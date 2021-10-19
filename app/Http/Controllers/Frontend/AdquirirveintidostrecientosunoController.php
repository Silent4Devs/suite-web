<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class AdquirirveintidostrecientosunoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('adquirirveintidostrecientosuno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adquirirveintidostrecientosunos.index');
    }
}
