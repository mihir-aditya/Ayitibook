<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'size'       => 'nullable|string|max:50',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->variant_id) {
            $variant  = ProductVariant::findOrFail($request->variant_id);
            $maxStock = $variant->quantity;
            $price    = $variant->price;
        } else {
            $maxStock = $product->stock_quantity;
            $price    = $product->final_price ?? $product->price;
        }

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->where('size', $request->size)
            ->first();

        $newQuantity = ($existingCart ? $existingCart->quantity : 0) + $request->quantity;

        if ($newQuantity > $maxStock) {
            return response()->json([
                'message' => 'Cannot add more than available stock. Only ' . $maxStock . ' items available.'
            ], 400);
        }

        $cart = Cart::updateOrCreate(
            [
                'user_id'    => Auth::id(),
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'size'       => $request->size,
            ],
            ['quantity' => DB::raw('quantity + ' . $request->quantity)]
        );

        // Refresh to get the actual id (updateOrCreate with DB::raw may not hydrate it)
        $cart->refresh();

        return response()->json([
            'message'      => 'Product added to cart successfully!',
            'cart_count'   => $this->getCartCount(),
            'cart_item_id' => $cart->id,  // used by Buy Now to select only this item
        ]);
    }

    public function count()
    {
        return response()->json(['count' => Cart::where('user_id', Auth::id())->sum('quantity')]);
    }

    public function index()
    {
        $cartItems = Cart::with(['product', 'variant'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            $price = $item->variant_id
                ? $item->variant->price
                : ($item->product->final_price ?? $item->product->price);
            return $price * $item->quantity;
        });

        return view('pages.my-cart', compact('cartItems', 'subtotal'));
    }

    public function remove($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();

        return response()->json([
            'message'    => 'Product removed from cart',
            'cart_count' => $this->getCartCount()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->with(['product', 'variant'])
            ->first();

        if (!$cart) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $maxStock = $cart->variant_id
            ? $cart->variant->quantity
            : $cart->product->stock_quantity;

        if ($request->quantity > $maxStock) {
            return response()->json([
                'message' => 'Only ' . $maxStock . ' items available in stock.'
            ], 400);
        }

        $cart->update(['quantity' => $request->quantity]);

        $price    = $cart->variant_id
            ? $cart->variant->price
            : ($cart->product->final_price ?? $cart->product->price);

        return response()->json([
            'message'    => 'Quantity updated',
            'success'    => true,
            'subtotal'   => $price * $request->quantity,
            'cart_count' => $this->getCartCount()
        ]);
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with(['product', 'variant'])->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(function ($item) {
            $price = $item->variant_id
                ? $item->variant->price
                : ($item->product->final_price ?? $item->product->price);
            return $price * $item->quantity;
        });

        $tax      = $subtotal * 0.1;
        $shipping = $subtotal > 100 ? 0 : 10;
        $total    = $subtotal + $tax + $shipping;

        return view('pages.checkout', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return response()->json(['message' => 'Cart cleared successfully', 'cart_count' => 0]);
    }

    public function getCartItems()
    {
        try {
            $rows = Cart::where('user_id', Auth::id())
                ->with(['product', 'variant'])
                ->get();

            $cartItems = $rows->map(function ($item) {

                // Skip orphaned rows (product deleted but cart row remains)
                if (!$item->product) {
                    return null;
                }

                $product = $item->product;
                $variant = $item->variant;

                // ── Price ──────────────────────────────────────────────────
                // Use the model's own getFinalPriceAttribute accessor directly
                // (same logic as ProductController::calculateFinalPrice)
                if ($variant) {
                    $price = (float) ($variant->price ?? 0);
                } else {
                    // Replicate calculateFinalPrice logic so we don't depend on
                    // a controller method here
                    if ($product->discount_price && $product->discount_type) {
                        if ($product->discount_type === 'percent') {
                            $price = $product->price - ($product->price * $product->discount_price / 100);
                        } else {
                            $price = $product->price - $product->discount_price;
                        }
                    } else {
                        $price = (float) ($product->price ?? 0);
                    }
                }
                $price = max(0, (float) $price);

                // ── Old price (for strikethrough) ──────────────────────────
                $oldPrice = null;
                if (!$variant && $product->discount_price && $product->discount_type && $product->price > 0) {
                    $oldPrice = number_format((float) $product->price, 2);
                }

                // ── Discount % ─────────────────────────────────────────────
                $discountPct = null;
                if (!$variant && $product->discount_price && $product->discount_type && $product->price > 0) {
                    if ($product->discount_type === 'percent') {
                        $discountPct = (int) $product->discount_price;
                    } else {
                        $discountPct = (int) round(($product->discount_price / $product->price) * 100);
                    }
                }

                // ── Thumbnail ──────────────────────────────────────────────
                // Use raw DB column values to avoid triggering accessors that
                // touch images/videos (which can crash on malformed JSON)
                $rawThumbnail = $product->getRawOriginal('thumbnail');
                if ($rawThumbnail) {
                    $thumbnail = asset('storage/' . ltrim($rawThumbnail, '/'));
                } else {
                    // Fall back to first image from the raw images column
                    $rawImages = $product->getRawOriginal('images');
                    $imagesArr = [];
                    if ($rawImages) {
                        $decoded = json_decode($rawImages, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                            $imagesArr = $decoded;
                        }
                    }
                    $thumbnail = !empty($imagesArr[0])
                        ? asset('storage/' . ltrim($imagesArr[0], '/'))
                        : asset('assets/images/no-image.png');
                }

                return [
                    'id'                  => $item->id,
                    'product_id'          => $item->product_id,
                    'product_name'        => $product->name ?? 'Unknown Product',
                    'description'         => $product->getRawOriginal('description') ?? null,
                    'sku'                 => $product->sku ?? null,
                    'variant_name'        => $variant ? ($variant->variant_name ?? null) : null,
                    'size'                => $item->size,
                    'quantity'            => (int) $item->quantity,
                    'price'               => number_format($price, 2, '.', ''),
                    'old_price'           => $oldPrice,
                    'discount_percentage' => $discountPct,
                    'subtotal'            => number_format($price * (int) $item->quantity, 2, '.', ''),
                    'thumbnail'           => $thumbnail,
                    'stock'               => $variant
                                                ? (int) ($variant->quantity ?? 0)
                                                : (int) ($product->stock_quantity ?? 0),
                ];

            })->filter()->values();

            $total = $cartItems->sum(fn($i) => (float) $i['price'] * (int) $i['quantity']);

            return response()->json([
                'items' => $cartItems,
                'total' => number_format($total, 2, '.', ''),
                'count' => $cartItems->sum('quantity'),
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessage(),
                'file'    => str_replace(base_path(), '', $e->getFile()),
                'line'    => $e->getLine(),
            ], 500);
        }
    }

    private function getCartCount()
    {
        return Cart::where('user_id', Auth::id())->sum('quantity');
    }
}