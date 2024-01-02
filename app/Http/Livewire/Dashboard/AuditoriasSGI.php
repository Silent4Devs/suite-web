<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\AccionCorrectiva;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\Calendario;
use App\Models\CalendarioOficial;
use App\Models\ClasificacionesAuditorias;
use App\Models\ClausulasAuditorias;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\EntregaMensual;
use App\Models\ContractManager\Factura;
use App\Models\Empleado;
use App\Models\Mejoras;
use App\Models\Organizacion;
use App\Models\PlanBaseActividade;
use App\Models\PlanImplementacion;
use App\Models\Recurso;
use Livewire\Component;

class AuditoriasSGI extends Component
{
    public $tabOption = 0;

    public function render()
    {
        switch ($this->tabOption) {
            case 1:
                // Tu lógica para la opción 1
                break;
            case 2:
                // Tu lógica para la opción 2
                break;
            case 3:
                // Tu lógica para la opción 3
                break;
            case 4:
                // Tu lógica para la opción 4
                break;
            default:
                // Lógica por defecto si $this->tabOption no coincide con ningún caso
                break;
        }
        //DASHBOARD AUDITORIAS
        //Tarjetas en general
        $hallazgos = AuditoriaInternasHallazgos::where('clasificacion_id', '!=', null)->where('clausula_id', '!=', null)->with('clasificacion', 'clausula')->get();
        $clasificaciones = ClasificacionesAuditorias::get();
        $clausulas = ClausulasAuditorias::get();
        // dd($hallazgos, $clasificaciones, $clausulas);

        $clasificaciones_array = [];

        foreach ($clasificaciones as $clasif) {
            $clasificaciones_array[$clasif->nombre_clasificaciones] = 0;
        }
        $clausulas_array = [];
        foreach ($clausulas as $claus) {
            $clausulas_array[$claus->nombre_clausulas] = 0;
        }

        foreach ($hallazgos as $hallazgo) {
            $clasificacionNombre = $hallazgo->clasificacion->nombre_clasificaciones;
            $clausulaNombre = $hallazgo->clausula->nombre_clausulas;
            // dd($clasificacionNombre, $clausulaNombre);
            // Increment the respective counter for clasificacion and clausula
            if (isset($clasificaciones_array[$clasificacionNombre])) {
                $clasificaciones_array[$clasificacionNombre]++;
            }

            if (isset($clausulas_array[$clausulaNombre])) {
                $clausulas_array[$clausulaNombre]++;
            }
        }

        // Extract counts for clasificaciones and clausulas into their respective arrays
        $clasificacionesData = [];
        foreach ($clasificaciones_array as $clasifName => $count) {
            $clasificacionesData['x'][] = $clasifName;
            $clasificacionesData['y'][] = $count;
        }

        $clausulasData = [];
        foreach ($clausulas_array as $clausulaName => $count) {
            $clausulasData['x'][] = $clausulaName;
            $clausulasData['y'][] = $count;
        }

        $clasificacionesDataJson = json_encode($clasificacionesData);
        $clausulasDataJson = json_encode($clausulasData);

        // $clashallazgosaudit = AuditoriaInternasHallazgos::distinct()->pluck('incumplimiento_requisito')->map(function ($item) {
        //     return $item;
        // })->unique()->values()->toArray();

        // dd($clasificaciones_array, $clausulas_array);

        // dd($clashallazgosaudit);
        // $clashallazgosnames = AuditoriaInternasHallazgos::distinct()->pluck('clasificacion_hallazgo')->map(function ($item) {
        //     $lowerCaseItem = strtolower($item);

        //     if ($lowerCaseItem === 'nc menor' || $lowerCaseItem === 'no conformidad menor') {
        //         return 'No Conformidad Menor';
        //     } elseif ($lowerCaseItem === 'nc mayor' || $lowerCaseItem === 'no conformidad mayor') {
        //         return 'No Conformidad Mayor';
        //     } else {
        //         return ucfirst($item); // Capitalizar la primera letra de otras categorías
        //     }
        // })->unique()->values()->toArray();
        // dd($clashallazgosnames);
        //tarjetas de no conformidad menor

        // $noconformenor = $clashallazgos->Where('clasificacion_hallazgo', 'No Conformidad Menor')->count() +
        //     $clashallazgos->Where('clasificacion_hallazgo', 'NC Menor')->count() +
        //     $clashallazgos->Where('clasificacion_hallazgo', 'NO CONFORMIDAD MENOR')->count();
        //GRAFICA DE BARRAS DE AUDITORIA

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
            return $item;
        })->unique()->values()->toArray();
        // $tclasificaciones = ClasificacionesAuditorias::select('nombre_clasificaciones')->get();
        // $clasificaciones = ClasificacionesAuditorias::distinct()->pluck('nombre_clasificaciones')->map(function ($item) {
        //     return $item;
        // })->unique()->values()->toArray();

        // dd($nombreauditorias);
        // dd($nombreClasificacion1,$nombreClasificacion2,$nombreClasificacion3,$nombreClasificacion4);
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

        $audits = AuditoriaAnual::select('fechainicio', 'fechafin', 'nombre')->get();
        $eventos = Calendario::getAll();
        $oficiales = CalendarioOficial::get();
        $contratos = Contrato::select('nombre_servicio', 'fecha_inicio', 'fecha_fin')->get();

        $facturas = Factura::select('concepto', 'fecha_recepcion', 'fecha_liberacion')->get();

        $niveles_servicio = EntregaMensual::select('nombre_entregable', 'plazo_entrega_inicio', 'plazo_entrega_termina')->get();

        $cumples_aniversarios = Empleado::getaltaAll();
        $nombre_organizacion = Organizacion::getFirst();
        $nombre_organizacion = $nombre_organizacion ? $nombre_organizacion->empresa : 'la Organización';

        return view('livewire.dashboard.auditorias-s-g-i', [
            'plan_base' => $plan_base,
            'auditorias_anual' => $auditorias_anual,
            'recursos' => $recursos,
            'actividades' => $actividades,
            'auditoria_internas' => $auditoria_internas,
            'eventos' => $eventos,
            'oficiales' => $oficiales,
            'cumples_aniversarios' => $cumples_aniversarios,
            'nombre_organizacion' => $nombre_organizacion,
            'contratos' => $contratos,
            'facturas' => $facturas,
            'niveles_servicio' => $niveles_servicio,
            'mejoras' => $mejoras,
            'cerradoCount' => $cerradoCount,
            'encursoCount' => $encursoCount,
            'enesperaCount' => $enesperaCount,
            'sinatenderCount' => $sinatenderCount,
            'accioncorrectiva' => $accioncorrectiva,
            'cerradoCountAC' => $cerradoCountAC,
            'encursoCountAC' => $encursoCountAC,
            'enesperaCountAC' => $enesperaCountAC,
            'sinatenderCountAC' => $sinatenderCountAC,
            // 'observacion' => $observacion,
            // 'noconformayor' => $noconformayor,
            // 'oportunidadmejora' => $oportunidadmejora,
            // 'noconformenor' => $noconformenor,
            'empleado' => $empleado,
            // 'clausid' => $clausid,
            // 'contexto' => $contexto,
            // 'liderazgo' => $liderazgo,
            // 'planificacion' => $planificacion,
            // 'soporte' => $soporte,
            // 'operacion' => $operacion,
            // 'evaluacion' => $evaluacion,
            // 'mejora' => $mejora,
            // 'clashallazgosaudit' => $clashallazgosaudit,
            'audits' => $audits,
            'totalclasificaciones' => $totalclasificaciones,
            'nombreauditorias' => $nombreauditorias,
            'nombreaudits' => $nombreaudits,
            'clasificaciones' => $clasificaciones,
            'clasificacion_array' => $clasificaciones_array,
            'clausulas_array' => $clausulas_array,
            'clasificacionesDataJson' => $clasificacionesDataJson,
            'clausulasDataJson' => $clausulasDataJson,
        ]);
    }
}
