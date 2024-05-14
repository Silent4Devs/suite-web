<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        request()->validate([
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
        $user = User::select(['id', 'name', 'password', 'email'])
            ->where('email', request('email'))
            ->firstOrFail();

        //Genera un nuevo token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'user' => $user->toArray(),
        ]);
    }

    public function logout(): JsonResponse
    {
        $token = request()->bearerToken();

        return response()->json([
            'status' => 'Success',
            'message' => 'Hasta la proxima',
            'data' => $token,
        ], 204);

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
        ], 204);
    }
}
