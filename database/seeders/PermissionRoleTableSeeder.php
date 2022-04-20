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
    }
}
