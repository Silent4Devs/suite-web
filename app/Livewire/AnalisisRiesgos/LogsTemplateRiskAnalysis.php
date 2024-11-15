<?php

namespace App\Http\Livewire\AnalisisRiesgos;

use Livewire\Component;

class LogsTemplateRiskAnalysis extends Component
{
    public $templateId = null;

    public function mount($templateId)
    {
        $this->templateId = $templateId;
    }

    public function render()
    {

        return view('livewire.analisis-riesgos.logs-template-risk-analysis');
    }
}
