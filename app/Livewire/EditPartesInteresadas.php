<?php

namespace App\Livewire;

use App\Models\ParteInteresadaExpectativaNecesidad;
use Livewire\Component;

class EditPartesInteresadas extends Component
{
    public $id_requisito;

    public function edit($id)
    {
        $id_requisito = ParteInteresadaExpectativaNecesidad::find($id);

        return $this->id_requisito;
    }

    public function render()
    {
        return view('livewire.edit-partes-interesadas');
    }
}
