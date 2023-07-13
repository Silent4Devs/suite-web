<?php

namespace App\Http\Controllers\Admin;

use App\Models\AccionCorrectiva;
use App\Models\AuditoriaAnual;
use App\Models\CategoriaCapacitacion;
use App\Models\ControlDocumento;
use App\Models\Documento;
use App\Models\IncidentesDeSeguridad;
use App\Models\IncidentesSeguridad;
use App\Models\IndicadoresSgsi;
use App\Models\PlanBaseActividade;
use App\Models\PlanImplementacion;
use App\Models\Recurso;
use App\Models\Registromejora;
use App\Services\LaravelChart;
use Carbon\Carbon;
use DB;

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
        // dd($settings1);

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

        // DB::enableQueryLog();
        $total = IncidentesSeguridad::select('id')->get()->count();
        $nuevos = IncidentesSeguridad::select('id')->where('estatus', 'nuevo')->get()->count();
        $en_curso = IncidentesSeguridad::select('id')->where('estatus', 'en curso')->get()->count();
        $en_espera = IncidentesSeguridad::select('id')->where('estatus', 'en espera')->get()->count();
        $cerrados = IncidentesSeguridad::select('id')->where('estatus', 'cerrado')->get()->count();
        $cancelados = IncidentesSeguridad::select('id')->where('estatus', 'cancelado')->get()->count();

        // Show results of log

        $chart2 = new LaravelChart($settings2);

        // $settings3 = [
        //     'chart_title'        => 'Progreso general del plan',
        //     'chart_type'         => 'pie',
        //     'report_type'        => 'group_by_relationship',
        //     'model'              => 'App\Models\PlanBaseActividade',
        //     'group_by_field'     => 'estado',
        //     'aggregate_function' => 'count',
        //     'filter_field'       => 'created_at',
        //     'column_class'       => 'col-md-12',
        //     'entries_number'     => '5',
        //     'relationship_name'  => 'estatus',
        // ];

        // $chart3 = new LaravelChart($settings3);

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
                } elseif (isset($settings5['filter_period'])) {
                    switch ($settings5['filter_period']) {
                        case 'week':
                            $start = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start = date('Y') . '-01-01';
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
        // dd('test');
        if (class_exists($settings6['model'])) {
            $settings6['total_number'] = $settings6['model']::when(isset($settings6['filter_field']), function ($query) use ($settings6) {
                if (isset($settings6['filter_days'])) {
                    return $query->where(
                        $settings6['filter_field'],
                        '>=',
                        now()->subDays($settings6['filter_days'])->format('Y-m-d')
                    );
                } elseif (isset($settings6['filter_period'])) {
                    switch ($settings6['filter_period']) {
                        case 'week':
                            $start = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start = date('Y') . '-01-01';
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

        $actividadsininici = PlanBaseActividade::select('id')->where('estatus_id', '=', '1')->count('id');
        $actividadenproc = PlanBaseActividade::select('id')->where('estatus_id', '=', '2')->count('id');
        $actividadcompl = PlanBaseActividade::select('id')->where('estatus_id', '=', '3')->count('id');
        $actividadretr = PlanBaseActividade::select('id')->where('estatus_id', '=', '4')->count('id');

        $auditexterna = AuditoriaAnual::select('id')->count('id');
        $auditinterna = AuditoriaAnual::select('id')->count('id');

        $exist_doc = ControlDocumento::select('deleted_at')->where('deleted_at', '=', null)->count();
        $capacitaciones = Recurso::getAll();
        $categorias_arr = [];
        $recursos_categoria_arr = [];
        $categorias = CategoriaCapacitacion::with('recursos')->get();
        foreach ($categorias as $categoria) {
            array_push($categorias_arr, $categoria->nombre);
            array_push($recursos_categoria_arr, count($categoria->recursos));
        }
        $tipos_total_arr = [];
        $diplomado = 0;
        $certificado = 0;
        $curso = 0;
        $tipos = Recurso::getAll();

        foreach ($tipos as $tipo) {
            if ($tipo->tipo == 'diplomado') {
                $diplomado++;
            } elseif ($tipo->tipo == 'certificacion') {
                $certificado++;
            } elseif ($tipo->tipo == 'curso') {
                $curso++;
            }
        }
        array_push($tipos_total_arr, $diplomado);
        array_push($tipos_total_arr, $certificado);
        array_push($tipos_total_arr, $curso);

        $capacitaciones_year_actual = Recurso::whereYear('fecha_curso', date('Y'))->count();
        $capacitaciones_year_actual_uno_antes = Recurso::whereYear('fecha_curso', date('Y') - 1)->count();

        $arr_fechas_cursos = [];
        $arr_participantes = [];
        $recursos = Recurso::whereYear('fecha_curso', date('Y'))->orderBy('fecha_curso', 'asc')->get();
        // dd(Carbon::parse($recursos[0]->fecha_curso)->diff());
        foreach ($recursos as $recurso) {
            array_push($arr_fechas_cursos, Carbon::parse($recurso->fecha_curso)->format('M d Y'));
            array_push($arr_participantes, count($recurso->empleados));
        }

        // Gantt Tasks
        $actividades = collect();
        $implementacion = PlanImplementacion::first();
        if ($implementacion) {
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
                $task->canAddIssue = $task->canAddIssue == 'true' ? true : false;
                $task->endIsMilestone = $task->endIsMilestone == 'true' ? true : false;
                $task->startIsMilestone = $task->startIsMilestone == 'true' ? true : false;
                $task->progressByWorklog = $task->progressByWorklog == 'true' ? true : false;
                $actividades->push($task);
            }
        }
        // Fin Gantt Tasks
        //Inicio Documentos
        $contador_documentos_publicados = Documento::where('estatus', '=', Documento::PUBLICADO)->count();
        $contador_documentos_en_elaboracion = Documento::where('estatus', '=', Documento::EN_ELABORACION)->count();
        $contador_documentos_en_revision = Documento::where('estatus', '=', Documento::EN_REVISION)->count();
        $contador_documentos_rechazados = Documento::where('estatus', '=', Documento::DOCUMENTO_RECHAZADO)->count();
        $contador_documentos_obsoletos = Documento::where('estatus', '=', Documento::DOCUMENTO_OBSOLETO)->count();
        //Fin Documentos

        $evaluacion_indicadores = IndicadoresSgsi::select('indicadores_sgsis.nombre', 'evaluacion_indicador.*', 'indicadores_sgsis.meta', 'indicadores_sgsis.id')
            ->join('evaluacion_indicador', 'indicadores_sgsis.id', '=', 'evaluacion_indicador.id_indicador')->get()->toArray();
        $evaluaciones = [];
        $evaluacion_nombre = [];

        foreach ($evaluacion_indicadores as $evaluacion) {
            array_push($evaluaciones, $evaluacion['resultado']);
            array_push($evaluacion_nombre, $evaluacion['nombre']);
        }
        // dd(DB::getQueryLog());
        // dd($evaluacion_nombre);
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
            'contador_documentos_publicados',
            'contador_documentos_en_elaboracion',
            'contador_documentos_en_revision',
            'contador_documentos_rechazados',
            'contador_documentos_obsoletos',
            'actividades',
            'exist_doc',
            'capacitaciones',
            'categorias',
            'categorias_arr',
            'recursos_categoria_arr',
            'tipos_total_arr',
            'capacitaciones_year_actual',
            'capacitaciones_year_actual_uno_antes',
            'arr_fechas_cursos',
            'arr_participantes',
            'total',
            'nuevos',
            'en_curso',
            'en_espera',
            'cerrados',
            'cancelados',
            'evaluacion_indicadores',
            'evaluacion_nombre',
            'evaluaciones'
        ));
    }
}
