<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Team;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Objetivosseguridad;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreObjetivosseguridadRequest;
use App\Http\Requests\UpdateObjetivosseguridadRequest;
use App\Http\Requests\MassDestroyObjetivosseguridadRequest;

class ObjetivosseguridadController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('objetivosseguridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Objetivosseguridad::with(['team'])->select(sprintf('%s.*', (new Objetivosseguridad)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'objetivosseguridad_show';
                $editGate      = 'objetivosseguridad_edit';
                $deleteGate    = 'objetivosseguridad_delete';
                $crudRoutePart = 'objetivosseguridads';

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
            $table->editColumn('objetivoseguridad', function ($row) {
                return $row->objetivoseguridad ? $row->objetivoseguridad : "";
            });
            $table->editColumn('indicador', function ($row) {
                return $row->indicador ? $row->indicador : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.objetivosseguridads.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('objetivosseguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $responsables  = Empleado::get();

        return view('admin.objetivosseguridads.create', compact('responsables'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $objetivosseguridad = Objetivosseguridad::create($request->all());

        return redirect()->route('admin.objetivosseguridads.index')->with("success", 'Guardado con éxito');
    }

    public function edit(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivosseguridad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridad->load('team');

        return view('admin.objetivosseguridads.edit', compact('objetivosseguridad'));
    }

    public function update(UpdateObjetivosseguridadRequest $request, Objetivosseguridad $objetivosseguridad)
    {
        $objetivosseguridad->update($request->all());

        return redirect()->route('admin.objetivosseguridads.index')->with("success", 'Editado con éxito');
    }

    public function show(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivosseguridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridad->load('team');

        return view('admin.objetivosseguridads.show', compact('objetivosseguridad'));
    }

    public function destroy(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivosseguridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridad->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyObjetivosseguridadRequest $request)
    {
        Objetivosseguridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
