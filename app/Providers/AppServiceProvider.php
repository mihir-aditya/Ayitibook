<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DeliveryPartner;
use App\Observers\DeliveryPartnerObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DeliveryPartner::observe(DeliveryPartnerObserver::class);
    }
}