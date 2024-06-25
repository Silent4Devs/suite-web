<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Course;
use App\Traits\ObtenerOrganizacion;

class PanelCursosController extends Controller
{
    use ObtenerOrganizacion;

    public function index()
    {

        $cursos = Course::get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.escuela.panel-cursos', compact('cursos', 'logo_actual', 'empresa_actual'));
    }
}
