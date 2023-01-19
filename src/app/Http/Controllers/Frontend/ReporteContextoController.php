<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use App\Models\ControlDocumento;

class ReporteContextoController extends Controller
{
    public function index()
    {
        //$control_documentos = ControlDocumento::get();
        return view('reporteContexto.index');
    }
}
