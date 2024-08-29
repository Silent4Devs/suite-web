<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iso9001\PlanImplementacion as PlanItemIplementacion9001;
use App\Models\PlanImplementacion;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PlanesAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $iso9001 = Cache::remember('PlanImplementacion:plan_implementacion_9001_all', 3600 * 8, function () {
        //     return PlanItemIplementacion9001::with('elaborador')->get();
        // });

        // $isoMerged = Cache::remember('PlanImplementacion:plan_implementacion_merged', 3600 * 2, function () {
        //     return PlanItemIplementacion9001::with('elaborador')->get();
        // });
        // $merged = $$planImplementacions->concat($iso9001);
        // if ($request->ajax()) {
        //     return datatables()->of($planImplementacions)->toJson();
        // }

        return view('admin.workPlan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($modulo, $referencia = null)
    {
        abort_if(Gate::denies('planes_de_accion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planImplementacion = new PlanImplementacion;

        return view('admin.workPlan.create', compact('planImplementacion', 'modulo', 'referencia'));
    }

    public function createPlanTrabajoBase($modulo, $referencia = null)
    {
        abort_if(Gate::denies('planes_de_accion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $planImplementacion = new PlanImplementacion;

        return view('admin.workPlan.createPlanTrabajoBase', compact('planImplementacion', 'modulo', 'referencia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent' => 'required|string|max:255',
            'inicio' => 'required|date',
            'fin' => 'required|date|after:inicio', // Asegura que la fecha de fin sea después de la fecha de inicio
            'objetivo' => 'required|string|max:550',
        ], [
            'parent.required' => 'Debes definir un nombre para el plan de trabajo',
            'objetivo.required' => 'Debes definir un objetivo para el plan de trabajo',
            'fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
        ]);
        $tasks = [
            [
                'id' => 'tmp_'.(strtotime(now())).'_1',
                'end' => strtotime($request->fin) * 1000,
                'name' => 'Plan de Trabajo - '.$request->norma,
                'level' => 0,
                'start' => strtotime($request->inicio) * 1000,
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
                'resources' => [],
                'subtasks' => [],
                'historic' => [],
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
            'modulo_origen' => 'Planes de Trabajo',
            'objetivo' => $request->objetivo,
            'elaboro_id' => User::getCurrentUser()->empleado->id,
            'es_plan_trabajo_base' => $request->es_plan_trabajo_base != null ? true : false,
        ]);

        $mensaje = $request->es_plan_trabajo_base != null ? 'Plan de trabajo Base' : 'Plan de trabajo';
        $route = $request->es_plan_trabajo_base != null ? 'admin.planTrabajoBase.index' : 'admin.planes-de-accion.index';

        return redirect()->route($route)->with('success', $mensaje.' '.$planImplementacion->parent.' creado');
    }

    public function crearPlanDeAccion($modelo)
    {
        if (! count($modelo->planes)) {
            $tasks = [
                [
                    'id' => 'tmp_'.(strtotime(now())).'_1',
                    'end' => strtotime(now()) * 1000,
                    'name' => 'Plan de Trabajo - '.$modelo->norma,
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
                    'resources' => [],
                    'subtasks' => [],
                    'historic' => [],
                ],
            ];

            $assigs = [];

            $planImplementacion = new PlanImplementacion; // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $planImplementacion->tasks = $tasks;
            $planImplementacion->canAdd = true;
            $planImplementacion->canWrite = true;
            $planImplementacion->canWriteOnParent = true;
            $planImplementacion->changesReasonWhy = false;
            $planImplementacion->selectedRow = 0;
            $planImplementacion->zoom = '3d';
            $planImplementacion->parent = 'Incidente - '.$modelo->folio;
            $planImplementacion->norma = 'ISO 27001';
            $planImplementacion->modulo_origen = 'Incidentes';
            $planImplementacion->objetivo = null;
            $planImplementacion->elaboro_id = User::getCurrentUser()->empleado->id;

            $modelo->planes()->save($planImplementacion);
        }
    }

    public function show($planImplementacion)
    {
        try {
            $planImplementacion = PlanImplementacion::find($planImplementacion);

            if (! $planImplementacion) {
                // Si no existe, redirigir o mostrar un mensaje de error
                abort(404);
            }

            return view('admin.workPlan.show', compact('planImplementacion'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function edit($planImplementacion)
    {

        try {
            abort_if(Gate::denies('planes_de_accion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $planImplementacion = PlanImplementacion::findOrFail($planImplementacion);

            if (! $planImplementacion) {
                abort(404);
            }

            $referencia = null;

            return view('admin.workPlan.edit', compact('planImplementacion', 'referencia'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $planImplementacion)
    {
        try {
            $request->validate([
                'parent' => 'required|string|max:255',
                'inicio' => 'required|date',
                'fin' => 'required|date|after:inicio', // Asegura que la fecha de fin sea después de la fecha de inicio
                'objetivo' => 'required|string|max:550',
            ], [
                'parent.required' => 'Debes definir un nombre para el plan de trabajo',
                'objetivo.required' => 'Debes definir un objetivo para el plan de trabajo',
                'fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
            ]);
            $planImplementacion = PlanImplementacion::find($planImplementacion);

            if (! $planImplementacion) {
                abort(404);
            }

            $planImplementacion->update([ // Necesario se carga inicialmente el Diagrama Universal de Gantt
                'parent' => $request->parent,
                'norma' => $request->norma,
                'modulo_origen' => $request->modulo_origen,
                'objetivo' => $request->objetivo,
            ]);
            $route = $planImplementacion->es_plan_trabajo_base ? 'admin.planTrabajoBase.index' : 'admin.planes-de-accion.index';
            $mensaje = $planImplementacion->es_plan_trabajo_base ? 'Plan de Trabajo Base Actualizado' : 'Plan de Trabajo Actualizado';

            return redirect()->route($route)->with('success', $mensaje);
        } catch (\Throwable $th) {
            abort(404);
        }

        $planImplementacion->update([ // Necesario se carga inicialmente el Diagrama Universal de Gantt
            'parent' => $request->parent,
            'norma' => $request->norma,
            'modulo_origen' => $request->modulo_origen,
            'objetivo' => $request->objetivo,
        ]);
        $route = $planImplementacion->es_plan_trabajo_base ? 'admin.planTrabajoBase.index' : 'admin.planes-de-accion.index';
        $mensaje = $planImplementacion->es_plan_trabajo_base ? 'Plan de Trabajo Base Actualizado' : 'Plan de Trabajo Actualizado';

        return redirect()->route($route)->with('success', $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $planImplementacionId)
    {
        abort_if(Gate::denies('planes_de_accion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planImplementacion = PlanImplementacion::find($planImplementacionId);

        if ($planImplementacion) {
            $eliminado = $planImplementacion->delete();

            return redirect()->route('admin.planes-de-accion.index')->with('success', 'Eliminado exitosamente');
        } else {
            return redirect()->route('admin.planes-de-accion.index')->with('error', 'No se encontró el Plan de Trabajo para eliminar');
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
        //$implementacion = PlanImplementacion::find($plan);
        //$users = DB::table('users')->select('name', 'email as user_email')->get();
        $implementacion = DB::table('plan_implementacions')
            ->select('*')
            ->where('id', $plan)
            ->first();

        $tasks = json_decode($implementacion->tasks);
        foreach (json_decode($implementacion->tasks) as $task) {
            $task->status = $task->status ?? 'STATUS_UNDEFINED';
            $task->end = intval($task->end);
            $task->start = intval($task->start);
            $task->canAdd = $task->canAdd === 'true';
            $task->canWrite = $task->canWrite === 'true';
            $task->duration = intval($task->duration);
            $task->progress = intval($task->progress);
            $task->canDelete = $task->canDelete === 'true';
            $task->level = isset($task->level) ? intval($task->level) : 0;
            $task->collapsed = isset($task->collapsed) ? $task->collapsed === 'true' : false;
            $task->canAddIssue = isset($task->canAddIssue) ? $task->canAddIssue === 'true' : false;
            $task->endIsMilestone = isset($task->endIsMilestone) ? $task->endIsMilestone === 'true' : false;
            $task->startIsMilestone = isset($task->startIsMilestone) ? $task->startIsMilestone === 'true' : false;
            $task->progressByWorklog = isset($task->progressByWorklog) ? $task->progressByWorklog === 'true' : false;
        }

        $elaborador = DB::table('empleados')
            ->select(
                'id',
                'name',
                'n_registro',
                'foto',
                'puesto',
                'estatus',
                'telefono_movil',
                'genero',
                'n_empleado',
                'supervisor_id',
                'area_id',
                'sede_id',
                'puesto_id',
                'perfil_empleado_id',
                'tipo_contrato_empleados_id',
                'proyecto_asignado',
                'entidad_crediticias_id',
                'semanas_min_timesheet',
                'vacante_activa'
            )->get();
        $roles = DB::table('roles')
            ->select(
                'id',
                'title as name'
            )->get();
        $area = DB::table('areas')
            ->select(
                'id',
                'area',
                'foto_area'
            )->get();

        $implementacion->resources = $elaborador;
        $implementacion->roles = $roles;
        $implementacion->tasks = $tasks;
        $implementacion->area = $area;

        return $implementacion;
    }
}
