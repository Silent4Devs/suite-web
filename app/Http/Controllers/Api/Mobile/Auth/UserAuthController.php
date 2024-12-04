<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class UserAuthController extends Controller
{
    protected $tokenCachePrefix = 'AuthMovil:user_token_';

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

        // $user = User::with(['empleado.puestoRelacionado', 'empleado.area'])
        //     ->select(['id', 'name', 'email'])
        //     ->where('email', $request->email)
        //     ->firstOrFail();

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
            $ruta = asset('storage/empleados/imagenes/' . $user->empleado->foto);
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

        $expiration = Carbon::now()->addMinutes(config('sanctum.expiration'))->timestamp;

        // Store token in Redis with expiration
        Cache::put($this->tokenCachePrefix . $token, [
            'user_id' => $user->id,
            'expiration' => $expiration,
        ], config('sanctum.expiration') * 60); // store in seconds

        //devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'user' => $user->toArray(),
            'supervisor' => $supervisor,
            'expiration' => $expiration,
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

        // Remove token from Redis
        Cache::forget($this->tokenCachePrefix . $token);

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

    public function checkToken(Request $request)
    {
        // Obtener el token de la solicitud
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json(['status' => 'error', 'message' => 'No token provided'], 400);
        }

        // First check Redis for the token
        $cachedToken = Cache::get($this->tokenCachePrefix . $token);

        if ($cachedToken) {
            if (Carbon::now()->timestamp < $cachedToken['expiration']) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Token is valid',
                ], 200);
            } else {
                // Token expired, remove from Redis
                Cache::forget($this->tokenCachePrefix . $token);
            }
        }

        // Verificar si el token existe y sigue siendo válido
        $tokenInstance = PersonalAccessToken::findToken($token);

        if ($tokenInstance && ! $tokenInstance->isExpired()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Token is valid',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is invalid or expired',
            ], 500);
        }
    }

    public function refreshToken(Request $request)
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token not provided',
            ], 400);
        }

        // Check Redis cache first
        $cachedToken = Cache::get($this->tokenCachePrefix . $token);

        if (! $cachedToken) {
            // Fall back to database check if not in Redis
            $tokenInstance = PersonalAccessToken::findToken($token);

            if (! $tokenInstance) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid token',
                ], 401);
            }

            $cachedToken = [
                'user_id' => $tokenInstance->tokenable->id,
                'expiration' => Carbon::now()->addMinutes(config('sanctum.expiration'))->timestamp,
            ];

            // Cache the token if valid
            Cache::put($this->tokenCachePrefix . $token, $cachedToken, config('sanctum.expiration') * 60);
        }

        $expirationTime = Carbon::createFromTimestamp($cachedToken['expiration']);

        // Check if the token has expired
        if (Carbon::now()->greaterThanOrEqualTo($expirationTime)) {
            // Token expired, generate a new token
            $user = User::find($cachedToken['user_id']);

            if (! $user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 401);
            }

            // Revoke old token (if from database)
            PersonalAccessToken::where('token', hash('sha256', $token))->delete();

            // Create a new token and store it in Redis
            $newToken = $user->createToken('auth_token')->plainTextToken;
            $newExpiration = Carbon::now()->addMinutes(config('sanctum.expiration'))->timestamp;

            Cache::put($this->tokenCachePrefix . $newToken, [
                'user_id' => $user->id,
                'expiration' => $newExpiration,
            ], config('sanctum.expiration') * 60);

            return response()->json([
                'status' => 'success',
                'message' => 'Token refreshed',
                'token' => $newToken,
                'expiration' => $newExpiration,
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Token is still valid',
            'expiration' => $cachedToken['expiration'],
        ], 200);
    }
}
