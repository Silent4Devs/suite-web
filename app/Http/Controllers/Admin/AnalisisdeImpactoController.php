<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ajustesMatrizBIA;
use App\Models\AnalisisImpacto;
use App\Models\CuestionarioInfraestructuraTecnologica;
use App\Models\CuestionarioProporcionaInformacion;
use App\Models\CuestionarioRecibeInformacion;
use App\Models\CuestionarioRecursosHumanos;
use App\Traits\ObtenerOrganizacion;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class AnalisisdeImpactoController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = AnalisisImpacto::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'matriz_bia_cuestionario_ver_pendiente';
                $editGate = 'matriz_bia_cuestionario_editar';
                $deleteGate = 'matriz_bia_cuestionario_eliminar';
                $crudRoutePart = 'analisis-impacto';

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
            $table->editColumn('fecha_entrevista', function ($row) {
                return $row->fecha_entrevista ? $row->fecha_entrevista : '';
            });
            $table->editColumn('entrevistado', function ($row) {
                return $row->entrevistado ? $row->entrevistado : '';
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : '';
            });
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : '';
            });
            $table->editColumn('direccion', function ($row) {
                return $row->direccion ? $row->direccion : '';
            });
            $table->editColumn('extencion', function ($row) {
                return $row->extencion ? $row->extencion : '';
            });
            $table->editColumn('correo', function ($row) {
                return $row->correo ? $row->correo : '';
            });
            $table->editColumn('id_aplicacion', function ($row) {
                return $row->id_aplicacion ? $row->id_aplicacion : '';
            });
            $table->editColumn('nombre_aplicacion', function ($row) {
                return $row->nombre_aplicacion ? $row->nombre_aplicacion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.analisis-impacto.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = new AnalisisImpacto();

        return view('admin.analisis-impacto.create', compact('cuestionario'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //validacion
        $request->validate([
            //'id' => ['required'],
            'fecha_entrevista' => ['required', 'date'],
            'entrevistado' => ['required'],
            'puesto' => ['required'],
            'area' => ['required'],
            'direccion' => ['required'],
            'extencion' => ['nullable', 'numeric'],
            'correo' => ['required'],
            'procesos_a_cargo' => ['required'],
            // DATOS DE IDENTIFICACIÓN DEL PROCESO
            'id_proceso' => ['required'],
            'nombre_proceso' => ['required'],
            'version' => ['required'],
            'tipo' => ['required'],
            'objetivo_proceso' => ['required'],
            'macroproceso' => ['required'],
            'subproceso' => ['required'],
            'periodicidad' => ['required'],
            'p_otro_txt' => ['nullable'],
        ]);

        $cuestionario = AnalisisImpacto::create($request->all());

        return redirect()->route('admin.analisis-impacto.edit', ['id' => $cuestionario]);
    }

    public function show($id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AnalisisImpacto::find($id);

        return view('admin.analisis-impacto.show', compact('cuestionario'));
    }

    public function edit(Request $request, $id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuestionario = AnalisisImpacto::find($id);

        if (empty($cuestionario)) {
            Flash::error('Cuestionario no encontrado');

            return redirect(route('admin.analisis-impacto.index'));
        }

        return view('admin.analisis-impacto.edit', ['id' => $cuestionario], compact('cuestionario'));
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
            'direccion' => ['required'],
            'extencion' => ['nullable', 'numeric'],
            'correo' => ['required'],
            'procesos_a_cargo' => ['required'],
            // DATOS DE IDENTIFICACIÓN DEL PROCESO
            'id_proceso' => ['required'],
            'nombre_proceso' => ['required'],
            'version' => ['required'],
            'tipo' => ['required'],
            'objetivo_proceso' => ['required'],
            'macroproceso' => ['required'],
            'subproceso' => ['required'],
            'periodicidad' => ['required'],
            'p_otro_txt' => ['nullable'],
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
            'flujo_q_4' => ['required'],
            'periodicidad_diario',
            'periodicidad_quincenal',
            'periodicidad_mensual',
            'periodicidad_otro',
            'periodicidad_flujo_txt' => ['nullable'],
            'flujo_q_6' => ['required'],
            'flujo_q_7' => ['required'],
            'flujo_q_8' => ['required'],
            'flujo_q_10' => ['required'],
            'flujo_años' => ['required', 'numeric'],
            'flujo_meses' => ['required', 'numeric'],
            'flujo_semanas' => ['required', 'numeric'],
            'flujo_dias' => ['required', 'numeric'],
            'flujo_otro', //quitar
            'flujo_otro_txt' => ['nullable'],
            // RESPALDOS DE INFORMACIÓN
            'respaldo_q_20' => ['required'],
            'respaldo_q_21' => ['required'],
            'respaldo_q_22' => ['required'],
            'respaldo_q_23' => ['required'],
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
            'operacion_q_1' => ['required'],
            'operacion_q_2' => ['required'],
            'operacion_q_3' => ['required'],
            'regulatorio_q_1' => ['required'],
            'regulatorio_q_2' => ['required'],
            'regulatorio_q_3' => ['required'],
            'reputacion_q_1' => ['required'],
            'reputacion_q_2' => ['required'],
            'reputacion_q_3' => ['required'],
            'social_q_1' => ['required'],
            'social_q_2' => ['required'],
            'social_q_3' => ['required'],
            'incidentes_q_26' => ['required'],
            'incidentes_q_27' => ['required'],
            // firmas
            'firma_Entrevistado',
            'firma_Jefe',
            'firma_Entrevistador',
            'exite_firma_Entrevistado',
            'exite_firma_Jefe',
            'exite_firma_Entrevistador',
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
            // 'd8',
            // 'd9',
            // 'd10',
            // 'd11',
            // 'd12',
            // 'd13',
            // 'd14',
            // 'd15',
            // 'd16',
            // 'd17',
            // 'd18',
            // 'd19',
            // 'd20',
            // 'd21',
            // 'd22',
            // 'd23',
            // 'd24',
            // 'd25',
            // 'd26',
            // 'd27',
            // 'd28',
            // 'd29',
            // 'd30',
            // 'd31',
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

        ]);

        $cuestionario = AnalisisImpacto::find($id);
        $cuestionario->update($request->all());
        Flash::success('Cuestionario actualizado correctamente.');

        return redirect(route('admin.analisis-impacto.index'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AnalisisImpacto::find($id);
        $cuestionario->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function matriz()
    {
        abort_if(Gate::denies('matriz_bia_matriz'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AnalisisImpacto::with(['recursosHumanos', 'recibeInformacion', 'proporcionaInformacion'])->orderBy('id', 'DESC')->get();
        $tecnologica = CuestionarioInfraestructuraTecnologica::with('cuestionario')->get();
        $personas_contingencia = CuestionarioRecursosHumanos::with('cuestionario')->where('escenario', '2')->get();
        $proporciona_informacion = CuestionarioProporcionaInformacion::with('cuestionario')->orderByDesc('cuestionario_id')->get();
        $recibe_informacion = CuestionarioRecibeInformacion::with('cuestionario')->orderByDesc('cuestionario_id')->get();

        return view('admin.analisis-impacto.matriz', compact('cuestionario', 'tecnologica', 'personas_contingencia', 'proporciona_informacion', 'recibe_informacion'));
    }

    public function menu()
    {
        abort_if(Gate::denies('matriz_bia_menu_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.analisis-impacto.menu-buttons');
    }

    public function menuBIA()
    {
        abort_if(Gate::denies('matriz_bia_menu_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.analisis-impacto.menu-bia');
    }

    public function menuAIA()
    {
        abort_if(Gate::denies('matriz_bia_menu_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.analisis-impacto.menu-aia');
    }

    public function ajustes()
    {
        abort_if(Gate::denies('matriz_bia_matriz_ajustes'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = 1;
        $cuestionario = ajustesMatrizBIA::find($id);
        if (empty($cuestionario)) {
            Flash::error('Ajustes no encontrados');

            return redirect(route('admin.analisis-impacto.matriz'));
        }

        return view('admin.analisis-impacto.ajustes', compact('cuestionario'));
    }

    public function updateAjustesBIA(Request $request, $id)
    {
        abort_if(Gate::denies('matriz_bia_matriz_ajustes_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuestionario = ajustesMatrizBIA::find($id);
        $cuestionario->update($request->all());
        Flash::success('Ajustes aplicados satisfactoriamente.');

        return redirect()->route('admin.analisis-impacto.matriz');
    }
}
