<?php

namespace App\Http\Controllers\Frontend;

use App\Functions\Mriesgos;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatrizRiesgoRequest;
use App\Http\Requests\StoreMatrizRiesgoRequest;
use App\Http\Requests\UpdateMatrizRiesgoRequest;
use App\Models\Activo;
use App\Models\Amenaza;
use App\Models\Area;
use App\Models\Controle;
use App\Models\DeclaracionAplicabilidad;
use App\Models\Empleado;
use App\Models\MatrizRiesgo;
use App\Models\MatrizRiesgosControlesPivot;
use App\Models\Organizacion;
use App\Models\PlanImplementacion;
//use Illuminate\Support\Facades\Request;
use App\Models\Proceso;
use App\Models\Sede;
use App\Models\Team;
use App\Models\Tipoactivo;
use App\Models\Vulnerabilidad;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MatrizRiesgosController extends Controller
{
    /*public function index(Request $request)
    {
        /*abort_if(Gate::denies('matriz_riesgo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        abort_if(Gate::denies('configuracion_sede_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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


        return view('frontend.matriz-seguridad', compact('tipoactivos', 'tipoactivos', 'controles', 'teams'));
    }*/

    public function create()
    {
        abort_if(Gate::denies('iso_27001_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sedes = Sede::getAll();
        $areas = Area::getAll();
        $procesos = Proceso::getAll();
        $responsables = Empleado::getAll();
        $activos = Activo::getAll();
        $amenazas = Amenaza::get();

        $vulnerabilidades = Vulnerabilidad::get();
        $controles = DeclaracionAplicabilidad::getAll(['id', 'anexo_indice', 'anexo_politica']);

        return view('frontend.matrizRiesgos.create', compact('activos', 'amenazas', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'responsables'))->with('id_analisis', \request()->idAnalisis);
    }

    public function store(StoreMatrizRiesgoRequest $request)
    {
        //$request->merge(['plan_de_accion' => $request['plan_accion']['0']]);

        $matrizRiesgo = MatrizRiesgo::create($request->all());

        foreach ($request->controles_id as $item) {
            $control = new MatrizRiesgosControlesPivot();
            // $control->matriz_id = 2;
            $control->matriz_id = $matrizRiesgo->id;
            $control->controles_id = $item;
            $control->save();
        }

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRiesgo->planes()->sync($request->plan_accion);
        }

        return redirect()->route('matriz-seguridad', ['id' => $request->id_analisis])->with('success', 'Guardado con éxito');
    }

    public function edit(MatrizRiesgo $matrizRiesgo)
    {
        $organizacions = Organizacion::getAll();
        $teams = Team::get();
        $activos = Activo::getAll();
        $tipoactivos = Tipoactivo::getAll();
        $controles = Controle::get();
        $sedes = Sede::getAll();
        $areas = Area::getAll();
        $amenazas = Amenaza::get();
        $procesos = Proceso::getAll();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgo::count();
        $responsables = Empleado::getAll();
        $vulnerabilidades = Vulnerabilidad::get();
        $planes_seleccionados = [];
        $planes = $matrizRiesgo->load('planes');
        if ($matrizRiesgo->planes) {
            foreach ($matrizRiesgo->planes as $plan) {
                array_push($planes_seleccionados, $plan->id);
            }
        }

        return view('frontend.matrizRiesgos.edit', compact('planes_seleccionados', 'matrizRiesgo', 'vulnerabilidades', 'controles', 'amenazas', 'activos', 'sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz', 'tipoactivos', 'responsables'));
    }

    public function update(UpdateMatrizRiesgoRequest $request, MatrizRiesgo $matrizRiesgo)
    {
        $calculo = new Mriesgos();
        $res = $calculo->CalculoD($request);
        $request->request->add(['resultadoponderacion' => $res]);
        $matrizRiesgo->update($request->all());

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRiesgo->planes()->sync($request->plan_accion);
        }

        return redirect()->route('matriz-seguridad', ['id' => $request->id_analisis])->with('success', 'Actualizado con éxito');
    }

    public function show(MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('matriz_riesgo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        /*if (!is_null($matrizRiesgo->activo_id)) {
            $matrizRiesgo->load('activo_id', 'controles');
        }*/

        return view('frontend.matrizRiesgos.show', compact('matrizRiesgo'));
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

    public function SeguridadInfo(Request $request)
    {
        // dd($request->all());
        /*$query = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        dd($query);*/
        abort_if(Gate::denies('configuracion_sede_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizRiesgo::with(['controles', 'matriz_riesgos_controles_pivots' => function ($query) {
                return $query->with('declaracion_aplicabilidad');
            }])->where('id_analisis', '=', $request['id'])->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'configuracion_sede_show';
                $editGate = 'configuracion_sede_edit';
                $deleteGate = 'configuracion_sede_delete';
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
                return $row->id ? $row->id : '';
            });
            $table->editColumn('id_sede', function ($row) {
                return $row->sede ? $row->sede->sede : '';
            });
            $table->editColumn('id_proceso', function ($row) {
                return $row->proceso ? $row->proceso->nombre : '';
            });
            $table->editColumn('id_responsable', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });
            $table->editColumn('activo_id', function ($row) {
                return $row->activo ? $row->activo->nombreactivo : '';
            });
            $table->editColumn('id_amenaza', function ($row) {
                return $row->amenaza ? $row->amenaza->nombre : '';
            });
            $table->editColumn('id_vulnerabilidad', function ($row) {
                return $row->vulnerabilidad ? $row->vulnerabilidad->nombre : '';
            });
            $table->editColumn('descripcionriesgo', function ($row) {
                return $row->descripcionriesgo ? $row->descripcionriesgo : '';
            });
            $table->editColumn('confidencialidad', function ($row) {
                if ($row->confidencialidad) {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('integridad', function ($row) {
                if ($row->integridad) {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('disponibilidad', function ($row) {
                if ($row->disponibilidad) {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('resultadoponderacion', function ($row) {
                return $row->resultadoponderacion ? $row->resultadoponderacion : '';
            });
            $table->editColumn('probabilidad', function ($row) {
                //return $row->probabilidad ? $row->probabilidad : "";
                switch ($row->probabilidad) {
                    case 0:
                        return 'NULA' ? 'NULA' : '';
                        break;
                    case 3:
                        return 'BAJA' ? 'BAJA' : '';
                        break;
                    case 6:
                        return 'MEDIA' ? 'MEDIA' : '';
                        break;
                    case 9:
                        return 'ALTA' ? 'ALTA' : '';
                        break;
                    default:
                        break;
                }
            });
            $table->editColumn('impacto', function ($row) {
                //return $row->impacto ? $row->impacto : "";
                switch ($row->impacto) {
                    case 0:
                        return 'BAJO' ? 'BAJO' : '';
                        break;
                    case 3:
                        return 'MEDIO' ? 'MEDIO' : '';
                        break;
                    case 6:
                        return 'ALTO' ? 'ALTO' : '';
                        break;
                    case 9:
                        return 'MUY ALTO' ? 'MUY ALTO' : '';
                        break;
                    default:
                        break;
                }
            });
            $table->editColumn('nivelriesgo', function ($row) {
                if (is_null($row->nivelriesgo)) {
                    return null ? $row->nivelriesgo : '';
                } else {
                    return $row->nivelriesgo ? $row->nivelriesgo : '';
                }
            });
            /*$table->editColumn('riesgototal', function ($row) {
                return $row->riesgototal ? $row->riesgototal : "";
            });*/
            $table->editColumn('control', function ($row) {
                return $row->matriz_riesgos_controles_pivots ? $row->matriz_riesgos_controles_pivots : '';
            });
            $table->editColumn('plan_de_accion', function ($row) {
                return $row->planes ? $row->planes : '';
            });
            $table->editColumn('confidencialidad_cid', function ($row) {
                if ($row->confidencialidad_cid) {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('integridad_cid', function ($row) {
                if ($row->integridad_cid) {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('disponibilidad_cid', function ($row) {
                if ($row->disponibilidad_cid) {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('probabilidad_residual', function ($row) {
                //return $row->probabilidad_residual ? $row->probabilidad_residual : "";
                switch ($row->probabilidad_residual) {
                    case 0:
                        return 'NULA' ? 'NULA' : '';
                        break;
                    case 3:
                        return 'BAJA' ? 'BAJA' : '';
                        break;
                    case 6:
                        return 'MEDIA' ? 'MEDIA' : '';
                        break;
                    case 9:
                        return 'ALTA' ? 'ALTA' : '';
                        break;
                    default:
                        break;
                }
            });
            $table->editColumn('impacto_residual', function ($row) {
                //return $row->impacto_residual ? $row->impacto_residual : "";
                switch ($row->impacto_residual) {
                    case 0:
                        return 'BAJO' ? 'BAJO' : '';
                        break;
                    case 3:
                        return 'MEDIO' ? 'MEDIO' : '';
                        break;
                    case 6:
                        return 'ALTO' ? 'ALTO' : '';
                        break;
                    case 9:
                        return 'MUY ALTO' ? 'MUY ALTO' : '';
                        break;
                    default:
                        break;
                }
            });
            $table->editColumn('nivelriesgo_residual', function ($row) {
                return $row->nivelriesgo_residual ? $row->nivelriesgo_residual : '';
            });
            $table->editColumn('riesto_total_residual', function ($row) {
                return $row->riesto_total_residual ? $row->riesto_total_residual : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacions = Organizacion::getAll();
        $teams = Team::get();
        $tipoactivos = Tipoactivo::getAll();
        $controles = Controle::get();
        $matriz_heat = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        $sedes = Sede::getAll();
        $areas = Area::getAll();
        $procesos = Proceso::getAll();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgo::count();

        return view('frontend.matrizRiesgos.index', compact('sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz'))->with('id_matriz', $request['id']);
    }

    public function MapaCalor(Request $request)
    {
        return view('frontend.matrizRiesgos.heatchart')->with('id', $request->idAnalisis);
    }

    public function createPlanAccion(MatrizRiesgo $id)
    {
        $planImplementacion = new PlanImplementacion();
        $modulo = $id;
        $modulo_name = 'Matríz de Riegos';
        $referencia = $modulo->nombrerequisito;
        $urlStore = route('matriz-requisito-legales.storePlanAccion', $id);

        return view('frontend.planesDeAccion.create', compact('planImplementacion', 'modulo_name', 'modulo', 'referencia', 'urlStore'));
    }

    public function storePlanAccion(Request $request, MatrizRiesgo $id)
    {
        $request->validate([
            'parent' => 'required|string',
            'norma' => 'required|string',
            'modulo_origen' => 'required|string',
            'objetivo' => 'required|string',
        ], [
            'parent.required' => 'Debes de definir un nombre para el plan de acción',
            'norma.required' => 'Debes de definir una norma para el plan de acción',
            'modulo_origen.required' => 'Debes de definir un módulo de origen para el plan de acción',
            'objetivo.required' => 'Debes de definir un objetivo para el plan de acción',
        ]);

        $planImplementacion = new PlanImplementacion(); // Necesario se carga inicialmente el Diagrama Universal de Gantt
        $planImplementacion->tasks = [];
        $planImplementacion->canAdd = true;
        $planImplementacion->canWrite = true;
        $planImplementacion->canWriteOnParent = true;
        $planImplementacion->changesReasonWhy = false;
        $planImplementacion->selectedRow = 0;
        $planImplementacion->zoom = '3d';
        $planImplementacion->parent = $request->parent;
        $planImplementacion->norma = $request->norma;
        $planImplementacion->modulo_origen = $request->modulo_origen;
        $planImplementacion->objetivo = $request->objetivo;
        $planImplementacion->elaboro_id = auth()->user()->empleado->id;

        $matrizRequisitoLegal = $id;
        $matrizRequisitoLegal->planes()->save($planImplementacion);

        return redirect()->route('matriz-requisito-legales.index')->with('success', 'Plan de Acción' . $planImplementacion->parent . ' creado');
    }

    public function ControlesGet()
    {
    }
}
