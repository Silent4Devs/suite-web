<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\BeneficiariosEmpleado;
use Illuminate\Http\Request;

class BeneficiariosEmpleadoController extends Controller
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
    public function show(BeneficiariosEmpleado $beneficiariosEmpleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BeneficiariosEmpleado $beneficiariosEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\RH\BeneficiariosEmpleado  $beneficiariosEmpleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $beneficiariosEmpleado)
    {
        $beneficiariosEmpleado = BeneficiariosEmpleado::find($beneficiariosEmpleado);

        $beneficiariosEmpleado->update([
            $request->typeInput => $request->value,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Beneficiario Actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RH\BeneficiariosEmpleado  $beneficiariosEmpleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($beneficiariosEmpleado)
    {
        $beneficiariosEmpleado = BeneficiariosEmpleado::find($beneficiariosEmpleado);

        $beneficiariosEmpleado->delete();

        return response()->json(['status' => 'success', 'message' => 'Beneficiario eliminado']);
    }
}
