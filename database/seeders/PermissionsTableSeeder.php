<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        Permission::truncate();
        $permissions = [
            // CONFIGURAR VISTAS
            [
                'name' => 'Acceder a Configurar Vistas',
                'title' => 'configurar_vistas_access',
            ],
            [
                'name' => 'Acceder a Configurar Vista Mis Datos',
                'title' => 'configurar_vista_mis_datos_access',
            ],
            [
                'name' => 'Acceder a Configurar Vista Mis Organización',
                'title' => 'configurar_vista_mi_organizacion_access',
            ],
            [
                'name' => 'Acceder a Configurar Soporte',
                'title' => 'configurar_soporte_access',
            ],
            [
                'name' => 'Agregar Colaborador de Soporte',
                'title' => 'configurar_soporte_create',
            ],
            [
                'name' => 'Visualizar Colaborador de Soporte',
                'title' => 'configurar_soporte_show',
            ],
            [
                'name' => 'Editar Colaborador de Soporte',
                'title' => 'configurar_soporte_edit',
            ],
            [
                'name' => 'Eliminar Colaborador de Soporte',
                'title' => 'configurar_soporte_delete',
            ],
            [
                'name' => 'Acceder a Listados de Soporte',
                'title' => 'listados_soporte_access',
            ],
            // MI PERFIL
            [
                'name' => 'Acceder a Mi Perfil',
                'title' => 'mi_perfil_access',
            ],
            [
                'name' => 'Acceder a Mis Datos',
                'title' => 'mis_datos_access',
            ],
            [
                'name' => 'Acceder a Mi Calendario',
                'title' => 'mi_calendario_access',
            ],
            [
                'name' => 'Acceder a Mis Actividades',
                'title' => 'mis_actividades_access',
            ],
            [
                'name' => 'Acceder a Mis Aprobaciones',
                'title' => 'mis_aprobaciones_access',
            ],
            [
                'name' => 'Acceder a Mis Capacitaciones',
                'title' => 'mis_capacitaciones_access',
            ],
            [
                'name' => 'Realizar Reportes',
                'title' => 'realizar_reportes_access',
            ],
            [
                'name' => 'Subir Documentación Empleado',
                'title' => 'subir_documentacion_empleados',
            ],
            [
                'name' => 'Subir Certificaciones Empleado',
                'title' => 'subir_certificaciones_empleados',
            ],
            [
                'name' => 'Subir Capacitaciones Empleado',
                'title' => 'subir_capacitaciones_empleados',
            ],
            // PORTAL DE COMUNICACION
            [
                'name' => 'Acceder al Portal de Comunicación',
                'title' => 'portal_de_comunicacion_access',
            ],
            [
                'name' => 'Acceder a Generar Reportes',
                'title' => 'generar_reportes_access',
            ],
            //DIRECTORIO
            [
                'name' => 'Acceder al Directorio de la Empresa',
                'title' => 'directorio_access',
            ],
            //COMPETENCIAS
            [
                'name' => 'Visualizar Perfil(es) Profesional(es)',
                'title' => 'visualizar_perfil_profesional',
            ],
            [
                'name' => 'Editar Perfil Profesional',
                'title' => 'perfil_profesional_edit',
            ],
            //PERFIL DE PUESTO
            [
                'name' => 'Visualizar Perfil De Puesto',
                'title' => 'perfil_de_puesto_access',
            ],
            // TIMESHEET
            [
                'name' => 'Acceder a TimeSheet',
                'title' => 'timesheet_access',
            ],
            [
                'name' => 'Visualizar Mi TimeSheet (Horas Aceptadas)',
                'title' => 'mi_timesheet_horas_aceptadas_show',
            ],
            [
                'name' => 'Visualizar Mi TimeSheet (Horas Rechazadas)',
                'title' => 'mi_timesheet_horas_rechazadas_show',
            ],
            [
                'name' => 'Crear TimeSheet',
                'title' => 'timesheet_create',
            ],
            [
                'name' => 'Acceder a Proyectos Para TimeSheet',
                'title' => 'timesheet_administrador_proyectos_access',
            ],
            [
                'name' => 'Agregar Proyectos Para TimeSheet',
                'title' => 'timesheet_administrador_proyectos_create',
            ],
            [
                'name' => 'Eliminar Proyectos de TimeSheet',
                'title' => 'timesheet_administrador_proyectos_delete',
            ],
            [
                'name' => 'Acceder a Tareas a Proyectos de TimeSheet',
                'title' => 'timesheet_administrador_tareas_proyectos_access',
            ],
            [
                'name' => 'Agregar Tareas a Proyectos de TimeSheet',
                'title' => 'timesheet_administrador_tareas_proyectos_create',
            ],
            [
                'name' => 'Eliminar Tareas de Proyectos de TimeSheet',
                'title' => 'timesheet_administrador_tareas_proyectos_delete',
            ],
            [
                'name' => 'Acceder a Aprobar/Rechazar Horas TimeSheet',
                'title' => 'timesheet_administrador_aprobar_rechazar_horas_access',
            ],
            [
                'name' => 'Aprobar Horas TimeSheet',
                'title' => 'timesheet_administrador_aprobar_horas',
            ],
            [
                'name' => 'Rechazar Horas TimeSheet',
                'title' => 'timesheet_administrador_rechazar_horas',
            ],
            [
                'name' => 'Acceder a TimeSheet Clientes',
                'title' => 'timesheet_administrador_clientes_access',
            ],
            [
                'name' => 'Agregar Clientes TimeSheet',
                'title' => 'timesheet_administrador_clientes_create',
            ],
            [
                'name' => 'Editar Clientes TimeSheet',
                'title' => 'timesheet_administrador_clientes_edit',
            ],
            [
                'name' => 'Visualizar Clientes TimeSheet',
                'title' => 'timesheet_administrador_clientes_show',
            ],
            [
                'name' => 'Eliminar Clientes TimeSheet',
                'title' => 'timesheet_administrador_clientes_delete',
            ],
            // CAPITAL HUMANO
            [
                'name' => 'Acceder a Capital Humano',
                'title' => 'capital_humano_access',
            ],
            [
                'name' => 'Acceder a Competencias - Capital Humano',
                'title' => 'capital_humano_competencias_access',
            ],
            [
                'name' => 'Agregar Competencias - Capital Humano',
                'title' => 'capital_humano_competencias_create',
            ],
            [
                'name' => 'Editar Competencias - Capital Humano',
                'title' => 'capital_humano_competencias_edit',
            ],
            [
                'name' => 'Visualizar Competencias - Capital Humano',
                'title' => 'capital_humano_competencias_show',
            ],
            [
                'name' => 'Eliminar Competencias - Capital Humano',
                'title' => 'capital_humano_competencias_delete',
            ],
            [
                'name' => 'Acceder a Consulta de Competencias Por Puestos - Capital Humano',
                'title' => 'capital_humano_competencias_por_puestos_consulta_access',
            ],
            [
                'name' => 'Acceder a Competencias Por Puestos - Capital Humano',
                'title' => 'capital_humano_competencias_por_puestos_access',
            ],
            [
                'name' => 'Agregar Competencias Por Puestos - Capital Humano',
                'title' => 'capital_humano_competencias_por_puestos_create',
            ],
            [
                'name' => 'Editar Competencias Por Puestos - Capital Humano',
                'title' => 'capital_humano_competencias_por_puestos_edit',
            ],
            [
                'name' => 'Eliminar Competencias Por Puestos - Capital Humano',
                'title' => 'capital_humano_competencias_por_puestos_delete',
            ],
            [
                'name' => 'Acceder Lista de Documentos',
                'title' => 'lista_documentos_empleados_access',
            ],
            [
                'name' => 'Crear Registro para Lista de Documentos',
                'title' => 'lista_documentos_empleados_create',
            ],
            [
                'name' => 'Editar Registro de Lista de Documentos',
                'title' => 'lista_documentos_empleados_edit',
            ],
            [
                'name' => 'Eliminar Registro de Lista de Documentos',
                'title' => 'lista_documentos_empleados_delete',
            ],
            [
                'name' => 'Acceder a Niveles Jerárquicos',
                'title' => 'niveles_jerarquicos_access',
            ],
            [
                'name' => 'Agregar Nivel Jerárquico',
                'title' => 'niveles_jerarquicos_create',
            ],
            [
                'name' => 'Editar Nivel Jerárquico',
                'title' => 'niveles_jerarquicos_edit',
            ],
            [
                'name' => 'Eliminar Nivel Jerárquico',
                'title' => 'niveles_jerarquicos_delete',
            ],
            [
                'name' => 'Visualizar Nivel Jerárquico',
                'title' => 'niveles_jerarquicos_show',
            ],
            [
                'name' => 'Acceder a Tipos de Contratos',
                'title' => 'tipos_de_contratos_access',
            ],
            [
                'name' => 'Agregar Tipo de Contrato',
                'title' => 'tipos_de_contratos_create',
            ],
            [
                'name' => 'Editar Tipo de Contrato',
                'title' => 'tipos_de_contratos_edit',
            ],
            [
                'name' => 'Visualizar Tipo de Contrato',
                'title' => 'tipos_de_contratos_show',
            ],
            [
                'name' => 'Eliminar Tipo de Contrato',
                'title' => 'tipos_de_contratos_delete',
            ],
            [
                'name' => 'Acceder a Entidades Crediticias',
                'title' => 'entidades_crediticias_access',
            ],
            [
                'name' => 'Agregar Entidad Crediticia',
                'title' => 'entidades_crediticias_create',
            ],
            [
                'name' => 'Editar Entidad Crediticia',
                'title' => 'entidades_crediticias_edit',
            ],
            [
                'name' => 'Visualizar Entidad Crediticia',
                'title' => 'entidades_crediticias_show',
            ],
            [
                'name' => 'Eliminar Entidad Crediticia',
                'title' => 'entidades_crediticias_delete',
            ],
            [
                'name' => 'Acceder a Objetivos Estratégicos',
                'title' => 'objetivos_estrategicos_access',
            ],
            [
                'name' => 'Crear Objetivo Estratégico',
                'title' => 'objetivos_estrategicos_create',
            ],
            [
                'name' => 'Editar Objetivo Estratégico',
                'title' => 'objetivos_estrategicos_edit',
            ],
            [
                'name' => 'Eliminar Objetivo Estratégico',
                'title' => 'objetivos_estrategicos_delete',
            ],
            [
                'name' => 'Visualizar Objetivos Estratégicos',
                'title' => 'objetivos_estrategicos_show',
            ],
            [
                'name' => 'Copiar Objetivos Estratégicos',
                'title' => 'objetivos_estrategicos_copy',
            ],
            [
                'name' => 'Acceder a Perfiles Profesionales',
                'title' => 'perfiles_profesionales_access',
            ],
            [
                'name' => 'Acceder a Categorias de Capacitaciones',
                'title' => 'categorias_capacitaciones_access',
            ],
            [
                'name' => 'Agregar Categoria de Capacitación',
                'title' => 'categorias_capacitaciones_create',
            ],
            [
                'name' => 'Editar Categoria de Capacitación',
                'title' => 'categorias_capacitaciones_edit',
            ],
            [
                'name' => 'Visualizar Categoria de Capacitación',
                'title' => 'categorias_capacitaciones_show',
            ],
            [
                'name' => 'Eliminar Categoria de Capacitación',
                'title' => 'categorias_capacitaciones_delete',
            ],
            [
                'name' => 'Acceder a Lista de Días Festivos',
                'title' => 'dias_festivos_access',
            ],
            [
                'name' => 'Agregar Día Festivo',
                'title' => 'dias_festivos_create',
            ],
            [
                'name' => 'Visualizar Día Festivo',
                'title' => 'dias_festivos_show',
            ],
            [
                'name' => 'Editar Día Festivo',
                'title' => 'dias_festivos_edit',
            ],
            [
                'name' => 'Eliminar Día Festivo',
                'title' => 'dias_festivos_delete',
            ],
            [
                'name' => 'Acceder a Lista de Eventos de la Organización',
                'title' => 'eventos_organizacion_access',
            ],
            [
                'name' => 'Agregar Evento de la Organización',
                'title' => 'eventos_organizacion_create',
            ],
            [
                'name' => 'Visualizar Evento de la Organización',
                'title' => 'eventos_organizacion_show',
            ],
            [
                'name' => 'Editar Evento de la Organización',
                'title' => 'eventos_organizacion_edit',
            ],
            [
                'name' => 'Eliminar Evento de la Organización',
                'title' => 'eventos_organizacion_delete',
            ],
            // [
            //     'name' => 'Acceder a Lista de Comunicados de la Organización',
            //     'title' => 'comunicados_organizacion_access',
            // ],
            // [
            //     'name' => 'Agregar Comunicado de la Organización',
            //     'title' => 'comunicados_organizacion_create',
            // ],
            // [
            //     'name' => 'Visualizar Comunicado de la Organización',
            //     'title' => 'comunicados_organizacion_show',
            // ],
            // [
            //     'name' => 'Editar Comunicado de la Organización',
            //     'title' => 'comunicados_organizacion_edit',
            // ],
            // [
            //     'name' => 'Eliminar Comunicado de la Organización',
            //     'title' => 'comunicados_organizacion_delete',
            // ],
            //EV360
            [
                'name' => 'Acceder a Evaluación 360 grados',
                'title' => 'evaluacion_360_access',
            ],
            [
                'name' => 'Crear a Evaluación 360 grados',
                'title' => 'evaluacion_360_create',
            ],
            [
                'name' => 'Eliminar Evaluación 360 grados',
                'title' => 'evaluacion_360_delete',
            ],
            [
                'name' => 'Acceder a Seguimiento a Evaluación 360 grados',
                'title' => 'evaluacion_360_seguimiento_access',
            ],
            [
                'name' => 'Acceder a Configuración de la Evaluación 360 grados',
                'title' => 'evaluacion_360_configuracion_access',
            ],
            [
                'name' => 'Enviar Recordatorio sobre la Evaluación 360 grados',
                'title' => 'evaluacion_360_recordatorio_send',
            ],
            [
                'name' => 'Cerrar Evaluación 360 grados',
                'title' => 'evaluacion_360_close',
            ],
            [
                'name' => 'Reiniciar Evaluación 360 grados',
                'title' => 'evaluacion_360_reset',
            ],
            [
                'name' => 'Iniciar Evaluación 360 grados',
                'title' => 'evaluacion_360_start',
            ],
            [
                'name' => 'Visualizar Resúmen/Individual de la Evaluación 360 grados',
                'title' => 'evaluacion_360_resumen_individual_show',
            ],
            [
                'name' => 'Visualizar Resúmen/General de Evaluación 360 grados',
                'title' => 'evaluacion_360_resumen_general_show',
            ],
            // ANALISIS DE RIESGOS
            [
                'name' => 'Acceder a Análisis de Riesgos',
                'title' => 'analisis_de_riesgos_access',
            ],
            [
                'name' => 'Acceder a Amenazas - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_amenazas_access',
            ],
            [
                'name' => 'Agregar Amenaza - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_amenazas_create',
            ],
            [
                'name' => 'Editar Amenaza - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_amenazas_edit',
            ],
            [
                'name' => 'Visualizar Amenaza - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_amenazas_show',
            ],
            [
                'name' => 'Eliminar Amenaza - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_amenazas_delete',
            ],
            [
                'name' => 'Acceder a Vulnerabilidades - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_vulnerabilidades_access',
            ],
            [
                'name' => 'Agregar Vulnerabilidad - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_vulnerabilidades_create',
            ],
            [
                'name' => 'Editar Vulnerabilidad - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_vulnerabilidades_edit',
            ],
            [
                'name' => 'Visualizar Vulnerabilidad - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_vulnerabilidades_show',
            ],
            [
                'name' => 'Eliminar Vulnerabilidad - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_vulnerabilidades_delete',
            ],
            [
                'name' => 'Acceder a Matríz de Riesgos - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_access',
            ],
            [
                'name' => 'Agregar Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_create',
            ],
            [
                'name' => 'Editar Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_edit',
            ],
            [
                'name' => 'Visualizar Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_show',
            ],
            [
                'name' => 'Eliminar Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_delete',
            ],
            [
                'name' => 'Configurar Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_config',
            ],
            [
                'name' => 'Agregar Análisis de Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_analisis_create',
            ],
            [
                'name' => 'Visualizar Análisis de Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_config_show',
            ],
            [
                'name' => 'Editar Análisis de Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_config_edit',
            ],
            [
                'name' => 'Eliminar Análisis de Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_config_delete',
            ],
            [
                'name' => 'Visualizar Gráfica de Análisis de Matríz de Riesgo - Análisis de Riegos',
                'title' => 'analisis_de_riesgos_matriz_riesgo_analisis_grafica_show',
            ],
            //CARGA MASIVA DE DATOS
            [
                'name' => 'Cargar Datos Masivamente',
                'title' => 'carga_masiva_de_datos_access',
            ],
            // MI ORGANIZACION
            [
                'name' => 'Crear Organización',
                'title' => 'organizacion_create',
            ],
            [
                'name' => 'Ediar Organización',
                'title' => 'organizacion_edit',
            ],
            [
                'name' => 'Visualizar Organización',
                'title' => 'organizacion_show',
            ],
            [
                'name' => 'Eliminar Organización',
                'title' => 'organizacion_delete',
            ],
            [
                'name' => 'Acceder a Organización',
                'title' => 'organizacion_access',
            ],
            [
                'name' => 'Acceder a Áreas de la Organización',
                'title' => 'organizacion_area_access',
            ],
            [
                'name' => 'Acceder a Sedes de la Organización',
                'title' => 'organizacion_sede_access',
            ],
            //SEDES
            [
                'name' => 'Crear Sede',
                'title' => 'configuracion_sede_create',
            ],
            [
                'name' => 'Editar Sede',
                'title' => 'configuracion_sede_edit',
            ],
            [
                'name' => 'Visualizar Sede',
                'title' => 'configuracion_sede_show',
            ],
            [
                'name' => 'Editar Sede',
                'title' => 'configuracion_sede_delete',
            ],
            [
                'name' => 'Acceder Sede',
                'title' => 'configuracion_sede_access',
            ],
            // AREAS
            [
                'name' => 'Crear Area',
                'title' => 'configuracion_area_create',
            ],
            [
                'name' => 'Editar Area',
                'title' => 'configuracion_area_edit',
            ],
            [
                'name' => 'Visualizar Area',
                'title' => 'configuracion_area_show',
            ],
            [
                'name' => 'Eliminar Area',
                'title' => 'configuracion_area_delete',
            ],
            [
                'name' => 'Acceder a las Areas',
                'title' => 'configuracion_area_access',
            ],
            // ORGANIGRAMA
            [
                'name' => 'Acceder a Organigrama',
                'title' => 'organigrama_organizacion_access',
            ],
            // MAPA DE PROCESOS
            [
                'name' => 'Acceder a Mapa de Procesos',
                'title' => 'mapa_procesos_organizacion_access',
            ],
            //DASHBOARD
            [
                'name' => 'Acceder a Dashboard',
                'title' => 'dashboard_access',
            ],
            //DOCUMENTOS
            [
                'name' => 'Acceder a Lista de Documentos Publicados',
                'title' => 'documentos_publicados_lista_access',
            ],
            [
                'name' => 'Acceder a Repositorio de Documentos Publicados',
                'title' => 'documentos_publicados_respositorio_access',
            ],
            [
                'name' => 'Acceder a Repositorio de Documentos en Aprobación',
                'title' => 'documentos_aprobacion_respositorio_access',
            ],
            [
                'name' => 'Acceder a Repositorio de Documentos Obsoletos',
                'title' => 'documentos_obsoletos_respositorio_access',
            ],
            [
                'name' => 'Acceder a Repositorio de Documentos Versiones Anteriores',
                'title' => 'documentos_versiones_anteriores_respositorio_access',
            ],
            //AGENDA
            [
                'name' => 'Acceder a Agenda',
                'title' => 'agenda_access',
            ],
            //CENTRO DE ATENCIÓN
            [
                'name' => 'Acceder a Centro de Atención',
                'title' => 'centro_atencion_access',
            ],
            [
                'name' => 'Acceder a Incidentes de Seguridad',
                'title' => 'incidentes_seguridad_access',
            ],
            [
                'name' => 'Crear Incidentes de Seguridad',
                'title' => 'incidentes_seguridad_create',
            ],
            [
                'name' => 'Editar Incidentes de Seguridad',
                'title' => 'incidentes_seguridad_edit',
            ], [
                'name' => 'Eliminar Incidentes de Seguridad',
                'title' => 'incidentes_seguridad_delete',
            ],
            [
                'name' => 'Acceder a Riesgos',
                'title' => 'riesgos_access',
            ],
            [
                'name' => 'Crear Riesgos',
                'title' => 'riesgos_create',
            ],
            [
                'name' => 'Editar Riesgos',
                'title' => 'riesgos_edit',
            ], [
                'name' => 'Eliminar Riesgos',
                'title' => 'riesgos_delete',
            ],
            [
                'name' => 'Acceder a Quejas',
                'title' => 'quejas_access',
            ],
            [
                'name' => 'Crear Quejas',
                'title' => 'quejas_create',
            ],
            [
                'name' => 'Editar Quejas',
                'title' => 'quejas_edit',
            ], [
                'name' => 'Eliminar Quejas',
                'title' => 'quejas_delete',
            ],
            [
                'name' => 'Acceder a Denuncias',
                'title' => 'denuncias_access',
            ],
            [
                'name' => 'Crear Denuncias',
                'title' => 'denuncias_create',
            ],
            [
                'name' => 'Editar Denuncias',
                'title' => 'denuncias_edit',
            ],
            [
                'name' => 'Eliminar Denuncias',
                'title' => 'denuncias_delete',
            ],
            [
                'name' => 'Acceder a Mejoras',
                'title' => 'mejoras_access',
            ],
            [
                'name' => 'Crear Mejoras',
                'title' => 'mejoras_create',
            ],
            [
                'name' => 'Editar Mejoras',
                'title' => 'mejoras_edit',
            ], [
                'name' => 'Eliminar Mejoras',
                'title' => 'mejoras_delete',
            ],
            [
                'name' => 'Acceder a Sugerencias',
                'title' => 'sugerencias_access',
            ],
            [
                'name' => 'Crear Sugerencias',
                'title' => 'sugerencias_create',
            ],
            [
                'name' => 'Editar Sugerencias',
                'title' => 'sugerencias_edit',
            ], [
                'name' => 'Eliminar Sugerencias',
                'title' => 'sugerencias_delete',
            ],
            //CONTÁCTANOS
            [
                'name' => 'Acceder a Contáctanos',
                'title' => 'contactanos_access',
            ],
            //GLOSARIO
            [
                'name' => 'Crear Glosario',
                'title' => 'glosario_create',
            ],
            [
                'name' => 'Editar Glosario',
                'title' => 'glosario_edit',
            ],
            [
                'name' => 'Visualizar Glosario',
                'title' => 'glosario_show',
            ],
            [
                'name' => 'Eliminar Glosario',
                'title' => 'glosario_delete',
            ],
            [
                'name' => 'Acceder a Glosario',
                'title' => 'glosario_access',
            ],
            // ANALISIS DE RIESGOS
            [
                'name' => 'Crear Matríz de Riesgo',
                'title' => 'matriz_riesgo_create',
            ],
            [
                'name' => 'Editar Matríz de Riesgo',
                'title' => 'matriz_riesgo_edit',
            ],
            [
                'name' => 'Visualizar Matríz de Riesgo',
                'title' => 'matriz_riesgo_show',
            ],
            [
                'name' => 'Eliminar Matríz de Riesgo',
                'title' => 'matriz_riesgo_delete',
            ],
            [
                'name' => 'Acceder a Matríz de Riesgo',
                'title' => 'matriz_riesgo_access',
            ],
            [
                'name' => 'Acceder a Normas',
                'title' => 'normas_access',
            ],
            // ISO 27001
            [
                'name' => 'Acceder a ISO 27001',
                'title' => 'isoveinticieteuno_access',
            ],
            [
                'name' => 'Acceder a Contexto',
                'title' => 'contexto_access',
            ],
            [
                'name' => 'Acceder a Análisis de Brechas',
                'title' => 'analisis_brechas_access',
            ],
            [
                'name' => 'Acceder a Plan de Implementación',
                'title' => 'implementacion_access',
            ],
            [
                'name' => ' Modificar Plan de Implementación',
                'title' => 'implementacion_modify',
            ],
            [
                'name' => ' Acceder Declaración de Aplicabilidad',
                'title' => 'declaracion_aplicabilidad_access',
            ],
            [
                'name' => ' Generar Reporte Declaración de Aplicabilidad',
                'title' => 'declaracion_aplicabilidad_reporte',
            ],
            [
                'name' => 'Crear Partes Interesadas',
                'title' => 'partes_interesada_create',
            ],
            [
                'name' => 'Editar Partes Interesadas',
                'title' => 'partes_interesada_edit',
            ],
            [
                'name' => 'Visualizar Partes Interesadas',
                'title' => 'partes_interesada_show',
            ],
            [
                'name' => 'Eliminar Partes Interesadas',
                'title' => 'partes_interesada_delete',
            ],
            [
                'name' => 'Acceder Partes Interesadas',
                'title' => 'partes_interesada_access',
            ],
            [
                'name' => 'Crear Matríz de Requisitos Legales',
                'title' => 'matriz_requisito_legale_create',
            ],
            [
                'name' => 'Editar Matríz de Requisitos Legales',
                'title' => 'matriz_requisito_legale_edit',
            ],
            [
                'name' => 'Visualizar Matríz de Requisitos Legales',
                'title' => 'matriz_requisito_legale_show',
            ],
            [
                'name' => 'Eliminar Matríz de Requisitos Legales',
                'title' => 'matriz_requisito_legale_delete',
            ],
            [
                'name' => 'Acceder Matríz de Requisitos Legales',
                'title' => 'matriz_requisito_legale_access',
            ],
            [
                'name' => 'Acceder a Entendimiento de la Organización',
                'title' => 'entendimiento_organizacion_access',
            ],
            [
                'name' => 'Crear Entendimiento de Organización',
                'title' => 'entendimiento_organizacion_create',
            ],
            [
                'name' => 'Editar Entendimiento de Organización',
                'title' => 'entendimiento_organizacion_edit',
            ],
            [
                'name' => 'Eliminar Entendimiento de Organización',
                'title' => 'entendimiento_organizacion_delete',
            ],
            [
                'name' => 'Crear Alcance SGSI',
                'title' => 'alcance_sgsi_create',
            ],
            [
                'name' => 'Ediar Alcance SGSI',
                'title' => 'alcance_sgsi_edit',
            ],
            [
                'name' => 'Visualizar Alcance SGSI',
                'title' => 'alcance_sgsi_show',
            ],
            [
                'name' => 'Eliminar Alcance SGSI',
                'title' => 'alcance_sgsi_delete',
            ],
            [
                'name' => 'Acceder al Alcance SGSI',
                'title' => 'alcance_sgsi_access',
            ],
            [
                'name' => 'Acceder a Reportes de Contexto',
                'title' => 'reportes_contexto_access',
            ],
            [
                'name' => 'Generar Reportes de Contexto',
                'title' => 'reportes_contexto_generate',
            ],
            //Liderazgo
            [
                'name' => 'Acceder a Liderazgo',
                'title' => 'liderazgo_access',
            ],
            [
                'name' => 'Crear Comite de Seguridad',
                'title' => 'comiteseguridad_create',
            ],
            [
                'name' => 'Editar Comite de Seguridad',
                'title' => 'comiteseguridad_edit',
            ],
            [
                'name' => 'Visualizar Comite de Seguridad',
                'title' => 'comiteseguridad_show',
            ],
            [
                'name' => 'Eliminar Comite de Seguridad',
                'title' => 'comiteseguridad_delete',
            ],
            [
                'name' => 'Acceder Comite de Seguridad',
                'title' => 'comiteseguridad_access',
            ],
            [
                'name' => 'Crear Minutas Alta Dirección',
                'title' => 'minutasaltadireccion_create',
            ],
            [
                'name' => 'Editar Minutas Alta Dirección',
                'title' => 'minutasaltadireccion_edit',
            ],
            [
                'name' => 'Visualizar Minutas Alta Dirección',
                'title' => 'minutasaltadireccion_show',
            ],
            [
                'name' => 'Eliminar Minutas Alta Dirección',
                'title' => 'minutasaltadireccion_delete',
            ],
            [
                'name' => 'Acceder Minutas Alta Dirección',
                'title' => 'minutasaltadireccion_access',
            ],
            [
                'name' => 'Crear Evidencias SGSI',
                'title' => 'evidencias_sgsi_create',
            ],
            [
                'name' => 'Editar Evidencias SGSI',
                'title' => 'evidencias_sgsi_edit',
            ],
            [
                'name' => 'Visualizar Evidencias SGSI',
                'title' => 'evidencias_sgsi_show',
            ],
            [
                'name' => 'Eliminar Evidencias SGSI',
                'title' => 'evidencias_sgsi_delete',
            ],
            [
                'name' => 'Acceder Evidencias SGSI',
                'title' => 'evidencias_sgsi_access',
            ],
            [
                'name' => 'Crear Políticas SGSI',
                'title' => 'politica_sgsi_create',
            ],
            [
                'name' => 'Editar Políticas SGSI',
                'title' => 'politica_sgsi_edit',
            ],
            [
                'name' => 'Visualizar Políticas SGSI',
                'title' => 'politica_sgsi_show',
            ],
            [
                'name' => 'Eliminar Políticas SGSI',
                'title' => 'politica_sgsi_delete',
            ],
            [
                'name' => 'Acceder Políticas SGSI',
                'title' => 'politica_sgsi_access',
            ],
            [
                'name' => 'Crear Roles de Responsabilidades',
                'title' => 'roles_responsabilidade_create',
            ],
            [
                'name' => 'Editar Roles de Responsabilidades',
                'title' => 'roles_responsabilidade_edit',
            ],
            [
                'name' => 'Visualizar Roles de Responsabilidades',
                'title' => 'roles_responsabilidade_show',
            ],
            [
                'name' => 'Eliminar Roles de Responsabilidades',
                'title' => 'roles_responsabilidade_delete',
            ],
            [
                'name' => 'Acceder Roles de Responsabilidades',
                'title' => 'roles_responsabilidade_access',
            ],
            // PLANIFICACION
            [
                'name' => 'Acceder a Planificación',
                'title' => 'planificacion_access',
            ],
            [
                'name' => 'Crear Riesgos y Oportunidades',
                'title' => 'riesgosoportunidade_create',
            ],
            [
                'name' => 'Editar Riesgos y Oportunidades',
                'title' => 'riesgosoportunidade_edit',
            ],
            [
                'name' => 'Visualizar Riesgos y Oportunidades',
                'title' => 'riesgosoportunidade_show',
            ],
            [
                'name' => 'Eliminar Riesgos y Oportunidades',
                'title' => 'riesgosoportunidade_delete',
            ],
            [
                'name' => 'Acceder Riesgos y Oportunidades',
                'title' => 'riesgosoportunidade_access',
            ],
            [
                'name' => 'Crear Objetivos de Seguridad',
                'title' => 'objetivosseguridad_create',
            ],
            [
                'name' => 'Editar Objetivos de Seguridad',
                'title' => 'objetivosseguridad_edit',
            ],
            [
                'name' => 'Visualizar Objetivos de Seguridad',
                'title' => 'objetivosseguridad_show',
            ],
            [
                'name' => 'Eliminar Objetivos de Seguridad',
                'title' => 'objetivosseguridad_delete',
            ],
            [
                'name' => 'Acceder Objetivos de Seguridad',
                'title' => 'objetivosseguridad_access',
            ],
            // SOPORTE
            [
                'name' => 'Acceder a Soporte',
                'title' => 'soporte_access',
            ],
            [
                'name' => 'Crear Recurso',
                'title' => 'recurso_create',
            ],
            [
                'name' => 'Editar Recurso',
                'title' => 'recurso_edit',
            ],
            [
                'name' => 'Visualizar Recurso',
                'title' => 'recurso_show',
            ],
            [
                'name' => 'Eliminar Recurso',
                'title' => 'recurso_delete',
            ],
            [
                'name' => 'Acceder Recurso',
                'title' => 'recurso_access',
            ],
            [
                'name' => 'Crear Competencia',
                'title' => 'competencium_create',
            ],
            [
                'name' => 'Editar Competencia',
                'title' => 'competencium_edit',
            ],
            [
                'name' => 'Visualizar Competencia',
                'title' => 'competencium_show',
            ],
            [
                'name' => 'Eliminar Competencia',
                'title' => 'competencium_delete',
            ],
            [
                'name' => 'Acceder Competencia',
                'title' => 'competencium_access',
            ],
            [
                'name' => 'Crear Concientización SGSI',
                'title' => 'concientizacion_sgi_create',
            ],
            [
                'name' => 'Editar Concientización SGSI',
                'title' => 'concientizacion_sgi_edit',
            ],
            [
                'name' => 'Visualizar Concientización SGSI',
                'title' => 'concientizacion_sgi_show',
            ],
            [
                'name' => 'Eliminar Concientización SGSI',
                'title' => 'concientizacion_sgi_delete',
            ],
            [
                'name' => 'Acceder Concientización SGSI',
                'title' => 'concientizacion_sgi_access',
            ],
            [
                'name' => 'Crear Material SGSI',
                'title' => 'material_sgsi_create',
            ],
            [
                'name' => 'Editar Material SGSI',
                'title' => 'material_sgsi_edit',
            ],
            [
                'name' => 'Visualizar Material SGSI',
                'title' => 'material_sgsi_show',
            ],
            [
                'name' => 'Eliminar Material SGSI',
                'title' => 'material_sgsi_delete',
            ],
            [
                'name' => 'Acceder Material SGSI',
                'title' => 'material_sgsi_access',
            ],
            [
                'name' => 'Crear Material ISO 27001',
                'title' => 'material_iso_veinticiente_create',
            ],
            [
                'name' => 'Editar Material ISO 27001',
                'title' => 'material_iso_veinticiente_edit',
            ],
            [
                'name' => 'Visualizar Material ISO 27001',
                'title' => 'material_iso_veinticiente_show',
            ],
            [
                'name' => 'Eliminar Material ISO 27001',
                'title' => 'material_iso_veinticiente_delete',
            ],
            [
                'name' => 'Acceder Material ISO 27001',
                'title' => 'material_iso_veinticiente_access',
            ],
            [
                'name' => 'Crear Comunicación SGSI',
                'title' => 'comunicacion_sgi_create',
            ],
            [
                'name' => 'Editar Comunicación SGSI',
                'title' => 'comunicacion_sgi_edit',
            ],
            [
                'name' => 'Visualizar Comunicación SGSI',
                'title' => 'comunicacion_sgi_show',
            ],
            [
                'name' => 'Eliminar Comunicación SGSI',
                'title' => 'comunicacion_sgi_delete',
            ],
            [
                'name' => 'Acceder Comunicación SGSI',
                'title' => 'comunicacion_sgi_access',
            ],
            [
                'name' => 'Acceder Política del SGSI Soporte',
                'title' => 'politica_del_sgsi_soporte_access',
            ],
            [
                'name' => 'Crear Control de Acceso',
                'title' => 'control_acceso_create',
            ],
            [
                'name' => 'Editar Control de Acceso',
                'title' => 'control_acceso_edit',
            ],
            [
                'name' => 'Visualizar Control de Acceso',
                'title' => 'control_acceso_show',
            ],
            [
                'name' => 'Eliminar Control de Acceso',
                'title' => 'control_acceso_delete',
            ],
            [
                'name' => 'Acceder a Control de Acceso',
                'title' => 'control_acceso_access',
            ],
            [
                'name' => 'Crear Información Documentada',
                'title' => 'informacion_documetada_create',
            ],
            [
                'name' => 'Editar Información Documentada',
                'title' => 'informacion_documetada_edit',
            ],
            [
                'name' => 'Visualizar Información Documentada',
                'title' => 'informacion_documetada_show',
            ],
            [
                'name' => 'Eliminar Información Documentada',
                'title' => 'informacion_documetada_delete',
            ],
            [
                'name' => 'Acceder Información Documentada',
                'title' => 'informacion_documetada_access',
            ],
            // OPERACIÓN
            [
                'name' => 'Acceder a operación',
                'title' => 'operacion_access',
            ],
            [
                'name' => 'Crear Planificación de Control',
                'title' => 'planificacion_control_create',
            ],
            [
                'name' => 'Editar Planificación de Control',
                'title' => 'planificacion_control_edit',
            ],
            [
                'name' => 'Visualizar Planificación de Control',
                'title' => 'planificacion_control_show',
            ],
            [
                'name' => 'Eliminar Planificación de Control',
                'title' => 'planificacion_control_delete',
            ],
            [
                'name' => 'Acceder a Planificación de Control',
                'title' => 'planificacion_control_access',
            ],
            [
                'name' => 'Crear Tratamiento de Riesgos',
                'title' => 'tratamiento_riesgo_create',
            ],
            [
                'name' => 'Editar Tratamiento de Riesgos',
                'title' => 'tratamiento_riesgo_edit',
            ],
            [
                'name' => 'Visualizar Tratamiento de Riesgos',
                'title' => 'tratamiento_riesgo_show',
            ],
            [
                'name' => 'Eliminar Tratamiento de Riesgos',
                'title' => 'tratamiento_riesgo_delete',
            ],
            [
                'name' => 'Acceder Tratamiento de Riesgos',
                'title' => 'tratamiento_riesgo_access',
            ],
            //EVALUACIÓN
            [
                'name' => 'Acceder a Evaluación',
                'title' => 'evaluacion_access',
            ],
            [
                'name' => 'Crear Indicadores SGSI',
                'title' => 'indicadores_sgsi_create',
            ],
            [
                'name' => 'Editar Indicadores SGSI',
                'title' => 'indicadores_sgsi_edit',
            ],
            [
                'name' => 'Visualizar Indicadores SGSI',
                'title' => 'indicadores_sgsi_show',
            ],
            [
                'name' => 'Eliminar Indicadores SGSI',
                'title' => 'indicadores_sgsi_delete',
            ],
            [
                'name' => 'Acceder a Indicadores SGSI',
                'title' => 'indicadores_sgsi_access',
            ],
            [
                'name' => 'Acceder a Indicador de Incidentes SGSI',
                'title' => 'indicadorincidentessi_access',
            ],
            [
                'name' => 'Crear Activo de Incidente de Seguridad',
                'title' => 'activo_incidentes_de_seguridad_create',
            ],
            [
                'name' => 'Editar Activo de Incidente de Seguridad',
                'title' => 'activo_incidentes_de_seguridad_edit',
            ],
            [
                'name' => 'Visualizar Activo de Incidente de Seguridad',
                'title' => 'activo_incidentes_de_seguridad_show',
            ],
            [
                'name' => 'Eliminar Activo de Incidente de Seguridad',
                'title' => 'activo_incidentes_de_seguridad_delete',
            ],
            [
                'name' => 'Acceder Activo de Incidente de Seguridad',
                'title' => 'activo_incidentes_de_seguridad_access',
            ],
            [
                'name' => 'Crear Auditoria Anual',
                'title' => 'auditoria_anual_create',
            ],
            [
                'name' => 'Editar Auditoria Anual',
                'title' => 'auditoria_anual_edit',
            ],
            [
                'name' => 'Visualizar Auditoria Anual',
                'title' => 'auditoria_anual_show',
            ],
            [
                'name' => 'Eliminar Auditoria Anual',
                'title' => 'auditoria_anual_delete',
            ],
            [
                'name' => 'Acceder a Auditoria Anual',
                'title' => 'auditoria_anual_access',
            ],
            [
                'name' => 'Crear Plan de Auditoria',
                'title' => 'plan_auditorium_create',
            ],
            [
                'name' => 'Editar Plan de Auditoria',
                'title' => 'plan_auditorium_edit',
            ],
            [
                'name' => 'Visualizar Plan de Auditoria',
                'title' => 'plan_auditorium_show',
            ],
            [
                'name' => 'Eliminar Plan de Auditoria',
                'title' => 'plan_auditorium_delete',
            ],
            [
                'name' => 'Acceder a Plan de Auditoria',
                'title' => 'plan_auditorium_access',
            ],
            [
                'name' => 'Crear Auditoria Interna',
                'title' => 'auditoria_interna_create',
            ],
            [
                'name' => 'Editar Auditoria Interna',
                'title' => 'auditoria_interna_edit',
            ],
            [
                'name' => 'Visualizar Auditoria Interna',
                'title' => 'auditoria_interna_show',
            ],
            [
                'name' => 'Eliminar Auditoria Interna',
                'title' => 'auditoria_interna_delete',
            ],
            [
                'name' => 'Acceder Auditoria Interna',
                'title' => 'auditoria_interna_access',
            ],
            [
                'name' => 'Crear Revisión de Dirección',
                'title' => 'revision_direccion_create',
            ],
            [
                'name' => 'Editar Revisión de Dirección',
                'title' => 'revision_direccion_edit',
            ],
            [
                'name' => 'Visualizar Revisión de Dirección',
                'title' => 'revision_direccion_show',
            ],
            [
                'name' => 'Eliminar Revisión de Dirección',
                'title' => 'revision_direccion_delete',
            ],
            [
                'name' => 'Acceder a Revisión de Dirección',
                'title' => 'revision_direccion_access',
            ],
            // MEJORA
            [
                'name' => 'Acceder a Mejora',
                'title' => 'mejora_access',
            ],
            [
                'name' => 'Crear Acción Correctiva',
                'title' => 'accion_correctiva_create',
            ],
            [
                'name' => 'Editar Acción Correctiva',
                'title' => 'accion_correctiva_edit',
            ],
            [
                'name' => 'Visualizar Acción Correctiva',
                'title' => 'accion_correctiva_show',
            ],
            [
                'name' => 'Eliminar Acción Correctiva',
                'title' => 'accion_correctiva_delete',
            ],
            [
                'name' => 'Acceder a Acción Correctiva',
                'title' => 'accion_correctiva_access',
            ],
            [
                'name' => 'Crear Registro de Mejora',
                'title' => 'registromejora_create',
            ],
            [
                'name' => 'Editar Registro de Mejora',
                'title' => 'registromejora_edit',
            ],
            [
                'name' => 'Visualizar Registro de Mejora',
                'title' => 'registromejora_show',
            ],
            [
                'name' => 'Eliminar Registro de Mejora',
                'title' => 'registromejora_delete',
            ],
            [
                'name' => 'Acceder a Registro de Mejora',
                'title' => 'registromejora_access',
            ],
            // CONTROLES ISO 27001
            //# ADMINISTRACIÓN ##
            //Documentos Administración
            [
                'name' => 'Crear Documento',
                'title' => 'documentos_create',
            ],
            [
                'name' => 'Editar Documento',
                'title' => 'documentos_edit',
            ],
            [
                'name' => 'Hacer Obsoleto un Documento',
                'title' => 'documentos_delete',
            ],
            [
                'name' => 'Visualizar Documento',
                'title' => 'documentos_show',
            ],
            [
                'name' => 'Descargar Documento',
                'title' => 'documentos_download',
            ],
            [
                'name' => 'Publicar Documento',
                'title' => 'documentos_publish',
            ],
            [
                'name' => 'Visualizar Revisiones del Documento',
                'title' => 'documentos_history_reviews',
            ],
            [
                'name' => 'Visualizar Versiones del Documento',
                'title' => 'documentos_versiones',
            ],
            [
                'name' => 'Acceder a Lista General de Documentos',
                'title' => 'documentos_access',
            ],
            [
                'name' => 'Crear Gestor Documental',
                'title' => 'carpetum_create',
            ],
            [
                'name' => 'Editar Gestor Documental',
                'title' => 'carpetum_edit',
            ],
            [
                'name' => 'Visualizar Gestor Documental',
                'title' => 'carpetum_show',
            ],
            [
                'name' => 'Eliminar Gestor Documental',
                'title' => 'carpetum_delete',
            ],
            [
                'name' => 'Acceder a Gestor Documental',
                'title' => 'carpetum_access',
            ],
            // EMPLEADOS
            [
                'name' => 'Crear Empleados',
                'title' => 'configuracion_empleados_create',
            ],
            [
                'name' => 'Editar Empleados',
                'title' => 'configuracion_empleados_edit',
            ],
            [
                'name' => 'Eliminar Empleados',
                'title' => 'configuracion_empleados_delete',
            ],
            [
                'name' => 'Visualizar Empleados',
                'title' => 'configuracion_empleados_show',
            ],
            [
                'name' => 'Visualizar Empleados',
                'title' => 'configuracion_empleados_access',
            ],

            //ACTIVOS CONFIG DATOS
            [
                'name' => 'Crear Tipo de Activo',
                'title' => 'configuracion_tipoactivo_create',
            ],
            [
                'name' => 'Editar Tipo de Activo',
                'title' => 'configuracion_tipoactivo_edit',
            ],
            [
                'name' => 'Visualizar Tipo de Activo',
                'title' => 'configuracion_tipoactivo_show',
            ],
            [
                'name' => 'Eliminar Tipo de Activo',
                'title' => 'configuracion_tipoactivo_delete',
            ],
            [
                'name' => 'Acceder Tipo de Activo',
                'title' => 'configuracion_tipoactivo_access',
            ],
            [
                'name' => 'Crear Activo',
                'title' => 'configuracion_activo_create',
            ],
            [
                'name' => 'Editar Activo',
                'title' => 'configuracion_activo_edit',
            ],
            [
                'name' => 'Visualizar Activo',
                'title' => 'configuracion_activo_show',
            ],
            [
                'name' => 'Eliminar Activo',
                'title' => 'configuracion_activo_delete',
            ],
            [
                'name' => 'Acceder Activo',
                'title' => 'configuracion_activo_access',
            ],
            // PROCESOS
            [
                'name' => 'Crear Macroproceso',
                'title' => 'configuracion_macroproceso_create',
            ],
            [
                'name' => 'Editar Macroproceso',
                'title' => 'configuracion_macroproceso_edit',
            ],
            [
                'name' => 'Visualizar Macroproceso',
                'title' => 'configuracion_macroproceso_show',
            ],
            [
                'name' => 'Eliminar Macroproceso',
                'title' => 'configuracion_macroproceso_delete',
            ],
            [
                'name' => 'Acceder Macroproceso',
                'title' => 'configuracion_macroproceso_access',
            ],
            [
                'name' => 'Acceder a Procesos',
                'title' => 'configuracion_procesos_access',
            ],
            [
                'name' => 'Crear a Procesos',
                'title' => 'configuracion_procesos_create',
            ],
            [
                'name' => 'Editar Proceso',
                'title' => 'configuracion_procesos_edit',
            ],
            [
                'name' => 'Visualizar Proceso',
                'title' => 'configuracion_procesos_show',
            ],
            [
                'name' => 'Eliminar Proceso',
                'title' => 'configuracion_procesos_delete',
            ],
            // AJUSTES
            [
                'name' => 'Acceso de gestión de usuarios',
                'title' => 'user_management_access',
            ],
            [
                'name' => 'Crear Permisos',
                'title' => 'permission_create',
            ],
            [
                'name' => 'Editar Permisos',
                'title' => 'permission_edit',
            ],
            [
                'name' => 'Visualizar Permisos',
                'title' => 'permission_show',
            ],
            [
                'name' => 'Eliminar Permisos',
                'title' => 'permission_delete',
            ],
            [
                'name' => 'Acceder a Permisos',
                'title' => 'permission_access',
            ],
            [
                'name' => 'Crear Roles',
                'title' => 'role_create',
            ],
            [
                'name' => 'Editar Roles',
                'title' => 'role_edit',
            ],
            [
                'name' => 'Visualizar Roles',
                'title' => 'role_show',
            ],
            [
                'name' => 'Eliminar Roles',
                'title' => 'role_delete',
            ],
            [
                'name' => 'Acceder a Roles',
                'title' => 'role_access',
            ],
            [
                'name' => 'Crear Usuarios',
                'title' => 'user_create',
            ],
            [
                'name' => 'Editar Usuarios',
                'title' => 'user_edit',
            ],
            [
                'name' => 'Visualizar Usuarios',
                'title' => 'user_show',
            ],
            [
                'name' => 'Eliminar Usuarios',
                'title' => 'user_delete',
            ],
            [
                'name' => 'Acceder a Usuarios',
                'title' => 'user_access',
            ],
            [
                'name' => 'Crear Controles',
                'title' => 'controle_create',
            ],
            [
                'name' => 'Editar Controles',
                'title' => 'controle_edit',
            ],
            [
                'name' => 'Visualizar Controles',
                'title' => 'controle_show',
            ],
            [
                'name' => 'Eliminar Controles',
                'title' => 'controle_delete',
            ],
            [
                'name' => 'Acceder Controles',
                'title' => 'controle_access',
            ],
            [
                'name' => 'Visualizar Log del Sistema',
                'title' => 'audit_log_show',
            ],
            [
                'name' => 'Acceder a Log del Sistema',
                'title' => 'audit_log_access',
            ],
            [
                'name' => 'Crear Puesto',
                'title' => 'puesto_create',
            ],
            [
                'name' => 'Editar Puesto',
                'title' => 'puesto_edit',
            ],
            [
                'name' => 'Visualizar Puesto',
                'title' => 'puesto_show',
            ],
            [
                'name' => 'Eliminar Puesto',
                'title' => 'puesto_delete',
            ],
            [
                'name' => 'Acceder a Puestos',
                'title' => 'puesto_access',
            ],
            [
                'name' => 'Crear Alertas de Usuario',
                'title' => 'user_alert_create',
            ],
            [
                'name' => 'Visualizar Alertas de Usuario',
                'title' => 'user_alert_show',
            ],
            [
                'name' => 'Eliminar Alertas de Usuario',
                'title' => 'user_alert_delete',
            ],
            [
                'name' => 'Acceder Alertas de Usuario',
                'title' => 'user_alert_access',
            ],
            [
                'name' => 'Crear Enlaces de Ejecución',
                'title' => 'enlaces_ejecutar_create',
            ],
            [
                'name' => 'Editar Enlaces de Ejecución',
                'title' => 'enlaces_ejecutar_edit',
            ],
            [
                'name' => 'Visualizar Enlaces de Ejecución',
                'title' => 'enlaces_ejecutar_show',
            ],
            [
                'name' => 'Eliminar Enlaces de Ejecución',
                'title' => 'enlaces_ejecutar_delete',
            ],
            [
                'name' => 'Acceder a Enlaces de Ejecución',
                'title' => 'enlaces_ejecutar_access',
            ],
            [
                'name' => 'Crear Team',
                'title' => 'team_create',
            ],
            [
                'name' => 'Editar Team',
                'title' => 'team_edit',
            ],
            [
                'name' => 'Visualizar Team',
                'title' => 'team_show',
            ],
            [
                'name' => 'Eliminar Team',
                'title' => 'team_delete',
            ],
            [
                'name' => 'Acceder al Team',
                'title' => 'team_access',
            ],
            [
                'name' => 'Crear Estado de Incidente',
                'title' => 'estado_incidente_create',
            ],
            [
                'name' => 'Editar Estado de Incidente',
                'title' => 'estado_incidente_edit',
            ],
            [
                'name' => 'Visualizar Estado de Incidente',
                'title' => 'estado_incidente_show',
            ],
            [
                'name' => 'Eliminar Estado de Incidente',
                'title' => 'estado_incidente_delete',
            ],
            [
                'name' => 'Acceder a Estado de Incidente',
                'title' => 'estado_incidente_access',
            ],
            [
                'name' => 'Crear Estatus Plan de Trabajo',
                'title' => 'estatus_plan_trabajo_create',
            ],
            [
                'name' => 'Editar Estatus Plan de Trabajo',
                'title' => 'estatus_plan_trabajo_edit',
            ],
            [
                'name' => 'Visualizar Estatus Plan de Trabajo',
                'title' => 'estatus_plan_trabajo_show',
            ],
            [
                'name' => 'Eliminar Estatus Plan de Trabajo',
                'title' => 'estatus_plan_trabajo_delete',
            ],
            [
                'name' => 'Acceder a Estatus Plan de Trabajo',
                'title' => 'estatus_plan_trabajo_access',
            ],
            [
                'name' => 'Crear Estado de Documento',
                'title' => 'estado_documento_create',
            ],
            [
                'name' => 'Editar Estado de Documento',
                'title' => 'estado_documento_edit',
            ],
            [
                'name' => 'Visualizar Estado de Documento',
                'title' => 'estado_documento_show',
            ],
            [
                'name' => 'Eliminar Estado de Documento',
                'title' => 'estado_documento_delete',
            ],
            [
                'name' => 'Acceder a Estado de Documento',
                'title' => 'estado_documento_access',
            ],

            // FAQ
            [
                'name' => 'Acceder al Administrador FAQ',
                'title' => 'faq_management_access',
            ],
            [
                'name' => 'Crear Categoría FAQ',
                'title' => 'faq_category_create',
            ],
            [
                'name' => 'Editar Categoría FAQ',
                'title' => 'faq_category_edit',
            ],
            [
                'name' => 'Visualizar Categoría FAQ',
                'title' => 'faq_category_show',
            ],
            [
                'name' => 'Eliminar Categoría FAQ',
                'title' => 'faq_category_delete',
            ],
            [
                'name' => 'Acceder a Categoría FAQ',
                'title' => 'faq_category_access',
            ],
            [
                'name' => 'Crear Pregunta FAQ',
                'title' => 'faq_question_create',
            ],
            [
                'name' => 'Editar Pregunta FAQ',
                'title' => 'faq_question_edit',
            ],
            [
                'name' => 'Visualizar Pregunta FAQ',
                'title' => 'faq_question_show',
            ],
            [
                'name' => 'Eliminar Pregunta FAQ',
                'title' => 'faq_question_delete',
            ],
            [
                'name' => 'Acceder a Pregunta FAQ',
                'title' => 'faq_question_access',
            ],
            // GAP
            [
                'name' => 'Crear GAP Uno',
                'title' => 'gap_uno_create',
            ],
            [
                'name' => 'Editar GAP Uno',
                'title' => 'gap_uno_edit',
            ],
            [
                'name' => 'Visualizar GAP Uno',
                'title' => 'gap_uno_show',
            ],
            [
                'name' => 'Eliminar GAP Uno',
                'title' => 'gap_uno_delete',
            ],
            [
                'name' => 'Acceder a GAP Uno',
                'title' => 'gap_uno_access',
            ],
            [
                'name' => 'Crear GAP Dos',
                'title' => 'gap_do_create',
            ],
            [
                'name' => 'Editar GAP Dos',
                'title' => 'gap_do_edit',
            ],
            [
                'name' => 'Visualizar GAP Dos',
                'title' => 'gap_do_show',
            ],
            [
                'name' => 'Eliminar GAP Dos',
                'title' => 'gap_do_delete',
            ],
            [
                'name' => 'Acceder a GAP Dos',
                'title' => 'gap_do_access',
            ],
            [
                'name' => 'Crear GAP Tres',
                'title' => 'gap_tre_create',
            ],
            [
                'name' => 'Editar GAP Tres',
                'title' => 'gap_tre_edit',
            ],
            [
                'name' => 'Visualizar GAP Tres',
                'title' => 'gap_tre_show',
            ],
            [
                'name' => 'Eliminar GAP Tres',
                'title' => 'gap_tre_delete',
            ],
            [
                'name' => 'Acceder a GAP Tres',
                'title' => 'gap_tre_access',
            ],

            // LISTA DE VERIFICACION
            [
                'name' => 'Acceder a Lista de Verificación',
                'title' => 'lista_de_verificacion_access',
            ],

            // CONTROL DE DOCUMENTOS
            [
                'name' => 'Crear Control de Documento',
                'title' => 'control_documento_create',
            ],
            [
                'name' => 'Editar Control de Documento',
                'title' => 'control_documento_edit',
            ],
            [
                'name' => 'Eliminar Control de Documento',
                'title' => 'control_documento_delete',
            ],
            [
                'name' => 'Acceder a Control de Documento',
                'title' => 'control_documento_access',
            ],
            [
                'name' => 'Editar Contraseña de Perfil',
                'title' => 'profile_password_edit',
            ],
            [
                'name' => 'Crear Grupo de Area',
                'title' => 'configuracion_grupoarea_create',
            ],
            [
                'name' => 'Editar Grupo de Area',
                'title' => 'configuracion_grupoarea_edit',
            ],
            [
                'name' => 'Visualizar Grupo de Area',
                'title' => 'configuracion_grupoarea_show',
            ],
            [
                'name' => 'Eliminar Grupo de Area',
                'title' => 'configuracion_grupoarea_delete',
            ],
            [
                'name' => 'Acceder al Grupo de Area',
                'title' => 'configuracion_grupoarea_access',
            ],
            [
                'name' => 'Visualizar Entendimiento de la Organización',
                'title' => 'entendimiento_organizacion_show',
            ],
            [
                'name' => 'Visualizar Ajustes',
                'title' => 'ajustes_access',
            ],
            [
                'name' => 'Visualizar Configuración de Datos',
                'title' => 'configuracion_datos_access',
            ],
            [
                'name' => 'Visualizar Consulta de Datos',
                'title' => 'consulta_access',
            ],
            [
                'name' => 'Acceder a Módulo de Administración',
                'title' => 'administracion_access',
            ],
            // SITEMAP
            // CHECAR ESTOS PERMISOS
            [
                'name' => 'Acceder a Mapa del Sitio',
                'title' => 'sitemap_access',
            ],
            [
                'name' => 'Acceder a ISO 22301',
                'title' => 'isoveintidostresuno_access',
            ],
            [
                'name' => 'Acceder a ISO 31000',
                'title' => 'isotreintaunmil_access',
            ],
            [
                'name' => 'Crear Plan de Actividades Base',
                'title' => 'plan_base_actividade_create',
            ],
            [
                'name' => 'Editar Plan de Actividades Base',
                'title' => 'plan_base_actividade_edit',
            ],
            [
                'name' => 'Visualizar Plan de Actividades Base',
                'title' => 'plan_base_actividade_show',
            ],
            [
                'name' => 'Eliminar Plan de Actividades Base',
                'title' => 'plan_base_actividade_delete',
            ],
            [
                'name' => 'Acceder Plan de Actividades Base',
                'title' => 'plan_base_actividade_access',
            ],
            [
                'name' => 'Adquirir ISO 22301',
                'title' => 'adquirirveintidostrecientosuno_access',
            ],
            [
                'name' => 'Adquirir ISO 22301',
                'title' => 'adquirirtreintaunmil_access',
            ],
            [
                'name' => 'Crear Organizaciones',
                'title' => 'organizacione_create',
            ],
            [
                'name' => 'Editar Organizaciones',
                'title' => 'organizacione_edit',
            ],
            [
                'name' => 'Visualizar Organizaciones',
                'title' => 'organizacione_show',
            ],
            [
                'name' => 'Eliminar Organizaciones',
                'title' => 'organizacione_delete',
            ],
            [
                'name' => 'Acceder a Organizaciones',
                'title' => 'organizacione_access',
            ],
            [
                'name' => 'Crear Plan de Acción Correctiva',
                'title' => 'planaccion_correctiva_create',
            ],
            [
                'name' => 'Editar Plan de Acción Correctiva',
                'title' => 'planaccion_correctiva_edit',
            ],
            [
                'name' => 'Visualizar Plan de Acción Correctiva',
                'title' => 'planaccion_correctiva_show',
            ],
            [
                'name' => 'Eliminar Plan de Acción Correctiva',
                'title' => 'planaccion_correctiva_delete',
            ],
            [
                'name' => 'Acceder a Plan de Acción Correctiva',
                'title' => 'planaccion_correctiva_access',
            ],
            [
                'name' => 'Crear DMAIC',
                'title' => 'dmaic_create',
            ],
            [
                'name' => 'Editar DMAIC',
                'title' => 'dmaic_edit',
            ],
            [
                'name' => 'Visualizar DMAIC',
                'title' => 'dmaic_show',
            ],
            [
                'name' => 'Eliminar DMAIC',
                'title' => 'dmaic_delete',
            ],
            [
                'name' => 'Acceder a DMAIC',
                'title' => 'dmaic_access',
            ],
            [
                'name' => 'Crear Plan de Mejora',
                'title' => 'plan_mejora_create',
            ],
            [
                'name' => 'Editar Plan de Mejora',
                'title' => 'plan_mejora_edit',
            ],
            [
                'name' => 'Visualizar Plan de Mejora',
                'title' => 'plan_mejora_show',
            ],
            [
                'name' => 'Eliminar Plan de Mejora',
                'title' => 'plan_mejora_delete',
            ],
            [
                'name' => 'Acceder a Plan de Mejora',
                'title' => 'plan_mejora_access',
            ],
            [
                'name' => 'Crear Archivo',
                'title' => 'archivo_create',
            ],
            [
                'name' => 'Editar Archivo',
                'title' => 'archivo_edit',
            ],
            [
                'name' => 'Visualizar Archivo',
                'title' => 'archivo_show',
            ],
            [
                'name' => 'Eliminar Archivo',
                'title' => 'archivo_delete',
            ],
            [
                'name' => 'Acceder a Archivo',
                'title' => 'archivo_access',
            ],
            [
                'name' => 'puede crear, editar y eliminar archivos en las carpetas del repositorio documental',
                'title' => 'documentador',
            ],
            [
                'name' => 'Acceder a Planes de accion',
                'title' => 'planes_accion_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
