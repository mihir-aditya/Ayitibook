<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Cart;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('components.header', function ($view) {
            $wishlistCount = 0;
            $cartCount = 0;

            if (Auth::check()) {
                $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
                $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            }

            $view->with(compact('wishlistCount', 'cartCount'));
        });
    }
}
