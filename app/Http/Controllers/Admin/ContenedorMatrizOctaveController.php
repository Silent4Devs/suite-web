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
    public function index(Request $request)
    {
        abort_if(Gate::denies('categorias_capacitaciones_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizOctaveContenedor::orderByDesc('id')->get();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'categorias_capacitaciones_show';
                $editGate = 'categorias_capacitaciones_edit';
                $deleteGate = 'categorias_capacitaciones_delete';
                $crudRoutePart = 'contenedores';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

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

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.ContenedorMatrizOctave.index');
    }

    public function create()
    {
        // dd("aqui");
        return view('admin.ContenedorMatrizOctave.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $contenedor = MatrizOctaveContenedor::create($request->all());

        return redirect()->route('admin.contenedores.edit', $contenedor);
    }

    public function edit(Request $request, $contenedor, MatrizOctaveContenedor $matrizOctaveContenedor)
    {
        $contenedor = MatrizOctaveContenedor::find($contenedor);
        $sumatoria = $this->calcularRiesgo($contenedor->id);
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();

        return view('admin.ContenedorMatrizOctave.edit', compact('contenedor', 'sumatoria', 'controles'));
    }

    public function update(Request $request, $contenedor)
    {
        $contenedor = MatrizOctaveContenedor::find($contenedor);
        $contenedor = $contenedor->update($request->all());

        return redirect()->route('admin.contenedores.index');
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
        $promedio = $promedio/3;
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

        return redirect()->route('admin.contenedores.index')->with('success', 'Eliminado con éxito');
    }
}
