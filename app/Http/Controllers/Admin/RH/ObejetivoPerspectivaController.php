<?php

namespace App\Http\Controllers\admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\TipoObjetivo;
use Illuminate\Http\Request;

class ObejetivoPerspectivaController extends Controller
{
    public function index()
    {
        $perspectivas = TipoObjetivo::getAll();

        return view('admin.recursos-humanos.evaluacion-360.objetivos.perspectiva.index', compact('perspectivas'));
    }

    public function create()
    {
        return view('admin.recursos-humanos.evaluacion-360.objetivos.perspectiva.create');
    }

    public function store(Request $request)
    {
        $perspectiva = TipoObjetivo::create($request->all());

        return redirect()->route('admin.Perspectiva.index');
    }

    public function edit($perspectiva)
    {
        $perspectiva = TipoObjetivo::find($perspectiva);

        return view('admin.recursos-humanos.evaluacion-360.objetivos.perspectiva.edit', compact('perspectiva'));
    }

    public function update(Request $request, $perspectiva)
    {
        $perspectiva = TipoObjetivo::find($perspectiva);

        $perspectiva->update($request->all());

        return redirect()->route('admin.Perspectiva.index');
    }

    public function show($perspectiva)
    {
        $perspectiva = TipoObjetivo::find($perspectiva);

        return view('admin.recursos-humanos.evaluacion-360.objetivos.perspectiva.show', compact('perspectiva'));
    }

    public function destroy($id)
    {
        $perspectiva = TipoObjetivo::find($id);
        $perspectiva->delete();
        $perspectivas = TipoObjetivo::getAll();

        return view('admin.recursos-humanos.evaluacion-360.objetivos.perspectiva.index', compact('perspectivas'));
    }
}
