<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
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
use App\Models\AuditoriaInternasHallazgos;
use App\Models\ClasificacionesAuditorias;
// use GuzzleHttp\Psr7\Request;

class AuditoriasSGI extends Component
{
    public $tabOption = 0;
    public $mejoras = null;
    public $clashallazgos;
    public $clashallazgosaudit = null;
    public $clausid = null;
    public $plan_base = null;
    public $auditorias_anual = null;
    public $recursos = null;
    public $actividades = null;
    public $auditoria_internas = null;
    public $eventos = null;
    public $oficiales = null;
    public $cumples_aniversarios = null;
    public $nombre_organizacion = null;
    public $contratos = null;
    public $facturas = null;
    public $niveles_servicio = null;
    public $cerradoCount = null;
    public $encursoCount = null;
    public $enesperaCount = null;
    public $sinatenderCount = null;
    public $accioncorrectiva = null;
    public $cerradoCountAC = null;
    public $encursoCountAC = null;
    public $enesperaCountAC = null;
    public $sinatenderCountAC = null;
    public $observacion = null;
    public $noconformayor = null;
    public $oportunidadmejora = null;
    public $noconformenor = null;
    public $empleado = null;
    public $contexto = null;
    public $liderazgo = null;
    public $planificacion = null;
    public $soporte = null;
    public $operacion = null;
    public $evaluacion = null;
    public $mejora = null;
    public $audits = null;
    public $totalclasificaciones = null;
    public $nombreauditorias = null;
    public $nombreaudits = null;
    public $clasificaciones = null;
    public $auditoriasView = null;

