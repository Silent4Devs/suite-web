<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySedeRequest;
use App\Http\Requests\StoreSedeRequest;
use App\Http\Requests\UpdateSedeRequest;
use App\Models\Organizacion;
use App\Models\Sede;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SedeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('sede_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sedes = Sede::all();

        $organizacions = Organizacion::get();

        $teams = Team::get();

        return view('frontend.sedes.index', compact('sedes', 'organizacions', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('sede_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::all()->pluck('empresa', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.sedes.create', compact('organizacions'));
    }

    public function store(StoreSedeRequest $request)
    {
        $sede = Sede::create($request->all());

        return redirect()->route('frontend.sedes.index');
    }

    public function edit(Sede $sede)
    {
        abort_if(Gate::denies('sede_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::all()->pluck('empresa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sede->load('organizacion', 'team');

        return view('frontend.sedes.edit', compact('organizacions', 'sede'));
    }

    public function update(UpdateSedeRequest $request, Sede $sede)
    {
        $sede->update($request->all());

        return redirect()->route('frontend.sedes.index');
    }

    public function show(Sede $sede)
    {
        abort_if(Gate::denies('sede_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sede->load('organizacion', 'team');

        return view('frontend.sedes.show', compact('sede'));
    }

    public function destroy(Sede $sede)
    {
        abort_if(Gate::denies('sede_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sede->delete();

        return back();
    }

    public function massDestroy(MassDestroySedeRequest $request)
    {
        Sede::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
