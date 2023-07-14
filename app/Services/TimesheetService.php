<?php 

namespace App\Services;

use App\Repos\AreaRepo;
use App\Repos\EmpleadoRepo;
use App\Repos\TimesheetHorasRepo;
use App\Repos\TimesheetProyectoRepo;
use App\Repos\TimesheetsRepo;
use Carbon\Carbon;

class TimesheetService
{
    private $timesheetRepo;

    private $areaRepo;

    private $empleadoRepo;

    private $carbon;

    private $timesheetProyectoRepo;

    private $timesheetHorasRepo;

    public function __construct(TimesheetsRepo $timesheetRepo, AreaRepo $areaRepo, EmpleadoRepo $empleadoRepo, Carbon $carbon, TimesheetProyectoRepo $timesheetProyectoRepo, TimesheetHorasRepo $timesheetHorasRepo)
    {
        $this->timesheetRepo = $timesheetRepo;
        $this->areaRepo = $areaRepo;
        $this->empleadoRepo = $empleadoRepo;
        $this->carbon = $carbon;
        $this->timesheetProyectoRepo = $timesheetProyectoRepo;
        $this->timesheetHorasRepo = $timesheetHorasRepo;
    }

    /**
     * Retorna el total de los registros en timesheets seperados por tipos
     *
     * @return array
     */
    public function totalCounters(): array
    {
        $counters = $this->timesheetRepo->find(['estatus']);
        $papelera = 0;
        $pendiente = 0;
        $rechazado = 0;
        $aprobado = 0;
        foreach($counters as $counter){
            switch($counter->estatus){
                case 'aprobado':
                    $aprobado++;
                    break;
                case 'pendiente':
                    $pendiente++;
                    break;
                case 'papelera':
                    $papelera++;
                    break;
                case 'rechazado':
                    $rechazado++;
                    break;
            }
        }
        return [
            'borrador_contador' => $papelera, 
            'pendientes_contador' => $pendiente,
            'aprobados_contador' => $aprobado,
            'rechazos_contador' => $rechazado,
            'totales' => $papelera + $pendiente + $aprobado + $rechazado
        ];
    }


    public function totalRegisterByAreas(): array
    {
        $array = [];
        $areas = $this->areaRepo->find();
        $participacion_total = 0;
        $hoy = $this->carbon->now();
        $semanas_del_mes = intval(($hoy->format('d') * 4) / 29);
        $times_por_mes_esperados = $semanas_del_mes * $this->empleadoRepo->count();
        if ($times_por_mes_esperados == 0) {
            $times_por_mes_esperados = 1;
        }
        foreach($areas as $area){
            $times_complete_esperados_area = 0;
            $total_times_complit_area = 0;
            $contador_times_aprobados_areas = 0;
            $contador_times_pendientes_areas = 0;
            $contador_times_rechazados_areas = 0;
            $contador_times_papelera_areas = 0;
            $empleados_array = [];
            foreach($area->totalEmpleados as $empleado){
                $times_esperados_empleado = intval(date_diff($empleado->antiguedad, $this->carbon->now())->format('%R%a') / 7);
                $times_complete_esperados_area += $times_esperados_empleado;
                $papelera = 0;
                $pendiente = 0;
                $rechazado = 0;
                $aprobado = 0;
                $timesheets_empleado = $empleado->timesheet;
                if(!$timesheets_empleado->isEmpty()){
                    foreach($timesheets_empleado as $timesheet){
                        switch($timesheet->estatus){
                            case 'aprobado':
                                $aprobado++;
                                break;
                            case 'pendiente':
                                $pendiente++;
                                break;
                            case 'papelera':
                                $papelera++;
                                break;
                            case 'rechazado':
                                $rechazado++;
                                break;
                        }
                    }
                }
                $total_times_complit_area += $aprobado;
                $contador_times_aprobados_areas += $aprobado;
                $contador_times_pendientes_areas += $pendiente;
                $contador_times_rechazados_areas += $rechazado;
                $contador_times_papelera_areas += $papelera;
                $totales_empleado = $papelera + $pendiente + $rechazado + $aprobado;
                $empleados_array[] = [
                    'empleado' => $empleado->name,
                    'papelera' => $papelera,
                    'pendiente' => $pendiente,
                    'rechazado' => $rechazado,
                    'aprobado' => $aprobado,
                    'totales' => $totales_empleado,
                ];
            }

            if ($times_complete_esperados_area == 0) {
                $times_complete_esperados_area = 1;
            }
            $porcentaje_participacion_area = round((($total_times_complit_area * 100) / $times_complete_esperados_area), 2);
            if ($total_times_complit_area >= $times_complete_esperados_area) {
                $porcentaje_participacion_area = 100;
            }
            if ($porcentaje_participacion_area <= 44) {
                $nivel_participacion = 'baja';
            }
            if (($porcentaje_participacion_area > 45) && ($porcentaje_participacion_area < 89)) {
                $nivel_participacion = 'media';
            }
            if ($porcentaje_participacion_area >= 90) {
                $nivel_participacion = 'alta';
            }
            $array[] = [
                'area' => $area->area,
                'times_aprobados' => $contador_times_aprobados_areas,
                'times_pendientes' => $contador_times_pendientes_areas,
                'times_rechazados' => $contador_times_rechazados_areas,
                'times_papelera' => $contador_times_papelera_areas,
                'partisipacion' => $porcentaje_participacion_area,
                'nivel_p' => $nivel_participacion,
                'times_esperados' => $times_complete_esperados_area,
                'empleados' => $empleados_array
            ];
            $participacion_total += $contador_times_aprobados_areas;
        }
        
        $response = [];
        foreach($array as $item){
            $item['total_participacion_porcentaje'] = round((($item['times_aprobados'] * 100) / $participacion_total), 2);
            $response[] = $item;
        }
        return $response;
    }

