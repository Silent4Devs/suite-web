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

    private function cloneScalesProb($riskAnalysis,$scalesPivote, $scales, $probPivote, $prob){

        $scalePivoteRegister = TBRiskAnalysis_ScalesArModel::create([
            'risk_analysis_id' => $riskAnalysis->id,
            'valor_min' => $scalesPivote->valor_min,
            'valor_max' => $scalesPivote->valor_max,
        ]);
    }

    private function cloneTemplateAR($id)
    {
        $template = TBTemplateAnalisisRiesgoModel::find($id);
        // dump($template);
        $riskAnalysis = TBRiskAnalysisModel::create([
            'nombre' => $template->nombre,
            'norma_id' => $template->norma_id,
            'descripcion' => $template->descripcion,
        ]);
        dump($riskAnalysis);
        //scales and probability
        // $scalesPivote = $template->getAr_Escala;
        // $scales = $template->getAr_Escala->getEscalas;
        // $probPivote = $template->getAR_Probabilidad_Impacto;
        // $prob = $template->getAR_Probabilidad_Impacto->getProbImp;
        // $this->cloneScalesProb($riskAnalysis,$scalesPivote, $scales, $probPivote, $prob);
        //sections and questions
        // $sections = TBSectionTemplateAnalisisRiesgoModel::where('template_id',$id)->get();
        // foreach($sections as $section){
        //     $questions = $section->questions;
        //     foreach($questions as $question){
        //         if($question->type === "11"){
        //             $questionFormulas[] = $question;
        //         }
        //         if(!$question->dataQuestions->isEmpty()){
        //         }

        //     }
        // }
        // //formulas
        // foreach($questionFormulas as $questionFormula){
        //     $formula = TBFormulaTemplateAnalisisRiesgoModel::where('question_id', $questionFormula->id)->first();

        // }
        // $formulas = TBFormulaTemplateAnalisisRiesgoModel::where('template_id', $id)->get();
        // dd($formulas);

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
        // dump($risk->id);
        $this->cloneTemplateAR($risk->id);
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
