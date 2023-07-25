<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\DependientesEconomicosEmpleados;
use Illuminate\Http\Request;

class DependientesEconomicosEmpleadosController extends Controller
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
    public function show(DependientesEconomicosEmpleados $dependientesEconomicosEmpleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(DependientesEconomicosEmpleados $dependientesEconomicosEmpleados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\RH\DependientesEconomicosEmpleados  $dependientesEconomicosEmpleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dependientesEconomicosEmpleados)
    {
        $dependientesEconomicosEmpleados = DependientesEconomicosEmpleados::find($dependientesEconomicosEmpleados);

        $dependientesEconomicosEmpleados->update([
            $request->typeInput => $request->value,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Dependiente Actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RH\DependientesEconomicosEmpleados  $dependientesEconomicosEmpleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($dependientesEconomicosEmpleados)
    {
        $dependientesEconomicosEmpleados = DependientesEconomicosEmpleados::find($dependientesEconomicosEmpleados);

        $dependientesEconomicosEmpleados->delete();

        return response()->json(['status' => 'success', 'message' => 'Dependiente eliminado']);
    }
}
