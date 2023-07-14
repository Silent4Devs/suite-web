<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoEmpleado;
use App\Models\TimesheetProyectoArea;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class TimesheetProyectoEmpleadosComponent extends Component
{
    public $proyecto;
    public $empleados;
    public $proyecto_empleados;
    public $proyecto_id;

    public $empleado_añadido;
    public $horas_asignadas;
    public $costo_hora;

    public $empleado_editado;
    public $horas_edit;
    public $costo_edit;

    public function mount($proyecto_id)
    {
        $this->proyecto = TimesheetProyecto::find($proyecto_id);
        $this->areasempleado = TimesheetProyectoArea::where('proyecto_id', $proyecto_id)->get();
        $this->empleados = Empleado::getAll();
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
        if ($this->proyecto->tipo === "Externo") {
            $this->validate([
                'horas_asignadas' => ['required'],
                'costo_hora' => ['required'],
            ]);
        }
        $time_proyect_empleado = TimesheetProyectoEmpleado::create([
            'proyecto_id' => $this->proyecto->id,
            'empleado_id' => $empleado_add_proyecto->id,
            'area_id' => $empleado_add_proyecto->area_id,
            'horas_asignadas' => $this->horas_asignadas,
            'costo_hora' => $this->costo_hora,
        ]);
    }

    public function editEmpleado($id, Request $request)
    {
        if ($this->proyecto->tipo === "Externo") {
            $this->validate([
                'horas_edit' => ['required'],
                'costo_edit' => ['required'],
            ]);
        }
        $empleado_añadido = $request->input('serverMemo')['data'];
        $id_empleado = $empleado_añadido['empleado_editado'];

        $emp_upd_proyecto = Empleado::find($id_empleado);
        $empleado_edit_proyecto = TimesheetProyectoEmpleado::find($id);
        $empleado_edit_proyecto->update([
            'empleado_id' => $emp_upd_proyecto->id,
            'area_id' => $emp_upd_proyecto->area_id,
            'horas_asignadas' => $empleado_añadido['horas_edit'],
            'costo_hora' => $empleado_añadido['costo_edit'],
        ]);
    }

    public function empleadoProyectoRemove($id)
    {
        $empleado_remov = TimesheetProyectoEmpleado::find($id);

        $empleado_remov->delete();
    }
}
