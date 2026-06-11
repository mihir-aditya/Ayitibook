<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $admin = auth('admin')->user();

        if (! $admin) {
            abort(403, 'Unauthenticated.');
        }

        // 'admin' role is always superuser — passes every role gate
        if ($admin->role === 'admin') {
            return $next($request);
        }

        if (! in_array($admin->role, $roles)) {
            abort(403, 'You do not have permission to perform this action.');
        }

        return $next($request);
    }
}