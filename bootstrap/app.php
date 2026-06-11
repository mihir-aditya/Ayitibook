<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'seller'           => \App\Http\Middleware\SellerMiddleware::class,
        'affiliate.access' => \App\Http\Middleware\AffiliateAccess::class,
        'admin.role'       => \App\Http\Middleware\AdminRoleMiddleware::class,  // ← added
    ]);
})

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();