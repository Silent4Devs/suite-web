<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\Api\InicioUsuario\InicioUsuarioController;
use App\Http\Controllers\Api\V1\SolicitudDayOff\SolicitudDayOffApiController;
use App\Http\Controllers\Api\V1\SolicitudVacaciones\SolicitudVacacionesApiController;
use App\Http\Controllers\Api\V1\PortalComunicacion\PortalComunicacionController;
use App\Http\Controllers\Api\v1\AnalisisRiesgo\FormulasController;
use App\Http\Controllers\Api\V1\AnalisisRiesgo\templateAnalisisRiesgoController;
use App\Http\Controllers\Api\V1\Comunicados\ComunicadosApiController;
use App\Http\Controllers\Api\V1\ContadorSolicitudes\ContadorSolicitudesApiController;
use App\Http\Controllers\Api\V1\SolicitudPermisoGoceSueldo\SolicitudPermisoGoceSueldoApiController;
use App\Http\Controllers\Api\V1\Test;
use App\Http\Controllers\Api\V1\Timesheet\TimesheetApiController;

Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/ejemplo', [AuthController::class, 'login']);
Route::apiResource('/test', Test::class);
route::post('/test2', [Test::class, 'store']);

Route::post('api/v1/logout', [AuthController::class, 'logout']);

