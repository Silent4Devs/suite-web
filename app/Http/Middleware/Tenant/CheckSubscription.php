<?php

namespace App\Http\Middleware\Tenant;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! tenant()->can_use_app && request()->route()->getName() !== 'tenant.settings.application') {
            return redirect(route('tenant.settings.application'));
        }

        return $next($request);
    }
}
