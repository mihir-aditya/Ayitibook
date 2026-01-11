<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Seller\RegisterController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\AuthController as SellerAuthController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\ProfileController as SellerProfileController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\RefundController;
/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index']);
Route::get('/', [PageController::class, 'guestHome'])->name('guest-home');

// Public product search
Route::get('/search-product', [ProductController::class, 'index'])->name('search-product');

/*
|--------------------------------------------------------------------------
| USER AUTH (BREEZE – DO NOT TOUCH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/home', [PageController::class, 'home'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-account', [AccountController::class, 'myAccount'])->name('my-account');
    Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/add-address', [AccountController::class, 'addAddress'])->name('addAddress');

    Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
    Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');
    Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/contact-seller', [PageController::class, 'contactSeller'])->name('contact-seller');
    Route::get('/product-detail/{slug}', [PageController::class, 'productDetails'])->name('product-details');
    

});

/*
|--------------------------------------------------------------------------
| SELLER REGISTRATION
|--------------------------------------------------------------------------
*/
Route::prefix('seller')->name('seller.')->group(function () {

    // Register
Route::get('/seller/register', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/seller/register', [RegisterController::class, 'store'])
    ->name('register.submit');

    // Login
    Route::get('/login', [SellerAuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [SellerAuthController::class, 'login'])
        ->name('login.submit');


    /*
    |--------------------------------------------------------------------------
    | SELLER DASHBOARD (AUTHENTICATED)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:seller')->group(function () {

        Route::post('/logout', [SellerAuthController::class, 'logout'])
            ->name('logout');
Route::get('/dashboard', [SellerDashboardController::class, 'index'])
            ->name('dashboard');
 Route::get('/profile', [SellerProfileController::class, 'edit'])
        ->name('profile');

    Route::post('/profile', [SellerProfileController::class, 'update'])
        ->name('profile.update');

        Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [SellerOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [SellerOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::post('/orders/{id}/notes', [SellerOrderController::class, 'saveNotes'])->name('orders.saveNotes');
        Route::post('/orders/{id}/cancel', [SellerOrderController::class, 'cancel'])->name('orders.cancel');

        Route::resource('products', SellerProductController::class);
Route::post(
    'products/delete/{id}',
    [SellerProductController::class, 'destroy']
)->name('products.destroy');

        Route::post('products/{id}/restore',
            [SellerProductController::class, 'restore']
        )->name('products.restore');

        Route::delete('products/{id}/force',
            [SellerProductController::class, 'forceDelete']
        )->name('products.forceDelete');

        Route::post('products/bulk-delete',
            [SellerProductController::class, 'bulkDelete']
        )->name('products.bulkDelete');
        
    Route::get('/refunds', [RefundController::class, 'index'])->name('seller.refunds');
    Route::get('/refunds/{sl_no}', [RefundController::class, 'show'])->name('seller.refunds.show');
    Route::post('/refunds/{sl_no}/status', [RefundController::class, 'updateStatus'])->name('seller.refunds.update');

        // Quick add categories, brands, and tags
        Route::post('categories/quick-add', [SellerProductController::class, 'storeCategory'])->name('categories.store');
        Route::post('brands/quick-add', [SellerProductController::class, 'storeBrand'])->name('brands.store');
        Route::post('tags/quick-add', [SellerProductController::class, 'storeTag'])->name('tags.store');
    });
});


require __DIR__.'/auth.php';
