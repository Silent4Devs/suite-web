<?php

namespace App\Http\Middleware\Tabantaj;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->user()->isOwner()) {
            abort(403);
        }

        return $next($request);
    }
}
