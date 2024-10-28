<?php

namespace app\Http\Controllers\Api\V1\Capacitaciones;

use App\Http\Controllers\Controller;
use App\Models\ComunicacionSgi;
use App\Models\Empleado;
use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Level;
use App\Models\Escuela\UserEvaluation;
use App\Models\Escuela\UsuariosCursos;
use App\Models\FelicitarCumpleaños;
use App\Models\Organizacione;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class tbApiMobileControllerCapacitaciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function encodeSpecialCharacters($url)
    {
        // Handle spaces
        // $url = str_replace(' ', '%20', $url);
        // Encode other special characters, excluding /, \, and :
        $url = preg_replace_callback(
            '/[^A-Za-z0-9_\-\.~\/\\\:]/',
            function ($matches) {
                return rawurlencode($matches[0]);
            },
            $url,
        );

        return $url;
    }

    public function tbFunctionUltimoCurso()
    {
        $usuario = User::getCurrentUser();
        $cursos_usuario = UsuariosCursos::with('cursos')->where('user_id', $usuario->id)->get();

        // Obtener el último curso y los últimos tres cursos
        $ultimo = $cursos_usuario->sortBy('last_review')->last();

        $completedLessonsCount = $ultimo->cursos->lessons->filter(function ($lesson) {
            return $lesson->completed;
        })->count();

        $totalLessonsCount = $ultimo->cursos->lessons->count();

        $advance = ($completedLessonsCount * 100) / ($totalLessonsCount > 0 ? $totalLessonsCount : 1);
        $ultimo->advance = round($advance, 2);

        $json_lastCourse = [
            'id_course' => $ultimo->cursos->id,
            'title' => $ultimo->cursos->title,
            'subtitle' => $ultimo->cursos->subtitle,
            'description' => $ultimo->cursos->description,
            'nombre_instructor' => $ultimo->cursos->instructor->name,
            'imagen_instructor' => isset($ultimo->cursos->instructor->empleado->avatar_ruta) ? $this->encodeSpecialCharacters($ultimo->cursos->instructor->empleado->avatar_ruta) : '',
            'course_progress' => $ultimo->advance,
        ];

        return response(json_encode(
            [
                'lastCourse' => $json_lastCourse,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionCursosInscrito()
    {
        $usuario = User::getCurrentUser();
        $cursos_usuario = UsuariosCursos::with('cursos')->where('user_id', $usuario->id)->get();

        // Obtener el último curso y los últimos tres cursos
        $cursos_usuario = $cursos_usuario->sortBy('last_review');

        foreach ($cursos_usuario as $keyCursos => $cu) {

            $completedLessonsCount = $cu->cursos->lessons->filter(function ($lesson) {
                return $lesson->completed;
            })->count();

            $totalLessonsCount = $cu->cursos->lessons->count();

            $advance = ($completedLessonsCount * 100) / ($totalLessonsCount > 0 ? $totalLessonsCount : 1);
            $cu->advance = round($advance, 2);

            $json_inscribedCourses[] = [
                'id_course' => $cu->cursos->id,
                'title' => $cu->cursos->title,
                'subtitle' => $cu->cursos->subtitle,
                'description' => $cu->cursos->description,
                'nombre_instructor' => $cu->cursos->instructor->name,
                'imagen_instructor' => isset($cu->cursos->instructor->empleado->avatar_ruta) ? $this->encodeSpecialCharacters($cu->cursos->instructor->empleado->avatar_ruta) : '',
                'course_progress' => $cu->advance,
            ];
        }

        return response(json_encode(
            [
                'inscribedCourses' => $json_inscribedCourses,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionCatalogoCursos()
    {
        $categories = Category::getAll();
        $levels = Level::getAll();
        $courses = Course::where('status', 3)
            // ->category($this->category_id)
            // ->level($this->level_id)
            ->get();

        $json_courses = [];

        foreach ($courses as $keyCourse => $course) {
            $json_courses['cursos'][$keyCourse] = [
                'id_course' => $course->id,
                'title' => $course->title,
                'subtitle' => $course->subtitle,
                'description' => $course->description,
                'nombre_instructor' => $course->instructor->name,
                'imagen_instructor' => isset($course->instructor->empleado->avatar_ruta) ? $this->encodeSpecialCharacters($course->instructor->empleado->avatar_ruta) : '',
                // 'course_progress' => $course->advance, //No util, no esta inscrito a estos.
                'colaboradores_inscritos' => $course->students_count,
            ];

            $courses_lessons = $course->lessons;
            $lesson_introduction = $courses_lessons->first();

            if (! is_null($lesson_introduction)) {
                if (is_null($lesson_introduction['iframe'])) {
                    $course->lesson_introduction = null;
                } else {
                    $course->lesson_introduction = $lesson_introduction['iframe'];
                }
            } else {
                $course->lesson_introduction = null;
            }

            // $json_courses['cursos'][$keyCourse] = [];

            dd($course, $json_courses, $courses_lessons);
        }

        return response(json_encode(
            [
                'coursesCatalogue' => $courses,
                // 'hoy' => $fecha_hoy,
                // 'comunicados' => $comunicados,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionCursoEstudiante($curso_id)
    {
        $usuario = User::getCurrentUser();

        $evaluacionesLeccion = Evaluation::getAll()->where('course_id', $curso_id);

        $course = Course::getAll()->where('id', $curso_id)->first();

        $evaluationsUser = UserEvaluation::where('user_id', $usuario->id)->where('completed', true)->pluck('evaluation_id')->toArray();

        $json_progreso_curso = [];

        $json_progreso_curso['course'] = [
            'id_course' => $course->id,
            'title' => $course->title,
            'nombre_instructor' => $course->instructor->name,
            'imagen_instructor' => isset($course->instructor->empleado->avatar_ruta) ? $this->encodeSpecialCharacters($course->instructor->empleado->avatar_ruta) : '',
        ];

        foreach ($course->sections_order as $keySections => $section) {
            $json_progreso_curso['course']['section'][$keySections] = [
                'id_section' => $section->id,
                'name_section' => $section->name
            ];

            foreach ($section->lessons as $keyLesson => $lesson) {
                $json_progreso_curso['course']['section'][$keySections]['lesson'][$keyLesson] = [
                    'id_lesson' => $lesson->id,
                    'name_lesson' => $lesson->name,
                    'url_evaluation' => $lesson->url,
                    'lesson_completed' => $lesson->completed,
                ];
            }


            foreach ($section->evaluations as $keyEvaluation => $evaluation) {

                $totalLectionSection = $section->lessons->count();
                $completedLectionSection = $section->lessons;
                $completedLessonsCount = $section->lessons
                    ->filter(function ($lesson) {
                        return $lesson->completed;
                    })
                    ->count();

                if ($totalLectionSection != $completedLessonsCount) {
                    $json_progreso_curso['course']['section'][$keySections]['evaluations'][$keyEvaluation] = [
                        'id_evaluation' => $evaluation->id,
                        'name_evaluation' => $evaluation->name,
                        'evaluation_blocked' => true,
                    ];
                } else {
                    if ($evaluation->questions->count() > 0) {
                        $completed = in_array($evaluation->id, $evaluationsUser);

                        $json_progreso_curso['course']['section'][$keySections]['evaluations'][$keyEvaluation] = [
                            'id_evaluation' => $evaluation->id,
                            'name_evaluation' => $evaluation->name,
                            'evaluation_completed' => $completed,
                            'evaluation_blocked' => false,
                        ];
                    }
                }
            }
        }

        dd($json_progreso_curso, $course, $evaluacionesLeccion);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
