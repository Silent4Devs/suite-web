<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatrizRequisitoLegaleRequest;
use App\Http\Requests\StoreMatrizRequisitoLegaleRequest;
use App\Http\Requests\UpdateMatrizRequisitoLegaleRequest;
use App\Mail\MatrizEmail;
use App\Models\Empleado;
use App\Models\EvaluacionRequisitoLegal;
use App\Models\EvidenciaMatrizRequisitoLegale;
use App\Models\ListaDistribucion;
use App\Models\MatrizRequisitoLegale;
use App\Models\PlanImplementacion;
use App\Models\ProcesosListaDistribucion;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class MatrizRequisitoLegalesController extends Controller
{
    public $modelo = 'MatrizRequisitoLegale';

    public function index(Request $request)
    {

        abort_if(Gate::denies('matriz_requisitos_legales_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $matrizRequisitoLegales = MatrizRequisitoLegale::select('id', 'nombrerequisito', 'formacumple', 'fechaexpedicion')->orderBy('id')->get();

            // dd($matrizRequisitoLegales);
            //  $matrizRequisitoLegales = MatrizRequisitoLegale::with('planes', 'evidencias_matriz', 'empleado', 'evaluaciones')->orderBy('id')->get();
            return datatables()->of($matrizRequisitoLegales)->toJson();
        }

        $teams = Team::get();

        $modulo = ListaDistribucion::with('participantes.empleado')->where('modelo', '=', $this->modelo)->first();

        if (! isset($modulo)) {
            $listavacia = 'vacia';
        } elseif ($modulo->participantes->isEmpty()) {
            $listavacia = 'vacia';
        } else {
            foreach ($modulo->participantes as $participante) {
                if ($participante->empleado->estatus != 'alta') {
                    $listavacia = 'baja';

                    return view('admin.matrizRequisitoLegales.index', compact('teams', 'listavacia'));
                }
            }
            $listavacia = 'cumple';
        }

        return view('admin.matrizRequisitoLegales.index', compact('teams', 'listavacia'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_requisitos_legales_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $planes_implementacion = PlanImplementacion::where('id', '!=', 1)->get();
        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('admin.matrizRequisitoLegales.create', compact('planes_implementacion', 'empleados'));
    }

    public function store(StoreMatrizRequisitoLegaleRequest $request)
    {
        abort_if(Gate::denies('matriz_requisitos_legales_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombrerequisito' => ['required', 'string'],
            'formacumple' => ['nullable', 'string'],
            'tipo' => ['required', 'string'],
            'fechaexpedicion' => ['nullable', 'date'],
            'fechavigor' => ['nullable', 'date'],
            'periodicidad_cumplimiento' => ['required', 'string'],
            'requisitoacumplir' => ['required'],
            'cumplerequisito' => ['nullable', 'string'],
            'medio' => ['nullable', 'string'],
            'descripcion_cumplimiento' => ['nullable', 'string'],
        ]);

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

        return redirect()->route('admin.matriz-requisito-legales.index');
    }

    public function edit(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisitos_legales_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $matrizRequisitoLegale->load('team', 'planes', 'evidencias_matriz');
        // dd($matrizRequisitoLegale);
        $planes_implementacion = PlanImplementacion::where('id', '!=', 1)->get();
        $planes_seleccionados = [];
        if ($matrizRequisitoLegale->planes) {
            foreach ($matrizRequisitoLegale->planes as $plan) {
                array_push($planes_seleccionados, $plan->id);
            }
        }

        $empleados = Empleado::getAltaEmpleadosWithArea();

        $matrizRequisitoLegale->load('team');

        return view('admin.matrizRequisitoLegales.edit', compact('matrizRequisitoLegale', 'empleados', 'planes_seleccionados'));
    }

    public function update(UpdateMatrizRequisitoLegaleRequest $request, MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisitos_legales_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $request->validate([
        //     'nombrerequisito' => ['required', 'string'],
        //     'formacumple' => ['nullable', 'string'],
        //     'tipo' => ['required', 'string'],
        //     'fechaexpedicion' => ['nullable'],
        //     'fechavigor' => ['nullable', 'date'],
        //     'periodicidad_cumplimiento' => ['required', 'string'],
        //     'requisitoacumplir' => ['required'],
        //     'cumplerequisito' => ['nullable', 'string'],
        //     'medio' => ['nullable', 'string'],
        //     'descripcion_cumplimiento' => ['nullable', 'string'],
        // ]);

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

        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();
        $creador = User::getCurrentUser()->empleado->id; // Replace 123 with your specific empleado_id value
        // $no_niveles = $lista->niveles;
        // dd($lista, $no_niveles);

        $proceso = ProcesosListaDistribucion::where('modulo_id', '=', $lista->id)->where('proceso_id', '=', $matrizRequisitoLegale->id)->first();

        $proceso->update([
            'estatus' => 'Pendiente',
        ]);

        // dd($lista, $id_foda, $this->modelo, $proceso);

        $containsValue = $lista->participantes->contains('empleado_id', $creador);

        if (! $containsValue) {
            // dd("Estoy en la lista");
            $this->envioCorreos($proceso, $matrizRequisitoLegale->id);
            // The collection contains the specific empleado_id value
            // Your logic here...
        }

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRequisitoLegale->planes()->sync($request->plan_accion);
        }

        return redirect()->route('admin.matriz-requisito-legales.index')->with('success', 'Editado con éxito');
    }

    public function envioCorreos($proceso, $id_matriz)
    {
        foreach ($proceso->participantes as $part) {
            $emailAprobador = $part->participante->empleado->email;

            Mail::to(removeUnicodeCharacters($emailAprobador))->queue(new MatrizEmail($id_matriz));
        }
        // dd("Se enviaron todos");
    }

    public function show(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisitos_legales_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->load('team', 'planes', 'evaluaciones');
        $requisito = $matrizRequisitoLegale->id;

        $evaluaciones = EvaluacionRequisitoLegal::with('evaluador')->where('id_matriz', '=', $requisito)->orderByDesc('fechaverificacion')->get();
        $result = EvaluacionRequisitoLegal::where('id_matriz', '=', $requisito)->exists();

        return view('admin.matrizRequisitoLegales.show', compact('matrizRequisitoLegale', 'evaluaciones', 'result'));
    }

    public function destroy(Request $request, MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisitos_legales_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        $urlStore = route('admin.matriz-requisito-legales.storePlanAccion', $id);

        return view('admin.planesDeAccion.create', compact('planImplementacion', 'modulo_name', 'modulo', 'referencia', 'urlStore'));
    }

    public function storePlanAccion(Request $request, MatrizRequisitoLegale $id)
    {
        dd($request->all());
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
        $planImplementacion->elaboro_id = User::getCurrentUser()->empleado->id;

        $matrizRequisitoLegal->planes()->save($planImplementacion);

        return redirect()->route('admin.matriz-requisito-legales.index')->with('success', 'Plan de Acción'.$planImplementacion->parent.' creado');
    }

    public function evaluar(MatrizRequisitoLegale $id)
    {
        $empleados = Empleado::getAltaEmpleadosWithArea();
        $requisito = $id;
        $planes_implementacion = PlanImplementacion::where('id', '!=', 1)->get();

        return view('admin.matrizRequisitoLegales.evaluar', compact('requisito', 'empleados', 'planes_implementacion'));
    }

    public function evaluarStore(Request $request, MatrizRequisitoLegale $id)
    {
        // dd($request->all());

        $request->validate([
            'cumplerequisito' => ['required'],
            'fechaverificacion' => ['required', 'date'],
            'metodo' => ['required'],
            'descripcion_cumplimiento' => ['required'],
            'evidencia' => ['nullable'],
            'id_reviso' => ['required'],
            'comentarios' => ['nullable'],
        ]);

        $matrizRequisitoLegale = EvaluacionRequisitoLegal::create($request->all());
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/matriz_evidencias', $file, $file->getClientOriginalName())) {
                    EvidenciaMatrizRequisitoLegale::create([
                        'evidencia' => $file->getClientOriginalName(),
                        'id_matriz_requisito' => $matrizRequisitoLegale->id_matriz,
                    ]);
                }
            }
        }

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $matrizRequisitoLegale->planes()->sync($request->plan_accion);
        }

        return redirect()->route('admin.matriz-requisito-legales.index');
    }
}
