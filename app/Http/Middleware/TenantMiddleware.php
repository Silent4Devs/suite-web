<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use App\Services\TenantManager;

use Illuminate\Support\Facades\DB;

class TenantMiddleware
{
    protected $tenantManager;

    public function __construct(TenantManager $tenantManager)
    {
        $this->tenantManager = $tenantManager;
    }

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

        $tenant = Tenant::whereHas('domains', function ($query) use ($subdomain) {

            $query->where('domain', $subdomain);
        })->firstOrfail();


        // Configurar la conexión a la base de datos para el inquilino
        $db = $this->tenantManager->setTenant($tenant);
        dd($db);

        return $next($request);
    }
}
