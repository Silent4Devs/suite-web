<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Actions\CreateTenantAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class TbTenantRegisterController extends Controller
{
    /**
     * Procesa la solicitud de registro de un nuevo inquilino.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function submit(Request $request): JsonResponse
    {
        try {
            $data = $this->validateTenantData($request);

            $domain = $data['domain'];
            $data['password'] = Hash::make($data['password']);
            unset($data['domain']);

            // Crear el inquilino
            $tenant = (new CreateTenantAction)($data, $domain);

            // Generar la URL completa del tenant
            $tenantUrl = $this->generateTenantUrl($domain, 'admin.inicio-Usuario.index');

            return response()->json([
                'success' => true,
                'message' => 'Inquilino generado correctamente',
                'tenant_id' => $tenant->id,
                'tenant_url' => $tenantUrl
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Datos de validación incorrectos',
                'errors' => $e->errors(),
            ], 422);

        } catch (QueryException $e) {
            if ($e->getCode() === '23000') { // Código para errores de constraint en bases de datos
                return response()->json([
                    'success' => false,
                    'message' => 'Los datos ya existen. Verifique los campos únicos.',
                    'error' => $e->getMessage(),
                ], 409);
            }

            return response()->json([
                'success' => false,
                'message' => 'Error en la base de datos',
                'error' => $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            \Log::error("Error en la creación del inquilino: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'No se pudo crear el inquilino',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Valida los datos del formulario de registro.
     *
     * @param Request $request
     * @return array
     */
    protected function validateTenantData(Request $request): array
    {
        return $request->validate([
            'domain' => [
                'required',
                'string',
                'unique:domains',
                'regex:/^[a-zA-Z0-9-]+$/', // Solo permite letras, números y guiones
                'max:50'
            ],
            'company' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s.,]+$/' // Permite letras, números, espacios, puntos y comas
            ],
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            'email' => 'required|email|max:255|unique:tenants',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8', // Longitud mínima de 8 caracteres
                'max:255',
                'regex:/[A-Z]/', // Al menos una letra mayúscula
                'regex:/[a-z]/', // Al menos una letra minúscula
                'regex:/[0-9]/', // Al menos un número
                'regex:/[@$!%*?&]/' // Al menos un carácter especial
            ],
            'numero' => 'required|string|digits_between:8,10|regex:/^[0-9]+$/', // Solo números
            'cargo' => 'required|string|max:100',
            'sede' => 'required|string|max:150',
            'direccion' => 'required|string|max:255',
            'resumen' => 'required|string|min:10|max:500', // Longitud mínima y máxima
        ]);
    }

    /**
     * Genera la URL de redirección para el dominio del inquilino.
     *
     * @param string $domain
     * @param string $routeName
     * @return string
     */
    protected function generateTenantUrl(string $domain, string $routeName): string
    {
        $scheme = request()->getScheme();
        $fullDomainUrl = sprintf('%s://%s.%s', $scheme, $domain, 'suite-web.test');
        $routePath = parse_url(route($routeName), PHP_URL_PATH);

        return $fullDomainUrl . $routePath;
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
//     "numero": "1234567890",
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
