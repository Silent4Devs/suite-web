<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\UsuariosCursos;
use Illuminate\Http\Request;

class CursoEstudiante extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.escuela.estudiante.curso-estudiante');
    }

    public function misCursos()
    {
        $cursos_usuario = UsuariosCursos::with('cursos')->where('user_id', auth()->user()->id)->get();
        $cursos = Course::get();
        return view('admin.escuela.estudiante.mis-cursos', compact('cursos_usuario', 'cursos'));
    }

    public function cursoEstudiante($curso_id)
    {
        $curso = Course::first($curso_id);
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
    public function show(string $id)
    {
        //
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
