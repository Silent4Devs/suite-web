<?php

namespace App\Http\Controllers;

use App\Imports\AlcanceSgsiImport;
use App\Imports\AmenazaImport;
use App\Imports\AnalisisDeRiesgoImport;
use App\Imports\CategoriaActivoImport;
use App\Imports\CategoriaCapacitacionImport;
use App\Imports\CompetenciaImport;
use App\Imports\ComiteseguridadImport;
use App\Imports\ControlImport;
use App\Imports\EjecutarenlaceImport;
use App\Imports\EntendimientoOrganizacionImport;
use App\Imports\EstadoIncidenteImport;
use App\Imports\EvaluacionImport;
use App\Imports\FaqCategoriaImport;
use App\Imports\FaqPreguntaImport;
use App\Imports\MatrizRequisitoLegaleImport;
use App\Imports\PartesInteresadaImport;
use App\Imports\PuestoImport;
use App\Imports\PoliticaSgsiImport;
use App\Imports\RevisionDIreccionImport;
use App\Imports\TeamImport;
use App\Imports\UsuarioImport;
use App\Imports\VulnerabilidadImport;
use App\Imports\MinutasaltadireccionImport;
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

    public function AnalisisRiesgo()
    {
        Excel::import(new AnalisisDeRiesgoImport, request()->file('analisis_riego'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function PartesInteresadas()
    {
        Excel::import(new PartesInteresadaImport, request()->file('partes_interesadas'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function MatrizRequisitosLegales()
    {
        Excel::import(new MatrizRequisitoLegaleImport, request()->file('matriz_requisitos_legales'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Foda()
    {
        Excel::import(new EntendimientoOrganizacionImport, request()->file('foda'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function DeterminacionAlcance()
    {
        Excel::import(new AlcanceSgsiImport, request()->file('determinacion_alcance'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function ComiteSeguridad()
    {
        Excel::import(new ComiteseguridadImport, request()->file('comite_seguridad'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function AltaDireccion()
    {
        Excel::import(new MinutasaltadireccionImport, request()->file('alta_direccion'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function EvidenciaRecursos()
    {
        Excel::import(new EvidenciasSgsiImport, request()->file('evidencia_recursos'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function PoliticaSgsi()
    {
        Excel::import(new PoliticaSgsiImport, request()->file('politica_sgi'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }
}
