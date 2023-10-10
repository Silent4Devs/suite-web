<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\ContactosEmergenciaEmpleado;
use Illuminate\Http\Request;

class ContactosEmergenciaEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ContactosEmergenciaEmpleado $contactosEmergenciaEmpleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactosEmergenciaEmpleado $contactosEmergenciaEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\RH\ContactosEmergenciaEmpleado  $contactosEmergenciaEmpleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contactosEmergenciaEmpleado)
    {
        $contactosEmergenciaEmpleado = ContactosEmergenciaEmpleado::find($contactosEmergenciaEmpleado);

        $contactosEmergenciaEmpleado->update([
            $request->typeInput => $request->value,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Contacto Actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RH\ContactosEmergenciaEmpleado  $contactosEmergenciaEmpleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($contactosEmergenciaEmpleado)
    {
        $contactosEmergenciaEmpleado = ContactosEmergenciaEmpleado::find($contactosEmergenciaEmpleado);

        $contactosEmergenciaEmpleado->delete();

        return response()->json(['status' => 'success', 'message' => 'Contacto eliminado']);
    }
}
