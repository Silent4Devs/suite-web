<?php

namespace App\Http\Livewire\Timesheet;

use Livewire\Component;
use App\Models\Area;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetHoras;
use App\Models\Timesheet;
use App\Models\TimesheetTarea;
use App\Models\Empleado;
use App\Models\TimesheetCliente;

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

    public function render()
    {   
        $this->emit('resize');

        $this->areas = Area::get();

        $this->proyectos = TimesheetProyecto::get();

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
        foreach($tareas as $tarea){
            $horas = TimesheetHoras::where('tarea_id', $tarea->id)->get();

            
            foreach ($horas as $hora) {
                $h_total_tarea = 0;
                $empleado = Empleado::find($hora->timesheet->empleado_id);

                $timesheet_horas_empleado = Timesheet::where('empleado_id', $empleado->id)->get();
                foreach($timesheet_horas_empleado as $time_h_e){
                    $tabla_horas_empleado = TimesheetHoras::where('timesheet_id', $time_h_e->id)->get();
                    $horas_empleados = 0;
                    foreach($tabla_horas_empleado as $table_h_e){
                        $horas_empleados += $table_h_e->horas_lunes;
                        $horas_empleados += $table_h_e->horas_martes;
                        $horas_empleados += $table_h_e->horas_miercoles;
                        $horas_empleados += $table_h_e->horas_jueves;
                        $horas_empleados += $table_h_e->horas_viernes;
                        $horas_empleados += $table_h_e->horas_sabado;
                        $horas_empleados += $table_h_e->horas_domingo;
                    }
                }


                $empleados->push([
                    'name'=> $empleado->name,
                    'foto'=> $empleado->avatar_ruta,
                    'area'=> $empleado->area,
                    'puesto'=> $empleado->puesto,
                    'horas'=> $horas_empleados,
                ]);
                

                $h_total_tarea += $hora->horas_lunes;
                $h_total_tarea += $hora->horas_martes;
                $h_total_tarea += $hora->horas_miercoles;
                $h_total_tarea += $hora->horas_jueves;
                $h_total_tarea += $hora->horas_viernes;
                $h_total_tarea += $hora->horas_sabado;
                $h_total_tarea += $hora->horas_domingo;

                $this->total_horas_proyecto += $h_total_tarea; 
            }  
            $this->tareas_array->push([
                'tarea'=>$tarea->tarea,
                'horas_totales' => $h_total_tarea,
                'empleados' => $empleados->unique(),
            ]);
        }

        $this->empleados_proyecto = $empleados->unique();
    }
}
