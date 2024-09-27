<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AsistentService
{
    protected $client;

    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client;
        $this->baseUrl = 'http://192.168.9.77:8080'; // Definir URL base
    }

    /**
     * Enviar pregunta a la API de Python.
     */
    public function postQuestionToPythonAPI($question)
    {
        $url = $this->baseUrl.'/ask-question/';

        try {
            $response = $this->client->post($url, [
                'json' => ['user_question' => $question],
                'headers' => ['Content-Type' => 'application/json'],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'Request failed: '.$e->getMessage()];
        }
    }

    /**
     * Enviar archivo PDF a la API de Python.
     */
    public function postDataTextPythonAPI($filePath, $fileName)
    {
        $url = $this->baseUrl.'/text_to_chromadb/';

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
        } catch (RequestException $e) {
            return ['error' => 'Request failed: '.$e->getMessage()];
        }
    }

    /**
     * Enviar nombre de archivo a la API de Python.
     */
    public function postDataToPythonAPI($filename)
    {
        $url = $this->baseUrl."/save_name_files/archivos.txt/{$filename}";

        try {
            $response = $this->client->post($url);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'Request failed: '.$e->getMessage()];
        }
    }
}
