<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatrizRiesgoRequest;
use App\Http\Requests\StoreMatrizRiesgoRequest;
use App\Http\Requests\UpdateMatrizRiesgoRequest;
use App\Models\Activo;
use App\Models\Tipoactivo;
use App\Models\Controle;
use App\Models\MatrizRiesgo;
use App\Models\Team;
use DB;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MatrizRiesgosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('matriz_riesgo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MatrizRiesgo::with(['activo', 'controles', 'team'])->select(sprintf('%s.*', (new MatrizRiesgo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'matriz_riesgo_show';
                $editGate      = 'matriz_riesgo_edit';
                $deleteGate    = 'matriz_riesgo_delete';
                $crudRoutePart = 'matriz-riesgos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('proceso', function ($row) {
                return $row->proceso ? $row->proceso : "";
            });
            $table->addColumn('activo_descripcion', function ($row) {
                return $row->activo ? $row->activo->descripcion : '';
            });

            $table->editColumn('responsableproceso', function ($row) {
                return $row->responsableproceso ? $row->responsableproceso : "";
            });
            $table->editColumn('amenaza', function ($row) {
                return $row->amenaza ? $row->amenaza : "";
            });
            $table->editColumn('vulnerabilidad', function ($row) {
                return $row->vulnerabilidad ? $row->vulnerabilidad : "";
            });
            $table->editColumn('descripcionriesgo', function ($row) {
                return $row->descripcionriesgo ? $row->descripcionriesgo : "";
            });
            $table->editColumn('tipo_riesgo', function ($row) {
                return $row->tipo_riesgo ? MatrizRiesgo::TIPO_RIESGO_SELECT[$row->tipo_riesgo] : '';
            });


            $table->editColumn('confidencialidad', function ($row) {
                    return $row->confidencialidad ? $row->confidencialidad : "";
            });
            $table->editColumn('integridad', function ($row) {
                return $row->integridad ? $row->integridad : "";
            });
            $table->editColumn('disponibilidad', function ($row) {
                return $row->disponibilidad ? $row->disponibilidad: "";
            });
            $table->editColumn('probabilidad', function ($row) {
                return $row->probabilidad ? MatrizRiesgo::PROBABILIDAD_SELECT[$row->probabilidad] : '';
            });
            $table->editColumn('impacto', function ($row) {
                return $row->impacto ? MatrizRiesgo::IMPACTO_SELECT[$row->impacto] : '';
            });
            $table->editColumn('nivelriesgo', function ($row) {
                return $row->nivelriesgo ? $row->nivelriesgo : "";
            });
            $table->editColumn('riesgototal', function ($row) {
                return $row->riesgototal ? $row->riesgototal : "";
            });
            $table->editColumn('resultadoponderacion', function ($row) {
                return $row->resultadoponderacion ? $row->resultadoponderacion : "";
            });
            $table->editColumn('riesgoresidual', function ($row) {
                return $row->riesgoresidual ? $row->riesgoresidual : "";
            });
            $table->addColumn('controles_numero', function ($row) {
                return $row->controles ? $row->controles->numero : '';
            });

            $table->editColumn('justificacion', function ($row) {
                return $row->justificacion ? $row->justificacion : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'activo', 'controles']);

            return $table->make(true);
        }

//        $matrizRiesgo  = MatrizRiesgo::SELECT('confidencialidad', 'disponibilidad', 'integridad')->get();
        //$matrizRiesgo = MatrizRiesgo::all();


        $desglose = "SELECT * FROM gestion_normativa.matriz_riesgos";
        $result1 = DB::SELECT($desglose);
        $matrizRiesgo = DB::table('matriz_riesgos')->select('confidencialidad', 'disponibilidad', 'integridad')->get();
        $conf = 0;
        $disp = 0;
        $intg = 0;

        foreach ($matrizRiesgo as $key) {
            if ($key['confidencialidad'] = "SI") {
              $conf += 3.3;
            }
            if ($key['disponibilidad'] = "SI") {
              $disp += 3.3;
            }else {
              $disp += 0;
            }
            if ($key['integridad'] = "SI") {
              $intg += 3.3;
            }

        }
        dd($matrizRiesgo);
        $activos   = Activo::get();
        $controles = Controle::get();
        $teams     = Team::get();

        return view('admin.matrizRiesgos.index', compact('activos', 'controles', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_riesgo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        /*$activos = Activo::all()->pluck('descripcion', 'id')->prepend(trans('global.pleaseSelect'), '');*/

        $activos = Tipoactivo::all();

      /*  dd($activos);*/

        $controles = Controle::all()->pluck('numero', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.matrizRiesgos.create', compact('activos', 'controles'));
    }

    public function store(StoreMatrizRiesgoRequest $request)
    {
        $matrizRiesgo = MatrizRiesgo::create($request->all());
        //dd($matrizRiesgo);

        return redirect()->route('admin.matriz-riesgos.index');
    }

    public function edit(MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('matriz_riesgo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activos = Activo::all()->pluck('descripcion', 'id')->prepend(trans('global.pleaseSelect'), '');

        $controles = Controle::all()->pluck('numero', 'id')->prepend(trans('global.pleaseSelect'), '');

        $matrizRiesgo->load('activo', 'controles', 'team');

        return view('admin.matrizRiesgos.edit', compact('activos', 'controles', 'matrizRiesgo'));
    }

    public function update(UpdateMatrizRiesgoRequest $request, MatrizRiesgo $matrizRiesgo)
    {
        $matrizRiesgo->update($request->all());

        return redirect()->route('admin.matriz-riesgos.index');
    }

    public function show(MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('matriz_riesgo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRiesgo->load('activo', 'controles', 'team');

        return view('admin.matrizRiesgos.show', compact('matrizRiesgo'));
    }

    public function destroy(MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('matriz_riesgo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRiesgo->delete();

        return back();
    }

    public function massDestroy(MassDestroyMatrizRiesgoRequest $request)
    {
        MatrizRiesgo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
