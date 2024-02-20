<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;

class ObjetivosPeriodoController extends Controller
{
    public function config()
    {
        return view('admin.recursos-humanos.evaluacion-360.objetivos-periodo.config');
    }
}
