<?php

namespace App\Http\Requests\AnalisisRiesgo;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateSectionQuestionTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sections' => 'required|array',
            'sections.*.title' => 'required|string',
            'sections.*.id' => 'required|string',
            'sections.*.template_id' => 'required|integer',
            'questions.*.id' => 'required|string',
            'questions.*.size' => 'required|integer',
            'questions.*.type' => 'required|integer',
            'questions.*.position' => 'required|integer',
            'questions.*.obligatory' => 'required|boolean',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException(response()->json([
            'message' => 'Error en la validación',
            'errors' => $errors,
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
