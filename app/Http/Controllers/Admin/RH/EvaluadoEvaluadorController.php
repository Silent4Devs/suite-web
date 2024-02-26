<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\EvaluadoEvaluador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class EvaluadoEvaluadorController extends Controller
{
    public function remover(Request $request)
    {
        if ($request->ajax()) {
            $evaluado = intval($request->evaluado);
            $evaluador = intval($request->evaluador);
            $evaluacion = intval($request->evaluacion);
            $evaluadoEvaluador = EvaluadoEvaluador::where('evaluado_id', $evaluado)
                ->where('evaluador_id', $evaluador)
                ->where('evaluacion_id', $evaluacion)
                ->first();
            $eliminado = $evaluadoEvaluador->delete();
            if ($eliminado) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function agregar(Request $request)
    {
        if ($request->ajax()) {
            $evaluado = $request->evaluado;
            $evaluador = $request->evaluador;
            $evaluacion = $request->evaluacion;

            $evaluadoEvaluador_exists = EvaluadoEvaluador::where('evaluado_id', $evaluado)
                ->where('evaluador_id', $evaluador)
                ->where('evaluacion_id', $evaluacion)
                ->exists();
            if ($evaluadoEvaluador_exists) {
                return response()->json(['exists' => true]);
            }
            $evaluadoEvaluador = EvaluadoEvaluador::create([
                'evaluado_id' => $evaluado,
                'evaluador_id' => $evaluador,
                'evaluacion_id' => $evaluacion,
                'evaluado' => false,
            ]);
            if ($evaluadoEvaluador) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }
}