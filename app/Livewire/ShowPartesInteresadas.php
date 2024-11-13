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

    public function editarParteInteresada($id)
    {
        $this->view = 'edit';
        $model = ParteInteresadaExpectativaNecesidad::with('normas')->find($id);
        $this->normasModel = $model->normas->pluck('id')->toArray();
        $this->necesidades = $model->necesidades;
        $this->expectativas = $model->expectativas;
        $this->id_interesado = $model->id_interesada;
        $this->parteInteresadaIdEN = $model->id;
        $this->dispatch('abrir-modal');
    }

    public function eliminarParteInteresada($id)
    {
        $model = ParteInteresadaExpectativaNecesidad::find($id);
        $model->delete();
        $this->dispatch('render');
    }
}
