<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class BuscarCVComponent extends Component
{
    use LivewireAlert;

    public $areas;
    public $empleado_id = '';
    public $area_id = '';
    public $empleado_experiencia;
    public $empleado_educacion;
    public $empleado_certificaciones;
    public $empleado_cursos;
    public $foto_organizacion;
    public $empleados;
    public $isPersonal;

    public function clean()
    {
        $this->empleado_id = '';
        $this->area_id = '';
        $this->empleados = Empleado::select('id', 'area_id', 'name')->get();
        //$this->conteo = '';
        $this->callAlert('info', 'Los filtros se han restablecido', true, 'La información volvio a su estado original');
    }

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
        if (!$this->isPersonal) {
            $this->empleados = Empleado::select('id', 'area_id', 'name')->get();
        }
    }

    public function render()
    {
        $empleadoget = Empleado::select('*')->with('empleado_experiencia');

        if (!$this->isPersonal) {
            if ($this->area_id != '') {
                if (Empleado::where('area_id', '=', $this->area_id)->count() > 0) {
                    $this->empleados = Empleado::where('area_id', '=', $this->area_id)->get();
                    $this->callAlert('success', 'La información se actualizo correctamente', true);
                } else {
                    $this->callAlert('warning', 'No se encontro registro con esta area', false, 'las opciones de busqueda se restablecieron');
                    $this->area_id = '';
                    $this->empleado_id = '';
                    $this->empleados = Empleado::select('id', 'area_id', 'name')->get();
                }
            }
        }
        if ($this->empleado_id != '') {
            if (Empleado::where('id', '=', $this->empleado_id)->count() > 0) {
                $empleadoget->where('id', '=', $this->empleado_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con este empleado', false, 'las opciones de busqueda se restablecieron');
                $this->empleado_id = '';
                $this->empleados = Empleado::select('id', 'area_id', 'name')->get();
            }
        }

        return view('livewire.buscar-c-v-component', [
            'empleadoget' => $empleadoget->get()->first(),
        ]);
    }

    public function callAlert($tipo, $mensaje, $bool, $test = '')
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
