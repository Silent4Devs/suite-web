<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosEscuelaAdminSeeder extends Seeder
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
                'title' => 'escuela_admin_acceder',
                'name' => 'Este permiso permite al usuario poder ser administrador del modulo de escuela',
            ],
            [
                'title' => 'escuela_admin_dashboar',
                'name' => 'Este permiso permite al usuario ver el dashboard de escuela',
            ],
            //modulo de categorias
            [
                'title' => 'escuela_admin_categorias',
                'name' => 'Este permiso permite al usuario acceder al modulo de categorias de escuela',
            ],
            [
                'title' => 'escuela_admin_leer_categorias',
                'name' => 'Este permiso permite al usuario vizualizar los categorias',
            ],
            [
                'title' => 'escuela_admin_crear_categorias',
                'name' => 'Este permiso permite al usuario crear categorias',
            ],
            [
                'title' => 'escuela_admin_actualizar_categorias',
                'name' => 'Este permiso permite al usuario actualizar categorias',
            ],
            [
                'title' => 'escuela_admin_eliminar_categorias',
                'name' => 'Este permiso permite al usuario eliminar categorias',
            ],
            //modulo de niveles
            [
                'title' => 'escuela_admin_niveles',
                'name' => 'Este permiso permite al usuario acceder al modulo de niveles de escuela',
            ],
            [
                'title' => 'escuela_admin_leer_niveles',
                'name' => 'Este permiso permite al usuario vizualizar los niveles',
            ],
            [
                'title' => 'escuela_admin_crear_niveles',
                'name' => 'Este permiso permite al usuario crear niveles',
            ],
            [
                'title' => 'escuela_admin_actualizar_niveles',
                'name' => 'Este permiso permite al usuario actualizar niveles',
            ],
            [
                'title' => 'escuela_admin_eliminar_niveles',
                'name' => 'Este permiso permite al usuario eliminar niveles',
            ],
        ];

        Permission::insert($permissions);
    }
}
