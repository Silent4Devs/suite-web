<?php

namespace App\Livewire;

use App\Models\CuestionarioInfraestructuraTecnologica;
use Livewire\Component;

class CreateInfraestructuraTecnologica extends Component
{
    public $miembroID;

    public $sistemas;

    public $aplicativos;

    public $base_datos;

    public $otro;

    public $escenario;

    public $cuestionario_id;

    public $id_interesado;

    public $parteInteresadaIdEN;

    public $view = 'create';

    public $normasModel = [];

    protected $listeners = ['editarInfraestructura' => 'editInfraestructura', 'eliminarInfraestructura' => 'destroy'];

    public function validarTecnologia()
    {
        $this->validate([
            'escenario' => 'required',
            'sistemas' => 'max:100',
            'aplicativos' => 'max:100',
            'base_datos' => 'max:100',
            'otro' => 'max:100',
        ]);
    }

    public function createInfraestructura()
    {
        $this->default();
        $this->dispatch('abrir-modal-infraestructura');
    }

    public function saveInfraestructura()
    {
        $this->validarTecnologia();
        $model = CuestionarioInfraestructuraTecnologica::create([
            'sistemas' => $this->sistemas,
            'aplicativos' => $this->aplicativos,
            'base_datos' => $this->base_datos,
            'otro' => $this->otro,
            'escenario' => $this->escenario,
            'cuestionario_id' => $this->cuestionario_id,
        ]);

        $this->reset('id', 'sistemas', 'aplicativos', 'base_datos', 'otro', 'escenario');
        $this->dispatch('render');
        $this->dispatch('cerrar-modal-infraestructura', editarInfraestructura: false);
    }

    public function editInfraestructura($id)
    {
        $this->view = 'editRecibe';
        $model = CuestionarioInfraestructuraTecnologica::find($id);
        $this->miembroID = $model->id;
        $this->sistemas = $model->sistemas;
        $this->aplicativos = $model->aplicativos;
        $this->base_datos = $model->base_datos;
        $this->otro = $model->otro;
        $this->escenario = $model->escenario;
        $this->cuestionario_id = $model->cuestionario_id;
        $this->dispatch('abrir-modal-infraestructura');
    }

    public function default()
    {
        $this->sistemas = '';
        $this->aplicativos = '';
        $this->base_datos = '';
        $this->otro = '';
        $this->escenario = '';

        $this->view = 'create';
    }

    public function updateInfraestructura()
    {
        $this->validarTecnologia();
        $model = CuestionarioInfraestructuraTecnologica::find($this->miembroID);
        $model->update([
            'sistemas' => $this->sistemas,
            'aplicativos' => $this->aplicativos,
            'base_datos' => $this->base_datos,
            'otro' => $this->otro,
            'escenario' => $this->escenario,
            'cuestionario_id' => $this->cuestionario_id,
        ]);
        $this->dispatch('cerrar-modal-infraestructura', editarInfraestructura: true);
        $this->default();
        $this->dispatch('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioInfraestructuraTecnologica::find($id);
        $model->delete();
        $this->dispatch('render');
    }

    public function render()
    {
        return view('livewire.create-infraestructura-tecnologica');
    }
}
