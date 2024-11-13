<?php

namespace App\Http\Controllers\Admin\Escuela\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Escuela\Course;
use App\Models\Organizacion;

class CertificadoController extends Controller
{
    public function index()
    {
        $org = Organizacion::first();

        return view('admin.escuela.admin.certificado-select', compact('org'));
    }

    public function selectCertificado(Request $request){

        $org = Organizacion::first();

        $org->update([
            'certificado'=>$request->certificado,
        ]);

        // dd($org);

        return back();
    }
}
