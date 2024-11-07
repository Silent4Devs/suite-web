<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TenantManager
{
    protected $tenant;

    public function setTenant($tenant)
    {
        $this->tenant = $tenant;
        $this->configureTenantConnection($tenant);
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
}
