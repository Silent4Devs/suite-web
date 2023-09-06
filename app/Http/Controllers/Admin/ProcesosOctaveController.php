<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ActivoInformacion;
use App\Models\Area;
use App\Models\Grupo;
use App\Models\MatrizOctaveProceso;
use App\Models\MatrizOctaveServicio;
use App\Models\Proceso;
use App\Models\ProcesosOctaveHistoricos;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProcesosOctaveController extends Controller
{
    public function index(Request $request, $matriz)
    {
        if ($request->ajax()) {
            $query = MatrizOctaveProceso::with(['area'])->where('matriz_id', '=', $matriz)->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            // $table->editColumn('actions', function ($row) {
            //     $viewGate = 'analisis_de_riesgos_vulnerabilidades_edit';
            //     $editGate = 'analisis_de_riesgos_vulnerabilidades_show';
            //     $deleteGate = 'analisis_de_riesgos_vulnerabilidades_delete';
            //     $crudRoutePart = 'procesos-octave';

            //     return view('partials.datatablesActions', compact(
            //         'viewGate',
            //         'editGate',
            //         'deleteGate',
            //         'crudRoutePart',
            //         'row'
            //     ));
            // });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : '';
            // });
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('proceso', function ($row) {
                return $row->proceso ? $row->proceso->nombre : '';
            });

            $table->editColumn('nivel_riesgo', function ($row) {
                return $row->nivel_riesgo ? $row->nivel_riesgo : '';
            });

            $table->editColumn('direccion', function ($row) {
                return $row->area ? $row->area->area : '';
            });

            $table->editColumn('servicio', function ($row) {
                return $row->servicio ? $row->servicio->servicio : '';
            });

            // $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        // dd($request->all());
        return view('admin.procesos-octave.index', compact('matriz'));
    }

    public function create($matriz)
    {
        $areas = Area::getAll();
        $procesos = Proceso::getAll();

        $proceso_octave = MatrizOctaveProceso::where('matriz_id', $matriz)->pluck('id_proceso')->toArray();
        $procesos = $procesos->filter(function ($item) use ($proceso_octave) {
            if (!in_array($item->id, $proceso_octave)) {
                return $item;
            }
        });

        $activosInfo = ActivoInformacion::get();
        $servicios = MatrizOctaveServicio::get();
        $servicio_seleccionado = null;
        $grupos = Grupo::get();

        return view('admin.procesos-octave.create', compact('grupos', 'areas', 'procesos', 'activosInfo', 'servicios', 'servicio_seleccionado', 'matriz'));
    }

    public function store(Request $request)
    {
        $procesosOctave = MatrizOctaveProceso::create($request->all());
        $matriz = $request->matriz_id;

        return redirect()->route('admin.procesos-octave.index', ['matriz' => $matriz])->with('success', 'Guardado con éxito');
    }

    public function edit($procesosOctave, $matriz)
    {
        $areas = Area::getAll();
        $procesos = Proceso::getAll();
        $activosInfo = ActivoInformacion::get();
        $servicios = MatrizOctaveServicio::get();
        $procesosOctave = MatrizOctaveProceso::find($procesosOctave);
        $servicio_seleccionado = $procesosOctave->servicio_id;
        // dd($procesosOctave->operacional);
        $operacionalSeleccionado = $procesosOctave->operacional;
        $cumplimientoSeleccionado = $procesosOctave->cumplimiento;
        $legalSeleccionado = $procesosOctave->legal;
        $reputacionalSeleccionado = $procesosOctave->reputacional;
        $tecnologicoSeleccionado = $procesosOctave->tecnologico;
        $riesgo = $procesosOctave->riesgo;
        $model = Proceso::find($procesosOctave->id_proceso);
        $activosProceso = $model->activosAI;

        return view('admin.procesos-octave.edit', compact('activosProceso', 'riesgo', 'tecnologicoSeleccionado', 'reputacionalSeleccionado', 'legalSeleccionado', 'cumplimientoSeleccionado', 'operacionalSeleccionado', 'servicio_seleccionado', 'procesosOctave', 'areas', 'procesos', 'activosInfo', 'servicios', 'matriz'));
    }

    public function update(Request $request, MatrizOctaveProceso $procesosOctave)
    {
        $procesosOctave->update($request->all());
        $matriz = $request->matriz_id;
        $old_proceso = $this->obtenerRamas($procesosOctave);
        ProcesosOctaveHistoricos::create([
            'proceso_id' => $procesosOctave->id,
            'matriz_id' => $matriz,
            'historico' => $old_proceso,
        ]);

        return redirect()->route('admin.procesos-octave.index', ['matriz' => $matriz])->with('success', 'Guardado con éxito');
    }

    public function obtenerRamas($proceso)
    {
        $procesos = collect();
        if (MatrizOctaveProceso::where('id', $proceso->id)->with(['children'])->count() > 0) {
            foreach (MatrizOctaveProceso::where('id', $proceso->id)->with(['children'])->get() as $procesoOctave) {
                $procesos->push($procesoOctave->children);
            }
        }

        return $procesos[0]->toJson();
    }

    public function show()
    {
    }

    public function activos(Request $request)
    {
        $proceso = $request->proceso;
        $model = Proceso::find($proceso);
        $activos = $model->activosAI;

        return $activos;
    }

    public function destroy($procesosOctave)
    {
        $procesosOctave = MatrizOctaveProceso::find($procesosOctave);
        $procesosOctave->delete();

        return back();
    }
}
