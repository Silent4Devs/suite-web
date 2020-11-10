<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDmaicRequest;
use App\Http\Requests\StoreDmaicRequest;
use App\Http\Requests\UpdateDmaicRequest;
use App\Models\Dmaic;
use App\Models\Registromejora;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DmaicController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dmaic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dmaics = Dmaic::all();

        $registromejoras = Registromejora::get();

        $teams = Team::get();

        return view('frontend.dmaics.index', compact('dmaics', 'registromejoras', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('dmaic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Registromejora::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.dmaics.create', compact('mejoras'));
    }

    public function store(StoreDmaicRequest $request)
    {
        $dmaic = Dmaic::create($request->all());

        return redirect()->route('frontend.dmaics.index');
    }

    public function edit(Dmaic $dmaic)
    {
        abort_if(Gate::denies('dmaic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Registromejora::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dmaic->load('mejora', 'team');

        return view('frontend.dmaics.edit', compact('mejoras', 'dmaic'));
    }

    public function update(UpdateDmaicRequest $request, Dmaic $dmaic)
    {
        $dmaic->update($request->all());

        return redirect()->route('frontend.dmaics.index');
    }

    public function show(Dmaic $dmaic)
    {
        abort_if(Gate::denies('dmaic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dmaic->load('mejora', 'team');

        return view('frontend.dmaics.show', compact('dmaic'));
    }

    public function destroy(Dmaic $dmaic)
    {
        abort_if(Gate::denies('dmaic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dmaic->delete();

        return back();
    }

    public function massDestroy(MassDestroyDmaicRequest $request)
    {
        Dmaic::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
