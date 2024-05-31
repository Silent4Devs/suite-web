<?php

namespace App\Services;

use GuzzleHttp\Client;

class RequisicionService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function postDataToPythonAPI($filename)
    {
        // Define la URL del endpoint de la API de Python, incluyendo el nombre del archivo dinámico
        $url = "http://127.0.0.1:8000/save_name_files/archivos.txt/{$filename}";

        try {
            // Realiza la solicitud POST sin enviar datos en el cuerpo
            $response = $this->client->post($url);

            // Decodifica la respuesta JSON
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Maneja las excepciones según sea necesario
            return ['error' => $e->getMessage()];
        }
    }

    public function postDataLoadPythonAPI($path)
    {
        // Define la URL del endpoint de la API de Python, incluyendo el nombre del archivo dinámico
        $url = "http://127.0.0.1:8000/load_name_files/{$path}";

        try {
            // Realiza la solicitud POST sin enviar datos en el cuerpo
            $response = $this->client->post($url);

            // Decodifica la respuesta JSON
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Maneja las excepciones según sea necesario
            return ['error' => $e->getMessage()];
        }
    }

    public function postDataCleanPythonAPI($path)
    {
        // Define la URL del endpoint de la API de Python, incluyendo el nombre del archivo dinámico
        $url = "http://127.0.0.1:8000/clean_files/{$path}";

        try {
            // Realiza la solicitud POST sin enviar datos en el cuerpo
            $response = $this->client->post($url);

            // Decodifica la respuesta JSON
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Maneja las excepciones según sea necesario
            return ['error' => $e->getMessage()];
        }
    }

    public function postDataScanedPythonAPI($path)
    {
        // Define la URL del endpoint de la API de Python, incluyendo el nombre del archivo dinámico
        $url = "http://127.0.0.1:8000/is_scanned_pdf/{$path}";

        try {
            // Realiza la solicitud POST sin enviar datos en el cuerpo
            $response = $this->client->post($url);

            // Decodifica la respuesta JSON
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Maneja las excepciones según sea necesario
            return ['error' => $e->getMessage()];
        }
    }

    public function postDataExtractPythonAPI($image)
    {
        // Define la URL del endpoint de la API de Python, incluyendo el nombre del archivo dinámico
        $url = "http://127.0.0.1:8000/extract_text_from_image/{$image}";

        try {
            // Realiza la solicitud POST sin enviar datos en el cuerpo
            $response = $this->client->post($url);

            // Decodifica la respuesta JSON
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Maneja las excepciones según sea necesario
            return ['error' => $e->getMessage()];
        }
    }

    public function postDataTextPythonAPI()
    {
        $filePath = storage_path('app/public/requisicion.pdf');
        $fileName = 'requisicion.pdf';

        $url = 'http://127.0.0.1:8000/text_to_chromadb/';

        try {
            $response = $this->client->post($url, [
                'multipart' => [
                    [
                        'name' => 'pdf',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => $fileName,
                    ],
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
