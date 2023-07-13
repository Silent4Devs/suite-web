<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeclaracionAplicabilidad;
use App\Models\MatrizOctaveContenedor;
use App\Models\MatrizOctaveEscenario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\Datatables\Datatables;

class ContenedorMatrizOctaveController extends Controller
{
    public function index(Request $request, $matriz)
    {
        abort_if(Gate::denies('categorias_capacitaciones_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizOctaveContenedor::orderByDesc('id')->where('matriz_id', '=', $matriz)->get();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            // $table->editColumn('actions', function ($row) {
            //     $viewGate = 'categorias_capacitaciones_show';
            //     $editGate = 'categorias_capacitaciones_edit';
            //     $deleteGate = 'categorias_capacitaciones_delete';
            //     $crudRoutePart = 'contenedores';

            //     return view('partials.datatablesActions', compact(
            //         'viewGate',
            //         'editGate',
            //         'deleteGate',
            //         'crudRoutePart',
            //         'row'
            //     ));
            // });

            $table->editColumn('identificador_contenedor', function ($row) {
                return $row->identificador_contenedor ? $row->identificador_contenedor : '';
            });
            $table->editColumn('nom_contenedor', function ($row) {
                return $row->nom_contenedor ? $row->nom_contenedor : '';
            });
            $table->editColumn('riesgo', function ($row) {
                return $row->riesgo ? $row->riesgo : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            // $table->rawColumns(['actions']);

            return $table->make(true);
        }

        // dd($request->all());

        return view('admin.ContenedorMatrizOctave.index', compact('matriz'));
    }

    public function create($matriz)
    {
        // dd("aqui");
        return view('admin.ContenedorMatrizOctave.create', compact('matriz'));
    }

    public function store(Request $request)
    {
        $contenedor = MatrizOctaveContenedor::create($request->all());
        $matriz = $request->matriz_id;

        return redirect()->route('admin.contenedores.edit', ['contenedor' => $contenedor, 'matriz' => $matriz]);
    }

    public function edit(Request $request, $contenedor, MatrizOctaveContenedor $matrizOctaveContenedor, $matriz)
    {
        $contenedor = MatrizOctaveContenedor::find($contenedor);
        $sumatoria = $this->calcularRiesgo($contenedor->id);
        $controles = DeclaracionAplicabilidad::getAll(['id', 'anexo_indice', 'anexo_politica']);
        // dd($contenedor->impacto_proceso);
        return view('admin.ContenedorMatrizOctave.edit', compact('contenedor', 'sumatoria', 'controles', 'matriz'));
    }

    public function update(Request $request, $contenedor)
    {
        $contenedor = MatrizOctaveContenedor::find($contenedor);
        $contenedor = $contenedor->update($request->all());
        $matriz = $request->matriz_id;

        return redirect()->route('admin.contenedores.index', ['matriz' => $matriz]);
    }

    public function agregarEscenarios(Request $request, $contenedor)
    {
        $controles = array_map(function ($value) {
            return intval($value);
        }, $request->controles);

        $request->validate([
            'identificador_escenario' => 'required',
            'nom_escenario' => 'required',
        ]);

        $escenario = MatrizOctaveEscenario::create([
            'identificador_escenario' => $request->identificador_escenario,
            'nom_escenario' => $request->nom_escenario,
            'descripcion' => $request->descripcion,
            'confidencialidad' => $request->confidencialidad,
            'integridad' => $request->integridad,
            'disponibilidad' => $request->disponibilidad,
            'id_octave_contenedor' => $contenedor,
        ]);
        $escenario->controles()->sync($controles);
        $sumatoria = $this->calcularRiesgo($contenedor);
        $contenedor = MatrizOctaveContenedor::find($contenedor);
        $contenedor->update(['riesgo' => $sumatoria]);

        return response()->json(['estatus' => 200, 'riesgo' => $sumatoria]);
    }

    public function calcularRiesgo($contenedor)
    {
        $escenarios = MatrizOctaveContenedor::with('escenarios')->find($contenedor)->escenarios;
        $cantidadEscenarios = count($escenarios) > 0 ? count($escenarios) : 1;
        $sumatoria = 0;
        foreach ($escenarios as $escenario) {
            $sumatoria = $sumatoria + $this->obtenerPromedio($escenario);
        }
        $sumatoria = $sumatoria / $cantidadEscenarios;

        return round($sumatoria);
    }

    private function obtenerPromedio($escenario)
    {
        $promedio = ($escenario->confidencialidad ? $escenario->confidencialidad : 0) + ($escenario->integridad ? $escenario->integridad : 0) + ($escenario->disponibilidad ? $escenario->disponibilidad : 0);
        $promedio = $promedio / 3;

        return $promedio;
    }

    public function escenarios($contenedor)
    {
        $escenarios = MatrizOctaveContenedor::with(['escenarios' => function ($q) {
            $q->with('controles');
        }])->find($contenedor)->escenarios;

        return Datatables::of($escenarios)->make(true);
    }

    public function destroy($contenedor)
    {
        // dd($contenedor);
        // abort_if(Gate::denies('categorias_capacitaciones_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $matrizOctaveContenedor->delete();

        $activo = MatrizOctaveContenedor::find($contenedor);
        $activo->delete();

        return response()->json(['status' => 200]);

        // return redirect()->route('admin.contenedores.index')->with('success', 'Eliminado con éxito');
    }

    public function eliminarEscenario(Request $request)
    {
        $escenario = MatrizOctaveEscenario::find($request->escenario);
        $escenario->delete();
        $sumatoria = $this->calcularRiesgo($request->contenedor);

        return response()->json(['estatus' => 200, 'riesgo' => $sumatoria]);
    }
}
