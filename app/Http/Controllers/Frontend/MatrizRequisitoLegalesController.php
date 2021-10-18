<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatrizRequisitoLegaleRequest;
use App\Http\Requests\StoreMatrizRequisitoLegaleRequest;
use App\Http\Requests\UpdateMatrizRequisitoLegaleRequest;
use App\Models\MatrizRequisitoLegale;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MatrizRequisitoLegalesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('matriz_requisito_legale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegales = MatrizRequisitoLegale::all();

        $teams = Team::get();

        return view('frontend.matrizRequisitoLegales.index', compact('matrizRequisitoLegales', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_requisito_legale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.matrizRequisitoLegales.create');
    }

    public function store(StoreMatrizRequisitoLegaleRequest $request)
    {
        $matrizRequisitoLegale = MatrizRequisitoLegale::create($request->all());

        return redirect()->route('frontend.matriz-requisito-legales.index');
    }

    public function edit(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->load('team');

        return view('frontend.matrizRequisitoLegales.edit', compact('matrizRequisitoLegale'));
    }

    public function update(UpdateMatrizRequisitoLegaleRequest $request, MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        $matrizRequisitoLegale->update($request->all());

        return redirect()->route('frontend.matriz-requisito-legales.index');
    }

    public function show(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->load('team');

        return view('frontend.matrizRequisitoLegales.show', compact('matrizRequisitoLegale'));
    }

    public function destroy(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->delete();

        return back();
    }

    public function massDestroy(MassDestroyMatrizRequisitoLegaleRequest $request)
    {
        MatrizRequisitoLegale::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
