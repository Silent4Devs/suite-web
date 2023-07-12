<?php

namespace App\Http\Livewire\Timesheet;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoProveedor;
use App\Models\Empleado;

use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class TimesheetProyectoExternosComponent extends Component
{
    public $proyecto;
    public $empleados;
    public $proyecto_empleados;
    public $proyecto_proveedores;
    public $proyecto_id;

    public $empleado_añadido;
    public $horas_asignadas;
    public $costo_hora;

    public $externo_añadido;
    public $horas_tercero;
    public $costo_tercero;

    public $horas_tercero_edit;
    public $costo_tercero_edit;

    public function mount($proyecto_id)
    {
        $this->proyecto = TimesheetProyecto::find($proyecto_id);
        $this->empleados = Empleado::get();
    }

    public function render()
    {
        $this->proyecto_proveedores = TimesheetProyectoProveedor::where('proyecto_id', $this->proyecto->id)->get();
        $this->emit('tablaLivewire');
        return view('livewire.timesheet.timesheet-proyecto-externos-component');
    }

    public function addExterno()
    {
        if($this->proyecto->tipo === "Externo"){
            $this->validate([
                'horas_tercero' => ['required'],
                'costo_tercero' => ['required'],
            ]);
        }
        $time_proyect_externo = TimesheetProyectoProveedor::create([
            'proyecto_id' => $this->proyecto->id,
            'proveedor_tercero' => $this->externo_añadido,
            'horas_tercero' => $this->horas_tercero,
            'costo_tercero' => $this->costo_tercero,
        ]);
    }

    public function editExterno($id)
    {
        if($this->proyecto->tipo === "Externo"){
            $this->validate([
                'horas_tercero_edit' => ['required'],
                'costo_tercero_edit' => ['required'],
            ]);
        }
        $edit_time_externo = TimesheetProyectoProveedor::find($id);
        $edit_time_externo->update([
            'horas_tercero' => $this->horas_tercero_edit,
            'costo_tercero' => $this->costo_tercero_edit,
        ]);
    }

    public function externoProyectoRemove($id)
    {
        $externo_remov = TimesheetProyectoProveedor::find($id);

        $externo_remov->delete();
    }

}
