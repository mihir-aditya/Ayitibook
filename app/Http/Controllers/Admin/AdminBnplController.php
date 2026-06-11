<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BnplLoan;
use App\Models\BnplPayment;
use App\Models\BnplProfile;
use App\Models\BnplTier;
use App\Models\BnplCreditScore;
use App\Models\User;
use App\Services\BnplService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminBnplController extends Controller
{
    protected BnplService $bnplService;

    public function __construct(BnplService $bnplService)
    {
        $this->bnplService = $bnplService;
    }

    /**
     * BNPL overview / index page.
     */
    public function index(Request $request)
    {
        // ── Platform-wide stats ──────────────────────────────────────
        $totalUsers     = BnplProfile::count();
        $eligibleUsers  = BnplProfile::where('is_eligible', true)->count();
        $activeLoans    = BnplLoan::where('status', 'active')->count();
        $activeLoanVal  = BnplLoan::where('status', 'active')->sum('remaining_amount');
        $completedLoans = BnplLoan::where('status', 'completed')->count();
        $totalRepaid    = BnplPayment::where('status', 'paid')->sum('amount_paid');
        $overdueCount   = BnplPayment::where('status', 'overdue')->count();
        $overdueAmount  = BnplPayment::where('status', 'overdue')->sum('amount_due');
        $avgScore       = BnplProfile::avg('credit_score') ?? 0;
        $defaultCount   = BnplLoan::where('status', 'defaulted')->count();
        $totalLoans     = BnplLoan::count();
        $defaultRate    = $totalLoans > 0 ? ($defaultCount / $totalLoans) * 100 : 0;

        // Payment health
        $totalPayments  = BnplPayment::whereIn('status', ['paid', 'overdue'])->count() ?: 1;
        $onTimePayments = BnplPayment::where('status', 'paid')->where('days_late', 0)->count();
        $latePayments   = BnplPayment::where('status', 'paid')->where('days_late', '>', 0)->count();
        $missedPayments = BnplPayment::where('status', 'overdue')->count();

        $stats = [
            'total_users'       => $totalUsers,
            'eligible_users'    => $eligibleUsers,
            'active_loans'      => $activeLoans,
            'active_loan_value' => $activeLoanVal,
            'completed_loans'   => $completedLoans,
            'total_repaid'      => $totalRepaid,
            'overdue_count'     => $overdueCount,
            'overdue_amount'    => $overdueAmount,
            'avg_credit_score'  => round($avgScore),
            'default_count'     => $defaultCount,
            'default_rate'      => $defaultRate,
            'on_time_rate'      => ($onTimePayments / $totalPayments) * 100,
            'late_rate'         => ($latePayments   / $totalPayments) * 100,
            'missed_rate'       => ($missedPayments  / $totalPayments) * 100,
        ];

        // ── Tier distribution ────────────────────────────────────────
        $tierDistribution = BnplProfile::whereNotNull('tier')
            ->selectRaw('LOWER(tier) as tier_name, COUNT(*) as cnt')
            ->groupBy('tier_name')
            ->pluck('cnt', 'tier_name')
            ->toArray();

        $tierDistribution = array_merge(
            ['platinum' => 0, 'gold' => 0, 'silver' => 0, 'bronze' => 0],
            $tierDistribution
        );

        // ── Chart data: last 30 days ─────────────────────────────────
        $days = collect(range(29, 0))->map(fn($i) => now()->subDays($i)->format('Y-m-d'));

        $loansByDay = BnplLoan::selectRaw('DATE(created_at) as date, COUNT(*) as cnt')
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->pluck('cnt', 'date');

        $paysByDay = BnplPayment::selectRaw('DATE(paid_at) as date, COUNT(*) as cnt')
            ->whereNotNull('paid_at')
            ->where('paid_at', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->pluck('cnt', 'date');

        $chartLabels   = $days->map(fn($d) => Carbon::parse($d)->format('M d'))->values()->toArray();
        $chartLoans    = $days->map(fn($d) => (int)($loansByDay[$d] ?? 0))->values()->toArray();
        $chartPayments = $days->map(fn($d) => (int)($paysByDay[$d] ?? 0))->values()->toArray();

        // ── Overdue payments ─────────────────────────────────────────
        $overduePayments = BnplPayment::with(['loan', 'user'])
            ->where('status', 'overdue')
            ->orderByDesc('days_late')
            ->take(10)
            ->get();

        // ── Paginated BNPL profiles ──────────────────────────────────
        $bnplProfiles = BnplProfile::with('user')
            ->when($request->search, fn($q) => $q->whereHas('user', fn($u) =>
                $u->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
            ))
            ->when($request->tier, fn($q) => $q->where('tier', $request->tier))
            ->when($request->status === 'eligible',   fn($q) => $q->where('is_eligible', true))
            ->when($request->status === 'ineligible', fn($q) => $q->where('is_eligible', false))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.bnpl.index', compact(
            'stats',
            'tierDistribution',
            'chartLabels',
            'chartLoans',
            'chartPayments',
            'overduePayments',
            'bnplProfiles'
        ));
    }

    /**
     * BNPL detail page for a single user.
     */
    public function show(User $user)
    {
        $user->load([
            'bnplProfile',
            'bnplLoans.payments',
            'bnplPayments.loan',
            'bnplCreditScores',
            'bnplMilestones',
        ]);

        $profile          = $user->bnplProfile;
        $tiers            = BnplTier::active()->ordered()->get();
        $latestCreditScore = $user->bnplCreditScores()
            ->latest('calculated_at')
            ->first();

        return view('admin.bnpl.show', compact(
            'user',
            'profile',
            'tiers',
            'latestCreditScore'
        ));
    }

    /**
     * Enable BNPL for a user.
     */
    public function enable(User $user)
    {
        $profile = $user->bnplProfile;

        if (! $profile) {
            return back()->with('error', 'No BNPL profile found for this user.');
        }

        $profile->update(['is_enabled' => true]);

        return back()->with('success', "BNPL enabled for {$user->name}.");
    }

    /**
     * Disable BNPL for a user.
     */
    public function disable(User $user)
    {
        $profile = $user->bnplProfile;

        if (! $profile) {
            return back()->with('error', 'No BNPL profile found for this user.');
        }

        $profile->update(['is_enabled' => false]);

        return back()->with('success', "BNPL disabled for {$user->name}.");
    }

    /**
     * Admin override: update a user's credit limit.
     */
    public function updateLimit(Request $request, User $user)
    {
        $request->validate([
            'new_limit' => 'required|numeric|min:0|max:999999',
        ]);

        $profile = $user->bnplProfile;

        if (! $profile) {
            return back()->with('error', 'No BNPL profile found for this user.');
        }

        $oldLimit = $profile->current_limit;
        $newLimit = $request->new_limit;
        $used     = $profile->used_limit ?? 0;

        $profile->update([
            'current_limit'   => $newLimit,
            'available_limit' => max(0, $newLimit - $used),
        ]);

        return back()->with('success', "Credit limit updated from \${$oldLimit} to \${$newLimit} for {$user->name}.");
    }

    /**
     * Trigger a credit score recalculation.
     */
    public function recalculate(User $user)
    {
        try {
            $newScore = $this->bnplService->updateCreditScore($user->id);
            return back()->with('success', "Credit score recalculated: {$newScore} for {$user->name}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Recalculation failed: ' . $e->getMessage());
        }
    }
}