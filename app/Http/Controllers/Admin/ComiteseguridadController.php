<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyComiteseguridadRequest;
use App\Http\Requests\StoreComiteseguridadRequest;
use App\Http\Requests\UpdateComiteseguridadRequest;
use App\Models\Comiteseguridad;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComiteseguridadController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('comiteseguridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Comiteseguridad::with(['personaasignada', 'team'])->select(sprintf('%s.*', (new Comiteseguridad)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'comiteseguridad_show';
                $editGate      = 'comiteseguridad_edit';
                $deleteGate    = 'comiteseguridad_delete';
                $crudRoutePart = 'comiteseguridads';

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
            $table->editColumn('nombrerol', function ($row) {
                return $row->nombrerol ? $row->nombrerol : "";
            });
            $table->addColumn('personaasignada_name', function ($row) {
                return $row->personaasignada ? $row->personaasignada->name : '';
            });

            $table->editColumn('responsabilidades', function ($row) {
                return $row->responsabilidades ? $row->responsabilidades : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'personaasignada']);

            return $table->make(true);
        }

        $users = User::get();
        $teams = Team::get();

        return view('admin.comiteseguridads.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('comiteseguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personaasignadas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.comiteseguridads.create', compact('personaasignadas'));
    }

    public function store(StoreComiteseguridadRequest $request)
    {
        $comiteseguridad = Comiteseguridad::create($request->all());

        return redirect()->route('admin.comiteseguridads.index');
    }

    public function edit(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personaasignadas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comiteseguridad->load('personaasignada', 'team');

        return view('admin.comiteseguridads.edit', compact('personaasignadas', 'comiteseguridad'));
    }

    public function update(UpdateComiteseguridadRequest $request, Comiteseguridad $comiteseguridad)
    {
        $comiteseguridad->update($request->all());

        return redirect()->route('admin.comiteseguridads.index');
    }

    public function show(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comiteseguridad->load('personaasignada', 'team');

        return view('admin.comiteseguridads.show', compact('comiteseguridad'));
    }

    public function destroy(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comiteseguridad->delete();

        return back();
    }

    public function massDestroy(MassDestroyComiteseguridadRequest $request)
    {
        Comiteseguridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
