<?php

namespace App\Http\Middleware\Tenant;

use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TBTenantTimesheetMiddleware
{
    protected $tbTenantManager;

    protected $tbStripeService;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
    }

    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $tbNext
     */
    public function handle(Request $tbRequest, Closure $tbNext): Response
    {
        $tbStripeId = $this->tbTenantManager->tbGetTenantFromRequest($tbRequest);

        $tbSuscripciones = $this->tbStripeService->tbGetProductsByCustomer($tbStripeId);

        $tbModulosValidos = ['Gestión de talento', 'Gestión Financiera'];

        $tbEstado = $this->tbStripeService->tbTenantSubscriptionStatus($tbSuscripciones, $tbModulosValidos);

        if ($tbEstado) {
            return $tbNext($tbRequest);
        } else {
            abort(403, 'Acceso denegado: Suscripción no válida.');
        }
    }
}
