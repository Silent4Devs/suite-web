<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRegistromejoraRequest;
use App\Http\Requests\StoreRegistromejoraRequest;
use App\Http\Requests\UpdateRegistromejoraRequest;
use App\Models\Empleado;
use App\Models\Registromejora;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RegistromejoraController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('registromejora_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Registromejora::with(['nombre_reporta', 'responsableimplementacion', 'valida', 'team'])->select(sprintf('%s.*', (new Registromejora)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'registromejora_show';
                $editGate = 'registromejora_edit';
                $deleteGate = 'registromejora_delete';
                $crudRoutePart = 'registromejoras';

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
            $table->addColumn('nombre_reporta_name', function ($row) {
                return $row->nombre_reporta ? $row->nombre_reporta->name : '';
            });

            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('prioridad', function ($row) {
                return $row->prioridad ? Registromejora::PRIORIDAD_SELECT[$row->prioridad] : '';
            });
            $table->editColumn('clasificacion', function ($row) {
                return $row->clasificacion ? $row->clasificacion : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->addColumn('responsableimplementacion_name', function ($row) {
                return $row->responsableimplementacion ? $row->responsableimplementacion->name : '';
            });

            $table->editColumn('participantes', function ($row) {
                return $row->participantes ? $row->participantes : '';
            });
            $table->editColumn('recursos', function ($row) {
                return $row->recursos ? $row->recursos : '';
            });
            $table->editColumn('beneficios', function ($row) {
                return $row->beneficios ? $row->beneficios : '';
            });
            $table->addColumn('valida_name', function ($row) {
                return $row->valida ? $row->valida->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nombre_reporta', 'responsableimplementacion', 'valida']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();

        return view('admin.registromejoras.index', compact('users', 'users', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('registromejora_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::getAll();

        $nombre_reportas = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsableimplementacions = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $validas = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('admin.registromejoras.create', compact('nombre_reportas', 'responsableimplementacions', 'validas', 'empleados'));
    }

    public function store(StoreRegistromejoraRequest $request)
    {
        $registromejora = Registromejora::create($request->all());

        return redirect()->route('admin.registromejoras.index');
    }

    public function edit(Registromejora $registromejora)
    {
        abort_if(Gate::denies('registromejora_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::getAll();
        $nombre_reportas = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsableimplementacions = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $validas = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $registromejora->load('nombre_reporta', 'responsableimplementacion', 'valida', 'team');

        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('admin.registromejoras.edit', compact('nombre_reportas', 'responsableimplementacions', 'validas', 'registromejora', 'empleados'));
    }

    public function update(UpdateRegistromejoraRequest $request, Registromejora $registromejora)
    {
        $registromejora->update($request->all());

        return redirect()->route('admin.registromejoras.index');
    }

    public function show(Registromejora $registromejora)
    {
        abort_if(Gate::denies('registromejora_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registromejora->load('nombre_reporta', 'responsableimplementacion', 'valida', 'team', 'mejoraDmaics', 'mejoraPlanMejoras');

        return view('admin.registromejoras.show', compact('registromejora'));
    }

    public function destroy(Registromejora $registromejora)
    {
        abort_if(Gate::denies('registromejora_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registromejora->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegistromejoraRequest $request)
    {
        Registromejora::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
