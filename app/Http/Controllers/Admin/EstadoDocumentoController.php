<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEstadoDocumentoRequest;
use App\Http\Requests\StoreEstadoDocumentoRequest;
use App\Http\Requests\UpdateEstadoDocumentoRequest;
use App\Models\EstadoDocumento;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EstadoDocumentoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('estado_documento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EstadoDocumento::with(['team'])->select(sprintf('%s.*', (new EstadoDocumento)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'estado_documento_show';
                $editGate = 'estado_documento_edit';
                $deleteGate = 'estado_documento_delete';
                $crudRoutePart = 'estado-documentos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('estado', function ($row) {
                return $row->estado ? $row->estado : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.estadoDocumentos.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('estado_documento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estadoDocumentos.create');
    }

    public function store(StoreEstadoDocumentoRequest $request)
    {
        $estadoDocumento = EstadoDocumento::create($request->all());

        return redirect()->route('admin.estado-documentos.index');
    }

    public function edit(EstadoDocumento $estadoDocumento)
    {
        abort_if(Gate::denies('estado_documento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoDocumento->load('team');

        return view('admin.estadoDocumentos.edit', compact('estadoDocumento'));
    }

    public function update(UpdateEstadoDocumentoRequest $request, EstadoDocumento $estadoDocumento)
    {
        $estadoDocumento->update($request->all());

        return redirect()->route('admin.estado-documentos.index');
    }

    public function show(EstadoDocumento $estadoDocumento)
    {
        abort_if(Gate::denies('estado_documento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoDocumento->load('team');

        return view('admin.estadoDocumentos.show', compact('estadoDocumento'));
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
