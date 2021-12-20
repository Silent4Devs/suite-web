<?php

namespace App\Http\Controllers;

use App\Exports\AmenazaExport as ExportsAmenazaExport;
use App\Imports\AmenazaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
// use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
// use App\Http\Controllers\Response;
use Response;

class ExportExcel extends Controller
{
    public function Amenaza()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
        // return Excel::download(new ExportsAmenazaExport, 'Amenaza.xlsx');
    }
    public function Vulnerabilidad()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
    }
    public function AnalisisRiesgo()
    {
        $path = storage_path('app/public/exportExcel/analisis_riesgo.xlsx');
        return response()->download($path);
    }
    public function PartesInteresadas()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
    }
    public function MatrizRequisitosLegales()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
    }
    public function Foda()
    {
        $path = storage_path('app/public/exportExcel/foda.xlsx');
        return response()->download($path);
    }
    public function DeterminacionAlcance()
    {
        $path = storage_path('app/public/exportExcel/determinacionAlcance.xlsx');
        return response()->download($path);
    }
    public function ComiteSeguridad()
    {
        $path = storage_path('app/public/exportExcel/comite_seguridad.xlsx');
        return response()->download($path);
    }
    public function PoliticaSgsi()
    {
        $path = storage_path('app/public/exportExcel/politica_sgsi.xlsx');
        return response()->download($path);
    }
    public function AltaDireccion()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
    }
    public function CategoriaCapacitacion()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
    }
    public function RevisionDireccion()
    {
        $path = storage_path('app/public/exportExcel/revision_direccion.xlsx');
        return response()->download($path);
    }
    public function CategoriaActivo()
    {
        $path = storage_path('app/public/exportExcel/categoriaActivo.xlsx');
        return response()->download($path);
    }
    public function Puesto()
    {
        $path = storage_path('app/public/exportExcel/puestos.xlsx');
        return response()->download($path);
    }
    public function GrupoArea()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
    }
    public function Empleado()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
    }
    public function Activos()
    {
        $path = storage_path('app/public/exportExcel/users.xlsx');
        return response()->download($path);
    }
}

