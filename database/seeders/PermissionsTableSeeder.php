<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        Permission::truncate();
        /*$permissions = [
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
        ];*/

        $permissions1 = [
            // CONFIGURAR VISTAS
            [
                'title' => 'mi_perfil_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo "MI PERFIL", permite visualizar la opción "Mi perfil" en el menú del sistema',
            ],
            [
                'title' => 'mi_perfil_mis_datos_acceder',
                'name' => 'Este permiso consiste en darle acceso al usuario para acceder a la pestaña "MIS DATOS" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_perfil_profesional',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar su perfil profesional, esta opción se encuentra en la pestaña "MIS DATOS" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_perfil_de_puesto',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar su perfil de puesto, esta opción se encuentra en la pestaña "MIS DATOS" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_mi_expediente',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar su expediente profesional, esta opción se encuentra en la pestaña "MIS DATOS" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_mi_equipo',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar a su equipo de trabajo',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_mis_objetivos',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar sus objetivos',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_mis_activos',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar sus activos',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_mi_autoevaluacion',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar sus autoevaluaciones',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_mis_competencias',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar sus competencias',
            ],
            [
                'title' => 'mi_perfil_mis_datos_ver_mis_evaluaciones_a_realizar',
                'name' => 'Este permiso consiste en darle acceso al usuario para visualizar las evaluaciones que tiene que realizar',
            ],
            [
                'title' => 'mi_perfil_mi_calendario_acceder',
                'name' => 'Este permiso consiste en darle acceso al usuario para acceder a la pestaña "MI CALENDARIO" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_actividades_acceder',
                'name' => 'Este permiso consiste en darle acceso al usuario para acceder a la pestaña "MIS ACTIVIDADES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_aprobaciones_acceder',
                'name' => 'Este permiso consiste en darle acceso al usuario para acceder a la pestaña "MIS APROBACIONES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_capacitaciones_acceder',
                'name' => 'Este permiso consiste en darle acceso al usuario para acceder a la pestaña "MIS CAPACITACIONES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_reportes_acceder',
                'name' => 'Este permiso consiste en darle acceso al usuario para acceder a la pestaña "REPORTES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_reportes_realizar_reporte_de_incidente_de_seguridad',
                'name' => 'Este permiso consiste en darle acceso al usuario para poder levantar un reporte de incidente de seguridad desde la pestaña "REPORTES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado',
                'name' => 'Este permiso consiste en darle acceso al usuario para poder levantar un reporte de riesgo identificado desde la pestaña "REPORTES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_reportes_realizar_reporte_de_queja',
                'name' => 'Este permiso consiste en darle acceso al usuario para poder levantar un reporte de queja desde la pestaña "REPORTES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_reportes_realizar_reporte_de_denuncia',
                'name' => 'Este permiso consiste en darle acceso al usuario para poder levantar un reporte de denuncia desde la pestaña "REPORTES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_reportes_realizar_reporte_de_propuesta_de_mejora',
                'name' => 'Este permiso consiste en darle acceso al usuario para poder levantar un reporte propuesta de mejora desde la pestaña "REPORTES" en el módulo de "MI PERFIL"',
            ],
            [
                'title' => 'mi_perfil_mis_reportes_realizar_reporte_de_sugerencia',
                'name' => 'Este permiso consiste en darle acceso al usuario para poder levantar un reporte de sugerencia desde la pestaña "REPORTES" en el módulo de "MI PERFIL"',
            ],
            // Portal de comunicacion
            [
                'title' => 'portal_de_comunicaccion_acceder',
                'name' => 'Este permiso permite al usuario acceder al portal de comunicación',
            ],
            [
                'title' => 'portal_comunicacion_mostrar_comunicados',
                'name' => 'Este permiso permite al usuario visualizar los comunicados en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_documentos_publicados',
                'name' => 'Este permiso permite al usuario visualizar los documentos publicados en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_organizacion',
                'name' => 'Este permiso permite al usuario visualizar la opción "Organización" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_sedes',
                'name' => 'Este permiso permite al usuario visualizar la opción "Sedes" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_areas',
                'name' => 'Este permiso permite al usuario visualizar la opción "Áreas" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_mapa_de_procesos',
                'name' => 'Este permiso permite al usuario visualizar la opción "Mapa de Procesos" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_organigrama',
                'name' => 'Este permiso permite al usuario visualizar la opción "Organigrama" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_directorio',
                'name' => 'Este permiso permite al usuario visualizar la opción "Directorio" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_documentos',
                'name' => 'Este permiso permite al usuario visualizar la opción "Documentos" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_politicas',
                'name' => 'Este permiso permite al usuario visualizar la opción "Políticas" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_comites',
                'name' => 'Este permiso permite al usuario visualizar la opción "Comités" en el menú derecho de accesos directos en el portal de comunicación',
            ],
            [

                'title' => 'portal_comunicacion_mostrar_reportar',
                'name' => 'Este permiso permite al usuario visualizar la opción "Reportar" en el menú derecho de accesos directos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_nuevos_ingresos',
                'name' => 'Este permiso permite al usuario visualizar los nuevos ingresos en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_cumpleaños',
                'name' => 'Este permiso permite al usuario visualizar los cumpleaños en el portal de comunicación',
            ],

            [
                'title' => 'portal_comunicacion_mostrar_aniversarios',
                'name' => 'Este permiso permite al usuario visualizar los aniversarios en el portal de comunicación',
            ],
            // Time Sheet
            [
                'title' => 'timesheet_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "TIMESHEET", permite visualizar la opción "Timesheet" en el menú del sistema',
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
            // Calendario Organizacional
            [
                'title' => 'calendario_organizacional_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Calendario Organizacional", permite visualizar la opción "Calendario" en el menú del sistema',
            ],
            // Documentos Publicados
            [
                'title' => 'documentos_publicados_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Documentos", permite visualizar la opción "Documentos" en el menú del sistema',
            ],
            // Planes de Accion
            [
                'title' => 'planes_de_accion_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Planes de acción", permite visualizar la opción "Planes de acción" en el menú del sistema',
            ],

            [
                'title' => 'planes_de_accion_agregar',
                'name' => 'Este permiso permite al usuario realizar la acción de agregar nuevos planes de acción en el módulo de planes de acción',
            ],

            [
                'title' => 'planes_de_accion_editar',
                'name' => 'Este permiso permite al usuario realizar la acción de editar un plan de acción en el módulo de planes de acción',
            ],

            [
                'title' => 'planes_de_accion_eliminar',
                'name' => 'Este permiso permite al usuario realizar la acción de eliminar un plan de acción en el módulo de planes de acción',
            ],

            [
                'title' => 'planes_de_accion_visualizar_diagrama',
                'name' => 'Este permiso permite al usuario realizar la acción de visualizar diagrama del plan de acción en el módulo de planes de acción',
            ],
            //Centro de Atención
            [
                'title' => 'centro_de_atencion_acceder',
                'name' => 'Este permiso permite acceder al menú "Centro de Atención"',
            ],
            //Centro de Atención: Incidentes de Seguridad
            [
                'title' => 'centro_atencion_incidentes_de_seguridad_acceder',
                'name' => 'Este permiso permite al usuario acceder a"Incidentes de Seguridad" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_incidentes_de_seguridad_editar',
                'name' => 'Este permiso permite al usuario editar "Incidentes de Seguridad" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_incidentes_de_seguridad_eliminar',
                'name' => 'Este permiso permite al usuario eliminar un "Incidentes de Seguridad" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_incidentes_de_seguridad_ver',
                'name' => 'Este permiso permite al usuario ver "Incidentes de Seguridad" en el módulo de Centro de Atención',
            ],
            //Centro de Atención: Riesgos
            [
                'title' => 'centro_atencion_riesgos_acceder',
                'name' => 'Este permiso permite al usuario acceder a"Riesgos" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_riesgos_editar',
                'name' => 'Este permiso permite al usuario editar "Riesgos" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_riesgos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar un "Riesgos" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_riesgos_ver',
                'name' => 'Este permiso permite al usuario ver "Riesgos" en el módulo de Centro de Atención',
            ],
            //Centro de Atención: Quejas
            [
                'title' => 'centro_atencion_quejas_acceder',
                'name' => 'Este permiso permite al usuario acceder a "Quejas" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_quejas_editar',
                'name' => 'Este permiso permite al usuario editar "Quejas" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_quejas_eliminar',
                'name' => 'Este permiso permite al usuario eliminar "Quejas" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_quejas_ver',
                'name' => 'Este permiso permite al usuario ver "Quejas" en el módulo de Centro de Atención',
            ],
            //Centro de Atención: Quejas Clientes
            [
                'title' => 'centro_atencion_quejas_clientes_acceder',
                'name' => 'Ese permiso permite al usuario acceder al módulo de "Centro de Atención", a la vista "Queja Cliente"',

            ],
            [
                'title' => 'centro_atencion_quejas_clientes_agregar',
                'name' => 'Ese permiso permite al usuario acceder al módulo de "Centro de Atención", a la vista crear de "Queja Cliente"',

            ],
            [
                'title' => 'centro_atencion_quejas_cliente_editar',
                'name' => 'Ese permiso permite al usuario acceder al módulo de "Centro de Atención", a la vista edit de "Queja Cliente"',
            ],
            [
                'title' => 'centro_atencion_quejas_cliente_dashboard',
                'name' => 'Ese permiso permite al usuario acceder al módulo de "Centro de Atención", a la vista dashboard de "Queja Cliente"',

            ],
            //Centro de Atención: Denuncias
            [
                'title' => 'centro_atencion_denuncias_acceder',
                'name' => 'Este permiso permite al usuario acceder a "Denuncias" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_denuncias_editar',
                'name' => 'Este permiso permite al usuario editar "Denuncias" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_denuncias_eliminar',
                'name' => 'Este permiso permite al usuario eliminar "Denuncias" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_denuncias_ver',
                'name' => 'Este permiso permite al usuario ver "Denuncias" en el módulo de Centro de Atención',
            ],
            //Centro de Atención: Mejoras
            [
                'title' => 'centro_atencion_mejoras_acceder',
                'name' => 'Este permiso permite al usuario acceder a "Mejoras" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_mejoras_editar',
                'name' => 'Este permiso permite al usuario editar "Mejoras" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_mejoras_eliminar',
                'name' => 'Este permiso permite al usuario eliminar "Mejoras" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_mejoras_ver',
                'name' => 'Este permiso permite al usuario ver "Mejoras" en el módulo de Centro de Atención',
            ],
            //Centro de Atención: Sugerencias
            [
                'title' => 'centro_atencion_sugerencias_acceder',
                'name' => 'Este permiso permite al usuario acceder a "Sugerencias" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_sugerencias_editar',
                'name' => 'Este permiso permite al usuario editar "Sugerencias" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_sugerencias_eliminar',
                'name' => 'Este permiso permite al usuario eliminar  "Sugerencias" en el módulo de Centro de Atención',
            ],
            [
                'title' => 'centro_atencion_sugerencias_ver',
                'name' => 'Este permiso permite al usuario ver "Sugerencias" en el módulo de Centro de Atención',
            ],
            //Capital Humano
            [
                'title' => 'capital_humano_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Capital Humano", permite visualizar las pestañas (Empleados, Calendrario y Comunicación)',
            ],
            // Competencias
            [
                'title' => 'competencias_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Competecias"',
            ],
            [
                'title' => 'competencias_agregar',
                'name' => 'Este permiso permite al usuario crear "Competecias"',
            ],
            [
                'title' => 'competencias_editar',
                'name' => 'Este permiso permite al usuario editar "Competecias"',
            ],
            [
                'title' => 'competencias_eliminar',
                'name' => 'Este permiso permite al usuario eliminar "Competecias"',
            ],
            [
                'title' => 'competencias_show',
                'name' => 'Este permiso permite al usuario acceder a vista detallada  de "Competecias"',
            ],

            [
                'title' => 'perfiles_de_puesto_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Perfiles de Puesto", permite visualizar lo submodulos (Lista de Perfiles de Puesto, Compétencias por Puesto, Consulta de Perfiles de Puesto)',
            ],
            [
                'title' => 'lista_de_perfiles_de_puesto_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Lista de perfiles de puesto"',
            ],
            [
                'title' => 'lista_de_perfiles_de_puesto_agregar',
                'name' => 'Este permiso permite al usuario crear "Perfiles de puesto"',
            ],
            [
                'title' => 'lista_de_perfiles_de_puesto_editar',
                'name' => 'Este permiso permite al usuario editar "Perfiles de puesto"',
            ],
            [
                'title' => 'lista_de_perfiles_de_puesto_eliminar',
                'name' => 'Este permiso permite al usuario eliminar "Perfiles de puesto"',
            ],
            [
                'title' => 'lista_de_perfiles_de_puesto_show',
                'name' => 'Este permiso permite al usuario acceder a vista detallada  del "Perfil por puesto"',
            ],
            [
                'title' => 'lista_de_perfiles_de_puesto_asignar_competencias',
                'name' => 'Este permiso permite al usuario ingresar al modulo "Asignar competencia al puesto" para enlazar competencias',
            ],
            [
                'title' => 'competencias_por_puesto_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Competencias por puesto"',
            ],
            [
                'title' => 'competencias_por_puesto_agregar',
                'name' => 'Este permiso permite al usuario agregar "Competencias por puesto"',
            ],
            [
                'title' => 'competencias_por_puesto_editar',
                'name' => 'Este permiso permite al usuario editar "Competencias por puesto"',
            ],
            [
                'title' => 'competencias_por_puesto_eliminar',
                'name' => 'Este permiso permite al usuario eliminar "Competencias por puesto"',
            ],
            [
                'title' => 'lista_de_perfiles_de_puesto_agregar',
                'name' => 'Este permiso permite al usuario  enlazar competencias a los perfiles de puesto',
            ],
            [
                'title' => 'consulta_perfiles_de_puesto_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Consulta Perfiles de Puesto"',
            ],
            [
                'title' => 'bd_empleados_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "BD EMPLEADOS"',
            ],
            [
                'title' => 'bd_empleados_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'bd_empleados_ver',
                'name' => 'Este permiso permite al usuario ver detalles de un registro',
            ],
            [
                'title' => 'bd_empleados_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'bd_empleados_dar_de_baja',
                'name' => 'Este permiso permite al usuario dar de baja registros',
            ],
            [
                'title' => 'bd_empleados_configurar_vista_datos',
                'name' => 'Este permiso permite redirije al usuario al modulo "vista datos"',
            ],
            [
                'title' => 'bd_empleados_borrar_seleccionados',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'lista_de_documentos_empleados_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Lista de Documentos de Empleados"',
            ],
            [
                'title' => 'lista_de_documentos_empleados_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'lista_de_documentos_empleados_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'niveles_jerarquicos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Niveles Jerárquicos"',
            ],
            [
                'title' => 'niveles_jerarquicos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'niveles_jerarquicos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'niveles_jerarquicos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'niveles_jerarquicos_ver',
                'name' => 'Este permiso permite al usuario ver  registros',
            ],
            [
                'title' => 'tipos_de_contrato_para_empleados_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Tipos de contrato para empleados"',
            ],
            [
                'title' => 'tipos_de_contrato_para_empleados_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'tipos_de_contrato_para_empleados_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'tipos_de_contrato_para_empleados_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'tipos_de_contrato_para_empleados_ver',
                'name' => 'Este permiso permite al usuario ver  registros',
            ],
            [
                'title' => 'entidades_crediticeas_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Entidades crediticias"',
            ],
            [
                'title' => 'entidades_crediticeas_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'entidades_crediticeas_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'entidades_crediticeas_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'entidades_crediticeas_ver',
                'name' => 'Este permiso permite al usuario ver  registros',
            ],
            [
                'title' => 'objetivos_estrategicos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Objetivos Estratégicos"',
            ],
            [
                'title' => 'objetivos_estrategicos_agregar',
                'name' => 'Este permiso permite al usuario agregar  objetivos',
            ],
            [
                'title' => 'objetivos_estrategicos_copiar',
                'name' => 'Este permiso permite al usuario copiar registros',
            ],
            [
                'title' => 'objetivos_estrategicos_ver',
                'name' => 'Este permiso permite al usuario ver registros asociados',
            ],
            [
                'title' => 'objetivos_estrategicos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'perfiles_profesionales_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Perfiles Profesionales"',
            ],
            [
                'title' => 'organigrama_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Organigrama"',
            ],
            [
                'title' => 'capacitaciones_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Capacitaciones"',
            ],
            [
                'title' => 'capacitaciones_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'capacitaciones_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'capacitaciones_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'capacitaciones_ver',
                'name' => 'Este permiso permite al usuario ver  registros',
            ],
            [
                'title' => 'capacitaciones_categorias_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Categoria Capacitaciones"',
            ],
            [
                'title' => 'capacitaciones_categorias_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'capacitaciones_categorias_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'capacitaciones_categorias_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'capacitaciones_categorias_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'solicitudes_incidencias_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Solicitudes e Incidencias"',
            ],
            [
                'title' => 'beneficios_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Beneficios"',
            ],
            [
                'title' => 'calendario_corporativo_acceder',
                'name' => ' Este permiso permite al usuario acceder al módulo de "Calendario coorporativo"',
            ],
            [
                'title' => 'dias_festivos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Dias festivos"',
            ],
            [
                'title' => 'dias_festivos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'dias_festivos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'dias_festivos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'dias_festivos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'eventos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Eventos"',
            ],
            [
                'title' => 'eventos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'eventos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'eventos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'eventos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'comunicados_generales_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Comunicados Generales"',
            ],
            [
                'title' => 'comunicados_generales_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'comunicados_generales_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'comunicados_generales_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'comunicados_generales_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'crear_evaluacion_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Crear Evaluaciones"',
            ],
            [
                'title' => 'seguimiento_evaluaciones_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Seguimineto Evaluaciones"',
            ],
            [
                'title' => 'seguimiento_evaluaciones_crear',
                'name' => 'Este permiso permite al usuario crear evaluacion',
            ],
            [
                'title' => 'seguimiento_evaluaciones_evaluacion',
                'name' => 'Este permiso permite al usuario ver detalles de la evaluacion',
            ],
            [
                'title' => 'seguimiento_evaluaciones_grafica',
                'name' => 'Este permiso permite al usuario ver graficas de resultados generales de la evaluacion',
            ],
            [
                'title' => 'seguimiento_evaluaciones_eliminar',
                'name' => 'Este permiso permite al usuario eliminar evaluacion',
            ],
            [
                'title' => 'amenazas_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Amenazas"',
            ],
            [
                'title' => 'amenazas_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'amenazas_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'amenazas_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'amenazas_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'vulnerabilidades_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Vulnerabilidades"',
            ],
            [
                'title' => 'vulnerabilidades_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'vulnerabilidades_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'vulnerabilidades_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'vulnerabilidades_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'matriz_de_riesgo_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Matriz de Riesgo "',
            ],
            [
                'title' => 'matriz_de_riesgo_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'matriz_de_riesgo_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'matriz_de_riesgo_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'matriz_de_riesgo_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'matriz_de_riesgo_vinculo',
                'name' => 'Este permiso redirije al usuario a a submodulo la matriz creada',
            ],
            [
                'title' => 'iso_27001_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'iso_27001_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'iso_27001_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'iso_27001_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'analisis_de_riesgo_integral_acceder',
                'name' => 'Este permiso permite al usuario acceder al menú izquierdo "Análisis de Riesgo"',
            ],
            [
                'title' => 'analisis_de_riesgo_integral_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'analisis_de_riesgo_integral_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'analisis_de_riesgo_integral_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'analisis_de_riesgo_integral_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            //Sistema de Gestión Integral
            [
                'title' => 'sistema_de_gestion_acceder',
                'name' => 'Este permiso permite acceder al módulo "Sistema de Gestión"',
            ],
            [
                'title' => 'analisis_de_brechas_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Analisis de brechas "',
            ],
            [
                'title' => 'analisis_de_brechas_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'analisis_de_brechas_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'analisis_de_brechas_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'analisis_de_brechas_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'analisis_de_brechas_vinculo',
                'name' => 'Este permiso redirije al usuario a submodulo Analisis',
            ],
            [
                'title' => 'plan_de_implementacion_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Plan de Implementacion "',
            ],
            [
                'title' => 'plan_de_implementacion_Gantt',
                'name' => 'Este permiso habilita la vista Gantt',
            ],
            [
                'title' => 'plan_de_implementacion_Tabla',
                'name' => 'Este permiso habilita la vista Tabla',
            ],
            [
                'title' => 'plan_de_implementacion_Calendario',
                'name' => 'Este permiso habilita la vista Calendario',
            ],
            [
                'title' => 'plan_de_implementacion_Kanban',
                'name' => 'Este permiso habilita la vista Kanban',
            ],
            [
                'title' => 'partes_interesadas_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Partes Interesadas "',
            ],
            [
                'title' => 'partes_interesadas_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'partes_interesadas_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'partes_interesadas_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'partes_interesadas_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'matriz_requisitos_legales_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Matriz de requisitos legales y regulatorios"',
            ],
            [
                'title' => 'matriz_requisitos_legales_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'matriz_requisitos_legales_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'matriz_requisitos_legales_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'matriz_requisitos_legales_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'matriz_requisitos_legales_evaluar',
                'name' => 'Este permiso permite al evaluar el requisito',
            ],
            [
                'title' => 'analisis_foda_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Analisis FODA"',
            ],
            [
                'title' => 'analisis_foda_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'analisis_foda_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'analisis_foda_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'analisis_foda_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'analisis_foda_duplicar',
                'name' => 'Este permiso permite al usuario copiar un registro cargado previamente',
            ],
            [
                'title' => 'comformacion_comite_seguridad_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Conformacion Comité de Seguridad "',
            ],
            [
                'title' => 'comformacion_comite_seguridad_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'comformacion_comite_seguridad_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'comformacion_comite_seguridad_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'comformacion_comite_seguridad_ver',
                'name' => 'Este permiso permite al usuario ver detalles del registro',
            ],
            [
                'title' => 'comformacion_comite_seguridad_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Conformacion Comité de Seguridad "',
            ],
            [
                'title' => 'comformacion_comite_seguridad_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'comformacion_comite_seguridad_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'comformacion_comite_seguridad_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'comformacion_comite_seguridad_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'revision_por_direccion_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Revision por Dirección "',
            ],
            [
                'title' => 'revision_por_direccion_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'revision_por_direccion_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'revision_por_direccion_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'revision_por_direccion_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'revision_por_direccion_plan_accion',
                'name' => 'Este permiso redirije al plan de accion asociado',
            ],
            [
                'title' => 'revision_por_direccion_visualizar_revisiones',
                'name' => 'Este permiso permite al usuario ver detalle del estatus de la minuta',
            ],
            [
                'title' => 'evidencia_asignacion_recursos_sgsi_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Evidencia de Asignación de Recursos al SGSI"',
            ],
            [
                'title' => 'evidencia_asignacion_recursos_sgsi_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'evidencia_asignacion_recursos_sgsi_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'evidencia_asignacion_recursos_sgsi_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'evidencia_asignacion_recursos_sgsi_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'evidencia_asignacion_recursos_sgsi_ver_evidencia',
                'name' => 'Este permiso permite al usuario ver  evidencia del registro',
            ],
            [
                'title' => 'politica_sistema_gestion_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Política del Sistema de Gestión"',
            ],
            [
                'title' => 'politica_sistema_gestion_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'politica_sistema_gestion_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'politica_sistema_gestion_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'politica_sistema_gestion_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'politica_sistema_gestion_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Analisis de Riesgos"',
            ],
            [
                'title' => 'asignacion_de_controles_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Asignacion de controles"',
            ],
            [
                'title' => 'asignacion_de_controles_agregar_responsable',
                'name' => 'Este permiso permite al usuario agregar responsable',
            ],
            [
                'title' => 'asignacion_de_controles_agregar_aprobador',
                'name' => 'Este permiso permite al usuario agregar aprobador',
            ],
            [
                'title' => 'asignacion_de_controles_agregar_notificar',
                'name' => 'Este permiso permite al usuario notificar controles',
            ],
            [
                'title' => 'declaracion_de_aplicabilidad_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Declaracion de aplicabilidad"',
            ],
            [
                'title' => 'objetivos_del_sistema_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Objetivos del sistema "',
            ],
            [
                'title' => 'objetivos_del_sistema_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'objetivos_del_sistema_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'objetivos_del_sistema_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'objetivos_del_sistema_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'objetivos_del_sistema_vinculo',
                'name' => 'Este permiso redirije a "Evaluaciones Objetivos de seguridad"',
            ],
            [
                'title' => 'tranferencia_de_conocimeto_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Capacitaciones "',
            ],
            [
                'title' => 'competencias_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Perfiles profecionales "',
            ],
            [
                'title' => 'concientizacion_sgsi_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Concientización SGSI "',
            ],
            [
                'title' => 'concientizacion_sgsi_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'concientizacion_sgsi_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'concientizacion_sgsi_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'concientizacion_sgsi_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'concientizacion_sgsi_vinculos',
                'name' => 'Este permiso redirije a "Ver evidencias"',
            ],
            [
                'title' => 'material_sgsi_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Material SGSI "',
            ],
            [
                'title' => 'material_sgsi_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'material_sgsi_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'material_sgsi_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'material_sgsi_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'material_sgsi_vinculo',
                'name' => 'Este permiso redirije a "Ver evidencias"',
            ],
            [
                'title' => 'comunicados_generales_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Comunicados Generales"',
            ],
            [
                'title' => 'comunicados_generales_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'comunicados_generales_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'comunicados_generales_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'comunicados_generales_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'comunicados_generales_vinculo',
                'name' => 'Este permiso redirije a "Ver evidencias"',
            ],
            //Sistema de Gestión:Soporte
            [
                'title' => 'sistema_gestion_soporte_acceso',
                'name' => 'Este permiso permite al usuario acceder a la pestaña "Soporte" del módulo de Sistema de Gestión',
            ],
            [
                'title' => 'control_de_accesos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Control de accesos"',
            ],
            [
                'title' => 'control_de_accesos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'control_de_accesos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'control_de_accesos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'control_de_accesos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'control_de_accesos_vinculo',
                'name' => 'Este permiso redirije a "Ver evidencias"',
            ],
            [
                'title' => 'informacion_documentada_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Documentos de"',
            ],
            [
                'title' => 'informacion_documentada_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'planificacion_y_control_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Planificacion y Control"',
            ],
            //Sistema de gestión:Operacion
            [
                'title' => 'sistema_gestion_operacion_acceso',
                'name' => 'Este permiso permite al usuario acceder a la pestaña "Operacion" del módulo de Sistema de Gestión',
            ],
            [
                'title' => 'planificacion_y_control_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'planificacion_y_control_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'planificacion_y_control_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'planificacion_y_control_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'tratamiento_de_los_riesgos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Tratamiento de los Riesgos"',
            ],
            [
                'title' => 'tratamiento_de_los_riesgos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'tratamiento_de_los_riesgos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'tratamiento_de_los_riesgos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'tratamiento_de_los_riesgos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'sistema_gestion_evaluacion_acceso',
                'name' => 'Este permiso permite al usuario acceder a la pestaña "Evaluación" del módulo de Sistema de Gestión',
            ],
            [
                'title' => 'indicadores_sgsi_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Indicadores SGSI"',
            ],
            [
                'title' => 'indicadores_sgsi_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'indicadores_sgsi_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'indicadores_sgsi_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'indicadores_sgsi_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'indicadores_sgsi_vinculo',
                'name' => 'Este permiso redirije a "Ver indicadores"',
            ],
            [
                'title' => 'programa_anual_auditoria_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Programa anual de auditoria"',
            ],
            [
                'title' => 'programa_anual_auditoria_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'programa_anual_auditoria_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'programa_anual_auditoria_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'programa_anual_auditoria_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'plan_de_auditoria_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Plan de Auditoría"',
            ],
            [
                'title' => 'plan_de_auditoria_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'plan_de_auditoria_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'plan_de_auditoria_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'plan_de_auditoria_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'auditoria_interna_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Auditoría Interna"',
            ],
            [
                'title' => 'auditoria_interna_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'auditoria_interna_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'auditoria_interna_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'auditoria_interna_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'revision_por_direccion_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Revision por dirección"',
            ],
            [
                'title' => 'revision_por_direccion_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'revision_por_direccion_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'revision_por_direccion_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'revision_por_direccion_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            //MEJORA SISTEMA DE GESTIÓN
            [
                'title' => 'sistema_gestion_mejora_acceso',
                'name' => 'Este permiso permite al usuario acceder a la pestaña "Mejora" del módulo de Sistema de Gestión',
            ],
            [
                'title' => 'accion_correctiva_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Accion correctiva"',
            ],
            [
                'title' => 'accion_correctiva_crear',
                'name' => 'Este permiso permite al usuario crear una "Accion correctiva"',
            ],
            [
                'title' => 'accion_correctiva_editar',
                'name' => 'Este permiso permite al usuario editar una "Accion correctiva"',
            ],
            [
                'title' => 'accion_correctiva_eliminar',
                'name' => 'Este permiso permite al usuario eliminar una "Accion correctiva"',
            ],
            [
                'title' => 'accion_correctiva_show',
                'name' => 'Este permiso permite al usuario ver una "Accion correctiva"',
            ],
            [
                'title' => 'registro_mejora_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Rejistro Mejora"',
            ],
            [
                'title' => 'permisos_de_administracion_acceder',
                'name' => 'Este permiso permite al usuario visualizar en el menú izquierdo "Administración"',
            ],
            [
                'title' => 'carga_masiva_datos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Carga Masiva de Datos"',
            ],
            [
                'title' => 'configurar_organizacion_acceder',
                'name' => 'Este permiso permite al usuario acceder a la vista de menú izquierdo "Configurar Organización"',
            ],
            [
                'title' => 'mi_organizacion_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Mi Organizacion"',
            ],
            [
                'title' => 'mi_organizacion_panel_de_control',
                'name' => 'Este permiso redirije al usuario a "Habilitar/deshabilitar informacion de organizacion"',
            ],
            [
                'title' => 'mi_organizacion_editar_organizacion',
                'name' => 'Este permiso permite al usuario editar "Mi Organizacion"',
            ],
            [
                'title' => 'sedes_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Sedes"',
            ],
            [
                'title' => 'sedes_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'sedes_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'sedes_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'sedes_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'crear_grupo_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Crear Grupo"',
            ],
            [
                'title' => 'crear_grupo_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'crear_grupo_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'crear_grupo_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'crear_grupo_ver',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'crear_area_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Crear Area"',
            ],
            [
                'title' => 'crear_area_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'crear_area_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'crear_area_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'crear_area_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'macroprocesos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'macroprocesos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'macroprocesos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'macroprocesos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'procesos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Crear Procesos"',
            ],
            [
                'title' => 'procesos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'procesos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'procesos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'procesos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'procesos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Crear Procesos"',
            ],
            [
                'title' => 'procesos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'procesos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'procesos_elimnar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'procesos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'categoria_activos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Categoria Activos"',
            ],
            [
                'title' => 'categoria_activos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'categoria_activos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'categoria_activos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'categoria_activos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'subcategoria_activos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Subcategoria Activos"',
            ],
            [
                'title' => 'subcategoria_activos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'subcategoria_activos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'subcategoria_activos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'subcategoria_activos_ver',
                'name' => 'Este permiso permite al usuario ver detalles del registro',
            ],
            [
                'title' => 'inventario_activos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Inventario Activos"',
            ],
            [
                'title' => 'inventario_activos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'inventario_activos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'inventario_activos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'inventario_activos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'glosario_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Glosario"',
            ],
            [
                'title' => 'agregar_documento_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Agregar Documento"',
            ],
            [
                'title' => 'control_documentar_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Inventario Activos"',
            ],
            [
                'title' => 'control_documentar_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'control_documentar_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'control_documentar_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'control_documentar_visualizar_documento',
                'name' => 'Este permiso permite al usuario ver  documento',
            ],
            [
                'title' => 'control_documentar_visualizar_revisiones',
                'name' => 'Este permiso permite al usuario ver revisiones',
            ],
            [
                'title' => 'control_documentar_visualizar_versionamiento',
                'name' => 'Este permiso permite al usuario ver versiones',
            ],
            [
                'title' => 'repositorio_documental_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Repositorio Documental"',
            ],
            [
                'title' => 'puestos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Puestos"',
            ],
            [
                'title' => 'configurar_capital_humano',
                'name' => 'Este permiso permite al usuario acceder a la vista del menú izquierdo "Configurar Capital Humano"',
            ],
            [
                'title' => 'puestos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'puestos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'puestos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'puestos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'puestos_signar_competencias',
                'name' => 'Este permisoredirije al usuario al modulo "Asignar competencia al puesto"',
            ],
            [
                'title' => 'niveles_jerarquicos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Niveles Jerarquicos"',
            ],
            [
                'title' => 'niveles_jerarquicos_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'niveles_jerarquicos_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'niveles_jerarquicos_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'niveles_jerarquicos_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'empleados_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Empleados"',
            ],
            [
                'title' => 'empleados_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'empleados_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'empleados_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'empleados_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'empleados_borrar_varios',
                'name' => 'Este permiso permite al usuario eliminar varios registros',
            ],
            [
                'title' => 'empleados_configurar_vista_datos',
                'name' => 'Este permiso redirije al usuario al submodulo "Configurar Vistas -> Mis Datos"',
            ],
            [
                'title' => 'crear_categoria_acceder',
                'name' => 'Este permiso redirije al usuario al modulo de "Cpacitaciones-> Crear Categoria"',
            ],
            [
                'title' => 'crear_capacitacion_acceder',
                'name' => 'Este permiso redirije al usuario al modulo de "Cpacitaciones-> Crear Capacitacion"',
            ],
            [
                'title' => 'configurar_vista_mis_datos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Mis datos"',
            ],
            [
                'title' => 'configurar_vistas_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Mi Organizacion"',
            ],
            [
                'title' => 'ajustes_usuario_acceder',
                'name' => 'Este permiso le permite acceder a la vista del menú izquierdo "Ajustes de Usuario"',
            ],
            [
                'title' => 'permisos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Permisos"',
            ],
            [
                'title' => 'permisos_actualizar',
                'name' => 'Este permiso permite al usuario actualizar permisos',
            ],
            [
                'title' => 'roles_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Roles"',
            ],
            [
                'title' => 'roles_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'roles_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'roles_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'roles_ver',
                'name' => 'Este permiso permite al usuario ver detalles del registro',
            ],
            [
                'title' => 'roles_copiar',
                'name' => 'Este permiso permite al usuario copia valores de un registro',
            ],
            [
                'title' => 'usuarios_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Usuarios"',
            ],
            [
                'title' => 'usuarios_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'usuarios_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'usuarios_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'usuarios_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'usuarios_vincular_empleados',
                'name' => 'Este permiso permite al usuario vincular usario a un empleado',
            ],
            [
                'title' => 'usuarios_verificacion_dos_factores',
                'name' => 'Este permiso permite al usuario activar verificacion de dos factores',
            ],
            [
                'title' => 'usuarios_bloquear_usuario',
                'name' => 'Este permiso permite bloquear un usuario',
            ],
            [
                'title' => 'notificaciones_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Notificaciones"',
            ],
            [
                'title' => 'notificaciones_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'notificaciones_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'notificaciones_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'configurar_soporte_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Configurar Soporte"',
            ],
            [
                'title' => 'configurar_soporte_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'configurar_soporte_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'configurar_soporte_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'configurar_soporte_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'principal_glosario_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Glosario"',
            ],
            [
                'title' => 'principal_soporte_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Soporte"',
            ],
            [
                'title' => 'acceder_submenu_capacitaciones',
                'name' => 'Este permiso permite al usuario acceder al submenu de "Capacitaciones"',
            ],
            [
                'title' => 'menu_analisis_riesgo_acceder',
                'name' => 'Este permiso permite al usuario acceder al submenu de "Analisis de Amenazas"',
            ],
            [
                'title' => 'acceder_submenu_areas',
                'name' => 'Este permiso permite al usuario acceder al submenu "areas".',
            ],
            [
                'title' => 'acceder_submenu_mapa_procesos',
                'name' => 'Este permiso permite al usuario acceder al submenu "Mapa de Procesos".',
            ],
            [
                'title' => 'macroprocesos_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Crear Macroprocesos.',
            ],
            [
                'title' => 'acceder_submenu_activos',
                'name' => 'Este permiso permite al usuario acceder al submenu "Activos".',
            ],
            [
                'title' => 'determinacion_alcance_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Determinacion de Alcance"',
            ],
            [
                'title' => 'determinacion_alcance_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'determinacion_alcance_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'determinacion_alcance_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'determinacion_alcance_ver',
                'name' => 'Este permiso permite al usuario ver  detalles del registro',
            ],
            [
                'title' => 'evidencia_asignacion_recursos_sgsi_ver_evidencia',
                'name' => 'Este permiso permite al usuario ver  evidencia del registro',
            ],
            [
                'title' => 'mi_organizacion_agregar',
                'name' => 'Este permiso permite al usuario agregar registros',
            ],
            [
                'title' => 'mi_organizacion_editar',
                'name' => 'Este permiso permite al usuario editar registros',
            ],
            [
                'title' => 'mi_organizacion_eliminar',
                'name' => 'Este permiso permite al usuario eliminar registros',
            ],
            [
                'title' => 'mi_organizacion_ver',
                'name' => 'Este permiso permite al usuario ver registros',
            ],
            [
                'title' => 'agregar_documento_crear',
                'name' => 'Este permiso permite al usuario acceder al módulo de "Agregar Documento"',
            ],
            [
                'title' => 'sistema_de_gestion_contexto_acceder',
                'name' => 'Este permiso permite acceder al módulo "Sistema de Gestión-Contexto"',
            ],
            [
                'title' => 'sistema_de_gestion_liderazgo_acceder',
                'name' => 'Este permiso permite acceder al módulo "Sistema de Gestión-Liderazgo"',
            ],
            [
                'title' => 'sistema_de_gestion_planificacion_acceder',
                'name' => 'Este permiso permite acceder al módulo "Sistema de Gestión-Planificacion"',
            ],
            [
                'title' => 'sistema_de_gestion_soporte_acceder',
                'name' => 'Este permiso permite acceder al módulo "Sistema de Gestión-Soporte"',
            ],
            [
                'title' => 'sistema_de_gestion_operacion_acceder',
                'name' => 'Este permiso permite acceder al módulo "Sistema de Gestión-Operacion"',
            ],
            [
                'title' => 'sistema_de_gestion_evaluacion_acceder',
                'name' => 'Este permiso permite acceder al módulo "Sistema de Gestión-Evaluacion"',
            ],
            [
                'title' => 'sistema_de_gestion_mejora_acceder',
                'name' => 'Este permiso permite acceder al módulo "Sistema de Gestión-Mejora"',
            ],
            [
                'name' => 'Editar Contraseña de Perfil',
                'title' => 'profile_password_edit',
            ],
            [
                'name' => 'Agregar Carta de Aceptación Riesgo',
                'title' => 'carta_aceptacion_create',
            ],
            [
                'name' => 'Editar Carta de Aceptación Riesgo',
                'title' => 'carta_aceptacion_edit',
            ],
            [
                'name' => 'Visualizar Carta de Aceptación Riesgo',
                'title' => 'carta_aceptacion_show',
            ],
            [
                'name' => 'Eliminar Carta de Aceptación Riesgo',
                'title' => 'carta_aceptacion_delete',
            ],

            // Permisos Vacaciones

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

        // Permission::insert($permissions);
        Permission::insert($permissions1);
    }
}
