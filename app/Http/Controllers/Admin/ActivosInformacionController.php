<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ActivoInformacion;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Proceso;
use App\Models\User;
use Illuminate\Http\Request;

class ActivosInformacionController extends Controller
{
    public function index(Request $request)
    {
        $activos = ActivoInformacion::get();

        return view('admin.activosInformacion.index', compact('activos'));
    }

    public function create()
    {
        $empleados = Empleado::with('area')->get();
        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $area = Area::get();
        $procesos = Proceso::with('macroproceso')->get();

        return view('admin.activosInformacion.create', compact('empleados', 'area', 'duenos', 'procesos'));
    }

    public function store(Request $request)
    {
        $subtipos = ActivoInformacion::create($request->all());

        return redirect()->route('admin.activosInformacion.index')->with('success', 'Guardado con éxito');
    }

    public function edit($activos)
    {
        $activos = ActivoInformacion::find($activos);
        $empleados = Empleado::with('area')->get();
        $procesos = Proceso::with('macroproceso')->get();

        return view('admin.activosInformacion.edit', compact('activos', 'empleados', 'procesos'));
    }

    public function update(Request $request, $activos)
    {
        $activos = ActivoInformacion::find($activos);
        $activos->update($request->all());

        return redirect()->route('admin.activosInformacion.index');
    }

    public function destroy($id)
    {
        $activo = ActivoInformacion::find($id);
        $activo->delete();
        $activos = ActivoInformacion::get();

        return view('admin.activosInformacion.index', compact('activos'));
    }
}
