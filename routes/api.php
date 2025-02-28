<?php

use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\InicioUsuario\InicioUsuarioController;
use App\Http\Controllers\Api\v1\AnalisisRiesgo\FormulasController;
use App\Http\Controllers\Api\V1\AnalisisRiesgo\templateAnalisisRiesgoController;
use App\Http\Controllers\Api\V1\Capacitaciones\tbApiMobileControllerCapacitaciones;
use App\Http\Controllers\Api\V1\Capacitaciones\tbApiMobileControllerInstructorCapacitaciones;
use App\Http\Controllers\Api\V1\Comunicados\tbApiMobileControllerComunicados;
use App\Http\Controllers\Api\V1\ContadorSolicitudes\tbApiMobileControllerContadorSolicitudes;
use App\Http\Controllers\Api\V1\Documentos\tbApiMobileControllerDocumentos;
use App\Http\Controllers\Api\V1\OrdenesCompra\tbApiMobileControllerOrdenesCompra;
use App\Http\Controllers\Api\V1\PerfilUsuario\tbApiMobileControllerPerfilUsuario;
use App\Http\Controllers\Api\V1\PortalComunicacion\tbApiMobileControllerPortalComunicacion;
use App\Http\Controllers\Api\V1\Requisiciones\tbApiMobileControllerRequisiciones;
use App\Http\Controllers\Api\V1\SolicitudDayOff\tbApiMobileControllerSolicitudDayOff;
use App\Http\Controllers\Api\V1\SolicitudPermisoGoceSueldo\tbApiMobileControllerSolicitudPermisoGoceSueldo;
use App\Http\Controllers\Api\V1\SolicitudVacaciones\tbApiMobileControllerSolicitudVacaciones;
use App\Http\Controllers\Api\V1\Timesheet\TbTimesheetApiMobileController;

