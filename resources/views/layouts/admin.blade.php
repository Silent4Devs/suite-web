<!DOCTYPE html>
<html lang="esp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('panel.site_title') }}</title>

    <!-- Principal Styles -->
    <link href="{{ asset('css/app.css') }}{{ config('app.cssVersion') }}" rel="stylesheet">
    <link href="{{ asset('css/global/style.css') }}{{ config('app.cssVersion') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/admin.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" href="{{ asset('css/rds.css') }}{{ config('app.cssVersion') }}">
    <link href="{{ asset('css/global/custom.css') }}{{ config('app.cssVersion') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/darkMode.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/yearpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/global/TbButtons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/TbColorsGlobal.css') }}">

    @yield('css')
    @yield('styles')
    <!-- End Principal Styles -->

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://storage.googleapis.com/non-spec-apps/mio-icons/latest/outline.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,300,0,0" />
    <!-- End Fonts -->

    <!-- Extra Styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <!-- x-editable -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/jquery-editable/jquery-ui-datepicker/css/redmond/jquery-ui-1.10.3.custom.min.css"
        integrity="sha512-4E8WH1J08+TC3LLRtjJdA8OlggQvj5LN+TciGGwJWaQtFXj0BoZPKT9gIHol283GiUfpKPVk54LJfur5jfiRxA=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css"
        integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
        integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/plugins/monthSelect/style.min.css"
        integrity="sha512-V7B1IY1DE/QzU/pIChM690dnl44vAMXBidRNgpw0mD+hhgcgbxHAycRpOCoLQVayXGyrbC+HdAONVsF+4DgrZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- End Extra Styles -->

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" href="{{ asset('css/rds.css') }}{{ config('app.cssVersion') }}">
    @yield('styles')
    @livewireStyles

    {{-- Laravel vite --}}
    @vite(['resources/js/app.js'])
    {{-- Laravel vite --}}

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj_v2.png') }}">
    {{-- library mathjs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.4.0/math.min.js"></script>
</head>

<body style="zoom: 99%">
    <div id="loading">
        <img id="loading-image" src="https://i.pinimg.com/originals/07/24/88/0724884440e8ddd0896ff557b75a222a.gif"
            alt="Loading...">
    </div>
    @php
        use App\Models\Organizacion;
        use App\Models\User;
        use App\Models\Empleado;
        $usuario = User::getCurrentUser();
        $empleado = Empleado::getMyEmpleadodata($usuario->empleado->id);
        $organizacion = Organizacion::getLogo();
        if (!is_null($organizacion)) {
            $logotipo = $organizacion->logotipo;
        } else {
            $logotipo = 'logotipo-tabantaj.png';
        }

        $hoy_format_global = \Carbon\Carbon::now()->format('d/m/Y');
    @endphp

    <header>
        <div class="content-header-blue">
            <div class="caja-inicio-options-header">
                <button class="btn-menu-header" style="height: 40px;" onclick="menuHeader();">
                    <div class="line-menu">
                        <hr>
                    </div>
                </button>
                <a href="{{ url('/admin/portal-comunicacion') }}"><img src="{{ asset('img/logo-ltr.png') }}"
                        alt="Logo Tabantaj" style="height: 40px;"></a>
                @livewire('global-search-component', ['lugar' => 'header'])
            </div>
            @if ($empleado)
                <ul class="ml-auto c-header-nav">
                    <li style="position: relative; right:2rem;">
                        @livewire('campana-notificaciones-component')
                    </li>
                    <li class="c-header-nav-item dropdown show">
                        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <div style="width:100%; display: flex; align-items: center;">
                                @if ($empleado)
                                    <div style="width: 40px; overflow:hidden;" class="mr-2">
                                        <img class="img_empleado" style=""
                                            src="{{ asset('storage/empleados/imagenes/' . '/' . $empleado->avatar) }}"
                                            alt="{{ $empleado->name }}">
                                    </div>
                                    <div class="d-mobile-none">
                                        <span class="mr-2" style="font-weight: bold;">
                                            {{ $empleado ? explode(' ', $empleado->name)[0] : '' }}
                                        </span>
                                        {{-- <p class="m-0" style="font-size: 8px">
                                            {{ $usuario->empleado ? Str::limit($usuario->empleado->puesto, 30, '...') : '' }}
                                        </p> --}}
                                    </div>
                                @else
                                    <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                                @endif
                            </div>
                        </a>

                        @if ($empleado === null)
                            <div class="p-3 mt-3 text-center dropdown-menu dropdown-menu-right hide"
                                style="width:100px; box-shadow: 0px 3px 6px 1px #00000029; border-radius: 4px; border:none;">
                                <div class="px-3 mt-1 d-flex justify-content-center">
                                    <a style="all: unset; color: #747474; cursor: pointer;"
                                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                        <i class="bi bi-box-arrow-right"></i> Salir
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="p-3 mt-3 text-center dropdown-menu dropdown-menu-right hide"
                                style="width:300px; box-shadow: 0px 3px 6px 1px #00000029; border-radius: 4px; border:none;">
                                <div class="p-2">
                                    <p class="m-0 mt-2 text-muted" style="font-size:14px">Hola,
                                        <strong>{{ $empleado->name }}</strong>
                                    </p>
                                </div>
                                <div class="px-3 mt-1 d-flex justify-content-center">
                                    @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                                        @can('profile_password_edit')
                                            <a style="all: unset; color: #747474; cursor: pointer;"
                                                class=" {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                                                href="{{ route('profile.password.edit') }}">
                                                <i class="bi bi-gear"></i>
                                                Configurar Perfil
                                            </a>
                                        @endcan
                                    @endif
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <font style="color: #747474;">|</font>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a style="all: unset; color: #747474; cursor: pointer;"
                                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                        <i class="bi bi-box-arrow-right"></i> Salir
                                    </a>
                                </div>
                            </div>
                        @endif
                    </li>
                </ul>
            @endif
        </div>
        <div class="menu-hedare-window">
            <div class="item-content-menu-header" style="background-color: #EEF6FF; min-width: 280px;">
                <div class="logo-org-header">
                    <img src="{{ asset($logotipo) }}">
                </div>

                <span class="title-item-menu-header">MI PANEL</span>

                <ul class="menu-list-panel-header">
                    @can('mi_perfil_acceder')
                        <li>
                            <a href="{{ route('admin.inicio-Usuario.index') }}">
                                <i class="bi bi-file-person-fill"></i>
                                Mi perfil
                            </a>
                        </li>
                    @endcan
                    @can('portal_de_comunicaccion_acceder')
                        <li>
                            <a href="{{ route('admin.portal-comunicacion.index') }}">
                                <i class="bi bi-newspaper"></i>
                                Comunicación
                            </a>
                        </li>
                    @endcan
                    @can('calendario_corporativo_acceder')
                        <li>
                            <a href="{{ route('admin.systemCalendar') }}">
                                <i class="bi bi-calendar3"></i>
                                Calendario
                            </a>
                        </li>
                    @endcan
                    @can('documentos_publicados_acceder')
                        <li>
                            <a href="{{ route('admin.documentos.publicados') }}">
                                <i class="bi bi-folder"></i>
                                Documentos
                            </a>
                        </li>
                    @endcan
                    @can('planes_de_accion_acceder')
                        <li>
                            <a href="{{ route('admin.planes-de-accion.index') }}">
                                <i class="bi bi-file-earmark-check"></i>
                                Planes de Trabajo
                            </a>
                        </li>
                    @endcan
                    @can('centro_de_atencion_acceder')
                        <li>
                            <a href="{{ route('admin.desk.index') }}">
                                <i class="bi bi-person-workspace"></i>
                                Centro de atención
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a href="{{ route('admin.timesheet-create') }}">
                            <i class="bi bi-calendar-plus"></i>
                            Timesheet
                        </a>
                    </li>
                </ul>
            </div>
            @if (
                $usuario->can('clausulas_auditorias_acceder') ||
                    $usuario->can('mis_cursos_acceder') ||
                    $usuario->can('sistema_gestion_contratos_acceder') ||
                    $usuario->can('administracion_sistema_gestion_contratos_acceder') ||
                    $usuario->can('analisis_de_riesgo_integral_acceder') ||
                    $usuario->can('sistema_de_gestion_acceder') ||
                    $usuario->can('planes_de_accion_acceder') ||
                    $usuario->can('control_documentar_acceder') ||
                    $usuario->can('visitantes_acceder') ||
                    $usuario->can('capital_humano_acceder'))
                <div class="item-content-menu-header" style="background-color: #fff;">
                    <span class="title-item-menu-header">MÓDULOS TABANTAJ</span>
                    <div class="menu-blocks-mod-header">
                        @can('mis_cursos_acceder')
                            <a href="{{ route('admin.mis-cursos') }}">
                                <div class="caja-icon-mod-header" style="background: #9CEBFF;">
                                    <i class="material-symbols-outlined">school</i>
                                </div>
                                <span>Capacitaciones</span>
                            </a>
                        @endcan
                        {{-- @if ($usuario->can('sistema_gestion_contratos_acceder') || $usuario->can('administracion_sistema_gestion_contratos_acceder'))
                            <a href="{{ asset('contract_manager/katbol') }}  ">
                                <div class="caja-icon-mod-header" style="background: #BFFFE9;">
                                    <i class="material-symbols-outlined">request_quote</i>
                                </div>
                                <span>Finanzas</span>
                            </a>
                        @endif --}}
                        @can('sistema_de_gestion_acceder')
                            <a href="{{ route('admin.iso27001.inicio-guia') }}">
                                <div class="caja-icon-mod-header" style="background: #F1F1F1;">
                                    <i class="material-symbols-outlined">emoji_people</i>
                                </div>
                                <span>Gestión Normativa</span>
                            </a>
                        @endcan
                        @can('matriz_de_riesgo_acceder')
                            <a href="{{ route('admin.analisis-riesgos.menu') }}">
                                <div class="caja-icon-mod-header" style="background: #FCB4BC;">
                                    <i class="material-symbols-outlined">report</i>
                                </div>
                                <span>Gestión de Riesgos</span>
                            </a>
                        @endcan
                        @if (
                            $usuario->can('sistema_gestion_contratos_acceder') ||
                                $usuario->can('administracion_sistema_gestion_contratos_acceder'))
                            <a href="{{ url('contract_manager/katbol') }}">
                                <div class="caja-icon-mod-header" style="background: #E0C5FF;">
                                    <i class="material-symbols-outlined">assignment</i>
                                </div>
                                <span>Gestión Contractual</span>
                            </a>
                        @endif
                        @can('planes_de_accion_acceder')
                            <a href="{{ asset('admin/planes-de-accion') }}">
                                <div class="caja-icon-mod-header" style="background: #B1C6FF;">
                                    <i class="material-symbols-outlined">shield_person</i>
                                </div>
                                <span>Planes de Trabajo</span>
                            </a>
                        @endcan
                        @can('control_documentar_acceder')
                            <a href="{{ asset('admin/documentos') }}">
                                <div class="caja-icon-mod-header" style="background: #FFFDC4;">
                                    <i class="material-symbols-outlined">folder_copy</i>
                                </div>
                                <span>Gestor Documental</span>
                            </a>
                        @endcan
                        @can('visitantes_acceder')
                            <a href="{{ route('admin.visitantes.menu') }}">
                                <div class="caja-icon-mod-header" style="background: #FFD9ED;">
                                    <i class="material-symbols-outlined">group</i>
                                </div>
                                <span>Visitantes</span>
                            </a>
                        @endcan
                        @can('capital_humano_acceder')
                            <a href="{{ route('admin.capital-humano.index') }}">
                                <div class="caja-icon-mod-header" style="background: #FFD3BF;">
                                    <i class="material-symbols-outlined">diversity_3</i>
                                </div>
                                <span>Gestión de Talento</span>
                            </a>
                        @endcan
                    </div>
                </div>
            @endif
            @if (
                $usuario->can('clausulas_auditorias_acceder') ||
                    $usuario->can('clasificaciones_auditorias_acceder') ||
                    $usuario->can('configurar_organizacion_acceder') ||
                    $usuario->can('mi_organizacion_acceder') ||
                    $usuario->can('sedes_acceder') ||
                    $usuario->can('crear_grupo_acceder') ||
                    $usuario->can('crear_area_acceder') ||
                    $usuario->can('macroprocesos_acceder') ||
                    $usuario->can('procesos_acceder') ||
                    $usuario->can('categoria_activos_acceder') ||
                    $usuario->can('subcategoria_activos_acceder') ||
                    $usuario->can('inventario_activos_acceder') ||
                    $usuario->can('glosario_acceder') ||
                    $usuario->can('configurar_capital_humano') ||
                    $usuario->can('lista_de_perfiles_de_puesto_acceder') ||
                    $usuario->can('niveles_jerarquicos_acceder') ||
                    $usuario->can('bd_empleados_acceder') ||
                    $usuario->can('capacitaciones_categorias_acceder') ||
                    $usuario->can('capacitaciones_acceder') ||
                    $usuario->can('configurar_vistas_acceder') ||
                    $usuario->can('configurar_vista_mis_datos_acceder') ||
                    $usuario->can('mi_organizacion_acceder') ||
                    $usuario->can('ajustes_usuario_acceder') ||
                    $usuario->can('roles_acceder') ||
                    $usuario->can('usuarios_acceder') ||
                    $usuario->can('configurar_soporte_acceder'))
                <div class="item-content-menu-header line-left caja-menu-admin-header overflow-hidden"
                    style="background-color: #fff; min-width: 280px;">
                    <span class="title-item-menu-header">ADMINISTRACIÓN</span>
                    <div class="overflow-auto scroll_estilo" style="max-height:400px;  width: 120%;">
                        <ul class="menu-list-admin-header ">
                            @if ($usuario->can('clausulas_auditorias_acceder') || $usuario->can('clasificaciones_auditorias_acceder'))
                                <li class="li-click-list-header">
                                    <a href="#">
                                        <i class="bi bi-file-earmark-arrow-up"></i>
                                        Ajustes SG
                                        <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                                    </a>
                                    <ul>
                                        <li><a href="{{ asset('admin/lista-distribucion') }}">Lista de
                                                distribución</a>
                                        </li>
                                        @can('clausulas_auditorias_acceder')
                                            <li><a href="{{ route('admin.auditoria-clasificacion') }}">Clasificación</a>
                                            </li>
                                        @endcan
                                        @can('clasificaciones_auditorias_acceder')
                                            <li><a href="{{ route('admin.auditoria-clausula') }}">Cláusula</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif
                            @can('configurar_organizacion_acceder')
                                <li class="li-click-list-header">
                                    <a href="#">
                                        <i class="bi bi-buildings"></i>
                                        Configurar Organización
                                        <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                                    </a>
                                    <ul>
                                        @can('mi_organizacion_acceder')
                                            <li><a href="{{ route('admin.organizacions.index') }}">Organización</a></li>
                                        @endcan
                                        @can('sedes_acceder')
                                            <li><a href="{{ route('admin.sedes.index') }}">Sedes</a></li>
                                        @endcan
                                        @can('crear_grupo_acceder')
                                            <li><a href="{{ route('admin.grupoarea.index') }}">Crear Grupo de Áreas</a></li>
                                        @endcan
                                        @can('crear_area_acceder')
                                            <li><a href="{{ route('admin.areas.index') }}">Crear Áreas</a></li>
                                        @endcan
                                        <li>
                                            <a href="{{ route('admin.lista-informativa.index') }}">Lista Informativa</a>
                                        </li>
                                        @can('macroprocesos_acceder')
                                            <li><a href="{{ route('admin.macroprocesos.index') }}">Macroprocesos</a></li>
                                        @endcan
                                        @can('procesos_acceder')
                                            <li><a href="{{ route('admin.procesos.index') }}">Procesos</a></li>
                                        @endcan
                                        @can('categoria_activos_acceder')
                                            <li><a href="{{ route('admin.tipoactivos.index') }}">Categorias de Activos</a>
                                            </li>
                                        @endcan
                                        @can('subcategoria_activos_acceder')
                                            <li><a href="{{ route('admin.subtipoactivos.index') }}">Subcategorias de Activos
                                                </a>
                                            </li>
                                        @endcan
                                        @can('inventario_activos_acceder')
                                            <li><a href="{{ route('admin.activos.index') }}">Inventario de Activos</a></li>
                                        @endcan
                                        @can('glosario_acceder')
                                            <li><a href="{{ route('admin.glosarios.index') }}">Glosario</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('configurar_capital_humano')
                                <li class="li-click-list-header">
                                    <a href="#">
                                        <i class="bi bi-person-gear"></i>
                                        Configurar C. humano
                                        <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                                    </a>
                                    <ul>
                                        @can('lista_de_perfiles_de_puesto_acceder')
                                            <li><a href="{{ route('admin.puestos.index') }}">Puestos</a></li>
                                        @endcan
                                        @can('niveles_jerarquicos_acceder')
                                            <li><a href="{{ route('admin.perfiles.index') }}">Niveles Jerárquicos</a></li>
                                        @endcan
                                        @can('bd_empleados_acceder')
                                            <li><a href="{{ route('admin.empleados.index') }}">Empleados</a></li>
                                        @endcan
                                        @can('capacitaciones_categorias_acceder')
                                            <li><a href="{{ asset('admin/categoria-capacitacion') }}">Categorías de
                                                    Capacitaciones
                                                </a></li>
                                        @endcan
                                        @can('capacitaciones_acceder')
                                            <li><a href="{{ asset('admin/recursos') }}">Capacitaciones</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('configurar_vistas_acceder')
                                <li class="li-click-list-header">
                                    <a href="#">
                                        <i class="bi bi-laptop"></i>
                                        Configurar Vistas
                                        <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                                    </a>
                                    <ul>
                                        @can('configurar_vista_mis_datos_acceder')
                                            <li><a href="{{ route('admin.panel-inicio.index') }}">Mis Datos</a></li>
                                        @endcan
                                        @can('mi_organizacion_acceder')
                                            <li><a href="{{ route('admin.panel-organizacion.index') }}">Mi Organización</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('ajustes_usuario_acceder')
                                <li class="li-click-list-header">
                                    <a href="#">
                                        <i class="bi bi-gear"></i>
                                        Ajuste de usuario
                                        <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                                    </a>
                                    <ul>
                                        @can('roles_acceder')
                                            <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                                        @endcan
                                        @can('usuarios_acceder')
                                            <li><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('configurar_soporte_acceder')
                                <li class="li-click-list-header">
                                    <a href="#">
                                        <i class="bi bi-gear"></i>
                                        Ajuste de sistema
                                        <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('admin.configurar-soporte.index') }}">Configurar Soporte</a>
                                        </li>
                                        <li><a href="{{ route('admin.visualizar-logs.index') }}">Visualizar Logs</a></li>
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            @endif
            <div class="item-content-menu-header caja-img-escritorio-header"
                style="background-color: #e7ecef; padding: 0px;">
                <img src="{{ asset('img/escritorio-header.webp') }}" alt="" class="img-escritorio-header">
            </div>
        </div>
        <div class="bg-black-header-menu" onclick="menuHeader();"></div>
    </header>

    {{-- @include('partials.menu') --}}
    <div class="c-wrapper" id="contenido_body_general_wrapper">
        <div class="c-body">
            <main class="c-main" style="zoom: 90%;">
                <div class="container-fluid" id="app">
                    @if (session('message'))
                        <div class="mb-2 row">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                </div>
                @endif
                <div id="errores_generales_admin_quitar_recursos">
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                @yield('content')
            </main>
        </div>

    </div>
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <!-- incluir de footer -->

    <div id="elementos_imprimir" class="d-none">
        <div id="contenido_imprimir">

        </div>
    </div>

    <div id="tabla_imprimir_global" class="d-none">
        <div id="contenido_imprimir">
            <table class="encabezado-print">
                <tr>
                    <td style="width: 25%;">
                        <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 70px;">
                    </td>
                    <td style="width: 50%;">
                        <h4><strong>{{ !is_null($organizacion) ? $organizacion->empresa : 'Tabantaj' }}</strong></h4>
                        <div id="titulo_tabla"></div>
                    </td>
                    <td style="width: 25%;" class="encabezado_print_td_no_paginas">
                        Fecha: {{ $hoy_format_global }} <br>
                    </td>
                </tr>
            </table>

            <table class="table mt-3 w-100" id="tabla_blanca_imprimir_global">

            </table>
        </div>
    </div>

    <div class="barra-herramientas-bottom-molbile">
        <a href="{{ route('admin.inicio-Usuario.index') }}#datos" class="btn-barra-bottom-mobile"
            {{ request()->is('admin/inicioUsuario') || request()->is('admin/inicioUsuario/*') || request()->is('admin/competencias/*/cv') ? 'style=color:#3086AF !important;"' : '' }}>
            <i class="bi bi-file-person"></i>
            <p>Perfil</p>
        </a>
        <a href="{{ route('admin.timesheet-create') }}" class="btn-barra-bottom-mobile"
            {{ request()->is('admin/timesheet') || request()->is('admin/timesheet/*') ? 'style=color:#3086AF !important;"' : '' }}>
            <i class="bi bi-calendar3-range"></i>
            <p>Timesheet</p>
        </a>
        <a href="{{ route('admin.systemCalendar') }}" class="btn-barra-bottom-mobile"
            {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'style=color:#3086AF !important;"' : '' }}>
            <i class="bi bi-calendar3"></i>
            <p>Calendario</p>
        </a>
        <a href="{{ route('admin.portal-comunicacion.index') }}" class="btn-barra-bottom-mobile"
            {{ request()->is('admin/portal-comunicacion') || request()->is('admin/portal-comunicacion/*') ? 'style=color:#3086AF !important;"' : '' }}>
            <i class="bi bi-newspaper"></i>
            <p>Comunicación</p>
        </a>
    </div>

    <!-- inicia sección de script -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- Librerías para visualizar en campo el dolar --}}
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Notificaciones push desktop --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js"
        integrity="sha512-DjIQO7OxE8rKQrBLpVCk60Zu0mcFfNx2nVduB96yk5HS/poYZAkYu5fxpwXj3iet91Ezqq2TNN6cJh9Y5NtfWg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script async>
        window.onload = function() {
            // Check if the browser supports notifications
            if (!("Notification" in window)) {
                console.error("This browser does not support desktop notifications.");
            }
        };
    </script>
    {{-- Notificaciones push desktop --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    @livewireScripts
    <x-livewire-alert::scripts />

    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- js para validaciones globales -->
    <!--<script src="{{ asset('js/validations.js') }}"></script>-->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <script src="https://unpkg.com/@coreui/coreui@3.4.0/dist/js/coreui.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"
        defer></script> {{-- quitar script en el glosario --}}
    <script src="{{ asset('js/buttons.print.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script defer src="{{ asset('js/yearpicker.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script defer src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- x editable -->
    <script defer src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
    </script>
    <!-- termina sección de script -->


    <script async>
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "#loading").style.visibility = "visible";
            } else {
                document.querySelector(
                    "#loading").style.display = "none";
                document.querySelector(
                    "body").style.visibility = "visible";
            }
        };
    </script>
    <script defer>
        function imprimirElemento(elemento) {
            let elemento_seleccionado = document.getElementById(elemento);
            let contenido_imprimir = document.getElementById('contenido_imprimir').innerHTML = elemento_seleccionado
                .innerHTML;
            document.querySelector('#elementos_imprimir').classList.remove('d-none');
            document.querySelector('#contenido_body_general_wrapper').classList.add('vista_print');
            print();
            document.querySelector('#elementos_imprimir').classList.add('d-none');
            document.querySelector('#contenido_body_general_wrapper').classList.remove('vista_print');
        }

        function imprimirTabla(elemento, html = `
                    <h5>
                        <strong>
                            Registros
                        </strong>
                        <font style="font-weight: lighter;">

                        </font>
                    </h5>
                `) {
            let elemento_seleccionado = document.getElementById(elemento);
            document.getElementById('tabla_blanca_imprimir_global').innerHTML = elemento_seleccionado.innerHTML;
            document.getElementById('titulo_tabla').innerHTML = html;

            document.querySelector('#tabla_imprimir_global').classList.remove('d-none');
            document.querySelector('#contenido_body_general_wrapper').classList.add('vista_print');
            print();
            document.querySelector('#tabla_imprimir_global').classList.add('d-none');
            document.querySelector('#contenido_body_general_wrapper').classList.remove('vista_print');
        }
    </script>

    {{-- daterangepicker --}}
    <script defer>
        @if ($usuario->empleado)
            window.NotificationUser = {!! json_encode(['user' => auth()->check() ? $usuario->empleado->id : null]) !!};
        @else
            window.NotificationUser = 1
        @endif
    </script>

    <script>
        $(document).ready(function() {
            $('.c-sidebar-nav').animate({
                scrollTop: $(".c-active").offset()?.top - 350
            }, 0);
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(".btn_bajar_scroll").click(function() {
            $("lemnt_row_menu").fadeIn(0);
            $('.c-sidebar-nav').delay(1000).scrollTop(900);
        });
    </script>

    <script defer>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

    <!-- x-editable -->
    <script defer>
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.ajaxOptions = {
            type: 'PUT'
        };

        @yield('x-editable')
    </script>
    <!-- x-editable -->


    <script>
        $(function() {
            let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
            let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
            let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
            let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
            let printButtonTrans = '{{ trans('global.datatables.print') }}'
            let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
            let selectAllButtonTrans = '{{ trans('global.select_all') }}'
            let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

            let languages = {
                //'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                'es': {
                    decimal: "",
                    emptyTable: "No hay registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 to 0 of 0 registros",
                    infoFiltered: "(Filtrado de _MAX_ total registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: "Siguiente",
                        previous: "Anterior",
                    },
                },
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn'
            })
            $.extend(true, $.fn.dataTable.defaults, {
                // language: {
                //     url: languages['{{ app()->getLocale() }}']
                // },
                language: {
                    decimal: "",
                    emptyTable: "No hay registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 to 0 of 0 registros",
                    infoFiltered: "(Filtrado de _MAX_ total registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: '<i class="fas fa-chevron-right"></i>',
                        previous: '<i class="fas fa-chevron-left"></i>',
                    },
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                // select: {
                //     style: 'multi+shift',
                //     selector: 'td:first-child'
                // },
                order: [],
                scrollX: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, 50, 100, -1],
                    [5, 10, 20, 50, 100, "Todos"]
                ],
                //dom: 'lBfrtip<"actions">',
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12 p-0'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                buttons: [{
                        extend: 'selectAll',
                        className: 'btn-primary',
                        text: selectAllButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        },
                        action: function(e, dt) {
                            e.preventDefault()
                            dt.rows().deselect();
                            dt.rows({
                                search: 'applied'
                            }).select();
                        }
                    },
                    {
                        extend: 'selectNone',
                        className: 'btn-primary',
                        text: selectNoneButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        className: 'btn-default',
                        text: copyButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-default',
                        text: csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-default',
                        text: excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-default',
                        text: pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-default',
                        text: printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-default',
                        text: colvisButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>

    {{-- responsive --}}
    <script type="text/javascript">
        $(document).ready(function() {
            if ($(window).width() <= 800) {
                $('body').addClass('body-responsive-mobile');
            }
        });
        $(window).resize(function() {
            if ($(window).width() <= 800) {
                $('body').addClass('body-responsive-mobile');
            } else {
                $('body').removeClass('body-responsive-mobile');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".notifications-menu").on('click', function() {
                if (!$(this).hasClass('open')) {
                    $('.notifications-menu .label-warning').hide();
                    $.get('/admin/user-alerts/read');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(".caja_botones_menu a").click(function() {
            $(".caja_botones_menu a").removeClass("btn_activo");
            $(".caja_botones_menu a:hover").addClass("btn_activo");
        });
    </script>

    {{-- menus tabs --}}
    <script type="text/javascript">
        $(".caja_botones_menu a").click(function() {
            $(".caja_botones_menu a").removeClass("btn_activo");
            $(".caja_botones_menu a:hover").addClass("btn_activo");
        });
    </script>

    <script type="text/javascript">
        $(".caja_botones_menu a").click(function() {
            $("section").removeClass("caja_tab_reveldada");
            var id_seccion = $(".caja_botones_menu a:hover").attr('data-tabs');
            $(document.getElementById(id_seccion)).addClass("caja_tab_reveldada");
        });
        $('.modal').on('shown.bs.modal', function(event) {
            let modalBackDrop = document.querySelector('.modal-backdrop');
            if (modalBackDrop) {
                modalBackDrop.style.width = "100%";
                modalBackDrop.style.height = "100%"
            }
        })
    </script>

    <script>
        $('.li-click-list-header').click(function() {
            $('.li-click-list-header:hover').toggleClass('active-ul-header');
        });
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    @yield('scripts')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery-idletimer/1.0.0/idle-timer.min.js"
        integrity="sha512-hh4Bnn1GtJOoCXufO1cvrBF6BzRWBp7rFiQCEdSRwwxJVdCIlrp6AWeD8GJVbnLO9V1XovnJSylI5/tZGOzVAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(".animated-over .form-control").change(function(e) {
            console.log(e.target);
            if (e.target.value == "") {
                $(e.target).removeClass("input-content-animated");
            } else {
                $(e.target).addClass("input-content-animated");
            }
        });
    </script>

    <script>
        function menuHeader() {
            document.querySelector('header').classList.toggle('mostrar-menu');
            document.querySelector('.btn-menu-header').classList.toggle('active');
            document.querySelector('.bg-black-header-menu').classList.toggle('active');
        }
    </script>

    <script defer>
        var inputs = document.querySelectorAll('input[type="text"]');
        var inputTextarea = document.querySelectorAll('textarea');
        // Agregar un event listener a cada elemento input
        inputs.forEach(function(input) {
            validate(input, 250);
        });
        inputTextarea.forEach(function(input) {
            validate(input, 490);
        });

        function validate(input, caracteres) {
            var nuevoSpan = document.createElement('span');
            nuevoSpan.textContent = '¡Estas a punto de llegar a los ' + caracteres + ' caracteres!';
            nuevoSpan.style.color = 'red';
            input.addEventListener('input', function() {
                // Acciones a realizar cuando se ingresa texto en un input
                console.log('Se ingresó texto en el input con ID:', input.id);
                if (input.value.length > caracteres) {
                    nuevoSpan.style.display = 'block';
                    if (input.nextSibling) {
                        console.log('si hay un elemento despues', input.nextElementSibling);
                        var elemento = input.nextElementSibling;
                        elemento.parentNode.insertBefore(nuevoSpan, elemento.nextSibling);
                    } else {
                        console.log('no hay elemento');
                        input.parentNode.insertBefore(nuevoSpan, input.nextSibling);
                    }

                } else {
                    nuevoSpan.style.display = 'none';
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let lineActiveNav = document.createElement('div');
            lineActiveNav.classList.add('line-active-nav');

            document.querySelectorAll('.nav-tabs').forEach(element => {
                element.appendChild(lineActiveNav);
            });
        });
        $('.nav-link').click(function moveLineNav(e) {
            let boundLink = e.target.getBoundingClientRect();
            let boundNav = document.querySelector('.nav.nav-tabs:hover').getBoundingClientRect();

            let offsetTop = boundLink.top - boundNav.top + boundLink.height - 10;
            let offsetLeft = boundLink.left - boundNav.left;

            let line = document.querySelector('.nav-tabs:hover .line-active-nav');

            line.style.top = offsetTop + 'px';
            line.style.left = offsetLeft + 25 + 'px';
            line.style.width = boundLink.width - 50 + 'px';
        });
    </script>

</body>

</html>
