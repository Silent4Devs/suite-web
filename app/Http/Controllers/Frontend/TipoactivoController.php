<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTipoactivoRequest;
use App\Http\Requests\StoreTipoactivoRequest;
use App\Http\Requests\UpdateTipoactivoRequest;
use App\Models\Team;
use App\Models\Tipoactivo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoactivoController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('tipoactivo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all();

        $teams = Team::get();

        return view('frontend.tipoactivos.index', compact('tipoactivos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('tipoactivo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.tipoactivos.create');
    }

    public function store(StoreTipoactivoRequest $request)
    {
        $tipoactivo = Tipoactivo::create($request->all());

        return redirect()->route('frontend.tipoactivos.index');
    }

    public function edit(Tipoactivo $tipoactivo)
    {
        abort_if(Gate::denies('tipoactivo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivo->load('team');

        return view('frontend.tipoactivos.edit', compact('tipoactivo'));
    }

    public function update(UpdateTipoactivoRequest $request, Tipoactivo $tipoactivo)
    {
        $tipoactivo->update($request->all());

        return redirect()->route('frontend.tipoactivos.index');
    }

    public function show(Tipoactivo $tipoactivo)
    {
        abort_if(Gate::denies('tipoactivo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivo->load('team');

        return view('frontend.tipoactivos.show', compact('tipoactivo'));
    }

    public function destroy(Tipoactivo $tipoactivo)
    {
        abort_if(Gate::denies('tipoactivo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivo->delete();

        return back();
    }

    public function massDestroy(MassDestroyTipoactivoRequest $request)
    {
        Tipoactivo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
