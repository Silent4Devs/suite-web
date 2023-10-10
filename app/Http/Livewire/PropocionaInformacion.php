<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioProporcionaInformacion;
use Livewire\Component;

class PropocionaInformacion extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = CuestionarioProporcionaInformacion::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.propociona-informacion', compact('datas'));
    }
}
