<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyActivoRequest;
use App\Http\Requests\StoreActivoRequest;
use App\Http\Requests\UpdateActivoRequest;
use App\Models\Activo;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Marca;
use App\Models\Modelo;
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
        abort_if(Gate::denies('configuracion_activo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Activo::with(['tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team'])->select(sprintf('%s.*', (new Activo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'configuracion_activo_show';
                $editGate = 'configuracion_activo_edit';
                $deleteGate = 'configuracion_activo_delete';
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
                return $row->id ? $row->id : '';
            });

            $table->editColumn('nombre_activo', function ($row) {
                return $row->nombre_activo ? $row->nombre_activo : '';
            });

            $table->addColumn('tipoactivo_tipo', function ($row) {
                return $row->tipoactivo ? $row->tipoactivo->tipo : '';
            });

            $table->addColumn('subtipo_subtipo', function ($row) {
                return $row->subtipo ? $row->subtipo->subtipo : '';
            });

            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->addColumn('dueno_name', function ($row) {
                return $row->dueno ? $row->dueno->name : '';
            });

            $table->addColumn('ubicacion_sede', function ($row) {
                return $row->ubicacion ? $row->ubicacion->sede : '';
            });

            $table->editColumn('marca', function ($row) {
                return $row->marca ? $row->marca : '';
            });

            $table->editColumn('modelo', function ($row) {
                return $row->modelo ? $row->modelo : '';
            });

            $table->editColumn('n_serie', function ($row) {
                return $row->n_serie ? $row->n_serie : '';
            });

            $table->editColumn('n_producto', function ($row) {
                return $row->n_producto ? $row->n_producto : '';
            });

            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });

            $table->editColumn('fecha_compra', function ($row) {
                return $row->fecha_compra ? $row->fecha_compra : '';
            });

            $table->editColumn('puesto_dueño', function ($row) {
                return $row->empleado ? $row->empleado->puesto : '';
            });
            $table->editColumn('area_dueño', function ($row) {
                return $row->empleado ? $row->empleado->area : '';
            });
            $table->editColumn('responsable', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });
            $table->editColumn('puesto_responsable', function ($row) {
                return $row->empleado ? $row->empleado->puesto : '';
            });
            $table->editColumn('area_responsable', function ($row) {
                return $row->empleado ? $row->empleado->area : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tipoactivo', 'subtipo', 'dueno', 'ubicacion']);

            return $table->make(true);
        }

        $tipoactivos = Tipoactivo::get();
        $tipoactivos = Tipoactivo::get();
        $users = User::getAll();
        $sedes = Sede::getAll();
        $teams = Team::get();

        return view('admin.activos.index', compact('tipoactivos', 'tipoactivos', 'users', 'sedes', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('configuracion_activo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = Tipoactivo::all()->pluck('subtipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleados = Empleado::with('area')->get();

        $area = Area::get();

        $marcas = Marca::get();

        $modelos = Modelo::get();

        return view('admin.activos.create', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions', 'empleados', 'area', 'marcas', 'modelos'));
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
        // dd($request->hasfile('documentos_relacionados'));
        // $activo = Activo::create($request->all());
        $data = [];

        if ($request->hasfile('documentos_relacionados')) {
            foreach ($request->file('documentos_relacionados') as $file) {
                // $nombre_original =  $request->nombreactivo;
                // $nombre_compuesto = basename($nombre_original) . '.' . $file->extension();
                $nombre_compuesto = $file->getClientOriginalName();
                $file->storeAs('public/activos', $nombre_compuesto); // Almacenar Archivo

                $data[] = $nombre_compuesto;
            }
        } else {
            $data = [];
        }

        // $extension = pathinfo($request->file('documentos_relacionados')->getClientOriginalName(), PATHINFO_EXTENSION);
        // $nombre_original =  $request->nombreactivo;
        // $nombre_compuesto = basename($nombre_original) . '.' . $extension;
        // $request->file('documentos_relacionados')->storeAs('public/activos', $nombre_compuesto); // Almacenar Archivo
        // $activo->documentos_relacionados = $data;
        // $activo->save();

        Activo::create([
            'nombreactivo' => $request->nombreactivo,
            'descripcion' => $request->descripcion,
            'marca' => intval($request->marca),
            'modelo' => intval($request->modelo),
            'n_serie' => $request->n_serie,
            'n_producto' => $request->n_producto,
            'fecha_fin' => $request->fecha_fin,
            'fecha_compra' => $request->fecha_compra,
            'fecha_baja' => $request->fecha_baja,
            'fecha_alta' => $request->fecha_alta,
            'dueno_id' => $request->dueno_id,
            'id_responsable' => $request->id_responsable,
            'tipoactivo_id' => $request->tipoactivo_id,
            'subtipo_id' => $request->subtipo_id,
            'ubicacion_id' => $request->ubicacion_id,
            'sede' => $request->sede,
            'observaciones' => $request->observaciones,
            'documentos_relacionados' => json_encode($data),

        ]);

        return redirect()->route('admin.activos.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Activo $activo)
    {
        abort_if(Gate::denies('configuracion_activo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = Tipoactivo::all()->pluck('subtipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activo->load('tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team');

        $empleados = Empleado::with('area')->get();

        $area = Area::get();

        $marcas = Marca::get();

        $modelos = Modelo::get();

        $marca_seleccionada = Marca::select('id', 'nombre')->find($activo->marca);

        $modelo_seleccionado = Modelo::select('id', 'nombre')->find($activo->modelo);

        return view('admin.activos.edit', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions', 'activo', 'empleados', 'area', 'marcas', 'modelos', 'marca_seleccionada', 'modelo_seleccionado'));
    }

    public function update(UpdateActivoRequest $request, Activo $activo)
    {
        $data = [];
        if ($request->hasfile('documentos_relacionados')) {
            foreach ($request->file('documentos_relacionados') as $file) {
                $nombre_compuesto = $file->getClientOriginalName();
                $file->storeAs('public/activos', $nombre_compuesto); // Almacenar Archivo

                $data[] = $nombre_compuesto;
            }
        } else {
            $data = $activo->documentos_relacionados;
        }

        $activo->update([
            'nombreactivo' => $request->nombreactivo,
            'descripcion' => $request->descripcion,
            'marca' => intval($request->marca),
            'modelo' => intval($request->modelo),
            'n_serie' => $request->n_serie,
            'n_producto' => $request->n_producto,
            'fecha_fin' => $request->fecha_fin,
            'fecha_compra' => $request->fecha_compra,
            'fecha_baja' => $request->fecha_baja,
            'fecha_alta' => $request->fecha_alta,
            'dueno_id' => $request->dueno_id,
            'id_responsable' => $request->id_responsable,
            'tipoactivo_id' => $request->tipoactivo_id,
            'subtipo_id' => $request->subtipo_id,
            'ubicacion_id' => $request->ubicacion_id,
            'sede' => $request->sede,
            'observaciones' => $request->observaciones,
            'documentos_relacionados' => $data,

        ]);
        //  dd($activo);

        return redirect()->route('admin.activos.index')->with('success', 'Editado con éxito');
    }

    public function show(Activo $activo)
    {
        abort_if(Gate::denies('configuracion_activo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activo->load('tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team', 'activoIncidentesDeSeguridads');

        return view('admin.activos.show', compact('activo'));
    }

    public function destroy(Activo $activo)
    {
        abort_if(Gate::denies('configuracion_activo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyActivoRequest $request)
    {
        Activo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
