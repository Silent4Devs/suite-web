<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'organizacion_create',
            ],
            [
                'id'    => 18,
                'title' => 'organizacion_edit',
            ],
            [
                'id'    => 19,
                'title' => 'organizacion_show',
            ],
            [
                'id'    => 20,
                'title' => 'organizacion_delete',
            ],
            [
                'id'    => 21,
                'title' => 'organizacion_access',
            ],
            [
                'id'    => 22,
                'title' => 'dashboard_access',
            ],
            [
                'id'    => 23,
                'title' => 'implementacion_access',
            ],
            [
                'id'    => 24,
                'title' => 'glosario_create',
            ],
            [
                'id'    => 25,
                'title' => 'glosario_edit',
            ],
            [
                'id'    => 26,
                'title' => 'glosario_show',
            ],
            [
                'id'    => 27,
                'title' => 'glosario_delete',
            ],
            [
                'id'    => 28,
                'title' => 'glosario_access',
            ],
            [
                'id'    => 29,
                'title' => 'isoveintidostresuno_access',
            ],
            [
                'id'    => 30,
                'title' => 'isotreintaunmil_access',
            ],
            [
                'id'    => 31,
                'title' => 'plan_base_actividade_create',
            ],
            [
                'id'    => 32,
                'title' => 'plan_base_actividade_edit',
            ],
            [
                'id'    => 33,
                'title' => 'plan_base_actividade_show',
            ],
            [
                'id'    => 34,
                'title' => 'plan_base_actividade_delete',
            ],
            [
                'id'    => 35,
                'title' => 'plan_base_actividade_access',
            ],
            [
                'id'    => 36,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 37,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 38,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 39,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 40,
                'title' => 'isoveinticieteuno_access',
            ],
            [
                'id'    => 41,
                'title' => 'contexto_access',
            ],
            [
                'id'    => 42,
                'title' => 'entendimiento_organizacion_access',
            ],
            [
                'id'    => 43,
                'title' => 'partes_interesada_create',
            ],
            [
                'id'    => 44,
                'title' => 'partes_interesada_edit',
            ],
            [
                'id'    => 45,
                'title' => 'partes_interesada_show',
            ],
            [
                'id'    => 46,
                'title' => 'partes_interesada_delete',
            ],
            [
                'id'    => 47,
                'title' => 'partes_interesada_access',
            ],
            [
                'id'    => 48,
                'title' => 'matriz_requisito_legale_create',
            ],
            [
                'id'    => 49,
                'title' => 'matriz_requisito_legale_edit',
            ],
            [
                'id'    => 50,
                'title' => 'matriz_requisito_legale_show',
            ],
            [
                'id'    => 51,
                'title' => 'matriz_requisito_legale_delete',
            ],
            [
                'id'    => 52,
                'title' => 'matriz_requisito_legale_access',
            ],
            [
                'id'    => 53,
                'title' => 'alcance_sgsi_create',
            ],
            [
                'id'    => 54,
                'title' => 'alcance_sgsi_edit',
            ],
            [
                'id'    => 55,
                'title' => 'alcance_sgsi_show',
            ],
            [
                'id'    => 56,
                'title' => 'alcance_sgsi_delete',
            ],
            [
                'id'    => 57,
                'title' => 'alcance_sgsi_access',
            ],
            [
                'id'    => 58,
                'title' => 'liderazgo_access',
            ],
            [
                'id'    => 59,
                'title' => 'comiteseguridad_create',
            ],
            [
                'id'    => 60,
                'title' => 'comiteseguridad_edit',
            ],
            [
                'id'    => 61,
                'title' => 'comiteseguridad_show',
            ],
            [
                'id'    => 62,
                'title' => 'comiteseguridad_delete',
            ],
            [
                'id'    => 63,
                'title' => 'comiteseguridad_access',
            ],
            [
                'id'    => 64,
                'title' => 'minutasaltadireccion_create',
            ],
            [
                'id'    => 65,
                'title' => 'minutasaltadireccion_edit',
            ],
            [
                'id'    => 66,
                'title' => 'minutasaltadireccion_show',
            ],
            [
                'id'    => 67,
                'title' => 'minutasaltadireccion_delete',
            ],
            [
                'id'    => 68,
                'title' => 'minutasaltadireccion_access',
            ],
            [
                'id'    => 69,
                'title' => 'evidencias_sgsi_create',
            ],
            [
                'id'    => 70,
                'title' => 'evidencias_sgsi_edit',
            ],
            [
                'id'    => 71,
                'title' => 'evidencias_sgsi_show',
            ],
            [
                'id'    => 72,
                'title' => 'evidencias_sgsi_delete',
            ],
            [
                'id'    => 73,
                'title' => 'evidencias_sgsi_access',
            ],
            [
                'id'    => 74,
                'title' => 'politica_sgsi_create',
            ],
            [
                'id'    => 75,
                'title' => 'politica_sgsi_edit',
            ],
            [
                'id'    => 76,
                'title' => 'politica_sgsi_show',
            ],
            [
                'id'    => 77,
                'title' => 'politica_sgsi_delete',
            ],
            [
                'id'    => 78,
                'title' => 'politica_sgsi_access',
            ],
            [
                'id'    => 79,
                'title' => 'roles_responsabilidade_create',
            ],
            [
                'id'    => 80,
                'title' => 'roles_responsabilidade_edit',
            ],
            [
                'id'    => 81,
                'title' => 'roles_responsabilidade_show',
            ],
            [
                'id'    => 82,
                'title' => 'roles_responsabilidade_delete',
            ],
            [
                'id'    => 83,
                'title' => 'roles_responsabilidade_access',
            ],
            [
                'id'    => 84,
                'title' => 'planificacion_access',
            ],
            [
                'id'    => 85,
                'title' => 'riesgosoportunidade_create',
            ],
            [
                'id'    => 86,
                'title' => 'riesgosoportunidade_edit',
            ],
            [
                'id'    => 87,
                'title' => 'riesgosoportunidade_show',
            ],
            [
                'id'    => 88,
                'title' => 'riesgosoportunidade_delete',
            ],
            [
                'id'    => 89,
                'title' => 'riesgosoportunidade_access',
            ],
            [
                'id'    => 90,
                'title' => 'objetivosseguridad_create',
            ],
            [
                'id'    => 91,
                'title' => 'objetivosseguridad_edit',
            ],
            [
                'id'    => 92,
                'title' => 'objetivosseguridad_show',
            ],
            [
                'id'    => 93,
                'title' => 'objetivosseguridad_delete',
            ],
            [
                'id'    => 94,
                'title' => 'objetivosseguridad_access',
            ],
            [
                'id'    => 95,
                'title' => 'soporte_access',
            ],
            [
                'id'    => 96,
                'title' => 'recurso_create',
            ],
            [
                'id'    => 97,
                'title' => 'recurso_edit',
            ],
            [
                'id'    => 98,
                'title' => 'recurso_show',
            ],
            [
                'id'    => 99,
                'title' => 'recurso_delete',
            ],
            [
                'id'    => 100,
                'title' => 'recurso_access',
            ],
            [
                'id'    => 101,
                'title' => 'competencium_create',
            ],
            [
                'id'    => 102,
                'title' => 'competencium_edit',
            ],
            [
                'id'    => 103,
                'title' => 'competencium_show',
            ],
            [
                'id'    => 104,
                'title' => 'competencium_delete',
            ],
            [
                'id'    => 105,
                'title' => 'competencium_access',
            ],
            [
                'id'    => 106,
                'title' => 'adquirirveintidostrecientosuno_access',
            ],
            [
                'id'    => 107,
                'title' => 'adquirirtreintaunmil_access',
            ],
            [
                'id'    => 108,
                'title' => 'concientizacion_sgi_create',
            ],
            [
                'id'    => 109,
                'title' => 'concientizacion_sgi_edit',
            ],
            [
                'id'    => 110,
                'title' => 'concientizacion_sgi_show',
            ],
            [
                'id'    => 111,
                'title' => 'concientizacion_sgi_delete',
            ],
            [
                'id'    => 112,
                'title' => 'concientizacion_sgi_access',
            ],
            [
                'id'    => 113,
                'title' => 'material_sgsi_create',
            ],
            [
                'id'    => 114,
                'title' => 'material_sgsi_edit',
            ],
            [
                'id'    => 115,
                'title' => 'material_sgsi_show',
            ],
            [
                'id'    => 116,
                'title' => 'material_sgsi_delete',
            ],
            [
                'id'    => 117,
                'title' => 'material_sgsi_access',
            ],
            [
                'id'    => 118,
                'title' => 'material_iso_veinticiente_create',
            ],
            [
                'id'    => 119,
                'title' => 'material_iso_veinticiente_edit',
            ],
            [
                'id'    => 120,
                'title' => 'material_iso_veinticiente_show',
            ],
            [
                'id'    => 121,
                'title' => 'material_iso_veinticiente_delete',
            ],
            [
                'id'    => 122,
                'title' => 'material_iso_veinticiente_access',
            ],
            [
                'id'    => 123,
                'title' => 'comunicacion_sgi_create',
            ],
            [
                'id'    => 124,
                'title' => 'comunicacion_sgi_edit',
            ],
            [
                'id'    => 125,
                'title' => 'comunicacion_sgi_show',
            ],
            [
                'id'    => 126,
                'title' => 'comunicacion_sgi_delete',
            ],
            [
                'id'    => 127,
                'title' => 'comunicacion_sgi_access',
            ],
            [
                'id'    => 128,
                'title' => 'politica_del_sgsi_soporte_access',
            ],
            [
                'id'    => 129,
                'title' => 'control_acceso_create',
            ],
            [
                'id'    => 130,
                'title' => 'control_acceso_edit',
            ],
            [
                'id'    => 131,
                'title' => 'control_acceso_show',
            ],
            [
                'id'    => 132,
                'title' => 'control_acceso_delete',
            ],
            [
                'id'    => 133,
                'title' => 'control_acceso_access',
            ],
            [
                'id'    => 134,
                'title' => 'informacion_documetada_create',
            ],
            [
                'id'    => 135,
                'title' => 'informacion_documetada_edit',
            ],
            [
                'id'    => 136,
                'title' => 'informacion_documetada_show',
            ],
            [
                'id'    => 137,
                'title' => 'informacion_documetada_delete',
            ],
            [
                'id'    => 138,
                'title' => 'informacion_documetada_access',
            ],
            [
                'id'    => 139,
                'title' => 'operacion_access',
            ],
            [
                'id'    => 140,
                'title' => 'planificacion_control_create',
            ],
            [
                'id'    => 141,
                'title' => 'planificacion_control_edit',
            ],
            [
                'id'    => 142,
                'title' => 'planificacion_control_show',
            ],
            [
                'id'    => 143,
                'title' => 'planificacion_control_delete',
            ],
            [
                'id'    => 144,
                'title' => 'planificacion_control_access',
            ],
            [
                'id'    => 145,
                'title' => 'activo_create',
            ],
            [
                'id'    => 146,
                'title' => 'activo_edit',
            ],
            [
                'id'    => 147,
                'title' => 'activo_show',
            ],
            [
                'id'    => 148,
                'title' => 'activo_delete',
            ],
            [
                'id'    => 149,
                'title' => 'activo_access',
            ],
            [
                'id'    => 150,
                'title' => 'tratamiento_riesgo_create',
            ],
            [
                'id'    => 151,
                'title' => 'tratamiento_riesgo_edit',
            ],
            [
                'id'    => 152,
                'title' => 'tratamiento_riesgo_show',
            ],
            [
                'id'    => 153,
                'title' => 'tratamiento_riesgo_delete',
            ],
            [
                'id'    => 154,
                'title' => 'tratamiento_riesgo_access',
            ],
            [
                'id'    => 155,
                'title' => 'evaluacion_access',
            ],
            [
                'id'    => 156,
                'title' => 'mejora_access',
            ],
            [
                'id'    => 157,
                'title' => 'auditoria_interna_create',
            ],
            [
                'id'    => 158,
                'title' => 'auditoria_interna_edit',
            ],
            [
                'id'    => 159,
                'title' => 'auditoria_interna_show',
            ],
            [
                'id'    => 160,
                'title' => 'auditoria_interna_delete',
            ],
            [
                'id'    => 161,
                'title' => 'auditoria_interna_access',
            ],
            [
                'id'    => 162,
                'title' => 'revision_direccion_create',
            ],
            [
                'id'    => 163,
                'title' => 'revision_direccion_edit',
            ],
            [
                'id'    => 164,
                'title' => 'revision_direccion_show',
            ],
            [
                'id'    => 165,
                'title' => 'revision_direccion_delete',
            ],
            [
                'id'    => 166,
                'title' => 'revision_direccion_access',
            ],
            [
                'id'    => 167,
                'title' => 'controle_create',
            ],
            [
                'id'    => 168,
                'title' => 'controle_edit',
            ],
            [
                'id'    => 169,
                'title' => 'controle_show',
            ],
            [
                'id'    => 170,
                'title' => 'controle_delete',
            ],
            [
                'id'    => 171,
                'title' => 'controle_access',
            ],
            [
                'id'    => 172,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 173,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 174,
                'title' => 'area_create',
            ],
            [
                'id'    => 175,
                'title' => 'area_edit',
            ],
            [
                'id'    => 176,
                'title' => 'area_show',
            ],
            [
                'id'    => 177,
                'title' => 'area_delete',
            ],
            [
                'id'    => 178,
                'title' => 'area_access',
            ],
            [
                'id'    => 179,
                'title' => 'organizacione_create',
            ],
            [
                'id'    => 180,
                'title' => 'organizacione_edit',
            ],
            [
                'id'    => 181,
                'title' => 'organizacione_show',
            ],
            [
                'id'    => 182,
                'title' => 'organizacione_delete',
            ],
            [
                'id'    => 183,
                'title' => 'organizacione_access',
            ],
            [
                'id'    => 184,
                'title' => 'tipoactivo_create',
            ],
            [
                'id'    => 185,
                'title' => 'tipoactivo_edit',
            ],
            [
                'id'    => 186,
                'title' => 'tipoactivo_show',
            ],
            [
                'id'    => 187,
                'title' => 'tipoactivo_delete',
            ],
            [
                'id'    => 188,
                'title' => 'tipoactivo_access',
            ],
            [
                'id'    => 189,
                'title' => 'puesto_create',
            ],
            [
                'id'    => 190,
                'title' => 'puesto_edit',
            ],
            [
                'id'    => 191,
                'title' => 'puesto_show',
            ],
            [
                'id'    => 192,
                'title' => 'puesto_delete',
            ],
            [
                'id'    => 193,
                'title' => 'puesto_access',
            ],
            [
                'id'    => 194,
                'title' => 'sede_create',
            ],
            [
                'id'    => 195,
                'title' => 'sede_edit',
            ],
            [
                'id'    => 196,
                'title' => 'sede_show',
            ],
            [
                'id'    => 197,
                'title' => 'sede_delete',
            ],
            [
                'id'    => 198,
                'title' => 'sede_access',
            ],
            [
                'id'    => 199,
                'title' => 'indicadores_sgsi_create',
            ],
            [
                'id'    => 200,
                'title' => 'indicadores_sgsi_edit',
            ],
            [
                'id'    => 201,
                'title' => 'indicadores_sgsi_show',
            ],
            [
                'id'    => 202,
                'title' => 'indicadores_sgsi_delete',
            ],
            [
                'id'    => 203,
                'title' => 'indicadores_sgsi_access',
            ],
            [
                'id'    => 204,
                'title' => 'indicadorincidentessi_access',
            ],
            [
                'id'    => 205,
                'title' => 'auditoria_anual_create',
            ],
            [
                'id'    => 206,
                'title' => 'auditoria_anual_edit',
            ],
            [
                'id'    => 207,
                'title' => 'auditoria_anual_show',
            ],
            [
                'id'    => 208,
                'title' => 'auditoria_anual_delete',
            ],
            [
                'id'    => 209,
                'title' => 'auditoria_anual_access',
            ],
            [
                'id'    => 210,
                'title' => 'plan_auditorium_create',
            ],
            [
                'id'    => 211,
                'title' => 'plan_auditorium_edit',
            ],
            [
                'id'    => 212,
                'title' => 'plan_auditorium_show',
            ],
            [
                'id'    => 213,
                'title' => 'plan_auditorium_delete',
            ],
            [
                'id'    => 214,
                'title' => 'plan_auditorium_access',
            ],
            [
                'id'    => 215,
                'title' => 'accion_correctiva_create',
            ],
            [
                'id'    => 216,
                'title' => 'accion_correctiva_edit',
            ],
            [
                'id'    => 217,
                'title' => 'accion_correctiva_show',
            ],
            [
                'id'    => 218,
                'title' => 'accion_correctiva_delete',
            ],
            [
                'id'    => 219,
                'title' => 'accion_correctiva_access',
            ],
            [
                'id'    => 220,
                'title' => 'planaccion_correctiva_create',
            ],
            [
                'id'    => 221,
                'title' => 'planaccion_correctiva_edit',
            ],
            [
                'id'    => 222,
                'title' => 'planaccion_correctiva_show',
            ],
            [
                'id'    => 223,
                'title' => 'planaccion_correctiva_delete',
            ],
            [
                'id'    => 224,
                'title' => 'planaccion_correctiva_access',
            ],
            [
                'id'    => 225,
                'title' => 'registromejora_create',
            ],
            [
                'id'    => 226,
                'title' => 'registromejora_edit',
            ],
            [
                'id'    => 227,
                'title' => 'registromejora_show',
            ],
            [
                'id'    => 228,
                'title' => 'registromejora_delete',
            ],
            [
                'id'    => 229,
                'title' => 'registromejora_access',
            ],
            [
                'id'    => 230,
                'title' => 'dmaic_create',
            ],
            [
                'id'    => 231,
                'title' => 'dmaic_edit',
            ],
            [
                'id'    => 232,
                'title' => 'dmaic_show',
            ],
            [
                'id'    => 233,
                'title' => 'dmaic_delete',
            ],
            [
                'id'    => 234,
                'title' => 'dmaic_access',
            ],
            [
                'id'    => 235,
                'title' => 'plan_mejora_create',
            ],
            [
                'id'    => 236,
                'title' => 'plan_mejora_edit',
            ],
            [
                'id'    => 237,
                'title' => 'plan_mejora_show',
            ],
            [
                'id'    => 238,
                'title' => 'plan_mejora_delete',
            ],
            [
                'id'    => 239,
                'title' => 'plan_mejora_access',
            ],
            [
                'id'    => 240,
                'title' => 'enlaces_ejecutar_create',
            ],
            [
                'id'    => 241,
                'title' => 'enlaces_ejecutar_edit',
            ],
            [
                'id'    => 242,
                'title' => 'enlaces_ejecutar_show',
            ],
            [
                'id'    => 243,
                'title' => 'enlaces_ejecutar_delete',
            ],
            [
                'id'    => 244,
                'title' => 'enlaces_ejecutar_access',
            ],
            [
                'id'    => 245,
                'title' => 'team_create',
            ],
            [
                'id'    => 246,
                'title' => 'team_edit',
            ],
            [
                'id'    => 247,
                'title' => 'team_show',
            ],
            [
                'id'    => 248,
                'title' => 'team_delete',
            ],
            [
                'id'    => 249,
                'title' => 'team_access',
            ],
            [
                'id'    => 250,
                'title' => 'incidentes_de_seguridad_create',
            ],
            [
                'id'    => 251,
                'title' => 'incidentes_de_seguridad_edit',
            ],
            [
                'id'    => 252,
                'title' => 'incidentes_de_seguridad_show',
            ],
            [
                'id'    => 253,
                'title' => 'incidentes_de_seguridad_delete',
            ],
            [
                'id'    => 254,
                'title' => 'incidentes_de_seguridad_access',
            ],
            [
                'id'    => 255,
                'title' => 'estado_incidente_create',
            ],
            [
                'id'    => 256,
                'title' => 'estado_incidente_edit',
            ],
            [
                'id'    => 257,
                'title' => 'estado_incidente_show',
            ],
            [
                'id'    => 258,
                'title' => 'estado_incidente_delete',
            ],
            [
                'id'    => 259,
                'title' => 'estado_incidente_access',
            ],
            [
                'id'    => 260,
                'title' => 'estatus_plan_trabajo_create',
            ],
            [
                'id'    => 261,
                'title' => 'estatus_plan_trabajo_edit',
            ],
            [
                'id'    => 262,
                'title' => 'estatus_plan_trabajo_show',
            ],
            [
                'id'    => 263,
                'title' => 'estatus_plan_trabajo_delete',
            ],
            [
                'id'    => 264,
                'title' => 'estatus_plan_trabajo_access',
            ],
            [
                'id'    => 265,
                'title' => 'documentacion_access',
            ],
            [
                'id'    => 266,
                'title' => 'carpetum_create',
            ],
            [
                'id'    => 267,
                'title' => 'carpetum_edit',
            ],
            [
                'id'    => 268,
                'title' => 'carpetum_show',
            ],
            [
                'id'    => 269,
                'title' => 'carpetum_delete',
            ],
            [
                'id'    => 270,
                'title' => 'carpetum_access',
            ],
            [
                'id'    => 271,
                'title' => 'archivo_create',
            ],
            [
                'id'    => 272,
                'title' => 'archivo_edit',
            ],
            [
                'id'    => 273,
                'title' => 'archivo_show',
            ],
            [
                'id'    => 274,
                'title' => 'archivo_delete',
            ],
            [
                'id'    => 275,
                'title' => 'archivo_access',
            ],
            [
                'id'    => 276,
                'title' => 'estado_documento_create',
            ],
            [
                'id'    => 277,
                'title' => 'estado_documento_edit',
            ],
            [
                'id'    => 278,
                'title' => 'estado_documento_show',
            ],
            [
                'id'    => 279,
                'title' => 'estado_documento_delete',
            ],
            [
                'id'    => 280,
                'title' => 'estado_documento_access',
            ],
            [
                'id'    => 281,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 282,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 283,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 284,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 285,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 286,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 287,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 288,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 289,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 290,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 291,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 292,
                'title' => 'analisis_riesgo_access',
            ],
            [
                'id'    => 293,
                'title' => 'matriz_riesgo_create',
            ],
            [
                'id'    => 294,
                'title' => 'matriz_riesgo_edit',
            ],
            [
                'id'    => 295,
                'title' => 'matriz_riesgo_show',
            ],
            [
                'id'    => 296,
                'title' => 'matriz_riesgo_delete',
            ],
            [
                'id'    => 297,
                'title' => 'matriz_riesgo_access',
            ],
            [
                'id'    => 298,
                'title' => 'gap_uno_create',
            ],
            [
                'id'    => 299,
                'title' => 'gap_uno_edit',
            ],
            [
                'id'    => 300,
                'title' => 'gap_uno_show',
            ],
            [
                'id'    => 301,
                'title' => 'gap_uno_delete',
            ],
            [
                'id'    => 302,
                'title' => 'gap_uno_access',
            ],
            [
                'id'    => 303,
                'title' => 'gap_do_create',
            ],
            [
                'id'    => 304,
                'title' => 'gap_do_edit',
            ],
            [
                'id'    => 305,
                'title' => 'gap_do_show',
            ],
            [
                'id'    => 306,
                'title' => 'gap_do_delete',
            ],
            [
                'id'    => 307,
                'title' => 'gap_do_access',
            ],
            [
                'id'    => 308,
                'title' => 'gap_tre_create',
            ],
            [
                'id'    => 309,
                'title' => 'gap_tre_edit',
            ],
            [
                'id'    => 310,
                'title' => 'gap_tre_show',
            ],
            [
                'id'    => 311,
                'title' => 'gap_tre_delete',
            ],
            [
                'id'    => 312,
                'title' => 'gap_tre_access',
            ],
            [
                'id'    => 313,
                'title' => 'lista_de_verificacion_access',
            ],
            [
                'id'    => 314,
                'title' => 'control_documento_create',
            ],
            [
                'id'    => 315,
                'title' => 'control_documento_edit',
            ],
            [
                'id'    => 316,
                'title' => 'control_documento_delete',
            ],
            [
                'id'    => 317,
                'title' => 'control_documento_access',
            ],
            [
                'id'    => 318,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 319,
                'title' => 'entendimiento_organizacion_create',
            ],
            [
                'id'    => 320,
                'title' => 'entendimiento_organizacion_edit',
            ],
            [
                'id'    => 321,
                'title' => 'entendimiento_organizacion_delete',
            ],
            [
                'id'    => 322,
                'title' => 'grupoarea_create',
            ],
            [
                'id'    => 323,
                'title' => 'grupoarea_edit',
            ],
            [
                'id'    => 324,
                'title' => 'grupoarea_show',
            ],
            [
                'id'    => 325,
                'title' => 'grupoarea_delete',
            ],
            [
                'id'    => 326,
                'title' => 'grupoarea_access',
            ],
            [
                'id'    => 327,
                'title' => 'entendimiento_organizacion_show',
            ],

        ];

        Permission::insert($permissions);
    }
}
