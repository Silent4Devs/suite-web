<?php

namespace App\Livewire;

use App\Models\ContractManager\Contrato;
use Livewire\Component;

class TablaContratos extends Component
{
    public $contratos;

    public $contrato_ampliado;

    public $convenio_modificatorio;

    public function mount($id_contrato)
    {
        $this->contratos = Contrato::where('id', $id_contrato)->first();

        $this->contrato_ampliado = $this->contratos->contrato_ampliado;
        $this->convenio_modificatorio = $this->contratos->convenio_modificatorio;
    }

    public function render()
    {
        return view('livewire.tabla-contratos');
    }

    public function cambioContratoAmpliado()
    {
        $this->contratos->update(['contrato_ampliado' => $this->contrato_ampliado]);
    }

    public function cambioConvenioModificatorio()
    {
        $this->contratos->update(['convenio_modificatorio' => $this->convenio_modificatorio]);
    }
}
