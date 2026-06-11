<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RefundRequest;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RefundController extends Controller
{
    /* ══════════════════════════════════════════
       INDEX – list all refund / return requests
    ══════════════════════════════════════════ */
    public function index(Request $request)
    {
        $query = RefundRequest::with([
            'user',
            'orderItem.product',
            'orderItem.variant',
        ]);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('refund_id', 'like', "%{$s}%")
                    ->orWhere('order_id', 'like', "%{$s}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$s}%")
                        ->orWhere('email', 'like', "%{$s}%")
                    );
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('requested_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('requested_at', '<=', $request->date_to);
        }

        if ($request->filled('reason') && $request->reason !== 'all') {
            $query->where('reason', $request->reason);
        }

        $sortBy = $request->get('sort_by', 'requested_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $refunds = $query->paginate(20)->withQueryString();

        $stats = [
            'total' => RefundRequest::count(),
            'pending' => RefundRequest::where('status', 'pending')->count(),
            'approved' => RefundRequest::where('status', 'approved')->count(),
            'rejected' => RefundRequest::where('status', 'rejected')->count(),
            'refunded' => RefundRequest::where('status', 'refunded')->count(),
        ];

        $reasons = RefundRequest::select('reason')
            ->distinct()
            ->whereNotNull('reason')
            ->pluck('reason');

        return view('admin.refunds.index', compact('refunds', 'stats', 'reasons'));
    }

    /* ══════════════════════════════════════════
       SHOW – detail modal data (AJAX)
    ══════════════════════════════════════════ */
    public function show(RefundRequest $refund)
    {
        $refund->load([
            'user',
            'orderItem.product',
            'orderItem.variant',
            'order',
        ]);

        return response()->json([
            'success' => true,
            'refund' => $refund,
        ]);
    }

    /* ══════════════════════════════════════════
       UPDATE STATUS
    ══════════════════════════════════════════ */
    public function updateStatus(Request $request, RefundRequest $refund)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,refunded',
            'admin_note' => 'nullable|string|max:1000',
            'refund_amount' => 'required_if:status,approved|numeric|min:0.01',
        ]);

        $oldStatus = $refund->status;
        $newStatus = $request->status;

        if ($oldStatus === 'approved' && $newStatus === 'approved') {
            return back()->with('info', "Refund #{$refund->refund_id} is already approved.");
        }

        if ($newStatus === 'approved' && ! $refund->user) {
            return back()->with('error', "Cannot approve: user not found for refund #{$refund->refund_id}.");
        }

        DB::beginTransaction();
        try {
            // 1. Update refund status
            DB::table('refund_requests')
                ->where('sl_no', $refund->sl_no)
                ->update(['status' => $newStatus]);

            // 2. Wallet credit on approval
            if ($newStatus === 'approved') {
                $amount = (float) $request->refund_amount;
                $userId = $refund->user->id;

                // Read the latest balance inside the transaction with a lock
                $lockedUser = DB::table('users')
                    ->where('id', $userId)
                    ->lockForUpdate()
                    ->first();

                $newBalance = ((float) $lockedUser->wallet_balance) + $amount;

                // Update wallet balance
                DB::table('users')
                    ->where('id', $userId)
                    ->update(['wallet_balance' => $newBalance]);

                // Insert wallet transaction log using raw DB to avoid
                // Eloquent timestamp issues (updated_at may not exist on table)
                DB::table('wallet_transactions')->insert([
                    'transaction_id' => 'RFD_'.strtoupper(Str::random(10)),
                    'user_id' => $userId,
                    'amount' => $amount,
                    'transaction_type' => 'credit',
                    'purpose' => 'refund_approved',
                    'balance_after' => $newBalance,
                    'created_at' => now(),
                ]);
            }

            DB::commit();

            $notifSvc = app(NotificationService::class);
            $notifSvc->refundStatusChanged($refund, $newStatus);

            // Extra wallet-credited notification when approved
            if ($newStatus === 'approved') {
                $amount = (float) $request->refund_amount;
                $notifSvc->walletCredited($refund->user->id, $amount, 'refund');
            }

            $this->logActivity(
                "Refund {$refund->refund_id} status: {$oldStatus} → {$newStatus}".
                ($newStatus === 'approved' ? ' | Wallet credited' : '')
            );

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Refund status update failed', [
                'refund_id' => $refund->refund_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Failed: '.$e->getMessage());
        }

        $msg = $newStatus === 'approved'
            ? "Refund #{$refund->refund_id} approved & wallet credited."
            : "Refund #{$refund->refund_id} marked as {$newStatus}.";

        return back()->with('success', $msg);
    }

    /* ══════════════════════════════════════════
       BULK ACTION
    ══════════════════════════════════════════ */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,refunded,delete',
            'refund_ids' => 'required|array',
            'refund_ids.*' => 'exists:refund_requests,sl_no',
        ]);

        $ids = $request->refund_ids;
        $action = $request->action;

        DB::beginTransaction();
        try {
            switch ($action) {

                case 'approve':
                    $pendingRefunds = RefundRequest::with(['user', 'orderItem'])
                        ->whereIn('sl_no', $ids)
                        ->where('status', '!=', 'approved')
                        ->get();

                    foreach ($pendingRefunds as $refund) {
                        $amount = (float) (
                            optional($refund->orderItem)->price *
                            optional($refund->orderItem)->quantity ?? 0
                        );

                        DB::table('refund_requests')
                            ->where('sl_no', $refund->sl_no)
                            ->update(['status' => 'approved']);

                        if ($amount > 0 && $refund->user) {
                            $lockedUser = DB::table('users')
                                ->where('id', $refund->user->id)
                                ->lockForUpdate()
                                ->first();

                            $newBalance = ((float) $lockedUser->wallet_balance) + $amount;

                            DB::table('users')
                                ->where('id', $refund->user->id)
                                ->update(['wallet_balance' => $newBalance]);

                            DB::table('wallet_transactions')->insert([
                                'transaction_id' => 'RFD_'.strtoupper(Str::random(10)),
                                'user_id' => $refund->user->id,
                                'amount' => $amount,
                                'transaction_type' => 'credit',
                                'purpose' => 'refund_approved',
                                'balance_after' => $newBalance,
                                'created_at' => now(),
                            ]);

                        }
                        app(NotificationService::class)->refundStatusChanged($refund, 'approved');
                        if ($amount > 0 && $refund->user) {
                            app(NotificationService::class)->walletCredited($refund->user->id, $amount, 'refund');
                        }

                    }
                    break;

                case 'reject':
                    RefundRequest::whereIn('sl_no', $ids)->update(['status' => 'rejected']);
                    foreach (RefundRequest::whereIn('sl_no', $ids)->get() as $r) {
                        app(NotificationService::class)->refundStatusChanged($r, 'rejected');
                    }
                    break;

                case 'refunded':
                    RefundRequest::whereIn('sl_no', $ids)->update(['status' => 'refunded']);
                    break;

                case 'delete':
                    RefundRequest::whereIn('sl_no', $ids)->delete();
                    break;
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->with('error', 'Bulk action failed: '.$e->getMessage());
        }

        $this->logActivity("Bulk '{$action}' on ".count($ids).' refund requests');

        return back()->with('success', count($ids).' refund(s) updated.');
    }

    /* ══════════════════════════════════════════
       EXPORT CSV
    ══════════════════════════════════════════ */
    public function export(Request $request)
    {
        $query = RefundRequest::with(['user', 'orderItem.product']);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $refunds = $query->orderBy('requested_at', 'desc')->get();
        $fileName = 'refunds-'.date('Y-m-d').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Refund ID', 'Order ID', 'User', 'Email', 'Product', 'Reason', 'Status', 'Requested At'];

        $callback = function () use ($refunds, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($refunds as $r) {
                fputcsv($file, [
                    $r->refund_id,
                    $r->order_id,
                    $r->user->name ?? '—',
                    $r->user->email ?? '—',
                    $r->orderItem->product->name ?? '—',
                    ucwords(str_replace('_', ' ', $r->reason ?? '')),
                    ucfirst($r->status ?? ''),
                    $r->requested_at ? $r->requested_at->format('Y-m-d H:i:s') : '—',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /* ══════════════════════════════════════════
       ACTIVITY LOGGER
    ══════════════════════════════════════════ */
    private function logActivity(string $action): void
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('activity_logs')) {
            DB::table('activity_logs')->insert([
                'admin_id' => auth()->guard('admin')->id(),
                'action' => $action,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
