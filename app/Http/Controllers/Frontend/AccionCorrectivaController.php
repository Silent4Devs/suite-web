<?php

namespace App\Http\Controllers\Admin;

use App\Functions\GeneratePdf;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAccionCorrectivaRequest;
use App\Http\Requests\UpdateAccionCorrectivaRequest;
use App\Models\AccionCorrectiva;
use App\Models\AnalisisAccionCorrectiva;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\PlanaccionCorrectiva;
use App\Models\Proceso;
use App\Models\Puesto;
use App\Models\Team;
use App\Models\Tipoactivo;
use App\Models\User;
use Flash;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AccionCorrectivaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('accion_correctiva_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $query = AccionCorrectiva::with(['nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team','empleados'])->select(sprintf('%s.*', (new AccionCorrectiva)->table))->orderByDesc('id')->get();
        // dd($query);
        if ($request->ajax()) {
            $query = AccionCorrectiva::with(['nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team', 'empleados'])->select(sprintf('%s.*', (new AccionCorrectiva)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'accion_correctiva_show';
                $editGate = 'accion_correctiva_edit';
                $deleteGate = 'accion_correctiva_delete';
                $crudRoutePart = 'accion-correctivas';

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

            $table->addColumn('folio', function ($row) {
                return $row->folio ? $row->folio : '';
            });

            $table->addColumn('tema', function ($row) {
                return $row->tema ? $row->tema : '';
            });

            $table->addColumn('fecharegistro', function ($row) {
                return $row->fecharegistro ? $row->fecharegistro : '';
            });

            $table->addColumn('fecha_verificacion', function ($row) {
                return $row->fecha_verificacion ? $row->fecha_verificacion : '';
            });

            $table->addColumn('estatus', function ($row) {
                return $row->estatus ? $row->estatus : '';
            });

            $table->addColumn('fecha_cierre', function ($row) {
                return $row->fecha_cierre ? $row->fecha_cierre : '';
            });

            $table->addColumn('reporto', function ($row) {
                return $row->reporto ? $row->reporto->name : '';
            });

            $table->addColumn('reporto_puesto', function ($row) {
                return $row->reporto ? $row->reporto->puesto : '';
            });
            $table->addColumn('reporto_area', function ($row) {
                return $row->reporto ? $row->reporto->area->area : '';
            });

            $table->addColumn('registro', function ($row) {
                return $row->empleados ? $row->empleados->name : '';
            });

            $table->addColumn('registro_puesto', function ($row) {
                return $row->empleados ? $row->empleados->puesto : '';
            });
            $table->addColumn('registro_area', function ($row) {
                return $row->empleados ? $row->empleados->area->area : '';
            });
            $table->addColumn('causaorigen', function ($row) {
                return $row->causaorigen ? $row->causaorigen : '';
            });
            $table->addColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->addColumn('comentarios', function ($row) {
                return $row->comentarios ? $row->comentarios : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'documentometodo']);

            return $table->make(true);
        }

        $users = User::getAll();
        $puestos = Puesto::getAll();
        $teams = Team::get();

        return view('admin.accionCorrectivas.index', compact('users', 'puestos', 'users', 'puestos', 'users', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('accion_correctiva_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrereportas = User::get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoreportas = Puesto::get()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = User::get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = Puesto::get()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = User::get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = User::get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleados = Empleado::alta()->with('area')->get();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Tipoactivo::getAll();

        return view('admin.accionCorrectivas.create', compact('nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas', 'empleados', 'areas', 'procesos', 'activos'));
    }

    public function store(Request $request)
    {
        $accionCorrectiva = AccionCorrectiva::create([
            'tema' => $request->tema,
            'fecharegistro' => $request->fecharegistro,
            'id_reporto' => $request->id_reporto,
            'id_registro' => $request->id_registro,
            'causaorigen' => $request->causaorigen,
            'descripcion' => $request->descripcion,
            'areas' => $request->areas,
            'procesos' => $request->procesos,
            'activos' => $request->activos,
            'estatus' => 'Nuevo',
        ]);

        // $accionCorrectiva = AccionCorrectiva::create($request->all());;
        //dd($request['pdf-value']);

        /*     if ($request->input('documentometodo', false)) {
                 $accionCorrectiva->addMedia(storage_path('tmp/uploads/' . $request->input('documentometodo')))->toMediaCollection('documentometodo');
             }

             if ($media = $request->input('ck-media', false)) {
                 Media::whereIn('id', $media)->update(['model_id' => $accionCorrectiva->id]);
             }
             $generar = new GeneratePdf();
             //$generar->Generate($request['pdf-value'], $request);
             $generar->Generate($request['pdf-value'], $accionCorrectiva);      */

        Flash::success('Registro guardado exitosamente');
        // return redirect('admin/plan-correctiva?param=' . $accionCorrectiva->id);
        return redirect()->route('admin.accion-correctivas.edit', $accionCorrectiva);
    }

    public function edit(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrereportas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoreportas = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accionCorrectiva->load('nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team');

        $empleados = Empleado::alta()->with('area')->get();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Tipoactivo::getAll();

        $id = $accionCorrectiva->id;

        $analisis = AnalisisAccionCorrectiva::where('accion_correctiva_id', $accionCorrectiva->id)->first();

        // $PlanAccion = PlanaccionCorrectiva::select('planaccion_correctivas.id', 'planaccion_correctivas.accioncorrectiva_id', 'planaccion_correctivas.actividad', 'planaccion_correctivas.fechacompromiso', 'planaccion_correctivas.estatus', 'planaccion_correctivas.responsable_id', 'users.name','empleados')
        //     ->join('accion_correctivas', 'planaccion_correctivas.accioncorrectiva_id', '=', 'accion_correctivas.id')
        //     ->join('users', 'planaccion_correctivas.responsable_id', '=', 'users.id')
        //     ->where('planaccion_correctivas.accioncorrectiva_id', '=', $id)
        //     ->get();
        // $Count = $PlanAccion->count();
        // dd($accionCorrectiva);

        return view('admin.accionCorrectivas.edit', compact('nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas', 'accionCorrectiva', 'id', 'empleados', 'areas', 'procesos', 'activos', 'analisis'));
    }

    public function update(UpdateAccionCorrectivaRequest $request, AccionCorrectiva $accionCorrectiva)
    {
        $accionCorrectiva->update($request->all());
        //dd($accionCorrectiva);
        if ($request->input('documentometodo', false)) {
            if (!$accionCorrectiva->documentometodo || $request->input('documentometodo') !== $accionCorrectiva->documentometodo->file_name) {
                if ($accionCorrectiva->documentometodo) {
                    $accionCorrectiva->documentometodo->delete();
                }

                $accionCorrectiva->addMedia(storage_path('tmp/uploads/' . $request->input('documentometodo')))->toMediaCollection('documentometodo');
            }
        } elseif ($accionCorrectiva->documentometodo) {
            $accionCorrectiva->documentometodo->delete();
        }

        return redirect()->route('admin.accion-correctivas.index');
    }

    public function show(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accionCorrectiva->load('nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team', 'accioncorrectivaPlanaccionCorrectivas');

        return view('admin.accionCorrectivas.show', compact('accionCorrectiva'));
    }

    public function destroy(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accionCorrectiva->delete();

        Flash::success('Registro guardado exitosamente');

        return back();
    }

    public function massDestroy(MassDestroyAccionCorrectivaRequest $request)
    {
        AccionCorrectiva::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('accion_correctiva_create') && Gate::denies('accion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new AccionCorrectiva();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function test()
    {
        dd('Test');
    }

    public function storeAnalisis(Request $request, $accion)
    {
        $exist_accion_id = AnalisisAccionCorrectiva::where('accion_correctiva_id', $accion)->exists();
        if ($exist_accion_id) {
            $analisis = AnalisisAccionCorrectiva::where('accion_correctiva_id', $accion)->first();
            $analisis->update($request->all());
        } else {
            $analisis = AnalisisAccionCorrectiva::create(array_merge($request->all(), ['accion_correctiva_id' => $accion]));
        }

        return redirect()->route('admin.accion-correctivas.edit', $accion);
    }
}
