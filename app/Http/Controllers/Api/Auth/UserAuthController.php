<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
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

        //Busca al usuario en la base de datos por email
        $user = User::select(['id', 'name', 'password', 'email', 'empleado_id', 'n_empleado'])
            ->where('email', request('email'))
            ->firstOrFail()
            ->makeHidden(['empleado', 'empleado_id', 'n_empleado', 'roles']);

        function encodeSpecialCharacters($url)
        {
            // Handle spaces
            // Encode other special characters, excluding /, \, and :
            $url = preg_replace_callback('/[^A-Za-z0-9_\-\.~\/\\\:]/', function ($matches) {
                return rawurlencode($matches[0]);
            }, $url);

            return $url;
        }

        if ($user->empleado->foto == null || $user->empleado->foto == '0') {
            if ($user->empleado->genero == 'H') {
                $ruta = asset('storage/empleados/imagenes/man.png');
            } elseif ($user->empleado->genero == 'M') {
                $ruta = asset('storage/empleados/imagenes/woman.png');
            } else {
                $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
            }
        } else {
            $ruta = asset('storage/empleados/imagenes/'.$user->empleado->foto);
        }

        // Encode spaces in the URL
        $user->ruta_foto = encodeSpecialCharacters($ruta);

        $user->idEmpleado = $user->empleado->id;

        $user->id_puesto = $user->empleado->puestoRelacionado->id;
        $user->nombre_puesto = $user->empleado->puesto;

        $user->id_area = $user->empleado->area->id;
        $user->nombre_area = $user->empleado->area->area;

        $supervisor = $user->empleado->es_supervisor;

        //Genera un nuevo token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'user' => $user->toArray(),
            'supervisor' => $supervisor,
        ]);
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
