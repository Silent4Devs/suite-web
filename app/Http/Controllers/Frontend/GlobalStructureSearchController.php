<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Url\Url;

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

    ]; // Quedó deprecado

    public function globalSearch(Request $request)
    {
        $term = $request->term;

        $routes = collect(\Route::getRoutes())->map(function ($route) {
            return $route->uri();
        });

        $rutas_admin = collect($routes)->filter(function ($route) {
            return Str::contains($route, 'admin');
        });

        $rutas_filtradas = collect($rutas_admin)->filter(function ($route) {
            if (
                ! Str::contains($route, '{') && ! Str::contains($route, 'destroy') && ! Str::contains($route, 'global')
                && ! Str::contains($route, 'quitar') && ! Str::contains($route, 'locked')
                && ! Str::contains($route, 'media') && ! Str::contains($route, 'save')
                && ! Str::contains($route, 'update')
                && ! Str::contains($route, 'create')
                && ! Str::contains($route, 'crear')
                && ! Str::contains($route, 'load')
                && ! Str::contains($route, 'export')
                && ! Str::contains($route, 'import')
                && ! Str::contains($route, 'cancel')
                && ! Str::contains($route, 'suscribir')
                && ! Str::contains($route, 'calificar')
                && ! Str::contains($route, 'registrar')
                && ! Str::contains($route, 'check')
                && ! Str::contains($route, 'descargar')
                && ! Str::contains($route, 'get')
                && ! Str::contains($route, 'relacionada')
                && ! Str::contains($route, 'store')
                && ! Str::contains($route, 'edit')
                && ! Str::contains($route, 'delete')
                && ! Str::contains($route, 'eliminar')
                && ! Str::contains($route, 'publish')
                && ! Str::contains($route, 'dependencies')
                && ! Str::contains($route, 'permissions')
                && $route !== 'admin/roles'
                && $route !== 'admin/selectIndicador'
                && $route !== 'admin/implementacions'
                && $route !== 'dmin/team-members'
                && $route !== 'admin/planaccion-correctivas'
                && $route !== 'admin/indicadorincidentessis' // Remover cuando se trabaje con otro iso
                && ! Str::contains($route, 'selectindicador')
                && ! Str::contains($route, 'vincular')
                && ! Str::contains($route, 'alerts')
                && ! Str::contains($route, 'archivo')
                && ! Str::contains($route, 'actividades')
                && ! Str::contains($route, 'bloqueo')
                && ! Str::contains($route, 'sgsisInsertar')
                && ! Str::contains($route, 'sgsisUpdate')
                && ! Str::contains($route, 'archivar')
                && ! Str::contains($route, 'desarchivar')
                && $route != 'admin/organizaciones'
            ) {
                return $route;
            }
        });

        $rutas = collect($rutas_filtradas)->map(function ($route) {
            return '/'.$route;
        })->unique();

        $rutas_arr = []; // Se guarda el array asociativo para filtrar por búsquedas

        foreach ($rutas as $ruta) {
            $ruta_admin = str_replace('/admin', '', $ruta);
            if ($ruta == '/admin') {
                $ruta_admin = $ruta;
            }

            $url = Url::fromString('https:/'.$ruta_admin);
            $clean_text = str_replace('-', '', str_replace('/', ' ', $url->getPath()));
            $title = str_replace('-', ' ', $url->getHost()).$clean_text;
            $title = str_replace('iso27001 ', 'ISO 27001', $title);
            if ($title == 'entendimiento organizacions ') {
                $title = 'Análisis FODA';
            }
            if ($title == 'minutasaltadireccions ') {
                $title = 'Minutas de Sesiones con Alta Dirección';
            }
            if ($title == 'politica del sgsi soportes ') {
                $title = 'Politica del SGSI Soporte';
            }
            if ($title == 'buscarCV ') {
                $title = 'Competencias';
            }
            if ($title == 'recursos ') {
                $title = 'Capacitaciones';
            }
            $title = str_replace('inicioUsuario', 'Mi Perfil', $title);
            $title = str_replace('organizacions', 'Mi Organización', $title);
            $title = str_replace('organizacion', 'de la organización', $title);
            $title = str_replace('grupoarea', 'Grupos de Areas', $title);
            $title = str_replace('jerarquia', 'jerarquía', $title);
            $title = str_replace('areas', 'Areas', $title);
            $title = str_replace('sgsis', 'SGSI', $title);
            if ($title == 'carpeta ') {
                $title = 'Gestor Documental';
            }
            if ($title == 'system calendar ') {
                $title = 'Agenda';
            }
            if ($title == 'desk ') {
                $title = 'Centro de Atención';
            }
            if ($title == 'matriz requisito legales ') {
                $title = 'Matríz de Requisitos Legales';
            }
            if ($title == 'matriz riesgos ') {
                $title = 'Matríz de Riesgos';
            }
            if ($title == 'matriz seguridad ') {
                $title = 'Matríz de Seguridad';
            }
            if ($title == 'matriz seguridadMapa ') {
                $title = 'Mapa de Matríz de Seguridad';
            }
            if ($title == 'activos ') {
                $title = 'Activos (Inventario)';
            }
            $title = str_replace('desk', '(Centro de Atención)', $title);
            $title = str_replace('seguridads', ' Seguridad', $title);
            $title = str_replace('soporte', 'Contáctanos', $title);
            $title = str_replace('vulnerabilidads', 'Vulnerabilidades', $title);
            $title = str_replace('vulnerabilidads', 'Vulnerabilidades', $title);
            $title = str_replace('planTrabajoBase', 'Plan de Trabajo Base', $title);
            $title = str_replace('plantTrabajoBase', 'Plan de Trabajo Base', $title);
            $title = str_replace('controls', 'Controles', $title);
            $title = str_replace('planificacion', 'Planificación', $title);
            $title = str_replace('anuals', 'Anual', $title);
            $title = str_replace('direccions', 'Direcciones', $title);
            $title = str_replace('registromejoras', 'Registro de Mejoras', $title);
            $title = str_replace('tipoactivos', 'Activos (Categorias)', $title);
            $title = str_replace('users', 'Usuarios', $title);
            $title = str_replace('trabajos', 'Trabajo', $title);
            $title = str_replace('sitemap', 'Mapa del Sitio', $title);
            $rutas_arr[Str::title($title)] = $ruta;
        }

        if ($term != null) {
            $filtered = array_filter($rutas_arr, function ($key) use ($term) {
                return Str::contains(Str::lower($key), Str::lower($term));
            }, ARRAY_FILTER_USE_KEY);

            if (count($filtered) > 10) {
                $filtered = array_slice($filtered, 0, 10);
            }

            return $filtered;
        } else {
            return 'Sin Datos';
        }
    }
}
