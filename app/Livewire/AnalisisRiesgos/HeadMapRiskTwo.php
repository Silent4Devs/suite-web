<?php

namespace App\Livewire\AnalisisRiesgos;

use App\Models\TBAnswerSheetRiskAnalysisModel;
use App\Models\TBPeriodRiskAnalysisModel;
use App\Models\TBPeriodSheetRiskAnalysisModel;
use App\Models\TBRiskAnalysis_ProbImpArModel;
use App\Models\TBRiskAnalysis_ScalesArModel;
use App\Models\TBSheetRiskAnalysisModel;
use Carbon\Carbon;
use Livewire\Component;

class HeadMapRiskTwo extends Component
{
    public $riskAnalysisId;

    public $scales;

    public $prob;

    public $initialRisk = [];

    public $residualRisk = [];

    public $historiesRR;

    protected $listeners = ['reloadGraphics'];

    public function getHistoryRR()
    {
        $registers = TBSheetRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)->get();
        foreach ($registers as $register) {
            $register->initial_risk = $register->sheetPeriod?->initial_risk ? $register->sheetPeriod?->initial_risk : "N/A";
            $register->residual_risk = $register->sheetPeriod?->residual_risk ? $register->sheetPeriod?->residual_risk : "N/A";
            $register->period_name = $register->sheetPeriod?->period?->name ? $register->sheetPeriod?->period?->name: "N/A";
            $register->start = $register->sheetPeriod?->period?->start ? Carbon::parse($register->sheetPeriod?->period?->start)->format('d-m-Y') : "N/A";
        }
        $this->historiesRR = $registers;
        $this->reloadGraphics();
        $this->dispatch('reloadTableRR', table:'datatable-rr-history');
    }

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
