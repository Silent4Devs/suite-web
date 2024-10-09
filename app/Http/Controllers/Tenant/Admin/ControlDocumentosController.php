<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyControlDocumentoRequest;
use App\Http\Requests\StoreControlDocumentoRequest;
use App\Http\Requests\UpdateControlDocumentoRequest;
use App\Models\ControlDocumento;
use App\Models\EstadoDocumento;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ControlDocumentosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('control_documento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        /*if ($request->ajax()) {
            $query = ControlDocumento::with(['elaboro', 'reviso', 'estado', 'team'])->select(sprintf('%s.*', (new ControlDocumento)->table));
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'control_documento_show';
                $editGate      = 'control_documento_edit';
                $deleteGate    = 'control_documento_delete';
                $crudRoutePart = 'control-documentos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('clave', function ($row) {
                return $row->clave ? $row->clave : "";
            });
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : "";
            });
            $table->editColumn('fecha_creacion', function ($row) {
                return $row->fecha_creacion ? $row->fecha_creacion : "";
            });
            $table->editColumn('version', function ($row) {
                return $row->version ? $row->version : "";
            });
            $table->editColumn('elaboro', function ($row) {
                return $row->elaboro->name ? $row->elaboro->name : "";
            });

            $table->editColumn('reviso', function ($row) {
                return $row->reviso->name ? $row->reviso->name : "";
            });
            $table->editColumn('estado', function ($row) {
                return $row->estado->estado ? $row->estado->estado : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }*/

        $teams = Team::get();

        $controlDocumentos = ControlDocumento::with(['elaboro', 'reviso', 'estado', 'team'])->get();

        return view('admin.controlDocumentos.index', compact('controlDocumentos'));
    }

    public function create()
    {
        abort_if(Gate::denies('control_documento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::getAll();

        $elaboros = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $revisos = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estados = EstadoDocumento::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.controlDocumentos.create', compact('elaboros', 'revisos', 'estados'));
    }

    public function store(StoreControlDocumentoRequest $request)
    {
        $controlDocumento = ControlDocumento::create($request->all());

        return redirect()->route('admin.control-documentos.index');
    }

    public function edit(ControlDocumento $controlDocumento)
    {
        abort_if(Gate::denies('control_documento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::getAll();

        $elaboros = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $revisos = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estados = EstadoDocumento::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $controlDocumento->load('elaboro', 'reviso', 'estado', 'team');

        return view('admin.controlDocumentos.edit', compact('elaboros', 'revisos', 'estados', 'controlDocumento'));
    }

    public function show(ControlDocumento $controlDocumento)
    {
        abort_if(Gate::denies('control_documento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::getAll();

        $elaboros = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $revisos = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estados = EstadoDocumento::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $controlDocumento->load('elaboro', 'reviso', 'estado', 'team');

        return view('admin.controlDocumentos.edit', compact('elaboros', 'revisos', 'estados', 'controlDocumento'));
    }

    public function update(UpdateControlDocumentoRequest $request, ControlDocumento $controlDocumento)
    {
        $controlDocumento->update([
            'clave' => $request->clave,
            //"nombre" => $request->nombre,
            'fecha_creacion' => $request->fecha_creacion,
            //"version" => $request->version,
            'elaboro_id' => $request->elaboro_id,
            'reviso_id' => $request->reviso_id,
        ]);

        return redirect()->route('admin.control-documentos.index');
    }

    public function destroy(ControlDocumento $controlDocumento)
    {
        abort_if(Gate::denies('control_documento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controlDocumento->delete();

        return back();
    }

    public function massDestroy(MassDestroyControlDocumentoRequest $request)
    {
        ControlDocumento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
