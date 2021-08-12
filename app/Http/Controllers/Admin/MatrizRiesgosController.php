<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use App\Models\Area;
use App\Models\Sede;
use App\Models\Team;
use App\Models\Activo;
use App\Models\Amenaza;
use App\Models\Proceso;
use App\Models\Controle;
use App\Models\Empleado;
use App\Models\Tipoactivo;
use App\Functions\Mriesgos;
use App\Models\MatrizRiesgo;
use App\Models\Organizacion;
use App\Models\Vulnerabilidad;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreMatrizRiesgoRequest;
use App\Http\Requests\UpdateMatrizRiesgoRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Requests\MassDestroyMatrizRiesgoRequest;

class MatrizRiesgosController extends Controller
{
    public function index(Request $request)
    {
        /*abort_if(Gate::denies('matriz_riesgo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        abort_if(Gate::denies('configuracion_sede_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');*/

        $query = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        //dd(%$query);
        if ($request->ajax()) {
            $query = MatrizRiesgo::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'configuracion_sede_show';
                $editGate      = 'configuracion_sede_edit';
                $deleteGate    = 'configuracion_sede_delete';
                $crudRoutePart = 'sedes';

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
            $table->editColumn('sede', function ($row) {
                return $row->sede ? $row->sede : "";
            });
            $table->editColumn('foto_sedes', function ($row) {
                return $row->foto_sedes ? $row->foto_sedes : '';
            });
            $table->editColumn('direccion', function ($row) {
                return $row->direccion ? $row->direccion : "";
            });
            $table->editColumn('ubicacion', function ($row) {
                //return "'lat' => ".$row->latitude. ",'long' => ".$row->longitud ? "'lat' => ".$row->latitude. ",'long' =>".$row->longitud : "";
                return $row->id ? $row->id : "";
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgo::count();


        return view('admin.matriz-seguridad', compact('tipoactivos', 'tipoactivos', 'controles', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_riesgo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controles = Controle::get();
        $sedes = Sede::get();
        $areas = Area::get();
        $procesos = Proceso::get();
        $responsables = Empleado::get();
        $activos = Activo::get();
        $amenazas = Amenaza::get();
        $vulnerabilidades = Vulnerabilidad::get();

        return view('admin.matrizRiesgos.create', compact('activos', 'amenazas', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'responsables'))->with('id_analisis', \request()->idAnalisis);
    }

    public function store(StoreMatrizRiesgoRequest $request)
    {
        //dd($request->all());
        $matrizRiesgo = MatrizRiesgo::create($request->all());

        return redirect()->route('admin.matriz-seguridad', ['id' => $request->id_analisis])->with("success", 'Guardado con éxito');
    }

    public function edit(MatrizRiesgo $matrizRiesgo)
    {

        abort_if(Gate::denies('matriz_riesgo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $controles = Controle::all()->pluck('numero', 'id')->prepend(trans('global.pleaseSelect'), '');

        if (!is_null($matrizRiesgo->activo_id)) {
            $matrizRiesgo->load('activo_id', 'controles', 'team');
        }

        $disponibilidadcons = MatrizRiesgo::find($matrizRiesgo->id);
        $disponibilidad = $disponibilidadcons->disponibilidad;
        $integridad = $disponibilidadcons->integridad;
        $confidencialidad = $disponibilidadcons->confidencialidad;


        return view('admin.matrizRiesgos.edit', compact('tipoactivos', 'controles', 'matrizRiesgo', 'disponibilidad', 'integridad', 'confidencialidad',));
    }

    public function update(UpdateMatrizRiesgoRequest $request, MatrizRiesgo $matrizRiesgo)
    {
        $calculo = new Mriesgos();
        $res = $calculo->CalculoD($request);
        $request->request->add(['resultadoponderacion' => $res]);
        $matrizRiesgo->update($request->all());

        return redirect()->route('admin.matriz-riesgos.index')->with("success", 'Editado con éxito');
    }

    public function show(MatrizRiesgo $matrizRiesgo)
    {

        abort_if(Gate::denies('matriz_riesgo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!is_null($matrizRiesgo->activo_id)) {
            $matrizRiesgo->load('activo_id', 'controles');
        }

        return view('admin.matrizRiesgos.show', compact('matrizRiesgo'));
    }

    public function destroy(MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('matriz_riesgo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRiesgo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyMatrizRiesgoRequest $request)
    {
        MatrizRiesgo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /*public function SeguridadInfo(Request $request)
    {
        $query = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        dd($query);
        abort_if(Gate::denies('matriz_riesgo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //$query = MatrizRiesgo::with(['controles', 'team'])->where('id_analisis', '=', $request['id'])->get();
        if ($request->ajax()) {
            //Esta es el error , activo_id no lo encuentra, hay que modificar la relacion en el modelo de matrizriesgo
            $query = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'matriz_riesgo_show';
                $editGate = 'matriz_riesgo_edit';
                $deleteGate = 'matriz_riesgo_delete';
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
            $table->editColumn('id_sede', function ($row) {
                return $row->id_sede ? $row->id_sede : "";
            });

            $table->editColumn('id_proceso', function ($row) {
                return $row->id_proceso ? $row->id_proceso : "";
            });

            $table->editColumn('id_responsable', function ($row) {
                return $row->id_proceso ? $row->id_responsable : "";
            });
            $table->editColumn('activo_id', function ($row) {
                return $row->activo_id ? $row->activo_id : "";
            });
            $table->editColumn('amenaza', function ($row) {
                return $row->amenaza ? $row->amenaza : "";
            });
            $table->editColumn('vulnerabilidad', function ($row) {
                return $row->vulnerabilidad ? $row->vulnerabilidad : "";
            });
            $table->editColumn('descripcionriesgo', function ($row) {
                return $row->descripcionriesgo ? $row->descripcionriesgo : '';
            });
            /*$table->editColumn('tipo_riesgo', function ($row) {
                return $row->tipo_riesgo ? $row->tipo_riesgo : "";
            });
            $table->editColumn('confidencialidad', function ($row) {
                return $row->confidencialidad ? $row->confidencialidad : "";
            });
            $table->editColumn('integridad', function ($row) {
                return $row->integridad ? $row->integridad : "";
            });
            $table->editColumn('disponibilidad', function ($row) {
                return $row->disponibilidad ? $row->disponibilidad : '';
            });
            $table->editColumn('probabilidad', function ($row) {
                return $row->probabilidad ? $row->probabilidad : '';
            });
            $table->editColumn('impacto', function ($row) {
                return $row->impacto ? $row->impacto : "";
            });
            $table->editColumn('nivelriesgo', function ($row) {
                return $row->nivelriesgo ? $row->nivelriesgo : "";
            });
            $table->editColumn('riesgototal', function ($row) {
                return $row->riesgototal ? $row->riesgototal : "";
            });
            $table->editColumn('riesgototal', function ($row) {
                return $row->riesgototal ? $row->riesgototal : "";
            });
            $table->editColumn('controles_id', function ($row) {
                return $row->controles_id ? $row->controles_id : "";
            });
            $table->editColumn('plan_de_accion', function ($row) {
                return $row->plan_de_accion ? $row->plan_de_accion : "";
            });
            $table->editColumn('confidencialidad_cid', function ($row) {
                return $row->confidencialidad_cid ? $row->confidencialidad_cid : "";
            });
            $table->editColumn('integridad_cid', function ($row) {
                return $row->integridad_cid ? $row->integridad_cid : "";
            });
            $table->editColumn('disponibilidad_cid', function ($row) {
                return $row->disponibilidad_cid ? $row->disponibilidad_cid : "";
            });
            $table->editColumn('probabilidad_residual', function ($row) {
                return $row->probabilidad_residual ? $row->probabilidad_residual : "";
            });
            $table->addColumn('impacto_residual', function ($row) {
                return $row->impacto_residual ? $row->impacto_residual : '';
            });
            $table->editColumn('nivelriesgo_residual', function ($row) {
                return $row->nivelriesgo_residual ? $row->nivelriesgo_residual : "";
            });
            $table->editColumn('riesgo_total_residual', function ($row) {
                return $row->riesgo_total_residual ? $row->nivelriesgo_residual : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $tipoactivos = Tipoactivo::get();
        $controles = Controle::get();
        $matriz_heat = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        $sedes = Sede::get();
        $areas = Area::get();
        $procesos = Proceso::get();

        return view('admin.matrizRiesgos.index', compact('tipoactivos', 'tipoactivos', 'controles', 'matriz_heat', 'sedes', 'areas', 'procesos'))->with('idAnalisis', $request['id']);
    }*/

    public function SeguridadInfo(Request $request)
    {
        /*$query = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        dd($query);*/
        abort_if(Gate::denies('configuracion_sede_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'configuracion_sede_show';
                $editGate      = 'configuracion_sede_edit';
                $deleteGate    = 'configuracion_sede_delete';
                $crudRoutePart = 'sedes';

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
            $table->editColumn('id_sede', function ($row) {
                return $row->sede->sede ? $row->sede->sede : "";
            });
            $table->editColumn('id_proceso', function ($row) {
                return $row->proceso->nombre ? $row->proceso->nombre : "";
            });
            $table->editColumn('id_responsable', function ($row) {
                return $row->empleado->name ? $row->empleado->name : "";
            });
            $table->editColumn('activo_id', function ($row) {
                return $row->activo->nombreactivo ? $row->activo->nombreactivo : "";
            });
            $table->editColumn('id_amenaza', function ($row) {
                return $row->amenaza->nombre ? $row->amenaza->nombre : "";
            });
            $table->editColumn('id_vulnerabilidad', function ($row) {
                return $row->vulnerabilidad->nombre ? $row->vulnerabilidad->nombre : "";
            });
            $table->editColumn('descripcionriesgo', function ($row) {
                return $row->descripcionriesgo ? $row->descripcionriesgo : "";
            });
            $table->editColumn('confidencialidad', function ($row) {
                return $row->confidencialidad ? $row->confidencialidad : '';
            });
            $table->editColumn('integridad', function ($row) {
                return $row->integridad ? $row->direccion : "";
            });
            $table->editColumn('disponibilidad', function ($row) {
                return $row->disponibilidad ? $row->disponibilidad : "";
            });
            $table->editColumn('resultadoponderacion', function ($row) {
                return $row->resultadoponderacion ? $row->resultadoponderacion : "";
            });
            $table->editColumn('probabilidad', function ($row) {
                return $row->probabilidad ? $row->probabilidad : "";
            });
            $table->editColumn('impacto', function ($row) {
                return $row->impacto ? $row->impacto : "";
            });
            $table->editColumn('nivelriesgo', function ($row) {
                return $row->nivelriesgo ? $row->nivelriesgo : "";
            });
            $table->editColumn('riesgototal', function ($row) {
                return $row->riesgototal ? $row->riesgototal : "";
            });
            $table->editColumn('control', function ($row) {
                return $row->controles->control ? $row->controles->control : "";
            });
            $table->editColumn('plan_de_accion', function ($row) {
                return $row->plan_de_accion ? $row->plan_de_accion : "";
            });
            $table->editColumn('confidencialidad_cid', function ($row) {
                return $row->confidencialidad_cid ? $row->confidencialidad_cid : "";
            });
            $table->editColumn('integridad_cid', function ($row) {
                return $row->integridad_cid ? $row->integridad_cid : "";
            });
            $table->editColumn('disponibilidad_cid', function ($row) {
                return $row->disponibilidad_cid ? $row->disponibilidad_cid : "";
            });
            $table->editColumn('probabilidad_residual', function ($row) {
                return $row->probabilidad_residual ? $row->probabilidad_residual : "";
            });
            $table->editColumn('impacto_residual', function ($row) {
                return $row->impacto_residual ? $row->impacto_residual : "";
            });
            $table->editColumn('nivelriesgo_residual', function ($row) {
                return $row->nivelriesgo_residual ? $row->nivelriesgo_residual : "";
            });
            $table->editColumn('riesto_total_residual', function ($row) {
                return $row->riesto_total_residual ? $row->riesto_total_residual : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacions = Organizacion::all();
        //$org = $organizacions->organizacion;
        //dd($organizacions->organizacion, $organizacions);
        $teams = Team::get();
        $tipoactivos = Tipoactivo::get();
        $controles = Controle::get();
        $matriz_heat = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        $sedes = Sede::get();
        $areas = Area::get();
        $procesos = Proceso::get();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgo::count();

        //$sede_inicio = !is_null($sedes) ? url('images/' . DB::table('organizacions')->select('logotipo')->first()->logotipo) : url('img/Silent4Business-Logo-Color.png');


        return view('admin.matrizRiesgos.index', compact('sedes', 'areas', 'procesos' ,'organizacions', 'teams', 'numero_sedes', 'numero_matriz'))->with('id_matriz', $request['id']);
    }
}
