<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Tenant;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TBTenantMiddleware
{
    protected $tbTenantManager;

    protected $tbStripeService;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
    }

    public function handle($tbRequest, Closure $tbNext)
    {
        try {
            $tbSubdomain = explode('.', $tbRequest->getHost(), 2)[0];

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

        return $tbNext($tbRequest);
    }
}
