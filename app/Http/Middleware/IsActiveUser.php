<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (User::getCurrentUser()->is_active) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        return $next($request);
    }
}
