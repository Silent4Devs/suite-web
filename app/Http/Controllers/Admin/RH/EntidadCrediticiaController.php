<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\EntidadCrediticia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class EntidadCrediticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('entidades_crediticeas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(Gate::denies('entidades_crediticeas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entidadCrediticia = new EntidadCrediticia;

        return view('admin.recursos-humanos.entidades-crediticias.create', compact('entidadCrediticia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('entidades_crediticeas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'entidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:4000',
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
    public function show($entidadCrediticia)
    {
        abort_if(Gate::denies('entidades_crediticeas_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entidadCrediticia = EntidadCrediticia::find($entidadCrediticia);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RH\EntidadCrediticia  $entidadCrediticia
     * @return \Illuminate\Http\Response
     */
    public function edit($entidadCrediticia)
    {
        abort_if(Gate::denies('entidades_crediticeas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entidadCrediticia = EntidadCrediticia::find($entidadCrediticia);

        return view('admin.recursos-humanos.entidades-crediticias.edit', compact('entidadCrediticia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\RH\EntidadCrediticia  $entidadCrediticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $entidadCrediticia)
    {
        abort_if(Gate::denies('entidades_crediticeas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entidadCrediticia = EntidadCrediticia::find($entidadCrediticia);
        $request->validate([
            'entidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:4000',
        ]);

        $entidadCrediticia->update($request->all());

        return redirect()->route('admin.entidades-crediticias.index')->with('success', 'Entidad crediticia creada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RH\EntidadCrediticia  $entidadCrediticia
     * @return \Illuminate\Http\Response
     */
    public function destroy($entidadCrediticia)
    {
        abort_if(Gate::denies('entidades_crediticeas_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entidadCrediticia = EntidadCrediticia::find($entidadCrediticia);
        $entidadCrediticia->delete();

        return redirect()->route('admin.entidades-crediticias.index')->with('success', 'Entidad crediticia eliminada');
    }
}
