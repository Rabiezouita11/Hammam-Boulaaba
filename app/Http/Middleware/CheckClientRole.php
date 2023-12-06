<?php

namespace App\Http\Middleware;

use Closure;

class CheckClientRole
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'client') {
            return $next($request);
        }

        if (auth()->guest()) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
