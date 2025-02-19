<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class TwoFactorMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->two_factor_code) {
            if (Carbon::createFromFormat(config('panel.date_format').' '.config('panel.time_format'), $user->two_factor_expires_at)->lt(now())) {
                $user->resetTwoFactorCode();
                auth()->logout();

                return redirect()->route('login')->with('message', __('global.two_factor.expired'));
            }

            if (! $request->is('two-factor*')) {
                return redirect()->route('twoFactor.show');
            }
        }

        return $next($request);
    }
}
