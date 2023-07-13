<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTratamientoRiesgoRequest;
use App\Http\Requests\StoreTratamientoRiesgoRequest;
use App\Mail\RiesgoAceptadoRechazado;
use App\Mail\SolicitudAceptacionTratamientoRiesgo;
use App\Models\DeclaracionAplicabilidad;
use App\Models\Empleado;
use App\Models\Proceso;
use App\Models\Team;
use App\Models\TratamientoRiesgo;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TratamientoRiesgosController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TratamientoRiesgo::with(['control', 'responsable', 'team'])->select(sprintf('%s.*', (new TratamientoRiesgo)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tratamiento_de_los_riesgos_ver';
                $editGate = 'tratamiento_de_los_riesgos_editar';
                $deleteGate = 'tratamiento_de_los_riesgos_eliminar';
                $crudRoutePart = 'tratamiento-riesgos';

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
            $table->editColumn('identificador', function ($row) {
                return $row->identificador ? $row->identificador : '';
            });
            $table->editColumn('descripcionriesgo', function ($row) {
                return $row->descripcionriesgo ? html_entity_decode(strip_tags($row->descripcionriesgo), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->addColumn('tipo_riesgo', function ($row) {
                return $row->tipo_riesgo ? $row->tipo_riesgo : '';
            });

            $table->editColumn('riesgototal', function ($row) {
                return $row->riesgototal ? $row->riesgototal : '';
            });

            $table->editColumn('riesgo_total_residual', function ($row) {
                return $row->riesgo_total_residual ? $row->riesgo_total_residual : '';
            });

            $table->editColumn('acciones', function ($row) {
                return $row->acciones ? html_entity_decode(strip_tags($row->acciones), ENT_QUOTES, 'UTF-8') : 'n/a';
            });

            $table->editColumn('proceso', function ($row) {
                return $row->proceso ? $row->proceso->nombre : '';
            });

            $table->addColumn('responsable', function ($row) {
                return $row->responsable ? $row->responsable : '';
            });

            $table->addColumn('fechacompromiso', function ($row) {
                return $row->fechacompromiso ? $row->fechacompromiso : '';
            });

            $table->addColumn('inversion_requerida', function ($row) {
                return $row->inversion_requerida ? $row->inversion_requerida : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'control', 'responsable']);

            return $table->make(true);
        }

        $controles = DeclaracionAplicabilidad::getAll();
        $users = User::getAll();
        $teams = Team::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.tratamientoRiesgos.index', compact('controles', 'users', 'teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = DeclaracionAplicabilidad::with('control')->get();
        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::alta()->with('area')->get();

        return view('admin.tratamientoRiesgos.create', compact('controls', 'responsables', 'empleados'));
    }

    public function store(StoreTratamientoRiesgoRequest $request)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request);
        $tratamientoRiesgo = TratamientoRiesgo::create($request->all());
        // dd($tratamientoRiesgo);
        return redirect()->route('admin.tratamiento-riesgos.index')->with('success', 'Guardado con éxito');
    }

    public function vincularParticipantes($request, $planificacionControl)
    {
        $arrstrParticipantes = explode(',', $request->participantes);
        $participantes = array_map(function ($valor) {
            return intval($valor);
        }, $arrstrParticipantes);
        $planificacionControl->participantes()->sync($participantes);
    }

    public function edit($tratamientos)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientos = TratamientoRiesgo::find($tratamientos);
        $controls = DeclaracionAplicabilidad::with('control')->get();
        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::alta()->with('area')->get();
        $registros = Empleado::alta()->with('area')->get();
        $procesos = Proceso::getAll();

        return view('admin.tratamientoRiesgos.edit', compact('registros', 'procesos', 'tratamientos', 'controls', 'responsables', 'empleados'));
    }

    public function update(Request $request, $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'descripcionriesgo' => 'required|string',
            'acciones' => 'required|string',
            'id_dueno' => 'required',
            'id_registro' => 'required',
            'id_proceso' => 'required',
            'fechacompromiso' => 'required|date',
            'inversion_requerida' => 'required',
        ]);

        $tratamientoRiesgo = TratamientoRiesgo::find($tratamientoRiesgo);
        $tratamientoRiesgo->update([
            'descripcionriesgo' => $request->descripcionriesgo,
            'acciones' => $request->acciones,
            'id_dueno' => $request->id_dueno,
            'id_registro' => $request->id_registro,
            'id_proceso' => $request->id_proceso,
            'fechacompromiso' => $request->fechacompromiso,
            'inversion_requerida' => $request->inversion_requerida,
        ]);

        if ($tratamientoRiesgo->es_aprobado == 'pendiente') {
            $empleado_email = Empleado::select('name', 'email')->find($request->id_dueno);
            $empleado_copia = auth()->user()->empleado;
            Mail::to($empleado_email->email)->cc($tratamientoRiesgo->registro->email)->send(new SolicitudAceptacionTratamientoRiesgo($tratamientoRiesgo, $empleado_email));
        }

        if ($tratamientoRiesgo->es_aprobado == 'rechazado') {
            $tratamientoRiesgo->update([
                'es_aprobado' => 'pendiente',
                'comentarios' => null,
            ]);
            $empleado_email = Empleado::select('name', 'email')->find($request->id_dueno);
            $empleado_copia = auth()->user()->empleado;
            Mail::to($empleado_email->email)->cc($tratamientoRiesgo->registro->email)->send(new SolicitudAceptacionTratamientoRiesgo($tratamientoRiesgo, $empleado_email));
        }

        if ($request->participantes) {
            $this->vincularParticipantes($request, $tratamientoRiesgo);
        }

        return redirect()->route('admin.tratamiento-riesgos.index')->with('success', 'Editado con éxito');
    }

    public function show(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->load('control', 'responsable', 'team');
        // dd($tratamientoRiesgo);

        $route = 'storage/tratamiento/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $tratamientoRiesgo->id) . '/';

        return view('admin.tratamientoRiesgos.show', compact('route', 'tratamientoRiesgo'));
    }

    public function destroy(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyTratamientoRiesgoRequest $request)
    {
        TratamientoRiesgo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function guardarFirmaAprobacion(Request $request)
    {
        $tratamientoRiesgo = TratamientoRiesgo::find($request->id)->load('responsable', 'registro');
        $existsFolderFirmasCartas = Storage::exists('public/tratamiento/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $tratamientoRiesgo->id));
        if (!$existsFolderFirmasCartas) {
            Storage::makeDirectory('public/tratamiento/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $tratamientoRiesgo->id));
        }
        if (preg_match('/^data:image\/(\w+);base64,/', $request->firma)) {
            $value = substr($request->firma, strpos($request->firma, ',') + 1);
            $value = base64_decode($value);
            $new_name_image = $request->tipo . $tratamientoRiesgo->id . time() . '.png';
            $image = $new_name_image;
            $route = 'public/tratamiento/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $tratamientoRiesgo->id) . '/' . $new_name_image;
            Storage::put($route, $value);
            // dd($request->aprobado);

            if ($request->tipo == 'responsable_aprobador') {
                $tratamientoRiesgo->update([
                    'firma_' . $request->tipo => $image,

                ]);
            } else {
                $tratamientoRiesgo->update([
                    'firma_' . $request->tipo => $image,

                ]);
            }
        }

        if ($request->aprobado != null) {
            $tratamientoRiesgo->update([
                'es_aprobado' => $request->aprobado == '1' ? 'aprobado' : 'rechazado',
                'comentarios' => $request->comentarios,
            ]);
        }

        // dd($tratamientoRiesgo);
        Mail::to($tratamientoRiesgo->responsable->email)->send(new RiesgoAceptadoRechazado($tratamientoRiesgo));

        return response()->json(['success' => true]);
    }
}
