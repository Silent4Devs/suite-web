<?php

namespace App\Http\Livewire;

use App\Models\AceptoPolitica;
use Livewire\Component;

class AceptarPolitica extends Component
{
    public $id_politica;
    public $acepto_politica;

    public function mount($id_politica)
    {
        $this->id_politica = $id_politica;
    }

    public function render()
    {
        $this->acepto_politica = AceptoPolitica::where('id_empleado', auth()->user()->empleado->id)->where('acepto', true)->count();

        return view('livewire.aceptar-politica');
    }

    public function aceptar($id_politica)
    {
        $aceptar = AceptoPolitica::create([
            'id_politica' => $id_politica,
            'id_empleado' => auth()->user()->empleado->id,
        ]);
    }
}
