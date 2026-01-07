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
        $sellerId = Auth::guard('seller')->id();

        /* ===================== METRICS ===================== */

        $totalProducts = Product::where('seller_id', $sellerId)->count();

        $activeProducts = Product::where('seller_id', $sellerId)
            ->where('is_active', 1)
            ->count();

        $totalOrders = OrderItem::whereHas('product', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->distinct('order_id')
            ->count('order_id');

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

        return view('sellr.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'totalOrders',
            'totalRevenue',
            'ordersChart',
            'revenueChart'
        ));
    }
}
