<?php

namespace App\Http\Livewire\Timesheet;

use Livewire\Component;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use App\Models\Empleado;
use Carbon\Carbon;

class ReportesEmpleados extends Component
{
    public $lista_empleados;
    public $empleado_seleccionado_id;

    public $empleado;
    public $timesheet;

    public $todos_contador;
    public $borrador_contador;
    public $pendientes_contador;
    public $aprobados_contador;
    public $rechazos_contador;
    public $times_empleado;
    public $proyectos;
    public $proyectos_detalle;
    public $horas_totales = 0;

    public function mount()
    {
         
    }

    public function render()
    {   
        $hoy = Carbon::now();
        $semanas_del_mes = intval(($hoy->format('d') * 4) / 29);
        $this->empleados = collect();
        $empleados_list = Empleado::get();
        foreach ($empleados_list as $empleado_list) {
            $times_atrasados = 0;
            $times_empleado = Timesheet::where('empleado_id', $empleado_list->id)->whereMonth('fecha_dia', $hoy)->where('estatus', '!=', 'rechazado')->where('estatus', '!=', 'papelera')->count();

            if ($times_empleado < ($semanas_del_mes - 1) ) {
                $times_atrasados = ($semanas_del_mes - 1) - $times_empleado;
            }

            $this->empleados->push([
                'id'=>$empleado_list->id,
                'avatar_ruta'=>$empleado_list->avatar_ruta,
                'name'=>$empleado_list->name,
                'area'=>$empleado_list->area ? $empleado_list->area->area : "",
                'puesto'=>$empleado_list->puesto,
                'times_atrasados'=>$times_atrasados,
            ]);
        }

        



        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-empleados');
    }

    public function buscarEmpleado($id_empleado)
    {
        $this->empleado_seleccionado_id = $id_empleado;

        $this->proyectos = collect();

        $this->proyectos_detalle = collect();

        $this->empleado = Empleado::find($this->empleado_seleccionado_id);

        $this->timesheet = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->get();


        foreach($this->timesheet as $t){
            foreach($t->horas as $hora){
                $this->proyectos->push($hora->proyectos->id);
            }
        }

        $this->proyectos = $this->proyectos->unique();
        foreach($this->proyectos as $proyecto){
            $tareas = collect();
            $horas_proyecto = 0;
            foreach(TimesheetProyecto::find($proyecto)->tareas as $tarea){
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
