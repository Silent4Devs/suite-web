<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateAnalisisdeBrechas;

class TopController extends Controller
{
    public function index()
    {
        $top_analisis = TemplateAnalisisdeBrechas::get();

        return view('admin.analisisdebrecha2022nv.top.index', compact('top_analisis'));
    }

    public function topAnalisisRiegos()
    {

        return view('admin.analisis-riesgos.top-analisis-riesgos');
    }
}
