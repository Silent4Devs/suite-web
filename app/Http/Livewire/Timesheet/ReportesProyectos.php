<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use App\Models\Organizacion;
use App\Traits\getWeeksFromRange;
use Carbon\Carbon;
use Livewire\Component;

class ReportesProyectos extends Component
{
    use getWeeksFromRange;

    public $areas;
    public $proyectos;

    public $proyecto_reporte;
    public $area_proyecto;
    public $cliente_proyecto;
    public $tareas_array;
    public $empleados_proyecto;
    public $total_horas_proyecto;
    public $hoy_format;
    public $proyectos_array;

    public $semanas_totales_calendario = 0;

    public $calendario_tabla;

    public function render()
    {
        $hoy = Carbon::now();

        $this->emit('resize');

        $this->emit('scriptTabla');

        $this->areas = Area::get();

        //calendario tabla
        $calendario_array = [];
        $fecha_inicio_complit_timesheet = Organizacion::select('fecha_registro_timesheet')->first()->fecha_registro_timesheet;
        $fecha_inicio_complit_timesheet = Carbon::parse($fecha_inicio_complit_timesheet);
        $semanas_complit_timesheet = $this->getWeeksFromRange($fecha_inicio_complit_timesheet->format('Y'), $fecha_inicio_complit_timesheet->format('m'), $fecha_inicio_complit_timesheet->format('d'), []);
        $total_months = 0;
        foreach ($semanas_complit_timesheet as $semana) {
            $semana_array = explode('|', $semana);
            foreach ($semana_array as $semana_a) {
                $fecha = Carbon::parse($semana_a);
                $previous_month = $fecha->format('m');
                $previous_month = intval($previous_month) - 1;
                $previous_month = $previous_month == 0 ? 1 : $previous_month;
                $previous_month = Carbon::create()->day(1)->month(intval($previous_month))->format('F');
                $year = $fecha->format('Y');
                $month = $fecha->format('F');
                if (!($this->buscarKeyEnArray($year, $calendario_array))) {

                    $calendario_array["{$year}"] = [
                        'year'=>$year,
                        'total_weeks'=>0,
                        'total_months'=>0,
                        'months'=>[
                            "{$month}"=>[
                                'weeks'=>[]
                            ]
                        ]
                    ];

                    if ($month == 'January') {
                        $previous_year = $year - 1;
                        if (array_key_exists($previous_year, $calendario_array)) {
                            if (!($this->existsWeeksInMonth($semana, $calendario_array["{$previous_year}"]['months']['December']['weeks']))) {
                                $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                            }
                        }
                    }

                }else{
                    if (array_key_exists($month, $calendario_array["{$year}"]['months'])) {
                        if (!in_array($semana, $calendario_array["{$year}"]['months']["{$month}"]['weeks'])) {
                            $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                        }                            
                    }else{
                        if (array_key_exists($previous_month, $calendario_array["{$year}"]['months'])) {
                            
                            if (!($this->existsWeeksInMonth($semana, $calendario_array["{$year}"]['months']["{$previous_month}"]['weeks']))) {
                                $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                            }
                            
                        }else{
                            $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                        }
                    }
                }
            }
        }

        foreach ($calendario_array as $key => &$c_year) {
            $total_months = count($c_year['months']);
            $total_weeks_year = 0;
            $c_year['total_months'] = $total_months;

            foreach ($c_year['months'] as $key => &$c_mes) {
                $total_weeks = count($c_mes['weeks']);
                $total_weeks_year += $total_weeks;
                $c_mes['total_weeks'] = $total_weeks;
            }
            $c_year['total_weeks'] = $total_weeks_year;  
            $this->semanas_totales_calendario += $total_weeks_year;
        }

        $this->proyectos_array = collect();
        $this->proyectos = TimesheetProyecto::get();
        foreach ($this->proyectos as $proyecto) {

            // registros existenetes horas a la semana
            $registro_horas_proyecto = TimesheetHoras::where('proyecto_id', $proyecto->id)->get(); 
            $times_registro_horas_array = collect();
            foreach ($registro_horas_proyecto as $key => $registro_horas) {
                // $time_registro_horas = '';
            }

            // registro de horas en calendario
            $calendario_tabla_proyectos = [];
            foreach ($calendario_array as $key => $año) {
                foreach ($año['months'] as $key => $mes) {
                    foreach ($mes['weeks'] as $key => $semana) {

                        array_push($calendario_tabla_proyectos, '<span class="p-1" style="background-color:#FFF2CC;">Sin&nbsp;Registro</span>');
                    }
                }
            }

            $this->proyectos_array->push([
                'id'=>$proyecto->id,
                'proyecto'=>$proyecto->proyecto,
                'area'=>$proyecto->area ? $proyecto->area->area : '',
                'cliente'=>$proyecto->cliente ? $proyecto->cliente->nombre : '',
                'calendario'=>$calendario_tabla_proyectos,
            ]);
        }
        // dd($calendario_array);
        $this->calendario_tabla = $calendario_array;

        $this->hoy_format = $hoy->format('d/m/Y');

        return view('livewire.timesheet.reportes-proyectos');
    }

