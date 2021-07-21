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
        'Documentos' => '/admin/documentos',
        'Crear Documentos' => '/admin/documentos/create',
        'Empleados' => '/admin/empleados',
    ];

    public function globalSearch(Request $request)
    {
        $term = $request->term;
        if ($term) {
            $filtered = array_filter($this->globalSearch, function ($value) use ($term) {
                return str_contains($value, $term);
            });
            return $filtered;
        }
    }
}
