<?php

namespace App\Http\Middleware\Tenant;

use Closure;
use App\Models\Tenant;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TBTenantMiddleware
{
    protected $tenantManager;

    protected $stripeService;

    public function __construct(TBTenantTenantManager $tenantManager, TBTenantStripeService $stripeService)
    {
        $this->tenantManager = $tenantManager;
        $this->stripeService = $stripeService;
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
            app()->instance('currentTenant', $tenant);
        } catch (ModelNotFoundException) {
            abort(404, 'Tenant not found for the given subdomain.');
        } catch (\Exception $e) {
            abort(500, 'An unexpected error occurred.');
        }
        return $next($request);
    }
}
