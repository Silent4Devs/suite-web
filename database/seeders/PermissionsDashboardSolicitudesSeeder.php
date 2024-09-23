<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsDashboardSolicitudesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => 'dashboard_solicitudes_directivo',
                'name' => 'Este permiso permite al usuario acceder al dashboard de solicitudes como directivo',
            ],

        ];

        Permission::insert($permissions);
    }
}