    public function getRegistersByProyects(): array
    {
        // Obtenemos la lista de los proyectos
        $proyectos = $this->timesheetProyectoRepo->find();
        $proyectos_array = [];
        $cancelados = 0;
        $terminados = 0;
        $proceso = 0;
        $horas_totales = 0;
        $horas_totales_cancelados = 0;
        $horas_totales_terminados = 0;
        $horas_totales_proceso = 0;
        foreach($proyectos as $proyecto){
            switch($proyecto->estatus){
                case 'cancelado':
                    $cancelados++;
                    $totales = $this->calcularHorasProyecto($proyecto->tareas);
                    $horas_totales_cancelados += $totales;
                    $proyectos_array['cancelados'][] = [
                        'proyecto' => $proyecto->proyecto,
                        'tareas_count' => $proyecto->tareas->count(),
                        'estatus' => $proyecto->estatus,
                        'horas_totales' => round($totales)
                    ];
                    break;
                case 'terminado':
                    $terminados++;
                    $totales = $this->calcularHorasProyecto($proyecto->tareas);
                    $horas_totales_terminados += $totales;
                    $proyectos_array['terminados'][] = [
                        'proyecto' => $proyecto->proyecto,
                        'tareas_count' => $proyecto->tareas->count(),
                        'estatus' => $proyecto->estatus,
                        'horas_totales' => round($totales)
                    ];
                    break;
                case 'proceso':
                    $proceso++;
                    $totales = $this->calcularHorasProyecto($proyecto->tareas);
                    $horas_totales_proceso += $totales;
                    $proyectos_array['proceso'][] = [
                        'proyecto' => $proyecto->proyecto,
                        'tareas_count' => $proyecto->tareas->count(),
                        'estatus' => $proyecto->estatus,
                        'horas_totales' => round($totales)
                    ];
                    break;
            }
            $horas_totales += $totales;
        }
        return [
            'total_proyectos' => $proyectos->count(),
            'proyectos_terminados' => $terminados,
            'proyectos_en_proceso' => $proceso,
            'proyectos_cancelados' => $cancelados,
            'proyectos_lista' => $proyectos_array,
            'horas_terminados' => round($horas_totales_terminados),
            'horas_cancelados' => round($horas_totales_cancelados),
            'horas_proceso' => round($horas_totales_proceso),
            'horas_totales' => round($horas_totales)
        ];
    }

    private function calcularHorasProyecto($tareas): int
    {
        $total = 0;    
        foreach($tareas as $tarea){
            if(!$tarea->horas->isEmpty()){
                foreach($tarea->horas as $horas){
                    $total += $horas->horas_lunes;
                    $total += $horas->horas_martes;
                    $total += $horas->horas_miercoles;
                    $total += $horas->horas_jueves;
                    $total += $horas->horas_viernes;
                    $total += $horas->horas_sabado;
                    $total += $horas->horas_domingo;
                }
            }
        }
        return $total;
    }
}