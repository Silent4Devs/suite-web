<?php

namespace App\Http\Controllers\Admin\RH;

use App\Exports\EvaluacionesDesempenoReportExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\EvaluacionDesempeno;
use App\Models\Organizacion;
use App\Models\PeriodosEvaluacionDesempeno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EvaluacionesDesempenoController extends Controller
{
    public function index()
    {
        $evaluaciones = EvaluacionDesempeno::getAll();
        // dd($evaluaciones);
        return view('admin.recursos-humanos.evaluaciones-desempeno.index', compact('evaluaciones'));
    }

    public function editBorrador($id_evaluacion)
    {
        $evaluaciones = EvaluacionDesempeno::with('periodos', 'evaluados')->find($id_evaluacion);
        dd($evaluaciones);
        return view('admin.recursos-humanos.evaluaciones-desempeno.index', compact('evaluaciones'));
    }

    public function dashboardGeneral()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-general');
    }

    public function dashboardEvaluacion($id_evaluacion)
    {
        EvaluacionDesempeno::findOrFail($id_evaluacion);
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-evaluacion', compact('id_evaluacion'));
    }

    public function dashboardArea($id_evaluacion, $id_area)
    {
        EvaluacionDesempeno::findOrFail($id_evaluacion);
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-area', compact('id_evaluacion', 'id_area'));
    }

    public function dashboardEvaluado($id_evaluacion, $id_evaluado)
    {
        EvaluacionDesempeno::findOrFail($id_evaluacion);
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-evaluado', compact('id_evaluacion', 'id_evaluado'));
    }

    public function dashboardGlobal()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-global');
    }

    public function configEvaluaciones()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.config-evaluaciones-cards');
    }

    public function createEvaluacion()
    {
        $areas = Area::getIdNameAll();
        $empleados = Empleado::getIDaltaAll();

        return view('admin.recursos-humanos.evaluaciones-desempeno.create-evaluacion', compact('areas', 'empleados'));
    }

    public function cuestionarioEvaluacionDesempeno($evaluacion, $evaluado, $periodo)
    {
        $currentUser = User::getCurrentUser()->empleado;

        $evaluacionDesempeno = EvaluacionDesempeno::findOrFail($evaluacion);
        $evaluado = $evaluacionDesempeno->evaluados()->find($evaluado);

        if (empty($evaluacionDesempeno) || empty($evaluado)) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        $evaluadoresObjetivos = $evaluado->evaluadoresObjetivos($periodo)->pluck('evaluador_desempeno_id')->toArray();
        $evaluadoresCompetencias = $evaluado->evaluadoresCompetencias($periodo)->pluck('evaluador_desempeno_id')->toArray();
        $acceso_objetivos = in_array($currentUser->id, $evaluadoresObjetivos);
        $acceso_competencias = in_array($currentUser->id, $evaluadoresCompetencias);

        if (!$acceso_objetivos && !$acceso_competencias) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        return view('admin.recursos-humanos.evaluaciones-desempeno.cuestionario', compact(
            'evaluacionDesempeno',
            'evaluado',
            'periodo',
            'acceso_objetivos',
            'acceso_competencias'
        ));
    }

    public function misEvaluaciones()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.mis-evaluaciones');
    }

    public function cargaObjetivosEmpleado($id_empleado)
    {
        $empleado = Empleado::getaltaAllWithAreaObjetivoPerfil()->find($id_empleado);
        $organizacion = Organizacion::first();
        // dd($empleado);
        return view('admin.recursos-humanos.evaluaciones-desempeno.carga-objetivos-empleado', compact('empleado', 'organizacion'));
    }

    public function objetivosImportar()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.objetivos-importar');
    }

    public function objetivosPapelera($id_empleado)
    {
        $empleado = Empleado::getaltaAllWithAreaObjetivoPerfil()->find($id_empleado);
        // dd($empleado);
        return view('admin.recursos-humanos.evaluaciones-desempeno.objetivos-papelera', compact('empleado'));
    }

    public function objetivosExportar()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.objetivos-exportar');
    }

    public function destroy($id_evaluacion)
    {
        // dd($id_evaluacion);
        $evBorrar = EvaluacionDesempeno::find($id_evaluacion);
        $evBorrar->delete();
    }

    public function storeFirmasEvaluacion($id_ev, $id_evaluado, $id_periodo, Request $request)
    {
        try {
            $evaluacion = EvaluacionDesempeno::find($id_ev);

            $evaluador = auth()->user()->empleado;
            $evaluado = Empleado::getAltaEmpleados()->find($id_evaluado);
            $periodo = PeriodosEvaluacionDesempeno::find($id_periodo);

            $evVal = $evaluacion->evaluados->where('evaluado_desempeno_id', $id_evaluado)->first();

            $signatureEvaluado = $request->input('signatureEvaluado');
            $signatureEvaluador = $request->input('signatureEvaluador');

            $imageEvaluado = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureEvaluado));
            $imageEvaluador = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureEvaluador));

            if (!Storage::exists('public/evaluacionesDesempeno/evaluacion/' . $evaluacion->id . '/firmas/periodo' . '/' . $periodo->nombre_evaluacion . '/evaluado' . '/' . $evaluado->name . '/evaluador' . '/' . $evaluador->name)) {
                Storage::makeDirectory('public/evaluacionesDesempeno/evaluacion/' . $evaluacion->id . '/firmas/periodo' . '/' . $periodo->nombre_evaluacion . '/evaluado' . '/' . $evaluado->name . '/evaluador' . '/' . $evaluador->name, 0755, true);
            }

            $filenameEvaluado = '/evaluacion' . $evaluacion->id . 'firmaevaluado' . $evaluado->name . '.png';
            $filenameEvaluador = '/evaluacion' . $evaluacion->id . 'firmaevaluador' . $evaluador->name . '.png';

            Storage::put('public/evaluacionesDesempeno/evaluacion/' . $evaluacion->id . '/firmas/periodo' . '/' . $periodo->nombre_evaluacion . '/evaluado' . '/' . $evaluado->name . '/evaluador' . '/' . $evaluador->name  . $filenameEvaluado, $imageEvaluado);
            Storage::put('public/evaluacionesDesempeno/evaluacion/' . $evaluacion->id . '/firmas/periodo' . '/' . $periodo->nombre_evaluacion . '/evaluado' . '/' . $evaluado->name . '/evaluador' . '/' . $evaluador->name  . $filenameEvaluador, $imageEvaluador);

            if ($evaluacion->activar_competencias && $evaluacion->activar_objetivos) {
                $evldrObj = $evVal->evaluadoresObjetivos->where('periodo_id', $id_periodo)
                    ->where('evaluador_desempeno_id', $evaluador->id)
                    ->where('evaluado_desempeno_id', $evVal->id)
                    ->first();
                $evldrComp = $evVal->evaluadoresCompetencias->where('periodo_id', $id_periodo)
                    ->where('evaluador_desempeno_id', $evaluador->id)
                    ->where('evaluado_desempeno_id', $evVal->id)
                    ->first();

                $evldrObj->update([
                    'firma_evaluado' => $filenameEvaluado,
                    'firma_evaluador' => $filenameEvaluador,
                ]);
                $evldrComp->update([
                    'firma_evaluado' => $filenameEvaluado,
                    'firma_evaluador' => $filenameEvaluador,
                ]);
            } elseif ($evaluacion->activar_competencias && !$evaluacion->activar_objetivos) {
                $evldrObj = $evVal->evaluadoresObjetivos->where('periodo_id', $id_periodo)
                    ->where('evaluador_desempeno_id', $evaluador->id)
                    ->where('evaluado_desempeno_id', $evVal->id)
                    ->first();

                $evldrObj->update([
                    'firma_evaluado' => $filenameEvaluado,
                    'firma_evaluador' => $filenameEvaluador,
                ]);
            } elseif (!$evaluacion->activar_competencias && $evaluacion->activar_objetivos) {
                $evldrComp = $evVal->evaluadoresCompetencias->where('periodo_id', $id_periodo)
                    ->where('evaluador_desempeno_id', $evaluador->id)
                    ->where('evaluado_desempeno_id', $evVal->id)
                    ->first();

                $evldrComp->update([
                    'firma_evaluado' => $filenameEvaluado,
                    'firma_evaluador' => $filenameEvaluador,
                ]);
            }
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
            return response()->json(['success' => false]);
        }
    }

    public function descargaEvaluacion($id)
    {
        $evaluacion = EvaluacionDesempeno::find($id);

        // $headersBasicos = [
        //     'Nombre',
        //     'Puesto',
        //     'Area',
        //     'Evaluadores',
        //     'Estatus',
        //     'Porcentaje Objetivos',
        //     'Porcentaje Competencias',
        //     'Objetivos',
        //     'Competencias',
        // ];
        // dd($headersBasicos);
        foreach ($evaluacion->periodos as $key_periodo => $periodo) {
            $coleccion = collect();
            foreach ($evaluacion->evaluados as $key => $evaluado) {
                $empleadoId = $evaluado->empleado->id;
                $evaluadores = collect();

                if ($evaluacion->activar_objetivos) {
                    $totales_evaluado[$periodo->id][$evaluado->id]['objetivos'] = $evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo->id);
                    $evObj = $evaluado->evaluadoresObjetivos($periodo->id);

                    $evaluadoresObjetivos = $evObj->reject(function ($item) use ($empleadoId) {
                        return $item['evaluador_desempeno_id'] == $empleadoId;
                    });

                    $evO = $evaluadoresObjetivos->map(function ($eO) {
                        return [
                            'id' => $eO->empleado->id,
                            'nombre' => $eO->empleado->name
                        ];
                    });

                    $evaluadores = $evaluadores->merge($evO);
                }

                if ($evaluacion->activar_competencias) {
                    $totales_evaluado[$periodo->id][$evaluado->id]['competencias'] = $evaluado->calificacionesCompetenciasEvaluadoPeriodo($periodo->id);
                    $evComp = $evaluado->evaluadoresCompetencias($periodo->id);

                    $evaluadoresCompetencias = $evComp->reject(function ($item) use ($empleadoId) {
                        return $item['evaluador_desempeno_id'] == $empleadoId;
                    });

                    $evC = $evaluadoresCompetencias->map(function ($eC) {
                        return [
                            'id' => $eC->empleado->id,
                            'nombre' => $eC->empleado->name
                        ];
                    });

                    $evaluadores = $evaluadores->merge($evC);
                }

                // Keep only 'nombre' after ensuring uniqueness based on 'id'
                // $totales_evaluado[$periodo->id][$evaluado->id]['evaluadores'] = $evaluadores->unique('id')->pluck('nombre')->values()->all();

                // Ensure uniqueness and concatenate 'nombre' values with "/"
                $concatenatedEvaluadores = $evaluadores->unique('id')->pluck('nombre')->implode(' , ');

                $total_competencias = ($totales_evaluado[$periodo->id][$evaluado->id]['competencias']['promedio_total'] * $evaluacion->porcentaje_competencias) / 100;
                $total_objetivos = ($totales_evaluado[$periodo->id][$evaluado->id]['objetivos']['promedio_total'] * $evaluacion->porcentaje_objetivos) / 100;

                $data =
                    [
                        'nombre' => $evaluado->empleado->name,
                        'puesto' => $evaluado->empleado->puestoRelacionado->puesto,
                        'area' => $evaluado->empleado->area->area,
                        'evaluadores' => $concatenatedEvaluadores,
                        'estatus' => $evaluado->empleado->estatus,
                        'porcentajeObjetivos' => $evaluacion->porcentaje_objetivos,
                        'porcentajeCompetencias' => $evaluacion->porcentaje_competencias,
                        'competencias' => $total_competencias,
                        'objetivos' => $total_objetivos,
                    ];

                $filtro_competencias = $totales_evaluado[$periodo->id][$evaluado->id]['competencias']['calif_total'];
                $filtro_objetivos = $totales_evaluado[$periodo->id][$evaluado->id]['objetivos']['calif_total'];

                foreach ($filtro_competencias as $key_c => $comp) {
                    $data[$comp["competencia"]] = $comp["calificacion_total"];
                    $nombres_competencia[] = $comp["competencia"];
                }


                foreach ($filtro_objetivos as $key_o => $obj) {
                    $data['nombre_objetivo' . ($key_o + 1)] = $obj["nombre"];
                    $data['calif_objetivo' . ($key_o + 1)] = $obj["calificacion_total"];
                }

                $coleccion->push($data);
            }
        }

        $headers_competencias = $nombres_competencia;

        $headersBasicos = [
            'Nombre',
            'Puesto',
            'Area',
            'Evaluadores',
            'Estatus',
            'Porcentaje Objetivos',
            'Porcentaje Competencias',
            'Objetivos',
            'Competencias',
        ];

        $merge = array_merge($headersBasicos, $headers_competencias);

        // dd($merge);

        $export = new EvaluacionesDesempenoReportExport($id);
        // dd($export);
        return Excel::download($export, 'Evaluaciones_desempeño.xlsx');
    }
}
