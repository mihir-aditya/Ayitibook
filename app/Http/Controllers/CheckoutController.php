<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;

class CheckoutController extends Controller
{
    /**
     * Show checkout page — passes saved addresses to the view.
     */
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())
            ->orderByDesc('is_default')
            ->orderByDesc('sl_no')
            ->get();

        return view('pages.checkout', compact('addresses'));
    }

    /**
     * Place the order — validates, saves orders + order_items, clears cart.
     */
    public function placeOrder(Request $request)
{
    $request->validate([
        'billing_name'    => 'required|string|max:255',
        'billing_phone'   => 'required|string|max:20',
        'billing_address' => 'required|string|max:500',
        'billing_city'    => 'nullable|string|max:100',
        'billing_state'   => 'nullable|string|max:100',
        'billing_country' => 'nullable|string|max:100',
        'billing_zip'     => 'nullable|string|max:20',
        'billing_email'   => 'nullable|email|max:255',

        'shipping_name'    => 'nullable|string|max:255',
        'shipping_phone'   => 'nullable|string|max:20',
        'shipping_address' => 'nullable|string|max:500',
        'shipping_city'    => 'nullable|string|max:100',
        'shipping_state'   => 'nullable|string|max:100',
        'shipping_country' => 'nullable|string|max:100',
        'shipping_zip'     => 'nullable|string|max:20',

        'payment_method'  => 'required|in:COD,Wallet,BNPL',
        'address_id'      => 'nullable|exists:user_address,sl_no',
        'items_json'      => 'required|string',
        'subtotal'        => 'required|numeric|min:0',
        'tax'             => 'required|numeric|min:0',
        'shipping_fee'    => 'required|numeric|min:0',
        'total'           => 'required|numeric|min:0',
        'coupon_code'     => 'nullable|string|max:50',
        'coupon_discount' => 'nullable|numeric|min:0',
        'ayiticash_discount' => 'nullable|numeric|min:0',
        'total_discount'  => 'nullable|numeric|min:0',
        'free_shipping'   => 'nullable|in:0,1',
    ]);

    $userId = Auth::id();

    // Decode items from the hidden field
    $items = json_decode($request->items_json, true);
    if (empty($items)) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    $selectedCartIds = collect($items)->pluck('cart_id')->filter()->values()->toArray();

    // Load selected cart rows from DB
    $cartItems = Cart::with(['product', 'variant'])
        ->where('user_id', $userId)
        ->whereIn('id', $selectedCartIds)
        ->get()
        ->keyBy('id');

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'No valid items found.');
    }

    // Server‑side raw subtotal (pre‑discount) from DB prices
    $serverSubtotal = $cartItems->sum(function ($item) {
        $price = $item->variant_id
            ? ($item->variant->price ?? 0)
            : ($item->product->final_price ?? $item->product->price ?? 0);
        return $price * $item->quantity;
    });

    // Discounts from client
    $couponDiscount    = min((float) $request->coupon_discount    ?? 0, $serverSubtotal);
    $ayiticashDiscount = min((float) $request->ayiticash_discount ?? 0, $serverSubtotal);
    $totalDiscount     = $couponDiscount + $ayiticashDiscount;
    $discountedSubtotal = max(0, round($serverSubtotal - $totalDiscount, 2));

    $tax         = round($discountedSubtotal * 0.05, 2);
    $freeShipping = $request->free_shipping === '1';
    $shippingFee  = $freeShipping ? 0.00 : ($discountedSubtotal > 0 ? 15.00 : 0.00);

    // Group cart items by seller_id
    $sellerGroups = [];
    foreach ($cartItems as $item) {
        $sellerId = $item->product->seller_id;
        if (!$sellerId) {
            Log::warning('Product without seller in cart', ['product_id' => $item->product_id]);
            continue;
        }
        $sellerGroups[$sellerId][] = $item;
    }

    if (empty($sellerGroups)) {
        return redirect()->back()->with('error', 'No valid items with sellers found.');
    }

    try {
        DB::beginTransaction();

        $createdOrders = [];

        foreach ($sellerGroups as $sellerId => $items) {
            // Calculate this group's subtotal
            $groupSubtotal = 0;
            foreach ($items as $item) {
                $price = $item->variant_id
                    ? ($item->variant->price ?? 0)
                    : ($item->product->final_price ?? $item->product->price ?? 0);
                $groupSubtotal += $price * $item->quantity;
            }

            // Distribute discount proportionally
            $groupDiscount = round(($groupSubtotal / $serverSubtotal) * $totalDiscount, 2);
            // Distribute tax proportionally
            $groupTax = round(($groupSubtotal / $serverSubtotal) * $tax, 2);
            // Distribute shipping fee proportionally
            $groupShipping = round(($groupSubtotal / $serverSubtotal) * $shippingFee, 2);

            $groupTotal = $groupSubtotal - $groupDiscount + $groupTax + $groupShipping;
            $groupTotal = round($groupTotal, 2);

            // Generate unique order ID
            do {
                $orderId = random_int(100000, 999999);
            } while (Order::where('order_id', $orderId)->exists());

            // Create order for this seller
            $order = Order::create([
                'order_id'         => $orderId,
                'user_id'          => $userId,
                'address_id'       => $request->address_id ?: null,
                'seller_id'        => $sellerId,
                'payment_method'   => $request->payment_method,
                'total_amount'     => $groupTotal,
                'discount_amount'  => $groupDiscount,
                'coupon_code'      => $request->coupon_code ?: null,
                'billing_name'     => $request->billing_name,
                'billing_phone'    => $request->billing_phone,
                'billing_email'    => $request->billing_email,
                'billing_address'  => $request->billing_address,
                'billing_city'     => $request->billing_city,
                'billing_state'    => $request->billing_state,
                'billing_country'  => $request->billing_country,
                'billing_zip'      => $request->billing_zip,
                'shipping_name'    => $request->shipping_name    ?: $request->billing_name,
                'shipping_phone'   => $request->shipping_phone   ?: $request->billing_phone,
                'shipping_address' => $request->shipping_address ?: $request->billing_address,
                'shipping_city'    => $request->shipping_city    ?: $request->billing_city,
                'shipping_state'   => $request->shipping_state   ?: $request->billing_state,
                'shipping_country' => $request->shipping_country ?: $request->billing_country,
                'shipping_zip'     => $request->shipping_zip     ?: $request->billing_zip,
                'tax'              => $groupTax,
                'shipping_fee'     => $groupShipping,
                'order_status'     => 'placed',
                'placed_at'        => now(),
            ]);

            // Create order items for this seller
            foreach ($items as $item) {
                $price = $item->variant_id
                    ? ($item->variant->price ?? 0)
                    : ($item->product->final_price ?? $item->product->price ?? 0);

                OrderItem::create([
                    'order_item_id' => random_int(100000, 999999),
                    'order_id'      => $orderId,
                    'product_id'    => $item->product_id,
                    'variant_id'    => $item->variant_id ?? null,
                    'quantity'      => $item->quantity,
                    'price'         => $price,
                ]);

                // Update stock and sold count
                $item->product->increment('sold_count', $item->quantity);
                $item->product->decrement('stock_quantity', $item->quantity);
                if ($item->variant_id) {
                    $item->variant->decrement('quantity', $item->quantity);
                }
            }

            $createdOrders[] = $order;
        }

        // Clear only the checked‑out cart items
        Cart::where('user_id', $userId)
            ->whereIn('id', $selectedCartIds)
            ->delete();

        DB::commit();

    } catch (\Throwable $e) {
        DB::rollBack();
        Log::error('Order placement failed', [
            'user_id' => $userId,
            'error'   => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
        ]);
        return redirect()->back()
            ->withInput()
            ->with('error', 'Something went wrong while placing your order. Please try again.');
    }

    // Redirect to the first order's success page (or a multi‑order success view)
    $firstOrder = $createdOrders[0] ?? null;
    if (!$firstOrder) {
        return redirect()->route('cart.index')->with('error', 'No orders were created.');
    }

    // Optionally store all created order IDs in session to display on success page
    session(['created_orders' => collect($createdOrders)->pluck('order_id')->toArray()]);

    return redirect()->route('order.success', ['order_id' => $firstOrder->order_id])
        ->with('success', 'Order placed successfully!')
        ->with('payment_method', $request->payment_method)
        ->with('order_id', $firstOrder->order_id);
}
    /**
     * Save address via AJAX (called from checkout page add-address form).
     * Reuses the AccountController logic but returns JSON.
     */
    public function saveAddress(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'nullable|string|max:100',
            'phone'           => 'required|string|max:20',
            'alternate_phone' => 'nullable|string|max:20',
            'address'         => 'required|string|max:500',
            'city'            => 'nullable|string|max:100',
            'state'           => 'nullable|string|max:100',
            'country'         => 'nullable|string|max:100',
            'postal_code'     => 'nullable|string|max:20',
            'address_type'    => 'nullable|string|max:50',
            'is_default'      => 'nullable|boolean',
        ]);

        $userId = Auth::id();

        // If new address is default, unset all others
        if ($request->boolean('is_default')) {
            Address::where('user_id', $userId)->update(['is_default' => false]);
        }

        $address = Address::create([
            'address_id'             => random_int(100000, 999999),
            'user_id'                => $userId,
            'first_name'             => $request->first_name,
            'last_name'              => $request->last_name ?? '',
            'phone'                  => $request->phone,
            'alternate_phone_number' => $request->alternate_phone,
            'address'                => $request->address,
            'city'                   => $request->city,
            'state'                  => $request->state,
            'country'                => $request->country,
            'pincode'                => $request->postal_code,
            'address_type'           => $request->address_type ?? 'home',
            'is_default'             => $request->boolean('is_default'),
        ]);

        return response()->json([
            'success' => true,
            'address' => $address,
        ]);
    }
}