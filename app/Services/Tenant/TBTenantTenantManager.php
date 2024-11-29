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
    protected $tenant;

    public function setTenant($tenant)
    {
        $this->tenant = $tenant;
        $this->configureTenantConnection($tenant);
        $this->conigurateAuthTenant($tenant);
    }

    public function getTenant()
    {
        return $this->tenant;
    }

    protected function configureTenantConnection($tenant)
    {

        config([
            'database.connections.tenant.host' => $tenant->db_host,
            'database.connections.tenant.database' => $tenant->db_name,
            'database.connections.tenant.username' => $tenant->db_username,
            'database.connections.tenant.password' => $tenant->db_password,
        ]);
        DB::purge('tenant');
        DB::reconnect('tenant');
        try {
            $pdo = DB::connection('tenant')->getPdo();
        } catch (\Exception $e) {
            dd("Connection failed: " . $e->getMessage());
        }
        Schema::connection('tenant')->getConnection()->reconnect();
        DB::setDefaultConnection('tenant');
    }

    protected function conigurateAuthTenant($tenant)
    {
        Config::set('auth.providers.tenant_users.connection', 'tenant');
    }

    public function getTenantFromRequest($request)
    {
        $subdomain = explode('.', $request->getHost(), 2)[0];

        $tenant = Tenant::whereHas(
            'domains',
            fn($query) =>
            $query->where('domain', $subdomain)
        )->firstOrFail();

        return $tenant->stripe_id;
    }
}
