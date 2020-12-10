<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGapTreRequest;
use App\Http\Requests\StoreGapTreRequest;
use App\Http\Requests\UpdateGapTreRequest;
use App\Models\GapTre;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GapTresController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gap_tre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapTres = GapTre::with(['team'])->get();

        $teams = Team::get();

        return view('frontend.gapTres.index', compact('gapTres', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('gap_tre_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.gapTres.create');
    }

    public function store(StoreGapTreRequest $request)
    {
        $gapTre = GapTre::create($request->all());

        return redirect()->route('frontend.gap-tres.index');
    }

    public function edit(GapTre $gapTre)
    {
        abort_if(Gate::denies('gap_tre_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapTre->load('team');

        return view('frontend.gapTres.edit', compact('gapTre'));
    }

    public function update(UpdateGapTreRequest $request, GapTre $gapTre)
    {
        $gapTre->update($request->all());

        return redirect()->route('frontend.gap-tres.index');
    }

    public function show(GapTre $gapTre)
    {
        abort_if(Gate::denies('gap_tre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapTre->load('team');

        return view('frontend.gapTres.show', compact('gapTre'));
    }

    public function destroy(GapTre $gapTre)
    {
        abort_if(Gate::denies('gap_tre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapTre->delete();

        return back();
    }

    public function massDestroy(MassDestroyGapTreRequest $request)
    {
        GapTre::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
