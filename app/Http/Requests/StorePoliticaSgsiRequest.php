<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StorePoliticaSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('politica_sgsi_create');
    }

    public function rules()
    {
        return [];
    }
}
