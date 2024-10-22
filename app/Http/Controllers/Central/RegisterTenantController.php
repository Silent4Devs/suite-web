<?php

namespace App\Http\Controllers\Central;

use App\Actions\CreateTenantAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterTenantController extends Controller
{
    public function show(): View
    {
        return view('central.tenants.register');
    }

    public function submit(Request $request): RedirectResponse
    {
        $data = $this->validate($request, [
            'domain' => 'required|string|unique:domains',
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenants',
            'password' => 'required|string|confirmed|max:255',
        ]);

        $data['password'] = bcrypt($data['password']);

        $domain = $data['domain'];
        unset($data['domain']);

        // $tenant = (new CreateTenantAction)($data, $domain);

        $route = 'admin.inicio-Usuario.index'; // La ruta que quieres usar


        // Construir la URL completa con el subdominio
        $fullUrl = sprintf('%s://%s.%s', request()->getScheme(), $domain, 'localhost');

        // Obtener la URL de la ruta sin el dominio
        $routeUrl = route($route);

        // Asegurarse de que la URL de la ruta no contenga el esquema completo
        $routeUrlPath = parse_url($routeUrl, PHP_URL_PATH);

        // Concatenar la URL final
        $finalUrl = $fullUrl . $routeUrlPath;

        // Redirigir a la URL final
        return redirect($finalUrl)->with('success', 'Inquilino Generado');

        // We impersonate user with id 1. This user will be created by the CreateTenantAdmin job.
        // return redirect($tenant->impersonationUrl(1));
    }
}
