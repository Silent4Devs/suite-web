<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\activoConfidencialidad;
use App\Models\activoDisponibilidad;
use App\Models\ActivoInformacion;
use App\Models\activoIntegridad;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Grupo;
use App\Models\MatrizOctaveContenedor;
use App\Models\Proceso;
use App\Models\User;
use Illuminate\Http\Request;

class ActivosInformacionController extends Controller
{
    public function index(Request $request, $matriz)
    {
        $activos = ActivoInformacion::where('matriz_id', '=', $matriz)->get();

        return view('admin.ActivosInformacion.index', compact('activos', 'matriz'));
    }

    public function create($matriz)
    {
        $empleados = Empleado::getAltaEmpleadosWithArea();
        $duenos = User::getAll()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $area = Area::getAll();
        $procesos = Proceso::with('macroproceso')->get();
        $confidencials = activoConfidencialidad::getAll();
        $integridads = activoIntegridad::get();
        $disponibilidads = activoDisponibilidad::get();
        $contenedores = MatrizOctaveContenedor::get();
        $grupos = Grupo::get();

        return view('admin.ActivosInformacion.create', compact('grupos', 'empleados', 'area', 'duenos', 'procesos', 'confidencials', 'integridads', 'disponibilidads', 'contenedores', 'matriz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenedores' => 'required|array',
        ]);

        $contenedores = array_map(function ($value) {
            return intval($value);
        }, $request->contenedores);
        $activos = ActivoInformacion::create($request->all());
        $activos->contenedores()->sync($contenedores);
        $matriz = $request->matriz_id;

        return redirect()->route('admin.activosInformacion.index', ['matriz' => $matriz])->with('success', 'Guardado con éxito');
    }

    public function edit(Request $request, $activos, $matriz)
    {
        $activos = ActivoInformacion::find($activos);
        $empleados = Empleado::getAltaEmpleadosWithArea();
        $procesos = Proceso::with('macroproceso')->get();
        $confidencials = activoConfidencialidad::getAll();
        $integridads = activoIntegridad::get();
        $disponibilidads = activoDisponibilidad::get();
        $contenedores = MatrizOctaveContenedor::get();

        return view('admin.ActivosInformacion.edit', compact('activos', 'empleados', 'procesos', 'confidencials', 'integridads', 'disponibilidads', 'contenedores', 'matriz'));
    }

    public function update(Request $request, $activos)
    {
        $activos = ActivoInformacion::find($activos);
        $activos->update($request->all());
        $activos->contenedores()->sync($request->contenedores);
        $matriz = $request->matriz_id;

        return redirect()->route('admin.activosInformacion.index', ['matriz' => $matriz]);
    }

    public function destroy($id)
    {
        $activo = ActivoInformacion::find($id);
        $activo->delete();
        $activos = ActivoInformacion::get();

        return view('admin.ActivosInformacion.index', compact('activos'));
    }

    public function validacion(Request $request)
    {
        $codigo = $request->identificador;
        $existe = ActivoInformacion::where('identificador', $codigo)->exists();

        return response()->json(['existe' => $existe]);
    }
}
