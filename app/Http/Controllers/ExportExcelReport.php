<?php

namespace App\Http\Controllers;

use App\Services\ReportXlsxService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AmenazaExport as ExportsAmenazaExport;

// use App\Http\Controllers\Storage;
// use App\Http\Controllers\Response;

class ExportExcelReport extends Controller
{
    public function ConsumeTemplate($endpoint){
        try {
            // Call the ImageService to consume the external API
            $apiResponse = ReportXlsxService::ReportConsumer($endpoint);

            if($apiResponse['status'] == 500){
                dd("asd");
                   alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
            }else{
                // Guardar el archivo en el escritorio del usuario
                file_put_contents(public_path('reportfiles_tmp/'.$apiResponse['fileName']), $apiResponse['body']);

                // Redirigir para descargar el archivo
                return response()->download(public_path('reportfiles_tmp/'.$apiResponse['fileName']))->deleteFileAfterSend(true);
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
            \Log::error('Error en exportación de reporte de empleados y puestos: '.$e->getMessage());

            alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
        }
    }
    public function Amenaza()
    {
        $path = storage_path('app/public/exportExcel/Amenaza.xlsx');

        return response()->download($path);
        // return Excel::download(new ExportsAmenazaExport, 'Amenaza.xlsx');
    }

    public function Vulnerabilidad()
    {
        $path = storage_path('app/public/exportExcel/Vulnerabilidad.xlsx');

        return response()->download($path);
    }

    public function AnalisisRiesgo()
    {
        $path = storage_path('app/public/exportExcel/analisis_riesgo.xlsx');

        return response()->download($path);
    }

    public function PartesInteresadas()
    {
        $path = storage_path('app/public/exportExcel/partes_interesadas.xlsx');

        return response()->download($path);
    }

    // public function MatrizRequisitosLegales()
    // {
    //     $path = storage_path('app/public/exportExcel/users.xlsx');

    //     return response()->download($path);
    // }

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
        $path = storage_path('app/public/exportExcel/minutas_alta_direccion.xlsx');

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

    public function Users()
    {
        try {
            // Call the ImageService to consume the external API
            $apiResponse = ReportXlsxService::ReportConsumer("Users");

            if($apiResponse['status'] == 500){
                   alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
            }else{
                // Guardar el archivo en el escritorio del usuario
                file_put_contents(public_path('reportfiles_tmp/'.$apiResponse['fileName']), $apiResponse['body']);

                // Redirigir para descargar el archivo
                return response()->download(public_path('reportfiles_tmp/'.$apiResponse['fileName']))->deleteFileAfterSend(true);
            }

        } catch (\Exception $e) {

            \Log::error('Error en exportación de reporte de empleados y puestos: '.$e->getMessage());

            alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    public function Puesto()
    {
        try {
            // Call the ImageService to consume the external API
            $apiResponse = ReportXlsxService::ReportConsumer("moduloPuestos");

            if($apiResponse['status'] == 500){
                   alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
            }else{
                // Guardar el archivo en el escritorio del usuario
                file_put_contents(public_path('reportfiles_tmp/'.$apiResponse['fileName']), $apiResponse['body']);

                // Redirigir para descargar el archivo
                return response()->download(public_path('reportfiles_tmp/'.$apiResponse['fileName']))->deleteFileAfterSend(true);
            }

        } catch (\Exception $e) {

            \Log::error('Error en exportación de reporte de empleados y puestos: '.$e->getMessage());

            alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
        }
        //$this->ConsumeTemplate("moduloPuestos");
    }

    public function Roles()
    {
        try {
            // Call the ImageService to consume the external API
            $apiResponse = ReportXlsxService::ReportConsumer("moduloRoles");

            if($apiResponse['status'] == 500){
                   alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
            }else{
                // Guardar el archivo en el escritorio del usuario
                file_put_contents(public_path('reportfiles_tmp/'.$apiResponse['fileName']), $apiResponse['body']);

                // Redirigir para descargar el archivo
                return response()->download(public_path('reportfiles_tmp/'.$apiResponse['fileName']))->deleteFileAfterSend(true);
            }

        } catch (\Exception $e) {

            \Log::error('Error en exportación de reporte de empleados y puestos: '.$e->getMessage());

            alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    public function Soporte()
    {
        try {
            // Call the ImageService to consume the external API
            $apiResponse = ReportXlsxService::ReportConsumer("soporte");

            if($apiResponse['status'] == 500){
                   alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
            }else{
                // Guardar el archivo en el escritorio del usuario
                file_put_contents(public_path('reportfiles_tmp/'.$apiResponse['fileName']), $apiResponse['body']);

                // Redirigir para descargar el archivo
                return response()->download(public_path('reportfiles_tmp/'.$apiResponse['fileName']))->deleteFileAfterSend(true);
            }

        } catch (\Exception $e) {

            \Log::error('Error en exportación de reporte de empleados y puestos: '.$e->getMessage());

            alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    public function GrupoArea()
    {
        $path = storage_path('app/public/exportExcel/grupo_areas.xlsx');

        return response()->download($path);
    }

    public function Empleado()
    {
        try {
            // Call the ImageService to consume the external API
            $apiResponse = ReportXlsxService::ReportConsumer("moduloEmpleados");

            if($apiResponse['status'] == 500){
                   alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
            }else{
                // Guardar el archivo en el escritorio del usuario
                file_put_contents(public_path('reportfiles_tmp/'.$apiResponse['fileName']), $apiResponse['body']);

                // Redirigir para descargar el archivo
                return response()->download(public_path('reportfiles_tmp/'.$apiResponse['fileName']))->deleteFileAfterSend(true);
            }

        } catch (\Exception $e) {

            \Log::error('Error en exportación de reporte de empleados y puestos: '.$e->getMessage());

            alert()->error('Error','Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    public function Activos()
    {
        $path = storage_path('app/public/exportExcel/Activos.xlsx');

        return response()->download($path);
    }
}