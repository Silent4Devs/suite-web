<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">{{ __('My profile') }}</a>

                                    @can('organizacion_access')
                                        <a class="dropdown-item" href="{{ route('frontend.organizacions.index') }}">
                                            {{ trans('cruds.organizacion.title') }}
                                        </a>
                                    @endcan
                                    @can('dashboard_access')
                                        <a class="dropdown-item" href="{{ route('frontend.dashboards.index') }}">
                                            {{ trans('cruds.dashboard.title') }}
                                        </a>
                                    @endcan
                                    @can('implementacion_access')
                                        <a class="dropdown-item" href="{{ route('frontend.implementacions.index') }}">
                                            {{ trans('cruds.implementacion.title') }}
                                        </a>
                                    @endcan
                                    @can('documentacion_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.documentacion.title') }}
                                        </a>
                                    @endcan
                                    @can('carpetum_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.carpeta.index') }}">
                                            {{ trans('cruds.carpetum.title') }}
                                        </a>
                                    @endcan
                                    @can('archivo_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.archivos.index') }}">
                                            {{ trans('cruds.archivo.title') }}
                                        </a>
                                    @endcan
                                    @can('glosario_access')
                                        <a class="dropdown-item" href="{{ route('frontend.glosarios.index') }}">
                                            {{ trans('cruds.glosario.title') }}
                                        </a>
                                    @endcan
                                    @can('isoveinticieteuno_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.isoveinticieteuno.title') }}
                                        </a>
                                    @endcan
                                    @can('contexto_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.contexto.title') }}
                                        </a>
                                    @endcan
                                    @can('entendimiento_organizacion_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.entendimiento-organizacions.index') }}">
                                            {{ trans('cruds.entendimientoOrganizacion.title') }}
                                        </a>
                                    @endcan
                                    @can('partes_interesada_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.partes-interesadas.index') }}">
                                            {{ trans('cruds.partesInteresada.title') }}
                                        </a>
                                    @endcan
                                    @can('matriz_requisito_legale_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.matriz-requisito-legales.index') }}">
                                            {{ trans('cruds.matrizRequisitoLegale.title') }}
                                        </a>
                                    @endcan
                                    @can('alcance_sgsi_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.alcance-sgsis.index') }}">
                                            {{ trans('cruds.alcanceSgsi.title') }}
                                        </a>
                                    @endcan
                                    @can('liderazgo_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.liderazgo.title') }}
                                        </a>
                                    @endcan
                                    @can('comiteseguridad_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.comiteseguridads.index') }}">
                                            {{ trans('cruds.comiteseguridad.title') }}
                                        </a>
                                    @endcan
                                    @can('minutasaltadireccion_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.minutasaltadireccions.index') }}">
                                            {{ trans('cruds.minutasaltadireccion.title') }}
                                        </a>
                                    @endcan
                                    @can('evidencias_sgsi_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.evidencias-sgsis.index') }}">
                                            {{ trans('cruds.evidenciasSgsi.title') }}
                                        </a>
                                    @endcan
                                    @can('politica_sgsi_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.politica-sgsis.index') }}">
                                            {{ trans('cruds.politicaSgsi.title') }}
                                        </a>
                                    @endcan
                                    @can('roles_responsabilidade_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.roles-responsabilidades.index') }}">
                                            {{ trans('cruds.rolesResponsabilidade.title') }}
                                        </a>
                                    @endcan
                                    @can('planificacion_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.planificacion.title') }}
                                        </a>
                                    @endcan
                                    @can('riesgosoportunidade_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.riesgosoportunidades.index') }}">
                                            {{ trans('cruds.riesgosoportunidade.title') }}
                                        </a>
                                    @endcan
                                    @can('objetivosseguridad_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.objetivosseguridads.index') }}">
                                            {{ trans('cruds.objetivosseguridad.title') }}
                                        </a>
                                    @endcan
                                    @can('soporte_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.soporte.title') }}
                                        </a>
                                    @endcan
                                    @can('recurso_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.recursos.index') }}">
                                            {{ trans('cruds.recurso.title') }}
                                        </a>
                                    @endcan
                                    @can('competencium_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.competencia.index') }}">
                                            {{ trans('cruds.competencium.title') }}
                                        </a>
                                    @endcan
                                    @can('concientizacion_sgi_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.concientizacion-sgis.index') }}">
                                            {{ trans('cruds.concientizacionSgi.title') }}
                                        </a>
                                    @endcan
                                    @can('material_sgsi_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.material-sgsis.index') }}">
                                            {{ trans('cruds.materialSgsi.title') }}
                                        </a>
                                    @endcan
                                    @can('material_iso_veinticiente_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.material-iso-veinticientes.index') }}">
                                            {{ trans('cruds.materialIsoVeinticiente.title') }}
                                        </a>
                                    @endcan
                                    @can('comunicacion_sgi_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.comunicacion-sgis.index') }}">
                                            {{ trans('cruds.comunicacionSgi.title') }}
                                        </a>
                                    @endcan
                                    @can('politica_del_sgsi_soporte_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.politica-del-sgsi-soportes.index') }}">
                                            {{ trans('cruds.politicaDelSgsiSoporte.title') }}
                                        </a>
                                    @endcan
                                    @can('control_acceso_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.control-accesos.index') }}">
                                            {{ trans('cruds.controlAcceso.title') }}
                                        </a>
                                    @endcan
                                    @can('informacion_documetada_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.informacion-documetadas.index') }}">
                                            {{ trans('cruds.informacionDocumetada.title') }}
                                        </a>
                                    @endcan
                                    @can('operacion_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.operacion.title') }}
                                        </a>
                                    @endcan
                                    @can('planificacion_control_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.planificacion-controls.index') }}">
                                            {{ trans('cruds.planificacionControl.title') }}
                                        </a>
                                    @endcan
                                    @can('activo_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.activos.index') }}">
                                            {{ trans('cruds.activo.title') }}
                                        </a>
                                    @endcan
                                    @can('tratamiento_riesgo_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.tratamiento-riesgos.index') }}">
                                            {{ trans('cruds.tratamientoRiesgo.title') }}
                                        </a>
                                    @endcan
                                    @can('evaluacion_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.evaluacion.title') }}
                                        </a>
                                    @endcan
                                    @can('indicadores_sgsi_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.indicadores-sgsis.index') }}">
                                            {{ trans('cruds.indicadoresSgsi.title') }}
                                        </a>
                                    @endcan
                                    @can('incidentes_de_seguridad_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.incidentes-de-seguridads.index') }}">
                                            {{ trans('cruds.incidentesDeSeguridad.title') }}
                                        </a>
                                    @endcan
                                    @can('indicadorincidentessi_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.indicadorincidentessis.index') }}">
                                            {{ trans('cruds.indicadorincidentessi.title') }}
                                        </a>
                                    @endcan
                                    @can('auditoria_anual_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.auditoria-anuals.index') }}">
                                            {{ trans('cruds.auditoriaAnual.title') }}
                                        </a>
                                    @endcan
                                    @can('plan_auditorium_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.plan-auditoria.index') }}">
                                            {{ trans('cruds.planAuditorium.title') }}
                                        </a>
                                    @endcan
                                    @can('auditoria_interna_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.auditoria-internas.index') }}">
                                            {{ trans('cruds.auditoriaInterna.title') }}
                                        </a>
                                    @endcan
                                    @can('revision_direccion_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.revision-direccions.index') }}">
                                            {{ trans('cruds.revisionDireccion.title') }}
                                        </a>
                                    @endcan
                                    @can('mejora_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.mejora.title') }}
                                        </a>
                                    @endcan
                                    @can('accion_correctiva_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.accion-correctivas.index') }}">
                                            {{ trans('cruds.accionCorrectiva.title') }}
                                        </a>
                                    @endcan
                                    @can('planaccion_correctiva_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.planaccion-correctivas.index') }}">
                                            {{ trans('cruds.planaccionCorrectiva.title') }}
                                        </a>
                                    @endcan
                                    @can('registromejora_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.registromejoras.index') }}">
                                            {{ trans('cruds.registromejora.title') }}
                                        </a>
                                    @endcan
                                    @can('dmaic_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.dmaics.index') }}">
                                            {{ trans('cruds.dmaic.title') }}
                                        </a>
                                    @endcan
                                    @can('plan_mejora_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.plan-mejoras.index') }}">
                                            {{ trans('cruds.planMejora.title') }}
                                        </a>
                                    @endcan
                                    @can('isoveintidostresuno_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.isoveintidostresuno.title') }}
                                        </a>
                                    @endcan
                                    @can('adquirirveintidostrecientosuno_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.adquirirveintidostrecientosunos.index') }}">
                                            {{ trans('cruds.adquirirveintidostrecientosuno.title') }}
                                        </a>
                                    @endcan
                                    @can('isotreintaunmil_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.isotreintaunmil.title') }}
                                        </a>
                                    @endcan
                                    @can('adquirirtreintaunmil_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.adquirirtreintaunmils.index') }}">
                                            {{ trans('cruds.adquirirtreintaunmil.title') }}
                                        </a>
                                    @endcan
                                    @can('user_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.userManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('permission_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.permissions.index') }}">
                                            {{ trans('cruds.permission.title') }}
                                        </a>
                                    @endcan
                                    @can('role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.roles.index') }}">
                                            {{ trans('cruds.role.title') }}
                                        </a>
                                    @endcan
                                    @can('user_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.users.index') }}">
                                            {{ trans('cruds.user.title') }}
                                        </a>
                                    @endcan
                                    @can('controle_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.controles.index') }}">
                                            {{ trans('cruds.controle.title') }}
                                        </a>
                                    @endcan
                                    @can('audit_log_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.audit-logs.index') }}">
                                            {{ trans('cruds.auditLog.title') }}
                                        </a>
                                    @endcan
                                    @can('area_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.areas.index') }}">
                                            {{ trans('cruds.area.title') }}
                                        </a>
                                    @endcan
                                    @can('organizacione_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.organizaciones.index') }}">
                                            {{ trans('cruds.organizacione.title') }}
                                        </a>
                                    @endcan
                                    @can('tipoactivo_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.tipoactivos.index') }}">
                                            {{ trans('cruds.tipoactivo.title') }}
                                        </a>
                                    @endcan
                                    @can('puesto_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.puestos.index') }}">
                                            {{ trans('cruds.puesto.title') }}
                                        </a>
                                    @endcan
                                    @can('user_alert_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.user-alerts.index') }}">
                                            {{ trans('cruds.userAlert.title') }}
                                        </a>
                                    @endcan
                                    @can('sede_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.sedes.index') }}">
                                            {{ trans('cruds.sede.title') }}
                                        </a>
                                    @endcan
                                    @can('enlaces_ejecutar_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.enlaces-ejecutars.index') }}">
                                            {{ trans('cruds.enlacesEjecutar.title') }}
                                        </a>
                                    @endcan
                                    @can('team_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.teams.index') }}">
                                            {{ trans('cruds.team.title') }}
                                        </a>
                                    @endcan
                                    @can('estado_incidente_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.estado-incidentes.index') }}">
                                            {{ trans('cruds.estadoIncidente.title') }}
                                        </a>
                                    @endcan
                                    @can('estatus_plan_trabajo_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.estatus-plan-trabajos.index') }}">
                                            {{ trans('cruds.estatusPlanTrabajo.title') }}
                                        </a>
                                    @endcan
                                    @can('estado_documento_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.estado-documentos.index') }}">
                                            {{ trans('cruds.estadoDocumento.title') }}
                                        </a>
                                    @endcan
                                    @can('plan_base_actividade_access')
                                        <a class="dropdown-item" href="{{ route('frontend.plan-base-actividades.index') }}">
                                            {{ trans('cruds.planBaseActividade.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.faqManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.faq-categories.index') }}">
                                            {{ trans('cruds.faqCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_question_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.faq-questions.index') }}">
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('message'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>