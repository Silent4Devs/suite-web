<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use App\Traits\getWeeksFromRange;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ReportesProyectos extends Component
{
    use getWeeksFromRange;
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $totalRegistrosMostrando;

    public $perPage = 5;

    public $search;

    public $areas;

    public $proyectos;

    public $proyecto_reporte;

    public $area_proyecto;

    public $cliente_proyecto;

    public $tareas_array;

    public $empleados_proyecto;

    public $total_horas_proyecto;

    public $hoy_format;

    // public $proyectos_array;
    public $area_id;

    public $fecha_inicio;

    public $fecha_fin;

    public $hoy;

    public $fecha_inicio_proyecto;

    public $fecha_fin_proyecto;

    public $horas_totales_todos_proyectos = 0;

    public $semanas_totales_calendario = 0;

    public $calendario_tabla;

    public $organizacion;

    public function mount()
    {
        $this->areas = Area::getAll();
        $this->organizacion = Organizacion::getFirst();
    }

    public function updatedAreaId($value)
    {
        $this->area_id = $value;
        $this->proyecto_reporte = null;
    }

    public function updatedFechaInicio($value)
    {
        $this->fecha_inicio = $value;

        if ($this->fecha_inicio < $this->organizacion->fecha_registro_timesheet) {
            $this->fecha_inicio = $this->organizacion->fecha_registro_timesheet;
            $this->alert('info', 'La fecha de inicio no puede ser anterior a la fecha de registro de timesheet', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        } elseif ($this->fecha_inicio > $this->fecha_fin) {
            $this->fecha_inicio = Carbon::now()->endOfMonth()->subMonth(2)->format('Y-m-d');
            $this->alert('info', 'La fecha de inicio no puede ser posterior a hoy', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
        $this->proyecto_reporte = null;
    }

    public function updatedFechaFin($value)
    {
        $this->fecha_fin = $value;
        if ($this->fecha_fin > now()->format('Y-m-d')) {
            $this->fecha_fin = now()->format('Y-m-d');
            $this->alert('info', 'La fecha de fin no puede ser posterior a hoy', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        } elseif ($this->fecha_fin < $this->fecha_inicio) {
            $this->fecha_fin = now()->format('Y-m-d');
            $this->alert('info', 'La fecha de fin no puede ser anterior a la fecha de inicio', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
        $this->proyecto_reporte = null;
    }

    public function updatedFechaInicioProyecto($value)
    {
        $this->fecha_inicio_proyecto = $value;
        $this->genrarReporte($this->proyecto_reporte->id);
    }

    public function updatedFechaFinProyecto($value)
    {
        $this->fecha_fin_proyecto = $value;
        $this->genrarReporte($this->proyecto_reporte->id);
    }

    public function render()
    {
        $this->hoy = Carbon::now();

        $this->emit('resize');

        $this->emit('scriptTabla');

        $this->areas = Area::getAll();

        $this->horas_totales_todos_proyectos = 0;

        //calendario tabla
        $calendario_array = [];

        $fecha_registro_timesheet = Organizacion::select('fecha_registro_timesheet')->first()->fecha_registro_timesheet;

        if ($this->fecha_inicio) {
            $fecha_inicio_complit_timesheet = Carbon::parse($fecha_registro_timesheet)->lt($this->fecha_inicio) ? $this->fecha_inicio : $fecha_registro_timesheet;
        } else {
            $fecha_inicio_complit_timesheet = Carbon::now()->endOfMonth()->subMonth(2)->format('Y-m-d');
        }

        if (($this->fecha_fin) && (Carbon::parse($this->fecha_fin)->lt($this->hoy)) && (Carbon::parse($fecha_inicio_complit_timesheet)->lt($this->fecha_fin))) {
            $fecha_fin_complit_timesheet = $this->fecha_fin;
        } else {
            $fecha_fin_complit_timesheet = $this->hoy;
            $this->fecha_fin = Carbon::parse($fecha_fin_complit_timesheet)->format('Y-m-d');
        }

        $fecha_inicio_complit_timesheet = Carbon::parse($fecha_inicio_complit_timesheet);
        $fecha_fin_complit_timesheet = Carbon::parse($fecha_fin_complit_timesheet);
        $semanas_complit_timesheet = $this->getWeeksFromRange($fecha_inicio_complit_timesheet->format('Y'), $fecha_inicio_complit_timesheet->format('m'), $fecha_inicio_complit_timesheet->format('d'), [], 'monday', 'sunday', $fecha_fin_complit_timesheet, $fecha_fin_complit_timesheet);
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
                        'year' => $year,
                        'total_weeks' => 0,
                        'total_months' => 0,
                        'months' => [
                            "{$month}" => [
                                'weeks' => [],
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

        $proyectos_array = collect();
        if ($this->area_id) {
            $this->proyectos = TimesheetProyecto::get()->filter(function ($item) {
                return $item->areas->contains(Area::select('id', 'area')->find($this->area_id));
            });
        } else {
            $this->proyectos = TimesheetProyecto::getAll();
        }
        foreach ($this->proyectos as $proyecto) {
            // registros existenetes horas a la semana
            $registro_horas_proyecto = TimesheetHoras::where('proyecto_id', $proyecto->id)->get();

            // registro de horas en calendario
            $times_registro_horas_array = collect();
            $calendario_tabla_proyectos = [];
            foreach ($calendario_array as $key => $año) {
                foreach ($año['months'] as $key => $mes) {
                    foreach ($mes['weeks'] as $key => $semana) {
                        $dias_semana = explode('|', $semana);
                        $domingo_semana = Carbon::parse($dias_semana[1])->format('Y-m-d');

                        $horas_proyecto_times = 0;

                        foreach ($registro_horas_proyecto as $key => $registro_horas) {
                            $fecha_dia_domingo = Carbon::parse($registro_horas->timesheet->fecha_dia)->endOfWeek();
                            $fecha_dia_domingo = Carbon::parse($fecha_dia_domingo)->format('Y-m-d');

                            if ($fecha_dia_domingo == $domingo_semana) {
                                $horas_proyecto_times += floatval($registro_horas->horas_lunes);
                                $horas_proyecto_times += floatval($registro_horas->horas_martes);
                                $horas_proyecto_times += floatval($registro_horas->horas_miercoles);
                                $horas_proyecto_times += floatval($registro_horas->horas_jueves);
                                $horas_proyecto_times += floatval($registro_horas->horas_viernes);
                                $horas_proyecto_times += floatval($registro_horas->horas_sabado);
                                $horas_proyecto_times += floatval($registro_horas->horas_domingo);
                            }
                        }

                        $this->horas_totales_todos_proyectos += $horas_proyecto_times;

                        if ($horas_proyecto_times > 0) {
                            array_push($calendario_tabla_proyectos, $horas_proyecto_times);
                        } else {
                            array_push($calendario_tabla_proyectos, '<span class="p-1" style="background-color:#FFF2CC;">Sin&nbsp;Registro</span>');
                        }
                    }
                }
            }

            $proyectos_array->push([
                'id' => $proyecto->id,
                'identificador' => $proyecto->identificador,
                'proyecto' => $proyecto->proyecto,
                'areas' => $proyecto->areas,
                'cliente' => $proyecto->cliente ? $proyecto->cliente->nombre : '',
                'calendario' => $calendario_tabla_proyectos,
            ]);
        }
        if ($this->search) {
            $proyectos_array = $proyectos_array->filter(function ($item) {
                return str_contains($item['cliente'], $this->search) || str_contains($item['proyecto'], $this->search) || $item['areas']->pluck('area')->contains(function ($item) {
                    return str_contains($item, $this->search);
                });
            });
        }

        $this->totalRegistrosMostrando = count($proyectos_array);
        $proyectos_array = $this->paginate($proyectos_array, $this->perPage);

        $this->calendario_tabla = $calendario_array;
        $this->hoy_format = $this->hoy->format('d/m/Y');

        return view('livewire.timesheet.reportes-proyectos', compact('proyectos_array'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function genrarReporte($id)
    {
        $this->proyecto_reporte = TimesheetProyecto::getAll()->find($id);

        // $this->area_proyecto = Area::find($this->proyecto_reporte->area_id);
        $this->cliente_proyecto = TimesheetCliente::getAll()->find($this->proyecto_reporte->cliente_id);

        $empleados = collect();

        $tareas = TimesheetTarea::getAll()->where('proyecto_id', $id);

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

                $h_total_tarea += floatval($hora->horas_lunes);
                $h_total_tarea += floatval($hora->horas_martes);
                $h_total_tarea += floatval($hora->horas_miercoles);
                $h_total_tarea += floatval($hora->horas_jueves);
                $h_total_tarea += floatval($hora->horas_viernes);
                $h_total_tarea += floatval($hora->horas_sabado);
                $h_total_tarea += floatval($hora->horas_domingo);

                $h_total_tarea_total += $h_total_tarea;

                $empleado = Empleado::find($hora->timesheet->empleado_id);

                if (!$empleados->contains('id', $empleado->id)) {
                    $empleados->push([
                        'id' => $empleado->id,
                        'name' => $empleado->name,
                        'salario_diario' => $empleado->salario_diario,
                        'foto' => $empleado->avatar_ruta,
                        'area' => $empleado->area,
                        'puesto' => $empleado->puesto,
                        'horas' => $h_total_tarea,
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
                'tarea' => $tarea->tarea,
                'horas_totales' => $h_total_tarea_total,
                'empleados' => $empleados,
            ]);
        }
        // dd($this->tareas_array);

        foreach ($this->tareas_array as $key => $tarea_em) {
            foreach ($tarea_em['empleados'] as $key => $emp_array) {
                if (!($this->empleados_proyecto->contains('id', $emp_array['id']))) {
                    $this->empleados_proyecto->push($emp_array);
                } else {
                    $this->empleados_proyecto = $this->empleados_proyecto->map(function ($emp_item) use ($emp_array) {
                        if ($emp_item['id'] == $emp_array['id']) {
                            $emp_item['horas'] += $emp_array['horas'];
                        }

                        return $emp_item;
                    });
                }
            }
        }

        $this->emit('scriptChartsProyect', $this->tareas_array, $this->empleados_proyecto);
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
        foreach ($array as $key => $value) {
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
