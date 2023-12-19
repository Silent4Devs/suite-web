<?php

namespace App\Http\Livewire;

use App\Models\FortalezasEntendimientoOrganizacion;
use Livewire\Component;

class FortalezasComponent extends Component
{
    public $foda_id;

    public $fortaleza;

    public $riesgo;

    public $nombre;

    public $view = 'create';

    public $fortaleza_id;

    protected $rules = [
        'fortaleza' => 'required',
    ];

    protected $listeners = ['destroy'];

    public function mount($foda_id)
    {
        $this->foda_id = $foda_id;
    }

    public function render()
    {
        $fortalezas = FortalezasEntendimientoOrganizacion::where('foda_id', $this->foda_id)->orderBy('id')->get();

        return view('livewire.fortalezas-component', compact('fortalezas'));
    }

    public function destroy($id)
    {
        FortalezasEntendimientoOrganizacion::destroy($id);
    }

    public function save()
    {
        $this->validate();
        FortalezasEntendimientoOrganizacion::create([
            'foda_id' => $this->foda_id,
            'fortaleza' => $this->fortaleza,
            'riesgo' => $this->riesgo,
        ]);

        // dd($fort);

        $this->emit('recargar-fortalezas');
        $this->default();
    }

    public function edit($id)
    {
        $fortalezaEncontrada = FortalezasEntendimientoOrganizacion::find($id);

        $this->fortaleza_id = $fortalezaEncontrada->id;
        $this->foda_id = $fortalezaEncontrada->foda_id;
        $this->fortaleza = $fortalezaEncontrada->fortaleza;
        $this->riesgo = $fortalezaEncontrada->riesgo;
        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate();
        $fortalezaEncontrada = FortalezasEntendimientoOrganizacion::find($this->fortaleza_id);
        // dd($this->fortaleza_id);
        $fortalezaEncontrada->update([
            'foda_id' => $this->foda_id,
            'fortaleza' => $this->fortaleza,
            'riesgo' => $this->riesgo,
        ]);

        $this->default();
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function default()
    {
        $this->fortaleza = '';
        $this->riesgo = '';
        $this->dispatchBrowserEvent('contentChanged');
        $this->view = 'create';
    }

}
