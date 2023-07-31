<?php

namespace App\Http\Controllers\Admin;

use App\Functions\GeneratePdf;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAccionCorrectivaRequest;
use App\Mail\AprobacionAccionCorrectivaEmail;
use App\Models\AccionCorrectiva;
use App\Models\ActividadAccionCorrectiva;
use App\Models\AnalisisAccionCorrectiva;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\PlanaccionCorrectiva;
use App\Models\Proceso;
use App\Models\Puesto;
use App\Models\QuejasCliente;
use App\Models\Team;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\Tipoactivo;
use App\Models\User;
use Flash;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AccionCorrectivaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('accion_correctiva_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $query = AccionCorrectiva::with(['nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team','empleados','reporto'])->select(sprintf('%s.*', (new AccionCorrectiva)->table))->orderByDesc('id')->get();
        // dd($query);
        if ($request->ajax()) {
            $query = AccionCorrectiva::with(['nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team', 'empleados', 'reporto'])->where('aprobada', true)->select(sprintf('%s.*', (new AccionCorrectiva)->table))->orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'accion_correctiva_show';
                $editGate = 'accion_correctiva_show';
                $deleteGate = 'accion_correctiva_show';
                $crudRoutePart = 'accion-correctivas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : '';
            // });

            $table->addColumn('folio', function ($row) {
                return $row->folio ? $row->folio : '';
            });

            $table->addColumn('tema', function ($row) {
                return $row->tema ? $row->tema : '';
            });

            $table->addColumn('fecharegistro', function ($row) {
                return $row->fecharegistro ? \Carbon\Carbon::parse($row->fecharegistro)->format('d-m-Y') : '';
            });

            $table->addColumn('fecha_verificacion', function ($row) {
                return $row->fecha_verificacion ? \Carbon\Carbon::parse($row->fecha_verificacion)->format('d-m-Y') : '';
            });
            $table->addColumn('estatus', function ($row) {
                return $row->estatus ? $row->estatus : '';
            });

            $table->addColumn('fecha_cierre', function ($row) {
                return $row->fecha_cierre ? \Carbon\Carbon::parse($row->fecha_cierre)->format('d-m-Y') : '';
            });

            $table->addColumn('reporto', function ($row) {
                return $row->reporto ? $row->reporto : '';
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
                return $row->descripcion ? html_entity_decode(strip_tags($row->descripcion), ENT_QUOTES, 'UTF-8') : 'n/a';
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

        $total_AC = AccionCorrectiva::get()->count();
        $nuevos_AC = AccionCorrectiva::where('estatus', 'Sin atender')->get()->count();
        $en_curso_AC = AccionCorrectiva::where('estatus', 'En curso')->get()->count();
        $en_espera_AC = AccionCorrectiva::where('estatus', 'En espera')->get()->count();
        $cerrados_AC = AccionCorrectiva::where('estatus', 'Cerrado')->get()->count();
        $cancelados_AC = AccionCorrectiva::where('estatus', 'No procedente')->get()->count();

        return view('admin.accionCorrectivas.index', compact('total_AC', 'nuevos_AC', 'en_curso_AC', 'en_espera_AC', 'cerrados_AC', 'cancelados_AC', 'users', 'puestos', 'users', 'puestos', 'users', 'users', 'teams'));
    }

    public function obtenerAccionesCorrectivasSinAprobacion()
    {
        $accionesCorrectivas = AccionCorrectiva::with(['deskQuejaCliente' => function ($query) {
            $query->with('registro', 'responsableSgi');
        }])->where('aprobada', false)->where('aprobacion_contestada', false)->get();

        return datatables()->of($accionesCorrectivas)->toJson();
    }

    public function aprobaroRechazarAc(Request $request)
    {
        $accionCorrectiva = AccionCorrectiva::with('quejascliente')->find($request->id);
        $esAprobada = $request->aprobada == 'true' ? true : false;
        // dd($esAprobada);
        $accionCorrectiva->update([
            'aprobada' => $esAprobada,
            'aprobacion_contestada' => true,
            'comentarios_aprobacion' => $request->comentarios,
        ]);
        // dd($accionCorrectiva->quejasCliente);

        $quejasClientes = QuejasCliente::find($request->id_queja_cliente)->load('responsableSgi', 'registro', 'accionCorrectiva');
        Mail::to($quejasClientes->registro->email)->cc($quejasClientes->responsableSgi->email)->send(new AprobacionAccionCorrectivaEmail($quejasClientes));

        if ($esAprobada) {
            return response()->json(['success' => true, 'message' => 'Acción Correctiva Generada', 'aprobado' => true]);
        } else {
            return response()->json(['success' => true, 'message' => 'Acción Correctiva Rechazada', 'aprobado' => false]);
        }
    }

    public function create()
    {
        abort_if(Gate::denies('accion_correctiva_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::getAll();
        $puestos = Puesto::getAll();

        $nombrereportas = $user->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoreportas = $puestos->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = $user->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = $puestos->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = $user->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = $user->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleados = Empleado::alta()->with('area')->get();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Tipoactivo::getAll();

        return view('admin.accionCorrectivas.create', compact('nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas', 'empleados', 'areas', 'procesos', 'activos'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('accion_correctiva_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'tema' => 'required|string',
            'fecharegistro' => 'required',
            'id_reporto' => 'required',
            'id_registro' => 'required',
            'causaorigen' => 'required',
            'descripcion' => 'required|string',
        ]);

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
            'estatus' => 'Sin atender',
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
        // dd($accionCorrectiva);
        abort_if(Gate::denies('accion_correctiva_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::getAll();
        $puestos = Puesto::getAll();

        $nombrereportas = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoreportas = $puestos->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = $puestos->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accionCorrectiva->load('nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team');

        $empleados = Empleado::with('area')->orderBy('name')->get();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Tipoactivo::getAll();

        $id = $accionCorrectiva->id;

        $quejasClientes = QuejasCliente::getAll()->where('accion_correctiva_id', '=', $accionCorrectiva->id);

        $clientes = TimesheetCliente::getAll();

        $proyectos = TimesheetProyecto::getAll();

        $analisis = AnalisisAccionCorrectiva::where('accion_correctiva_id', $accionCorrectiva->id)->first();

        // dd($accionCorrectiva->quejascliente);
        // $PlanAccion = PlanaccionCorrectiva::select('planaccion_correctivas.id', 'planaccion_correctivas.accioncorrectiva_id', 'planaccion_correctivas.actividad', 'planaccion_correctivas.fechacompromiso', 'planaccion_correctivas.estatus', 'planaccion_correctivas.responsable_id', 'users.name','empleados')
        //     ->join('accion_correctivas', 'planaccion_correctivas.accioncorrectiva_id', '=', 'accion_correctivas.id')
        //     ->join('users', 'planaccion_correctivas.responsable_id', '=', 'users.id')
        //     ->where('planaccion_correctivas.accioncorrectiva_id', '=', $id)
        //     ->get();
        // $Count = $PlanAccion->count();
        // dd($accionCorrectiva);

        return view('admin.accionCorrectivas.edit', compact('clientes', 'proyectos', 'quejasClientes', 'nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas', 'accionCorrectiva', 'id', 'empleados', 'areas', 'procesos', 'activos', 'analisis'));
    }

    public function update(Request $request, AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'tema' => 'required|string',
            'fecharegistro' => 'required',
            'id_reporto' => 'required',
            'id_registro' => 'required',
            'causaorigen' => 'required',
            'descripcion' => 'required|string',
        ]);

        $accionCorrectiva->update($request->all());
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

        // QuejasCliente::create([
        //     'titulo' => $request->titulo,
        //     'cliente_id'=>$request->cliente_id,
        //     'proyectos_id'=>$request->proyectos_id,
        //     'descripcion' => $request->descripcion,
        //     'nombre' => $request->nombre,
        //     'puesto' => $request->puesto,
        //     'telefono' => $request->telefono,
        //     'correo' => $request->correo,
        //     'area_quejado' => $request->area_quejado,
        //     'colaborador_quejado' => $request->colaborador_quejado,
        //     'proceso_quejado' => $request->proceso_quejado,
        //     'otro_quejado' => $request->otro_quejado,
        //     'accion_correctiva_id' => $accionCorrectiva->id,
        // ]);

        Flash::success('Editado con éxito');

        return redirect()->route('admin.accion-correctivas.index')->with('success', 'Editado con éxito');
    }

    public function show(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actividades = ActividadAccionCorrectiva::with('responsables')->where('accion_correctiva_id', $accionCorrectiva->id)->get();
        $accionCorrectiva->load('analisis', 'nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team', 'accioncorrectivaPlanaccionCorrectivas', 'planes');
        // dd($accionCorrectiva->planes);
        return view('admin.accionCorrectivas.show', compact('accionCorrectiva', 'actividades'));
    }

    public function destroy(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accionCorrectiva->delete();

        Flash::success('Registro eliminado exitosamente');

        return back();
    }

    public function massDestroy(MassDestroyAccionCorrectivaRequest $request)
    {
        AccionCorrectiva::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function planesAccionCorrectiva(Request $request)
    {
        $accionCorrectiva = AccionCorrectiva::find($request->id);
        // $accionCorrectiva->planes()->detach();
        $accionCorrectiva->planes()->sync($request->planes);

        return response()->json(['success' => true]);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('accion_correctiva_crear') && Gate::denies('accion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        $request->validate([
            'control_a' => 'nullable|string|max:350',
            'proceso_a' => 'nullable|string|max:350',
            'personas_a' => 'nullable|string|max:350',
            'tecnologia_a' => 'nullable|string|max:350',
            'ambiente_a' => 'nullable|string|max:350',
            'metodos_a' => 'nullable|string|max:350',
            'problema_diagrama' => 'nullable|string|max:350',
        ]);
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
