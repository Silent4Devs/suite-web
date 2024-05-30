<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ObtenerOrganizacion;

class ReportesIndividualesController extends Controller
{
    use ObtenerOrganizacion;

    public function index()
    {

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.escuela.reportes-individuales', compact('logo_actual', 'empresa_actual'));
    }
}
