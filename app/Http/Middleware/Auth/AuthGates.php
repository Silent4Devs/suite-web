<?php

namespace App\Http\Middleware\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Tenant;
use App\Services\Tenant\TBTenantTenantManager;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    protected $tenantManager;

    public function __construct(TBTenantTenantManager $tenantManager)
    {
        $this->tenantManager = $tenantManager;
    }

    public function handle($request, Closure $next)
    {
        
        try {
            $subdomain = explode('.', $request->getHost(), 2)[0];

            $tenant = Tenant::whereHas(
                'domains',
                fn($query) =>
                $query->where('domain', $subdomain)
            )->firstOrFail();

            $this->tenantManager->setTenant($tenant);
            tenancy()->initialize($tenant);
        } catch (ModelNotFoundException) {
            abort(404, 'Tenant not found for the given subdomain.');
        } catch (\Exception $e) {
            abort(500, 'An unexpected error occurred.');
        }

        $user = \Auth::user();

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
