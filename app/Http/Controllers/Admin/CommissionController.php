<?php
// app/Http/Controllers/Admin/CommissionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of commissions.
     */
    public function index(Request $request)
    {
        $query = Commission::with(['affiliate.user', 'order']);

        // Filter by affiliate
        if ($request->has('affiliate_id') && !empty($request->affiliate_id)) {
            $query->where('affiliate_id', $request->affiliate_id);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Search by order ID
        if ($request->has('order_id') && !empty($request->order_id)) {
            $query->where('order_id', 'like', "%{$request->order_id}%");
        }

        $commissions = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.affiliate-commissions.index', compact('commissions'));
    }

    /**
     * Display the specified commission.
     */
    public function show(Commission $commission)
    {
        $commission->load(['affiliate.user', 'order']);

        return view('admin.affiliate-commissions.show', compact('commission'));
    }

    /**
     * Update the commission status.
     */
    public function updateStatus(Request $request, Commission $commission)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $commission->update([
            'status' => $request->status,
        ]);

        // If status is paid, update affiliate total earnings
        if ($request->status === 'paid') {
            $commission->affiliate->increment('total_earnings', $commission->amount);
        }

        return back()->with('success', 'Commission status updated successfully.');
    }

    /**
     * Approve a commission.
     */
    public function approveCommission(Commission $commission)
    {
        if ($commission->status !== 'pending') {
            return back()->with('error', 'Only pending commissions can be approved.');
        }

        $commission->update(['status' => 'approved']);

        return back()->with('success', 'Commission approved successfully.');
    }

    /**
     * Reject a commission.
     */
    public function rejectCommission(Commission $commission)
    {
        if ($commission->status !== 'pending') {
            return back()->with('error', 'Only pending commissions can be rejected.');
        }

        $commission->update(['status' => 'cancelled']);

        return back()->with('success', 'Commission rejected successfully.');
    }

    /**
     * Mark commission as paid.
     */
    public function payCommission(Commission $commission)
    {
        if ($commission->status !== 'approved') {
            return back()->with('error', 'Only approved commissions can be paid.');
        }

        $commission->update(['status' => 'paid']);
        $commission->affiliate->increment('total_earnings', $commission->amount);

        return back()->with('success', 'Commission marked as paid successfully.');
    }

    /**
     * Bulk approve commissions.
     */
    public function bulkApproveCommissions(Request $request)
    {
        $request->validate([
            'commission_ids' => 'required|array',
            'commission_ids.*' => 'exists:commissions,id',
        ]);

        Commission::whereIn('id', $request->commission_ids)
                  ->where('status', 'pending')
                  ->update(['status' => 'approved']);

        return back()->with('success', 'Selected commissions approved successfully.');
    }

    /**
     * Bulk status update for affiliates.
     */
    public function bulkStatusUpdate(Request $request)
    {
        $request->validate([
            'affiliate_ids' => 'required|array',
            'affiliate_ids.*' => 'exists:affiliates,id',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        \App\Models\Affiliate::whereIn('id', $request->affiliate_ids)
                             ->update(['status' => $request->status]);

        return back()->with('success', 'Affiliate statuses updated successfully.');
    }
}