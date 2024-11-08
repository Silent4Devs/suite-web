<?php

namespace App\Http\Livewire\AnalisisRiesgos;

use App\Models\Iso27\GapDosCatalogoIso;
use App\Models\TBAnswerRASheetRAModel;
use App\Models\TBAnswerSheetRiskAnalysisModel;
use App\Models\TBControlRiskAnalysisModel;
use App\Models\TBFormulaRiskAnalysisModel;
use App\Models\TBPeriodRiskAnalysisModel;
use App\Models\TBPeriodSheetRiskAnalysisModel;
use App\Models\TBRiskAnalysis_ProbImpArModel;
use App\Models\TBRiskAnalysis_ScalesArModel;
use App\Models\TBRiskAnalysisProbImpModel;
use App\Models\TBRiskAnalysisScaleModel;
use App\Models\TBSectionRiskAnalysisModel;
use App\Models\TBSettingsAr_FormulasArModel;
use App\Models\TBSettingsAr_QuestionsArModel;
use App\Models\TBSheetRA_ControlRAModel;
use App\Models\TBSheetRiskAnalysisModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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

    public $risks = [
        'id' => null,
        'initial' => 0,
        'residual' => 0,
        'approveInitial' => 0,
        'approveResidual' => 0,
    ];


    // variable control sheet form
    public $sheetForm = [
        'status' => 1, // evaluate = 1, finish = 2
        'bg' => '#FFFFD8',
        'initial_risk_confirm' => false,
        'residual_risk_confirm' => false,
        // 'edit' => false,
    ];

    public $answersForm;

    protected $listeners = ['formData','saveCoordinates','riskConfirm'];

    public function riskConfirm()
    {
        $sheet = TBSheetRiskAnalysisModel::find($this->sheetId);
        if($this->sheetForm['status'] === 1){
            $sheet->update([
                'initial_risk_confirm' => true,
            ]);
        }else {
            $sheet->update([
                'residual_risk_confirm' => true,
            ]);
        }
        // dd("change");
        // dd($this->sheetForm['status']);
        // $this->emit('riskConfirmMessage');
    }

    public function riskConfirmMessage()
    {
        // dd($this->sheetForm['status']);
        $this->emit('riskConfirmMessage');
    }

    public function saveCoordinates($id)
    {
        if(!in_array($id,$this->scalesCoordinates)){
            $this->scalesCoordinates[] = $id;
        }
    }

    // public function editControlSheet($control)
    // {

    //     $controlRegister = TBControlRiskAnalysisModel::find($control['id']);
    //     $controlRegister->update($control);
    // }

    // public function createControlSheet($control)
    // {
    //     // dd($control);
    //     $control['applicability'] = $control['applicability'] !== null ? $control['applicability'] : false;
    //     $control['is_apply'] = $control['is_apply'] !== null ? $control['is_apply'] : false;

    //     $controlSheetRegister = TBControlRiskAnalysisModel::create([
    //         'control_id' => $control['control_id'],
    //         'applicability' => $control['applicability'],
    //         'is_apply' => $control['is_apply'],
    //         'justification' => $control['justification'],
    //         'file' => $control['file']
    //     ]);

    //     TBSheetRA_ControlRAModel::create([
    //         'sheet_id' => $this->sheetId,
    //         'control_sheet_id' => $controlSheetRegister->id,
    //     ]);
    // }

    // public function saveTable()
    // {
    //     dd($this->controlsSheet);
    //     foreach ($this->controlsSheet as $index => $controlSheet) {
    //         if ($this->cloneControlsSheet[$index]['applicability'] !== $controlSheet['applicability'] ||
    //             $this->cloneControlsSheet[$index]['is_apply'] !== $controlSheet['is_apply'] ||
    //             $this->cloneControlsSheet[$index]['justification'] !== $controlSheet['justification'] ||
    //             $this->cloneControlsSheet[$index]['file'] !== $controlSheet['file']  ) {
    //             if ($controlSheet['sheet_id']) {
    //                 $this->editControlSheet($controlSheet);
    //             } else {
    //                 $this->createControlSheet($controlSheet);
    //             }
    //         }
    //     }

    //     $this->emit('responseTableControls');

    // }

    // public function getControlsSheet()
    // {
    //     $this->controlsSheet = collect([]);
    //     $catalogueControls = GapDosCatalogoIso::select('id', 'control_iso', 'anexo_politica')->get();
    //     $idsCatalogueControls = $catalogueControls->pluck('id');

    //     $controlsRegisters = TBSheetRA_ControlRAModel::where('sheet_id', $this->sheetId)->get();
    //     $idsControlsRegister = $controlsRegisters->pluck('controlSheet.control_id');

    //     $controlsSame = collect([]);
    //     $controlsDiferent = collect([]);

    //     // filter controls same
    //     $controlsRegisters->filter(function ($item) use ($idsCatalogueControls, &$controlsSame) {
    //         if ($idsCatalogueControls->contains(optional($item->controlSheet)->control_id)) {
    //             $data = (object) [
    //                 'id' =>  $item->controlSheet->id,
    //                 'sheet_id' => $item->sheet_id,
    //                 'control_id' => $item->controlSheet->control_id,
    //                 'control' => $item->controlSheet->control->control_iso,
    //                 'control_name' => $item->controlSheet->control->anexo_politica,
    //                 'applicability' => $item->controlSheet->applicability,
    //                 'is_apply' => $item->controlSheet->is_apply,
    //                 'justification' => $item->controlSheet->justification,
    //                 'file' => $item->controlSheet->file,
    //             ];
    //             $controlsSame->push($data);
    //         }
    //     });
    //     // flter controls diferent
    //     $catalogueControls->filter(function ($item) use ($idsControlsRegister, &$controlsDiferent) {
    //         if (!$idsControlsRegister->contains(optional($item)->id)) {
    //             $data = (object) [
    //                 'id' => null,
    //                 'sheet_id' => null,
    //                 'control_id' => $item->id,
    //                 'control' => $item->control_iso,
    //                 'control_name' => $item->anexo_politica,
    //                 'applicability' => null,
    //                 'is_apply' => null,
    //                 'justification' => null,
    //                 'file' => null,
    //             ];
    //             $controlsDiferent->push($data);
    //         }
    //     });

    //     // $controlsSame = collect($controlsSame);
    //     // dd($controlsSame[0]->control_name);
    //     // $this->controlsSheet = array_merge($controlsSame,$controlsDiferent);
    //     // dd($this->controlsSheet[0]->control_name);

    //     $this->controlsSheet = $this->controlsSheet->merge($controlsSame);
    //     $this->controlsSheet = $this->controlsSheet->merge($controlsDiferent);
    //     // clone for camparate
    //     $this->cloneControlsSheet = clone $this->controlsSheet;
    // }

    public function saveInitialResidualRisks($questionId, $value)
    {
        $questionFormula = TBFormulaRiskAnalysisModel::where('riesgo',true)->where('risk_analysis_id', $this->riskAnalysisId)->first();
        $periodSheet = TBPeriodSheetRiskAnalysisModel::where('period_id', $this->period_id)->where('sheet_id',$this->sheetId)->first();
        $sheet = TBSheetRiskAnalysisModel::find($periodSheet->sheet_id);

        // foreach ($this->questionsAnswer as $index => $questionAnswer) {
        //     $questionId = str_replace('qs-', '', $index);

        // }

        $ids = $this->getAnswerWithoutPrefix();
                // dump($ids,$this->scalesCoordinates);
                $commonKeys = array_intersect_key($ids, array_flip($this->scalesCoordinates));
                $commonKeys = array_values($commonKeys);
                // dd($commonKeys);

        switch(!is_null($questionFormula)){
            case (intval($questionId) === $questionFormula->question_id && $this->sheetForm['status'] === 1):

                // dd($this->questionsAnswer, $this->scalesCoordinates);
                $periodSheet->update([
                    'initial_risk' => $value,
                    'initial_coordinate_y' => $commonKeys[0],
                    'initial_coordinate_x' => $commonKeys[1],
                    // 'initial_coords' => `$commonKeys[0]-$commonKeys[1]`,

                ]);
                break;
            case (intval($questionId) === $questionFormula->question_id && $this->sheetForm['status'] === 2):
                $periodSheet->update([
                    'residual_risk' => $value,
                    'residual_coordinate_y' => $commonKeys[0],
                    'residual_coordinate_x' => $commonKeys[1],
                ]);
                break;
            default:
                break;
        }

        foreach($this->scales as $scale){
            // dump($scale->valor);
            switch(true){
                case (!is_null($value) && $value <= $scale->valor):
                    // dump($scale);
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

        // dd($this->scalesCoordinates);
        // $formula =  $questionFormula->formula;
        // preg_match_all('/\$fv([a-zA-Z0-9]+)/', $formula, $matches);
        // $parts = $matches[1];
        // // dd($parts);

        // foreach($this->sections as $section){
        //     foreach($section->questions as $question){
        //         if(!is_null($question->uuid_formula) && in_array($question->uuid_formula,$parts)){
        //             dd($question);
        //         }
        //     // dump($parts.include($question->uuid_formula));
        //     // $response = $parts.includes($question->uuid_formula);
        //         // if(){
        //         //     dd($question);
        //         // }
        //     }
        // }

        // dd("stop");




        // if(!is_null($questionFormula) && intval($questionId) === $questionFormula->question_id){
        //     $risk->update([
        //         'initial_risk' => $value
        //     ]);
        // }

    }

    public function getInitialResidualRisk()
    {
        $pivot = TBPeriodSheetRiskAnalysisModel::where('period_id', $this->period_id)->where('sheet_id',$this->sheetId)->first();
        // $pivot->initial_risk = $pivot->initial_risk ? $pivot->initial_risk : 0;
        // $pivot->residual_risk = $pivot->residual_risk ? $pivot->residual_risk : 0;
        // $probsMax = TBRiskAnalysis_ProbImpArModel::where('risk_analysis_id', $this->riskAnalysisId)->first();
        // $scalesMax = TBRiskAnalysis_ScalesArModel::where('risk_analysis_id', $this->riskAnalysisId)->first();
        // $scales = TBRiskAnalysisScaleModel::where('min_max_id',$scalesMax->id)->orderBy('id','asc')->get();
        // dd( $scales);
        // dd($pivot->initial_risk);
        foreach($this->scales as $scale){
            // dump($scale->valor);
            switch(true){
                case (!is_null($pivot->initial_risk) && $pivot->initial_risk <= $scale->valor):
                    // dump($scale);
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
            // dump($this->risks['approveInitial']);


        $max = $this->probImpa->valor_max * $this->probImpa->valor_max;

        $formulaRI = ($pivot->initial_risk / $max ) * 100;
        $formulaRR = ($pivot->residual_risk / $max ) * 100;
        $this->risks['id'] = $pivot->id;
        $this->risks['initial'] = $formulaRI;
        $this->risks['residual'] = $formulaRR;
    }

    public function getIdsQuestionsFormulas()
    {
        foreach ($this->sections as $section) {
            foreach ($section->questions as $question) {
                if (!is_null($question->uuid_formula)) {
                    $this->questionsFormulas[] = $question;
                }
            }
        }
    }

    public function getQuestionsAnswer()
    {
        $answersFormRegister = TBAnswerRASheetRAModel::where('sheet_id', $this->sheetId)->get();
        // dd($answersFormRegister);

        if ($answersFormRegister->isNotEmpty()) {
            $this->sheetForm['edit'] = true;
            foreach ($answersFormRegister as $answerRegister) {
                $this->answersForm[$answerRegister->answer->question_id] = $answerRegister->answer;
            }
            // //verify % risk initial
            // foreach($this->formulasSettings as $formulaSettings){
            //     if($formulaSettings->formula->riesgo){
            //         // dd("a");
            //         foreach ($answersFormRegister as $answerFormRegister) {
            //             // dd($answerFormRegister);
            //             if($answerRegister->answer->question_id === $formulaSettings->formula->question_id){
            //                 // dd($answerRegister->answer);

            //             }
            //         }
            //     }
            // }
        } else {
            $this->answersForm = [];
            $this->sheetForm['edit'] = false;
        }
    }

    public function chageStatusForm($status, $id)
    {
        $this->sheetId = $id;

        // dd($id);
        $this->sheetForm['status'] = $status;
        $this->sheetForm['bg'] = match ($status) {
            1 => '#FFFFD8',
            2 => '#FFDEAC',
            default => '#FFFFD8',
        };
        // $this->sheetForm['edit'] = match ($status) {
        //     1 => false,
        //     2 => true,
        //     default => false,
        // };
        $this->getQuestionsAnswer();
        $this->getInitialResidualRisk();
        $this->emitTo('analisis-riesgos.controls-risk-analysis', 'reload', $this->sheetId);
        $this->emit('calculateScale');


        // foreach ($this->formulasSettings as $formulaSetting) {
        //     if($formulaSetting->formula->riesgo){
        //         $value = TBAnswerSheetRiskAnalysisModel::where('question_id',$formulaSetting->formula->question_id)->first();
        //         dd($value);

        //     }
        // }
        // $this->getControlsSheet();
        // $this->emit('scriptTabla2');
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
                'name' => 'periodo ' . $countPeriod,
                'start' => $startDate,
            ]);

            DB::commit();

            $this->period_id = $period->id;

            $this->createSheet();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }

    public function closePeriod()
    {
        $registerPeriod = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            ->where('status', 'in-progress')
            ->orderBy('id', 'ASC')
            ->first();
        dd($registerPeriod);
    }

    public function verifyStatus()
    {
        $verifyPeriodActive = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            ->where('status', 'in-progress')
            ->exists();

        if (!$verifyPeriodActive) {
            $this->createPeriod();
        } else {
            // $period = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            //     ->where('status', 'in-progress')
            //     ->first();

            // $this->period_id = $period->id;
            $this->createSheet();
        }
    }

    public function editForm()
    {
        // dd($this->answersForm, $this->questionsAnswer);
        $questionsAnswer = $this->getAnswerWithoutPrefix();
        foreach ($questionsAnswer as $index => $questionAnswer) {
            // $questionId = str_replace('qs-', '', $index);

            $answerRegisterId = $this->answersForm[$index]['id'];
            $answerRegister = TBAnswerSheetRiskAnalysisModel::find($answerRegisterId);
            $answerRegister->value = $questionAnswer;
            if ($answerRegister->isDirty()) {
                $answerRegister->save();
                $this->saveInitialResidualRisks($index,$questionAnswer);
            }

            // se iguala el valor del input para formulas
            if ($answerRegister->value != $this->answersForm[$index]['value']) {
                $this->answersForm[$index]['value'] = $answerRegister->value;
            }


        }

        $this->getInitialResidualRisk();

        $this->emit('responseForm', $this->sheetForm['edit']);
        $this->emit('calculateScale');

    }

    public function saveForm()
    {
        // dd($this->questionsAnswer);
        // $questionFormula = TBFormulaRiskAnalysisModel::where('riesgo',true)->where('risk_analysis_id', $this->riskAnalysisId)->first();
        // // dd($questionFormula);
        // $risk = TBPeriodSheetRiskAnalysisModel::where('period_id', $this->period_id)->where('sheet_id',$this->sheetId)->first();

        $questionsAnswer = $this->getAnswerWithoutPrefix();

        foreach ($questionsAnswer as $index => $questionAnswer) {
            // $questionId = str_replace('qs-', '', $index);
            $answerRegister = TBAnswerSheetRiskAnalysisModel::create([
                'question_id' => intval($index),
                'value' => $questionAnswer,
            ]);

            TBAnswerRASheetRAModel::create([
                'sheet_id' => $this->sheetId,
                'answer_id' => $answerRegister->id,
            ]);

            $this->saveInitialResidualRisks($index,$questionAnswer);

            // if(!is_null($questionFormula) && intval($questionId) === $questionFormula->question_id){
            //     $risk->update([
            //         'initial_risk' => $questionAnswer
            //     ]);
            // }
        }

        $this->emit('responseForm', $this->sheetForm['edit']);
        $this->emit('calculateScale');
        $this->sheetForm['edit'] = true;
        $this->getQuestionsAnswer();
        $this->getInitialResidualRisk();
    }

    public function getAnswerWithoutPrefix(){
        $newAswers = array_combine(
            array_map(fn($key) => str_replace('qs-', '', $key), array_keys($this->questionsAnswer)),
            $this->questionsAnswer
        );

        return $newAswers;
    }

    public function formData($data)
    {
        $this->questionsAnswer = $data;
        if (!$this->sheetForm['edit']) {
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
        //get Scales and probability e impact
        $scalesMax = TBRiskAnalysis_ScalesArModel::where('risk_analysis_id', $this->riskAnalysisId)->first();
        $this->scales = TBRiskAnalysisScaleModel::where('min_max_id',$scalesMax->id)->orderBy('id','asc')->get();
        $probsMax = TBRiskAnalysis_ProbImpArModel::where('risk_analysis_id', $this->riskAnalysisId)->first();
        $this->probImpa = $probsMax;
        //get Sections
        $sectionsRegisters = TBSectionRiskAnalysisModel::select('id', 'title', 'position', 'risk_analysis_id')
            ->where('risk_analysis_id', $this->riskAnalysisId)
            ->get();

        //Header Settings Table
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
        //Questions formulas
        $this->getIdsQuestionsFormulas();
        // period completed
        $verifyPeriod = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            ->where('status', 'completed')
            ->exists();
        $this->verifyPeriod = $verifyPeriod;
        //verify period in progress
        $verifyPeriodProgress = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
            ->where('status', 'in-progress')
            ->exists();

        if ($verifyPeriodProgress) {
            $period = TBPeriodRiskAnalysisModel::where('risk_analysis_id', $this->riskAnalysisId)
                ->where('status', 'in-progress')
                ->first();
            $this->period_id = $period->id;

            // get answers table general
            $existSheets = TBPeriodSheetRiskAnalysisModel::where('period_id', $period->id)->exists();
            if ($existSheets) {
                $sheetsTable = TBPeriodSheetRiskAnalysisModel::where('period_id', $period->id)->get();
                $this->verifyAnswers = true;
                foreach ($sheetsTable as $sheetTable) {
                    $this->answersTable = [];
                    $empty1 = [];
                    $empty2 = [];
                    if ($sheetTable->sheet->answersSheet->count()) {
                        foreach ($sheetTable->sheet->answersSheet as $answerSheet) {
                            foreach ($this->questionSettigns as $questionSetting) {
                                if ($questionSetting->question_id === $answerSheet->question_id) {
                                    // dump($questionSetting);
                                    $this->answersTable[] = $answerSheet;
                                } else {
                                    // $this->answersTable[] = [];
                                }
                            }

                            foreach ($this->formulasSettings as $formulaSetting) {
                                // dump($formulasSetting);
                                if ($formulaSetting->formula->question_id === $answerSheet->question_id) {
                                    $this->answersTable[] = $answerSheet;
                                } else {
                                    // $this->answersTable[] = [];
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

        $this->emitTo('analisis-riesgos.treatment-plan', 'treatmentPlan', $this->period_id, $this->riskAnalysisId);
        // $this->emit('TreatmentPlan',$this->period_id);

        // if ($this->sheetId) {
        //     $this->getControlsSheet();
        // }

        // verify % risk initial
        // dd($this->formulasSettings);
            // dump($formulaSetting->formula->riesgo);






        $this->emit('scriptTabla');
        // $this->emit('scriptTabla2');
        // dump("kk");

        return view('livewire.analisis-riesgos.form-risk-analysis');
    }
}
