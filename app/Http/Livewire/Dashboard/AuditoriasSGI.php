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
    public $usuario = null;
    public $implementaciones = null;
    public $implementacion = null;
    public $tasks = null;

    public function render()
    {
        //VISTA DEl DASHBOARD AUDITORIAS
        //Tarjetas en general
        $this->clashallazgos = AuditoriaInternasHallazgos::select('clasificacion_hallazgo')->get();
        $this->clashallazgosaudit = AuditoriaInternasHallazgos::distinct()->pluck('incumplimiento_requisito')->map(function ($item) {
            return ($item);
        })->unique()->values()->toArray();
        $this->observacion = $this->clashallazgos->Where('clasificacion_hallazgo', 'Observación')->count();
        $this->noconformayor = $this->clashallazgos->Where('clasificacion_hallazgo', 'No Conformidad Mayor')->count();
        $this->oportunidadmejora = $this->clashallazgos->Where('clasificacion_hallazgo', 'Oportunidad de Mejora')->count();
        //tarjetas de no conformidad menor
        $nc1 = $this->clashallazgos->Where('clasificacion_hallazgo', 'No Conformidad Menor')->count();
        $nc2 = $this->clashallazgos->Where('clasificacion_hallazgo', 'NC Menor')->count();
        $nc3 = $this->clashallazgos->Where('clasificacion_hallazgo', 'NO CONFORMIDAD MENOR')->count();
        $this->noconformenor = $nc1 + $nc2 + $nc3;
        //GRAFICA DE BARRAS DE AUDITORIA
        $this->clausid = AuditoriaInternasHallazgos::select('clausula_id')->get();
        $this->contexto = $this->clausid->Where('clausula_id', '1')->count();
        $this->liderazgo = $this->clausid->Where('clausula_id', '2')->count();
        $this->planificacion = $this->clausid->Where('clausula_id', '3')->count();
        $this->soporte = $this->clausid->Where('clausula_id', '4')->count();
        $this->operacion = $this->clausid->Where('clausula_id', '5')->count();
        $this->evaluacion = $this->clausid->Where('clausula_id', '6')->count();
        $this->mejora = $this->clausid->Where('clausula_id', '7')->count();

        $this->totalclasificaciones = ClasificacionesAuditorias::select()->get();
        // dd($totalclasificaciones);
        // dd($totalclasificaciones);
        // dd($totalclasificaciones);
        foreach ($this->totalclasificaciones as $totalclasificacion) {
            $total = AuditoriaInternasHallazgos::Where('clasificacion_id', $totalclasificacion->id)->count();
            $totalclasificacion['total'] = $total;
            // dump($totalclasificacion->id);
        }


        //CLASIFICACIONES DE AUDITORIAS

        // Obtener los nombres de las clasificaciones para los identificadores 1, 2, 3 y 4
        $this->nombreauditorias = AuditoriaInterna::select('nombre_auditoria')->get();
        $this->nombreaudits = AuditoriaInterna::distinct()->pluck('nombre_auditoria')->map(function ($item) {
            return ($item);
        })->unique()->values()->toArray();
        // $tclasificaciones = ClasificacionesAuditorias::select('nombre_clasificaciones')->get();
        $this->clasificaciones = ClasificacionesAuditorias::distinct()->pluck('nombre_clasificaciones')->map(function ($item) {
            return ($item);
        })->unique()->values()->toArray();

        // dd($nombreauditorias);
        // dd($nombreClasificacion1,$nombreClasificacion2,$nombreClasificacion3,$nombreClasificacion4);

        // CALENDARIO
        $this->empleado = auth()->user()->empleado;
        $this->usuario = auth()->user();

        $this->implementaciones = PlanImplementacion::getAll();
        $this->actividades = collect();

        if ($this->implementaciones) {
            foreach ($this->implementaciones as $implementacion) {
                $this->tasks = $implementacion->tasks;
                foreach ($this->tasks as $task) {
                    $task->parent_id = $implementacion->id;
                    $task->status = isset($task->status) ? $task->status : 'STATUS_UNDEFINED';
                    $task->end = intval($task->end);
                    $task->start = intval($task->start);
                    $task->canAdd = $task->canAdd == 'true' ? true : false;
                    $task->canWrite = $task->canWrite == 'true' ? true : false;
                    $task->duration = intval($task->duration);
                    $task->progress = intval($task->progress);
                    $task->canDelete = $task->canDelete == 'true' ? true : false;
                    isset($this->task->level) ? $task->level = intval($task->level) : $task->level = 0;
                    isset($this->task->collapsed) ? $task->collapsed = $task->collapsed == 'true' ? true : false : $task->collapsed = false;
                    $task->canAddIssue = $task->canAddIssue == 'true' ? true : false;
                    $task->endIsMilestone = $task->endIsMilestone == 'true' ? true : false;
                    $task->startIsMilestone = $task->startIsMilestone == 'true' ? true : false;
                    $task->progressByWorklog = $task->progressByWorklog == 'true' ? true : false;
                    $this->actividades->push($task);
                }

                $implementacion->tasks = $this->tasks;
                // if (!isset($implementacion->assigs)) {
                //     $implementacion = (object)array_merge((array)$implementacion, array('assigs' => []));
                // }
            }
        }
        // $actividades = $actividades->flatten(1);

        $this->plan_base = PlanBaseActividade::get();
        $this->auditorias_anual = AuditoriaAnual::getAll();
        $this->auditoria_internas = AuditoriaInterna::get();
        // dd($auditoria_internas);

        $this->recursos = collect();
        if ($this->empleado) {
            $this->recursos = Recurso::whereHas('empleados', function ($query) {
                $query->where('empleados.id', $this->empleado->id);
            })->get();
        }

        $this->audits = AuditoriaAnual::select("fechainicio", "fechafin", "nombre")->get();
        $this->eventos = Calendario::getAll();
        $this->oficiales = CalendarioOficial::get();
        $this->contratos = Contrato::select('nombre_servicio', 'fecha_inicio', 'fecha_fin')->get();

        $this->facturas = Factura::select('concepto', 'fecha_recepcion', 'fecha_liberacion')->get();

        $this->niveles_servicio = EntregaMensual::select('nombre_entregable', 'plazo_entrega_inicio', 'plazo_entrega_termina')->get();

        $this->cumples_aniversarios = Empleado::getaltaAll();
        $this->nombre_organizacion = Organizacion::getFirst();
        $this->nombre_organizacion = $this->nombre_organizacion ? $this->nombre_organizacion->empresa : 'la Organización';

        //VISTA DE MEJORAS Y ACCIONES
        // DASHBOARD MEJORAS Y ACCIONES

        // Mejoras
        $this->mejoras = Mejoras::select('estatus')->get();
        // $cerradoCount = $mejoras->where('estatus', 'cerrado')->count();
        // $encursoCount = $mejoras->where('estatus', 'en curso')->count();
        // $enesperaCount = $mejoras->Where('estatus', 'en espera')->count();
        // $sinatenderCount = $mejoras->Where('estatus', 'sin atender')->count();

        // ACCIONES CORRECTIVAS
        $this->accioncorrectiva = AccionCorrectiva::select('estatus')->get();
        $this->cerradoCountAC = $this->accioncorrectiva->where('estatus', 'Cerrado')->count();
        $this->encursoCountAC = $this->accioncorrectiva->where('estatus', 'En curso')->count();
        $this->enesperaCountAC = $this->accioncorrectiva->where('estatus', 'En espera')->count();
        $this->sinatenderCountAC = $this->accioncorrectiva->where('estatus', 'Sin atender')->count();


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
                $this->tabOption = 1;
                $this->dispatchBrowserEvent('cambioPestaña1');
                break;
            case 2:
                $this->tabOption = 2;
                $this->dispatchBrowserEvent('cambioPestaña2');
                break;
            case 3:
                $this->tabOption = 3;
                $this->dispatchBrowserEvent('cambioPestaña3');
                break;
            case 4:
                $this->tabOption = 4;
                $this->dispatchBrowserEvent('cambioPestaña4');
                break;
            default:
                $this->tabOption = 0;
                $this->dispatchBrowserEvent('cambioPestaña1');
                break;
        }
    }
}
