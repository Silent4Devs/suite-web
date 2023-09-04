<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Conducta;
use Illuminate\Http\Request;

class EV360ConductasController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'definicion' => 'required|string|max:1000',
        ]);
        if ($request->ajax()) {
            $nivel_maximo_actual = Conducta::where('competencia_id', $request->competencia_id)->max('ponderacion');
            $ponderacion = 1;
            if ($nivel_maximo_actual) {
                $ponderacion = $nivel_maximo_actual + 1;
            }
            $conducta = Conducta::create([
                'definicion' => $request->definicion,
                'ponderacion' => $ponderacion,
                'competencia_id' => intval($request->competencia_id),
            ]);
        }

        // $this->resetCounter(intval($request->competencia_id));
        return response()->json(['success' => true]);
    }

    public function resetCounter($competencia_id)
    {
        $niveles = Conducta::where('competencia_id', $competencia_id)->get()->sortBy('ponderacion');
        $contador = 1;
        foreach ($niveles as $nivel) {
            $nivel->update(['ponderacion' => $contador]);
            $contador++;
        }
    }

    public function edit(Request $request, $conducta)
    {
        $conducta = Conducta::find(intval($conducta));
        if ($request->ajax()) {
            return response()->json(['conducta' => $conducta]);
        }
    }

    public function update(Request $request, $conducta)
    {
        $request->validate([
            'definicion' => 'required|string|max:1000',
        ]);
        if ($request->ajax()) {
            $conducta = Conducta::find(intval($conducta));
            $conducta->update([
                'definicion' => $request->definicion,
            ]);
            // $this->resetCounter(intval($conducta->competencia_id));
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $conducta)
    {
        if ($request->ajax()) {
            $conducta = Conducta::find(intval($conducta));
            $competencia = $conducta->competencia_id;
            $eliminacion = $conducta->delete();
            $this->resetCounter(intval($competencia));
            if ($eliminacion) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }
}
