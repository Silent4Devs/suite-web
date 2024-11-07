<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationSettingsController extends Controller
{
    public function show(): View
    {
        return view('tenant.settings.application');
    }

    public function storeConfiguration(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'company' => 'required|string|max:255',
        ]);

        tenant()->update($validated);

        return redirect()->back()->with('success', 'Configuration updated.');
    }
}
