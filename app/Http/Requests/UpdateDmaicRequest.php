<?php

namespace App\Http\Requests;

use App\Models\Dmaic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
