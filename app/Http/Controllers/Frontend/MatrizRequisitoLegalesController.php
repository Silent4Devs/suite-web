<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatrizRequisitoLegaleRequest;
use App\Http\Requests\StoreMatrizRequisitoLegaleRequest;
use App\Http\Requests\UpdateMatrizRequisitoLegaleRequest;
use App\Models\Empleado;
use App\Models\EvidenciaMatrizRequisitoLegale;
use App\Models\MatrizRequisitoLegale;
use App\Models\PlanImplementacion;
use App\Models\Team;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MatrizRequisitoLegalesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('matriz_requisito_legale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($query = MatrizRequisitoLegale::with(['team','evidencias_matriz','empleado'])->get());
        // dd(MatrizRequisitoLegale::with('planes', 'evidencias_matriz', 'empleado')->get());
        if ($request->ajax()) {
            // $query = MatrizRequisitoLegale::with(['team','evidencias_matriz','empleado'])->select(sprintf('%s.*', (new MatrizRequisitoLegale)->table));
            // $table = Datatables::of($query);

            // // $table->addColumn('placeholder', '&nbsp;');
            // // $table->addColumn('actions', '&nbsp;');

            // // $table->editColumn('actions', function ($row) {
            // //     $viewGate      = 'matriz_requisito_legale_show';
            // //     $editGate      = 'matriz_requisito_legale_edit';
            // //     $deleteGate    = 'matriz_requisito_legale_delete';
            // //     $crudRoutePart = 'matriz-requisito-legales';

            // //     return view('partials.datatablesActions', compact(
            // //         'viewGate',
            // //         'editGate',
            // //         'deleteGate',
            // //         'crudRoutePart',
            // //         'row'
            // //     ));
            // // });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : "";
            // });
            // $table->editColumn('tipo', function ($row) {
            //     return $row->tipo ? $row->tipo : "";
            // });
            // $table->editColumn('nombrerequisito', function ($row) {
            //     return $row->nombrerequisito ? $row->nombrerequisito : "";
            // });
            // $table->editColumn('formacumple', function ($row) {
            //     return $row->formacumple ? $row->formacumple : "";
            // });
            // $table->editColumn('requisitoacumplir', function ($row) {
            //     return $row->requisitoacumplir ? $row->requisitoacumplir : "";
            // });
            // $table->editColumn('alcance', function ($row) {
            //     return $row->alcance ? $row->alcance : "";
            // });
            // $table->editColumn('medio', function ($row) {
            //     return $row->medio ? $row->medio : "";
            // });
            // $table->editColumn('fechaexpedicion', function ($row) {
            //     return $row->fechaexpedicion ? $row->fechaexpedicion : "";
            // });
            // $table->editColumn('fechavigor', function ($row) {
            //     return $row->fechavigor ? $row->fechavigor : "";
            // });
            // $table->editColumn('periodicidad_cumplimiento', function ($row) {
            //     return $row->periodicidad_cumplimiento ? $row->periodicidad_cumplimiento : "";
            // });
            // $table->editColumn('cumplerequisito', function ($row) {
            //     return $row->cumplerequisito ? MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT[$row->cumplerequisito] : '';
            // });
            // $table->editColumn('metodo', function ($row) {
            //     return $row->metodo ? $row->metodo : "";
            // });
            // $table->editColumn('descripcion_cumplimiento', function ($row) {
            //     return $row->descripcion_cumplimiento ? $row->descripcion_cumplimiento : "";
            // });
            // $table->editColumn('evidencia', function ($row) {
            //     return $row->evidencias_matriz ? $row->evidencias_matriz : "";
            // });

            // $table->editColumn('reviso', function ($row) {
            //     return $row->empleado ? $row->empleado->name : "";
            // });

            // $table->editColumn('puesto', function ($row) {
            //     return $row->empleado ? $row->empleado->puesto : "";
            // });

            // $table->editColumn('area', function ($row) {
            //     return $row->empleado ? $row->empleado->area->area : "";
            // });

            // $table->editColumn('comentarios', function ($row) {
            //     return $row->comentarios ? $row->comentarios : "";
            // });

            // $table->rawColumns(['actions', 'placeholder']);

            // return $table->make(true);
            $matrizRequisitoLegales = MatrizRequisitoLegale::with('planes', 'evidencias_matriz', 'empleado')->orderBy('id')->get();

            return datatables()->of($matrizRequisitoLegales)->toJson();
        }

        $teams = Team::get();

        return view('frontend.matrizRequisitoLegales.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_requisito_legale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $planes_implementacion = PlanImplementacion::where('id', '!=', 1)->get();
        $empleados = Empleado::with('area')->get();

        return view('frontend.matrizRequisitoLegales.create', compact('planes_implementacion', 'empleados'));
    }

    public function store(StoreMatrizRequisitoLegaleRequest $request)
    {
        $matrizRequisitoLegale = MatrizRequisitoLegale::create($request->all());
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/matriz_evidencias', $file, $file->getClientOriginalName())) {
                    EvidenciaMatrizRequisitoLegale::create([
                        'evidencia' => $file->getClientOriginalName(),
                        'id_matriz_requisito' => $matrizRequisitoLegale->id,
                    ]);
                }
            }
        }

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRequisitoLegale->planes()->sync($request->plan_accion);
        }

        return redirect()->route('matriz-requisito-legales.index');
    }

    public function edit(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $matrizRequisitoLegale->load('team', 'planes', 'evidencias_matriz');
        // dd($matrizRequisitoLegale);
        $planes_implementacion = PlanImplementacion::where('id', '!=', 1)->get();
        $planes_seleccionados = [];
        if ($matrizRequisitoLegale->planes) {
            foreach ($matrizRequisitoLegale->planes as $plan) {
                array_push($planes_seleccionados, $plan->id);
            }
        }

        $empleados = Empleado::with('area')->get();

        $matrizRequisitoLegale->load('team');

        return view('frontend.matrizRequisitoLegales.edit', compact('matrizRequisitoLegale', 'empleados', 'planes_seleccionados'));
    }

    public function update(UpdateMatrizRequisitoLegaleRequest $request, MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        $matrizRequisitoLegale->update($request->all());
        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                if (Storage::putFileAs('public/matriz_evidencias', $file, $file->getClientOriginalName())) {
                    EvidenciaMatrizRequisitoLegale::create([
                        'evidencia' => $file->getClientOriginalName(),
                        'id_matriz_requisito' => $matrizRequisitoLegale->id,
                    ]);
                }
            }
        }

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRequisitoLegale->planes()->sync($request->plan_accion);
        }

        return redirect()->route('matriz-requisito-legales.index')->with('success', 'Editado con éxito');
    }

    public function show(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->load('team', 'planes');

        return view('frontend.matrizRequisitoLegales.show', compact('matrizRequisitoLegale'));
    }

    public function destroy(Request $request, MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $eliminado = $matrizRequisitoLegale->delete();
            if ($eliminado) {
                return response()->json(['success', true]);
            } else {
                return response()->json(['error', true]);
            }
        }
    }

    public function massDestroy(MassDestroyMatrizRequisitoLegaleRequest $request)
    {
        MatrizRequisitoLegale::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function createPlanAccion(MatrizRequisitoLegale $id)
    {
        $planImplementacion = new PlanImplementacion();
        $modulo = $id;
        $modulo_name = 'Matríz de Requisitos Legales';
        $referencia = $modulo->nombrerequisito;
        $urlStore = route('matriz-requisito-legales.storePlanAccion', $id);

        return view('frontend.planesDeAccion.create', compact('planImplementacion', 'modulo_name', 'modulo', 'referencia', 'urlStore'));
    }

    public function storePlanAccion(Request $request, MatrizRequisitoLegale $id)
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

        $matrizRequisitoLegal = $id;
        $planImplementacion = new PlanImplementacion(); // Necesario se carga inicialmente el Diagrama Universal de Gantt
        $planImplementacion->tasks = [
            [
                'id' => '1',
                'end' => Carbon::now()->timestamp * 1000,
                'name' => $request->parent,
                'level' => '0',
                'start' => Carbon::now()->timestamp * 1000,
                'canAdd' => true,
                'status' => 'STATUS_ACTIVE',
                'canWrite' => true,
                'duration' => '1',
                'progress' => '0',
                'canDelete' => true,
                'collapsed' => false,
                'relevance' => '0',
                'canAddIssue' => true,
                'endIsMilestone' => false,
                'startIsMilestone' => false,
                'progressByWorklog' => false,
            ],
        ];
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

        $matrizRequisitoLegal->planes()->save($planImplementacion);

        return redirect()->route('matriz-requisito-legales.index')->with('success', 'Plan de Acción'.$planImplementacion->parent.' creado');
    }
}
