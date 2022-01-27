<?php

use App\Http\Controllers\Admin\DocumentosController;
use App\Http\Controllers\Admin\GrupoAreaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/usuario-bloqueado', 'UsuarioBloqueado@usuarioBloqueado')->name('users.usuario-bloqueado');

Route::post('/revisiones/approve', 'RevisionDocumentoController@approve')->name('revisiones.approve');
Route::post('/revisiones/reject', 'RevisionDocumentoController@reject')->name('revisiones.reject');
Route::get('/revisiones/{revisionDocumento}', 'RevisionDocumentoController@edit')->name('revisiones.revisar');

Route::post('/minutas/revisiones/approve', 'RevisionMinutasController@approve')->name('minutas.revisiones.approve');
Route::post('/minutas/revisiones/reject', 'RevisionMinutasController@reject')->name('minutas.revisiones.reject');
Route::get('/minutas/revisiones/{revisionMinuta}', 'RevisionMinutasController@edit')->name('minutas.revisiones.revisar');

Auth::routes();

// Tabla-Calendario

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'active']], function () {
    //Modulo Capital Humano
    Route::get('capital-humano', 'RH\CapitalHumanoController@index')->name('capital-humano.index');

    //Tipos de contratos
    Route::resource('recursos-humanos/tipos-contratos-empleados', 'RH\TipoContratoEmpleadoController');
    Route::resource('recursos-humanos/entidades-crediticias', 'RH\EntidadCrediticiaController');
    Route::resource('recursos-humanos/dependientes-empleados', 'RH\DependientesEconomicosEmpleadosController');
    Route::resource('recursos-humanos/contactos-emergencia-empleados', 'RH\ContactosEmergenciaEmpleadoController');
    Route::resource('recursos-humanos/beneficiarios-empleados', 'RH\BeneficiariosEmpleadoController');

    // Evaluaciones 360
    Route::get('recursos-humanos/evaluacion-360', 'RH\Evaluacion360Controller@index')->name('rh-evaluacion360.index');

    Route::get('tabla-calendario/index', 'TablaCalendarioController@index')->name('tabla-calendario.index');
    Route::resource('recursos-humanos/calendario', 'TablaCalendarioController')->names([
        'create' => 'tabla-calendario.create',
        'store' => 'tabla-calendario.store',
        'show' => 'tabla-calendario.show',
        'edit' => 'tabla-calendario.edit',
        'update' => 'tabla-calendario.update',
        'destroy' => 'tabla-calendario.destroy',
    ]);

    // Route::get('calendario-oficial/index', 'CalendarioOficialController@index')->name('calendario-oficial.index');
    Route::resource('recursos-humanos/calendario-oficial', 'CalendarioOficialController')->names([
        'create' => 'calendario-oficial.create',
        'store' => 'calendario-oficial.store',
        'show' => 'calendario-oficial.show',
        'edit' => 'calendario-oficial.edit',
        'update' => 'calendario-oficial.update',
        'destroy' => 'calendario-oficial.destroy',
    ]);

    //Consulta de evaluación

    Route::get('recursos-humanos/evaluacion-360/{evaluacion}/{evaluado}/mis-evaluaciones', 'RH\EV360EvaluacionesController@misEvaluaciones')->name('ev360-evaluaciones.misEvaluaciones');
    Route::get('recursos-humanos/evaluacion-360/{evaluacion}/{evaluador}/evaluaciones-mi-equipo', 'RH\EV360EvaluacionesController@evaluacionesDeMiEquipo')->name('ev360-evaluaciones.evaluacionesDeMiEquipo');

    Route::post('recursos-humanos/evaluacion-360/{evaluacion}/recordatorio', 'RH\EV360EvaluacionesController@enviarCorreoAEvaluadores')->name('ev360-evaluaciones.recordatorio');
    Route::post('recursos-humanos/evaluacion-360/invitacion-reunion-evaluacion', 'RH\EV360EvaluacionesController@enviarInvitacionDeEvaluacion')->name('ev360-evaluaciones.invitacion-reunion-evaluacion');

    Route::get('recursos-humanos/evaluacion-360/{empleado}/evaluaciones-del-empleado', 'RH\EV360EvaluacionesController@evaluacionesDelEmpleado')->name('ev360-evaluaciones.evaluacionesDelEmpleado');
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
    Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/resumen/jefe/{empleado}', 'RH\EV360EvaluacionesController@resumenJefe')->name('ev360-evaluaciones.consulta.resumenJefe');
    Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/resumen/empleado/{empleado}', 'RH\EV360EvaluacionesController@resumenEmpleado')->name('ev360-evaluaciones.consulta.resumenEmpleado');
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

    Route::get(
        'recursos-humanos/evaluacion-360/competencias-por-puesto/{puesto}/create',
        'RH\CompetenciasPorPuestoController@create'
    )->name('ev360-competencias-por-puesto.create');
    Route::get(
        'recursos-humanos/evaluacion-360/competencias-por-puesto/{puesto}/obtener',
        'RH\CompetenciasPorPuestoController@indexCompetenciasPorPuesto'
    )->name('ev360-competencias-por-puesto.indexCompetenciasPorPuesto');
    Route::post(
        'recursos-humanos/evaluacion-360/competencias-por-puesto/{puesto}',
        'RH\CompetenciasPorPuestoController@store'
    )->name('ev360-competencias-por-puesto.store');
    Route::resource('recursos-humanos/evaluacion-360/competencias-por-puesto', 'RH\CompetenciasPorPuestoController')->names([
        'index' => 'ev360-competencias-por-puesto.index',
        'show' => 'ev360-competencias-por-puesto.show',
        'edit' => 'ev360-competencias-por-puesto.edit',
        'update' => 'ev360-competencias-por-puesto.update',
        'destroy' => 'ev360-competencias-por-puesto.destroy',
    ])->except('create', 'store');

    Route::post('recursos-humanos/evaluacion-360/competencias/obtener-niveles', 'RH\EV360CompetenciasController@obtenerNiveles')->name('ev360-competencias.obtenerNiveles');

    Route::post('recursos-humanos/evaluacion-360/competencias/store-redirect', 'RH\EV360CompetenciasController@storeAndRedirect')->name('ev360-competencias.conductas');

    Route::get('recursos-humanos/evaluacion-360/competencias/{competencia}/conductas', 'RH\EV360CompetenciasController@conductas')->name('ev360-competencias.obtenerConductas');

    Route::post('recursos-humanos/evaluacion-360/competencias/obtener-ultimo-nivel', 'RH\EV360CompetenciasController@obtenerUltimoNivel')->name('ev360-competencias.obtenerUltimoNivel');

    Route::get('recursos-humanos/evaluacion-360/competencias/{competencia}/edit', 'RH\EV360CompetenciasController@edit')->name('ev360-competencias.edit');

    Route::get('recursos-humanos/evaluacion-360/competencias/{competencia}/informacion', 'RH\EV360CompetenciasController@informacionCompetencia')->name('ev360-competencias.informacionCompetencia');

    Route::post('recursos-humanos/evaluacion-360/competencias/{competencia}/repuesta', 'RH\EV360CompetenciasController@guardarRespuestaCompetencia')->name('ev360-competencias.guardarRespuestaCompetencia');

    Route::resource('recursos-humanos/evaluacion-360/competencias', 'RH\EV360CompetenciasController')->names([
        'index' => 'ev360-competencias.index',
        'create' => 'ev360-competencias.create',
        'store' => 'ev360-competencias.store',
        'show' => 'ev360-competencias.show',
        'update' => 'ev360-competencias.update',
        'destroy' => 'ev360-competencias.destroy',
    ])->except(['edit']);

    Route::post('recursos-humanos/evaluacion-360/conductas/store', 'RH\EV360ConductasController@store')->name('ev360-conductas.store');
    Route::get('recursos-humanos/evaluacion-360/conductas/{conducta}/edit', 'RH\EV360ConductasController@edit')->name('ev360-conductas.edit');
    Route::patch('recursos-humanos/evaluacion-360/conductas/{conducta}', 'RH\EV360ConductasController@update')->name('ev360-conductas.update');
    Route::delete('recursos-humanos/evaluacion-360/conductas/{conducta}', 'RH\EV360ConductasController@destroy')->name('ev360-conductas.destroy');

    Route::get('recursos-humanos/evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@createByEmpleado')->name('ev360-objetivos-empleado.create');
    Route::get('recursos-humanos/evaluacion-360/{empleado}/objetivos/lista', 'RH\EV360ObjetivosController@show')->name('ev360-objetivos-empleado.show');
    Route::get('recursos-humanos/evaluacion-360/objetivos/{empleado}/copiar', 'RH\EV360ObjetivosController@indexCopiar')->name('ev360-objetivos-empleado.indexCopiar');
    Route::post('recursos-humanos/evaluacion-360/objetivos/copiar', 'RH\EV360ObjetivosController@storeCopiaObjetivos')->name('ev360-objetivos-empleado.storeCopiaObjetivos');
    Route::post('recursos-humanos/evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@storeByEmpleado')->name('ev360-objetivos-empleado.store');

    Route::get('recursos-humanos/evaluacion-360/objetivos/{objetivo}/edit', 'RH\EV360ObjetivosController@edit')->name('ev360-objetivos-empleado.edit');
    Route::get('recursos-humanos/evaluacion-360/{empleado}/objetivos/{objetivo}/editByEmpleado', 'RH\EV360ObjetivosController@editByEmpleado')->name('ev360-objetivos-empleado.editByEmpleado');
    Route::post('recursos-humanos/evaluacion-360/objetivos/{objetivo}/empleado', 'RH\EV360ObjetivosController@updateByEmpleado')->name('ev360-objetivos-empleado.updateByEmpleado');
    Route::resource('recursos-humanos/evaluacion-360/objetivos', 'RH\EV360ObjetivosController')->names([
        'index' => 'ev360-objetivos.index',
    ])->except(['create', 'show']);



    Route::get('Perspectiva/edit/{perspectivas}', 'RH\ObejetivoPerspectivaController@edit')->name('perspectivas.edit');
    Route::resource('Perspectiva', 'RH\ObejetivoPerspectivaController', ['except' => ['edit']]);

    Route::get('Metrica/edit/{metrica}', 'RH\ObjetivoUnidadMedidaController@edit')->name('metrica.edit');
    Route::resource('Metrica', 'RH\ObjetivoUnidadMedidaController', ['except' => ['edit']]);

    Route::view('iso27001', 'admin.iso27001.index')->name('iso27001.index');
    Route::view('iso9001', 'admin.iso9001.index')->name('iso9001.index');

    Route::get('portal-comunicacion/reportes', 'PortalComunicacionController@reportes')->name('portal-comunicacion.reportes');
    Route::post('portal-comunicacion/cumpleaños/{id}', 'PortalComunicacionController@felicitarCumpleaños')->name('portal-comunicacion.cumples');
    Route::post('portal-comunicacion/cumpleaños-dislike/{id}', 'PortalComunicacionController@felicitarCumpleañosDislike')->name('portal-comunicacion.cumples-dislike');
    Route::post('portal-comunicacion/cumpleaños_comentarios/{id}', 'PortalComunicacionController@felicitarCumplesComentarios')->name('portal-comunicacion.cumples-comentarios');
    Route::post('portal-comunicacion/cumpleaños_comentarios_update/{id}', 'PortalComunicacionController@felicitarCumplesComentariosUpdate')->name('portal-comunicacion.cumples-comentarios-update');
    Route::resource('portal-comunicacion', 'PortalComunicacionController');

    Route::get('plantTrabajoBase/{data}', 'PlanTrabajoBaseController@showTarea');
    Route::post('plantTrabajoBase/bloqueo/mostrar', 'LockedPlanTrabajoController@getLockedToPlanTrabajo')->name('lockedPlan.getLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/quitar', 'LockedPlanTrabajoController@removeLockedToPlanTrabajo')->name('lockedPlan.removeLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/is-locked', 'LockedPlanTrabajoController@isLockedToPlanTrabajo')->name('lockedPlan.isLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/registrar', 'LockedPlanTrabajoController@setLockedToPlanTrabajo')->name('lockedPlan.setLockedToPlanTrabajo');

    Route::get('inicioUsuario', 'InicioUsuarioController@index')->name('inicio-Usuario.index');

    Route::get('inicioUsuario/reportes/quejas', 'InicioUsuarioController@quejas')->name('reportes-quejas');
    Route::post('inicioUsuario/reportes/quejas', 'InicioUsuarioController@storeQuejas')->name('reportes-quejas-store');

    Route::get('inicioUsuario/reportes/denuncias', 'InicioUsuarioController@denuncias')->name('reportes-denuncias');
    Route::post('inicioUsuario/reportes/denuncias', 'InicioUsuarioController@storeDenuncias')->name('reportes-denuncias-store');

    Route::get('inicioUsuario/reportes/mejoras', 'InicioUsuarioController@mejoras')->name('reportes-mejoras');
    Route::post('inicioUsuario/reportes/mejoras', 'InicioUsuarioController@storeMejoras')->name('reportes-mejoras-store');

    Route::get('inicioUsuario/reportes/sugerencias', 'InicioUsuarioController@sugerencias')->name('reportes-sugerencias');
    Route::post('inicioUsuario/reportes/sugerencias', 'InicioUsuarioController@storeSugerencias')->name('reportes-sugerencias-store');

    Route::get('inicioUsuario/reportes/seguridad', 'InicioUsuarioController@seguridad')->name('reportes-seguridad');
    Route::post('inicioUsuario/reportes/seguridad/media', 'InicioUsuarioController@storeMedia')->name('reportes-seguridad.storeMedia');
    Route::post('inicioUsuario/reportes/seguridad', 'InicioUsuarioController@storeSeguridad')->name('reportes-seguridad-store');

    Route::get('inicioUsuario/reportes/riesgos', 'InicioUsuarioController@riesgos')->name('reportes-riesgos');
    Route::post('inicioUsuario/reportes/riesgos', 'InicioUsuarioController@storeRiesgos')->name('reportes-riesgos-store');

    Route::post('inicioUsuario/capacitaciones/archivar/{id}', 'InicioUsuarioController@archivarCapacitacion')->name('inicio-Usuario.capacitaciones.archivar');
    Route::post('inicioUsuario/capacitaciones/recuperar/{id}', 'InicioUsuarioController@recuperarCapacitacion')->name('inicio-Usuario.capacitaciones.recuperar');
    Route::get('inicioUsuario/capacitaciones/archivo', 'InicioUsuarioController@archivoCapacitacion')->name('inicio-Usuario.capacitaciones.archivo');

    Route::post('inicioUsuario/aprobacion/archivar/{id}', 'InicioUsuarioController@archivarAprobacion')->name('inicio-Usuario.aprobacion.archivar');
    Route::post('inicioUsuario/aprobacion/recuperar/{id}', 'InicioUsuarioController@recuperarAprobacion')->name('inicio-Usuario.aprobacion.recuperar');
    Route::get('inicioUsuario/aprobacion/archivo', 'InicioUsuarioController@archivoAprobacion')->name('inicio-Usuario.aprobacion.archivo');

    Route::post('inicioUsuario/actividades/archivar/{id}', 'InicioUsuarioController@archivarActividades')->name('inicio-Usuario.actividades.archivar');
    Route::post('inicioUsuario/actividades/recuperar/{id}', 'InicioUsuarioController@recuperarActividades')->name('inicio-Usuario.actividades.recuperar');
    Route::get('inicioUsuario/actividades/archivo', 'InicioUsuarioController@archivoActividades')->name('inicio-Usuario.acctividades.archivo');

    Route::get('inicioUsuario/perfil-puesto', 'InicioUsuarioController@perfilPuesto')->name('inicio-Usuario.perfil-puesto');

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
    Route::get('analisis-brechas/{id}', 'AnalisisBController@index')->name('analisis-brechas');
    Route::post('analisis-brechas/update', 'AnalisisBController@update');
    Route::delete('analisisdebrechas/destroy', 'AnalisisBrechaController@massDestroy')->name('analisisdebrechas.massDestroy');
    Route::resource('analisisdebrechas', 'AnalisisBrechaController');
    Route::get('getEmployeeData', 'AnalisisBrechaController@getEmployeeData')->name('getEmployeeData');

    // Declaracion de Aplicabilidad
    Route::get('declaracion-aplicabilidad/descargar', 'DeclaracionAplicabilidadController@download')->name('declaracion-aplicabilidad.descargar');
    Route::get('declaracion-aplicabilidad/{id}', 'DeclaracionAplicabilidadController@index')->name('declaracion-aplicabilidad');
    Route::delete('declaracion-aplicabilidad/destroy', 'DeclaracionAplicabilidadController@massDestroy')->name('declaracion-aplicabilidad.massDestroy');
    Route::resource('declaracion-aplicabilidad', 'DeclaracionAplicabilidadController');
    Route::post('declaracion-aplicabilidad/enviar-correo', 'DeclaracionAplicabilidadController@enviarCorreo')->name('declaracion-aplicabilidad.enviarcorreo');
    Route::get('getEmployeeData', 'DeclaracionAplicabilidadController@getEmployeeData')->name('getEmployeeData');

    //Panel declaracion
    Route::post('paneldeclaracion/responsables-quitar', 'PanelDeclaracionController@quitarRelacionResponsable')->name('paneldeclaracion.responsables.quitar');
    Route::post('paneldeclaracion/responsables', 'PanelDeclaracionController@relacionarResponsable')->name('paneldeclaracion.responsables');
    Route::post('paneldeclaracion/enviar-correo', 'PanelDeclaracionController@enviarCorreo')->name('paneldeclaracion.enviarcorreo');
    Route::post('paneldeclaracion/aprobadores-quitar', 'PanelDeclaracionController@quitarRelacionAprobador')->name('paneldeclaracion.aprobadores.quitar');
    Route::post('paneldeclaracion/aprobadores', 'PanelDeclaracionController@relacionarAprobador')->name('paneldeclaracion.aprobadores');
    Route::delete('paneldeclaracion/destroy', 'PanelDeclaracionController@massDestroy')->name('paneldeclaracion.massDestroy');
    Route::resource('paneldeclaracion', 'PanelDeclaracionController');

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
    Route::get('users/two-factor/{user}/change', 'UsersController@cambiarVerificacion')->name('users.two-factor-change');
    Route::get('users/bloqueo/{user}/change', 'UsersController@toogleBloqueo')->name('users.toogle-bloqueo');
    Route::post('users/vincular', 'UsersController@vincularEmpleado')->name('users.vincular');
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Empleados
    Route::post('empleado/buscar-empleado-por-correo', 'EmpleadoController@buscarEmpleadoPorCorreo')->name('empleado.buscarEmpleadoPorCorreo');
    Route::get('empleado/{empleado}/documentos', 'EmpleadoController@getDocumentos')->name('empleado.documentos');
    Route::post('empleado/{empleado}/documentos', 'EmpleadoController@storeDocumentos')->name('empleado.storeDocumentos');
    Route::delete('empleado/{documento}/documentos', 'EmpleadoController@deleteDocumento')->name('empleado.deleteDocumento');
    Route::post('empleados/update/{documento}/documentos', 'EmpleadoController@updateDocumento')->name('empleados.updateDocumento');
    Route::delete('empleados/{documento}/delete-file-documento', 'EmpleadoController@deleteFileDocumento')->name('empleados.deleteFileDocumento');
    Route::post('empleado/update-image-profile', 'EmpleadoController@updateImageProfile')->name('empleado.update-image-profile');
    Route::post('empleado/update-profile', 'EmpleadoController@updateInformationProfile')->name('empleado.update-profile');
    Route::post('empleado/update-related-info-profile', 'EmpleadoController@updateInformacionRelacionadaProfile')->name('empleado.update-related-info-profile');
    Route::post('empleados/store/{empleado}/competencias-resumen', 'EmpleadoController@storeResumen')->name('empleados.storeResumen');

    Route::post('empleados/update/{certificacion}/competencias-certificaciones', 'EmpleadoController@updateCertificaciones')->name('empleados.updateCertificaciones');
    Route::delete('empleados/{certificacion}/delete-file-certificacion', 'EmpleadoController@deleteFileCertificacion')->name('empleados.deleteFileCertificacion');
    Route::delete('empleados/{documento}/delete', 'EmpleadoController@deleteDocumento')->name('empleados.deleteDocumento');
    Route::post('empleados/store/{empleado}/competencias-certificaciones', 'EmpleadoController@storeCertificaciones')->name('empleados.storeCertificaciones');
    Route::delete('empleados/delete/{certificacion}/competencias-certificaciones', 'EmpleadoController@deleteCertificaciones')->name('empleados.deleteCertificaciones');
    Route::post('empleados/update/{curso}/competencias-curso', 'EmpleadoController@updateCurso')->name('empleados.updateCurso');
    Route::delete('empleados/{curso}/delete-file-curso', 'EmpleadoController@deleteFileCurso')->name('empleados.deleteFileCurso');
    Route::post('empleados/store/{empleado}/competencias-cursos', 'EmpleadoController@storeCursos')->name('empleados.storeCursos');
    Route::delete('empleados/delete/{curso}/competencias-cursos', 'EmpleadoController@deleteCursos')->name('empleados.deleteCursos');
    Route::post('empleados/update/{experiencia}/competencias-experiencia', 'EmpleadoController@updateExperiencia')->name('empleados.updateExperiencia');
    Route::post('empleados/store/{empleado}/competencias-experiencia', 'EmpleadoController@storeExperiencia')->name('empleados.storeExperiencia');
    Route::delete('empleados/delete/{educacion}/competencias-educacion', 'EmpleadoController@deleteEducacion')->name('empleados.deleteEducacion');
    Route::post('empleados/update/{educacion}/competencias-educacion', 'EmpleadoController@updateEducacion')->name('empleados.updateEducacion');
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
    Route::post('empleados/{empleado}/update-from-curriculum', 'EmpleadoController@updateFromCurriculum')->name('empleados.updateFromCurriculum');
    Route::resource('empleados', 'EmpleadoController');

    // Timesheet
    Route::get('timesheet', 'TimesheetController@index')->name('timesheet');
    Route::get('timesheet/create', 'TimesheetController@create')->name('timesheet-create');

    Route::get('timesheet/proyectos', 'TimesheetController@proyectos')->name('timesheet-proyectos');
    Route::get('timesheet/tareas', 'TimesheetController@tareas')->name('timesheet-tareas');

    Route::get('timesheet/aprobar', 'TimesheetController@aprobar')->name('timesheet-aprobar');

    Route::resource('timesheet', 'TimesheetController')->except(['create', 'index']);

    //Competencia Tipo

    Route::get('Tipo/edit/{tipo}', 'RH\TipoCompetenciaController@edit')->name('tipo.edit');
    Route::resource('Tipo', 'RH\TipoCompetenciaController', ['except' => ['edit']]);

    // Organizacions
    Route::delete('organizacions/destroy', 'OrganizacionController@massDestroy')->name('organizacions.massDestroy');
    Route::post('organizacions/media', 'OrganizacionController@storeMedia')->name('organizacions.storeMedia');
    Route::post('organizacions/ckmedia', 'OrganizacionController@storeCKEditorImages')->name('organizacions.storeCKEditorImages');
    Route::get('organizacions/visualizarorganizacion', 'OrganizacionController@visualizarOrganizacion')->name('organizacions.visualizarorganizacion');
    Route::post('organizacions/{schedule}/update-schedule', 'OrganizacionController@updateSchedule')->name('organizacions.update-schedule');
    Route::post('organizacions/{schedule}/delete-schedule', 'OrganizacionController@deleteSchedule')->name('organizacions.delete-schedule');
    Route::resource('organizacions', 'OrganizacionController');

    Route::get('organigrama/exportar', 'OrganigramaController@exportTo')->name('organigrama.exportar');
    Route::get('organigrama', 'OrganigramaController@index')->name('organigrama.index');

    //Directorio

    Route::get('directorio', 'DirectorioEmpleadosController@index')->name('directorio.index');

    // Dashboards
    Route::resource('dashboards', 'DashboardController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Implementacions

    Route::resource('implementacions', 'ImplementacionController');

    // Planes de Acción
    Route::post('planes-de-accion/{plan}/save', 'PlanesAccionController@saveProject')->name('planes-de-accion.saveProject');
    Route::post('planes-de-accion/{plan}/load', 'PlanesAccionController@loadProject')->name('planes-de-accion.loadProject');
    Route::resource('planes-de-accion', 'PlanesAccionController');

    // Glosarios
    Route::get('glosario/acervo', 'GlosarioController@render')->name('glosarios.render');
    // Route::get('glosario/{glosarios}/glosario-edit', 'GlosarioController@edit')->name('glosario.edit');
    Route::get('glosarios/edit/{glosarios}', 'GlosarioController@edit')->name('glosarios.edit');
    // Route::delete('glosarios/destroy', 'GlosarioController@destroy')->name('glosarios.destroy');
    Route::resource('glosarios', 'GlosarioController', ['except' => ['edit']]);

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

    //Configuración Soporte
    Route::delete('configurar-soporte/destroy', 'ConfigurarSoporteController@massDestroy')->name('configurar-soporte.massDestroy');
    Route::resource('configurar-soporte', 'ConfigurarSoporteController');
    Route::get('getgetEmployeeData', 'ConfigurarSoporteController@getgetEmployeeData')->name('getgetEmployeeData');
    Route::get('soporte', 'ConfigurarSoporteController@visualizarSoporte')->name('soporte');

    //Configuración Consultores
    // Route::delete('configurar-consultor/destroy', 'ConfigurarConsultorController@massDestroy')->name('configurar-consultor.massDestroy');
    // Route::resource('configurar-consultor', 'ConfigurarConsultorController');

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
    Route::post('recursos/{recurso}/asistencia-capacitacion', 'RecursosController@guardarAsistenciaCapacitacion')->name('recursos.guardarAsistenciaCapacitacion');
    Route::post('recursos/capacitacion-evaluacion', 'RecursosController@guardarEvaluacionCapacitacion')->name('recursos.guardarEvaluacionCapacitacion');
    // Route::post('recursos/reprogramar-capacitacion', 'RecursosController@reprogramarCapacitacion')->name('recursos.reprogramarCapacitacion');
    Route::post('recursos/{recurso}/reprogramar-capacitacion', 'RecursosController@reprogramarCapacitacion')->name('recursos.reprogramarCapacitacion');
    Route::post('recursos/{recurso}/cancelar-capacitacion', 'RecursosController@cancelarCapacitacion')->name('recursos.cancelarCapacitacion');
    Route::post('recursos/{recurso}/enviar-invitaciones-capacitacion', 'RecursosController@enviarInvitacionPorCorreoAhora')->name('recursos.enviarInvitacionPorCorreoAhora');
    Route::post('recursos/capacitaciones-principales', 'RecursosController@obtenerCapacitacionesPrincipales')->name('recursos.obtenerCapacitacionesPrincipales');
    Route::post('recursos/capacitaciones-archivadas', 'RecursosController@obtenerCapacitacionesArchivadas')->name('recursos.obtenerCapacitacionesArchivadas');
    Route::post('recursos/capacitacion/respuesta', 'RecursosController@respuestaCapacitacion')->name('recursos.respuestaCapacitacion');
    Route::post('recursos/capacitacion/archivar', 'RecursosController@archivarCapacitacion')->name('recursos.archivarCapacitacion');
    Route::post('recursos/validate', 'RecursosController@validateForm')->name('recursos.validateForm');
    Route::post('recursos/{recurso}/update', 'RecursosController@update')->name('recursos.update');
    Route::delete('recursos/destroy', 'RecursosController@massDestroy')->name('recursos.massDestroy');
    Route::post('recursos/media', 'RecursosController@storeMedia')->name('recursos.storeMedia');
    Route::post('recursos/ckmedia', 'RecursosController@storeCKEditorImages')->name('recursos.storeCKEditorImages');
    Route::post('recursos/suscribir/', 'RecursosController@suscribir')->name('recursos.suscribir');
    Route::post('recursos/cancelar/', 'RecursosController@eliminarParticipante')->name('recursos.cancelar');
    Route::post('recursos/calificar/', 'RecursosController@calificarParticipante')->name('recursos.calificar');
    Route::get('recursos/{recurso}/participantes/', 'RecursosController@participantes')->name('recursos.participantes');
    Route::get('recursos/{recurso}/participantes/get', 'RecursosController@getParticipantes')->name('recursos.getParticipantes');
    Route::resource('recursos', 'RecursosController')->except(['update']);

    // Competencia
    Route::get('competencia/{empleado}/idiomas', 'IdiomasEmpleadosController@index')->name('idiomas-empleados.index');
    Route::post('competencia/{idiomaEmpleado}/idiomas', 'IdiomasEmpleadosController@update')->name('idiomas-empleados.update');
    Route::delete('competencia/{idiomaEmpleado}/idiomas-delete-certificado', 'IdiomasEmpleadosController@deleteCertificado')->name('idiomas-empleados.deleteCertificado');
    Route::resource('competencia/idiomas-empleados', 'IdiomasEmpleadosController')->except(['index', 'update', 'show']);
    Route::delete('competencia/destroy', 'CompetenciasController@massDestroy')->name('competencia.massDestroy');
    Route::post('competencia/media', 'CompetenciasController@storeMedia')->name('competencia.storeMedia');
    Route::post('competencia/ckmedia', 'CompetenciasController@storeCKEditorImages')->name('competencia.storeCKEditorImages');
    Route::resource('competencia', 'CompetenciasController');
    Route::get('buscarCV', 'CompetenciasController@buscarcv')->name('buscarCV');
    Route::get('expedientes-profesionales', 'CompetenciasController@expedientesProfesionales')->name('capital.expedientes-profesionales');
    Route::post('competencias/{empleado}/documentos-carga', 'CompetenciasController@cargarDocumentos')->name('cargarDocumentos');
    Route::post('competencias/{empleado}/capacitacion-carga', 'CompetenciasController@cargarCapacitaciones')->name('cargarCapacitacion');
    Route::post('competencias/{empleado}/certificacion-carga', 'CompetenciasController@cargarCertificacion')->name('cargarCertificacion');
    Route::get('competencias/{empleado}/edit', 'CompetenciasController@editarCompetencias')->name('editarCompetencias');
    Route::get('competencias/{empleado}/cv', 'CompetenciasController@miCurriculum')->name('miCurriculum');

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

    // Route::post('activos/create', 'ActivosController@save');
    Route::get('activos/descargar', 'ActivosController@DescargaFormato')->name('activos.descargar');
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
    Route::get('areas/exportar', 'AreasController@exportTo')->name('areas.exportar');
    Route::delete('areas/destroy', 'AreasController@massDestroy')->name('areas.massDestroy');
    Route::get('areas/grupo', 'AreasController@obtenerAreasPorGrupo')->name('areas.obtenerAreasPorGrupo');
    Route::post('areas/parse-csv-import', 'AreasController@parseCsvImport')->name('areas.parseCsvImport');
    Route::get('areas/jerarquia', 'AreasController@renderJerarquia')->name('areas.renderJerarquia');
    Route::get('areas/jerarquia/lista', 'AreasController@obtenerJerarquia')->name('areas.obtenerJerarquia');
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
    // Subtipo Activos

    Route::delete('subtipoactivos/destroy', 'SubcategoriaActivoContoller@massDestroy')->name('subtipoactivos.massDestroy');
    Route::post('subtipoactivos/parse-csv-import', 'SubcategoriaActivoContoller@parseCsvImport')->name('subtipoactivos.parseCsvImport');
    Route::post('subtipoactivos/process-csv-import', 'SubcategoriaActivoContoller@processCsvImport')->name('subtipoactivos.processCsvImport');
    Route::resource('subtipoactivos', 'SubcategoriaActivoContoller')->names([
        'index' => 'subtipoactivos.index',
        'create' => 'subtipoactivos.create',
        'store' => 'subtipoactivos.store',
        'show' => 'subtipoactivos.show',
        'edit' => 'subtipoactivos.edit',
        'update' => 'subtipoactivos.update',
    ]);

    // Puestos
    Route::delete('puestos/destroy', 'PuestosController@massDestroy')->name('puestos.massDestroy');
    Route::post('puestos/parse-csv-import', 'PuestosController@parseCsvImport')->name('puestos.parseCsvImport');
    Route::post('puestos/process-csv-import', 'PuestosController@processCsvImport')->name('puestos.processCsvImport');
    Route::resource('puestos', 'PuestosController');
    Route::get('consulta-puestos', 'PuestosController@consultaPuestos')->name('consulta-puestos');

    // Perfiles
    Route::delete('perfiles/destroy', 'PerfilController@massDestroy')->name('perfiles.massDestroy');
    Route::post('perfiles/parse-csv-import', 'PerfilController@parseCsvImport')->name('perfiles.parseCsvImport');
    Route::post('perfiles/process-csv-import', 'PerfilController@processCsvImport')->name('perfiles.processCsvImport');
    Route::resource('perfiles', 'PerfilController');

    // Route::resource('consulta-puesto', 'ConsultaPuestoController');

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
    Route::get('analisis-riesgos-menu', 'AnalisisdeRiesgosController@menu')->name('analisis-riesgos.menu');
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
    Route::post('/revisiones/documentos-debo-aprobar', 'RevisionDocumentoController@obtenerDocumentosDeboAprobar')->name('revisiones.obtenerDocumentosDeboAprobar');
    Route::post('/revisiones/documentos-debo-aprobar-archivo', 'RevisionDocumentoController@obtenerDocumentosDeboAprobarArchivo')->name('revisiones.obtenerDocumentosDeboAprobarArchivo');

    //Documentos
    Route::get('documentos/publicados', [DocumentosController::class, 'publicados'])->name('documentos.publicados');
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

    Route::resource('panel-inicio', 'PanelInicioRuleController');
    Route::resource('panel-organizacion', 'PanelOrganizacionController');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa', 'active']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});

Route::group(['prefix' => 'iso9001'], function () {
    Route::get('planTrabajobase', 'iso9001\PlanImplementacionNueveUnoController@showTarea');
    Route::post('plantTrabajoBase/bloqueo/mostrar', 'iso9001\LockedPlanTrabajoController@getLockedToPlanTrabajo')->name('lockedPlan.getLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/quitar', 'iso9001\LockedPlanTrabajoController@removeLockedToPlanTrabajo')->name('lockedPlan.removeLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/is-locked', 'iso9001\LockedPlanTrabajoController@isLockedToPlanTrabajo')->name('lockedPlan.isLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/registrar', 'iso9001\LockedPlanTrabajoController@setLockedToPlanTrabajo')->name('lockedPlan.setLockedToPlanTrabajo');
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

//#######################
//### NOTIFICACIONES ###
//#####################

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
Route::group(['middleware' => ['auth', '2fa']], function () {
    //Ruta ImportExcel
    Route::get('CargaDocs', 'CargaDocs@index')->name('cargadocs');
    Route::post('CargaAmenaza', 'SubidaExcel@Amenaza')->name('carga-amenaza');
    Route::post('CargaVulnerabilidad', 'SubidaExcel@Vulnerabilidad')->name('carga-vulnerabilidad');
    Route::post('CargaUsuario', 'SubidaExcel@Usuario')->name('carga-usuario');
    Route::post('CargaPuesto', 'SubidaExcel@Puesto')->name('carga-puesto');
    Route::post('CargaControl', 'SubidaExcel@Control')->name('carga-control');
    Route::post('CargaEjecutarenlace', 'SubidaExcel@Ejecutarenlace')->name('carga-ejecutarenlace');
    Route::post('CargaTeam', 'SubidaExcel@Team')->name('carga-team');
    Route::post('CargaEstadoIncidente', 'SubidaExcel@EstadoIncidente')->name('carga-estadoincidente');
    Route::post('CargaRole', 'SubidaExcel@Roles')->name('carga-roles');
    Route::post('CargaCompetencia', 'SubidaExcel@Competencia')->name('carga-competencia');
    Route::post('CargaEvaluacion', 'SubidaExcel@Evaluacion')->name('carga-evaluacion');
    Route::post('CargaCategoriaCapacitacion', 'SubidaExcel@CategoriaCapacitacion')->name('carga-categoriacapacitacion');
    Route::post('CargaRevisionDireccion', 'SubidaExcel@RevisionDireccion')->name('carga-revisiondireccion');
    Route::post('CargaAnalisisRiesgo', 'SubidaExcel@AnalisisRiesgo')->name('carga-analisis_riego');
    Route::post('CargaPartesInteresadas', 'SubidaExcel@PartesInteresadas')->name('carga-partes_interesadas');
    Route::post('CargaMatrizRequisitosLegales', 'SubidaExcel@MatrizRequisitosLegales')->name('carga-matriz_requisitos_legales');
    Route::post('CargaFoda', 'SubidaExcel@Foda')->name('carga-foda');
    Route::post('CargaDeterminacionAlcance', 'SubidaExcel@DeterminacionAlcance')->name('carga-determinacion_alcance');
    Route::post('CargaComiteSeguridad', 'SubidaExcel@ComiteSeguridad')->name('carga-comite_seguridad');
    Route::post('CargaAltaDireccion', 'SubidaExcel@AltaDireccion')->name('carga-alta_direccion');
    Route::post('CargaEvidenciaRecursos', 'SubidaExcel@EvidenciaRecursos')->name('carga-evidencia_recursos');
    Route::post('CargaPoliticaSgsi', 'SubidaExcel@PoliticaSgsi')->name('carga-politica_sgi');
    Route::post('CargaGrupoArea', 'SubidaExcel@GrupoArea')->name('carga-grupo_area');
    Route::post('CargaDatosArea', 'SubidaExcel@DatosArea')->name('carga-datos_area');
    Route::post('CargaActivos', 'SubidaExcel@Activos')->name('carga-activo_inventario');
    Route::post('CargaEmpleado', 'SubidaExcel@Empleado')->name('carga-empleado');
    // Route::post('CargaCategoria', 'SubidaExcel@CategoriaActivo')->name('carga-categoria');

    //Ruta ExportExcel
    Route::get('ExportAmenaza', 'ExportExcel@Amenaza')->name('descarga-amenaza');
    Route::get('ExportVulnerabilidad', 'ExportExcel@Vulnerabilidad')->name('descarga-vulnerabilidad');
    Route::get('ExportAnalisisRiesgo', 'ExportExcel@AnalisisRiesgo')->name('descarga-analisis_riego');
    Route::get('ExportPartesInteresadas', 'ExportExcel@PartesInteresadas')->name('descarga-partes_interesadas');
    Route::get('ExportMatrizRequisitosLegales', 'ExportExcel@MatrizRequisitosLegales')->name('descarga-matriz_requisitos_legales');
    Route::get('ExportFoda', 'ExportExcel@Foda')->name('descarga-foda');
    Route::get('ExportDeterminacionAlcance', 'ExportExcel@DeterminacionAlcance')->name('descarga-determinacion_alcance');
    Route::get('ExportComiteSeguridad', 'ExportExcel@ComiteSeguridad')->name('descarga-comite_seguridad');
    Route::get('ExportAltaDireccion', 'ExportExcel@AltaDireccion')->name('descarga-alta_direccion');
    Route::get('ExportCategoriaCapacitacion', 'ExportExcel@CategoriaCapacitacion')->name('descarga-categoriacapacitacion');
    Route::get('ExportRevisionDireccion', 'ExportExcel@RevisionDireccion')->name('descarga-revisiondireccion');
    Route::get('ExportCategoria', 'ExportExcel@CategoriaActivo')->name('descarga-categoria');
    Route::get('ExportPuesto', 'ExportExcel@Puesto')->name('descarga-puesto');
    Route::get('ExportEstadoIncidente', 'ExportExcel@EstadoIncidente')->name('descarga-estadoincidente');
    Route::post('ExportRole', 'ExportExcel@Roles')->name('descarga-roles');
    Route::get('ExportPoliticaSgsi', 'ExportExcel@PoliticaSgsi')->name('descarga-politica_sgi');
    Route::get('ExportGrupoArea', 'ExportExcel@GrupoArea')->name('descarga-grupo_area');
    Route::get('ExportEmpleado', 'ExportExcel@Empleado')->name('descarga-empleado');
    Route::get('ExportActivos', 'ExportExcel@Activos')->name('descarga-activo_inventario');

    //  Route::get('ExportFormatoResponsivo', 'ActivosController@ExportFormato')->name('descarga-formato_reponsivo');
});

Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    Route::view('sitemap', 'admin.sitemap.index');
    // Route::view('stepper', 'stepper');
    //Route::view('admin/gantt', 'admin.gantt.grap');

    //URL::forceScheme('https');

    Route::view('post_register', 'auth.post_register');
});
