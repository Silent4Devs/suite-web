<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use App\Services\TbStripeService;
use App\Services\TenantManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TenantMiddleware
{
    protected $tenantManager;

    protected $stripeService;

    public function __construct(TenantManager $tenantManager, TbStripeService $stripeService)
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

            $cuts = $tenant->stripe_id;

            $cliente = $this->stripeService->getCustomerById($cuts);

            $suscripciones = $this->stripeService->getCustomerSubscriptions($cuts);
        } catch (ModelNotFoundException) {
            abort(404, 'Tenant not found for the given subdomain.');
        } catch (\Exception $e) {
            abort(500, 'An unexpected error occurred.');
        }
        return $next($request);
    }
}
