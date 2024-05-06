<?php

namespace App\Http\Controllers\Api\v1\AnalisisRiesgo;

use App\Http\Controllers\Controller;
use App\Models\TBSectionTemplateAnalisisRiesgoModel;
use App\Models\TBQuestionTemplateAnalisisRiesgoModel;
use App\Models\TBFormulaTemplateAnalisisRiesgoModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FormulasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newFormulas = $request->input('formulas');;
        $this->saveFormulas($newFormulas);
        return json_encode(['data' => 'Se crearon exitosamente las formulas'], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $formulas =TBFormulaTemplateAnalisisRiesgoModel::where('template_id',$id)->get();
        foreach($formulas as $formula){
            Arr::forget($formula, 'created_at');
            Arr::forget($formula, 'updated_at');
            Arr::forget($formula, 'deleted_at');
            Arr::forget($formula, 'template_id');
        }
        return json_encode(['data' => ['formulas'=>$formulas]], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formula = TBFormulaTemplateAnalisisRiesgoModel::findOrFail($id);
        $formula->delete();
        return json_encode(['data' => 'Se elimino el registro exitosamente'], 200);
    }

    public function filterOptions(&$options, $questions){
        foreach($questions as $question){
            $newQuestion = $question;

            Arr::forget($newQuestion, 'created_at');
            Arr::forget($newQuestion, 'updated_at');
            Arr::forget($newQuestion, 'pivot');
            Arr::forget($newQuestion, 'deleted_at');
            Arr::forget($newQuestion, 'size');
            Arr::forget($newQuestion, 'position');
            Arr::forget($newQuestion, 'obligatory');

            switch($question->type){
                case '3':
                    Arr::forget($newQuestion, 'type');
                    array_push($options, $newQuestion);
                    break;
                case '6':
                    Arr::forget($newQuestion, 'type');
                    array_push($options, $newQuestion);
                    break;
                default:
            }
        }
    }

    public function getOptionsFormulas($id){
        $sections = TBSectionTemplateAnalisisRiesgoModel::where('template_id',$id)->get();
        $options = [];

        foreach($sections as $section){
            $questions = $section->questions;

            $this->filterOptions($options,$questions);
        }

        return json_encode(['data' => ['options' => $options]], 200);
    }

    public function saveFormulas($newFormulas){
        foreach($newFormulas as $newFormula){
            DB::beginTransaction();
            try {
                TBFormulaTemplateAnalisisRiesgoModel::create([
                    'title'=> $newFormula['title'],
                    'formula' => $newFormula['formula'],
                    'riesgo' => $newFormula['riesgo'],
                    'template_id' => $newFormula['template_id'],
                ]);
                DB::commit();
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollback();
                continue;
            }
        }
    }

}
