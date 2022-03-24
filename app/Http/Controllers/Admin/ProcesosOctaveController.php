<?php

namespace App\Http\Controllers\admin;

use App\Models\Area;
use App\Models\Grupo;
use App\Models\Proceso;
use Illuminate\Http\Request;
use App\Models\ActivoInformacion;
use App\Models\MatrizOctaveProceso;
use App\Http\Controllers\Controller;
use App\Models\MatrizOctaveServicio;
use Yajra\DataTables\Facades\DataTables;



class ProcesosOctaveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MatrizOctaveProceso::with(['area'])->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_riesgos_vulnerabilidades_edit';
                $editGate = 'analisis_de_riesgos_vulnerabilidades_show';
                $deleteGate = 'analisis_de_riesgos_vulnerabilidades_delete';
                $crudRoutePart = 'procesos-octave';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        // dd($request->all());
        return view('admin.procesos-octave.index');
    }

    public function create()
    {
        $areas = Area::get();
        $procesos = Proceso::get();
        $activosInfo = ActivoInformacion::get();
        $servicios = MatrizOctaveServicio::get();
        $servicio_seleccionado = null;
        $grupos = Grupo::get();

        return view('admin.procesos-octave.create', compact('grupos','areas', 'procesos', 'activosInfo', 'servicios', 'servicio_seleccionado'));
    }

    public function store(Request $request)
    {
        $procesosOctave = MatrizOctaveProceso::create($request->all());

        return redirect()->route('admin.procesos-octave.index');
    }

    public function edit($procesosOctave)
    {
        $areas = Area::get();
        $procesos = Proceso::get();
        $activosInfo = ActivoInformacion::get();
        $servicios = MatrizOctaveServicio::get();
        $procesosOctave = MatrizOctaveProceso::find( $procesosOctave);
        $servicio_seleccionado = $procesosOctave->servicio_id;
        // dd($procesosOctave->operacional);
        $operacionalSeleccionado = $procesosOctave->operacional;
        $cumplimientoSeleccionado = $procesosOctave->cumplimiento;
        $legalSeleccionado = $procesosOctave->legal;
        $reputacionalSeleccionado = $procesosOctave->reputacional;
        $tecnologicoSeleccionado = $procesosOctave->tecnologico;
        $riesgo=$procesosOctave->riesgo;
        $model = Proceso::find($procesosOctave->id_proceso);
        $activosProceso = $model->activosAI;
        return view('admin.procesos-octave.edit', compact('activosProceso','riesgo','tecnologicoSeleccionado','reputacionalSeleccionado','legalSeleccionado','cumplimientoSeleccionado','operacionalSeleccionado','servicio_seleccionado','procesosOctave','areas', 'procesos', 'activosInfo', 'servicios'));
    }

    public function update(Request $request, MatrizOctaveProceso $procesosOctave)
    {
        // $procesosOctave = MatrizOctaveProceso::create($request->all());
        $procesosOctave->update($request->all());

        return redirect()->route('admin.procesos-octave.index');
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
       $procesosOctave=MatrizOctaveProceso::find($procesosOctave);
        $procesosOctave->delete();

        return back();
    }

}
