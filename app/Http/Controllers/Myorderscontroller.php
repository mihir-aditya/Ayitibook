<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrdersController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['items.product'])
            ->where('user_id', Auth::id());

        // ─── SEARCH ─────────────────────────────────────────────────────────
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                // Search by order_id
                $q->where('order_id', 'like', "%{$searchTerm}%")
                  // Or by product name via items relationship
                    ->orWhereHas('items.product', function ($sub) use ($searchTerm) {
                        $sub->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // ─── STATUS FILTER ───────────────────────────────────────────────────
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // ─── TIME FILTER (Order Time) ───────────────────────────────────────
        if ($request->filled('time')) {
            switch ($request->time) {
                case '30days':
                    $query->where('placed_at', '>=', Carbon::now()->subDays(30));
                    break;
                case '2024':
                    $query->whereYear('placed_at', 2024);
                    break;
                case '2023':
                    $query->whereYear('placed_at', 2023);
                    break;
                case '2022':
                    $query->whereYear('placed_at', 2022);
                    break;
                case '2021':
                    $query->whereYear('placed_at', 2021);
                    break;
                case 'older':
                    $query->whereYear('placed_at', '<', 2021);
                    break;
            }
        }

        // ─── SORTING ────────────────────────────────────────────────────────
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('placed_at', 'asc');
                break;
            case 'az':
                $query->orderBy('order_id', 'asc');
                break;
            case 'za':
                $query->orderBy('order_id', 'desc');
                break;
            default: // 'latest'
                $query->orderBy('placed_at', 'desc');
                break;
        }

        // Paginate with 10 items per page, preserving query string
        $orders = $query->paginate(10)->withQueryString();

        return view('profile.order', compact('orders'));
    }

    public function show(string $orderId)
    {
        $order = Order::with([
            'items.product',
            'items.variant',
            'items.refundRequests', // new
            'address',
            'deliveryPartnerPickup.deliveryPartner',
        ])
            ->where('user_id', Auth::id())
            ->where('order_id', $orderId)
            ->firstOrFail();

        return view('profile.order-details', compact('order'));
    }

    public function cancel(string $orderId)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('order_id', $orderId)
            ->firstOrFail();

        if (! in_array($order->order_status, ['pending', 'confirmed', 'placed'])) {
            return back()->with('error', 'This order cannot be cancelled at its current stage.');
        }

        $order->update(['order_status' => 'cancelled']);

        return redirect()
            ->route('order.show', $orderId)
            ->with('success', 'Order #'.$orderId.' has been cancelled.');
    }

    /**
     * Order success page — shown after checkout.
     * Route: GET /order/success/{order_id}  name: order.success
     */
    public function success(string $orderId)
    {
        $order = Order::with(['items.product', 'items.variant'])
            ->where('user_id', Auth::id())
            ->where('order_id', $orderId)
            ->firstOrFail();

        return view('pages.order-success', compact('order'));
    }
}
