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

        // Aquí puedes definir los datos que deseas enviar en el cuerpo de la solicitud POST
        $postData = [
            'key1' => 'value1',
            'key2' => 'value2',
            // Añade más datos según tus necesidades
        ];

        try {
            // Realiza la solicitud POST
            $response = $this->client->post($url, [
                'json' => $postData, // Envía los datos como JSON
            ]);

            // Decodifica la respuesta JSON
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Maneja las excepciones según sea necesario
            return ['error' => $e->getMessage()];
        }
    }
}
