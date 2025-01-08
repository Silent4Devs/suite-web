<?php

namespace App\Livewire\AnalisisRiesgos;

use App\Models\TBPeriodRiskAnalysisModel;
use App\Models\TBPeriodSheetRiskAnalysisModel;
use App\Models\TBRiskAnalysis_ProbImpArModel;
use App\Models\TBRiskAnalysis_ScalesArModel;
use Livewire\Component;

class HeadMapRiskTwo extends Component
{
    public $riskAnalysisId;

    public $scales;

    public $prob;

    public $initialRisk = [];

    public $residualRisk = [];

    protected $listeners = ['reloadGraphics'];

    public function reloadGraphics()
    {
        $this->reset(['scales', 'prob', 'initialRisk', 'residualRisk']);
        $this->getInfo();
        $this->dispatch('reloadGraph', $this->initialRisk, $this->residualRisk);
    }

    public function getInfo()
    {
        $this->scales = TBRiskAnalysis_ScalesArModel::where('risk_analysis_id', $this->riskAnalysisId)->first();
        $this->prob = TBRiskAnalysis_ProbImpArModel::where('risk_analysis_id', $this->riskAnalysisId)->first();

        $period = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)->where('status', 'in-progress')->first();

        if (! is_null($period)) {
            $sheets = TBPeriodSheetRiskAnalysisModel::where('period_id', $period->id)->get();

            foreach ($sheets as $sheet) {
                if (! is_null($sheet->initial_risk)) {
                    $this->initialRisk[] = [$sheet->initial_coordinate_x - 1, $sheet->initial_coordinate_y - 1, intval($sheet->initial_risk)];
                }

                if (! is_null($sheet->residual_risk)) {
                    $this->residualRisk[] = [$sheet->residual_coordinate_x - 1, $sheet->residual_coordinate_y - 1, intval($sheet->residual_risk)];
                }
            }
        }
    }

    public function mount($RiskAnalysisId)
    {
        $this->riskAnalysisId = $RiskAnalysisId;
    }

    public function render()
    {
        $this->getInfo();

        return view('livewire.analisis-riesgos.head-map-risk-two');
    }
}
