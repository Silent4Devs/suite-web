<?php

namespace App\Http\Livewire\Octave;

use Livewire\Component;

class SelectImpactos extends Component
{
    public $operacionalId = 1;
    public $cumplimientoId = 1;
    public $legalId = 1;
    public $reputacionalId = 1;
    public $tecnologicoId = 1;
    public $valorId;
    public $colorReglaTipo;
    public $colorTextoTipo;

    public function mount($operacionalId, $cumplimientoId, $legalId, $reputacionalId, $tecnologicoId)
    {
        if (!is_null($operacionalId)) {
            $this->operacionalId = $operacionalId;
        }
        if (!is_null($cumplimientoId)) {
            $this->cumplimientoId = $cumplimientoId;
        }
        if (!is_null($legalId)) {
            $this->legalId = $legalId;
        }
        if (!is_null($reputacionalId)) {
            $this->reputacionalId = $reputacionalId;
        }
        if (!is_null($tecnologicoId)) {
            $this->tecnologicoId = $tecnologicoId;
        }
        $this->calcularValor();
    }

    public function render()
    {
        return view('livewire.octave.select-impactos');
    }

    public function updatedOperacionalId($value)
    {
        $this->calcularValor();
    }

    public function updatedCumplimientoId($value)
    {
        $this->calcularValor();
    }

    public function updatedLegalId($value)
    {
        $this->calcularValor();
    }

    public function updatedReputacionalId($value)
    {
        $this->calcularValor();
    }

    public function updatedTecnologicoId($value)
    {
        $this->calcularValor();
    }

    private function calcularValor()
    {
        $this->valorId =
            $this->cumplimientoId +
            $this->operacionalId +
            $this->legalId +
            $this->reputacionalId +
            $this->tecnologicoId;
        $this->calcularReglaColoresTipo($this->valorId);
        $this->emit('impactoObtenido', $this->valorId);
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
