<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NivelesImpacto;
use Illuminate\Http\Request;

class NivelesImpactoController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $nivel = $request->nivel;
            $clasificacion = $request->clasificacion;
            $color = $request->color;
            // dd($request->all());
            $niveles = NivelesImpacto::create([
                'nivel' => $nivel,
                'clasificacion' => $clasificacion,
                'color' => $color,

            ]);
            if ($niveles) {
                return response()->json(['success' => true, 'nivelimpacto' => $niveles]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }
}
