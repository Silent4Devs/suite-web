<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioProporcionaInformacionAIA;
use Livewire\Component;

class CreateProporcionaInformacionAia extends Component
{
    public $miembroID;

    public $nombre;

    public $puesto;

    public $correo_electronico;

    public $extencion;

    public $ubicacion;

    public $cuestionario_id;

    public $interno_externo;

    public $id_interesado;

    public $parteInteresadaIdEN;

    public $view = 'create';

    public $normasModel = [];

    protected $listeners = ['editarFuenteInformacionAia' => 'edit', 'eliminarFuenteInformacionAia' => 'destroy'];

    public function validarMiembro()
    {
        $this->validate([
            'nombre' => 'required|max:50',
            'puesto' => 'required|max:100',
            'correo_electronico' => 'required|max:50',
            'interno_externo' => 'required|int',
            'extencion' => 'max:5',
        ]);
    }

    public function create()
    {
        $this->default();
        $this->emit('abrir-modal');
    }

    public function save()
    {
        $this->validarMiembro();
        $extencion = $this->extencion == '' ? 0 : $this->extencion;
        $model = CuestionarioProporcionaInformacionAIA::create([
            'nombre' => $this->nombre,
            'puesto' => $this->puesto,
            'correo_electronico' => $this->correo_electronico,
            'extencion' => $extencion,
            'ubicacion' => $this->ubicacion,
            'cuestionario_id' => $this->cuestionario_id,
            'interno_externo' => $this->interno_externo,
        ]);

        $this->reset('id', 'nombre', 'puesto', 'correo_electronico', 'extencion', 'ubicacion', 'interno_externo');
        $this->emit('render');
        $this->emit('cerrar-modal', ['editar' => false]);
    }

    public function edit($id)
    {
        $this->view = 'edit';
        $model = CuestionarioProporcionaInformacionAIA::find($id);
        $this->miembroID = $model->id;
        $this->nombre = $model->nombre;
        $this->puesto = $model->puesto;
        $this->correo_electronico = $model->correo_electronico;
        $this->extencion = $model->extencion;
        $this->ubicacion = $model->ubicacion;
        $this->cuestionario_id = $model->cuestionario_id;
        $this->interno_externo = $model->interno_externo;
        $this->emit('abrir-modal');
    }

    public function default()
    {
        $this->nombre = '';
        $this->puesto = '';
        $this->correo_electronico = '';
        $this->extencion = '';
        $this->ubicacion = '';
        $this->interno_externo = '';

        $this->view = 'create';
    }

    public function update()
    {
        $this->validarMiembro();
        $model = CuestionarioProporcionaInformacionAIA::find($this->miembroID);
        $extencion = $this->extencion == '' ? 0 : $this->extencion;
        $model->update([
            'nombre' => $this->nombre,
            'puesto' => $this->puesto,
            'correo_electronico' => $this->correo_electronico,
            'extencion' => $extencion,
            'ubicacion' => $this->ubicacion,
            'cuestionario_id' => $this->cuestionario_id,
            'interno_externo' => $this->interno_externo,
        ]);
        $this->emit('cerrar-modal', ['editar' => true]);
        $this->default();
        $this->emit('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioProporcionaInformacionAIA::find($id);
        $model->delete();
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.create-proporciona-informacion-aia');
    }
}
