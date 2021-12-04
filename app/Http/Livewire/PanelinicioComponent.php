<?php

namespace App\Http\Livewire;
use Jantinnerezo\LivewireAlert\LivewireAlert;


use Livewire\Component;

class PanelinicioComponent extends Component
{
    use LivewireAlert;

    public $nombre_id, $nempleado_id, $area_id, $jefe_id, $puesto_id, $perfil_id;

    public function render()
    {
        return view('livewire.panelinicio-component');
    }

    public function updatedNombreId($value)
    {
        $this->nombre_id = $value;
    }

    public function updatedNempleadoId($value)
    {
        $this->nempleado_id = $value;
    }

    public function updatedAreaId($value)
    {
        $this->area_id = $value;
    }

    public function updatedJefeId($value)
    {
        $this->jefe_id = $value;
    }

    public function updatedPuestoId($value)
    {
        $this->puesto_id = $value;
    }

    public function updatedPerfilId($value)
    {
        $this->perfil_id = $value;
    }

}
