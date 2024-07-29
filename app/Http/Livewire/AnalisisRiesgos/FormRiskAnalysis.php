<?php

namespace App\Http\Livewire\AnalisisRiesgos;

use App\Models\TBSectionRiskAnalysisModel;
use App\Models\TBSettingsAr_FormulasArModel;
use App\Models\TBSettingsAr_QuestionsArModel;
use Livewire\Component;

class FormRiskAnalysis extends Component
{
    public $riskAnalysisId;
    public $settignsTable = [];
    public $sections;
    public $questionsAnswer = [];

    protected $listeners = ['formData'];

    public function formData($data)
    {
        $this->questionsAnswer = $data;
        // dd($this->questionsAnswer);
    }

    public function mount($RiskAnalysisId)
    {
        $this->riskAnalysisId = $RiskAnalysisId;

    }

    public function render()
    {

        $questionSettigns = TBSettingsAr_QuestionsArModel::select('id', 'question_id', 'is_show')
            ->where('risk_analysis_id', $this->riskAnalysisId)
            ->where('is_show', true)
            ->orderBy('id', 'asc')
            ->get();

        $formulasRegisters = TBSettingsAr_FormulasArModel::select('id', 'formula_id', 'is_show')
            ->where('risk_analysis_id', $this->riskAnalysisId)
            ->orderBy('id', 'asc')
            ->get();

        $sectionsRegisters = TBSectionRiskAnalysisModel::select('id','title','position','risk_analysis_id')
            ->where('risk_analysis_id', $this->riskAnalysisId)
            ->get();

        //Header Settings Table
        foreach ($questionSettigns as $questionSettign) {
            $questionSettign->title = $questionSettign->question->title;
            array_push($this->settignsTable, $questionSettign);
        }

        foreach ($formulasRegisters as $formulaRegister) {
            $formulaRegister->title = $formulaRegister->formula->title;
            array_push($this->settignsTable, $formulaRegister);
        }

        // Questions Form
        $this->sections = $sectionsRegisters;

        // Question Answers

        // dd($this->sections[0]->questions[0]->dataQuestions);

        return view('livewire.analisis-riesgos.form-risk-analysis');
    }
}
