<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditoriaInternasHallazgos;

class DashboardAuditoriasSGIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.AuditoriasSGI.index');
    }

    public function obtenerClausulaId($incumplimiento)
    {
        // Utiliza el modelo para buscar el valor de clausula_id en función de incumplimiento_requisito
        $clausulaId = AuditoriaInternasHallazgos::where('incumplimiento_requisito', $incumplimiento)->value('clausula_id');

        // Devuelve el valor de clausula_id en formato JSON
        return response()->json(['clausula_id' => $clausulaId]);
    }

    // Otros métodos de tu controlador...
}
