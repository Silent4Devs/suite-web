<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AjustesAIA;
use App\Models\AnalisisAIA;
use App\Models\Organizacion;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ObtenerOrganizacion;

class AnalisisAIAController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = AnalisisAIA::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'matriz_bia_cuestionario_ver_pendiente';
                $editGate = 'matriz_bia_cuestionario_editar';
                $deleteGate = 'matriz_bia_cuestionario_eliminar';
                $crudRoutePart = 'analisis-aia';

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

            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : '';
            });
            $table->editColumn('fecha_entrevista', function ($row) {
                return $row->fecha_entrevista ? $row->fecha_entrevista : '';
            });
            $table->editColumn('id_aplicacion', function ($row) {
                return $row->id_aplicacion ? $row->id_aplicacion : '';
            });
            $table->editColumn('nombre_aplicacion', function ($row) {
                return $row->nombre_aplicacion ? $row->nombre_aplicacion : '';
            });
            $table->editColumn('entrevistado', function ($row) {
                return $row->entrevistado ? $row->entrevistado : '';
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : '';
            });
            $table->editColumn('correo', function ($row) {
                return $row->correo ? $row->correo : '';
            });
            $table->editColumn('extencion', function ($row) {
                return $row->extencion ? $row->extencion : '';
            });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;


        return view('admin.analisis-aia.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = new AnalisisAIA();

        return view('admin.analisis-aia.create', compact('cuestionario'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //validacion
        $request->validate([
            'id' => ['required'],
            'fecha_entrevista' => ['required', 'date'],
            'entrevistado' => ['required'],
            'puesto' => ['required'],
            'area' => ['required'],
            'direccion' => ['required'],
            'extencion' => ['nullable', 'numeric'],
            'correo' => ['required'],
            'aplicaciones_a_cargo' => ['required'],
            // DATOS DE IDENTIFICACIÓN DEL PROCESO
            'id_aplicacion' => ['required'],
            'nombre_aplicacion' => ['required'],
            'version' => ['required'],
            'tipo' => ['required'],
            'objetivo_aplicacion' => ['required'],
            'periodicidad' => ['required'],
            'p_otro_txt' => ['nullable'],
            'area_pertenece_aplicacion' => ['required'],
            'area_responsable_aplicacion' => ['required'],
        ]);

        $cuestionario = AnalisisAIA::create($request->all());

        return redirect()->route('admin.analisis-aia.edit', ['id' => $cuestionario]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuestionario = AnalisisAIA::find($id);

        if (empty($cuestionario)) {
            Flash::error('Cuestionario no encontrado');

            return redirect(route('admin.analisis-aia.index'));
        }

        return view('admin.analisis-aia.edit', ['id' => $cuestionario], compact('cuestionario'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            //            'id' => ['required'],
            'fecha_entrevista' => ['required', 'date'],
            'entrevistado' => ['required'],
            'puesto' => ['required'],
            'area' => ['required'],
            //            'direccion' => ['required'],
            'extencion' => ['nullable', 'numeric'],
            'correo' => ['required'],
            'aplicaciones_a_cargo' => ['required'],
            // DATOS DE IDENTIFICACIÓN DEL PROCESO
            'id_aplicacion' => ['required'],
            'nombre_aplicacion' => ['required'],
            'version' => ['required'],
            //            'tipo' => ['required'],
            'objetivo_aplicacion' => ['required'],
            'periodicidad' => ['required'],
            'p_otro_txt' => ['nullable'],
            'area_pertenece_aplicacion' => ['required'],
            'area_responsable_aplicacion' => ['required'],
            // RESPONSABLES DEL PROCESO
            'titular_nombre' => ['required'],
            'titular_a_paterno' => ['required'],
            'titular_a_materno' => ['required'],
            'titular_puesto' => ['required'],
            'titular_correo' => ['required'],
            'titular_extencion' => ['nullable', 'numeric'],
            'suplente_nombre' => ['required'],
            'suplente_a_paterno' => ['required'],
            'suplente_a_materno' => ['required'],
            'suplente_puesto' => ['required'],
            'suplente_correo' => ['required'],
            'suplente_extencion' => ['nullable', 'numeric'],
            'supervisor_nombre' => ['required'],
            'supervisor_a_paterno' => ['required'],
            'supervisor_a_materno' => ['required'],
            'supervisor_puesto' => ['required'],
            'supervisor_correo' => ['required'],
            'supervisor_extencion' => ['nullable', 'numeric'],
            // FLUJO DEL PROCESO
            'flujo_q_1' => ['required'],
            'flujo_q_2' => ['required'],
            'flujo_q_5' => ['required'],

            //INFRAESTRUCTURA TECNOLÓGICA
            'app_ip' => ['required'],
            'bd_ip' => ['required'],
            'otro_ip' => ['nullable'],
            'app_host' => ['required'],
            'bd_host' => ['required'],
            'otro_host' => ['nullable'],
            'app_base' => ['required'],
            'bd_base' => ['required'],
            'otro_base' => ['nullable'],
            'app_puerto' => ['required'],
            'bd_puerto' => ['required'],
            'otro_puerto' => ['nullable'],
            'app_servidor' => ['required'],
            'bd_servidor' => ['required'],
            'otro_servidor' => ['nullable'],
            'app_SO' => ['required'],
            'bd_SO' => ['required'],
            'otro_SO' => ['nullable'],
            'app_acceso' => ['required'],
            'bd_acceso' => ['required'],
            'otro_acceso' => ['nullable'],
            'app_url' => ['required'],
            'bd_url' => ['required'],
            'otro_url' => ['nullable'],
            'app_ip_publica' => ['required'],
            'bd_ip_publica' => ['required'],
            'otro_ip_publica' => ['nullable'],
            'app_certificado' => ['required'],
            'bd_certificado' => ['required'],
            'otro_certificado' => ['nullable'],
            'app_tipo_cifrado' => ['required'],
            'bd_tipo_cifrado' => ['required'],
            'otro_tipo_cifrado' => ['nullable'],
            'app_internet' => ['required'],
            'bd_internet' => ['required'],
            'otro_internet' => ['nullable'],
            'app_datos_url' => ['required'],
            'bd_datos_url' => ['required'],
            'otro_datos_url' => ['nullable'],
            'app_acceso_moviles' => ['required'],
            'bd_acceso_moviles' => ['required'],
            'otro_acceso_moviles' => ['nullable'],
            'app_nombre_app_movil' => ['required'],
            'bd_nombre_app_movil' => ['required'],
            'otro_nombre_app_movil' => ['nullable'],
            'app_interaccion_otras_apps' => ['required'],
            'bd_interaccion_otras_apps' => ['required'],
            'otro_interaccion_otras_apps' => ['nullable'],
            'app_datos_interactuan' => ['required'],
            'bd_datos_interactuan' => ['required'],
            'otro_datos_interactuan' => ['nullable'],
            'app_soporte_terceros' => ['required'],
            'bd_soporte_terceros' => ['required'],
            'otro_soporte_terceros' => ['nullable'],
            'app_datos_terceros' => ['required'],
            'bd_datos_terceros' => ['required'],
            'otro_datos_terceros' => ['nullable'],
            'app_instancia_balanceo' => ['required'],
            'bd_instancia_balanceo' => ['required'],
            'otro_instancia_balanceo' => ['nullable'],
            'app_datos_balanceo' => ['required'],
            'bd_datos_balanceo' => ['required'],
            'otro_datos_balanceo' => ['nullable'],
            'app_sofware_adicional' => ['required'],
            'bd_sofware_adicional' => ['required'],
            'otro_sofware_adicional' => ['nullable'],
            'app_lenguajes' => ['required'],
            'bd_lenguajes' => ['required'],
            'otro_lenguajes' => ['nullable'],
            'contingencia_app_ip' => ['required'],
            'contingencia_bd_ip' => ['required'],
            'contingencia_otro_ip' => ['nullable'],
            'contingencia_app_host' => ['required'],
            'contingencia_bd_host' => ['required'],
            'contingencia_otro_host' => ['nullable'],
            'contingencia_app_servidor' => ['required'],
            'contingencia_bd_servidor' => ['required'],
            'contingencia_otro_servidor' => ['nullable'],
            'contingencia_app_SO' => ['required'],
            'contingencia_bd_SO' => ['required'],
            'contingencia_otro_SO' => ['nullable'],
            'contingencia_app_acceso' => ['required'],
            'contingencia_bd_acceso' => ['required'],
            'contingencia_otro_acceso' => ['nullable'],
            'contingencia_app_url' => ['required'],
            'contingencia_bd_url' => ['required'],
            'contingencia_otro_url' => ['nullable'],
            // PERÍODOS CRÍTICOS
            'primer_semestre' => ['nullable'],
            'segundo_semestre' => ['nullable'],
            'ene' => ['nullable'],
            'feb' => ['nullable'],
            'mar' => ['nullable'],
            'abr' => ['nullable'],
            'may' => ['nullable'],
            'jun' => ['nullable'],
            'jul' => ['nullable'],
            'ago' => ['nullable'],
            'sep' => ['nullable'],
            'oct' => ['nullable'],
            'nov' => ['nullable'],
            'dic' => ['nullable'],
            's1' => ['nullable'],
            's2' => ['nullable'],
            's3' => ['nullable'],
            's4' => ['nullable'],
            'd1' => ['nullable'],
            'd2' => ['nullable'],
            'd3' => ['nullable'],
            'd4' => ['nullable'],
            'd5' => ['nullable'],
            'd6' => ['nullable'],
            'd7' => ['nullable'],
            'd8' => ['nullable'],
            'd9' => ['nullable'],
            'd10' => ['nullable'],
            'd11' => ['nullable'],
            'd12' => ['nullable'],
            'd13' => ['nullable'],
            'd14' => ['nullable'],
            'd15' => ['nullable'],
            'd16' => ['nullable'],
            'd17' => ['nullable'],
            'd18' => ['nullable'],
            'd19' => ['nullable'],
            'd20' => ['nullable'],
            'd21' => ['nullable'],
            'd22' => ['nullable'],
            'd23' => ['nullable'],
            'd24' => ['nullable'],
            'd25' => ['nullable'],
            'd26' => ['nullable'],
            'd27' => ['nullable'],
            'd28' => ['nullable'],
            'd29' => ['nullable'],
            'd30' => ['nullable'],
            'd31' => ['nullable'],
            'h1' => ['nullable'],
            'h2' => ['nullable'],
            'h3' => ['nullable'],
            'h4' => ['nullable'],
            'h5' => ['nullable'],
            'h6' => ['nullable'],
            'h7' => ['nullable'],
            'h8' => ['nullable'],
            'h9' => ['nullable'],
            'h10' => ['nullable'],
            'h11' => ['nullable'],
            'h12' => ['nullable'],
            'h13' => ['nullable'],
            'h14' => ['nullable'],
            'h15' => ['nullable'],
            'h16' => ['nullable'],
            'h17' => ['nullable'],
            'h18' => ['nullable'],
            'h19' => ['nullable'],
            'h20' => ['nullable'],
            'h21' => ['nullable'],
            'h22' => ['nullable'],
            'h23' => ['nullable'],
            'h24' => ['nullable'],
            // TIEMPOS DE RECUPERACIÓN
            'rpo_mes' => ['required', 'numeric'],
            'rpo_semana' => ['required', 'numeric'],
            'rpo_dia' => ['required', 'numeric'],
            'rpo_hora' => ['required', 'numeric'],
            'rto_mes' => ['required', 'numeric'],
            'rto_semana' => ['required', 'numeric'],
            'rto_dia' => ['required', 'numeric'],
            'rto_hora' => ['required', 'numeric'],
            'wrt_mes' => ['required', 'numeric'],
            'wrt_semana' => ['required', 'numeric'],
            'wrt_dia' => ['required', 'numeric'],
            'wrt_hora' => ['required', 'numeric'],
            'mtpd_mes' => ['required', 'numeric'],
            'mtpd_semana' => ['required', 'numeric'],
            'mtpd_dia' => ['required', 'numeric'],
            'mtpd_hora' => ['required', 'numeric'],
            // RESPALDOS DE INFORMACIÓN
            'respaldo_q_14' => ['required'],
            'respaldo_q_15' => ['required'],
            'respaldo_q_16' => ['required'],

            // PROBABILIDAD DE INCIDENTES DISRUPTIVOS
            'disruptivos_q_1' => ['required'],
            'disruptivos_q_2' => ['required'],
            'disruptivos_q_3' => ['required'],
            'disruptivos_q_4' => ['required'],
            'disruptivos_q_5' => ['required'],
            'disruptivos_q_6' => ['required'],
            'disruptivos_q_7' => ['required'],
            'disruptivos_q_8' => ['required'],
            'disruptivos_q_9' => ['required'],
            'disruptivos_q_10' => ['required'],
            'disruptivos_q_11' => ['required'],
            // RIESGOS E INCIDENTES DISRUPTIVOS
            'operacion_q_1' => ['required', 'numeric'],
            'operacion_q_2' => ['required', 'numeric'],
            'operacion_q_3' => ['required', 'numeric'],
            'operacion_q_4' => ['required', 'numeric'],
            'regulatorio_q_1' => ['required', 'numeric'],
            'regulatorio_q_2' => ['required', 'numeric'],
            'regulatorio_q_3' => ['required', 'numeric'],
            'regulatorio_q_4' => ['required', 'numeric'],
            'reputacion_q_1' => ['required', 'numeric'],
            'reputacion_q_2' => ['required', 'numeric'],
            'reputacion_q_3' => ['required', 'numeric'],
            'reputacion_q_4' => ['required', 'numeric'],
            'social_q_1' => ['required', 'numeric'],
            'social_q_2' => ['required', 'numeric'],
            'social_q_3' => ['required', 'numeric'],
            'social_q_4' => ['required', 'numeric'],
            'q_19' => ['required'],
            // Firmas
            'firma_Entrevistado',
            'firma_Jefe',
            'firma_Entrevistador',
            'exite_firma_Entrevistado',
            'exite_firma_Jefe',
            'exite_firma_Entrevistador',
            // Agregados posteriormente
            'productivo_desarrollo',
            'interno_externo',
            'manejador_bd',
        ]);

        $cuestionario = AnalisisAIA::find($id);
        $cuestionario->update($request->all());
        Flash::success('Cuestionario actualizado correctamente.');

        return redirect(route('admin.analisis-aia.index'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AnalisisAIA::find($id);
        $cuestionario->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function matriz()
    {
        abort_if(Gate::denies('matriz_bia_matriz'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AnalisisAIA::with('proporcionaInformacion', 'proporcionaMantenimientos')->get();

        return view('admin.analisis-aia.matriz', compact('cuestionario'));
    }

    public function ajustes()
    {
        abort_if(Gate::denies('matriz_bia_matriz_ajustes'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = 1;
        $cuestionario = AjustesAIA::find($id);
        if (empty($cuestionario)) {
            Flash::error('Ajustes no encontrados');

            return redirect(route('admin.analisis-aia.matriz'));
        }

        return view('admin.analisis-aia.ajustes', compact('cuestionario'));
    }

    public function updateAjustesAIA(Request $request, $id)
    {
        abort_if(Gate::denies('matriz_bia_matriz_ajustes_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AjustesAIA::find($id);
        $cuestionario->update($request->all());
        Flash::success('Ajustes aplicados satisfactoriamente.');

        return redirect()->route('admin.analisis-aia.matriz');
    }
}
