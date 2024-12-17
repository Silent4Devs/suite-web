<?php

namespace App\Http\Controllers\Api\Tenant\Auth;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\TbTenantUserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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

        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid access credentials',
            ], 401);
        }

        $user = TbTenantUserModel::select(['id', 'name', 'password', 'email'])
            ->where('email', request('email'))
            ->firstOrFail()
            ->makeHidden(['empleado', 'empleado_id', 'n_empleado', 'roles']);

        $token = $user->createToken('auth_token')->plainTextToken;

        $expiration = Carbon::now()->addMinutes(config('sanctum.expiration'))->timestamp;

        Cache::put($this->tokenCachePrefix . $token, [
            'user_id' => $user->id,
            'expiration' => $expiration,
        ], config('sanctum.expiration') * 60);

        return response()->json([
            'access_token' => $token,
            'user' => $user->toArray(),
            'expiration' => $expiration,
        ]);
    }

    public function tbLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->tbSendResponse([], 'Logged out successfully.');
    }
}