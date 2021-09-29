<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AmenazaImport;
use App\Imports\VulnerabilidadImport;
use App\Imports\UsuarioImport;
use App\Imports\PuestoImport;
use App\Imports\ControlImport;
use App\Imports\EjecutarenlaceImport;
use App\Imports\TeamImport;
use App\Imports\EstadoIncidenteImport;
use App\Imports\CompetenciaImport;
use App\Imports\EvaluacionImport;
use App\Imports\FodaImport;
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

    public function Usuario()
    {
        Excel::import(new UsuarioImport, request()->file('usuario'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Puesto()
    {
        Excel::import(new PuestoImport, request()->file('puesto'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function Control()
    {
        Excel::import(new ControlImport, request()->file('control'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function Ejecutarenlace()
    {
        Excel::import(new EjecutarenlaceImport, request()->file('ejecutarenlace'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function Team()
    {
        Excel::import(new TeamImport, request()->file('team'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function EstadoIncidente()
    {
        Excel::import(new EstadoIncidenteImport, request()->file('estadoincidente'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function Competencia()
    {
        Excel::import(new CompetenciaImport, request()->file('competencia'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function Evaluacion()
    {
        Excel::import(new EvaluacionImport, request()->file('evaluacion'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }

}
