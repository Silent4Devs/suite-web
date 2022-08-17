<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioRecibeInformacion;
use Livewire\Component;

class CreateRecibeInformacion extends Component
{
    
    public $miembroID;
    public $nombre;
    public $puesto;
    public $correo_electronico;
    public $extencion;
    public $ubicacion;
    public $cuestionario_id;

    public $id_interesado;
    public $parteInteresadaIdEN;
    public $view = 'create';
    public $normasModel = [];
    protected $listeners = ['editarFuenteInformacionRecibe' => 'editRecibe', 'eliminarFuenteInformacionRecibe' => 'destroy'];

  

    public function validarMiembro()
    {
        $this->validate([
            'nombre' => 'required|max:1250',
            'puesto' => 'required|max:1250',
            'correo_electronico' => 'required|max:1250',
        ]);
    }

    public function createRecibe()
    {
        $this->default();
        $this->emit('abrir-modal-recibe');
    }

    public function saveRecibe()
    {
        $this->validarMiembro();
        $model = CuestionarioRecibeInformacion::create([
        'nombre'=> $this->nombre,
        'puesto'=> $this->puesto,
        'correo_electronico'=> $this->correo_electronico,
        'extencion'=> $this->extencion,
        'ubicacion'=> $this->ubicacion,
        'cuestionario_id' => $this->cuestionario_id,
        ]);

        $this->reset('id','nombre','puesto','correo_electronico','extencion','ubicacion',);
        $this->emit('render');
        $this->emit('cerrar-modal-recibe', ['editarRecibe' => false]);
    }

    public function editRecibe($id)
    {
        $this->view = 'editRecibe';
        $model = CuestionarioRecibeInformacion::find($id);
        $this->miembroID = $model->id;
        $this->nombre = $model->nombre;
        $this->puesto = $model->puesto;
        $this->correo_electronico = $model->correo_electronico;
        $this->extencion = $model->extencion;
        $this->ubicacion = $model->ubicacion;
        $this->cuestionario_id = $model->cuestionario_id;
        $this->emit('abrir-modal-recibe');

    }

    public function default()
    {
        $this->nombre = '';
        $this->puesto = '';
        $this->correo_electronico = '';
        $this->extencion = '';
        $this->ubicacion = '';

        $this->view = 'create';
    }

    public function updateRecibe()
    {
        $this->validarMiembro();
        $model = CuestionarioRecibeInformacion::find($this->miembroID);
        $model->update([
            'nombre'=> $this->nombre,
            'puesto'=> $this->puesto,
            'correo_electronico'=> $this->correo_electronico,
            'extencion'=> $this->extencion,
            'ubicacion'=> $this->ubicacion,
            'cuestionario_id' => $this->cuestionario_id,
        ]);
        $this->emit('cerrar-modal-recibe', ['editar' => true]);
        $this->default();
        $this->emit('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioRecibeInformacion::find($id);
        $model->delete();
        $this->emit('render');
    }
    public function render()
    {
        return view('livewire.create-recibe-informacion');
    }
}