Route::post('/loginMobile', [UserAuthController::class, 'login']);
Route::post('checkToken', [UserAuthController::class, 'checkToken']);

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::post('/refreshToken', [UserAuthController::class, 'refreshToken']);
    Route::get('inicioUsuario', [InicioUsuarioController::class, 'index']);

    Route::get('perfilUsuario', [tbApiMobileControllerPerfilUsuario::class, 'tbFunctionPerfil']);
    Route::get('equipoUsuario', [tbApiMobileControllerPerfilUsuario::class, 'tbFunctionEquipo']);

    Route::get('portal-comunicacion', [tbApiMobileControllerPortalComunicacion::class, 'tbFunctionIndex']);
    Route::get('comunicados', [tbApiMobileControllerComunicados::class, 'tbFunctionIndex']);

    Route::get('documentos', [tbApiMobileControllerDocumentos::class, 'tbFunctionIndexUsuario']);
    Route::post('revision/{id}/aprobar', [tbApiMobileControllerDocumentos::class, 'aprobar']);
    Route::post('revision/{id}/rechazar', [tbApiMobileControllerDocumentos::class, 'rechazar']);

    Route::get('requisiciones', [tbApiMobileControllerRequisiciones::class, 'index']);
    Route::get('firmar-requisicion/{id}', [tbApiMobileControllerRequisiciones::class, 'firmarAprobadores']);
    Route::post('requisicion-firmada/{id}', [tbApiMobileControllerRequisiciones::class, 'FirmarUpdate']);
    Route::post('requisicion-rechazada/{id}', [tbApiMobileControllerRequisiciones::class, 'rechazada']);

    Route::get('ordenes-compra', [tbApiMobileControllerOrdenesCompra::class, 'index']);
    Route::get('firmar-orden/{id}', [tbApiMobileControllerOrdenesCompra::class, 'firmarAprobadores']);
    Route::post('orden-firmada/{id}', [tbApiMobileControllerOrdenesCompra::class, 'FirmarUpdate']);
    Route::post('orden-rechazada/{id}', [tbApiMobileControllerOrdenesCompra::class, 'rechazada']);

    Route::get('counterSolicitud', [tbApiMobileControllerContadorSolicitudes::class, 'tbFunctionContadorSolicitudes']);
    Route::get('counterGeneralSolicitud', [tbApiMobileControllerContadorSolicitudes::class, 'tbFunctionContadorGeneralSolicitudes']);

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
    // No funciona correctamente con /
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
    // No funciona correctamente con /
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
    // No funciona correctamente con /
    // Route::get('solicitud-permisos-vistaGlobal', [tbApiMobileControllerSolicitudPermisoGoceSueldo::class, 'vistaGlobal']);

    Route::prefix('timesheet')->group(function () {
        Route::get('/tbcreate', [TbTimesheetApiMobileController::class, 'tbFunctionCreate']);
        Route::post('/tbstore', [TbTimesheetApiMobileController::class, 'tbFunctionStore']);
        Route::get('/tbedit/{id}', [TbTimesheetApiMobileController::class, 'tbFunctionEdit']);
        Route::post('/tbupdate/{id}', [TbTimesheetApiMobileController::class, 'tbFunctionUpdate']);
        Route::delete('/tbdeletetimesheet/{id}', [TbTimesheetApiMobileController::class, 'tbFunctionEliminarTimesheet']);
        Route::delete('/tbdeleterecord/{id}', [TbTimesheetApiMobileController::class, 'tbFunctionEliminarRegistroHoras']);
        Route::get('/tbshow/{id}', [TbTimesheetApiMobileController::class, 'tbFunctionShow']);
        Route::get('/tbaprobaciones', [TbTimesheetApiMobileController::class, 'tbFunctionAprobaciones']);
        Route::post('/tbaprobar/{id}', [TbTimesheetApiMobileController::class, 'tbFunctionAprobar']);
        Route::post('/tbrechazar/{id}', [TbTimesheetApiMobileController::class, 'tbFunctionRechazar']);
        Route::get('/tbcontadorRegistrosPendientes', [TbTimesheetApiMobileController::class, 'tbFunctionContadorPendientesTimesheetAprobador']);
    });

    Route::prefix('capacitaciones')->group(function () {
        Route::get('/tblastcourse', [tbApiMobileControllerCapacitaciones::class, 'tbFunctionUltimoCurso']);
        Route::get('/tbinscribedcourses', [tbApiMobileControllerCapacitaciones::class, 'tbFunctionCursosInscrito']);
        Route::get('/tbcoursecatalogue', [tbApiMobileControllerCapacitaciones::class, 'tbFunctionCatalogoCursos']);
        Route::get('/tbcourseinfo/{id}', [tbApiMobileControllerCapacitaciones::class, 'tbFunctionInformacionCurso']);
        Route::get('tbstudentcourse/{course}/evaluation/{evaluation}', [tbApiMobileControllerCapacitaciones::class, 'tbFunctionCursoEvaluacion']);
        Route::get('/tbstudentcourse/{id}', [tbApiMobileControllerCapacitaciones::class, 'tbFunctionCursoEstudiante']);
        Route::post('/tbstudentevaluation/answers', [tbApiMobileControllerCapacitaciones::class, 'tbFunctionRespuestasCursoEvaluacion']);
    });

    Route::prefix('instructorCapacitaciones')->group(function () {
        Route::get('/tbIndexCourse', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionIndexCurso']);
        Route::get('/tbCreateCourse', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionCreateCurso']);
        Route::post('/tbStoreCourse', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionStoreCurso']);
        Route::get('/tbEditCourse/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionEditCurso']);
        Route::post('/tbUpdateCourse/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionUpdateCurso']);
        Route::get('/tbShowCourse/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionShowCurso']);
        Route::delete('/tbDeleteCourse/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionDeleteCurso']);

        Route::get('/tbIndexGoals/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionIndexGoals']);
        Route::post('/tbStoreGoals/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionStoreGoals']);
        Route::get('/tbEditGoals/{id_goal}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionEditGoals']);
        Route::post('/tbUpdateGoals/{id_goal}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionUpdateGoals']);
        Route::delete('/tbDeleteGoals/{id_goal}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionDeleteGoals']);

        Route::get('/tbIndexRequirements/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionIndexRequirements']);
        Route::post('/tbStoreRequirements/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionStoreRequirements']);
        Route::get('/tbEditRequirements/{id_requirement}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionEditRequirements']);
        Route::post('/tbUpdateRequirements/{id_requirement}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionUpdateRequirements']);
        Route::delete('/tbDeleteRequirements/{id_requirement}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionDeleteRequirements']);

        Route::get('/tbIndexAudience/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionIndexAudience']);
        Route::post('/tbStoreAudience/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionStoreAudience']);
        Route::get('/tbEditAudience/{id_audience}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionEditAudience']);
        Route::post('/tbUpdateAudience/{id_audience}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionUpdateAudience']);
        Route::delete('/tbDeleteAudience/{id_audience}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionDeleteAudience']);

        Route::get('/tbIndexEstudiantes/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionIndexEstudiantes']);
        Route::post('/tbStoreEstudiantes/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionStoreEstudiantes']);
        Route::delete('/tbDeleteEstudiantes', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionDeleteEstudiantes']);
        Route::delete('/tbDeleteMultipleEstudiantes', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionMultipleDeleteEstudiantes']);
        Route::delete('/tbDeleteAllEstudiantes/{id_course}', [tbApiMobileControllerInstructorCapacitaciones::class, 'tbFunctionAllDeleteEstudiantes']);
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
