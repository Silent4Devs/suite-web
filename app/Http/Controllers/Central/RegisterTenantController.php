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
            'numero' => 'required|max:10',
            'cargo' => 'required|string',
            'sede' => 'required|string',
            'direccion' => 'required|string',
            'resumen' => 'required|string',
        ]);

        $data['password'] = bcrypt($data['password']);

        $domain = $data['domain'];
        unset($data['domain']);

        $tenant = (new CreateTenantAction)($data, $domain);

        $route = 'admin.inicio-Usuario.index';

        $fullUrl = sprintf('%s://%s.%s', request()->getScheme(), $domain, 'suite-web.test');

        $routeUrl = route($route);

        $routeUrlPath = parse_url($routeUrl, PHP_URL_PATH);

        $finalUrl = $fullUrl . $routeUrlPath;

        return redirect($finalUrl)->with('success', 'Inquilino Generado');
    }
}
