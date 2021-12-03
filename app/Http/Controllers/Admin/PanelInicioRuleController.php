<?php

namespace App\Http\Controllers\Admin;

use App\Models\PanelInicioRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelInicioRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.panel-inicio.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PanelInicioRule  $panelInicioRule
     * @return \Illuminate\Http\Response
     */
    public function show(PanelInicioRule $panelInicioRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PanelInicioRule  $panelInicioRule
     * @return \Illuminate\Http\Response
     */
    public function edit(PanelInicioRule $panelInicioRule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PanelInicioRule  $panelInicioRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PanelInicioRule $panelInicioRule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PanelInicioRule  $panelInicioRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(PanelInicioRule $panelInicioRule)
    {
        //
    }
}
