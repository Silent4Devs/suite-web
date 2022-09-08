<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitantes\AvisoPrivacidadVisitante;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitantesAvisoPrivacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (AvisoPrivacidadVisitante::count() > 0) {
            $aviso_privacidad = AvisoPrivacidadVisitante::first();
        } else {
            $aviso_privacidad = new AvisoPrivacidadVisitante();
        }
        return view('admin.visitantes.aviso-privacidad.index', compact('aviso_privacidad'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'aviso_privacidad' => 'required',
        ]);

        if (AvisoPrivacidadVisitante::count() > 0) {
            $aviso_privacidad = AvisoPrivacidadVisitante::first();
            $aviso_privacidad->update([
                'aviso_privacidad' => $request->aviso_privacidad,
            ]);
        } else {
            $aviso_privacidad = AvisoPrivacidadVisitante::create([
                'aviso_privacidad' => $request->aviso_privacidad,
            ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'Aviso de privacidad actualizado correctamente',
            'updated_at' => Carbon::parse($aviso_privacidad->updated_at)->format('d-m-Y H:i:s'),
            'aviso_privacidad' => $aviso_privacidad,
        ]);
    }
}
