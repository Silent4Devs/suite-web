<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanificacionControlRequest;
use App\Mail\PlanificacionAceptadaRechazada;
use App\Mail\PlanificacionSolicitudResponsableAprobador;
use App\Mail\SolicitudFirmasControlCambios;
use App\Models\Empleado;
use App\Models\PlanificacionControl;
use App\Models\PlanificacionControlOrigenCambio;
use App\Models\Team;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlanificacionControlController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('planificacion_y_control_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PlanificacionControl::with(['team'])->select(sprintf('%s.*', (new PlanificacionControl)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'planificacion_y_control_ver';
                $editGate = 'planificacion_y_control_editar';
                $deleteGate = 'planificacion_y_control_eliminar';
                $crudRoutePart = 'planificacion-controls';

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
            $table->editColumn('folio_cambio', function ($row) {
                return $row->folio_cambio ? $row->folio_cambio : '';
            });
            $table->editColumn('fecha_registro', function ($row) {
                return $row->fecha_registro ? Carbon::parse($row->fecha_registro)->format('d-m-Y') : '';
            });
            $table->addColumn('reporta', function ($row) {
                return $row->empleado ? $row->empleado : '';
            });
            $table->editColumn('objetivo', function ($row) {
                return $row->objetivo ? html_entity_decode(strip_tags($row->objetivo), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->editColumn('origen', function ($row) {
                return $row->origen ? $row->origen->nombre : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? html_entity_decode(strip_tags($row->descripcion), ENT_QUOTES, 'UTF-8') : 'n/a';
            });
            $table->addColumn('responsable', function ($row) {
                return $row->responsable ? $row->responsable : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? Carbon::parse($row->fecha_inicio)->format('d-m-Y') : '';
            });
            $table->editColumn('fecha_termino', function ($row) {
                return $row->fecha_termino ? Carbon::parse($row->fecha_termino)->format('d-m-Y') : '';
            });
            $table->editColumn('criterios', function ($row) {
                return $row->criterios_aceptacion ? html_entity_decode(strip_tags($row->criterios_aceptacion), ENT_QUOTES, 'UTF-8') : 'n/a';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.planificacionControls.index', compact('users', 'teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('planificacion_y_control_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $duenos = User::getAll()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $alta = Empleado::getAltaEmpleadosWithArea();

        $empleados = $alta;

        $responsables = $alta;

        $aprobadores = $alta;

        $origen_seleccionado = null;

        $origenCambio = PlanificacionControlOrigenCambio::get();

        $esta_vinculado = User::getCurrentUser()->empleado ? true : false;

        return view('admin.planificacionControls.create', compact('aprobadores', 'esta_vinculado', 'origenCambio', 'origen_seleccionado', 'responsables', 'duenos', 'empleados'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('planificacion_y_control_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'folio_cambio' => 'required|numeric',
            'fecha_registro' => 'required|date',
            'id_reviso' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date',
            'origen_id' => 'required',
            'objetivo' => 'required|string',
            'id_responsable' => 'required',
            'id_responsable_aprobar' => 'required',
            'descripcion' => 'nullable|string',
            'criterios_aceptacion' => 'nullable|string',
        ]);

        $planificacionControl = PlanificacionControl::create([
            'folio_cambio' => $request->folio_cambio,
            'fecha_registro' => $request->fecha_registro,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
            'objetivo' => $request->objetivo,
            'criterios_aceptacion' => $request->criterios_aceptacion,
            'id_reviso' => $request->id_reviso,
            'id_responsable' => $request->id_responsable,
            'descripcion' => $request->descripcion,
            'origen_id' => $request->origen_id,
            'descripcion' => $request->descripcion,
            'id_responsable_aprobar' => $request->id_responsable_aprobar,
        ]);

        Mail::to(removeUnicodeCharacters($planificacionControl->empleado->email)->queue(new SolicitudFirmasControlCambios($planificacionControl)));

        // dd($request->all());
        // $planificacionControl = PlanificacionControl::create($request->all());

        // Almacenamiento de participantes relacionados
        if ($request->participantes) {
            $this->vincularParticipantes($request, $planificacionControl);
        }

        return redirect()->route('admin.planificacion-controls.index')->with('success', 'Guardado con éxito');
    }

    public function vincularParticipantes($request, $planificacionControl)
    {
        $arrstrParticipantes = explode(',', $request->participantes);
        $participantes = array_map(function ($valor) {
            return intval($valor);
        }, $arrstrParticipantes);
        $planificacionControl->participantes()->sync($participantes);
    }

    public function edit(PlanificacionControl $planificacionControl)
    {
        abort_if(Gate::denies('planificacion_y_control_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $duenos = User::getAll()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $alta = Empleado::getAltaEmpleadosWithArea();
        $empleados = $alta;

        $planificacionControl->load('team');

        $responsables = $alta;

        $aprobadores = $alta;

        $origen_seleccionado = $planificacionControl->origen_id;

        return view('admin.planificacionControls.edit', compact('aprobadores', 'origen_seleccionado', 'responsables', 'duenos', 'planificacionControl', 'empleados'));
    }

    public function update(Request $request, PlanificacionControl $planificacionControl)
    {
        abort_if(Gate::denies('planificacion_y_control_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $planificacionControl->update($request->all());

        $request->validate([
            'folio_cambio' => 'required|numeric',
            'fecha_registro' => 'required|date',
            'id_reviso' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date',
            'origen_id' => 'required',
            'objetivo' => 'required|string',
            'id_responsable' => 'required',
            'id_responsable_aprobar' => 'required',
            'descripcion' => 'nullable|string',
            'criterios_aceptacion' => 'nullable|string',
        ]);

        $planificacionControl->update([
            'folio_cambio' => $request->folio_cambio,
            'fecha_registro' => $request->fecha_registro,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
            'objetivo' => $request->objetivo,
            'criterios_aceptacion' => $request->criterios_aceptacion,
            'id_reviso' => $request->id_reviso,
            'id_responsable' => $request->id_responsable,
            'descripcion' => $request->descripcion,
            'origen_id' => $request->origen_id,
            'descripcion' => $request->descripcion,
            'id_responsable_aprobar' => $request->id_responsable_aprobar,
            'es_aprobado' => 'pendiente',
            'comentarios' => null,
        ]);

        // dd($planificacionControl);

        if ($planificacionControl->es_aprobado == 'pendiente') {
            Mail::to(removeUnicodeCharacters($planificacionControl->responsableAprobar->email))->cc([removeUnicodeCharacters($planificacionControl->empleado->email), removeUnicodeCharacters($planificacionControl->responsable->email)])->queue(new PlanificacionSolicitudResponsableAprobador($planificacionControl));
        }

        if ($request->participantes) {
            $this->vincularParticipantes($request, $planificacionControl);
        }

        // dd($request->all());

        return redirect()->route('admin.planificacion-controls.index')->with('success', 'Editado con éxito');
    }

    public function show(PlanificacionControl $planificacionControl)
    {
        abort_if(Gate::denies('planificacion_y_control_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planificacionControl->load('empleado', 'responsable', 'origen', 'team', 'participantes');
        // dd( $planificacionControl);
        $route = 'storage/planificacion/firmas/'.preg_replace(['/\s+/i', '/-/i'], '_', $planificacionControl->id).'/';

        return view('admin.planificacionControls.show', compact('route', 'planificacionControl'));
    }

    public function destroy(PlanificacionControl $planificacionControl)
    {
        abort_if(Gate::denies('planificacion_y_control_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planificacionControl->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyPlanificacionControlRequest $request)
    {
        PlanificacionControl::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function planesPlanificacionControl(Request $request)
    {
        $planificacionControl = PlanificacionControl::find($request->id);
        // $accionCorrectiva->planes()->detach();
        $planificacionControl->planes()->sync($request->planes);

        return response()->json(['success' => true]);
    }

    public function guardarFirmaAprobacion(Request $request)
    {
        // dd($request->all());
        $planificacionControl = PlanificacionControl::find($request->id)->load('responsableAprobar');
        $existsFolderFirmasCartas = Storage::exists('public/planificacion/firmas/'.preg_replace(['/\s+/i', '/-/i'], '_', $planificacionControl->id));
        if (! $existsFolderFirmasCartas) {
            Storage::makeDirectory('public/planificacion/firmas/'.preg_replace(['/\s+/i', '/-/i'], '_', $planificacionControl->id));
        }
        if (preg_match('/^data:image\/(\w+);base64,/', $request->firma)) {
            $value = substr($request->firma, strpos($request->firma, ',') + 1);
            $value = base64_decode($value);
            $new_name_image = $request->tipo.$planificacionControl->id.time().'.png';
            $image = $new_name_image;
            $route = 'public/planificacion/firmas/'.preg_replace(['/\s+/i', '/-/i'], '_', $planificacionControl->id).'/'.$new_name_image;
            Storage::put($route, $value);
            // dd($request->aprobado);

            if ($request->tipo == 'responsable_aprobador') {
                $planificacionControl->update([
                    'firma_'.$request->tipo => $image,

                ]);
            } else {
                $planificacionControl->update([
                    'firma_'.$request->tipo => $image,

                ]);
            }

            if ($planificacionControl->firma_registro) {
                Mail::to(removeUnicodeCharacters($planificacionControl->responsable->email))->cc(removeUnicodeCharacters($planificacionControl->empleado->email))->queue(new SolicitudFirmasControlCambios($planificacionControl));
            }

            if ($planificacionControl->firma_registro && $planificacionControl->firma_responsable) {
                Mail::to(removeUnicodeCharacters($planificacionControl->responsableAprobar->email))->cc([removeUnicodeCharacters($planificacionControl->empleado->email), removeUnicodeCharacters($planificacionControl->responsable->email)])->queue(new PlanificacionSolicitudResponsableAprobador($planificacionControl));
            }
        }
        // dd($request->aprobado);
        if ($request->aprobado != null) {
            $planificacionControl->update([
                'es_aprobado' => $request->aprobado == '1' ? 'aprobado' : 'rechazado',
                'comentarios' => $request->comentarios,
            ]);
            Mail::to(removeUnicodeCharacters($planificacionControl->empleado->email))->cc([removeUnicodeCharacters($planificacionControl->responsableAprobar->email), removeUnicodeCharacters($planificacionControl->responsable->email)])->queue(new PlanificacionAceptadaRechazada($planificacionControl));
        }

        return response()->json(['success' => true]);
    }
}
