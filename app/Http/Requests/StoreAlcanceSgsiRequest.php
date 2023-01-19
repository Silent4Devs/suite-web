<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlcanceSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('alcance_sgsi_create');
    }

    public function rules()
    {
        return [];
    }
}