Route::group(['prefix' => 'api/v1', 'as' => 'api.', 'namespace' => 'Api\v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('inicioUsuario', [InicioUsuarioController::class, 'index']);

    Route::get('portal-comunicacion', [PortalComunicacionController::class, 'index']);
    Route::get('comunicados', [ComunicadosApiController::class, 'index']);

    Route::get('counterSolicitud', [ContadorSolicitudesApiController::class, 'contadorSolicitudes']);
    Route::get('counterGeneralSolicitud', [ContadorSolicitudesApiController::class, 'contadorGeneralSolicitudes']);

    Route::get('solicitud-dayoff', [SolicitudDayOffApiController::class, 'index']);
    Route::get('solicitud-dayoff/create', [SolicitudDayOffApiController::class, 'create']);
    Route::post('solicitud-dayoff/store', [SolicitudDayOffApiController::class, 'store']);
    Route::get('solicitud-dayoff/{id}/show', [SolicitudDayOffApiController::class, 'show']);
    Route::get('solicitud-dayoff/aprobacion', [SolicitudDayOffApiController::class, 'aprobacion']);
    Route::get('solicitud-dayoff/{id}/respuesta', [SolicitudDayOffApiController::class, 'respuesta']);
    Route::post('solicitud-dayoff/{id}/update', [SolicitudDayOffApiController::class, 'update']);
    Route::get('solicitud-dayoff/archivo', [SolicitudDayOffApiController::class, 'archivo']);
    Route::get('solicitud-dayoff-vistaGlobal', [SolicitudDayOffApiController::class, 'vistaGlobal']);
    Route::get('solicitud-dayoff/{id}/showVistaGlobal', [SolicitudDayOffApiController::class, 'showVistaGlobal']);
    Route::get('solicitud-dayoff/{id}/showArchivo', [SolicitudDayOffApiController::class, 'showArchivo']);
    Route::delete('solicitud-dayoff/{id}/destroy', [SolicitudDayOffApiController::class, 'destroy']);

    Route::get('solicitud-vacaciones', [SolicitudVacacionesApiController::class, 'index']);
    Route::get('solicitud-vacaciones/create', [SolicitudVacacionesApiController::class, 'create']);
    Route::get('solicitud-vacaciones/{id}/show', [SolicitudVacacionesApiController::class, 'show']);
    Route::post('solicitud-vacaciones/store', [SolicitudVacacionesApiController::class, 'store']);
    Route::get('solicitud-vacaciones/aprobacion', [SolicitudVacacionesApiController::class, 'aprobacion']);
    Route::get('solicitud-vacaciones/{id}/respuesta', [SolicitudVacacionesApiController::class, 'respuesta']);
    Route::post('solicitud-vacaciones/{id}/update', [SolicitudVacacionesApiController::class, 'update']);
    Route::get('solicitud-vacaciones/archivo', [SolicitudVacacionesApiController::class, 'archivo']);
    Route::get('solicitud-vacaciones-vistaGlobal', [SolicitudVacacionesApiController::class, 'vistaGlobal']);
    Route::get('solicitud-vacaciones/{id}/showVistaGlobal', [SolicitudVacacionesApiController::class, 'showVistaGlobal']);
    Route::get('solicitud-vacaciones/{id}/archivoShow', [SolicitudVacacionesApiController::class, 'archivoShow']);
    Route::delete('solicitud-vacaciones/{id}/destroy', [SolicitudVacacionesApiController::class, 'destroy']);

    Route::get('solicitud-permisos', [SolicitudPermisoGoceSueldoApiController::class, 'index']);
    Route::get('solicitud-permisos/catalogoPermisos', [SolicitudPermisoGoceSueldoApiController::class, 'catalogoPermisos']);
    Route::get('solicitud-permisos/{id}/show', [SolicitudPermisoGoceSueldoApiController::class, 'show']);
    Route::post('solicitud-permisos/store', [SolicitudPermisoGoceSueldoApiController::class, 'store']);
    Route::get('solicitud-permisos/aprobacion', [SolicitudPermisoGoceSueldoApiController::class, 'aprobacion']);
    Route::get('solicitud-permisos/{id}/respuesta', [SolicitudPermisoGoceSueldoApiController::class, 'respuesta']);
    Route::post('solicitud-permisos/{id}/update', [SolicitudPermisoGoceSueldoApiController::class, 'update']);
    Route::get('solicitud-permisos/archivo', [SolicitudPermisoGoceSueldoApiController::class, 'archivo']);
    // Route::get('solicitud-permisos-vistaGlobal', [SolicitudPermisoGoceSueldoApiController::class, 'vistaGlobal']);
    Route::get('solicitud-permisos/{id}/showVistaGlobal', [SolicitudPermisoGoceSueldoApiController::class, 'showVistaGlobal']);
    Route::get('solicitud-permisos/{id}/archivoShow', [SolicitudPermisoGoceSueldoApiController::class, 'archivoShow']);
    Route::delete('solicitud-permisos/{id}/destroy', [SolicitudPermisoGoceSueldoApiController::class, 'destroy']);

    Route::get('timesheet/show/{id}', [TimesheetApiController::class, 'show']);
    Route::get('timesheet/aprobaciones', [TimesheetApiController::class, 'aprobaciones']);
    Route::post('timesheet/aprobar/{id}', [TimesheetApiController::class, 'aprobar']);
    Route::post('timesheet/rechazar/{id}', [TimesheetApiController::class, 'rechazar']);
    Route::get('timesheet/contadorRegistrosPendientes', [TimesheetApiController::class, 'contadorPendientesTimesheetAprobador']);
});
// Route::apiResource('api/v1/test', templateAnalisisRiesgoController::class);
// Route::delete('api/v1/test/section/delete/{id}', [templateAnalisisRiesgoController::class, 'destroySection']);
// Route::delete('api/v1/test/question/delete/{id}', [templateAnalisisRiesgoController::class, 'destroyQuestion']);
// Route::delete('api/v1/test/data/question/delete/{id}', [templateAnalisisRiesgoController::class, 'destroyDataQuestion']);
// Route::get('api/v1/template/ar/settings/table/{id}', [templateAnalisisRiesgoController::class, 'getSettingsTable']);
// Route::put('api/v1/template/ar/settings/table/edit', [templateAnalisisRiesgoController::class, 'updateSettingsTable']);

// Route::get('api/v1/ar/template/{id}', [templateAnalisisRiesgoController::class, 'getInfoTemplate']);
// Route::get('api/v1/ar/settings/{id}', [templateAnalisisRiesgoController::class, 'getSettings']);
// Route::apiResource('api/v1/ar/formulas', FormulasController::class);
// Route::get('api/v1/ar/formulas/options/{id}', [FormulasController::class, 'getOptionsFormulas']);
// Route::get('api/v1/ar/formulas/sections/{id}', [FormulasController::class, 'getSections']);

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
