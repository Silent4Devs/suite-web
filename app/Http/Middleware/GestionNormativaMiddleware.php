<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\tbApiPanelControlController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GestionNormativaMiddleware
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
        }
    }

    public function consultaApi()
    {
        $apiController = new tbApiPanelControlController();
        $response = $apiController->getData();

        $client = $response->original[0];

        if ($client['uuid'] == env('CLIENT_UUID')) {
            // Filtrar el módulo que cumpla con las condiciones deseadas
            $modulo = array_filter($client["modulos"], function ($modulo) {
                return $modulo["nombre_catalogo"] == "Gestión Normativa" && $modulo["estatus"] == true;
            });

            // Verificar si existe un módulo que cumpla con la condición
            $estatus = !empty($modulo);
            return $estatus ? true : false;
        }

        // Procesa la respuesta según sea necesario
        return false;
    }
}
