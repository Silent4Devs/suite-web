<?php

namespace App\Http\Livewire;

use App\Models\Norma;
use App\Models\ParteInteresadaExpectativaNecesidad;
use Livewire\Component;

class CreatePartesInteresadas extends Component
{
    public $expectativas;

    public $necesidades;

    public $id_interesado;

    public $parteInteresadaIdEN;

    public $view = 'create';

    public $normasModel = [];

    protected $listeners = ['editarParteInteresada' => 'edit', 'eliminarParteInteresada' => 'destroy', 'agregarNormas'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function validarParteInteresada()
    {
        $this->validate([
            'necesidades' => 'required|max:1250',
            'expectativas' => 'required|max:1250',
        ]);
    }

    public function create()
    {
        $this->default();
        $this->emit('abrir-modal');
    }

    public function save()
    {
        $this->validarParteInteresada();
        $model = ParteInteresadaExpectativaNecesidad::create([
            'necesidades' => $this->necesidades,
            'expectativas' => $this->expectativas,
            'id_interesada' => $this->id_interesado,
        ]);
        $model->normas()->sync($this->normasModel);
        $this->reset('necesidades', 'expectativas');
        $this->emit('render');
        $this->emit('cerrar-modal', ['editar' => false]);
    }

    public function edit($id)
    {
        $this->view = 'edit';
        $model = ParteInteresadaExpectativaNecesidad::with('normas')->find($id);
        $this->normasModel = $model->normas->pluck('id')->toArray();
        $this->necesidades = $model->necesidades;
        $this->expectativas = $model->expectativas;
        $this->id_interesado = $model->id_interesada;
        $this->parteInteresadaIdEN = $model->id;
        $this->emit('abrir-modal');
    }

    public function default()
    {
        $this->necesidades = '';
        $this->expectativas = '';
        $this->normasModel = [];
        $this->view = 'create';
    }

    public function update()
    {
        $this->validarParteInteresada();
        $model = ParteInteresadaExpectativaNecesidad::find($this->parteInteresadaIdEN);
        $model->update([
            'necesidades' => $this->necesidades,
            'expectativas' => $this->expectativas,
            'id_interesada' => $this->id_interesado,
        ]);
        $model->normas()->sync($this->normasModel);
        $this->emit('cerrar-modal', ['editar' => true]);
        $this->default();
        $this->emit('render');
    }

    public function destroy($id)
    {
        $model = ParteInteresadaExpectativaNecesidad::find($id);
        $model->delete();
        $this->emit('render');
    }

    public function agregarNormas($id)
    {
        $this->parteInteresadaIdEN = $id;
        $model = ParteInteresadaExpectativaNecesidad::with('normas')->find($id);
        $this->normasModel = $model->normas->pluck('id')->toArray();

        $this->emit('abrirModalPartesInteresadas');
    }

    public function saveNorma($id)
    {
        $model = ParteInteresadaExpectativaNecesidad::with('normas')->find($this->parteInteresadaIdEN);
        $model->normas()->sync($this->normasModel);
        $this->emit('cerrarModalPartesInteresadas');
        $this->emit('render');
        $this->normasModel = [];
    }

    public function render()
    {
        $normas = Norma::all();

        return view('livewire.create-partes-interesadas', compact('normas'));
    }
}
