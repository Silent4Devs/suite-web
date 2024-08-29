<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioRecibeInformacion;
use Livewire\Component;

class RecibeInformacion extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $recibe = CuestionarioRecibeInformacion::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.recibe-informacion', compact('recibe'));
    }
}
