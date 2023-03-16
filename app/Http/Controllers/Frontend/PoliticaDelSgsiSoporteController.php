<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PoliticaDelSgsiSoporteController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('politica_del_sgsi_soporte_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.politicaDelSgsiSoportes.index');
    }
}
