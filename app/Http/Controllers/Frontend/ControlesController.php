<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyControleRequest;
use App\Http\Requests\StoreControleRequest;
use App\Http\Requests\UpdateControleRequest;
use App\Models\Controle;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControlesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('controle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controles = Controle::all();

        $teams = Team::get();

        return view('frontend.controles.index', compact('controles', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('controle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.controles.create');
    }

    public function store(StoreControleRequest $request)
    {
        $controle = Controle::create($request->all());

        return redirect()->route('frontend.controles.index');
    }

    public function edit(Controle $controle)
    {
        abort_if(Gate::denies('controle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controle->load('team');

        return view('frontend.controles.edit', compact('controle'));
    }

    public function update(UpdateControleRequest $request, Controle $controle)
    {
        $controle->update($request->all());

        return redirect()->route('frontend.controles.index');
    }

    public function show(Controle $controle)
    {
        abort_if(Gate::denies('controle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controle->load('team');

        return view('frontend.controles.show', compact('controle'));
    }

    public function destroy(Controle $controle)
    {
        abort_if(Gate::denies('controle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controle->delete();

        return back();
    }

    public function massDestroy(MassDestroyControleRequest $request)
    {
        Controle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
