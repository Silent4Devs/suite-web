<?php

namespace App\Http\Controllers\Api\Tenant\Auth;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\TbTenantUserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class TbTenantAuthController extends TbTenantBaseController
{
    public function tbLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $tbCredentials = $request->only('email', 'password');

        $tbUser = TbTenantUserModel::where('email', $tbCredentials['email'])->first();

        if ($tbUser && Hash::check($tbCredentials['password'], $tbUser->password)) {

            $tbToken = $tbUser->createToken('auth_token', ['*'], now()->addHour())->plainTextToken;
            $tbData = [
                'user' => $tbUser,
                'token' => $tbToken,
                'expires_at' => now()->addHour(),
            ];

            return $this->tbSendResponse($tbData, 'Login correcto');
        }

        return $this->tbSendError('Credenciales inválidas', ['error' => 'Credenciales inválidas']);
    }

    public function tbLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->tbSendResponse([], 'Logged out successfully.');
    }
}
