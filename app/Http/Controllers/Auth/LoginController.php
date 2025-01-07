<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCodeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        guard as protected baseGuard;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::MIPERFIL;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        // Usa el guard del tenant
        return Auth::guard('tenants');
    }

    public function redirectTo()
    {
        if (auth()->user()->is_admin) {
            return '/admin/portal-comunicacion';
        }

        return '/admin/portal-comunicacion';
    }

    protected function authenticated(Request $request, $user)
    {
        $tenant = $user->tenant;
        if ($user->two_factor) {
            $user->generateTwoFactorCode();
            $user->notify(new TwoFactorCodeNotification);
        }
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);

        return redirect('/');
    }
}
