<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\EntidadCrediticia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EntidadCrediticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $entidadesCrediticias = EntidadCrediticia::select('id', 'entidad', 'descripcion')->get();
        if ($request->ajax()) {
            return datatables()->of($entidadesCrediticias)->toJson();
        }
        return view('admin.recursos-humanos.entidades-crediticias.index', compact('entidadesCrediticias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidadCrediticia = new EntidadCrediticia;
        return view('admin.recursos-humanos.entidades-crediticias.create', compact('entidadCrediticia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'entidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:4000'
        ]);

        EntidadCrediticia::create($request->all());
        return redirect()->route('admin.entidades-crediticias.index')->with('success', 'Entidad crediticia creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RH\EntidadCrediticia  $entidadCrediticia
     * @return \Illuminate\Http\Response
     */
    public function show(EntidadCrediticia $entidadCrediticia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RH\EntidadCrediticia  $entidadCrediticia
     * @return \Illuminate\Http\Response
     */
    public function edit(EntidadCrediticia $entidadCrediticia)
    {
        return view('admin.recursos-humanos.entidades-crediticias.edit', compact('entidadCrediticia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RH\EntidadCrediticia  $entidadCrediticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntidadCrediticia $entidadCrediticia)
    {
        $request->validate([
            'entidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:4000'
        ]);

        EntidadCrediticia::create($request->all());
        return redirect()->route('admin.entidades-crediticias.index')->with('success', 'Entidad crediticia creada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RH\EntidadCrediticia  $entidadCrediticia
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntidadCrediticia $entidadCrediticia)
    {
        //
    }
}
