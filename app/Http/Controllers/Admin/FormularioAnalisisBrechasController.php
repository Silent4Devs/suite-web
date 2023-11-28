<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FormularioAnalisisBrechasController extends Controller
{
    public function index($id)
    {
        return view('admin.analisisdebrecha2022nv.formulario.index')->with('id');
    }
}
