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

        $suscripciones = $this->stripeService->getProductsByCustomer ($stripeId);

        $modulosValidos = ["Gestión de Talento", "Gestión Financiera"];

        $estado = $this->getTenantConsultaEstatus($suscripciones,$modulosValidos);
        dd($estado);    
        if ($estado) {
            return $next($request);
        } else {
            abort(403);
        }
    }

    public function getTenantConsultaEstatus($suscripciones, $modulosValidos)
    {
        try {
            if (!empty($suscripciones) && is_array($suscripciones)) {

                foreach ($suscripciones as $suscription) {
                    if (in_array($suscription->name, $modulosValidos) && $suscription->active === true) {
                        return $suscription->active ? true : false;
                    } else {
                        return false;
                    }
                }
                
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            abort(403);
        }
    }
}
