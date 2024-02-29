<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluacionesDesempeñoController extends Controller
{
    public function index()
    {
    }

    public function dashboardGeneral()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.dashboard-general');
    }

    public function dashboardGlobal()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.dashboard-global');
    }

    public function configEvaluaciones()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.config-evaluaciones-cards');
    }

    public function createEvaluacion()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.create-evaluacion');
    }
}
