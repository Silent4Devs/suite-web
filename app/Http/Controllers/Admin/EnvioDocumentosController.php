<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\EnvioDocumentos;
use App\Models\EnvioDocumentosAjustes;
use App\Models\Organizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class EnvioDocumentosController extends Controller
{
  
    public function index(Request $request)
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = auth()->user()->empleado->id;

        if ($request->ajax()) {
            $query = EnvioDocumentos::with(['coordinador','mensajero'])->where('id_solicita', '=', $data)->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;
        return view('admin.envio-documentos.index', compact('logo_actual', 'empresa_actual'));
    }

  
    public function create()
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $operadores = EnvioDocumentosAjustes::with(['coordinador','mensajero'])->first();
        $solicitud = new EnvioDocumentos();
        $solicita = auth()->user()->empleado->supervisor_id;
        $fecha_solicitud = Carbon::now();
        $fecha_solicitud = $fecha_solicitud->format('d-m-Y');
        // $permisos = PermisosGoceSueldo::get();

        return view('admin.envio-documentos.create', compact('solicitud','solicita','operadores','fecha_solicitud'));
    }

 
    public function store(Request $request)
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($request->all());
        $request->validate([
            'destinatario' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'fecha_limite' => 'required|date',
        ]);
        $solicitud = EnvioDocumentos::create($request->all());
        // Mail::to($supervisor->email)->send(new MailSolicitudPermisoGoceSueldo($solicitante, $supervisor, $solicitud));

        Flash::success('Solicitud creada satisfactoriamente.');
        return redirect()->route('admin.envio-documentos.index');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy(Request $request)
    {
        abort_if(Gate::denies('solicitud_goce_sueldo_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = $request->id;
        $envio = EnvioDocumentos::find($id);
        $envio->delete();
        return response()->json(['status' => 200]);
        // Flash::success('Solicitud de envió eliminada satisfactoriamente');

        // return redirect()->route('admin.envio-documentos.index');

    }

    public function ajustes()
    {
        abort_if(Gate::denies('matriz_bia_matriz_ajustes'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = 1;
        $ajustes =EnvioDocumentosAjustes::find($id);
        if (empty($ajustes)) {
            Flash::error('Ajustes no encontrados');
            return redirect(route('admin.Ausencias.index'));
        }
        $empleados = Empleado::get();
        // dd($ajustes);
      
        return view('admin.envio-documentos.edit',compact('ajustes','empleados'));
    }

    public function ajustesUpdate(Request $request, $id)
    {
        $ajustes = EnvioDocumentosAjustes::find($id);
        $ajustes->update($request->all());
        Flash::success('Ajustes aplicados satisfactoriamente.');

        return redirect()->route('admin.Ausencias.index');
    }
}
