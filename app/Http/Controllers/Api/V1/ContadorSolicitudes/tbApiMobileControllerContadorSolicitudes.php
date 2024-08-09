<?php

namespace App\Http\Controllers\Api\V1\ContadorSolicitudes;

use App\Http\Controllers\Controller;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\SolicitudVacaciones;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;

class tbApiMobileControllerContadorSolicitudes extends Controller
{
    use ObtenerOrganizacion;

    public function tbFunctionContadorSolicitudes()
    {
        $usuario = User::getCurrentUser();

        $solicitud_vacacion = SolicitudVacaciones::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
        $solicitud_dayoff = SolicitudDayOff::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
        $solicitud_permiso = SolicitudPermisoGoceSueldo::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();

        return response(json_encode([
            'solicitud_vacacion' => $solicitud_vacacion,
            'solicitud_dayoff' => $solicitud_dayoff,
            'solicitud_permiso' => $solicitud_permiso,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionContadorGeneralSolicitudes()
    {
        $usuario = User::getCurrentUser();

        $solicitud_vacacion = SolicitudVacaciones::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
        $solicitud_dayoff = SolicitudDayOff::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
        $solicitud_permiso = SolicitudPermisoGoceSueldo::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
        $solicitudes_pendientes = $solicitud_vacacion + $solicitud_dayoff + $solicitud_permiso;

        return response(json_encode([
            'solicitudes_pendientes' => $solicitudes_pendientes,
        ]), 200)->header('Content-Type', 'application/json');
    }
}
