<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Course;
use App\Models\Escuela\CourseUser;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\UsuariosCursos;
use App\Models\User;
use Illuminate\Http\Request;
use VXM\Async\AsyncFacade as Async;

class CursoEstudiante extends Controller
{
    public $category_id;

    public $level_id;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.escuela.estudiante.curso-estudiante');
    }

    public function misCursos()
    {
        $usuario = User::getCurrentUser();
        $cursos_usuario = UsuariosCursos::with(['cursos.lessons'])
            ->where('user_id', $usuario->id)
            ->get()
            ->map(function ($cu) {
                $completedLessonsCount = $cu->cursos->lessons->where('completed', true)->count();
                $totalLessonsCount = $cu->cursos->lessons->count();

                $advance = $totalLessonsCount > 0 ? ($completedLessonsCount * 100) / $totalLessonsCount : 0;
                $cu->advance = round($advance, 2);

                return $cu;
            });

        // Sort and retrieve the last course and the last three courses
        $sortedCursos = $cursos_usuario->sortByDesc('last_review');
        $lastCourse = $sortedCursos->first();
        $lastThreeCourse = $sortedCursos->take(3);

        return view('admin.escuela.estudiante.mis-cursos', compact('cursos_usuario', 'usuario', 'lastThreeCourse', 'lastCourse'));
    }

    public function cursoEstudiante($curso_id)
    {
        try {
            // $results = Async::run([
            //     fn() => Evaluation::where('course_id', $curso_id)->get(),
            //     fn() => Course::where('id', $curso_id)->first(),
            // ]);

            $evaluacionesLeccion = Evaluation::getAll()->where('course_id', $curso_id);
            $curso = Course::getAll()->where('id', $curso_id)->first();

            if (! $curso) {
                abort(404);
            }

            return view('admin.escuela.estudiante.curso-estudiante', compact('curso', 'evaluacionesLeccion'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function evaluacionEstudiante($curso_id, $evaluacion_id)
    {
        return view('admin.escuela.estudiante.curso-evaluacion', compact('curso_id', 'evaluacion_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tableQuizDetails($curso_id, $evaluacion_id)
    {
        // dd($curso_id);
        return view('admin.escuela.instructor.quizdetails', compact('curso_id', 'evaluacion_id'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(course $course)
    {
        // $this->authorize('published', $course);

        $similares = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            // Devuelva los cursos que esten publicados
            ->where('status', 3)
            ->latest('id')
            ->take(5)
            ->get();

        $token = CourseUser::where('course_id', $course->id)->where('user_id', User::getCurrentUser()->id)->exists();

        $lesson_introduction = $course->lessons->first();
        // dump($courses_lessons->first());
        if (! is_null($lesson_introduction)) {
            if (is_null($lesson_introduction['iframe'])) {
                $course->lesson_introduction = null;
            } else {
                $course->lesson_introduction = $lesson_introduction['iframe'];
            }
        } else {
            $course->lesson_introduction = null;
        }

        return view('admin.escuela.estudiante.show', compact('course', 'similares', 'token'));
    }

    public function enrolled(Course $course)
    {
        $course->students()->attach(User::getCurrentUser()->id);

        return redirect()->route('admin.curso-estudiante', $course->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function coursesInscribed()
    {
        $usuario = User::getCurrentUser();
        $cursos_usuario = UsuariosCursos::with('cursos')->where('user_id', $usuario->id)->get();

        //calculo el porcentaje del curso completado
        // foreach ($cursos_usuario as $cu) {
        //     $i = 0;
        //     $courses_lessons = $cu->cursos->lessons;
        //     foreach ($courses_lessons as $cl) {
        //         if ($cl->completed) {
        //             $i++;
        //         }
        //     }
        //     $advance = ($i * 100) / ($courses_lessons->count());
        //     $advance = round($advance, 2);

        //     //agrego el porcentaje del curso a una propiedad
        //     $cu->advance = $advance;
        // }

        // //last course
        // $lastCourse = $cursos_usuario->sortBy('last_review')->last();
        foreach ($cursos_usuario as $cu) {
            $completedLessonsCount = $cu->cursos->lessons->filter(function ($lesson) {
                return $lesson->completed;
            })->count();

            $totalLessonsCount = $cu->cursos->lessons->count();

            $advance = ($completedLessonsCount * 100) / ($totalLessonsCount > 0 ? $totalLessonsCount : 1);
            $cu->advance = round($advance, 2);
        }

        // Obtener el último curso
        $lastCourse = $cursos_usuario->sortBy('last_review')->last();

        return view('admin.escuela.estudiante.courses-inscribed', compact('usuario', 'cursos_usuario', 'lastCourse'));
    }
}
