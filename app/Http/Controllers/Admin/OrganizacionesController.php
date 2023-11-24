<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrganizacioneRequest;
use App\Http\Requests\StoreOrganizacioneRequest;
use App\Http\Requests\UpdateOrganizacioneRequest;
use App\Models\Organizacion;
use App\Models\Organizacione;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrganizacionesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mi_organizacion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Organizacione::with(['team'])->select(sprintf('%s.*', (new Organizacione)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'organizacione_show';
                $editGate = 'organizacione_edit';
                $deleteGate = 'organizacione_delete';
                $crudRoutePart = 'organizaciones';

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
            $table->editColumn('organizacion', function ($row) {
                return $row->organizacion ? $row->organizacion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.organizaciones.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('organizacione_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organizaciones.create');
    }

    public function store(StoreOrganizacioneRequest $request)
    {
        $organizacione = Organizacion::create($request->all());

        return redirect()->route('admin.organizaciones.index');
    }

    public function edit(Organizacione $organizacione)
    {
        abort_if(Gate::denies('organizacione_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacione->load('team');

        return view('admin.organizaciones.edit', compact('organizacione'));
    }

    public function update(UpdateOrganizacioneRequest $request, Organizacione $organizacione)
    {
        $organizacione->update($request->all());
        // example:
        alert()->success('Post Created', 'Successfully')->toToast();

        return redirect()->route('admin.organizaciones.index');
    }

    public function show(Organizacione $organizacione)
    {
        abort_if(Gate::denies('organizacione_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacione->load('team');

        return view('admin.organizaciones.show', compact('organizacione'));
    }

    public function destroy(Organizacione $organizacione)
    {
        abort_if(Gate::denies('organizacione_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacione->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrganizacioneRequest $request)
    {
        Organizacione::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
