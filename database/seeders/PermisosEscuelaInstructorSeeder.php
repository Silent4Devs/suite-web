<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosEscuelaInstructorSeeder extends Seeder
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
                'title' => 'mis_cursos_acceder',
                'name' => 'Este permiso permite al usuario poder eligir la opcion de que cursos tomar',
            ],
            [
                'title' => 'mis_cursos_instructor',
                'name' => 'Este permiso permite al usuario acceder al modulo de cursos instructor',
            ],
            [
                'title' => 'escuela_instructor_leer_cursos',
                'name' => 'Este permiso permite al instructor vizualizar los cursos',
            ],
            [
                'title' => 'escuela_instructor_crear_cursos',
                'name' => 'Este permiso permite al instructor crear cursos',
            ],
            [
                'title' => 'escuela_instructor_actualizar_cursos',
                'name' => 'Este permiso permite al instructor actualizar cursos',
            ],
            [
                'title' => 'escuela_instructor_eliminar_cursos',
                'name' => 'Este permiso permite al instructor eliminar cursos',
            ],
        ];

        Permission::insert($permissions);
    }
}
