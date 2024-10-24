<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AceptacionAccionCorrectivaEmail;
use App\Mail\AtencionQuejaAtendidaEmail;
use App\Mail\CierreQuejaAceptadaEmail;
use App\Mail\NotificacionResponsableQuejaEmail;
use App\Mail\ResolucionQuejaRechazadaEmail;
use App\Mail\SeguimientoQuejaClienteEmail;
use App\Mail\SolicitarCierreQuejaEmail;
use App\Models\AccionCorrectiva;
use App\Models\Activo;
use App\Models\AnalisisQuejasClientes;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\EvidenciaQuejasClientes;
use App\Models\EvidenciasQuejasClientesCerrado;
use App\Models\Proceso;
use App\Models\QuejasCliente;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Services\SentimentService;

class QuejasClienteController extends Controller
{
    public function quejasClientes()
    {
        abort_if(Gate::denies('centro_atencion_quejas_clientes_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $clientes = TimesheetCliente::getAll();

        $proyectos = TimesheetProyecto::getAll();

        return view('admin.desk.clientes.quejasclientes', compact('areas', 'procesos', 'empleados', 'activos', 'clientes', 'proyectos'));
    }

    public function indexQuejasClientes()
    {
        abort_if(Gate::denies('centro_atencion_quejas_clientes_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejasClientes = QuejasCliente::select('id', 'cliente_id', 'nombre', 'puesto', 'telefono', 'fecha_cierre', 'estatus', 'fecha', 'titulo', 'accion_correctiva_id')->where('archivado', false)->get();

        return datatables()->of($quejasClientes)->toJson();
    }

    public function storeQuejasClientes(Request $request)
    {
        abort_if(Gate::denies('centro_atencion_quejas_clientes_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'cliente_id' => 'required',
            'proyectos_id' => 'required',
            'nombre' => 'required',
            'titulo' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            'area_quejado' => 'required',
            'solucion_requerida_cliente' => 'required',
            'correo_cliente' => 'required',
            'correo' => 'required',
            'canal' => 'required',
        ]);

        $correo_cliente = intval($request->correo_cliente) == 1 ? true : false;
        // if ($correo_cliente) {
        //     $request->validate([
        //         'correo' => 'required',
        //     ]);
        // }

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

        $quejasClientes = QuejasCliente::create([
            'cliente_id' => $request->cliente_id,
            'proyectos_id' => $request->proyectos_id,
            'nombre' => $request->nombre,
            'puesto' => $request->puesto,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'area_quejado' => $request->area_quejado,
            'colaborador_quejado' => $request->colaborador_quejado,
            'proceso_quejado' => $request->proceso_quejado,
            'otro_quejado' => $request->otro_quejado,
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'estatus' => 'Sin atender',
            'comentarios' => $request->comentarios,
            'canal' => $request->canal,
            'otro_canal' => $request->otro_canal,
            'solucion_requerida_cliente' => $request->solucion_requerida_cliente,
            'empleado_reporto_id' => User::getCurrentUser()->empleado->id,
            'correo_cliente' => $correo_cliente,
            'sentimientos' => $sentimientos,
        ]);

        AnalisisQuejasClientes::create([
            'quejas_clientes_id' => $quejasClientes->id,
            'formulario' => 'quejaCliente',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Queja_file_'.$quejasClientes->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_quejas_clientes';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciaQuejasClientes::create([
                    'evidencia' => $image,
                    'quejas_clientes_id' => $quejasClientes->id,
                ]);
            }
        }

        if ($correo_cliente) {
            Mail::to(removeUnicodeCharacters($quejasClientes->correo))->cc(removeUnicodeCharacters($quejasClientes->registro->email))->queue(new SeguimientoQuejaClienteEmail($quejasClientes));
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function editQuejasClientes(Request $request, $id_quejas)
    {
        abort_if(Gate::denies('centro_atencion_quejas_cliente_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejasClientes = QuejasCliente::findOrfail(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos');

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $analisis = AnalisisQuejasClientes::where('formulario', '=', 'quejaCliente')->where('quejas_clientes_id', intval($id_quejas))->first();

        $areas = Area::getAll();

        $empleados = Empleado::orderBy('name')->get();

        $clientes = TimesheetCliente::getAll();

        $proyectos = TimesheetProyecto::getAll();

        $cierre = EvidenciasQuejasClientesCerrado::where('quejas_clientes_id', '=', $quejasClientes->id)->get();

        $evidenciaCreate = EvidenciaQuejasClientes::where('quejas_clientes_id', '=', $quejasClientes->id)->get();

        return view('admin.desk.clientes.edit', compact('id_quejas', 'evidenciaCreate', 'cierre', 'clientes', 'proyectos', 'quejasClientes', 'procesos', 'empleados', 'areas', 'activos', 'analisis'));
    }

    public function updateQuejasClientes(Request $request, $id_quejas)
    {
        abort_if(Gate::denies('centro_atencion_quejas_cliente_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queja_procedente = intval($request->queja_procedente) == 1 ? true : false;
        if ($queja_procedente) {
            $request->validate([
                'urgencia' => 'required',
                'impacto' => 'required',
            ]);
        }

        $quejasClientes = QuejasCliente::findOrfail(intval($id_quejas));
        $queja_procedente = intval($request->queja_procedente ? $request->queja_procedente : $quejasClientes->queja_procedente) == 1 ? true : false;
        $realizar_accion = intval($request->realizar_accion ? $request->realizar_accion : $quejasClientes->realizar_accion) == 1 ? true : false;
        $desea_levantar_ac = intval($request->desea_levantar_ac ? $request->desea_levantar_ac : $quejasClientes->desea_levantar_ac) == 1 ? true : false;
        $notificar_responsable = intval($request->notificar_responsable ? $request->notificar_responsable : $quejasClientes->notificar_responsable) == 1 ? true : false;
        $notificar_registro_queja = intval($request->notificar_registro_queja ? $request->notificar_registro_queja : $quejasClientes->notificar_registro_queja) == 1 ? true : false;
        $cumplio_ac_responsable = intval($request->cumplio_ac_responsable ? $request->cumplio_ac_responsable : $quejasClientes->cumplio_ac_responsable) == 1 ? true : false;
        $conforme_solucion = intval($request->conforme_solucion ? $request->conforme_solucion : $quejasClientes->conforme_solucion) == 1 ? true : false;
        $cumplio_fecha = intval($request->cumplio_fecha ? $request->cumplio_fecha : $quejasClientes->cumplio_fecha) == 1 ? true : false;
        $cerrar_ticket = intval($request->cerrar_ticket ? $request->cerrar_ticket : $quejasClientes->cerrar_ticket) == 1 ? true : false;
        $email_realizara_accion_inmediata = intval($request->email_realizara_accion_inmediata ? $request->email_realizara_accion_inmediata : $quejasClientes->email_realizara_accion_inmediata) == 1 ? true : false;
        //if ($desea_levantar_ac) {
        //     $request->validate([
        //        'responsable_sgi_id' => 'required',
        //    ]);
        //}
        $notificar_atencion_queja_no_aprobada = intval($request->notificar_atencion_queja_no_aprobada) == 1 ? true : false;

        $quejasClientes->update([
            'cliente_id' => $request->cliente_id ? $request->cliente_id : $quejasClientes->cliente_id,
            'proyectos_id' => $request->proyectos_id ? $request->proyectos_id : $quejasClientes->proyectos_id,
            'nombre' => $request->nombre ? $request->nombre : $quejasClientes->nombre,
            'puesto' => $request->puesto ? $request->puesto : $quejasClientes->puesto,
            'telefono' => $request->telefono ? $request->telefono : $quejasClientes->telefono,
            'correo' => $request->correo ? $request->correo : $quejasClientes->correo,
            'area_quejado' => $request->area_quejado ? $request->area_quejado : $quejasClientes->area_quejado,
            'colaborador_quejado' => $request->colaborador_quejado ? $request->colaborador_quejado : $quejasClientes->colaborador_quejado,
            'proceso_quejado' => $request->proceso_quejado ? $request->proceso_quejado : $quejasClientes->proceso_quejado,
            'otro_quejado' => $request->otro_quejado ? $request->otro_quejado : $quejasClientes->otro_quejado,
            'titulo' => $request->titulo ? $request->titulo : $quejasClientes->titulo,
            'fecha_cierre' => $request->fecha_cierre ? $request->fecha_cierre : $quejasClientes->fecha_cierre,
            'ubicacion' => $request->ubicacion ? $request->ubicacion : $quejasClientes->ubicacion,
            'descripcion' => $request->descripcion ? $request->descripcion : $quejasClientes->descripcion,
            'estatus' => 'En curso' ? 'En curso' : $quejasClientes->estatus,
            'comentarios' => $request->comentarios ? $request->comentarios : $quejasClientes->comentarios,
            'canal' => $request->canal ? $request->canal : $quejasClientes->canal,
            'otro_canal' => $request->otro_canal ? $request->otro_canal : $quejasClientes->otro_canal,
            'solucion_requerida_cliente' => $request->solucion_requerida_cliente ? $request->solucion_requerida_cliente : $quejasClientes->solucion_requerida_cliente,
            'urgencia' => $request->urgencia ? $request->urgencia : $quejasClientes->urgencia,
            'impacto' => $request->impacto ? $request->impacto : $quejasClientes->impacto,
            'prioridad' => $request->prioridad ? $request->prioridad : $quejasClientes->prioridad,
            'categoria_queja' => $request->categoria_queja ? $request->categoria_queja : $quejasClientes->categoria_queja,
            'otro_categoria' => $request->otro_categoria ? $request->otro_categoria : $quejasClientes->otro_categoria,
            'queja_procedente' => $queja_procedente,
            'porque_procedente' => $request->porque_procedente ? $request->porque_procedente : $quejasClientes->porque_procedente,
            'realizar_accion' => $realizar_accion,
            'cual_accion' => $request->cual_accion ? $request->cual_accion : $quejasClientes->cual_accion,
            'desea_levantar_ac' => $desea_levantar_ac,
            'acciones_tomara_responsable' => $request->acciones_tomara_responsable ? $request->acciones_tomara_responsable : $quejasClientes->acciones_tomara_responsable,
            'fecha_limite' => $request->fecha_limite ? $request->fecha_limite : $quejasClientes->fecha_limite,
            'comentarios_atencion' => $request->comentarios_atencion ? $request->comentarios_atencion : $quejasClientes->comentarios_atencion,
            'responsable_sgi_id' => $request->responsable_sgi_id ? $request->responsable_sgi_id : $quejasClientes->responsable_sgi_id,
            'responsable_atencion_queja_id' => $request->responsable_atencion_queja_id ? $request->responsable_atencion_queja_id : $quejasClientes->responsable_atencion_queja_id,
            'porque_procedente' => $request->porque_procedente ? $request->porque_procedente : $quejasClientes->porque_procedente,
            'cumplio_ac_responsable' => $cumplio_ac_responsable,
            'porque_no_cumplio_responsable' => $request->porque_no_cumplio_responsable ? $request->porque_no_cumplio_responsable : $quejasClientes->porque_no_cumplio_responsable,
            'conforme_solucion' => $conforme_solucion,
            'cerrar_ticket' => $cerrar_ticket,
            'cumplio_fecha' => $cumplio_fecha,
            'notificar_responsable' => $notificar_responsable,
            'notificar_registro_queja' => $notificar_registro_queja,
            'porque_no_cierre_ticket' => $request->porque_no_cierre_ticket ? $request->porque_no_cierre_ticket : $quejasClientes->porque_no_cierre_ticket,
            'notificar_atencion_queja_no_aprobada' => $notificar_atencion_queja_no_aprobada,
        ]);

        $documento = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_documento = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_documento = 'Queja_file_'.$quejasClientes->id.'_'.$name_documento.'.'.$extension;

                $route = 'public/evidencias_quejas_clientes';

                $documento = $new_name_documento;

                $file->storeAs($route, $documento);

                EvidenciaQuejasClientes::create([
                    'evidencia' => $documento,
                    'quejas_clientes_id' => $quejasClientes->id,
                ]);
            }
        }

        $image = null;

        if ($request->file('cierre') != null or ! empty($request->file('cierre'))) {
            foreach ($request->file('cierre') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Queja_file_'.$quejasClientes->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_quejas_clientes_cerrado';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasQuejasClientesCerrado::create([
                    'cierre' => $image,
                    'quejas_clientes_id' => $quejasClientes->id,
                ]);
            }
        }

        if ($queja_procedente == false) {
            $quejasClientes->update([
                'estatus' => 'No procedente',
            ]);
        }

        if ($cerrar_ticket) {
            $quejasClientes->update([
                'estatus' => 'Cerrado',
                'fecha_cierre' => now(),
            ]);
        }

        if ($notificar_atencion_queja_no_aprobada) {
            if ($cerrar_ticket == false) {
                if (! $quejasClientes->email_env_resolucion_rechazada) {
                    if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                        $quejasClientes->update([
                            'email_env_resolucion_rechazada' => true,
                        ]);
                        Mail::to(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->cc(removeUnicodeCharacters($quejasClientes->registro->email))->queue(new ResolucionQuejaRechazadaEmail($quejasClientes));
                    }
                }
            }
        }

        if ($notificar_atencion_queja_no_aprobada) {
            if ($cerrar_ticket) {
                if (! $quejasClientes->email_env_resolucion_aprobada) {
                    if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                        $quejasClientes->update([
                            'email_env_resolucion_aprobada' => true,
                        ]);
                        Mail::to(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->cc(removeUnicodeCharacters($quejasClientes->registro->email))->queue(new CierreQuejaAceptadaEmail($quejasClientes));
                    }
                }
            }
        }

        if (! $email_realizara_accion_inmediata) {
            if (! is_null($quejasClientes->acciones_tomara_responsable)) {
                if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                    $quejasClientes->update([
                        'email_realizara_accion_inmediata' => true,
                    ]);
                    Mail::to(removeUnicodeCharacters($quejasClientes->registro->email))->cc(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->queue(new AtencionQuejaAtendidaEmail($quejasClientes));
                }
            }
        }

        if ($notificar_registro_queja) {
            if (! $quejasClientes->correo_enviado_registro) {
                if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                    $quejasClientes->update([
                        'correo_enviado_registro' => true,
                    ]);
                    Mail::to(removeUnicodeCharacters($quejasClientes->registro->email))->cc(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->queue(new NotificacionResponsableQuejaEmail($quejasClientes, $quejasClientes->responsableAtencion));
                }
            }
        }

        if ($desea_levantar_ac) {
            $quejasClientes->load('cliente', 'proyectos', 'responsableAtencion', 'responsableSgi', 'registro');
            $evidenciaArr = [];
            $evidencias = EvidenciaQuejasClientes::where('quejas_clientes_id', '=', $quejasClientes->id)->get();
            foreach ($evidencias as $evidencia) {
                array_push($evidenciaArr, $evidencia->evidencia);
            }
            $existeAC = AccionCorrectiva::whereHas('deskQuejaCliente', function ($query) use ($quejasClientes) {
                $query->where('acciones_correctivas_aprobacionables_id', $quejasClientes->id);
            })->exists();

            if (! $existeAC) {
                $accion_correctiva = AccionCorrectiva::create([
                    'tema' => $request->titulo,
                    'causaorigen' => 'Queja de un cliente',
                    'descripcion' => $request->descripcion,
                    'estatus' => 'nuevo',
                    'fecharegistro' => Carbon::now(),
                    'areas' => $request->area_quejado,
                    'procesos' => $request->proceso_quejado,
                    'es_externo' => true,
                    'otro_categoria' => $request->otro_categoria,
                    'id_registro' => $request->responsable_sgi_id,
                    'estatus' => 'Sin atender',
                    'aprobada' => false,
                    'aprobacion_contestada' => false,
                    'id_reporto' => $request->empleado_reporto_id,
                    'otros' => $request->otro_quejado,
                    'colaborador_quejado' => $request->colaborador_quejado,

                ]);
                $quejasClientes->update([
                    'accion_correctiva_id' => $accion_correctiva->id,

                ]);
                $quejasClientes->accionCorrectivaAprobacional()->sync($accion_correctiva->id);
            }

            if (! $quejasClientes->correoEnviado) {
                $quejasClientes->update([
                    'correoEnviado' => true,
                ]);
                Mail::to(removeUnicodeCharacters($quejasClientes->responsableSgi->email))->cc(removeUnicodeCharacters($quejasClientes->registro->email))->queue(new AceptacionAccionCorrectivaEmail($quejasClientes, $evidenciaArr));
            }
        }
        if ($request->ajax()) {
            return response()->json(['estatus' => 200]);
        }

        // return redirect()->route('admin.desk.quejas-edit', $id_quejas)->with('success', 'Reporte actualizado');
        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function correoResponsableQuejaCliente(Request $request)
    {
        $id_quejas = $request->id;
        $quejasClientes = QuejasCliente::find(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos', 'responsableAtencion');

        $quejasClientes->update([
            'responsable_atencion_queja_id' => $request->responsable_atencion_queja_id,
        ]);

        $empleado_email = Empleado::select('name', 'email')->find($request->responsable_atencion_queja_id);
        $empleado_copia = User::getCurrentUser()->empleado;

        if ($quejasClientes->registro != null && $request->responsable_atencion_queja_id != null) {
            Mail::to(removeUnicodeCharacters($empleado_email->email))->cc(removeUnicodeCharacters($empleado_copia->email))->queue(new NotificacionResponsableQuejaEmail($quejasClientes, $empleado_email));
        }

        return response()->json(['success' => true, 'request' => $request->all(), 'message' => 'Enviado con éxito']);
    }

    public function correoSolicitarCierreQuejaCliente(Request $request)
    {
        $id_quejas = $request->id;
        $quejasClientes = QuejasCliente::find(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos', 'responsableAtencion');

        Mail::to(removeUnicodeCharacters($quejasClientes->registro->email))->cc(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->queue(new SolicitarCierreQuejaEmail($quejasClientes));

        return response()->json(['success' => true, 'request' => $request->all(), 'message' => 'Enviado con éxito']);
    }

    public function updateAnalisisQuejasClientes(Request $request, $id_quejas)
    {
        $analisis_quejasClientes = AnalisisQuejasClientes::findOrfail(intval($id_quejas));
        $analisis_quejasClientes->update([
            'problema_diagrama' => $request->problema_diagrama,
            'problema_porque' => $request->problema_porque,
            'causa_ideas' => $request->causa_ideas,
            'causa_porque' => $request->causa_porque,
            'ideas' => $request->ideas,
            'porque_1' => $request->porque_1,
            'porque_2' => $request->porque_2,
            'porque_3' => $request->porque_3,
            'porque_4' => $request->porque_4,
            'porque_5' => $request->porque_5,
            'control_a' => $request->control_a,
            'control_b' => $request->control_b,
            'proceso_a' => $request->proceso_a,
            'proceso_b' => $request->proceso_b,
            'personas_a' => $request->personas_a,
            'personas_b' => $request->personas_b,
            'tecnologia_a' => $request->tecnologia_a,
            'tecnologia_b' => $request->tecnologia_b,
            'metodos_a' => $request->metodos_a,
            'metodos_b' => $request->metodos_b,
            'ambiente_a' => $request->ambiente_a,
            'ambiente_b' => $request->ambiente_b,
            'fecha_cierre' => $request->fecha_cierre,
        ]);

        return redirect()->route('admin.desk.index', $analisis_quejasClientes->quejas_id)->with('success', 'Reporte actualizado');
    }

    public function planesQuejasClientes(Request $request)
    {
        $quejasClientes = QuejasCliente::find($request->id);
        // $quejasClientes->planes()->detach();
        $quejasClientes->planes()->sync($request->planes);

        return response()->json(['success' => true]);
    }

    public function archivoQuejaClientes()
    {
        $quejas = QuejasCliente::getAll()->where('archivado', true);

        return view('admin.desk.clientes.archivo', compact('quejas'));
    }

    public function archivadoQuejaClientes(Request $request, $id)
    {

        if ($request->ajax()) {
            $queja = QuejasCliente::findOrfail(intval($id));
            $queja->update([
                'archivado' => true,
            ]);

            \Artisan::call('cache:clear');

            return response()->json(['success' => true]);
        }
    }

    public function recuperarArchivadoQuejaCliente($id)
    {
        $queja = QuejasCliente::find($id);

        $queja->update([
            'archivado' => false,
        ]);

        \Artisan::call('cache:clear');

        return redirect()->route('admin.desk.index');
    }

    public function quejasClientesDashboard()
    {
        abort_if(Gate::denies('centro_atencion_quejas_cliente_dashboard'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejasClientes = QuejasCliente::getAll();

        $quejasClientesSaA = $quejasClientes->where('estatus', 'Sin atender')->where('prioridad', 'Alta')->count();
        $quejasClientesSaM = $quejasClientes->where('estatus', 'Sin atender')->where('prioridad', 'Media')->count();
        $quejasClientesSaB = $quejasClientes->where('estatus', 'Sin atender')->where('prioridad', 'Baja')->count();
        $quejasClientesSaSd = $quejasClientes->where('estatus', 'Sin atender')->where('prioridad', null)->count();

        $quejasClientesEcA = $quejasClientes->where('estatus', 'En curso')->where('prioridad', 'Alta')->count();
        $quejasClientesEcM = $quejasClientes->where('estatus', 'En curso')->where('prioridad', 'Media')->count();
        $quejasClientesEcB = $quejasClientes->where('estatus', 'En curso')->where('prioridad', 'Baja')->count();
        $quejasClientesEcSd = $quejasClientes->where('estatus', 'En curso')->where('prioridad', null)->count();

        $quejasClientesEeA = $quejasClientes->where('estatus', 'En espera')->where('prioridad', 'Alta')->count();
        $quejasClientesEeM = $quejasClientes->where('estatus', 'En espera')->where('prioridad', 'Media')->count();
        $quejasClientesEeB = $quejasClientes->where('estatus', 'En espera')->where('prioridad', 'Baja')->count();
        $quejasClientesEeSd = $quejasClientes->where('estatus', 'En espera')->where('prioridad', null)->count();

        $quejasClientesCA = $quejasClientes->where('estatus', 'Cerrado')->where('prioridad', 'Alta')->count();
        $quejasClientesCM = $quejasClientes->where('estatus', 'Cerrado')->where('prioridad', 'Media')->count();
        $quejasClientesCB = $quejasClientes->where('estatus', 'Cerrado')->where('prioridad', 'Baja')->count();
        $quejasClientesCSd = $quejasClientes->where('estatus', 'Cerrado')->where('prioridad', null)->count();

        $quejasClientesCanA = $quejasClientes->where('estatus', 'No procedente')->where('prioridad', 'Alta')->count();
        $quejasClientesCanM = $quejasClientes->where('estatus', 'No procedente')->where('prioridad', 'Media')->count();
        $quejasClientesCanB = $quejasClientes->where('estatus', 'No procedente')->where('prioridad', 'Baja')->count();
        $quejasClientesCanSd = $quejasClientes->where('estatus', 'No procedente')->where('prioridad', null)->count();

        $quejaEstatusAltaArray = [$quejasClientesSaA, $quejasClientesEcA, $quejasClientesEeA, $quejasClientesCA, $quejasClientesCanA];
        $quejaEstatusMediaArray = [$quejasClientesSaM, $quejasClientesEcM, $quejasClientesEeM, $quejasClientesCM, $quejasClientesCanM];
        $quejaEstatusBajaArray = [$quejasClientesSaB, $quejasClientesEcB, $quejasClientesEeB, $quejasClientesCB, $quejasClientesCanB];
        $quejaEstatusSinDArray = [$quejasClientesSaSd, $quejasClientesEcSd, $quejasClientesEeSd, $quejasClientesCSd, $quejasClientesCanSd];

        $quejaPrioridadA = $quejasClientes->where('prioridad', 'Alta')->count();
        $quejaPrioridadM = $quejasClientes->where('prioridad', 'Media')->count();
        $quejaPrioridadB = $quejasClientes->where('prioridad', 'Baja')->count();

        $quejaAcSolicitada = $quejasClientes->where('desea_levantar_ac', true)->count();
        $quejaAcNoSolicitada = $quejasClientes->where('desea_levantar_ac', false)->count();

        $quejaCanalCorreoE = $quejasClientes->where('canal', 'Correo electronico')->count();
        $quejaCanalTelefono = $quejasClientes->where('canal', 'Via telefonica')->count();
        $quejaCanalPresencial = $quejasClientes->where('canal', 'Presencial')->count();
        $quejaCanalRemota = $quejasClientes->where('canal', 'Remota')->count();
        $quejaCanalOficio = $quejasClientes->where('canal', 'Oficio')->count();
        $quejaCanalOtro = $quejasClientes->where('canal', 'Otro')->count();

        $quejaCategoriaServNoP = $quejasClientes->where('categoria_queja', 'Servicio no prestado')->count();
        $quejaCategoriaRetrasoP = $quejasClientes->where('categoria_queja', 'Retraso en la prestacion')->count();
        $quejaCategoriaEntreNoC = $quejasClientes->where('categoria_queja', 'Entregable no conforme')->count();
        $quejaCategoriaIncuComC = $quejasClientes->where('categoria_queja', 'Incumplimiento de los compromisos contractuales')->count();
        $quejasCategoriaIncuNivServ = $quejasClientes->where('categoria_queja', 'Incumplimiento de los niveles de servicio')->count();
        $quejasCategoriaNegPresServ = $quejasClientes->where('categoria_queja', 'Negativa de prestación del servicio')->count();
        $quejasCategoriaIncFact = $quejasClientes->where('categoria_queja', 'Incorrecta facturacion')->count();
        $quejasCategoriaOtro = $quejasClientes->where('categoria_queja', 'Otro')->count();

        $quejaCumplioFecha = $quejasClientes->where('cumplio_fecha', true)->count();
        $quejaNoCumplioFecha = $quejasClientes->where('cumplio_fecha', false)->count();

        $areasCollect = [];
        $areas = [];
        $ticketPorArea = $quejasClientes;
        foreach ($ticketPorArea as $ticketArea) {
            $areas = $ticketArea->area_quejado;
            $areasExplode = explode(',', $areas);
            foreach ($areasExplode as $areaExplode) {
                //$areasCollect->push(trim($areaExplode));
                if (array_key_exists($areaExplode, $areasCollect)) {
                    $areasCollect[trim($areaExplode)] = $areasCollect[trim($areaExplode)] + 1;
                } else {
                    $areasCollect[trim($areaExplode)] = 1;
                }
            }
        }
        $areasCollect = array_filter($areasCollect, function ($item) {
            return $item != '';
        }, ARRAY_FILTER_USE_KEY);

        $procesosCollect = [];
        $ticketPorProceso = $quejasClientes;

        foreach ($ticketPorProceso as $ticketProceso) {
            $procesos = $ticketProceso->proceso_quejado;
            if ($procesos != null) {
                $procesosExplode = explode(',', $procesos);
                foreach ($procesosExplode as $procesoExplode) {
                    if (array_key_exists($procesoExplode, $procesosCollect)) {
                        $procesosCollect[trim($procesoExplode)] = $procesosCollect[trim($procesoExplode)] + 1;
                    } else {
                        $procesosCollect[trim($procesoExplode)] = 1;
                    }
                }
            }
        }
        $procesosCollect = array_filter($procesosCollect, function ($item) {
            return $item != '';
        }, ARRAY_FILTER_USE_KEY);

        $quejasproyectos = array_unique(QuejasCliente::pluck('proyectos_id')->toArray());
        $proyectos = TimesheetProyecto::getAllWithCliente()->find($quejasproyectos);
        $proyectosLabel = [];
        foreach ($proyectos as $proyecto) {

            $cantidad = $quejasClientes->where('proyectos_id', $proyecto->id)->count();
            array_push($proyectosLabel, [
                'nombre' => $proyecto->proyecto,
                'cliente' => $proyecto->cliente->nombre,
                'cantidad' => $cantidad,
            ]);
        }

        $quejasclientes = array_unique(QuejasCliente::pluck('cliente_id')->toArray());
        $clientes = TimesheetCliente::select('nombre', 'id')->find($quejasclientes);
        $clientesLabel = [];
        foreach ($clientes as $cliente) {
            $cantidadClientes = $quejasClientes->where('cliente_id', $cliente->id)->count();
            array_push($clientesLabel, [
                'nombre' => $cliente->nombre,
                'cantidad' => $cantidadClientes,
            ]);
        }

        $total_quejasClientes = $quejasClientes->count();
        $nuevos_quejasClientes = $quejasClientes->where('estatus', 'Sin atender')->count();
        $en_curso_quejasClientes = $quejasClientes->where('estatus', 'En curso')->count();
        $en_espera_quejasClientes = $quejasClientes->where('estatus', 'En espera')->count();
        $cerrados_quejasClientes = $quejasClientes->where('estatus', 'Cerrado')->count();
        $cancelados_quejasClientes = $quejasClientes->where('estatus', 'No procedente')->count();

        return view('admin.desk.clientes.dashboard', compact(
            'ticketPorArea',
            'areas',
            'areasCollect',
            'ticketPorProceso',
            'procesosCollect',
            'total_quejasClientes',
            'nuevos_quejasClientes',
            'en_curso_quejasClientes',
            'en_espera_quejasClientes',
            'cerrados_quejasClientes',
            'cancelados_quejasClientes',
            'quejasclientes',
            'clientes',
            'clientesLabel',
            'proyectosLabel',
            'quejasproyectos',
            'proyectos',
            'quejaCumplioFecha',
            'quejaNoCumplioFecha',
            'quejaCategoriaServNoP',
            'quejaCategoriaRetrasoP',
            'quejaCategoriaEntreNoC',
            'quejaCategoriaIncuComC',
            'quejasCategoriaIncuNivServ',
            'quejasCategoriaNegPresServ',
            'quejasCategoriaIncFact',
            'quejasCategoriaOtro',
            'quejaCanalCorreoE',
            'quejaCanalTelefono',
            'quejaCanalPresencial',
            'quejaCanalRemota',
            'quejaCanalOficio',
            'quejaCanalOtro',
            'quejaAcSolicitada',
            'quejaAcNoSolicitada',
            'quejaPrioridadA',
            'quejaPrioridadM',
            'quejaPrioridadB',
            'quejaEstatusAltaArray',
            'quejaEstatusMediaArray',
            'quejaEstatusBajaArray',
            'quejaEstatusSinDArray'
        ));
    }

    public function validateFormQuejaCliente(Request $request)
    {
        $id_quejas = $request->quejas_clientes_id;

        $quejasClientes = QuejasCliente::with('registro', 'responsableAtencion', 'cliente', 'proyectos')->find(intval($id_quejas));
        if ($request->tipo_validacion == 'queja-registro') {
            $this->validateRequestRegistroQuejaCliente($request);

            return response()->json(['isValid' => true]);
        } elseif ($request->tipo_validacion == 'queja-analisis') {
            $this->validateRequestRegistroQuejaCliente($request);
            $this->validateRequestAnalisisQuejaCliente($request);

            return response()->json(['isValid' => true]);
        } elseif ($request->tipo_validacion == 'queja-atencion') {
            if (! is_null($quejasClientes->responsable_atencion_queja_id)) {
                if ($quejasClientes->responsable_atencion_queja_id != User::getCurrentUser()->empleado->id) {
                    $this->validateRequestRegistroQuejaCliente($request);
                    $this->validateRequestAnalisisQuejaCliente($request);
                }
                $this->validateRequestAtencionQuejaCliente($request);
            } else {
                $this->validateRequestRegistroQuejaCliente($request);
                $this->validateRequestAnalisisQuejaCliente($request);
                $this->validateRequestAtencionQuejaCliente($request);
            }

            return response()->json(['isValid' => true]);
        } elseif ($request->tipo_validacion == 'queja-cierre') {
            $this->validateRequestRegistroQuejaCliente($request);
            $this->validateRequestAnalisisQuejaCliente($request);
            $this->validateRequestAtencionQuejaCliente($request);
            $this->validateRequestCierreQuejaCliente($request);

            return response()->json(['isValid' => true]);
        }
    }

    public function destroyQuejasClientes(Request $request, $quejasClientes)
    {
        $quejasClientes = QuejasCliente::find($quejasClientes);
        $quejasClientes->delete();

        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }

    public function validateRequestRegistroQuejaCliente($request)
    {

        $request->validate(
            [
                'cliente_id' => 'required',
                'proyectos_id' => 'required',
                'nombre' => 'required',
                'titulo' => 'required',
                'fecha' => 'required',
                'descripcion' => 'required',
                'area_quejado' => 'required',
                'canal' => 'required',
            ],
            [
                'cliente_id' => 'El campo cliente es obligatorio',
                'proyectos_id' => 'El campo proyecto es obligatorio',
                'titulo' => 'El campo título es obligatorio',
                'fecha' => 'El campo fecha es obligatorio',
                'descripcion' => 'El campo descripción es obligatorio',
                'area_quejado' => 'El campo area es obligatorio',
                'canal' => 'El campo canal es obligatorio',
            ]
        );
    }

    public function validateRequestAnalisisQuejaCliente($request)
    {
        $levantamiento_ac = intval($request->levantamiento_ac) == 1 ? true : false;
        $queja_procedente = intval($request->queja_procedente) == 1 ? true : false;
        if ($queja_procedente) {
            $request->validate(
                [
                    'urgencia' => 'required',
                    'impacto' => 'required',
                    'categoria_queja' => 'required',
                    'responsable_atencion_queja_id' => 'required',

                ],
                [
                    'urgencia' => 'El campo urgencia es obligatorio',
                    'impacto' => 'El campo impacto es obligatorio',
                    'categoria_queja' => 'El campo categoria es obligatorio',
                    'responsable_atencion_queja_id' => 'El campo responsable de la atención es obligatorio',
                ]
            );

            if ($levantamiento_ac) {
                $request->validate(
                    [
                        'responsable_sgi_id' => 'required',
                    ],
                    [
                        'responsable_sgi_id' => 'El campo responsable del SGI es obligatorio',
                    ]
                );
            }
        }
    }

    public function validateRequestAtencionQuejaCliente($request)
    {
        $request->validate(
            [
                'realizar_accion' => 'required',
                'acciones_tomara_responsable' => 'required',

            ],
            [
                'realizar_accion' => 'El campo realiazar acción es obligatorio',
                'acciones_tomara_responsable' => 'El campo acciones es obligatorio',
            ]
        );
    }

    public function validateRequestCierreQuejaCliente($request)
    {
        $request->validate(
            [
                'porque_no_cumplio_responsable' => 'required',
                'porque_no_cierre_ticket' => 'required',

            ],
            [
                'porque_no_cumplio_responsable' => 'El campo por qué no se cumplieron las acciones es obligatorio',
                'porque_no_cierre_ticket' => 'El campo por qué no se cierra el ticket es obligatorio',
            ]
        );
    }

    public function showQuejaClientes(Request $request)
    {
        $id_quejas = $request->quejas_clientes_id;

        $quejasClientes = QuejasCliente::findOrfail(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos');

        return view('admin.desk.quejas-clientes.show', compact('quejasClientes', 'id_quejas'));
    }
}
