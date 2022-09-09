<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioProporcionaInformacion;
use Livewire\Component;

class CreatePropocionaInformacion extends Component
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
    protected $listeners = ['editarFuenteInformacion' => 'edit', 'eliminarFuenteInformacion' => 'destroy', 'agregarNormas'];

  

    public function validarMiembro()
    {
        $this->validate([
            'nombre' => 'required|max:1250',
            'puesto' => 'required|max:1250',
            'correo_electronico' => 'required|max:1250',
            'interno_externo' => 'required|int',
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
        $model = CuestionarioProporcionaInformacion::create([
        'nombre'=> $this->nombre,
        'puesto'=> $this->puesto,
        'correo_electronico'=> $this->correo_electronico,
        'extencion'=> $this->extencion,
        'ubicacion'=> $this->ubicacion,
        'cuestionario_id' => $this->cuestionario_id,
        'interno_externo' => $this->interno_externo,
        ]);

        $this->reset('id','nombre','puesto','correo_electronico','extencion','ubicacion','interno_externo');
        $this->emit('render');
        $this->emit('cerrar-modal', ['editar' => false]);
    }

    public function edit($id)
    {
        $this->view = 'edit';
        $model = CuestionarioProporcionaInformacion::find($id);
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
        $model = CuestionarioProporcionaInformacion::find($this->miembroID);
        $model->update([
            'nombre'=> $this->nombre,
            'puesto'=> $this->puesto,
            'correo_electronico'=> $this->correo_electronico,
            'extencion'=> $this->extencion,
            'ubicacion'=> $this->ubicacion,
            'cuestionario_id' => $this->cuestionario_id,
            'interno_externo' => $this->interno_externo,
        ]);
        $this->emit('cerrar-modal', ['editar' => true]);
        $this->default();
        $this->emit('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioProporcionaInformacion::find($id);
        $model->delete();
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.create-propociona-informacion');
    }
}
