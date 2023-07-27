<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PlanImplementacion;
use Illuminate\Http\Request;

class PlanesAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $planesImplementacion = PlanImplementacion::with('elaborador')->get();

            return datatables()->of($planesImplementacion)->toJson();
        }

        return view('frontend.planesDeAccion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($modulo, $referencia = null)
    {
        $planImplementacion = new PlanImplementacion();

        return view('frontend.planesDeAccion.create', compact('planImplementacion', 'modulo', 'referencia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $planImplementacion = PlanImplementacion::create([ // Necesario se carga inicialmente el Diagrama Universal de Gantt
            'tasks' => [],
            'canAdd' => true,
            'canWrite' => true,
            'canWriteOnParent' => true,
            'changesReasonWhy' => false,
            'selectedRow' => 0,
            'zoom' => '3d',
            'parent' => $request->parent,
            'norma' => $request->norma,
            'modulo_origen' => $request->modulo_origen,
            'objetivo' => $request->objetivo,
            'elaboro_id' => auth()->user()->empleado->id,
        ]);

        return redirect()->route('planes-de-accion.index')->with('success', 'Plan de Acción'.$planImplementacion->parent.'creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function show($planImplementacion)
    {
        $planImplementacion = PlanImplementacion::find($planImplementacion);

        return view('frontend.planesDeAccion.show', compact('planImplementacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function edit($planImplementacion)
    {
        $planImplementacion = PlanImplementacion::find($planImplementacion);
        $referencia = null;

        return view('frontend.planesDeAccion.edit', compact('planImplementacion', 'referencia'));
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

        return redirect()->route('planes-de-accion.index')->with('success', 'Plan de Acción Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanImplementacion  $planImplementacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $planImplementacion)
    {
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
            PlanImplementacion::find($plan)->update([
                'tasks' => $tasks,
                'canAdd' => isset($project['canAdd']) ? $project['canAdd'] : true,
                'canWrite' => isset($project['canWrite']) ? $project['canWrite'] : true,
                'canWriteOnParent' => isset($project['canWriteOnParent']) ? $project['canWriteOnParent'] : null,
                'changesReasonWhy' => isset($project['changesReasonWhy']) ? $project['changesReasonWhy'] : null,
                'selectedRow' => isset($project['selectedRow']) ? $project['selectedRow'] : 0,
                'zoom' => isset($project['zoom']) ? $project['zoom'] : '1M',
            ]);
        } else {
            $tasks = isset($project['tasks']) ? $project['tasks'] : [];
            PlanImplementacion::create([
                'tasks' => $tasks,
                'canAdd' => isset($project['canAdd']) ? $project['canAdd'] : true,
                'canWrite' => isset($project['canWrite']) ? $project['canWrite'] : true,
                'canWriteOnParent' => isset($project['canWriteOnParent']) ? $project['canWriteOnParent'] : null,
                'changesReasonWhy' => isset($project['changesReasonWhy']) ? $project['changesReasonWhy'] : null,
                'selectedRow' => isset($project['selectedRow']) ? $project['selectedRow'] : 0,
                'zoom' => isset($project['zoom']) ? $project['zoom'] : '1M',
            ]);
        }

        return response()->json(['success' => true], 200);
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
