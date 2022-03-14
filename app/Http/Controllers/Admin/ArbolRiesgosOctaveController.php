<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatrizOctaveProceso;
use App\Models\Organizacion;
use Illuminate\Http\Request;

class ArbolRiesgosOctaveController extends Controller
{
    public function index()
    {
        $procesosTree = collect(['servicio' => ['nombre' => 'Broxel', 'procesos' => collect()]]);
        $procesosTree['servicio']['procesos']->push(MatrizOctaveProceso::with(['children'])->get());
        $organizacion = Organizacion::first();
        $existeArbol = $procesosTree['servicio']['procesos']->count() > 0;
        $rutaImagenes = asset('storage/empleados/imagenes/');
        return view('admin.OCTAVE.arbol-riesgos', compact('procesosTree', 'organizacion', 'existeArbol', 'rutaImagenes'));
    }

    public function obtenerArbol()
    {
        $procesosTree = collect(['servicio' => ['nombre' => 'Broxel', 'procesos' => collect()]]);
        $procesosTree['servicio']['procesos']->push(MatrizOctaveProceso::with(['children'])->get());
        return json_encode($procesosTree);
    }
}
