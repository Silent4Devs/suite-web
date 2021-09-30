<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\RH\Objetivo;
use App\Models\RH\ObjetivoEmpleado;
use Illuminate\Http\Request;

class EV360ObjetivosController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $objetivos = Objetivo::with(['metrica', 'tipo'])->get();
            return datatables()->of($objetivos)->toJson();
        }
        return view('admin.recursos-humanos.evaluacion-360.objetivos.index');
    }

    public function create()
    {
        $objetivo = new Objetivo;
        $tipo_seleccionado = null;
        $metrica_seleccionada = null;
        return view('admin.recursos-humanos.evaluacion-360.objetivos.create', compact('objetivo', 'tipo_seleccionado', 'metrica_seleccionada'));
    }

    public function createByEmpleado(Request $request, $empleado)
    {
        $objetivo = new Objetivo;
        $empleado = Empleado::find(intval($empleado));
        $empleado->load(['objetivos' => function ($q) {
            $q->with(['objetivo' => function ($query) {
                $query->with(['tipo', 'metrica']);
            }]);
        }]);

        if ($request->ajax()) {
            $objetivos = $empleado->objetivos ?  $empleado->objetivos : collect();
            return datatables()->of($objetivos)->toJson();
        }
        $tipo_seleccionado = null;
        $metrica_seleccionada = null;
        if ($request->ajax()) {
        }
        return view('admin.recursos-humanos.evaluacion-360.objetivos.create-by-empleado', compact('objetivo', 'tipo_seleccionado', 'metrica_seleccionada', 'empleado'));
    }

    public function storeByEmpleado(Request $request, $empleado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'KPI' => 'required|string|max:1500',
            'meta' => 'required|integer',
            'descripcion_meta' => 'nullable|string|max:1500',
            'tipo_id' => 'required|exists:ev360_tipo_objetivos,id',
            'metrica_id' => 'required|exists:ev360_metricas_objetivos,id',
        ]);
        $empleado = Empleado::find(intval($empleado));
        if ($request->ajax()) {
            $objetivo = Objetivo::create($request->all());
            ObjetivoEmpleado::create([
                'objetivo_id' => $objetivo->id,
                'empleado_id' => $empleado->id,
            ]);
            if ($objetivo) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'KPI' => 'required|string|max:1500',
            'meta' => 'required|integer',
            'descripcion_meta' => 'nullable|string|max:1500',
            'tipo_id' => 'required|exists:ev360_tipo_objetivos,id',
            'metrica_id' => 'required|exists:ev360_metricas_objetivos,id',
        ]);
        $objetivo = Objetivo::create($request->all());
        if ($objetivo) {
            return redirect()->route('admin.ev360-objetivos.index')->with('success', 'Objetivo creado con éxito');
        } else {
            return redirect()->route('admin.ev360-objetivos.index')->with('error', 'Ocurrió un error al crear el objetivo, intente de nuevo...');
        }
    }

    public function edit($objetivo)
    {
        $objetivo = Objetivo::find($objetivo);
        $tipo_seleccionado = $objetivo->tipo_id;
        $metrica_seleccionada = $objetivo->metrica_id;
        return view('admin.recursos-humanos.evaluacion-360.objetivos.edit', compact('objetivo', 'tipo_seleccionado', 'metrica_seleccionada'));
    }

    public function update(Request $request, $objetivo)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'KPI' => 'required|string|max:1500',
            'meta' => 'required|integer',
            'descripcion_meta' => 'nullable|string|max:1500',
            'tipo_id' => 'required|exists:ev360_tipo_objetivos,id',
            'metrica_id' => 'required|exists:ev360_metricas_objetivos,id',
        ]);
        $objetivo = Objetivo::find($objetivo);
        $u_objetivo = $objetivo->update($request->all());
        if ($u_objetivo) {
            return redirect()->route('admin.ev360-objetivos.index')->with('success', 'Objetivo editado con éxito');
        } else {
            return redirect()->route('admin.ev360-objetivos.index')->with('error', 'Ocurrió un error al editar el objetivo, intente de nuevo...');
        }
    }
}
