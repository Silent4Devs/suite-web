<?php

//Route::view('/', 'welcome');

use App\Http\Controllers\Admin\CategoriaCapacitacionController;
use App\Http\Controllers\Admin\DocumentosController;
use App\Http\Controllers\Admin\GrupoAreaController;
use App\Http\Controllers\Admin\RH\EV360GrupoCompetenciasController;
use App\Http\Controllers\Admin\RH\EV360NivelesDominioController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Livewire\NotificacionesComponent;
use App\Models\RH\GrupoCompetencia;
use App\Models\RH\NivelDominio;
use App\Models\RH\PeriodoEvaluacion;

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::post('/revisiones/approve', 'RevisionDocumentoController@approve')->name('revisiones.approve');
Route::post('/revisiones/reject', 'RevisionDocumentoController@reject')->name('revisiones.reject');
Route::get('/revisiones/{revisionDocumento}', 'RevisionDocumentoController@edit')->name('revisiones.revisar');

Route::post('/minutas/revisiones/approve', 'RevisionMinutasController@approve')->name('minutas.revisiones.approve');
Route::post('/minutas/revisiones/reject', 'RevisionMinutasController@reject')->name('minutas.revisiones.reject');
Route::get('/minutas/revisiones/{revisionMinuta}', 'RevisionMinutasController@edit')->name('minutas.revisiones.revisar');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('recursos-humanos/evaluacion-360', 'RH\Evaluacion360Controller@index')->name('rh-evaluacion360.index');

    Route::get('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/participantes', 'RH\EV360EvaluacionesController@getParticipantes')->name('ev360-evaluaciones.getParticipantes');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/competencia', 'RH\EV360EvaluacionesController@relatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.relatedCompetenciaWithEvaluacion');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/competencia/delete', 'RH\EV360EvaluacionesController@deleteRelatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.deleteRelatedCompetenciaWithEvaluacion');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/objetivo', 'RH\EV360EvaluacionesController@relatedObjetivoWithEvaluacion')->name('ev360-evaluaciones.relatedObjetivoWithEvaluacion');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/objetivo/delete', 'RH\EV360EvaluacionesController@deleteRelatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.deleteRelatedObjetivoWithEvaluacion');
    Route::get('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/evaluacion', 'RH\EV360EvaluacionesController@evaluacion')->name('ev360-evaluaciones.evaluacion');
    Route::get('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/evaluacion/{evaluado}/{evaluador}', 'RH\EV360EvaluacionesController@contestarCuestionario')->name('ev360-evaluaciones.contestarCuestionario');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/evaluacion/{evaluado}/{evaluador}/cerrar', 'RH\EV360EvaluacionesController@finalizarEvaluacion')->name('ev360-evaluaciones.finalizarEvaluacion');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/objetivo/meta-alcanzada-descripcion/store', 'RH\EV360EvaluacionesController@storeMetaAlcanzadaDescripcion')->name('ev360-evaluaciones.objetivos.storeMetaAlcanzadaDescripcion');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/objetivo/meta-alcanzada/store', 'RH\EV360EvaluacionesController@storeMetaAlcanzada')->name('ev360-evaluaciones.objetivos.storeMetaAlcanzada');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/iniciar', 'RH\EV360EvaluacionesController@iniciarEvaluacion')->name('ev360-evaluaciones.iniciarEvaluacion');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/postergar', 'RH\EV360EvaluacionesController@postergarEvaluacion')->name('ev360-evaluaciones.postergarEvaluacion');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/cerrar', 'RH\EV360EvaluacionesController@cerrarEvaluacion')->name('ev360-evaluaciones.cerrarEvaluacion');
    Route::post('recursos-humanos/evaluacion-360/autoevaluacion/competencias/obtener', 'RH\EV360EvaluacionesController@getAutoevaluacionCompetencias')->name('ev360-evaluaciones.autoevaluacion.competencias.get');
    Route::post('recursos-humanos/evaluacion-360/autoevaluacion/objetivos/obtener', 'RH\EV360EvaluacionesController@getAutoevaluacionObjetivos')->name('ev360-evaluaciones.autoevaluacion.objetivos.get');
    Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/consulta/{evaluado}', 'RH\EV360EvaluacionesController@consultaPorEvaluado')->name('ev360-evaluaciones.autoevaluacion.consulta.evaluado');
    Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/resumen', 'RH\EV360EvaluacionesController@resumen')->name('ev360-evaluaciones.consulta.resumen');
    Route::resource('recursos-humanos/evaluacion-360/evaluaciones', 'RH\EV360EvaluacionesController')->names([
        'index' => 'ev360-evaluaciones.index',
        'create' => 'ev360-evaluaciones.create',
        'store' => 'ev360-evaluaciones.store',
        'show' => 'ev360-evaluaciones.show',
        'edit' => 'ev360-evaluaciones.edit',
        'update' => 'ev360-evaluaciones.update',
    ]);

    Route::post('recursos-humanos/evaluacion-360/evaluaciones/evaluado-evaluador/remover', 'RH\EvaluadoEvaluadorController@remover')->name('ev360-evaluaciones.evaluadores.remover');
    Route::post('recursos-humanos/evaluacion-360/evaluaciones/evaluado-evaluador/agregar', 'RH\EvaluadoEvaluadorController@agregar')->name('ev360-evaluaciones.evaluadores.agregar');

    Route::post('recursos-humanos/evaluacion-360/competencias/store-redirect', 'RH\EV360CompetenciasController@storeAndRedirect')->name('ev360-competencias.conductas');
    Route::get('recursos-humanos/evaluacion-360/competencias/{competencia}/conductas', 'RH\EV360CompetenciasController@conductas')->name('ev360-competencias.obtenerConductas');
    Route::get('recursos-humanos/evaluacion-360/competencias/{competencia}/informacion', 'RH\EV360CompetenciasController@informacionCompetencia')->name('ev360-competencias.informacionCompetencia');
    Route::post('recursos-humanos/evaluacion-360/competencias/{competencia}/repuesta', 'RH\EV360CompetenciasController@guardarRespuestaCompetencia')->name('ev360-competencias.guardarRespuestaCompetencia');
    Route::resource('recursos-humanos/evaluacion-360/competencias', 'RH\EV360CompetenciasController')->names([
        'index' => 'ev360-competencias.index',
        'create' => 'ev360-competencias.create',
        'store' => 'ev360-competencias.store',
        'show' => 'ev360-competencias.show',
        'edit' => 'ev360-competencias.edit',
        'update' => 'ev360-competencias.update',
    ]);


    Route::post('recursos-humanos/evaluacion-360/conductas/store', 'RH\EV360ConductasController@store')->name('ev360-conductas.store');
    Route::get('recursos-humanos/evaluacion-360/conductas/{conducta}/edit', 'RH\EV360ConductasController@edit')->name('ev360-conductas.edit');
    Route::patch('recursos-humanos/evaluacion-360/conductas/{conducta}', 'RH\EV360ConductasController@update')->name('ev360-conductas.update');
    Route::delete('recursos-humanos/evaluacion-360/conductas/{conducta}', 'RH\EV360ConductasController@destroy')->name('ev360-conductas.destroy');


    Route::get('recursos-humanos/evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@createByEmpleado')->name('ev360-objetivos-empleado.create');
    Route::post('recursos-humanos/evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@storeByEmpleado')->name('ev360-objetivos-empleado.store');
    Route::resource('recursos-humanos/evaluacion-360/objetivos', 'RH\EV360ObjetivosController')->names([
        'index' => 'ev360-objetivos.index',
        'create' => 'ev360-objetivos.create',
        'store' => 'ev360-objetivos.store',
        'show' => 'ev360-objetivos.show',
        'edit' => 'ev360-objetivos.edit',
        'update' => 'ev360-objetivos.update',
    ]);


    // Route::resource('recursos-humanos/evaluacion-360/periodo', 'RH\EV360EvaluacionPeriodosController')->names([
    //     'index' => 'ev360-periodo.index',
    //     'create' => 'ev360-periodo.create',
    //     'store' => 'ev360-periodo.store',
    //     'show' => 'ev360-periodo.show',
    //     'edit' => 'ev360-periodo.edit',
    //     'update' => 'ev360-periodo.update',
    // ]);

    Route::view('iso27001', 'admin.iso27001.index')->name('iso27001.index');

    Route::view('soporte', 'admin.soporte.index')->name('soporte.index');


    Route::get('portal-comunicacion/reportes', 'PortalComunicacionController@reportes')->name('portal-comunicacion.reportes');
    Route::resource('portal-comunicacion', 'PortalComunicacionController');

    Route::post('plantTrabajoBase/bloqueo/mostrar', 'LockedPlanTrabajoController@getLockedToPlanTrabajo')->name('lockedPlan.getLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/quitar', 'LockedPlanTrabajoController@removeLockedToPlanTrabajo')->name('lockedPlan.removeLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/is-locked', 'LockedPlanTrabajoController@isLockedToPlanTrabajo')->name('lockedPlan.isLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/registrar', 'LockedPlanTrabajoController@setLockedToPlanTrabajo')->name('lockedPlan.setLockedToPlanTrabajo');

    Route::get('inicioUsuario', 'inicioUsuarioController@index')->name('inicio-Usuario.index');

    Route::get('inicioUsuario/reportes/quejas', 'inicioUsuarioController@quejas')->name('reportes-quejas');
    Route::post('inicioUsuario/reportes/quejas', 'inicioUsuarioController@storeQuejas')->name('reportes-quejas-store');

    Route::get('inicioUsuario/reportes/denuncias', 'inicioUsuarioController@denuncias')->name('reportes-denuncias');
    Route::post('inicioUsuario/reportes/denuncias', 'inicioUsuarioController@storeDenuncias')->name('reportes-denuncias-store');

    Route::get('inicioUsuario/reportes/mejoras', 'inicioUsuarioController@mejoras')->name('reportes-mejoras');
    Route::post('inicioUsuario/reportes/mejoras', 'inicioUsuarioController@storeMejoras')->name('reportes-mejoras-store');

    Route::get('inicioUsuario/reportes/sugerencias', 'inicioUsuarioController@sugerencias')->name('reportes-sugerencias');
    Route::post('inicioUsuario/reportes/sugerencias', 'inicioUsuarioController@storeSugerencias')->name('reportes-sugerencias-store');

    Route::get('inicioUsuario/reportes/seguridad', 'inicioUsuarioController@seguridad')->name('reportes-seguridad');
    Route::post('inicioUsuario/reportes/seguridad/media', 'inicioUsuarioController@storeMedia')->name('reportes-seguridad.storeMedia');
    Route::post('inicioUsuario/reportes/seguridad', 'inicioUsuarioController@storeSeguridad')->name('reportes-seguridad-store');

    Route::get('inicioUsuario/reportes/riesgos', 'inicioUsuarioController@riesgos')->name('reportes-riesgos');
    Route::post('inicioUsuario/reportes/riesgos', 'inicioUsuarioController@storeRiesgos')->name('reportes-riesgos-store');

    Route::post('inicioUsuario/capacitaciones/archivar', 'inicioUsuarioController@archivarCapacitacion')->name('inicio-Usuario.capacitaciones.archivar');

    Route::get('desk', 'DeskController@index')->name('desk.index');


    Route::post('desk/{seguridad}/analisis_seguridad-update', 'DeskController@updateAnalisisSeguridad')->name('desk.analisis_seguridad-update');
    Route::post('desk/{riesgos}/analisis_riesgo-update', 'DeskController@updateAnalisisReisgos')->name('desk.analisis_riesgo-update');
    Route::post('desk/{mejoras}/analisis_mejora-update', 'DeskController@updateAnalisisMejoras')->name('desk.analisis_mejora-update');
    Route::post('desk/{quejas}/analisis_queja-update', 'DeskController@updateAnalisisQuejas')->name('desk.analisis_queja-update');
    Route::post('desk/{denuncias}/analisis_denuncia-update', 'DeskController@updateAnalisisDenuncias')->name('desk.analisis_denuncia-update');
    Route::post('desk/{sugerencias}/analisis_sugerencia-update', 'DeskController@updateAnalisisSugerencias')->name('desk.analisis_sugerencia-update');


    Route::get('desk/{seguridad}/seguridad-edit', 'DeskController@editSeguridad')->name('desk.seguridad-edit');
    Route::post('desk/{seguridad}/seguridad-update', 'DeskController@updateSeguridad')->name('desk.seguridad-update');
    Route::post('desk/{incidente}/archivar', 'DeskController@archivadoSeguridad')->name('desk.seguridad-archivar');
    Route::get('desk/seguridad-archivo', 'DeskController@archivoSeguridad')->name('desk.seguridad-archivo');
    Route::get('desk/seguridad', 'DeskController@indexSeguridad')->name('desk.seguridad-index');

    Route::get('desk/{riesgos}/riesgos-edit', 'DeskController@editRiesgos')->name('desk.riesgos-edit');
    Route::post('desk/{riesgos}/riesgos-update', 'DeskController@updateRiesgos')->name('desk.riesgos-update');

    Route::get('desk/{quejas}/quejas-edit', 'DeskController@editQuejas')->name('desk.quejas-edit');
    Route::post('desk/{quejas}/quejas-update', 'DeskController@updateQuejas')->name('desk.quejas-update');

    Route::get('desk/{denuncias}/denuncias-edit', 'DeskController@editDenuncias')->name('desk.denuncias-edit');
    Route::post('desk/{denuncias}/denuncias-update', 'DeskController@updateDenuncias')->name('desk.denuncias-update');

    Route::get('desk/{mejoras}/mejoras-edit', 'DeskController@editMejoras')->name('desk.mejoras-edit');
    Route::post('desk/{mejoras}/mejoras-update', 'DeskController@updateMejoras')->name('desk.mejoras-update');

    Route::get('desk/{sugerencias}/sugerencias-edit', 'DeskController@editSugerencias')->name('desk.sugerencias-edit');
    Route::post('desk/{sugerencias}/sugerencias-update', 'DeskController@updateSugerencias')->name('desk.sugerencias-update');

    // Actividades DESK - Plan Accion
    Route::get('desk-seguridad-actividades/{seguridad_id}', 'ActividadesIncidentesController@index')->name('desk-seguridad-actividades.index');
    Route::resource('desk-seguridad-actividades', 'ActividadesIncidentesController')->except(['index']);

    Route::get('desk-riesgos-actividades/{riesgo_id}', 'ActividadesRiesgosController@index')->name('desk-riesgos-actividades.index');
    Route::resource('desk-riesgos-actividades', 'ActividadesRiesgosController')->except(['index']);

    Route::get('desk-quejas-actividades/{queja_id}', 'ActividadesQuejasController@index')->name('desk-quejas-actividades.index');
    Route::resource('desk-quejas-actividades', 'ActividadesQuejasController')->except(['index']);

    Route::get('desk-denuncias-actividades/{denuncia_id}', 'ActividadesDenunciasController@index')->name('desk-denuncias-actividades.index');
    Route::resource('desk-denuncias-actividades', 'ActividadesDenunciasController')->except(['index']);

    Route::get('desk-mejoras-actividades/{mejora_id}', 'ActividadesMejorasController@index')->name('desk-mejoras-actividades.index');
    Route::resource('desk-mejoras-actividades', 'ActividadesMejorasController')->except(['index']);

    Route::get('desk-sugerencias-actividades/{sugerencia_id}', 'ActividadesSugerenciasController@index')->name('desk-sugerencias-actividades.index');
    Route::resource('desk-sugerencias-actividades', 'ActividadesSugerenciasController')->except(['index']);

    Route::get('planTrabajoBase', 'PlanTrabajoBaseController@index')->name('planTrabajoBase.index');
    Route::post('planTrabajoBase/save/current', 'PlanTrabajoBaseController@saveCurrentProyect')->name('planTrabajoBase.saveCurrentProyect');
    Route::post('planTrabajoBase/save/status', 'PlanTrabajoBaseController@saveStatus')->name('planTrabajoBase.saveStatus');
    Route::post('planTrabajoBase/check/changes', 'PlanTrabajoBaseController@checkChanges')->name('planTrabajoBase.checkChanges');
    Route::post('planTrabajoBase/save', 'PlanTrabajoBaseController@saveImplementationProyect')->name('planTrabajoBase.saveProyect');
    Route::post('planTrabajoBase/load', 'PlanTrabajoBaseController@loadProyect')->name('planTrabajoBase.loadProyect');

    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    //analisis brechas
    //Route::resource('analisis-brechas', 'AnalisisBController');
    Route::get('analisis-brechas', 'AnalisisBController@index')->name('analisis-brechas.index');
    Route::post('analisis-brechas/update', 'AnalisisBController@update');

    // Declaracion de Aplicabilidad
    Route::get('declaracion-aplicabilidad/descargar', 'DeclaracionAplicabilidadController@download')->name('declaracion-aplicabilidad.descargar');
    Route::delete('declaracion-aplicabilidad/destroy', 'DeclaracionAplicabilidadController@massDestroy')->name('declaracion-aplicabilidad.massDestroy');
    Route::resource('declaracion-aplicabilidad', 'DeclaracionAplicabilidadController');

    //gantt
    Route::get('gantt', 'GanttController@index');
    Route::post('gantt/update', 'GanttController@update');

    // Roles
    Route::get('roles/{role}/permisos', 'RolesController@getPermissions')->name('roles.getPermissions');
    Route::patch('roles/{role}/edit', 'RolesController@update')->name('roles.patch');
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    //procesos

    Route::get('mapa-procesos', 'ProcesoController@mapaProcesos')->name('procesos.mapa');
    Route::get('procesos/{documento}/vista', 'ProcesoController@obtenerDocumentoProcesos')->name('procesos.obtenerDocumentoProcesos');
    Route::resource('procesos', 'ProcesoController');
    Route::post('selectIndicador', 'ProcesoController@AjaxRequestIndicador')->name('selectIndicador');
    Route::post('selectRiesgos', 'ProcesoController@AjaxRequestRiesgos')->name('selectRiesgos');

    //macroprocesos
    Route::resource('macroprocesos', 'MacroprocesoController');

    // Users
    Route::post('users/vincular', 'UsersController@vincularEmpleado')->name('users.vincular');
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    //Route::post('users/get', 'UsersController@getUsers')->name('users.get');
    Route::resource('users', 'UsersController');

    // Empleados
    Route::post('empleados/store/{empleado}/competencias-resumen', 'EmpleadoController@storeResumen')->name('empleados.storeResumen');
    Route::post('empleados/store/{empleado}/competencias-certificaciones', 'EmpleadoController@storeCertificaciones')->name('empleados.storeCertificaciones');
    Route::delete('empleados/delete/{certificacion}/competencias-certificaciones', 'EmpleadoController@deleteCertificaciones')->name('empleados.deleteCertificaciones');
    Route::post('empleados/store/{empleado}/competencias-cursos', 'EmpleadoController@storeCursos')->name('empleados.storeCursos');
    Route::delete('empleados/delete/{curso}/competencias-cursos', 'EmpleadoController@deleteCursos')->name('empleados.deleteCursos');
    Route::post('empleados/store/{empleado}/competencias-experiencia', 'EmpleadoController@storeExperiencia')->name('empleados.storeExperiencia');
    Route::delete('empleados/delete/{educacion}/competencias-educacion', 'EmpleadoController@deleteEducacion')->name('empleados.deleteEducacion');
    Route::post('empleados/store/{empleado}/competencias-educacion', 'EmpleadoController@storeEducacion')->name('empleados.storeEducacion');
    Route::delete('empleados/delete/{experiencia}/competencias-experiencia', 'EmpleadoController@deleteExperiencia')->name('empleados.deleteExperiencia');
    Route::get('empleados/store/{empleado}/competencias-certificaciones', 'EmpleadoController@getCertificaciones')->name('empleados.getCertificaciones');
    Route::get('empleados/store/{empleado}/competencias-educacion', 'EmpleadoController@getEducacion')->name('empleados.getEducacion');
    Route::get('empleados/store/{empleado}/competencias-experiencia', 'EmpleadoController@getExperiencia')->name('empleados.getExperiencia');
    Route::get('empleados/store/{empleado}/competencias-cursos', 'EmpleadoController@getCursos')->name('empleados.getCursos');
    Route::post('empleados/store/competencias', 'EmpleadoController@storeWithCompetencia')->name('empleados.storeWithCompetencia');
    Route::post('empleados/get', 'EmpleadoController@getEmpleados')->name('empleados.get');
    Route::post('empleados/get-lista', 'EmpleadoController@getListaEmpleados')->name('empleados.lista');
    Route::get('empleados/get-all', 'EmpleadoController@getAllEmpleados')->name('empleados.getAll');
    Route::resource('empleados', 'EmpleadoController');


    // Organizacions
    Route::delete('organizacions/destroy', 'OrganizacionController@massDestroy')->name('organizacions.massDestroy');
    Route::post('organizacions/media', 'OrganizacionController@storeMedia')->name('organizacions.storeMedia');
    Route::post('organizacions/ckmedia', 'OrganizacionController@storeCKEditorImages')->name('organizacions.storeCKEditorImages');
    Route::resource('organizacions', 'OrganizacionController');

    Route::get('organigrama/exportar', 'OrganigramaController@exportTo')->name('organigrama.exportar');
    Route::get('organigrama', 'OrganigramaController@index')->name('organigrama.index');

    // Dashboards
    Route::resource('dashboards', 'DashboardController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Implementacions

    Route::resource('implementacions', 'ImplementacionController');

    // Planes de Acción
    Route::post('planes-de-accion/{plan}/save', 'PlanesAccionController@saveProject')->name('planes-de-accion.saveProject');
    Route::post('planes-de-accion/{plan}/load', 'PlanesAccionController@loadProject')->name('planes-de-accion.loadProject');
    // Route::get('planes-de-accion/create/', 'PlanesAccionController@create')->name('planes-de-accion.create');
    Route::resource('planes-de-accion', 'PlanesAccionController')->except(['create']);

    // Glosarios
    Route::delete('glosarios/destroy', 'GlosarioController@massDestroy')->name('glosarios.massDestroy');
    Route::resource('glosarios', 'GlosarioController');

    // Plan Base Actividades
    Route::delete('plan-base-actividades/destroy', 'PlanBaseActividadesController@massDestroy')->name('plan-base-actividades.massDestroy');
    Route::post('plan-base-actividades/media', 'PlanBaseActividadesController@storeMedia')->name('plan-base-actividades.storeMedia');
    Route::post('plan-base-actividades/ckmedia', 'PlanBaseActividadesController@storeCKEditorImages')->name('plan-base-actividades.storeCKEditorImages');
    Route::resource('plan-base-actividades', 'PlanBaseActividadesController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Entendimiento Organizacions
    Route::delete('entendimiento-organizacions/destroy', 'EntendimientoOrganizacionController@massDestroy')->name('entendimiento-organizacions.massDestroy');
    Route::resource('entendimiento-organizacions', 'EntendimientoOrganizacionController');
    Route::post('entendimiento-organizacions/parse-csv-import', 'EntendimientoOrganizacionController@parseCsvImport')->name('entendimiento-organizacions.parseCsvImport');
    Route::post('areas/process-csv-import', 'AreasController@processCsvImport')->name('areas.processCsvImport');

    // Partes Interesadas
    Route::delete('partes-interesadas/destroy', 'PartesInteresadasController@massDestroy')->name('partes-interesadas.massDestroy');
    Route::resource('partes-interesadas', 'PartesInteresadasController');

    // Matriz Requisito Legales
    Route::get('matriz-requisito-legales/planes-de-accion/create/{id}', 'MatrizRequisitoLegalesController@createPlanAccion')->name('matriz-requisito-legales.createPlanAccion');
    Route::post('matriz-requisito-legales/planes-de-accion/store/{id}', 'MatrizRequisitoLegalesController@storePlanAccion')->name('matriz-requisito-legales.storePlanAccion');
    Route::delete('matriz-requisito-legales/destroy', 'MatrizRequisitoLegalesController@massDestroy')->name('matriz-requisito-legales.massDestroy');
    Route::resource('matriz-requisito-legales', 'MatrizRequisitoLegalesController');

    // Alcance Sgsis
    Route::delete('alcance-sgsis/destroy', 'AlcanceSgsiController@massDestroy')->name('alcance-sgsis.massDestroy');
    Route::resource('alcance-sgsis', 'AlcanceSgsiController');

    // Comiteseguridads
    Route::delete('comiteseguridads/destroy', 'ComiteseguridadController@massDestroy')->name('comiteseguridads.massDestroy');

    Route::get('comiteseguridads/visualizacion', 'ComiteseguridadController@visualizacion');

    Route::resource('comiteseguridads', 'ComiteseguridadController');

    // Minutasaltadireccions
    Route::get('minutasaltadireccions/{minuta}/minuta-documento', 'MinutasaltadireccionController@renderViewDocument')->name('documentos.renderViewMinuta');
    Route::get('minutasaltadireccions/{minuta}/historial-revisiones', 'MinutasaltadireccionController@renderHistoryReview')->name('documentos.renderHistoryReviewMinuta');
    Route::get('minutasaltadireccions/planes-de-accion/create/{id}', 'MinutasaltadireccionController@createPlanAccion')->name('minutasaltadireccions.createPlanAccion');
    Route::patch('minutasaltadireccions/{minuta}/update-and-review', 'MinutasaltadireccionController@updateAndReview')->name('minutasaltadireccions.updateAndReview');
    Route::post('minutasaltadireccions/planes-de-accion/store/{id}', 'MinutasaltadireccionController@storePlanAccion')->name('minutasaltadireccions.storePlanAccion');
    Route::delete('minutasaltadireccions/destroy', 'MinutasaltadireccionController@massDestroy')->name('minutasaltadireccions.massDestroy');
    Route::post('minutasaltadireccions/media', 'MinutasaltadireccionController@storeMedia')->name('minutasaltadireccions.storeMedia');
    Route::post('minutasaltadireccions/ckmedia', 'MinutasaltadireccionController@storeCKEditorImages')->name('minutasaltadireccions.storeCKEditorImages');
    Route::resource('minutasaltadireccions', 'MinutasaltadireccionController');

    // Evidencias Sgsis
    Route::delete('evidencias-sgsis/destroy', 'EvidenciasSgsiController@massDestroy')->name('evidencias-sgsis.massDestroy');
    Route::post('evidencias-sgsis/media', 'EvidenciasSgsiController@storeMedia')->name('evidencias-sgsis.storeMedia');
    Route::post('evidencias-sgsis/ckmedia', 'EvidenciasSgsiController@storeCKEditorImages')->name('evidencias-sgsis.storeCKEditorImages');
    Route::resource('evidencias-sgsis', 'EvidenciasSgsiController');

    // Politica Sgsis
    Route::delete('politica-sgsis/destroy', 'PoliticaSgsiController@massDestroy')->name('politica-sgsis.massDestroy');

    Route::get('politica-sgsis/visualizacion', 'PoliticaSgsiController@visualizacion')->name('politica-sgsis/visualizacion');

    Route::resource('politica-sgsis', 'PoliticaSgsiController');




    // Roles Responsabilidades
    Route::delete('roles-responsabilidades/destroy', 'RolesResponsabilidadesController@massDestroy')->name('roles-responsabilidades.massDestroy');
    Route::resource('roles-responsabilidades', 'm');

    // Riesgosoportunidades
    Route::delete('riesgosoportunidades/destroy', 'RiesgosoportunidadesController@massDestroy')->name('riesgosoportunidades.massDestroy');
    Route::resource('riesgosoportunidades', 'RiesgosoportunidadesController');

    // Objetivosseguridads
    Route::delete('objetivosseguridads/destroy', 'ObjetivosseguridadController@massDestroy')->name('objetivosseguridads.massDestroy');
    Route::resource('objetivosseguridads', 'ObjetivosseguridadController');
    Route::get('objetivosseguridadsInsertar', 'ObjetivosseguridadController@ObjetivoInsert')->name('objetivos-seguridadsInsertar');
    Route::get('evaluaciones-objetivosInsertar', 'ObjetivosseguridadController@evaluacionesInsert')->name('evaluacionesobjetivosInsert');
    Route::get('evaluaciones-objetivosShow', 'ObjetivosseguridadController@evaluacionesShow')->name('evaluacionesobjetivosShow');



    Route::resource('categoria-capacitacion', 'CategoriaCapacitacionController');

    // Recursos
    Route::delete('recursos/destroy', 'RecursosController@massDestroy')->name('recursos.massDestroy');
    Route::post('recursos/media', 'RecursosController@storeMedia')->name('recursos.storeMedia');
    Route::post('recursos/ckmedia', 'RecursosController@storeCKEditorImages')->name('recursos.storeCKEditorImages');
    Route::post('recursos/suscribir/', 'RecursosController@suscribir')->name('recursos.suscribir');
    Route::post('recursos/cancelar/', 'RecursosController@eliminarParticipante')->name('recursos.cancelar');
    Route::post('recursos/calificar/', 'RecursosController@calificarParticipante')->name('recursos.calificar');
    Route::get('recursos/{recurso}/participantes/', 'RecursosController@participantes')->name('recursos.participantes');
    Route::get('recursos/{recurso}/participantes/get', 'RecursosController@getParticipantes')->name('recursos.getParticipantes');
    Route::resource('recursos', 'RecursosController');

    // Competencia
    Route::delete('competencia/destroy', 'CompetenciasController@massDestroy')->name('competencia.massDestroy');
    Route::post('competencia/media', 'CompetenciasController@storeMedia')->name('competencia.storeMedia');
    Route::post('competencia/ckmedia', 'CompetenciasController@storeCKEditorImages')->name('competencia.storeCKEditorImages');
    Route::resource('competencia', 'CompetenciasController');
    Route::get('buscarCV', 'CompetenciasController@buscarcv')->name('buscarCV');

    // Adquirirveintidostrecientosunos
    Route::resource('adquirirveintidostrecientosunos', 'AdquirirveintidostrecientosunoController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Adquirirtreintaunmils
    Route::resource('adquirirtreintaunmils', 'AdquirirtreintaunmilController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Concientizacion Sgis
    Route::delete('concientizacion-sgis/destroy', 'ConcientizacionSgiController@massDestroy')->name('concientizacion-sgis.massDestroy');
    Route::post('concientizacion-sgis/media', 'ConcientizacionSgiController@storeMedia')->name('concientizacion-sgis.storeMedia');
    Route::post('concientizacion-sgis/ckmedia', 'ConcientizacionSgiController@storeCKEditorImages')->name('concientizacion-sgis.storeCKEditorImages');
    Route::resource('concientizacion-sgis', 'ConcientizacionSgiController');

    // Material Sgsis
    Route::delete('material-sgsis/destroy', 'MaterialSgsiController@massDestroy')->name('material-sgsis.massDestroy');
    Route::post('material-sgsis/media', 'MaterialSgsiController@storeMedia')->name('material-sgsis.storeMedia');
    Route::post('material-sgsis/ckmedia', 'MaterialSgsiController@storeCKEditorImages')->name('material-sgsis.storeCKEditorImages');
    Route::resource('material-sgsis', 'MaterialSgsiController');

    // Material Iso Veinticientes
    Route::delete('material-iso-veinticientes/destroy', 'MaterialIsoVeinticienteController@massDestroy')->name('material-iso-veinticientes.massDestroy');
    Route::post('material-iso-veinticientes/media', 'MaterialIsoVeinticienteController@storeMedia')->name('material-iso-veinticientes.storeMedia');
    Route::post('material-iso-veinticientes/ckmedia', 'MaterialIsoVeinticienteController@storeCKEditorImages')->name('material-iso-veinticientes.storeCKEditorImages');
    Route::resource('material-iso-veinticientes', 'MaterialIsoVeinticienteController');

    // Comunicacion Sgis
    Route::delete('comunicacion-sgis/destroy', 'ComunicacionSgiController@massDestroy')->name('comunicacion-sgis.massDestroy');
    Route::post('comunicacion-sgis/media', 'ComunicacionSgiController@storeMedia')->name('comunicacion-sgis.storeMedia');
    Route::post('comunicacion-sgis/ckmedia', 'ComunicacionSgiController@storeCKEditorImages')->name('comunicacion-sgis.storeCKEditorImages');
    Route::resource('comunicacion-sgis', 'ComunicacionSgiController');

    // Politica Del Sgsi Soportes
    Route::resource('politica-del-sgsi-soportes', 'PoliticaDelSgsiSoporteController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Control Accesos
    Route::delete('control-accesos/destroy', 'ControlAccesoController@massDestroy')->name('control-accesos.massDestroy');
    Route::post('control-accesos/media', 'ControlAccesoController@storeMedia')->name('control-accesos.storeMedia');
    Route::post('control-accesos/ckmedia', 'ControlAccesoController@storeCKEditorImages')->name('control-accesos.storeCKEditorImages');
    Route::resource('control-accesos', 'ControlAccesoController');

    // Informacion Documetadas
    Route::delete('informacion-documetadas/destroy', 'InformacionDocumetadaController@massDestroy')->name('informacion-documetadas.massDestroy');
    Route::post('informacion-documetadas/media', 'InformacionDocumetadaController@storeMedia')->name('informacion-documetadas.storeMedia');
    Route::post('informacion-documetadas/ckmedia', 'InformacionDocumetadaController@storeCKEditorImages')->name('informacion-documetadas.storeCKEditorImages');
    Route::resource('informacion-documetadas', 'InformacionDocumetadaController');

    // Planificacion Controls
    Route::delete('planificacion-controls/destroy', 'PlanificacionControlController@massDestroy')->name('planificacion-controls.massDestroy');
    Route::resource('planificacion-controls', 'PlanificacionControlController');

    // Activos
    Route::delete('activos/destroy', 'ActivosController@massDestroy')->name('activos.massDestroy');
    Route::resource('activos', 'ActivosController');

    // Marca
    Route::get('marcas/get-marcas', 'MarcaController@getMarcas')->name('marcas.getMarcas');
    Route::resource('marcas', 'MarcaController');

    // Modelo
    Route::get('modelos/get-modelos/{id?}', 'ModeloController@getModelos')->name('modelos.getModelos');
    Route::resource('modelos', 'ModeloController');

    // Tratamiento Riesgos
    Route::delete('tratamiento-riesgos/destroy', 'TratamientoRiesgosController@massDestroy')->name('tratamiento-riesgos.massDestroy');
    Route::resource('tratamiento-riesgos', 'TratamientoRiesgosController');

    // Auditoria Internas
    Route::delete('auditoria-internas/destroy', 'AuditoriaInternaController@massDestroy')->name('auditoria-internas.massDestroy');
    Route::post('auditoria-internas/media', 'AuditoriaInternaController@storeMedia')->name('auditoria-internas.storeMedia');
    Route::post('auditoria-internas/ckmedia', 'AuditoriaInternaController@storeCKEditorImages')->name('auditoria-internas.storeCKEditorImages');
    Route::resource('auditoria-internas', 'AuditoriaInternaController');

    // Revision Direccions
    Route::delete('revision-direccions/destroy', 'RevisionDireccionController@massDestroy')->name('revision-direccions.massDestroy');
    Route::resource('revision-direccions', 'RevisionDireccionController');

    // Controles
    Route::delete('controles/destroy', 'ControlesController@massDestroy')->name('controles.massDestroy');
    Route::post('controles/parse-csv-import', 'ControlesController@parseCsvImport')->name('controles.parseCsvImport');
    Route::post('controles/process-csv-import', 'ControlesController@processCsvImport')->name('controles.processCsvImport');
    Route::resource('controles', 'ControlesController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Areas
    Route::delete('areas/destroy', 'AreasController@massDestroy')->name('areas.massDestroy');
    Route::get('areas/grupo', 'AreasController@obtenerAreasPorGrupo')->name('areas.obtenerAreasPorGrupo');
    Route::post('areas/parse-csv-import', 'AreasController@parseCsvImport')->name('areas.parseCsvImport');
    Route::get('areas/jerarquia', 'AreasController@renderJerarquia')->name('areas.renderJerarquia');
    Route::post('areas/process-csv-import', 'AreasController@processCsvImport')->name('areas.processCsvImport');
    Route::resource('areas', 'AreasController');

    // Organizaciones
    Route::delete('organizaciones/destroy', 'OrganizacionesController@massDestroy')->name('organizaciones.massDestroy');
    Route::post('organizaciones/parse-csv-import', 'OrganizacionesController@parseCsvImport')->name('organizaciones.parseCsvImport');
    Route::post('organizaciones/process-csv-import', 'OrganizacionesController@processCsvImport')->name('organizaciones.processCsvImport');
    Route::resource('organizaciones', 'OrganizacionesController');

    // Tipoactivos
    Route::delete('tipoactivos/destroy', 'TipoactivoController@massDestroy')->name('tipoactivos.massDestroy');
    Route::post('tipoactivos/parse-csv-import', 'TipoactivoController@parseCsvImport')->name('tipoactivos.parseCsvImport');
    Route::post('tipoactivos/process-csv-import', 'TipoactivoController@processCsvImport')->name('tipoactivos.processCsvImport');
    Route::resource('tipoactivos', 'TipoactivoController');

    // Puestos
    Route::delete('puestos/destroy', 'PuestosController@massDestroy')->name('puestos.massDestroy');
    Route::post('puestos/parse-csv-import', 'PuestosController@parseCsvImport')->name('puestos.parseCsvImport');
    Route::post('puestos/process-csv-import', 'PuestosController@processCsvImport')->name('puestos.processCsvImport');
    Route::resource('puestos', 'PuestosController');

    // Sedes
    Route::delete('sedes/destroy', 'SedeController@massDestroy')->name('sedes.massDestroy');
    Route::get('sedes/organizacion', 'SedeController@obtenerListaSedes')->name('sedes.obtenerListaSedes');
    Route::post('sedes/parse-csv-import', 'SedeController@parseCsvImport')->name('sedes.parseCsvImport');
    Route::post('sedes/process-csv-import', 'SedeController@processCsvImport')->name('sedes.processCsvImport');
    Route::resource('sedes', 'SedeController');
    Route::get('sede-ubicacion/{data}', 'SedeController@ubicacion');
    Route::get('sedes/sede-ubicacionorganizacion/{id}', 'SedeController@ubicacionorg');

    //Grupo Areas
    Route::post('grupoarea/areas-relacionadas', [GrupoAreaController::class, 'getRelationatedAreas'])->name('grupoarea.getRelationatedAreas');
    Route::delete('grupoarea/destroy', 'GrupoAreaController@massDestroy')->name('grupoarea.massDestroy');
    Route::post('grupoarea/parse-csv-import', 'GrupoAreaController@parseCsvImport')->name('grupoarea.parseCsvImport');
    Route::post('grupoarea/process-csv-import', 'GrupoAreaController@processCsvImport')->name('grupoarea.processCsvImport');
    Route::resource('grupoarea', 'GrupoAreaController');


    // Indicadores Sgsis
    Route::get('evaluaciones-sgsisInsertar', 'IndicadoresSgsiController@evaluacionesInsert')->name('evaluacionesInsert');
    Route::delete('indicadores-sgsis/destroy', 'IndicadoresSgsiController@massDestroy')->name('indicadores-sgsis.massDestroy');
    Route::resource('indicadores-sgsis', 'IndicadoresSgsiController');
    Route::get('indicadores-sgsisInsertar', 'IndicadoresSgsiController@IndicadorInsert')->name('indicadores-sgsisInsertar');
    Route::get('indicadores-sgsisUpdate', 'IndicadoresSgsiController@IndicadorUpdate')->name('indicadores-sgsisUpdate');
    Route::get('evaluaciones-sgsisUpdate', 'IndicadoresSgsiController@evaluacionesUpdate')->name('evaluacionesUpdate');

    // Indicadorincidentessis
    Route::resource('indicadorincidentessis', 'IndicadorincidentessiController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Auditoria Anuals
    Route::delete('auditoria-anuals/destroy', 'AuditoriaAnualController@massDestroy')->name('auditoria-anuals.massDestroy');
    Route::resource('auditoria-anuals', 'AuditoriaAnualController');

    // Plan Auditoria
    Route::delete('plan-auditoria/destroy', 'PlanAuditoriaController@massDestroy')->name('plan-auditoria.massDestroy');
    Route::resource('plan-auditoria', 'PlanAuditoriaController');

    // Accion Correctivas
    Route::get('accion-correctiva-actividades/{accion_correctiva_id}', 'ActividadAccionCorrectivaController@index')->name('accion-correctiva-actividades.index');
    Route::resource('accion-correctiva-actividades', 'ActividadAccionCorrectivaController')->except(['index']);
    Route::delete('accion-correctivas/destroy', 'AccionCorrectivaController@massDestroy')->name('accion-correctivas.massDestroy');
    Route::post('accion-correctivas/media', 'AccionCorrectivaController@storeMedia')->name('accion-correctivas.storeMedia');
    Route::post('accion-correctivas/ckmedia', 'AccionCorrectivaController@storeCKEditorImages')->name('accion-correctivas.storeCKEditorImages');
    Route::post('accion-correctivas/{accion}/analisis/store', 'AccionCorrectivaController@storeAnalisis')->name('accion-correctivas.storeAnalisis');
    Route::resource('accion-correctivas', 'AccionCorrectivaController');
    Route::get('plan-correctiva', 'PlanaccionCorrectivaController@planformulario')->name('plantest');
    Route::post('accion-correctivas/editarplan', 'PlanaccionCorrectivaController@update');
    Route::post('plan-correctivas-storeedit', 'PlanaccionCorrectivaController@storeEdit');
    Route::post('planaccion-storered', 'PlanaccionCorrectivaController@storeRedirect')->name('storered');



    // Ajax
    //Route::post('AjaxAccionCorrectivaCrear', 'AccionCorrectiva@store');

    // Planaccion Correctivas
    Route::delete('planaccion-correctivas/destroy', 'PlanaccionCorrectivaController@massDestroy')->name('planaccion-correctivas.massDestroy');
    Route::resource('planaccion-correctivas', 'PlanaccionCorrectivaController');

    // Registromejoras
    Route::delete('registromejoras/destroy', 'RegistromejoraController@massDestroy')->name('registromejoras.massDestroy');
    Route::resource('registromejoras', 'RegistromejoraController');

    // Dmaics
    Route::delete('dmaics/destroy', 'DmaicController@massDestroy')->name('dmaics.massDestroy');
    Route::resource('dmaics', 'DmaicController');

    // Plan Mejoras
    Route::delete('plan-mejoras/destroy', 'PlanMejoraController@massDestroy')->name('plan-mejoras.massDestroy');
    Route::resource('plan-mejoras', 'PlanMejoraController');

    // Enlaces Ejecutars
    Route::delete('enlaces-ejecutars/destroy', 'EnlacesEjecutarController@massDestroy')->name('enlaces-ejecutars.massDestroy');
    Route::resource('enlaces-ejecutars', 'EnlacesEjecutarController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Incidentes De Seguridads
    Route::delete('incidentes-de-seguridads/destroy', 'IncidentesDeSeguridadController@massDestroy')->name('incidentes-de-seguridads.massDestroy');
    Route::resource('incidentes-de-seguridads', 'IncidentesDeSeguridadController');

    // Estado Incidentes
    Route::delete('estado-incidentes/destroy', 'EstadoIncidentesController@massDestroy')->name('estado-incidentes.massDestroy');
    Route::resource('estado-incidentes', 'EstadoIncidentesController');

    // Estatus Plan Trabajos
    Route::delete('estatus-plan-trabajos/destroy', 'EstatusPlanTrabajoController@massDestroy')->name('estatus-plan-trabajos.massDestroy');
    Route::resource('estatus-plan-trabajos', 'EstatusPlanTrabajoController');

    // Carpeta
    Route::delete('carpeta/destroy', 'CarpetasController@massDestroy')->name('carpeta.massDestroy');
    Route::resource('carpeta', 'CarpetasController');

    // Archivos
    Route::delete('archivos/destroy', 'ArchivosController@massDestroy')->name('archivos.massDestroy');
    Route::post('archivos/media', 'ArchivosController@storeMedia')->name('archivos.storeMedia');
    Route::post('archivos/ckmedia', 'ArchivosController@storeCKEditorImages')->name('archivos.storeCKEditorImages');
    Route::resource('archivos', 'ArchivosController');

    // Estado Documentos
    Route::delete('estado-documentos/destroy', 'EstadoDocumentoController@massDestroy')->name('estado-documentos.massDestroy');
    Route::resource('estado-documentos', 'EstadoDocumentoController');

    // Faq Categories
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Questions
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::post('global-structure-search', 'GlobalStructureSearchController@globalSearch')->name('globalStructureSearch');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');

    //amenzas
    Route::resource('amenazas', 'AmenazaController');
    Route::delete('amenazas/destroy', 'AmenazaController@massDestroy')->name('amenazas.massDestroy');
    Route::post('amenazas/parse-csv-import', 'AmenazaController@parseCsvImport')->name('amenazas.parseCsvImport');
    Route::post('amenazas/process-csv-import', 'AmenazaController@processCsvImport')->name('amenazas.processCsvImport');

    //vulnerabilidades
    Route::resource('vulnerabilidads', 'VulnerabilidadController');
    Route::delete('vulnerabilidads/destroy', 'VulnerabilidadController@massDestroy')->name('vulnerabilidads.massDestroy');
    Route::post('vulnerabilidads/parse-csv-import', 'VulnerabilidadController@parseCsvImport')->name('vulnerabilidads.parseCsvImport');
    Route::post('vulnerabilidads/process-csv-import', 'VulnerabilidadController@processCsvImport')->name('vulnerabilidads.processCsvImport');


    // analisis Riesgos
    Route::delete('analisis-riesgos/destroy', 'AnalisisdeRiesgosController@massDestroy')->name('analisis-riesgos.massDestroy');
    Route::resource('analisis-riesgos', 'AnalisisdeRiesgosController');
    Route::get('getEmployeeData', 'AnalisisdeRiesgosController@getEmployeeData')->name('getEmployeeData');

    // Matriz Riesgos
    Route::get('matriz-riesgos/planes-de-accion/create/{id}', 'MatrizRiesgosController@createPlanAccion')->name('matriz-riesgos.createPlanAccion');
    Route::post('matriz-riesgos/planes-de-accion/store/{id}', 'MatrizRiesgosController@storePlanAccion')->name('matriz-riesgos.storePlanAccion');
    Route::delete('matriz-riesgos/destroy', 'MatrizRiesgosController@massDestroy')->name('matriz-riesgos.massDestroy');
    Route::resource('matriz-riesgos', 'MatrizRiesgosController');
    Route::post('matriz-riesgos/parse-csv-import', 'MatrizRiesgosController@parseCsvImport')->name('matriz-riesgos.parseCsvImport');
    Route::get('matriz-seguridad', 'MatrizRiesgosController@SeguridadInfo')->name('matriz-seguridad');
    Route::get('matriz-seguridadMapa', 'MatrizRiesgosController@MapaCalor')->name('matriz-mapa');
    Route::get('controles-get', 'MatrizRiesgosController@ControlesGet')->name('controles-get');

    // Gap Unos
    Route::delete('gap-unos/destroy', 'GapUnoController@massDestroy')->name('gap-unos.massDestroy');
    Route::resource('gap-unos', 'GapUnoController');

    // Gap Dos
    Route::delete('gap-dos/destroy', 'GapDosController@massDestroy')->name('gap-dos.massDestroy');
    Route::resource('gap-dos', 'GapDosController');

    // Gap Tres
    Route::delete('gap-tres/destroy', 'GapTresController@massDestroy')->name('gap-tres.massDestroy');
    Route::resource('gap-tres', 'GapTresController');

    //Revisiones Documentos
    Route::get('/revisiones/archivo', 'RevisionDocumentoController@archivo')->name('revisiones.archivo');
    Route::post('/revisiones/archivar', 'RevisionDocumentoController@archivar')->name('revisiones.archivar');
    Route::post('/revisiones/desarchivar', 'RevisionDocumentoController@desarchivar')->name('revisiones.desarchivar');

    //Documentos
    Route::get('documentos/publicados', [DocumentosController::class, 'publicados'])->name('documentos.publicados');;
    Route::patch('documentos/{documento}/update-when-publish', 'DocumentosController@updateDocumentWhenPublish')->name('documentos.updateDocumentWhenPublish');
    Route::post('documentos/store-when-publish', 'DocumentosController@storeDocumentWhenPublish')->name('documentos.storeDocumentWhenPublish');
    Route::post('documentos/publish', 'DocumentosController@publish')->name('documentos.publish');
    Route::post('documentos/check-code', 'DocumentosController@checkCode')->name('documentos.checkCode');
    Route::get('documentos/{documento}/view-document', 'DocumentosController@renderViewDocument')->name('documentos.renderViewDocument');
    Route::get('documentos/{documento}/history-reviews', 'DocumentosController@renderHistoryReview')->name('documentos.renderHistoryReview');
    Route::get('documentos/{documento}/document-versions', 'DocumentosController@renderHistoryVersions')->name('documentos.renderHistoryVersions');
    Route::post('documentos/dependencies', 'DocumentosController@getDocumentDependencies')->name('documentos.getDocumentDependencies');
    Route::delete('documentos/{documento}/', 'DocumentosController@destroy')->name('documentos.destroy');
    Route::resource('documentos', 'DocumentosController');

    // Control Documentos
    Route::delete('control-documentos/destroy', 'ControlDocumentosController@massDestroy')->name('control-documentos.massDestroy');
    Route::resource('control-documentos', 'ControlDocumentosController', ['except' => ['create']]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');

    //REPORTES CONTEXTO 27001
    Route::get('reportes-contexto/', 'ReporteContextoController@index')->name('reportes-contexto.index');
    Route::post('reportes-contexto/create', 'ReporteContextoController@store')->name('reportes-contexto.store');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});


/* Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Organizacions
    Route::delete('organizacions/destroy', 'OrganizacionController@massDestroy')->name('organizacions.massDestroy');
    Route::resource('organizacions', 'OrganizacionController');


    // Glosarios
    Route::delete('glosarios/destroy', 'GlosarioController@massDestroy')->name('glosarios.massDestroy');
    Route::resource('glosarios', 'GlosarioController');

    // Plan Base Actividades
    Route::delete('plan-base-actividades/destroy', 'PlanBaseActividadesController@massDestroy')->name('plan-base-actividades.massDestroy');
    Route::resource('plan-base-actividades', 'PlanBaseActividadesController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);


    // Partes Interesadas
    Route::delete('partes-interesadas/destroy', 'PartesInteresadasController@massDestroy')->name('partes-interesadas.massDestroy');
    Route::resource('partes-interesadas', 'PartesInteresadasController');

    // Matriz Requisito Legales
    Route::delete('matriz-requisito-legales/destroy', 'MatrizRequisitoLegalesController@massDestroy')->name('matriz-requisito-legales.massDestroy');
    Route::resource('matriz-requisito-legales', 'MatrizRequisitoLegalesController');


    // Alcance Sgsis
    Route::delete('alcance-sgsis/destroy', 'AlcanceSgsiController@massDestroy')->name('alcance-sgsis.massDestroy');
    Route::resource('alcance-sgsis', 'AlcanceSgsiController');

    // Comiteseguridads
    Route::delete('comiteseguridads/destroy', 'ComiteseguridadController@massDestroy')->name('comiteseguridads.massDestroy');
    Route::resource('comiteseguridads', 'ComiteseguridadController');

    // Minutasaltadireccions
    Route::delete('minutasaltadireccions/destroy', 'MinutasaltadireccionController@massDestroy')->name('minutasaltadireccions.massDestroy');
    Route::resource('minutasaltadireccions', 'MinutasaltadireccionController');

    // Evidencias Sgsis
    Route::delete('evidencias-sgsis/destroy', 'EvidenciasSgsiController@massDestroy')->name('evidencias-sgsis.massDestroy');
    Route::resource('evidencias-sgsis', 'EvidenciasSgsiController');

    // Politica Sgsis
    Route::delete('politica-sgsis/destroy', 'PoliticaSgsiController@massDestroy')->name('politica-sgsis.massDestroy');
    Route::resource('politica-sgsis', 'PoliticaSgsiController');

    // Roles Responsabilidades
    Route::delete('roles-responsabilidades/destroy', 'RolesResponsabilidadesController@massDestroy')->name('roles-responsabilidades.massDestroy');
    Route::resource('roles-responsabilidades', 'RolesResponsabilidadesController');

    // Riesgosoportunidades
    Route::delete('riesgosoportunidades/destroy', 'RiesgosoportunidadesController@massDestroy')->name('riesgosoportunidades.massDestroy');
    Route::resource('riesgosoportunidades', 'RiesgosoportunidadesController');

    // Objetivosseguridads
    Route::delete('objetivosseguridads/destroy', 'ObjetivosseguridadController@massDestroy')->name('objetivosseguridads.massDestroy');
    Route::resource('objetivosseguridads', 'ObjetivosseguridadController');

    // Recursos
    Route::delete('recursos/destroy', 'RecursosController@massDestroy')->name('recursos.massDestroy');
    Route::resource('recursos', 'RecursosController');

    // Competencia
    Route::delete('competencia/destroy', 'CompetenciasController@massDestroy')->name('competencia.massDestroy');
    Route::resource('competencia', 'CompetenciasController');
    // Concientizacion Sgis
    Route::delete('concientizacion-sgis/destroy', 'ConcientizacionSgiController@massDestroy')->name('concientizacion-sgis.massDestroy');
    Route::resource('concientizacion-sgis', 'ConcientizacionSgiController');

    // Material Sgsis
    Route::delete('material-sgsis/destroy', 'MaterialSgsiController@massDestroy')->name('material-sgsis.massDestroy');
    Route::resource('material-sgsis', 'MaterialSgsiController');

    // Material Iso Veinticientes
    Route::delete('material-iso-veinticientes/destroy', 'MaterialIsoVeinticienteController@massDestroy')->name('material-iso-veinticientes.massDestroy');
    Route::resource('material-iso-veinticientes', 'MaterialIsoVeinticienteController');

    // Comunicacion Sgis
    Route::delete('comunicacion-sgis/destroy', 'ComunicacionSgiController@massDestroy')->name('comunicacion-sgis.massDestroy');
    Route::resource('comunicacion-sgis', 'ComunicacionSgiController');

    // Politica Del Sgsi Soportes
    //Route::resource('politica-del-sgsi-soportes', 'PoliticaDelSgsiSoporteController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Control Accesos
    Route::delete('control-accesos/destroy', 'ControlAccesoController@massDestroy')->name('control-accesos.massDestroy');
    Route::resource('control-accesos', 'ControlAccesoController');

    // Informacion Documetadas
    Route::delete('informacion-documetadas/destroy', 'InformacionDocumetadaController@massDestroy')->name('informacion-documetadas.massDestroy');
    Route::resource('informacion-documetadas', 'InformacionDocumetadaController');

    // Planificacion Controls
    Route::delete('planificacion-controls/destroy', 'PlanificacionControlController@massDestroy')->name('planificacion-controls.massDestroy');
    Route::resource('planificacion-controls', 'PlanificacionControlController');

    // Activos
    Route::delete('activos/destroy', 'ActivosController@massDestroy')->name('activos.massDestroy');
    Route::resource('activos', 'ActivosController');

    // Tratamiento Riesgos
    Route::delete('tratamiento-riesgos/destroy', 'TratamientoRiesgosController@massDestroy')->name('tratamiento-riesgos.massDestroy');
    Route::resource('tratamiento-riesgos', 'TratamientoRiesgosController');

    // Auditoria Internas
    Route::delete('auditoria-internas/destroy', 'AuditoriaInternaController@massDestroy')->name('auditoria-internas.massDestroy');
    Route::resource('auditoria-internas', 'AuditoriaInternaController');

    // Revision Direccions
    Route::delete('revision-direccions/destroy', 'RevisionDireccionController@massDestroy')->name('revision-direccions.massDestroy');
    Route::resource('revision-direccions', 'RevisionDireccionController');

    // Controles
    Route::delete('controles/destroy', 'ControlesController@massDestroy')->name('controles.massDestroy');
    Route::resource('controles', 'ControlesController');

    // Audit Logs
    //Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Areas
    Route::delete('areas/destroy', 'AreasController@massDestroy')->name('areas.massDestroy');
    Route::resource('areas', 'AreasController');

    // Grupo Areas
    Route::delete('grupoarea/destroy', 'GrupoAreaController@massDestroy')->name('grupoarea.massDestroy');
    Route::resource('grupoarea', 'GrupoAreaController');

    // Organizaciones
    Route::delete('organizaciones/destroy', 'OrganizacionesController@massDestroy')->name('organizaciones.massDestroy');
    Route::resource('organizaciones', 'OrganizacionesController');

    // Tipoactivos
    Route::delete('tipoactivos/destroy', 'TipoactivoController@massDestroy')->name('tipoactivos.massDestroy');
    Route::resource('tipoactivos', 'TipoactivoController');

    // Puestos
    Route::delete('puestos/destroy', 'PuestosController@massDestroy')->name('puestos.massDestroy');
    Route::resource('puestos', 'PuestosController');

    // Sedes
    Route::delete('sedes/destroy', 'SedeController@massDestroy')->name('sedes.massDestroy');
    Route::resource('sedes', 'SedeController');

    // Indicadores Sgsis
    Route::delete('indicadores-sgsis/destroy', 'IndicadoresSgsiController@massDestroy')->name('indicadores-sgsis.massDestroy');
    Route::resource('indicadores-sgsis', 'IndicadoresSgsiController');

    // Indicadorincidentessis
    //Route::resource('indicadorincidentessis', 'IndicadorincidentessiController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Auditoria Anuals
    Route::delete('auditoria-anuals/destroy', 'AuditoriaAnualController@massDestroy')->name('auditoria-anuals.massDestroy');
    Route::resource('auditoria-anuals', 'AuditoriaAnualController');

    // Plan Auditoria
    Route::delete('plan-auditoria/destroy', 'PlanAuditoriaController@massDestroy')->name('plan-auditoria.massDestroy');
    Route::resource('plan-auditoria', 'PlanAuditoriaController');

    // Accion Correctivas
    Route::delete('accion-correctivas/destroy', 'AccionCorrectivaController@massDestroy')->name('accion-correctivas.massDestroy');
    Route::resource('accion-correctivas', 'AccionCorrectivaController');

    // Planaccion Correctivas
    Route::delete('planaccion-correctivas/destroy', 'PlanaccionCorrectivaController@massDestroy')->name('planaccion-correctivas.massDestroy');
    Route::resource('planaccion-correctivas', 'PlanaccionCorrectivaController');

    // Registromejoras
    Route::delete('registromejoras/destroy', 'RegistromejoraController@massDestroy')->name('registromejoras.massDestroy');
    Route::resource('registromejoras', 'RegistromejoraController');

    // Dmaics
    Route::delete('dmaics/destroy', 'DmaicController@massDestroy')->name('dmaics.massDestroy');
    Route::resource('dmaics', 'DmaicController');

    // Plan Mejoras
    Route::delete('plan-mejoras/destroy', 'PlanMejoraController@massDestroy')->name('plan-mejoras.massDestroy');
    Route::resource('plan-mejoras', 'PlanMejoraController');

    // Enlaces Ejecutars
    Route::delete('enlaces-ejecutars/destroy', 'EnlacesEjecutarController@massDestroy')->name('enlaces-ejecutars.massDestroy');
    Route::resource('enlaces-ejecutars', 'EnlacesEjecutarController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Incidentes De Seguridads
    Route::delete('incidentes-de-seguridads/destroy', 'IncidentesDeSeguridadController@massDestroy')->name('incidentes-de-seguridads.massDestroy');
    Route::resource('incidentes-de-seguridads', 'IncidentesDeSeguridadController');

    // Estado Incidentes
    Route::delete('estado-incidentes/destroy', 'EstadoIncidentesController@massDestroy')->name('estado-incidentes.massDestroy');
    Route::resource('estado-incidentes', 'EstadoIncidentesController');

    // Estatus Plan Trabajos
    Route::delete('estatus-plan-trabajos/destroy', 'EstatusPlanTrabajoController@massDestroy')->name('estatus-plan-trabajos.massDestroy');
    Route::resource('estatus-plan-trabajos', 'EstatusPlanTrabajoController');

    // Carpeta
    Route::delete('carpeta/destroy', 'CarpetasController@massDestroy')->name('carpeta.massDestroy');
    Route::resource('carpeta', 'CarpetasController');

    // Archivos
    Route::delete('archivos/destroy', 'ArchivosController@massDestroy')->name('archivos.massDestroy');
    Route::resource('archivos', 'ArchivosController');

    // Estado Documentos
    Route::delete('estado-documentos/destroy', 'EstadoDocumentoController@massDestroy')->name('estado-documentos.massDestroy');
    Route::resource('estado-documentos', 'EstadoDocumentoController');

    // Faq Categories
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Matriz Riesgos
    //Route::delete('matriz-riesgos/destroy', 'MatrizRiesgosController@massDestroy')->name('matriz-riesgos.massDestroy');
    //Route::resource('matriz-riesgos', 'MatrizRiesgosController');
    // Gap Unos
    Route::delete('gap-unos/destroy', 'GapUnoController@massDestroy')->name('gap-unos.massDestroy');
    Route::resource('gap-unos', 'GapUnoController');

    // Gap Dos
    Route::delete('gap-dos/destroy', 'GapDosController@massDestroy')->name('gap-dos.massDestroy');
    Route::resource('gap-dos', 'GapDosController');

    // Gap Tres
    Route::delete('gap-tres/destroy', 'GapTresController@massDestroy')->name('gap-tres.massDestroy');
    Route::resource('gap-tres', 'GapTresController');

    // Faq Questions
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
}); */

########################
#### NOTIFICACIONES ###
######################

// Route::get('/notificaciones', [\App\Http\Livewire\NotificacionesComponent::class, '__invoke'])->name('notificaciones');
Route::get('/notificaciones', 'NotificacionesController@index')->name('notificaciones');
Route::get('/tareas', 'TareasNotificacionesController@index')->name('tareas');

Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});

Route::view('sitemap', 'admin.sitemap.index');
// Route::view('stepper', 'stepper');
//Route::view('admin/gantt', 'admin.gantt.grap');

//URL::forceScheme('https');


Route::view('post_register', 'auth.post_register');

//Ruta CargaImagen
Route::get('CargaDocs', 'CargaDocs@index')->name('cargadocs');
Route::post('CargaAmenza', 'SubidaExcel@Amenaza')->name('carga-amenaza');
Route::post('CargaVulnerabilidad', 'SubidaExcel@Vulnerabilidad')->name('carga-vulnerabilidad');
Route::post('CargaUsuario', 'SubidaExcel@Usuario')->name('carga-usuario');
Route::post('CargaPuesto', 'SubidaExcel@Puesto')->name('carga-puesto');
Route::post('CargaControl', 'SubidaExcel@Control')->name('carga-control');
Route::post('CargaEjecutarenlace', 'SubidaExcel@Ejecutarenlace')->name('carga-ejecutarenlace');
Route::post('CargaTeam', 'SubidaExcel@Team')->name('carga-team');
Route::post('CargaEstadoIncidente', 'SubidaExcel@EstadoIncidente')->name('carga-estadoincidente');
Route::post('CargaCompetencia', 'SubidaExcel@Competencia')->name('carga-competencia');
Route::post('CargaEvaluacion', 'SubidaExcel@Evaluacion')->name('carga-evaluacion');
Route::post('CargaCategoriaCapacitacion', 'SubidaExcel@CategoriaCapacitacion')->name('carga-categoriacapacitacion');
Route::post('CargaRevisionDireccion', 'SubidaExcel@RevisionDireccion')->name('carga-revisiondireccion');
Route::post('CargaCategoria', 'SubidaExcel@CategoriaActivo')->name('carga-categoria');
Route::post('CargaFaqCategoria', 'SubidaExcel@FaqCategoria')->name('carga-faqcategoria');
Route::post('CargaFaqPregunta', 'SubidaExcel@FaqPregunta')->name('carga-faqpregunta');
