<?php

namespace App\Livewire;

use App\Models\ParteInteresadaExpectativaNecesidad;
use Livewire\Component;

class ShowPartesInteresadas extends Component
{
    public $id_interesado;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = ParteInteresadaExpectativaNecesidad::with('normas')->where('id_interesada', '=', $this->id_interesado)->get();

        return view('livewire.show-partes-interesadas', compact('datas'));
    }
}
