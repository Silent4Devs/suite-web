<?php

namespace App\Http\Controllers\admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\TipoCompetencia;
use Illuminate\Http\Request;

class TipoCompetenciaController extends Controller
{
    public function index()
    {
        $tipos = TipoCompetencia::getAll();

        return view('admin.recursos-humanos.evaluacion-360.competencias.tipo.index', compact('tipos'));
    }

    public function create()
    {
        return view('admin.recursos-humanos.evaluacion-360.competencias.tipo.create');
    }

    public function store(Request $request)
    {
        $tipos = TipoCompetencia::create($request->all());

        return redirect()->route('admin.Tipo.index');
    }

    public function edit($tipos)
    {
        $tipos = TipoCompetencia::find($tipos);

        return view('admin.recursos-humanos.evaluacion-360.competencias.tipo.edit', compact('tipos'));
    }

    public function update(Request $request, $tipos)
    {
        $tipos = TipoCompetencia::find($tipos);

        $tipos->update($request->all());

        return redirect()->route('admin.Tipo.index');
    }

    public function show($tipos)
    {
        $tipos = TipoCompetencia::find($tipos);

        return view('admin.recursos-humanos.evaluacion-360.competencias.tipo.show', compact('tipos'));
    }

    public function destroy($id)
    {
        $tipos = TipoCompetencia::find($id);
        $tipos->delete();
        $tipos = TipoCompetencia::getAll();

        return view('admin.recursos-humanos.evaluacion-360.competencias.tipo.index', compact('tipos'));
    }
}
