<?php

namespace App\Livewire\AnalisisRiesgos;

use App\Models\TBAnswerRASheetRAModel;
use App\Models\TBAnswerSheetRiskAnalysisModel;
use App\Models\TBFormulaRiskAnalysisModel;
use App\Models\TBPeriodRiskAnalysisModel;
use App\Models\TBPeriodSheetRiskAnalysisModel;
use App\Models\TBRiskAnalysis_ProbImpArModel;
use App\Models\TBRiskAnalysis_ScalesArModel;
use App\Models\TBRiskAnalysisScaleModel;
use App\Models\TBSectionRiskAnalysisModel;
use App\Models\TBSettingsAr_FormulasArModel;
use App\Models\TBSettingsAr_QuestionsArModel;
use App\Models\TBSheetRiskAnalysisModel;
use App\Models\TBVersionSheetRiskAnalysisModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormRiskAnalysis extends Component
{
    use WithFileUploads;

    public $riskAnalysisId;

    public $settignsTable = [];

    public $sections;

    public $questionsAnswer = [];

    public $scales;

    public $probImpa;

    public $scalesCoordinates = [];

    public $verifyPeriod;

    public $period_id;

    public $questionSettigns;

    public $formulasSettings;

    public $answersTable = [];

    public $verifyAnswers;

    public $sheetTables;

    public $sheetId;

    public $questionsFormulas = [];

    public $controlsSheet;

    public $cloneControlsSheet;

    public $descriptionQuestionId;

    public $sheetsRegisters;

    public $risks = [
        'id' => null,
        'initial' => 0,
        'residual' => 0,
        'approveInitial' => 0,
        'approveResidual' => 0,
        'coords' => [
            'initial' => [
                'impac' => 0,
                'prob' => 0,
            ],
            'residual' => [
                'impac' => 0,
                'prob' => 0,
            ],
        ],

    ];

    // variable control sheet form
    public $sheetForm = [
        'status' => 1, // evaluate = 1, finish = 2
        'bg' => '#FFFFD8',
        'initial_risk_confirm' => false,
        'residual_risk_confirm' => false,
        'edit' => false,
    ];

    public $answersForm =[] ;

    public $selectedIds = [];

    public function cloneAnswerSheet($regainSheetId, $newSheetId)
    {
        $answersPivot = TBAnswerRASheetRAModel::where('sheet_id', $regainSheetId)->get();

        foreach ($answersPivot as $answerPivot) {
            $newAnswer= new TBAnswerSheetRiskAnalysisModel;
            $cloneAnswer = $answerPivot->answer->replicate();
            $newAnswer->fill($cloneAnswer->toArray());
            $newAnswer->save();

            $newAnswerPivot= new TBAnswerRASheetRAModel;
            $cloneAnswerPivot = $answerPivot->replicate();
            $newAnswerPivot->fill($cloneAnswerPivot->toArray());
            $newAnswerPivot->answer_id = $newAnswer->id;
            $newAnswerPivot->sheet_id = $newSheetId;
            $newAnswerPivot->save();
        }

    }

    public function createHistory($sheetRegister)
    {
        $newHistory = new TBVersionSheetRiskAnalysisModel;
        $cloneSheet = $sheetRegister->replicate();
        $newHistory->fill($cloneSheet->toArray());
        $newHistory->save();
    }

    public function regainSheet()
    {
        if(!empty($this->selectedIds)){
            $this->verifyStatus(true);

            foreach($this->selectedIds as $regainSheet){
                $sheetRegister = TBSheetRiskAnalysisModel::where('id',$regainSheet)->first();
                $this->createHistory($sheetRegister);
                $newSheet = new TBSheetRiskAnalysisModel;

                $cloneSheet = $sheetRegister->replicate();
                $newSheet->fill($cloneSheet->toArray());
                $newSheet->residual_risk_confirm = false;
                $newSheet->save();

                TBPeriodSheetRiskAnalysisModel::create([
                    'period_id' => $this->period_id,
                    'sheet_id' => $newSheet->id,
                    "initial_risk" => $sheetRegister->sheetPeriod->residual_risk ,
                    "initial_coordinate_y" => $sheetRegister->sheetPeriod->residual_coordinate_y,
                    "initial_coordinate_x" => $sheetRegister->sheetPeriod->residual_coordinate_x,
                ]);

                $this->saveRequireTreatmentPlan($newSheet,$sheetRegister->sheetPeriod->residual_risk);

                $this->cloneAnswerSheet($regainSheet,$newSheet->id);

            }
        }else{
            dd("esta vacio");
        }
        $this->dispatch('execute-script', table:'datatable-register-sheets');
        $this->dispatch('execute-script', table:'datatable-risk-analysis');
        $this->dispatch('close-modal');

    }

    public function toggleSelectAll($isSelected)
    {
        // $this->skipRender();
        if ($isSelected) {
            $this->selectedIds = $this->sheetsRegisters->pluck('id')->toArray();
        } else {
            $this->selectedIds = [];
        }
    }

    public function getSheetRegisters()
    {

        $sheetsRegisters = TBSheetRiskAnalysisModel::whereHas('sheetPeriod.period', function ($query) {
            $query->where('status', 'completed');
        })->get();


        // $sheetsRegisters = TBSheetRiskAnalysisModel::where('risk_analysis_id',$this->riskAnalysisId)->get();
        // $this->sheetsRegisters = $sheetsRegister;
        foreach($sheetsRegisters as $sheetRegister){
            $sheetRegister->start = Carbon::parse($sheetRegister->sheetPeriod->period->start)->format('d-m-Y');
            $sheetRegister->end = Carbon::parse($sheetRegister->sheetPeriod->period->end)->format('d-m-Y');

            foreach($sheetRegister->answersSheet as $answerSheet){
                switch ($answerSheet->questionR->title) {
                    case 'ID':
                        $sheetRegister->code_id = $answerSheet->value;
                        break;
                    case 'Probabilidad':
                        $sheetRegister->prob = $answerSheet->value;
                        break;
                    case 'Impacto':
                        $sheetRegister->imp = $answerSheet->value;
                        break;
                    default:
                        # code...
                        break;
                }

            }
        }

        $this->sheetsRegisters = $sheetsRegisters;
        $this->dispatch('execute-script', table:'datatable-register-sheets');
        $this->dispatch('execute-script', table:'datatable-risk-analysis');


    }

    #[On('handleReloadTreatmentPlan')]
    public function handleReloadTreatmentPlan()
    {
        $this->skipRender();
        $this->dispatch('treatmentPlan',['period' => $this->period_id, 'riskAnalysisId'=>$this->riskAnalysisId])->to(TreatmentPlan::class);
        // $this->dispatch('execute-script', table:'datatable-risk-analysis');
    }

    #[On('riskConfirm')]
    public function riskConfirm()
    {
        $sheet = TBSheetRiskAnalysisModel::find($this->sheetId);
        if ($this->sheetForm['status'] === 1) {
            $sheet->update([
                'initial_risk_confirm' => true,
            ]);
        $this->dispatch('reload',sheetId:$this->sheetId)->to(ControlsRiskAnalysis::class);

            $this->dispatch('treatmentPlan',['period' => $this->period_id, 'riskAnalysisId'=>$this->riskAnalysisId])->to(TreatmentPlan::class);
        } else {
            $sheet->update([
                'residual_risk_confirm' => true,
            ]);
        }
    }

    public function riskConfirmMessage()
    {
        $this->dispatch('riskConfirmMessage');
    }

    #[On('saveCoordinates')]
    public function saveCoordinates($id)
    {
        if (! in_array($id, $this->scalesCoordinates)) {
            $this->scalesCoordinates[] = $id;
        }
    }

    public function saveRequireTreatmentPlan($sheet,$value)
    {
        foreach ($this->scales as $scale) {
            switch (true) {
                case ! is_null($value) && $value <= $scale->valor:
                    if ($scale->riesgo_aceptable === true) {
                        $sheet->update([
                            'require_treatment_plan' => false,
                        ]);
                        break 2;
                    } else {
                        $sheet->update([
                            'require_treatment_plan' => true,
                        ]);
                        break 2;
                    }
                    break;
                default:
                    break;
            }
        }
    }

    public function saveInitialResidualRisks($questionId, $value)
    {
        $questionFormula = TBFormulaRiskAnalysisModel::where('riesgo', true)->where('risk_analysis_id', $this->riskAnalysisId)->first();
        $periodSheet = TBPeriodSheetRiskAnalysisModel::where('period_id', $this->period_id)->where('sheet_id', $this->sheetId)->first();
        $sheet = TBSheetRiskAnalysisModel::find($periodSheet->sheet_id);

        $ids = $this->getAnswerWithoutPrefix();
        $commonKeys = array_intersect_key($ids, array_flip($this->scalesCoordinates));
        $commonKeys = array_values($commonKeys);


        switch (! is_null($questionFormula)) {
            case intval($questionId) === $questionFormula->question_id && $this->sheetForm['status'] === 1:

                $periodSheet->update([
                    'initial_risk' => $value,
                    'initial_coordinate_y' => $commonKeys[0],
                    'initial_coordinate_x' => $commonKeys[1],

                ]);
                break;
            case intval($questionId) === $questionFormula->question_id && $this->sheetForm['status'] === 2:
                $periodSheet->update([
                    'residual_risk' => $value,
                    'residual_coordinate_y' => $commonKeys[0],
                    'residual_coordinate_x' => $commonKeys[1],
                ]);
                break;
            default:
                break;
        }

        foreach ($this->scales as $scale) {
            switch (true) {
                case ! is_null($value) && $value <= $scale->valor:
                    if ($scale->riesgo_aceptable === true) {
                        $sheet->update([
                            'require_treatment_plan' => false,
                        ]);
                        break 2;
                    } else {
                        $sheet->update([
                            'require_treatment_plan' => true,
                        ]);
                        break 2;
                    }
                    break;
                default:
                    break;
            }
        }

    }

    public function getInitialResidualRisk()
    {
        $pivot = TBPeriodSheetRiskAnalysisModel::where('period_id', $this->period_id)->where('sheet_id', $this->sheetId)->first();
        // dd($pivot->residual_risk);

        foreach ($this->scales as $scale) {
            switch (true) {
                case ! is_null($pivot->initial_risk) && $pivot->initial_risk <= $scale->valor:
                    if ($scale->riesgo_aceptable === true) {
                        $this->risks['approveInitial'] = true;
                        break 2;
                    } else {
                        $this->risks['approveInitial'] = false;
                        break 2;
                    }
                    break;
                default:
                    break;
            }
        }

        foreach($this->scales as $scale){
            switch(true) {
                case ! is_null($pivot->residual_risk) && $pivot->residual_risk <= $scale->valor:
                    if ($scale->riesgo_aceptable === true) {
                        $this->risks['approveResidual'] = true;
                        break 2;
                    } else {
                        $this->risks['approveResidual'] = false;
                        break 2;
                    }
                    break;
                default:
                    break;
            }
        }

        $max = $this->probImpa->valor_max * $this->probImpa->valor_max;

        $formulaRI = round(($pivot->initial_risk / $max) * 100,2);
        $formulaRR = round(($pivot->residual_risk / $max) * 100,2);
        $this->risks['id'] = $pivot->id;
        $this->risks['initial'] = $formulaRI;
        $this->risks['residual'] = $formulaRR;
        $this->risks['coords']['initial']['prob'] = $pivot->initial_coordinate_y ? $pivot->initial_coordinate_y : 0;
        $this->risks['coords']['initial']['impac'] = $pivot->initial_coordinate_x ? $pivot->initial_coordinate_x : 0;
        $this->risks['coords']['residual']['prob'] = $pivot->residual_coordinate_y ? $pivot->residual_coordinate_y : 0;
        $this->risks['coords']['residual']['impac'] = $pivot->residual_coordinate_x ? $pivot->residual_coordinate_x : 0;

    }

    public function getIdsQuestionsFormulas()
    {
        foreach ($this->sections as $section) {
            foreach ($section->questions as $question) {
                if (! is_null($question->uuid_formula)) {
                    $this->questionsFormulas[] = $question;
                }
            }
        }
    }

    public function getQuestionsAnswer()
    {
        $answersFormRegister = TBAnswerRASheetRAModel::where('sheet_id', $this->sheetId)->get();
        if ($answersFormRegister->isNotEmpty()) {
            $this->sheetForm['edit'] = true;
            foreach ($answersFormRegister as $answerRegister) {
                $this->answersForm[$answerRegister->answer->question_id] = [
                    'id' => $answerRegister->answer->id,
                    'question_id' => $answerRegister->answer->question_id,
                    'value' => $answerRegister->answer->value,
                ];
            }
        } else {
            $this->answersForm = [];
            $this->sheetForm['edit'] = false;
        }
    }

    public function chageStatusForm($status, $id)
    {
        $this->sheetId = $id;

        $this->sheetForm['status'] = $status;
        $this->sheetForm['bg'] = match ($status) {
            1 => '#FFFFD8',
            2 => '#FFDEAC',
            default => '#FFFFD8',
        };

        $this->getQuestionsAnswer();
        $this->getInitialResidualRisk();
        $this->dispatch('reload',sheetId:$this->sheetId)->to(ControlsRiskAnalysis::class);
        $this->dispatch('execute-script', table:'datatable-risk-analysis');
        $this->dispatch('calculateScale');

    }

    public function createSheet()
    {
        $sheet = TBSheetRiskAnalysisModel::create([
            'risk_analysis_id' => $this->riskAnalysisId,
        ]);

        TBPeriodSheetRiskAnalysisModel::create([
            'period_id' => $this->period_id,
            'sheet_id' => $sheet->id,
        ]);
    }

    public function createPeriod()
    {
        $countPeriod = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            ->where('status', 'completed')
            ->count();
        $countPeriod++;

        $startDate = Carbon::now()->format('d-M-Y');

        try {
            DB::beginTransaction();

            $period = TBPeriodRiskAnalysisModel::create([
                'risk_analysis_id' => $this->riskAnalysisId,
                'status' => 'in-progress',
                'name' => 'periodo '.$countPeriod,
                'start' => $startDate,
            ]);

            DB::commit();

            $this->period_id = $period->id;

            // $this->createSheet();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
        }
    }

    #[On('closePeriod')]
    public function closePeriod($id)
    {
        $registerPeriod = TBPeriodRiskAnalysisModel::find($id);
        $endDate = Carbon::now()->format('d-M-Y');
        $registerPeriod->update([
            'status' => 'completed',
            'end' => $endDate,
        ]);

        $this->verifyAnswers = false;
        $this->dispatch('reloadGraphics')->to(HeadMapRiskTwo::class);
        // $this->dispatch('analisis-riesgos.head-map-risk-two', 'reloadGraphics');
        $this->period_id = null;

    }

    public function verifyStatus($regainSheet=false)
    {
        $verifyPeriodActive = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            ->where('status', 'in-progress')
            ->exists();

        if (! $verifyPeriodActive) {
            $this->createPeriod();
            if(!$regainSheet){
                $this->createSheet();
            }
        } else {
            if(!$regainSheet){
                $this->createSheet();
            }
        }
            $this->dispatch('execute-script', table:'datatable-register-sheets');
            $this->dispatch('execute-script', table:'datatable-risk-analysis');
    }

    #[On('destroySheet')]
    public function destroySheet($id)
    {
        $sheet = TBSheetRiskAnalysisModel::find($id);
        $sheet->delete();
    }

    public function editForm()
    {
        $questionsAnswer = $this->getAnswerWithoutPrefix();
        foreach ($questionsAnswer as $index => $questionAnswer) {
            $answerRegisterId = $this->answersForm[$index]['id'];
            $answerRegister = TBAnswerSheetRiskAnalysisModel::find($answerRegisterId);
            $answerRegister->value = $questionAnswer;
            if ($answerRegister->isDirty()) {
                $answerRegister->save();
                $this->saveInitialResidualRisks($index, $questionAnswer);
            }

            // se iguala el valor del input para formulas
            if ($answerRegister->value != $this->answersForm[$index]['value']) {
                $this->answersForm[$index]['value'] = $answerRegister->value;
            }

        }

        $this->getInitialResidualRisk();

        $this->dispatch('responseForm', $this->sheetForm['edit']);
        $this->dispatch('calculateScale');
        $this->dispatch('reloadGraphics')->to(HeadMapRiskTwo::class);

    }

    public function saveForm()
    {
        $questionsAnswer = $this->getAnswerWithoutPrefix();

        foreach ($questionsAnswer as $index => $questionAnswer) {
            $answerRegister = TBAnswerSheetRiskAnalysisModel::create([
                'question_id' => intval($index),
                'value' => $questionAnswer,
            ]);

            TBAnswerRASheetRAModel::create([
                'sheet_id' => $this->sheetId,
                'answer_id' => $answerRegister->id,
            ]);

            $this->saveInitialResidualRisks($index, $questionAnswer);
        }

        $this->dispatch('responseForm', $this->sheetForm['edit']);
        $this->dispatch('calculateScale');
        $this->sheetForm['edit'] = true;
        $this->getQuestionsAnswer();
        $this->getInitialResidualRisk();
        $this->dispatch('reloadGraphics')->to(HeadMapRiskTwo::class);

    }

    public function getAnswerWithoutPrefix()
    {
        $newAswers = array_combine(
            array_map(fn ($key) => str_replace('qs-', '', $key), array_keys($this->questionsAnswer)),
            $this->questionsAnswer
        );

        return $newAswers;
    }

    #[On('formData')]
    public function formData($data,$coords)
    {
        $newCoords = json_decode($coords);
            $this->scalesCoordinates = $newCoords;

        $this->questionsAnswer = $data;
        if (! $this->sheetForm['edit']) {
            $this->saveForm();
        } else {
            $this->editForm();
        }
    }

    public function mount($RiskAnalysisId)
    {
        $this->riskAnalysisId = $RiskAnalysisId;
    }

    public function render()
    {
        // get Scales and probability e impact
        $scalesMax = TBRiskAnalysis_ScalesArModel::where('risk_analysis_id', $this->riskAnalysisId)->first();
        $this->scales = TBRiskAnalysisScaleModel::where('min_max_id', $scalesMax->id)->orderBy('id', 'asc')->get();
        $probsMax = TBRiskAnalysis_ProbImpArModel::where('risk_analysis_id', $this->riskAnalysisId)->first();
        $this->probImpa = $probsMax;
        // get Sections
        $sectionsRegisters = TBSectionRiskAnalysisModel::select('id', 'title', 'position', 'risk_analysis_id')
            ->where('risk_analysis_id', $this->riskAnalysisId)
            ->get();

        // Header Settings Table
        $this->questionSettigns = TBSettingsAr_QuestionsArModel::select('id', 'question_id', 'is_show')
            ->where('risk_analysis_id', $this->riskAnalysisId)
            ->where('is_show', true)
            ->orderBy('id', 'asc')
            ->get();

        $this->formulasSettings = TBSettingsAr_FormulasArModel::select('id', 'formula_id', 'is_show')
            ->where('risk_analysis_id', $this->riskAnalysisId)
            ->orderBy('id', 'asc')
            ->get();

        // Questions Form
        $this->sections = $sectionsRegisters;
        // Questions formulas
        $this->getIdsQuestionsFormulas();
        // period completed
        $verifyPeriod = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            ->where('status', 'completed')
            ->exists();
        $this->verifyPeriod = $verifyPeriod;
        // verify period in progress
        $verifyPeriodProgress = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            ->where('status', 'in-progress')
            ->exists();

        if ($verifyPeriodProgress) {
            $period = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
                ->where('status', 'in-progress')
                ->first();
            $this->period_id = $period->id;
        // $this->dispatch('treatmentPlan',['period' => $this->period_id, 'riskAnalysisId'=>$this->riskAnalysisId])->to(TreatmentPlan::class);


            // get answers table general
            $existSheets = TBPeriodSheetRiskAnalysisModel::where('period_id', $period->id)->exists();
            if (! is_null($existSheets)) {
                $sheetsTable = TBPeriodSheetRiskAnalysisModel::where('period_id', $period->id)->get();
                $this->verifyAnswers = true;
                foreach ($sheetsTable as $sheetTable) {
                    $this->answersTable = [];
                    $empty1 = [];
                    $empty2 = [];
                    if ($sheetTable->sheet->answersSheet->count() && ! is_null($sheetTable->sheet->answersSheet)) {
                        foreach ($sheetTable->sheet->answersSheet as $answerSheet) {
                            foreach ($this->questionSettigns as $questionSetting) {
                                if ($questionSetting->question_id === $answerSheet->question_id) {
                                    $this->answersTable[] = $answerSheet;
                                }
                            }

                            foreach ($this->formulasSettings as $formulaSetting) {
                                if ($formulaSetting->formula->question_id === $answerSheet->question_id) {
                                    $this->answersTable[] = $answerSheet;
                                }

                            }
                        }
                        $sheetTable->sheet->answersTable = $this->answersTable;
                    } else {
                        foreach ($this->questionSettigns as $questionSetting) {
                            $empty1[] = [];
                        }

                        foreach ($this->formulasSettings as $formulaSetting) {
                            $empty2[] = [];
                        }

                        $result = array_merge($empty1, $empty2);

                        $sheetTable->sheet->answersTable = $result;
                    }
                }

                $this->sheetTables = $sheetsTable;
            }
        }

        // $this->dispatch('analisis-riesgos.treatment-plan', 'treatmentPlan', $this->period_id, $this->riskAnalysisId);

        // $this->dispatch('scriptTabla');

        return view('livewire.analisis-riesgos.form-risk-analysis');
    }
}
