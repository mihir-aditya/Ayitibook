<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function add(Request $request)
    {
        $cart = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => \DB::raw('quantity + 1')
            ]
        );

        return response()->json([
            'message' => 'Product added to cart successfully!',
        ]);
    }

    public function count()
    {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }

    public function index()
    {
       $cartItems = \App\Models\Cart::with('product')
        ->where('user_id', \Auth::id())
        ->get();

    $subtotal = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return view('pages.my-cart', compact('cartItems', 'subtotal'));
    }

    public function remove($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return response()->json(['message' => 'Product removed from cart']);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->update(['quantity' => $request->quantity]);
            return response()->json(['message' => 'Quantity updated', 'success' => true]);
        }
        return response()->json(['message' => 'Item not found'], 404);
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $total = $subtotal; // shipping free

         return view('pages.checkout', compact('cartItems', 'subtotal', 'total'));
    }
}

