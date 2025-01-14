<?php

namespace App\Http\Middleware\Tabantaj\Auth;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use App\Services\Tenant\TBTenantTenantManager;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public $tbTenantManager;

    public function __construct(TBTenantTenantManager $tbTenantManager)
    {
        $this->tbTenantManager = $tbTenantManager;
    }

    public function handle($request, Closure $next)
    {

        $user = \Auth::user();

        try {
            $tbSubdomain = explode('.', $request->getHost(), 2)[0];

            $tbTenant = Tenant::whereHas(
                'domains',
                fn ($tbQuery) => $tbQuery->where('domain', $tbSubdomain)
            )->firstOrFail();

            $this->tbTenantManager->tbSetTenant($tbTenant);
            tenancy()->initialize($tbTenant);
            app()->instance('tbCurrentTenant', $tbTenant);
        } catch (ModelNotFoundException) {
            abort(404, 'Tenant not found for the given subdomain.');
        } catch (\Exception $tbException) {
            abort(500, 'An unexpected error occurred.');
        }

        if ($user) {
            // Cache roles and permissions to minimize database queries
            $permissionsArray = Cache::remember('permissions_array', now()->addMinutes(60), function () {
                $roles = Role::getAll();
                $permissionsArray = [];

                foreach ($roles as $role) {
                    foreach ($role->permissions as $permission) {
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
        }

        return $next($request);
    }
}
