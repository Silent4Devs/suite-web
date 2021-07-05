<?php

//Route::view('/', 'welcome');

use App\Http\Controllers\Admin\CategoriaCapacitacionController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Livewire\NotificacionesComponent;

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {

    Route::view('iso27001', 'admin.iso27001.index')->name('iso27001.index');


    Route::view('soporte', 'admin.soporte.index')->name('soporte.index');

    Route::post('plantTrabajoBase/bloqueo/mostrar', 'LockedPlanTrabajoController@getLockedToPlanTrabajo')->name('lockedPlan.getLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/quitar', 'LockedPlanTrabajoController@removeLockedToPlanTrabajo')->name('lockedPlan.removeLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/is-locked', 'LockedPlanTrabajoController@isLockedToPlanTrabajo')->name('lockedPlan.isLockedToPlanTrabajo');
    Route::post('plantTrabajoBase/bloqueo/registrar', 'LockedPlanTrabajoController@setLockedToPlanTrabajo')->name('lockedPlan.setLockedToPlanTrabajo');

    Route::get('inicioUsuario', 'inicioUsuarioController@index')->name('inicio-Usuario.index');


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
    Route::get('analisis-brechas', 'AnalisisBController@index');
    Route::post('analisis-brechas/update', 'AnalisisBController@update');


    // Declaracion de Aplicabilidad
    Route::get('declaracion-aplicabilidad/descargar', 'DeclaracionAplicabilidadController@download')->name('declaracion-aplicabilidad.descargar');
    Route::delete('declaracion-aplicabilidad/destroy', 'DeclaracionAplicabilidadController@massDestroy')->name('declaracion-aplicabilidad.massDestroy');
    Route::resource('declaracion-aplicabilidad', 'DeclaracionAplicabilidadController');

    //gantt
    Route::get('gantt', 'GanttController@index');
    Route::post('gantt/update', 'GanttController@update');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    //procesos
    Route::resource('procesos', 'ProcesoController');

    //macroprocesos
    Route::resource('macroprocesos', 'MacroprocesoController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    //Route::post('users/get', 'UsersController@getUsers')->name('users.get');
    Route::resource('users', 'UsersController');

    // Empleados
    Route::post('empleados/get', 'EmpleadoController@getEmpleados')->name('empleados.get');
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
    Route::resource('entendimiento-organizacions', 'EntendimientoOrganizacionController', ['except' => ['show', 'destroy']]);

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

    //Grupo Areas
    Route::delete('grupoarea/destroy', 'GrupoAreaController@massDestroy')->name('grupoarea.massDestroy');
    Route::post('grupoarea/parse-csv-import', 'GrupoAreaController@parseCsvImport')->name('grupoarea.parseCsvImport');
    Route::post('grupoarea/process-csv-import', 'GrupoAreaController@processCsvImport')->name('grupoarea.processCsvImport');
    Route::resource('grupoarea', 'GrupoAreaController');


    // Indicadores Sgsis
    Route::delete('indicadores-sgsis/destroy', 'IndicadoresSgsiController@massDestroy')->name('indicadores-sgsis.massDestroy');
    Route::resource('indicadores-sgsis', 'IndicadoresSgsiController');

    // Indicadorincidentessis
    Route::resource('indicadorincidentessis', 'IndicadorincidentessiController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Auditoria Anuals
    Route::delete('auditoria-anuals/destroy', 'AuditoriaAnualController@massDestroy')->name('auditoria-anuals.massDestroy');
    Route::resource('auditoria-anuals', 'AuditoriaAnualController');

    // Plan Auditoria
    Route::delete('plan-auditoria/destroy', 'PlanAuditoriaController@massDestroy')->name('plan-auditoria.massDestroy');
    Route::resource('plan-auditoria', 'PlanAuditoriaController');

    // Accion Correctivas
    Route::delete('accion-correctivas/destroy', 'AccionCorrectivaController@massDestroy')->name('accion-correctivas.massDestroy');
    Route::post('accion-correctivas/media', 'AccionCorrectivaController@storeMedia')->name('accion-correctivas.storeMedia');
    Route::post('accion-correctivas/ckmedia', 'AccionCorrectivaController@storeCKEditorImages')->name('accion-correctivas.storeCKEditorImages');
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
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');

    // Matriz Riesgos
    Route::delete('matriz-riesgos/destroy', 'MatrizRiesgosController@massDestroy')->name('matriz-riesgos.massDestroy');
    Route::resource('matriz-riesgos', 'MatrizRiesgosController');

    // Gap Unos
    Route::delete('gap-unos/destroy', 'GapUnoController@massDestroy')->name('gap-unos.massDestroy');
    Route::resource('gap-unos', 'GapUnoController');

    // Gap Dos
    Route::delete('gap-dos/destroy', 'GapDosController@massDestroy')->name('gap-dos.massDestroy');
    Route::resource('gap-dos', 'GapDosController');

    // Gap Tres
    Route::delete('gap-tres/destroy', 'GapTresController@massDestroy')->name('gap-tres.massDestroy');
    Route::resource('gap-tres', 'GapTresController');

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



Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {

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
});

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
Route::view('stepper', 'stepper');
//Route::view('admin/gantt', 'admin.gantt.grap');

//URL::forceScheme('https');


Route::view('post_register', 'auth.post_register');

Route::view('test', 'auth.test');
