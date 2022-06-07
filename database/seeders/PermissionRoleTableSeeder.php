<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $consultor_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'team_'
                && substr($permission->title, 0, 14) != 'configuracion_';
        });

        if (!is_null(Role::find(2))) {
            Role::findOrFail(2)->permissions()->sync($consultor_permissions);
        }

        if (!is_null(Role::find(3))) {
            $consulta_permission = $admin_permissions->filter(function ($permission) {
                return
                    $permission->title == 'mi_perfil_access'
                    || $permission->title == 'organizacion_show'
                    || $permission->title == 'organizacion_access'
                    || $permission->title == 'organizacion_area_access'
                    || $permission->title == 'organizacion_sede_access'
                    || $permission->title == 'organigrama_organizacion_access'
                    || $permission->title == 'mapa_procesos_organizacion_access'
                    || $permission->title == 'dashboard_access'
                    || $permission->title == 'documentos_publicados_lista_access'
                    || $permission->title == 'documentos_publicados_respositorio_access'
                    || $permission->title == 'agenda_access'
                    || $permission->title == 'contactanos_access'
                    || $permission->title == 'glosario_show'
                    || $permission->title == 'glosario_access'
                    || $permission->title == 'documentos_show'
                    || $permission->title == 'incidentes_seguridad_create'
                    || $permission->title == 'riesgos_create'
                    || $permission->title == 'quejas_create'
                    || $permission->title == 'denuncias_create'
                    || $permission->title == 'mejoras_create'
                    || $permission->title == 'sugerencias_create';
            });
            Role::findOrFail(3)->permissions()->sync($consulta_permission);
        }

        if (!is_null(Role::find(4))) {
            $colaborador_permission = $admin_permissions->filter(function ($permission) {
                return
                    $permission->title == 'mi_perfil_access'
                    || $permission->title == 'mis_datos_access'
                    || $permission->title == 'mi_calendario_access'
                    || $permission->title == 'mis_actividades_access'
                    || $permission->title == 'mis_aprobaciones_access'
                    || $permission->title == 'mis_capacitaciones_access'
                    || $permission->title == 'realizar_reportes_access'
                    || $permission->title == 'portal_de_comunicacion_access'
                    || $permission->title == 'generar_reportes_access'
                    || $permission->title == 'directorio_access'
                    || $permission->title == 'visualizar_perfil_profesional'
                    || $permission->title == 'perfil_de_puesto_access'
                    || $permission->title == 'objetivos_estrategicos_show'
                    || $permission->title == 'organizacion_access'
                    || $permission->title == 'organizacion_area_access'
                    || $permission->title == 'organizacion_sede_access'
                    || $permission->title == 'organigrama_organizacion_access'
                    || $permission->title == 'mapa_procesos_organizacion_access'
                    || $permission->title == 'documentos_publicados_lista_access'
                    || $permission->title == 'agenda_access'
                    || $permission->title == 'incidentes_seguridad_access'
                    || $permission->title == 'incidentes_seguridad_create'
                    || $permission->title == 'riesgos_access'
                    || $permission->title == 'riesgos_create'
                    || $permission->title == 'quejas_access'
                    || $permission->title == 'quejas_create'
                    || $permission->title == 'denuncias_access'
                    || $permission->title == 'denuncias_create'
                    || $permission->title == 'mejoras_access'
                    || $permission->title == 'mejoras_create'
                    || $permission->title == 'sugerencias_access'
                    || $permission->title == 'sugerencias_create'
                    || $permission->title == 'politica_sgsi_access'
                    || $permission->title == 'organizacione_show';
            });
            Role::findOrFail(4)->permissions()->sync($colaborador_permission);
        }

    }
}
