<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\TbTenantBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbTenantProfileController extends TbTenantBaseController
{
    public function tbUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return $this->tbSendResponse($user, 'Profile updated successfully.');
    }
}
