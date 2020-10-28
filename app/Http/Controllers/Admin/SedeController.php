<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class SedeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sede_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sede::with(['organizacion', 'team'])->select(sprintf('%s.*', (new Sede)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sede_show';
                $editGate      = 'sede_edit';
                $deleteGate    = 'sede_delete';
                $crudRoutePart = 'sedes';

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
            $table->editColumn('sede', function ($row) {
                return $row->sede ? $row->sede : "";
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });
            $table->addColumn('organizacion_empresa', function ($row) {
                return $row->organizacion ? $row->organizacion->empresa : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'organizacion']);

            return $table->make(true);
        }

        $organizacions = Organizacion::get();
        $teams         = Team::get();

        return view('admin.sedes.index', compact('organizacions', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('sede_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::all()->pluck('empresa', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sedes.create', compact('organizacions'));
    }

    public function store(StoreSedeRequest $request)
    {
        $sede = Sede::create($request->all());

        return redirect()->route('admin.sedes.index');
    }

    public function edit(Sede $sede)
    {
        abort_if(Gate::denies('sede_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacions = Organizacion::all()->pluck('empresa', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sede->load('organizacion', 'team');

        return view('admin.sedes.edit', compact('organizacions', 'sede'));
    }

    public function update(UpdateSedeRequest $request, Sede $sede)
    {
        $sede->update($request->all());

        return redirect()->route('admin.sedes.index');
    }

    public function show(Sede $sede)
    {
        abort_if(Gate::denies('sede_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sede->load('organizacion', 'team');

        return view('admin.sedes.show', compact('sede'));
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
