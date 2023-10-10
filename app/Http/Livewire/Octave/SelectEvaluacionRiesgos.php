<?php

namespace App\Http\Livewire\Octave;

use Livewire\Component;

class SelectEvaluacionRiesgos extends Component
{
    public $confidencialidad = 0;

    public $disponibilidad = 0;

    public $integridad = 0;

    public $evaluacion;

    public $colorReglaTipo;

    public $colorTextoTipo;

    public $impactoOb = 5;

    protected $listeners = ['impactoObtenido' => 'calcularConImpacto'];

    public function mount($impactoOb)
    {
        $this->calcularValor();
        $this->impactoOb = $impactoOb;
    }

    public function render()
    {
        return view('livewire.octave.select-evaluacion-riesgos');
    }

    public function calcularConImpacto($impacto)
    {
        $this->impactoOb = $impacto;
        $this->calcularValor();
    }

    public function updatedConfidencialidad()
    {
        $this->calcularValor();
    }

    public function updatedDisponibilidad()
    {
        $this->calcularValor();
    }

    public function updatedIntegridad()
    {
        $this->calcularValor();
    }

    private function calcularValor()
    {
        $this->evaluacion =
            ($this->confidencialidad +
                $this->disponibilidad +
                $this->integridad) * $this->impactoOb;
        $this->calcularReglaColoresTipo($this->evaluacion);
    }

    private function calcularReglaColoresTipo($valor)
    {
        if ($valor <= 10) {
            $this->colorReglaTipo = '#6AA84F';
            $this->colorTextoTipo = '#fff';
        } elseif ($valor <= 23) {
            $this->colorReglaTipo = '#00FF00';
            $this->colorTextoTipo = '#000';
        } elseif ($valor <= 42) {
            $this->colorReglaTipo = '#FFFF00';
            $this->colorTextoTipo = '#000';
        } elseif ($valor <= 61) {
            $this->colorReglaTipo = '#FF9900';
            $this->colorTextoTipo = '#fff';
        } else {
            $this->colorReglaTipo = '#FF0000';
            $this->colorTextoTipo = '#fff';
        }
    }
}
