<?php

namespace App\Http\Controllers\Central;

use App\Actions\CreateTenantAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class RegisterTenantController extends Controller
{
    /**
     * Muestra el formulario de registro del inquilino.
     *
     * @return View
     */
    public function show(): View
    {
        return view('central.tenants.register');
    }

    /**
     * Procesa la solicitud de registro de un nuevo inquilino.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function submit(Request $request): RedirectResponse
    {
        $data = $this->validateTenantData($request);

        $domain = $data['domain'];
        $data['password'] = Hash::make($data['password']);  // Encriptar contraseña
        unset($data['domain']);  // Eliminar el dominio de los datos del inquilino

        // Crear el inquilino
        $tenant = (new CreateTenantAction)($data, $domain);

        // Generar la URL de redirección
        $finalUrl = $this->generateTenantUrl($domain, 'admin.inicio-Usuario.index');

        return redirect($finalUrl)->with('success', 'Inquilino Generado');
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
