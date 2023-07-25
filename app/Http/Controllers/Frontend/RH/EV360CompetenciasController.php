<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\Puesto;
use App\Models\RH\Competencia;
use App\Models\RH\CompetenciaPuesto;
use App\Models\RH\Conducta;
use App\Models\RH\EvaluacionRepuesta;
use Illuminate\Http\Request;

class EV360CompetenciasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $competencias = Competencia::with('tipo')->get();

            return datatables()->of($competencias)->toJson();
        }

        return view('admin.recursos-humanos.evaluacion-360.competencias.index');
    }

    public function create()
    {
        $competencia = new Competencia;
        $tipo_seleccionado = null;

        return view('admin.recursos-humanos.evaluacion-360.competencias.create', compact('competencia', 'tipo_seleccionado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'tipo_id' => 'required|exists:ev360_tipo_competencias,id',
        ]);
        $competencia = Competencia::create($request->all());
        if ($competencia) {
            return redirect()->route('admin.ev360-competencias.edit', $competencia->id);
        } else {
            return redirect()->route('admin.ev360-competencias.index')->with('error', 'Ocurrió un error al crear la competencia, intente de nuevo...');
        }
    }

    public function storeAndRedirect(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'tipo_id' => 'required|exists:ev360_tipo_competencias,id',
        ]);
        $competencia = Competencia::create($request->all());
        if ($competencia) {
            return response()->json(['success' => true, 'competencia_id' => $competencia->id]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function edit($competencia)
    {
        $competencia = Competencia::find(intval($competencia));
        $tipo_seleccionado = $competencia->tipo_id;

        return view('admin.recursos-humanos.evaluacion-360.competencias.edit', compact('competencia', 'tipo_seleccionado'));
    }

    public function update(Request $request, $competencia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'tipo_id' => 'required|exists:ev360_tipo_competencias,id',
        ]);
        $competencia = Competencia::find(intval($competencia));
        $competencia_u = $competencia->update($request->all());
        // Almacenamos la competencia en todos los puestos
        if ($request->toda_la_empresa) {
            $puestos = Puesto::getAll();
            foreach ($puestos as $puesto) {
                $exists = CompetenciaPuesto::where('puesto_id', '=', $puesto->id)
                    ->where('competencia_id', '=', $competencia->id)
                    ->exists();
                if (! $exists) {
                    CompetenciaPuesto::create([
                        'puesto_id' => $puesto->id,
                        'competencia_id' => $competencia->id,
                        'nivel_esperado' => $request->nivel_esperado,
                    ]);
                }
            }
        }
        if ($competencia_u) {
            return redirect()->route('admin.ev360-competencias.index')->with('success', 'Competencia actualizada con éxito');
        } else {
            return redirect()->route('admin.ev360-competencias.index')->with('error', 'Ocurrió un error al crear la competencia, intente de nuevo...');
        }
    }

    public function conductas(Request $request, $competencia)
    {
        if ($request->ajax()) {
            $conductas = Conducta::where('competencia_id', intval($competencia))->get()->sortBy('ponderacion');

            return datatables()->of($conductas)->toJson();
        }
    }

    public function informacionCompetencia(Request $request, $competencia)
    {
        if ($request->ajax()) {
            $competencia = Competencia::with(['opciones' => function ($q) {
                $q->orderByDesc('ponderacion');
            }])->find(intval($competencia));

            return response()->json(['competencia' => $competencia]);
        }
    }

    public function guardarRespuestaCompetencia(Request $request, $competencia)
    {
        if ($request->ajax()) {
            $repuesta = EvaluacionRepuesta::where('evaluacion_id', $request->evaluacion_id)
                ->where('evaluado_id', $request->evaluado_id)
                ->where('evaluador_id', $request->evaluador_id)
                ->where('competencia_id', intval($competencia))
                ->first();
            $repuesta_u = $repuesta->update(['calificacion' => intval($request->calificacion)]);
            $total_preguntas = EvaluacionRepuesta::where('evaluacion_id', $request->evaluacion_id)
                ->where('evaluado_id', $request->evaluado_id)
                ->where('evaluador_id', $request->evaluador_id)
                ->count();
            $sin_contestar = EvaluacionRepuesta::where('evaluacion_id', $request->evaluacion_id)
                ->where('evaluado_id', $request->evaluado_id)
                ->where('evaluador_id', $request->evaluador_id)
                ->where('calificacion', '=', 0)->count();
            $contestadas = EvaluacionRepuesta::where('evaluacion_id', $request->evaluacion_id)
                ->where('evaluado_id', $request->evaluado_id)
                ->where('evaluador_id', $request->evaluador_id)
                ->where('calificacion', '>', 0)->count();
            $progreso = $progreso = floatval(number_format((($contestadas / $total_preguntas) * 100)));

            if ($repuesta_u) {
                return response()->json(['success' => true, 'progreso' => $progreso, 'contestadas' => $contestadas, 'sin_contestar' => $sin_contestar]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function obtenerNiveles(Request $request)
    {
        if ($request->ajax()) {
            $competencia = Competencia::find(intval($request->competencia_id));
            $niveles = $competencia->opciones;

            return json_encode($niveles);
        }
    }
}
