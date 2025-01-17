<?php

namespace App\Http\Middleware;

use App\Models\Role;
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
        // dd(Auth::user());
        $user = Auth::user();

        // dd($user->roles->contains('title', 'Admin'), $user->can('mi_perfil_acceder'));
        if ($user) {
            $permissionsArray = Cache::remember('permissions_array', now()->addMinutes(60), function () {
                $roles = Role::getAll();
                // dump($roles);
                $permissionsArray = [];
                foreach ($roles as $role) {
                    // dump($role->permissions);
                    foreach ($role->permissions as $permission) {
                        // dump($permission);
                        $permissionsArray[$permission->title][] = $role->id;
                    }
                }
                return $permissionsArray;
            });



            // Define gates for each permission
            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function ($user) use ($roles) {
                    // Check if user has any of the roles associated with this permission
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            }

            return $next($request);
        }
    }
}
