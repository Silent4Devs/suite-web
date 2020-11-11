<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEstadoDocumentoRequest;
use App\Http\Requests\StoreEstadoDocumentoRequest;
use App\Http\Requests\UpdateEstadoDocumentoRequest;
use App\Models\EstadoDocumento;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstadoDocumentoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estado_documento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoDocumentos = EstadoDocumento::all();

        $teams = Team::get();

        return view('frontend.estadoDocumentos.index', compact('estadoDocumentos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('estado_documento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.estadoDocumentos.create');
    }

    public function store(StoreEstadoDocumentoRequest $request)
    {
        $estadoDocumento = EstadoDocumento::create($request->all());

        return redirect()->route('frontend.estado-documentos.index');
    }

    public function edit(EstadoDocumento $estadoDocumento)
    {
        abort_if(Gate::denies('estado_documento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoDocumento->load('team');

        return view('frontend.estadoDocumentos.edit', compact('estadoDocumento'));
    }

    public function update(UpdateEstadoDocumentoRequest $request, EstadoDocumento $estadoDocumento)
    {
        $estadoDocumento->update($request->all());

        return redirect()->route('frontend.estado-documentos.index');
    }

    public function show(EstadoDocumento $estadoDocumento)
    {
        abort_if(Gate::denies('estado_documento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoDocumento->load('team');

        return view('frontend.estadoDocumentos.show', compact('estadoDocumento'));
    }

    public function destroy(EstadoDocumento $estadoDocumento)
    {
        abort_if(Gate::denies('estado_documento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoDocumento->delete();

        return back();
    }

    public function massDestroy(MassDestroyEstadoDocumentoRequest $request)
    {
        EstadoDocumento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
