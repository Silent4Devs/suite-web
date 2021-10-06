<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDmaicRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dmaic_edit');
    }

    public function rules()
    {
        return [];
    }
}
