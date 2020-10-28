<?php

namespace App\Http\Requests;

use App\Models\Dmaic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
