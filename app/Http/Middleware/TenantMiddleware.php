<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use App\Services\TenantManager;

class TenantMiddleware
{
    public function handle($request, Closure $next)
    {
        // Detectar el inquilino según el dominio
        $domain = $request->getHost();
        $parts = explode('.', $domain);
        if (count($parts) > 1) {
            $subdomain = $parts[0];
        } else {
            $subdomain = $domain;
        }

        $tenant = Tenant::whereHas('domains', function ($query) use ($domain) {

            $query->where('domain', $domain);
        })->firstOrfail();

        dd($tenant);
        // Configurar la conexión a la base de datos para el inquilino
        app(TenantManager::class)->setTenant($tenant);

        return $next($request);
    }
}
