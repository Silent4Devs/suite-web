<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatrizOctaveProceso;
use App\Models\Organizacion;

class ArbolRiesgosOctaveController extends Controller
{
    public function index()
    {
        $procesosTree = collect(['name' => 'Broxel', 'content' => 'Sin contenido', 'children' => collect()]);
        $procesos = collect();
        if (MatrizOctaveProceso::with(['children'])->count() > 0) {
            foreach (MatrizOctaveProceso::with(['children'])->get() as $procesoOctave) {
                $procesos->push($procesoOctave->children);
            }
        }
        $procesosTree['children'] = $procesos;

        // $procesosTree['children'] = MatrizOctaveProceso::with(['children'])->count() > 0 ? MatrizOctaveProceso::with(['children'])->get()->children : [];
        $organizacion = Organizacion::first();
        $existeArbol = $procesosTree['children']->count() > 0;
        $rutaImagenes = asset('storage/empleados/imagenes/');

        return view('admin.OCTAVE.arbol-riesgos', compact('procesosTree', 'organizacion', 'existeArbol', 'rutaImagenes'));
    }

    public function obtenerArbol()
    {
        $procesosTree = collect(['name' => 'Broxel', 'children' => collect()]);
        $procesos = collect();
        if (MatrizOctaveProceso::with(['children'])->count() > 0) {
            foreach (MatrizOctaveProceso::with(['children'])->get() as $procesoOctave) {
                $procesos->push($procesoOctave->children);
            }
        }
        $procesosTree['children'] = $procesos;

        return json_encode($procesosTree);
    }
}
