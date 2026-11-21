<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /** Pemakaian: RoleMiddleware::class.':buyer' atau ':seller' */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($request->user()?->role !== $role) {
            return redirect($request->user()?->isSeller() ? '/seller' : '/home');
        }
        return $next($request);
    }
}
