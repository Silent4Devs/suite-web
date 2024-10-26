<?php

namespace app\Http\Controllers\Api\V1\Capacitaciones;

use App\Http\Controllers\Controller;
use App\Models\ComunicacionSgi;
use App\Models\Empleado;
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
    public function tbFunctionUltimoCurso()
    {
        $usuario = User::getCurrentUser();
        $cursos_usuario = UsuariosCursos::with('cursos')->where('user_id', $usuario->id)->get();

        // foreach ($cursos_usuario as $cu) {
        //     $completedLessonsCount = $cu->cursos->lessons->filter(function ($lesson) {
        //         return $lesson->completed;
        //     })->count();

        //     $totalLessonsCount = $cu->cursos->lessons->count();

        //     $advance = ($completedLessonsCount * 100) / ($totalLessonsCount > 0 ? $totalLessonsCount : 1);
        //     $cu->advance = round($advance, 2);
        // }

        // Obtener el último curso y los últimos tres cursos
        $lastCourse = $cursos_usuario->sortBy('last_review')->last();
        // $lastThreeCourse = $cursos_usuario->sortByDesc('last_review')->take(3);

        return response(json_encode(
            [
                // 'hoy' => $fecha_hoy,
                // 'comunicados' => $comunicados,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionCatalogoCursos()
    {
        $usuario = User::getCurrentUser();
        $cursos_usuario = UsuariosCursos::with('cursos')->where('user_id', $usuario->id)->get();

        foreach ($cursos_usuario as $cu) {
            $completedLessonsCount = $cu->cursos->lessons->filter(function ($lesson) {
                return $lesson->completed;
            })->count();

            $totalLessonsCount = $cu->cursos->lessons->count();

            $advance = ($completedLessonsCount * 100) / ($totalLessonsCount > 0 ? $totalLessonsCount : 1);
            $cu->advance = round($advance, 2);
        }

        // Obtener el último curso y los últimos tres cursos
        $lastCourse = $cursos_usuario->sortBy('last_review')->last();
        $lastThreeCourse = $cursos_usuario->sortByDesc('last_review')->take(3);

        return response(json_encode(
            [
                'hoy' => $fecha_hoy,
                'comunicados' => $comunicados,
            ],
        ), 200)->header('Content-Type', 'application/json');
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
