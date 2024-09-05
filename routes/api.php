<?php

use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\InicioUsuario\InicioUsuarioController;
use App\Http\Controllers\Api\v1\AnalisisRiesgo\FormulasController;
use App\Http\Controllers\Api\V1\AnalisisRiesgo\templateAnalisisRiesgoController;
use App\Http\Controllers\Api\V1\Comunicados\tbApiMobileControllerComunicados;
use App\Http\Controllers\Api\V1\ContadorSolicitudes\tbApiMobileControllerContadorSolicitudes;
use App\Http\Controllers\Api\V1\PortalComunicacion\tbApiMobileControllerPortalComunicacion;
use App\Http\Controllers\Api\V1\SolicitudDayOff\tbApiMobileControllerSolicitudDayOff;
use App\Http\Controllers\Api\V1\SolicitudPermisoGoceSueldo\tbApiMobileControllerSolicitudPermisoGoceSueldo;
use App\Http\Controllers\Api\V1\SolicitudVacaciones\tbApiMobileControllerSolicitudVacaciones;
use App\Http\Controllers\Api\V1\Timesheet\tbApiMobileControllerTimesheet;
use App\Http\Controllers\tbApiPanelControlController;

Route::post('/loginMobile', [UserAuthController::class, 'login']);
Route::post('checkToken', [UserAuthController::class, 'checkToken']);

Route::group(['prefix' => 'api/v1', 'as' => 'api.', 'namespace' => 'Api\v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::get('inicioUsuario', [InicioUsuarioController::class, 'index']);

    Route::get('portal-comunicacion', [tbApiMobileControllerPortalComunicacion::class, 'tbFunctionIndex']);
    Route::get('comunicados', [tbApiMobileControllerComunicados::class, 'tbFunctionIndex']);

    Route::get('counterSolicitud', [tbApiMobileControllerContadorSolicitudes::class, 'tbFunctionContadorSolicitudes']);
    Route::get('counterGeneralSolicitud', [tbApiMobileControllerContadorSolicitudes::class, 'tbFunctionContadorGeneralSolicitudes']);

    Route::get('/api-data', [tbApiPanelControlController::class, 'getData']);

    Route::prefix('solicitud-dayoff')->group(function () {
        Route::get('', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionIndex']);
        Route::post('/store', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionStore']);
        Route::get('/{id}/show', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionShow']);
        Route::get('/aprobacion', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionAprobacion']);
        Route::get('/{id}/respuesta', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionRespuesta']);
        Route::post('/{id}/update', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionUpdate']);
        Route::get('/archivo', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionArchivo']);
        Route::get('/{id}/showVistaGlobal', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionShowVistaGlobal']);
        Route::get('/{id}/showArchivo', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionShowArchivo']);
        Route::delete('/{id}/destroy', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionDestroy']);
    });
    //No funciona correctamente con /
    Route::get('solicitud-dayoff-vistaGlobal', [tbApiMobileControllerSolicitudDayOff::class, 'tbFunctionVistaGlobal']);

    Route::prefix('solicitud-vacaciones')->group(function () {
        Route::get('', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionIndex']);
        Route::get('/create', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionCreate']);
        Route::post('/store', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionStore']);
        Route::get('/{id}/show', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionShow']);
        Route::post('/{id}/update', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionUpdate']);
        Route::delete('/{id}/destroy', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionDestroy']);
        Route::get('/aprobacion', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionAprobacion']);
        Route::get('/{id}/respuesta', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionRespuesta']);
        Route::get('/archivo', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionArchivo']);
        Route::get('/{id}/archivoShow', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionArchivoShow']);
        Route::get('/{id}/showVistaGlobal', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionShowVistaGlobal']);
    });
    //No funciona correctamente con /
    Route::get('solicitud-vacaciones-vistaGlobal', [tbApiMobileControllerSolicitudVacaciones::class, 'tbFunctionVistaGlobal']);

    Route::prefix('solicitud-permisos')->group(function () {
        Route::get('', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'index']);
        Route::get('/catalogoPermisos', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'catalogoPermisos']);
        Route::get('/{id}/show', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'show']);
        Route::post('/store', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'store']);
        Route::get('/aprobacion', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'aprobacion']);
        Route::get('/{id}/respuesta', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'respuesta']);
        Route::post('/{id}/update', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'update']);
        Route::get('/archivo', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'archivo']);
        Route::get('/{id}/showVistaGlobal', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'showVistaGlobal']);
        Route::get('/{id}/archivoShow', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'archivoShow']);
        Route::delete('/{id}/destroy', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'destroy']);
    });
    //No funciona correctamente con /
    // Route::get('solicitud-permisos-vistaGlobal', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'vistaGlobal']);

    Route::prefix('timesheet')->group(function () {
        Route::get('/show/{id}', [tbApiMobileControllerTimesheet::class, 'tbFunctionShow']);
        Route::get('/aprobaciones', [tbApiMobileControllerTimesheet::class, 'tbFunctionAprobaciones']);
        Route::post('/aprobar/{id}', [tbApiMobileControllerTimesheet::class, 'tbFunctionAprobar']);
        Route::post('/rechazar/{id}', [tbApiMobileControllerTimesheet::class, 'tbFunctionRechazar']);
        Route::get('/contadorRegistrosPendientes', [tbApiMobileControllerTimesheet::class, 'tbFunctionContadorPendientesTimesheetAprobador']);
    });
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
