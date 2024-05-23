<?php

namespace App\Livewire;

use App\Models\RH\MetricasObjetivo;
use Livewire\Component;

class MetricaObjetivoSelect extends Component
{
    protected $listeners = ['render-metrica-objetivo-select' => 'render'];

    public $metricas;

    public $metrica_seleccionada;

    public function mount($metrica_seleccionada)
    {
        $this->metrica_seleccionada = $metrica_seleccionada;
        $this->metricas = [];
    }

    public function render()
    {
        $this->metricas = MetricasObjetivo::all();

        return view('livewire.metrica-objetivo-select', ['metricas' => $this->metricas]);
    }

    public function hydrate()
    {
        $this->dispatch('select2');
    }
}
