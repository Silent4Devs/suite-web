<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyActivoRequest;
use App\Http\Requests\StoreActivoRequest;
use App\Http\Requests\UpdateActivoRequest;
use App\Models\Activo;
use App\Models\Sede;
use App\Models\Team;
use App\Models\Tipoactivo;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('activo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activos = Activo::all();

        $tipoactivos = Tipoactivo::get();

        $users = User::get();

        $sedes = Sede::get();

        $teams = Team::get();

        return view('frontend.activos.index', compact('activos', 'tipoactivos', 'users', 'sedes', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('activo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = Tipoactivo::all()->pluck('subtipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.activos.create', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions'));
    }

    public function store(StoreActivoRequest $request)
    {
        $activo = Activo::create($request->all());

        return redirect()->route('frontend.activos.index');
    }

    public function edit(Activo $activo)
    {
        abort_if(Gate::denies('activo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = Tipoactivo::all()->pluck('subtipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activo->load('tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team');

        return view('frontend.activos.edit', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions', 'activo'));
    }

    public function update(UpdateActivoRequest $request, Activo $activo)
    {
        $activo->update($request->all());

        return redirect()->route('frontend.activos.index');
    }

    public function show(Activo $activo)
    {
        abort_if(Gate::denies('activo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activo->load('tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team', 'activoIncidentesDeSeguridads');

        return view('frontend.activos.show', compact('activo'));
    }

    public function destroy(Activo $activo)
    {
        abort_if(Gate::denies('activo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activo->delete();

        return back();
    }

    public function massDestroy(MassDestroyActivoRequest $request)
    {
        Activo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
