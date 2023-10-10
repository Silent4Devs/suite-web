<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditoriaReporteCards extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('auditoria_interna_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.AuditoriaReporteCards.index');
    }
}
