<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class AusenciasController extends Controller
{
    public function index()
    {
        return view('admin.controlAusencia.index');
    }

    public function ajustesVacaciones()
    {
        abort_if(Gate::denies('ajustes_vacaciones'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.controlAusencia.ajustesVacaciones');
    }

    public function ajustesDayOff()
    {
        abort_if(Gate::denies('ajustes_dayoff'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.controlAusencia.ajustesDayOff');
    }

    public function ajustesGoceSueldo()
    {
        abort_if(Gate::denies('ajustes_goce_sueldo'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.controlAusencia.ajustesPermisosGoceSueldo');
    }
}
