<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\UsuariosCursos;
use App\Traits\ObtenerOrganizacion;

class ReportesIndividualesController extends Controller
{
    use ObtenerOrganizacion;

    public function index($id)
    {
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        $cursos_usuario = UsuariosCursos::with('cursos')->where('course_id', $id)->get();

        foreach ($cursos_usuario as $cu) {
            $completedLessonsCount = $cu->cursos->lessons->filter(function ($lesson) {
                return $lesson->completed;
            })->count();

            $totalLessonsCount = $cu->cursos->lessons->count();

            $advance = ($completedLessonsCount * 100) / ($totalLessonsCount > 0 ? $totalLessonsCount : 1);
            $cu->advance = round($advance, 2);
        }

        return view('admin.escuela.reportes-individuales', compact('logo_actual', 'empresa_actual', 'cursos_usuario'));
    }
}
