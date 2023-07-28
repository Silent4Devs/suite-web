<?php

namespace App\Services;

use App\Repos\AreaRepo;
use App\Repos\EmpleadoRepo;
use App\Repos\TimesheetHorasRepo;
use App\Repos\TimesheetProyectoRepo;
use App\Repos\TimesheetsRepo;
use App\Repos\TimesheetTareaRepo;
use Carbon\Carbon;

class DashboardService
{
    private $timesheetRepo;

    private $carbon;

    private $empleadoRepo;

    private $areaRepo;

    private $timesheetProyectoRepo;

    private $timesheetTareaRepo;

    private $timesheetHorasRepo;

    public function __construct(
        TimesheetsRepo $timesheetRepo,
        Carbon $carbon,
        EmpleadoRepo $empleadoRepo,
        AreaRepo $areaRepo,
        TimesheetProyectoRepo $timesheetProyectoRepo,
        TimesheetTareaRepo $timesheetTareaRepo,
        TimesheetHorasRepo $timesheetHorasRepo
    ) {
        $this->timesheetRepo = $timesheetRepo;
        $this->carbon = $carbon;
        $this->empleadoRepo = $empleadoRepo;
        $this->areaRepo = $areaRepo;
        $this->timesheetProyectoRepo = $timesheetProyectoRepo;
        $this->timesheetTareaRepo = $timesheetTareaRepo;
        $this->timesheetHorasRepo = $timesheetHorasRepo;
    }

