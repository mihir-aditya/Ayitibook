<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// Auth
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
     public function wishlist()
    {
        $user=Auth::user();
        $wishlists=Wishlist::where('user_id', $user->id)->with('product')->get();
        return view('pages.wishlist', compact('user', 'wishlists'));
    }
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $wishlist = DB::table('wishlists')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

    if ($wishlist) {
        // Product already in wishlist then remove from it and return message
        DB::table('wishlists')->where('id', $wishlist->id)->delete();
        return response()->json(['message' => 'Product removed from wishlist!']);
    }

    DB::table('wishlists')->insert([
        'user_id' => Auth::id(),
        'product_id' => $request->product_id,
    ]);

    return response()->json(['message' => 'Added to wishlist successfully!']);
}

public function count()
{
    $count = DB::table('wishlists')->where('user_id', Auth::id())->count();
    return response()->json(['count' => $count]);
}


}
