<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsCatalogueTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => 'admin_catalogue_training',
                'name' => 'Este permiso permite al usuario acceder a la pestaña de administrador para el catalogo de capacitaciones',
            ],
            [
                'title' => 'admin_type_catalogue_training',
                'name' => 'Este permiso permite al usuario acceder a la pestaña de administrador para el catalogo de tipos de capacitaciones',
            ],
        ];

        Permission::insert($permissions);
    }
}
