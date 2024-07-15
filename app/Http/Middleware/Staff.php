<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Staff
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->usertype === 'staff') {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
