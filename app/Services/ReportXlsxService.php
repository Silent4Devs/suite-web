<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ReportXlsxService
{
    public static function ReportEmpleadosPuestos($Endpoint)
    {
        $apiEndpoint = env('REPORTSERVICE_API');
        // Endpoint where you want to send the file

        $response = Http::get($apiEndpoint."/".$Endpoint);

        if ($response->successful()) {

            $currentDate = Carbon::now()->format('Y-m-d');

            // Nombre del archivo que deseas en el escritorio del usuario
            $fileName = $Endpoint . $currentDate . '.xlsx';

            return [
                'status' => $response->status(),
                'fileName' => $fileName,
                'response' => $response->json(),
                'body' => $response->body(),
            ];
        } else {
            return [
                'status' => $response->status(),
                'fileName' => 'fileerror.xlsx',
                'response' => $response->json(),
                'body' => $response->body(),
            ];
        }

    }

}
