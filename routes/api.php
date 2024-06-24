<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\Api\InicioUsuario\InicioUsuarioController;
use App\Http\Controllers\Api\V1\SolicitudDayOff\SolicitudDayOffApiController;
use App\Http\Controllers\Api\V1\SolicitudVacaciones\SolicitudVacacionesApiController;
use App\Http\Controllers\Api\V1\PortalComunicacion\PortalComunicacionController;
use App\Http\Controllers\Api\v1\AnalisisRiesgo\FormulasController;
use App\Http\Controllers\Api\V1\AnalisisRiesgo\templateAnalisisRiesgoController;
use App\Http\Controllers\Api\V1\Comunicados\ComunicadosApiController;
use App\Http\Controllers\Api\V1\Timesheet\TimesheetApiController;

Route::post('v1/login', [AuthController::class, 'login']);

Route::post('api/v1/logout', [AuthController::class, 'logout']);

Route::group(['prefix' => 'api/v1', 'as' => 'api.', 'namespace' => 'Api\v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('inicioUsuario', [InicioUsuarioController::class, 'index']);
});
Route::apiResource('api/v1/test', templateAnalisisRiesgoController::class);
Route::delete('api/v1/test/section/delete/{id}', [templateAnalisisRiesgoController::class, 'destroySection']);
Route::delete('api/v1/test/question/delete/{id}', [templateAnalisisRiesgoController::class, 'destroyQuestion']);
Route::delete('api/v1/test/data/question/delete/{id}', [templateAnalisisRiesgoController::class, 'destroyDataQuestion']);
Route::get('api/v1/template/ar/settings/table/{id}', [templateAnalisisRiesgoController::class, 'getSettingsTable']);
Route::put('api/v1/template/ar/settings/table/edit', [templateAnalisisRiesgoController::class, 'updateSettingsTable']);

Route::get('api/v1/ar/template/{id}', [templateAnalisisRiesgoController::class, 'getInfoTemplate']);
Route::get('api/v1/ar/settings/{id}', [templateAnalisisRiesgoController::class, 'getSettings']);
Route::apiResource('api/v1/ar/formulas', FormulasController::class);
Route::get('api/v1/ar/formulas/options/{id}', [FormulasController::class, 'getOptionsFormulas']);
Route::get('api/v1/ar/formulas/sections/{id}', [FormulasController::class, 'getSections']);

Route::get('portal-comunicacion/{id}', [PortalComunicacionController::class, 'index']);
Route::get('comunicados', [ComunicadosApiController::class, 'index']);

Route::get('solicitud-dayoff/{id}', [SolicitudDayOffApiController::class, 'index']);
Route::get('solicitud-dayoff/create/{id}', [SolicitudDayOffApiController::class, 'create']);
Route::post('solicitud-dayoff/store', [SolicitudDayOffApiController::class, 'store']);
Route::get('solicitud-dayoff/{id}/show', [SolicitudDayOffApiController::class, 'show']);
Route::get('solicitud-dayoff/aprobacion/{id}', [SolicitudDayOffApiController::class, 'aprobacion']);
Route::get('solicitud-dayoff/{id}/respuesta', [SolicitudDayOffApiController::class, 'respuesta']);
Route::post('solicitud-dayoff/{id}/update', [SolicitudDayOffApiController::class, 'update']);
Route::get('solicitud-dayoff/archivo/{id}', [SolicitudDayOffApiController::class, 'archivo']);
Route::get('solicitud-dayoff-vistaGlobal', [SolicitudDayOffApiController::class, 'vistaGlobal']);
Route::get('solicitud-dayoff/{id}/showVistaGlobal', [SolicitudDayOffApiController::class, 'showVistaGlobal']);
Route::get('solicitud-dayoff/{id}/showArchivo', [SolicitudDayOffApiController::class, 'showArchivo']);

Route::get('solicitud-vacaciones/{id}', [SolicitudVacacionesApiController::class, 'index']);
Route::get('solicitud-vacaciones/create/{id}', [SolicitudVacacionesApiController::class, 'create']);
Route::get('solicitud-vacaciones/{id}/show', [SolicitudVacacionesApiController::class, 'show']);
Route::post('solicitud-vacaciones/store', [SolicitudVacacionesApiController::class, 'store']);
Route::get('solicitud-vacaciones/aprobacion/{id}', [SolicitudVacacionesApiController::class, 'aprobacion']);
Route::get('solicitud-vacaciones/{id}/respuesta', [SolicitudVacacionesApiController::class, 'respuesta']);
Route::post('solicitud-vacaciones/{id}/update', [SolicitudVacacionesApiController::class, 'update']);
Route::get('solicitud-vacaciones/archivo/{id}', [SolicitudVacacionesApiController::class, 'archivo']);
Route::get('solicitud-vacaciones-vistaGlobal', [SolicitudVacacionesApiController::class, 'vistaGlobal']);
Route::get('solicitud-vacaciones/{id}/showVistaGlobal', [SolicitudVacacionesApiController::class, 'showVistaGlobal']);
Route::get('solicitud-vacaciones/{id}/archivoShow', [SolicitudVacacionesApiController::class, 'archivoShow']);

Route::get('timesheet/show/{id}', [TimesheetApiController::class, 'show']);
Route::get('timesheet/aprobaciones', [TimesheetApiController::class, 'aprobaciones']);
Route::post('timesheet/aprobar/{id}', [TimesheetApiController::class, 'aprobar']);
Route::post('timesheet/rechazar/{id}', [TimesheetApiController::class, 'rechazar']);

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
