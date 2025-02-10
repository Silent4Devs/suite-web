<?php

namespace App\Http\Controllers\Api\V1\AnalisisRiesgo;

use App\Http\Controllers\Controller;
use App\Models\TBDataQuestionTemplateAnalisisRiesgoModel;
use App\Models\TBFormulaTemplateAnalisisRiesgoModel;
use App\Models\TBQuestionTemplateAnalisisRiesgoModel;
use App\Models\TBQuestionTemplateAr_DataQuestionTemplateArModel;
use App\Models\TBSectionTemplateAnalisisRiesgoModel;
use App\Models\TBSectionTemplateAr_QuestionTemplateArModel;
use App\Models\TBSettingsTemplateAR_TBFormulaTemplateARModel;
use App\Models\TBSettingsTemplateAR_TBQuestionTemplateARModel;
use App\Models\TBTemplateAnalisisRiesgoModel;
use App\Models\Template_Analisis_Riesgos;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class templateAnalisisRiesgoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $sections = json_decode($request->input('sections'));
        $questions = json_decode($request->input('questions'));
        $imagenes = $request->file('image');
        $templateId = $sections[0]->template_id;
        $sectionId = $sections[0]->id;
        if (! empty($imagenes)) {
            $this->saveImage($questions, $imagenes);
        }

        $this->saveSections($sections, $questions);

        $this->createQuestionsDefault($templateId, $sectionId);

        return json_encode(['data' => 'Sections and questions created successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $template = TBTemplateAnalisisRiesgoModel::findOrFail($id);

            $sections = TBSectionTemplateAnalisisRiesgoModel::select('id', 'title', 'template_id', 'position')
                ->where('template_id', $template->id)->get();

            $questions = [];

            foreach ($sections as $section) {
                $data = $section->questions;
                $sectionId = $section->id;

                $filter = $data->reject(function ($registro) {
                    if ($registro['type'] === '11' || $registro['type'] === '12' || $registro['type'] === '13' || $registro['type'] === '14') {
                        return $registro;
                    }
                });

                $newQuestions = $filter->map(function ($itm) use ($sectionId) {
                    Arr::forget($itm, 'created_at');
                    Arr::forget($itm, 'updated_at');
                    Arr::forget($itm, 'pivot');
                    Arr::forget($itm, 'deleted_at');
                    $itm->columnId = $sectionId;
                    $itm->isNumeric = $itm->is_numeric;

                    Arr::forget($itm, 'is_numeric');
                    $this->getDataQuestion($itm);

                    return $itm;
                });

                Arr::forget($section, 'questions');

                foreach ($newQuestions as $newQuestion) {
                    array_push($questions, $newQuestion);
                }
            }

            return json_encode(['data' => ['sections' => $sections, 'questions' => $questions]], 200);

        } catch (\Throwable $th) {
            throw $th;

            return response()->json(['message' => 'No encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, Request $request)
    {
        $templateId = $id;
        $requestSections = json_decode($request->input('sections'));
        $requestQuestions = json_decode($request->input('questions'));
        $imagenes = $request->file('image');
        if (! empty($imagenes)) {
            $this->saveImage($requestQuestions, $imagenes);
        }
        $dataFilter = $this->filterData($requestSections, $requestQuestions);
        $sections = $dataFilter['sections'];
        $newSections = $dataFilter['newSections'];
        $questions = $dataFilter['questions'];
        $newQuestions = $dataFilter['newQuestions'];

        $this->saveSections($newSections, $newQuestions);

        $this->updateSections($sections);
        $this->updateQuestions($questions, $templateId);

        return json_encode(['data' => 'Se actualizaron exitosamente las secciones y las preguntas']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template_Analisis_Riesgos $template_Analisis_Riesgos)
    {
        //
    }

    public function saveSections($sections, $questions)
    {
        DB::beginTransaction();
        try {
            foreach ($sections as $section) {
                $sectionId = $section->id;
                $templateId = $section->template_id;
                $questionsFilter = array_filter($questions, function ($item) use ($sectionId) {
                    return $item->columnId === $sectionId;
                });

                $sectionCreate = TBSectionTemplateAnalisisRiesgoModel::create([
                    'title' => $section->title,
                    'template_id' => $templateId,
                    'position' => $section->position,
                ]);
                $sectionId = $sectionCreate->id;
                $this->saveQuestions($sectionId, $questionsFilter, $templateId);
            }
            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
        }
    }

    public function saveQuestions($sectionId, $questions, $templateId)
    {
        foreach ($questions as $question) {
            $id = $question->id;
            $exist = intval($id);
            if (! $exist) {
                DB::beginTransaction();
                try {
                    $uuid = $this->verifyUuidFormula($question);
                    $questionCreate = TBQuestionTemplateAnalisisRiesgoModel::create([
                        'title' => $question->title,
                        'size' => $question->size,
                        'type' => $question->type,
                        'position' => $question->position,
                        'obligatory' => $question->obligatory,
                        'is_numeric' => $question->isNumeric,
                        'uuid_formula' => $uuid ? $uuid : null,
                    ]);

                    TBSectionTemplateAr_QuestionTemplateArModel::create([
                        'section_id' => $sectionId,
                        'question_id' => $questionCreate->id,
                    ]);

                    TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
                        'template_id' => $templateId,
                        'question_id' => $questionCreate->id,
                        'is_show' => false,
                    ]);

                    $this->filterSaveDataQuestion($question, $questionCreate);
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollback();

                    continue;
                }
            } else {
                $pivot = TBSectionTemplateAr_QuestionTemplateArModel::where('question_id', $id)->first();
                $register = TBQuestionTemplateAnalisisRiesgoModel::where('id', $id)->first();
                DB::beginTransaction();
                try {
                    $register->update([
                        'title' => $question['title'],
                        'size' => $question['size'],
                        'type' => $question['type'],
                        'position' => $question['position'],
                        'obligatory' => $question['obligatory'],
                        'is_numeric' => $question->isNumeric,
                    ]);
                    $pivot->update(
                        ['section_id' => $sectionId],
                    );
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollback();

                    continue;
                }
            }
        }

    }

    public function updateSections($sections)
    {
        foreach ($sections as $section) {
            $id = $section->id;
            $sectionRegister = TBSectionTemplateAnalisisRiesgoModel::find($id);
            DB::beginTransaction();
            try {
                $sectionRegister->update([
                    'title' => $section->title,
                    'position' => $section->position,
                ]);
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();

                continue;
            }
        }
    }

    public function updateQuestions($questions, $templateId)
    {
        foreach ($questions as $question) {
            $id = $question->id;
            $exist = intval($id);

            if ($exist) {
                $pivot = TBSectionTemplateAr_QuestionTemplateArModel::where('question_id', $id)->first();
                $register = TBQuestionTemplateAnalisisRiesgoModel::where('id', $id)->first();
                DB::beginTransaction();
                try {
                    $register->update([
                        'title' => $question->title,
                        'size' => $question->size,
                        'type' => $question->type,
                        'position' => $question->position,
                        'obligatory' => $question->obligatory,
                        'is_numeric' => $question->isNumeric,
                    ]);
                    $pivot->update(
                        ['section_id' => $question->columnId],
                    );

                    $this->filterUpdateDataQuestion($question, $id);
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollback();

                    continue;
                }
            } else {

                DB::beginTransaction();
                try {
                    $questionCreate = TBQuestionTemplateAnalisisRiesgoModel::create([
                        'title' => $question->title,
                        'size' => $question->size,
                        'type' => $question->type,
                        'position' => $question->position,
                        'obligatory' => $question->obligatory,
                        'is_numeric' => $question->isNumeric,
                    ]);

                    TBSectionTemplateAr_QuestionTemplateArModel::create([
                        'section_id' => $question->columnId,
                        'question_id' => $questionCreate->id,
                    ]);

                    TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
                        'template_id' => $templateId,
                        'question_id' => $questionCreate->id,
                        'is_show' => false,
                    ]);

                    $this->filterSaveDataQuestion($question, $questionCreate);
                    DB::commit();
                } catch (\Throwable $th) {
                    // throw $th;
                    DB::rollback();

                    continue;
                }

            }
        }

    }

    public function filterData($requestSections, $requestQuestions)
    {
        $sections = [];
        $questions = [];
        $newSections = [];
        $newQuestions = [];

        foreach ($requestSections as $requestSection) {
            $id = intval($requestSection->id);
            if ($id) {
                $sections[] = $requestSection;
            } else {

                $newSections[] = $requestSection;
            }
        }

        foreach ($requestQuestions as $requestQuestion) {
            $id = intval($requestQuestion->id);
            $columnId = intval($requestQuestion->columnId);

            if ($id && $columnId) {
                $questions[] = $requestQuestion;
            } elseif ($columnId) {
                $questions[] = $requestQuestion;

            } else {
                $newQuestions[] = $requestQuestion;
            }
        }

        return ['sections' => $sections, 'newSections' => $newSections, 'questions' => $questions, 'newQuestions' => $newQuestions];
    }

    public function filterSaveDataQuestion($question, $questionCreate)
    {
        switch ($question->type) {
            case '3':
                $this->saveDataQuestionMinMax($question->data, $questionCreate->id);
                break;
            case '4':
                $this->saveDataQuestionCatalog($question->data, $questionCreate->id);
                break;
            case '5':
                $this->saveMultipleDataQuestion($question->data, $questionCreate->id);
                break;
            case '6':
                $this->saveMultipleDataQuestion($question->data, $questionCreate->id);
                break;
            case '7':
                $this->saveSelectDataQuestion($question->data, $questionCreate->id);
                break;
            case '10':
                $this->saveImageDataQuestion($question->data, $questionCreate->id);
                break;
            case '15':
                $this->saveDataQuestionMinMax($question->data, $questionCreate->id);
                break;
            default:
                break;
        }
    }

    public function filterUpdateDataQuestion($question, $questionCreate)
    {
        switch ($question->type) {
            case '3':
                $this->updateDataQuestionMinMax($question->data, $questionCreate);
                break;
            case '4':
                $this->updateDataQuestionCatalog($question->data);
                break;
            case '5':
                $this->updateMultipleDataQuestion($question->data, $questionCreate);
                break;
            case '6':
                $this->updateMultipleDataQuestion($question->data, $questionCreate);
                break;
            case '7':
                $this->updateSelectDataQuestion($question->data, $questionCreate);
                break;
            case '10':
                $this->updateImageDataQuestion($question->data, $questionCreate);
                break;
            case '15':
                $this->updateDataQuestionMinMax($question->data, $questionCreate);
                break;
            default:
                break;
        }
    }

    public function saveDataQuestionMinMax($dataQuestion, $questionCreateId)
    {
        DB::beginTransaction();
        try {
            $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
                'minimum' => intval($dataQuestion->minimo),
                'maximum' => intval($dataQuestion->maximo),
            ]);

            TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
                'question_id' => $questionCreateId,
                'dataquestion_id' => $dataQuestionCreate->id,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
        }

    }

    public function updateDataQuestionMinMax($dataQuestion)
    {

        DB::beginTransaction();
        $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($dataQuestion->id);

        try {
            $register->update([
                'minimum' => intval($dataQuestion->minimo),
                'maximum' => intval($dataQuestion->maximo),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
        }

    }

    public function saveDataQuestionCatalog($dataQuestion, $questionCreateId)
    {
        DB::beginTransaction();
        try {
            $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
                'title' => ($dataQuestion->title),
                'catalog' => intval($dataQuestion->catalog),
            ]);

            TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
                'question_id' => $questionCreateId,
                'dataquestion_id' => $dataQuestionCreate->id,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
        }

    }

    public function updateDataQuestionCatalog($dataQuestion)
    {

        DB::beginTransaction();
        $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($dataQuestion->id);

        try {
            $register->update([
                'title' => $dataQuestion->title,
                'catalog' => intval($dataQuestion->catalog),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
        }

    }

    public function saveMultipleDataQuestion($dataQuestions, $questionCreateId)
    {
        foreach ($dataQuestions as $dataQuestion) {
            DB::beginTransaction();
            try {
                $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
                    'title' => $dataQuestion->title,
                    'name' => $dataQuestion->name,
                    'status' => $dataQuestion->status,
                    'value' => $dataQuestion->value,
                ]);

                TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
                    'question_id' => $questionCreateId,
                    'dataquestion_id' => $dataQuestionCreate->id,
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                // throw $th;
                DB::rollback();

                continue;
            }
        }
    }

    public function updateMultipleDataQuestion($dataQuestions, $questionCreateId)
    {
        foreach ($dataQuestions as $dataQuestion) {
            $id = $dataQuestion->id;
            if (is_int($id)) {
                DB::beginTransaction();
                $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($id);
                try {
                    $register->update([
                        'title' => $dataQuestion->title,
                        'name' => $dataQuestion->name,
                        'status' => $dataQuestion->status,
                        'value' => $dataQuestion->value,
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    // throw $th;
                    DB::rollback();

                    continue;
                }
            } else {
                DB::beginTransaction();
                try {
                    $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
                        'title' => $dataQuestion->title,
                        'name' => $dataQuestion->name,
                        'status' => $dataQuestion->status,
                    ]);

                    TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
                        'question_id' => $questionCreateId,
                        'dataquestion_id' => $dataQuestionCreate->id,
                    ]);

                    DB::commit();
                } catch (\Throwable $th) {
                    // throw $th;
                    DB::rollback();

                    continue;
                }
            }
        }
    }

    public function saveSelectDataQuestion($dataQuestions, $questionCreateId)
    {
        // dd($dataQuestions);
        foreach ($dataQuestions as $dataQuestion) {
            DB::beginTransaction();
            try {
                $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
                    'title' => $dataQuestion->title,
                    'name' => $dataQuestion->name,
                    'value' => $dataQuestion->value,
                ]);

                TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
                    'question_id' => $questionCreateId,
                    'dataquestion_id' => $dataQuestionCreate->id,
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                // throw $th;
                // dd($th);
                DB::rollback();

                continue;
            }
        }
    }

    public function updateSelectDataQuestion($dataQuestions, $questionCreateId)
    {
        foreach ($dataQuestions as $dataQuestion) {
            $id = $dataQuestion->id;
            if (is_int($id)) {
                DB::beginTransaction();
                $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($id);
                try {
                    $register->update([
                        'title' => $dataQuestion->title,
                        'name' => $dataQuestion->name,
                        'value' => $dataQuestion->value,

                    ]);

                    DB::commit();
                } catch (\Throwable $th) {
                    // throw $th;
                    DB::rollback();

                    continue;
                }
            } else {
                DB::beginTransaction();
                try {
                    $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
                        'title' => $dataQuestion->title,
                        'name' => $dataQuestion->name,
                    ]);

                    TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
                        'question_id' => $questionCreateId,
                        'dataquestion_id' => $dataQuestionCreate->id,
                    ]);

                    DB::commit();
                } catch (\Throwable $th) {
                    // throw $th;
                    DB::rollback();

                    continue;
                }
            }
        }
    }

    public function saveImageDataQuestion($dataQuestions, $questionCreateId)
    {

        DB::beginTransaction();
        try {

            $dataQuestionCreate = TBDataQuestionTemplateAnalisisRiesgoModel::create([
                'url' => $dataQuestions->name,
            ]);
            TBQuestionTemplateAr_DataQuestionTemplateArModel::create([
                'question_id' => $questionCreateId,
                'dataquestion_id' => $dataQuestionCreate->id,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
        }

        // $extension = pathinfo($dataQuestions->file('file')->getClientOriginalName(), PATHINFO_EXTENSION);
        // $new_name_image = 'Template_AR_Question_Image'.$extension;

        // $route = storage_path().'/app/public/analisis_riesgo/template/questions/'.$new_name_image;
        // $image = $new_name_image;

        // // Call the ImageService to consume the external API
        // $apiResponse = ImageService::consumeImageCompresorApi($dataQuestions->file('file'));

        // // Compress and save the image
        // if ($apiResponse['status'] == 200) {
        //     file_put_contents($route, $apiResponse['body']);
        // }
    }

    public function updateImageDataQuestion($dataQuestions, $questionId)
    {
        if (property_exists($dataQuestions, 'name')) {
            DB::beginTransaction();
            $register = TBDataQuestionTemplateAnalisisRiesgoModel::find($questionId);
            try {
                $register->update([
                    'url' => $dataQuestions->name,
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                // throw $th;
                DB::rollback();
            }
        }

    }

    public function getDataQuestion($question)
    {
        $register = TBQuestionTemplateAnalisisRiesgoModel::findOrFail($question->id);
        $data = $register->dataQuestions;
        switch ($question->type) {
            case '3':
                foreach ($data as $item) {
                    Arr::forget($item, 'created_at');
                    Arr::forget($item, 'updated_at');
                    Arr::forget($item, 'deleted_at');
                    Arr::forget($item, 'pivot');
                    Arr::forget($item, 'title');
                    Arr::forget($item, 'name');
                    Arr::forget($item, 'status');

                    $item->minimo = $item->minimum;
                    $item->maximo = $item->maximum;

                    Arr::forget($item, 'minimum');
                    Arr::forget($item, 'maximum');

                }
                break;
            case '4':
                foreach ($data as $item) {
                    Arr::forget($item, 'created_at');
                    Arr::forget($item, 'updated_at');
                    Arr::forget($item, 'deleted_at');
                    Arr::forget($item, 'pivot');
                    Arr::forget($item, 'name');
                    Arr::forget($item, 'status');
                    Arr::forget($item, 'minimum');
                    Arr::forget($item, 'maximum');
                    Arr::forget($item, 'url');

                    // $item->id = $item->catalog;

                    // Arr::forget($item, 'catalog');

                }
                break;
            case '5':
                foreach ($data as $item) {
                    Arr::forget($item, 'created_at');
                    Arr::forget($item, 'updated_at');
                    Arr::forget($item, 'deleted_at');
                    Arr::forget($item, 'pivot');
                    Arr::forget($item, 'minimum');
                    Arr::forget($item, 'maximum');
                }
                break;
            case '6':
                foreach ($data as $item) {
                    Arr::forget($item, 'created_at');
                    Arr::forget($item, 'updated_at');
                    Arr::forget($item, 'deleted_at');
                    Arr::forget($item, 'pivot');
                    Arr::forget($item, 'minimum');
                    Arr::forget($item, 'maximum');
                }
                break;
            case '7':
                foreach ($data as $item) {
                    Arr::forget($item, 'created_at');
                    Arr::forget($item, 'updated_at');
                    Arr::forget($item, 'deleted_at');
                    Arr::forget($item, 'pivot');
                    Arr::forget($item, 'minimum');
                    Arr::forget($item, 'maximum');
                    Arr::forget($item, 'status');
                }
                break;
            case '10':
                foreach ($data as $item) {
                    Arr::forget($item, 'created_at');
                    Arr::forget($item, 'updated_at');
                    Arr::forget($item, 'deleted_at');
                    Arr::forget($item, 'pivot');
                    Arr::forget($item, 'minimum');
                    Arr::forget($item, 'maximum');
                    Arr::forget($item, 'title');
                    Arr::forget($item, 'name');
                    Arr::forget($item, 'status');

                    $fileName = $item->url;
                    $path = asset('storage/analisis_riesgo/template/questions/'.$fileName);
                    $item->url = $path;
                }
                break;
            case '15':
                foreach ($data as $item) {
                    Arr::forget($item, 'created_at');
                    Arr::forget($item, 'updated_at');
                    Arr::forget($item, 'deleted_at');
                    Arr::forget($item, 'pivot');
                    Arr::forget($item, 'title');
                    Arr::forget($item, 'name');
                    Arr::forget($item, 'status');
                    Arr::forget($item, 'catalog');
                    Arr::forget($item, 'value');
                    Arr::forget($item, 'url');

                    $item->minimo = $item->minimum;
                    $item->maximo = $item->maximum;

                    Arr::forget($item, 'minimum');
                    Arr::forget($item, 'maximum');

                }
                break;
            default:
                break;
        }
        $question->data = $data;
    }

    public function destroySection($id)
    {
        $section = TBSectionTemplateAnalisisRiesgoModel::find($id);
        $section->delete();

        return json_encode(['data' => 'Se elimino el registro exitosamente'], 200);
    }

    public function destroyQuestion($id)
    {
        $pivot = TBSectionTemplateAr_QuestionTemplateArModel::find($id);
        $question = TBQuestionTemplateAnalisisRiesgoModel::find($id);

        $question->delete();
        $pivot->delete();

        return json_encode(['data' => 'Se elimino el registro exitosamente'], 200);

    }

    public function destroyDataQuestion($id)
    {
        $pivot = TBQuestionTemplateAr_DataQuestionTemplateArModel::find($id);
        $dataQuestion = TBDataQuestionTemplateAnalisisRiesgoModel::find($id);

        $dataQuestion->delete();
        $pivot->delete();

        return json_encode(['data' => 'Se elimino el registro exitosamente'], 200);

    }

    public function getSettings(int $id)
    {
        try {
            $template = TBTemplateAnalisisRiesgoModel::findOrFail($id);

            $sections = TBSectionTemplateAnalisisRiesgoModel::select('id', 'title', 'template_id', 'position')
                ->where('template_id', $template->id)->get();

            $formulas = TBFormulaTemplateAnalisisRiesgoModel::where('template_id', $id)->get();

            foreach ($formulas as $formula) {
                Arr::forget($formula, 'created_at');
                Arr::forget($formula, 'updated_at');
                Arr::forget($formula, 'deleted_at');
                Arr::forget($formula, 'template_id');
            }

            $exists = $this->verifyInputsDefault($sections);
            $questions = [];

            // $optionId = ([
            //     'id' => 'q-1',
            //     'title' => 'ID',
            //     'template' => $template->id,
            //     'position' => 0,
            //     'type' => '12',
            //     'size' => 3,
            //     'obligatory' => true,
            //     'data' => [],
            // ]);

            // $optionDescription = ([
            //     'id' => 'q-2',
            //     'title' => 'Descripcion del riesgo',
            //     'template' => $template->id,
            //     'position' => 1,
            //     'type' => '12',
            //     'size' => 3,
            //     'obligatory' => true,
            //     'data' => [],
            // ]);

            // $optionOwner = ([
            //     'id' => 'q-3',
            //     'title' => 'Dueño del riesgo',
            //     'template' => $template->id,
            //     'position' => 2,
            //     'type' => '13',
            //     'size' => 3,
            //     'obligatory' => true,
            //     'data' => [],
            // ]);

            if ($exists) {
                foreach ($sections as $index => $section) {
                    $data = $section->questions;
                    $sectionId = $section->id;
                    $newQuestions = $data->map(function ($itm) use ($sectionId) {
                        // if ($index === 0) {
                        //     $itm['type'] === '11' ? $itm['position'] = $itm['position'] + 5 : null;
                        //     if ($itm['type'] !== '10' && $itm['type'] !== '11' && $itm['type'] !== '12' && $itm['type'] !== '13' && $itm['type'] !== '14') {
                        //         $itm['position'] = $itm['position'] + 5;
                        //     }
                        // }
                        Arr::forget($itm, 'created_at');
                        Arr::forget($itm, 'updated_at');
                        Arr::forget($itm, 'pivot');
                        Arr::forget($itm, 'deleted_at');
                        $itm->columnId = $sectionId;

                        $itm->isNumeric = $itm->is_numeric;
                        Arr::forget($itm, 'is_numeric');

                        $this->getDataQuestion($itm);

                        return $itm;
                    });

                    $questions = array_merge($questions, $newQuestions->toArray());

                    Arr::forget($section, 'questions');
                }
            } else {
                foreach ($sections as $index => $section) {
                    $data = $section->questions;
                    $sectionId = $section->id;
                    if ($index === 0) {
                        $optionId['columnId'] = $sectionId;
                        $optionDescription['columnId'] = $sectionId;
                        $optionOwner['columnId'] = $sectionId;
                    }
                    $newQuestions = $data->map(function ($itm) use ($sectionId, $index, &$optionId) {
                        if ($index === 0) {
                            $itm['type'] === '11' ? $itm['position'] = $itm['position'] + 5 : null;
                            $itm['type'] !== '11' ? $itm['position'] = $itm['position'] + 6 : null;
                        }
                        // if($itm['type'] !== "11"){
                        //     $position = $itm['position'];
                        //     $itm['position'] = $position + 1;
                        // }
                        Arr::forget($itm, 'created_at');
                        Arr::forget($itm, 'updated_at');
                        Arr::forget($itm, 'pivot');
                        Arr::forget($itm, 'deleted_at');
                        $itm->columnId = $sectionId;
                        $this->getDataQuestion($itm);

                        return $itm;
                    });
                    $questions = array_merge($questions, $newQuestions->toArray());

                    Arr::forget($section, 'questions');
                }
                $questions[] = ($optionId);
                $questions[] = ($optionDescription);
                $questions[] = ($optionOwner);

            }

            return json_encode(['data' => ['sections' => $sections, 'questions' => $questions]], 200);

        } catch (\Throwable $th) {
            throw $th;

            return response()->json(['message' => 'No encontrado'], 404);
        }
    }

    public function getInfoTemplate(int $id)
    {
        $register = TBTemplateAnalisisRiesgoModel::find($id);
        $template = ([
            'id' => $register->id,
            'title' => $register->nombre,
            'norma' => $register->norma->norma,
            'description' => $register->descripcion,
        ]);

        return json_encode(['data' => ['template' => $template]], 200);
    }

    public function verifyInputsDefault($sections)
    {
        $existInputId = false;

        foreach ($sections as $index => $section) {
            $existInputCreateBy = false;

            $questions = $section->questions;

            foreach ($questions as $question) {

                if ($question['type'] === '12') {
                    $existInputId = true;
                }

            }
        }

        return $existInputId;

    }

    public function saveImage(&$questions, $imagenes)
    {
        $today = Carbon::now();
        $date = $today->format('d-m-Y');
        $filter = array_filter($questions, function ($item) use ($imagenes) {
            if ($item->type === '10' && Arr::exists($imagenes, $item->id)) {
                return $item;
            }
        });

        foreach ($filter as $question) {
            $key = $question->id;
            $imagen = $imagenes[$key];
            $name = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = pathinfo($imagen->getClientOriginalName(), PATHINFO_EXTENSION);
            $new_name_image = 'Template_AR_Question_Image_'.$name.'_'.$date.'.'.$extension;

            $route = storage_path().'/app/public/analisis_riesgo/template/questions/'.$new_name_image;
            $image = $new_name_image;

            // Call the ImageService to consume the external API
            $apiResponse = ImageService::consumeImageCompresorApi($imagen);

            // Compress and save the image
            if ($apiResponse['status'] == 200) {
                file_put_contents($route, $apiResponse['body']);
                foreach ($questions as $question) {
                    if ($question->id === $key) {
                        $question->data->name = $new_name_image;
                    }
                }
            }

        }

    }

    public function getSettingsTable(int $id)
    {
        $questionsRegisters = TBSettingsTemplateAR_TBQuestionTemplateARModel::select('id', 'question_id', 'is_show')->where('template_id', $id)->orderBy('id', 'asc')->get();
        $formulasRegisters = TBSettingsTemplateAR_TBFormulaTemplateARModel::select('id', 'formula_id', 'is_show')->where('template_id', $id)->orderBy('id', 'asc')->get();
        foreach ($questionsRegisters as $questionRegister) {
            $questionRegister->title = $questionRegister->question->title;
            Arr::forget($questionRegister, 'question');
        }
        foreach ($formulasRegisters as $formulaRegister) {
            $formulaRegister->title = $formulaRegister->formula->title;
            Arr::forget($formulaRegister, 'formula');
        }

        return json_encode(['data' => ['questions' => $questionsRegisters, 'formulas' => $formulasRegisters]], 200);
    }

    public function updateSettingsTable(Request $request)
    {
        $questions = $request['questions'];
        $formulas = $request['formulas'];

        foreach ($questions as $question) {
            try {
                $questionRegister = TBSettingsTemplateAR_TBQuestionTemplateARModel::findOrFail($question['question_id']);
                DB::beginTransaction();

                $questionRegister->update([
                    'is_show' => $question['is_show'],
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                // throw $th;
                DB::rollback();

                continue;
            }
        }

        foreach ($formulas as $formula) {
            try {
                $formulaRegister = TBSettingsTemplateAR_TBFormulaTemplateARModel::findOrFail($formula['formula_id']);
                DB::beginTransaction();

                $formulaRegister->update([
                    'is_show' => $formula['is_show'],
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                // throw $th;
                DB::rollback();

                continue;
            }
        }

        return json_encode(['data' => 'Table Settigns updated successfully']);
    }

    public function createQuestionsDefault($templateId, $sectionId)
    {
        $sectionRegister = TBSectionTemplateAnalisisRiesgoModel::where('template_id', $templateId)->first();

        $optionId = ([
            'title' => 'ID',
            'position' => 0,
            'type' => '12',
            'size' => 3,
            'obligatory' => true,
            'data' => [],
        ]);

        $optionDescription = ([
            'title' => 'Descripcion del riesgo',
            'position' => 1,
            'type' => '12',
            'size' => 3,
            'obligatory' => true,
            'data' => [],
        ]);

        $optionOwner = ([
            'title' => 'Dueño del riesgo',
            'position' => 2,
            'type' => '13',
            'size' => 3,
            'obligatory' => true,
            'data' => [],
        ]);

        $optionProb = ([
            'title' => 'Probabilidad',
            'position' => 3,
            'type' => '14',
            'size' => 3,
            'obligatory' => true,
            'data' => [],
            'uuid_formula' => substr(Str::uuid(), 0, 5),
        ]);

        $optionImpa = ([
            'title' => 'Impacto',
            'position' => 4,
            'type' => '14',
            'size' => 3,
            'obligatory' => true,
            'data' => [],
            'uuid_formula' => substr(Str::uuid(), 0, 5),
        ]);

        $questionOptionId = TBQuestionTemplateAnalisisRiesgoModel::create($optionId);

        TBSectionTemplateAr_QuestionTemplateArModel::create([
            'section_id' => $sectionRegister->id,
            'question_id' => $questionOptionId->id,
        ]);

        TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
            'template_id' => $sectionRegister->id,
            'question_id' => $questionOptionId->id,
            'is_show' => false,
        ]);

        $questionOptionDescription = TBQuestionTemplateAnalisisRiesgoModel::create($optionDescription);

        TBSectionTemplateAr_QuestionTemplateArModel::create([
            'section_id' => $sectionRegister->id,
            'question_id' => $questionOptionDescription->id,
        ]);

        TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
            'template_id' => $sectionRegister->id,
            'question_id' => $questionOptionDescription->id,
            'is_show' => false,
        ]);

        $questionOptionOwner = TBQuestionTemplateAnalisisRiesgoModel::create($optionOwner);

        TBSectionTemplateAr_QuestionTemplateArModel::create([
            'section_id' => $sectionRegister->id,
            'question_id' => $questionOptionOwner->id,
        ]);

        TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
            'template_id' => $sectionRegister->id,
            'question_id' => $questionOptionOwner->id,
            'is_show' => false,
        ]);

        $questionOptionProb = TBQuestionTemplateAnalisisRiesgoModel::create($optionProb);

        TBSectionTemplateAr_QuestionTemplateArModel::create([
            'section_id' => $sectionRegister->id,
            'question_id' => $questionOptionProb->id,
        ]);

        TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
            'template_id' => $sectionRegister->id,
            'question_id' => $questionOptionProb->id,
            'is_show' => false,
        ]);

        $questionOptionImpa = TBQuestionTemplateAnalisisRiesgoModel::create($optionImpa);

        TBSectionTemplateAr_QuestionTemplateArModel::create([
            'section_id' => $sectionRegister->id,
            'question_id' => $questionOptionImpa->id,
        ]);

        TBSettingsTemplateAR_TBQuestionTemplateARModel::create([
            'template_id' => $sectionRegister->id,
            'question_id' => $questionOptionImpa->id,
            'is_show' => false,
        ]);

    }

    public function verifyUuidFormula($question)
    {
        switch ($question->type) {
            case '3':
                $uuid = Str::uuid();
                $uuid = substr($uuid, 0, 5);

                return $uuid;
                break;
            case '5':
                if ($question->is_numeric) {
                    $uuid = Str::uuid();
                    $uuid = substr($uuid, 0, 5);

                    return $uuid;
                } else {
                    return null;
                }
                break;
            case '6':
                if ($question->is_numeric) {
                    $uuid = Str::uuid();
                    $uuid = substr($uuid, 0, 5);

                    return $uuid;
                } else {
                    return null;
                }
                break;
            case '7':
                if ($question->is_numeric) {
                    $uuid = Str::uuid();
                    $uuid = substr($uuid, 0, 5);

                    return $uuid;
                } else {
                    return null;
                }
                break;
            default:
                return null;
        }
    }
}
