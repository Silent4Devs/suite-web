<?php

namespace App\Http\Livewire\AnalisisRiesgos;

use App\Models\TBAnswerRASheetRAModel;
use App\Models\TBAnswerSheetRiskAnalysisModel;
use App\Models\TBPeriodRiskAnalysisModel;
use App\Models\TBPeriodSheetRiskAnalysisModel;
use App\Models\TBSectionRiskAnalysisModel;
use App\Models\TBSettingsAr_FormulasArModel;
use App\Models\TBSettingsAr_QuestionsArModel;
use App\Models\TBSheetRiskAnalysisModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Sheet;

class FormRiskAnalysis extends Component
{
    public $riskAnalysisId;
    public $settignsTable = [];
    public $sections;
    public $questionsAnswer = [];

    public $verifyPeriod;
    public $period_id;
    public $questionSettigns;
    public $formulasSettings;
    public $answersTable = [];
    public $verifyAnswers;
    public $sheetTables;
    public $sheetId;
    public $statusForm= false; //status form modal false=create, true=edit
    public $answersForm;
    // public $sectionsRegisters;

    protected $listeners = ['formData'];

    public function getQuestionsAnswer(){
        // dd($this->sheetId);
        $this->answersForm = TBAnswerRASheetRAModel::where('sheet_id',$this->sheetId)->get();
        dd($this->answersForm);
    }

    public function chageStatusForm($status,$id)
    {
        $this->statusForm = $status;
        $this->sheetId = $id;
        $this->getQuestionsAnswer();
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

    public function formData($data)
    {
        $this->questionsAnswer = $data;
        // dd($this->questionsAnswer);
        foreach($this->questionsAnswer as $index => $questionAnswer){
            $questionId = str_replace('qs-', '', $index);
            // dump($questionId);
            // dump('indice:'. $index . ' value:'.$questionAnswer);
            $answerRegister = TBAnswerSheetRiskAnalysisModel::create([
                'question_id' => $questionId,
                'value' => $questionAnswer
            ]);

            TBAnswerRASheetRAModel::create([
                'sheet_id'=>$this->sheetId,
                'answer_id'=> $answerRegister->id
            ]);
        }
    }

    public function mount($RiskAnalysisId)
    {
        $this->riskAnalysisId = $RiskAnalysisId;
    }

    public function render()
    {
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
                            // dd($this->answersTable);
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

        $this->emit('scriptTabla');

        // dd($sheetTable->sheet,$this->questionsAnswer);

        return view('livewire.analisis-riesgos.form-risk-analysis');
    }
}
