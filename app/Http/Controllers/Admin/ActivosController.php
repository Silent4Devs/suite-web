<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ActivosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('activo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Activo::with(['tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team'])->select(sprintf('%s.*', (new Activo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'activo_show';
                $editGate      = 'activo_edit';
                $deleteGate    = 'activo_delete';
                $crudRoutePart = 'activos';

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
            $table->addColumn('tipoactivo_tipo', function ($row) {
                return $row->tipoactivo ? $row->tipoactivo->tipo : '';
            });

            $table->addColumn('subtipo_subtipo', function ($row) {
                return $row->subtipo ? $row->subtipo->subtipo : '';
            });

            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });
            $table->addColumn('dueno_name', function ($row) {
                return $row->dueno ? $row->dueno->name : '';
            });

            $table->addColumn('ubicacion_sede', function ($row) {
                return $row->ubicacion ? $row->ubicacion->sede : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tipoactivo', 'subtipo', 'dueno', 'ubicacion']);

            return $table->make(true);
        }

        $tipoactivos = Tipoactivo::get();
        $tipoactivos = Tipoactivo::get();
        $users       = User::get();
        $sedes       = Sede::get();
        $teams       = Team::get();

        return view('admin.activos.index', compact('tipoactivos', 'tipoactivos', 'users', 'sedes', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('activo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = Tipoactivo::all()->pluck('subtipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.activos.create', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions'));
    }

    public function store(StoreActivoRequest $request)
    {
        $activo = Activo::create($request->all());

        return redirect()->route('admin.activos.index');
    }

    public function edit(Activo $activo)
    {
        abort_if(Gate::denies('activo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = Tipoactivo::all()->pluck('subtipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activo->load('tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team');

        return view('admin.activos.edit', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions', 'activo'));
    }

    public function update(UpdateActivoRequest $request, Activo $activo)
    {
        $activo->update($request->all());

        return redirect()->route('admin.activos.index');
    }

    public function show(Activo $activo)
    {
        abort_if(Gate::denies('activo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activo->load('tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team', 'activoIncidentesDeSeguridads');

        return view('admin.activos.show', compact('activo'));
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
