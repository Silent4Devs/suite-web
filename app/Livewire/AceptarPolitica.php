<?php

namespace App\Livewire;

use App\Models\AceptoPolitica;
use App\Models\User;
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
        $usuario = User::getCurrentUser();
        if (AceptoPolitica::where('id_empleado', $usuario->empleado->id)->where('id_politica', $this->id_politica)->first()) {
            $this->acepto_politica = AceptoPolitica::where('id_empleado', $usuario->empleado->id)->where('id_politica', $this->id_politica)->first()->acepto;
        } else {
            $this->acepto_politica = false;
        }

        return view('livewire.aceptar-politica');
    }

    public function aceptar($id_politica)
    {
        $aceptar = AceptoPolitica::updateOrCreate([
            'id_politica' => $id_politica,
            'id_empleado' => User::getCurrentUser()->empleado->id,
        ], ['aceptado' => true]);
    }
}
