<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\Api\InicioUsuario\InicioUsuarioController;

Route::post('api/v1/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'api/v1', 'as' => 'api.', 'namespace' => 'Api\v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('inicioUsuario', [InicioUsuarioController::class, 'index']);
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Incidentes De Seguridads
    Route::apiResource('incidentes-de-seguridads', 'IncidentesDeSeguridadApiController');

    // Gap Unos
    Route::apiResource('gap-unos', 'GapUnoApiController');

    // Gap Dos
    Route::apiResource('gap-dos', 'GapDosApiController');

    // Gap Tres
    Route::apiResource('gap-tres', 'GapTresApiController');
});
