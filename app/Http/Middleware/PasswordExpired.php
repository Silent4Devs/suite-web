<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PasswordExpired
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->passwordExpired()) {
            return redirect()->route('password.expired');
        }

        return $next($request);
    }
}
