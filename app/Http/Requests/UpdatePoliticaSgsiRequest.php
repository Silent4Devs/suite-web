<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePoliticaSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('politica_sgsi_edit');
    }

    public function rules()
    {
        return [];
    }
}
