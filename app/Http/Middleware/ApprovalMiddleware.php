<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class ApprovalMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (!User::getCurrentUser()->approved) {
                auth()->logout();

                return redirect()->route('login')->with('message', trans('global.yourAccountNeedsAdminApproval'));
            }
        }

        return $next($request);
    }
}
