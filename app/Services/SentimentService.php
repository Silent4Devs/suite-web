<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SentimentService
{
    public static function analyzeSentiment($text)
    {
        $api = env('REPORTSERVICES_API'); // Asegúrate de que esta variable esté correctamente definida en tu .env
        $apiEndpoint = $api.'/sentimentAnalysis/'; // Cambia la ruta según la API que estés utilizando

        $texts = is_array($text) ? $text : [$text];

        // Enviar el texto en el formato que espera la API
        $response = Http::post($apiEndpoint, [
            'texts' => $texts, // Enviar como un array bajo la clave 'texts'
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            return [
                'status' => $response->status(),
                'error' => $response->json(),
                'body' => $response->body(),
            ];
        }
    }
}
