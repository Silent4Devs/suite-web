<?php

namespace App\Http\Livewire\AnalisisRiesgos;

use App\Models\Empleado;
use App\Models\TBFormulaTemplateAnalisisRiesgoModel;
use App\Models\TBTemplateAnalisisRiesgoModel;
use App\Models\TBSectionTemplateAnalisisRiesgoModel;
use App\Models\TBSectionTemplateAr_QuestionTemplateArModel;
use App\Models\TBRiskAnalysisGeneralModel;
use App\Models\TBRiskAnalysis_ScalesArModel;
use App\Models\TBRiskAnalysisModel;
use App\Models\TBRiskAnalysisScaleModel;
use App\Models\TBRiskAnalysis_ProbImpArModel;
use App\Models\TBRiskAnalysisProbImpModel;
use App\Models\TBSectionRiskAnalysisModel;
use App\Models\TBQuestionRiskAnalysisModel;
use App\Models\TBSectionAR_QuestionARModel;
use App\Models\TBDataQuestionRiskAnalysisModel;
use App\Models\TBQuestionAr_DataQuestionArModel;
use App\Models\TBFormulaRiskAnalysisModel;
use App\Models\TBSettingsTemplateAR_TBFormulaTemplateARModel;
use App\Models\TBSettingsAr_FormulasArModel;
use App\Models\TBSettingsTemplateAR_TBQuestionTemplateARModel;
use App\Models\TBSettingsAr_QuestionsArModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RiskAnalysis extends Component
{

    public $name;
    public $fecha;
    public $elaboro_id = '';
    public $norma = 'iso27001';
    private $norma_id = 1;
    public $selectedCard = null;
    public $view = 'create';
    public $imagenID;

    private function resetInput()
    {
        $this->name = null;
        $this->elaboro_id = '';
        $this->view = 'create';
        $this->selectedCard = null;
    }

    private function cloneFormulas($riskAnalysis, $questionsFormulas,$formulas)
    {
        // dd($riskAnalysis);
        foreach($questionsFormulas as $questionFormula){
            foreach($formulas as $formula){
                $copyQuestion = $questionFormula->replicate();
                $newQuestion = new TBQuestionRiskAnalysisModel();
                $copyFormula = $formula->replicate();

                $newFormula = new TBFormulaRiskAnalysisModel();

                if($formula->question_id === $questionFormula->id){
                    $newQuestion->fill($copyQuestion->toArray());
                    $newQuestion->save();

                    TBSectionAR_QuestionARModel::create([
                        'section_id' => $questionFormula->section_id,
                        'question_id' => $newQuestion->id,
                    ]);

                    $copyFormula->section_id = $questionFormula->section_id;
                    $copyFormula->question_id = $newQuestion->id;


                    $newFormula->fill($copyFormula->toArray());
                    $newFormula->risk_analysis_id = $riskAnalysis;
                    $newFormula->save();

                    $settingFormula = TBSettingsTemplateAR_TBFormulaTemplateARModel::where('formula_id', $formula->id)->first();
                    // dd($settingFormula);
                    $copySettingsFormula = $settingFormula->replicate();
                    $newSettingsFormula = new TBSettingsAr_FormulasArModel();
                    $newSettingsFormula->fill($copySettingsFormula->toArray());
                    $newSettingsFormula->risk_analysis_id = $riskAnalysis;
                    $newSettingsFormula->formula_id = $newFormula->id;
                    $newSettingsFormula->save();
                }
            }
        }
    }
    private function cloneSectionsQuestions($sections,$riskAnalysis,&$questionsFormulas)
    {
        foreach($sections as $section){
            $copySection = $section->replicate();
            $copySection->risk_analysis_id = $riskAnalysis;

            $newSection = new TBSectionRiskAnalysisModel();
            $newSection->fill($copySection->toArray());
            $newSection->save();

            $questions = $section->questions;

            foreach($questions as $question){
                if($question->type !== "11"){
                    $copyQuestion = $question->replicate();

                    $newQuestion = new TBQuestionRiskAnalysisModel();
                    $newQuestion->fill($copyQuestion->toArray());
                    $newQuestion->save();

                    TBSectionAR_QuestionARModel::create([
                        'section_id' => $newSection->id,
                        'question_id' => $newQuestion->id,
                    ]);
                    //Settings Risk Analysis here

                    $settingQuestion = TBSettingsTemplateAR_TBQuestionTemplateARModel::where('question_id',$question->id)->first();
                    $copySettingQuestion = $settingQuestion->replicate();
                    $newSettingsQuestion = new TBSettingsAr_QuestionsArModel();
                    $newSettingsQuestion->fill($copySettingQuestion->toArray());
                    $newSettingsQuestion->risk_analysis_id = $riskAnalysis;
                    $newSettingsQuestion->question_id = $newQuestion->id;
                    $newSettingsQuestion->save();


                    $dataQuestions = $question->dataQuestions;
                    foreach($dataQuestions as $dataQuestion){
                        $copyData = $dataQuestion->replicate();
                        $newData = new TBDataQuestionRiskAnalysisModel();
                        $newData->fill($copyData->toArray());
                        $newData->save();


                        TBQuestionAr_DataQuestionArModel::create([
                            'question_id' => $newQuestion->id,
                            'dataquestion_id' => $newData->id,
                        ]);
                    }
                }else{
                    $question->section_id = $newSection->id;
                    $questionsFormulas[]= $question;
                }
            }
        }
    }
    private function cloneScalesProb($riskAnalysis,$scalePivote, $scales, $probPivote, $probabilities)
    {
        $scalePrivoteRegister = TBRiskAnalysis_ScalesArModel::create([
            'risk_analysis_id' => $riskAnalysis,
            'valor_min' => $scalePivote->valor_min,
            'valor_max' => $scalePivote->valor_max,
        ]);

        foreach($scales as $scale){
            TBRiskAnalysisScaleModel::create([
                'nombre' => $scale->nombre,
                'valor' => $scale->valor,
                'color' => $scale->color,
                'riesgo_aceptable' => $scale->riesgo_aceptable,
                'min_max_id' => $scalePrivoteRegister->id,
            ]);
        }

        $probabilityPrivoteRegister = TBRiskAnalysis_ProbImpArModel::create([
            'risk_analysis_id' => $riskAnalysis,
            'valor_min' => $probPivote->valor_min,
            'valor_max' => $probPivote->valor_max,
        ]);

        foreach($probabilities as $probability){
            TBRiskAnalysisProbImpModel::create([
                'nombre' => $probability->nombre,
                'valor' => $probability->valor,
                'color' => $probability->color,
                'min_max_id' => $probabilityPrivoteRegister->id,
            ]);
        }
    }

    private function cloneTemplateAR($generalId,$templateId)
    {
        $template = TBTemplateAnalisisRiesgoModel::find($templateId);
        //get info scales and probability/impact
        $scalePivote = $template->getAr_Escala;
        $probPivote = $template->getAR_Probabilidad_Impacto;
        $scales = $template->getAr_Escala->getEscalas;
        $probabilities = $template->getAR_Probabilidad_Impacto->getProbImp;
        $sections = TBSectionTemplateAnalisisRiesgoModel::where('template_id',$template->id)->get();
        $formulas = TBFormulaTemplateAnalisisRiesgoModel::where('template_id',$template->id)->get();
        $questionsFormulas = [];

        //clone template risk analysis
        $riskAnalysis = TBRiskAnalysisModel::create([
            'nombre' => $template->nombre,
            'norma_id' => $template->norma_id,
            'general_id' => $generalId,
            'descripcion' => $template->descripcion,
        ]);

        $this->cloneScalesProb($riskAnalysis->id,$scalePivote, $scales, $probPivote, $probabilities);
        $this->cloneSectionsQuestions($sections,$riskAnalysis->id,$questionsFormulas);
        $this->cloneFormulas($riskAnalysis->id, $questionsFormulas, $formulas);

    }

    public function saveRegister()
    {

        $risk = TBRiskAnalysisGeneralModel::create([
            'name' => $this->name,
            'fecha' => $this->fecha,
            'status' => false,
            'elaboro_id' => $this->elaboro_id,
            'norma_id' => $this->norma_id,
            'template_id' => $this->selectedCard,
        ]);
        $templateId = $this->selectedCard;
        $this->cloneTemplateAR($risk->id,$templateId);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.max' => 'El campo nombre no debe ser mayor a 255 caracteres',
        ]);

        if ($this->selectedCard) {
            $this->saveRegister();
            $this->resetInput();
            $this->emit('limpiarNameInput');
        } else {
            $this->emit('selectedCardAlert');
        }
    }

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
        $colaboradores = Empleado::getaltaAll();
        $this->fecha = Carbon::today()->format('d-m-Y');
        $templates = TBTemplateAnalisisRiesgoModel::where('top', true)->get();
        $this->imagenID = asset('img\alert_template_analisis_brechas_id.png');
        $registers = TBRiskAnalysisGeneralModel::get();
        foreach($registers as $register){
            $newDate = Carbon::createFromFormat('Y-m-d', $register->fecha)->format('d-m-Y');
            $register->fecha = $newDate;
        }
        return view('livewire.analisis-riesgos.risk-analysis', compact('templates','colaboradores','registers'));
    }
}
