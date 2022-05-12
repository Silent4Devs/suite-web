<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use Carbon\Carbon;
use Livewire\Component;

class ReportesProyectos extends Component
{
    public $areas;
    public $proyectos;

    public $proyecto_reporte;
    public $area_proyecto;
    public $cliente_proyecto;
    public $tareas_array;
    public $empleados_proyecto;
    public $total_horas_proyecto;
    public $hoy_format;

    public function render()
    {
        $hoy = Carbon::now();

        $this->emit('resize');

        $this->emit('scriptTabla');

        $this->areas = Area::get();

        $this->proyectos = TimesheetProyecto::get();

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
}
