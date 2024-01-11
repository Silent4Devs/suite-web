<?php

namespace App\Http\Livewire;

use App\Models\AceptarAlcance as ModelsAceptarAlcance;
use App\Models\User;
use Livewire\Component;

class AceptarAlcance extends Component
{
    public $id_alcance;

    public $acepto_alcance;

    public function mount($id_alcance)
    {
        $this->id_alcance = $id_alcance;
    }

    public function render()
    {
        $usuario = User::getCurrentUser();
        if (ModelsAceptarAlcance::where('id_empleado', $usuario->empleado->id)->where('id_alcance', $this->id_alcance)->first()) {
            $this->acepto_alcance = ModelsAceptarAlcance::where('id_empleado', $usuario->empleado->id)->where('id_alcance', $this->id_alcance)->first()->acepto;
        } else {
            $this->acepto_alcance = false;
        }

        return view('livewire.aceptar-alcance');
    }

    public function aceptar($id_alcance)
    {
        $aceptar = ModelsAceptarAlcance::updateOrCreate([
            'id_alcance' => $id_alcance,
            'id_empleado' => User::getCurrentUser()->empleado->id,
        ], ['aceptado' => true]);
    }
}
