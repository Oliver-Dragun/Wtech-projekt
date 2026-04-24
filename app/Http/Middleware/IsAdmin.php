<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Blocks access for non-admin users
class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}
