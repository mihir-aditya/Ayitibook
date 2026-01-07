<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\RefundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    /**
     * List refunds for logged-in seller
     */
    public function index()
    {
        $sellerId = Auth::id();

        $refunds = RefundRequest::whereHas('order', function ($q) use ($sellerId) {
            $q->where('seller_id', $sellerId);
        })
        ->orderByDesc('requested_at')
        ->get();

        return view('sellr.refund', compact('refunds'));
    }

    /**
     * View single refund request
     */
    public function show($sl_no)
    {
        $sellerId = Auth::id();

        $refund = RefundRequest::where('sl_no', $sl_no)
            ->whereHas('order', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->firstOrFail();

        // return view('seller.refunds.show', compact('refund'));
    }

    /**
     * Update refund status (approve / reject / refunded)
     */
    public function updateStatus(Request $request, $sl_no)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,refunded',
        ]);

        $sellerId = Auth::id();

        $refund = RefundRequest::where('sl_no', $sl_no)
            ->whereHas('order', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->firstOrFail();

        // prevent invalid transitions
        if ($refund->status === 'refunded') {
            return back()->with('error', 'Refund already completed');
        }

        $refund->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Refund status updated successfully');
    }
}
