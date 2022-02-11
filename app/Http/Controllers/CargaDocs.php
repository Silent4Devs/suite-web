<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class CargaDocs extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('carga_masiva_de_datos_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.CargaDocs.index');
    }
}
