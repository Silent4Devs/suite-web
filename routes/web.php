<?php

use App\Http\Controllers\Admin\AnalisisdeRiesgosController;
use App\Http\Controllers\Admin\ArbolRiesgosOctaveController;
use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\AusenciasController;
use App\Http\Controllers\Admin\CalendarioOficialController;
use App\Http\Controllers\Admin\ContenedorMatrizOctaveController;
use App\Http\Controllers\Admin\DashboardAuditoriasSGIController;
use App\Http\Controllers\Admin\DashboardPermisosController;
use App\Http\Controllers\Admin\DayOffController;
use App\Http\Controllers\Admin\DenunciasController;
use App\Http\Controllers\Admin\DocumentosController;
use App\Http\Controllers\Admin\EmpleadoController;
use App\Http\Controllers\Admin\EnvioDocumentosController;
use App\Http\Controllers\Admin\Escuela\CapacitacionesController;
use App\Http\Controllers\Admin\FirmasModuleController;
use App\Http\Controllers\Admin\GrupoAreaController;
use App\Http\Controllers\Admin\IncidentesDayOffController;
use App\Http\Controllers\Admin\IncidentesVacacionesController;
use App\Http\Controllers\Admin\InicioUsuarioController;
use App\Http\Controllers\Admin\MatrizRiesgosController;
use App\Http\Controllers\Admin\MejorasController;
use App\Http\Controllers\Admin\OrganizacionController;
use App\Http\Controllers\Admin\PermisosGoceSueldoController;
use App\Http\Controllers\Admin\PortalComunicacionController;
use App\Http\Controllers\Admin\ProcesosOctaveController;
use App\Http\Controllers\Admin\PuestosController;
use App\Http\Controllers\Admin\QuejasClienteController;
use App\Http\Controllers\Admin\QuejasController;
use App\Http\Controllers\Admin\RiesgosController;
use App\Http\Controllers\Admin\SeguridadController;
use App\Http\Controllers\Admin\SolicitudDayOffController;
use App\Http\Controllers\Admin\SolicitudPermisoGoceSueldoController;
use App\Http\Controllers\Admin\SolicitudVacacionesController;
use App\Http\Controllers\Admin\SugerenciasController;
use App\Http\Controllers\Admin\TablaCalendarioController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VacacionesController;
use App\Http\Controllers\Admin\VisitanteQuoteController;
use App\Http\Controllers\Admin\VisitantesAvisoPrivacidadController;
use App\Http\Controllers\Admin\VisitantesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\ContractManager\ContratosController;
use App\Http\Controllers\ContractManager\DashboardController;
use App\Http\Controllers\ContractManager\OrdenCompraController;
use App\Http\Controllers\ExportExcelReport;
use App\Http\Controllers\QueueCorreo;
use App\Http\Controllers\RevisionDocumentoController;
use App\Http\Controllers\SubidaExcel;
use App\Http\Controllers\UsuarioBloqueado;
use App\Http\Controllers\Visitantes\RegistroVisitantesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('tenant', 'central.landing')->name('central.landing');

