<?php
// app/Http/Middleware/DeliveryPartnerAuth.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryPartnerAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('delivery_partner')->check()) {
            return redirect()->route('delivery-partner.login');
        }

        $partner = Auth::guard('delivery_partner')->user();
        
        if ($partner->status !== 'active') {
            Auth::guard('delivery_partner')->logout();
            return redirect()->route('delivery-partner.login')
                ->with('error', 'Your account is not active.');
        }

        return $next($request);
    }
}