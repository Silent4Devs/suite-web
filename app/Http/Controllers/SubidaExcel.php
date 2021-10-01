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
use App\Imports\CategoriaCapacitacionImport;
use App\Imports\RevisionDIreccionImport;
use App\Imports\CategoriaActivoImport;
use App\Imports\FaqCategoriaImport;
use App\Imports\FaqPreguntaImport;
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
    public function CategoriaCapacitacion()
    {
        Excel::import(new CategoriaCapacitacionImport, request()->file('categoriacapacitacion'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function RevisionDireccion()
    {
        Excel::import(new RevisionDIreccionImport, request()->file('revisiondireccion'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function CategoriaActivo()
    {
        Excel::import(new CategoriaActivoImport, request()->file('categoria'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function FaqCategoria()
    {
        Excel::import(new FaqCategoriaImport, request()->file('faqcategoria'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }
    public function FaqPregunta()
    {
        Excel::import(new FaqPreguntaImport, request()->file('faqpregunta'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }

}
