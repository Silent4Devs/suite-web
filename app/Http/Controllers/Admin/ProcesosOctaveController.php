<?php

namespace App\Http\Controllers\admin;

use App\Models\Area;
use App\Models\Proceso;
use Illuminate\Http\Request;
use App\Models\ActivoInformacion;
use App\Models\MatrizOctaveProceso;
use App\Http\Controllers\Controller;
use App\Models\MatrizOctaveServicio;

class ProcesosOctaveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MatrizOctaveProceso::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_riesgos_vulnerabilidades_edit';
                $editGate = 'analisis_de_riesgos_vulnerabilidades_show';
                $deleteGate = 'analisis_de_riesgos_vulnerabilidades_delete';
                $crudRoutePart = 'carta-aceptacion';

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
                return $row->proceso ? $row->proceso : '';
            });

            $table->editColumn('nivel_riesgo', function ($row) {
                return $row->nivel_riesgo ? $row->nivel_riesgo : '';
            });

            $table->editColumn('direccion', function ($row) {
                return $row->grupo ? $row->grupo->nombre : '';
            });

            $table->editColumn('servicio', function ($row) {
                return $row->servicio ? $row->servicio->servicio : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.procesos-octave.index');
    }


    public function create(){

        $areas=Area::get();
        $procesos = Proceso::get();
        $activosInfo = ActivoInformacion::get();
        $servicios=MatrizOctaveServicio::get();

        return view('admin.procesos-octave.create', compact('areas','procesos', 'activosInfo','servicios'));
    }

    public function store(Request $request)
    {

        $procesosOctave = MatrizOctaveProceso::create($request->all());


        return redirect()->route('admin.procesos-octave.index');
    }

    public function edit(){

        $areas=Area::get();
        $procesos = Proceso::get();
        $activosInfo = ActivoInformacion::get();
        $servicios=MatrizOctaveServicio::get();

        return view('admin.procesos-octave.edit', compact('areas','procesos', 'activosInfo','servicios'));
    }

    public function update(Request $request, MatrizOctaveProceso $procesosOctave)
    {
        $procesosOctave = MatrizOctaveProceso::create($request->all());

        return redirect()->route('admin.procesos-octave.index');
    }

    public function show(){

    }
}
