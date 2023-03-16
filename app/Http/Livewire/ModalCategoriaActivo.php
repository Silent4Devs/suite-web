<?php

namespace App\Http\Livewire;

use App\Models\RH\TipoObjetivo;
use Carbon\Carbon;
use Livewire\Component;

class ModalCategoriaActivo extends Component
{
    public function save()
    {
        $tipo = TipoObjetivo::create([
            'tipo' => $this->tipo,
            'created_at' => Carbon::now(),
        ]);

        $this->emit('tipoObjetivoStore');
        $this->emit('render-tipo-objetivo-select');
    }

    public function render()
    {
        return view('livewire.modal-categoria-activo');
    }
}
