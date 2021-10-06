<?php

namespace App\Http\Requests;

use App\Models\Vulnerabilidad;
use Illuminate\Foundation\Http\FormRequest;

class CreateVulnerabilidadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
        return Vulnerabilidad::$rules;
    }
}
