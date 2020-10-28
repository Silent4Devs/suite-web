<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRecursoRequest;
use App\Http\Requests\StoreRecursoRequest;
use App\Http\Requests\UpdateRecursoRequest;
use App\Models\Recurso;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecursosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('recurso_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recursos = Recurso::all();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.recursos.index', compact('recursos', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('recurso_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participantes = User::all()->pluck('name', 'id');

        return view('frontend.recursos.create', compact('participantes'));
    }

    public function store(StoreRecursoRequest $request)
    {
        $recurso = Recurso::create($request->all());
        $recurso->participantes()->sync($request->input('participantes', []));

        return redirect()->route('frontend.recursos.index');
    }

    public function edit(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participantes = User::all()->pluck('name', 'id');

        $recurso->load('participantes', 'team');

        return view('frontend.recursos.edit', compact('participantes', 'recurso'));
    }

    public function update(UpdateRecursoRequest $request, Recurso $recurso)
    {
        $recurso->update($request->all());
        $recurso->participantes()->sync($request->input('participantes', []));

        return redirect()->route('frontend.recursos.index');
    }

    public function show(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurso->load('participantes', 'team');

        return view('frontend.recursos.show', compact('recurso'));
    }

    public function destroy(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurso->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecursoRequest $request)
    {
        Recurso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
