<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class TbLoginController extends Controller
{
    public function login(Request $request)
    {
        // dd(1, $request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //valida las credenciales del usuario
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid access credentials',
            ], 401);
        }

        $user = Auth::user();

        function encodeSpecialCharacters($url)
        {
            // Handle spaces
            // Encode other special characters, excluding /, \, and :
            $url = preg_replace_callback('/[^A-Za-z0-9_\-\.~\/\\\:]/', function ($matches) {
                return rawurlencode($matches[0]);
            }, $url);

            return $url;
        }

        $permissionsArray = Cache::remember('permissions_array', now()->addMinutes(60), function () {
            $roles = Role::getAll();
            $permissionsArray = [];
            foreach ($roles as $role) {
                foreach ($role->permissions as $permission) {
                    $permissionsArray[$permission->title][] = $role->id;
                }
            }

            return $permissionsArray;
        });

        // Define gates for each permission
        foreach ($permissionsArray as $title => $roles) {
            Gate::define($title, function ($user) use ($roles) {
                // Check if user has any of the roles associated with this permission
                return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
            });
        }

        return redirect(route('admin.portal-comunicacion.index'));

    }

    public function logout()
    {
        // Invalida la sesión actual y regenera el token CSRF
        Auth::logout();

        // Redirecciona al usuario después del logout
        return redirect(route('users.login'));
    }
}
