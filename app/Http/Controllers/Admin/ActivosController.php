<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyActivoRequest;
use App\Http\Requests\UpdateActivoRequest;
use App\Models\Activo;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Proceso;
use App\Models\Sede;
use App\Models\SubcategoriaActivo;
use App\Models\Team;
use App\Models\Tipoactivo;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ActivosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('inventario_activos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Activo::with(['tipoactivo' => function ($query) {
                $query->with('subcategoria_activos');
            }, 'dueno', 'empleado', 'ubicacion', 'team'])->select(sprintf('%s.*', (new Activo)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'inventario_activos_ver';
                $editGate = 'inventario_activos_editar';
                $deleteGate = 'inventario_activos_eliminar';
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

            $table->addColumn('subcategoria', function ($row) {
                return $row->subcategoria ? $row->subcategoria->subcategoria : '';
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

        $tipoactivos = Tipoactivo::getAll();
        $subtipo = SubcategoriaActivo::getAll();
        $users = User::getAll();
        $sedes = Sede::getAll();
        $teams = Team::get();
        $activos_nuevo = Activo::getAll();

        return view('admin.activos.index', compact('tipoactivos', 'users', 'sedes', 'teams', 'subtipo', 'activos_nuevo'));
    }

    public function create()
    {
        abort_if(Gate::denies('inventario_activos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = SubcategoriaActivo::all()->pluck('subcategoria', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleados = Empleado::alta()->with('area')->get();
        $procesos = Proceso::with('macroproceso')->get();

        $area = Area::getAll();

        $marcas = Marca::getAll();

        $modelos = Modelo::getAll();
        $tipos = Tipoactivo::getAll();

        return view('admin.activos.create', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions', 'empleados', 'area', 'marcas', 'modelos', 'tipos', 'procesos'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('inventario_activos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($request->all());

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

        $activo = Activo::create([
            'identificador' => $request->identificador,
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
            'documento' => $request->documento,
            'proceso_id' => $request->proceso_id,

        ]);

        if ($request->file('documento')) {
            $file = $request->file('documento');

            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            //    dd($nombre);

            //indicamos que queremos guardar un nuevo archivo en el disco local
            //    Storage::disk(('app\public\responsivasActivos'))->put($nombre,$file);
            $file->storeAs('public\responsivasActivos', $nombre);
            $activo->update(['documento' => $nombre]);
        }

        return redirect()->route('admin.activos.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Activo $activo)
    {
        abort_if(Gate::denies('inventario_activos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subtipos = SubcategoriaActivo::all()->pluck('subcategoria', 'id')->prepend(trans('global.pleaseSelect'), '');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubicacions = Sede::all()->pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleados = Empleado::alta()->with('area')->get();

        $procesos = Proceso::with('macroproceso')->get();

        $area = Area::getAll();

        $marcas = Marca::getAll();

        $modelos = Modelo::getAll();
        $tipos = Tipoactivo::getAll();
        $categoriasSeleccionado = $activo->tipoactivo_id;
        $subcategoriaSeleccionado = $activo->subtipo_id;
        // dd($subcategoriaSeleccionado);
        return view('admin.activos.edit', compact('tipoactivos', 'subtipos', 'duenos', 'ubicacions', 'empleados', 'area', 'marcas', 'modelos', 'tipos', 'activo', 'procesos', 'categoriasSeleccionado', 'subcategoriaSeleccionado'));
    }

    public function update(UpdateActivoRequest $request, Activo $activo)
    {
        abort_if(Gate::denies('inventario_activos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        abort_if(Gate::denies('inventario_activos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activo->load('tipoactivo', 'subtipo', 'dueno', 'ubicacion', 'team', 'activoIncidentesDeSeguridads');

        return view('admin.activos.show', compact('activo'));
    }

    public function destroy(Activo $activo)
    {
        abort_if(Gate::denies('inventario_activos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyActivoRequest $request)
    {
        Activo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    protected function downloadFile($src)
    {
        if (is_file($src)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $content_type = finfo_file($finfo, $src);
            finfo_close($finfo);
            $file_name = basename($src).PHP_EOL;
            $size = filesize($src);
            header("Content_Type: $content_type");
            header("Content-Disposition: attachemt; filename=$file_name");
            header('Content-Transfer-Encoding: binary');
            header("Content-Lenght: $size");
            readfile($src);

            return true;
        } else {
            return false;
        }

        // $path = storage_path('app/public/exportActivos/Responsiva.docx');

        // return response()->download($path);
    }

    public function DescargaFormato()
    {
        if (! $this->downloadFile(storage_path('app/public/exportActivos/Responsiva.docx'))) {
            return redirect()->back();
        }
    }
}
