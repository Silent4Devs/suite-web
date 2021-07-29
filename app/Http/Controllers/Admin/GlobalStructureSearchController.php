<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GlobalStructureSearchController extends Controller
{
    // Estructura nombre_buscador => ruta
    protected $globalSearch = [
        'ISO27001' => '/admin/iso27001',
        'Soporte' => '/admin/soporte',
        'Inicio Usuario' => '/admin/inicioUsuario',
        'Inicio Usuario' => '/admin/inicioUsuario',
        'Reportes - Quejas' => '/admin/inicioUsuario/reportes/quejas',
        'Reportes - Denuncias' => '/admin/inicioUsuario/reportes/denuncias',
        'Reportes - Mejoras' => '/admin/inicioUsuario/reportes/mejoras',
        'Reportes - Sujerencias' => '/admin/inicioUsuario/reportes/sugerencias',
        'Reportes - Seguridad' => '/admin/inicioUsuario/reportes/seguridad',
        'Desk' => '/admin/desk',
        'Desk - Seguridad Archivo' => '/admin/desk/seguridad-archivo',
        'Desk - Seguridad' => '/admin/desk/seguridad',
        'Plan Trabajo Base' => '/admin/planTrabajoBase',
        'Home' => '/admin',
        'Análisis Brechas' => '/admin/analisis-brechas',
        'Declaración de Aplicabilidad' => '/admin/declaracion-aplicabilidad',
        'Diagrama Gantt' => '/admin/gantt',
        'Mapa Procesos' => '/admin/mapa-procesos',
        'Procesos' => '/admin/procesos',
        'Macroprocesos' => '/admin/macroprocesos',
        'Crear Macroprocesos' => '/admin/macroprocesos/create',
        'Usuarios' => '/admin/users',
        'Crear Usuarios' => '/admin/users/create',
        'Empleados' => '/admin/empleados',
        'Crear Empleados' => '/admin/empleados/create',
        'Organización' => '/admin/organizacions',
        'Crear Organización' => '/admin/organizacions/create',
        'Organigrama' => '/admin/organigrama',
        'Dashboard' => '/admin/dashboards',
        'Implementación' => '/admin/implementacions',
        'Glosarios' => '/admin/glosarios',
        'Crear Glosarios' => '/admin/glosarios/create',
        'Plan Base Actividades' => '/admin/plan-base-actividades',
        'Crear Plan Base Actividades' => '/admin/plan-base-actividades/create',
        'Entendimiento Organización' => '/admin/entendimiento-organizacions',
        'Partes Interesadas' => '/admin/partes-interesadas',
        'Crear Partes Interesadas' => '/admin/partes-interesadas/create',
        'Matriz Requisitos Legales' => '/admin/matriz-requisito-legales',
        'Crear Matriz Requisitos Legales' => '/admin/matriz-requisito-legales/create',
        'Alcance Sgsi' => '/admin/alcance-sgsis',
        'Crear Alcance Sgsi' => '/admin/alcance-sgsis/create',
        'Comite Seguridad' => '/admin/comiteseguridads',
        'Crear Comite Seguridad' => '/admin/comiteseguridads/create',
        'Minutas de Sesiones con Alta Dirección' => '/admin/minutasaltadireccions',
        'Crear Minutas de Sesiones con Alta Dirección' => '/admin/minutasaltadireccions/create',
        'Evidencias SGSI' => '/admin/evidencias-sgsis',
        'Crear Evidencias SGSI' => '/admin/evidencias-sgsis/create',
        'Politicas SGSI' => '/admin/politica-sgsis',
        'Crear Politicas SGSI' => '/admin/politica-sgsis/create',
        'Riesgos y Oportunidades' => '/admin/riesgosoportunidades',
        'Crear Riesgos y Oportunidades' => '/admin/riesgosoportunidades/create',
        'Objetivos de Seguridad' => '/admin/objetivosseguridads',
        'Crear Objetivos de Seguridad' => '/admin/objetivosseguridads/create',
        'Categoría Capacitación' => '/admin/categoria-capacitacion',
        'Recursos' => '/admin/recursos',
        'Crear Recursos' => '/admin/recursos/create',
        'Competencia' => '/admin/competencia',
        'Crear Competencia' => '/admin/competencia/create',
        'Consientización SGSI' => '/admin/concientizacion-sgis',
        'Crear Consientización SGSI' => '/admin/concientizacion-sgis/create',
        'Material SGSI' => '/admin/material-sgsis',
        'Crear Material SGSI' => '/admin/material-sgsis/create',
        'Material ISO 27001:2013' => '/admin/material-sgsis',
        'Crear Material ISO 27001:2013' => '/admin/material-sgsis/create',
        'Comunicación SGSI' => '/admin/comunicacion-sgis',
        'Crear Comunicación SGSI' => '/admin/comunicacion-sgis',
        'Politicas SGSI Soportes' => '/admin/politica-del-sgsi-soportes',
        'Información Documentada' => '/admin/informacion-documetadas',
        'Crear Información Documentada' => '/admin/informacion-documetadas/create',
        'Planificación Controles' => '/admin/planificacion-controls',
        'Crear Planificación Controles' => '/admin/planificacion-controls/create',
        'Activos' => '/admin/activos',
        'Crear Activos' => '/admin/activos/create',
        'Auditorias Internas' => '/admin/auditoria-internas',
        'Crear Auditorias Internas' => '/admin/auditoria-internas/create',
        'Revisión Direcciones' => '/admin/revision-direccions',
        'Crear Revisión Direcciones' => '/admin/revision-direccions/create',
        'Controles' => '/admin/controles',
        'Crear Controles' => '/admin/controles/create',
        'Areas' => '/admin/areas',
        'Crear Areas' => '/admin/areas/create',
        'Areas por Grupo' => '/admin/areas/grupo',
        'Areas por Jerarquía' => '/admin/areas/jerarquia',
        'Organizaciones' => '/admin/organizaciones',
        'Crear Organizaciones' => '/admin/organizaciones/create',
        'Grupos' => '/admin/grupoarea',
        'Crear Grupos' => '/admin/grupoarea/create',
        'Indicadores SGSI' => '/admin/indicadores-sgsis',
        'Crear Indicadores SGSI' => '/admin/indicadores-sgsis/create',
        'Auditoria Anual' => '/admin/auditoria-anuals',
        'Crear Auditoria Anual' => '/admin/auditoria-anuals/create',
        'Plan de auditoria' => '/admin/plan-auditoria',
        'Crear Plan de auditoria' => '/admin/plan-auditoria/create',
        'Acción Correctiva' => '/admin/accion-correctivas',
        'Crear Acción Correctiva' => '/admin/accion-correctivas/create',
        'Crear Plan de Acción Correctiva' => '/admin/plan-correctiva',
        'Registro de Mejoras' => '/admin/registromejoras',
        'Crear Registro de Mejoras' => '/admin/registromejoras/create',
        'Incidentes de Seguridad' => '/admin/incidentes-de-seguridads',
        'Crear Incidentes de Seguridad' => '/admin/incidentes-de-seguridads/create',
        'Gestor Documental' => '/admin/carpeta',
        'Agenda' => '/admin/system-calendar',
        'Matríz de Riesgos' => '/admin/matriz-riesgos',
        'Crear Matríz de Riesgos' => '/admin/matriz-riesgos/create',
        'Control de Documental' => '/admin/control-documentos',
        'Documentos' => '/admin/documentos',
        'Crear Documentos' => '/admin/documentos/create',
        'Empleados' => '/admin/empleados',
        'Crear Empleados' => '/admin/empleados/create',

    ];

    public function globalSearch(Request $request)
    {
        $term = $request->term;

        if ($term != null) {
            $filtered = array_filter($this->globalSearch, function ($value) use ($term) {
                return str_contains($value, $term);
            });

            if (count($filtered) > 10) {
                $filtered = array_slice($filtered, 0, 10);
            }
            return $filtered;
        } else {
            return "Sin Datos";
        }
    }
}
