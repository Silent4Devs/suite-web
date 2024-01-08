<?php

use App\Http\Controllers\Admin\DocumentosController;
use App\Http\Controllers\Admin\GrupoAreaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsuarioBloqueado;
use App\Http\Controllers\Visitantes\RegistroVisitantesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'visitantes', 'as' => 'visitantes.', 'namespace' => 'Visitantes'], function () {
    Route::get('/presentacion', [RegistroVisitantesController::class, 'presentacion'])->name('presentacion');
    Route::get('/salida', [RegistroVisitantesController::class, 'salida'])->name('salida');
    Route::get('/salida/{registrarVisitante?}/registrar', [RegistroVisitantesController::class, 'registrarSalida'])->name('salida.registrar');
    Route::resource('/', 'RegistroVisitantesController');
});

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/usuario-bloqueado', [UsuarioBloqueado::class, 'usuarioBloqueado'])->name('users.usuario-bloqueado');

Route::post('/revisiones/approve', 'RevisionDocumentoController@approve')->name('revisiones.approve');
Route::post('/revisiones/reject', 'RevisionDocumentoController@reject')->name('revisiones.reject');
Route::get('/revisiones/{revisionDocumento}', 'RevisionDocumentoController@edit')->name('revisiones.revisar');

Route::post('/minutas/revisiones/approve', 'RevisionMinutasController@approve')->name('minutas.revisiones.approve');
Route::post('/minutas/revisiones/reject', 'RevisionMinutasController@reject')->name('minutas.revisiones.reject');
Route::get('/minutas/revisiones/{revisionMinuta}', 'RevisionMinutasController@edit')->name('minutas.revisiones.revisar');
Route::get('comunicados-tv', 'ComunicadosTVController@index')->name('comunicados-tv');

Route::post('provedor_reporte', 'ContractManager\ReporteRequisicionController@AjaxRequestClientes')->name('provedor_reporte');
Route::post('contrato_reporte', 'ContractManager\ReporteRequisicionController@AjaxRequestContratos')->name('contrato_reporte');

Auth::routes();

