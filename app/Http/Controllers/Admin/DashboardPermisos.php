<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ObtenerOrganizacion;


class DashboardPermisos extends Controller
{
    use ObtenerOrganizacion;

    public function dashboardArea()
    {

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.dashboardSolicitudesPermisos.dashboardArea', compact('logo_actual', 'empresa_actual'));
    }
}
