<?php

namespace app\Http\Controllers\Api\V1\Capacitaciones;

use App\Http\Controllers\Controller;
use App\Models\ComunicacionSgi;
use App\Models\Empleado;
use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Instructor\Answer;
use App\Models\Escuela\Instructor\Question;
use App\Models\Escuela\Instructor\UserAnswer;
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
use Illuminate\Support\Facades\Validator;

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
            $json_courses['courses'][$keyCourse] = [
                'id_course' => $course->id,
                'title' => $course->title,
                'subtitle' => $course->subtitle,
                'description' => $course->description,
                'course_rating' => $course->rating,
                'colaboradores_inscritos' => $course->students_count,
                'nombre_instructor' => $course->instructor->name ?? $course->teacher->empleado->name,
                'imagen_instructor' => isset($course->instructor->empleado->avatar_ruta) ? $this->encodeSpecialCharacters($course->instructor->empleado->avatar_ruta) : '',
                // 'course_progress' => $course->advance, //No util, no esta inscrito a estos.
            ];

            $courses_lessons = $course->lessons;
            $lesson_introduction = $courses_lessons->first();

            if (! is_null($lesson_introduction)) {
                if (is_null($lesson_introduction->url)) {

                    $json_courses['courses'][$keyCourse]['video_introduction'] = null;
                } else {
                    $json_courses['courses'][$keyCourse]['video_introduction'] = $lesson_introduction->url;
                }
            } else {
                $json_courses['courses'][$keyCourse]['video_introduction'] = null;
            }

            if ($course->goals->isNotEmpty()) {
                foreach ($course->goals as $keyGoal => $goal) {
                    $json_courses['courses'][$keyCourse]['goals'][$keyGoal] = [
                        'id_goal' => $goal->id,
                        'name_goal' => $goal->name,
                    ];
                }
            }
        }

        return response(json_encode(
            [
                'coursesCatalogue' => $json_courses,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionInformacionCurso($curso_id)
    {
        $usuario = User::getCurrentUser();

        $evaluacionesLeccion = Evaluation::getAll()->where('course_id', $curso_id);

        $course = Course::getAll()->where('id', $curso_id)->first();

        $evaluationsUser = UserEvaluation::where('user_id', $usuario->id)->where('completed', true)->pluck('evaluation_id')->toArray();

        $json_informacion_curso = [];

        $json_informacion_curso['course'] = [
            'id_course' => $course->id,
            'title' => $course->title,
            'subtitle' => $course->subtitle,
            'description' => $course->description,
            'course_rating' => $course->rating,
            'colaboradores_inscritos' => $course->students_count,
            'nombre_instructor' => $course->instructor->name ?? $course->teacher->empleado->name,
            'imagen_instructor' => isset($course->instructor->empleado->avatar_ruta) ? $this->encodeSpecialCharacters($course->instructor->empleado->avatar_ruta) : '',
            // 'course_progress' => $course->advance, //No util, no esta inscrito a estos.
        ];

        $courses_lessons = $course->lessons;
        $lesson_introduction = $courses_lessons->first();

        if (! is_null($lesson_introduction)) {
            if (is_null($lesson_introduction->url)) {

                $json_informacion_curso['course']['video_introduction'] = null;
            } else {
                $json_informacion_curso['course']['video_introduction'] = $lesson_introduction->url;
            }
        } else {
            $json_informacion_curso['course']['video_introduction'] = null;
        }

        if ($course->goals->isNotEmpty()) {
            foreach ($course->goals as $keyGoal => $goal) {
                $json_informacion_curso['course']['goals'][$keyGoal] = [
                    'id_goal' => $goal->id,
                    'name_goal' => $goal->name,
                ];
            }
        }

        foreach ($course->sections_order as $keySections => $section) {
            $json_informacion_curso['course']['section'][$keySections] = [
                'id_section' => $section->id,
                'name_section' => $section->name
            ];

            foreach ($section->lessons as $keyLesson => $lesson) {
                $json_informacion_curso['course']['section'][$keySections]['lesson'][$keyLesson] = [
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
                    $json_informacion_curso['course']['section'][$keySections]['evaluations'][$keyEvaluation] = [
                        'id_evaluation' => $evaluation->id,
                        'name_evaluation' => $evaluation->name,
                        'evaluation_blocked' => true,
                    ];
                } else {
                    if ($evaluation->questions->count() > 0) {
                        $completed = in_array($evaluation->id, $evaluationsUser);

                        $json_informacion_curso['course']['section'][$keySections]['evaluations'][$keyEvaluation] = [
                            'id_evaluation' => $evaluation->id,
                            'name_evaluation' => $evaluation->name,
                            'evaluation_completed' => $completed,
                            'evaluation_blocked' => false,
                        ];
                    }
                }
            }
        }

        return response(json_encode(
            [
                'informacionCurso' => $json_informacion_curso,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionCursoEstudiante($curso_id)
    {
        $usuario = User::getCurrentUser();

        $evaluacionesLeccion = Evaluation::getAll()->where('course_id', $curso_id);

        $course = Course::getAll()->where('id', $curso_id)->first();

        $current = $course->last_finished_lesson;

        if (! $current) {
            $current = $course->lessons->last();
        }

        $evaluationsUser = UserEvaluation::where('user_id', $usuario->id)->where('completed', true)->pluck('evaluation_id')->toArray();

        $json_progreso_curso = [];

        $json_progreso_curso['course'] = [
            'id_course' => $course->id,
            'title' => $course->title,
            'nombre_instructor' => $course->instructor->name,
            'imagen_instructor' => isset($course->instructor->empleado->avatar_ruta) ? $this->encodeSpecialCharacters($course->instructor->empleado->avatar_ruta) : '',
        ];

        foreach ($course->sections_order as $keySections => $section) {
            // Datos de la sección
            $json_progreso_curso['course']['section'][$keySections] = [
                'id_section' => $section->id,
                'name_section' => $section->name,
            ];

            // Contar lecciones completadas en la sección
            $totalLessons = $section->lessons->count();
            $completedLessonsCount = $section->lessons
                ->filter(function ($lesson) {
                    return $lesson->completed;
                })
                ->count();

            // Procesar lecciones
            foreach ($section->lessons as $keyLesson => $lesson) {
                $isCurrentLesson = ($current->id == $lesson->id);

                // Datos comunes para todas las lecciones
                $lessonData = [
                    'id_lesson' => $lesson->id,
                    'name_lesson' => $lesson->name,
                    'platform_lesson' => $lesson->platform_format,
                    'lesson_completed' => $lesson->completed,
                    'current_lesson' => $isCurrentLesson,
                    'resource_lesson' => null, // Valor por defecto
                ];

                // Asignar el valor de data_lesson y resource_lesson según el formato de la plataforma
                switch ($lesson->platform_format) {
                    case 'Vimeo':
                    case 'Youtube':
                        $lessonData['data_lesson'] = $lesson->url;
                        if ($lesson->resource) {
                            $lessonData['resource_lesson'] = asset('storage/' . $lesson->resource->url);
                        }
                        break;
                    case 'Documento':
                        $lessonData['data_lesson'] = asset('storage/' . $lesson->resource->url);
                        break;
                    case 'Texto':
                        $lessonData['data_lesson'] = $lesson->text_lesson;
                        break;
                    default:
                        continue 2; // Saltar al siguiente ciclo del foreach
                }

                // Agregar la lección al arreglo de progreso del curso
                $json_progreso_curso['course']['section'][$keySections]['lesson'][$keyLesson] = $lessonData;
            }

            // Procesar evaluaciones
            foreach ($section->evaluations as $keyEvaluation => $evaluation) {
                dd($evaluation);
                $evaluationData = [
                    'id_evaluation' => $evaluation->id,
                    'name_evaluation' => $evaluation->name,
                    'evaluation_blocked' => ($totalLessons != $completedLessonsCount),
                ];

                // Si la evaluación no está bloqueada, agregar datos adicionales
                if (!$evaluationData['evaluation_blocked'] && $evaluation->questions->count() > 0) {
                    $evaluationData['evaluation_completed'] = in_array($evaluation->id, $evaluationsUser);
                }

                // Agregar la evaluación al arreglo de progreso del curso
                $json_progreso_curso['course']['section'][$keySections]['evaluations'][$keyEvaluation] = $evaluationData;
            }
        }

        return response(json_encode(
            [
                'cursoEstudiante' => $json_progreso_curso,
            ],
        ), 200)->header('Content-Type', 'application/json');
        // dd($json_progreso_curso, $course, $evaluacionesLeccion);
    }

    public function tbFunctionCursoEvaluacion($curso_id, $evaluation_id)
    {
        $user = User::getCurrentUser();
        $course = Course::with('instructor.empleado')->findOrFail($curso_id);
        $evaluation = Evaluation::with('questions.answers')->findOrFail($evaluation_id);

        $json_preguntas_curso = [
            'course' => $this->formatCourseData($course),
            'evaluation' => $this->formatEvaluationData($evaluation, $user),
        ];

        return response()->json(['cursoEvaluacion' => $json_preguntas_curso], 200);
    }

    private function formatCourseData($course)
    {
        return [
            'id_course' => $course->id,
            'title' => $course->title,
            'nombre_instructor' => $course->instructor->name,
            'imagen_instructor' => isset($course->instructor->empleado->avatar_ruta)
                ? $this->encodeSpecialCharacters($course->instructor->empleado->avatar_ruta)
                : '',
        ];
    }

    private function formatEvaluationData($evaluation, $user)
    {
        $totalQuizQuestions = $evaluation->questions->count();

        $userEvaluation = UserEvaluation::firstOrCreate(
            ['user_id' => $user->id, 'evaluation_id' => $evaluation->id],
            ['quiz_size' => $totalQuizQuestions, 'completed' => false]
        );

        $evaluationData = [
            'id_evaluation' => $evaluation->id,
            'name_evaluation' => $evaluation->name,
            'evaluation_completed' => $userEvaluation->completed,
            'evaluation_blocked' => false,
            'questions' => $userEvaluation->completed
                ? $this->formatCompletedQuestions($userEvaluation)
                : $this->formatUncompletedQuestions($evaluation)
        ];

        return $evaluationData;
    }

    private function formatUncompletedQuestions($evaluation)
    {
        $questionsData = [];
        foreach ($evaluation->questions->shuffle() as $question) {
            $questionsData[] = [
                'id_question' => $question->id,
                'question' => $question->question,
                'is_active' => $question->is_active,
                'answers' => $this->formatAnswers($question->answers),
            ];
        }
        return $questionsData;
    }

    private function formatCompletedQuestions($userEvaluation)
    {
        $questionsData = [];
        foreach ($userEvaluation->userAnswers as $answeredQuestion) {
            $question = $answeredQuestion->question;
            $questionsData[] = [
                'id_question' => $question->id,
                'question' => $question->question,
                'is_active' => $question->is_active,
                'answers' => $this->formatAnswers($question->answers, $answeredQuestion->answer_id, $answeredQuestion->is_correct),
            ];
        }
        return $questionsData;
    }

    private function formatAnswers($answers, $selectedAnswerId = null, $isCorrect = false)
    {
        $answersData = [];
        foreach ($answers as $answer) {
            $answersData[] = [
                "id_answer" => $answer->id,
                "answer" => $answer->answer,
                "is_correct" => $selectedAnswerId === $answer->id
                    ? (bool) $isCorrect
                    : (bool) $answer->is_correct,
                "selected" => $selectedAnswerId === $answer->id,
            ];
        }
        return $answersData;
    }

    public function tbFunctionRespuestasCursoEvaluacion(Request $request)
    {
        // Define las reglas de validación
        $validator = Validator::make($request->all(), [
            'id_course' => ['required', 'integer'],
            'id_evaluation' => ['required', 'integer'],
            'answers' => ['required', 'array'],
            'answers.*.id_question' => ['required', 'integer'],
            'answers.*.id_answer' => ['required', 'integer'],
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'integer' => 'El campo :attribute debe ser un número.',
        ]);

        // Si hay errores de validación, retornamos un JSON con el error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors(),
            ], 422); // Código HTTP 422 Unprocessable Entity
        }

        // Obtener al usuario actual
        $user = User::getCurrentUser();

        // Obtener el registro de la evaluacion
        $userEvaluation = UserEvaluation::where('user_id', $user->id)
            ->where('evaluation_id', $request->id_evaluation)
            ->first();

        // Inicializar la variable
        $correctQuestions = 0;

        // Preparar un array para la inserción masiva
        $data = [];
        foreach ($request->answers as $answer) {
            // Comprobar si la respuesta es correcta
            $correctAnswer = Answer::where('id', $answer["id_answer"])
                ->where('question_id', $answer["id_question"])
                ->first();

            // Obtener si es correcta o incorrecta
            $isChoiceCorrect = $correctAnswer && $correctAnswer->is_correct === "1";

            // Sumarla solo si es correcta
            if($isChoiceCorrect){
                $correctQuestions++;
            }

            $data[] = [
                'user_id' => $user->id,
                'user_evaluation_id' => $userEvaluation->id,
                'evaluation_id' => $request->id_evaluation,
                'question_id' => $answer['id_question'],
                'answer_id' => $answer['id_answer'],
                'is_correct' => $isChoiceCorrect,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Obtener el numero de preguntas contestadas en el cuestionario
        $totalQuestions = count($request->answers);

        // Obtener su calificacion de la evaluación
        $percentage = ($correctQuestions * 100) / $totalQuestions;

        // Establecerla como completada y poner su porcentaje
        $userEvaluation->update([
            'score' => $percentage,
            'completed' => true,
        ]);

        // Insertar todas las respuestas en una sola operación (batch)
        UserAnswer::insert($data);

        return response()->json([
            'success' => true,
            'message' => 'Cuestionario Completado. Respuestas guardadas exitosamente',
        ]);
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
