<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTratamientoRiesgoRequest;
use App\Http\Requests\StoreTratamientoRiesgoRequest;
use App\Http\Requests\UpdateTratamientoRiesgoRequest;
use App\Models\Controle;
use App\Models\Team;
use App\Models\TratamientoRiesgo;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TratamientoRiesgosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tratamiento_riesgo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgos = TratamientoRiesgo::all();

        $controles = Controle::get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.tratamientoRiesgos.index', compact('tratamientoRiesgos', 'controles', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('tratamiento_riesgo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.tratamientoRiesgos.create', compact('controls', 'responsables'));
    }

    public function store(StoreTratamientoRiesgoRequest $request)
    {
        $tratamientoRiesgo = TratamientoRiesgo::create($request->all());

        return redirect()->route('frontend.tratamiento-riesgos.index');
    }

    public function edit(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_riesgo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tratamientoRiesgo->load('control', 'responsable', 'team');

        return view('frontend.tratamientoRiesgos.edit', compact('controls', 'responsables', 'tratamientoRiesgo'));
    }

    public function update(UpdateTratamientoRiesgoRequest $request, TratamientoRiesgo $tratamientoRiesgo)
    {
        $tratamientoRiesgo->update($request->all());

        return redirect()->route('frontend.tratamiento-riesgos.index');
    }

    public function show(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_riesgo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->load('control', 'responsable', 'team');

        return view('frontend.tratamientoRiesgos.show', compact('tratamientoRiesgo'));
    }

    public function destroy(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_riesgo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->delete();

        return back();
    }

    public function massDestroy(MassDestroyTratamientoRiesgoRequest $request)
    {
        TratamientoRiesgo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
