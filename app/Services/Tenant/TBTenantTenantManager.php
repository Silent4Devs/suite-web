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
    protected $tbTenant;

    public function tbSetTenant($tbTenant)
    {
        $this->tbTenant = $tbTenant;
        $this->tbConfigureTenantConnection($tbTenant);
        $this->tbConfigureAuthTenant($tbTenant);
    }

    public function tbGetTenant()
    {
        return $this->tbTenant;
    }

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

    protected function tbConfigureAuthTenant($tbTenant)
    {
        Config::set('auth.providers.tb_tenant_users.connection', 'tenant');
    }

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
