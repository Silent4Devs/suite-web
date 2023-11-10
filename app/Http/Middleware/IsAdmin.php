<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! User::getCurrentUser()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}
