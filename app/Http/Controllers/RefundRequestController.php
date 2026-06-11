<?php

namespace App\Http\Controllers;

use App\Models\RefundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RefundRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id'        => 'required|exists:orders,order_id',
            'order_item_id'   => 'required|exists:order_items,sl_no',
            'reason'          => 'required|string|max:255',
            'comments'        => 'nullable|string',
            'images'          => 'nullable|array',
            'images.*'        => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $refundId = random_int(10000, 99999);

        // Store uploaded images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('refund_evidence', 'public');
                $imagePaths[] = $path;
            }
        }

        $refund = RefundRequest::create([
            'refund_id'      => $refundId,
            'order_id'       => $request->order_id,
            'order_item_id'  => $request->order_item_id,
            'user_id'        => Auth::id(),
            'reason'         => $request->reason,
            'comments'       => $request->comments,
            'images'         => $imagePaths,
            'status'         => 'pending',
            'requested_at'   => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Refund request submitted successfully. Request ID: ' . $refundId,
            'refund'  => $refund,
        ]);
    }
}