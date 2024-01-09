<?php

namespace App\Livewire;

use App\Models\RH\MetricasObjetivo;
use Carbon\Carbon;
use Livewire\Component;

class MetricaObjetivoCreate extends Component
{
    public $definicion;

    protected $rules = [
        'definicion' => 'required|string|max:255',
    ];

    protected $mesages = [
        'definicion.required' => 'Debes agregar una definición para la métrica del objetivo',
        'definicion.max' => 'La métrica del objetivo no debe exceder los 255 carácteres',
    ];

    public function save()
    {
        $this->validate();
        MetricasObjetivo::create([
            'definicion' => $this->definicion,
            'created_at' => Carbon::now(),
        ]);
        $this->dispatch('metricaObjetivoStore');
        $this->dispatch('render-metrica-objetivo-select');
    }

    public function render()
    {
        return view('livewire.metrica-objetivo-create');
    }
}
