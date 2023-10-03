<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\SolicitudMensajeria as MailMensajeria;
use App\Models\Empleado;
use App\Models\EnvioDocumentos;
use App\Models\EnvioDocumentosAjustes;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class EnvioDocumentosController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('solicitud_mensajeria_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = EnvioDocumentos::with(['coordinador', 'mensajero'])->where('id_solicita', '=', $data)->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'solicitud_mensajeria_ver';
                $editGate = 'solicitud_mensajeria_editar';
                $deleteGate = 'solicitud_mensajeria_eliminar';
                $crudRoutePart = 'envio-documentos';

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
            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? $row->fecha : '';
            });
            $table->editColumn('coordinador', function ($row) {
                return $row->coordinador ? $row->coordinador : '';
            });
            $table->editColumn('mensajero', function ($row) {
                return $row->mensajero ? $row->mensajero : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('notas', function ($row) {
                return $row->notas ? $row->notas : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.envio-documentos.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('solicitud_mensajeria_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $operadores = EnvioDocumentosAjustes::with(['coordinador', 'mensajero'])->first();
        $solicitud = new EnvioDocumentos();
        $solicita = User::getCurrentUser()->empleado->supervisor_id;
        $fecha_solicitud = Carbon::now();
        $fecha_solicitud = $fecha_solicitud->format('d-m-Y');
        // $permisos = PermisosGoceSueldo::get();

        return view('admin.envio-documentos.create', compact('solicitud', 'solicita', 'operadores', 'fecha_solicitud'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('solicitud_mensajeria_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($request->all());
        $request->validate([
            'destinatario' => 'required|string',
            'telefono' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_limite' => 'required|date',
        ]);
        $solicitud = EnvioDocumentos::create($request->all());
        $coordinador = Empleado::find($request->id_coordinador);
        $solicitante = Empleado::find($request->id_solicita);
        Mail::to(removeUnicodeCharacters($coordinador->email))->send(new MailMensajeria($solicitante, $coordinador, $solicitud));

        Flash::success('Solicitud creada satisfactoriamente.');

        return redirect()->route('admin.envio-documentos.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('solicitud_mensajeria_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $envio = EnvioDocumentos::with(['mensajero', 'coordinador', 'solicita'])->find($id);

        if (empty($envio)) {
            Flash::error('Solicitud no localizada');

            return redirect(route('admin.envio-documentos.index'));
        }

        return view('admin.envio-documentos.show', compact('envio'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('solicitud_mensajeria_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $solicitud = EnvioDocumentos::find($id);

        if (empty($solicitud)) {
            Flash::error('Amenaza not found');

            return redirect(route('admin.envio-documentos.index'));
        }

        $fecha_solicitud = $solicitud->fecha_solicitud;
        $operadores = EnvioDocumentosAjustes::with(['coordinador', 'mensajero'])->first();

        return view('admin.envio-documentos.edit', compact('solicitud', 'fecha_solicitud', 'operadores'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('solicitud_mensajeria_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $solicitud = EnvioDocumentos::find($id);

        if (empty($solicitud)) {
            Flash::error('Error al actualizar');

            return redirect(route('admin.envio-documentos.index'));
        }

        $solicitud->update($request->all());

        Flash::success('Solicitud actualizada correctamente.');

        return redirect(route('admin.envio-documentos.index'));
    }

    public function destroy(Request $request, $id)
    {
        abort_if(Gate::denies('solicitud_mensajeria_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $id = $request->id;
        $envio = EnvioDocumentos::find($id);

        $envio->delete();

        return redirect(route('admin.envio-documentos.index'));
    }

    public function ajustes()
    {
        abort_if(Gate::denies('solicitud_mensajeria_ajustes'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = 1;
        $ajustes = EnvioDocumentosAjustes::find($id);
        if (empty($ajustes)) {
            Flash::error('Ajustes no encontrados');

            return redirect(route('admin.Ausencias.index'));
        }
        $empleados = Empleado::getAll();
        // dd($ajustes);

        return view('admin.envio-documentos.ajustesEdit', compact('ajustes', 'empleados'));
    }

    public function ajustesUpdate(Request $request, $id)
    {
        abort_if(Gate::denies('solicitud_mensajeria_ajustes'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ajustes = EnvioDocumentosAjustes::find($id);
        $ajustes->update($request->all());
        Flash::success('Ajustes aplicados satisfactoriamente.');

        return redirect()->route('admin.Ausencias.index');
    }

    public function atencion(Request $request)
    {
        abort_if(Gate::denies('solicitud_mensajeria_atencion'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = EnvioDocumentos::with(['coordinador', 'mensajero'])->where('id_coordinador', '=', $data)->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'no_permitido';
                $editGate = 'amenazas_editar';
                $deleteGate = 'no_permitido';
                $crudRoutePart = 'envio-documentos';

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
            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? $row->fecha : '';
            });
            $table->editColumn('solicita', function ($row) {
                return $row->solicita ? $row->solicita : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('notas', function ($row) {
                return $row->notas ? $row->notas : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.envio-documentos.atencion', compact('logo_actual', 'empresa_actual'));
    }

    public function seguimiento($id)
    {
        abort_if(Gate::denies('solicitud_mensajeria_atencion'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $solicitud = EnvioDocumentos::find($id);

        if (empty($solicitud)) {
            Flash::error('Amenaza not found');

            return redirect(route('admin.envio-documentos.index'));
        }

        $fecha_solicitud = $solicitud->fecha_solicitud;
        $operadores = EnvioDocumentosAjustes::with(['coordinador', 'mensajero'])->first();

        return view('admin.envio-documentos.seguimiento', compact('solicitud', 'fecha_solicitud', 'operadores'));
    }

    public function seguimientoUpdate(Request $request, $id)
    {
        abort_if(Gate::denies('solicitud_mensajeria_atencion'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $solicitud = EnvioDocumentos::find($id);

        if (empty($solicitud)) {
            Flash::error('Error al actualizar');

            return redirect(route('admin.envio-documentos.index'));
        }

        $solicitud->update($request->all());

        Flash::success('Solicitud actualizada correctamente.');

        return redirect(route('admin.envio-documentos.atencion'));
    }
}
