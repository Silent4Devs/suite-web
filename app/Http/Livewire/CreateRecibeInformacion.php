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

    public $interno_externo;

    public $id_interesado;

    public $view = 'create';

    protected $listeners = ['editarFuenteInformacionRecibe' => 'editRecibe', 'eliminarFuenteInformacionRecibe' => 'destroy'];

    public function validarMiembro()
    {
        $this->validate([
            'nombre' => 'required|max:50',
            'puesto' => 'required|max:75',
            'correo_electronico' => 'required|max:50',
            'extencion' => 'max:16',
            'ubicacion' => 'max:150',
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
        $extencion = $this->extencion == '' ? 0 : $this->extencion;
        $model = CuestionarioRecibeInformacion::create([
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
        $this->interno_externo = $model->interno_externo;
        $this->emit('abrir-modal-recibe');
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

    public function updateRecibe()
    {
        $this->validarMiembro();
        $model = CuestionarioRecibeInformacion::find($this->miembroID);
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
