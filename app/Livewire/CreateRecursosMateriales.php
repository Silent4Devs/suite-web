<?php

namespace App\Livewire;

use App\Models\CuestionarioRecursosMateriales;
use Livewire\Component;

class CreateRecursosMateriales extends Component
{
    public $recursoID;

    public $equipos;

    public $impresoras;

    public $telefono;

    public $otro;

    public $escenario;

    public $cuestionario_id;

    public $view = 'create';

    protected $listeners = ['editarMateriales' => 'edit', 'eliminarMateriales' => 'destroy'];

    public function validarMaterial()
    {
        $this->validate([
            'escenario' => 'required',
            'equipos' => 'max:999|int',
            'impresoras' => 'max:999|int',
            'telefono' => 'max:999|int',
            'otro' => 'max:999|int',
        ]);
    }

    public function createMateriales()
    {
        $this->default();
        $this->dispatch('abrir-modal-materiales');
    }

    public function saveMateriales()
    {
        $this->validarMaterial();
        $num_equipos = $this->equipos == '' ? 0 : $this->equipos;
        $num_impresoras = $this->impresoras == '' ? 0 : $this->impresoras;
        $num_telefonos = $this->telefono == '' ? 0 : $this->telefono;
        $model = CuestionarioRecursosMateriales::create([
            'escenario' => $this->escenario,
            'equipos' => $num_equipos,
            'impresoras' => $num_impresoras,
            'telefono' => $num_telefonos,
            'otro' => $this->otro,
            'cuestionario_id' => $this->cuestionario_id,
        ]);

        $this->reset('id', 'escenario', 'impresoras', 'telefono', 'otro', 'equipos');
        $this->dispatch('render');
        $this->dispatch('cerrar-modal-materiales', editarMateriales: false);
    }

    public function edit($id)
    {
        $this->view = 'editMateriales';
        $model = CuestionarioRecursosMateriales::find($id);
        $this->recursoID = $model->id;
        $this->escenario = $model->escenario;
        $this->equipos = $model->equipos;
        $this->impresoras = $model->impresoras;
        $this->telefono = $model->telefono;
        $this->otro = $model->otro;

        $this->cuestionario_id = $model->cuestionario_id;
        $this->dispatch('abrir-modal-materiales');
    }

    public function default()
    {
        $this->escenario = '';
        $this->equipos = '';
        $this->impresoras = '';
        $this->telefono = '';
        $this->otro = '';

        $this->view = 'create';
    }

    public function updateMateriales()
    {
        $this->validarMaterial();
        $model = CuestionarioRecursosMateriales::find($this->recursoID);
        $num_equipos = $this->equipos == '' ? 0 : $this->equipos;
        $num_impresoras = $this->impresoras == '' ? 0 : $this->impresoras;
        $num_telefonos = $this->telefono == '' ? 0 : $this->telefono;
        $model->update([
            'escenario' => $this->escenario,
            'equipos' => $num_equipos,
            'impresoras' => $num_impresoras,
            'telefono' => $num_telefonos,
            'otro' => $this->otro,
            'cuestionario_id' => $this->cuestionario_id,
        ]);
        $this->dispatch('cerrar-modal-materiales', editar: true);
        $this->default();
        $this->dispatch('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioRecursosMateriales::find($id);
        $model->delete();
        $this->dispatch('render');
    }

    public function render()
    {
        return view('livewire.create-recursos-materiales');
    }
}
