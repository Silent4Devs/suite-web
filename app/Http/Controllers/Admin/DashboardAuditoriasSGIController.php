<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\Calendario;
use App\Models\CalendarioOficial;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\EntregaMensual;
use App\Models\ContractManager\Factura;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\PlanBaseActividade;
use App\Models\PlanImplementacion;
use App\Models\Recurso;
use App\Models\Mejoras;
use App\Models\AccionCorrectiva;


class DashboardAuditoriasSGIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // DASHBOARD MEJORAS Y ACCIONES

        // Mejoras
        $mejoras = Mejoras::select('estatus')->get();
        $cerradoCount = $mejoras->where('estatus', 'cerrado')->count();
        $encursoCount = $mejoras->where('estatus', 'en curso')->count();
        $enesperaCount = $mejoras->Where('estatus', 'en espera')->count();
        $sinatenderCount = $mejoras->Where('estatus', 'sin atender')->count();

        // ACCIONES CORRECTIVAS
        $accioncorrectiva = AccionCorrectiva::select('estatus')->get();
        $cerradoCountAC = $accioncorrectiva->where('estatus', 'Cerrado')->count();
        $encursoCountAC = $accioncorrectiva->where('estatus', 'En curso')->count();
        $enesperaCountAC = $accioncorrectiva->where('estatus', 'En espera')->count();
        $sinatenderCountAC = $accioncorrectiva->where('estatus', 'Sin atender')->count();

        // CALENDARIO
        $empleado = auth()->user()->empleado;
        $usuario = auth()->user();

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
        $auditorias_anual = AuditoriaAnual::getAll();
        $auditoria_internas = AuditoriaInterna::get();
        // dd($auditoria_internas);

        $recursos = collect();
        if ($usuario->empleado) {
            $recursos = Recurso::whereHas('empleados', function ($query) use ($empleado) {
                $query->where('empleados.id', $empleado->id);
            })->get();
        }

        $eventos = Calendario::getAll();
        $oficiales = CalendarioOficial::get();
        $contratos = Contrato::select('nombre_servicio', 'fecha_inicio', 'fecha_fin')->get();

        $facturas = Factura::select('concepto', 'fecha_recepcion', 'fecha_liberacion')->get();

        $niveles_servicio = EntregaMensual::select('nombre_entregable', 'plazo_entrega_inicio', 'plazo_entrega_termina')->get();

        $cumples_aniversarios = Empleado::getaltaAll();
        $nombre_organizacion = Organizacion::getFirst();
        $nombre_organizacion = $nombre_organizacion ? $nombre_organizacion->empresa : 'la Organización';
        return view('admin.AuditoriasSGI.index', compact(
            'plan_base',
            'auditorias_anual',
            'recursos',
            'actividades',
            'auditoria_internas',
            'eventos',
            'oficiales',
            'cumples_aniversarios',
            'nombre_organizacion',
            'contratos',
            'facturas',
            'niveles_servicio',
            'mejoras',
            'cerradoCount',
            'encursoCount',
            'enesperaCount',
            'sinatenderCount',
            'accioncorrectiva',
            'cerradoCountAC',
            'encursoCountAC',
            'enesperaCountAC',
            'sinatenderCountAC',
        ));
    }
}
