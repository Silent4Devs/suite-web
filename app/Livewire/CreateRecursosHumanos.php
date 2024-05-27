<?php

namespace App\Livewire;

use App\Models\CuestionarioRecursosHumanos;
use Livewire\Component;

class CreateRecursosHumanos extends Component
{
    public $miembroID;

    public $empresa;

    public $nombre;

    public $a_paterno;

    public $a_materno;

    public $puesto;

    public $rol;

    public $tel;

    public $correo;

    public $escenario;

    public $cuestionario_id;

    public $view = 'create';

    protected $listeners = ['editarRecursos' => 'edit', 'eliminarRecursos' => 'destroy'];

    public function validarMiembro()
    {
        $this->validate([
            'escenario' => 'required',
            'empresa' => 'required|max:70',
            'nombre' => 'required|max:50',
            'a_paterno' => 'required|max:15',
            'a_materno' => 'required|max:15',
            'puesto' => 'required|max:60',
            'rol' => 'required|max:30',
            'tel' => 'required|max:16',
            'correo' => 'required|max:40',
        ]);
    }

    public function createRecursos()
    {
        $this->default();
        $this->dispatch('abrir-modal-recursos');
    }

    public function saveRecursos()
    {
        $this->validarMiembro();
        $model = CuestionarioRecursosHumanos::create([
            'escenario' => $this->escenario,
            'empresa' => $this->empresa,
            'nombre' => $this->nombre,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'puesto' => $this->puesto,
            'rol' => $this->rol,
            'tel' => $this->tel,
            'correo' => $this->correo,
            'cuestionario_id' => $this->cuestionario_id,
        ]);

        $this->reset('id', 'escenario', 'nombre', 'a_paterno', 'a_materno', 'puesto', 'rol', 'tel', 'correo');
        $this->dispatch('render');
        $this->dispatch('cerrar-modal-recursos', editarRecursos: false);
    }

    public function edit($id)
    {
        $this->view = 'editRecursos';
        $model = CuestionarioRecursosHumanos::find($id);
        $this->miembroID = $model->id;
        $this->escenario = $model->escenario;
        $this->empresa = $model->empresa;
        $this->nombre = $model->nombre;
        $this->a_paterno = $model->a_paterno;
        $this->a_materno = $model->a_materno;
        $this->puesto = $model->puesto;
        $this->rol = $model->rol;
        $this->tel = $model->tel;
        $this->correo = $model->correo;

        $this->cuestionario_id = $model->cuestionario_id;
        $this->dispatch('abrir-modal-recursos');
    }

    public function default()
    {
        $this->escenario = '';
        $this->empresa = '';
        $this->nombre = '';
        $this->a_paterno = '';
        $this->a_materno = '';
        $this->puesto = '';
        $this->rol = '';
        $this->tel = '';
        $this->correo = '';
        $this->view = 'create';
    }

    public function updateRecursos()
    {
        $this->validarMiembro();
        $model = CuestionarioRecursosHumanos::find($this->miembroID);
        $model->update([
            'escenario' => $this->escenario,
            'empresa' => $this->empresa,
            'nombre' => $this->nombre,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'puesto' => $this->puesto,
            'rol' => $this->rol,
            'tel' => $this->tel,
            'correo' => $this->correo,
            'cuestionario_id' => $this->cuestionario_id,
        ]);
        $this->dispatch('cerrar-modal-recursos', editar: true);
        $this->default();
        $this->dispatch('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioRecursosHumanos::find($id);
        $model->delete();
        $this->dispatch('render');
    }

    public function render()
    {
        return view('livewire.create-recursos-humanos');
    }
}
