<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Template_Analisis_Riesgos;
use Illuminate\Http\Request;

class templateAnalisisRiesgo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return json_encode('hola');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Template_Analisis_Riesgos $template_Analisis_Riesgos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template_Analisis_Riesgos $template_Analisis_Riesgos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template_Analisis_Riesgos $template_Analisis_Riesgos)
    {
        //
    }
}
