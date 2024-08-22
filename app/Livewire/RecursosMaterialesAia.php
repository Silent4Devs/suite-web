<?php

namespace App\Livewire;

use App\Models\CuestionarioRecursosMaterialesAIA;
use Livewire\Component;

class RecursosMaterialesAia extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = CuestionarioRecursosMaterialesAIA::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.recursos-materiales-aia', compact('datas'));
    }
}
