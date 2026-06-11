<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminBnplController;
use App\Http\Controllers\Admin\AffiliateClickController;
use App\Http\Controllers\Admin\AffiliateController as AdminAffiliateController;
use App\Http\Controllers\Admin\AffiliateLinkController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryPartnerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RefundController as AdminRefundController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Affiliate\AffiliateController;
use App\Http\Controllers\Affiliate\ClickTrackingController;
use App\Http\Controllers\BnplController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryPartner\AuthController as DeliveryPartnerAuthController;
use App\Http\Controllers\DeliveryPartner\DashboardController as DeliveryPartnerDashboardController;
use App\Http\Controllers\MyOrdersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefundRequestController;
use App\Http\Controllers\Seller\AuthController as SellerAuthController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\ProfileController as SellerProfileController;
use App\Http\Controllers\Seller\RefundController;
use App\Http\Controllers\Seller\RegisterController;
use App\Http\Controllers\SellerController as UserSellerController;
use App\Http\Controllers\SellerSubscriptionController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'guestHome'])->name('guest-home');
Route::get('/search-product', [ProductController::class, 'index'])->name('search-product');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product-detail/{id}', [PageController::class, 'productDetails'])->name('product-details');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/store/{seller}', [UserSellerController::class, 'store'])->name('seller.store');

// Subscribe / unsubscribe (requires auth)
Route::post('/store/{seller}/subscribe', [UserSellerController::class, 'toggleSubscribe'])
    ->name('seller.subscribe')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| USER AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/home', [PageController::class, 'home'])->name('dashboard');
    Route::post('/refund-request', [RefundRequestController::class, 'store'])->name('refund.request');

    Route::get('/contact-seller', [PageController::class, 'contactSeller'])->name('contact-seller');

    Route::prefix('bnpl')->name('bnpl.')->group(function () {
        Route::post('/create-loan', [BnplController::class, 'createLoan'])->name('create-loan');
        Route::post('/make-payment', [BnplController::class, 'makePayment'])->name('make-payment');
        Route::get('/check-eligibility', [BnplController::class, 'checkEligibility'])->name('check-eligibility');
        Route::get('/credit-score', [BnplController::class, 'getCreditScore'])->name('credit-score');
        Route::get('/upcoming-payments', [BnplController::class, 'getUpcomingPayments'])->name('upcoming-payments');
        Route::get('/payment-history', [BnplController::class, 'getPaymentHistory'])->name('payment-history');
        Route::get('/loans', [BnplController::class, 'getLoans'])->name('loans');
        Route::get('/loans/{loan}', [BnplController::class, 'getLoan'])->name('loan-detail');
        Route::post('/recalculate-score', [BnplController::class, 'recalculateCreditScore'])->name('recalculate-score');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/account', [ProfileController::class, 'updateAccount'])->name('account');
        Route::patch('/address', [ProfileController::class, 'updateAddress'])->name('address');
        Route::patch('/preferences', [ProfileController::class, 'updatePreferences'])->name('preferences');
        Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');

        // ── NOTIFICATION ROUTES ──────────────────────────────────────────────
        // These MUST be above the /{page} catch-all so Laravel matches them first
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
        Route::delete('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');
        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
        Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
        // ────────────────────────────────────────────────────────────────────

        // /{page} catch-all — MUST stay last inside this prefix group
        Route::get('/{page}', [ProfileController::class, 'show'])
            ->name('page')
            ->where('page', 'bnpl|cancellation|dashboard|demo|demo2|edit|profile|profile-page|loyalty-rewards|myreviews|order-details|order|return|saved-payment|subscribed-sellers|transaction|wallet-transactions|wishlist|address');
        //                      ↑ 'notifications' removed from the regex — it now has its own route above
    });

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/my-account', [AccountController::class, 'myAccount'])->name('my-account');
        Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('update-profile');
        Route::post('/add-address', [AccountController::class, 'addAddress'])->name('add-address');
        Route::post('/address/{id}/default', [AccountController::class, 'setDefaultAddress'])->name('set-default-address');
        Route::delete('/address/{id}', [AccountController::class, 'deleteAddress'])->name('delete-address');
    });

    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/', [WishlistController::class, 'wishlist'])->name('index');
        Route::get('/count', [WishlistController::class, 'count'])->name('count');
        Route::post('/add', [WishlistController::class, 'store'])->name('add');
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::get('/count', [CartController::class, 'count'])->name('count');
        Route::get('/get-items', [CartController::class, 'getCartItems'])->name('get-items');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::delete('/clear/all', [CartController::class, 'clear'])->name('clear');
        Route::put('/{id}', [CartController::class, 'update'])->name('update');
        Route::delete('/{id}', [CartController::class, 'remove'])->name('remove');
    });

    Route::post('/product/generate-affiliate-link', [AffiliateController::class, 'generateLinkForProduct'])
        ->name('affiliate.generate-link');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::post('/checkout/save-address', [CheckoutController::class, 'saveAddress'])->name('checkout.save-address');

    Route::get('/order/success/{order_id}', [MyOrdersController::class, 'success'])->name('order.success');
    Route::get('/my-orders', [MyOrdersController::class, 'index'])->name('my-orders');
    Route::get('/orders/{orderId}', [MyOrdersController::class, 'show'])->name('order.show');
    Route::patch('/orders/{orderId}/cancel', [MyOrdersController::class, 'cancel'])->name('order.cancel');

    Route::post('/products/{product}/reviews', [ProductReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ProductReviewController::class, 'edit'])->name('reviews.edit');
    Route::patch('/reviews/{review}', [ProductReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ProductReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::prefix('sellers')->name('sellers.')->group(function () {
        Route::post('{seller}/subscribe', [SellerSubscriptionController::class, 'toggle'])->name('subscribe');
        Route::delete('{seller}/subscribe', [SellerSubscriptionController::class, 'destroy'])->name('unsubscribe');
    });

    // ── NOTIFICATION AJAX ROUTES (outside /profile prefix) ──────────────────
    // Used by the header bell dropdown
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/latest', [NotificationController::class, 'latest'])->name('notifications.latest');
    // ────────────────────────────────────────────────────────────────────────
});

