<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller');
    }

    public function index()
    {
        $seller   = Auth::guard('seller')->user();
        $sellerId = $seller->id;

        /* ===================== METRICS ===================== */
        $totalProducts = Product::where('seller_id', $sellerId)->count();

        $activeProducts = Product::where('seller_id', $sellerId)
            ->where('is_active', 1)
            ->count();

        $totalOrders = OrderItem::whereHas('product', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->distinct('order_id')
            ->count('sl_no');

        $totalRevenue = OrderItem::whereHas('product', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->where('orders.order_status', 'delivered')
            ->sum(DB::raw('order_items.price * order_items.quantity'));

        /* ===================== CHARTS ===================== */
        $ordersChart = OrderItem::join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.placed_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw('MONTH(orders.placed_at) as month'),
                DB::raw('COUNT(DISTINCT orders.order_id) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $revenueChart = OrderItem::join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.order_status', 'delivered')
            ->where('orders.placed_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw('MONTH(orders.placed_at) as month'),
                DB::raw('SUM(order_items.price * order_items.quantity) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        /* ===================== RECENT ORDERS ===================== */
        $recentOrders = Order::with(['items' => function ($q) use ($sellerId) {
                $q->whereHas('product', function ($p) use ($sellerId) {
                    $p->where('seller_id', $sellerId);
                })->with('product');
            }])
            ->whereHas('items', function ($q) use ($sellerId) {
                $q->whereHas('product', function ($p) use ($sellerId) {
                    $p->where('seller_id', $sellerId);
                });
            })
            ->orderBy('placed_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($order) use ($sellerId) {
                // Filter items to only those belonging to this seller (in case of mixed orders)
                $sellerItems = $order->items->filter(function ($item) use ($sellerId) {
                    return $item->product->seller_id == $sellerId;
                });

                $totalAmount = $sellerItems->sum(function ($item) {
                    return $item->price * $item->quantity;
                });

                $productNames = $sellerItems->map(function ($item) {
                    return $item->product->name;
                })->implode(', ');

                return (object) [
                    'order_id'      => $order->order_id,
                    'order_status'  => $order->order_status,
                    'product_names' => $productNames,
                    'total_amount'  => $totalAmount,
                    'placed_at'     => $order->placed_at,
                ];
            });

        return view('seller.dashboard.dashboard', compact(
            'seller',
            'totalProducts',
            'activeProducts',
            'totalOrders',
            'totalRevenue',
            'ordersChart',
            'revenueChart',
            'recentOrders'
        ));
    }
}