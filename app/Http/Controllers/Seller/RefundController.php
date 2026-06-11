<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\RefundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\NotificationService;

class RefundController extends Controller
{
    /**
     * List refunds for logged-in seller
     */
    public function index(Request $request)
    {
        $sellerId = Auth::id();
        $status = $request->query('status');
        $search = $request->query('search');

        // Build the query - need to check where seller_id is stored
        // Assuming seller_id might be in orders table or order_items table
        $query = RefundRequest::with([
            'orderItem.product', 
            'user', 
            'order'
        ]);

        // Check where seller_id actually exists
        // Option 1: If seller_id is in orders table
        if (DB::getSchemaBuilder()->hasColumn('orders', 'seller_id')) {
            $query->whereHas('order', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            });
        } 
        // Option 2: If seller_id is in order_items table
        else if (DB::getSchemaBuilder()->hasColumn('order_items', 'seller_id')) {
            $query->whereHas('orderItem', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            });
        }
        // Option 3: If neither, we need to find another way
        else {
            // Fallback: Show all refunds or implement different logic
            // For now, let's show only if user is admin or implement proper permission
            if (!Auth::user()->hasRole('admin')) {
                return redirect()->back()->with('error', 'Unable to filter refunds by seller.');
            }
        }

        // Filter by status if provided
        if ($status && in_array($status, ['pending', 'approved', 'rejected', 'refunded'])) {
            $query->where('status', $status);
        }

        // Search functionality
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('sl_no', 'like', "%{$search}%")
                  ->orWhere('refund_id', 'like', "%{$search}%")
                  ->orWhereHas('order', function ($q2) use ($search) {
                      $q2->where('sl_no', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Order by requested_at (most recent first)
        $query->orderBy('requested_at', 'desc');

        $refunds = $query->paginate(15);

        return view('seller.refund.refund', compact('refunds', 'status', 'search'));
    }

    /**
     * View single refund request
     */
    public function show($id)
    {
        $sellerId = Auth::id();

        $refund = RefundRequest::with([
            'orderItem.product', 
            'user', 
            'order'
        ])->where('sl_no', $id);

        // Apply seller filter based on where seller_id exists
        if (DB::getSchemaBuilder()->hasColumn('orders', 'seller_id')) {
            $refund->whereHas('order', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            });
        } else if (DB::getSchemaBuilder()->hasColumn('order_items', 'seller_id')) {
            $refund->whereHas('orderItem', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            });
        }

        $refund = $refund->firstOrFail();

        return view('seller.refund.showrefund', compact('refund'));
    }

    /**
     * Update refund status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,refunded,pending',
            'refund_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:500'
        ]);

        $sellerId = Auth::id();

        $refund = RefundRequest::where('sl_no', $id);

        // Apply seller filter
        if (DB::getSchemaBuilder()->hasColumn('orders', 'seller_id')) {
            $refund->whereHas('order', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            });
        } else if (DB::getSchemaBuilder()->hasColumn('order_items', 'seller_id')) {
            $refund->whereHas('orderItem', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            });
        }

        $refund = $refund->firstOrFail();

        // Validate status transition
        $validTransitions = [
            'pending' => ['approved', 'rejected'],
            'approved' => ['refunded', 'pending'],
            'rejected' => ['pending'],
            'refunded' => [] // No transitions from refunded
        ];

        if (!in_array($request->status, $validTransitions[$refund->status] ?? [])) {
            return back()->with('error', "Cannot change status from {$refund->status} to {$request->status}.");
        }

        // Update refund
        $updateData = [
            'status' => $request->status,
            'processed_at' => now(),
        ];

        // Add refund amount if provided
        if ($request->filled('refund_amount')) {
            $updateData['refund_amount'] = $request->refund_amount;
        }

        // Add notes if provided
        if ($request->filled('notes')) {
            $updateData['admin_notes'] = $request->notes;
        }

        $refund->update($updateData);

        // Send notification to user
        $this->sendRefundStatusNotification($refund, $request->status);

        return back()->with('success', 'Refund status updated successfully.');
    }

    /**
     * Send notification to user about refund status change
     */
    private function sendRefundStatusNotification($refund, string $newStatus): void
    {
        // Delegate to the central NotificationService
        app(NotificationService::class)->refundStatusChanged($refund, $newStatus);
    }

    /**
     * Get refund statistics for dashboard
     */
    public function statistics()
    {
        $sellerId = Auth::id();
        
        $stats = RefundRequest::selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = "approved" THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = "rejected" THEN 1 ELSE 0 END) as rejected,
            SUM(CASE WHEN status = "refunded" THEN 1 ELSE 0 END) as refunded
        ');
        
        // Apply seller filter
        if (DB::getSchemaBuilder()->hasColumn('orders', 'seller_id')) {
            $stats->whereHas('order', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            });
        } else if (DB::getSchemaBuilder()->hasColumn('order_items', 'seller_id')) {
            $stats->whereHas('orderItem', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            });
        }
        
        return $stats->first();
    }

    /**
     * Bulk update refund status
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'refund_ids' => 'required|array',
            'refund_ids.*' => 'exists:refund_requests,sl_no',
            'status' => 'required|in:approved,rejected,refunded',
            'action' => 'required|in:update,delete'
        ]);

        $sellerId = Auth::id();
        $updated = 0;

        foreach ($request->refund_ids as $id) {
            $refund = RefundRequest::where('sl_no', $id);
            
            // Apply seller filter
            if (DB::getSchemaBuilder()->hasColumn('orders', 'seller_id')) {
                $refund->whereHas('order', function ($q) use ($sellerId) {
                    $q->where('seller_id', $sellerId);
                });
            } else if (DB::getSchemaBuilder()->hasColumn('order_items', 'seller_id')) {
                $refund->whereHas('orderItem', function ($q) use ($sellerId) {
                    $q->where('seller_id', $sellerId);
                });
            }
            
            $refund = $refund->first();
            
            if (!$refund) continue;

            if ($request->action === 'update') {
                $refund->update([
                    'status' => $request->status,
                    'processed_at' => now()
                ]);
                $updated++;
                
                // Send notification
                $this->sendRefundStatusNotification($refund, $request->status);
            } 
            // Note: You might not want to allow deletion, but keeping the structure
            else if ($request->action === 'delete' && Auth::user()->hasRole('admin')) {
                $refund->delete();
                $updated++;
            }
        }

        $message = $request->action === 'update' 
            ? "Updated {$updated} refund requests to " . ucfirst($request->status)
            : "Deleted {$updated} refund requests";

        return back()->with('success', $message);
    }
}