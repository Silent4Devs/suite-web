<?php

namespace App\Http\Livewire;

use App\Models\ContractManager\Contrato;
use Livewire\Component;

class EditTablaContratos extends Component
{
    public $contratos;

    public $contrato;

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
        return view('livewire.edit-tabla-contratos');
    }

    public function updatedContratoAmpliado()
    {
        $this->contratos->update(['contrato_ampliado' => $this->contrato_ampliado]);
    }

    public function updatedConvenioModificatorio()
    {
        $this->contratos->update(['convenio_modificatorio' => $this->convenio_modificatorio]);
    }
}