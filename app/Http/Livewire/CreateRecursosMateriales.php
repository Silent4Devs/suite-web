<?php

namespace App\Http\Livewire;

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
            // 'equipos' => 'required|max:50',
            // 'impresoras' => 'required|max:50',
            // 'telefono' => 'required|max:15',
            // 'otro' => 'required|max:15',
        ]);
    }

    public function createMateriales()
    {
        $this->default();
        $this->emit('abrir-modal-materiales');
    }

    public function saveMateriales()
    {
        $this->validarMaterial();
        $model = CuestionarioRecursosMateriales::create([
            'escenario' => $this->escenario,
            'equipos' => $this->equipos,
            'impresoras' => $this->impresoras,
            'telefono' => $this->telefono,
            'otro' => $this->otro,
            'cuestionario_id' => $this->cuestionario_id,
        ]);
        dd($model);
        $this->reset('id', 'escenario', 'impresoras', 'telefono', 'otro', 'equipos');
        $this->emit('render');
        $this->emit('cerrar-modal-materiales', ['editarMateriales' => false]);
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
        $this->emit('abrir-modal-materiales');
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
        $model->update([
            'escenario' => $this->escenario,
            'equipos' => $this->equipos,
            'impresoras' => $this->impresoras,
            'telefono' => $this->telefono,
            'otro' => $this->otro,
            'cuestionario_id' => $this->cuestionario_id,
        ]);
        $this->emit('cerrar-modal-materiales', ['editar' => true]);
        $this->default();
        $this->emit('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioRecursosMateriales::find($id);
        $model->delete();
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.create-recursos-materiales');
    }
}
