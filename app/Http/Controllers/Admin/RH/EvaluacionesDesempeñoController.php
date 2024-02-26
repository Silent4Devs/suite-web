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
}
