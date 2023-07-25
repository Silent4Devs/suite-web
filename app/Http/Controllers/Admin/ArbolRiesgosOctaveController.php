<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatrizOctaveProceso;
use App\Models\Organizacion;
use Composer\DependencyResolver\Request;

class ArbolRiesgosOctaveController extends Controller
{
    public function index(Request $request, $matriz)
    {
        $procesosTree = $this->obtenerRamas();
        $organizacion = Organizacion::getFirst();
        $existeArbol = $procesosTree['children']->count() > 0;
        $rutaImagenes = asset('storage/empleados/imagenes/');

        return view('admin.OCTAVE.arbol-riesgos', compact('procesosTree', 'organizacion', 'existeArbol', 'rutaImagenes', 'matriz'));
    }

    public function obtenerRamas()
    {
        $procesosTree = collect(['name' => 'Broxel', 'content' => 'Sin contenido', 'children' => collect()]);
        $procesos = collect();
        if (MatrizOctaveProceso::with(['children'])->count() > 0) {
            foreach (MatrizOctaveProceso::with(['children'])->get() as $procesoOctave) {
                $procesos->push($procesoOctave->children);
            }
        }
        $procesosTree['children'] = $procesos;

        return $procesosTree;
    }

    public function obtenerArbol()
    {
        $procesosTree = $this->obtenerRamas();

        return json_encode($procesosTree);
    }
}