// Tabla-Calendario

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'active']], function () {
    Route::get('inicioUsuario', 'InicioUsuarioController@index')->name('inicio-Usuario.index');
    Route::get('/', 'InicioUsuarioController@index');
    Route::get('/home', 'InicioUsuarioController@index')->name('home');
    //log-viewer
    //Route::get('log-viewer', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log-viewer');
    // Users
    Route::get('users/{id}/restablecer', 'UsersController@restablecerUsuario')->name('users.restablecer');
    Route::get('users/eliminados', 'UsersController@vistaEliminados')->name('users.eliminados');
    Route::get('users/two-factor/{user}/change', 'UsersController@cambiarVerificacion')->name('users.two-factor-change');
    Route::get('users/bloqueo/{user}/change', 'UsersController@toogleBloqueo')->name('users.toogle-bloqueo');
    Route::post('users/vincular', 'UsersController@vincularEmpleado')->name('users.vincular');
    Route::post('users/list/get', 'UsersController@getUsersIndex')->name('users.getUsersIndex');
    Route::resource('users', 'UsersController');

    // Empleados
    Route::get('empleados/importar', 'EmpleadoController@importar')->name('empleado.importar');
    Route::post('empleados/list/get', 'EmpleadoController@getListaEmpleadosIndex')->name('empleado.getListaEmpleadosIndex');
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

    Route::post('empleado-deletemultiple', 'EmpleadoController@borradoMultiple')->name('empleado.deleteMultiple');
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

    Route::get('empleados/datosEmpleado/{id}', 'EmpleadoController@show');
    // Route::get('empleados/imprimir/{id}', 'EmpleadoController@imprimir')->name('imprimir');

    Route::post('empleados/{empleado}/update-from-curriculum', 'EmpleadoController@updateFromCurriculum')->name('empleados.updateFromCurriculum');
    Route::post('empleados/baja/remover-vacante', 'EmpleadoController@removerVacante')->name('empleados.removerVacante');
    Route::post('empleado/expediente/update', 'EmpleadoController@expedienteUpdate')->name('empleado.edit.expediente-update');
    Route::post('empleado/expediente/Restaurar', 'EmpleadoController@expedienteRestaurar')->name('empleado.edit.expediente-restaurar');
    Route::get('empleado/{empleado}/solicitud-baja', 'EmpleadoController@solicitudBaja')->name('empleado.solicitud-baja');
    Route::resource('empleados', 'EmpleadoController');

    // Organizacions
    Route::delete('organizacions/destroy', 'OrganizacionController@massDestroy')->name('organizacions.massDestroy');
    Route::post('organizacions/media', 'OrganizacionController@storeMedia')->name('organizacions.storeMedia');
    Route::post('organizacions/ckmedia', 'OrganizacionController@storeCKEditorImages')->name('organizacions.storeCKEditorImages');
    Route::get('organizacions/visualizarorganizacion', 'OrganizacionController@visualizarOrganizacion')->name('organizacions.visualizarorganizacion');
    Route::post('organizacions/{schedule}/update-schedule', 'OrganizacionController@updateSchedule')->name('organizacions.update-schedule');
    Route::post('organizacions/{schedule}/delete-schedule', 'OrganizacionController@deleteSchedule')->name('organizacions.delete-schedule');
    Route::resource('organizacions', 'OrganizacionController');
    // Inicio usuario

    // Areas
    Route::get('areas/exportar', 'AreasController@exportTo')->name('areas.exportar');
    Route::delete('areas/destroy', 'AreasController@massDestroy')->name('areas.massDestroy');
    Route::get('areas/grupo', 'AreasController@obtenerAreasPorGrupo')->name('areas.obtenerAreasPorGrupo');
    Route::post('areas/parse-csv-import', 'AreasController@parseCsvImport')->name('areas.parseCsvImport');
    Route::get('areas/jerarquia', 'AreasController@renderJerarquia')->name('areas.renderJerarquia');
    Route::get('areas/jerarquia/lista', 'AreasController@obtenerJerarquia')->name('areas.obtenerJerarquia');
    Route::post('areas/process-csv-import', 'AreasController@processCsvImport')->name('areas.processCsvImport');
    Route::resource('areas', 'AreasController');

    // Puestos
    Route::delete('puestos/destroy', 'PuestosController@massDestroy')->name('puestos.massDestroy');
    Route::post('puestos/delete-language', 'PuestosController@deleteLanguage')->name('puestos.deleteLanguage');
    Route::post('puestos/parse-csv-import', 'PuestosController@parseCsvImport')->name('puestos.parseCsvImport');
    Route::post('puestos/process-csv-import', 'PuestosController@processCsvImport')->name('puestos.processCsvImport');
    Route::resource('puestos', 'PuestosController');
    Route::get('consulta-puestos', 'PuestosController@consultaPuestos')->name('consulta-puestos');

    Route::group(['middleware' => ['auth', '2fa', 'active', 'primeros.pasos']], function () {
        // Visitantes
        Route::get('visitantes/autorizar', 'VisitantesController@autorizar')->name('visitantes.autorizar');
        Route::get('visitantes/configuracion', 'VisitantesController@configuracion')->name('visitantes.configuracion');
        Route::get('visitantes/dashboard', 'VisitantesController@dashboard')->name('visitantes.dashboard');
        Route::middleware('cacheResponse')->get('visitantes/menu', 'VisitantesController@menu')->name('visitantes.menu');
        Route::resource('visitantes/aviso-privacidad', 'VisitantesAvisoPrivacidadController')->names('visitantes.aviso-privacidad');
        Route::resource('visitantes/cita-textual', 'VisitanteQuoteController')->names('visitantes.cita-textual');
        Route::resource('visitantes', 'VisitantesController');
        // Fin visitantes
        Route::post('contenedores/escenarios/{contenedor}/agregar', 'ContenedorMatrizOctaveController@agregarEscenarios')->name('contenedores.escenarios.store');
        Route::get('contenedores/escenarios/{contenedor}/listar', 'ContenedorMatrizOctaveController@escenarios')->name('contenedores.escenarios.get');
        Route::delete('contenedores/destroy', 'ContenedorMatrizOctaveController@massDestroy')->name('contenedores.massDestroy');
        Route::post('contenedores/escenarios/eliminar', 'ContenedorMatrizOctaveController@eliminarEscenario')->name('contenedores.escenarios.destroy');

        Route::get('octave/arbol-riesgos/{matriz}', 'ArbolRiesgosOctaveController@index')->name('octave.arbol-riesgos.index');
        Route::post('octave/arbol-riesgos', 'ArbolRiesgosOctaveController@obtenerArbol')->name('octave.arbol-riesgos.obtener');
        Route::get('contenedores/{matriz}', 'ContenedorMatrizOctaveController@index')->name('contenedores.index');
        Route::get('contenedores/create/{matriz}', 'ContenedorMatrizOctaveController@create')->name('contenedores.create');
        Route::get('contenedores/{contenedor}/edit/{matriz}', 'ContenedorMatrizOctaveController@edit')->name('contenedores.edit');
        Route::delete('contenedores/{contenedor}', 'ContenedorMatrizOctaveController@destroy')->name('contenedores.destroy');
        Route::resource('contenedores', 'ContenedorMatrizOctaveController')->except(['index', 'create', 'edit', 'destroy']);

        Route::get('recursos-humanos/evaluacion-360', 'RH\Evaluacion360Controller@index')->name('rh-evaluacion360.index');

        //Modulo Capital Humano
        Route::middleware('cacheResponse')->get('capital-humano', 'RH\CapitalHumanoController@index')->name('capital-humano.index');

        //Control de Ausencias
        Route::get('ajustes-dayoff', 'AusenciasController@ajustesDayoff')->name('ajustes-dayoff');
        Route::get('ajustes-vacaciones', 'AusenciasController@ajustesVacaciones')->name('ajustes-vacaciones');
        Route::get('ajustes-permisos-goce-sueldo', 'AusenciasController@ajustesGoceSueldo')->name('ajustes-permisos-goce-sueldo');
        Route::resource('Ausencias', 'AusenciasController');

        // Route::get('solicitud-vacaciones/archivo', 'SolicitudVacacionesController@archivo')->name('solicitud-vacaciones.archivo');
        Route::get('envio-documentos/atencion', 'EnvioDocumentosController@atencion')->name('envio-documentos.atencion');
        Route::get('envio-documentos/atencion/{id}/seguimiento', 'EnvioDocumentosController@seguimiento')->name('envio-documentos.seguimiento');
        Route::put('envio-documentos/{id}/seguimientoUpdate', 'EnvioDocumentosController@seguimientoUpdate')->name('envio-documentos.seguimientoUpdate');
        Route::get('ajustes-envio-documentos', 'EnvioDocumentosController@ajustes')->name('ajustes-envio-documentos');
        Route::put('ajustes-envio-documentos/{id}/update', 'EnvioDocumentosController@ajustesUpdate')->name('ajustes-envio-documentos-update');
        Route::resource('envio-documentos', 'EnvioDocumentosController');

        //Control de Ausencias- Vacaciones
        Route::get('vista-global-vacaciones', 'VacacionesController@vistaGlobal')->name('vista-global-vacaciones');
        Route::get('ExportVacaciones', 'VacacionesController@exportExcel')->name('descarga-vacaciones');
        Route::delete('vacaciones/destroy', 'VacacionesController@massDestroy')->name('vacaciones.massDestroy');
        Route::resource('vacaciones', 'VacacionesController')->names([
            'create' => 'vacaciones.create',
            'store' => 'vacaciones.store',
            'show' => 'vacaciones.show',
            'edit' => 'vacaciones.edit',
            'update' => 'vacaciones.update',
            'destroy' => 'vacaciones.destroy',
        ]);

        Route::get('lista-distribucion', 'ListaDistribucionController@index')->name('lista-distribucion.index');
        Route::get('lista-distribucion/{id}/edit', 'ListaDistribucionController@edit')->name('lista-distribucion.edit');
        Route::post('lista-distribucion/{lista}/update', 'ListaDistribucionController@update')->name('lista-distribucion.update');
        Route::get('lista-distribucion/{id}/show', 'ListaDistribucionController@show')->name('lista-distribucion.edit');

        //Control de Ausencias- Day-Off
        Route::get('vista-global-dayoff', 'DayOffController@vistaGlobal')->name('vista-global-dayoff');
        Route::get('ExportDayOff', 'DayOffController@exportExcel')->name('descarga-dayOff');
        Route::delete('dayOff/destroy', 'DayOffController@massDestroy')->name('dayOff.massDestroy');
        Route::resource('dayOff', 'DayOffController')->names([
            'create' => 'dayOff.create',
            'store' => 'dayOff.store',
            'show' => 'dayOff.show',
            'edit' => 'dayOff.edit',
            'update' => 'dayOff.update',
            'destroy' => 'dayOff.destroy',
        ]);

        Route::get('vista-global-permisos-goce-sueldo', 'PermisosGoceSueldoController@vistaGlobal')->name('vista-global-permisos-goce-sueldo');
        Route::delete('permisos-goce-sueldo/destroy', 'PermisosGoceSueldoController@massDestroy')->name('permisos-goce-sueldo.massDestroy');
        Route::resource('permisos-goce-sueldo', 'PermisosGoceSueldoController')->names([
            'create' => 'permisos-goce-sueldo.create',
            'store' => 'permisos-goce-sueldo.store',
            'show' => 'permisos-goce-sueldo.show',
            'edit' => 'permisos-goce-sueldo.edit',
            'update' => 'permisos-goce-sueldo.update',
            'destroy' => 'permisos-goce-sueldo.destroy',
        ]);

        //Control de Solicitud- Vacaciones
        Route::get('solicitud-vacaciones/perido-adicional/create', 'SolicitudVacacionesController@periodoAdicional')->name('solicitud-vacaciones.periodoAdicional');
        Route::get('solicitud-vacaciones/{id}/archivoShow', 'SolicitudVacacionesController@archivoShow')->name('solicitud-vacaciones.archivoShow');
        Route::get('solicitud-vacaciones/{id}/vistaGlobal', 'SolicitudVacacionesController@showVistaGlobal')->name('solicitud-vacaciones.vistaGlobal');
        Route::get('solicitud-vacaciones/menu', 'SolicitudVacacionesController@aprobacionMenu')->name('solicitud-vacaciones.menu');
        Route::get('solicitud-vacaciones/archivo', 'SolicitudVacacionesController@archivo')->name('solicitud-vacaciones.archivo');
        Route::get('solicitud-vacaciones/aprobacion', 'SolicitudVacacionesController@aprobacion')->name('solicitud-vacaciones.aprobacion');
        Route::get('solicitud-vacaciones/{id}/respuesta', 'SolicitudVacacionesController@respuesta')->name('solicitud-vacaciones.respuesta');
        Route::get('solicitud-vacaciones/{id}/show', 'SolicitudVacacionesController@show')->name('solicitud-vacaciones.show');
        Route::post('solicitud-vacaciones/destroy', 'SolicitudVacacionesController@destroy')->name('solicitud-vacaciones.destroy');
        Route::resource('solicitud-vacaciones', 'SolicitudVacacionesController')->names([
            'create' => 'solicitud-vacaciones.create',
            'store' => 'solicitud-vacaciones.store',
            'show' => 'solicitud-vacaciones.show',
            'edit' => 'solicitud-vacaciones.edit',
            'update' => 'solicitud-vacaciones.update',
            'destroy' => 'solicitud-vacaciones.destroy',
        ])->except(['show', 'destroy']);

        Route::get('solicitud-dayoff/{id}/showArchivo', 'SolicitudDayOffController@showArchivo')->name('solicitud-dayoff.showArchivo');
        Route::get('solicitud-dayoff/{id}/vistaGlobal', 'SolicitudDayOffController@showVistaGlobal')->name('solicitud-dayoff.vistaGlobal');
        Route::get('solicitud-dayoff/menu', 'SolicitudDayOffController@aprobacionMenu')->name('solicitud-dayoff.menu');
        Route::get('solicitud-dayoff/archivo', 'SolicitudDayOffController@archivo')->name('solicitud-dayoff.archivo');
        Route::get('solicitud-dayoff/aprobacion', 'SolicitudDayOffController@aprobacion')->name('solicitud-dayoff.aprobacion');
        Route::get('solicitud-dayoff/{id}/respuesta', 'SolicitudDayOffController@respuesta')->name('solicitud-dayoff.respuesta');
        Route::get('solicitud-dayoff/{id}/show', 'SolicitudDayOffController@show')->name('solicitud-dayoff.show');
        Route::post('solicitud-dayoff/destroy', 'SolicitudDayOffController@destroy')->name('solicitud-dayoff.destroy');
        Route::resource('solicitud-dayoff', 'SolicitudDayOffController')->names([
            'create' => 'solicitud-dayoff.create',
            'store' => 'solicitud-dayoff.store',
            'show' => 'solicitud-dayoff.show',
            'edit' => 'solicitud-dayoff.edit',
            'update' => 'solicitud-dayoff.update',
            'destroy' => 'solicitud-dayoff.destroy',
        ])->except(['show', 'destroy']);

        Route::get('solicitud-permiso-goce-sueldo/{id}/showArchivo', 'SolicitudPermisoGoceSueldoController@showArchivo')->name('solicitud-permiso-goce-sueldo.showArchivo');
        Route::get('solicitud-permiso-goce-sueldo/{id}/vistaGlobal', 'SolicitudPermisoGoceSueldoController@showVistaGlobal')->name('solicitud-permiso-goce-sueldo.vistaGlobal');
        Route::get('solicitud-permiso-goce-sueldo/menu', 'SolicitudPermisoGoceSueldoController@aprobacionMenu')->name('solicitud-permiso-goce-sueldo.menu');
        Route::get('solicitud-permiso-goce-sueldo/archivo', 'SolicitudPermisoGoceSueldoController@archivo')->name('solicitud-permiso-goce-sueldo.archivo');
        Route::get('solicitud-permiso-goce-sueldo/aprobacion', 'SolicitudPermisoGoceSueldoController@aprobacion')->name('solicitud-permiso-goce-sueldo.aprobacion');
        Route::get('solicitud-permiso-goce-sueldo/{id}/respuesta', 'SolicitudPermisoGoceSueldoController@respuesta')->name('solicitud-permiso-goce-sueldo.respuesta');
        Route::get('solicitud-permiso-goce-sueldo/{id}/show', 'SolicitudPermisoGoceSueldoController@show')->name('solicitud-permiso-goce-sueldo.show');
        Route::post('solicitud-permiso-goce-sueldo/destroy', 'SolicitudPermisoGoceSueldoController@destroy')->name('solicitud-permiso-goce-sueldo.destroy');
        Route::resource('solicitud-permiso-goce-sueldo', 'SolicitudPermisoGoceSueldoController')->names([
            'create' => 'solicitud-permiso-goce-sueldo.create',
            'store' => 'solicitud-permiso-goce-sueldo.store',
            'show' => 'solicitud-permiso-goce-sueldo.show',
            'edit' => 'solicitud-permiso-goce-sueldo.edit',
            'update' => 'solicitud-permiso-goce-sueldo.update',
            'destroy' => 'solicitud-permiso-goce-sueldo.destroy',
        ])->except(['show', 'destroy']);

        Route::resource('incidentes-vacaciones', 'IncidentesVacacionesController')->names([
            'create' => 'incidentes-vacaciones.create',
            'store' => 'incidentes-vacaciones.store',
            'show' => 'incidentes-vacaciones.show',
            'edit' => 'incidentes-vacaciones.edit',
            'update' => 'incidentes-vacaciones.update',
            'destroy' => 'incidentes-vacaciones.destroy',
        ]);

        Route::resource('incidentes-dayoff', 'IncidentesDayOffController')->names([
            'create' => 'incidentes-dayoff.create',
            'store' => 'incidentes-dayoff.store',
            'show' => 'incidentes-dayoff.show',
            'edit' => 'incidentes-dayoff.edit',
            'update' => 'incidentes-dayoff.update',
            'destroy' => 'incidentes-dayoff.destroy',
        ]);

        //Tipos de contratos
        Route::resource('recursos-humanos/tipos-contratos-empleados', 'RH\TipoContratoEmpleadoController');
        Route::resource('recursos-humanos/entidades-crediticias', 'RH\EntidadCrediticiaController');
        Route::resource('recursos-humanos/dependientes-empleados', 'RH\DependientesEconomicosEmpleadosController');
        Route::resource('recursos-humanos/contactos-emergencia-empleados', 'RH\ContactosEmergenciaEmpleadoController');
        Route::resource('recursos-humanos/beneficiarios-empleados', 'RH\BeneficiariosEmpleadoController');

        // Evaluaciones 360
        Route::post('recursos-humanos/evaluacion-360/normalizar/{evaluacion}/resultados', 'RH\EV360EvaluacionesController@normalizarResultados')->name('ev360-normalizar-resultados');
        Route::get('recursos-humanos/evaluacion-360', 'RH\EV360EvaluacionesController@index')->name('rh-evaluacion360.index');

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
        Route::post('recursos-humanos/evaluacion-360/evaluaciones/objetivo/calificacion-persepcion/store', 'RH\EV360EvaluacionesController@saveCalificacionPersepcion')->name('ev360-evaluaciones.objetivos.saveCalificacionPersepcion');
        Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/iniciar', 'RH\EV360EvaluacionesController@iniciarEvaluacion')->name('ev360-evaluaciones.iniciarEvaluacion');
        Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/postergar', 'RH\EV360EvaluacionesController@postergarEvaluacion')->name('ev360-evaluaciones.postergarEvaluacion');
        Route::post('recursos-humanos/evaluacion-360/evaluaciones/{evaluacion}/cerrar', 'RH\EV360EvaluacionesController@cerrarEvaluacion')->name('ev360-evaluaciones.cerrarEvaluacion');
        Route::post('recursos-humanos/evaluacion-360/autoevaluacion/competencias/obtener', 'RH\EV360EvaluacionesController@getAutoevaluacionCompetencias')->name('ev360-evaluaciones.autoevaluacion.competencias.get');
        Route::post('recursos-humanos/evaluacion-360/autoevaluacion/objetivos/obtener', 'RH\EV360EvaluacionesController@getAutoevaluacionObjetivos')->name('ev360-evaluaciones.autoevaluacion.objetivos.get');
        Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/consulta/{evaluado}', 'RH\EV360EvaluacionesController@consultaPorEvaluado')->name('ev360-evaluaciones.autoevaluacion.consulta.evaluado');
        // Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/reactivar/{evaluado}', 'RH\EV360EvaluacionesController@reactivarPorEvaluado')->name('ev360-evaluaciones.reactivarPorEvaluado');
        Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/reactivar/{evaluado}/{evaluador}', 'RH\EV360EvaluacionesController@reactivarPorEvaluador')->name('ev360-evaluaciones.reactivarPorEvaluador');
        Route::post('recursos-humanos/evaluacion-360/normalizar/objetivo', 'RH\EV360EvaluacionesController@normalizarCalificacionObjetivo')->name('ev360-evaluaciones.normalizar.objetivo');
        Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/resumen', 'RH\EV360EvaluacionesController@resumen')->name('ev360-evaluaciones.consulta.resumen');
        Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/resumen/jefe/{empleado}', 'RH\EV360EvaluacionesController@resumenJefe')->name('ev360-evaluaciones.consulta.resumenJefe');
        Route::get('recursos-humanos/evaluacion-360/evaluacion/{evaluacion}/resumen/empleado/{empleado}', 'RH\EV360EvaluacionesController@resumenEmpleado')->name('ev360-evaluaciones.consulta.resumenEmpleado');
        Route::resource('recursos-humanos/evaluacion-360/evaluaciones', 'RH\EV360EvaluacionesController')->names([
            'index' => 'ev360-evaluaciones.index',
            'create' => 'ev360-evaluaciones.create',
            'store' => 'ev360-evaluaciones.store',
            // 'show' => 'ev360-evaluaciones.show',
            'edit' => 'ev360-evaluaciones.edit',
            'update' => 'ev360-evaluaciones.update',
        ]);

        Route::get('recursos-humanos/evaluacion-360/evaluacion/objetivostmp', 'RH\EV360EvaluacionesController@objetivostemporal')->name('ev360-evaluaciones.objetivostmp');

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

        // Route::get('recursos-humanos/evaluacion-360/competencias/{id}', 'RH\EV360CompetenciasController@show')->name('ev360-competencias.show');

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
        Route::post('recursos-humanos/evaluacion-360/{empleado}/objetivos/{objetivo}/aprobar', 'RH\EV360ObjetivosController@aprobarRechazarObjetivo')->name('ev360-objetivos-empleado.aprobarRechazarObjetivo');
        Route::get('recursos-humanos/evaluacion-360/{empleado}/objetivos/lista', 'RH\EV360ObjetivosController@show')->name('ev360-objetivos-empleado.show');
        Route::get('recursos-humanos/evaluacion-360/objetivos/{empleado}/copiar', 'RH\EV360ObjetivosController@indexCopiar')->name('ev360-objetivos-empleado.indexCopiar');
        Route::post('recursos-humanos/evaluacion-360/objetivos/definir-nuevos', 'RH\EV360ObjetivosController@definirNuevosObjetivos')->name('ev360-objetivos-empleado.definir-nuevos');
        Route::post('recursos-humanos/evaluacion-360/objetivos/copiar', 'RH\EV360ObjetivosController@storeCopiaObjetivos')->name('ev360-objetivos-empleado.storeCopiaObjetivos');
        Route::post('recursos-humanos/evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@storeByEmpleado')->name('ev360-objetivos-empleado.store');

        Route::get('recursos-humanos/evaluacion-360/objetivos/{objetivo}/edit', 'RH\EV360ObjetivosController@edit')->name('ev360-objetivos-empleado.edit');
        Route::post('recursos-humanos/evaluacion-360/objetivos/{objetivo}', 'RH\EV360ObjetivosController@destroyByEmpleado')->name('ev360-objetivos-empleado.destroyByEmpleado');
        Route::get('recursos-humanos/evaluacion-360/{empleado}/objetivos/{objetivo}/editByEmpleado', 'RH\EV360ObjetivosController@editByEmpleado')->name('ev360-objetivos-empleado.editByEmpleado');
        Route::post('recursos-humanos/evaluacion-360/objetivos/{objetivo}/empleado', 'RH\EV360ObjetivosController@updateByEmpleado')->name('ev360-objetivos-empleado.updateByEmpleado');
        Route::resource('recursos-humanos/evaluacion-360/objetivos', 'RH\EV360ObjetivosController')->names([
            'index' => 'ev360-objetivos.index',
            'destroy' => 'ev360-objetivos.destroy',
        ])->except(['show']);

        Route::get('Perspectiva/edit/{perspectivas}', 'RH\ObejetivoPerspectivaController@edit')->name('perspectivas.edit');
        Route::resource('Perspectiva', 'RH\ObejetivoPerspectivaController', ['except' => ['edit']]);

        Route::get('Metrica/edit/{metrica}', 'RH\ObjetivoUnidadMedidaController@edit')->name('metrica.edit');
        Route::resource('Metrica', 'RH\ObjetivoUnidadMedidaController', ['except' => ['edit']]);

        Route::view('iso27001', 'admin.iso27001.index')->name('iso27001.index');
        Route::view('iso27001/guia', 'admin.iso27001.guia')->name('iso27001.guia');
        Route::view('iso27001/normas-guia', 'admin.iso27001.normas-guia')->name('iso27001.normas-guia');
        Route::view('iso27001/inicio-guia', 'admin.iso27001.inicio-guia')->name('iso27001.inicio-guia');
        Route::view('iso27001M', 'admin.iso27001M.index')->name('iso27001M.index');
        Route::view('iso9001', 'admin.iso9001.index')->name('iso9001.index');
        Route::view('contratos', 'admin.contratos.index')->name('contratos.index');
        Route::view('visualizar-logs', 'admin.visualizar-logs.index')->name('visualizar-logs.index');

        Route::get('portal-comunicacion/reportes', 'PortalComunicacionController@reportes')->name('portal-comunicacion.reportes');
        Route::post('portal-comunicacion/cumpleaños/{id}', 'PortalComunicacionController@felicitarCumpleaños')->name('portal-comunicacion.cumples');
        Route::post('portal-comunicacion/cumpleaños-dislike/{id}', 'PortalComunicacionController@felicitarCumpleañosDislike')->name('portal-comunicacion.cumples-dislike');
        Route::post('portal-comunicacion/cumpleaños_comentarios/{id}', 'PortalComunicacionController@felicitarCumplesComentarios')->name('portal-comunicacion.cumples-comentarios');
        Route::post('portal-comunicacion/cumpleaños_comentarios_update/{id}', 'PortalComunicacionController@felicitarCumplesComentariosUpdate')->name('portal-comunicacion.cumples-comentarios-update');
        // Route::middleware('cacheResponse')->resource('portal-comunicacion', 'PortalComunicacionController');
        Route::resource('portal-comunicacion', 'PortalComunicacionController');

        Route::get('plantTrabajoBase/{data}', 'PlanTrabajoBaseController@showTarea');
        Route::post('plantTrabajoBase/listaDataTables', 'PlanTrabajoBaseController@listaDataTables')->name('plantTrabajoBase.listaDataTables');
        Route::post('plantTrabajoBase/bloqueo/mostrar', 'LockedPlanTrabajoController@getLockedToPlanTrabajo')->name('lockedPlan.getLockedToPlanTrabajo');
        Route::post('plantTrabajoBase/bloqueo/quitar', 'LockedPlanTrabajoController@removeLockedToPlanTrabajo')->name('lockedPlan.removeLockedToPlanTrabajo');
        Route::post('plantTrabajoBase/bloqueo/is-locked', 'LockedPlanTrabajoController@isLockedToPlanTrabajo')->name('lockedPlan.isLockedToPlanTrabajo');
        Route::post('plantTrabajoBase/bloqueo/registrar', 'LockedPlanTrabajoController@setLockedToPlanTrabajo')->name('lockedPlan.setLockedToPlanTrabajo');

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

        Route::post('inicioUsuario/actividades/archivar', 'InicioUsuarioController@archivarActividades')->name('inicio-Usuario.actividades.archivar');
        Route::post('inicioUsuario/actividades/cambiar-estatus', 'InicioUsuarioController@cambiarEstatusActividad')->name('inicio-Usuario.actividades.cambiarEstatusActividad');
        Route::post('inicioUsuario/actividades/recuperar', 'InicioUsuarioController@recuperarActividades')->name('inicio-Usuario.actividades.recuperar');
        Route::get('inicioUsuario/actividades/archivo', 'InicioUsuarioController@archivoActividades')->name('inicio-Usuario.acctividades.archivo');

        Route::get('inicioUsuario/perfil-puesto', 'InicioUsuarioController@perfilPuesto')->name('inicio-Usuario.perfil-puesto');

        Route::get('inicioUsuario/expediente/{id_empleado}', 'InicioUsuarioController@expediente')->name('inicio-Usuario.expediente');

        Route::post('inicioUsuario/expediente/update', 'InicioUsuarioController@expedienteUpdate')->name('inicio-Usuario.expediente-update');
        Route::post('inicioUsuario/expediente/{id_empleado}/getListaDocumentos', 'EmpleadoController@getListaDocumentos')->name('inicio-Usuario.expediente-getListaDocumentos');

        Route::post('inicioUsuario/versioniso', 'InicioUsuarioController@updateVersionIso')->name('inicio-Usuario.updateVersionIso');

        Route::get('desk', 'DeskController@index')->name('desk.index');

        Route::post('desk/{seguridad}/analisis_seguridad-update', 'DeskController@updateAnalisisSeguridad')->name('desk.analisis_seguridad-update');
        Route::post('desk/{riesgos}/analisis_riesgo-update', 'DeskController@updateAnalisisReisgos')->name('desk.analisis_riesgo-update');
        Route::post('desk/{mejoras}/analisis_mejora-update', 'DeskController@updateAnalisisMejoras')->name('desk.analisis_mejora-update');
        Route::post('desk/{quejas}/analisis_queja-update', 'DeskController@updateAnalisisQuejas')->name('desk.analisis_queja-update');
        Route::post('desk/{quejas}/analisis_quejaCliente-update', 'DeskController@updateAnalisisQuejasClientes')->name('desk.analisis_quejasClientes-update');
        Route::post('desk/queja-cliente/validate', 'DeskController@validateFormQuejaCliente')->name('desk.quejasClientes.validateFormQuejaCliente');
        Route::post('desk/queja-cliente/correo-responsable', 'DeskController@correoResponsableQuejaCliente')->name('desk.quejas-clientes.correoResponsable');
        Route::post('desk/queja-cliente/correo-solicitar-cierre-queja', 'DeskController@correoSolicitarCierreQuejaCliente')->name('desk.quejas-clientes.correoSolicitarCierreQueja');
        Route::post('desk/queja-cliente/show', 'DeskController@showQuejaClientes')->name('desk.quejas-clientes.show');
        Route::post('desk/{denuncias}/analisis_denuncia-update', 'DeskController@updateAnalisisDenuncias')->name('desk.analisis_denuncia-update');
        Route::post('desk/{sugerencias}/analisis_sugerencia-update', 'DeskController@updateAnalisisSugerencias')->name('desk.analisis_sugerencia-update');

        Route::get('desk/{seguridad}/seguridad-edit', 'DeskController@editSeguridad')->name('desk.seguridad-edit');
        Route::post('desk/{seguridad}/seguridad-update', 'DeskController@updateSeguridad')->name('desk.seguridad-update');
        //flujo de archivado seguridad
        Route::post('desk/{incidente}/archivar', 'DeskController@archivadoSeguridad')->name('desk.seguridad-archivar');
        Route::get('desk/seguridad-archivo', 'DeskController@archivoSeguridad')->name('desk.seguridad-archivo');
        Route::post('desk/seguridad-archivo/recuperar/{id}', 'DeskController@recuperarArchivadoSeguridad')->name('desk.seguridad-archivo.recuperar');
        Route::get('desk/seguridad', 'DeskController@indexSeguridad')->name('desk.seguridad-index');
        //
        Route::get('desk/{riesgos}/riesgos-edit', 'DeskController@editRiesgos')->name('desk.riesgos-edit');
        Route::post('desk/{riesgos}/riesgos-update', 'DeskController@updateRiesgos')->name('desk.riesgos-update');
        //flujo de archivado riesgos
        Route::post('desk/{incidente}/archivarRiesgos', 'DeskController@archivadoRiesgo')->name('desk.riesgo-archivar');
        Route::get('desk/riesgos-archivo', 'DeskController@archivoRiesgo')->name('desk.riesgo-archivo');
        Route::post('desk/riesgos-archivo/recuperar/{id}', 'DeskController@recuperarArchivadoRiesgo')->name('desk.riesgo-archivo.recuperar');
        Route::get('desk/riesgos', 'DeskController@indexRiesgo')->name('desk.riesgo-index');
        //

        Route::get('desk/{quejas}/quejas-edit', 'DeskController@editQuejas')->name('desk.quejas-edit');
        Route::post('desk/{quejas}/quejas-update', 'DeskController@updateQuejas')->name('desk.quejas-update');
        //flujo de archivado quejas
        Route::post('desk/{incidente}/archivarQuejas', 'DeskController@archivadoQueja')->name('desk.queja-archivar');
        Route::get('desk/quejas-archivo', 'DeskController@archivoQueja')->name('desk.queja-archivo');
        Route::post('desk/quejas-archivo/recuperar/{id}', 'DeskController@recuperarArchivadoQueja')->name('desk.queja-archivo.recuperar');
        Route::get('desk/quejas', 'DeskController@indexQueja')->name('desk.queja-index');
        //

        //Archivo QuejaCliente
        Route::post('desk/{incidente}/archivarQuejasClientes', 'DeskController@archivadoQuejaClientes')->name('desk.quejasclientes-archivar');
        Route::get('desk/quejas-archivo', 'DeskController@archivoQuejaClientes')->name('desk.quejacliente-archivo');
        Route::post('desk/quejas-clientes-archivo/recuperar/{id}', 'DeskController@recuperarArchivadoQuejaCliente')->name('desk.quejaClientes-archivo.recuperar');

        //flujo de archivado Sugerencias
        Route::post('desk/{incidente}/archivarSugerencia', 'DeskController@archivadoSugerencia')->name('desk.sugerencia-archivar');
        Route::get('desk/sugerencia-archivo', 'DeskController@archivoSugerencia')->name('desk.sugerencia-archivo');
        Route::post('desk/sugerencia-archivo/recuperar/{id}', 'DeskController@recuperarArchivadoSugerencia')->name('desk.sugerencia-archivo.recuperar');
        Route::get('desk/sugerencias', 'DeskController@indexSugerencia')->name('desk.sugerencia-index');

        Route::get('desk/{denuncias}/denuncias-edit', 'DeskController@editDenuncias')->name('desk.denuncias-edit');
        Route::post('desk/{denuncias}/denuncias-update', 'DeskController@updateDenuncias')->name('desk.denuncias-update');

        //flujo de archivado denuncias
        Route::get('desk/denuncias', 'DeskController@indexDenuncia')->name('desk.denuncia-index');
        Route::post('desk/{incidente}/archivarDenuncias', 'DeskController@archivadoDenuncia')->name('desk.denuncia-archivar');
        Route::get('desk/denuncias-archivo', 'DeskController@archivoDenuncia')->name('desk.denuncia-archivo');
        Route::post('desk/denuncias-archivo/recuperar/{id}', 'DeskController@recuperarArchivadoDenuncia')->name('desk.denuncia-archivo.recuperar');
        //

        Route::get('desk/{mejoras}/mejoras-edit', 'DeskController@editMejoras')->name('desk.mejoras-edit');
        Route::post('desk/{mejoras}/mejoras-update', 'DeskController@updateMejoras')->name('desk.mejoras-update');

        //flujo de archivado mejoras

        Route::get('desk/mejoras', 'DeskController@indexMejora')->name('desk.mejora-index');
        Route::post('desk/{incidente}/archivarMejoras', 'DeskController@archivadoMejora')->name('desk.mejora-archivar');
        Route::get('desk/mejoras-archivo', 'DeskController@archivoMejora')->name('desk.mejora-archivo');
        Route::post('desk/mejoras-archivo/recuperar/{id}', 'DeskController@recuperarArchivadoMejora')->name('desk.mejora-archivo.recuperar');

        //
        Route::get('desk/{sugerencias}/sugerencias-edit', 'DeskController@editSugerencias')->name('desk.sugerencias-edit');
        Route::post('desk/{sugerencias}/sugerencias-update', 'DeskController@updateSugerencias')->name('desk.sugerencias-update');

        //Quejas clientes
        Route::get('desk/quejas-clientes', 'DeskController@quejasClientes')->name('desk.quejas-clientes');
        Route::get('desk/quejas-clientes/index', 'DeskController@indexQuejasClientes')->name('desk.quejasClientes-index');
        Route::post('desk/reportes/quejas-clientes', 'DeskController@storeQuejasClientes')->name('desk.quejasClientes-store');
        Route::get('desk/{quejas}/quejas-clientes-edit', 'DeskController@editQuejasClientes')->name('desk.quejasClientes-edit');
        Route::delete('desk/{quejas}/quejas-clientes-delete', 'DeskController@destroyQuejasClientes')->name('desk.quejasClientes-destroy');
        Route::post('desk/{quejas}/quejas-clientes-update', 'DeskController@updateQuejasClientes')->name('desk.quejasClientes-update');
        Route::post('desk/planes/quejas-clientes', 'DeskController@planesQuejasClientes')->name('desk.planesQuejasClientes');

        //Dashboard Queja Cliente

        Route::get('desk/quejas-clientes/dashboard', 'DeskController@quejasClientesDashboard')->name('desk.quejasClientes-dashboard');

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
        Route::get('obtener-clausula-id/{incumplimiento}', [DashboardAuditoriasSGIController::class, 'obtenerClausulaId'])->name('obtener-clausula-id');
        Route::get('/dashboard-auditorias-sgi', 'DashboardAuditoriasSGIController@index')->name('dashboard_auditorias');
        // Permissions
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');

        //Template Analisis de Brechas
        Route::get('templates/create', 'TemplateController@create')->name('templates.create');
        Route::get('templates/{id}/edit', 'TemplateController@edit')->name('templates.edit');
        // Route::post('templates/store', 'TemplateController@store')->name('templates.store');

        //Analisis brechas
        Route::group(['middleware' => ['version_iso_2013']], function () {
            //Route::resource('analisis-brechas', 'AnalisisBController');
            Route::get('analisis-brechas', 'AnalisisBController@index')->name('analisis-brechas.index');
            Route::get('analisis-brechas/{id}', 'AnalisisBController@index')->name('analisis-brechas');
            Route::post('analisis-brechas/update', 'AnalisisBController@update');
            Route::delete('analisisdebrechas/destroy', 'AnalisisBrechaController@massDestroy')->name('analisisdebrechas.massDestroy');
            Route::resource('analisisdebrechas', 'AnalisisBrechaController');
            Route::get('getEmployeeData', 'AnalisisBrechaController@getEmployeeData')->name('getEmployeeData');
        });

        Route::get('templates', 'TemplateController@index')->name('templates');
        Route::get('evaluacion-analisis-brechas-2022/{id}', 'FormularioAnalisisBrechasController@index')->name('formulario');

        Route::group(['middleware' => ['version_iso_2022']], function () {
            //Analisis brechas 2022
            //Template Analisis de Brechas
            Route::post('templates/store', 'TemplateController@store')->name('templates.store');
            Route::get('/top', 'TopController@index')->name('top');
            Route::resource('analisisdebrechas-2022', 'AnalisisBrechaIsoController');
            Route::delete('analisisdebrechas-2022/destroy', 'AnalisisBrechaIsoController@massDestroy')->name('analisisdebrechas-2022.massDestroy');
            Route::get('getEmployeeData', 'AnalisisBrechaIsoController@getEmployeeData')->name('getEmployeeData');
            Route::get('analisis-brechas-2022', 'AnalisisBIsoController@index')->name('analisis-brechas-2022.index');
            Route::get('analisis-brechas-2022/{id}', 'AnalisisBIsoController@index')->name('analisis-brechas-2022');
            Route::post('analisis-brechas-2022/update', 'AnalisisBController@update');

            // Gap Unos 2022
            Route::delete('gap-uno-2022/destroy', 'iso27\GapUnoConcentradoIsoController@massDestroy')->name('gap-unos-2022.massDestroy');
            Route::resource('gap-uno-2022', 'iso27\GapUnoConcentradoIsoController');

            // Gap Dos 2022
            //Route::delete('gap-dos-2022/destroy', 'iso27\GapDosConcentradoIsoController@massDestroy')->name('gap-dos.massDestroy');
            Route::resource('gap-dos-2022', 'iso27\GapDosConcentradoIsoController');

            // Gap Tres 2022
            //Route::delete('gap-tres-2022/destroy', 'iso27\GapTresConcentradoIsoController@massDestroy')->name('gap-tres.massDestroy');
            Route::resource('gap-tres-2022', 'iso27\GapTresConcentradoIsoController');
            // });
        });

        Route::group(['middleware' => ['version_iso_2013']], function () {
            // Declaracion de Aplicabilidad
            Route::get('declaracion-aplicabilidad/descargar', 'DeclaracionAplicabilidadController@download')->name('declaracion-aplicabilidad.descargar');
            Route::get('declaracion-aplicabilidad/tabla', 'DeclaracionAplicabilidadController@tabla')->name('declaracion-aplicabilidad.tabla');
            Route::put('declaracion-aplicabilidad/tabla/{control}', 'DeclaracionAplicabilidadController@updateTabla')->name('declaracion-aplicabilidad.updateTabla');
            Route::get('declaracion-aplicabilidad/{id}', 'DeclaracionAplicabilidadController@index')->name('declaracion-aplicabilidad');
            Route::delete('declaracion-aplicabilidad/destroy', 'DeclaracionAplicabilidadController@massDestroy')->name('declaracion-aplicabilidad.massDestroy');
            Route::resource('declaracion-aplicabilidad', 'DeclaracionAplicabilidadController');
            Route::post('declaracion-aplicabilidad/enviar-correo', 'DeclaracionAplicabilidadController@enviarCorreo')->name('declaracion-aplicabilidad.enviarcorreo');
            Route::get('getEmployeeData', 'DeclaracionAplicabilidadController@getEmployeeData')->name('getEmployeeData');
        });

        Route::group(['middleware' => ['version_iso_2022']], function () {

            // Declaracion de Aplicabilidad 2022
            Route::get('declaracion-aplicabilidad-2022/descargar', 'iso27\DeclaracionAplicabilidadConcentradoIsoController@download')->name('declaracion-aplicabilidad-2022.descargar');
            Route::get('declaracion-aplicabilidad-2022/dashboard', 'iso27\DeclaracionAplicabilidadConcentradoIsoController@dashboard')->name('declaracion-aplicabilidad-2022.dashboard');
            Route::get('declaracion-aplicabilidad-2022/tabla', 'iso27\DeclaracionAplicabilidadConcentradoIsoController@tabla')->name('declaracion-aplicabilidad-2022.tabla');
            Route::put('declaracion-aplicabilidad-2022/tabla/{control}', 'iso27\DeclaracionAplicabilidadConcentradoIsoController@updateTabla')->name('declaracion-aplicabilidad-2022.updateTabla');
            Route::get('declaracion-aplicabilidad-2022/{id}', 'iso27\DeclaracionAplicabilidadConcentradoIsoController@index')->name('declaracion-aplicabilidad-2022');
            Route::delete('declaracion-aplicabilidad-2022/destroy', 'iso27\DeclaracionAplicabilidadConcentradoIsoController@massDestroy')->name('declaracion-aplicabilidad-2022.massDestroy');
            Route::resource('declaracion-aplicabilidad-2022', 'iso27\DeclaracionAplicabilidadConcentradoIsoController');
            Route::post('declaracion-aplicabilidad-2022/enviar-correo', 'iso27\DeclaracionAplicabilidadConcentradoIsoController@enviarCorreo')->name('declaracion-aplicabilidad-2022.enviarcorreo');
            Route::get('getEmployeeData', 'iso27\DeclaracionAplicabilidadConcentradoIsoController@getEmployeeData')->name('getEmployeeData');

            //Panel declaracione-2022
            Route::post('paneldeclaracion-2022/controles', 'PanelDeclaracionIsoController@controles')->name('paneldeclaracion-2022.controles');
            Route::post('paneldeclaracion-2022/responsables-quitar', 'PanelDeclaracionIsoController@quitarRelacionResponsable')->name('paneldeclaracion-2022.responsables.quitar');
            Route::post('paneldeclaracion-2022/responsables', 'PanelDeclaracionIsoController@relacionarResponsable')->name('paneldeclaracion-2022.responsables');
            Route::post('paneldeclaracion-2022/enviar-correo', 'PanelDeclaracionIsoController@enviarCorreo')->name('paneldeclaracion-2022.enviarcorreo');
            Route::post('paneldeclaracion-2022/aprobadores-quitar', 'PanelDeclaracionIsoController@quitarRelacionAprobador')->name('paneldeclaracion-2022.aprobadores.quitar');
            Route::post('paneldeclaracion-2022/aprobadores', 'PanelDeclaracionIsoController@relacionarAprobador')->name('paneldeclaracion-2022.aprobadores');
            Route::delete('paneldeclaracion-2022/destroy', 'PanelDeclaracionIsoController@massDestroy')->name('paneldeclaracion-2022.massDestroy');
            Route::resource('paneldeclaracion-2022', 'PanelDeclaracionIsoController');

            Route::post('paneldeclaracion/controles', 'PanelDeclaracionController@controles')->name('paneldeclaracion.controles');
            Route::post('paneldeclaracion/responsables-quitar', 'PanelDeclaracionController@quitarRelacionResponsable')->name('paneldeclaracion.responsables.quitar');
            Route::post('paneldeclaracion/responsables', 'PanelDeclaracionController@relacionarResponsable')->name('paneldeclaracion.responsables');
            Route::post('paneldeclaracion/enviar-correo', 'PanelDeclaracionController@enviarCorreo')->name('paneldeclaracion.enviarcorreo');
            Route::post('paneldeclaracion/aprobadores-quitar', 'PanelDeclaracionController@quitarRelacionAprobador')->name('paneldeclaracion.aprobadores.quitar');
            Route::post('paneldeclaracion/aprobadores', 'PanelDeclaracionController@relacionarAprobador')->name('paneldeclaracion.aprobadores');
            Route::delete('paneldeclaracion/destroy', 'PanelDeclaracionController@massDestroy')->name('paneldeclaracion.massDestroy');
            Route::resource('paneldeclaracion', 'PanelDeclaracionController');

            //Analisis brechas 2022
            // Route::get('/top', 'TopController@index')->name('top');
            Route::get('template/{id}/formulario', 'FormularioAnalisisBrechasController@index')->name('formulario');
            Route::resource('analisisdebrechas-2022', 'AnalisisBrechaIsoController');
            Route::get('analisis-brechas-2022-inicio', 'AnalisisBrechaIsoController@inicioBrechas')->name('analisis-brechas-inicio');
            Route::delete('analisisdebrechas-2022/destroy', 'AnalisisBrechaIsoController@massDestroy')->name('analisisdebrechas-2022.massDestroy');
            Route::get('getEmployeeData', 'AnalisisBrechaIsoController@getEmployeeData')->name('getEmployeeData');
            Route::get('analisis-brechas-2022', 'AnalisisBIsoController@index')->name('analisis-brechas-2022.index');
            Route::get('analisis-brechas-2022/{id}', 'AnalisisBIsoController@index')->name('analisis-brechas-2022');
            Route::post('analisis-brechas-2022/update', 'AnalisisBController@update');

            // Route::group(['middleware' => ['version_iso_2022']], function () {
            //Analisis brechas 2022
            //Template Analisis de Brechas
            Route::post('templates/store', 'TemplateController@store')->name('templates.store');
            Route::get('/template-brechas-2022-top', 'TopController@index')->name('template-top');
            Route::resource('analisisdebrechas-2022', 'AnalisisBrechaIsoController');
            Route::delete('analisisdebrechas-2022/destroy', 'AnalisisBrechaIsoController@massDestroy')->name('analisisdebrechas-2022.massDestroy');
            Route::get('getEmployeeData', 'AnalisisBrechaIsoController@getEmployeeData')->name('getEmployeeData');
            Route::get('analisis-brechas-2022', 'AnalisisBIsoController@index')->name('analisis-brechas-2022.index');
            Route::get('analisis-brechas-2022/{id}', 'AnalisisBIsoController@index')->name('analisis-brechas-2022');
            Route::post('analisis-brechas-2022/update', 'AnalisisBController@update');

            // Gap Unos 2022
            Route::delete('gap-uno-2022/destroy', 'iso27\GapUnoConcentradoIsoController@massDestroy')->name('gap-unos-2022.massDestroy');
            Route::resource('gap-uno-2022', 'iso27\GapUnoConcentradoIsoController');

            // Gap Dos 2022
            //Route::delete('gap-dos-2022/destroy', 'iso27\GapDosConcentradoIsoController@massDestroy')->name('gap-dos.massDestroy');
            Route::resource('gap-dos-2022', 'iso27\GapDosConcentradoIsoController');

            // Gap Tres 2022
            //Route::delete('gap-tres-2022/destroy', 'iso27\GapTresConcentradoIsoController@massDestroy')->name('gap-tres.massDestroy');
            Route::resource('gap-tres-2022', 'iso27\GapTresConcentradoIsoController');
            // });
        });

        //gantt
        Route::get('gantt', 'GanttController@index');
        Route::post('gantt/update', 'GanttController@update');

        // Roles
        Route::get('permisos/lista', 'PermissionsController@index')->name('permisos.index');
        Route::get('permisos/actualizar', 'PermissionsController@actualizarLista')->name('permisos.actualizar');
        Route::post('roles/{role}/copiar', 'RolesController@copiarRol')->name('roles.copy');
        Route::get('roles/{role}/permisos', 'RolesController@getPermissions')->name('roles.getPermissions');
        Route::patch('roles/{role}/edit', 'RolesController@update')->name('roles.patch');
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');

        //procesos

        Route::get('mapa-procesos', 'ProcesoController@mapaProcesos')->name('procesos.mapa');
        Route::get('procesos/{documento?}/vista', 'ProcesoController@obtenerDocumentoProcesos')->name('procesos.obtenerDocumentoProcesos');
        Route::resource('procesos', 'ProcesoController');
        Route::post('selectIndicador', 'ProcesoController@AjaxRequestIndicador')->name('selectIndicador');
        Route::post('selectRiesgos', 'ProcesoController@AjaxRequestRiesgos')->name('selectRiesgos');

        //macroprocesos
        Route::resource('macroprocesos', 'MacroprocesoController');

        // Timesheet
        Route::get('timesheet', 'TimesheetController@index')->name('timesheet');
        Route::get('timesheet/show/{id}', 'TimesheetController@show')->name('timesheet-show');
        Route::get('timesheet/create-copia/{id}', 'TimesheetController@createCopia')->name('timesheet-create-copia');
        Route::get('timesheet/edit/{id}', 'TimesheetController@edit')->name('timesheet-edit');
        Route::get('timesheet/papelera', 'TimesheetController@papelera')->name('timesheet-papelera');
        Route::get('timesheet/reporte-aprobador/{id}', 'TimesheetController@reporteAprobador')->name('timesheet-reporte-aprobador');
        Route::get('timesheet/eliminar/{id}', 'TimesheetController@eliminar')->name('timesheet-eliminar');
        Route::get('timesheet/aprobaciones', 'TimesheetController@aprobaciones')->name('timesheet-aprobaciones');
        Route::get('timesheet/aprobados', 'TimesheetController@aprobados')->name('timesheet-aprobados');
        Route::get('timesheet/rechazos', 'TimesheetController@rechazos')->name('timesheet-rechazos');
        Route::post('timesheet/aprobar/{id}', 'TimesheetController@aprobar')->name('timesheet-aprobar');
        Route::post('timesheet/rechazar/{id}', 'TimesheetController@rechazar')->name('timesheet-rechazar');
        Route::get('timesheet/inicio', 'TimesheetController@timesheetInicio')->name('timesheet-inicio');
        Route::post('timesheet/actualizarDia', 'TimesheetController@actualizarDia')->name('timesheet-actualizarDia');
        Route::get('timesheet/create', 'TimesheetController@create')->name('timesheet-create');

        Route::get('timesheet/proyectos', 'TimesheetController@proyectos')->name('timesheet-proyectos');
        Route::get('timesheet/proyectos/create', 'TimesheetController@createProyectos')->name('timesheet-proyectos-create');
        Route::post('timesheet/proyectos/store', 'TimesheetController@storeProyectos')->name('timesheet-proyectos-store');
        Route::get('timesheet/proyectos/edit/{id}', 'TimesheetController@editProyectos')->name('timesheet-proyectos-edit');
        Route::post('timesheet/proyectos/update/{id}', 'TimesheetController@updateProyectos')->name('timesheet-proyectos-update');
        // Route::get('timesheet/proyectos/notificacion-horas', 'TimesheetController@notificacionhorassobrepasadas')->name('timesheet-notificacion-horas');
        Route::get('timesheet/proyectos/show/{id}', 'TimesheetController@showProyectos')->name('timesheet-proyectos-show');
        Route::get('timesheet/tareas', 'TimesheetController@tareas')->name('timesheet-tareas');
        Route::get('timesheet/tareas-proyecto/{proyecto_id}', 'TimesheetController@tareasProyecto')->name('timesheet-tareas-proyecto');
        Route::get('timesheet/proyectos/reporte/registros', 'TimesheetController@reportesRegistros')->name('timesheet-reportes-registros');
        Route::get('timesheet/proyectos/reporte/proyemp', 'TimesheetController@reportesProyemp')->name('timesheet-reportes-proyemp');
        Route::get('timesheet/proyectos/reporte/empleados', 'TimesheetController@reportesEmpleados')->name('timesheet-reportes-empleados');
        Route::get('timesheet/proyectos/reporte/proyectos', 'TimesheetController@reportesProyectos')->name('timesheet-reportes-proyectos');

        Route::get('timesheet/proyecto-empleados/{proyecto_id}', 'TimesheetController@proyectosEmpleados')->name('timesheet-proyecto-empleados');
        Route::get('timesheet/proyecto-externos/{proyecto_id}', 'TimesheetController@proyectosExternos')->name('timesheet-proyecto-externos');

        Route::get('timesheet/clientes', 'TimesheetController@clientes')->name('timesheet-clientes');
        Route::get('timesheet/clientes/create', 'TimesheetController@clientesCreate')->name('timesheet-clientes-create');
        Route::get('timesheet/clientes/edit/{id}', 'TimesheetController@clientesEdit')->name('timesheet-clientes-edit');
        Route::post('timesheet/clientes/store', 'TimesheetController@clientesStore')->name('timesheet-clientes-store');
        Route::post('timesheet/clientes/update/{id}', 'TimesheetController@clientesUpdate')->name('timesheet-clientes-update');
        Route::post('timesheet/clientes/delete/{id}', 'TimesheetController@clientesDelete')->name('timesheet-cliente-delete');

        Route::get('timesheet/reportes', 'TimesheetController@reportes')->name('timesheet-reportes');
        Route::get('timesheet/dashboard', 'TimesheetController@dashboard')->name('timesheet-dashboard');

        Route::post('timesheet/create/obtenerTareas', 'TimesheetController@obtenerTareas')->name('timesheet-obtener-tareas');

        Route::resource('timesheet', 'TimesheetController')->except(['create', 'index', 'edit']);

        //Competencia Tipo

        Route::get('Tipo/edit/{tipo}', 'RH\TipoCompetenciaController@edit')->name('tipo.edit');
        Route::resource('Tipo', 'RH\TipoCompetenciaController', ['except' => ['edit']]);

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
        Route::get('planes-de-accion/create-plan-trabajo-base', 'PlanesAccionController@createPlanTrabajoBase')->name('planes-de-accion.createPlanTrabajoBase');
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
        Route::post('entendimiento-organizacions/copiar', 'EntendimientoOrganizacionController@duplicarFoda')->name('entendimiento-organizacions.duplicarFoda');
        Route::resource('entendimiento-organizacions', 'EntendimientoOrganizacionController');
        Route::post('entendimiento-organizacions/parse-csv-import', 'EntendimientoOrganizacionController@parseCsvImport')->name('entendimiento-organizacions.parseCsvImport');
        Route::post('areas/process-csv-import', 'AreasController@processCsvImport')->name('areas.processCsvImport');
        Route::get('entendimiento-organizacions-foda-organizacions', 'EntendimientoOrganizacionController@cardFoda')->name('foda-organizacions');
        route::get('entendimiento-organizacions-foda-edit/{id}', 'EntendimientoOrganizacionController@foda')->name('foda-organizacions.edit');
        Route::get('entendimiento-organizacions-foda-general', 'EntendimientoOrganizacionController@cardFodaGeneral')->name('foda-general');
        Route::get('entendimiento-organizacions-foda-admin/{id}', 'EntendimientoOrganizacionController@adminShow');

        Route::post('entendimiento-organizacions/{minuta}/solicitud-aprobacion', 'EntendimientoOrganizacionController@solicitudAprobacion')->name('foda-organizacions.solicitudAprobacion');
        Route::get('partes-interesadas/{id}/edit', 'PartesInteresadasController@edit')->name('partes-interesadas.edit');
        Route::post('partes-interesadas/{id}/update', 'PartesInteresadasController@update')->name('partes-interesadas.update');
        Route::resource('partes-interesadas', 'PartesInteresadasController')->except(['edit', 'update']);

        //Configuración Soporte
        Route::delete('configurar-soporte/destroy', 'ConfigurarSoporteController@massDestroy')->name('configurar-soporte.massDestroy');
        Route::resource('configurar-soporte', 'ConfigurarSoporteController');
        Route::get('getgetEmployeeData', 'ConfigurarSoporteController@getgetEmployeeData')->name('getgetEmployeeData');
        Route::get('soporte', 'ConfigurarSoporteController@visualizarSoporte')->name('soporte');

        //Configuración Consultores
        // Route::delete('configurar-consultor/destroy', 'ConfigurarConsultorController@massDestroy')->name('configurar-consultor.massDestroy');
        // Route::resource('configurar-consultor', 'ConfigurarConsultorController');

        // Matriz Requisito Legales
        Route::get('matriz-requisito-legales/{id}/evaluar', 'MatrizRequisitoLegalesController@evaluar')->name('matriz-requisito-legales.evaluar');
        Route::post('matriz-requisito-legales/{id}/store', 'MatrizRequisitoLegalesController@evaluarStore')->name('matriz-requisito-legales.evaluarStore');
        Route::get('matriz-requisito-legales/planes-de-accion/create/{id}', 'MatrizRequisitoLegalesController@createPlanAccion')->name('matriz-requisito-legales.createPlanAccion');
        Route::post('matriz-requisito-legales/planes-de-accion/store/{id}', 'MatrizRequisitoLegalesController@storePlanAccion')->name('matriz-requisito-legales.storePlanAccion');
        Route::delete('matriz-requisito-legales/destroy', 'MatrizRequisitoLegalesController@massDestroy')->name('matriz-requisito-legales.massDestroy');
        Route::resource('matriz-requisito-legales', 'MatrizRequisitoLegalesController');

        // Alcance Sgsis
        Route::get('alcance-sgsis/visualizacion', 'AlcanceSgsiController@visualizacion')->name('alcance-sgsis/visualizacion');
        Route::delete('alcance-sgsis/destroy', 'AlcanceSgsiController@massDestroy')->name('alcance-sgsis.massDestroy');
        Route::resource('alcance-sgsis', 'AlcanceSgsiController');
        Route::get('alcance-sgsis/{id}/aprove', 'AlcanceSgsiController@aprove')->name('admin.alcanceSgsis.aprove');
        Route::post('alcance-sgsis/pdf', 'AlcanceSgsiController@pdf')->name('alcance-sgsis.pdf');

        // Comiteseguridads
        Route::delete('comiteseguridads/destroy', 'ComiteseguridadController@massDestroy')->name('comiteseguridads.massDestroy');
        Route::get('comiteseguridads/visualizacion', 'ComiteseguridadController@visualizacion')->name('comiteseguridads.visualizacion');
        Route::get('comiteseguridads/{comiteseguridad}/edit', 'ComiteseguridadController@edit')->name('comiteseguridads.edit');
        Route::post('comiteseguridads/saveMember/{id_comite}', 'ComiteseguridadController@saveMember')->name('comiteseguridads.saveMember');
        Route::get('comiteseguridads/deleteMember/{id}', 'ComiteseguridadController@deleteMember')->name('comiteseguridads.deleteMember');
        Route::resource('comiteseguridads', 'ComiteseguridadController')->except('edit');

        // Minutasaltadireccions
        Route::get('minutasaltadireccions/descargar/{name}', 'MinutasaltadireccionController@DescargaFormato')->name('minutasaltadireccions.descargar');
        Route::get('minutasaltadireccions/{minuta}/minuta-documento', 'MinutasaltadireccionController@renderViewDocument')->name('documentos.renderViewMinuta');
        Route::get('minutasaltadireccions/{minuta}/historial-revisiones', 'MinutasaltadireccionController@renderHistoryReview')->name('documentos.renderHistoryReviewMinuta');
        Route::get('minutasaltadireccions/planes-de-accion/create/{id}', 'MinutasaltadireccionController@createPlanAccion')->name('minutasaltadireccions.createPlanAccion');
        Route::get('minutasaltadireccions/{id}/edit', 'MinutasaltadireccionController@edit')->name('minutasaltadireccions.edit');
        Route::patch('minutasaltadireccions/{minuta}/update-and-review', 'MinutasaltadireccionController@updateAndReview')->name('minutasaltadireccions.updateAndReview');
        Route::post('minutasaltadireccions/planes-de-accion/store/{id}', 'MinutasaltadireccionController@storePlanAccion')->name('minutasaltadireccions.storePlanAccion');
        Route::delete('minutasaltadireccions/destroy', 'MinutasaltadireccionController@massDestroy')->name('minutasaltadireccions.massDestroy');
        Route::post('minutasaltadireccions/media', 'MinutasaltadireccionController@storeMedia')->name('minutasaltadireccions.storeMedia');
        Route::post('minutasaltadireccions/ckmedia', 'MinutasaltadireccionController@storeCKEditorImages')->name('minutasaltadireccions.storeCKEditorImages');
        Route::get('minutasaltadireccions/{id}/show', 'MinutasaltadireccionController@show')->name('minutasaltadireccions.show');
        Route::post('minutasaltadireccions/{minuta}/aprobado', 'MinutasaltadireccionController@aprobado')->name('minutasaltadireccions.aprobado');
        Route::post('minutasaltadireccions/{minuta}/rechazado', 'MinutasaltadireccionController@rechazado')->name('minutasaltadireccions.rechazado');
        Route::resource('minutasaltadireccions', 'MinutasaltadireccionController');
        Route::post('minutasaltadireccions/pdf/{id}', 'MinutasaltadireccionController@pdf')->name('minutasaltadireccions.pdf');


        // Evidencias Sgsis
        Route::delete('evidencias-sgsis/destroy', 'EvidenciasSgsiController@massDestroy')->name('evidencias-sgsis.massDestroy');
        Route::post('evidencias-sgsis/media', 'EvidenciasSgsiController@storeMedia')->name('evidencias-sgsis.storeMedia');
        Route::post('evidencias-sgsis/ckmedia', 'EvidenciasSgsiController@storeCKEditorImages')->name('evidencias-sgsis.storeCKEditorImages');
        Route::resource('evidencias-sgsis', 'EvidenciasSgsiController');

        // Politica Sgsis
        Route::delete('politica-sgsis/destroy', 'PoliticaSgsiController@massDestroy')->name('politica-sgsis.massDestroy');

        Route::get('politica-sgsis/visualizacion', 'PoliticaSgsiController@visualizacion')->name('politica-sgsis/visualizacion');

        Route::post('politica-sgsis/pdf', 'PoliticaSgsiController@pdf')->name('politica-sgsis.pdf');
        Route::resource('politica-sgsis', 'PoliticaSgsiController');

        // Riesgosoportunidades
        Route::delete('riesgosoportunidades/destroy', 'RiesgosoportunidadesController@massDestroy')->name('riesgosoportunidades.massDestroy');
        Route::resource('riesgosoportunidades', 'RiesgosoportunidadesController');

        // Objetivosseguridads
        Route::delete('objetivosseguridads/destroy', 'ObjetivosseguridadController@massDestroy')->name('objetivosseguridads.massDestroy');
        Route::resource('objetivosseguridads', 'ObjetivosseguridadController');
        Route::get('objetivosseguridadsInsertar', 'ObjetivosseguridadController@ObjetivoInsert')->name('objetivos-seguridadsInsertar');
        Route::get('objetivos/dashboard', 'ObjetivosseguridadController@objetivosDashboard')->name('objetivos-seguridad-dashboard');
        Route::get('evaluaciones-objetivosInsertar', 'ObjetivosseguridadController@evaluacionesInsert')->name('evaluacionesobjetivosInsert');
        Route::get('evaluaciones-objetivosShow', 'ObjetivosseguridadController@evaluacionesShow')->name('evaluacionesobjetivosShow');

        Route::resource('categoria-capacitacion', 'CategoriaCapacitacionController');

        Route::post('tipos-objetivos/datatables', 'TiposObjetivosSistemaController@getDataForDataTable')->name('tipos-objetivos.getDataForDataTable');
        Route::resource('tipos-objetivos', 'TiposObjetivosSistemaController');
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
        Route::post('planificacion-controls/firma', 'PlanificacionControlController@guardarFirmaAprobacion')->name('planificacion-controls.firma-aprobacion');
        Route::delete('planificacion-controls/destroy', 'PlanificacionControlController@massDestroy')->name('planificacion-controls.massDestroy');
        Route::resource('planificacion-controls', 'PlanificacionControlController');

        // Activos

        // Route::post('activos/create', 'ActivosController@create');
        Route::get('activos/descargar', 'ActivosController@DescargaFormato')->name('activos.descargar');
        Route::delete('activos/destroy', 'ActivosController@massDestroy')->name('activos.massDestroy');
        Route::resource('activos', 'ActivosController');

        Route::post('activosInformacion/validacion', 'ActivosInformacionController@validacion')->name('activosInformacion.validacion');
        Route::get('activosInformacion/descargar', 'ActivosInformacionController@DescargaFormato')->name('activosInformacion.descargar');
        Route::delete('activosInformacion/destroy', 'ActivosInformacionController@massDestroy')->name('activosInformacion.massDestroy');
        Route::get('activosInformacion/create/{matriz}', 'ActivosInformacionController@create')->name('activosInformacion.create');
        Route::get('activosInformacion/{matriz}', 'ActivosInformacionController@index')->name('activosInformacion.index');
        Route::get('activosInformacion/{matriz}/{activo}/edit', 'ActivosInformacionController@edit')->name('activosInformacion.edit');
        Route::resource('activosInformacion', 'ActivosInformacionController')->names([
            'store' => 'activosInformacion.store',
            'show' => 'activosInformacion.show',
            'update' => 'activosInformacion.update',
        ])->except(['edit', 'create', 'index']);

        // Marca
        Route::get('marcas/get-marcas', 'MarcaController@getMarcas')->name('marcas.getMarcas');
        Route::resource('marcas', 'MarcaController');

        // Modelo
        Route::get('modelos/get-modelos/{id?}', 'ModeloController@getModelos')->name('modelos.getModelos');
        Route::resource('modelos', 'ModeloController');

        // Tratamiento Riesgos
        Route::post('tratamiento-riesgos/firma', 'TratamientoRiesgosController@guardarFirmaAprobacion')->name('tratamiento-riesgos.firma-aprobacion');
        Route::delete('tratamiento-riesgos/destroy', 'TratamientoRiesgosController@massDestroy')->name('tratamiento-riesgos.massDestroy');
        Route::resource('tratamiento-riesgos', 'TratamientoRiesgosController');

        // Auditoria Internas
        Route::delete('auditoria-internas/destroy', 'AuditoriaInternaController@massDestroy')->name('auditoria-internas.massDestroy');
        Route::post('auditoria-internas/media', 'AuditoriaInternaController@storeMedia')->name('auditoria-internas.storeMedia');
        Route::post('auditoria-internas/ckmedia', 'AuditoriaInternaController@storeCKEditorImages')->name('auditoria-internas.storeCKEditorImages');
        Route::get('auditoria-internas/{auditoriaInterna}/edit', 'AuditoriaInternaController@edit')->name('auditoria-internas.edit');
        Route::resource('auditoria-internas', 'AuditoriaInternaController')->except('edit');
        Route::get('auditoria-internas/{auditoriaInterna}/reporteIndividual', 'AuditoriaInternaController@indexReporteIndividual')->name('auditoria-internas.reporteIndividual');
        Route::get('auditoria-internas/{auditoriaInterna}/createReporteIndividual', 'AuditoriaInternaController@createReporte')->name('auditoria-internas.createReporteIndividual');
        Route::post('auditoria-internas/{reporteid}/storeReporteIndividual', 'AuditoriaInternaController@storeReporte')->name('auditoria-internas.storeReporteIndividual');
        Route::post('auditoria-internas/reporte-rechazado/{reporteid}', 'AuditoriaInternaController@rechazoReporteIndividual')->name('auditoria-internas.rechazoReporteIndividual');
        Route::post('auditoria-internas/{reporteid}/storeFirmaReporteLider', 'AuditoriaInternaController@storeFirmaReporteLider')->name('auditoria-internas.storeFirmaReporteLider');
        Route::post('auditoria-internas/{id}/pdf', 'AuditoriaInternaController@pdf')->name('auditoria-internas.pdf');

        Route::get('auditoria-reportes/cards', 'AuditoriaReporteCards@index')->name('AuditoriaReporteCards.index');

        //Clasificacion Auditorias
        Route::get('auditorias/clasificacion-auditorias', 'ClasificacionesAuditoriasController@index')->name('auditoria-clasificacion');
        Route::get('auditorias/clasificacion-auditorias/create', 'ClasificacionesAuditoriasController@create')->name('auditoria-clasificacion.create');
        Route::post('auditorias/clasificacion-auditorias/store', 'ClasificacionesAuditoriasController@store')->name('auditoria-clasificacion.store');
        Route::get('auditorias/clasificacion-auditorias/edit/{id}', 'ClasificacionesAuditoriasController@edit')->name('auditoria-clasificacion.edit');
        Route::post('auditorias/clasificacion-auditorias/update/{id}', 'ClasificacionesAuditoriasController@update')->name('auditoria-clasificacion.update');
        Route::get('auditorias/clasificacion-auditorias/delete/{id}', 'ClasificacionesAuditoriasController@destroy')->name('auditoria-clasificacion.destroy');
        Route::get('auditorias/clasificacion-auditorias/datatable', 'ClasificacionesAuditoriasController@datatable')->name('auditoria-clasificacion.datatable');

        //Clausulas Auditorias
        Route::get('auditorias/clausulas-auditorias', 'ClausulasAuditoriasController@index')->name('auditoria-clausula');
        Route::get('auditorias/clausulas-auditorias/create', 'ClausulasAuditoriasController@create')->name('auditoria-clausula.create');
        Route::post('auditorias/clausulas-auditorias/store', 'ClausulasAuditoriasController@store')->name('auditoria-clausula.store');
        Route::get('auditorias/clausulas-auditorias/edit/{id}', 'ClausulasAuditoriasController@edit')->name('auditoria-clausula.edit');
        Route::post('auditorias/clausulas-auditorias/update/{id}', 'ClausulasAuditoriasController@update')->name('auditoria-clausula.update');
        Route::get('auditorias/clausulas-auditorias/delete/{id}', 'ClausulasAuditoriasController@destroy')->name('auditoria-clausula.destroy');
        Route::get('auditorias/clausulas-auditorias/datatable', 'ClausulasAuditoriasController@datatable')->name('auditoria-clausula.datatable');

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

        // Organizaciones
        Route::delete('organizaciones/destroy', 'OrganizacionesController@massDestroy')->name('organizaciones.massDestroy');
        Route::post('organizaciones/parse-csv-import', 'OrganizacionesController@parseCsvImport')->name('organizaciones.parseCsvImport');
        Route::post('organizaciones/process-csv-import', 'OrganizacionesController@processCsvImport')->name('organizaciones.processCsvImport');
        Route::resource('organizaciones', 'OrganizacionesController');

        // Tipoactivos
        Route::get('tipoactivos/get-tipos', 'TipoactivoController@getTipos')->name('tipoactivos.getTipos');
        Route::delete('tipoactivos/destroy', 'TipoactivoController@massDestroy')->name('tipoactivos.massDestroy');
        Route::post('tipoactivos/parse-csv-import', 'TipoactivoController@parseCsvImport')->name('tipoactivos.parseCsvImport');
        Route::post('tipoactivos/process-csv-import', 'TipoactivoController@processCsvImport')->name('tipoactivos.processCsvImport');
        Route::resource('tipoactivos', 'TipoactivoController');

        // Subtipo Activos
        Route::get('subtipoactivos/get-subtipos', 'SubcategoriaActivoContoller@getSubtipos')->name('subtipoactivos.getSubtipos');
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
        Route::get('indicadores/dashboard', 'IndicadoresSgsiController@indicadoresDashboard')->name('indicadores-dashboard');
        Route::post('indicadores/porcentaje-dashboard', 'IndicadoresSgsiController@indicadoresDashboardPorcentaje')->name('indicadores-porcentaje-dashboard');
        // Indicadorincidentessis
        Route::resource('indicadorincidentessis', 'IndicadorincidentessiController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

        // Auditoria Anuals
        Route::delete('auditoria-anuals/destroy', 'AuditoriaAnualController@massDestroy')->name('auditoria-anuals.massDestroy');
        Route::resource('auditoria-anuals', 'AuditoriaAnualController');
        Route::get('auditoria-anuals/{id}/programa', 'AuditoriaAnualController@programa')->name('auditoria-anuals-programa');
        Route::post('auditoria-anuals/programa/documentos', 'AuditoriaAnualController@programaDocumentos')->name('auditoria-anuals.programaDocumentos');

        // Plan Auditoria
        Route::delete('plan-auditoria/destroy', 'PlanAuditoriaController@massDestroy')->name('plan-auditoria.massDestroy');
        Route::get('plan-auditoria/{planAuditorium}/edit', 'PlanAuditoriaController@edit')->name('plan-auditoria.edit');
        Route::resource('plan-auditoria', 'PlanAuditoriaController')->except('edit');

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

        // Accion Correctiva Aprobaciones
        Route::post('accion-correctivas/obtener', 'AccionCorrectivaController@obtenerAccionesCorrectivasSinAprobacion')->name('accion-correctivas.obtenerAprobaciones');
        Route::post('accion-correctivas/aprobar', 'AccionCorrectivaController@aprobaroRechazarAc')->name('accion-correctivas.aprobarRechazar');

        // Plan Accion Correctivas
        Route::post('accion-correctivas/planes', 'AccionCorrectivaController@planesAccionCorrectiva')->name('accion-correctivas.planes');
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
        // Route::post('CargaAmenaza', 'SubidaExcel@Vulnerabilidad')->name('cargaExcel-vulnerabilidad');
        Route::resource('vulnerabilidads', 'VulnerabilidadController');
        Route::delete('vulnerabilidads/destroy', 'VulnerabilidadController@massDestroy')->name('vulnerabilidads.massDestroy');
        Route::post('vulnerabilidads/parse-csv-import', 'VulnerabilidadController@parseCsvImport')->name('vulnerabilidads.parseCsvImport');
        Route::post('vulnerabilidads/process-csv-import', 'VulnerabilidadController@processCsvImport')->name('vulnerabilidads.processCsvImport');

        // analisis Riesgos
        Route::delete('analisis-riesgos/destroy', 'AnalisisdeRiesgosController@massDestroy')->name('analisis-riesgos.massDestroy');
        Route::middleware('cacheResponse')->get('analisis-riesgos-menu', 'AnalisisdeRiesgosController@menu')->name('analisis-riesgos.menu');
        Route::resource('analisis-riesgos', 'AnalisisdeRiesgosController');
        Route::get('getEmployeeData', 'AnalisisdeRiesgosController@getEmployeeData')->name('getEmployeeData');

        Route::middleware('cacheResponse')->get('analisis-impacto-menu', 'AnalisisdeImpactoController@menu')->name('analisis-impacto.menu');
        Route::get('analisis-impacto-menu-BIA', 'AnalisisdeImpactoController@menuBIA')->name('analisis-impacto.menu-BIA');
        Route::get('analisis-impacto-menu-AIA', 'AnalisisdeImpactoController@menuAIA')->name('analisis-impacto.menu-AIA');

        Route::get('analisis-impacto/ajustes', 'AnalisisdeImpactoController@ajustes')->name('analisis-impacto.ajustes');
        Route::put('analisis-impacto/{id}/updateAjustesBIA', 'AnalisisdeImpactoController@updateAjustesBIA')->name('analisis-impacto.updateAjustesBIA');
        Route::get('analisis-impacto/matriz', 'AnalisisdeImpactoController@matriz')->name('analisis-impacto.matriz');
        Route::delete('analisis-impacto/destroy', 'AnalisisdeImpactoController@massDestroy')->name('analisis-impacto.massDestroy');

        Route::get('analisis-impacto/{id}/edit', 'AnalisisdeImpactoController@edit')->name('analisis-impacto.edit');
        Route::get('getEmployeeData', 'AnalisisdeImpactoController@getEmployeeData')->name('analisis-impacto.getEmployeeData');
        Route::resource('analisis-impacto', 'AnalisisdeImpactoController')->names([
            'index' => 'analisis-impacto.index',
            'create' => 'analisis-impacto.create',
            'store' => 'analisis-impacto.store',
            'show' => 'analisis-impacto.show',
            'update' => 'analisis-impacto.update',
        ])->except(['edit']);

        Route::get('analisis-aia/ajustes', 'AnalisisAIAController@ajustes')->name('analisis-aia.ajustes');
        Route::put('analisis-aia/{id}/updateAjustesBIA', 'AnalisisAIAController@updateAjustesAIA')->name('analisis-aia.updateAjustesAIA');
        Route::get('analisis-aia/{id}/edit', 'AnalisisAIAController@edit')->name('analisis-aia.edit');
        Route::get('analisis-aia/matriz', 'AnalisisAIAController@matriz')->name('analisis-aia.matriz');
        Route::delete('analisis-aia/destroy', 'AnalisisdeAIAController@massDestroy')->name('analisis-aia.massDestroy');
        Route::resource('analisis-aia', 'AnalisisAIAController')->names([
            'index' => 'analisis-aia.index',
            'create' => 'analisis-aia.create',
            'store' => 'analisis-aia.store',
            'show' => 'analisis-aia.show',
            'update' => 'analisis-aia.update',
        ])->except(['edit']);

        //Carta de Aceptación
        // Route::get('carta-aceptacion/riesgos', 'CartadeAceptacionController@ISO31000')->name('matriz-seguridad.ISO31000');
        Route::delete('carta-aceptacion/destroy', 'CartaAceptacionRiesgosController@destroy')->name('carta-aceptacion.destroy');
        Route::resource('carta-aceptacion', 'CartaAceptacionRiesgosController')->except('destroy');
        Route::post('carta-aceptacion/aprobacion', 'CartaAceptacionRiesgosController@aprobacionAutoridad')->name('cartaaceptacion.aprobacion');
        //Tabla de impactos
        Route::resource('tabla-impacto', 'TablaImpactoController');

        //niveles de impacto
        Route::get('niveles-impacto/get-niveles/{id?}', 'NivelesImpactoController@getNivelesImpactos')->name('niveles.getNivelesImpactos');
        Route::resource('niveles-impacto', 'NivelesImpactoController');

        // Matriz Riesgos
        Route::get('matriz-riesgos/planes-de-accion/create/{id}', 'MatrizRiesgosController@createPlanAccion')->name('matriz-riesgos.createPlanAccion');
        Route::post('matriz-riesgos/planes-de-accion/store/{id}', 'MatrizRiesgosController@storePlanAccion')->name('matriz-riesgos.storePlanAccion');
        Route::delete('matriz-riesgos/destroy', 'MatrizRiesgosController@massDestroy')->name('matriz-riesgos.massDestroy');
        Route::resource('matriz-riesgos', 'MatrizRiesgosController');
        Route::post('matriz-riesgo/octave', 'MatrizRiesgosController@storeOctave')->name('matriz-riesgos.octave.store');
        Route::post('matriz-riesgo/octave/delete-activo', 'MatrizRiesgosController@deleteActivoOctave')->name('matriz-riesgo.octave.activo.delete');
        Route::put('matriz-riesgo/{id}/octave', 'MatrizRiesgosController@updateOctave')->name('matriz-riesgos.octave.update');
        Route::get('matriz-riesgo/{id}/octave/edit', 'MatrizRiesgosController@octaveEdit')->name('matriz-riesgos.octave.edit');
        Route::get('matriz-riesgo/octave', 'MatrizRiesgosController@octave')->name('matriz-riesgos.octave');
        Route::get('getEmployeeDataOctaveNomActivoInfo', 'MatrizRiesgosController@getEmployeeDataOctaveNomActivoInfo')->name('getEmployeeDataOctaveNomActivoInfo');

        Route::get('matriz-seguridad/octave/index', 'MatrizRiesgosController@octaveIndex')->name('matriz-seguridad.octaveIndex');
        Route::get('matriz-seguridad/ISO31000', 'MatrizRiesgosController@ISO31000')->name('matriz-seguridad.ISO31000');
        Route::post('matriz-riesgo/ISO31000/delete-activo', 'MatrizRiesgosController@deleteActivoISO31000')->name('matriz-seguridad.ISO31000.activo.delete');
        Route::get('matriz-seguridad/ISO31000/create', 'MatrizRiesgosController@ISO31000Create')->name('matriz-seguridad.ISO31000Create');
        Route::get('matriz-seguridad/ISO31000/{id}/edit', 'MatrizRiesgosController@ISO31000Edit')->name('matriz-seguridad.ISO31000.edit');
        Route::post('matriz-seguridad/ISO31000', 'MatrizRiesgosController@ISO31000Store')->name('matriz-seguridad.ISO31000.store');
        Route::put('matriz-seguridad/{id}/ISO31000', 'MatrizRiesgosController@ISO31000Update')->name('matriz-seguridad.ISO31000.update');
        Route::get('matriz-seguridad/NIST', 'MatrizRiesgosController@NIST')->name('matriz-seguridad.NIST');
        Route::get('matriz-seguridad/NIST/create', 'MatrizRiesgosController@NISTCreate')->name('matriz-seguridad.NISTCreate');
        Route::get('matriz-seguridad/NIST/{id}/edit', 'MatrizRiesgosController@NISTEdit')->name('matriz-seguridad.NIST.edit');
        Route::post('matriz-seguridad/NIST', 'MatrizRiesgosController@NISTStore')->name('matriz-seguridad.NIST.store');
        Route::put('matriz-seguridad/{id}/NIST', 'MatrizRiesgosController@NISTUpdate')->name('matriz-seguridad.NIST.update');
        Route::post('matriz-riesgos/parse-csv-import', 'MatrizRiesgosController@parseCsvImport')->name('matriz-riesgos.parseCsvImport');
        Route::get('matriz-seguridad', 'MatrizRiesgosController@SeguridadInfo')->name('matriz-seguridad');

        Route::get('matriz-seguridadMapa', 'MatrizRiesgosController@MapaCalor')->name('matriz-mapa');
        Route::get('matriz-octavemapa', 'MatrizRiesgosController@MapaCalorOctave')->name('matriz-octavemapa');
        Route::get('controles-get', 'MatrizRiesgosController@ControlesGet')->name('controles-get');
        Route::get('octave/graficas/{matriz}', 'MatrizRiesgosController@graficas')->name('octave-graficas');

        // Matriz de riesgos -- Sistema de Gestion
        Route::get('matriz-seguridad/sistema-gestion', 'MatrizRiesgosController@SistemaGestion')->name('matriz-seguridad.sistema-gestion');
        Route::post('matriz-seguridad/sistema-gestion/identificadorExist', 'MatrizRiesgosController@identificadorExist')->name('matriz-seguridad.sistema-gestion.identificadorExist');
        Route::post('matriz-seguridad/sistema-gestion/data', 'MatrizRiesgosController@SistemaGestionData')->name('matriz-seguridad.sistema-gestion.data');
        Route::get('matriz-riesgos/sistema-gestion/create', 'MatrizRiesgosController@createSistemaGestion')->name('matriz-riesgos.sistema-gestion.create');
        Route::post('matriz-riesgos/sistema-gestion/store', 'MatrizRiesgosController@storeSistemaGestion')->name('matriz-riesgos.sistema-gestion.store');
        Route::get('matriz-riesgos/sistema-gestion/edit/{id}', 'MatrizRiesgosController@editSistemaGestion')->name('matriz-riesgos.sistema-gestion.edit');
        Route::put('matriz-seguridad/sistema-gestion/update/{id}', 'MatrizRiesgosController@updateSistemaGestion')->name('matriz-riesgos.sistema-gestion.update');
        Route::get('matriz-seguridad/sistema-gestion/show/{id}', 'MatrizRiesgosController@showSistemaGestion')->name('matriz-riesgos.sistema-gestion.show');
        Route::delete('matriz-seguridad/sistema-gestion/{riesgo}', 'MatrizRiesgosController@destroySistemaGestion')->name('matriz-riesgos.sistema-gestion.destroy');
        Route::get('matriz-seguridad/sistema-gestion/seguridadMapa', 'MatrizRiesgosController@MapaCalorSistemaGestion')->name('matriz-mapa.SistemaGestion');

        //ProcesosOctave
        Route::post('procesos-octave/activos', 'ProcesosOctaveController@activos')->name('procesos.octave.activos');
        // Route::delete('procesos-octave/destroy', 'ProcesosOctaveController@destroy')->name('procesos-octave.destroy');
        Route::get('procesos-octave/{matriz}', 'ProcesosOctaveController@index')->name('procesos-octave.index');
        Route::get('procesos-octave/{matriz}/create', 'ProcesosOctaveController@create')->name('procesos-octave.create');
        Route::delete('procesos-octave/{proceso}', 'ProcesosOctaveController@destroy')->name('procesos-octave.destroy');
        Route::get('procesos-octave/{matriz}/edit/{proceso}', 'ProcesosOctaveController@edit')->name('procesos-octave.edit');
        Route::resource('procesos-octave', 'ProcesosOctaveController')->except(['index', 'create', 'edit', 'destroy']);

        //Servicios
        Route::delete('servicios/destroy', 'ServiciosController@destroy')->name('servicios.destroy');
        Route::resource('servicios', 'ServiciosController')->except('destroy');

        //Revisiones Documentos
        Route::get('/revisiones/archivo', 'RevisionDocumentoController@archivo')->name('revisiones.archivo');
        Route::post('/revisiones/archivar', 'RevisionDocumentoController@archivar')->name('revisiones.archivar');
        Route::post('/revisiones/desarchivar', 'RevisionDocumentoController@desarchivar')->name('revisiones.desarchivar');
        Route::post('/revisiones/documentos-debo-aprobar', 'RevisionDocumentoController@obtenerDocumentosDeboAprobar')->name('revisiones.obtenerDocumentosDeboAprobar');
        Route::post('/revisiones/documentos-debo-aprobar-archivo', 'RevisionDocumentoController@obtenerDocumentosDeboAprobarArchivo')->name('revisiones.obtenerDocumentosDeboAprobarArchivo');
        Route::post('/revisiones/documentos-me-deben-aprobar', 'RevisionDocumentoController@obtenerDocumentosMeDebenAprobar')->name('revisiones.obtenerDocumentosMeDebenAprobar');
        Route::post('/revisiones/documentos-me-deben-aprobar-archivo', 'RevisionDocumentoController@obtenerDocumentosMeDebenAprobarArchivo')->name('revisiones.obtenerDocumentosMeDebenAprobarArchivo');

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

        // lista documentos empleados
        Route::get('lista-documentos', 'ListaDocumentosEmpleados@index')->name('lista-documentos-empleados');
        Route::post('lista-documentos/store', 'ListaDocumentosEmpleados@store')->name('lista-documentos-empleados-store');
        Route::get('lista-documentos/destroy/{id}', 'ListaDocumentosEmpleados@destroy')->name('lista-documentos-empleados-destroy');
    });

    //Escuela cursos instructor
    Route::resource('courses', 'Escuela\Instructor\CourseController');

    Route::get('curso-estudiante/{course}', 'CursoEstudiante@cursoEstudiante')->name('curso-estudiante');
    Route::get('mis-cursos', 'CursoEstudiante@misCursos')->name('mis-cursos');
    Route::get('curso-estudiante/{course}/evaluacion/{evaluation}', 'CursoEstudiante@evaluacionEstudiante')->name('curso.evaluacion');
    Route::get('courses/{course}', 'CursoEstudiante@show')->name('courses.show');
    Route::post('course/{course}/enrolled', 'CursoEstudiante@enrolled')->name('courses.enrolled');
    Route::get('courses/{course}/quizdetail', 'Escuela\Instructor\CourseController@quizDetails')->name('courses-quizdetails');
    Route::get('courses/{course}/evaluation/{evaluation}/quiz-details', 'Escuela\QuizDetailsController@show')->name('courses.evaluation.quizdetails');

    Route::get('courses/{course}/evaluation/{evaluation}', 'Escuela\Instructor\CourseQuestionController@index')->name('courses.evaluation.questions');
    Route::get('courses/{course}/evaluacion/{evaluation}/quizdetail', 'CursoEstudiante@tableQuizDetails')->name('courses.quizdetails');
    //categorias para el administrador de escuela
    Route::resource('categories', 'Escuela\Admin\CategoryController');
    Route::get('categories/destroy/{id}', 'Escuela\Admin\CategoryController@destroy');
    Route::resource('levels', 'Escuela\Admin\LevelController');
    Route::get('levels/destroy/{id}', 'Escuela\Admin\LevelController@destroy');
    Route::resource('dashboardescuela', 'Escuela\Admin\HomeController');
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
    // Route::get('ExportCategoria', 'ExportExcel@CategoriaActivo')->name('descarga-categoria');
    Route::get('ExportPuesto', 'ExportExcel@Puesto')->name('descarga-puesto');
    // Route::get('ExportEstadoIncidente', 'ExportExcel@EstadoIncidente')->name('descarga-estadoincidente');
    Route::get('ExportRole', 'ExportExcel@Roles')->name('descarga-roles');
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

//KATBOL
Route::group(['prefix' => 'contract_manager', 'as' => 'contract_manager.', 'namespace' => 'ContractManager', 'middleware' => ['auth', '2fa', 'active']], function () {
    Route::view('katbol', 'contract_manager.katbol.index')->name('katbol');

    //Proveedores
    Route::resource('proveedor', 'ProveedoresController');

    //Contratos
    //## API - Revisar en tiempo real si contrato ya existe ###
    Route::post('contratos-katbol/numero/existe', 'ContratosController@revisarSiNumeroContratoExiste')->name('contratos-katbol.noContratoExistencia');
    Route::post('contratos-katbol/{id}/ampliacion', 'ContratosController@updateAmpliacion')->name('contratos-katbol.ampliacion');
    Route::post('contratos-katbol/{id}/convenios', 'ContratosController@updateConvenios')->name('contratos-katbol.convenios');
    // Route::post('contratos-katbol/update/{id}', 'ContratosController@update')->name('contracontratos-katboltos.update');
    Route::post('contratos-katbol/contrato-file-upload-tmp', 'ContratosController@uploadInTmpDirectory')->name('contratos-katbol.fileUploadTmp');
    // Route::get('download/{file}', 'ContratosController@getDownload');
    Route::post('contratos-katbol/archivos', 'ContratosController@obtenerArchivos')->name('contratos-katbol.obtenerArchivos');
    Route::get('contratos-katbol/file/download', 'ContratosController@downloadFile')->name('downloadFile');
    // Route::post('contratos/identificadorExist', 'ContratosController@identificadorExist')->name('contratos-katbol.identificadorExist');
    Route::post('selectProveedor', 'DashboardController@AjaxRequestClientes')->name('selectCliente');
    Route::post('selectContrato', 'DashboardController@AjaxRequestContratos')->name('selectContrato');
    Route::post('selectEvaluacionesServicio', 'DashboardController@AjaxRequestEvaluacionesServicio')->name('selectEvaluacionesServicio');
    Route::get('dashboard-contratos-katbol', 'DashboardController@index')->name('dashboard.katbol');
    Route::post('contratos-katbol/check-code', 'ContratosController@checkCode')->name('contratos-katbol.checkCode');
    Route::resource('contratos-katbol', 'ContratosController');
    Route::get('contratos-katbol/exportar/contratos', 'ContratosController@exportTo')->name('reportecliente.exportar');
    Route::put('contratos-katbol/contratopago/{id}', 'ContratosController@Campos')->name('contratos-katbol.contratopago');
    Route::get('contratos-katbol/contratoinsert/{id}', 'FacturaController@ContratoInsert')->name('contratos-katbol.Insertar');
    Route::get('contratos-katbol/eval-nivel/{id}', 'ContratosController@evaluacion')->name('contratos-katbol.evaluacion');
    Route::get('contratos-katbol/revision-factura/{id}', 'ContratosController@revision')->name('contratos-katbol.revision');

    Route::post('contratos-katbol/validateDocument', 'ContratoController@validateDocument')->name('contratos-katbol.validar-documento');

    Route::resource('bitacoras', 'BitacoraController');

    Route::resource('facturas', 'FacturaController');
    Route::get('facturas/exportar', 'FacturaController@exportTo')->name('adeudoproveedor.exportar');

    Route::get('cedula/{id_cedula}/historico', 'HistoricoCedulaController@index')->name('cedula.historico');

    Route::get('productos/archivados', 'ProductoController@view_archivados')->name('productos.view_archivados');
    Route::post('productos/list/get/archivados', 'ProductoController@getArchivadosIndex')->name('productos.getArchivadosIndex');
    Route::resource('productos', 'ProductoController');
    Route::post('productos/archivar/{id}', 'ProductoController@archivar')->name('productos.archivar');
    Route::post('productos/list/get', 'ProductoController@getProductosIndex')->name('productos.getProductosIndex');

    Route::get('sucursales/archivados', 'SucursalController@view_archivados')->name('sucursales.view_archivados');
    Route::post('sucursales/list/get/archivados', 'SucursalController@getArchivadosIndex')->name('sucursales.getArchivadosIndex');
    Route::resource('sucursales', 'SucursalController');
    Route::post('sucursales/archivar/{id}', 'SucursalController@archivar')->name('sucursales.archivar');
    Route::post('sucursales/list/get', 'SucursalController@getSucursalesIndex')->name('sucursales.getSucursalesIndex');

    Route::get('proveedores/archivados', 'ProveedoresOController@view_archivados')->name('proveedores.view_archivados');
    Route::post('proveedores/list/get/archivados', 'ProveedoresOController@getArchivadosIndex')->name('proveedores.getArchivadosIndex');
    Route::resource('proveedores', 'ProveedoresOController');
    Route::post('proveedores/archivar/{id}', 'ProveedoresOController@archivar')->name('proveedores.archivar');
    Route::post('proveedores/list/get', 'ProveedoresOController@getProveedoresIndex')->name('proveedores.getProveedoresIndex');

    Route::get('compradores/archivados', 'CompradoresController@view_archivados')->name('compradores.view_archivados');
    Route::post('compradores/list/get/archivados', 'CompradoresController@getArchivadosIndex')->name('compradores.getArchivadosIndex');
    Route::resource('compradores', 'CompradoresController');
    Route::post('compradores/archivar/{id}', 'CompradoresController@archivar')->name('compradores.archivar');
    Route::post('compradores/list/get', 'CompradoresController@getCompradoresIndex')->name('compradores.getCompradoresIndex');

    Route::get('centro-costos/archivados', 'CentroCostosController@view_archivados')->name('centro-costos.view_archivados');
    Route::post('centro-costos/list/get/archivados', 'CentroCostosController@getArchivadosIndex')->name('centro-costos.getArchivadosIndex');
    Route::resource('centro-costos', 'CentroCostosController');
    Route::post('centro-costos/archivar/{id}', 'CentroCostosController@archivar')->name('centro-costos.archivar');
    Route::post('centro-costos/list/get', 'CentroCostosController@getCentroCostosIndex')->name('centro-costos.getCentroCostosIndex');

    Route::resource('reportes', 'ReporteRequisicionController');
    Route::post('excelContratos', 'ReporteRequisicionController@ExcelContratos')->name('excelContratos');

    //requisiciones
    Route::get('requisiciones', 'RequisicionesController@index')->name('requisiciones');
    Route::delete('requisiciones/eliminar-registro', 'RequisicionesController@eliminarProveedores')->name('eliminarProveedores');
    Route::get('requisiciones/aprobadores', 'RequisicionesController@indexAprobadores')->name('requisiciones.indexAprobadores');
    Route::post('requisiciones/list/get', 'RequisicionesController@getRequisicionIndex')->name('requisiciones.getRequisicionIndex');
    Route::post('requisiciones-aprobadores/list/get', 'RequisicionesController@getRequisicionIndexAprobador')->name('requisiciones.getRequisicionIndexAprobador');
    Route::post('requisiciones-solicitante/list/get', 'RequisicionesController@getRequisicionIndexSolicitante')->name('requisiciones.getRequisicionIndexSolicitante');
    Route::get('requisiciones/show/{id}', 'RequisicionesController@show')->name('requisiciones.show');
    Route::get('requisiciones/edit/{id}', 'RequisicionesController@edit')->name('requisiciones.edit');
    Route::get('requisiciones/create', 'RequisicionesController@create')->name('requisiciones.create');
    Route::post('requisiciones/pdf/{id}', 'RequisicionesController@pdf')->name('requisiciones.pdf');
    Route::get('requisiciones/destroy/{id}', 'RequisicionesController@destroy')->name('requisiciones.destroy');
    Route::get('requisiciones/aprobados/{id}', 'RequisicionesController@firmarAprobadores')->name('requisiciones.firmarAprobadores');
    Route::post('requisiciones/firma', 'RequisicionesController@guardarFirmaAprobacion')->name('requisiciones.firma');
    Route::get('requisiciones/firmar/{tipo_firma}/{id}', 'RequisicionesController@Firmar')->name('requisiciones.firmar');
    Route::post('requisiciones/firma-update/{tipo_firma}/{id}', 'RequisicionesController@FirmarUpdate')->name('requisiciones.firmar-update');
    Route::get('requisiciones/archivo', 'RequisicionesController@archivo')->name('requisiciones.archivo');
    Route::post('requisiciones-archivo/list/get', 'RequisicionesController@getRequisicionIndexArchivo')->name('requisiciones.getRequisicionIndexArchivo');
    Route::get('requisiciones/archivo-estado/{id}', 'RequisicionesController@estado')->name('requisiciones.estado');
    Route::post('requisiciones/rechazada/{id}', 'RequisicionesController@rechazada')->name('requisiciones.rechazada');

    // ordenes de compra
    Route::get('orden-compra', 'OrdenCompraController@index')->name('orden-compra');
    Route::post('orden-compra/list/get', 'OrdenCompraController@getRequisicionIndex')->name('orden-compra.getRequisicionIndex');
    Route::get('orden-compra/{id}/edit', 'OrdenCompraController@edit')->name('orden-compra.edit');
    Route::post('orden-compra/update/{id}', 'OrdenCompraController@update')->name('orden-compra.update');
    Route::post('orden-compra/destroy/{id}', 'OrdenCompraController@destroy')->name('orden-compra.destroy');
    Route::get('orden-compra/show/{id}', 'OrdenCompraController@show')->name('orden-compra.show');
    Route::post('orden-compra/pdf/{id}', 'OrdenCompraController@pdf')->name('orden-compra.pdf');
    Route::post('orden-compra/rechazada/{id}', 'OrdenCompraController@rechazada')->name('orden-compra.rechazada');
    Route::get('orden-compra/firmar/{tipo_firma}/{id}', 'OrdenCompraController@firmar')->name('orden-compra.firmar');
    Route::post('orden-compra/firma-update/{tipo_firma}/{id}', 'OrdenCompraController@FirmarUpdate')->name('orden-compra.firmar-update');
});