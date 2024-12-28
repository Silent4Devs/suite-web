<?php

namespace App\Http\Controllers\Api\Tenant\Auth;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Models\Tenant\TbTenantsModel;
use App\Models\Tenant\TbTenantUserImpersonationTokensModel;
use App\Models\Tenant\TbTenantUserModel;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class TbTenantAuthController extends TbTenantBaseController
{
    protected $tbTenantManager;

    protected $tbStripeService;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
    }

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

            $tbUserToken = TbTenantUserImpersonationTokensModel::updateOrCreate(
                [
                    'tenant_id' => "1",
                    'user_id' => $tbUser->id,
                ],
                [
                    'token' => $tbToken,
                    'auth_guard' => "test_data",
                    'redirect_url' => 'www.suite-web.test',
                ]
            );

            $tbTenant = $tbUser->tenant()->where('email', $tbUser->email)->first();

            $tbUserProfile = $this->tbStripeService->tbGetCustomerById($tbTenant->stripe_id);

            $tbData = [
                'user' => $tbUser,
                'userToken' => $tbUserToken,
                'userProfile' => $tbUserProfile,
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
