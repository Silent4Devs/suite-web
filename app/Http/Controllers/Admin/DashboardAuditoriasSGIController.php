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
use App\Models\AuditoriaInternasHallazgos;
use App\Models\ClasificacionesAuditorias;
use GuzzleHttp\Psr7\Request;


class DashboardAuditoriasSGIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DASHBOARD AUDITORIAS
        //Tarjetas en general
        $clashallazgos = AuditoriaInternasHallazgos::select('clasificacion_hallazgo')->get();
        // dd($clashallazgos);
        $clashallazgosaudit = AuditoriaInternasHallazgos::distinct()->pluck('incumplimiento_requisito')->map(function ($item) {
            return ($item);
        })->unique()->values()->toArray();
        // dd($clashallazgosaudit);
        $clashallazgosnames = AuditoriaInternasHallazgos::distinct()->pluck('clasificacion_hallazgo')->map(function ($item) {
            $lowerCaseItem = strtolower($item);

            if ($lowerCaseItem === 'nc menor' || $lowerCaseItem === 'no conformidad menor') {
                return 'No Conformidad Menor';
            } elseif ($lowerCaseItem === 'nc mayor' || $lowerCaseItem === 'no conformidad mayor') {
                return 'No Conformidad Mayor';
            } else {
                return ucfirst($item); // Capitalizar la primera letra de otras categorías
            }
        })->unique()->values()->toArray();
        // dd($clashallazgosnames);
        $observacion = $clashallazgos->Where('clasificacion_hallazgo', 'Observación')->count();
        $noconformayor = $clashallazgos->Where('clasificacion_hallazgo', 'No Conformidad Mayor')->count();
        $oportunidadmejora = $clashallazgos->Where('clasificacion_hallazgo', 'Oportunidad de Mejora')->count();
        //tarjetas de no conformidad menor
        $nc1 = $clashallazgos->Where('clasificacion_hallazgo', 'No Conformidad Menor')->count();
        $nc2 = $clashallazgos->Where('clasificacion_hallazgo', 'NC Menor')->count();
        $nc3 = $clashallazgos->Where('clasificacion_hallazgo', 'NO CONFORMIDAD MENOR')->count();
        $noconformenor = $nc1+$nc2+$nc3;
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
        foreach($totalclasificaciones as $totalclasificacion){
            $total = AuditoriaInternasHallazgos::Where('clasificacion_id',$totalclasificacion->id)->count();
            $totalclasificacion['total'] = $total;
            // dump($totalclasificacion->id);
        }


        //CLASIFICACIONES DE AUDITORIAS


        // Obtener los nombres de las clasificaciones para los identificadores 1, 2, 3 y 4
        $clasid = ClasificacionesAuditorias::select('id')->get();
        // dd($clasid);
        $nombreClasificacion = ClasificacionesAuditorias::where('identificador')->value('nombre_clasificaciones');
        // dd($nombreClasificacion);
        $nombreClasificacion1 = ClasificacionesAuditorias::where('identificador', 1)->value('nombre_clasificaciones');
        $nombreClasificacion2 = ClasificacionesAuditorias::where('identificador', 2)->value('nombre_clasificaciones');
        $nombreClasificacion3 = ClasificacionesAuditorias::where('identificador', 3)->value('nombre_clasificaciones');
        $nombreClasificacion4 = ClasificacionesAuditorias::where('identificador', 4)->value('nombre_clasificaciones');


        $nombreauditorias = AuditoriaInterna::select('nombre_auditoria')->get();
        $nombreaudits = AuditoriaInterna::distinct()->pluck('nombre_auditoria')->map(function ($item) {
            return ($item);
        })->unique()->values()->toArray();
        $tclasificaciones = ClasificacionesAuditorias::select('nombre_clasificaciones')->get();
        $clasificaciones = ClasificacionesAuditorias::distinct()->pluck('nombre_clasificaciones')->map(function ($item) {
            return ($item);
        })->unique()->values()->toArray();

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

        $audits= AuditoriaAnual::select("fechainicio","fechafin","nombre")->get();
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
            'observacion',
            'noconformayor',
            'oportunidadmejora',
            'noconformenor',
            'empleado',
            'clausid',
            'contexto',
            'liderazgo',
            'planificacion',
            'soporte',
            'operacion',
            'evaluacion',
            'mejora',
            'clashallazgosnames',
            'clashallazgosaudit',
            'audits',
            'nombreClasificacion1',
            'nombreClasificacion2',
            'nombreClasificacion3',
            'nombreClasificacion4',
            'totalclasificaciones',
            'nombreauditorias',
            'nombreaudits',
            'clasificaciones'
        ));
    }
    public function obtenerClausulaId($incumplimiento)
    {
        // Utiliza el modelo para buscar el valor de clausula_id en función de incumplimiento_requisito
        $clausulaId = AuditoriaInternasHallazgos::where('incumplimiento_requisito', $incumplimiento)->value('clausula_id');

        // Devuelve el valor de clausula_id en formato JSON
        return response()->json(['clausula_id' => $clausulaId]);
    }

    // Otros métodos de tu controlador...
}
