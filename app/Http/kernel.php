<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // global middleware
    ];

    protected $middlewareGroups = [
        'web' => [
            // web middleware
        ],

        'api' => [
            // api middleware
        ],
    ];

    protected $routeMiddleware = [
        'auth'   => \App\Http\Middleware\Authenticate::class,
        'guest'  => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'seller' => \App\Http\Middleware\SellerMiddleware::class,
    ];
}
