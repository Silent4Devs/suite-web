<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGapDoRequest;
use App\Http\Requests\StoreGapDoRequest;
use App\Http\Requests\UpdateGapDoRequest;
use App\Models\GapDo;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class GapDosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gap_do_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapDos = GapDo::with(['team'])->get();

        $teams = Team::get();

        return view('frontend.gapDos.index', compact('gapDos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('gap_do_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.gapDos.create');
    }

    public function store(StoreGapDoRequest $request)
    {
        $gapDo = GapDo::create($request->all());

        return redirect()->route('frontend.gap-dos.index');
    }

    public function edit(GapDo $gapDo)
    {
        abort_if(Gate::denies('gap_do_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapDo->load('team');

        return view('frontend.gapDos.edit', compact('gapDo'));
    }

    public function update(UpdateGapDoRequest $request, GapDo $gapDo)
    {
        $gapDo->update($request->all());

        return redirect()->route('frontend.gap-dos.index');
    }

    public function show(GapDo $gapDo)
    {
        abort_if(Gate::denies('gap_do_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapDo->load('team');

        return view('frontend.gapDos.show', compact('gapDo'));
    }

    public function destroy(GapDo $gapDo)
    {
        abort_if(Gate::denies('gap_do_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapDo->delete();

        return back();
    }

    public function massDestroy(MassDestroyGapDoRequest $request)
    {
        GapDo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
