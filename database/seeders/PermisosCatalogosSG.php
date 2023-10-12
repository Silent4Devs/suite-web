<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosCatalogosSG extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'title' => 'clausulas_auditorias_acceder',
                'name' => 'Este permiso permite al usuario acceder al modulo una Clausula para Auditorias',
            ],
            [
                'title' => 'clausulas_auditorias_crear',
                'name' => 'Este permiso permite al usuario crear una Clausula para Auditorias',
            ],
            [
                'title' => 'clausulas_auditorias_editar',
                'name' => 'Este permiso permite al usuario editar una Clausula para Auditorias',
            ],
            [
                'title' => 'clausulas_auditorias_eliminar',
                'name' => 'Este permiso permite al usuario eliminar una Clausula para Auditorias',
            ],
            [
                'title' => 'clasificaciones_auditorias_acceder',
                'name' => 'Este permiso permite al usuario acceder al modulo una Clasificacion para Auditorias',
            ],
            [
                'title' => 'clasificaciones_auditorias_crear',
                'name' => 'Este permiso permite al usuario crear una Clasificacion para Auditorias',
            ],
            [
                'title' => 'clasificaciones_auditorias_editar',
                'name' => 'Este permiso permite al usuario editar una Clasificacion para Auditorias',
            ],
            [
                'title' => 'clasificaciones_auditorias_eliminar',
                'name' => 'Este permiso permite al usuario eliminar una Clasificacion para Auditorias',
            ],
        ];

        Permission::insert($permissions);
    }
}
