<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class IndicadorincidentessiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('indicadorincidentessi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.indicadorincidentessis.index');
    }
}
