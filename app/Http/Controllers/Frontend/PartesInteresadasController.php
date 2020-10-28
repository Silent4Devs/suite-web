<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPartesInteresadaRequest;
use App\Http\Requests\StorePartesInteresadaRequest;
use App\Http\Requests\UpdatePartesInteresadaRequest;
use App\Models\PartesInteresada;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PartesInteresadasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('partes_interesada_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partesInteresadas = PartesInteresada::all();

        $teams = Team::get();

        return view('frontend.partesInteresadas.index', compact('partesInteresadas', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('partes_interesada_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.partesInteresadas.create');
    }

    public function store(StorePartesInteresadaRequest $request)
    {
        $partesInteresada = PartesInteresada::create($request->all());

        return redirect()->route('frontend.partes-interesadas.index');
    }

    public function edit(PartesInteresada $partesInteresada)
    {
        abort_if(Gate::denies('partes_interesada_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partesInteresada->load('team');

        return view('frontend.partesInteresadas.edit', compact('partesInteresada'));
    }

    public function update(UpdatePartesInteresadaRequest $request, PartesInteresada $partesInteresada)
    {
        $partesInteresada->update($request->all());

        return redirect()->route('frontend.partes-interesadas.index');
    }

    public function show(PartesInteresada $partesInteresada)
    {
        abort_if(Gate::denies('partes_interesada_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partesInteresada->load('team');

        return view('frontend.partesInteresadas.show', compact('partesInteresada'));
    }

    public function destroy(PartesInteresada $partesInteresada)
    {
        abort_if(Gate::denies('partes_interesada_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partesInteresada->delete();

        return back();
    }

    public function massDestroy(MassDestroyPartesInteresadaRequest $request)
    {
        PartesInteresada::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
