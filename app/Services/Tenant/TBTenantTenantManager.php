<?php

namespace App\Services\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TBTenantTenantManager
{
    /**
     * @var mixed $tbTenant Instancia del tenant actual.
     */
    protected $tbTenant;

    /**
     * tbSetTenant
     *
     * Establece el tenant actual y configura la conexión y autenticación para este.
     *
     * @param mixed $tbTenant Instancia del tenant.
     * @return void
     */
    public function tbSetTenant($tbTenant)
    {
        $this->tbTenant = $tbTenant;
        $this->tbConfigureTenantConnection($tbTenant);
        $this->tbConfigureAuthTenant($tbTenant);
    }

    /**
     * tbGetTenant
     *
     * Obtiene la instancia del tenant actual.
     *
     * @return mixed Instancia del tenant.
     */
    public function tbGetTenant()
    {
        return $this->tbTenant;
    }

    /**
     * tbConfigureTenantConnection
     *
     * Configura la conexión de base de datos para el tenant actual.
     *
     * @param mixed $tbTenant Instancia del tenant.
     * @return void
     */
    protected function tbConfigureTenantConnection($tbTenant)
    {
        config([
            'database.connections.tenant.host' => $tbTenant->db_host,
            'database.connections.tenant.database' => $tbTenant->db_name,
            'database.connections.tenant.username' => $tbTenant->db_username,
            'database.connections.tenant.password' => $tbTenant->db_password,
        ]);

        DB::purge('tenant');
        DB::reconnect('tenant');

        try {
            DB::connection('tenant')->getPdo();
        } catch (\Exception $tbException) {
            dd("Connection failed: " . $tbException->getMessage());
        }

        Schema::connection('tenant')->getConnection()->reconnect();
        DB::setDefaultConnection('tenant');
        app()->instance('tbTenant', $tbTenant);
    }

    /**
     * tbConfigureAuthTenant
     *
     * Configura la autenticación para el tenant actual.
     *
     * @param mixed $tbTenant Instancia del tenant.
     * @return void
     */
    protected function tbConfigureAuthTenant($tbTenant)
    {
        Config::set('auth.providers.tb_tenant_users.connection', 'tenant');
    }

    /**
     * tbGetTenantFromRequest
     *
     * Obtiene el tenant a partir de un subdominio en la solicitud HTTP.
     *
     * @param \Illuminate\Http\Request $tbRequest Solicitud HTTP entrante.
     * @return string ID de Stripe del tenant encontrado.
     */
    public function tbGetTenantFromRequest($tbRequest)
    {
        $tbSubdomain = explode('.', $tbRequest->getHost(), 2)[0];

        $tbTenant = Tenant::whereHas(
            'domains',
            fn($tbQuery) =>
            $tbQuery->where('domain', $tbSubdomain)
        )->firstOrFail();

        return $tbTenant->stripe_id;
    }
}
