<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organizacion;
use Illuminate\Http\Request;

class CertificadoController extends Controller
{
    public function index()
    {
        $org = Organizacion::first();

        return view('admin.escuela.admin.certificado-select', compact('org'));
    }

    public function selectCertificado(Request $request)
    {

        $org = Organizacion::first();

        $org->update([
            'certificado' => $request->certificado,
        ]);

        // dd($org);

        return back();
    }
}
