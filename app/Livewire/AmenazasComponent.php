<?php

namespace App\Livewire;

use App\Models\AmenazasEntendimientoOrganizacion;
use Livewire\Component;

class AmenazasComponent extends Component
{
    public $foda_id;

    public $amenaza;

    public $riesgo;

    public $nombre;

    public $view = 'create';

    protected $rules = [
        'amenaza' => 'required',
    ];

    public function mount($foda_id)
    {
        $this->foda_id = $foda_id;
    }

    public function render()
    {
        $amenazas = AmenazasEntendimientoOrganizacion::where('foda_id', $this->foda_id)->orderBy('id')->get();

        return view('livewire.amenazas-component', compact('amenazas'));
    }

    public function destroy($id)
    {
        AmenazasEntendimientoOrganizacion::destroy($id);
    }

    public function save()
    {
        $this->validate();
        AmenazasEntendimientoOrganizacion::create([
            'foda_id' => $this->foda_id,
            'amenaza' => $this->amenaza,
            'riesgo' => $this->riesgo,
        ]);

        // dd($fort);

        $this->dispatch('recargar-amenazas');
        $this->default();
    }

    public function edit($id)
    {
        $amenazaEncontrada = AmenazasEntendimientoOrganizacion::find($id);

        $this->amenaza_id = $amenazaEncontrada->id;
        $this->foda_id = $amenazaEncontrada->foda_id;
        $this->amenaza = $amenazaEncontrada->amenaza;
        $this->riesgo = $amenazaEncontrada->riesgo;
        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate();
        $amenazaEncontrada = AmenazasEntendimientoOrganizacion::find($this->amenaza_id);
        $amenazaEncontrada->update([
            'foda_id' => $this->foda_id,
            'amenaza' => $this->amenaza,
            'riesgo' => $this->riesgo,
        ]);

        $this->default();
        $this->dispatch('contentChanged');
    }

    public function default()
    {
        $this->amenaza = '';
        $this->riesgo = '';
        $this->dispatch('contentChanged');
        $this->view = 'create';
    }
}
