<?php

namespace App\Livewire\NIST;

use Livewire\Component;

class SelectImpacto extends Component
{
    public $severidad = 1;

    public $probabilidad = 1;

    public $impacto = 1;

    public $valor;

    public $colorReglaTipo;

    public $colorTextoTipo;

    public function mount()
    {
        $this->calcularValor();
    }

    public function render()
    {
        return view('livewire.n-i-s-t.select-impacto');
    }

    public function updatedSeveridad($value)
    {
        $this->calcularValor();
    }

    public function updatedProbabilidad($value)
    {
        $this->calcularValor();
    }

    public function updatedImpacto($value)
    {
        $this->calcularValor();
    }

    private function calcularValor()
    {
        $this->valor =
            $this->severidad +
            $this->probabilidad +
            $this->impacto;
        $this->calcularReglaColoresTipo($this->valor);
    }

    private function calcularReglaColoresTipo($valor)
    {
        if ($valor <= 5) {
            $this->colorReglaTipo = '#6AA84F';
            $this->colorTextoTipo = '#fff';
        } elseif ($valor <= 20) {
            $this->colorReglaTipo = '#00FF00';
            $this->colorTextoTipo = '#000';
        } elseif ($valor <= 50) {
            $this->colorReglaTipo = '#FFFF00';
            $this->colorTextoTipo = '#000';
        } elseif ($valor <= 80) {
            $this->colorReglaTipo = '#FF9900';
            $this->colorTextoTipo = '#fff';
        } else {
            $this->colorReglaTipo = '#FF0000';
            $this->colorTextoTipo = '#fff';
        }
    }
}
