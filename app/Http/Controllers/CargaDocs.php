<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CargaDocs extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('carga_masiva_datos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.CargaDocs.index');
    }
}
