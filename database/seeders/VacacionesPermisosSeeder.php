<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class VacacionesPermisosSeeder extends Seeder
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
                'name' => 'Ajustar Vacaciones',
                'title' => 'ajustes_vacaciones',
            ],

            [
                'name' => 'Ajustar DayOff',
                'title' => 'ajustes_dayoff',
            ],

            [
                'name' => 'Ajustar permisos con goce de sueldo',
                'title' => 'ajustes_goce_sueldo',
            ],

            [
                'name' => 'Ver Lineamientos de vacaciones',
                'title' => 'reglas_vacaciones_acceder',
            ],

            [
                'name' => ' Crear Lineamientos de vacaciones',
                'title' => 'reglas_vacaciones_crear',
            ],

            [
                'name' => 'Editar Lineamientos de vacaciones',
                'title' => 'reglas_vacaciones_editar',
            ],

            [
                'name' => 'Eliminar Lineamientos de vacaciones',
                'title' => 'reglas_vacaciones_eliminar',
            ],

            [
                'name' => 'Ver todas la solicitudes de vacaciones',
                'title' => 'reglas_vacaciones_vista_global',
            ],

            [
                'name' => 'Ver Lineamientos de Day Off',
                'title' => 'reglas_dayoff_acceder',
            ],

            [
                'name' => 'Crear Lineamientos de Day Off',
                'title' => 'reglas_dayoff_crear',
            ],

            [
                'name' => 'Editar Lineamientos de Day Off',
                'title' => 'reglas_dayoff_editar',
            ],

            [
                'name' => 'Eliminar Lineamientos de Day Off',
                'title' => 'reglas_dayoff_eliminar',
            ],

            [
                'name' => 'Ver todas la solicitudes de Day Off',
                'title' => 'reglas_dayoff_vista_global',
            ],

            [
                'name' => 'Ver Lineamientos de Permisos con goce de sueldo',
                'title' => 'reglas_goce_sueldo_acceder',
            ],

            [
                'name' => 'Crear Lineamientos de  Permisos con goce de sueldo',
                'title' => 'reglas_goce_sueldo_crear',
            ],

            [
                'name' => 'Editar Lineamientos de  Permisos con goce de sueldo',
                'title' => 'reglas_goce_sueldo_editar',
            ],

            [
                'name' => 'Eliminar Lineamientos de  Permisos con goce de sueldo',
                'title' => 'reglas_goce_sueldo_eliminar',
            ],

            [
                'name' => 'Ver todas la solicitudes de Permisos con goce de sueldo',
                'title' => 'reglas_goce_sueldo_vista_global',
            ],

            [
                'name' => 'Acceder modulo suma-resta dias de vacacion',
                'title' => 'incidentes_vacaciones_acceder',
            ],

            [
                'name' => 'Crear suma-resta dias de vacacion',
                'title' => 'incidentes_vacaciones_crear',
            ],
            [
                'name' => 'Editar suma-resta dias vacacion',
                'title' => 'incidentes_vacaciones_editar',
            ],

            [
                'name' => 'Eliminar suma-resta dias de vacacion',
                'title' => 'incidentes_vacaciones_eliminar',
            ],

            [
                'name' => 'Acceder modulo suma-resta dias de dayoff',
                'title' => 'incidentes_dayoff_acceder',
            ],

            [
                'name' => 'Crear suma-resta dias de dayoff',
                'title' => 'incidentes_dayoff_crear',
            ],

            [
                'name' => 'Editar suma-resta dias de vacacion',
                'title' => 'incidentes_dayoff_editar',
            ],

            [
                'name' => 'Elimar suma-resta dias de vacacion',
                'title' => 'incidentes_dayoff_eliminar',
            ],

            [
                'name' => 'Ver y acceder card "Solicitudes" en mi perfil',
                'title' => 'mi_perfil_modulo_solicitud_ausencia',
            ],

            [
                'name' => 'Acceder modulo de aprobaciones',
                'title' => 'modulo_aprobacion_ausencia',
            ],
            [
                'name' => 'Acceder modulo solicitud de vacaciones',
                'title' => 'solicitud_vacaciones_acceder',
            ],
            [
                'name' => 'Crear solicitud de vacaciones',
                'title' => 'solicitud_vacaciones_crear',
            ],
            [
                'name' => 'Editar solicitud de vacaciones',
                'title' => 'solicitud_vacaciones_editar',
            ],
            [
                'name' => 'Eliminar solicitud de vacaciones',
                'title' => 'solicitud_vacaciones_eliminar',
            ],

            [
                'name' => 'Acceder modulo solicitud de Day Off',
                'title' => 'solicitud_dayoff_acceder',
            ],

            [
                'name' => 'Crear solicitud de Day Off',
                'title' => 'solicitud_dayoff_crear',
            ],

            [
                'name' => 'Eliminar solicitud de Day Off',
                'title' => 'solicitud_dayoff_eliminar',
            ],

            [
                'name' => 'Acceder modulo solicitud de Permiso con goce de sueldo',
                'title' => 'solicitud_goce_sueldo_acceder',
            ],

            [
                'name' => 'Crear solicitud de Permiso con goce de sueldo',
                'title' => 'solicitud_goce_sueldo_crear',
            ],

            [
                'name' => 'Eliminar solicitud de Permiso con goce de sueldo',
                'title' => 'solicitud_goce_sueldo_eliminar',
            ],

            [
                'name' => 'Aprobar vacaciones',
                'title' => 'solicitud_vacaciones_aprobar',
            ],
            [
                'name' => 'Aprobar Day Off',
                'title' => 'solicitud_dayoff_aprobar',
            ],
            [
                'name' => 'Aprobar Permisos con goce de sueldo',
                'title' => 'solicitud_permiso_goce_aprobar',
            ],
        ];
        Permission::insert($permissions);
    }
}
