<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    
    public function home()
{
    $userId = Auth::id();

    $flashsale = Product::where('is_active', 1)
        ->where('is_flash_sale', 1)
        ->withExists(['wishlist as is_wishlist' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->withExists(['cart as is_cart' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->with(['cart' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->get()
        ->each(function ($product) {
            $product->cart_quantity = $product->cart->first()->quantity ?? 0;
            unset($product->cart); // साफ करने के लिए
        });

    $bestsellers = Product::where('is_active', 1)
        ->orderBy('sales_count', 'desc')
        ->take(10)
        ->withExists(['wishlist as is_wishlist' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->withExists(['cart as is_cart' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->with(['cart' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->get()
        ->each(function ($product) {
            $product->cart_quantity = $product->cart->first()->quantity ?? 0;
            unset($product->cart);
        });

    $products = Product::where('is_active', 1)
        ->take(8)
        ->withExists(['wishlist as is_wishlist' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->withExists(['cart as is_cart' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->with(['cart' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->get()
        ->each(function ($product) {
            $product->cart_quantity = $product->cart->first()->quantity ?? 0;
            unset($product->cart);
        });

    $wishlistCount = DB::table('wishlists')->where('user_id', $userId)->count();
    $cartCount = DB::table('carts')->where('user_id', $userId)->sum('quantity');

    return view('pages.home', compact('flashsale', 'bestsellers', 'products', 'wishlistCount', 'cartCount'));
}


    public function guestHome()
    {
        $flashsale = Product::where('is_active', 1)->where('is_flash_sale',1)->get();
        $bestsellers = Product::where('is_active', 1)->orderBy('sales_count', 'desc')->take(10)->get();
        $products = Product::where('is_active', 1)->take(8)->get();
        return view('pages.guest_home', compact('flashsale', 'bestsellers', 'products'));
    }
    public function dash()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    

   

    public function cart()
    {
        $user=Auth::user();
        return view('pages.my-cart', compact('user'));
    }

    public function contactSeller()
    {
        return view('pages.contact-seller');
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        // also check that prodcut is aleard on car and wishlist or not for that user
        $userId = Auth::id();
        $product->is_wishlist = DB::table('wishlists')->where('user_id', $userId)->where('product_id', $product->id)->exists();
        $cartItem = DB::table('carts')->where('user_id', $userId)->where('product_id', $product->id)->first();
        $product->is_cart = $cartItem ? true : false;
        $product->cart_quantity = $cartItem ? $cartItem->quantity : 0;
        return view('pages.product-details', compact('product'));
    }

    public function searchProduct(Request $request)
    {
        $query = $request->input('query');
        // Logic to search for products based on the query
        return view('pages.search-product', compact('query'));
    }


}
