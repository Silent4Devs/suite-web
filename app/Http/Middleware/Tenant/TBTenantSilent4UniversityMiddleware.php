<?php

namespace App\Http\Middleware\Tenant;

use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TBTenantSilent4UniversityMiddleware
{
    protected $tbTenantManager;

    protected $tbStripeService;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $tbRequest, Closure $tbNext): Response
    {

        $tbModulosValidos = ['Capacitaciones'];

        $tbEstado = $this->tbStripeService->tbTenantSubscriptionStatusOnPremise($tbModulosValidos);

        if ($tbEstado) {
            return $tbNext($tbRequest);
        } else {
            abort(403, 'Acceso denegado: Suscripción no válida.');
        }
    }
}
