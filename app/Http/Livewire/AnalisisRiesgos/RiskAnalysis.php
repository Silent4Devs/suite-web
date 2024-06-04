<?php

namespace App\Http\Livewire\AnalisisRiesgos;

use Livewire\Component;
use App\Models\TBTemplateAnalisisRiesgoModel;

class RiskAnalysis extends Component
{

    public $selectedCard = null;

    public function SelectCard($index)
    {
        // dd($index);
        if ($this->selectedCard === $index) {
            $this->selectedCard = null;
        } else {
            $this->selectedCard = $index;
        }
        // dd($this->selectedCard);
    }

    public function render()
    {
        $templates = TBTemplateAnalisisRiesgoModel::where('top', true)->get();
        // dd($templates);
        return view('livewire.analisis-riesgos.risk-analysis', compact('templates'));
    }
}
