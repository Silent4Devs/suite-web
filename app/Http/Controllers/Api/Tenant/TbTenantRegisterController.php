<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Actions\CreateTenantAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $data = $this->validateTenantData($request);

        $domain = $data['domain'];
        $data['password'] = Hash::make($data['password']);
        unset($data['domain']);

        try {
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
        } catch (\Exception $e) {
            \Log::error("Error en la creación del inquilino: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'No se pudo crear el inquilino',
                'error' => $e->getMessage()
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
            'domain' => 'required|string|unique:domains',
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenants',
            'password' => 'required|string|confirmed|max:255',
            'numero' => 'required|max:10',
            'cargo' => 'required|string',
            'sede' => 'required|string',
            'direccion' => 'required|string',
            'resumen' => 'required|string',
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