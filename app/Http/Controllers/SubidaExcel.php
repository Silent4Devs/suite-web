<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AmenazaImport;
use App\Imports\VulnerabilidadImport;
use App\Imports\UsuarioImport;
use Maatwebsite\Excel\Facades\Excel;

class SubidaExcel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Amenaza()
    {
        Excel::import(new AmenazaImport, request()->file('archivo'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Vulnerabilidad()
    {
        Excel::import(new VulnerabilidadImport, request()->file('vulnerabilidad'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Usuarios()
    {
        Excel::import(new UsuarioImport, request()->file('usuario'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Puesto()
    {
        Excel::import(new PuestoImport, request()->file('puesto'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }


}
