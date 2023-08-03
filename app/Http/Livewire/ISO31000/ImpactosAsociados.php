<?php

namespace App\Http\Livewire\ISO31000;

use Livewire\Component;

class ImpactosAsociados extends Component
{
    public $estrategico = 1;

    public $operacional = 1;

    public $cumplimiento = 1;

    public $legal = 1;

    public $reputacional = 1;

    public $tecnologico = 1;

    public $valor = 6;

    public function mount($estrategico, $operacional, $cumplimiento, $legal, $reputacional, $tecnologico)
    {
        $this->estrategico = $estrategico;
        $this->operacional = $operacional;
        $this->cumplimiento = $cumplimiento;
        $this->legal = $legal;
        $this->reputacional = $reputacional;
        $this->tecnologico = $tecnologico;
        $this->calcularValor();
    }

    public function render()
    {
        return view('livewire.i-s-o31000.impactos-asociados');
    }

    public function updatedEstrategico($value)
    {
        $this->calcularValor();
    }

    public function updatedOperacional($value)
    {
        $this->calcularValor();
    }

    public function updatedCumplimiento($value)
    {
        $this->calcularValor();
    }

    public function updatedLegal($value)
    {
        $this->calcularValor();
    }

    public function updatedReputacional($value)
    {
        $this->calcularValor();
    }

    public function updatedTecnologico($value)
    {
        $this->calcularValor();
    }

    private function calcularValor()
    {
        $this->valor =
            $this->estrategico +
            $this->operacional +
            $this->cumplimiento +
            $this->legal +
            $this->reputacional +
            $this->tecnologico;
        $this->calcularReglaColoresTipo($this->valor);
        $this->emit('impactoObtenido31', $this->valor);
    }

    private function calcularReglaColoresTipo($valor)
    {
        if ($valor <= 5) {
            $this->colorReglaTipo = '#6AA84F';
            $this->colorTextoTipo = '#fff';
        } elseif ($valor <= 10) {
            $this->colorReglaTipo = '#00FF00';
            $this->colorTextoTipo = '#000';
        } elseif ($valor <= 15) {
            $this->colorReglaTipo = '#FFFF00';
            $this->colorTextoTipo = '#000';
        } elseif ($valor <= 20) {
            $this->colorReglaTipo = '#FF9900';
            $this->colorTextoTipo = '#fff';
        } else {
            $this->colorReglaTipo = '#FF0000';
            $this->colorTextoTipo = '#fff';
        }
    }
}
