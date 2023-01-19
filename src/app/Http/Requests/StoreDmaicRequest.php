<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreDmaicRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dmaic_create');
    }

    public function rules()
    {
        return [];
    }
}
