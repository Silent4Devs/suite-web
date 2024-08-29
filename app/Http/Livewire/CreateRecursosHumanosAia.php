<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioRecursosHumanosAIA;
use Livewire\Component;

class CreateRecursosHumanosAia extends Component
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
            'empresa' => 'required|max:256',
            'nombre' => 'required|max:256',
            'a_paterno' => 'required|max:256',
            'a_materno' => 'required|max:256',
            'puesto' => 'required|max:256',
            'rol' => 'required|max:256',
            'tel' => 'required|max:8',
            'correo' => 'required|max:256',
        ]);
    }

    public function createRecursos()
    {
        $this->default();
        $this->emit('abrir-modal-recursos');
    }

    public function saveRecursos()
    {
        $this->validarMiembro();
        $model = CuestionarioRecursosHumanosAIA::create([
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
        $this->emit('render');
        $this->emit('cerrar-modal-recursos', ['editarRecursos' => false]);
    }

    public function edit($id)
    {
        $this->view = 'editRecursos';
        $model = CuestionarioRecursosHumanosAIA::find($id);
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
        $this->emit('abrir-modal-recursos');
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
        $model = CuestionarioRecursosHumanosAIA::find($this->miembroID);
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
        $this->emit('cerrar-modal-recursos', ['editar' => true]);
        $this->default();
        $this->emit('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioRecursosHumanosAIA::find($id);
        $model->delete();
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.create-recursos-humanos-aia');
    }
}
