<?php

namespace App\Livewire;

use App\Models\DebilidadesEntendimientoOrganizacion;
use Livewire\Component;

class DebilidadesComponent extends Component
{
    public $foda_id;

    public $debilidad;

    public $riesgo;

    public $nombre;

    public $view = 'create';

    protected $rules = [
        'debilidad' => 'required',
    ];

    public function mount($foda_id)
    {
        $this->foda_id = $foda_id;
    }

    public function render()
    {
        $debilidades = DebilidadesEntendimientoOrganizacion::where('foda_id', $this->foda_id)->orderBy('id')->get();

        return view('livewire.debilidades-component', compact('debilidades'));
    }

    public function destroy($id)
    {
        DebilidadesEntendimientoOrganizacion::destroy($id);
    }

    public function save()
    {
        $this->validate();
        DebilidadesEntendimientoOrganizacion::create([
            'foda_id' => $this->foda_id,
            'debilidad' => $this->debilidad,
            'riesgo' => $this->riesgo,
        ]);

        // dd($fort);

        $this->dispatch('recargar-debilidades');
        $this->default();
    }

    public function edit($id)
    {
        $debilidadEncontrada = DebilidadesEntendimientoOrganizacion::find($id);

        $this->debilidad_id = $debilidadEncontrada->id;
        $this->foda_id = $debilidadEncontrada->foda_id;
        $this->debilidad = $debilidadEncontrada->debilidad;
        $this->riesgo = $debilidadEncontrada->riesgo;
        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate();
        $debilidadEncontrada = DebilidadesEntendimientoOrganizacion::find($this->debilidad_id);
        // dd($this->fortaleza_id);
        $debilidadEncontrada->update([
            'foda_id' => $this->foda_id,
            'debilidad' => $this->debilidad,
            'riesgo' => $this->riesgo,
        ]);

        $this->default();
        $this->dispatch('contentChanged');
    }

    public function default()
    {
        $this->debilidad = '';
        $this->riesgo = '';
        $this->dispatch('contentChanged');
        $this->view = 'create';
    }
}
