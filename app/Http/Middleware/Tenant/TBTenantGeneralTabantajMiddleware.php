<?php

namespace App\Http\Middleware\Tenant;

use App\Http\Controllers\Api\tbApiPanelControlController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TBTenantGeneralTabantajMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
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
