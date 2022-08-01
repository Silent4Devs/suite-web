<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class AusenciasController extends Controller
{
    public function index()
    {
        return view('admin.controlAusencia.index');
    }

    public function ajustesVacaciones()
    {
        return view('admin.controlAusencia.ajustesVacaciones');
    }

    public function ajustesDayOff()
    {
        return view('admin.controlAusencia.ajustesDayOff');
    }

    public function ajustesGoceSueldo()
    {
        return view('admin.controlAusencia.ajustesPermisosGoceSueldo');
    }
}
