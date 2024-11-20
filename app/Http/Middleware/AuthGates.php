<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use App\Models\Tenant;
use App\Services\TenantManager;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    protected $tenantManager;

    public function __construct(TenantManager $tenantManager)
    {
        $this->tenantManager = $tenantManager;
    }

    public function handle($request, Closure $next)
    {
        $domain = $request->getHost();
        $parts = explode('.', $domain);
        if (count($parts) > 1) {
            $subdomain = $parts[0];
        } else {
            $subdomain = $domain;
        }

        $tenant = Tenant::whereHas('domains', function ($query) use ($subdomain) {
            $query->where('domain', $subdomain);
        })->firstOrfail();

        $this->tenantManager->setTenant($tenant);
        tenancy()->initialize($tenant);

        // dd($tenant, $user = Auth::guard('tenant'), DB::connection()->getDatabaseName());
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