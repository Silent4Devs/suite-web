<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAlcanceSgsiRequest;
use App\Http\Requests\StoreAlcanceSgsiRequest;
use App\Http\Requests\UpdateAlcanceSgsiRequest;
use App\Models\AlcanceSgsi;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlcanceSgsiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('alcance_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsis = AlcanceSgsi::all();

        $teams = Team::get();

        return view('frontend.alcanceSgsis.index', compact('alcanceSgsis', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('alcance_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.alcanceSgsis.create');
    }

    public function store(StoreAlcanceSgsiRequest $request)
    {
        $alcanceSgsi = AlcanceSgsi::create($request->all());

        return redirect()->route('frontend.alcance-sgsis.index');
    }

    public function edit(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('alcance_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('team');

        return view('frontend.alcanceSgsis.edit', compact('alcanceSgsi'));
    }

    public function update(UpdateAlcanceSgsiRequest $request, AlcanceSgsi $alcanceSgsi)
    {
        $alcanceSgsi->update($request->all());

        return redirect()->route('frontend.alcance-sgsis.index');
    }

    public function show(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('alcance_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('team');

        return view('frontend.alcanceSgsis.show', compact('alcanceSgsi'));
    }

    public function destroy(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('alcance_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->delete();

        return back();
    }

    public function massDestroy(MassDestroyAlcanceSgsiRequest $request)
    {
        AlcanceSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
