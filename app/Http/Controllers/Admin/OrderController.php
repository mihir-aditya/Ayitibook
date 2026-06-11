<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    /* =========================
       Show Orders List
    ========================== */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product.seller']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                    ->orWhere('total_amount', 'like', "%{$search}%")
                    ->orWhere('payment_method', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by order status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('order_status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method != 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by seller
        if ($request->has('seller') && $request->seller != 'all') {
            $query->whereHas('items.product', function ($q) use ($request) {
                $q->where('seller_id', $request->seller);
            });
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('placed_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('placed_at', '<=', $request->date_to);
        }

        // Filter by amount range
        if ($request->has('amount_from') && $request->amount_from != '') {
            $query->where('total_amount', '>=', $request->amount_from);
        }

        if ($request->has('amount_to') && $request->amount_to != '') {
            $query->where('total_amount', '<=', $request->amount_to);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'placed_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $orders = $query->paginate(20)->withQueryString();

        // Get filter data
        $sellers = Seller::where('status', 'approved')->get();

        // Statistics
        $stats = [
            'total' => Order::count(),
            'placed' => Order::where('order_status', 'placed')->count(),
            'confirmed' => Order::where('order_status', 'confirmed')->count(),
            'shipped' => Order::where('order_status', 'shipped')->count(),
            'delivered' => Order::where('order_status', 'delivered')->count(),
            'cancelled' => Order::where('order_status', 'cancelled')->count(),
            'refunded' => Order::where('order_status', 'refunded')->count(),
            'today' => Order::whereDate('placed_at', today())->count(),
            'week' => Order::where('placed_at', '>=', now()->subWeek())->count(),
            'month' => Order::where('placed_at', '>=', now()->subMonth())->count(),
            'total_revenue' => Order::where('order_status', 'delivered')->sum('total_amount'),
            'avg_order_value' => Order::where('order_status', 'delivered')->avg('total_amount') ?? 0,
        ];

        // Payment method stats
        $paymentStats = Order::select('payment_method', DB::raw('COUNT(*) as count'))
            ->groupBy('payment_method')
            ->get();

        $stats['payment_methods'] = $paymentStats;

        return view('admin.orders.index', compact('orders', 'sellers', 'stats'));
    }

    /* =========================
       Show Order Details
    ========================== */
    public function show($id)
    {
        // Find by order_id first, then by sl_no
        $order = Order::where('order_id', $id)
            ->orWhere('sl_no', $id)
            ->with([
                'user',
                'address',
                'items.product.seller',
                'items.product.category',
                'items.variant',
            ])
            ->firstOrFail();

        // Fetch transaction details safely (table may not exist yet)
        $transactions = collect();
        if (Schema::hasTable('transaction_details')) {
            $transactions = \App\Models\TransactionDetail::where('order_id', $order->order_id)
                ->orderBy('transaction_date', 'desc')
                ->get();
        }

        // Calculate order statistics
        $subtotal = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $orderStats = [
            'items_count' => $order->items->count(),
            'unique_sellers' => $order->items->pluck('product.seller_id')->filter()->unique()->count(),
            'total_quantity' => $order->items->sum('quantity'),
            'subtotal' => $subtotal,
            'tax' => $order->tax ?? 0,
            'shipping' => $order->shipping_fee ?? 0,
            'discount' => $order->discount_amount ?? 0,
        ];

        // Get order timeline
        $timeline = $this->getOrderTimeline($order);

        return view('admin.orders.show', compact('order', 'orderStats', 'timeline', 'transactions'));
    }

    /* =========================
       Update Order Status
    ========================== */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:placed,confirmed,shipped,delivered,cancelled,refunded',
            'notes' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->order_status;
        $newStatus = $request->status;

        $order->update([
            'order_status' => $newStatus,
        ]);

        // Log status change
        if ($request->notes) {
            $this->logOrderActivity($order, "Status changed from {$oldStatus} to {$newStatus}. Notes: {$request->notes}");
        } else {
            $this->logOrderActivity($order, "Status changed from {$oldStatus} to {$newStatus}");
        }

        // If order is delivered, update product sold counts
        if ($newStatus == 'delivered' && $oldStatus != 'delivered') {
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->increment('sold_count', $item->quantity);

                    // If product is in flash sale, update sales_count
                    if ($product->is_flash_sale) {
                        $product->increment('sales_count', $item->quantity);
                    }
                }
            }
        }

        // If order is cancelled and was delivered, revert sold counts
        if ($newStatus == 'cancelled' && $oldStatus == 'delivered') {
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->decrement('sold_count', $item->quantity);

                    // If product is in flash sale, revert sales_count
                    if ($product->is_flash_sale) {
                        $product->decrement('sales_count', $item->quantity);
                    }
                }
            }
        }

        return back()->with('success', 'Order status updated successfully');
    }

    /* =========================
       Bulk Update Orders
    ========================== */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:complete,process,cancel,delete',
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,sl_no',
        ]);

        $action = $request->action;
        $orderIds = $request->order_ids;
        $count = 0;

        switch ($action) {
            case 'complete':
                Order::whereIn('sl_no', $orderIds)->update(['order_status' => 'completed']);
                $count = count($orderIds);
                break;

            case 'process':
                Order::whereIn('sl_no', $orderIds)->update(['order_status' => 'processing']);
                $count = count($orderIds);
                break;

            case 'cancel':
                Order::whereIn('sl_no', $orderIds)->update(['order_status' => 'cancelled']);
                $count = count($orderIds);
                break;

            case 'delete':
                Order::whereIn('sl_no', $orderIds)->delete();
                $count = count($orderIds);
                break;
        }

        $this->logActivity("Bulk action '{$action}' on {$count} orders");

        return back()->with('success', "{$count} orders updated successfully");
    }

    /* =========================
       Export Orders
    ========================== */
    public function export(Request $request)
    {
        $type = $request->get('type', 'csv');
        $orders = Order::with(['user', 'items'])->get();

        if ($type == 'csv') {
            return $this->exportToCsv($orders);
        }

        return back()->with('error', 'Invalid export type');
    }

    /* =========================
       Export to CSV
    ========================== */
    private function exportToCsv($orders)
    {
        $fileName = 'orders-'.date('Y-m-d').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = [
            'Order ID', 'Customer', 'Email', 'Phone', 'Items', 'Total Amount',
            'Payment Method', 'Status', 'Placed At', 'Completed At',
        ];

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_id,
                    $order->user->name ?? 'N/A',
                    $order->user->email ?? 'N/A',
                    $order->user->phone ?? 'N/A',
                    $order->items->count(),
                    $order->total_amount,
                    $order->payment_method,
                    ucfirst($order->order_status),
                    $order->placed_at ? $order->placed_at->format('Y-m-d H:i:s') : 'N/A',
                    $order->completed_at ? $order->completed_at->format('Y-m-d H:i:s') : 'N/A',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /* =========================
       Get Order Statistics
    ========================== */
    public function getStatistics()
    {
        $stats = [
            'total_orders' => Order::count(),
            'placed_orders' => Order::where('order_status', 'placed')->count(),
            'confirmed_orders' => Order::where('order_status', 'confirmed')->count(),
            'shipped_orders' => Order::where('order_status', 'shipped')->count(),
            'delivered_orders' => Order::where('order_status', 'delivered')->count(),
            'cancelled_orders' => Order::where('order_status', 'cancelled')->count(),
            'refunded_orders' => Order::where('order_status', 'refunded')->count(),
            'today_orders' => Order::whereDate('placed_at', today())->count(),
            'week_orders' => Order::where('placed_at', '>=', now()->subWeek())->count(),
            'month_orders' => Order::where('placed_at', '>=', now()->subMonth())->count(),
            'total_revenue' => Order::where('order_status', 'delivered')->sum('total_amount'),
            'avg_order_value' => Order::where('order_status', 'delivered')->avg('total_amount') ?? 0,
        ];

        // Daily order count for chart (last 30 days)
        $dailyOrders = Order::selectRaw('DATE(placed_at) as date, COUNT(*) as count')
            ->where('placed_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top selling products
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->whereHas('order', function ($q) {
                $q->where('order_status', 'delivered');
            })
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->with('product')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'stats' => $stats,
            'daily_orders' => $dailyOrders,
            'top_products' => $topProducts,
        ]);
    }

    /* =========================
       Get Order Timeline
    ========================== */
    private function getOrderTimeline($order)
    {
        $timeline = [];

        // Order placed
        if ($order->placed_at) {
            $timeline[] = [
                'event' => 'Order Placed',
                'description' => 'Order was placed by customer',
                'date' => $order->placed_at,
                'icon' => 'fas fa-shopping-cart',
                'color' => 'blue',
            ];
        }

        // Payment confirmed (if you have payment confirmation date)
        // Add if you have payment confirmation logic

        // Order status changes
        $statusChanges = [
            'placed' => 'Order Placed',
            'confirmed' => 'Order Confirmed',
            'shipped' => 'Order Shipped',
            'delivered' => 'Order Delivered',
            'cancelled' => 'Order Cancelled',
            'refunded' => 'Order Refunded',
        ];

        if (isset($statusChanges[$order->order_status])) {
            $timeline[] = [
                'event' => $statusChanges[$order->order_status],
                'description' => 'Order status updated',
                'date' => now(), // Use actual status change date if you track it
                'icon' => $this->getStatusIcon($order->order_status),
                'color' => $this->getStatusColor($order->order_status),
                'current' => true,
            ];
        }

        // Sort by date
        usort($timeline, function ($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        return $timeline;
    }

    /* =========================
       Get Status Icon
    ========================== */
    private function getStatusIcon($status)
    {
        $icons = [
            'placed' => 'fas fa-shopping-cart',
            'confirmed' => 'fas fa-check',
            'shipped' => 'fas fa-shipping-fast',
            'delivered' => 'fas fa-box-open',
            'cancelled' => 'fas fa-times-circle',
            'refunded' => 'fas fa-undo',
        ];

        return $icons[$status] ?? 'fas fa-question-circle';
    }

    /* =========================
       Get Status Color
    ========================== */
    private function getStatusColor($status)
    {
        $colors = [
            'placed' => 'blue',
            'confirmed' => 'indigo',
            'shipped' => 'amber',
            'delivered' => 'green',
            'cancelled' => 'red',
            'refunded' => 'purple',
        ];

        return $colors[$status] ?? 'gray';
    }

    /* =========================
       Log Order Activity
    ========================== */
    private function logOrderActivity($order, $action)
    {
        // Check if table exists before logging
        if (Schema::hasTable('order_activities')) {
            DB::table('order_activities')->insert([
                'order_id' => $order->order_id,
                'admin_id' => auth()->guard('admin')->id(),
                'action' => $action,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /* =========================
       Activity Logger
    ========================== */
    private function logActivity($action)
    {
        // Check if table exists before logging
        if (Schema::hasTable('activity_logs')) {
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
