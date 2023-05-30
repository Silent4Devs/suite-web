<?php

namespace App\Http\Livewire\Timesheet;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoEmpleado;
use App\Models\Empleado;

use Livewire\Component;

class TimesheetProyectoEmpleadosComponent extends Component
{
    public $proyecto;
    public $empleados;
    public $proyecto_empleados;
    public $proyecto_id;

    public function mount($proyecto_id)
    {
        $this->proyecto = TimesheetProyecto::find($proyecto_id);
        $this->empleados = Empleado::get();
    }

    public function render()
    {
        $this->proyecto_empleados = Empleado::get();
        return view('livewire.timesheet.timesheet-proyecto-empleados-component');
    }
}
