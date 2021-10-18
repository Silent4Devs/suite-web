<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGapUnoRequest;
use App\Http\Requests\StoreGapUnoRequest;
use App\Http\Requests\UpdateGapUnoRequest;
use App\Models\GapUno;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class GapUnoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gap_uno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapUnos = GapUno::with(['team'])->get();

        $teams = Team::get();

        return view('frontend.gapUnos.index', compact('gapUnos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('gap_uno_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.gapUnos.create');
    }

    public function store(StoreGapUnoRequest $request)
    {
        $gapUno = GapUno::create($request->all());

        return redirect()->route('frontend.gap-unos.index');
    }

    public function edit(GapUno $gapUno)
    {
        abort_if(Gate::denies('gap_uno_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapUno->load('team');

        return view('frontend.gapUnos.edit', compact('gapUno'));
    }

    public function update(UpdateGapUnoRequest $request, GapUno $gapUno)
    {
        $gapUno->update($request->all());

        return redirect()->route('frontend.gap-unos.index');
    }

    public function show(GapUno $gapUno)
    {
        abort_if(Gate::denies('gap_uno_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapUno->load('team');

        return view('frontend.gapUnos.show', compact('gapUno'));
    }

    public function destroy(GapUno $gapUno)
    {
        abort_if(Gate::denies('gap_uno_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapUno->delete();

        return back();
    }

    public function massDestroy(MassDestroyGapUnoRequest $request)
    {
        GapUno::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
