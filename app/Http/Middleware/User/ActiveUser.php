<?php

namespace App\Http\Middleware\User;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //dd(User::getCurrentUser(), DB::connection()->getDatabaseName());
        if (! User::getCurrentUser()->is_active) {
            return redirect()->route('users.usuario-bloqueado');
        }

        return $next($request);
    }
}