/*
|--------------------------------------------------------------------------
| SELLER ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('seller')->name('seller.')->group(function () {
    Route::middleware('guest:seller')->group(function () {
        Route::get('/register', [RegisterController::class, 'show'])->name('register');
        Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');
        Route::get('/login', [SellerAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [SellerAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth:seller')->group(function () {
        Route::post('/logout', [SellerAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [SellerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [SellerProfileController::class, 'update'])->name('profile.update');

        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [SellerOrderController::class, 'index'])->name('index');
            Route::get('/{id}', [SellerOrderController::class, 'show'])->name('show');
            Route::post('/{id}/status', [SellerOrderController::class, 'updateStatus'])->name('update-status');
            Route::post('/{id}/notes', [SellerOrderController::class, 'saveNotes'])->name('save-notes');
            Route::post('/{id}/cancel', [SellerOrderController::class, 'cancel'])->name('cancel');
        });

        Route::resource('products', SellerProductController::class);
        Route::post('products/{id}/restore', [SellerProductController::class, 'restore'])->name('products.restore');
        Route::delete('products/{id}/force', [SellerProductController::class, 'forceDelete'])->name('products.force-delete');
        Route::post('products/bulk-delete', [SellerProductController::class, 'bulkDelete'])->name('products.bulk-delete');
        Route::post('categories/quick-add', [SellerProductController::class, 'storeCategory'])->name('categories.store');
        Route::post('brands/quick-add', [SellerProductController::class, 'storeBrand'])->name('brands.store');
        Route::post('tags/quick-add', [SellerProductController::class, 'storeTag'])->name('tags.store');

        Route::prefix('refunds')->name('refunds.')->group(function () {
            Route::get('/', [RefundController::class, 'index'])->name('index');
            Route::get('/{id}', [RefundController::class, 'show'])->name('show');
            Route::post('/{id}/status', [RefundController::class, 'updateStatus'])->name('update-status');
            Route::post('/bulk-update', [RefundController::class, 'bulkUpdate'])->name('bulk-update');
        });
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|
| Role matrix:
|   admin   → full access to everything (superuser, bypasses all role checks)
|   manager → operational: orders, refunds, products, sellers, users (no delete),
|             delivery partners, BNPL, affiliates — no admin management
|   support → limited: view dashboard/orders/refunds + update their status only
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    /* ── Guest (login page) ── */
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
    });

    /* ── All authenticated admins ── */
    Route::middleware('auth:admin')->group(function () {

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        /* ══════════════════════════════════════════════════════════════
           SHARED — every role (admin + manager + support)
           Dashboard, profile, activity feed
        ══════════════════════════════════════════════════════════════ */
        Route::middleware('admin.role:admin,manager,support')->group(function () {

            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('dashboard-simple', [DashboardController::class, 'simpleDashboard'])->name('dashboard.simple');
            Route::get('activity', [DashboardController::class, 'activity'])->name('activity');
            Route::get('analytics', [DashboardController::class, 'analytics'])->name('analytics');

            Route::prefix('profile')->name('profile.')->group(function () {
                Route::get('/', [DashboardController::class, 'profile'])->name('index');
                Route::post('update', [DashboardController::class, 'updateProfile'])->name('update');
                Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
            });
            // backward-compat alias
            Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
        });

        /* ══════════════════════════════════════════════════════════════
           SUPPORT + above — orders & refunds (view + status update only)
        ══════════════════════════════════════════════════════════════ */
        Route::middleware('admin.role:admin,manager,support')->group(function () {

            /* Orders — support can view and update status, not delete/export */
            Route::prefix('orders')->name('orders.')->group(function () {
                Route::get('/', [OrderController::class, 'index'])->name('index');
                Route::get('/statistics', [OrderController::class, 'getStatistics'])->name('statistics');
                Route::get('/{order}', [OrderController::class, 'show'])->name('show');
                Route::put('/{order}/update-status', [OrderController::class, 'updateStatus'])->name('update-status');
            });

            /* Refunds — support can view and update status */
            Route::prefix('refunds')->name('refunds.')->group(function () {
                Route::get('/', [AdminRefundController::class, 'index'])->name('index');
                Route::get('/{refund}', [AdminRefundController::class, 'show'])->name('show');
                Route::patch('/{refund}/status', [AdminRefundController::class, 'updateStatus'])->name('update-status');
            });
        });

        /* ══════════════════════════════════════════════════════════════
           MANAGER + above — full operational access
           (orders extras, refunds extras, products, sellers,
            users, delivery partners, BNPL, affiliates)
        ══════════════════════════════════════════════════════════════ */
        Route::middleware('admin.role:admin,manager')->group(function () {

            /* Orders — bulk, export, destroy (manager+) */
            Route::prefix('orders')->name('orders.')->group(function () {
                Route::get('/export', [OrderController::class, 'export'])->name('export');
                Route::put('/bulk-action', [OrderController::class, 'bulkAction'])->name('bulk-action');
                Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
            });

            /* Refunds — bulk, export (manager+) */
            Route::prefix('refunds')->name('refunds.')->group(function () {
                Route::get('/export', [AdminRefundController::class, 'export'])->name('export');
                Route::post('/bulk', [AdminRefundController::class, 'bulkAction'])->name('bulk');
            });

            /* Products */
            Route::resource('products', AdminProductController::class);
            Route::prefix('products')->name('products.')->group(function () {
                Route::put('bulk-action', [AdminProductController::class, 'bulkAction'])->name('bulk-action');
                Route::get('export', [AdminProductController::class, 'export'])->name('export');
                Route::get('statistics', [AdminProductController::class, 'getStatistics'])->name('statistics');
                Route::put('{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('toggle-status');
                Route::put('{product}/toggle-flash-sale', [AdminProductController::class, 'toggleFlashSale'])->name('toggle-flash-sale');
                Route::put('{product}/update-stock', [AdminProductController::class, 'updateStock'])->name('update-stock');
            });

            /* Sellers */
            Route::resource('sellers', SellerController::class);
            Route::prefix('sellers')->name('sellers.')->group(function () {
                Route::post('bulk-action', [SellerController::class, 'bulkAction'])->name('bulk-action');
                Route::get('export', [SellerController::class, 'export'])->name('export');
                Route::get('statistics', [SellerController::class, 'getStatistics'])->name('statistics');
                Route::put('{seller}/password', [SellerController::class, 'updatePassword'])->name('update-password');
                Route::get('{seller}/toggle-verification', [SellerController::class, 'toggleVerification'])->name('toggle-verification');
                Route::get('{seller}/update-status/{status}', [SellerController::class, 'updateStatus'])->name('update-status');
            });

            /* Users — manager can view/edit but NOT delete */
            Route::resource('users', UserController::class)->except(['destroy']);
            Route::prefix('users')->name('users.')->group(function () {
                Route::post('bulk-action', [UserController::class, 'bulkAction'])->name('bulk-action');
                Route::get('export', [UserController::class, 'export'])->name('export');
                Route::get('statistics', [UserController::class, 'getStatistics'])->name('statistics');
                Route::put('{user}/password', [UserController::class, 'updatePassword'])->name('update-password');
            });

            /* Delivery Partners */
            Route::resource('delivery-partners', DeliveryPartnerController::class)
                ->parameters(['delivery-partners' => 'deliveryPartner']);
            Route::prefix('delivery-partners')->name('delivery-partners.')->group(function () {
                Route::post('bulk-action', [DeliveryPartnerController::class, 'bulkAction'])->name('bulk-action');
                Route::post('{deliveryPartner}/verify', [DeliveryPartnerController::class, 'verify'])->name('verify');
                Route::post('{deliveryPartner}/reject', [DeliveryPartnerController::class, 'reject'])->name('reject');
                Route::get('payouts', [DeliveryPartnerController::class, 'payouts'])->name('payouts');
                Route::post('payouts/{payout}/update-status', [DeliveryPartnerController::class, 'updatePayoutStatus'])->name('payouts.update-status');
                Route::get('statistics', [DeliveryPartnerController::class, 'getStatistics'])->name('statistics');
            });

            /* BNPL */
            Route::prefix('bnpl')->name('bnpl.')->group(function () {
                Route::get('/', [AdminBnplController::class, 'index'])->name('index');
                Route::get('/users/{user}', [AdminBnplController::class, 'show'])->name('users.show');
                Route::patch('/users/{user}/enable', [AdminBnplController::class, 'enable'])->name('users.enable');
                Route::patch('/users/{user}/disable', [AdminBnplController::class, 'disable'])->name('users.disable');
                Route::patch('/users/{user}/update-limit', [AdminBnplController::class, 'updateLimit'])->name('users.update-limit');
                Route::post('/users/{user}/recalculate', [AdminBnplController::class, 'recalculate'])->name('users.recalculate');
            });

            /* Affiliates */
            Route::prefix('affiliate')->name('affiliate.')->group(function () {
                Route::resource('/', AdminAffiliateController::class)->parameters(['' => 'affiliate']);
                Route::post('bulk-status-update', [AdminAffiliateController::class, 'bulkStatusUpdate'])->name('bulk.status-update');
                Route::get('tracked-products', [AdminAffiliateController::class, 'trackedProducts'])->name('tracked-products');

                Route::prefix('links')->name('links.')->group(function () {
                    Route::get('/', [AffiliateLinkController::class, 'index'])->name('index');
                    Route::get('/create', [AffiliateLinkController::class, 'create'])->name('create');
                    Route::post('/', [AffiliateLinkController::class, 'store'])->name('store');
                    Route::get('/{affiliateLink}', [AffiliateLinkController::class, 'show'])->name('show');
                    Route::get('/{affiliateLink}/edit', [AffiliateLinkController::class, 'edit'])->name('edit');
                    Route::put('/{affiliateLink}', [AffiliateLinkController::class, 'update'])->name('update');
                    Route::delete('/{affiliateLink}', [AffiliateLinkController::class, 'destroy'])->name('destroy');
                });

                Route::prefix('clicks')->name('clicks.')->group(function () {
                    Route::get('/', [AffiliateClickController::class, 'index'])->name('index');
                    Route::get('/{affiliateClick}', [AffiliateClickController::class, 'show'])->name('show');
                });

                Route::prefix('commissions')->name('commissions.')->group(function () {
                    Route::get('/', [CommissionController::class, 'index'])->name('index');
                    Route::get('/{commission}', [CommissionController::class, 'show'])->name('show');
                    Route::post('/{commission}/approve', [CommissionController::class, 'approveCommission'])->name('approve');
                    Route::post('/{commission}/reject', [CommissionController::class, 'rejectCommission'])->name('reject');
                    Route::post('/{commission}/pay', [CommissionController::class, 'payCommission'])->name('pay');
                    Route::put('/{commission}/status', [CommissionController::class, 'updateStatus'])->name('update-status');
                    Route::post('/bulk-approve', [CommissionController::class, 'bulkApproveCommissions'])->name('bulk-approve');
                });
            });
        });

        /* ══════════════════════════════════════════════════════════════
           ADMIN ONLY — user deletion, admin management
        ══════════════════════════════════════════════════════════════ */
        Route::middleware('admin.role:admin')->group(function () {

            /* User hard-delete (admin only) */
            Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

            /* Admin management — create/edit/delete other admins */
            Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class)
                ->except(['show']);
            Route::prefix('admins')->name('admins.')->group(function () {
                Route::patch('{admin}/reset-password', [\App\Http\Controllers\Admin\AdminController::class, 'resetPassword'])->name('reset-password');
                Route::patch('{admin}/toggle-status', [\App\Http\Controllers\Admin\AdminController::class, 'toggleStatus'])->name('toggle-status');
            });
        });
    });
});

