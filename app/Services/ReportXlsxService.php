<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ReportXlsxService
{
    // Ejemplo de uso para ReportCustomerPost
    /*$attributes = [
       'attribute1' => 'value1',
       'attribute2' => 'value2',
       // Agrega aquí los atributos dinámicos que necesites enviar en la solicitud POST
];

$result = ReportXlsxService::ReportCustomerPost('endpoint_post', $attributes);

// Ejemplo de uso para ReportConsumer
$result = ReportXlsxService::ReportConsumer('endpoint_get');*/

    //idea
    public static function ReportCustomerPost($endpoint, $data)
    {

        $apiEndpoint = env('REPORTSERVICE_API');
        $response = Http::post($apiEndpoint.'/registrosTimesheet/');
        if ($response->successful()) {
            $currentDate = Carbon::now()->format('Y-m-d');
            $fileName = $endpoint.'-'.$currentDate.'.xlsx';

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

    //default
    public static function ReportConsumer($Endpoint)
    {
        $apiEndpoint = env('REPORTSERVICE_API');
        // Endpoint where you want to send the file

        $response = Http::get($apiEndpoint.'/'.$Endpoint);

        if ($response->successful()) {

            $currentDate = Carbon::now()->format('Y-m-d');

            // Nombre del archivo que deseas en el escritorio del usuario
            $fileName = $Endpoint.'-'.$currentDate.'.xlsx';

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
