<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Handles authentication for the /admin pages
class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in and has is_admin == 1
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}
