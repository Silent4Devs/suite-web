<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\PlanBaseActividade;
use App\Models\PlanImplementacion;
use App\Models\Recurso;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class SystemCalendarController extends Controller
{
    // public $sources = [
    //     [
    //         'model'      => '\App\Models\AuditoriaInterna',
    //         'date_field' => 'fechaauditoria',
    //         'field'      => 'alcance',
    //         'prefix'     => '',
    //         'suffix'     => '',
    //         'route'      => 'admin.auditoria-internas.edit',
    //     ],
    //     [
    //         'model'      => '\App\Models\PlanaccionCorrectiva',
    //         'date_field' => 'fechacompromiso',
    //         'field'      => 'actividad',
    //         'prefix'     => '',
    //         'suffix'     => '',
    //         'route'      => 'admin.planaccion-correctivas.edit',
    //     ],
    //     [
    //         'model'      => '\App\Models\PlanMejora',
    //         'date_field' => 'fecha_compromiso',
    //         'field'      => 'descripcion',
    //         'prefix'     => '',
    //         'suffix'     => '',
    //         'route'      => 'admin.plan-mejoras.edit',
    //     ],
    //     [
    //         'model'      => '\App\Models\PlanBaseActividade',
    //         'date_field' => 'fecha_inicio',
    //         'field'      => 'actividad',
    //         'prefix'     => '',
    //         'suffix'     => '',
    //         'route'      => 'admin.plan-base-actividades.edit',
    //     ],
    // ];

    public function index()
    {
        abort_if(Gate::denies('agenda_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $implementaciones = PlanImplementacion::getAll();
        $actividades = collect();

        if ($implementaciones) {
            foreach ($implementaciones as $implementacion) {
                $tasks = $implementacion->tasks;
                foreach ($tasks as $task) {
                    $task->parent_id = $implementacion->id;
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
                    $task->canAddIssue = $task->canAddIssue == 'true' ? true : false;
                    $task->endIsMilestone = $task->endIsMilestone == 'true' ? true : false;
                    $task->startIsMilestone = $task->startIsMilestone == 'true' ? true : false;
                    $task->progressByWorklog = $task->progressByWorklog == 'true' ? true : false;
                    $actividades->push($task);
                }

                $implementacion->tasks = $tasks;
                // if (!isset($implementacion->assigs)) {
                //     $implementacion = (object)array_merge((array)$implementacion, array('assigs' => []));
                // }
            }
        }
        // $actividades = $actividades->flatten(1);

        $plan_base = PlanBaseActividade::get();
        $auditorias_anual = AuditoriaAnual::get();
        $auditoria_internas = AuditoriaInterna::get();
        // dd($auditoria_internas);
        $recursos = Recurso::get();

        return view('fontend.calendar.calendar', compact('plan_base', 'auditorias_anual', 'recursos', 'actividades', 'auditoria_internas'));
    }
}
