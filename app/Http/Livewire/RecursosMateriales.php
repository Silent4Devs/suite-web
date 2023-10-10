<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioRecursosMateriales;
use Livewire\Component;

class RecursosMateriales extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = CuestionarioRecursosMateriales::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.recursos-materiales', compact('datas'));
    }
}
