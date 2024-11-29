<?php

namespace App\Http\Middleware\Tenant;

use App\Http\Controllers\Api\tbApiPanelControlController;
use App\Models\Tenant;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TBTenantTimesheetMiddleware
{
    protected $tenantManager;

    protected $stripeService;

    public function __construct(TBTenantTenantManager $tenantManager, TBTenantStripeService $stripeService)
    {
        $this->tenantManager = $tenantManager;
        $this->stripeService = $stripeService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $stripeId = $this->tenantManager->getTenantFromRequest($request);

        $suscripciones = $this->stripeService->getProductsByCustomer($stripeId);

        dd($suscripciones);
        $estado = $this->consultaApi();
        if ($estado) {
            return $next($request);
        } else {
            abort(403);
        }
    }

    public function consultaApi()
    {
        try {
            $apiController = new tbApiPanelControlController();
            $response = $apiController->getData();

            $client = $response->original[0];

            if ($client['key'] == env('CLIENT_KEY') && $client['Estatus'] == true) {
                // Definir los nombres de los módulos que son válidos
                $modulosValidos = ["Gestión de Talento", "Gestión Financiera"]; // Agrega todos los nombres de módulos válidos aquí

                // Filtrar los módulos que cumplan con las condiciones deseadas
                $modulo = array_filter($client["modulos"], function ($modulo) use ($modulosValidos) {
                    return in_array($modulo["nombre_catalogo"], $modulosValidos) && $modulo["estatus"] == true;
                });

                // Verificar si existe algún módulo que cumpla con la condición
                $estatus = !empty($modulo);
                return $estatus ? true : false;
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
