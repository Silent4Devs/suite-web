<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ImageService
{
    public static function consumeImageCompresorApi($file)
    {
        $api = env('GOSERVICES_API');
        // Endpoint where you want to send the file
        $apiEndpoint = $api.'/api/filesmanager/imagecompresor';

        // Ruta al archivo de imagen en tu sistema de archivos Laravel
        $rutaArchivo = $file->path();

        // Verifica si el archivo existe
        if (! file_exists($rutaArchivo)) {
            return response()->json(['error' => 'El archivo de imagen no existe'], 404);
        }

        // Hacer la solicitud HTTP con el archivo adjunto
        $response = Http::attach(
            'image', // Nombre del campo en el formulario
            file_get_contents($rutaArchivo), // Contenido del archivo
            $file->getClientOriginalName() // Nombre del archivo
        )->post($apiEndpoint);

        // Verificar si la solicitud fue exitosa y devolver la respuesta
        if ($response->successful()) {
            return [
                'status' => $response->status(),
                'response' => $response->json(),
                'body' => $response->body(),
            ];
        } else {
            return [
                'status' => $response->status(),
                'response' => $response->json(),
                'body' => $response->body(),
            ];
        }
    }
}
