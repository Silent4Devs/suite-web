<?php

namespace App\Services;

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
            'database.connections.tenant' => [
                'driver' => 'pgsql',
                'host' => $tenant->db_host,
                'database' => $tenant->db_name,
                'username' => $tenant->db_username,
                'password' => $tenant->db_password,
                'charset' => 'UTF8',
                'collation' => 'en_US.UTF-8',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ],
        ]);

        DB::purge('tenant');
        DB::reconnect('tenant');
        Schema::connection('tenant')->getConnection()->reconnect();
    }
}
