<?php

namespace App\Http\Controllers\Admin;

use App\Services\LaravelChart;
use App\Models\User;
use DB;
use Carbon\Carbon;
use App\Models\AccionCorrectiva;
use App\Models\Registromejora;
use App\Models\IncidentesDeSeguridad;
use App\Models\ControlDocumento;
use App\Models\PlanBaseActividade;
use App\Models\AuditoriaAnual;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'        => 'Actividades por colaborador',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\PlanBaseActividade',
            'group_by_field'     => 'name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_period'      => 'year',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'colaborador',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'        => 'Incidentes de seguridad',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\IncidentesDeSeguridad',
            'group_by_field'     => 'estado',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'estado',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'        => 'Progreso general del plan',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\PlanBaseActividade',
            'group_by_field'     => 'estado',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
            'relationship_name'  => 'estatus',
        ];

        $chart3 = new LaravelChart($settings3);

        $settings4 = [
            'chart_title'        => 'Documentación',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\ControlDocumento',
            'group_by_field'     => 'estado',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
            'relationship_name'  => 'estado',
        ];

        $chart4 = new LaravelChart($settings4);

        $settings5 = [
            'chart_title'           => 'Total acciones correctivas',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\AccionCorrectiva',
            'group_by_field'        => 'fecharegistro',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-2',
            'entries_number'        => '10',
        ];

        $settings5['total_number'] = 0;

        if (class_exists($settings5['model'])) {
            $settings5['total_number'] = $settings5['model']::when(isset($settings5['filter_field']), function ($query) use ($settings5) {
                if (isset($settings5['filter_days'])) {
                    return $query->where(
                        $settings5['filter_field'],
                        '>=',
                        now()->subDays($settings5['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings5['filter_period'])) {
                    switch ($settings5['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings5['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings5['aggregate_function'] ?? 'count'}($settings5['aggregate_field'] ?? '*');
        }

        $settings6 = [
            'chart_title'           => 'Total acciones de mejora',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Registromejora',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-2',
            'entries_number'        => '5',
        ];

        $settings6['total_number'] = 0;

        if (class_exists($settings6['model'])) {
            $settings6['total_number'] = $settings6['model']::when(isset($settings6['filter_field']), function ($query) use ($settings6) {
                if (isset($settings6['filter_days'])) {
                    return $query->where(
                        $settings6['filter_field'],
                        '>=',
                        now()->subDays($settings6['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings6['filter_period'])) {
                    switch ($settings6['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings6['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings6['aggregate_function'] ?? 'count'}($settings6['aggregate_field'] ?? '*');
        }

        $settings7 = [
            'chart_title'           => 'Auditoria Interna - Total No conformidad menor',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\AuditoriaInterna',
            'group_by_field'        => 'fechaauditoria',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'count',
            'aggregate_field'       => 'totalnoconformidadmenor',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart7 = new LaravelChart($settings7);

        $settings8 = [
            'chart_title'           => 'Auditoria Interna - Total No conformidad mayor',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\AuditoriaInterna',
            'group_by_field'        => 'fechaauditoria',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'totalnoconformidadmayor',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart8 = new LaravelChart($settings8);

        $settings9 = [
            'chart_title'           => 'Auditoria Interna - Total Observación',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\AuditoriaInterna',
            'group_by_field'        => 'fechaauditoria',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'totalobservacion',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart9 = new LaravelChart($settings9);

        $settings10 = [
            'chart_title'           => 'Auditoria Interna - Total mejora',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\AuditoriaInterna',
            'group_by_field'        => 'fechaauditoria',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'totalmejora',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart10 = new LaravelChart($settings10);



        $registro = Registromejora::select('id')->count('id');
        $accionc = AccionCorrectiva::select('id')->count('id');

        $incidentesasignado = IncidentesDeSeguridad::select('id')->where('estado_id', '=', '4')->count('id');
        $incidentescerrado = IncidentesDeSeguridad::select('id')->where('estado_id', '=', '1')->count('id');
        $incidentespendiente = IncidentesDeSeguridad::select('id')->where('estado_id', '=', '3')->count('id');
        $incidentescancelado = IncidentesDeSeguridad::select('id')->where('estado_id', '=', '5')->count('id');
        $incidentescurso = IncidentesDeSeguridad::select('id')->where('estado_id', '=', '2')->count('id');


        $documentoPubli = ControlDocumento::select('id')->where('estado_id', '=', '1')->count('id');
        $documentoAprob =  ControlDocumento::select('id')->where('estado_id', '=', '2')->count('id');
        $documentorev = ControlDocumento::select('id')->where('estado_id', '=', '3')->count('id');
        $documentoElab = ControlDocumento::select('id')->where('estado_id', '=', '4')->count('id');
        $docunoelab =  ControlDocumento::select('id')->where('estado_id', '=', '5')->count('id');

        $actividadsininici = PlanBaseActividade::select('id')->where('estatus_id', '=', '1')->count('id');
        $actividadenproc =  PlanBaseActividade::select('id')->where('estatus_id', '=', '2')->count('id');
        $actividadcompl = PlanBaseActividade::select('id')->where('estatus_id', '=', '3')->count('id');
        $actividadretr = PlanBaseActividade::select('id')->where('estatus_id', '=', '4')->count('id');
      
        $auditexterna = AuditoriaAnual::select('id')->where('tipo', '=', 'Interna')->count('id');
        $auditinterna = AuditoriaAnual::select('id')->where('tipo', '=', 'Externa')->count('id');

        $exist_doc = ControlDocumento::select('deleted_at')->where('deleted_at', '=', null)->count();
        

        return view('home', compact(
            'auditexterna',
            'auditinterna',
            'actividadsininici',
            'actividadenproc',
            'actividadcompl',
            'actividadretr',
            'settings6',
            'settings5',
            'chart1',
            'chart2',
            'chart3',
            'chart4',
            'chart7',
            'chart8',
            'chart9',
            'chart10',
            'accionc',
            'registro',
            'incidentesasignado',
            'incidentescerrado',
            'incidentespendiente',
            'incidentescancelado',
            'incidentescurso',
            'documentoPubli',
            'documentoAprob',
            'documentorev',
            'documentoElab',
            'docunoelab',
            'exist_doc'
        ));
    }
}
