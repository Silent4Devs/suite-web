<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActividadDenuncia;
use App\Models\Denuncias;
use App\Models\PlanImplementacion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActividadesDenunciasController extends Controller
{
    public function index(Request $request, $denuncia_id)
    {
        if ($request->ajax()) {
            $actividades = ActividadDenuncia::with('responsables')->where('denuncia_id', $denuncia_id)->get();

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
            $actividad = ActividadDenuncia::create($request->all());
            $responsables = $request->responsables;
            $actividad->responsables()->sync($responsables);

            $modelo = Denuncias::find(intval($request->denuncia_id));
            $actividad = ActividadDenuncia::find($actividad->id);

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
                        'name' => 'Denuncia - ' . $modelo->folio,
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
                        'name' => $modelo->folio,
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
                $planImplementacion->parent = 'Denuncia - ' . $modelo->folio;
                $planImplementacion->norma = 'ISO 27001';
                $planImplementacion->modulo_origen = 'Denuncias';
                $planImplementacion->objetivo = null;
                $planImplementacion->elaboro_id = auth()->user()->empleado->id;

                $modelo->planes()->save($planImplementacion);
            }
        }
    }
}
