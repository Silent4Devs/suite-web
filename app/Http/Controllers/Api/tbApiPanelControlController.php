<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class tbApiPanelControlController extends Controller
{

    public function getData()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://192.168.9.113/api/onPremise/clientes");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);

        $jsonData = json_decode($response, true); // true para array asociativo

        if (curl_errno($ch)) {
            // dd('Error de cURL: ' . curl_error($ch));
            return response()->json([
                'message' => 'Error al obtener los datos de la API externa',
                'status' => $response->status(),
                'error' => $response->body(),
            ], $response->status());
        } else {
            // if ($response->successful()) {
            //     // Devuelve la respuesta en formato JSON
            //     return response()->json($response->json(), 200);
            // }
            return response()->json($jsonData, 200);
            // dd('Respuesta: ' . $response);
        }
        curl_close($ch);
    }

    // public function getData()
    // {
    //     // Realiza la solicitud a la API externa
    //     // $response = Http::get('https://66d8dc314ad2f6b8ed52d80a.mockapi.io/example2');
    //     $response = Http::get('http://192.168.9.113/api/onPremise/clientes');

    //     // Verifica si la solicitud fue exitosa
    //     if ($response->successful()) {
    //         // Devuelve la respuesta en formato JSON
    //         return response()->json($response->json(), 200);
    //     }

    //     // Maneja los errores de la solicitud
    //     return response()->json([
    //         'message' => 'Error al obtener los datos de la API externa',
    //         'status' => $response->status(),
    //         'error' => $response->body(),
    //     ], $response->status());
    // }
}
