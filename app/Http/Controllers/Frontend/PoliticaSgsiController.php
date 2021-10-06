<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPoliticaSgsiRequest;
use App\Http\Requests\StorePoliticaSgsiRequest;
use App\Http\Requests\UpdatePoliticaSgsiRequest;
use App\Models\PoliticaSgsi;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PoliticaSgsiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('politica_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsis = PoliticaSgsi::all();

        $teams = Team::get();

        return view('frontend.politicaSgsis.index', compact('politicaSgsis', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('politica_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.politicaSgsis.create');
    }

    public function store(StorePoliticaSgsiRequest $request)
    {
        $politicaSgsi = PoliticaSgsi::create($request->all());

        return redirect()->route('frontend.politica-sgsis.index');
    }

    public function edit(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        return view('frontend.politicaSgsis.edit', compact('politicaSgsi'));
    }

    public function update(UpdatePoliticaSgsiRequest $request, PoliticaSgsi $politicaSgsi)
    {
        $politicaSgsi->update($request->all());

        return redirect()->route('frontend.politica-sgsis.index');
    }

    public function show(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        return view('frontend.politicaSgsis.show', compact('politicaSgsi'));
    }

    public function destroy(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->delete();

        return back();
    }

    public function massDestroy(MassDestroyPoliticaSgsiRequest $request)
    {
        PoliticaSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
