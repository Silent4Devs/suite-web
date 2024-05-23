<?php

namespace App\Livewire;

use App\Models\LiberaMantenimientoAIA;
use Livewire\Component;

class CreateMantenimientoAia extends Component
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

    protected $listeners = ['editarMantenimiento' => 'edit', 'eliminarMantenimiento' => 'destroy'];

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
        $this->dispatch('abrir-modal-mantenimiento');
    }

    public function save()
    {
        $this->validarMiembro();
        $extencion = $this->extencion == '' ? 0 : $this->extencion;
        $model = LiberaMantenimientoAIA::create([
            'nombre' => $this->nombre,
            'puesto' => $this->puesto,
            'correo_electronico' => $this->correo_electronico,
            'extencion' => $extencion,
            'ubicacion' => $this->ubicacion,
            'cuestionario_id' => $this->cuestionario_id,
            'interno_externo' => $this->interno_externo,
        ]);

        $this->reset('id', 'nombre', 'puesto', 'correo_electronico', 'extencion', 'ubicacion', 'interno_externo');
        $this->dispatch('render');
        $this->dispatch('cerrar-modal-mantenimiento', editar: false);
    }

    public function edit($id)
    {
        $this->view = 'edit';
        $model = LiberaMantenimientoAIA::find($id);
        $this->miembroID = $model->id;
        $this->nombre = $model->nombre;
        $this->puesto = $model->puesto;
        $this->correo_electronico = $model->correo_electronico;
        $this->extencion = $model->extencion;
        $this->ubicacion = $model->ubicacion;
        $this->cuestionario_id = $model->cuestionario_id;
        $this->interno_externo = $model->interno_externo;
        $this->dispatch('abrir-modal-mantenimiento');
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
        $model = LiberaMantenimientoAIA::find($this->miembroID);
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
        $this->dispatch('cerrar-modal-mantenimiento', editar: true);
        $this->default();
        $this->dispatch('render');
    }

    public function destroy($id)
    {
        $model = LiberaMantenimientoAIA::find($id);
        $model->delete();
        $this->dispatch('render');
    }

    public function render()
    {
        return view('livewire.create-mantenimiento-aia');
    }
}
