<?php

namespace App\Http\Controllers;

use App\Models\ComunicacionSgi;
use Carbon\Carbon;

class ComunicadosTVController extends Controller
{
    public function index()
    {
        $comunicacionSgis_carrusel = ComunicacionSgi::getAllwithImagenes()->where('publicar_en', '=', 'Carrusel')->orWhere('publicar_en', '=', 'Ambos')->where('fecha_programable', '<=', Carbon::now()->format('Y-m-d'))->where('fecha_programable_fin', '>=', Carbon::now()->format('Y-m-d'))->get();

        return view('comunicados-tv.index', compact('comunicacionSgis_carrusel'));
    }
}
