<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empleado;

class BuscarCVComponent extends Component
{
    public $areas;
    public $empleado_id = "";
    public $area_id = "";
    public $empleado_experiencia;
    public $empleado_educacion;
    public $empleado_certificaciones;
    public $empleado_cursos;
    public $foto_organizacion;

    public function updatedAreaId($value)
    {
        $this->area_id = $value;
    }

    public function updatedEmpleadoId($value)
    {
        $this->empleado_id = $value;
    }

    public function mount()
    {
    }

    public function render()
    {
        $empleados = Empleado::select('id', 'area_id', 'name')->get();
        $empleadoget = Empleado::select('*')->with('empleado_experiencia');

        if ($this->area_id != "") {
            if(Empleado::where('area_id', '=', $this->area_id)->count() > 0){
                $empleadoget->where('area_id', '=', $this->area_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            }else{
                $this->callAlert('warning', 'No se encontro registro con esta area', false, 'las opciones de busqueda se restablecieron');
                $this->area_id = "";
            }
        }

        if ($this->empleado_id != "") {
            if(Empleado::where('id', '=', $this->empleado_id)->count() > 0){
                $empleadoget->where('id', '=', $this->empleado_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            }else{
                $this->callAlert('warning', 'No se encontro registro con este empleado', false, 'las opciones de busqueda se restablecieron');
                $this->empleado_id = "";
            }
        }

        return view('livewire.buscar-c-v-component', [
            'empleados' => $empleados,
            'empleadoget' => $empleadoget->get()->first(),
        ]);
    }

    public function callAlert($tipo, $mensaje, $bool, $test = "")

    {

        $this->alert($tipo, $mensaje, [

            'position' =>  'top-end',

            'timer' =>  2500,

            'toast' =>  true,

            'text' =>  $test,

            'confirmButtonText' =>  'Entendido',

            'cancelButtonText' =>  '',

            'showCancelButton' =>  false,

            'showConfirmButton' =>  $bool,

        ]);
    }
}
