<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\TbTenantBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class TbTenantAuthController extends TbTenantBaseController
{
    public function tbLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return $this->tbSendResponse(['token' => $token], 'Login successful.');
        }

        return $this->tbSendError('Unauthorized.', ['error' => 'Invalid credentials']);
    }

    public function tbLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->tbSendResponse([], 'Logged out successfully.');
    }
}
