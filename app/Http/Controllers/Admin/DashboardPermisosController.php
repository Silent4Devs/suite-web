<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\SolicitudVacaciones;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;

class DashboardPermisosController extends Controller
{
    use ObtenerOrganizacion;

    public function dashboardOrg($id)
    {
        $currentUser = User::getCurrentUser();

        $mes_año = Carbon::now();  // Puedes reemplazar esto con el mes que desees
        $inicio_mes = $mes_año->copy()->startOfMonth();  // Primer día del mes
        $fin_mes = $mes_año->copy()->endOfMonth();       // Último día del mes

        $vacacionesMounth = SolicitudVacaciones::where('fecha_inicio', '>=', $inicio_mes)->orWhere('fecha_fin', '>=', $fin_mes)->get();
        $dayOffMounth = SolicitudDayOff::where('fecha_inicio', '>=', $inicio_mes)->orWhere('fecha_fin', '>=', $fin_mes)->get();
        $permisoMounth = SolicitudPermisoGoceSueldo::where('fecha_inicio', '>=', $inicio_mes)->orWhere('fecha_fin', '>=', $fin_mes)->get();

        $vacaciones = SolicitudVacaciones::where('aprobacion', 3)->get();
        $dayOff = SolicitudDayOff::where('aprobacion', 3)->get();
        $permisos = SolicitudPermisoGoceSueldo::where('aprobacion', 3)->get();

        $vacacionesEvents = collect();
        $dayOffEvents = collect();
        $permisosEvents = collect();

        if (($id == 'all') or ($id == 'todos') or ($id == 'todas')) {
            $areaSeleccionada = 'all';
        } else {
            $areaSeleccionada = $id;

            $area = Area::find($id);

            $vacaciones = $vacaciones->filter(function ($vacacion) use ($area) {
                return $vacacion->empleado->area_id === $area->id;
            });

            $dayOff = $dayOff->filter(function ($day) use ($area) {
                return $day->empleado->area_id === $area->id;
            });

            $permisos = $permisos->filter(function ($permiso) use ($area) {
                return $permiso->empleado->area_id === $area->id;
            });
        }

        foreach ($vacaciones as $vacacion) {
            $vacacionesEvents->push([
                'title' => 'Vacaciones - '.$vacacion->empleado->name,
                'inicio' => [
                    'dia' => Carbon::parse($vacacion->fecha_inicio)->format('d'),
                    'mes' => Carbon::parse($vacacion->fecha_inicio)->format('m'),
                    'año' => Carbon::parse($vacacion->fecha_inicio)->format('Y'),
                ],
                'fin' => [
                    'dia' => Carbon::parse($vacacion->fecha_fin)->format('d'),
                    'mes' => Carbon::parse($vacacion->fecha_fin)->format('m'),
                    'año' => Carbon::parse($vacacion->fecha_fin)->format('Y'),
                ],
                'color' => '#428BEC',
                'empleado_img' => $vacacion->empleado->avatar_ruta,
            ]);
        }

        foreach ($dayOff as $day) {
            $dayOffEvents->push([
                'title' => 'DayOff - '.$day->empleado->name,
                'inicio' => [
                    'dia' => Carbon::parse($day->fecha_inicio)->format('d'),
                    'mes' => Carbon::parse($day->fecha_inicio)->format('m'),
                    'año' => Carbon::parse($day->fecha_inicio)->format('Y'),
                ],
                'fin' => [
                    'dia' => Carbon::parse($day->fecha_fin)->format('d'),
                    'mes' => Carbon::parse($day->fecha_fin)->format('m'),
                    'año' => Carbon::parse($day->fecha_fin)->format('Y'),
                ],
                'color' => '#428BEC',
                'empleado_img' => $day->empleado->avatar_ruta,
            ]);
        }

        foreach ($permisos as $permiso) {
            $permisosEvents->push([
                'title' => 'Permiso - '.$permiso->empleado->name,
                'inicio' => [
                    'dia' => Carbon::parse($permiso->fecha_inicio)->format('d'),
                    'mes' => Carbon::parse($permiso->fecha_inicio)->format('m'),
                    'año' => Carbon::parse($permiso->fecha_inicio)->format('Y'),
                ],
                'fin' => [
                    'dia' => Carbon::parse($permiso->fecha_fin)->format('d'),
                    'mes' => Carbon::parse($permiso->fecha_fin)->format('m'),
                    'año' => Carbon::parse($permiso->fecha_fin)->format('Y'),
                ],
                'color' => '#428BEC',
                'empleado_img' => $permiso->empleado->avatar_ruta,
            ]);
        }

        $areasToSelect = Area::orderBy('area', 'Asc')->get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.dashboardSolicitudesPermisos.dashboardOrg', compact('logo_actual', 'empresa_actual', 'currentUser', 'areasToSelect', 'areaSeleccionada', 'vacacionesMounth', 'dayOffMounth', 'permisoMounth', 'vacaciones', 'dayOff', 'permisos', 'vacacionesEvents', 'dayOffEvents', 'permisosEvents'));
    }
}
