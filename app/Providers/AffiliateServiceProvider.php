<?php

namespace App\Providers;

use App\Services\AffiliateLinkService;
use App\Services\CommissionService;
use Illuminate\Support\ServiceProvider;

class AffiliateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CommissionService::class, function ($app) {
            return new CommissionService();
        });

        $this->app->singleton(AffiliateLinkService::class, function ($app) {
            return new AffiliateLinkService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
