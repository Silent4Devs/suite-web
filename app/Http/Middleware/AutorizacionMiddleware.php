<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AutorizacionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('users.login');
        }

        if (!User::getCurrentUser()->is_active) {
            return redirect()->route('users.usuario-bloqueado');
        }

        $permissionsArray = Cache::remember('permissions_array', now()->addMinutes(60), function () {
            return Role::with('permissions')->get()->flatMap(function ($role) {
                return $role->permissions->mapWithKeys(function ($permission) use ($role) {
                    return [$permission->title => [$role->id]];
                });
            })->reduce(function ($carry, $item) {
                foreach ($item as $key => $value) {
                    $carry[$key] = array_merge($carry[$key] ?? [], $value);
                }
                return $carry;
            }, []);
        });

        // Define gates for each permission
        foreach ($permissionsArray as $title => $roles) {
            Gate::define($title, function ($user) use ($roles) {
                return $user->roles->pluck('id')->intersect($roles)->isNotEmpty();
            });
        }

        return $next($request);
    }
}
