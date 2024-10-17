<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

class LoginTenantController extends Controller
{
    public function show(): View
    {
        // $currentDatabase = DB::connection('tenant')->getDatabaseName();
        // dd($currentDatabase);
        return view('central.tenants.login');
    }

    public function submit(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'exists:tenants',
        ]);

        /** @var Tenant $tenant */
        $tenant = Tenant::where('email', $email = $request->post('email'))->firstOrFail();

        return redirect(
            $tenant->route('tenant.login', ['email' => $email]),
        );
    }
}