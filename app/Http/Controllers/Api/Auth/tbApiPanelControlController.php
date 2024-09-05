<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class tbApiPanelControlController extends Controller
{
    public function getData()
    {
        // Realiza la solicitud a la API externa
        $response = Http::get('https://66d8dc314ad2f6b8ed52d80a.mockapi.io/example2');

        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            // Devuelve la respuesta en formato JSON
            return response()->json($response->json(), 200);
        }

        // Maneja los errores de la solicitud
        return response()->json([
            'message' => 'Error al obtener los datos de la API externa',
            'status' => $response->status(),
            'error' => $response->body(),
        ], $response->status());
    }
}