/*
|--------------------------------------------------------------------------
| AFFILIATE PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/r/{code}', [ClickTrackingController::class, 'trackClick'])->name('affiliate.track');

Route::middleware(['affiliate.access'])->prefix('affiliate')->name('affiliate.')->group(function () {
    Route::get('/{affiliate}', [AffiliateController::class, 'show'])->name('show');
    Route::get('/{affiliate}/dashboard', [AffiliateController::class, 'dashboard'])->name('dashboard');
    Route::get('/{affiliate}/links', [AffiliateController::class, 'getLinks'])->name('links');
    Route::get('/{affiliate}/links/create', [AffiliateController::class, 'createLink'])->name('links.create');
    Route::post('/{affiliate}/links', [AffiliateController::class, 'storeLink'])->name('links.store');
    Route::get('/{affiliate}/clicks', [AffiliateController::class, 'getClicks'])->name('clicks');
    Route::get('/{affiliate}/commissions', [AffiliateController::class, 'getCommissions'])->name('commissions');
    Route::delete('/{affiliate}/links/{link}', [AffiliateController::class, 'destroyLink'])->name('affiliate.links.destroy');
});

/*
|--------------------------------------------------------------------------
| DELIVERY PARTNER ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('delivery-partner')->name('delivery-partner.')->group(function () {
    Route::middleware('guest:delivery_partner')->group(function () {
        Route::get('/login', [DeliveryPartnerAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [DeliveryPartnerAuthController::class, 'login'])->name('login.submit');
        Route::get('/register', [DeliveryPartnerAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [DeliveryPartnerAuthController::class, 'register'])->name('register.submit');
    });

    Route::middleware('auth:delivery_partner')->group(function () {
        Route::post('/logout', [DeliveryPartnerAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DeliveryPartnerDashboardController::class, 'index'])->name('dashboard');
        Route::post('/update-location', [DeliveryPartnerDashboardController::class, 'updateLocation'])->name('update-location');
        Route::post('/toggle-online', [DeliveryPartnerDashboardController::class, 'toggleOnline'])->name('toggle-online');
        Route::get('/available-pickups', [DeliveryPartnerDashboardController::class, 'availablePickups'])->name('available-pickups');
        Route::post('/accept-pickup/{order}', [DeliveryPartnerDashboardController::class, 'acceptPickup'])->name('accept-pickup');
        Route::get('/my-pickups', [DeliveryPartnerDashboardController::class, 'myPickups'])->name('my-pickups');

        Route::prefix('pickups')->name('pickups.')->group(function () {
            Route::get('/{pickup}', [DeliveryPartnerDashboardController::class, 'showPickup'])->name('show');
            Route::post('/{pickup}/update-status', [DeliveryPartnerDashboardController::class, 'updatePickupStatus'])->name('update-status');
        });

        Route::get('/earnings', [DeliveryPartnerDashboardController::class, 'earnings'])->name('earnings');
        Route::post('/request-payout', [DeliveryPartnerDashboardController::class, 'requestPayout'])->name('request-payout');
        Route::get('/profile', [DeliveryPartnerDashboardController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [DeliveryPartnerDashboardController::class, 'updateProfile'])->name('profile.update');
    });
});

Route::post('/delivery-partners/{deliveryPartner}/remove-avatar',
    [App\Http\Controllers\Admin\DeliveryPartnerController::class, 'removeAvatar'])
    ->name('delivery-partners.remove-avatar');

require __DIR__.'/auth.php';