    public function render()
    {

        return view('livewire.dashboard.auditorias-s-g-i', [
            'plan_base' => $this->plan_base,
            'auditorias_anual' => $this->auditorias_anual,
            'recursos' => $this->recursos,
            'actividades' => $this->actividades,
            'auditoria_internas' => $this->auditoria_internas,
            'eventos' => $this->eventos,
            'oficiales' => $this->oficiales,
            'cumples_aniversarios' => $this->cumples_aniversarios,
            'nombre_organizacion' => $this->nombre_organizacion,
            'contratos' => $this->contratos,
            'facturas' => $this->facturas,
            'niveles_servicio' => $this->niveles_servicio,
            'mejoras' => $this->mejoras,
            'cerradoCount' => $this->cerradoCount,
            'encursoCount' => $this->encursoCount,
            'enesperaCount' => $this->enesperaCount,
            'sinatenderCount' => $this->sinatenderCount,
            'accioncorrectiva' => $this->accioncorrectiva,
            'cerradoCountAC' => $this->cerradoCountAC,
            'encursoCountAC' => $this->encursoCountAC,
            'enesperaCountAC' => $this->enesperaCountAC,
            'sinatenderCountAC' => $this->sinatenderCountAC,
            'observacion' => $this->observacion,
            'noconformayor' => $this->noconformayor,
            'oportunidadmejora' => $this->oportunidadmejora,
            'noconformenor' => $this->noconformenor,
            'empleado' => $this->empleado,
            'clausid' => $this->clausid,
            'contexto' => $this->contexto,
            'liderazgo' => $this->liderazgo,
            'planificacion' => $this->planificacion,
            'soporte' => $this->soporte,
            'operacion' => $this->operacion,
            'evaluacion' => $this->evaluacion,
            'mejora' => $this->mejora,
            'clashallazgosaudit' => $this->clashallazgosaudit,
            'audits' => $this->audits,
            'totalclasificaciones' => $this->totalclasificaciones,
            'nombreauditorias' => $this->nombreauditorias,
            'nombreaudits' => $this->nombreaudits,
            'clasificaciones' => $this->clasificaciones,
            'auditoriasView' => $this->auditoriasView,
            'tabOption' => $this->tabOption
        ]);
    }
    public function updateData($option)
    {
        $this->tabOption = $option;
        switch ($this->tabOption) {
            case 1:
                //VISTA DE MI PLAN ISO
                break;
            case 2:
                //VISTA DE RIESGOS

                break;
            case 3:
                //VISTA DEl DASHBOARD AUDITORIAS
                //Tarjetas en general
                $this->clashallazgos = AuditoriaInternasHallazgos::select('clasificacion_hallazgo')->get();
                $this->clashallazgosaudit = AuditoriaInternasHallazgos::distinct()->pluck('incumplimiento_requisito')->map(function ($item) {
                    return ($item);
                })->unique()->values()->toArray();
                $observacion = $this->clashallazgos->Where('clasificacion_hallazgo', 'Observación')->count();
                $noconformayor = $this->clashallazgos->Where('clasificacion_hallazgo', 'No Conformidad Mayor')->count();
                $oportunidadmejora = $this->clashallazgos->Where('clasificacion_hallazgo', 'Oportunidad de Mejora')->count();
                //tarjetas de no conformidad menor
                $nc1 = $this->clashallazgos->Where('clasificacion_hallazgo', 'No Conformidad Menor')->count();
                $nc2 = $this->clashallazgos->Where('clasificacion_hallazgo', 'NC Menor')->count();
                $nc3 = $this->clashallazgos->Where('clasificacion_hallazgo', 'NO CONFORMIDAD MENOR')->count();
                $noconformenor = $nc1 + $nc2 + $nc3;
                //GRAFICA DE BARRAS DE AUDITORIA
                $clausid = AuditoriaInternasHallazgos::select('clausula_id')->get();
                $contexto = $clausid->Where('clausula_id', '1')->count();
                $liderazgo = $clausid->Where('clausula_id', '2')->count();
                $planificacion = $clausid->Where('clausula_id', '3')->count();
                $soporte = $clausid->Where('clausula_id', '4')->count();
                $operacion = $clausid->Where('clausula_id', '5')->count();
                $evaluacion = $clausid->Where('clausula_id', '6')->count();
                $mejora = $clausid->Where('clausula_id', '7')->count();

                $totalclasificaciones = ClasificacionesAuditorias::select()->get();
                // dd($totalclasificaciones);
                // dd($totalclasificaciones);
                // dd($totalclasificaciones);
                foreach ($totalclasificaciones as $totalclasificacion) {
                    $total = AuditoriaInternasHallazgos::Where('clasificacion_id', $totalclasificacion->id)->count();
                    $totalclasificacion['total'] = $total;
                    // dump($totalclasificacion->id);
                }


                //CLASIFICACIONES DE AUDITORIAS

                // Obtener los nombres de las clasificaciones para los identificadores 1, 2, 3 y 4
                $nombreauditorias = AuditoriaInterna::select('nombre_auditoria')->get();
                $nombreaudits = AuditoriaInterna::distinct()->pluck('nombre_auditoria')->map(function ($item) {
                    return ($item);
                })->unique()->values()->toArray();
                // $tclasificaciones = ClasificacionesAuditorias::select('nombre_clasificaciones')->get();
                $clasificaciones = ClasificacionesAuditorias::distinct()->pluck('nombre_clasificaciones')->map(function ($item) {
                    return ($item);
                })->unique()->values()->toArray();

                // dd($nombreauditorias);
                // dd($nombreClasificacion1,$nombreClasificacion2,$nombreClasificacion3,$nombreClasificacion4);

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

                $audits = AuditoriaAnual::select("fechainicio", "fechafin", "nombre")->get();
                $eventos = Calendario::getAll();
                $oficiales = CalendarioOficial::get();
                $contratos = Contrato::select('nombre_servicio', 'fecha_inicio', 'fecha_fin')->get();

                $facturas = Factura::select('concepto', 'fecha_recepcion', 'fecha_liberacion')->get();

                $niveles_servicio = EntregaMensual::select('nombre_entregable', 'plazo_entrega_inicio', 'plazo_entrega_termina')->get();

                $cumples_aniversarios = Empleado::getaltaAll();
                $nombre_organizacion = Organizacion::getFirst();
                $nombre_organizacion = $nombre_organizacion ? $nombre_organizacion->empresa : 'la Organización';
                break;
            case 4:
                //VISTA DE MEJORAS Y ACCIONES
                // DASHBOARD MEJORAS Y ACCIONES

                // Mejoras
                $this->mejoras = Mejoras::select('estatus')->get();
                // $cerradoCount = $mejoras->where('estatus', 'cerrado')->count();
                // $encursoCount = $mejoras->where('estatus', 'en curso')->count();
                // $enesperaCount = $mejoras->Where('estatus', 'en espera')->count();
                // $sinatenderCount = $mejoras->Where('estatus', 'sin atender')->count();

                // ACCIONES CORRECTIVAS
                $accioncorrectiva = AccionCorrectiva::select('estatus')->get();
                $cerradoCountAC = $accioncorrectiva->where('estatus', 'Cerrado')->count();
                $encursoCountAC = $accioncorrectiva->where('estatus', 'En curso')->count();
                $enesperaCountAC = $accioncorrectiva->where('estatus', 'En espera')->count();
                $sinatenderCountAC = $accioncorrectiva->where('estatus', 'Sin atender')->count();

                break;
            default:

                break;
        }
    }
}
