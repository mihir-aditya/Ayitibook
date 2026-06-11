<?php
// app/Http/Controllers/Admin/AffiliateController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    /**
     * Display a listing of affiliates.
     */
    public function index(Request $request)
    {
        $query = Affiliate::with('user');

        // Search by user name or email
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('affiliate_code', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $affiliates = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.affiliates.index', compact('affiliates'));
    }

    /**
     * Show the form for creating a new affiliate.
     */
    public function create()
    {
        // Get users who are not already affiliates
        $users = User::whereDoesntHave('affiliate')
                    //  ->where('is_admin', false) // Assuming you have an is_admin field
                     ->get();

        return view('admin.affiliates.create', compact('users'));
    }

    /**
     * Store a newly created affiliate.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:affiliates,user_id',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $affiliate = Affiliate::create([
            'user_id' => $request->user_id,
            'affiliate_code' => $this->generateUniqueAffiliateCode(),
            'status' => $request->status,
            'total_earnings' => 0,
        ]);

        return redirect()->route('admin.affiliate.show', $affiliate)
                         ->with('success', 'Affiliate created successfully.');
    }

    /**
     * Display the specified affiliate.
     */
    public function show(Affiliate $affiliate)
    {
        $affiliate->load([
            'user', 
            'affiliateLinks.product',
            'affiliateClicks' => function ($query) {
                $query->latest()->limit(10);
            },
            'commissions' => function ($query) {
                $query->with('order')->latest()->limit(10);
            },
            'customerAffiliateLocks.customer'
        ]);

        $stats = [
            'total_clicks' => $affiliate->affiliateClicks()->count(),
            'total_links' => $affiliate->affiliateLinks()->count(),
            'total_commissions' => $affiliate->commissions()->count(),
            'pending_commissions' => $affiliate->commissions()->where('status', 'pending')->count(),
            'total_locked_customers' => $affiliate->customerAffiliateLocks()
                ->where('locked_until', '>', now())
                ->count(),
        ];

        return view('admin.affiliates.show', compact('affiliate', 'stats'));
    }

    /**
     * Show the form for editing the specified affiliate.
     */
    public function edit(Affiliate $affiliate)
    {
        return view('admin.affiliates.edit', compact('affiliate'));
    }

    /**
     * Update the specified affiliate.
     */
    public function update(Request $request, Affiliate $affiliate)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $affiliate->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.affiliate.show', $affiliate)
                         ->with('success', 'Affiliate updated successfully.');
    }

    /**
     * Remove the specified affiliate.
     */
    public function destroy(Affiliate $affiliate)
    {
        // Check if affiliate has any earnings or commissions
        if ($affiliate->total_earnings > 0 || $affiliate->commissions()->exists()) {
            return back()->with('error', 'Cannot delete affiliate with earnings or commissions. Consider suspending instead.');
        }

        $affiliate->delete();

        return redirect()->route('admin.affiliate.index')
                         ->with('success', 'Affiliate deleted successfully.');
    }

    /**
     * Generate a unique affiliate code.
     */
    private function generateUniqueAffiliateCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Affiliate::where('affiliate_code', $code)->exists());

        return $code;
    }

    /**
     * Get commissions for a specific affiliate.
     */
    public function getCommissions(Affiliate $affiliate)
    {
        $commissions = $affiliate->commissions()->with('order')->latest()->paginate(20);

        return view('admin.affiliates.commissions', compact('affiliate', 'commissions'));
    }

    /**
     * Get tracked products for affiliates.
     */
    public function trackedProducts(Request $request)
    {
        $query = \App\Models\Product::whereHas('affiliateLinks');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $products = $query->with(['affiliateLinks.affiliate.user'])->paginate(20);

        return view('admin.affiliates.tracked-products', compact('products'));
    }
}