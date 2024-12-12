<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

class TbTenantBaseController extends Controller
{
    /**
     * tbSendResponse
     *
     * Envía una respuesta JSON exitosa con datos y un mensaje.
     *
     * @param mixed $result Datos a incluir en la respuesta.
     * @param string $message Mensaje descriptivo de la operación.
     * @param int $status Código HTTP (por defecto 200).
     * @return JsonResponse Respuesta JSON formateada.
     */
    protected function tbSendResponse($result, $message, $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $result,
            'message' => $message,
        ], $status);
    }

    /**
     * tbSendError
     *
     * Envía una respuesta JSON de error con un mensaje y opcionalmente datos adicionales.
     *
     * @param string $error Mensaje de error principal.
     * @param array $errorMessages Lista de mensajes de error adicionales (opcional).
     * @param int $status Código HTTP (por defecto 400).
     * @return JsonResponse Respuesta JSON formateada.
     */
    protected function tbSendError($error, $errorMessages = [], $status = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $status);
    }
}
