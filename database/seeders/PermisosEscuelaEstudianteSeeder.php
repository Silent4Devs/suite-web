<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosEscuelaEstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            [
                'title' => 'escuela_estudiante',
                'name' => 'Este permiso permite al usuario acceder a la pestaña de mis cursos',
            ],
        ];

        Permission::insert($permissions);
    }
}
