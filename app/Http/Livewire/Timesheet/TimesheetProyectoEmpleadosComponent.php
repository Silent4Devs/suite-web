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

    public $empleado_añadido;
    public $horas_asignadas;
    public $costo_hora;

    public function mount($proyecto_id)
    {
        $this->proyecto = TimesheetProyecto::find($proyecto_id);
        $this->empleados = Empleado::get();
    }

    public function render()
    {
        $this->proyecto_empleados = TimesheetProyectoEmpleado::where('proyecto_id', $this->proyecto->id)->get();
        $this->emit('tablaLivewire');
        return view('livewire.timesheet.timesheet-proyecto-empleados-component');
    }

    public function addEmpleado()
    {
        $empleado_add_proyecto = Empleado::find($this->empleado_añadido);
        $time_proyect_empleado = TimesheetProyectoEmpleado::create([
            'proyecto_id' => $this->proyecto->id,
            'empleado_id'=> $empleado_add_proyecto->id,
            'area_id' => $empleado_add_proyecto->area_id,
            'horas_asignadas' => $this->horas_asignadas,
            'costo_hora' => $this->costo_hora,
        ]);
    }
}
