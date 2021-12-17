<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanelOrganizacion;
use Illuminate\Http\Request;

class PanelOrganizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("aqui");
        return view('admin.panel-organizacion.index');
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
     * @param  \App\Models\PanelOrganizacion  $panelOrganizacion
     * @return \Illuminate\Http\Response
     */
    public function show(PanelOrganizacion $panelOrganizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PanelOrganizacion  $panelOrganizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(PanelOrganizacion $panelOrganizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PanelOrganizacion  $panelOrganizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PanelOrganizacion $panelOrganizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PanelOrganizacion  $panelOrganizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PanelOrganizacion $panelOrganizacion)
    {
        //
    }
}
