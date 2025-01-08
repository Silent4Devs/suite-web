<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Actions\Tenant\TBTenantCreateTenantAction;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TbtenantRegisterController extends Controller
{
    /**
     * Procesa la solicitud de registro de un nuevo inquilino.
     */
    public function submit(Request $request): JsonResponse
    {
        try {
            $tbData = $this->tbValidateTenantData($request);

            $tbDomain = $tbData['domain'];
            $tbData['password'] = Hash::make($tbData['password']);
            unset($tbData['domain']);
            // Crear el inquilino
            $tbTenant = (new TBTenantCreateTenantAction)($tbData, $tbDomain);

            // Generar la URL completa del tenant
            $tbTenantUrl = $this->tbGenerateTenantUrl($tbDomain, 'users.login');

            return $this->tbSuccessResponse('Inquilino generado correctamente', [
                'tenant_id' => $tbTenant->id,
                'tenant_url' => $tbTenantUrl,
            ], 201);
        } catch (ValidationException $e) {
            return $this->tbValidationErrorResponse($e);
        } catch (QueryException $e) {
            return $this->tbDatabaseErrorResponse($e);
        } catch (\Exception $e) {
            //Log::error("Error al crear inquilino: {$e->getMessage()}");

            return $this->tbErrorResponse('No se pudo crear el inquilino', $e->getMessage(), 500);
        }
    }

    /**
     * Valida los datos del formulario de registro.
     */
    protected function tbValidateTenantData(Request $request): array
    {
        return $request->validate([
            'domain' => [
                'required',
                'string',
                'unique:domains',
                'regex:/^[a-zA-Z0-9-]+$/',
                'max:50',
            ],
            'company' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s.,]+$/',
            ],
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255|unique:tenants',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'max:255',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'cargo' => 'required|string|max:100',
            'sede' => 'required|string|max:150',
            'direccion' => 'required|string|max:255',
            'resumen' => 'required|string|min:10|max:500',
            'userId' => 'required|integer',
        ]);
    }

    /**
     * Genera la URL de redirección para el dominio del inquilino.
     */
    protected function tbGenerateTenantUrl(string $tbDomain, string $tbRouteName): string
    {
        $tbScheme = request()->getScheme();
        $tbBaseDomain = config('app.tenant_base_domain', 'suite-web.test');
        $tbRoutePath = parse_url(route($tbRouteName), PHP_URL_PATH);

        return sprintf('%s://%s.%s%s', $tbScheme, $tbDomain, $tbBaseDomain, $tbRoutePath);
    }

    /**
     * Genera una respuesta JSON de éxito.
     */
    private function tbSuccessResponse(string $tbMessage, array $tbData = [], int $tbStatus = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $tbMessage,
            'data' => $tbData,
        ], $tbStatus);
    }

    /**
     * Genera una respuesta JSON para errores de validación.
     */
    private function tbValidationErrorResponse(ValidationException $tbException): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Datos de validación incorrectos',
            'errors' => $tbException->errors(),
        ], 422);
    }

    /**
     * Genera una respuesta JSON para errores de base de datos.
     */
    private function tbDatabaseErrorResponse(QueryException $tbException): JsonResponse
    {
        $tbMessage = $tbException->getCode() === '23000'
            ? 'Los datos ya existen. Verifique los campos únicos.'
            : 'Error en la base de datos';

        return $this->tbErrorResponse($tbMessage, $tbException->getMessage(), 500);
    }

    /**
     * Genera una respuesta JSON genérica para errores.
     */
    private function tbErrorResponse(string $tbMessage, ?string $tbError = null, int $tbStatus = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $tbMessage,
            'error' => $tbError,
        ], $tbStatus);
    }
}

/**
 * Peticion de ejemplo para la api.
 */

// {
//     "domain": "tenant123",
//     "company": "Mi Empresa",
//     "name": "John Doe",
//     "email": "johndoe@example.com",
//     "password": "securepassword",
//     "password_confirmation": "securepassword",
//     "cargo": "CEO",
//     "sede": "Sede Central",
//     "direccion": "123 Calle Falsa",
//     "resumen": "Este es un resumen de la empresa"
// }

// {
//     "success": true,
//     "message": "Inquilino generado correctamente",
//     "tenant_id": 1,
//     "tenant_url": "https://tenant123.suite-web.test/admin/inicio-Usuario/index"
// }
