<?php

namespace App\Http\Livewire\Timesheet;

use Livewire\Component;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use App\Models\Empleado;

class ReportesEmpleados extends Component
{
    public $lista_empleados;
    public $empleado_seleccionado_id;

    public $empleado;
    public $timesheet;
    public $proyectos;

    public $todos_contador;
    public $borrador_contador;
    public $pendientes_contador;
    public $aprobados_contador;
    public $rechazos_contador;
    public $times_empleado;

    public function mount()
    {
         
    }

    public function render()
    {
        $this->empleados = Empleado::orderBy('name', 'ASC')->get();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-empleados');
    }

    public function buscarEmpleado()
    {
        $this->empleado = Empleado::find($this->empleado_seleccionado_id);

        $this->timesheet = Timesheet::where('empleado_id', $this->empleado_seleccionado_id)->get();

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
