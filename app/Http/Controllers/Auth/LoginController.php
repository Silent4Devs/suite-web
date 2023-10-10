<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LockedPlanTrabajo;
use App\Notifications\TwoFactorCodeNotification;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Svg\Tag\Path;

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
        logout as performLogout;
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

    public function redirectTo()
    {
        if (auth()->user()->is_admin) {
            // $numero_bloqueo = LockedPlanTrabajo::count();
            // if ($numero_bloqueo == 1) {
            //     $bloqueo = LockedPlanTrabajo::first();
            //     if (intval($bloqueo->blocked) == 1 && intval($bloqueo->locked_by) == auth()->user()->id) {
            //         $bloqueo->update([
            //             'locked_to' => Carbon::now(),
            //             'blocked' => '0',
            //             'locked_by' => 0,
            //         ]);
            //     }
            // }

            return '/admin/inicioUsuario#datos';

        }

        return '/admin/inicioUsuario#datos';
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->two_factor) {
            $user->generateTwoFactorCode();
            $user->notify(new TwoFactorCodeNotification());
        }
    }

    public function logout(Request $request)
    {
        // $numero_bloqueo = LockedPlanTrabajo::count();
        // if ($numero_bloqueo == 1) {
        //     $bloqueo = LockedPlanTrabajo::first();
        //     if (intval($bloqueo->blocked) == 1 && intval($bloqueo->locked_by) == auth()->user()->id) {
        //         $bloqueo->update([
        //             'locked_to' => Carbon::now(),
        //             'blocked' => '0',
        //             'locked_by' => 0,
        //         ]);
        //     }
        // }
        $this->performLogout($request);

        return redirect('/');
    }
}
