<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalCumpleaños extends Component
{
    public $cumples_felicitados_comentarios;

    public $cumple_id;

    public function mount($cumples_felicitados_comentarios)
    {
        $this->cumples_felicitados_comentarios_contador = $cumples_felicitados_comentarios;
    }

    public function render()
    {
        return view('livewire.modal-cumpleaños');
    }
}
