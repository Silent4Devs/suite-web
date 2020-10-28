<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRegistromejoraRequest;
use App\Http\Requests\StoreRegistromejoraRequest;
use App\Http\Requests\UpdateRegistromejoraRequest;
use App\Models\Registromejora;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistromejoraController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('registromejora_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registromejoras = Registromejora::all();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.registromejoras.index', compact('registromejoras', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('registromejora_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombre_reportas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsableimplementacions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $validas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.registromejoras.create', compact('nombre_reportas', 'responsableimplementacions', 'validas'));
    }

    public function store(StoreRegistromejoraRequest $request)
    {
        $registromejora = Registromejora::create($request->all());

        return redirect()->route('frontend.registromejoras.index');
    }

    public function edit(Registromejora $registromejora)
    {
        abort_if(Gate::denies('registromejora_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombre_reportas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsableimplementacions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $validas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $registromejora->load('nombre_reporta', 'responsableimplementacion', 'valida', 'team');

        return view('frontend.registromejoras.edit', compact('nombre_reportas', 'responsableimplementacions', 'validas', 'registromejora'));
    }

    public function update(UpdateRegistromejoraRequest $request, Registromejora $registromejora)
    {
        $registromejora->update($request->all());

        return redirect()->route('frontend.registromejoras.index');
    }

    public function show(Registromejora $registromejora)
    {
        abort_if(Gate::denies('registromejora_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registromejora->load('nombre_reporta', 'responsableimplementacion', 'valida', 'team', 'mejoraDmaics', 'mejoraPlanMejoras');

        return view('frontend.registromejoras.show', compact('registromejora'));
    }

    public function destroy(Registromejora $registromejora)
    {
        abort_if(Gate::denies('registromejora_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registromejora->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegistromejoraRequest $request)
    {
        Registromejora::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
