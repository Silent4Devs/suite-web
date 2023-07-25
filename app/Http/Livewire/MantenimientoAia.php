<?php

namespace App\Http\Livewire;

use App\Models\LiberaMantenimientoAIA;
use Livewire\Component;

class MantenimientoAia extends Component
{
    public $cuestionario_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = LiberaMantenimientoAIA::where('cuestionario_id', '=', $this->cuestionario_id)->get();

        return view('livewire.mantenimiento-aia', compact('datas'));
    }
}