    public function timesheetsDashboard()
    {
        $borrador_contador = $this->timesheetRepo->count(['estatus', 'papelera']);
        $pendientes_contador = $this->timesheetRepo->count(['estatus', 'pendiente']);
        $aprobados_contador = $this->timesheetRepo->count(['estatus', 'aprobado']);
        $rechazos_contador = $this->timesheetRepo->count(['estatus', 'rechazado']);

        $hoy = $this->carbon->now();
        $semanas_del_mes = intval(($hoy->format('d') * 4) / 29);
        $empleados_partisipacion = $this->empleadoRepo->find();

        $areas = $this->areaRepo->find();
        $areas_array = collect();

        // Primero iteramos el total de las areas
        foreach ($areas as $area) {
            $times_complit_esperados_area = 0;
            $empleados_area = $this->empleadoRepo->find(['*'], ['area', $area->id]);

            // Obtenemos la antiguedad de los empleados
            foreach ($empleados_area as $empleado) {
                $fecha_inicio = date_create($empleado->antiguedad->format('d-m-Y'));
                $fecha_fin = date_create($hoy->format('d-m-Y'));
                $times_esperados_empleado = intval(date_diff($fecha_inicio, $fecha_fin)->format('%R%a') / 7);

                $times_complit_esperados_area += $times_esperados_empleado;
            }

            if ($times_complit_esperados_area == 0) {
                $times_complit_esperados_area = 1;
            }

            // Obtenemos el nivel de participacion de los empleados por area
            $total_times_complit_area = 0;
            $empleados_times_atrasados = 0;
            foreach ($empleados_partisipacion as $emp_part_area) {
                if ($emp_part_area->area_id == $area->id) {
                    $times_empleado_part_area = $this->timesheetRepo->count([
                        'empleado' => $emp_part_area->id,
                        'notEqualsEstatus' => 'rechazado',
                        'notEqualsEstatus' => 'papelera',
                        'notEqualsEstatus' => 'pendiente',
                    ]);
                } else {
                    $times_empleado_part_area = 0;
                }
                $total_times_complit_area += $times_empleado_part_area;
            }

            // Obtenemos el porcentaje de participacion por área
            $porcentaje_participacion_area = round((($total_times_complit_area * 100) / $times_complit_esperados_area), 2);
            if ($total_times_complit_area >= $times_complit_esperados_area) {
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

            $contador_times_aprobados_areas = 0;
            $contador_times_pendientes_areas = 0;
            $contador_times_rechazados_areas = 0;
            $contador_times_papelera_areas = 0;
            foreach ($area->empleados as $key => $empleado_t) {
                $contador_times_aprobados_areas += $this->timesheetRepo->count(['empleado' => $empleado_t->id, 'estatus' => 'aprobado']);
                $contador_times_pendientes_areas += $this->timesheetRepo->count(['empleado' => $empleado_t->id, 'estatus' => 'pendiente']);
                $contador_times_rechazados_areas += $this->timesheetRepo->count(['empleado' => $empleado_t->id, 'estatus' => 'rechazado']);
                $contador_times_papelera_areas += $this->timesheetRepo->count(['empleado' => $empleado_t->id, 'estatus' => 'papelera']);
            }

            $areas_array->push([
                'area' => $area->area,
                'times_aprobados' => $contador_times_aprobados_areas,
                'times_pendientes' => $contador_times_pendientes_areas,
                'times_rechazados' => $contador_times_rechazados_areas,
                'times_papelera' => $contador_times_papelera_areas,
                'partisipacion' => $porcentaje_participacion_area,
                'nivel_p' => $nivel_participacion,
                'times_esperados' => $times_complit_esperados_area,
            ]);
        }

        $empleados_count = $this->empleadoRepo->count([]);
        $times_por_mes_esperados = $semanas_del_mes * $empleados_count;
        if ($times_por_mes_esperados == 0) {
            $times_por_mes_esperados = 1;
        }

        $total_times_mes = 0;
        $empleados_times_atrasados = 0;
        foreach ($empleados_partisipacion as $emp_part) {
            $times_empleado_part = $this->timesheetRepo->count([
                'fecha' => $hoy,
                'empleado' => $emp_part->id,
                'notEqualsEstatus' => 'rechazado',
                'notEqualsEstatus' => 'papelera',
            ]);
            $total_times_mes += $times_empleado_part;

            if ($times_empleado_part < ($semanas_del_mes)) {
                $empleados_times_atrasados++;
            }
        }

        $porcentaje_participacion = round((($total_times_mes * 100) / $times_por_mes_esperados), 2);
        if ($total_times_mes >= $times_por_mes_esperados) {
            $porcentaje_participacion = 100;
        }

        $proyectos_proceso_c = $this->timesheetProyectoRepo->count(['estatus' => 'proceso']);
        $proyectos_cancelados_c = $this->timesheetProyectoRepo->count(['estatus' => 'cancelado']);
        $proyectos_terminados_c = $this->timesheetProyectoRepo->count(['estatus' => 'terminado']);

        $proyectos_proceso = $this->timesheetProyectoRepo->find();
        $proyectos_array = collect();
        foreach ($proyectos_proceso as $proyect) {
            $horas_totales_proyecto = 0;
            $tareas_proyecto = $this->timesheetTareaRepo->find(['*'], ['proyecto' => $proyect->id]);
            foreach ($tareas_proyecto as $tarea_p) {
                $horas_proyecto = $this->timesheetHorasRepo->find(['*'], ['tarea' => $tarea_p->id]);
                foreach ($horas_proyecto as $horas_p) {
                    $horas_totales_proyecto += $horas_p->horas_lunes;
                    $horas_totales_proyecto += $horas_p->horas_martes;
                    $horas_totales_proyecto += $horas_p->horas_miercoles;
                    $horas_totales_proyecto += $horas_p->horas_jueves;
                    $horas_totales_proyecto += $horas_p->horas_viernes;
                    $horas_totales_proyecto += $horas_p->horas_sabado;
                    $horas_totales_proyecto += $horas_p->horas_domingo;
                }
            }
            $proyectos_array->push([
                'proyecto' => $proyect->proyecto,
                'horas' => $horas_totales_proyecto,
                'tareas' => $tareas_proyecto,
                'tareas_count' => $tareas_proyecto->count(),
                'estatus' => $proyect->estatus,
            ]);
        }

        $proyectos_proceso_array = 0;
        $proyectos_cancelado_array = 0;
        $proyectos_terminado_array = 0;
        foreach ($proyectos_array as $proyect_array) {
            if ($proyect_array['estatus'] == 'proceso') {
                $proyectos_proceso_array += $proyect_array['horas'];
            }
            if ($proyect_array['estatus'] == 'cancelado') {
                $proyectos_cancelado_array += $proyect_array['horas'];
            }
            if ($proyect_array['estatus'] == 'terminado') {
                $proyectos_terminado_array += $proyect_array['horas'];
            }
        }

        return [
            'borrador_contador' => $borrador_contador,
            'pendientes_contador' => $pendientes_contador,
            'aprobados_contador' => $aprobados_contador,
            'rechazos_contador' => $rechazos_contador,
            'areas_array' => $areas_array,
            'porcentaje_participacion' => $porcentaje_participacion,
            'empleados_times_atrasados' => $empleados_times_atrasados,
            'empleados_count' => $empleados_count,
            'areas' => $areas,
            'proyectos_proceso_c' => $proyectos_proceso_c,
            'proyectos_cancelados_c' => $proyectos_cancelados_c,
            'proyectos_terminados_c' => $proyectos_terminados_c,
            'proyectos_array' => $proyectos_array,
            'proyectos_proceso_array' => $proyectos_proceso_array,
            'proyectos_cancelado_array' => $proyectos_cancelado_array,
            'proyectos_terminado_array' => $proyectos_terminado_array,
        ];
    }
}
