<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class TipoactivoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('configuracion_tipoactivo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Tipoactivo::select("*")->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'configuracion_tipoactivo_show';
                $editGate = 'configuracion_tipoactivo_edit';
                $deleteGate = 'configuracion_tipoactivo_delete';
                $crudRoutePart = 'tipoactivos';

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
            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? $row->tipo : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.tipoactivos.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('configuracion_tipoactivo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoactivos.create');
    }

    public function store(Request $request)
    {
        $tipoactivo = Tipoactivo::create($request->all());

        return redirect()->route('admin.tipoactivos.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Tipoactivo $tipoactivo)
    {
        abort_if(Gate::denies('configuracion_tipoactivo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivo->load('team');

        return view('admin.tipoactivos.edit', compact('tipoactivo'));
    }

    public function update(Request $request, Tipoactivo $tipoactivo)
    {
        $tipoactivo->update($request->all());

        return redirect()->route('admin.tipoactivos.index')->with('success', 'Editado con éxito');
    }

    public function show(Tipoactivo $tipoactivo)
    {
        abort_if(Gate::denies('configuracion_tipoactivo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivo->load('team');

        return view('admin.tipoactivos.show', compact('tipoactivo'));
    }

    public function destroy(Tipoactivo $tipoactivo)
    {
        abort_if(Gate::denies('configuracion_tipoactivo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyTipoactivoRequest $request)
    {
        Tipoactivo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
