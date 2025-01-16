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

        dd($user);
        //Busca al usuario en la base de datos por email
        // $user = User::select(['id', 'name', 'password', 'email', 'empleado_id', 'n_empleado'])
        //     ->where('email', request('email'))
        //     ->firstOrFail()
        //     ->makeHidden(['empleado', 'empleado_id', 'n_empleado', 'roles']);

        function encodeSpecialCharacters($url)
        {
            // Handle spaces
            // Encode other special characters, excluding /, \, and :
            $url = preg_replace_callback('/[^A-Za-z0-9_\-\.~\/\\\:]/', function ($matches) {
                return rawurlencode($matches[0]);
            }, $url);

            return $url;
        }

        if ($user) {
            // dd(3, $user, User::getCurrentUser());
            // Cache roles and permissions to minimize database queries
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

            // return redirect(route('admin.inicio-Usuario.index'));
        }

        // if ($user->empleado->foto == null || $user->empleado->foto == '0') {
        //     if ($user->empleado->genero == 'H') {
        //         $ruta = asset('storage/empleados/imagenes/man.png');
        //     } elseif ($user->empleado->genero == 'M') {
        //         $ruta = asset('storage/empleados/imagenes/woman.png');
        //     } else {
        //         $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
        //     }
        // } else {
        //     $ruta = asset('storage/empleados/imagenes/'.$user->empleado->foto);
        // }

        // // Encode spaces in the URL
        // $user->ruta_foto = encodeSpecialCharacters($ruta);

        // $user->idEmpleado = $user->empleado->id;

        // $user->id_puesto = $user->empleado->puestoRelacionado->id;
        // $user->nombre_puesto = $user->empleado->puesto;

        // $user->id_area = $user->empleado->area->id;
        // $user->nombre_area = $user->empleado->area->area;

        // $supervisor = $user->empleado->es_supervisor;

        // //Genera un nuevo token para el usuario
        // $token = $user->createToken('auth_token')->plainTextToken;

        // $expiration = Carbon::now()->addMinutes(config('sanctum.expiration'))->timestamp;

        // // Store token in Redis with expiration
        // Cache::put($this->tokenCachePrefix.$token, [
        //     'user_id' => $user->id,
        //     'expiration' => $expiration,
        // ], config('sanctum.expiration') * 60); // store in seconds

        // //devuelve una respuesta JSON con el token generado y el tipo de token
        // return response()->json([
        //     'access_token' => $token,
        //     'user' => $user->toArray(),
        //     'supervisor' => $supervisor,
        //     'expiration' => $expiration,
        // ]);
    }

    public function getUser(){
        $user =  User::getCurrentUser();

        return $user;
    }

    public function logout()
    {
        $token = request()->bearerToken();

        if (! $token) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Token not provided',
                'data' => null,
            ], 400);
        }

        // Remove token from Redis
        Cache::forget($this->tokenCachePrefix.$token);

        /** @var PersonalAccessToken $model */
        $model = Sanctum::$personalAccessTokenModel;

        $accessToken = $model::findToken($token);
        $accessToken->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Hasta la proxima',
            'data' => null,
        ], 200);
    }
}
