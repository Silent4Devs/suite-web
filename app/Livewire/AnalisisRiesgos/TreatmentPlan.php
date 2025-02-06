<?php

namespace App\Livewire\AnalisisRiesgos;

use App\Models\PlanImplementacion;
use App\Models\TBPeriodSheetRiskAnalysisModel;
use App\Models\TBRiskAnalysisModel;
use App\Models\TBSheetRiskAnalysisModel;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class TreatmentPlan extends Component
{
    public $question_id;

    public $sheetId;

    public $riskName;

    public $sheets;

    public $parent;

    public $inicio;

    public $fin;

    public $objetivo;

    // protected $listeners = ['treatmentPlan'];

    public function saveTreatmentPlan()
    {
        $this->validate([
            'parent' => 'required|string|max:255',
            'inicio' => 'required|date',
            'fin' => 'required|date|after:inicio', // Asegura que la fecha de fin sea después de la fecha de inicio
            'objetivo' => 'required|string|max:550',
        ], [
            'parent.required' => 'Debes definir un nombre para el plan de trabajo',
            'objetivo.required' => 'Debes definir un objetivo para el plan de trabajo',
            'fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
        ]);

        $sheet = TBSheetRiskAnalysisModel::find($this->sheetId);

        $tasks = [
            [
                'id' => 'tmp_'.(strtotime(now())).'_1',
                'end' => strtotime($this->fin) * 1000,
                'name' => 'Plan de Trabajo - ',
                'level' => 0,
                'start' => strtotime($this->inicio) * 1000,
                'canAdd' => true,
                'status' => 'STATUS_UNDEFINED',
                'canWrite' => true,
                'duration' => 0,
                'progress' => 0,
                'canDelete' => true,
                'collapsed' => false,
                'relevance' => '0',
                'canAddIssue' => true,
                'description' => '',
                'endIsMilestone' => false,
                'startIsMilestone' => false,
                'progressByWorklog' => false,
                'assigs' => [],
                'resources' => [],
                'subtasks' => [],
                'historic' => [],
            ],
        ];

        $planImplementacion = PlanImplementacion::create([ // Necesario se carga inicialmente el Diagrama Universal de Gantt
            'tasks' => $tasks,
            'canAdd' => true,
            'canWrite' => true,
            'canWriteOnParent' => true,
            'changesReasonWhy' => false,
            'selectedRow' => 0,
            'zoom' => '3d',
            'parent' => $this->parent,
            'norma' => null,
            'modulo_origen' => 'Planes de Trabajo',
            'objetivo' => $this->objetivo,
            'elaboro_id' => User::getCurrentUser()->empleado->id,
            'es_plan_trabajo_base' => false,
        ]);

        $sheet->update([
            'treatment_plan_id' => $planImplementacion->id,
        ]);

        redirect()->route('admin.planes-de-accion.show', $planImplementacion->id);
    }

    public function selectSheetId($id)
    {
        $this->sheetId = $id;
    }

    #[On('treatmentPlan')]
    public function treatmentPlan($data)
    {
        $period = $data['period'];
        $riskAnalysisId = $data['riskAnalysisId'];
        $risk = TBRiskAnalysisModel::find($riskAnalysisId);
        $this->sheets = TBPeriodSheetRiskAnalysisModel::where('period_id', $period)->whereNotNull('initial_risk')->get();
        if (! is_null($period)) {
            foreach ($this->sheets as $key => $sheet) {
                if (! $sheet->sheet->require_treatment_plan) {
                    $this->sheets->pull($key);
                }
            }
            $this->riskName = $risk->riskAnalysisGeneral->name;
        }
    }

    public function mount(){
        $this->dispatch('handleReloadTreatmentPlan',)->to(FormRiskAnalysis::class);
        // $this->skipRender();
    }

    public function render()
    {
        return view('livewire.analisis-riesgos.treatment-plan');
    }
}
