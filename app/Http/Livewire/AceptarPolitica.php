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
        if (AceptoPolitica::where('id_empleado', auth()->user()->empleado->id)->where('id_politica', $this->id_politica)->first()) {
            $this->acepto_politica = AceptoPolitica::where('id_empleado', auth()->user()->empleado->id)->where('id_politica', $this->id_politica)->first()->acepto;
        } else {
            $this->acepto_politica = false;
        }

        return view('livewire.aceptar-politica');
    }

    public function aceptar($id_politica)
    {
        $aceptar = AceptoPolitica::updateOrCreate([
            'id_politica' => $id_politica,
            'id_empleado' => auth()->user()->empleado->id,
        ], ['aceptado' => true]);
    }
}
