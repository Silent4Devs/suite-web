<?php

namespace App\Http\Livewire\AnalisisRiesgos;

use App\Models\TBPeriodSheetRiskAnalysisModel;
use App\Models\TBRiskAnalysisModel;
use App\Models\TBSectionRiskAnalysisModel;
use Livewire\Component;

class TreatmentPlan extends Component
{
    public $question_id;
    public $riskName;
    protected $listeners = ['treatmentPlan'];

    public function treatmentPlan($period, $riskAnalysisId)
    {
        $risk = TBRiskAnalysisModel::find($riskAnalysisId);
        $sheets = TBPeriodSheetRiskAnalysisModel::where('period_id',$period)->whereNotNull('initial_risk')->get();
        // if($sheets->isNotEmpty()){
        //     // foreach($sectionsRegisters as $section){
        //     //     $sectionCollect = collect($section['questions']);
        //     //     $question = $sectionCollect->first(function ($item) {
        //     //         return $item['title'] === 'Descripcion del riesgo';
        //     //     });
        //     //     $this->question_id = $question['id'];
        //     // }
        //     // dd($sheets);
        // }

        // // dd($this->question_id);
        // dd($risk->riskAnalysisGeneral);
    }

    public function render()
    {
        return view('livewire.analisis-riesgos.treatment-plan');
    }
}
