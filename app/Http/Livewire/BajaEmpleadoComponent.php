<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Traits\EmpleadoFunciones;
use App\Traits\ObtenerOrganizacion;
use Livewire\Component;

class BajaEmpleadoComponent extends Component
{
    use ObtenerOrganizacion, EmpleadoFunciones;

    public $empleado;
    public $empleados;
    public $nuevoSupervisor;
    public function hydrate()
    {
        $this->emit('select2');
    }

    //mount
    public function mount($empleado)
    {
        $this->empleado = $empleado;
        $this->empleados = $this->obtenerEmpleados();
    }

    public function render()
    {
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo = $organizacion_actual->logo;
        $empresa = $organizacion_actual->empresa;
        return view('livewire.baja-empleado-component', compact('logo', 'empresa'));
    }

    public function obtenerEmpleados()
    {
        $empleados = Empleado::select('id', 'name')->get();
        return $empleados;
    }

    public function cambiarSupervisor()
    {
        $empleadosACargo = $this->empleado->children;
        $empleadosACargo->each(function ($empleado) {
            // $empleado->update([
            //     'supervisor_id' => $this->nuevoSupervisor
            // ]);
        });
        $this->emit('select2');
    }
}
