<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioRecursosHumanosAIA;
use Livewire\Component;

class RecursosHumanosAia extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = CuestionarioRecursosHumanosAIA::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.recursos-humanos-aia', compact('datas'));
    }
}
