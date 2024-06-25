<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Instructor\UserAnswer;
use App\Models\Escuela\UsuariosCursos;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;

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
            $id_user = $cu->user_id;
            $completedLessonsCount = $cu->cursos->lessons->filter(function ($lesson) use ($id_user) {
                return $lesson->getCompletedUserAttribute($id_user);
            })->count();

            $totalLessonsCount = $cu->cursos->lessons->count();

            $advance = ($completedLessonsCount * 100) / ($totalLessonsCount > 0 ? $totalLessonsCount : 1);
            $cu->advance = round($advance, 2);

            // ---------------------------------------------------------------------------

            $calificacion = 0;
            $evaluaciones = Evaluation::where('course_id', $id)->get();
            $evaluaciones_count = $evaluaciones->count();
            $evaluacion_usuario_collect = collect();
            foreach ($evaluaciones as $evaluation) {
                $correctQuestions = UserAnswer::where('is_correct', true)->where('user_id', $cu->user_id)->where('evaluation_id', $evaluation->id)->count();
                $last_quest_response = UserAnswer::where('user_id', $cu->user_id)->where('evaluation_id', $evaluation->id)->first();
                // dd($last_quest_response);
                $totalQuizQuestions = count($evaluation->questions);
                $totalQuestions = $totalQuizQuestions == 0 ? 1 : $totalQuizQuestions;
                $percentage = ($correctQuestions * 10) / $totalQuestions;
                $calificacion += $percentage;

                $evaluacion_usuario_collect->push(
                    [
                        'name' => $evaluation->name,
                        'calificacion' => isset($percentage) ? $percentage : 'No aplica',
                        'fecha' => $last_quest_response ? Carbon::parse($last_quest_response->created_at)->format('d/m/Y') : 'No contestada',
                    ],
                );
            }
            $cu->calificacion = $calificacion / ($evaluaciones->count() == 0 ? 1 : $evaluaciones->count());
            $cu->evaluaciones_usuario = $evaluacion_usuario_collect;
        }

        return view('admin.escuela.reportes-individuales', compact('logo_actual', 'empresa_actual', 'cursos_usuario', 'evaluaciones'));
    }
}
