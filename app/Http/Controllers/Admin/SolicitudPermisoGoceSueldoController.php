<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\RespuestaPermisoGoceSueldo as MailRespuestaPermisoGoceSueldo;
use App\Mail\SolicitudPermisoGoceSueldo as MailSolicitudPermisoGoceSueldo;
use App\Models\Empleado;
use App\Models\ListaInformativa;
use App\Models\PermisosGoceSueldo;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SolicitudPermisoGoceSueldoController extends Controller
{
    use ObtenerOrganizacion;

    public $modelo = 'SolicitudPermisoGoceSueldo';

    public function index(Request $request)
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudPermisoGoceSueldo::with('empleado')->where('empleado_id', '=', $data)->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'no_permitido';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'solicitud-permiso-goce-sueldo';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('dias_solicitados', function ($row) {
                return $row->dias_solicitados ? $row->dias_solicitados : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? $row->fecha_inicio : '';
            });
            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->editColumn('aprobacion', function ($row) {
                return $row->aprobacion ? $row->aprobacion : '';
            });
            $table->editColumn('permiso', function ($row) {
                return $row->permiso ? $row->permiso : '';
            });
            $table->editColumn('tipo', function ($row) {
                return $row->permiso->tipo_permiso ? $row->permiso->tipo_permiso : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.solicitudGoceSueldo.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = new SolicitudPermisoGoceSueldo();
        $autoriza = User::getCurrentUser()->empleado->supervisor_id;
        $permisos = PermisosGoceSueldo::get();

        return view('admin.solicitudGoceSueldo.create', compact('vacacion', 'autoriza', 'permisos'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'permiso_id' => 'required|int',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $empleados = Empleado::getAll();

        $supervisor = $empleados->find($request->autoriza);
        $solicitante = $empleados->find($request->empleado_id);
        $solicitud = SolicitudPermisoGoceSueldo::create($request->all());

        $informados = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->where('modelo', '=', $this->modelo)->first();

        if (isset($informados->participantes[0]) || isset($informados->usuarios[0])) {

            if (isset($informados->participantes[0])) {
                foreach ($informados->participantes as $participante) {
                    $correos[] = $participante->empleado->email;
                }
            }

            if (isset($informados->usuarios[0])) {
                foreach ($informados->usuarios as $usuario) {
                    $correos[] = $usuario->usuario->email;
                }
            }
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudPermisoGoceSueldo($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudPermisoGoceSueldo($solicitante, $supervisor, $solicitud));
        }

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.solicitud-permiso-goce-sueldo.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacacion = SolicitudPermisoGoceSueldo::with(['empleado', 'permiso'])->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }

        return view('admin.solicitudGoceSueldo.show', compact('vacacion'));
    }

    public function edit(Request $request, $id)
    {
        // abort_if(Gate::denies('amenazas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $vacacion = SolicitudPermisoGoceSueldo::find($id);
        // if (empty($vacacion)) {
        //     Alert::warning('warning', 'Data not found');

        //     return redirect(route('admin.solicitud-goce-sueldo.index'));
        // }

        // return view('admin.solicitudGoceSueldo.edit', compact('vacacion'));
    }

    public function update(Request $request, $id)
    {
        $empleado = User::getCurrentUser()->empleado;

        if ($empleado->es_supervisor || Gate::allows('solicitud_permiso_goce_aprobar')) {

            $request->validate([
                'aprobacion' => 'required|int',
            ]);
            $solicitud = SolicitudPermisoGoceSueldo::find($id);
            $empleados = Empleado::getAll();

            $supervisor = $empleados->find($request->autoriza);
            $solicitante = $empleados->find($request->empleado_id);
            $solicitud->update($request->all());

            $informados = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->where('modelo', '=', $this->modelo)->first();

            if (isset($informados->participantes[0]) || isset($informados->usuarios[0])) {

                if (isset($informados->participantes[0])) {
                    foreach ($informados->participantes as $participante) {
                        $correos[] = $participante->empleado->email;
                    }
                }

                if (isset($informados->usuarios[0])) {
                    foreach ($informados->usuarios as $usuario) {
                        $correos[] = $usuario->usuario->email;
                    }
                }
                Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaPermisoGoceSueldo($solicitante, $supervisor, $solicitud, $correos));
            } else {
                Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaPermisoGoceSueldo($solicitante, $supervisor, $solicitud));
            }
            Alert::success('éxito', 'Información actualizada con éxito');

            return redirect(route('admin.solicitud-permiso-goce-sueldo.aprobacion'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = $request->id;
        $vacaciones = SolicitudPermisoGoceSueldo::find($id);
        $vacaciones->delete();
        Alert::success('éxito', 'Información eliminada con éxito');

        return response()->json(['status' => 200]);
    }

    public function aprobacion(Request $request)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudPermisoGoceSueldo::with('empleado')->where('autoriza', '=', $data)->where('aprobacion', '=', 1)->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('empleado', function ($row) {
                return $row->empleado ? $row->empleado : '';
            });
            $table->editColumn('permiso', function ($row) {
                return $row->permiso ? $row->permiso : '';
            });
            $table->editColumn('tipo', function ($row) {
                return $row->permiso->tipo_permiso ? $row->permiso->tipo_permiso : '';
            });
            $table->editColumn('dias_solicitados', function ($row) {
                return $row->dias_solicitados ? $row->dias_solicitados : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? $row->fecha_inicio : '';
            });
            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });
            $table->editColumn('aprobacion', function ($row) {
                return $row->aprobacion ? $row->aprobacion : '';
            });
            // $table->editColumn('descripcion', function ($row) {
            //     return $row->descripcion ? $row->descripcion : '';
            // });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.solicitudGoceSueldo.global-solicitudes', compact('logo_actual', 'empresa_actual'));
    }

    public function respuesta($id)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudPermisoGoceSueldo::with('empleado')->find($id);

        return view('admin.solicitudGoceSueldo.respuesta', compact('vacacion'));
    }

    public function archivo(Request $request)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudPermisoGoceSueldo::with('empleado')->where('autoriza', '=', $data)->where(function ($query) {
                $query->where('aprobacion', '=', 2)
                    ->orwhere('aprobacion', '=', 3);
            })->orderByDesc('id')->get();
            $table = datatables()::of($query);
            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'solicitud-permiso-goce-sueldo';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('empleado', function ($row) {
                return $row->empleado ? $row->empleado : '';
            });
            $table->editColumn('dias_solicitados', function ($row) {
                return $row->dias_solicitados ? $row->dias_solicitados : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? $row->fecha_inicio : '';
            });
            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });
            $table->editColumn('aprobacion', function ($row) {
                return $row->aprobacion ? $row->aprobacion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.solicitudGoceSueldo.archivo', compact('logo_actual', 'empresa_actual'));
    }

    public function showVistaGlobal($id)
    {
        abort_if(Gate::denies('reglas_goce_sueldo_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudPermisoGoceSueldo::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }

        return view('admin.solicitudGoceSueldo.vistaGlobal', compact('vacacion'));
    }

    public function showArchivo($id)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudPermisoGoceSueldo::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-permiso-goce-sueldo.index'));
        }

        return view('admin.solicitudGoceSueldo.archivoShow', compact('vacacion'));
    }
}
