<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActividadIncidente;
use Illuminate\Http\Request;

class ActividadesIncidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $actividades = ActividadIncidente::with('responsables')->get();
            return datatables()->of($actividades)->toJson();
        }
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
        if ($request->ajax()) {
            $actividad = ActividadIncidente::create($request->all());
            $responsables = $request->responsables;
            $actividad->responsables()->sync($responsables);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActividadIncidente  $actividadIncidente
     * @return \Illuminate\Http\Response
     */
    public function show(ActividadIncidente $actividadIncidente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActividadIncidente  $actividadIncidente
     * @return \Illuminate\Http\Response
     */
    public function edit(ActividadIncidente $actividadIncidente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActividadIncidente  $actividadIncidente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActividadIncidente $actividadIncidente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActividadIncidente  $actividadIncidente
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActividadIncidente $actividadIncidente)
    {
        //
    }
}
