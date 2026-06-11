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

    $baseProductQuery = Product::where('is_active', 1)
        ->select(['id', 'name', 'slug', 'thumbnail', 'price', 'sales_count', 'is_flash_sale'])
        ->withExists(['wishlist as is_wishlist' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])
        ->withExists(['cart as is_cart' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }]);

    $flashsale = (clone $baseProductQuery)
        ->where('is_flash_sale', 1)
        ->orderBy('updated_at', 'desc')
        ->take(12)
        ->get();

    $bestsellers = (clone $baseProductQuery)
        ->orderBy('sales_count', 'desc')
        ->take(10)
        ->get();

    $products = (clone $baseProductQuery)
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();

    $wishlistCount = DB::table('wishlists')->where('user_id', $userId)->count();
    $cartCount = DB::table('carts')->where('user_id', $userId)->sum('quantity');

    return view('pages.home', compact('flashsale', 'bestsellers', 'products', 'wishlistCount', 'cartCount'));
}


    public function guestHome()
    {
        $flashsale = Product::where('is_active', 1)
            ->where('is_flash_sale', 1)
            ->select(['id', 'name', 'slug', 'thumbnail', 'price'])
            ->orderBy('updated_at', 'desc')
            ->take(12)
            ->get();

        $bestsellers = Product::where('is_active', 1)
            ->select(['id', 'name', 'slug', 'thumbnail', 'price'])
            ->orderBy('sales_count', 'desc')
            ->take(10)
            ->get();

        $products = Product::where('is_active', 1)
            ->select(['id', 'name', 'slug', 'thumbnail', 'price'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('pages.home', compact('flashsale', 'bestsellers', 'products'));
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

    public function productDetails($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
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
