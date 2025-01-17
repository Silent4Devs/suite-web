<?php

namespace App\Exports;

use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\Timesheet;
use App\Traits\getWeeksFromRange;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteEmpleadoExport implements FromCollection, WithHeadings
{
    use getWeeksFromRange;

    public $fecha_inicio;

    public $fecha_fin;

    public $empleados;

    public $times_faltantes_empleado;

    public $semanas_totales_calendario;

    public $horas_totales_filtros_empleados;

    public $calendario_tabla;

    public $hoy_format;

    public $hoy;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(?string $fecha_inicio, ?string $fecha_fin)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
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

    public function collection()
    {
        $this->empleados = Empleado::getSelectEmpleadosWithArea();

        //calendario tabla
        $calendario_array = [];

        $this->hoy = Carbon::now();

        $fecha_inicio_complit_timesheet = $this->fecha_inicio ? $this->fecha_inicio : Organizacion::getFechaRegistroTimesheet();
        $fecha_inicio_complit_timesheet = Carbon::parse($fecha_inicio_complit_timesheet);
        $semanas_complit_timesheet = $this->getWeeksFromRange($fecha_inicio_complit_timesheet->format('Y'), $fecha_inicio_complit_timesheet->format('m'), $fecha_inicio_complit_timesheet->format('d'), [], 'monday', 'sunday', $this->fecha_fin ? Carbon::parse($this->fecha_fin) : null, $this->fecha_fin ? Carbon::parse($this->fecha_fin) : Carbon::now(), false);
        $total_months = 0;
        $datos = [];

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
                if (! ($this->buscarKeyEnArray($year, $calendario_array))) {
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
                            if (! ($this->existsWeeksInMonth($semana, $calendario_array["{$previous_year}"]['months']['December']['weeks']))) {
                                $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                            }
                        }
                    }
                } else {
                    if (array_key_exists($month, $calendario_array["{$year}"]['months'])) {
                        if (! in_array($semana, $calendario_array["{$year}"]['months']["{$month}"]['weeks'])) {
                            $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                        }
                    } else {
                        if (array_key_exists($previous_month, $calendario_array["{$year}"]['months'])) {
                            if (! ($this->existsWeeksInMonth($semana, $calendario_array["{$year}"]['months']["{$previous_month}"]['weeks']))) {
                                $calendario_array["{$year}"]['months']["{$previous_month}"]['weeks'][] = $semana;
                            } else {
                                $calendario_array["{$year}"]['months']["{$month}"]['weeks'][] = $semana;
                                array_pop($calendario_array["{$year}"]['months']["{$previous_month}"]['weeks']);
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
        foreach ($this->empleados as $empleado_list) {

            $horas_total_time = 0;

            $horas_total_time = 0;

            $fecha_registro_timesheet = Organizacion::getFechaRegistroTimesheet();

            if ($this->fecha_inicio) {
                $fecha_inicio_timesheet_empleado = $this->fecha_inicio;
            }

            if (($this->fecha_fin) && (Carbon::parse($this->fecha_fin)->lt($this->hoy))) {
                $fecha_fin_timesheet_empleado = $this->fecha_fin;
            } else {
                $fecha_fin_timesheet_empleado = $this->fecha_fin;
            }

            $hoy_2 = now();
            if ($hoy_2->subweeks(3)->lt($fecha_inicio_timesheet_empleado)) {
                if (gettype($fecha_inicio_timesheet_empleado == 'string')) {
                    $fecha_inicio_timesheet_empleado = Carbon::parse($fecha_inicio_timesheet_empleado);
                }
                $fecha_inicio_timesheet_empleado = $fecha_inicio_timesheet_empleado->subweek()->subMonth();
            }

            // horas totales por empleado
            $times_empleado_aprobados_pendientes_list = Timesheet::where('fecha_dia', '>=', $fecha_inicio_timesheet_empleado)
                ->where('fecha_dia', '<=', $fecha_fin_timesheet_empleado)
                ->where('empleado_id', $empleado_list->id)
                ->where('estatus', '!=', 'rechazado')
                ->where('estatus', '!=', 'Rechazada')
                ->where('estatus', '!=', 'papelera')
                ->get();

            $horas_semana = 0;
            $times_empleado_calendario_array = [];
            $times_empleado_array = [];
            foreach ($times_empleado_aprobados_pendientes_list as $time) {
                $horas_semana = 0;
                foreach ($time->horas as $hora) {

                    $horas_total_time += floatval($hora->horas_lunes);
                    $horas_total_time += floatval($hora->horas_martes);
                    $horas_total_time += floatval($hora->horas_miercoles);
                    $horas_total_time += floatval($hora->horas_jueves);
                    $horas_total_time += floatval($hora->horas_viernes);
                    $horas_total_time += floatval($hora->horas_sabado);
                    $horas_total_time += floatval($hora->horas_domingo);

                    $horas_semana += floatval($hora->horas_lunes);
                    $horas_semana += floatval($hora->horas_martes);
                    $horas_semana += floatval($hora->horas_miercoles);
                    $horas_semana += floatval($hora->horas_jueves);
                    $horas_semana += floatval($hora->horas_viernes);
                    $horas_semana += floatval($hora->horas_sabado);
                    $horas_semana += floatval($hora->horas_domingo);

                    $times_empleado_calendario_array[] = [
                        'id' => $time->id,
                        'semana_y' => $time->semana_y,
                        'horas_semana' => $horas_semana,
                    ];
                }
            }
            $this->horas_totales_filtros_empleados += $horas_total_time;

            // semanas
            $entro_esta_semana = false;
            if (Carbon::parse($this->fecha_inicio)->lt(Carbon::parse($empleado_list->antiguedad))) {
                if (Carbon::parse($empleado_list->antiguedad)->startOfWeek(Carbon::MONDAY) >= Carbon::now()->startOfWeek(Carbon::MONDAY)) {
                    // concuerda la misma semana de ingreso y de la actual
                    $entro_esta_semana = true;
                } else {
                    $fecha_inicio_timesheet_faltantes_empleado = Carbon::parse($empleado_list->antiguedad)->startOfWeek(Carbon::MONDAY);
                }
            } else {
                $fecha_inicio_timesheet_faltantes_empleado = $this->fecha_inicio;
            }
            if (! $fecha_inicio_timesheet_faltantes_empleado) {
                $fecha_inicio_timesheet_faltantes_empleado = $this->fecha_inicio;
            }

            $fechaToFormat = Carbon::parse($fecha_inicio_timesheet_faltantes_empleado);
            $antiguedad_y = $fechaToFormat->format('Y');
            $antiguedad_m = $fechaToFormat->format('m');
            $antiguedad_d = $fechaToFormat->format('d');

            foreach ($times_empleado_aprobados_pendientes_list as $time) {
                $times_empleado_array[] = $time->semana_y;
            }

            if ($entro_esta_semana) {
                $this->times_faltantes_empleado = [];

                $times_atrasados = 0;
            } else {
                if ($this->fecha_fin == now()->format('Y-m-d')) {
                    $fecha_finalizacion = null;
                } else {
                    $fecha_finalizacion = Carbon::parse($this->fecha_fin)->gt(now()) ? null : Carbon::parse($this->fecha_fin);
                }

                $this->times_faltantes_empleado = $this->getWeeksFromRange($antiguedad_y, $antiguedad_m, $antiguedad_d, $times_empleado_array, 'monday', 'sunday', $fecha_finalizacion, $this->fecha_fin ? Carbon::parse($this->fecha_fin) : Carbon::now(), true);

                $times_atrasados = count($this->times_faltantes_empleado);
            }
            $fecha_ing = Carbon::parse($empleado_list->antiguedad);
            $fecha_ingre = date('Y-m-d', strtotime($fecha_ing));

            $horas_totales_empleado_calendar = 0;
            $calendario_tabla_empleado = [];
            foreach ($calendario_array as $key => $año) {
                foreach ($año['months'] as $key => $mes) {
                    foreach ($mes['weeks'] as $key => $semana) {
                        if (count($times_empleado_calendario_array) > 0) {
                            $unique_array = [];
                            $s = explode('|', $semana);
                            foreach ($times_empleado_calendario_array as $element) {
                                $hash = $element['semana_y'];
                                $unique_array[$hash] = $element;
                            }
                            $result_unique = array_values($unique_array);

                            $time = array_filter($result_unique, function ($value) use ($semana) {
                                return $value['semana_y'] == $semana;
                            });
                            if (count($time) > 0) {
                                foreach ($time as $key => $t) {
                                    array_push($calendario_tabla_empleado, $t['horas_semana']);
                                    $horas_totales_empleado_calendar += $t['horas_semana'];
                                }
                            } elseif ($entro_esta_semana === true or (Carbon::parse($s[0])->lt(Carbon::parse($fecha_ingre)))) {
                                array_push($calendario_tabla_empleado, '<span class="p-1" style="background-color:#FFF2CC;">No&nbsp;Aplica</span>');
                            } else {
                                array_push($calendario_tabla_empleado, '<span class="p-1" style="background-color:#FFF2CC;">Sin&nbsp;Registro</span>');
                                $times_atrasados = ($times_atrasados + 1);
                            }
                        } else {
                            $s = explode('|', $semana);
                            if ((Carbon::parse($s[0])->lt(Carbon::parse($fecha_ingre)))) {
                                array_push($calendario_tabla_empleado, '<span class="p-1" style="background-color:#FFF2CC;">No&nbsp;Aplica</span>');
                            } else {
                                array_push($calendario_tabla_empleado, '<span class="p-1" style="background-color:#FFF2CC;">Sin&nbsp;Registro</span>');
                                $times_atrasados = ($times_atrasados + 1);
                            }
                        }
                    }
                }
            }

            $calendario_column = implode(' ', array_map(function ($horas) {
                // Elimina las etiquetas HTML, los caracteres &nbsp; y otros espacios innecesarios
                $horas_limpias = strip_tags($horas); // Eliminar etiquetas HTML
                $horas_limpias = html_entity_decode($horas_limpias); // Decodificar entidades HTML como &nbsp;

                return trim($horas_limpias); // Eliminar espacios adicionales
            }, $calendario_tabla_empleado));

            // Divide los valores de calendario en un array
            $calendario_dividido = explode(' ', $calendario_column);

            $datos[] = [
                'Nombre' => $empleado_list->name,
                'Area' => $empleado_list->area ? $empleado_list->area->area : '',
                'Puesto' => $empleado_list->puesto,
                'Estatus' => $empleado_list->estatus,
                'Fecha' => $empleado_list->estatus == 'alta' ? Carbon::parse($empleado_list->fecha_ingreso)->format('d/m/Y') : ($empleado_list->fecha_baja == null ? 'Fecha no registrada' : Carbon::parse($empleado_list->fecha_baja)->format('d/m/Y')),
                'Calendario' => $calendario_column,
                'Total de Horas' => $horas_totales_empleado_calendar,
                'Atrasos' => $times_atrasados,
            ];
        }

        $this->calendario_tabla = $calendario_array;
        $this->hoy_format = $this->hoy->format('d/m/Y');

        return collect($datos);
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Area',
            'Puesto',
            'Estatus',
            'Fecha',
            'Calendario',
            'Total de Horas',
            'Atrasos',
        ];
    }

    public function headingsStyle(): array
    {
        return [
            'font' => [
                'color' => ['rgb' => 'FFFFFF'], // Color del texto (blanco)
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '00FF00'], // Color de fondo (verde)
            ],
        ];
    }
}
