<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\CourseUser;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Level;
use App\Models\Escuela\UsuariosCursos;
use App\Models\User;
use Illuminate\Http\Request;

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
        $cursos_usuario = UsuariosCursos::with('cursos')->where('user_id', User::getCurrentUser()->id)->get();
        // dd($cursos_usuario);
        // $cursos = Course::getAll();
        // $categories = Category::all();
        // $levels = Level::all();
        // $courses = Course::where('status', 3)
        //     ->category($this->category_id)
        //     ->level($this->level_id)
        //     ->latest('id')->paginate(8);
        // dd($categories, $levels, $courses);

        return view('admin.escuela.estudiante.mis-cursos', compact('cursos_usuario'));
    }

    public function cursoEstudiante($curso_id)
    {
        $curso = Course::where('id', $curso_id)->first();
        // dd($curso_id, $curso);
        $evaluacionesLeccion = Evaluation::where('course_id', $curso_id)->get();

        return view('admin.escuela.estudiante.curso-estudiante', compact('curso', 'evaluacionesLeccion'));
    }

    public function evaluacionEstudiante($curso_id, $evaluacion_id)
    {
        // dd("Llega hasta aca", $curso_id, $evaluacion_id);
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
}
