<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyComiteseguridadRequest;
use App\Http\Requests\StoreComiteseguridadRequest;
use App\Http\Requests\UpdateComiteseguridadRequest;
use App\Models\Comiteseguridad;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComiteseguridadController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('comiteseguridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comiteseguridads = Comiteseguridad::all();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.comiteseguridads.index', compact('comiteseguridads', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('comiteseguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personaasignadas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.comiteseguridads.create', compact('personaasignadas'));
    }

    public function store(StoreComiteseguridadRequest $request)
    {
        $comiteseguridad = Comiteseguridad::create($request->all());

        return redirect()->route('frontend.comiteseguridads.index');
    }

    public function edit(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personaasignadas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comiteseguridad->load('personaasignada', 'team');

        return view('frontend.comiteseguridads.edit', compact('personaasignadas', 'comiteseguridad'));
    }

    public function update(UpdateComiteseguridadRequest $request, Comiteseguridad $comiteseguridad)
    {
        $comiteseguridad->update($request->all());

        return redirect()->route('frontend.comiteseguridads.index');
    }

    public function show(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comiteseguridad->load('personaasignada', 'team');

        return view('frontend.comiteseguridads.show', compact('comiteseguridad'));
    }

    public function destroy(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comiteseguridad->delete();

        return back();
    }

    public function massDestroy(MassDestroyComiteseguridadRequest $request)
    {
        Comiteseguridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
