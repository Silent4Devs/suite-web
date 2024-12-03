<?php

namespace App\Http\Middleware\Tenant;

use App\Http\Controllers\Api\tbApiPanelControlController;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TBTenantGeneralTabantajMiddleware
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
        $tbStripeId = $this->tbTenantManager->tbGetTenantFromRequest($tbRequest);

        $tbSuscripciones = $this->tbStripeService->tbGetProductsByCustomer($tbStripeId);

        $tbModulosValidos = [];

        $tbEstado = $this->tbStripeService->tbTenantSubscriptionStatus($tbSuscripciones, $tbModulosValidos);

        if ($tbEstado) {
            return $tbNext($tbRequest);
        } else {
            abort(403, 'Acceso denegado: Suscripción no válida.');
        }
    }

    public function consultaApi()
    {
        try {
            $apiController = new tbApiPanelControlController();
            $response = $apiController->getData();

            $client = $response->original[0];

            if ($client['key'] == env('CLIENT_KEY') && $client['Estatus'] == true) {
                // Filtrar el módulo que cumpla con las condiciones deseadas
                return true;
            } else {
                // Procesa la respuesta según sea necesario
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
            abort(403);
        }
    }
}
