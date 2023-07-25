<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Empleado;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoProveedor;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TimesheetProyectoExternosComponent extends Component
{
    use LivewireAlert;

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
        $this->empleados = Empleado::getAll();
    }

    public function render()
    {
        $this->proyecto_proveedores = TimesheetProyectoProveedor::where('proyecto_id', $this->proyecto->id)->orderBy('id')->get();
        $this->emit('scriptTabla');

        return view('livewire.timesheet.timesheet-proyecto-externos-component');
    }

    private function resetInput()
    {
        $this->externo_añadido = null;
        $this->horas_tercero = null;
        $this->costo_tercero = null;
    }

    public function addExterno()
    {
        if ($this->proyecto->tipo === 'Externo') {
            $this->validate([
                'externo_añadido' => ['required'],
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
        $this->resetInput();
        $this->alert('success', 'Agregado exitosamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function editExterno($id, $datos)
    {
        // dd($datos);
        if ($this->proyecto->tipo === 'Externo') {
            if (empty($datos['horas_tercero_edit']) || empty($datos['costo_tercero_edit']) || empty($datos['externo_editado'])) {
                // dd('Llega nulo');
                // $this->dispatchBrowserEvent('closeModal');
                $this->alert('error', 'No debe contener datos vacios', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                ]);

                return null;
            }
        }
        $edit_time_externo = TimesheetProyectoProveedor::find($id);
        $edit_time_externo->update([
            'proveedor_tercero' => $datos['externo_editado'],
            'horas_tercero' => $datos['horas_tercero_edit'],
            'costo_tercero' => $datos['costo_tercero_edit'],
        ]);
        $this->dispatchBrowserEvent('closeModal');
        // $this->resetInput();
        $this->alert('success', 'Editado exitosamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function externoProyectoRemove($id)
    {
        $externo_remov = TimesheetProyectoProveedor::find($id);

        $externo_remov->delete();
    }
}
