<?php

namespace App\Http\Livewire;

use App\Models\MiembrosComiteSeguridad;
use Livewire\Component;

class ShowMiembrosComiteSeguridad extends Component
{
    public $id_comite;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = MiembrosComiteSeguridad::where('comite_id', '=', $this->id_comite)->get();

        return view('livewire.show-miembros-comite-seguridad', compact('datas'));
    }
}
