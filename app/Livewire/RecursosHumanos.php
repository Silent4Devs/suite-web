<?php

namespace App\Livewire;

use App\Models\CuestionarioRecursosHumanos;
use Livewire\Component;

class RecursosHumanos extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = CuestionarioRecursosHumanos::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.recursos-humanos', compact('datas'));
    }
}
