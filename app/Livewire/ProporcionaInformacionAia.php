<?php

namespace App\Livewire;

use App\Models\CuestionarioProporcionaInformacionAIA;
use Livewire\Component;

class ProporcionaInformacionAia extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = CuestionarioProporcionaInformacionAIA::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.proporciona-informacion-aia', compact('datas'));
    }
}
