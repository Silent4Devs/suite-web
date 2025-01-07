<?php

namespace App\Http\Middleware\Tenant;

use Closure;
use Illuminate\Http\Request;

class TBTenantCheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $token = $user ? $user->currentAccessToken() : null;

        if (! $token || $token->expires_at < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Token expirado o inválido',
            ], 401);
        }

        return $next($request);
    }
}
