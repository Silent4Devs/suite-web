<?php

namespace App\Http\Requests;

use Composer\Util\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyAnalisisBrechasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('analisis_brechas_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // return Gate::allows('comiteseguridad_create');
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
            'ids' => 'required|array',
            'ids.*' => 'exists:analisis_brechas,id',
        ];
    }
}
