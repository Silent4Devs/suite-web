<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Area;
use App\Models\Sede;
use App\Models\Team;
use App\Models\User;
use App\Models\Marca;
use App\Models\Activo;
use App\Models\Modelo;
use App\Models\Empleado;
use App\Models\Tipoactivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreActivoRequest;
use App\Http\Requests\UpdateActivoRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyActivoRequest;

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

            $table->editColumn('nombre_activo', function ($row) {
                return $row->nombreactivo ? $row->nombreactivo: "";
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

            $table->editColumn('marca', function ($row) {
                return $row->marca ? $row->marca : "";
            });

            $table->editColumn('modelo', function ($row) {
                return $row->modelo ? $row->modelo : "";
            });

            $table->editColumn('n_serie', function ($row) {
                return $row->n_serie ? $row->n_serie : "";
            });

            $table->editColumn('n_producto', function ($row) {
                return $row->n_producto ? $row->n_producto : "";
            });

            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : "";
            });

            $table->editColumn('fecha_compra', function ($row) {
                return $row->fecha_compra ? $row->fecha_compra : "";
            });

            $table->editColumn('puesto_dueño', function ($row) {
                return $row->empleado ? $row->empleado->puesto : "";
            });
            $table->editColumn('area_dueño', function ($row) {
                return $row->empleado ? $row->empleado->area : "";
            });
            $table->editColumn('responsable', function ($row) {
                return $row->empleado ? $row->empleado->name : "";
            });
            $table->editColumn('puesto_responsable', function ($row) {
                return $row->empleado ? $row->empleado->puesto : "";
            });
            $table->editColumn('area_responsable', function ($row) {
                return $row->empleado ? $row->empleado->area : "";
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

        $empleados=Empleado::get();

        $area=Area::get();

        $marcas=Marca::get();

        $modelos=Modelo::get();

        return view('admin.activos.create', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions','empleados','area','marcas','modelos'));
    }

    public function store(StoreActivoRequest $request)
    {
        // $request->validate(
        //     [
        //         'nombre_activo_id' => 'required|string',
        //         'tipoactivo_id' => 'required|string',
        //         'subtipo' => 'required|integer',

        //     ],
        // );
        // dd($request->all());
        $activo = Activo::create($request->all());


        return redirect()->route('admin.activos.index')->with("success",'Guardado con éxito');
    }

    public function edit(Activo $activo)
    {
        abort_if(Gate::denies('activo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = Tipoactivo::all()->pluck('subtipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activo->load('tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team');

        $empleados=Empleado::get();

        $area=Area::get();

        $marcas=Marca::get();

        $modelos=Modelo::get();

        return view('admin.activos.edit', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions', 'activo','empleados','area','marcas','modelos'));
    }

    public function update(UpdateActivoRequest $request, Activo $activo)
    {

        $request->validate(
            [
                'nombreactivo' => 'required|string',
                'tipoactivo_id' => 'required|string',
                'subtipo_id' => 'required|integer',

            ],
        );

        $activo->update($request->all());

        return redirect()->route('admin.activos.index')->with("success",'Editado con éxito');
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

        return back()->with('deleted','Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyActivoRequest $request)
    {
        Activo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