    public function genrarReporte($id)
    {
        $this->proyecto_reporte = TimesheetProyecto::find($id);

        $this->area_proyecto = Area::find($this->proyecto_reporte->area_id);
        $this->cliente_proyecto = TimesheetCliente::find($this->proyecto_reporte->cliente_id);

        $empleados = collect();

        $tareas = TimesheetTarea::where('proyecto_id', $id)->get();

        $this->tareas_array = collect();

        $empleados = collect();

        $this->empleados_proyecto = collect();

        $h_total_tarea = 0;

        $this->total_horas_proyecto = 0;
        foreach ($tareas as $tarea) {
            $horas = TimesheetHoras::where('tarea_id', $tarea->id)->get();
            $empleados = collect();
            $h_total_tarea = 0;
            $h_total_tarea_total = 0;
            foreach ($horas as $hora) {
                $h_total_tarea = 0;

                $h_total_tarea += $hora->horas_lunes;
                $h_total_tarea += $hora->horas_martes;
                $h_total_tarea += $hora->horas_miercoles;
                $h_total_tarea += $hora->horas_jueves;
                $h_total_tarea += $hora->horas_viernes;
                $h_total_tarea += $hora->horas_sabado;
                $h_total_tarea += $hora->horas_domingo;

                $h_total_tarea_total += $h_total_tarea;

                $empleado = Empleado::find($hora->timesheet->empleado_id);
                $times_horas_empleado = $hora->timesheet;

                // foreach ($times_horas_empleado as $time_horas_empleado) {

                // }

                if (!$empleados->contains('id', $empleado->id)) {
                    $empleados->push([
                        'id'=> $empleado->id,
                        'name'=> $empleado->name,
                        'salario_diario'=> $empleado->salario_diario,
                        'foto'=> $empleado->avatar_ruta,
                        'area'=> $empleado->area,
                        'puesto'=> $empleado->puesto,
                        'horas'=> $h_total_tarea,
                    ]);
                } else {
                    $empleados = $empleados->map(function ($emp_item) use ($h_total_tarea, $empleado) {
                        if ($emp_item['id'] == $empleado->id) {
                            $emp_item['horas'] += $h_total_tarea;
                        }

                        return $emp_item;
                    });
                }
            }

            $this->total_horas_proyecto += $h_total_tarea_total;

            $this->tareas_array->push([
                'tarea'=>$tarea->tarea,
                'horas_totales' => $h_total_tarea_total,
                'empleados' => $empleados,
            ]);
        }
        $this->empleados_proyecto = $empleados->unique();
    }

    public function buscarEnArray($search, $array)
    {
        foreach ($array as $value) {
            if ($value == $search) {
                return true;
            }
        }

        return false;
    }

    public function buscarKeyEnArray($search, $array)
    {
        foreach ($array as $key=>$value) {
            if ($key == $search) {
                return true;
            }
        }

        return false;   
    }

    public function existsWeeksInMonth($search, $array)
    {
        if (in_array($search, $array)) {
            return true;
        }

        return false;
    }
}
