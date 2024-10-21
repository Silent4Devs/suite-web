<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class DashboardGestionContratosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //Dashboard Contratos
            [
                'title' => 'dashboard_gestion_contratos_acceder',
                'name' => 'Permite acceder el dashboard de gestion de contratos',
            ],
        ];
        Permission::insert($permissions);
    }
}
