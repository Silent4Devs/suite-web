<?php

namespace App\Livewire;

use App\Models\OportunidadesEntendimientoOrganizacion;
use Livewire\Component;

class OportunidadesComponent extends Component
{
    public $foda_id;

    public $oportunidad;

    public $riesgo;

    public $nombre;

    public $view = 'create';

    protected $rules = [
        'oportunidad' => 'required',
    ];

    protected $listeners = ['destroy'];

    public function mount($foda_id)
    {
        $this->foda_id = $foda_id;
    }

    public function render()
    {
        $oportunidades = OportunidadesEntendimientoOrganizacion::where('foda_id', $this->foda_id)->orderBy('id')->get();

        return view('livewire.oportunidades-component', compact('oportunidades'));
    }

    public function destroy($id)
    {
        OportunidadesEntendimientoOrganizacion::destroy($id);
    }

    public function save()
    {
        $this->validate();
        OportunidadesEntendimientoOrganizacion::create([
            'foda_id' => $this->foda_id,
            'oportunidad' => $this->oportunidad,
            'riesgo' => $this->riesgo,
        ]);

        // dd($fort);

        $this->dispatch('recargar-oportunidades');
        $this->default();
    }

    public function edit($id)
    {
        $oportunidadEncontrada = OportunidadesEntendimientoOrganizacion::find($id);

        $this->oportunidad_id = $oportunidadEncontrada->id;
        $this->foda_id = $oportunidadEncontrada->foda_id;
        $this->oportunidad = $oportunidadEncontrada->oportunidad;
        $this->riesgo = $oportunidadEncontrada->riesgo;
        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate();
        $oportunidadEncontrada = OportunidadesEntendimientoOrganizacion::find($this->oportunidad_id);
        // dd($this->fortaleza_id);
        $oportunidadEncontrada->update([
            'foda_id' => $this->foda_id,
            'oportunidad' => $this->oportunidad,
            'riesgo' => $this->riesgo,
        ]);

        $this->default();
        $this->dispatch('contentChanged');
    }

    public function default()
    {
        $this->oportunidad = '';
        $this->riesgo = '';
        $this->dispatch('contentChanged');
        $this->view = 'create';
    }
}
