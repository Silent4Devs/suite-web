<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ControlDocumento;
use Illuminate\Http\Request;

class ReporteContextoController extends Controller
{
    public function index()
    {
        //$control_documentos = ControlDocumento::get();
        return view('admin.reporteContexto.index');
    }
}
