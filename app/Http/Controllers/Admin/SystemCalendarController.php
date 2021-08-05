<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\PlanBaseActividade;
use App\Models\AuditoriaAnual;
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
        $gantt_path = 'storage/gantt/gantt_inicial.json';
        $file_gant = json_decode(file_get_contents($gantt_path), true);

        $plan_base = PlanBaseActividade::get();
        $auditorias_anual = AuditoriaAnual::get();
        $recursos = Recurso::get();

        return view('admin.calendar.calendar', compact('plan_base', 'auditorias_anual', 'recursos', 'file_gant'));
    }
}
