<?php

namespace App\Http\Livewire\Timesheet;

use App\Mail\TimesheetCorreoRetraso;
use App\Models\Empleado;
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
            $times_empleado = Timesheet::where('empleado_id', $empleado_list->id)->where('estatus', '!=', 'rechazado')->where('estatus', '!=', 'papelera')->count();

            $fecha_inicio = date_create($empleado_list->antiguedad->format('d-m-Y'));
            $fecha_fin = date_create($hoy->format('d-m-Y'));

            $semanas_empleado = intval(date_diff($fecha_inicio, $fecha_fin)->format('%R%a') / 7);

            if ($times_empleado < $semanas_empleado) {
                $times_atrasados = $semanas_empleado - $times_empleado;
            }

            // semanas faltantes
            $antiguedad_y = Carbon::parse($empleado_list->antiguedad)->format('Y');
            $antiguedad_m = Carbon::parse($empleado_list->antiguedad)->format('m');
            $antiguedad_d = Carbon::parse($empleado_list->antiguedad)->format('d');
            $times_empleado_list = Timesheet::where('empleado_id', $empleado_list->id)->where('estatus', '!=', 'papelera')->where('estatus', '!=', 'rechazado')->get();
            $times_empleado_array = [];

            foreach ($times_empleado_list as $time) {
                $times_empleado_array[] = $time->semana_y;
            }

            $times_faltantes_empleado = $this->getWeeksFromRange($antiguedad_y, $antiguedad_m, $antiguedad_d, $times_empleado_array);

            // array empleados
            $this->empleados->push([
                'id'=>$empleado_list->id,
                'avatar_ruta'=>$empleado_list->avatar_ruta,
                'name'=>$empleado_list->name,
                'area'=>$empleado_list->area ? $empleado_list->area->area : '',
                'puesto'=>$empleado_list->puesto,
                'times_atrasados'=>$times_atrasados,
                'times_faltantes'=>$times_faltantes_empleado,
            ]);
        }

        $this->hoy_format = $hoy->format('d/m/Y');

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-empleados');
    }

    public function buscarEmpleado($id_empleado)
    {
        $this->empleado_seleccionado_id = $id_empleado;

        $this->proyectos = collect();

        $this->proyectos_detalle = collect();

        $this->times_empleado_horas = collect();

        $this->empleado = Empleado::find($this->empleado_seleccionado_id);

        $this->timesheet = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->orderByDesc('fecha_dia')->get();

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
