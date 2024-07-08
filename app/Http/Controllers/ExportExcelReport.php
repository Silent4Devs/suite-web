<?php

namespace App\Http\Controllers;

use App\Services\ReportXlsxService;
use Illuminate\Support\Facades\Log;

class ExportExcelReport extends Controller
{
    private function exportReport($endpoint)
    {
        try {
            // Call the ReportXlsxService to consume the external API
            $apiResponse = ReportXlsxService::ReportConsumer($endpoint);

            if ($apiResponse['status'] == 500) {
                Log::error('Error occurred while exporting the report');

                alert()->error('Error', 'Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');

                return redirect()->back();
            } else {
                // Save the file on the user's desktop
                $filePath = public_path('reportfiles_tmp/'.$apiResponse['fileName']);
                file_put_contents($filePath, $apiResponse['body']);

                // Redirect to download the file
                return response()->download($filePath)->deleteFileAfterSend(true);
            }
        } catch (\Exception $e) {
            Log::error('Error en exportación de reporte: '.$e->getMessage());

            alert()->error('Error', 'Ocurrió un error al exportar el reporte. Por favor, inténtalo de nuevo más tarde.');

            return redirect()->back();
        }
    }

    public function Users()
    {
        return $this->exportReport('Users');
    }

    public function Puesto()
    {
        return $this->exportReport('moduloPuestos');
    }

    public function Roles()
    {
        return $this->exportReport('moduloRoles');
    }

    public function Soporte()
    {
        return $this->exportReport('soporte');
    }

    public function Empleado()
    {
        return $this->exportReport('moduloEmpleados');
    }

    public function Sede()
    {
        return $this->exportReport('moduloSedes');
    }

    public function NivelJerarquico()
    {
        return $this->exportReport('nivelesJerarquicos');
    }

    public function RegistroArea()
    {
        return $this->exportReport('registroAreas');
    }

    public function Macroproceso()
    {
        return $this->exportReport('macroProcesos');
    }

    public function Proceso()
    {
        return $this->exportReport('moduloProcesos');
    }

    public function TipoActivo()
    {
        return $this->exportReport('moduloTipoActivos');
    }

    public function InventarioActivos()
    {
        return $this->exportReport('inventarioActivos');
    }

    public function Glosarios()
    {
        return $this->exportReport('glosario');
    }

    public function CategoriasCapacitaciones()
    {
        return $this->exportReport('categoriasCapacitaciones');
    }

    // Esta funcion utiliza livewire
    public function VisualizarLogs()
    {
        return $this->exportReport('visualizarLogs');
    }

    public function SolicitudesDayOff()
    {
        return $this->exportReport('solicitudesDayOff');
    }

    public function SolicitudesVacaciones()
    {
        return $this->exportReport('solicitudesVacaciones');
    }

    public function Evaluaciones360()
    {
        return $this->exportReport('evaluaciones360');
    }
}
