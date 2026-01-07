<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->select('sl_no', 'order_id', 'user_id', 'total_amount', 'order_status', 'placed_at')->orderBy('placed_at', 'desc')->get();
        
        // Convert placed_at strings to Carbon instances
        $orders = $orders->map(function($order) {
            $order->placed_at = Carbon::parse($order->placed_at);
            return $order;
        });
        
        return view('sellr.apps.e-commerce.admin.orders', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = DB::table('orders')
            ->select('sl_no', 'order_id', 'user_id', 'address_id', 'payment_method', 'total_amount', 'order_status', 'placed_at', 'created_at', 'updated_at')
            ->where('sl_no', $id)
            ->orWhere('order_id', $id)
            ->first();

        if (!$order) {
            abort(404, 'Order not found');
        }

        // Convert dates to Carbon instances
        $order->placed_at = Carbon::parse($order->placed_at);
        $order->created_at = Carbon::parse($order->created_at);
        $order->updated_at = Carbon::parse($order->updated_at);

        // Use order_id if available, otherwise use sl_no
        $orderId = $order->order_id ?? $order->sl_no;
        
        $items = DB::table('order_items')
            ->leftJoin('product_variants', 'order_items.variant_id', '=', 'product_variants.variant_id')
            ->where('order_items.order_id', $orderId)
            ->select('order_items.*', 'product_variants.variant_name as variant_name')
            ->get();

        // Fetch user data (with null check)
        $user = $order->user_id ? DB::table('users')->where('id', $order->user_id)->first() : null;

        // Fetch address data (with null check)
        $address = $order->address_id ? DB::table('addresses')->where('id', $order->address_id)->first() : null;

        return view('sellr.apps.e-commerce.admin.orderdetails', ['order' => $order, 'items' => $items, 'user' => $user, 'address' => $address]);
    }

    public function updateStatus($id)
    {
        $order = DB::table('orders')
            ->where('sl_no', $id)
            ->orWhere('order_id', $id)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $status = request()->input('status');
        
        // Validate status
        $validStatuses = ['placed', 'confirmed', 'shipped', 'delivered', 'cancelled', 'refunded'];
        if (!in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        // Update the order status
        DB::table('orders')
            ->where('sl_no', $order->sl_no)
            ->update([
                'order_status' => $status,
                'updated_at' => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Order status updated']);
    }

    public function saveNotes($id)
    {
        $order = DB::table('orders')
            ->where('sl_no', $id)
            ->orWhere('order_id', $id)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $notes = request()->input('notes');

        // Update the order notes
        DB::table('orders')
            ->where('sl_no', $order->sl_no)
            ->update([
                'notes' => $notes,
                'updated_at' => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Notes saved']);
    }

    public function cancel($id)
    {
        $order = DB::table('orders')
            ->where('sl_no', $id)
            ->orWhere('order_id', $id)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Update the order status to cancelled
        DB::table('orders')
            ->where('sl_no', $order->sl_no)
            ->update([
                'order_status' => 'cancelled',
                'updated_at' => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Order cancelled']);
    }
}
