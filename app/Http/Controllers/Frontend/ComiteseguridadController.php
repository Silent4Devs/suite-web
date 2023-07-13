<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyComiteseguridadRequest;
use App\Http\Requests\UpdateComiteseguridadRequest;
use App\Models\Comiteseguridad;
use App\Models\Empleado;
use App\Models\Organizacion;
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
        // $query = Comiteseguridad::with(['personaasignada', 'team','asignacion'])->select(sprintf('%s.*', (new Comiteseguridad)->table))->get();
        // dd($query[2]->asignacion->avatar);
        abort_if(Gate::denies('comiteseguridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Comiteseguridad::with(['personaasignada', 'team', 'asignacion'])->select(sprintf('%s.*', (new Comiteseguridad)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'comiteseguridad_show';
                $editGate = 'comiteseguridad_edit';
                $deleteGate = 'comiteseguridad_delete';
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
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nombrerol', function ($row) {
                return $row->nombrerol ? $row->nombrerol : '';
            });
            $table->addColumn('asignada', function ($row) {
                return $row->asignacion ? $row->asignacion : '';
            });
            $table->editColumn('responsabilidades', function ($row) {
                return $row->responsabilidades ? $row->responsabilidades : '';
            });
            $table->editColumn('fechavigor', function ($row) {
                return $row->fechavigor ? $row->fechavigor : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'personaasignada']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();

        return view('frontend.comiteseguridads.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('comiteseguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personaasignadas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::with('area')->get();

        return view('frontend.comiteseguridads.create', compact('personaasignadas', 'empleados'));
    }

    public function store(Request $request)
    {
        $comiteseguridad = Comiteseguridad::create($request->all());
        // dd($comiteseguridad);

        return redirect()->route('frontend.comiteseguridads.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personaasignadas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comiteseguridad->load('personaasignada', 'team');
        $empleados = Empleado::with('area')->get();

        return view('frontend.comiteseguridads.edit', compact('personaasignadas', 'comiteseguridad', 'empleados'));
    }

    public function update(UpdateComiteseguridadRequest $request, Comiteseguridad $comiteseguridad)
    {
        $comiteseguridad->update($request->all());

        return redirect()->route('comiteseguridads.index')->with('success', 'Editado con éxito');
    }

    public function show(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comiteseguridad->load('personaasignada', 'team');

        return view('frontend.comiteseguridads.show', compact('comiteseguridad'));
    }

    public function destroy(Comiteseguridad $comiteseguridad)
    {
        abort_if(Gate::denies('comiteseguridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comiteseguridad->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyComiteseguridadRequest $request)
    {
        Comiteseguridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function visualizacion()
    {
        $comiteseguridads = Comiteseguridad::get();

        $organizacion = Organizacion::getAll();

        return view('frontend.comiteseguridads.visualizacion', compact('comiteseguridads', 'organizacion'));
    }
}
