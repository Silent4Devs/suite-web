<?php

namespace App\Http\Controllers;

use App\Imports\ActivoImport;
use App\Imports\AlcanceSgsiImport;
use App\Imports\AmenazaImport;
use App\Imports\AnalisisDeRiesgoImport;
use App\Imports\CategoriaActivoImport;
use App\Imports\CategoriaCapacitacionImport;
use App\Imports\ComiteseguridadImport;
use App\Imports\CompetenciaImport;
use App\Imports\ControlImport;
use App\Imports\DatosAreaImport;
use App\Imports\EjecutarenlaceImport;
use App\Imports\EmpleadoImport;
use App\Imports\EntendimientoOrganizacionImport;
use App\Imports\EstadoIncidenteImport;
use App\Imports\EvaluacionImport;
use App\Imports\FaqCategoriaImport;
use App\Imports\FaqPreguntaImport;
use App\Imports\GrupoImport;
use App\Imports\MatrizRequisitoLegaleImport;
use App\Imports\MinutasaltadireccionImport;
use App\Imports\PartesInteresadaImport;
use App\Imports\PoliticaSgsiImport;
use App\Imports\PuestoImport;
use App\Imports\RevisionDIreccionImport;
use App\Imports\RolImport;
use App\Imports\TeamImport;
use App\Imports\UsuarioImport;
use App\Imports\VulnerabilidadImport;
use App\Models\Activo;
use App\Models\AlcanceSgsi;
use App\Models\Amenaza;
use App\Models\AnalisisDeRiesgo;
use App\Models\CategoriaCapacitacion;
use App\Models\Comiteseguridad;
use App\Models\Empleado;
use App\Models\EntendimientoOrganizacion;
use App\Models\EstadoIncidente;
use App\Models\Grupo;
use App\Models\MatrizRequisitoLegale;
use App\Models\Minutasaltadireccion;
use App\Models\PartesInteresada;
use App\Models\PoliticaSgsi;
use App\Models\Puesto;
use App\Models\RevisionDireccion;
use App\Models\Role;
use App\Models\Tipoactivo;
use App\Models\Vulnerabilidad;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubidaExcel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Amenaza(Request $request)
    {
        if ($request->eliminar == 'true') {
            Amenaza::truncate();
        }
        Excel::import(new AmenazaImport, request()->file('archivo'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Vulnerabilidad(Request $request)
    {
        if ($request->eliminar == 'true') {
            Vulnerabilidad::truncate();
        }
        Excel::import(new VulnerabilidadImport, request()->file('vulnerabilidad'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Usuario()
    {
        Excel::import(new UsuarioImport, request()->file('usuario'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Puesto(Request $request)
    {
        if ($request->eliminar == 'true') {
            Puesto::truncate();
        }
        Excel::import(new PuestoImport, request()->file('puesto'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

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

    public function EstadoIncidente(Request $request)
    {
        if ($request->eliminar == 'true') {
            EstadoIncidente::truncate();
        }
        Excel::import(new EstadoIncidenteImport, request()->file('estadoincidente'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Roles(Request $request)
    {
        if ($request->eliminar == 'true') {
            Role::truncate();
        }
        Excel::import(new RolImport, request()->file('role'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

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

    public function CategoriaCapacitacion(Request $request)
    {
        if ($request->eliminar == 'true') {
            CategoriaCapacitacion::truncate();
        }
        Excel::import(new CategoriaCapacitacionImport, request()->file('categoriacapacitacion'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function RevisionDireccion(Request $request)
    {
        if ($request->eliminar == 'true') {
            RevisionDireccion::truncate();
        }
        Excel::import(new RevisionDIreccionImport, request()->file('revisiondireccion'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function CategoriaActivo(Request $request)
    {
        if ($request->eliminar == 'true') {
            Tipoactivo::truncate();
        }
        Excel::import(new CategoriaActivoImport, request()->file('categoria'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

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

    public function AnalisisRiesgo(Request $request)
    {
        if ($request->eliminar == 'true') {
            AnalisisDeRiesgo::truncate();
        }
        Excel::import(new AnalisisDeRiesgoImport, request()->file('analisis_riego'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function PartesInteresadas(Request $request)
    {
        if ($request->eliminar == 'true') {
            PartesInteresada::truncate();
        }
        Excel::import(new PartesInteresadaImport, request()->file('partes_interesadas'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function MatrizRequisitosLegales(Request $request)
    {
        if ($request->eliminar == 'true') {
            MatrizRequisitoLegale::truncate();
        }
        Excel::import(new MatrizRequisitoLegaleImport, request()->file('matriz_requisitos_legales'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Foda(Request $request)
    {
        if ($request->eliminar == 'true') {
            EntendimientoOrganizacion::truncate();
        }
        Excel::import(new EntendimientoOrganizacionImport, request()->file('foda'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function DeterminacionAlcance(Request $request)
    {
        if ($request->eliminar == 'true') {
            AlcanceSgsi::truncate();
        }
        Excel::import(new AlcanceSgsiImport, request()->file('determinacion_alcance'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function ComiteSeguridad(Request $request)
    {
        if ($request->eliminar == 'true') {
            Comiteseguridad::truncate();
        }
        Excel::import(new ComiteseguridadImport, request()->file('comite_seguridad'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function AltaDireccion(Request $request)
    {
        if ($request->eliminar == 'true') {
            Minutasaltadireccion::truncate();
        }
        Excel::import(new MinutasaltadireccionImport, request()->file('alta_direccion'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function EvidenciaRecursos()
    {
        Excel::import(new EvidenciasSgsiImport, request()->file('evidencia_recursos'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function PoliticaSgsi(Request $request)
    {
        if ($request->eliminar == 'true') {
            PoliticaSgsi::truncate();
        }
        Excel::import(new PoliticaSgsiImport, request()->file('politica_sgi'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function GrupoArea(Request $request)
    {
        if ($request->eliminar == 'true') {
            Grupo::truncate();
        }
        Excel::import(new GrupoImport, request()->file('grupo_area'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function DatosArea()
    {
        Excel::import(new DatosAreaImport, request()->file('datos_area'));

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Activos(Request $request)
    {
        if ($request->eliminar == 'true') {
            Activo::truncate();
        }
        Excel::import(new ActivoImport, request()->file('activo_inventario'));
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }

    public function Empleado(Request $request)
    {
        if ($request->eliminar == 'true') {
            Empleado::truncate();
        }
        // Excel::import(new EmpleadoImport, request()->file('empleado'));
        $file = $request->file('empleado');
        (new EmpleadoImport)->import($file);
        if ($request->tipo == 'tabla') {
            return response()->json(['status' => 'success', 'message' => 'Datos importados con éxito']);
        }

        return redirect('CargaDocs')->with('success', 'All good!');
    }
}
