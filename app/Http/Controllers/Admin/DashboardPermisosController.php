<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ObtenerOrganizacion;
use App\Models\Area;
use App\Models\SolicitudVacaciones;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Message;

class DashboardPermisosController extends Controller
{
    use ObtenerOrganizacion;

    public function dashboardOrg($id)
    {
        $hoy = Carbon::now();
        $inicioMes = Carbon::now()->subMonth();

        $vacacionesMounth = SolicitudVacaciones::where('fecha_inicio', '>=', $inicioMes)->where('fecha_fin', '<=', $hoy)->get();
        $dayOffMounth = SolicitudDayOff::where('fecha_inicio', '>=', $inicioMes)->where('fecha_fin', '<=', $hoy)->get();
        $permisoMounth = SolicitudPermisoGoceSueldo::where('fecha_inicio', '>=', $inicioMes)->where('fecha_fin', '<=', $hoy)->get();

        if (($id == 'all') or ($id == 'todos') or ($id == 'todas')) {
            $areaSeleccionada = 'all';
        } else {
            $areaSeleccionada = $id;

            $area = Area::find($id);
        }

        $areasToSelect = Area::orderBy('area', 'Asc')->get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.dashboardSolicitudesPermisos.dashboardOrg', compact('logo_actual', 'empresa_actual', 'areasToSelect', 'areaSeleccionada', 'vacacionesMounth', 'dayOffMounth', 'permisoMounth'));
    }
}
