<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Mejoras;
use Illuminate\Http\Request;
use App\Models\ActividadMejora;
use App\Models\PlanImplementacion;
use App\Http\Controllers\Controller;

class ActividadesMejorasController extends Controller
{
    public function index(Request $request, $mejora_id)
    {
        if ($request->ajax()) {
            $actividades = ActividadMejora::with('responsables')->where('mejora_id', $mejora_id)->get();

            return datatables()->of($actividades)->toJson();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'actividad' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'prioridad' => 'required',
            'tipo' => 'required',
            'responsables' => 'required',
            'comentarios' => 'required',
        ]);
        if ($request->ajax()) {
            $actividad = ActividadMejora::create($request->all());
            $responsables = $request->responsables;
            $actividad->responsables()->sync($responsables);

            $modelo = Mejoras::find(intval($request->mejora_id));
            $actividad = ActividadMejora::find($actividad->id);
            if (!count($modelo->planes)) {
                $this->vincularActividadesPlanDeAccion($actividad, $modelo);
            } else {
                $plan = $modelo->planes->first();
                $this->vincularActividadesPlanDeAccion($actividad, $modelo, $plan, true);
            }

            return response()->json(['success' => true]);
            // $actividades = ActividadIncidente::with('responsables')->where('seguridad_id', $request->seguridad_id)->get();
        }
    }

    public function vincularActividadesPlanDeAccion($actividad, $modelo, $planEdit = null, $edit = false)
    {
        if (isset($actividad)) {
            if (!count($modelo->planes)) {
                $tasks = [
                    [
                        'id' => 'tmp_' . (strtotime(now())) . '_1',
                        'end' => strtotime(now()) * 1000,
                        'name' => 'Mejora - ' . $modelo->folio . '-' . $modelo->titulo,
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
                        'name' => $modelo->folio . '-' . $modelo->titulo,
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

                $asignados = $actividad->responsables;
                $assigs = [];
                foreach ($asignados as $asignado) {
                    // $empleado = Empleado::find($id);
                    $assigs[] = [
                        'id' => 'tmp_' . time() . '_' . $asignado->id,
                        'effort' => '0',
                        'roleId' => '1',
                        'resourceId' => $asignado->id,
                    ];
                }

                $start = strtotime($actividad->fecha_inicio) * 1000;
                $end = strtotime($actividad->fecha_fin) * 1000;
                $duration = Carbon::parse($actividad->fecha_inicio)->diffInDays(Carbon::parse($actividad->fecha_fin));
                $tasks[] = [
                    'id' => 'tmp_' . $start . '_' . $end . '_' . $actividad->id,
                    'end' => $end,
                    'name' => $actividad->actividad,
                    'level' => 2,
                    'start' => $start,
                    'canAdd' => true,
                    'status' => 'STATUS_UNDEFINED',
                    'canWrite' => true,
                    'duration' => $duration,
                    'progress' => 0,
                    'canDelete' => true,
                    'collapsed' => false,
                    'relevance' => '0',
                    'canAddIssue' => true,
                    'description' => $actividad->comentarios,
                    'endIsMilestone' => false,
                    'startIsMilestone' => false,
                    'progressByWorklog' => false,
                    'assigs' => $assigs,
                ];
            } else {
                $planActual = $modelo->planes->first();
                $tasks = $planActual->tasks;

                $asignados = $actividad->responsables;

                $assigs = [];
                foreach ($asignados as $asignado) {
                    // $empleado = Empleado::find($id);
                    $assigs[] = [
                        'id' => 'tmp_' . time() . '_' . $asignado->id,
                        'effort' => '0',
                        'roleId' => '1',
                        'resourceId' => $asignado->id,
                    ];
                }

                $start = strtotime($actividad->fecha_inicio) * 1000;
                $end = strtotime($actividad->fecha_fin) * 1000;
                $duration = Carbon::parse($actividad->fecha_inicio)->diffInDays(Carbon::parse($actividad->fecha_fin));
                $tasks[] = [
                    'id' => 'tmp_' . $start . '_' . $end . '_' . $actividad->id,
                    'end' => $end,
                    'name' => $actividad->actividad,
                    'level' => 2,
                    'start' => $start,
                    'canAdd' => true,
                    'status' => 'STATUS_UNDEFINED',
                    'canWrite' => true,
                    'duration' => $duration,
                    'progress' => 0,
                    'canDelete' => true,
                    'collapsed' => false,
                    'relevance' => '0',
                    'canAddIssue' => true,
                    'description' => $actividad->comentarios,
                    'endIsMilestone' => false,
                    'startIsMilestone' => false,
                    'progressByWorklog' => false,
                    'assigs' => $assigs,
                ];
            }

            if ($edit) {
                $planEdit->update([
                    'tasks' => $tasks,
                ]);
                $modelo->planes()->sync($planEdit);
            } else {
                $planImplementacion = new PlanImplementacion(); // Necesario se carga inicialmente el Diagrama Universal de Gantt
                $planImplementacion->tasks = $tasks;
                $planImplementacion->canAdd = true;
                $planImplementacion->canWrite = true;
                $planImplementacion->canWriteOnParent = true;
                $planImplementacion->changesReasonWhy = false;
                $planImplementacion->selectedRow = 0;
                $planImplementacion->zoom = '3d';
                $planImplementacion->parent = 'Mejora - ' . $modelo->folio;
                $planImplementacion->norma = 'ISO 27001';
                $planImplementacion->modulo_origen = 'Mejoras';
                $planImplementacion->objetivo = null;
                $planImplementacion->elaboro_id = User::getCurrentUser()->empleado->id;

                $modelo->planes()->save($planImplementacion);
            }
        }
    }
}
