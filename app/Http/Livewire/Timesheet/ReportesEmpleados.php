<?php

namespace App\Http\Livewire\Timesheet;

use App\Mail\TimesheetCorreoRetraso;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Traits\getWeeksFromRange;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ReportesEmpleados extends Component
{
    use getWeeksFromRange;
    use LivewireAlert;

    public $lista_empleados;
    public $empleado_seleccionado_id;
    public $hoy_format;

    public $empleado;
    public $timesheet;

    public $areas;

    public $todos_contador;
    public $borrador_contador;
    public $pendientes_contador;
    public $aprobados_contador;
    public $rechazos_contador;
    public $times_empleado;
    public $proyectos;
    public $proyectos_detalle;
    public $horas_totales = 0;
    public $times_empleado_horas;

    public $horas_totales_filtros_empleados;

    public $calendario_tabla;

    public $semanas_totales_calendario = 0;

    public $area_id = 0;
    public $fecha_inicio;
    public $fecha_fin;

    public function mount()
    {
        $this->areas = Area::get();
    }

    public function updatedAreaId($value)
    {
        $this->area_id = $value;
        $this->empleado = null;
    }

    public function updatedFechaInicio($value)
    {
        $this->fecha_inicio = $value;
        $this->empleado = null;
    }

    public function updatedFechaFin($value)
    {
        $this->fecha_fin = $value;
        $this->empleado = null;
    }

    public function render()
    {
        $hoy = Carbon::now();
        $semanas_del_mes = intval(($hoy->format('d') * 4) / 29);
        $this->empleados = collect();
        if ($this->area_id) {
            $empleados_list = Empleado::where('area_id', $this->area_id)->get();
        } else {
            $empleados_list = Empleado::get();
        }

        //calendario tabla
        $calendario_array = [];
        $fecha_inicio_complit_timesheet = $this->fecha_inicio ? $this->fecha_inicio : Organizacion::select('fecha_registro_timesheet')->first()->fecha_registro_timesheet;
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
                                'weeks'=>[],
                            ],
                        ],
                    ];

                    if ($month == 'January') {
                        $previous_year = $year - 1;
                        if (array_key_exists($previous_year, $calendario_array)) {
                            if (!($this->existsWeeksInMonth($semana, $calendario_array["{$previous_year}"]['months']['December']['weeks']))) {
                                $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                            }
                        }
                    }
                } else {
                    if (array_key_exists($month, $calendario_array["{$year}"]['months'])) {
                        if (!in_array($semana, $calendario_array["{$year}"]['months']["{$month}"]['weeks'])) {
                            $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                        }
                    } else {
                        if (array_key_exists($previous_month, $calendario_array["{$year}"]['months'])) {
                            if (!($this->existsWeeksInMonth($semana, $calendario_array["{$year}"]['months']["{$previous_month}"]['weeks']))) {
                                $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                            }
                        } else {
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

        $this->horas_totales_filtros_empleados = 0;
        foreach ($empleados_list as $empleado_list) {
            $horas_total_time = 0;

            $fecha_registro_timesheet = Organizacion::select('fecha_registro_timesheet')->first()->fecha_registro_timesheet;

            if ($this->fecha_inicio) {
                $fecha_inicio_timesheet_empleado = Carbon::parse($empleado_list->antiguedad)->lt($this->fecha_inicio) ? $this->fecha_inicio : $empleado_list->antiguedad;
            } else {
                $fecha_inicio_timesheet_empleado = Carbon::parse($empleado_list->antiguedad)->lt($fecha_registro_timesheet) ? $fecha_registro_timesheet : $empleado_list->antiguedad;
            }

            if (($this->fecha_fin) && (Carbon::parse($this->fecha_fin)->lt($hoy))) {
                $fecha_fin_timesheet_empleado = $empleado_list->estatus == 'baja' ? $empleado_list->fecha_baja : $this->fecha_fin;
            } else {
                $fecha_fin_timesheet_empleado = $empleado_list->estatus == 'baja' ? $empleado_list->fecha_baja : $hoy;
            }

            // horas totales por empleado
            $times_empleado_aprobados_pendientes_list = Timesheet::where('fecha_dia', '>=', $fecha_inicio_timesheet_empleado)->where('fecha_dia', '<=', $fecha_fin_timesheet_empleado)->where('empleado_id', $empleado_list->id)->where('estatus', '!=', 'rechazado')->where('estatus', '!=', 'papelera')->get();

            $horas_semana = 0;
            $times_empleado_calendario_array = [];
            $times_empleado_array = [];

            foreach ($times_empleado_aprobados_pendientes_list as $time) {
                foreach ($time->horas as $hora) {
                    $horas_semana = 0;
                    $horas_total_time += $hora->horas_lunes;
                    $horas_total_time += $hora->horas_martes;
                    $horas_total_time += $hora->horas_miercoles;
                    $horas_total_time += $hora->horas_jueves;
                    $horas_total_time += $hora->horas_viernes;
                    $horas_total_time += $hora->horas_sabado;
                    $horas_total_time += $hora->horas_domingo;

                    $horas_semana += $hora->horas_lunes;
                    $horas_semana += $hora->horas_martes;
                    $horas_semana += $hora->horas_miercoles;
                    $horas_semana += $hora->horas_jueves;
                    $horas_semana += $hora->horas_viernes;
                    $horas_semana += $hora->horas_sabado;
                    $horas_semana += $hora->horas_domingo;

                    $times_empleado_calendario_array[] = [
                        'id'=>$time->id,
                        'semana_y'=>$time->semana_y,
                        'horas_semana'=>$horas_semana,
                    ];
                }
            }
            $this->horas_totales_filtros_empleados += $horas_total_time;

            $times_atrasados = 0;
            $times_empleado = Timesheet::where('empleado_id', $empleado_list->id)->where('estatus', '!=', 'rechazado')->where('estatus', '!=', 'papelera')->count();

            $fecha_inicio = date_create(Carbon::parse($fecha_inicio_timesheet_empleado)->format('d-m-Y'));
            $fecha_fin = date_create(Carbon::parse($fecha_fin_timesheet_empleado)->format('d-m-Y'));

            $semanas_empleado = intval(date_diff($fecha_inicio, $fecha_fin)->format('%R%a') / 7);

            if ($times_empleado < $semanas_empleado) {
                $times_atrasados = $semanas_empleado - $times_empleado;
            }

            // semanas faltantes
            $antiguedad_y = Carbon::parse($fecha_inicio_timesheet_empleado)->format('Y');
            $antiguedad_m = Carbon::parse($fecha_inicio_timesheet_empleado)->format('m');
            $antiguedad_d = Carbon::parse($fecha_inicio_timesheet_empleado)->format('d');

            foreach ($times_empleado_aprobados_pendientes_list as $time) {
                $times_empleado_array[] = $time->semana_y;
            }

            // $times_faltantes_empleado = [];
            $times_faltantes_empleado = $this->getWeeksFromRange($antiguedad_y, $antiguedad_m, $antiguedad_d, $times_empleado_array);

            // registro de horas en calendario
            $calendario_tabla_empleado = [];
            foreach ($calendario_array as $key => $año) {
                foreach ($año['months'] as $key => $mes) {
                    foreach ($mes['weeks'] as $key => $semana) {
                        if (count($times_empleado_calendario_array) > 0) {
                            $time = array_filter($times_empleado_calendario_array, function ($value) use ($semana) {
                                return $value['semana_y'] == $semana;
                            });
                            if (count($time) > 0) {
                                // dd($time);
                                foreach ($time as $key => $t) {
                                    array_push($calendario_tabla_empleado, $t['horas_semana']);
                                }
                            } else {
                                array_push($calendario_tabla_empleado, '<span class="p-1" style="background-color:#FFF2CC;">Sin&nbsp;Registro</span>');
                            }
                        } else {
                            array_push($calendario_tabla_empleado, '<span class="p-1" style="background-color:#FFF2CC;">Sin&nbsp;Registro</span>');
                        }
                    }
                }
            }
            // dump($calendario_tabla_empleado);

            // array empleados
            $this->empleados->push([
                'id'=>$empleado_list->id,
                'avatar_ruta'=>$empleado_list->avatar_ruta,
                'estatus'=>$empleado_list->estatus,
                'horas_totales'=>$horas_total_time,
                'name'=>$empleado_list->name,
                'area'=>$empleado_list->area ? $empleado_list->area->area : '',
                'puesto'=>$empleado_list->puesto,
                'times_atrasados'=>$times_atrasados,
                'times_faltantes'=>$times_faltantes_empleado,
                'calendario'=>$calendario_tabla_empleado,
            ]);
        }

        $this->calendario_tabla = $calendario_array;

        $this->hoy_format = $hoy->format('d/m/Y');

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-empleados');
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

    public function buscarEmpleado($id_empleado)
    {
        $this->empleado_seleccionado_id = $id_empleado;

        $this->proyectos = collect();

        $this->proyectos_detalle = collect();

        $this->times_empleado_horas = collect();

        $this->empleado = Empleado::find($this->empleado_seleccionado_id);

        $this->timesheet = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', '!=', 'rechazado')->where('estatus', '!=', 'papelera')->orderByDesc('fecha_dia')->get();

        foreach ($this->timesheet as $t) {
            $horas_semana_lunes = 0;
            $horas_semana_martes = 0;
            $horas_semana_miercoles = 0;
            $horas_semana_jueves = 0;
            $horas_semana_viernes = 0;
            $horas_semana_sabado = 0;
            $horas_semana_domingo = 0;
            $horas_totales_semana = 0;
            foreach ($t->horas as $hora) {
                $this->proyectos->push($hora->proyecto->id);

                $horas_semana_lunes += $hora->horas_lunes;
                $horas_semana_martes += $hora->horas_martes;
                $horas_semana_miercoles += $hora->horas_miercoles;
                $horas_semana_jueves += $hora->horas_jueves;
                $horas_semana_viernes += $hora->horas_viernes;
                $horas_semana_sabado += $hora->horas_sabado;
                $horas_semana_domingo += $hora->horas_domingo;

                $horas_totales_semana += $hora->horas_lunes;
                $horas_totales_semana += $hora->horas_martes;
                $horas_totales_semana += $hora->horas_miercoles;
                $horas_totales_semana += $hora->horas_jueves;
                $horas_totales_semana += $hora->horas_viernes;
                $horas_totales_semana += $hora->horas_sabado;
                $horas_totales_semana += $hora->horas_domingo;
            }

            $this->times_empleado_horas->push([
                'fecha'=>$t->fecha_dia,
                'estatus'=>$t->estatus,
                'semana'=>$t->semana,
                'horas_lunes'=>$horas_semana_lunes,
                'horas_martes'=>$horas_semana_martes,
                'horas_miercoles'=>$horas_semana_miercoles,
                'horas_jueves'=>$horas_semana_jueves,
                'horas_viernes'=>$horas_semana_viernes,
                'horas_sabado'=>$horas_semana_sabado,
                'horas_domingo'=>$horas_semana_domingo,
                'horas_totales'=>$horas_totales_semana,
            ]);
        }

        $this->proyectos = $this->proyectos->unique();
        foreach ($this->proyectos as $proyecto) {
            $tareas = collect();
            $horas_proyecto = 0;
            foreach (TimesheetProyecto::find($proyecto)->tareas as $tarea) {
                $tarea_model = TimesheetHoras::where('tarea_id', $tarea->id)->get();
                $horas = 0;
                foreach ($tarea_model as $tm) {
                    $horas += intval($tm->horas_lunes);
                    $horas += intval($tm->horas_martes);
                    $horas += intval($tm->horas_miercoles);
                    $horas += intval($tm->horas_jueves);
                    $horas += intval($tm->horas_viernes);
                    $horas += intval($tm->horas_sabado);
                    $horas += intval($tm->horas_domingo);
                }
                $tareas->push([
                    'id'=>$tarea->id,
                    'tarea'=>$tarea->tarea,
                    'horas'=>$horas,
                ]);
                $horas_proyecto += $horas;
            }
            $this->proyectos_detalle->push([
                'id'=>$proyecto,
                'proyecto'=>TimesheetProyecto::find($proyecto)->proyecto,
                'tareas'=>$tareas,
                'horas'=>$horas_proyecto,
            ]);
            $this->horas_totales += $horas_proyecto;
        }

        // contadores
        $this->todos_contador = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->count();
        $this->borrador_contador = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', 'papelera')->count();
        $this->pendientes_contador = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', 'pendiente')->count();
        $this->aprobados_contador = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', 'aprobado')->count();
        $this->rechazos_contador = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', 'rechazado')->count();

        $this->times_empleado = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->get();

        $this->emit('scriptTabla');
    }

    public function correoRetraso($id)
    {
        $empleado = Empleado::select('id', 'name', 'email', 'antiguedad')->find($id);
        $antiguedad_y = Carbon::parse($empleado->antiguedad)->format('Y');
        $antiguedad_m = Carbon::parse($empleado->antiguedad)->format('m');
        $antiguedad_d = Carbon::parse($empleado->antiguedad)->format('d');
        $times_empleado = Timesheet::where('empleado_id', $empleado->id)->where('estatus', '!=', 'papelera')->where('estatus', '!=', 'rechazado')->get();
        $times_empleado_array = [];

        foreach ($times_empleado as $time) {
            $times_empleado_array[] = $time->semana_y;
        }

        $times_faltantes_empleado = $this->getWeeksFromRange($antiguedad_y, $antiguedad_m, $antiguedad_d, $times_empleado_array);

        Mail::to($empleado->email)->send(new TimesheetCorreoRetraso($empleado, $times_faltantes_empleado));

        $this->alert('success', 'Correo Enviado!');

        $this->empleado = null;
    }

    public function todos()
    {
        $this->times_empleado = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->get();
    }

    public function papelera()
    {
        $this->times_empleado = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', 'papelera')->get();
    }

    public function pendientes()
    {
        $this->times_empleado = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', 'pendiente')->get();
    }

    public function aprobados()
    {
        $this->times_empleado = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', 'aprobado')->get();
    }

    public function rechazos()
    {
        $this->times_empleado = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->where('estatus', 'rechazado')->get();
    }
}
