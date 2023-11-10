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

        if (! is_null(Role::find(2))) {
            Role::findOrFail(2)->permissions()->sync($consultor_permissions);
        }

        if (! is_null(Role::find(3))) {
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

        if (! is_null(Role::find(4))) {
            $colaborador_permission = $admin_permissions->filter(function ($permission) {
                return
                    $permission->title == 'mi_perfil_acceder'
                    || $permission->title == 'mi_perfil_mis_datos_acceder'
                    || $permission->title == 'mi_perfil_mi_calendario_acceder'
                    || $permission->title == 'mi_perfil_mis_actividades_acceder'
                    || $permission->title == 'mi_perfil_mis_aprobaciones_acceder'
                    || $permission->title == 'mi_perfil_mis_capacitaciones_acceder'
                    || $permission->title == 'mi_perfil_mis_reportes_acceder'
                    || $permission->title == 'mi_perfil_mis_reportes_realizar_reporte_de_incidente_de_seguridad'
                    || $permission->title == 'mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado'
                    || $permission->title == 'mi_perfil_mis_reportes_realizar_reporte_de_queja'
                    || $permission->title == 'mi_perfil_mis_reportes_realizar_reporte_de_denuncia'
                    || $permission->title == 'mi_perfil_mis_reportes_realizar_reporte_de_propuesta_de_mejora'
                    || $permission->title == 'mi_perfil_mis_reportes_realizar_reporte_de_sugerencia'
                    || $permission->title == 'portal_de_comunicaccion_acceder'
                    || $permission->title == 'portal_comunicacion_mostrar_comunicados'
                    || $permission->title == 'portal_comunicacion_mostrar_documentos_publicados'
                    || $permission->title == 'portal_comunicacion_mostrar_organizacion'
                    || $permission->title == 'portal_comunicacion_mostrar_sedes'
                    || $permission->title == 'portal_comunicacion_mostrar_areas'
                    || $permission->title == 'portal_comunicacion_mostrar_mapa_de_procesos'
                    || $permission->title == 'portal_comunicacion_mostrar_organigrama'
                    || $permission->title == 'portal_comunicacion_mostrar_directorio'
                    || $permission->title == 'portal_comunicacion_mostrar_documentos'
                    || $permission->title == 'portal_comunicacion_mostrar_politicas'
                    || $permission->title == 'portal_comunicacion_mostrar_comites'
                    || $permission->title == 'portal_comunicacion_mostrar_reportar'
                    || $permission->title == 'portal_comunicacion_mostrar_nuevos_ingresos'
                    || $permission->title == 'portal_comunicacion_mostrar_aniversarios'
                    || $permission->title == 'portal_comunicacion_mostrar_cumpleaños'
                    || $permission->title == 'timesheet_acceder'
                    || $permission->title == 'calendario_organizacional_acceder'
                    || $permission->title == 'documentos_publicados_acceder'
                    || $permission->title == 'mi_perfil_mis_datos_ver_perfil_profesional'
                    || $permission->title == 'mi_perfil_mis_datos_ver_perfil_de_puesto'
                    || $permission->title == 'objetivos_estrategicos_ver'
                    || $permission->title == 'organigrama_acceder'
                    || $permission->title == 'mi_perfil_mis_datos_ver_mi_expediente'
                    || $permission->title == 'mi_perfil_mis_datos_ver_mi_equipo'
                    || $permission->title == 'mi_perfil_mis_datos_ver_mis_objetivos'
                    || $permission->title == 'mi_perfil_mis_datos_ver_mis_activos'
                    || $permission->title == 'mi_perfil_mis_datos_ver_mi_autoevaluacion'
                    || $permission->title == 'mi_perfil_mis_datos_ver_mis_competencias'
                    || $permission->title == 'mi_perfil_mis_datos_ver_mis_evaluaciones_a_realizar';
            });
            Role::findOrFail(4)->permissions()->sync($colaborador_permission);
        }
    }
}
