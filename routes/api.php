<?php

use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\InicioUsuario\InicioUsuarioController;
use App\Http\Controllers\Api\V1\SolicitudDayOff\tbApiMobileControllerSolicitudDayOff;
use App\Http\Controllers\Api\V1\SolicitudVacaciones\tbApiMobileControllerSolicitudVacaciones;
use App\Http\Controllers\Api\V1\PortalComunicacion\tbApiMobileControllerPortalComunicacion;
use App\Http\Controllers\Api\v1\AnalisisRiesgo\FormulasController;
use App\Http\Controllers\Api\V1\AnalisisRiesgo\templateAnalisisRiesgoController;
use App\Http\Controllers\Api\V1\Comunicados\ComunicadosApiController;
use App\Http\Controllers\Api\V1\ContadorSolicitudes\ContadorSolicitudesApiController;
use App\Http\Controllers\Api\V1\SolicitudPermisoGoceSueldo\tbApiMobileControllerSolicitudPermisoGoceSueldo;
use App\Http\Controllers\Api\V1\Timesheet\tbApiMobileControllerTimesheet;

Route::post('/loginMobile', [UserAuthController::class, 'login']);
Route::post('checkToken', [UserAuthController::class, 'checkToken']);

Route::group(['prefix' => 'api/v1', 'as' => 'api.', 'namespace' => 'Api\v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::get('inicioUsuario', [InicioUsuarioController::class, 'index']);

    Route::get('portal-comunicacion', [tbApiMobileControllerPortalComunicacion::class, 'index']);
    Route::get('comunicados', [ComunicadosApiController::class, 'index']);

    Route::get('counterSolicitud', [ContadorSolicitudesApiController::class, 'contadorSolicitudes']);
    Route::get('counterGeneralSolicitud', [ContadorSolicitudesApiController::class, 'contadorGeneralSolicitudes']);

    Route::get('solicitud-dayoff', [tbApiMobileControllerSolicitudDayOff::class, 'index']);
    Route::get('solicitud-dayoff/create', [tbApiMobileControllerSolicitudDayOff::class, 'create']);
    Route::post('solicitud-dayoff/store', [tbApiMobileControllerSolicitudDayOff::class, 'store']);
    Route::get('solicitud-dayoff/{id}/show', [tbApiMobileControllerSolicitudDayOff::class, 'show']);
    Route::get('solicitud-dayoff/aprobacion', [tbApiMobileControllerSolicitudDayOff::class, 'aprobacion']);
    Route::get('solicitud-dayoff/{id}/respuesta', [tbApiMobileControllerSolicitudDayOff::class, 'respuesta']);
    Route::post('solicitud-dayoff/{id}/update', [tbApiMobileControllerSolicitudDayOff::class, 'update']);
    Route::get('solicitud-dayoff/archivo', [tbApiMobileControllerSolicitudDayOff::class, 'archivo']);
    Route::get('solicitud-dayoff-vistaGlobal', [tbApiMobileControllerSolicitudDayOff::class, 'vistaGlobal']);
    Route::get('solicitud-dayoff/{id}/showVistaGlobal', [tbApiMobileControllerSolicitudDayOff::class, 'showVistaGlobal']);
    Route::get('solicitud-dayoff/{id}/showArchivo', [tbApiMobileControllerSolicitudDayOff::class, 'showArchivo']);
    Route::delete('solicitud-dayoff/{id}/destroy', [tbApiMobileControllerSolicitudDayOff::class, 'destroy']);

    Route::get('solicitud-vacaciones', [tbApiMobileControllerSolicitudVacaciones::class, 'index']);
    Route::get('solicitud-vacaciones/create', [tbApiMobileControllerSolicitudVacaciones::class, 'create']);
    Route::get('solicitud-vacaciones/{id}/show', [tbApiMobileControllerSolicitudVacaciones::class, 'show']);
    Route::post('solicitud-vacaciones/store', [tbApiMobileControllerSolicitudVacaciones::class, 'store']);
    Route::get('solicitud-vacaciones/aprobacion', [tbApiMobileControllerSolicitudVacaciones::class, 'aprobacion']);
    Route::get('solicitud-vacaciones/{id}/respuesta', [tbApiMobileControllerSolicitudVacaciones::class, 'respuesta']);
    Route::post('solicitud-vacaciones/{id}/update', [tbApiMobileControllerSolicitudVacaciones::class, 'update']);
    Route::get('solicitud-vacaciones/archivo', [tbApiMobileControllerSolicitudVacaciones::class, 'archivo']);
    Route::get('solicitud-vacaciones-vistaGlobal', [tbApiMobileControllerSolicitudVacaciones::class, 'vistaGlobal']);
    Route::get('solicitud-vacaciones/{id}/showVistaGlobal', [tbApiMobileControllerSolicitudVacaciones::class, 'showVistaGlobal']);
    Route::get('solicitud-vacaciones/{id}/archivoShow', [tbApiMobileControllerSolicitudVacaciones::class, 'archivoShow']);
    Route::delete('solicitud-vacaciones/{id}/destroy', [tbApiMobileControllerSolicitudVacaciones::class, 'destroy']);

    Route::get('solicitud-permisos', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'index']);
    Route::get('solicitud-permisos/catalogoPermisos', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'catalogoPermisos']);
    Route::get('solicitud-permisos/{id}/show', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'show']);
    Route::post('solicitud-permisos/store', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'store']);
    Route::get('solicitud-permisos/aprobacion', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'aprobacion']);
    Route::get('solicitud-permisos/{id}/respuesta', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'respuesta']);
    Route::post('solicitud-permisos/{id}/update', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'update']);
    Route::get('solicitud-permisos/archivo', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'archivo']);
    // Route::get('solicitud-permisos-vistaGlobal', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'vistaGlobal']);
    Route::get('solicitud-permisos/{id}/showVistaGlobal', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'showVistaGlobal']);
    Route::get('solicitud-permisos/{id}/archivoShow', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'archivoShow']);
    Route::delete('solicitud-permisos/{id}/destroy', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'destroy']);

    Route::get('timesheet/show/{id}', [tbApiMobileControllerTimesheet::class, 'show']);
    Route::get('timesheet/aprobaciones', [tbApiMobileControllerTimesheet::class, 'aprobaciones']);
    Route::post('timesheet/aprobar/{id}', [tbApiMobileControllerTimesheet::class, 'aprobar']);
    Route::post('timesheet/rechazar/{id}', [tbApiMobileControllerTimesheet::class, 'rechazar']);
    Route::get('timesheet/contadorRegistrosPendientes', [tbApiMobileControllerTimesheet::class, 'contadorPendientesTimesheetAprobador']);
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
