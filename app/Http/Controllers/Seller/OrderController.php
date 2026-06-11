<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\NotificationService;

class OrderController extends Controller
{
    /* ──────────────────────────────────────────────
     | List all orders for the logged-in seller
     ─────────────────────────────────────────────── */
    public function index()
    {
        $seller = Auth::guard('seller')->user();

        $orders = Order::with(['user'])
            ->where('seller_id', $seller->id)
            ->orderByDesc('placed_at')
            ->get();

        return view('seller.orders.orders', compact('orders'));
    }

    /* ──────────────────────────────────────────────
     | Show full order details
     ─────────────────────────────────────────────── */
    public function show($id)
    {
        $order = Order::with([
                'items.product',
                'items.product.seller',
                'items.variant',
                'user',
                'address',
            ])
            ->where(function ($q) use ($id) {
                $q->where('sl_no', $id)->orWhere('order_id', $id);
            })
            ->first();

        if (!$order) {
            abort(404, 'Order not found');
        }

        $user    = $order->user;
        $address = $order->address;
        $items   = $order->items;   // Collection of OrderItem, each has ->product and ->variant

        return view('seller.orders.orderdetails', compact('order', 'items', 'user', 'address'));
    }

    /* ──────────────────────────────────────────────
     | Update order status  (AJAX POST)
     ─────────────────────────────────────────────── */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('sl_no', $id)->orWhere('order_id', $id)->first();
 
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
 
        $validStatuses = ['placed', 'confirmed', 'shipped', 'delivered', 'cancelled', 'refunded'];
        $status        = $request->input('status');
 
        if (!in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Invalid status'], 400);
        }
 
        $order->order_status = $status;
        $order->save();
 
        // ── Notify the buyer ────────────────────────────────
        $svc = app(NotificationService::class);
        match ($status) {
            'confirmed'  => $svc->orderConfirmed($order),
            'shipped'    => $svc->orderShipped($order),
            'delivered'  => $svc->orderDelivered($order),
            'cancelled'  => $svc->orderCancelled($order, 'seller'),
            default      => null,
        };
        // ────────────────────────────────────────────────────
 
        return response()->json(['success' => true, 'message' => 'Status updated to ' . $status]);
    }

    /* ──────────────────────────────────────────────
     | Save internal notes  (AJAX POST)
     ─────────────────────────────────────────────── */
    public function saveNotes(Request $request, $id)
    {
        $order = Order::where('sl_no', $id)->orWhere('order_id', $id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Use raw DB update since 'notes' isn't in $fillable on Order model
        DB::table('orders')
            ->where('sl_no', $order->sl_no)
            ->update(['notes' => $request->input('notes')]);

        return response()->json(['success' => true, 'message' => 'Notes saved']);
    }

    /* ──────────────────────────────────────────────
     | Cancel order  (AJAX POST)
     ─────────────────────────────────────────────── */
    public function cancel($id)
    {
        $order = Order::where('sl_no', $id)->orWhere('order_id', $id)->first();
 
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
 
        if (in_array($order->order_status, ['delivered', 'refunded'])) {
            return response()->json([
                'error' => 'Cannot cancel a ' . $order->order_status . ' order'
            ], 422);
        }
 
        $order->order_status = 'cancelled';
        $order->save();
 
        // ── Notify the buyer ────────────────────────────────
        app(NotificationService::class)->orderCancelled($order, 'seller');
        // ────────────────────────────────────────────────────
 
        return response()->json(['success' => true, 'message' => 'Order cancelled']);
    }
}