<?php

namespace App\Http\Livewire\AnalisisRiesgos;

use App\Models\Empleado;
use App\Models\TBTemplateAnalisisRiesgoModel;
use App\Models\TBSectionTemplateAnalisisRiesgoModel;
use App\Models\TBRiskAnalysisGeneralModel;
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

    private function cloneTemplateAR($id)
    {
        $template = TBTemplateAnalisisRiesgoModel::find($id);
        $scalesPivote = $template->getAr_Escala;
        $scales = $template->getAr_Escala->getEscalas;
        $probPivote = $template->getAR_Probabilidad_Impacto;
        $prob = $template->getAR_Probabilidad_Impacto->getProbImp;
        $sections = TBSectionTemplateAnalisisRiesgoModel::where('template_id',$id)->get();
        foreach($sections as $section){
            $questions = $section->questions;
            dump($questions);
        }
    }

    public function saveRegister()
    {
        $id =1;
        // $this->cloneTemplateAR($id);
        TBRiskAnalysisGeneralModel::create([
            'name' => $this->name,
            'fecha' => $this->fecha,
            'status' => false,
            'elaboro_id' => $this->elaboro_id,
            'norma_id' => $this->norma_id,
            'template_id' => $this->selectedCard,
        ]);
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
