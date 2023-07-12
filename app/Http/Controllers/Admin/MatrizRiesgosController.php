<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Mriesgos;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatrizRiesgoRequest;
use App\Http\Requests\StoreMatrizRiesgoRequest;
use App\Http\Requests\UpdateMatrizRiesgoRequest;
use App\Models\Activo;
use App\Models\ActivoInformacion;
use App\Models\Amenaza;
use App\Models\Area;
use App\Models\Controle;
use App\Models\DeclaracionAplicabilidad;
use App\Models\Empleado;
use App\Models\Matriz31000ActivosInfo;
use App\Models\MatrizIso31000;
use App\Models\MatrizIso31000ControlesPivot;
use App\Models\MatrizNist;
//use Illuminate\Support\Facades\Request;
use App\Models\MatrizOctave;
use App\Models\MatrizoctaveActivosInfo;
use App\Models\MatrizOctaveProceso;
use App\Models\MatrizOctaveServicio;
use App\Models\MatrizRiesgo;
use App\Models\MatrizRiesgosControlesPivot;
use App\Models\MatrizRiesgosSistemaGestion;
use App\Models\Organizacion;
use App\Models\PlanImplementacion;
use App\Models\Proceso;
use App\Models\Sede;
use App\Models\SubcategoriaActivo;
use App\Models\Team;
use App\Models\Tipoactivo;
use App\Models\TratamientoRiesgo;
use App\Models\Vulnerabilidad;
use App\Models\Iso27\GapDosCatalogoIso;
use App\Models\VersionesIso;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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


        return view('admin.matriz-seguridad', compact('tipoactivos', 'tipoactivos', 'controles', 'teams'));
    }*/

    public function create()
    {
        abort_if(Gate::denies('iso_27001_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ver = VersionesIso::select('version_historico')->first();
        if($ver->version_historico === true ){
            $version_historico = "true";
        }elseif($ver->version_historico === false ){
            $version_historico = "false";
        }

        $sedes = Sede::select('id', 'sede')->get();
        //$areas = Area::get();
        $procesos = Proceso::select('id', 'codigo', 'nombre')->get();
        $responsables = Empleado::select('id', 'name', 'area_id', 'puesto_id')->alta()->get();

        $activos = SubcategoriaActivo::select('id', 'subcategoria')->get();
        $amenazas = Amenaza::select('id', 'nombre')->get();

        $vulnerabilidades = Vulnerabilidad::select('id', 'nombre')->get();

        if($version_historico === "true"){
            $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->orderBy('id')->get();
        }elseif($version_historico === "false"){
            $controles = GapDosCatalogoIso::select('id', 'control_iso', 'anexo_politica')->orderBy('id')->get();
        }

        $tipo_riesgo = MatrizRiesgo::TIPO_RIESGO_SELECT;
        $probabilidad = MatrizRiesgo::PROBABILIDAD_SELECT;
        $impacto = MatrizRiesgo::IMPACTO_SELECT;

        return view('admin.matrizRiesgos.create', compact('version_historico', 'activos', 'amenazas', 'vulnerabilidades', 'sedes', 'procesos', 'controles', 'responsables', 'tipo_riesgo', 'probabilidad', 'impacto'))->with('id_analisis', \request()->idAnalisis, );
    }

    public function store(StoreMatrizRiesgoRequest $request)
    {
        abort_if(Gate::denies('iso_27001_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $matrizRiesgo = MatrizRiesgo::create($request->all());

        foreach ($request->controles_id as $item) {
            $control = new MatrizRiesgosControlesPivot();
            // $control->matriz_id = 2;
            $control->version_historico = $matrizRiesgo->version_historico;
            $control->matriz_id = $matrizRiesgo->id;
            $control->controles_id = $item;
            $control->save();
        }

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRiesgo->planes()->sync($request->plan_accion);
        }

        return redirect()->route('admin.matriz-seguridad', ['id' => $request->id_analisis])->with('success', 'Guardado con éxito');
    }

    public function edit(MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('iso_27001_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacions = Organizacion::all();
        $teams = Team::get();
        $activos = SubcategoriaActivo::get();
        $tipoactivos = Tipoactivo::get();
        $controlesSeleccionado = [];
        if ($matrizRiesgo->matriz_riesgos_controles_pivots != null) {
            $controlesSeleccionado = $matrizRiesgo->matriz_riesgos_controles_pivots->pluck('id')->toArray();
        }
        if($matrizRiesgo->version_historico === true OR $matrizRiesgo->version_historico === null){
            $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->orderBy('id')->get();
        }elseif($matrizRiesgo->version_historico === false){
            $controles = GapDosCatalogoIso::select('id', 'control_iso', 'anexo_politica')->orderBy('id')->get();
        }
        // dd($matrizRiesgo->version_historico, $controles);
        $sedes = Sede::getAll();
        $areas = Area::get();
        $amenazas = Amenaza::get();
        $procesos = Proceso::get();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgo::count();
        $responsables = Empleado::alta()->get();
        $vulnerabilidades = Vulnerabilidad::get();
        $planes_seleccionados = [];
        $planes = $matrizRiesgo->load('planes');
        if ($matrizRiesgo->planes) {
            foreach ($matrizRiesgo->planes as $plan) {
                array_push($planes_seleccionados, $plan->id);
            }
        }

        return view('admin.matrizRiesgos.edit', compact('planes_seleccionados', 'matrizRiesgo', 'vulnerabilidades', 'controles', 'amenazas', 'activos', 'sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz', 'tipoactivos', 'responsables'));
    }

    public function update(UpdateMatrizRiesgoRequest $request, MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('iso_27001_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $calculo = new Mriesgos();

        $matrizRiesgo->update($request->all());
        $matrizRiesgo->matriz_riesgos_controles_pivots()->sync($request->controles_id);

        if (isset($request->plan_accion)) {
            $matrizRiesgo->planes()->sync($request->plan_accion);
        }

        return redirect()->route('admin.matriz-seguridad', ['id' => $request->id_analisis])->with('success', 'Actualizado con éxito');
    }

    public function show(MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('iso_27001_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        /*if (!is_null($matrizRiesgo->activo_id)) {
            $matrizRiesgo->load('activo_id', 'controles');
        }*/

        return view('admin.matrizRiesgos.show', compact('matrizRiesgo'));
    }

    public function destroy(MatrizRiesgo $matrizRiesgo)
    {
        abort_if(Gate::denies('iso_27001_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRiesgo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyMatrizRiesgoRequest $request)
    {
        abort_if(Gate::denies('iso_27001_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        MatrizRiesgo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function SeguridadInfo(Request $request)
    {
        abort_if(Gate::denies('matriz_de_riesgo_vinculo'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizRiesgo::with(['controles', 'matriz_riesgos_controles_pivots'])->where('id_analisis', '=', $request->id)->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'iso_27001_ver';
                $editGate = 'iso_27001_editar';
                $deleteGate = 'iso_27001_eliminar';
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
                return $row->activo ? $row->activo->subcategoria : '';
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
                if ($row->confidencialidad == 'on') {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('integridad', function ($row) {
                if ($row->integridad == 'on') {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('disponibilidad', function ($row) {
                if ($row->disponibilidad == 'on') {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('resultadoponderacion', function ($row) {
                return $row->resultadoponderacion ? $row->resultadoponderacion : '';
            });
            $table->editColumn('probabilidad', function ($row) {
                return $row->probabilidad ? $row->probabilidad : '';
            });
            $table->editColumn('impacto', function ($row) {
                return $row->impacto ? $row->impacto : '';
            });
            $table->editColumn('nivelriesgo', function ($row) {
                return $row->nivelriesgo ? $row->nivelriesgo : '';
            });
            $table->editColumn('version_historico', function ($row) {
                return $row->version_historico ? $row->version_historico : '';
            });

            $table->editColumn('control', function ($row) {
                if($row->version_historico === true){
                    return $row->matriz_riesgos_controles_pivots ? $row->matriz_riesgos_controles_pivots : '';
                }else{
                    $controles = MatrizRiesgosControlesPivot::select('gap_dos_catalogo_isos.control_iso AS anexo_indice', 'gap_dos_catalogo_isos.anexo_politica AS anexo_politica')
                    ->where('matriz_riesgos_controles_pivot.version_historico', '=', 'false')
                    ->join('gap_dos_catalogo_isos', 'gap_dos_catalogo_isos.id', '=', 'matriz_riesgos_controles_pivot.controles_id' )
                    ->orderBy('gap_dos_catalogo_isos.id')
                    ->get();
                     return $controles ? $controles: '';
                }
            });
            $table->editColumn('plan_de_accion', function ($row) {
                return $row->planes ? $row->planes : '';
            });
            $table->editColumn('confidencialidad_cid', function ($row) {
                if ($row->confidencialidad_cid == 'on') {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('integridad_cid', function ($row) {
                if ($row->integridad_cid == 'on') {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('disponibilidad_cid', function ($row) {
                if ($row->disponibilidad_cid == 'on') {
                    return 'Sí' ? 'Sí' : '';
                } else {
                    return 'No' ? 'No' : '';
                }
            });
            $table->editColumn('resultadoponderacionRes', function ($row) {
                return $row->resultadoponderacionRes ? $row->resultadoponderacionRes : '';
            });
            $table->editColumn('probabilidad_residual', function ($row) {
                return $row->probabilidad_residual ? $row->probabilidad_residual : '';
            });
            $table->editColumn('impacto_residual', function ($row) {
                return $row->impacto_residual ? $row->impacto_residual : '';
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

        $organizacions = Organizacion::all();
        $teams = Team::get();
        $tipoactivos = Tipoactivo::get();
        $controles = Controle::get();
        $matriz_heat = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgo::count();
        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.matrizRiesgos.index', compact('empresa_actual', 'logo_actual', 'sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz'))->with('id_matriz', $request['id']);
    }

    public function MapaCalor(Request $request)
    {
        return view('admin.matrizRiesgos.heatchart')->with('id', $request->idAnalisis);
    }

    public function MapaCalorOctave(Request $request)
    {
        return view('admin.OCTAVE.heatchart')->with('id', $request->idAnalisis);
    }

    public function createPlanAccion(MatrizRiesgo $id)
    {
        $planImplementacion = new PlanImplementacion();
        $modulo = $id;
        $modulo_name = 'Matríz de Riegos';
        $referencia = $modulo->nombrerequisito;
        $urlStore = route('admin.matriz-requisito-legales.storePlanAccion', $id);

        return view('admin.planesDeAccion.create', compact('planImplementacion', 'modulo_name', 'modulo', 'referencia', 'urlStore'));
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

        return redirect()->route('admin.matriz-requisito-legales.index')->with('success', 'Plan de Acción' . $planImplementacion->parent . ' creado');
    }

    public function ControlesGet()
    {
    }

    public function SistemaGestion(Request $request)
    {
        abort_if(Gate::denies('matriz_de_riesgo_vinculo'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::all();
        $teams = Team::get();
        $tipoactivos = Tipoactivo::get();
        $controles = Controle::get();
        $matriz_heat = MatrizRiesgosSistemaGestion::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgosSistemaGestion::count();
        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.matrizSistemaGestion.index', compact('empresa_actual', 'logo_actual', 'sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz'))->with('id_matriz', $request['id']);
    }

    public function SistemaGestionData(Request $request)
    {
        abort_if(Gate::denies('matriz_de_riesgo_vinculo'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizRiesgosSistemaGestion::with(['controles', 'matriz_riesgos_controles_pivots'])->where('id_analisis', '=', $request->id)->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_riesgo_integral_ver';
                $editGate = 'analisis_de_riesgo_integral_editar';
                $deleteGate = 'analisis_de_riesgo_integral_eliminar';
                $crudRoutePart = 'matriz-riesgos.sistema-gestion';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('identificador', function ($row) {
                return $row->identificador ? $row->identificador : '';
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
                return $row->activo ? $row->activo->subcategoria : '';
            });
            $table->editColumn('id_amenaza', function ($row) {
                return $row->amenaza ? $row->amenaza->nombre : '';
            });
            $table->editColumn('id_vulnerabilidad', function ($row) {
                return $row->vulnerabilidad ? $row->vulnerabilidad->nombre : '';
            });
            $table->editColumn('tipo_riesgo', function ($row) {
                return $row->tipo_riesgo ? $row->tipo_riesgo : '';
            });
            $table->editColumn('descripcionriesgo', function ($row) {
                return $row->descripcionriesgo ? $row->descripcionriesgo : '';
            });
            $table->editColumn('calidad_servicio', function ($row) {
                // return $row->confidencialidad_270000 ? $row->confidencialidad_270000 : '';
                if ($row->calidad_servicio == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('cliente', function ($row) {
                // return $row->integridad_27000 ? $row->integridad_27000 : '';
                if ($row->cliente == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('estrategia_negocio', function ($row) {
                // return $row->disponibilidad_27000 ? $row->disponibilidad_27000 : '';
                if ($row->estrategia_negocio == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('disponibilidad_2000', function ($row) {
                // return $row->confidencialidad_270000 ? $row->confidencialidad_270000 : '';
                if ($row->disponibilidad_2000 == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('niveles_servicio', function ($row) {
                // return $row->integridad_27000 ? $row->integridad_27000 : '';
                if ($row->niveles_servicio == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('continuidad_BCP', function ($row) {
                // return $row->disponibilidad_27000 ? $row->disponibilidad_27000 : '';
                if ($row->continuidad_BCP == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('confidencialidad_270000', function ($row) {
                // return $row->confidencialidad_270000 ? $row->confidencialidad_270000 : '';
                if ($row->confidencialidad_270000 == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('integridad_27000', function ($row) {
                // return $row->integridad_27000 ? $row->integridad_27000 : '';
                if ($row->integridad_27000 == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('disponibilidad_27000', function ($row) {
                // return $row->disponibilidad_27000 ? $row->disponibilidad_27000 : '';
                if ($row->disponibilidad_27000 == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('resultado_ponderacion', function ($row) {
                return $row->resultado_ponderacion ? $row->resultado_ponderacion : '';
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
                } elseif ($row->nivelriesgo == 0) {
                    return 'cero';
                } else {
                    return $row->nivelriesgo ? $row->nivelriesgo : '';
                }
            });
            $table->editColumn('riesgo_total', function ($row) {
                if (is_null($row->riesgo_total)) {
                    return null ? $row->riesgo_total : '';
                } elseif ($row->riesgo_total == 0) {
                    return 'cero';
                } else {
                    return $row->riesgo_total ? $row->riesgo_total : '';
                }
            });
            /*$table->editColumn('riesgototal', function ($row) {
                return $row->riesgototal ? $row->riesgototal : "";
            });*/
            $table->editColumn('version_historico', function ($row) {
                return $row->version_historico ? $row->version_historico : '';
            });

            $table->editColumn('control', function ($row) {
                if($row->version_historico === true){
                    return $row->matriz_riesgos_controles_pivots ? $row->matriz_riesgos_controles_pivots : '';
                }else{
                    $controles = MatrizRiesgosControlesPivot::select('gap_dos_catalogo_isos.control_iso AS anexo_indice', 'gap_dos_catalogo_isos.anexo_politica AS anexo_politica')
                    ->join('gap_dos_catalogo_isos', 'gap_dos_catalogo_isos.id', '=', 'matriz_riesgos_controles_pivot.controles_id' )
                    ->where('version_historico', '=', 'false')
                    ->orderBy('gap_dos_catalogo_isos.id')
                    ->get();
                     return $controles ? $controles: '';
                }
            });
            $table->editColumn('plan_de_accion', function ($row) {
                return $row->planes ? $row->planes : '';
            });
            $table->editColumn('calidad_servicioRes', function ($row) {
                if ($row->calidad_servicioRes == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('clienteRes', function ($row) {
                if ($row->clienteRes == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('estrategia_negocioRes', function ($row) {
                if ($row->estrategia_negocioRes == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('disponibilidad_2000Res', function ($row) {
                if ($row->disponibilidad_2000Res == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('niveles_servicioRes', function ($row) {
                if ($row->niveles_servicioRes == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('continuidad_BCPRes', function ($row) {
                if ($row->continuidad_BCPRes == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('confidencialidad_270000Res', function ($row) {
                if ($row->confidencialidad_270000Res == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('integridad_27000Res', function ($row) {
                if ($row->integridad_27000Res == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
                }
            });
            $table->editColumn('disponibilidad_27000Res', function ($row) {
                if ($row->disponibilidad_27000Res == 11.1) {
                    return 'Sí';
                } else {
                    return 'No';
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
            $table->editColumn('riesgo_residual', function ($row) {
                if (is_null($row->riesgo_residual)) {
                    return null ? $row->riesgo_residual : '';
                } elseif ($row->riesgo_residual == 0) {
                    return 'cero';
                } else {
                    return $row->riesgo_residual ? $row->riesgo_residual : '';
                }
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    public function createSistemaGestion()
    {
        abort_if(Gate::denies('analisis_de_riesgo_integral_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $matrizRiesgo = new MatrizRiesgosSistemaGestion();
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $responsables = Empleado::alta()->get();
        $activos = SubcategoriaActivo::get();
        $amenazas = Amenaza::get();
        $vulnerabilidades = Vulnerabilidad::get();

        $ver = VersionesIso::first();
        if($ver->version_historico === false){
            $version_historico = "false";
        }elseif($ver->version_historico === true){
            $version_historico = "true";
        }
        if($version_historico === "true"){
            $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->orderBy('id')->get();
        }elseif($version_historico === "false"){
            $controles = GapDosCatalogoIso::select('id', 'control_iso', 'anexo_politica')->orderBy('id')->get();
        }

        return view('admin.matrizSistemaGestion.create', compact('version_historico', 'amenazas', 'matrizRiesgo', 'activos', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'responsables'))->with('id_analisis', \request()->idAnalisis);
    }

    public function identificadorExist(Request $request)
    {
        $identificador = $request->identificador;
        $exist = MatrizRiesgosSistemaGestion::where('identificador', $identificador)->exists();

        return response()->json(['existe'=>$exist]);
    }

    public function storeSistemaGestion(Request $request)
    {
        abort_if(Gate::denies('analisis_de_riesgo_integral_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'controles_id' => 'required',
            'identificador' => ['required', Rule::unique('matriz_riesgos_sistema_gestion')->whereNull('deleted_at')],
        ]);
        // dd($request->all());
        $controles = array_map(function ($value) {
            return intval($value);
        }, $request->controles_id);

        $matrizRiesgo = MatrizRiesgosSistemaGestion::create($request->all());
        $matrizRiesgo->matriz_riesgos_controles_pivots()->sync($controles);
        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRiesgo->planes()->sync($request->plan_accion);
        }

        if ($matrizRiesgo->riesgo_total >= 90) {
            $tratamiento_riesgo = TratamientoRiesgo::create([
                'matriz_sistema_gestion_id'=>$matrizRiesgo->id,
                'identificador'=>$request->identificador,
                'descripcionriesgo'=>$request->descripcionriesgo,
                'tipo_riesgo'=>$request->tipo_riesgo,
                'riesgototal'=>$request->riesgo_total,
                'riesgo_total_residual'=>$request->riesgo_residual,
                'acciones'=>$request->acciones,
                'id_proceso'=>$request->id_proceso,
                'id_dueno'=>$request->id_responsable,
            ]);
        }

        return redirect()->route('admin.matriz-seguridad.sistema-gestion', ['id' => $request->id_analisis])->with('success', 'Guardado con éxito');
    }

    public function editSistemaGestion(Request $request, $id)
    {
        abort_if(Gate::denies('analisis_de_riesgo_integral_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $matrizRiesgo = MatrizRiesgosSistemaGestion::with('matriz_riesgos_controles_pivots')->find($id);
        $organizacions = Organizacion::all();
        $teams = Team::get();
        $activos = SubcategoriaActivo::get();
        $tipoactivos = Tipoactivo::get();
        // $controles = Controle::get();
        $controlesSeleccionado = [];
        if ($matrizRiesgo->matriz_riesgos_controles_pivots != null) {
            $controlesSeleccionado = $matrizRiesgo->matriz_riesgos_controles_pivots->pluck('id')->toArray();
        }
        if($matrizRiesgo->version_historico === true OR $matrizRiesgo->version_historico === null){
            $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->orderBy('id')->get();
        }elseif($matrizRiesgo->version_historico === false){
            $controles = GapDosCatalogoIso::select('id', 'control_iso', 'anexo_politica')->orderBy('id')->get();
        }

        $sedes = Sede::getAll();
        $areas = Area::get();
        $amenazas = Amenaza::get();
        $procesos = Proceso::get();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgo::count();
        $responsables = Empleado::alta()->get();
        $vulnerabilidades = Vulnerabilidad::get();
        $planes_seleccionados = [];
        $planes = $matrizRiesgo->load('planes');
        if ($matrizRiesgo->planes) {
            foreach ($matrizRiesgo->planes as $plan) {
                array_push($planes_seleccionados, $plan->id);
            }
        }

        return view('admin.matrizSistemaGestion.edit', compact('planes_seleccionados', 'matrizRiesgo', 'vulnerabilidades', 'controles', 'amenazas', 'activos', 'sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz', 'tipoactivos', 'responsables'));
    }

    public function updateSistemaGestion(Request $request, $matrizRiesgo)
    {
        abort_if(Gate::denies('analisis_de_riesgo_integral_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'controles_id' => 'required',
            'identificador' => 'required|unique:matriz_riesgos_sistema_gestion,identificador,' . $matrizRiesgo . ',id,deleted_at,NULL',
        ]);

        // dd($matrizRiesgo);
        $matrizRiesgo = MatrizRiesgosSistemaGestion::with('matriz_riesgos_controles_pivots')->find($matrizRiesgo);
        $calculo = new Mriesgos();
        $res = $calculo->CalculoD($request);
        $request->request->add(['resultadoponderacion' => $res]);
        $matrizRiesgo->update($request->all());
        $matrizRiesgo->matriz_riesgos_controles_pivots()->sync($request->controles_id);

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRiesgo->planes()->sync($request->plan_accion);
        }

        if ($matrizRiesgo->riesgo_total < 90) {
            if (TratamientoRiesgo::where('matriz_sistema_gestion_id', $matrizRiesgo->id)->first()) {
                TratamientoRiesgo::where('matriz_sistema_gestion_id', $matrizRiesgo->id)->first()->delete();
            }
        }
        if ($matrizRiesgo->riesgo_total >= 90) {
            $tratamiento_riesgo = TratamientoRiesgo::updateOrCreate(
                [
                    'matriz_sistema_gestion_id'=>$matrizRiesgo->id,

                ],
                [
                'identificador'=>$request->identificador,
                'descripcionriesgo'=>$request->descripcionriesgo,
                'tipo_riesgo'=>$request->tipo_riesgo,
                'riesgototal'=>$request->riesgo_total,
                'riesgo_total_residual'=>$request->riesgo_residual,
                'acciones'=>$request->acciones,
                'id_proceso'=>$request->id_proceso,
                'id_dueno'=>$request->id_responsable,
            ]
            );
        }

        return redirect()->route('admin.matriz-seguridad.sistema-gestion', ['id' => $request->id_analisis])->with('success', 'Actualizado con éxito');
    }

    public function destroySistemaGestion($matrizRiesgo)
    {
        abort_if(Gate::denies('analisis_de_riesgo_integral_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $matrizRiesgo = MatrizRiesgosSistemaGestion::find($matrizRiesgo);
        $matrizRiesgo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function MapaCalorSistemaGestion(Request $request)
    {
        return view('admin.matrizSistemaGestion.heatchart')->with('id', $request->idAnalisis);
    }

    public function showSistemaGestion(MatrizRiesgo $matrizRiesgo, $id)
    {
        abort_if(Gate::denies('analisis_de_riesgo_integral_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRiesgo = MatrizRiesgosSistemaGestion::with(['controles', 'matriz_riesgos_controles_pivots', 'proceso'])->find($id);
        // dd($matrizRiesgo);
        return view('admin.matrizSistemaGestion.show', compact('matrizRiesgo'));
    }

    public function octaveIndex(Request $request)
    {
        // dd($request->all());
        /*$query = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        dd($query);*/
        // abort_if(Gate::denies('configuracion_sede_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //  $query = MatrizRiesgo::with(['controles', 'matriz_riesgos_controles_pivots' => function ($query) {
        //     return $query->with('declaracion_aplicabilidad');
        // }])->where('id_analisis', '=', $request['id'])->get();
        // dd($query);
        abort_if(Gate::denies('analisis_de_riesgos_matriz_riesgo_config'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizOctave::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_riesgos_matriz_riesgo_config_show';
                $editGate = 'analisis_de_riesgos_matriz_riesgo_config_edit';
                $deleteGate = 'analisis_de_riesgos_matriz_riesgo_config_delete';
                $crudRoutePart = 'matriz-riesgos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('vp', function ($row) {
                return $row->vp ? $row->vp : '';
            });
            $table->editColumn('id_area', function ($row) {
                return $row->area ? $row->area->area : '';
            });
            $table->editColumn('servicio', function ($row) {
                return $row->servicio ? $row->servicio : '';
            });
            $table->editColumn('id_sede', function ($row) {
                return $row->sede ? $row->sede->sede : '';
            });
            $table->editColumn('id_proceso', function ($row) {
                return $row->proceso ? $row->proceso->nombre : '';
            });
            $table->editColumn('activo_id', function ($row) {
                return $row->activo ? $row->activo->nombreactivo : '';
            });
            $table->editColumn('operacional', function ($row) {
                return $row->operacional ? $row->operacional : '';
            });
            $table->editColumn('cumplimiento', function ($row) {
                return $row->cumplimiento ? $row->cumplimiento : '';
            });
            $table->editColumn('legal', function ($row) {
                return $row->legal ? $row->legal : '';
            });
            $table->editColumn('reputacional', function ($row) {
                return $row->reputacional ? $row->reputacional : '';
            });
            $table->editColumn('tecnologico', function ($row) {
                return $row->tecnologico ? $row->tecnologico : '';
            });
            $table->editColumn('valor', function ($row) {
                return $row->valor ? $row->valor : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacions = Organizacion::all();
        $teams = Team::get();
        $tipoactivos = Tipoactivo::get();
        $controles = Controle::get();
        $matriz_heat = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $numero_sedes = Sede::count();
        // $numero_matriz = MatrizRiesgo::count();
        $numero_matriz = MatrizOctave::count();

        return view('admin.OCTAVE.index', compact('sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz'))->with('id_matriz', $request->id);
    }

    public function octave(Request $request)
    {
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        // $responsables = Empleado::get();
        $activos = Activo::get();
        $amenazas = Amenaza::get();
        $duenos = Empleado::alta()->get();
        $custodios = Empleado::alta()->get();
        $vulnerabilidades = Vulnerabilidad::get();
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();
        $activosoctave = MatrizOctave::get();
        $matrizOctave = new MatrizOctave();
        $nombreAis = ActivoInformacion::with('dueno', 'custodio')->get();
        // dd($nombreAis);

        return view('admin.OCTAVE.create', compact('activos', 'amenazas', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'duenos', 'custodios', 'activosoctave', 'matrizOctave', 'nombreAis'))->with('id_analisis', $request->id_analisis);
    }

    public function octaveEdit(Request $request, $id)
    {
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $activos = Activo::get();
        $amenazas = Amenaza::get();
        $duenos = Empleado::alta()->get();
        $custodios = Empleado::alta()->get();
        $vulnerabilidades = Vulnerabilidad::get();
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();
        $activosoctave = MatrizOctave::get();
        $matrizOctave = MatrizOctave::with('matrizActivos')->find($id);

        return view('admin.OCTAVE.edit', compact('activos', 'amenazas', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'duenos', 'custodios', 'activosoctave', 'matrizOctave', 'nombreAis'))->with('id_analisis', $request->id_analisis);
    }

    public function updateOctave(Request $request, $matrizRiesgoOctave)
    {
        $matrizRiesgoOctave = MatrizOctave::find($matrizRiesgoOctave);
        $matrizRiesgoOctave->update($request->all());
        $this->saveUpdateActivosOctave($request->activosoctave, $matrizRiesgoOctave);

        return redirect("admin/matriz-seguridad/octave/index?id={$request->id_analisis}")->with('success', 'Editado con éxito');

        return redirect()->route('admin.matriz-riesgos.octave', ['id' => $request->id_analisis])->with('success', 'Actualizado con éxito');
    }

    public function deleteActivoOctave(Request $request)
    {
        $matrizRiesgoOctave = MatrizoctaveActivosInfo::find($request->id);
        $matrizRiesgoOctave->delete();

        return response()->json(['status' => 200]);
    }

    public function storeOctave(Request $request)
    {
        $matrizRiesgoOctave = MatrizOctave::create($request->all());
        $this->saveUpdateActivosOctave($request->activosoctave, $matrizRiesgoOctave);

        return redirect("admin/matriz-seguridad/octave/index?id={$request->id_analisis}")->with('success', 'Guardado con éxito');
    }

    public function ISO31000(Request $request)
    {
        //abort_if(Gate::denies('analisis_de_riesgos_matriz_riesgo_config'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizIso31000::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_riesgos_matriz_riesgo_config_show';
                $editGate = 'analisis_de_riesgos_matriz_riesgo_config_edit';
                $deleteGate = 'analisis_de_riesgos_matriz_riesgo_config_delete';
                $crudRoutePart = 'matriz-riesgos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('proveedores', function ($row) {
                return $row->proveedores ? $row->proveedores : '';
            });
            $table->editColumn('servicio', function ($row) {
                return $row->servicio ? $row->servicio : '';
            });
            $table->editColumn('id_proceso', function ($row) {
                return $row->proceso ? $row->proceso->nombre : '';
            });
            $table->editColumn('descripcion_servicio', function ($row) {
                return $row->descripcion_servicio ? $row->descripcion_servicio : '';
            });
            $table->editColumn('estrategico', function ($row) {
                return $row->estrategico ? $row->estrategico : '';
            });
            $table->editColumn('operacional', function ($row) {
                return $row->operacional ? $row->operacional : '';
            });
            $table->editColumn('cumplimiento', function ($row) {
                return $row->cumplimiento ? $row->cumplimiento : '';
            });
            $table->editColumn('legal', function ($row) {
                return $row->legal ? $row->legal : '';
            });
            $table->editColumn('reputacional', function ($row) {
                return $row->reputacional ? $row->reputacional : '';
            });
            $table->editColumn('tecnologico', function ($row) {
                return $row->tecnologico ? $row->tecnologico : '';
            });
            $table->editColumn('valor', function ($row) {
                return $row->valor ? $row->valor : '';
            });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacions = Organizacion::all();
        $teams = Team::get();
        $tipoactivos = Tipoactivo::get();
        $controles = Controle::get();
        $matriz_heat = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $numero_sedes = Sede::count();
        // $numero_matriz = MatrizRiesgo::count();
        $numero_matriz = MatrizIso31000::count();

        return view('admin.MatrizISO31000.index', compact('sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz'))->with('id_matriz', $request['id']);
    }

    public function ISO31000Create(Request $request)
    {
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $responsables = Empleado::alta()->get();
        $activos = Activo::get();
        $amenazas = Amenaza::get();

        $vulnerabilidades = Vulnerabilidad::get();
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();
        $activosmatriz31000 = MatrizIso31000::get();

        return view('admin.MatrizISO31000.create', compact('activosmatriz31000', 'activos', 'amenazas', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'responsables'))->with('id_analisis', $request->id_analisis);
    }

    public function ISO31000Edit(Request $request, $id)
    {
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $responsables = Empleado::alta()->get();
        $activos = Activo::get();
        $amenazas = Amenaza::get();
        $vulnerabilidades = Vulnerabilidad::get();
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();
        $activosmatriz31000 = MatrizIso31000::with('activosInformacion')->find($id);

        return view('admin.MatrizISO31000.edit', compact('activosmatriz31000', 'activos', 'amenazas', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'responsables'))->with('id_analisis', $request->id_analisis);
    }

    public function ISO31000Store(Request $request)
    {
        $matrizIso3100 = MatrizIso31000::create($request->all());
        $this->saveUpdateMatriz31000ActivosInfo($request->activosmatriz31000, $matrizIso3100);

        return redirect("admin/matriz-seguridad/ISO31000?id={$request->id_analisis}")->with('success', 'Guardado con éxito');
    }

    public function ISO31000Update(Request $request, $id)
    {
        $matrizIso3100 = MatrizIso31000::find($id);
        $matrizIso3100->update(($request->all()));
        $this->saveUpdateMatriz31000ActivosInfo($request->activosmatriz31000, $matrizIso3100);

        return redirect("admin/matriz-seguridad/ISO31000?id={$request->id_analisis}")->with('success', 'Guardado con éxito');
    }

    public function deleteActivoISO31000(Request $request)
    {
        $matrizRiesgoOctave = Matriz31000ActivosInfo::find($request->id);
        $matrizRiesgoOctave->delete();

        return response()->json(['status' => 200]);
    }

    public function NIST(Request $request)
    {
        //abort_if(Gate::denies('analisis_de_riesgos_matriz_riesgo_config'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = MatrizNist::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_riesgos_matriz_riesgo_config_show';
                $editGate = 'analisis_de_riesgos_matriz_riesgo_config_edit';
                $deleteGate = 'analisis_de_riesgos_matriz_riesgo_config_delete';
                $crudRoutePart = 'matriz-riesgos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('amenaza', function ($row) {
                return $row->amenaza ? $row->amenaza : '';
            });
            $table->editColumn('impacto_vulnerabilidad', function ($row) {
                return $row->impacto_vulnerabilidad ? $row->impacto_vulnerabilidad : '';
            });
            $table->editColumn('aplicaciones', function ($row) {
                return $row->aplicaciones ? $row->aplicaciones : '';
            });
            $table->editColumn('escenario', function ($row) {
                return $row->escenario ? $row->escenario : '';
            });
            $table->editColumn('categoria', function ($row) {
                return $row->categoria ? $row->categoria : '';
            });
            $table->editColumn('causa', function ($row) {
                return $row->causa ? $row->causa : '';
            });
            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? $row->tipo : '';
            });
            $table->editColumn('severidad', function ($row) {
                return $row->severidad ? $row->severidad : '';
            });
            $table->editColumn('probabilidad', function ($row) {
                return $row->probabilidad ? $row->probabilidad : '';
            });
            $table->editColumn('impacto_num', function ($row) {
                return $row->impacto_num ? $row->impacto_num : '';
            });
            $table->editColumn('valor', function ($row) {
                return $row->valor ? $row->valor : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacions = Organizacion::all();
        $teams = Team::get();
        $tipoactivos = Tipoactivo::get();
        $controles = Controle::get();
        $matriz_heat = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $request['id'])->get();
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $numero_sedes = Sede::count();
        $numero_matriz = MatrizRiesgo::count();

        return view('admin.NIST.index', compact('sedes', 'areas', 'procesos', 'organizacions', 'teams', 'numero_sedes', 'numero_matriz'))->with('id_matriz', $request['id']);
    }

    public function NISTCreate(Request $request)
    {
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $responsables = Empleado::alta()->get();
        $activos = Activo::get();
        $amenazas = Amenaza::get();
        $matrizNist = new MatrizNist();
        $vulnerabilidades = Vulnerabilidad::get();
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();

        return view('admin.NIST.create', compact('activos', 'amenazas', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'responsables', 'matrizNist'))->with('id_analisis', $request->id_analisis);
    }

    public function NISTEdit(Request $request, $id)
    {
        $sedes = Sede::getAll();
        $areas = Area::get();
        $procesos = Proceso::get();
        $responsables = Empleado::alta()->get();
        $activos = Activo::get();
        $amenazas = Amenaza::get();
        $matrizNist = MatrizNist::find($id);
        $vulnerabilidades = Vulnerabilidad::get();
        $controles = DeclaracionAplicabilidad::select('id', 'anexo_indice', 'anexo_politica')->get();

        return view('admin.NIST.edit', compact('activos', 'amenazas', 'vulnerabilidades', 'sedes', 'areas', 'procesos', 'controles', 'responsables', 'matrizNist'))->with('id_analisis', $request->id_analisis);
    }

    public function NISTStore(Request $request)
    {
        MatrizNist::create($request->all());

        return redirect("admin/matriz-seguridad/NIST?id={$request->id_analisis}")->with('success', 'Guardado con éxito');
    }

    public function NISTUpdate(Request $request, $id)
    {
        $matrizNist = MatrizNist::find($id);
        $matrizNist->update($request->all());

        return redirect("admin/matriz-seguridad/NIST?id={$request->id_analisis}")->with('success', 'Editado con éxito');
    }

    // public function storeMatriz31000(Request $request)
    // {
    //     //$request->merge(['plan_de_accion' => $request['plan_accion']['0']]);
    //     // dd($request->controles_id);
    //     $matrizRiesgo31000 = MatrizIso31000::create($request->all());

    //     foreach ($request->controles_id as $item) {
    //         $control = new MatrizIso31000ControlesPivot();
    //         // $control->matriz_id = 2;
    //         $control->matriz_id = $matrizRiesgo31000->id;
    //         $control->controles_id = $item;
    //         $control->save();
    //     }

    //     if (isset($request->plan_accion)) {
    //         // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
    //         $matrizRiesgo31000->planes()->sync($request->plan_accion);
    //     }

    //     $this->saveUpdateMatriz31000ActivosInfo($request->externos, $matrizRiesgo31000);

    //     return redirect()->route('admin.matriz-riesgos.octave', ['id' => $request->id_analisis])->with('success', 'Guardado con éxito');
    // }

    public function saveUpdateActivosOctave($activosoctave, $matrizRiesgoOctave)
    {
        if (!is_null($activosoctave)) {
            foreach ($activosoctave as $activoctave) {
                // dd(PuestoResponsabilidade::exists($responsabilidad['id']));
                if (!is_null(MatrizoctaveActivosInfo::find($activoctave['id']))) {
                    MatrizoctaveActivosInfo::find($activoctave['id'])->update([
                        'nombre_ai' => $activoctave['nombre_ai'],
                        'valor_criticidad' =>  $activoctave['valor_criticidad'],
                        'contenedor_activos' =>  $activoctave['contenedor_activos'],
                        'id_amenaza' =>  $activoctave['id_amenaza'],
                        'id_vulnerabilidad' =>  $activoctave['id_vulnerabilidad'],
                        'escenario_riesgo' =>  $activoctave['escenario_riesgo'],
                        'id_custodio' =>  $activoctave['id_custodio'],
                        'id_dueno' =>  $activoctave['id_dueno'],
                        'confidencialidad' =>  $activoctave['confidencialidad'],
                        'disponibilidad' =>  $activoctave['disponibilidad'],
                        'integridad' =>  $activoctave['integridad'],
                        'evaluacion_riesgo' =>  $activoctave['evaluacion_riesgo'],

                    ]);
                } else {
                    MatrizoctaveActivosInfo::create([
                        'id_octave' => $matrizRiesgoOctave->id,
                        'nombre_ai' => $activoctave['nombre_ai'],
                        'valor_criticidad' =>  $activoctave['valor_criticidad'],
                        'contenedor_activos' =>  $activoctave['contenedor_activos'],
                        'id_amenaza' =>  $activoctave['id_amenaza'],
                        'id_vulnerabilidad' =>  $activoctave['id_vulnerabilidad'],
                        'escenario_riesgo' =>  $activoctave['escenario_riesgo'],
                        'id_custodio' =>  $activoctave['id_custodio'],
                        'id_dueno' =>  $activoctave['id_dueno'],
                        'confidencialidad' =>  $activoctave['confidencialidad'],
                        'disponibilidad' =>  $activoctave['disponibilidad'],
                        'integridad' =>  $activoctave['integridad'],
                        'evaluacion_riesgo' =>  $activoctave['evaluacion_riesgo'],
                    ]);
                }
            }
        }
        // dd($activosoctave);
    }

    public function saveUpdateMatriz31000ActivosInfo($activosmatriz31000, $matrizRiesgo31000)
    {
        if (!is_null($activosmatriz31000)) {
            foreach ($activosmatriz31000 as $activomatriz31000) {
                // dd(PuestoResponsabilidade::exists($responsabilidad['id']));
                if (Matriz31000ActivosInfo::find($activomatriz31000['id']) != null) {
                    Matriz31000ActivosInfo::find($activomatriz31000['id'])->update([
                        'contenedor_activos' =>  $activomatriz31000['contenedor_activos'],
                        'id_amenaza' =>  $activomatriz31000['id_amenaza'],
                        'id_vulnerabilidad' => $activomatriz31000['id_vulnerabilidad'],
                        'escenario_riesgo' =>  $activomatriz31000['escenario_riesgo'],
                        'confidencialidad' =>  $activomatriz31000['confidencialidad'],
                        'disponibilidad' =>  $activomatriz31000['disponibilidad'],
                        'integridad' =>  $activomatriz31000['integridad'],
                        'evaluación_riesgo' =>  $activomatriz31000['evaluacion_riesgo'],
                        // 'activo_id' =>  $activomatriz31000['activo_id']
                    ]);
                } else {
                    Matriz31000ActivosInfo::create([
                        'id_matriz31000' => $matrizRiesgo31000->id,
                        'contenedor_activos' =>  $activomatriz31000['contenedor_activos'],
                        'id_amenaza' =>  $activomatriz31000['id_amenaza'],
                        'id_vulnerabilidad' => $activomatriz31000['id_vulnerabilidad'],
                        'escenario_riesgo' =>  $activomatriz31000['escenario_riesgo'],
                        'confidencialidad' =>  $activomatriz31000['confidencialidad'],
                        'disponibilidad' =>  $activomatriz31000['disponibilidad'],
                        'integridad' =>  $activomatriz31000['integridad'],
                        'evaluación_riesgo' =>  $activomatriz31000['evaluacion_riesgo'],
                        // 'activo_id' =>  $activomatriz31000['activo_id']
                    ]);
                }
            }
        }
    }

    public function graficas(Request $request, $matriz)
    {
        $procesos = MatrizOctaveProceso::with('proceso')->get();
        $direcciones = Area::get();
        $servicios = MatrizOctaveServicio::get();
        $activos = ActivoInformacion::get();
        $activos_contenedores = ActivoInformacion::get();

        return view('admin.OCTAVE.graficas', compact('procesos', 'direcciones', 'servicios', 'activos', 'activos_contenedores', 'matriz'));
    }
}