Route::group(['middleware' => ['tenant']], function () {

    Route::get('orden-compra/excel', [OrdenCompraController::class, 'excel'])->name('orden-compra.excel');
    Route::group(['prefix' => 'visitantes', 'as' => 'visitantes.', 'namespace' => 'Visitantes'], function () {
        Route::get('/presentacion', [RegistroVisitantesController::class, 'presentacion'])->name('presentacion');
        Route::get('/salida', [RegistroVisitantesController::class, 'salida'])->name('salida');
        Route::get('/salida/{registrarVisitante?}/registrar', [RegistroVisitantesController::class, 'registrarSalida'])->name('salida.registrar');
        Route::resource('/', RegistroVisitantesController::class);
    });

    Route::get('correotestqueue', [QueueCorreo::class, 'index']);
    Route::get('insertarFirmadoresFinanzas', [QueueCorreo::class, 'insertarFirmadoresFinanzas']);

    Route::get('/', [LoginController::class, 'showLoginForm'])->name('users.login');
    Route::get('/usuario-bloqueado', [UsuarioBloqueado::class, 'usuarioBloqueado'])->name('users.usuario-bloqueado');

    Route::post('/minutas/revisiones/approve', 'RevisionMinutasController@approve')->name('minutas.revisiones.approve');
    Route::post('/minutas/revisiones/reject', 'RevisionMinutasController@reject')->name('minutas.revisiones.reject');
    Route::get('/minutas/revisiones/{revisionMinuta}', 'RevisionMinutasController@edit')->name('minutas.revisiones.revisar');
    Route::get('comunicados-tv', 'ComunicadosTVController@index')->name('comunicados-tv');

    Route::post('provedor_reporte', 'ContractManager\ReporteRequisicionController@AjaxRequestClientes')->name('provedor_reporte');
    Route::post('contrato_reporte', 'ContractManager\ReporteRequisicionController@AjaxRequestContratos')->name('contrato_reporte');

    // Rutas de CertificatesController
    Route::prefix('certificates')->controller(CertificatesController::class)->group(function () {
        Route::get('type-catalogue-training', 'TypeCatalogueTraining')->name('type-catalogue-training.index'); // Catálogo de tipos de capacitación
        Route::get('catalogue-training', 'CatalogueTraining')->name('catalogue-training.index'); // Catálogo de capacitación
        Route::get('user-training', 'UserTraining')->name('user-training.index'); // Capacitación de usuario

        // Rutas para la revisión y acciones de aprobación o rechazo de capacitación del usuario
        Route::get('user-catalogue-training/{id}', 'revision')->name('user-catalogue-training'); // Revisión de capacitación de usuario
        Route::post('user-catalogue-training/{id}/aprobado', 'aprobado')->name('user-catalogue-training.aprobado'); // Aprobar capacitación
        Route::post('user-catalogue-training/{id}/rechazado', 'rechazado')->name('user-catalogue-training.rechazado'); // Rechazar capacitación
    });

    Auth::routes();

    // Tabla-Calendario

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'active']], function () {

        Route::get('inicioUsuario', [InicioUsuarioController::class, 'index'])->name('inicio-Usuario.index');
        Route::get('/', [PortalComunicacionController::class, 'index']);
        Route::get('/home', [InicioUsuarioController::class, 'index'])->name('home');
        Route::get('inicioUsuario/mis-cursos', 'InicioUsuarioController@misCursos')->name('inicioUsuario.mis-cursos');
        //log-viewer
        //Route::get('log-viewer', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log-viewer');
        // Users
        // Agrupamos las rutas relacionadas con el controlador UsersController
        Route::controller(UsersController::class)->group(function () {
            Route::get('users/{id}/restablecer', 'restablecerUsuario')->name('users.restablecer');
            Route::get('users/eliminados', 'vistaEliminados')->name('users.eliminados');
            Route::get('users/two-factor/{user}/change', 'cambiarVerificacion')->name('users.two-factor-change');
            Route::get('users/bloqueo/{user}/change', 'toogleBloqueo')->name('users.toogle-bloqueo');
            Route::post('users/vincular', 'vincularEmpleado')->name('users.vincular');
            Route::post('users/list/get', 'getUsersIndex')->name('users.getUsersIndex');
        });

        // Uso de resource para las operaciones CRUD
        Route::resource('users', UsersController::class);

        // Firmas
        Route::controller(FirmasModuleController::class)->group(function () {
            Route::get('firmas_module', 'index')->name('module_firmas');
            Route::get('firmas_module/create', 'create')->name('module_firmas.create');
            Route::post('firmas_module/store', 'store')->name('module_firmas.store');
            Route::get('firmas_module/edit/{id}', 'edit')->name('module_firmas.edit');
            Route::post('firmas_module/update/{id}', 'update')->name('module_firmas.update');

            // Agrupamos las rutas relacionadas a acciones específicas en la firma
            Route::post('firmas_module/seguridad/{id}', 'seguridad')->name('module_firmas.seguridad');
            Route::post('firmas_module/riesgos/{id}', 'riesgos')->name('module_firmas.riesgos');
            Route::post('firmas_module/quejas/{id}', 'quejas')->name('module_firmas.quejas');
            Route::post('firmas_module/mejoras/{id}', 'mejoras')->name('module_firmas.mejoras');
            Route::post('firmas_module/denuncias/{id}', 'denuncias')->name('module_firmas.denuncias');
            Route::post('firmas_module/sugerencia/{id}', 'sugerencias')->name('module_firmas.sugerencias');
            Route::post('firmas_module/minutas/{id}', 'minutas')->name('module_firmas.minutas');
        });

        // Empleados
        Route::controller(EmpleadoController::class)->group(function () {
            Route::get('empleados/importar', 'importar')->name('empleado.importar');
            Route::post('empleados/list/get', 'getListaEmpleadosIndex')->name('empleado.getListaEmpleadosIndex');
            Route::post('empleado/buscar-empleado-por-correo', 'buscarEmpleadoPorCorreo')->name('empleado.buscarEmpleadoPorCorreo');

            Route::get('empleado/{empleado}/documentos', 'getDocumentos')->name('empleado.documentos');
            Route::post('empleado/{empleado}/documentos', 'storeDocumentos')->name('empleado.storeDocumentos');
            Route::delete('empleado/{documento}/documentos', 'deleteDocumento')->name('empleado.deleteDocumento');

            Route::post('empleados/update/{documento}/documentos', 'updateDocumento')->name('empleados.updateDocumento');
            Route::delete('empleados/{documento}/delete-file-documento', 'deleteFileDocumento')->name('empleados.deleteFileDocumento');

            Route::post('empleado/update-image-profile', 'updateImageProfile')->name('empleado.update-image-profile');
            Route::post('empleado/update-profile', 'updateInformationProfile')->name('empleado.update-profile');
            Route::post('empleado/update-related-info-profile', 'updateInformacionRelacionadaProfile')->name('empleado.update-related-info-profile');

            Route::post('empleados/store/{empleado}/competencias-resumen', 'storeResumen')->name('empleados.storeResumen');

            Route::post('empleado-deletemultiple', 'borradoMultiple')->name('empleado.deleteMultiple');
            Route::post('empleados/update/{certificacion}/competencias-certificaciones', 'updateCertificaciones')->name('empleados.updateCertificaciones');
            Route::delete('empleados/{certificacion}/delete-file-certificacion', 'deleteFileCertificacion')->name('empleados.deleteFileCertificacion');

            Route::delete('empleados/{documento}/delete', 'deleteDocumento')->name('empleados.deleteDocumento');
            Route::post('empleados/store/{empleado}/competencias-certificaciones', 'storeCertificaciones')->name('empleados.storeCertificaciones');
            Route::delete('empleados/delete/{certificacion}/competencias-certificaciones', 'deleteCertificaciones')->name('empleados.deleteCertificaciones');

            Route::post('empleados/update/{curso}/competencias-curso', 'updateCurso')->name('empleados.updateCurso');
            Route::delete('empleados/{curso}/delete-file-curso', 'deleteFileCurso')->name('empleados.deleteFileCurso');

            Route::post('empleados/store/{empleado}/competencias-cursos', 'storeCursos')->name('empleados.storeCursos');
            Route::delete('empleados/delete/{curso}/competencias-cursos', 'deleteCursos')->name('empleados.deleteCursos');

            Route::post('empleados/update/{experiencia}/competencias-experiencia', 'updateExperiencia')->name('empleados.updateExperiencia');
            Route::post('empleados/store/{empleado}/competencias-experiencia', 'storeExperiencia')->name('empleados.storeExperiencia');
            Route::delete('empleados/delete/{experiencia}/competencias-experiencia', 'deleteExperiencia')->name('empleados.deleteExperiencia');

            Route::post('empleados/update/{educacion}/competencias-educacion', 'updateEducacion')->name('empleados.updateEducacion');
            Route::post('empleados/store/{empleado}/competencias-educacion', 'storeEducacion')->name('empleados.storeEducacion');
            Route::delete('empleados/delete/{educacion}/competencias-educacion', 'deleteEducacion')->name('empleados.deleteEducacion');

            Route::get('empleados/store/{empleado}/competencias-certificaciones', 'getCertificaciones')->name('empleados.getCertificaciones');
            Route::get('empleados/store/{empleado}/competencias-educacion', 'getEducacion')->name('empleados.getEducacion');
            Route::get('empleados/store/{empleado}/competencias-experiencia', 'getExperiencia')->name('empleados.getExperiencia');
            Route::get('empleados/store/{empleado}/competencias-cursos', 'getCursos')->name('empleados.getCursos');

            Route::post('empleados/store/competencias', 'storeWithCompetencia')->name('empleados.storeWithCompetencia');
            Route::post('empleados/get', 'getEmpleados')->name('empleados.get');
            Route::post('empleados/get-lista', 'getListaEmpleados')->name('empleados.lista');
            Route::get('empleados/get-all', 'getAllEmpleados')->name('empleados.getAll');

            Route::get('empleados/datosEmpleado/{id}', 'show');

            Route::post('empleados/{empleado}/update-from-curriculum', 'updateFromCurriculum')->name('empleados.updateFromCurriculum');
            Route::post('empleados/baja/remover-vacante', 'removerVacante')->name('empleados.removerVacante');
            Route::post('empleado/expediente/update', 'expedienteUpdate')->name('empleado.edit.expediente-update');
            Route::post('empleado/expediente/Restaurar', 'expedienteRestaurar')->name('empleado.edit.expediente-restaurar');

            Route::get('empleado/{empleado}/solicitud-baja', 'solicitudBaja')->name('empleado.solicitud-baja');
            Route::get('empleados/baja', 'baja')->name('empleados.baja');
            Route::get('empleados/historial', 'historial')->name('empleados.historial');
            Route::post('empleados/seleccionar', 'seleccionar')->name('empleados.seleccionar');
            Route::get('exportar-historial/{id}', 'exportarHistorial')->name('empleados.historial_export');
        });

        Route::resource('empleados', EmpleadoController::class);

        // Organizacions
        Route::controller(OrganizacionController::class)->group(function () {
            Route::delete('organizacions/destroy', 'massDestroy')->name('organizacions.massDestroy');
            Route::post('organizacions/media', 'storeMedia')->name('organizacions.storeMedia');
            Route::post('organizacions/ckmedia', 'storeCKEditorImages')->name('organizacions.storeCKEditorImages');
            Route::get('organizacions/visualizarorganizacion', 'visualizarOrganizacion')->name('organizacions.visualizarorganizacion');
            Route::post('organizacions/{schedule}/update-schedule', 'updateSchedule')->name('organizacions.update-schedule');
            Route::post('organizacions/{schedule}/delete-schedule', 'deleteSchedule')->name('organizacions.delete-schedule');
        });

        Route::resource('organizacions', OrganizacionController::class);

        // Inicio usuario

        // Areas
        Route::controller(AreasController::class)->group(function () {
            Route::get('areas/exportar', 'exportTo')->name('areas.exportar');
            Route::delete('areas/destroy', 'massDestroy')->name('areas.massDestroy');
            Route::get('areas/grupo', 'obtenerAreasPorGrupo')->name('areas.obtenerAreasPorGrupo');
            Route::post('areas/parse-csv-import', 'parseCsvImport')->name('areas.parseCsvImport');
            Route::get('areas/jerarquia', 'renderJerarquia')->name('areas.renderJerarquia');
            Route::post('areas/pdf', 'pdf')->name('areas.pdf');
            Route::get('areas/jerarquia/lista', 'obtenerJerarquia')->name('areas.obtenerJerarquia');
            Route::post('areas/process-csv-import', 'processCsvImport')->name('areas.processCsvImport');
        });

        Route::resource('areas', AreasController::class);

        // Puestos
        Route::controller(PuestosController::class)->group(function () {
            Route::delete('puestos/destroy', 'massDestroy')->name('puestos.massDestroy');
            Route::post('puestos/delete-language', 'deleteLanguage')->name('puestos.deleteLanguage');
            Route::post('puestos/parse-csv-import', 'parseCsvImport')->name('puestos.parseCsvImport');
            Route::post('puestos/process-csv-import', 'processCsvImport')->name('puestos.processCsvImport');
            Route::get('consulta-puestos', 'consultaPuestos')->name('consulta-puestos');

            Route::post('puestos-aprobacion/aprobacion-firma-puesto', 'aprobacionFirma')->name('puestos-aprobacion.aprobacion-firma-puesto');
            Route::get('puestos-aprobacion/aprobacion-firma-puesto/historico', 'historicoAprobacion')->name('puestos-aprobacion.aprobacion-firma-puesto.historico');
        });

        Route::resource('puestos', PuestosController::class);

        Route::group(['middleware' => ['auth', '2fa', 'active', 'primeros.pasos']], function () {
            //Se puso aqui debido a problema de cross-origin
            Route::get('ExportEmpleadosGeneral', 'EmpleadoController@exportExcel')->name('descarga-empleados-general');

            // Rutas para Visitantes
            // Rutas para Visitantes
            Route::prefix('visitantes')->controller(VisitantesController::class)->group(function () {
                Route::get('autorizar', 'autorizar')->name('visitantes.autorizar'); // Autorizar visitantes
                Route::get('configuracion', 'configuracion')->name('visitantes.configuracion'); // Configuración
                Route::get('dashboard', 'dashboard')->name('visitantes.dashboard'); // Dashboard
                // Route::middleware('cacheResponse')->get('menu', 'menu')->name('visitantes.menu'); // Menú con cache
                Route::get('menu', 'menu')->name('visitantes.menu');
            });

            // Rutas para recursos anidados
            Route::prefix('visitantes')->group(function () {
                Route::resource('aviso-privacidad', VisitantesAvisoPrivacidadController::class)->names('visitantes.aviso-privacidad');
                Route::resource('cita-textual', VisitanteQuoteController::class)->names('visitantes.cita-textual');
            });

            // Recurso general para Visitantes
            Route::resource('visitantes', VisitantesController::class);

            // Rutas para Contenedores
            Route::prefix('contenedores')->controller(ContenedorMatrizOctaveController::class)->group(function () {
                Route::post('escenarios/{contenedor}/agregar', 'agregarEscenarios')->name('contenedores.escenarios.store'); // Agregar escenarios a un contenedor
                Route::get('escenarios/{contenedor}/listar', 'escenarios')->name('contenedores.escenarios.get'); // Listar escenarios
                Route::post('escenarios/eliminar', 'eliminarEscenario')->name('contenedores.escenarios.destroy'); // Eliminar escenario
                Route::delete('destroy', 'massDestroy')->name('contenedores.massDestroy'); // Eliminar contenedores en masa

                Route::get('{matriz}', 'index')->name('contenedores.index'); // Índice de contenedores
                Route::get('create/{matriz}', 'create')->name('contenedores.create'); // Crear nuevo contenedor
                Route::get('{contenedor}/edit/{matriz}', 'edit')->name('contenedores.edit'); // Editar contenedor
                Route::delete('{contenedor}', 'destroy')->name('contenedores.destroy'); // Eliminar contenedor
            });

            // Excluir rutas ya definidas
            Route::resource('contenedores', ContenedorMatrizOctaveController::class)->except(['index', 'create', 'edit', 'destroy']);

            // Rutas para Árbol de Riesgos Octave
            Route::prefix('octave/arbol-riesgos')->controller(ArbolRiesgosOctaveController::class)->group(function () {
                Route::get('{matriz}', 'index')->name('octave.arbol-riesgos.index'); // Índice del árbol de riesgos
                Route::post('/', 'obtenerArbol')->name('octave.arbol-riesgos.obtener'); // Obtener datos del árbol de riesgos
            });

            //Modulo Capital Humano
            Route::get('capital-humano', 'RH\CapitalHumanoController@index')->name('capital-humano.index');
            // Route::middleware('cacheResponse')->get('capital-humano', 'RH\CapitalHumanoController@index')->name('capital-humano.index');

            // Rutas de AusenciasController
            Route::controller(AusenciasController::class)->group(function () {
                Route::get('ajustes-dayoff', 'ajustesDayoff')->name('ajustes-dayoff'); // Ajustes para días libres
                Route::get('ajustes-vacaciones', 'ajustesVacaciones')->name('ajustes-vacaciones'); // Ajustes para vacaciones
                Route::get('ajustes-permisos-goce-sueldo', 'ajustesGoceSueldo')->name('ajustes-permisos-goce-sueldo'); // Ajustes para permisos con goce de sueldo
            });

            // Recurso completo para Ausencias
            Route::resource('ausencias', AusenciasController::class);

            // Rutas de EnvioDocumentosController
            Route::controller(EnvioDocumentosController::class)->group(function () {
                Route::get('envio-documentos/atencion', 'atencion')->name('envio-documentos.atencion');
                Route::get('envio-documentos/atencion/{id}/seguimiento', 'seguimiento')->name('envio-documentos.seguimiento');
                Route::put('envio-documentos/{id}/seguimientoUpdate', 'seguimientoUpdate')->name('envio-documentos.seguimientoUpdate');
                Route::get('ajustes-envio-documentos', 'ajustes')->name('ajustes-envio-documentos');
                Route::put('ajustes-envio-documentos/{id}/update', 'ajustesUpdate')->name('ajustes-envio-documentos-update');
                // Route::get('solicitud-vacaciones/archivo', 'SolicitudVacacionesController@archivo')->name('solicitud-vacaciones.archivo');
            });

            // Recurso completo para EnvioDocumentosController
            Route::resource('envio-documentos', EnvioDocumentosController::class);

            // Control de Ausencias - Vacaciones
            Route::controller(VacacionesController::class)->group(function () {
                Route::get('vista-global-vacaciones', 'vistaGlobal')->name('vista-global-vacaciones');
                Route::get('ExportVacaciones', 'exportExcel')->name('descarga-vacaciones');
                Route::delete('vacaciones/destroy', 'massDestroy')->name('vacaciones.massDestroy');
            });

            // Recurso completo para VacacionesController
            Route::resource('vacaciones', VacacionesController::class)->names([
                'create' => 'vacaciones.create',
                'store' => 'vacaciones.store',
                'show' => 'vacaciones.show',
                'edit' => 'vacaciones.edit',
                'update' => 'vacaciones.update',
                'destroy' => 'vacaciones.destroy',
            ]);

            // Dashboard permisos
            Route::get('dashboard-permisos/dashboard-org/{id}', [DashboardPermisosController::class, 'dashboardOrg'])->name('dashboard-permisos.dashboard-org');

            // Lista Distribución
            Route::get('lista-distribucion', 'ListaDistribucionController@index')->name('lista-distribucion.index');
            Route::get('lista-distribucion/{id}/edit', 'ListaDistribucionController@edit')->name('lista-distribucion.edit');
            Route::post('lista-distribucion/{lista}/update', 'ListaDistribucionController@update')->name('lista-distribucion.update');
            Route::get('lista-distribucion/{id}/show', 'ListaDistribucionController@show')->name('lista-distribucion.show');

            //Lista Informativa
            Route::get('lista-informativa', 'ListaInformativaController@index')->name('lista-informativa.index');
            Route::get('lista-informativa/{id}/edit', 'ListaInformativaController@edit')->name('lista-informativa.edit');
            Route::post('lista-informativa/{lista}/update', 'ListaInformativaController@update')->name('lista-informativa.update');
            Route::get('lista-informativa/{id}/show', 'ListaInformativaController@show')->name('lista-informativa.show');

            //Control de Ausencias- Day-Off
            Route::controller(DayOffController::class)->group(function () {
                Route::get('vista-global-dayoff', 'vistaGlobal')->name('vista-global-dayoff');
                Route::get('ExportDayOff', 'exportExcel')->name('descarga-dayOff');
                Route::delete('dayOff/destroy', 'massDestroy')->name('dayOff.massDestroy');
            });

            Route::resource('dayOff', DayOffController::class)->names([
                'create' => 'dayOff.create',
                'store' => 'dayOff.store',
                'show' => 'dayOff.show',
                'edit' => 'dayOff.edit',
                'update' => 'dayOff.update',
                'destroy' => 'dayOff.destroy',
            ]);

            Route::controller(PermisosGoceSueldoController::class)->group(function () {
                Route::get('vista-global-permisos-goce-sueldo', 'vistaGlobal')->name('vista-global-permisos-goce-sueldo');
                Route::get('ExportPermisoGoceSueldo', 'exportExcel')->name('descarga-permiso-goce-sueldo');
                Route::delete('permisos-goce-sueldo/destroy', 'massDestroy')->name('permisos-goce-sueldo.massDestroy');
            });

            Route::resource('permisos-goce-sueldo', PermisosGoceSueldoController::class)->names([
                'index' => 'permisos-goce-sueldo.index',
                'create' => 'permisos-goce-sueldo.create',
                'store' => 'permisos-goce-sueldo.store',
                'show' => 'permisos-goce-sueldo.show',
                'edit' => 'permisos-goce-sueldo.edit',
                'update' => 'permisos-goce-sueldo.update',
                'destroy' => 'permisos-goce-sueldo.destroy',
            ]);

            //Control de Solicitud- Vacaciones
            Route::prefix('solicitud-vacaciones')->group(function () {
                Route::controller(SolicitudVacacionesController::class)->group(function () {
                    Route::get('perido-adicional/create', 'periodoAdicional')->name('solicitud-vacaciones.periodoAdicional');
                    Route::get('{id}/archivoShow', 'archivoShow')->name('solicitud-vacaciones.archivoShow');
                    Route::get('{id}/vistaGlobal', 'showVistaGlobal')->name('solicitud-vacaciones.vistaGlobal');
                    Route::get('menu', 'aprobacionMenu')->name('solicitud-vacaciones.menu');
                    Route::get('archivo', 'archivo')->name('solicitud-vacaciones.archivo');
                    Route::get('aprobacion', 'aprobacion')->name('solicitud-vacaciones.aprobacion');
                    Route::get('{id}/respuesta', 'respuesta')->name('solicitud-vacaciones.respuesta');
                    Route::get('{id}/show', 'show')->name('solicitud-vacaciones.show');
                    Route::post('destroy', 'destroy')->name('solicitud-vacaciones.destroy');
                });

                Route::resource('/', SolicitudVacacionesController::class)->names([
                    'create' => 'solicitud-vacaciones.create',
                    'store' => 'solicitud-vacaciones.store',
                    'edit' => 'solicitud-vacaciones.edit',
                    'update' => 'solicitud-vacaciones.update',
                    'index' => 'solicitud-vacaciones.index',
                ])->except(['show', 'destroy']);
            });

            Route::post('solicitudAprobacionVacacion/updateAprobacion/{id}', 'SolicitudVacacionesController@updateAprobacion')->name('solicitud-vacaciones.updateAprobacion');

            Route::prefix('solicitud-dayoff')->group(function () {
                Route::controller(SolicitudDayOffController::class)->group(function () {
                    Route::get('{id}/showArchivo', 'showArchivo')->name('solicitud-dayoff.showArchivo');
                    Route::get('{id}/vistaGlobal', 'showVistaGlobal')->name('solicitud-dayoff.vistaGlobal');
                    Route::get('menu', 'aprobacionMenu')->name('solicitud-dayoff.menu');
                    Route::get('archivo', 'archivo')->name('solicitud-dayoff.archivo');
                    Route::get('aprobacion', 'aprobacion')->name('solicitud-dayoff.aprobacion');
                    Route::get('{id}/respuesta', 'respuesta')->name('solicitud-dayoff.respuesta');
                    Route::get('{id}/show', 'show')->name('solicitud-dayoff.show');
                    Route::post('destroy', 'destroy')->name('solicitud-dayoff.destroy');
                });

                Route::resource('/', SolicitudDayOffController::class)->names([
                    'create' => 'solicitud-dayoff.create',
                    'store' => 'solicitud-dayoff.store',
                    'edit' => 'solicitud-dayoff.edit',
                    'update' => 'solicitud-dayoff.update',
                    'index' => 'solicitud-dayoff.index',
                ])->except(['show', 'destroy']);
            });

            Route::post('solicitudAprobacionDayOff/updateAprobacion/{id}', 'SolicitudDayOffController@updateAprobacion')->name('solicitud-DayOff.updateAprobacion');

            // Rutas para Solicitud de Permiso Goce Sueldo
            Route::prefix('solicitud-permiso-goce-sueldo')->controller(SolicitudPermisoGoceSueldoController::class)->group(function () {
                Route::get('{id}/showArchivo', 'showArchivo')->name('solicitud-permiso-goce-sueldo.showArchivo');
                Route::get('{id}/vistaGlobal', 'showVistaGlobal')->name('solicitud-permiso-goce-sueldo.vistaGlobal');
                Route::get('menu', 'aprobacionMenu')->name('solicitud-permiso-goce-sueldo.menu');
                Route::get('archivo', 'archivo')->name('solicitud-permiso-goce-sueldo.archivo');
                Route::get('aprobacion', 'aprobacion')->name('solicitud-permiso-goce-sueldo.aprobacion');
                Route::get('{id}/respuesta', 'respuesta')->name('solicitud-permiso-goce-sueldo.respuesta');
                Route::get('{id}/show', 'show')->name('solicitud-permiso-goce-sueldo.show');
                Route::post('destroy', 'destroy')->name('solicitud-permiso-goce-sueldo.destroy');
            });

            // Rutas de recursos para Solicitud de Permiso Goce Sueldo
            Route::resource('solicitud-permiso-goce-sueldo', SolicitudPermisoGoceSueldoController::class)->names([
                'create' => 'solicitud-permiso-goce-sueldo.create',
                'store' => 'solicitud-permiso-goce-sueldo.store',
                'show' => 'solicitud-permiso-goce-sueldo.show',
                'edit' => 'solicitud-permiso-goce-sueldo.edit',
                'update' => 'solicitud-permiso-goce-sueldo.update',
                'destroy' => 'solicitud-permiso-goce-sueldo.destroy',
                'index' => 'solicitud-permiso-goce-sueldo.index',
            ])->except(['show', 'destroy']);

            // Rutas de recursos para Incidentes Vacaciones
            Route::resource('incidentes-vacaciones', IncidentesVacacionesController::class)->names([
                'create' => 'incidentes-vacaciones.create',
                'store' => 'incidentes-vacaciones.store',
                'show' => 'incidentes-vacaciones.show',
                'edit' => 'incidentes-vacaciones.edit',
                'update' => 'incidentes-vacaciones.update',
                'destroy' => 'incidentes-vacaciones.destroy',
            ]);

            Route::resource('incidentes-dayoff', IncidentesDayOffController::class)->names([
                'index' => 'incidentes-dayoff.index',
                'create' => 'incidentes-dayoff.create',
                'store' => 'incidentes-dayoff.store',
                'show' => 'incidentes-dayoff.show',
                'edit' => 'incidentes-dayoff.edit',
                'update' => 'incidentes-dayoff.update',
                'destroy' => 'incidentes-dayoff.destroy',
            ]);

            // Rutas para Tabla Calendario
            Route::prefix('recursos-humanos/calendario')->controller(TablaCalendarioController::class)->group(function () {
                Route::get('index', 'index')->name('tabla-calendario.index');

                Route::get('create', 'create')->name('tabla-calendario.create');
                Route::post('/', 'store')->name('tabla-calendario.store');
                Route::get('{id}', 'show')->name('tabla-calendario.show');
                Route::get('{id}/edit', 'edit')->name('tabla-calendario.edit');
                Route::put('{id}', 'update')->name('tabla-calendario.update');
                Route::delete('{id}', 'destroy')->name('tabla-calendario.destroy');
            });

            Route::get('tabla-calendario/index', [TablaCalendarioController::class, 'index'])->name('tabla-calendario.index');

            Route::resource('recursos-humanos/calendario', TablaCalendarioController::class)->names([
                'create' => 'tabla-calendario.create',
                'store' => 'tabla-calendario.store',
                'show' => 'tabla-calendario.show',
                'edit' => 'tabla-calendario.edit',
                'update' => 'tabla-calendario.update',
                'destroy' => 'tabla-calendario.destroy',
            ]);

            // Route::get('calendario-oficial/index', 'CalendarioOficialController@index')->name('calendario-oficial.index');
            Route::resource('recursos-humanos/calendario-oficial', CalendarioOficialController::class)->names([
                'create' => 'calendario-oficial.create',
                'store' => 'calendario-oficial.store',
                'show' => 'calendario-oficial.show',
                'edit' => 'calendario-oficial.edit',
                'update' => 'calendario-oficial.update',
                'destroy' => 'calendario-oficial.destroy',
            ]);

            // Agrupar rutas de 'recursos-humanos'
            Route::prefix('recursos-humanos')->group(function () {
                //Tipos de contratos
                Route::resource('tipos-contratos-empleados', 'RH\TipoContratoEmpleadoController');
                Route::resource('entidades-crediticias', 'RH\EntidadCrediticiaController');
                Route::resource('dependientes-empleados', 'RH\DependientesEconomicosEmpleadosController');
                Route::resource('contactos-emergencia-empleados', 'RH\ContactosEmergenciaEmpleadoController');
                Route::resource('beneficiarios-empleados', 'RH\BeneficiariosEmpleadoController');

                // Evaluaciones 360
                Route::get('evaluacion-360', 'RH\Evaluacion360Controller@index')->name('rh-evaluacion360.index');
                Route::post('evaluacion-360/normalizar/{evaluacion}/resultados', 'RH\EV360EvaluacionesController@normalizarResultados')->name('ev360-normalizar-resultados');
                Route::get('evaluacion-360', 'RH\EV360EvaluacionesController@index')->name('rh-evaluacion360.index');

                //Consulta de evaluación
                Route::get('evaluacion-360/{evaluacion}/{evaluado}/mis-evaluaciones', 'RH\EV360EvaluacionesController@misEvaluaciones')->name('ev360-evaluaciones.misEvaluaciones');
                Route::get('evaluacion-360/{evaluacion}/{evaluador}/evaluaciones-mi-equipo', 'RH\EV360EvaluacionesController@evaluacionesDeMiEquipo')->name('ev360-evaluaciones.evaluacionesDeMiEquipo');

                Route::post('evaluacion-360/{evaluacion}/recordatorio', 'RH\EV360EvaluacionesController@enviarCorreoAEvaluadores')->name('ev360-evaluaciones.recordatorio');
                Route::post('evaluacion-360/invitacion-reunion-evaluacion', 'RH\EV360EvaluacionesController@enviarInvitacionDeEvaluacion')->name('ev360-evaluaciones.invitacion-reunion-evaluacion');

                Route::get('evaluacion-360/{empleado}/evaluaciones-del-empleado', 'RH\EV360EvaluacionesController@evaluacionesDelEmpleado')->name('ev360-evaluaciones.evaluacionesDelEmpleado');
                Route::get('evaluacion-360/evaluaciones/{evaluacion}/participantes', 'RH\EV360EvaluacionesController@getParticipantes')->name('ev360-evaluaciones.getParticipantes');
                Route::post('evaluacion-360/evaluaciones/{evaluacion}/competencia', 'RH\EV360EvaluacionesController@relatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.relatedCompetenciaWithEvaluacion');
                Route::post('evaluacion-360/evaluaciones/{evaluacion}/competencia/delete', 'RH\EV360EvaluacionesController@deleteRelatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.deleteRelatedCompetenciaWithEvaluacion');
                Route::post('evaluacion-360/evaluaciones/{evaluacion}/objetivo', 'RH\EV360EvaluacionesController@relatedObjetivoWithEvaluacion')->name('ev360-evaluaciones.relatedObjetivoWithEvaluacion');
                Route::post('evaluacion-360/evaluaciones/{evaluacion}/objetivo/delete', 'RH\EV360EvaluacionesController@deleteRelatedCompetenciaWithEvaluacion')->name('ev360-evaluaciones.deleteRelatedObjetivoWithEvaluacion');
                Route::get('evaluacion-360/evaluaciones/{evaluacion}/evaluacion', 'RH\EV360EvaluacionesController@evaluacion')->name('ev360-evaluaciones.evaluacion');
                Route::get('evaluacion-360/evaluaciones/{evaluacion}/evaluacion/{evaluado}/{evaluador}', 'RH\EV360EvaluacionesController@contestarCuestionario')->name('ev360-evaluaciones.contestarCuestionario');
                Route::get('evaluacion-360/vista-evaluador/{evaluacion}/evaluacion/{evaluador}/evaluador', 'RH\EV360EvaluacionesController@vistaevaluador')->name('ev360-evaluaciones.vistaevaluador');
                Route::post('evaluacion-360/evaluaciones/{evaluacion}/evaluacion/{evaluado}/{evaluador}/cerrar', 'RH\EV360EvaluacionesController@finalizarEvaluacion')->name('ev360-evaluaciones.finalizarEvaluacion');
                Route::post('evaluacion-360/evaluaciones/objetivo/meta-alcanzada-descripcion/store', 'RH\EV360EvaluacionesController@storeMetaAlcanzadaDescripcion')->name('ev360-evaluaciones.objetivos.storeMetaAlcanzadaDescripcion');
                Route::post('evaluacion-360/evaluaciones/objetivo/meta-alcanzada/store', 'RH\EV360EvaluacionesController@storeMetaAlcanzada')->name('ev360-evaluaciones.objetivos.storeMetaAlcanzada');
                Route::post('evaluacion-360/evaluaciones/objetivo/calificacion-persepcion/store', 'RH\EV360EvaluacionesController@saveCalificacionPersepcion')->name('ev360-evaluaciones.objetivos.saveCalificacionPersepcion');
                Route::post('evaluacion-360/evaluaciones/{evaluacion}/iniciar', 'RH\EV360EvaluacionesController@iniciarEvaluacion')->name('ev360-evaluaciones.iniciarEvaluacion');
                Route::post('evaluacion-360/evaluaciones/{evaluacion}/postergar', 'RH\EV360EvaluacionesController@postergarEvaluacion')->name('ev360-evaluaciones.postergarEvaluacion');
                Route::post('evaluacion-360/evaluaciones/{evaluacion}/cerrar', 'RH\EV360EvaluacionesController@cerrarEvaluacion')->name('ev360-evaluaciones.cerrarEvaluacion');
                Route::post('evaluacion-360/autoevaluacion/competencias/obtener', 'RH\EV360EvaluacionesController@getAutoevaluacionCompetencias')->name('ev360-evaluaciones.autoevaluacion.competencias.get');
                Route::post('evaluacion-360/autoevaluacion/objetivos/obtener', 'RH\EV360EvaluacionesController@getAutoevaluacionObjetivos')->name('ev360-evaluaciones.autoevaluacion.objetivos.get');
                Route::get('evaluacion-360/evaluacion/{evaluacion}/consulta/{evaluado}', 'RH\EV360EvaluacionesController@consultaPorEvaluado')->name('ev360-evaluaciones.autoevaluacion.consulta.evaluado');
                // Route::get('evaluacion-360/evaluacion/{evaluacion}/reactivar/{evaluado}', 'RH\EV360EvaluacionesController@reactivarPorEvaluado')->name('ev360-evaluaciones.reactivarPorEvaluado');
                Route::get('evaluacion-360/evaluacion/{evaluacion}/reactivar/{evaluado}/{evaluador}', 'RH\EV360EvaluacionesController@reactivarPorEvaluador')->name('ev360-evaluaciones.reactivarPorEvaluador');
                Route::post('evaluacion-360/normalizar/objetivo', 'RH\EV360EvaluacionesController@normalizarCalificacionObjetivo')->name('ev360-evaluaciones.normalizar.objetivo');
                Route::get('evaluacion-360/evaluacion/{evaluacion}/resumen', 'RH\EV360EvaluacionesController@resumen')->name('ev360-evaluaciones.consulta.resumen');
                Route::get('evaluacion-360/evaluacion/{evaluacion}/resumen/jefe/{empleado}', 'RH\EV360EvaluacionesController@resumenJefe')->name('ev360-evaluaciones.consulta.resumenJefe');
                Route::get('evaluacion-360/evaluacion/{evaluacion}/resumen/empleado/{empleado}', 'RH\EV360EvaluacionesController@resumenEmpleado')->name('ev360-evaluaciones.consulta.resumenEmpleado');
                Route::resource('evaluacion-360/evaluaciones', 'RH\EV360EvaluacionesController')->names([
                    'index' => 'ev360-evaluaciones.index',
                    'create' => 'ev360-evaluaciones.create',
                    'store' => 'ev360-evaluaciones.store',
                    // 'show' => 'ev360-evaluaciones.show',
                    'edit' => 'ev360-evaluaciones.edit',
                    'update' => 'ev360-evaluaciones.update',
                ]);

                Route::get('evaluacion-360/evaluacion/objetivostmp', 'RH\EV360EvaluacionesController@objetivostemporal')->name('ev360-evaluaciones.objetivostmp');

                Route::post('evaluacion-360/evaluaciones/evaluado-evaluador/remover', 'RH\EvaluadoEvaluadorController@remover')->name('ev360-evaluaciones.evaluadores.remover');
                Route::post('evaluacion-360/evaluaciones/evaluado-evaluador/agregar', 'RH\EvaluadoEvaluadorController@agregar')->name('ev360-evaluaciones.evaluadores.agregar');
                Route::post('evaluacion-360/pdf', 'RH\EV360EvaluacionesController@pdf')->name('ev360-evaluaciones.pdf');

                Route::get(
                    'evaluacion-360/competencias-por-puesto/{puesto}/create',
                    'RH\CompetenciasPorPuestoController@create'
                )->name('ev360-competencias-por-puesto.create');
                Route::get(
                    'evaluacion-360/competencias-por-puesto/{puesto}/obtener',
                    'RH\CompetenciasPorPuestoController@indexCompetenciasPorPuesto'
                )->name('ev360-competencias-por-puesto.indexCompetenciasPorPuesto');
                Route::post(
                    'evaluacion-360/competencias-por-puesto/{puesto}',
                    'RH\CompetenciasPorPuestoController@store'
                )->name('ev360-competencias-por-puesto.store');
                Route::resource('evaluacion-360/competencias-por-puesto', 'RH\CompetenciasPorPuestoController')->names([
                    'index' => 'ev360-competencias-por-puesto.index',
                    'show' => 'ev360-competencias-por-puesto.show',
                    'edit' => 'ev360-competencias-por-puesto.edit',
                    'update' => 'ev360-competencias-por-puesto.update',
                    'destroy' => 'ev360-competencias-por-puesto.destroy',
                ])->except('create', 'store');

                // Route::get('evaluacion-360/competencias/{id}', 'RH\EV360CompetenciasController@show')->name('ev360-competencias.show');

                Route::post('evaluacion-360/competencias/obtener-niveles', 'RH\EV360CompetenciasController@obtenerNiveles')->name('ev360-competencias.obtenerNiveles');

                Route::post('evaluacion-360/competencias/store-redirect', 'RH\EV360CompetenciasController@storeAndRedirect')->name('ev360-competencias.conductas');

                Route::get('evaluacion-360/competencias/{competencia}/conductas', 'RH\EV360CompetenciasController@conductas')->name('ev360-competencias.obtenerConductas');

                Route::post('evaluacion-360/competencias/obtener-ultimo-nivel', 'RH\EV360CompetenciasController@obtenerUltimoNivel')->name('ev360-competencias.obtenerUltimoNivel');

                Route::get('evaluacion-360/competencias/{competencia}/edit', 'RH\EV360CompetenciasController@edit')->name('ev360-competencias.edit');

                Route::get('evaluacion-360/competencias/{competencia}/informacion', 'RH\EV360CompetenciasController@informacionCompetencia')->name('ev360-competencias.informacionCompetencia');

                Route::post('evaluacion-360/competencias/{competencia}/repuesta', 'RH\EV360CompetenciasController@guardarRespuestaCompetencia')->name('ev360-competencias.guardarRespuestaCompetencia');

                Route::resource('evaluacion-360/competencias', 'RH\EV360CompetenciasController')->names([
                    'index' => 'ev360-competencias.index',
                    'create' => 'ev360-competencias.create',
                    'store' => 'ev360-competencias.store',
                    'show' => 'ev360-competencias.show',
                    'update' => 'ev360-competencias.update',
                    'destroy' => 'ev360-competencias.destroy',
                ])->except(['edit']);

                Route::post('evaluacion-360/conductas/store', 'RH\EV360ConductasController@store')->name('ev360-conductas.store');
                Route::get('evaluacion-360/conductas/{conducta}/edit', 'RH\EV360ConductasController@edit')->name('ev360-conductas.edit');
                Route::patch('evaluacion-360/conductas/{conducta}', 'RH\EV360ConductasController@update')->name('ev360-conductas.update');
                Route::delete('evaluacion-360/conductas/{conducta}', 'RH\EV360ConductasController@destroy')->name('ev360-conductas.destroy');

                Route::get('evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@createByEmpleado')->name('ev360-objetivos-empleado.create');
                Route::post('evaluacion-360/{empleado}/objetivos/{objetivo}/aprobar', 'RH\EV360ObjetivosController@aprobarRechazarObjetivo')->name('ev360-objetivos-empleado.aprobarRechazarObjetivo');
                Route::get('evaluacion-360/{empleado}/objetivos/lista', 'RH\EV360ObjetivosController@show')->name('ev360-objetivos-empleado.show');
                Route::get('evaluacion-360/objetivos/{empleado}/copiar', 'RH\EV360ObjetivosController@indexCopiar')->name('ev360-objetivos-empleado.indexCopiar');
                Route::post('evaluacion-360/objetivos/definir-nuevos', 'RH\EV360ObjetivosController@definirNuevosObjetivos')->name('ev360-objetivos-empleado.definir-nuevos');
                Route::post('evaluacion-360/objetivos/copiar', 'RH\EV360ObjetivosController@storeCopiaObjetivos')->name('ev360-objetivos-empleado.storeCopiaObjetivos');
                Route::post('evaluacion-360/{empleado}/objetivos', 'RH\EV360ObjetivosController@storeByEmpleado')->name('ev360-objetivos-empleado.store');

                Route::get('evaluacion-360/objetivos/{objetivo}/edit', 'RH\EV360ObjetivosController@edit')->name('ev360-objetivos-empleado.edit');
                Route::post('evaluacion-360/objetivos/{objetivo}', 'RH\EV360ObjetivosController@destroyByEmpleado')->name('ev360-objetivos-empleado.destroyByEmpleado');
                Route::get('evaluacion-360/{empleado}/objetivos/{objetivo}/editByEmpleado', 'RH\EV360ObjetivosController@editByEmpleado')->name('ev360-objetivos-empleado.editByEmpleado');
                Route::post('evaluacion-360/objetivos/{objetivo}/empleado', 'RH\EV360ObjetivosController@updateByEmpleado')->name('ev360-objetivos-empleado.updateByEmpleado');
                Route::resource('evaluacion-360/objetivos', 'RH\EV360ObjetivosController')->names([
                    'index' => 'ev360-objetivos.index',
                    'destroy' => 'ev360-objetivos.destroy',
                ])->except(['show']);
                Route::resource('evaluacion-360/objetivos/rangos', 'RH\CatalogoRangosObjetivosController');
            });

            Route::get('Perspectiva/edit/{perspectivas}', 'RH\ObejetivoPerspectivaController@edit')->name('perspectivas.edit');
            Route::resource('Perspectiva', 'RH\ObejetivoPerspectivaController', ['except' => ['edit']]);

            Route::get('Metrica/edit/{metrica}', 'RH\ObjetivoUnidadMedidaController@edit')->name('metrica.edit');
            Route::resource('Metrica', 'RH\ObjetivoUnidadMedidaController', ['except' => ['edit']]);

            Route::view('iso27001', 'admin.iso27001.index')->name('iso27001.index');
            Route::view('iso27001/guia', 'admin.iso27001.guia')->name('iso27001.guia');
            Route::view('iso27001/normas-guia', 'admin.iso27001.normas-guia')->name('iso27001.normas-guia');

            // evaluaciones desempeno
            Route::get('recursos-humanos/evaluacion-desempeno/configuracion', 'RH\ObjetivosPeriodoController@config')->name('ev360-objetivos-periodo.config');
            Route::get('recursos-humanos/evaluacion-desempeno/index', 'RH\EvaluacionesDesempenoController@index')->name('rh.evaluaciones-desempeno.index');
            Route::delete('recursos-humanos/evaluacion-desempeno/{evaluacion}/destroy', 'RH\EvaluacionesDesempenoController@destroy')->name('rh.evaluaciones-desempeno.borrar');

            Route::get('recursos-humanos/evaluacion-desempeno/dashboard-general', 'RH\EvaluacionesDesempenoController@dashboardGeneral')->name('rh.evaluaciones-desempeno.dashboard-general');
            Route::get('recursos-humanos/evaluacion-desempeno/{evaluacion}/dashboard-evaluacion', 'RH\EvaluacionesDesempenoController@dashboardEvaluacion')->name('rh.evaluaciones-desempeno.dashboard-evaluacion');
            Route::get('recursos-humanos/evaluacion-desempeno/{evaluacion}/dashboard-evaluacion/{evaluado}/evaluado', 'RH\EvaluacionesDesempenoController@dashboardEvaluado')->name('rh.evaluaciones-desempeno.dashboard-evaluado');
            Route::get('recursos-humanos/evaluacion-desempeno/{evaluacion}/dashboard-area/{area}', 'RH\EvaluacionesDesempenoController@dashboardArea')->name('rh.evaluaciones-desempeno.dashboard-area');
            Route::get('recursos-humanos/evaluacion-desempeno/descargaEvaluacion/{evaluacion}', 'RH\EvaluacionesDesempenoController@descargaEvaluacion')->name('rh.evaluaciones-desempeno.descargaEvaluacion');

            Route::get('recursos-humanos/evaluacion-desempeno/dashboard-global', 'RH\EvaluacionesDesempenoController@dashboardGlobal')->name('rh.evaluaciones-desempeno.dashboard-global');

            Route::get('recursos-humanos/evaluacion-desempeno/config-evaluaciones', 'RH\EvaluacionesDesempenoController@configEvaluaciones')->name('rh.evaluaciones-desempeno.config-evaluaciones');

            Route::get('recursos-humanos/evaluacion-desempeno/create-evaluacion', 'RH\EvaluacionesDesempenoController@createEvaluacion')->name('rh.evaluaciones-desempeno.create-evaluacion');
            Route::get('recursos-humanos/evaluacion-desempeno/edit-borrador/{evaluacion}', 'RH\EvaluacionesDesempenoController@editBorrador')->name('rh.evaluaciones-desempeno.edit-borrador');
            Route::get('recursos-humanos/evaluacion-desempeno/evaluacion/{evaluacion}/cuestionario/{evaluado}/{periodo}', 'RH\EvaluacionesDesempenoController@cuestionarioEvaluacionDesempeno')->name('rh.evaluaciones-desempeno.cuestionario');
            Route::post('recursos-humanos/evaluacion-desempeno/evaluacion/{evaluacion}/storeFirmaEvaluacion/{evaluado}/{periodo}', 'RH\EvaluacionesDesempenoController@storeFirmasEvaluacion')->name('rh.evaluaciones-desempeno.storeFirmasEvaluacion');

            Route::get('recursos-humanos/evaluacion-desempeno/dashboard-personal', 'RH\EvaluacionesDesempenoController@dashboardPersonal')->name('rh.evaluaciones-desempeno.dashboard-personal');

            Route::get('recursos-humanos/evaluacion-desempeno/mis-evaluaciones', 'RH\EvaluacionesDesempenoController@misEvaluaciones')->name('rh.evaluaciones-desempeno.mis-evaluaciones');

            Route::get('recursos-humanos/evaluacion-desempeno/{empleado}/carga-objetivos-empleado', 'RH\EvaluacionesDesempenoController@cargaObjetivosEmpleado')->name('rh.evaluaciones-desempeno.carga-objetivos-empleado');
            Route::get('recursos-humanos/evaluacion-desempeno/{area}/carga-objetivos-area', 'RH\EvaluacionesDesempenoController@cargaObjetivosArea')->name('rh.evaluaciones-desempeno.carga-objetivos-area');
            Route::get('recursos-humanos/evaluacion-desempeno/carga-objetivos-notificacion', 'RH\EvaluacionesDesempenoController@cargarObjetivosNotificacion')->name('rh.evaluaciones-desempeno.carga-objetivos-notificacion');

            Route::get('recursos-humanos/evaluacion-desempeno/objetivos-importar', 'RH\EvaluacionesDesempenoController@objetivosImportar')->name('rh.evaluaciones-desempeno.objetivos-importar');

            Route::get('recursos-humanos/evaluacion-desempeno/{empleado}/objetivos-papelera', 'RH\EvaluacionesDesempenoController@objetivosPapelera')->name('rh.evaluaciones-desempeno.objetivos-papelera');

            Route::get('recursos-humanos/evaluacion-desempeno/objetivos-exportar', 'RH\EvaluacionesDesempenoController@objetivosExportar')->name('rh.evaluaciones-desempeno.objetivos-exportar');

            Route::get('recursos-humanos/evaluacion-desempeno/test', 'RH\EvaluacionesDesempenoController@test');

            // Definición de la ruta
            Route::get('iso27001/inicio-guia', function () {
                // Verifica si la sesión 'visited_first_link' está definida
                if (session()->has('visited_first_link')) {
                    // Si ya se ha visitado el primer enlace, redirige a la tercera ruta
                    return redirect()->route('admin.iso27001.guia');
                } else {
                    // Si es la primera vez que se accede, establece la sesión 'visited_first_link'
                    session(['visited_first_link' => true]);

                    // Retorna la vista del primer enlace
                    return view('admin.iso27001.inicio-guia');
                }
            })->name('iso27001.inicio-guia');

            Route::view('iso27001M', 'admin.iso27001M.index')->name('iso27001M.index');
            Route::view('iso9001', 'admin.iso9001.index')->name('iso9001.index');
            Route::view('contratos', 'admin.contratos.index')->name('contratos.index');
            Route::view('visualizar-logs', 'admin.visualizar-logs.index')->name('visualizar-logs.index');

            Route::get('portal-comunicacion/reportes', 'PortalComunicacionController@reportes')->name('portal-comunicacion.reportes');
            Route::post('portal-comunicacion/cumpleaños/{id}', 'PortalComunicacionController@felicitarCumpleaños')->name('portal-comunicacion.cumples');
            Route::post('portal-comunicacion/cumpleaños-dislike/{id}', 'PortalComunicacionController@felicitarCumpleañosDislike')->name('portal-comunicacion.cumples-dislike');
            Route::post('portal-comunicacion/cumpleaños_comentarios/{id}', 'PortalComunicacionController@felicitarCumplesComentarios')->name('portal-comunicacion.cumples-comentarios');
            Route::post('portal-comunicacion/cumpleaños_comentarios_update/{id}', 'PortalComunicacionController@felicitarCumplesComentariosUpdate')->name('portal-comunicacion.cumples-comentarios-update');
            // Route::resource('portal-comunicacion', 'PortalComunicacionController');
            Route::resource('portal-comunicacion', 'PortalComunicacionController');

            Route::get('plantTrabajoBase/{data}', 'PlanTrabajoBaseController@showTarea');
            Route::post('plantTrabajoBase/listaDataTables', 'PlanTrabajoBaseController@listaDataTables')->name('plantTrabajoBase.listaDataTables');
            Route::post('plantTrabajoBase/bloqueo/mostrar', 'LockedPlanTrabajoController@getLockedToPlanTrabajo')->name('lockedPlan.getLockedToPlanTrabajo');
            Route::post('plantTrabajoBase/bloqueo/quitar', 'LockedPlanTrabajoController@removeLockedToPlanTrabajo')->name('lockedPlan.removeLockedToPlanTrabajo');
            Route::post('plantTrabajoBase/bloqueo/is-locked', 'LockedPlanTrabajoController@isLockedToPlanTrabajo')->name('lockedPlan.isLockedToPlanTrabajo');
            Route::post('plantTrabajoBase/bloqueo/registrar', 'LockedPlanTrabajoController@setLockedToPlanTrabajo')->name('lockedPlan.setLockedToPlanTrabajo');

            Route::get('inicioUsuario/solicitud', [InicioUsuarioController::class, 'solicitud'])->name('solicitud');

            Route::post('inicioUsuario/estado-disponibilidad', [InicioUsuarioController::class, 'cambiarEstadoDisponibilidad'])->name('estado-disponibilidad');

            // TODO Quejas
            Route::get('inicioUsuario/reportes/quejas', [QuejasController::class, 'quejas'])->name('reportes-quejas');
            Route::post('inicioUsuario/reportes/quejas', [QuejasController::class, 'storeQuejas'])->name('reportes-quejas-store');
            Route::get('desk/quejas', 'QuejasController@indexQueja')->name('desk.queja-index');
            Route::post('desk/{quejas}/analisis_queja-update', 'QuejasController@updateAnalisisQuejas')->name('reportes-quejas-update');
            Route::get('desk/{quejas}/quejas-edit', 'QuejasController@editQuejas')->name('desk.quejas-edit');
            Route::post('desk/{quejas}/quejas-update', 'QuejasController@updateQuejas')->name('desk.quejas-update');
            //  ARCHIVADO QUEJAS
            Route::post('desk/{incidente}/archivarQuejas', 'QuejasController@archivadoQueja')->name('desk.queja-archivar');
            Route::get('desk/quejas-archivo', 'QuejasController@archivoQueja')->name('desk.queja-archivo');
            Route::post('desk/quejas-archivo/recuperar/{id}', 'QuejasController@recuperarArchivadoQueja')->name('desk.queja-archivo.recuperar');

            // TODO QuejasCliente
            // Route::post('desk/{quejas}/analisis_queja-update', 'DeskController@updateAnalisisQuejas')->name('desk.analisis_queja-update');
            Route::get('desk/quejas-clientes', [QuejasClienteController::class, 'quejasClientes'])->name('desk.quejas-clientes');
            Route::post('desk/reportes/quejas-clientes', [QuejasClienteController::class, 'storeQuejasClientes'])->name('desk.quejasClientes-store');
            Route::post('desk/{quejas}/analisis_quejaCliente-update', 'QuejasClienteController@updateAnalisisQuejasClientes')->name('desk.analisis_quejasClientes-update');
            Route::post('desk/queja-cliente/validate', 'QuejasClienteController@validateFormQuejaCliente')->name('desk.quejasClientes.validateFormQuejaCliente');
            Route::post('desk/queja-cliente/correo-responsable', 'QuejasClienteController@correoResponsableQuejaCliente')->name('desk.quejas-clientes.correoResponsable');
            Route::post('desk/queja-cliente/correo-solicitar-cierre-queja', 'QuejasClienteController@correoSolicitarCierreQuejaCliente')->name('desk.quejas-clientes.correoSolicitarCierreQueja');
            Route::post('desk/queja-cliente/show', 'QuejasClienteController@showQuejaClientes')->name('desk.quejas-clientes.show');
            Route::get('desk/quejas-clientes/index', 'QuejasClienteController@indexQuejasClientes')->name('desk.quejasClientes-index');
            Route::get('desk/{quejas}/quejas-clientes-edit', 'QuejasClienteController@editQuejasClientes')->name('desk.quejasClientes-edit');
            Route::delete('desk/{quejas}/quejas-clientes-delete', 'QuejasClienteController@destroyQuejasClientes')->name('desk.quejasClientes-destroy');
            Route::post('desk/{quejas}/quejas-clientes-update', 'QuejasClienteController@updateQuejasClientes')->name('desk.quejasClientes-update');
            Route::post('desk/planes/quejas-clientes', 'QuejasClienteController@planesQuejasClientes')->name('desk.planesQuejasClientes');

            //Dashboard Queja Cliente
            Route::get('desk/quejas-clientes/dashboard', 'QuejasClienteController@quejasClientesDashboard')->name('desk.quejasClientes-dashboard');

            //Archivo QuejaCliente
            Route::post('desk/{incidente}/archivarQuejasClientes', 'QuejasClienteController@archivadoQuejaClientes')->name('desk.quejasclientes-archivar');
            Route::get('desk/quejas-cliente-archivo', 'QuejasClienteController@archivoQuejaClientes')->name('desk.quejacliente-archivo');
            Route::post('desk/quejas-clientes-archivo/recuperar/{id}', 'QuejasClienteController@recuperarArchivadoQuejaCliente')->name('desk.quejaClientes-archivo.recuperar');

            // TODO SOBRE Denuncias
            Route::get('inicioUsuario/reportes/denuncias', [DenunciasController::class, 'denuncias'])->name('reportes-denuncias');
            Route::post('inicioUsuario/reportes/denuncias', [DenunciasController::class, 'storeDenuncias'])->name('reportes-denuncias-store');
            Route::get('desk/{denuncias}/denuncias-edit', 'DenunciasController@editDenuncias')->name('desk.denuncias-edit');
            Route::post('desk/{denuncias}/denuncias-update', 'DenunciasController@updateDenuncias')->name('desk.denuncias-update');
            Route::post('desk/{denuncias}/analisis_denuncia-update', 'DenunciasController@updateAnalisisDenuncias')->name('desk.analisis_denuncia-update');

            //flujo de archivado denuncias
            Route::get('desk/denuncias', 'DenunciasController@indexDenuncia')->name('desk.denuncia-index');
            Route::post('desk/{incidente}/archivarDenuncias', 'DenunciasController@archivadoDenuncia')->name('desk.denuncia-archivar');
            Route::get('desk/denuncias-archivo', 'DenunciasController@archivoDenuncia')->name('desk.denuncia-archivo');
            Route::post('desk/denuncias-archivo/recuperar/{id}', 'DenunciasController@recuperarArchivadoDenuncia')->name('desk.denuncia-archivo.recuperar');

            // TODO SOBRE Mejoras
            Route::get('inicioUsuario/reportes/mejoras', [MejorasController::class, 'mejoras'])->name('reportes-mejoras');
            Route::post('inicioUsuario/reportes/mejoras', [MejorasController::class, 'storeMejoras'])->name('reportes-mejoras-store');
            Route::post('desk/{mejoras}/analisis_mejora-update', 'MejorasController@updateAnalisisMejoras')->name('desk.analisis_mejora-update');
            Route::get('desk/{mejoras}/mejoras-edit', 'MejorasController@editMejoras')->name('desk.mejoras-edit');
            Route::post('desk/{mejoras}/mejoras-update', 'MejorasController@updateMejoras')->name('desk.mejoras-update');

            //flujo de archivado mejoras
            Route::get('desk/mejoras', 'MejorasController@indexMejora')->name('desk.mejora-index');
            Route::post('desk/{incidente}/archivarMejoras', 'MejorasController@archivadoMejora')->name('desk.mejora-archivar');
            Route::get('desk/mejoras-archivo', 'MejorasController@archivoMejora')->name('desk.mejora-archivo');
            Route::post('desk/mejoras-archivo/recuperar/{id}', 'MejorasController@recuperarArchivadoMejora')->name('desk.mejora-archivo.recuperar');

            // TODO SOBRE Sugerencias
            Route::get('inicioUsuario/reportes/sugerencias', [SugerenciasController::class, 'sugerencias'])->name('reportes-sugerencias');
            Route::post('inicioUsuario/reportes/sugerencias', [SugerenciasController::class, 'storeSugerencias'])->name('reportes-sugerencias-store');
            Route::post('desk/{sugerencias}/analisis_sugerencia-update', 'SugerenciasController@updateAnalisisSugerencias')->name('desk.analisis_sugerencia-update');
            Route::get('desk/{sugerencias}/sugerencias-edit', 'SugerenciasController@editSugerencias')->name('desk.sugerencias-edit');
            Route::post('desk/{sugerencias}/sugerencias-update', 'SugerenciasController@updateSugerencias')->name('desk.sugerencias-update');
            Route::get('desk/sugerencias', 'SugerenciasController@indexSugerencia')->name('desk.sugerencia-index');
            //flujo de archivado Sugerencias
            Route::post('desk/{incidente}/archivarSugerencia', 'SugerenciasController@archivadoSugerencia')->name('desk.sugerencia-archivar');
            Route::get('desk/sugerencia-archivo', 'SugerenciasController@archivoSugerencia')->name('desk.sugerencia-archivo');
            Route::post('desk/sugerencia-archivo/recuperar/{id}', 'SugerenciasController@recuperarArchivadoSugerencia')->name('desk.sugerencia-archivo.recuperar');

            // TODO SOBRE Seguridad
            Route::get('inicioUsuario/reportes/seguridad', [SeguridadController::class, 'seguridad'])->name('reportes-seguridad');
            Route::post('inicioUsuario/reportes/seguridad/media', [SeguridadController::class, 'storeMedia'])->name('reportes-seguridad.storeMedia');
            Route::post('inicioUsuario/reportes/seguridad', [SeguridadController::class, 'storeSeguridad'])->name('reportes-seguridad-store');
            Route::post('desk/{seguridad}/analisis_seguridad-update', 'SeguridadController@updateAnalisisSeguridad')->name('desk.analisis_seguridad-update');
            Route::get('desk/{seguridad}/seguridad-edit', 'SeguridadController@editSeguridad')->name('desk.seguridad-edit');
            Route::post('desk/{seguridad}/seguridad-update', 'SeguridadController@updateSeguridad')->name('desk.seguridad-update');
            //flujo de archivado seguridad
            Route::post('desk/{incidente}/archivar', 'SeguridadController@archivadoSeguridad')->name('desk.seguridad-archivar');
            Route::get('desk/seguridad-archivo', 'SeguridadController@archivoSeguridad')->name('desk.seguridad-archivo');
            Route::post('desk/seguridad-archivo/recuperar/{id}', 'SeguridadController@recuperarArchivadoSeguridad')->name('desk.seguridad-archivo.recuperar');
            Route::get('desk/seguridad', 'SeguridadController@indexSeguridad')->name('desk.seguridad-index');

            // TODO SOBRE Riesgos
            Route::get('inicioUsuario/reportes/riesgos', [RiesgosController::class, 'riesgos'])->name('reportes-riesgos');
            Route::post('inicioUsuario/reportes/riesgos', [RiesgosController::class, 'storeRiesgos'])->name('reportes-riesgos-store');
            Route::post('desk/{riesgos}/analisis_riesgo-update', 'RiesgosController@updateAnalisisReisgos')->name('desk.analisis_riesgo-update');
            Route::get('desk/{riesgos}/riesgos-edit', 'RiesgosController@editRiesgos')->name('desk.riesgos-edit');
            Route::post('desk/{riesgos}/riesgos-update', 'RiesgosController@updateRiesgos')->name('desk.riesgos-update');
            //flujo de archivado riesgos
            Route::post('desk/{incidente}/archivarRiesgos', 'RiesgosController@archivadoRiesgo')->name('desk.riesgo-archivar');
            Route::get('desk/riesgos-archivo', 'RiesgosController@archivoRiesgo')->name('desk.riesgo-archivo');
            Route::post('desk/riesgos-archivo/recuperar/{id}', 'RiesgosController@recuperarArchivadoRiesgo')->name('desk.riesgo-archivo.recuperar');
            Route::get('desk/riesgos', 'RiesgosController@indexRiesgo')->name('desk.riesgo-index');

            //
            Route::post('inicioUsuario/capacitaciones/archivar/{id}', [InicioUsuarioController::class, 'archivarCapacitacion'])->name('inicio-Usuario.capacitaciones.archivar');
            Route::post('inicioUsuario/capacitaciones/recuperar/{id}', [InicioUsuarioController::class, 'recuperarCapacitacion'])->name('inicio-Usuario.capacitaciones.recuperar');
            Route::get('inicioUsuario/capacitaciones/archivo', [InicioUsuarioController::class, 'archivoCapacitacion'])->name('inicio-Usuario.capacitaciones.archivo');

            Route::post('inicioUsuario/aprobacion/archivar/{id}', [InicioUsuarioController::class, 'archivarAprobacion'])->name('inicio-Usuario.aprobacion.archivar');
            Route::post('inicioUsuario/aprobacion/recuperar/{id}', [InicioUsuarioController::class, 'recuperarAprobacion'])->name('inicio-Usuario.aprobacion.recuperar');
            Route::get('inicioUsuario/aprobacion/archivo', [InicioUsuarioController::class, 'archivoAprobacion'])->name('inicio-Usuario.aprobacion.archivo');

            Route::post('inicioUsuario/actividades/archivar', [InicioUsuarioController::class, 'archivarActividades'])->name('inicio-Usuario.actividades.archivar');
            Route::post('inicioUsuario/actividades/cambiar-estatus', [InicioUsuarioController::class, 'cambiarEstatusActividad'])->name('inicio-Usuario.actividades.cambiarEstatusActividad');
            Route::post('inicioUsuario/actividades/recuperar', [InicioUsuarioController::class, 'recuperarActividades'])->name('inicio-Usuario.actividades.recuperar');
            Route::get('inicioUsuario/actividades/archivo', [InicioUsuarioController::class, 'archivoActividades'])->name('inicio-Usuario.acctividades.archivo');

            Route::get('inicioUsuario/perfil-puesto', [InicioUsuarioController::class, 'perfilPuesto'])->name('inicio-Usuario.perfil-puesto');

            Route::get('inicioUsuario/expediente/{id_empleado}', [InicioUsuarioController::class, 'expediente'])->name('inicio-Usuario.expediente');

            Route::post('inicioUsuario/expediente/update', [InicioUsuarioController::class, 'expedienteUpdate'])->name('inicio-Usuario.expediente-update');
            Route::post('inicioUsuario/expediente/{id_empleado}/getListaDocumentos', 'EmpleadoController@getListaDocumentos')->name('inicio-Usuario.expediente-getListaDocumentos');

            Route::post('inicioUsuario/versioniso', [InicioUsuarioController::class, 'updateVersionIso'])->name('inicio-Usuario.updateVersionIso');

            Route::get('desk', 'DeskController@index')->name('desk.index');

            // Route::post('desk/{seguridad}/analisis_seguridad-update', 'SeguridadController@updateAnalisisSeguridad')->name('desk.analisis_seguridad-update');
            // Route::post('desk/{riesgos}/analisis_riesgo-update', 'RiesgosController@updateAnalisisReisgos')->name('desk.analisis_riesgo-update');
            // Route::post('desk/{mejoras}/analisis_mejora-update', 'MejorasController@updateAnalisisMejoras')->name('desk.analisis_mejora-update');
            // // Route::post('desk/{quejas}/analisis_queja-update', 'DeskController@updateAnalisisQuejas')->name('desk.analisis_queja-update');
            // Route::post('desk/{quejas}/analisis_quejaCliente-update', 'QuejasClienteController@updateAnalisisQuejasClientes')->name('desk.analisis_quejasClientes-update');
            // Route::post('desk/queja-cliente/validate', 'QuejasClienteController@validateFormQuejaCliente')->name('desk.quejasClientes.validateFormQuejaCliente');
            // Route::post('desk/queja-cliente/correo-responsable', 'QuejasClienteController@correoResponsableQuejaCliente')->name('desk.quejas-clientes.correoResponsable');
            // Route::post('desk/queja-cliente/correo-solicitar-cierre-queja', 'QuejasClienteController@correoSolicitarCierreQuejaCliente')->name('desk.quejas-clientes.correoSolicitarCierreQueja');
            // Route::post('desk/queja-cliente/show', 'QuejasClienteController@showQuejaClientes')->name('desk.quejas-clientes.show');
            // Route::post('desk/{denuncias}/analisis_denuncia-update', 'DenunciasController@updateAnalisisDenuncias')->name('desk.analisis_denuncia-update');
            // Route::post('desk/{sugerencias}/analisis_sugerencia-update', 'SugerenciasController@updateAnalisisSugerencias')->name('desk.analisis_sugerencia-update');

            // Route::get('desk/{seguridad}/seguridad-edit', 'SeguridadController@editSeguridad')->name('desk.seguridad-edit');
            // Route::post('desk/{seguridad}/seguridad-update', 'SeguridadController@updateSeguridad')->name('desk.seguridad-update');
            // //flujo de archivado seguridad
            // Route::post('desk/{incidente}/archivar', 'SeguridadController@archivadoSeguridad')->name('desk.seguridad-archivar');
            // Route::get('desk/seguridad-archivo', 'SeguridadController@archivoSeguridad')->name('desk.seguridad-archivo');
            // Route::post('desk/seguridad-archivo/recuperar/{id}', 'SeguridadController@recuperarArchivadoSeguridad')->name('desk.seguridad-archivo.recuperar');
            // Route::get('desk/seguridad', 'SeguridadController@indexSeguridad')->name('desk.seguridad-index');
            //
            // Route::get('desk/{riesgos}/riesgos-edit', 'RiesgosController@editRiesgos')->name('desk.riesgos-edit');
            // Route::post('desk/{riesgos}/riesgos-update', 'RiesgosController@updateRiesgos')->name('desk.riesgos-update');
            // //flujo de archivado riesgos
            // Route::post('desk/{incidente}/archivarRiesgos', 'RiesgosController@archivadoRiesgo')->name('desk.riesgo-archivar');
            // Route::get('desk/riesgos-archivo', 'RiesgosController@archivoRiesgo')->name('desk.riesgo-archivo');
            // Route::post('desk/riesgos-archivo/recuperar/{id}', 'RiesgosController@recuperarArchivadoRiesgo')->name('desk.riesgo-archivo.recuperar');
            // Route::get('desk/riesgos', 'RiesgosController@indexRiesgo')->name('desk.riesgo-index');
            //

            // Route::get('desk/{quejas}/quejas-edit', 'QuejasController@editQuejas')->name('desk.quejas-edit');
            // Route::post('desk/{quejas}/quejas-update', 'QuejasController@updateQuejas')->name('desk.quejas-update');
            //flujo de archivado quejas
            // Route::post('desk/{incidente}/archivarQuejas', 'QuejasController@archivadoQueja')->name('desk.queja-archivar');
            // Route::get('desk/quejas-archivo', 'QuejasController@archivoQueja')->name('desk.queja-archivo');
            // Route::post('desk/quejas-archivo/recuperar/{id}', 'QuejasController@recuperarArchivadoQueja')->name('desk.queja-archivo.recuperar');
            // Route::get('desk/quejas', 'QuejasController@indexQueja')->name('desk.queja-index');
            //

            //Archivo QuejaCliente
            // Route::post('desk/{incidente}/archivarQuejasClientes', 'QuejasClienteController@archivadoQuejaClientes')->name('desk.quejasclientes-archivar');
            // Route::get('desk/quejas-archivo', 'QuejasClienteController@archivoQuejaClientes')->name('desk.quejacliente-archivo');
            // Route::post('desk/quejas-clientes-archivo/recuperar/{id}', 'QuejasClienteController@recuperarArchivadoQuejaCliente')->name('desk.quejaClientes-archivo.recuperar');

            // //flujo de archivado Sugerencias
            // Route::post('desk/{incidente}/archivarSugerencia', 'SugerenciasController@archivadoSugerencia')->name('desk.sugerencia-archivar');
            // Route::get('desk/sugerencia-archivo', 'SugerenciasController@archivoSugerencia')->name('desk.sugerencia-archivo');
            // Route::post('desk/sugerencia-archivo/recuperar/{id}', 'SugerenciasController@recuperarArchivadoSugerencia')->name('desk.sugerencia-archivo.recuperar');
            // Route::get('desk/sugerencias', 'SugerenciasController@indexSugerencia')->name('desk.sugerencia-index');

            // Route::get('desk/{denuncias}/denuncias-edit', 'DenunciasController@editDenuncias')->name('desk.denuncias-edit');
            // Route::post('desk/{denuncias}/denuncias-update', 'DenunciasController@updateDenuncias')->name('desk.denuncias-update');

            // //flujo de archivado denuncias
            // Route::get('desk/denuncias', 'DenunciasController@indexDenuncia')->name('desk.denuncia-index');
            // Route::post('desk/{incidente}/archivarDenuncias', 'DenunciasController@archivadoDenuncia')->name('desk.denuncia-archivar');
            // Route::get('desk/denuncias-archivo', 'DenunciasController@archivoDenuncia')->name('desk.denuncia-archivo');
            // Route::post('desk/denuncias-archivo/recuperar/{id}', 'DenunciasController@recuperarArchivadoDenuncia')->name('desk.denuncia-archivo.recuperar');
            //

            // Route::get('desk/{mejoras}/mejoras-edit', 'MejorasController@editMejoras')->name('desk.mejoras-edit');
            // Route::post('desk/{mejoras}/mejoras-update', 'MejorasController@updateMejoras')->name('desk.mejoras-update');

            // //flujo de archivado mejoras

            // Route::get('desk/mejoras', 'MejorasController@indexMejora')->name('desk.mejora-index');
            // Route::post('desk/{incidente}/archivarMejoras', 'MejorasController@archivadoMejora')->name('desk.mejora-archivar');
            // Route::get('desk/mejoras-archivo', 'MejorasController@archivoMejora')->name('desk.mejora-archivo');
            // Route::post('desk/mejoras-archivo/recuperar/{id}', 'MejorasController@recuperarArchivadoMejora')->name('desk.mejora-archivo.recuperar');

            //
            // Route::get('desk/{sugerencias}/sugerencias-edit', 'SugerenciasController@editSugerencias')->name('desk.sugerencias-edit');
            // Route::post('desk/{sugerencias}/sugerencias-update', 'SugerenciasController@updateSugerencias')->name('desk.sugerencias-update');

            //Quejas clientes
            // Route::get('desk/quejas-clientes', 'QuejasClienteController@quejasClientes')->name('desk.quejas-clientes');
            // Route::get('desk/quejas-clientes/index', 'QuejasClienteController@indexQuejasClientes')->name('desk.quejasClientes-index');
            // Route::post('desk/reportes/quejas-clientes', 'QuejasClienteController@storeQuejasClientes')->name('desk.quejasClientes-store');
            // Route::get('desk/{quejas}/quejas-clientes-edit', 'QuejasClienteController@editQuejasClientes')->name('desk.quejasClientes-edit');
            // Route::delete('desk/{quejas}/quejas-clientes-delete', 'QuejasClienteController@destroyQuejasClientes')->name('desk.quejasClientes-destroy');
            // Route::post('desk/{quejas}/quejas-clientes-update', 'QuejasClienteController@updateQuejasClientes')->name('desk.quejasClientes-update');
            // Route::post('desk/planes/quejas-clientes', 'QuejasClienteController@planesQuejasClientes')->name('desk.planesQuejasClientes');

            // //Dashboard Queja Cliente

            // Route::get('desk/quejas-clientes/dashboard', 'QuejasClienteController@quejasClientesDashboard')->name('desk.quejasClientes-dashboard');

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
            Route::get('dashboard-auditorias-sgi', 'DashboardAuditoriasSGIController@index')->name('dashboard_auditorias');
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
            Route::get('evaluacion-analisis-brechas-2022/{id}', 'FormularioAnalisisBrechasController@index')->name('formulario_brecha');

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
                Route::get('analisis/{id}/dashboard', 'FormularioAnalisisBrechasController@index')->name('formulario');
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
            // Route::post('procesos/{id}', 'ProcesoController@destroy')->name('procesos.destroy');
            Route::post('selectIndicador', 'ProcesoController@AjaxRequestIndicador')->name('selectIndicador');
            Route::post('selectRiesgos', 'ProcesoController@AjaxRequestRiesgos')->name('selectRiesgos');

            //macroprocesos
            Route::resource('macroprocesos', 'MacroprocesoController');

            // Timesheet
            Route::get('timesheet/', 'TimesheetController@index')->name('timesheet');
            Route::get('timesheet/mis-registros/{estatus?}', 'TimesheetController@misRegistros')->name('timesheet-mis-registros');
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
            Route::post('timesheet/pdf/{id}', 'TimesheetController@pdf')->name('timesheet.pdf');

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
            Route::get('timesheet/proyectos/reporte/financiero', 'TimesheetController@reportesFinanciero')->name('timesheet-reportes-financiero');

            Route::get('timesheet/proyecto-empleados/{proyecto_id}', 'TimesheetController@proyectosEmpleados')->name('timesheet-proyecto-empleados');
            Route::get('timesheet/proyecto-externos/{proyecto_id}', 'TimesheetController@proyectosExternos')->name('timesheet-proyecto-externos');

            Route::get('timesheet/clientes', 'TimesheetController@clientes')->name('timesheet-clientes');
            Route::get('timesheet/clientes/create', 'TimesheetController@clientesCreate')->name('timesheet-clientes-create');
            Route::get('timesheet/clientes/edit/{id}', 'TimesheetController@clientesEdit')->name('timesheet-clientes-edit');
            Route::post('timesheet/clientes/store', 'TimesheetController@clientesStore')->name('timesheet-clientes-store');
            Route::post('timesheet/clientes/update/{id}', 'TimesheetController@clientesUpdate')->name('timesheet-clientes-update');
            Route::post('timesheet/clientes/delete/{id}', 'TimesheetController@clientesDelete')->name('timesheet-cliente-delete');
            Route::post('timesheet/clientes/pdf', 'TimesheetController@pdfClientes')->name('timesheet-cliente.pdf');

            Route::get('timesheet/reportes', 'TimesheetController@reportes')->name('timesheet-reportes');
            Route::get('timesheet/dashboard', 'TimesheetController@dashboard')->name('timesheet-dashboard');

            Route::post('timesheet/create/obtenerTareas', 'TimesheetController@obtenerTareas')->name('timesheet-obtener-tareas');

            Route::post('timesheet/creacionContratoProyecto', 'TimesheetController@creacionContratoProyecto')->name('timesheet.creacionContratoProyecto');

            Route::resource('timesheet', 'TimesheetController')->except(['create', 'index', 'edit']);

            //Competencia Tipo

            Route::get('Tipo/edit/{tipo}', 'RH\TipoCompetenciaController@edit')->name('tipo.edit');
            Route::resource('Tipo', 'RH\TipoCompetenciaController', ['except' => ['edit']]);

            Route::get('organigrama/exportar', 'OrganigramaController@exportTo')->name('organigrama.exportar');
            Route::get('organigrama', 'OrganigramaController@index')->name('organigrama.index');

            //Directorio

            Route::get('directorio', 'DirectorioEmpleadosController@index')->name('directorio.index');

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
            Route::get('entendimiento-organizacions-foda-revision/{id}', 'EntendimientoOrganizacionController@revision')->name('foda.revision');
            Route::post('entendimiento-organizacions-foda-revision/{id}/aprobado', 'EntendimientoOrganizacionController@aprobado')->name('foda-organizacions.aprobado');
            Route::post('entendimiento-organizacions-foda-revision/{id}/rechazado', 'EntendimientoOrganizacionController@rechazado')->name('foda-organizacions.rechazado');
            Route::post('entendimiento-organizacions/{id}/solicitud-aprobacion', 'EntendimientoOrganizacionController@solicitudAprobacion')->name('foda-organizacions.solicitudAprobacion');

            Route::delete('partes-interesadas/destroy', 'PartesInteresadasController@massDestroy')->name('partes-interesadas.massDestroy');
            Route::get('partes-interesadas/{id}/edit', 'PartesInteresadasController@edit')->name('partes-interesadas.edit');
            Route::post('partes-interesadas/{id}/update', 'PartesInteresadasController@update')->name('partes-interesadas.update');
            Route::resource('partes-interesadas', 'PartesInteresadasController')->except(['edit', 'update']);

            //Configuración Soporte
            Route::delete('configurar-soporte/destroy', 'ConfigurarSoporteController@massDestroy')->name('configurar-soporte.massDestroy');
            Route::resource('configurar-soporte', 'ConfigurarSoporteController');
            Route::get('getgetEmployeeData', 'ConfigurarSoporteController@getgetEmployeeData')->name('getgetEmployeeData');
            Route::get('soporte', 'ConfigurarSoporteController@visualizarSoporte')->name('soporte');
            Route::view('actualizaciones', 'actualizaciones')->name('actualizaciones');

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
            Route::post('alcance-sgsis/pdf/show/{id}', 'AlcanceSgsiController@pdfShow')->name('alcance-sgsis-show.pdf');
            Route::get('alcance-sgsis-revision/{id}', 'AlcanceSgsiController@revision')->name('alcance-sgsis.revision');
            Route::post('alcance-sgsis/{id}/aprobado', 'AlcanceSgsiController@aprobado')->name('alcance-sgsis.aprobado');
            Route::post('alcance-sgsis/{id}/rechazado', 'AlcanceSgsiController@rechazado')->name('alcance-sgsis.rechazado');

            // Comiteseguridads
            Route::delete('comiteseguridads/destroy', 'ComiteseguridadController@massDestroy')->name('comiteseguridads.massDestroy');
            Route::get('comiteseguridads/visualizacion', 'ComiteseguridadController@visualizacion')->name('comiteseguridads.visualizacion');
            Route::get('comiteseguridads/{comiteseguridad}/edit', 'ComiteseguridadController@edit')->name('comiteseguridads.edit');
            Route::post('admin/comiteseguridads/saveMember/{id_comite}', 'ComiteseguridadController@saveMember')->name('comiteseguridads.saveMember');
            Route::get('comiteseguridads/deleteMember/{id}', 'ComiteseguridadController@deleteMember')->name('comiteseguridads.deleteMember');
            Route::resource('comiteseguridads', 'ComiteseguridadController')->except('edit');

            // Minutasaltadireccions
            Route::get('minutasaltadireccions/descargar/{name}', 'MinutasaltadireccionController@DescargaFormato')->name('minutasaltadireccions.descargar');
            Route::get('minutasaltadireccions/{minuta}/minuta-documento', 'MinutasaltadireccionController@renderViewDocument')->name('documentos.renderViewMinuta');
            Route::get('minutasaltadireccions/{minuta}/historial-revisiones', 'MinutasaltadireccionController@renderHistoryReview')->name('documentos.renderHistoryReviewMinuta');
            Route::get('minutasaltadireccions/planes-de-accion/create/{id}', 'MinutasaltadireccionController@createPlanAccion')->name('minutasaltadireccions.createPlanAccion');
            // Route::get('minutasaltadireccions/{id}/edit', 'MinutasaltadireccionController@edit')->name('minutasaltadireccions.edit');
            Route::patch('minutasaltadireccions/{minuta}/update-and-review', 'MinutasaltadireccionController@updateAndReview')->name('minutasaltadireccions.updateAndReview');
            Route::post('minutasaltadireccions/planes-de-accion/store/{id}', 'MinutasaltadireccionController@storePlanAccion')->name('minutasaltadireccions.storePlanAccion');
            Route::delete('minutasaltadireccions/destroy', 'MinutasaltadireccionController@massDestroy')->name('minutasaltadireccions.massDestroy');
            Route::post('minutasaltadireccions/media', 'MinutasaltadireccionController@storeMedia')->name('minutasaltadireccions.storeMedia');
            Route::post('minutasaltadireccions/ckmedia', 'MinutasaltadireccionController@storeCKEditorImages')->name('minutasaltadireccions.storeCKEditorImages');
            // Route::get('minutasaltadireccions/{id}/show', 'MinutasaltadireccionController@show')->name('minutasaltadireccions.show');
            Route::get('minutasaltadireccions-revision/{id}', 'MinutasaltadireccionController@revision')->name('minutasaltadireccions.revision');
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
            Route::resource('politica-sgsis', 'PoliticaSgsiController');
            Route::get('politica-sgsis-visualizacion', 'PoliticaSgsiController@visualizacion')->name('politica-sgsis.visualizacion');
            Route::post('politica-sgsis/cambioMostrar', 'PoliticaSgsiController@cambioMostrar')->name('politica-sgsis.cambio-mostrar');
            Route::post('politica-sgsis/pdf', 'PoliticaSgsiController@pdf')->name('politica-sgsis.pdf');
            Route::post('politica-sgsis/pdf/show/{id}', 'PoliticaSgsiController@pdf_show')->name('politica-sgsis.pdf_show');
            Route::get('politica-sgsis-revision/{id}', 'PoliticaSgsiController@revision')->name('politica-sgsis.revision');
            Route::post('politica-sgsis/{id}/aprobado', 'PoliticaSgsiController@aprobado')->name('politica-sgsis.aprobado');
            Route::post('politica-sgsis/{id}/rechazado', 'PoliticaSgsiController@rechazado')->name('politica-sgsis.rechazado');

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
            Route::post('competencias/pdf', 'CompetenciasController@pdf')->name('competencias.pdf');

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
            // Route::post('global-structure-search', 'GlobalStructureSearchController@globalSearch')->name('globalStructureSearch');
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
            // Route::middleware('cacheResponse')->get('analisis-riesgos-menu', 'AnalisisdeRiesgosController@menu')->name('analisis-riesgos.menu');
            Route::get('analisis-riesgos-menu', 'AnalisisdeRiesgosController@menu')->name('analisis-riesgos.menu');
            Route::resource('analisis-riesgos', 'AnalisisdeRiesgosController');
            Route::get('analisis-riesgos-inicio', 'AnalisisdeRiesgosController@inicioRiesgos');
            Route::get('top-template-analisis-riegos', 'TopController@topAnalisisRiegos')->name('top-template-analisis-riesgos');
            Route::get('risk-analysis', [AnalisisdeRiesgosController::class, 'RiskAnalysis'])->name('risk-analysis-index');
            Route::get('risk-analysis/{id}', [AnalisisdeRiesgosController::class, 'ShowRiskAnalysis'])->name('show-risk-analysis');
            Route::get('logs-template-risk-analysis/{id}', [AnalisisdeRiesgosController::class, 'LogsTemplateRiskAnalysis'])->name('logs-template-risk-analysis');

            Route::get('template-analisis-riesgo/create', 'TBTemplateAnalisisRiesgosController@create')->name('template-create-analisis-riesgos');
            Route::get('template-analisis-riesgo/create', 'TBTemplateAnalisisRiesgosController@create')->name('template-create-analisis-riesgos');
            Route::resource('template-analisis-riesgo', 'TBTemplateAnalisisRiesgosController');
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
            // Route::delete('analisis-aia/destroy', 'AnalisisdeAIAController@massDestroy')->name('analisis-aia.massDestroy');
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
            // Rutas de Matriz de Riesgos
            Route::prefix('matriz-riesgos')->controller(MatrizRiesgosController::class)->group(function () {
                Route::get('planes-de-accion/create/{id}', 'createPlanAccion')->name('matriz-riesgos.createPlanAccion');
                Route::post('planes-de-accion/store/{id}', 'storePlanAccion')->name('matriz-riesgos.storePlanAccion');
                Route::delete('destroy', 'massDestroy')->name('matriz-riesgos.massDestroy');
                Route::post('parse-csv-import', 'parseCsvImport')->name('matriz-riesgos.parseCsvImport');
                Route::resource('/', MatrizRiesgosController::class);
            });

            // Rutas de Octave
            // Rutas relacionadas con Octave
            Route::prefix('matriz-riesgo/octave')->controller(MatrizRiesgosController::class)->group(function () {
                Route::post('/', 'storeOctave')->name('matriz-riesgos.octave.store');
                Route::post('delete-activo', 'deleteActivoOctave')->name('matriz-riesgo.octave.activo.delete');
                Route::put('{id}', 'updateOctave')->name('matriz-riesgos.octave.update');
                Route::get('{id}/edit', 'octaveEdit')->name('matriz-riesgos.octave.edit');
                Route::get('/', 'octave')->name('matriz-riesgos.octave');
                Route::get('mapa', 'MapaCalorOctave')->name('matriz-octavemapa');
                Route::get('graficas/{matriz}', 'graficas')->name('octave-graficas');
                Route::get('getEmployeeDataOctaveNomActivoInfo', 'getEmployeeDataOctaveNomActivoInfo')->name('getEmployeeDataOctaveNomActivoInfo');
            });

            // Rutas de ISO31000
            Route::prefix('matriz-seguridad/ISO31000')->controller(MatrizRiesgosController::class)->group(function () {
                Route::get('/', 'ISO31000')->name('matriz-seguridad.ISO31000');
                Route::post('/', 'ISO31000Store')->name('matriz-seguridad.ISO31000.store');
                Route::post('delete-activo', 'deleteActivoISO31000')->name('matriz-seguridad.ISO31000.activo.delete');
                Route::get('create', 'ISO31000Create')->name('matriz-seguridad.ISO31000Create');
                Route::get('{id}/edit', 'ISO31000Edit')->name('matriz-seguridad.ISO31000.edit');
                Route::put('{id}', 'ISO31000Update')->name('matriz-seguridad.ISO31000.update');
            });

            // Rutas de NIST
            Route::prefix('matriz-seguridad/NIST')->controller(MatrizRiesgosController::class)->group(function () {
                Route::get('/', 'NIST')->name('matriz-seguridad.NIST');
                Route::post('/', 'NISTStore')->name('matriz-seguridad.NIST.store');
                Route::get('create', 'NISTCreate')->name('matriz-seguridad.NISTCreate');
                Route::get('{id}/edit', 'NISTEdit')->name('matriz-seguridad.NIST.edit');
                Route::put('{id}', 'NISTUpdate')->name('matriz-seguridad.NIST.update');
            });

            // Rutas del Sistema de Gestión
            Route::prefix('matriz-seguridad/sistema-gestion')->controller(MatrizRiesgosController::class)->group(function () {
                Route::get('/', 'SistemaGestion')->name('matriz-seguridad.sistema-gestion');
                Route::post('identificadorExist', 'identificadorExist')->name('matriz-seguridad.sistema-gestion.identificadorExist');
                Route::post('data', 'SistemaGestionData')->name('matriz-seguridad.sistema-gestion.data');
                Route::get('create', 'createSistemaGestion')->name('matriz-riesgos.sistema-gestion.create');
                Route::post('store', 'storeSistemaGestion')->name('matriz-riesgos.sistema-gestion.store');
                Route::get('edit/{id}', 'editSistemaGestion')->name('matriz-riesgos.sistema-gestion.edit');
                Route::put('update/{id}', 'updateSistemaGestion')->name('matriz-riesgos.sistema-gestion.update');
                Route::get('show/{id}', 'showSistemaGestion')->name('matriz-riesgos.sistema-gestion.show');
                Route::delete('{riesgo}', 'destroySistemaGestion')->name('matriz-riesgos.sistema-gestion.destroy');
                Route::get('seguridadMapa', 'MapaCalorSistemaGestion')->name('matriz-mapa.SistemaGestion');
            });

            // Otras rutas
            Route::get('matriz-seguridadMapa', [MatrizRiesgosController::class, 'MapaCalor'])->name('matriz-mapa');
            Route::get('controles-get', [MatrizRiesgosController::class, 'ControlesGet'])->name('controles-get');

            // Rutas relacionadas con Matriz de Seguridad y Octave
            Route::prefix('matriz-seguridad')->controller(MatrizRiesgosController::class)->group(function () {
                Route::get('/', 'SeguridadInfo')->name('matriz-seguridad'); // Seguridad general
                Route::get('octave/index', 'octaveIndex')->name('matriz-seguridad.octaveIndex'); // Octave Index
            });

            // Rutas relacionadas con Octave
            Route::prefix('octave')->controller(MatrizRiesgosController::class)->group(function () {
                Route::get('graficas/{matriz}', 'graficas')->name('octave-graficas'); // Gráficas Octave
            });

            // Otras rutas
            Route::post('matriz-riesgos/parse-csv-import', [MatrizRiesgosController::class, 'parseCsvImport'])->name('matriz-riesgos.parseCsvImport');
            Route::get('matriz-octavemapa', 'MatrizRiesgosController@MapaCalorOctave')->name('matriz-octavemapa');

            // Rutas para Procesos Octave
            Route::prefix('procesos-octave')->controller(ProcesosOctaveController::class)->group(function () {
                Route::post('activos', 'activos')->name('procesos.octave.activos'); // Activos de procesos Octave
                Route::get('{matriz}', 'index')->name('procesos-octave.index'); // Índice de procesos Octave
                Route::get('{matriz}/create', 'create')->name('procesos-octave.create'); // Crear proceso Octave
                Route::delete('{proceso}', 'destroy')->name('procesos-octave.destroy'); // Eliminar proceso Octave
                Route::get('{matriz}/edit/{proceso}', 'edit')->name('procesos-octave.edit'); // Editar proceso Octave
                // Route::delete('destroy', 'destroy')->name('procesos-octave.destroy'); // Comentario conservado
            });

            Route::resource('procesos-octave', ProcesosOctaveController::class)->except(['index', 'create', 'edit', 'destroy']);

            //Servicios
            Route::delete('servicios/destroy', 'ServiciosController@destroy')->name('servicios.destroy');
            Route::resource('servicios', 'ServiciosController')->except('destroy');

            //Revisiones Documentos
            Route::prefix('revisiones')->controller(RevisionDocumentoController::class)->group(function () {
                Route::post('approve', 'approve')->name('revisiones.approve');
                Route::post('reject', 'reject')->name('revisiones.reject');
                Route::get('{revisionDocumento}', 'edit')->name('revisiones.revisar');

                Route::get('archivo', 'archivo')->name('revisiones.archivo');
                Route::post('archivar', 'archivar')->name('revisiones.archivar');
                Route::post('desarchivar', 'desarchivar')->name('revisiones.desarchivar');
                Route::post('documentos-debo-aprobar', 'obtenerDocumentosDeboAprobar')->name('revisiones.obtenerDocumentosDeboAprobar');
                Route::post('documentos-debo-aprobar-archivo', 'obtenerDocumentosDeboAprobarArchivo')->name('revisiones.obtenerDocumentosDeboAprobarArchivo');
                Route::post('documentos-me-deben-aprobar', 'obtenerDocumentosMeDebenAprobar')->name('revisiones.obtenerDocumentosMeDebenAprobar');
                Route::post('documentos-me-deben-aprobar-archivo', 'obtenerDocumentosMeDebenAprobarArchivo')->name('revisiones.obtenerDocumentosMeDebenAprobarArchivo');
            });

            //Documentos
            Route::controller(DocumentosController::class)->group(function () {
                Route::get('documentos/publicados', 'publicados')->name('documentos.publicados');
                Route::patch('documentos/{documento}/update-when-publish', 'updateDocumentWhenPublish')->name('documentos.updateDocumentWhenPublish');
                Route::post('documentos/store-when-publish', 'storeDocumentWhenPublish')->name('documentos.storeDocumentWhenPublish');
                Route::post('documentos/publish', 'publish')->name('documentos.publish');
                Route::post('documentos/check-code', 'checkCode')->name('documentos.checkCode');
                Route::get('documentos/{documento}/view-document', 'renderViewDocument')->name('documentos.renderViewDocument');
                Route::get('documentos/{documento}/history-reviews', 'renderHistoryReview')->name('documentos.renderHistoryReview');
                Route::get('documentos/{documento}/document-versions', 'renderHistoryVersions')->name('documentos.renderHistoryVersions');
                Route::post('documentos/dependencies', 'getDocumentDependencies')->name('documentos.getDocumentDependencies');
                Route::delete('documentos/{documento}', 'destroy')->name('documentos.destroy');
            });

            Route::resource('documentos', DocumentosController::class);

            // Control Documentos
            Route::delete('control-documentos/destroy', 'ControlDocumentosController@massDestroy')->name('control-documentos.massDestroy');
            Route::resource('control-documentos', 'ControlDocumentosController', ['except' => ['create']]);

            Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
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
        Route::get('capacitaciones-inicio', [CapacitacionesController::class, 'capacitacionesInicio']);

        Route::resource('courses', 'Escuela\Instructor\CourseController');

        Route::get('curso-estudiante/{course}', 'CursoEstudiante@cursoEstudiante')->name('curso-estudiante')->middleware('course');
        Route::get('mis-cursos', 'CursoEstudiante@misCursos')->name('mis-cursos');
        Route::get('reload-porcentage-courses', 'CursoEstudiante@porcentageCourses');
        Route::get('curso-estudiante/{course}/evaluacion/{evaluation}', 'CursoEstudiante@evaluacionEstudiante')->name('curso.evaluacion');
        Route::get('courses/{course}', 'CursoEstudiante@show')->name('courses.show');
        Route::post('course/{course}/enrolled', 'CursoEstudiante@enrolled')->name('courses.enrolled');
        Route::get('courses/{course}/quizdetail', 'Escuela\Instructor\CourseController@quizDetails')->name('courses-quizdetails');
        Route::get('courses/{course}/evaluation/{evaluation}/quiz-details', 'Escuela\QuizDetailsController@show')->name('courses.evaluation.quizdetails');

        Route::get('courses/{course}/evaluation/{evaluation}', 'Escuela\Instructor\CourseQuestionController@index')->name('courses.evaluation.questions');
        Route::get('courses/{course}/evaluacion/{evaluation}/quizdetail', 'CursoEstudiante@tableQuizDetails')->name('courses.quizdetails');
        Route::get('courses-inscribed', 'CursoEstudiante@coursesInscribed')->name('courses-inscribed');
        Route::get('courses-reportes-individuales/{id}', 'Escuela\Admin\ReportesIndividualesController@index')->name('courses-reportes-individuales');

        Route::get('panel-cursos', 'PanelCursosController@index')->name('panel-cursos');

        //categorias para el administrador de escuela
        Route::resource('categories', 'Escuela\Admin\CategoryController');
        Route::get('categories/destroy/{id}', 'Escuela\Admin\CategoryController@destroy');
        Route::resource('levels', 'Escuela\Admin\LevelController');
        Route::get('levels/destroy/{id}', 'Escuela\Admin\LevelController@destroy');
        Route::resource('dashboardescuela', 'Escuela\Admin\HomeController');
        Route::get('certificado-course', 'Escuela\Admin\CertificadoController@index');
        Route::post('certificado-course-select', 'Escuela\Admin\CertificadoController@selectCertificado');

        // pasarela de pago
        Route::get('pasarela-pago/', 'PasarelaPagoController@index')->name('pasarela-pago.inicio');
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

    // Route::get('/notificaciones', [\App\Livewire\NotificacionesComponent::class, '__invoke'])->name('notificaciones');
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
        // Ruta independiente para CargaDocs
        Route::get('CargaDocs', 'CargaDocs@index')->name('cargadocs');

        // Agrupación de rutas que utilizan el controlador SubidaExcel
        Route::controller(SubidaExcel::class)->group(function () {
            Route::post('CargaAmenaza', 'Amenaza')->name('carga-amenaza');
            Route::post('CargaVulnerabilidad', 'Vulnerabilidad')->name('carga-vulnerabilidad');
            Route::post('CargaUsuario', 'Usuario')->name('carga-usuario');
            Route::post('CargaPuesto', 'Puesto')->name('carga-puesto');
            Route::post('CargaControl', 'Control')->name('carga-control');
            Route::post('CargaEjecutarenlace', 'Ejecutarenlace')->name('carga-ejecutarenlace');
            Route::post('CargaTeam', 'Team')->name('carga-team');
            Route::post('CargaEstadoIncidente', 'EstadoIncidente')->name('carga-estadoincidente');
            Route::post('CargaRole', 'Roles')->name('carga-roles');
            Route::post('CargaCompetencia', 'Competencia')->name('carga-competencia');
            Route::post('CargaEvaluacion', 'Evaluacion')->name('carga-evaluacion');
            Route::post('CargaCategoriaCapacitacion', 'CategoriaCapacitacion')->name('carga-categoriacapacitacion');
            Route::post('CargaRevisionDireccion', 'RevisionDireccion')->name('carga-revisiondireccion');
            Route::post('CargaAnalisisRiesgo', 'AnalisisRiesgo')->name('carga-analisis_riego');
            Route::post('CargaPartesInteresadas', 'PartesInteresadas')->name('carga-partes_interesadas');
            Route::post('CargaMatrizRequisitosLegales', 'MatrizRequisitosLegales')->name('carga-matriz_requisitos_legales');
            Route::post('CargaFoda', 'Foda')->name('carga-foda');
            Route::post('CargaDeterminacionAlcance', 'DeterminacionAlcance')->name('carga-determinacion_alcance');
            Route::post('CargaComiteSeguridad', 'ComiteSeguridad')->name('carga-comite_seguridad');
            Route::post('CargaAltaDireccion', 'AltaDireccion')->name('carga-alta_direccion');
            Route::post('CargaEvidenciaRecursos', 'EvidenciaRecursos')->name('carga-evidencia_recursos');
            Route::post('CargaPoliticaSgsi', 'PoliticaSgsi')->name('carga-politica_sgi');
            Route::post('CargaGrupoArea', 'GrupoArea')->name('carga-grupo_area');
            Route::post('CargaDatosArea', 'DatosArea')->name('carga-datos_area');
            Route::post('CargaActivos', 'Activos')->name('carga-activo-inventario');
            Route::post('CargaEmpleado', 'Empleado')->name('carga-empleado');
        });

        //Ruta ExportExcel
        // Agrupación de todas las rutas que pertenecen a ExportExcelReport
        Route::controller(ExportExcelReport::class)->group(function () {
            Route::get('ExportUsuario', 'Users')->name('descarga-usuario');
            Route::get('ExportPuesto', 'Puesto')->name('descarga-puesto');
            Route::get('ExportRoles', 'Roles')->name('descarga-roles');
            Route::get('ExportSoporte', 'Soporte')->name('descarga-soporte');
            Route::get('ExportEmpleado', 'Empleado')->name('descarga-empleado');
            Route::get('ExportSede', 'Sede')->name('descarga-sedes');
            Route::get('ExportNivelJerarquico', 'NivelJerarquico')->name('descarga-nivel-jerarquico');
            Route::get('ExportRegistroArea', 'RegistroArea')->name('descarga-registro-area');
            Route::get('ExportMacroproceso', 'Macroproceso')->name('descarga-macroproceso');
            Route::get('ExportProceso', 'Proceso')->name('descarga-proceso');
            Route::get('ExportTipoActivo', 'TipoActivo')->name('descarga-tipo-activo');
            Route::get('ExportInventarioActivos', 'InventarioActivos')->name('descarga-inventario-activos');
            Route::get('ExportGlosarios', 'Glosarios')->name('descarga-glosarios');
            Route::get('ExportCategoriasCapacitaciones', 'categoriasCapacitaciones')->name('descarga-categoria-capacitaciones');
            Route::get('ExportVisualizarLogs', 'visualizarLogs')->name('descarga-visualizar-logs');
            Route::get('ExportSolicitudesDayOff', 'solicitudesDayOff')->name('descarga-solicitudes-day-off');
            Route::get('ExportSolicitudesVacaciones', 'solicitudesVacaciones')->name('descarga-solicitudes-vacaciones');
            Route::get('ExportEvaluaciones360', 'evaluaciones360')->name('descarga-evaluaciones-360');

            Route::post('ExportRegistrosTimesheet', 'registrosTimesheet')->name('descarga-registro-timesheet');
            Route::post('ExportTimesheetAreas', 'timesheetAreas')->name('descarga-timesheet-areas');
            Route::post('ExportTimesheetProyectos', 'timesheetProyectos')->name('descarga-timesheet-proyectos');

            // Agrupación de rutas relacionadas con riesgos y seguridad
            Route::get('ExportAmenaza', 'Amenaza')->name('descarga-amenaza');
            Route::get('ExportVulnerabilidad', 'Vulnerabilidad')->name('descarga-vulnerabilidad');
            Route::get('ExportAnalisisRiesgo', 'AnalisisRiesgo')->name('descarga-analisis_riego');
            Route::get('ExportPartesInteresadas', 'PartesInteresadas')->name('descarga-partes_interesadas');
            Route::get('ExportMatrizRequisitosLegales', 'MatrizRequisitosLegales')->name('descarga-matriz_requisitos_legales');
            Route::get('ExportFoda', 'Foda')->name('descarga-foda');
            Route::get('ExportDeterminacionAlcance', 'DeterminacionAlcance')->name('descarga-determinacion_alcance');
            Route::get('ExportComiteSeguridad', 'ComiteSeguridad')->name('descarga-comite_seguridad');
            Route::get('ExportAltaDireccion', 'AltaDireccion')->name('descarga-alta_direccion');

            Route::get('ExportCategoriaCapacitacion', 'CategoriaCapacitacion')->name('descarga-categoriacapacitacion');
            Route::get('ExportRevisionDireccion', 'RevisionDireccion')->name('descarga-revisiondireccion');

            // Otras rutas
            Route::get('ExportPoliticaSgsi', 'PoliticaSgsi')->name('descarga-politica_sgi');
            Route::get('ExportGrupoArea', 'GrupoArea')->name('descarga-grupo_area');
        });
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
        // Route::view('katbol', 'contract_manager.katbol.index')->name('katbol')->middleware('cacheResponse');
        Route::view('katbol', 'contract_manager.katbol.index')->name('katbol');

        //Proveedores
        Route::resource('proveedor', 'ProveedoresController');

        // Rutas para Contratos
        Route::controller(ContratosController::class)->prefix('contratos-katbol')->group(function () {
            //## API - Revisar en tiempo real si contrato ya existe ###
            Route::post('numero/existe', 'revisarSiNumeroContratoExiste')->name('contratos-katbol.noContratoExistencia');
            Route::post('{id}/ampliacion', 'updateAmpliacion')->name('contratos-katbol.ampliacion');
            Route::post('{id}/convenios', 'updateConvenios')->name('contratos-katbol.convenios');
            // Route::post('contratos-katbol/update/{id}', 'ContratosController@update')->name('contracontratos-katboltos.update');
            Route::post('contrato-file-upload-tmp', 'uploadInTmpDirectory')->name('contratos-katbol.fileUploadTmp');
            // Route::get('download/{file}', 'ContratosController@getDownload');
            // Route::post('contratos/identificadorExist', 'ContratosController@identificadorExist')->name('contratos-katbol.identificadorExist');
            Route::post('archivos', 'obtenerArchivos')->name('contratos-katbol.obtenerArchivos');
            Route::get('file/download', 'downloadFile')->name('downloadFile');
            Route::post('check-code', 'checkCode')->name('contratos-katbol.checkCode');
            Route::resource('/', 'ContratosController')->parameters(['' => 'contrato']); // Asumiendo que la clave primaria es 'contrato'
            Route::get('destroy/{id}', 'destroy')->name('contratos-katbol.delete');
            Route::get('exportar/contratos', 'exportTo')->name('reportecliente.exportar');
            Route::put('contratopago/{id}', 'Campos')->name('contratos-katbol.contratopago');
            Route::get('contratoinsert/{id}', 'FacturaController@ContratoInsert')->name('contratos-katbol.Insertar');
            Route::get('eval-nivel/{id}', 'evaluacion')->name('contratos-katbol.evaluacion');
            Route::get('revision-factura/{id}', 'revision')->name('contratos-katbol.revision');
            Route::post('validateDocument', 'validateDocument')->name('contratos-katbol.validar-documento');
            Route::post('aprobacion-firma-contrato', 'aprobacionFirma')->name('contratos-katbol.aprobacion-firma-contrato');
            Route::get('aprobacion-firma-contrato/historico', 'historicoAprobacion')->name('contratos-katbol.aprobacion-firma-contrato.historico');
        });

        Route::resource('contratos-katbol', 'ContratosController');

        // Rutas para el Dashboard
        Route::controller(DashboardController::class)->group(function () {
            Route::post('selectProveedor', 'AjaxRequestClientes')->name('selectCliente');
            Route::post('selectContrato', 'AjaxRequestContratos')->name('selectContrato');
            Route::post('selectEvaluacionesServicio', 'AjaxRequestEvaluacionesServicio')->name('selectEvaluacionesServicio');
            Route::get('dashboard-contratos-katbol', 'index')->name('dashboard.katbol');
        });

        // Rutas para Dashboards (sin acciones específicas)
        Route::resource('dashboards', DashboardController::class, ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

        // Route::resource('bitacoras', 'BitacoraController');

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
        Route::post('compradores/pdf', 'CompradoresController@pdfCompradores')->name('compradores.pdf');

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
        // Route::post('requisiciones-aprobadores/list/get', 'RequisicionesController@getRequisicionIndexAprobador')->name('requisiciones.getRequisicionIndexAprobador');
        // Route::post('requisiciones-solicitante/list/get', 'RequisicionesController@getRequisicionIndexSolicitante')->name('requisiciones.getRequisicionIndexSolicitante');
        Route::get('requisiciones/show/{id}', 'RequisicionesController@show')->name('requisiciones.show');
        Route::get('requisiciones/edit/{id}', 'RequisicionesController@edit')->name('requisiciones.edit');
        Route::post('requisiciones/{id}/cancelarRequisicion', 'RequisicionesController@cancelarRequisicion')->name('requisiciones.cancelarRequisicion');
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
        Route::get('requisiciones/filtrar', 'RequisicionesController@filtrarPorEstado')->name('requisiciones.filtrarPorEstado');
        Route::get('requisiciones/filtrar_jefe', 'RequisicionesController@filtrarPorEstado1')->name('requisiciones.filtrarPorEstado1');
        Route::get('requisiciones/filtrar_solicitante', 'RequisicionesController@filtrarPorEstado2')->name('requisiciones.filtrarPorEstado2');
        Route::get('requisiciones/filtrar_compras', 'RequisicionesController@filtrarPorEstado3')->name('requisiciones.filtrarPorEstado3');
        Route::post('requisiciones/cambiarResponsable', 'RequisicionesController@cambiarResponsable')->name('requisiciones.cambiarResponsable');

        // ordenes de compra
        Route::get('orden-compra', 'OrdenCompraController@index')->name('orden-compra');
        Route::match(['get', 'post'], 'orden-compra/getocindex', 'OrdenCompraController@getOCIndex')->name('orden-compra.get-oc-index');
        Route::get('orden-compra/{id}/edit', 'OrdenCompraController@edit')->name('orden-compra.edit');
        Route::post('orden-compra/update/{id}', 'OrdenCompraController@update')->name('orden-compra.update');
        Route::post('orden-compra/updateOrdenCompra/{id}', 'OrdenCompraController@updateOrdenCompra')->name('orden-compra.updateOrdenCompra');
        Route::post('orden-compra/destroy/{id}', 'OrdenCompraController@destroy')->name('orden-compra.destroy');
        Route::get('orden-compra/show/{id}', 'OrdenCompraController@show')->name('orden-compra.show');
        Route::post('orden-compra/pdf/{id}', 'OrdenCompraController@pdf')->name('orden-compra.pdf');
        Route::post('orden-compra/rechazada/{id}', 'OrdenCompraController@rechazada')->name('orden-compra.rechazada');
        // Route::get('orden-compra/firmar/{tipo_firma}/{id}', 'OrdenCompraController@firmar')->name('orden-compra.firmar');
        Route::post('orden-compra/firma-update/{tipo_firma}/{id}', 'OrdenCompraController@FirmarUpdate')->name('orden-compra.firmar-update');
        Route::get('orden-compra/filtrar', 'OrdenCompraController@filtrarPorEstado')->name('orden-compra.filtrarPorEstado');
        Route::get('orden-compra/filtrar_solicitante', 'OrdenCompraController@filtrarPorEstado2')->name('orden-compra.filtrarPorEstado2');
        Route::get('orden-compra/filtrar_compras', 'OrdenCompraController@filtrarPorEstado3')->name('orden-compra.filtrarPorEstado3');
        Route::get('orden-compra/aprobadores', 'OrdenCompraController@indexAprobadores')->name('orden-compra.indexAprobadores');
        Route::get('orden-compra/aprobados/{id}', 'OrdenCompraController@firmarAprobadores')->name('orden-compra.firmarAprobadores');
        Route::get('orden-compra/{id}/editar-orden-compra', 'OrdenCompraController@editarOrdenCompra')->name('orden-compra.editarOrdenCompra');
        Route::post('orden-compra/{id}/cancelarOrdenCompra', 'OrdenCompraController@cancelarOrdenCompra')->name('requisiciones.cancelarOrdenCompra');
    });
});
