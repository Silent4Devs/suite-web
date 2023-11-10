<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iso9001\PlanImplementacion as PlanItemIplementacion9001;
use App\Models\PlanImplementacion;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class PlanesAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $iso2007 = Cache::remember('PlanImplementacion:plan_implementacion_all_where_false', 3600 * 8, function () {
            return PlanImplementacion::select('id', 'tasks', 'parent', 'norma', 'modulo_origen', 'objetivo', 'elaboro_id', 'es_plan_trabajo_base')->where('es_plan_trabajo_base', false)->with('elaborador')->get();
        });

        // $iso9001 = Cache::remember('PlanImplementacion:plan_implementacion_9001_all', 3600 * 8, function () {
        //     return PlanItemIplementacion9001::with('elaborador')->get();
        // });

        // $isoMerged = Cache::remember('PlanImplementacion:plan_implementacion_merged', 3600 * 2, function () {
        //     return PlanItemIplementacion9001::with('elaborador')->get();
        // });
        // $merged = $iso2007->concat($iso9001);

        if ($request->ajax()) {
            return datatables()->of($iso2007)->toJson();
        }

        return view('admin.planesDeAccion.index', compact('iso2007'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($modulo, $referencia = null)
    {
        abort_if(Gate::denies('planes_de_accion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planImplementacion = new PlanImplementacion();

        return view('admin.planesDeAccion.create', compact('planImplementacion', 'modulo', 'referencia'));
    }

    public function createPlanTrabajoBase($modulo, $referencia = null)
    {
        abort_if(Gate::denies('planes_de_accion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $planImplementacion = new PlanImplementacion();

        return view('admin.planesDeAccion.createPlanTrabajoBase', compact('planImplementacion', 'modulo', 'referencia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent' => 'required|string',
            'norma' => 'required|string',
            // 'modulo_origen' => 'required|string',
            'objetivo' => 'required|string',
        ], [
            'parent.required' => 'Debes de definir un nombre para el plan de acción',
            'norma.required' => 'Debes de definir una norma para el plan de acción',
            // 'modulo_origen.required' => 'Debes de definir un módulo de origen para el plan de acción',
            'objetivo.required' => 'Debes de definir un objetivo para el plan de acción',
        ]);
        $tasks = [
            [
                'id' => 'tmp_' . (strtotime(now())) . '_1',
                'end' => strtotime(now()) * 1000,
                'name' => 'Plan de Accion - ' . $request->norma,
                'level' => 0,
                'start' => strtotime(now()) * 1000,
                'canAdd' => true,
                'status' => 'STATUS_UNDEFINED',
                'canWrite' => true,
                'duration' => 0,
                'progress' => 0,
                'canDelete' => true,
                'collapsed' => false,
                'relevance' => '0',
                'canAddIssue' => true,
                'description' => '',
                'endIsMilestone' => false,
                'startIsMilestone' => false,
                'progressByWorklog' => false,
                'assigs' => [],
            ],
            [
                'id' => 'tmp_' . (strtotime(now())) . rand(1, 1000),
                'end' => strtotime(now()) * 1000,
                'name' => $request->norma,
                'level' => 1,
                'start' => strtotime(now()) * 1000,
                'canAdd' => true,
                'status' => 'STATUS_UNDEFINED',
                'canWrite' => true,
                'duration' => 0,
                'progress' => 0,
                'canDelete' => true,
                'collapsed' => false,
                'relevance' => '0',
                'canAddIssue' => true,
                'description' => '',
                'endIsMilestone' => false,
                'startIsMilestone' => false,
                'progressByWorklog' => false,
                'assigs' => [],
            ],
        ];

        $planImplementacion = PlanImplementacion::create([ // Necesario se carga inicialmente el Diagrama Universal de Gantt
            'tasks' => $tasks,
            'canAdd' => true,
            'canWrite' => true,
            'canWriteOnParent' => true,
            'changesReasonWhy' => false,
            'selectedRow' => 0,
            'zoom' => '3d',
            'parent' => $request->parent,
            'norma' => $request->norma,
            'modulo_origen' => 'Planes de Acción',
            'objetivo' => $request->objetivo,
            'elaboro_id' => User::getCurrentUser()->empleado->id,
            'es_plan_trabajo_base' => $request->es_plan_trabajo_base != null ? true : false,
        ]);

        $mensaje = $request->es_plan_trabajo_base != null ? 'Plan de Trabajo Base' : 'Plan de Acción';
        $route = $request->es_plan_trabajo_base != null ? 'admin.planTrabajoBase.index' : 'admin.planes-de-accion.index';

        return redirect()->route($route)->with('success', $mensaje . ' ' . $planImplementacion->parent . ' creado');
    }

    public function crearPlanDeAccion($modelo)
    {
        if (!count($modelo->planes)) {
            $tasks = [
                [
                    'id' => 'tmp_' . (strtotime(now())) . '_1',
                    'end' => strtotime(now()) * 1000,
                    'name' => 'Plan de Accion - ' . $modelo->norma,
                    'level' => 0,
                    'start' => strtotime(now()) * 1000,
                    'canAdd' => true,
                    'status' => 'STATUS_UNDEFINED',
                    'canWrite' => true,
                    'duration' => 0,
                    'progress' => 0,
                    'canDelete' => true,
                    'collapsed' => false,
                    'relevance' => '0',
                    'canAddIssue' => true,
                    'description' => '',
                    'endIsMilestone' => false,
                    'startIsMilestone' => false,
                    'progressByWorklog' => false,
                    'assigs' => [],
                ],
                [
                    'id' => 'tmp_' . (strtotime(now())) . rand(1, 1000),
                    'end' => strtotime(now()) * 1000,
                    'name' => $modelo->norma,
                    'level' => 1,
                    'start' => strtotime(now()) * 1000,
                    'canAdd' => true,
                    'status' => 'STATUS_UNDEFINED',
                    'canWrite' => true,
                    'duration' => 0,
                    'progress' => 0,
                    'canDelete' => true,
                    'collapsed' => false,
                    'relevance' => '0',
                    'canAddIssue' => true,
                    'description' => '',
                    'endIsMilestone' => false,
                    'startIsMilestone' => false,
                    'progressByWorklog' => false,
                    'assigs' => [],
                ],
            ];

            $assigs = [];

            $planImplementacion = new PlanImplementacion(); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $planImplementacion->tasks = $tasks;
            $planImplementacion->canAdd = true;
            $planImplementacion->canWrite = true;
            $planImplementacion->canWriteOnParent = true;
            $planImplementacion->changesReasonWhy = false;
            $planImplementacion->selectedRow = 0;
            $planImplementacion->zoom = '3d';
            $planImplementacion->parent = 'Incidente - ' . $modelo->folio;
            $planImplementacion->norma = 'ISO 27001';
            $planImplementacion->modulo_origen = 'Incidentes';
            $planImplementacion->objetivo = null;
            $planImplementacion->elaboro_id = User::getCurrentUser()->empleado->id;

            $modelo->planes()->save($planImplementacion);
        }
    }

    public function show($planImplementacion)
    {
        $planImplementacion = PlanImplementacion::find($planImplementacion);

        return view('admin.planesDeAccion.show', compact('planImplementacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function edit($planImplementacion)
    {
        abort_if(Gate::denies('planes_de_accion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planImplementacion = PlanImplementacion::find($planImplementacion);
        $referencia = null;

        return view('admin.planesDeAccion.edit', compact('planImplementacion', 'referencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $planImplementacion)
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
        $planImplementacion = PlanImplementacion::find($planImplementacion);
        $planImplementacion->update([ // Necesario se carga inicialmente el Diagrama Universal de Gantt
            'parent' => $request->parent,
            'norma' => $request->norma,
            'modulo_origen' => $request->modulo_origen,
            'objetivo' => $request->objetivo,
        ]);
        $route = $planImplementacion->es_plan_trabajo_base ? 'admin.planTrabajoBase.index' : 'admin.planes-de-accion.index';
        $mensaje = $planImplementacion->es_plan_trabajo_base ? 'Plan de Trabajo Base Actualizado' : 'Plan de Acción Actualizado';

        return redirect()->route($route)->with('success', $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $planImplementacion)
    {
        abort_if(Gate::denies('planes_de_accion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $planImplementacion = PlanImplementacion::find($planImplementacion);
            $eliminado = $planImplementacion->delete();
            if ($eliminado) {
                return response()->json(['success', true]);
            } else {
                return response()->json(['error', true]);
            }
        }
    }

    public function saveProject(Request $request, $plan)
    {
        $project = $request->prj;
        $project = (array) json_decode($project);
        if (PlanImplementacion::find($plan)) {
            $tasks = isset($project['tasks']) ? $project['tasks'] : [];
            $plan_implementacion = PlanImplementacion::find($plan)->update([
                'tasks' => $tasks,
                'canAdd' => isset($project['canAdd']) ? $project['canAdd'] : true,
                'canWrite' => isset($project['canWrite']) ? $project['canWrite'] : true,
                'canWriteOnParent' => isset($project['canWriteOnParent']) ? $project['canWriteOnParent'] : null,
                'changesReasonWhy' => isset($project['changesReasonWhy']) ? $project['changesReasonWhy'] : null,
                'selectedRow' => isset($project['selectedRow']) ? $project['selectedRow'] : 0,
                'zoom' => isset($project['zoom']) ? $project['zoom'] : '1M',
            ]);
            $plan_implementacion = PlanImplementacion::find($plan);
        } else {
            $tasks = isset($project['tasks']) ? $project['tasks'] : [];
            $plan_implementacion = PlanImplementacion::create([
                'tasks' => $tasks,
                'canAdd' => isset($project['canAdd']) ? $project['canAdd'] : true,
                'canWrite' => isset($project['canWrite']) ? $project['canWrite'] : true,
                'canWriteOnParent' => isset($project['canWriteOnParent']) ? $project['canWriteOnParent'] : null,
                'changesReasonWhy' => isset($project['changesReasonWhy']) ? $project['changesReasonWhy'] : null,
                'selectedRow' => isset($project['selectedRow']) ? $project['selectedRow'] : 0,
                'zoom' => isset($project['zoom']) ? $project['zoom'] : '1M',
            ]);
        }

        return response()->json(['success' => true, 'ultima_modificacion' => Carbon::parse($plan_implementacion->updated_at)->format('d/m/Y g:i:s A')], 200);
    }

    public function loadProject($plan)
    {
        $implementacion = PlanImplementacion::find($plan);
        $tasks = $implementacion->tasks;
        foreach ($tasks as $task) {
            $task->status = isset($task->status) ? $task->status : 'STATUS_UNDEFINED';
            $task->end = intval($task->end);
            $task->start = intval($task->start);
            $task->canAdd = $task->canAdd == 'true' ? true : false;
            $task->canWrite = $task->canWrite == 'true' ? true : false;
            $task->duration = intval($task->duration);
            $task->progress = intval($task->progress);
            $task->canDelete = $task->canDelete == 'true' ? true : false;
            isset($task->level) ? $task->level = intval($task->level) : $task->level = 0;
            isset($task->collapsed) ? $task->collapsed = $task->collapsed == 'true' ? true : false : $task->collapsed = false;
            if (isset($task->canAddIssue)) {
                $task->canAddIssue = $task->canAddIssue == 'true' ? true : false;
            }
            if (isset($task->endIsMilestone)) {
                $task->endIsMilestone = $task->endIsMilestone == 'true' ? true : false;
            }
            if (isset($task->startIsMilestone)) {
                $task->startIsMilestone = $task->startIsMilestone == 'true' ? true : false;
            }
            if (isset($task->progressByWorklog)) {
                $task->progressByWorklog = $task->progressByWorklog == 'true' ? true : false;
            }
        }
        $implementacion->tasks = $tasks;

        return $implementacion;
    }
}
