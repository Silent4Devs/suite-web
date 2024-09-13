<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

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
