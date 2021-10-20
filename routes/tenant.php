<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DeskController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\EntendimientoOrganizacionController;
use App\Http\Controllers\Frontend\SedeController;
use App\Http\Controllers\Admin\TipoactivoController;
use App\Http\Controllers\Frontend\EmpleadoController;
use App\Http\Controllers\Frontend\ImplementacionController;
use App\Http\Controllers\Frontend\GrupoAreaController;
use App\Http\Controllers\Frontend\DocumentosController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Frontend\OrganizacionController;
use App\Http\Controllers\Frontend\InicioUsuarioController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\ScopeSessions;
use App\Http\Controllers\Frontend\PortalComunicacionController;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    ScopeSessions::class,
])->group(function () {
    Route::middleware(['universal'])->namespace('App\\Http\\Controllers\\')->group(function () {
        Auth::routes();
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        // Organizacions
        Route::resource('organizacions', OrganizacionController::class);
        Route::post('organizacions/media', [OrganizacionController::class, 'storeMedia'])->name('organizacions.storeMedia');
        Route::delete('organizacions/destroy', [OrganizacionController::class, 'massDestroy'])->name('organizacions.massDestroy');
        Route::post('organizacions/ckmedia', [OrganizacionController::class, 'storeCKEditorImages'])->name('organizacions.storeCKEditorImages');

        // Route::get('recursos-humanos/evaluacion-360', 'RH\Evaluacion360Controller@index')->name('rh-evaluacion360.index');

        // Route::get('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/participantes', 'RH\EV360EvaluacionesController@getParticipantes')->name('ev360-evaluaciones.getParticipantes');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/competencia', 'RH\EV360EvaluacionesController@relatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.relatedCompetenciaWithEvaluacion');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/competencia/delete', 'RH\EV360EvaluacionesController@deleteRelatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.deleteRelatedCompetenciaWithEvaluacion');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/objetivo', 'RH\EV360EvaluacionesController@relatedObjetivoWithEvaluacion')->name('ev360-evaluaciones.relatedObjetivoWithEvaluacion');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/objetivo/delete', 'RH\EV360EvaluacionesController@deleteRelatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.deleteRelatedObjetivoWithEvaluacion');
        // Route::get('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/evaluacion', 'RH\EV360EvaluacionesController@evaluacion')->name('ev360-evaluaciones.evaluacion');
        // Route::get('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/evaluacion/{evaluado}/{evaluador}', 'RH\EV360EvaluacionesController@contestarCuestionario')->name('ev360-evaluaciones.contestarCuestionario');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/evaluacion/{evaluado}/{evaluador}/cerrar', 'RH\EV360EvaluacionesController@finalizarEvaluacion')->name('ev360-evaluaciones.finalizarEvaluacion');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/objetivo/meta-alcanzada-descripcion/store', 'RH\EV360EvaluacionesController@storeMetaAlcanzadaDescripcion')->name('ev360-evaluaciones.objetivos.storeMetaAlcanzadaDescripcion');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/objetivo/meta-alcanzada/store', 'RH\EV360EvaluacionesController@storeMetaAlcanzada')->name('ev360-evaluaciones.objetivos.storeMetaAlcanzada');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/iniciar', 'RH\EV360EvaluacionesController@iniciarEvaluacion')->name('ev360-evaluaciones.iniciarEvaluacion');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/postergar', 'RH\EV360EvaluacionesController@postergarEvaluacion')->name('ev360-evaluaciones.postergarEvaluacion');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/cerrar', 'RH\EV360EvaluacionesController@cerrarEvaluacion')->name('ev360-evaluaciones.cerrarEvaluacion');
        // Route::post('recursos-humanos/evaluacion-360/autoevaluacion/competencias/obtener', 'RH\EV360EvaluacionesController@getAutoevaluacionCompetencias')->name('ev360-evaluaciones.autoevaluacion.competencias.get');
        // Route::post('recursos-humanos/evaluacion-360/autoevaluacion/objetivos/obtener', 'RH\EV360EvaluacionesController@getAutoevaluacionObjetivos')->name('ev360-evaluaciones.autoevaluacion.objetivos.get');
        // Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/consulta/{evaluado}', 'RH\EV360EvaluacionesController@consultaPorEvaluado')->name('ev360-evaluaciones.autoevaluacion.consulta.evaluado');
        // Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/resumen', 'RH\EV360EvaluacionesController@resumen')->name('ev360-evaluaciones.consulta.resumen');
        // Route::resource('recursos-humanos/evaluacion-360/evaluaciones', 'RH\EV360EvaluacionesController')->names([
        //     'index' => 'ev360-evaluaciones.index',
        //     'create' => 'ev360-evaluaciones.create',
        //     'store' => 'ev360-evaluaciones.store',
        //     'show' => 'ev360-evaluaciones.show',
        //     'edit' => 'ev360-evaluaciones.edit',
        //     'update' => 'ev360-evaluaciones.update',
        // ]);

        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/evaluado-evaluador/remover', 'RH\EvaluadoEvaluadorController@remover')->name('ev360-evaluaciones.evaluadores.remover');
        // Route::post('recursos-humanos/evaluacion-360/evaluaciones/evaluado-evaluador/agregar', 'RH\EvaluadoEvaluadorController@agregar')->name('ev360-evaluaciones.evaluadores.agregar');

        // Route::post('recursos-humanos/evaluacion-360/competencias/store-redirect', 'RH\EV360CompetenciasController@storeAndRedirect')->name('ev360-competencias.conductas');
        // Route::get('recursos-humanos/evaluacion-360/competencias/{competencia}/conductas', 'RH\EV360CompetenciasController@conductas')->name('ev360-competencias.obtenerConductas');
        // Route::get('recursos-humanos/evaluacion-360/competencias/{competencia}/informacion', 'RH\EV360CompetenciasController@informacionCompetencia')->name('ev360-competencias.informacionCompetencia');
        // Route::post('recursos-humanos/evaluacion-360/competencias/{competencia}/repuesta', 'RH\EV360CompetenciasController@guardarRespuestaCompetencia')->name('ev360-competencias.guardarRespuestaCompetencia');
        // Route::resource('recursos-humanos/evaluacion-360/competencias', 'RH\EV360CompetenciasController')->names([
        //     'index' => 'ev360-competencias.index',
        //     'create' => 'ev360-competencias.create',
        //     'store' => 'ev360-competencias.store',
        //     'show' => 'ev360-competencias.show',
        //     'edit' => 'ev360-competencias.edit',
        //     'update' => 'ev360-competencias.update',
        // ]);

        // Route::post('recursos-humanos/evaluacion-360/conductas/store', 'RH\EV360ConductasController@store')->name('ev360-conductas.store');
        // Route::get('recursos-humanos/evaluacion-360/conductas/{conducta}/edit', 'RH\EV360ConductasController@edit')->name('ev360-conductas.edit');
        // Route::patch('recursos-humanos/evaluacion-360/conductas/{conducta}', 'RH\EV360ConductasController@update')->name('ev360-conductas.update');
        // Route::delete('recursos-humanos/evaluacion-360/conductas/{conducta}', 'RH\EV360ConductasController@destroy')->name('ev360-conductas.destroy');

        // Route::get('recursos-humanos/evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@createByEmpleado')->name('ev360-objetivos-empleado.create');
        // Route::post('recursos-humanos/evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@storeByEmpleado')->name('ev360-objetivos-empleado.store');
        // Route::resource('recursos-humanos/evaluacion-360/objetivos', 'RH\EV360ObjetivosController')->names([
        //     'index' => 'ev360-objetivos.index',
        //     'create' => 'ev360-objetivos.create',
        //     'store' => 'ev360-objetivos.store',
        //     'show' => 'ev360-objetivos.show',
        //     'edit' => 'ev360-objetivos.edit',
        //     'update' => 'ev360-objetivos.update',
        // ]);

        // Route::resource('recursos-humanos/evaluacion-360/periodo', 'RH\EV360EvaluacionPeriodosController')->names([
        //     'index' => 'ev360-periodo.index',
        //     'create' => 'ev360-periodo.create',
        //     'store' => 'ev360-periodo.store',
        //     'show' => 'ev360-periodo.show',
        //     'edit' => 'ev360-periodo.edit',
        //     'update' => 'ev360-periodo.update',
        // ]);

        Route::view('iso27001', 'frontend.iso27001.index')->name('iso27001.index');
        Route::view('soporte', 'frontend.soporte.index')->name('soporte.index');
        Route::get('portal-comunicacion/reportes', [PortalComunicacionController::class, 'reportes'])->name('portal-comunicacion.reportes');
        Route::resource('portal-comunicacion', PortalComunicacionController::class);

        // Route::post('plantTrabajoBase/bloqueo/mostrar', 'LockedPlanTrabajoController@getLockedToPlanTrabajo')->name('lockedPlan.getLockedToPlanTrabajo');
        // Route::post('plantTrabajoBase/bloqueo/quitar', 'LockedPlanTrabajoController@removeLockedToPlanTrabajo')->name('lockedPlan.removeLockedToPlanTrabajo');
        // Route::post('plantTrabajoBase/bloqueo/is-locked', 'LockedPlanTrabajoController@isLockedToPlanTrabajo')->name('lockedPlan.isLockedToPlanTrabajo');
        // Route::post('plantTrabajoBase/bloqueo/registrar', 'LockedPlanTrabajoController@setLockedToPlanTrabajo')->name('lockedPlan.setLockedToPlanTrabajo');

        Route::get('inicioUsuario', [InicioUsuarioController::class, 'index'])->name('inicio-Usuario.index');

        Route::get('inicioUsuario/reportes/quejas', [InicioUsuarioController::class, 'quejas'])->name('reportes-quejas');
        Route::post('inicioUsuario/reportes/quejas', [InicioUsuarioController::class, 'storeQuejas'])->name('reportes-quejas-store');

        Route::get('inicioUsuario/reportes/denuncias', [InicioUsuarioController::class, 'denuncias'])->name('reportes-denuncias');
        Route::post('inicioUsuario/reportes/denuncias', [InicioUsuarioController::class, 'storeDenuncias'])->name('reportes-denuncias-store');

        Route::get('inicioUsuario/reportes/mejoras', [InicioUsuarioController::class, 'mejoras'])->name('reportes-mejoras');
        Route::post('inicioUsuario/reportes/mejoras', [InicioUsuarioController::class, 'storeMejoras'])->name('reportes-mejoras-store');

        Route::get('inicioUsuario/reportes/sugerencias', [InicioUsuarioController::class, 'sugerencias'])->name('reportes-sugerencias');
        Route::post('inicioUsuario/reportes/sugerencias', [InicioUsuarioController::class, 'storeSugerencias'])->name('reportes-sugerencias-store');

        Route::get('inicioUsuario/reportes/seguridad', [InicioUsuarioController::class, 'seguridad'])->name('reportes-seguridad');
        Route::post('inicioUsuario/reportes/seguridad/media', [InicioUsuarioController::class, 'storeMedia'])->name('reportes-seguridad.storeMedia');
        Route::post('inicioUsuario/reportes/seguridad', [InicioUsuarioController::class, 'storeSeguridad'])->name('reportes-seguridad-store');

        Route::get('inicioUsuario/reportes/riesgos', [InicioUsuarioController::class, 'riesgos'])->name('reportes-riesgos');
        Route::post('inicioUsuario/reportes/riesgos', [InicioUsuarioController::class, 'storeRiesgos'])->name('reportes-riesgos-store');

        Route::post('inicioUsuario/capacitaciones/archivar', [InicioUsuarioController::class, 'archivarCapacitacion'])->name('inicio-Usuario.capacitaciones.archivar');

        Route::get('desk', [DeskController::class, 'index'])->name('desk.index');

        Route::post('desk/{seguridad}/analisis_seguridad-update', [DeskController::class, 'updateAnalisisSeguridad'])->name('desk.analisis_seguridad-update');
        Route::post('desk/{riesgos}/analisis_riesgo-update', [DeskController::class, 'updateAnalisisReisgos'])->name('desk.analisis_riesgo-update');
        Route::post('desk/{mejoras}/analisis_mejora-update', [DeskController::class, 'updateAnalisisMejoras'])->name('desk.analisis_mejora-update');
        Route::post('desk/{quejas}/analisis_queja-update', [DeskController::class, 'updateAnalisisQuejas'])->name('desk.analisis_queja-update');
        Route::post('desk/{denuncias}/analisis_denuncia-update', [DeskController::class, 'updateAnalisisDenuncias'])->name('desk.analisis_denuncia-update');
        Route::post('desk/{sugerencias}/analisis_sugerencia-update', [DeskController::class, 'updateAnalisisSugerencias'])->name('desk.analisis_sugerencia-update');

        Route::get('desk/{seguridad}/seguridad-edit', [DeskController::class, 'editSeguridad'])->name('desk.seguridad-edit');
        Route::post('desk/{seguridad}/seguridad-update', [DeskController::class, 'updateSeguridad'])->name('desk.seguridad-update');
        Route::post('desk/{incidente}/archivar', [DeskController::class, 'archivadoSeguridad'])->name('desk.seguridad-archivar');
        Route::get('desk/seguridad-archivo', [DeskController::class, 'archivoSeguridad'])->name('desk.seguridad-archivo');
        Route::get('desk/seguridad', [DeskController::class, 'indexSeguridad'])->name('desk.seguridad-index');

        Route::get('desk/{riesgos}/riesgos-edit', [DeskController::class, 'editRiesgos'])->name('desk.riesgos-edit');
        Route::post('desk/{riesgos}/riesgos-update', [DeskController::class, 'updateRiesgos'])->name('desk.riesgos-update');

        Route::get('desk/{quejas}/quejas-edit', [DeskController::class, 'editQuejas'])->name('desk.quejas-edit');
        Route::post('desk/{quejas}/quejas-update', [DeskController::class, 'updateQuejas'])->name('desk.quejas-update');

        Route::get('desk/{denuncias}/denuncias-edit', [DeskController::class, 'editDenuncias'])->name('desk.denuncias-edit');
        Route::post('desk/{denuncias}/denuncias-update', [DeskController::class, 'updateDenuncias'])->name('desk.denuncias-update');

        Route::get('desk/{mejoras}/mejoras-edit', [DeskController::class, 'editMejoras'])->name('desk.mejoras-edit');
        Route::post('desk/{mejoras}/mejoras-update', [DeskController::class, 'updateMejoras'])->name('desk.mejoras-update');

        Route::get('desk/{sugerencias}/sugerencias-edit', [DeskController::class, 'editSugerencias'])->name('desk.sugerencias-edit');
        Route::post('desk/{sugerencias}/sugerencias-update', [DeskController::class, 'updateSugerencias'])->name('desk.sugerencias-update');

        // Actividades DESK - Plan Accion
        Route::get('desk-seguridad-actividades/{seguridad_id}', [ActividadesIncidentesController::class, 'index'])->name('desk-seguridad-actividades.index');
        Route::resource('desk-seguridad-actividades', ActividadesIncidentesController::class)->except(['index']);

        Route::get('desk-riesgos-actividades/{riesgo_id}', [ActividadesRiesgosController::class, 'index'])->name('desk-riesgos-actividades.index');
        Route::resource('desk-riesgos-actividades', ActividadesRiesgosController::class)->except(['index']);

        Route::get('desk-quejas-actividades/{queja_id}', [ActividadesQuejasController::class, 'index'])->name('desk-quejas-actividades.index');
        Route::resource('desk-quejas-actividades', ActividadesQuejasController::class)->except(['index']);

        Route::get('desk-denuncias-actividades/{denuncia_id}', [ActividadesDenunciasController::class, 'index'])->name('desk-denuncias-actividades.index');
        Route::resource('desk-denuncias-actividades', ActividadesDenunciasController::class)->except(['index']);

        Route::get('desk-mejoras-actividades/{mejora_id}', [ActividadesMejorasController::class, 'index'])->name('desk-mejoras-actividades.index');
        Route::resource('desk-mejoras-actividades', ActividadesMejorasController::class)->except(['index']);

        Route::get('desk-sugerencias-actividades/{sugerencia_id}', [ActividadesSugerenciasController::class, 'index'])->name('desk-sugerencias-actividades.index');
        Route::resource('desk-sugerencias-actividades', ActividadesSugerenciasController::class)->except(['index']);

        Route::get('planTrabajoBase', [PlanTrabajoBaseController::class, 'index'])->name('planTrabajoBase.index');
        Route::post('planTrabajoBase/save/current', [PlanTrabajoBaseController::class, 'saveCurrentProyect'])->name('planTrabajoBase.saveCurrentProyect');
        Route::post('planTrabajoBase/save/status', [PlanTrabajoBaseController::class, 'saveStatus'])->name('planTrabajoBase.saveStatus');
        Route::post('planTrabajoBase/check/changes', [PlanTrabajoBaseController::class, 'checkChanges'])->name('planTrabajoBase.checkChanges');
        Route::post('planTrabajoBase/save', [PlanTrabajoBaseController::class, 'saveImplementationProyect'])->name('planTrabajoBase.saveProyect');
        Route::post('planTrabajoBase/load', [PlanTrabajoBaseController::class, 'loadProyect'])->name('planTrabajoBase.loadProyect');

        // Permissions
        Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
        Route::resource('permissions', PermissionsController::class);

        //analisis brechas
        //Route::resource('analisis-brechas', 'AnalisisBController');
        Route::get('analisis-brechas', [AnalisisBController::class, 'index'])->name('analisis-brechas.index');
        Route::post('analisis-brechas/update', [AnalisisBController::class, 'update']);

        // Declaracion de Aplicabilidad
        Route::get('declaracion-aplicabilidad/descargar', [DeclaracionAplicabilidadController::class, 'download'])->name('declaracion-aplicabilidad.descargar');
        Route::delete('declaracion-aplicabilidad/destroy', [DeclaracionAplicabilidadController::class, 'massDestroy'])->name('declaracion-aplicabilidad.massDestroy');
        Route::resource('declaracion-aplicabilidad', DeclaracionAplicabilidadController::class);

        //gantt
        Route::get('gantt', [GanttController::class, 'index']);
        Route::post('gantt/update', [GanttController::class, 'update']);

        // Roles
        Route::get('roles/{role}/permisos', [RolesController::class, 'getPermissions'])->name('roles.getPermissions');
        Route::patch('roles/{role}/edit', [RolesController::class, 'update'])->name('roles.patch');
        Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
        Route::resource('roles', RolesController::class);

        //procesos

        Route::get('mapa-procesos', [ProcesoController::class, 'mapaProcesos'])->name('procesos.mapa');
        Route::get('procesos/{documento}/vista', [ProcesoController::class, 'obtenerDocumentoProcesos'])->name('procesos.obtenerDocumentoProcesos');
        Route::resource('procesos', ProcesoController::class);
        Route::post('selectIndicador', [ProcesoController::class, 'AjaxRequestIndicador'])->name('selectIndicador');
        Route::post('selectRiesgos', [ProcesoController::class, 'AjaxRequestRiesgos'])->name('selectRiesgos');

        //macroprocesos
        Route::resource('macroprocesos', MacroprocesoController::class);

        // Users
        Route::post('users/vincular', [UsersController::class, 'vincularEmpleado'])->name('users.vincular');
        Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
        //Route::post('users/get', 'UsersController@getUsers')->name('users.get');
        Route::resource('users', UsersController::class);

        // Empleados
        Route::post('empleados/store/{empleado}/competencias-resumen', [EmpleadoController::class, 'storeResumen'])->name('empleados.storeResumen');
        Route::post('empleados/store/{empleado}/competencias-certificaciones', [EmpleadoController::class, 'storeCertificaciones'])->name('empleados.storeCertificaciones');
        Route::delete('empleados/delete/{certificacion}/competencias-certificaciones', [EmpleadoController::class, 'deleteCertificaciones'])->name('empleados.deleteCertificaciones');
        Route::post('empleados/store/{empleado}/competencias-cursos', [EmpleadoController::class, 'storeCursos'])->name('empleados.storeCursos');
        Route::delete('empleados/delete/{curso}/competencias-cursos', [EmpleadoController::class, 'deleteCursos'])->name('empleados.deleteCursos');
        Route::post('empleados/store/{empleado}/competencias-experiencia', [EmpleadoController::class, 'storeExperiencia'])->name('empleados.storeExperiencia');
        Route::delete('empleados/delete/{educacion}/competencias-educacion', [EmpleadoController::class, 'deleteEducacion'])->name('empleados.deleteEducacion');
        Route::post('empleados/store/{empleado}/competencias-educacion', [EmpleadoController::class, 'storeEducacion'])->name('empleados.storeEducacion');
        Route::delete('empleados/delete/{experiencia}/competencias-experiencia', [EmpleadoController::class, 'deleteExperiencia'])->name('empleados.deleteExperiencia');
        Route::get('empleados/store/{empleado}/competencias-certificaciones', [EmpleadoController::class, 'getCertificaciones'])->name('empleados.getCertificaciones');
        Route::get('empleados/store/{empleado}/competencias-educacion', [EmpleadoController::class, 'getEducacion'])->name('empleados.getEducacion');
        Route::get('empleados/store/{empleado}/competencias-experiencia', [EmpleadoController::class, 'getExperiencia'])->name('empleados.getExperiencia');
        Route::get('empleados/store/{empleado}/competencias-cursos', [EmpleadoController::class, 'getCursos'])->name('empleados.getCursos');
        Route::post('empleados/store/competencias', [EmpleadoController::class, 'storeWithCompetencia'])->name('empleados.storeWithCompetencia');
        Route::post('empleados/get', [EmpleadoController::class, 'getEmpleados'])->name('empleados.get');
        Route::get('empleados/get-all', [EmpleadoController::class, 'getAllEmpleados'])->name('empleados.getAll');
        Route::resource('empleados', EmpleadoController::class);

        Route::get('organigrama/exportar', [OrganigramaController::class, 'exportTo'])->name('organigrama.exportar');
        Route::get('organigrama', [OrganigramaController::class, 'index'])->name('organigrama.index');

        // Dashboards
        Route::resource('dashboards', DashboardController::class, ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

        // Implementacions

        Route::resource('implementacions', ImplementacionController::class);

        // Planes de Acción
        Route::post('planes-de-accion/{plan}/save', [PlanesAccionController::class, 'saveProject'])->name('planes-de-accion.saveProject');
        Route::post('planes-de-accion/{plan}/load', [PlanesAccionController::class, 'loadProject'])->name('planes-de-accion.loadProject');
        // Route::get('planes-de-accion/create/', [PlanesAccionController::class, 'create')->name('planes-de-accion.create');
        Route::resource('planes-de-accion', PlanesAccionController::class)->except(['create']);

        // Glosarios
        Route::delete('glosarios/destroy', [GlosarioController::class, 'massDestroy'])->name('glosarios.massDestroy');
        Route::resource('glosarios', GlosarioController::class);

        // Plan Base Actividades
        // Route::delete('plan-base-actividades/destroy', [PlanBaseActividadesController::class, 'massDestroy'])->name('plan-base-actividades.massDestroy');
        // Route::post('plan-base-actividades/media', [PlanBaseActividadesController::class, 'storeMedia'])->name('plan-base-actividades.storeMedia');
        // Route::post('plan-base-actividades/ckmedia', [PlanBaseActividadesController::class, 'storeCKEditorImages'])->name('plan-base-actividades.storeCKEditorImages');
        // Route::resource('plan-base-actividades', [PlanBaseActividadesController::class]);

        // User Alerts
        Route::delete('user-alerts/destroy', [UserAlertsController::class, 'massDestroy'])->name('user-alerts.massDestroy');
        Route::resource('user-alerts', UserAlertsController::class, ['except' => ['edit', 'update']]);

        // Entendimiento Organizacions
        Route::delete('entendimiento-organizacions/destroy', [EntendimientoOrganizacionController::class ,'massDestroy'])->name('entendimiento-organizacions.massDestroy');
        Route::resource('entendimiento-organizacions', EntendimientoOrganizacionController::class);
        Route::post('entendimiento-organizacions/parse-csv-import', [EntendimientoOrganizacionController::class ,'parseCsvImport'])->name('entendimiento-organizacions.parseCsvImport');
        Route::post('areas/process-csv-import', [AreasController::class, 'processCsvImport'])->name('areas.processCsvImport');

        // Partes Interesadas
        Route::delete('partes-interesadas/destroy', [PartesInteresadasController::class, 'massDestroy'])->name('partes-interesadas.massDestroy');
        Route::resource('partes-interesadas', PartesInteresadasController::class);

        // Matriz Requisito Legales
        Route::get('matriz-requisito-legales/planes-de-accion/create/{id}', [MatrizRequisitoLegalesController::class, 'createPlanAccion'])->name('matriz-requisito-legales.createPlanAccion');
        Route::post('matriz-requisito-legales/planes-de-accion/store/{id}', [MatrizRequisitoLegalesController::class,'storePlanAccion'])->name('matriz-requisito-legales.storePlanAccion');
        Route::delete('matriz-requisito-legales/destroy', [MatrizRequisitoLegalesController::class,'massDestroy'])->name('matriz-requisito-legales.massDestroy');
        Route::resource('matriz-requisito-legales', MatrizRequisitoLegalesController::class);

        // Alcance Sgsis
        Route::delete('alcance-sgsis/destroy', [AlcanceSgsiController::class,'massDestroy'])->name('alcance-sgsis.massDestroy');
        Route::resource('alcance-sgsis', AlcanceSgsiController::class);

        // Comiteseguridads
        Route::delete('comiteseguridads/destroy', [ComiteseguridadController::class,'massDestroy'])->name('comiteseguridads.massDestroy');

        Route::get('comiteseguridads/visualizacion', [ComiteseguridadController::class,'visualizacion']);

        Route::resource('comiteseguridads', ComiteseguridadController::class);

        // Minutasaltadireccions
        Route::get('minutasaltadireccions/{minuta}/minuta-documento', [MinutasaltadireccionController::class,'renderViewDocument'])->name('documentos.renderViewMinuta');
        Route::get('minutasaltadireccions/{minuta}/historial-revisiones', [MinutasaltadireccionController::class,'renderHistoryReview'])->name('documentos.renderHistoryReviewMinuta');
        Route::get('minutasaltadireccions/planes-de-accion/create/{id}', [MinutasaltadireccionController::class,'createPlanAccion'])->name('minutasaltadireccions.createPlanAccion');
        Route::patch('minutasaltadireccions/{minuta}/update-and-review', [MinutasaltadireccionController::class,'updateAndReview'])->name('minutasaltadireccions.updateAndReview');
        Route::post('minutasaltadireccions/planes-de-accion/store/{id}', [MinutasaltadireccionController::class,'storePlanAccion'])->name('minutasaltadireccions.storePlanAccion');
        Route::delete('minutasaltadireccions/destroy', [MinutasaltadireccionController::class,'massDestroy'])->name('minutasaltadireccions.massDestroy');
        Route::post('minutasaltadireccions/media', [MinutasaltadireccionController::class,'storeMedia'])->name('minutasaltadireccions.storeMedia');
        Route::post('minutasaltadireccions/ckmedia', [MinutasaltadireccionController::class,'storeCKEditorImages'])->name('minutasaltadireccions.storeCKEditorImages');
        Route::resource('minutasaltadireccions', MinutasaltadireccionController::class);

        // Evidencias Sgsis
        Route::delete('evidencias-sgsis/destroy', [EvidenciasSgsiController::class,'massDestroy'])->name('evidencias-sgsis.massDestroy');
        Route::post('evidencias-sgsis/media', [EvidenciasSgsiController::class,'storeMedia'])->name('evidencias-sgsis.storeMedia');
        Route::post('evidencias-sgsis/ckmedia', [EvidenciasSgsiController::class,'storeCKEditorImages'])->name('evidencias-sgsis.storeCKEditorImages');
        Route::resource('evidencias-sgsis', EvidenciasSgsiController::class);

        // Politica Sgsis
        Route::delete('politica-sgsis/destroy', [PoliticaSgsiController::class,'massDestroy'])->name('politica-sgsis.massDestroy');
        Route::get('politica-sgsis/visualizacion', [PoliticaSgsiController::class,'visualizacion'])->name('politica-sgsis/visualizacion');
        Route::resource('politica-sgsis', PoliticaSgsiController::class);

        // Roles Responsabilidades
        Route::delete('roles-responsabilidades/destroy', [RolesResponsabilidadesController::class,'massDestroy'])->name('roles-responsabilidades.massDestroy');
        Route::resource('roles-responsabilidades', m::class);

        // Riesgosoportunidades
        Route::delete('riesgosoportunidades/destroy', [RiesgosoportunidadesController::class,'massDestroy'])->name('riesgosoportunidades.massDestroy');
        Route::resource('riesgosoportunidades', RiesgosoportunidadesController::class);

        // Objetivosseguridads
        Route::delete('objetivosseguridads/destroy', [ObjetivosseguridadController::class,'massDestroy'])->name('objetivosseguridads.massDestroy');
        Route::resource('objetivosseguridads', ObjetivosseguridadController::class);
        Route::get('objetivosseguridadsInsertar', [ObjetivosseguridadController::class,'ObjetivoInsert'])->name('objetivos-seguridadsInsertar');
        Route::get('evaluaciones-objetivosInsertar', [ObjetivosseguridadController::class,'evaluacionesInsert'])->name('evaluacionesobjetivosInsert');
        Route::get('evaluaciones-objetivosShow', [ObjetivosseguridadController::class,'evaluacionesShow'])->name('evaluacionesobjetivosShow');

        Route::resource('categoria-capacitacion', CategoriaCapacitacionController::class);

        // Recursos
        Route::delete('recursos/destroy', [RecursosController::class,'massDestroy'])->name('recursos.massDestroy');
        Route::post('recursos/media', [RecursosController::class,'storeMedia'])->name('recursos.storeMedia');
        Route::post('recursos/ckmedia', [RecursosController::class,'toreCKEditorImages'])->name('recursos.storeCKEditorImages');
        Route::post('recursos/suscribir/', [RecursosController::class,'suscribir'])->name('recursos.suscribir');
        Route::post('recursos/cancelar/', [RecursosController::class,'eliminarParticipante'])->name('recursos.cancelar');
        Route::post('recursos/calificar/', [RecursosController::class,'calificarParticipante'])->name('recursos.calificar');
        Route::get('recursos/{recurso}/participantes/', [RecursosController::class,'participantes'])->name('recursos.participantes');
        Route::get('recursos/{recurso}/participantes/get', [RecursosController::class,'getParticipantes'])->name('recursos.getParticipantes');
        Route::resource('recursos', RecursosController::class);

        // Competencia
        Route::delete('competencia/destroy', [CompetenciasController::class,'massDestroy'])->name('competencia.massDestroy');
        Route::post('competencia/media', [CompetenciasController::class,'storeMedia'])->name('competencia.storeMedia');
        Route::post('competencia/ckmedia', [CompetenciasController::class,'storeCKEditorImages'])->name('competencia.storeCKEditorImages');
        Route::resource('competencia', CompetenciasController::class);
        Route::get('buscarCV', [CompetenciasController::class,'buscarcv'])->name('buscarCV');

        // Adquirirveintidostrecientosunos
        Route::resource('adquirirveintidostrecientosunos', AdquirirveintidostrecientosunoController::class, ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

        // Adquirirtreintaunmils
        Route::resource('adquirirtreintaunmils', AdquirirtreintaunmilController::class, ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

        // Concientizacion Sgis
        Route::delete('concientizacion-sgis/destroy', [ConcientizacionSgiController::class,'massDestroy'])->name('concientizacion-sgis.massDestroy');
        Route::post('concientizacion-sgis/media', [ConcientizacionSgiController::class,'storeMedia'])->name('concientizacion-sgis.storeMedia');
        Route::post('concientizacion-sgis/ckmedia', [ConcientizacionSgiController::class,'storeCKEditorImages'])->name('concientizacion-sgis.storeCKEditorImages');
        Route::resource('concientizacion-sgis', ConcientizacionSgiController::class);

        // Material Sgsis
        Route::delete('material-sgsis/destroy', [MaterialSgsiController::class,'massDestroy'])->name('material-sgsis.massDestroy');
        Route::post('material-sgsis/media', [MaterialSgsiController::class,'storeMedia'])->name('material-sgsis.storeMedia');
        Route::post('material-sgsis/ckmedia', [MaterialSgsiController::class,'storeCKEditorImages'])->name('material-sgsis.storeCKEditorImages');
        Route::resource('material-sgsis', MaterialSgsiController::class);

        // Material Iso Veinticientes
        Route::delete('material-iso-veinticientes/destroy', [MaterialIsoVeinticienteController::class,'massDestroy'])->name('material-iso-veinticientes.massDestroy');
        Route::post('material-iso-veinticientes/media', [MaterialIsoVeinticienteController::class,'storeMedia'])->name('material-iso-veinticientes.storeMedia');
        Route::post('material-iso-veinticientes/ckmedia', [MaterialIsoVeinticienteController::class,'storeCKEditorImages'])->name('material-iso-veinticientes.storeCKEditorImages');
        Route::resource('material-iso-veinticientes', MaterialIsoVeinticienteController::class);

        // Comunicacion Sgis
        Route::delete('comunicacion-sgis/destroy', [ComunicacionSgiController::class,'massDestroy'])->name('comunicacion-sgis.massDestroy');
        Route::post('comunicacion-sgis/media', [ComunicacionSgiController::class,'storeMedia'])->name('comunicacion-sgis.storeMedia');
        Route::post('comunicacion-sgis/ckmedia', [ComunicacionSgiController::class,'storeCKEditorImages'])->name('comunicacion-sgis.storeCKEditorImages');
        Route::resource('comunicacion-sgis', ComunicacionSgiController::class);

        // Politica Del Sgsi Soportes
        Route::resource('politica-del-sgsi-soportes', PoliticaDelSgsiSoporteController::class, ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

        // Control Accesos
        Route::delete('control-accesos/destroy', [ControlAccesoController::class,'massDestroy'])->name('control-accesos.massDestroy');
        Route::post('control-accesos/media', [ControlAccesoController::class,'storeMedia'])->name('control-accesos.storeMedia');
        Route::post('control-accesos/ckmedia', [ControlAccesoController::class,'storeCKEditorImages'])->name('control-accesos.storeCKEditorImages');
        Route::resource('control-accesos', ControlAccesoController::class);

        // Informacion Documetadas
        Route::delete('informacion-documetadas/destroy', [InformacionDocumetadaController::class,'massDestroy'])->name('informacion-documetadas.massDestroy');
        Route::post('informacion-documetadas/media', [InformacionDocumetadaController::class,'storeMedia'])->name('informacion-documetadas.storeMedia');
        Route::post('informacion-documetadas/ckmedia', [InformacionDocumetadaController::class,'storeCKEditorImages'])->name('informacion-documetadas.storeCKEditorImages');
        Route::resource('informacion-documetadas', InformacionDocumetadaController::class);

        // Planificacion Controls
        Route::delete('planificacion-controls/destroy', [PlanificacionControlController::class,'massDestroy'])->name('planificacion-controls.massDestroy');
        Route::resource('planificacion-controls', PlanificacionControlController::class);

        // Activos
        Route::delete('activos/destroy', [ActivosController::class,'massDestroy'])->name('activos.massDestroy');
        Route::resource('activos', ActivosController::class);

        // Marca
        Route::get('marcas/get-marcas', [MarcaController::class,'getMarcas'])->name('marcas.getMarcas');
        Route::resource('marcas', MarcaController::class);

        // Modelo
        Route::get('modelos/get-modelos/{id?}', [ModeloController::class,'getModelos'])->name('modelos.getModelos');
        Route::resource('modelos', ModeloController::class);

        // Tratamiento Riesgos
        Route::delete('tratamiento-riesgos/destroy', [TratamientoRiesgosController::class,'massDestroy'])->name('tratamiento-riesgos.massDestroy');
        Route::resource('tratamiento-riesgos', TratamientoRiesgosController::class);

        // Auditoria Internas
        Route::delete('auditoria-internas/destroy', [AuditoriaInternaController::class,'massDestroy'])->name('auditoria-internas.massDestroy');
        Route::post('auditoria-internas/media', [AuditoriaInternaController::class,'storeMedia'])->name('auditoria-internas.storeMedia');
        Route::post('auditoria-internas/ckmedia', [AuditoriaInternaController::class,'storeCKEditorImages'])->name('auditoria-internas.storeCKEditorImages');
        Route::resource('auditoria-internas', AuditoriaInternaController::class);

        // Revision Direccions
        Route::delete('revision-direccions/destroy', [RevisionDireccionController::class,'massDestroy'])->name('revision-direccions.massDestroy');
        Route::resource('revision-direccions', RevisionDireccionController::class);

        // Controles
        Route::delete('controles/destroy', [ControlesController::class,'massDestroy'])->name('controles.massDestroy');
        Route::post('controles/parse-csv-import', [ControlesController::class,'parseCsvImport'])->name('controles.parseCsvImport');
        Route::post('controles/process-csv-import', [ControlesController::class,'processCsvImport'])->name('controles.processCsvImport');
        Route::resource('controles', ControlesController::class);

        // Audit Logs
        Route::resource('audit-logs', AuditLogsController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

        // Areas
        Route::delete('areas/destroy', [AreasController::class,'massDestroy'])->name('areas.massDestroy');
        Route::get('areas/grupo', [AreasController::class,'obtenerAreasPorGrupo'])->name('areas.obtenerAreasPorGrupo');
        Route::post('areas/parse-csv-import', [AreasController::class,'parseCsvImport'])->name('areas.parseCsvImport');
        Route::get('areas/jerarquia', [AreasController::class,'renderJerarquia'])->name('areas.renderJerarquia');
        Route::post('areas/process-csv-import', [AreasController::class,'processCsvImport'])->name('areas.processCsvImport');
        Route::resource('areas', AreasController::class);

        // Organizaciones
        Route::delete('organizaciones/destroy', [OrganizacionesController::class,'massDestroy'])->name('organizaciones.massDestroy');
        Route::post('organizaciones/parse-csv-import', [OrganizacionesController::class,'parseCsvImport'])->name('organizaciones.parseCsvImport');
        Route::post('organizaciones/process-csv-import', [OrganizacionesController::class,'processCsvImport'])->name('organizaciones.processCsvImport');
        Route::resource('organizaciones', OrganizacionesController::class);

        // Tipoactivos
        Route::delete('tipoactivos/destroy', [TipoactivoController::class, 'massDestroy'])->name('tipoactivos.massDestroy');
        Route::post('tipoactivos/parse-csv-import', [TipoactivoController::class, 'parseCsvImport'])->name('tipoactivos.parseCsvImport');
        Route::post('tipoactivos/process-csv-import', [TipoactivoController::class, 'processCsvImport'])->name('tipoactivos.processCsvImport');
        Route::resource('tipoactivos', TipoactivoController::class);

        // Puestos
        Route::delete('puestos/destroy', [PuestosController::class,'massDestroy'])->name('puestos.massDestroy');
        Route::post('puestos/parse-csv-import', [PuestosController::class,'parseCsvImport'])->name('puestos.parseCsvImport');
        Route::post('puestos/process-csv-import', [PuestosController::class,'processCsvImport'])->name('puestos.processCsvImport');
        Route::resource('puestos', PuestosController::class);

        // Sedes
        Route::delete('sedes/destroy', [SedeController::class, 'massDestroy'])->name('sedes.massDestroy');
        Route::get('sedes/organizacion', [SedeController::class, 'obtenerListaSedes'])->name('sedes.obtenerListaSedes');
        Route::post('sedes/parse-csv-import', [SedeController::class, 'parseCsvImport'])->name('sedes.parseCsvImport');
        Route::post('sedes/process-csv-import', [SedeController::class, 'processCsvImport'])->name('sedes.processCsvImport');
        Route::resource('sedes', SedeController::class);
        Route::get('sede-ubicacion/{data}', [SedeController::class, 'ubicacion']);
        Route::get('sedes/sede-ubicacionorganizacion/{id}', [SedeController::class, 'ubicacionorg']);

        //Grupo Areas
        Route::post('grupoarea/areas-relacionadas', [GrupoAreaController::class, 'getRelationatedAreas'])->name('grupoarea.getRelationatedAreas');
        Route::delete('grupoarea/destroy', [GrupoAreaController::class,'massDestroy'])->name('grupoarea.massDestroy');
        Route::post('grupoarea/parse-csv-import', [GrupoAreaController::class,'parseCsvImport'])->name('grupoarea.parseCsvImport');
        Route::post('grupoarea/process-csv-import', [GrupoAreaController::class,'processCsvImport'])->name('grupoarea.processCsvImport');
        Route::resource('grupoarea', GrupoAreaController::class);

        // Indicadores Sgsis
        Route::get('evaluaciones-sgsisInsertar', [IndicadoresSgsiController::class,'evaluacionesInsert'])->name('evaluacionesInsert');
        Route::delete('indicadores-sgsis/destroy', [IndicadoresSgsiController::class,'massDestroy'])->name('indicadores-sgsis.massDestroy');
        Route::resource('indicadores-sgsis', IndicadoresSgsiController::class);
        Route::get('indicadores-sgsisInsertar', [IndicadoresSgsiController::class,'IndicadorInsert'])->name('indicadores-sgsisInsertar');
        Route::get('indicadores-sgsisUpdate', [IndicadoresSgsiController::class,'IndicadorUpdate'])->name('indicadores-sgsisUpdate');
        Route::get('evaluaciones-sgsisUpdate', [IndicadoresSgsiController::class,'evaluacionesUpdate'])->name('evaluacionesUpdate');

        // Indicadorincidentessis
        Route::resource('indicadorincidentessis', [IndicadorincidentessiController::class], ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

        // Auditoria Anuals
        Route::delete('auditoria-anuals/destroy', [AuditoriaAnualController::class,'massDestroy'])->name('auditoria-anuals.massDestroy');
        Route::resource('auditoria-anuals', AuditoriaAnualController::class);

        // Plan Auditoria
        Route::delete('plan-auditoria/destroy', [PlanAuditoriaController::class,'massDestroy'])->name('plan-auditoria.massDestroy');
        Route::resource('plan-auditoria', PlanAuditoriaController::class);

        // Accion Correctivas
        Route::get('accion-correctiva-actividades/{accion_correctiva_id}', [ActividadAccionCorrectivaController::class,'index'])->name('accion-correctiva-actividades.index');
        Route::resource('accion-correctiva-actividades', ActividadAccionCorrectivaController::class)->except(['index']);
        Route::delete('accion-correctivas/destroy', [AccionCorrectivaController::class,'massDestroy'])->name('accion-correctivas.massDestroy');
        Route::post('accion-correctivas/media', [AccionCorrectivaController::class,'storeMedia'])->name('accion-correctivas.storeMedia');
        Route::post('accion-correctivas/ckmedia', [AccionCorrectivaController::class,'storeCKEditorImages'])->name('accion-correctivas.storeCKEditorImages');
        Route::post('accion-correctivas/{accion}/analisis/store', [AccionCorrectivaController::class,'storeAnalisis'])->name('accion-correctivas.storeAnalisis');
        Route::resource('accion-correctivas', AccionCorrectivaController::class);
        Route::get('plan-correctiva', [PlanaccionCorrectivaController::class,'planformulario'])->name('plantest');
        Route::post('accion-correctivas/editarplan', [PlanaccionCorrectivaController::class,'update']);
        Route::post('plan-correctivas-storeedit', [PlanaccionCorrectivaController::class,'storeEdit']);
        Route::post('planaccion-storered', [PlanaccionCorrectivaController::class,'storeRedirect'])->name('storered');

        // // Ajax
        // //Route::post('AjaxAccionCorrectivaCrear', 'AccionCorrectiva@store');

        // Planaccion Correctivas
        Route::delete('planaccion-correctivas/destroy', [PlanaccionCorrectivaController::class,'massDestroy'])->name('planaccion-correctivas.massDestroy');
        Route::resource('planaccion-correctivas', PlanaccionCorrectivaController::class);

        // Registromejoras
        Route::delete('registromejoras/destroy', [RegistromejoraController::class,'massDestroy'])->name('registromejoras.massDestroy');
        Route::resource('registromejoras', RegistromejoraController::class);

        // Dmaics
        Route::delete('dmaics/destroy', [DmaicController::class,'massDestroy'])->name('dmaics.massDestroy');
        Route::resource('dmaics', DmaicController::class);

        // Plan Mejoras
        Route::delete('plan-mejoras/destroy', [PlanMejoraController::class,'massDestroy'])->name('plan-mejoras.massDestroy');
        Route::resource('plan-mejoras', PlanMejoraController::class);

        // Enlaces Ejecutars
        Route::delete('enlaces-ejecutars/destroy', [EnlacesEjecutarController::class,'massDestroy'])->name('enlaces-ejecutars.massDestroy');
        Route::resource('enlaces-ejecutars', EnlacesEjecutarController::class);

        // Teams
        Route::delete('teams/destroy', [TeamController::class,'massDestroy'])->name('teams.massDestroy');
        Route::resource('teams', TeamController::class);

        // Incidentes De Seguridads
        Route::delete('incidentes-de-seguridads/destroy', [IncidentesDeSeguridadController::class,'massDestroy'])->name('incidentes-de-seguridads.massDestroy');
        Route::resource('incidentes-de-seguridads', IncidentesDeSeguridadController::class);

        // Estado Incidentes
        Route::delete('estado-incidentes/destroy', [EstadoIncidentesController::class,'massDestroy'])->name('estado-incidentes.massDestroy');
        Route::resource('estado-incidentes', EstadoIncidentesController::class);

        // Estatus Plan Trabajos
        Route::delete('estatus-plan-trabajos/destroy', [EstatusPlanTrabajoController::class,'massDestroy'])->name('estatus-plan-trabajos.massDestroy');
        Route::resource('estatus-plan-trabajos', EstatusPlanTrabajoController::class);

        // Carpeta
        Route::delete('carpeta/destroy', [CarpetasController::class,'massDestroy'])->name('carpeta.massDestroy');
        Route::resource('carpeta', CarpetasController::class);

        // Archivos
        Route::delete('archivos/destroy', [ArchivosController::class,'massDestroy'])->name('archivos.massDestroy');
        Route::post('archivos/media', [ArchivosController::class,'storeMedia'])->name('archivos.storeMedia');
        Route::post('archivos/ckmedia', [ArchivosController::class,'storeCKEditorImages'])->name('archivos.storeCKEditorImages');
        Route::resource('archivos', ArchivosController::class);

        // Estado Documentos
        Route::delete('estado-documentos/destroy', [EstadoDocumentoController::class,'massDestroy'])->name('estado-documentos.massDestroy');
        Route::resource('estado-documentos', EstadoDocumentoController::class);

        // Faq Categories
        Route::delete('faq-categories/destroy', [FaqCategoryController::class,'massDestroy'])->name('faq-categories.massDestroy');
        Route::resource('faq-categories', FaqCategoryController::class);

        // Faq Questions
        Route::delete('faq-questions/destroy', [FaqQuestionController::class,'massDestroy'])->name('faq-questions.massDestroy');
        Route::resource('faq-questions', FaqQuestionController::class);

        Route::get('system-calendar', [SystemCalendarController::class,'index'])->name('systemCalendar');
        Route::get('global-search', [GlobalSearchController::class,'search'])->name('globalSearch');
        Route::post('global-structure-search', [GlobalStructureSearchController::class,'globalSearch'])->name('globalStructureSearch');
        Route::get('user-alerts/read', [UserAlertsController::class,'read']);
        Route::get('team-members', [TeamMembersController::class,'index'])->name('team-members.index');
        Route::post('team-members', [TeamMembersController::class,'invite'])->name('team-members.invite');

        //amenzas
        Route::resource('amenazas', AmenazaController::class);
        Route::delete('amenazas/destroy', [AmenazaController::class,'massDestroy'])->name('amenazas.massDestroy');
        Route::post('amenazas/parse-csv-import', [AmenazaController::class,'parseCsvImport'])->name('amenazas.parseCsvImport');
        Route::post('amenazas/process-csv-import', [AmenazaController::class,'processCsvImport'])->name('amenazas.processCsvImport');

        //vulnerabilidades
        Route::resource('vulnerabilidads', VulnerabilidadController::class);
        Route::delete('vulnerabilidads/destroy', [VulnerabilidadController::class,'massDestroy'])->name('vulnerabilidads.massDestroy');
        Route::post('vulnerabilidads/parse-csv-import', [VulnerabilidadController::class,'parseCsvImport'])->name('vulnerabilidads.parseCsvImport');
        Route::post('vulnerabilidads/process-csv-import', [VulnerabilidadController::class,'processCsvImport'])->name('vulnerabilidads.processCsvImport');

        // analisis Riesgos
        Route::delete('analisis-riesgos/destroy', [AnalisisdeRiesgosController::class,'massDestroy'])->name('analisis-riesgos.massDestroy');
        Route::resource('analisis-riesgos', AnalisisdeRiesgosController::class);
        Route::get('getEmployeeData', [AnalisisdeRiesgosController::class,'getEmployeeData'])->name('getEmployeeData');

        // Matriz Riesgos
        Route::get('matriz-riesgos/planes-de-accion/create/{id}', [MatrizRiesgosController::class,'createPlanAccion'])->name('matriz-riesgos.createPlanAccion');
        Route::post('matriz-riesgos/planes-de-accion/store/{id}', [MatrizRiesgosController::class,'storePlanAccion'])->name('matriz-riesgos.storePlanAccion');
        Route::delete('matriz-riesgos/destroy', [MatrizRiesgosController::class,'massDestroy'])->name('matriz-riesgos.massDestroy');
        Route::resource('matriz-riesgos', MatrizRiesgosController::class);
        Route::post('matriz-riesgos/parse-csv-import', [MatrizRiesgosController::class,'parseCsvImport'])->name('matriz-riesgos.parseCsvImport');
        Route::get('matriz-seguridad', [MatrizRiesgosController::class,'SeguridadInfo'])->name('matriz-seguridad');
        Route::get('matriz-seguridadMapa', [MatrizRiesgosController::class,'MapaCalor'])->name('matriz-mapa');
        Route::get('controles-get', [MatrizRiesgosController::class,'ControlesGet'])->name('controles-get');

        // Gap Unos
        Route::delete('gap-unos/destroy', [GapUnoController::class,'massDestroy'])->name('gap-unos.massDestroy');
        Route::resource('gap-unos', GapUnoController::class);

        // Gap Dos
        Route::delete('gap-dos/destroy', [GapDosController::class,'massDestroy'])->name('gap-dos.massDestroy');
        Route::resource('gap-dos', GapDosController::class);

        // Gap Tres
        Route::delete('gap-tres/destroy', [GapTresController::class,'@massDestroy'])->name('gap-tres.massDestroy');
        Route::resource('gap-tres', GapTresController::class);

        //Revisiones Documentos
        Route::get('/revisiones/archivo', [RevisionDocumentoController::class,'archivo'])->name('revisiones.archivo');
        Route::post('/revisiones/archivar', [RevisionDocumentoController::class,'archivar'])->name('revisiones.archivar');
        Route::post('/revisiones/desarchivar', [RevisionDocumentoController::class,'desarchivar'])->name('revisiones.desarchivar');

        //Documentos
        Route::get('documentos/publicados', [DocumentosController::class, 'publicados'])->name('documentos.publicados');
        Route::patch('documentos/{documento}/update-when-publish', [DocumentosController::class, 'updateDocumentWhenPublish'])->name('documentos.updateDocumentWhenPublish');
        Route::post('documentos/store-when-publish', [DocumentosController::class, 'storeDocumentWhenPublish'])->name('documentos.storeDocumentWhenPublish');
        Route::post('documentos/publish', [DocumentosController::class, 'publish'])->name('documentos.publish');
        Route::post('documentos/check-code', [DocumentosController::class, 'checkCode'])->name('documentos.checkCode');
        Route::get('documentos/{documento}/view-document', [DocumentosController::class, 'renderViewDocument'])->name('documentos.renderViewDocument');
        Route::get('documentos/{documento}/history-reviews', [DocumentosController::class, 'renderHistoryReview'])->name('documentos.renderHistoryReview');
        Route::get('documentos/{documento}/document-versions', [DocumentosController::class, 'renderHistoryVersions'])->name('documentos.renderHistoryVersions');
        Route::post('documentos/dependencies', [DocumentosController::class, 'getDocumentDependencies'])->name('documentos.getDocumentDependencies');
        Route::delete('documentos/{documento}/', [DocumentosController::class, 'destroy'])->name('documentos.destroy');
        Route::resource('documentos', DocumentosController::class);

        // Control Documentos
        Route::delete('control-documentos/destroy', [ControlDocumentosController::class,'massDestroy'])->name('control-documentos.massDestroy');
        Route::resource('control-documentos', ControlDocumentosController::class, ['except' => ['create']]);

        Route::get('system-calendar', [SystemCalendarController::class,'index'])->name('systemCalendar');
        Route::get('global-search', [GlobalSearchController::class,'search'])->name('globalSearch');
        Route::get('user-alerts/read', [UserAlertsController::class,'read']);
        Route::get('team-members', [TeamMembersController::class,'index'])->name('team-members.index');
        Route::post('team-members', [TeamMembersController::class,'invite'])->name('team-members.invite');

        //REPORTES CONTEXTO 27001
        Route::get('reportes-contexto/', [ReporteContextoController::class,'index'])->name('reportes-contexto.index');
        Route::post('reportes-contexto/create', [ReporteContextoController::class,'store'])->name('reportes-contexto.store');
    });
});
