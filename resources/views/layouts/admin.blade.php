<!DOCTYPE html>
<html lang="esp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    <title>{{ trans('panel.site_title') }}</title>
    @yield('css')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- boostrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj_v2.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dark_mode.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/yearpicker.css') }}">
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
    {{-- <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" type="text/css" href=" https://printjs-4de6.kxcdn.com/print.min.css"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://storage.googleapis.com/non-spec-apps/mio-icons/latest/outline.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,300,0,0" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rds.css') }}">
    @yield('styles')
    @livewireStyles
</head>

<body>
    <div id="loading">
        <img id="loading-image" src="https://i.pinimg.com/originals/07/24/88/0724884440e8ddd0896ff557b75a222a.gif"
            alt="Loading...">
    </div>
    @php
        use App\Models\Organizacion;
        use App\Models\User;
        $usuario = User::getCurrentUser();
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
                <button onclick="document.querySelector('header').classList.toggle('mostrar-menu')">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <a href="{{ url('/') }}"><img src="{{ asset('img/logo-ltr.png') }}" alt="Logo Tabantaj"
                        style="height: 40px;"></a>
                @livewire('global-search-component', ['lugar' => 'header'])
            </div>
            @if ($usuario->empleado)
                <div class="caja-user-header">
                    {{ $usuario->empleado ? explode(' ', $usuario->empleado->name)[0] : '' }}
                    <div class="caja-img-user-header">
                        <img src="{{ asset('storage/empleados/imagenes/' . '/' . $usuario->empleado->avatar) }}"
                            alt="{{ $usuario->empleado->name }}">
                    </div>
                </div>
            @endif
        </div>
        <div class="menu-hedare-window">
            <div class="item-content-menu-header" style="background-color: #EEF6FF; min-width: 280px;">
                <span class="title-item-menu-header">MI PANEL</span>

                <ul class="menu-list-panel-header">
                    <li>
                        <a href="{{ route('admin.inicio-Usuario.index') }}">
                            <i class="bi bi-file-person-fill"></i>
                            Mi perfil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.portal-comunicacion.index') }}">
                            <i class="bi bi-newspaper"></i>
                            Comunicación
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.systemCalendar') }}">
                            <i class="bi bi-calendar3"></i>
                            Calendario
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.documentos.publicados') }}">
                            <i class="bi bi-folder"></i>
                            Documentos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.planes-de-accion.index') }}">
                            <i class="bi bi-file-earmark-check"></i>
                            Planes de acción
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.desk.index') }}">
                            <i class="bi bi-person-workspace"></i>
                            Centro de atención
                        </a>
                    </li>
                </ul>
            </div>
            <div class="item-content-menu-header" style="background-color: #fff;">
                <span class="title-item-menu-header">MÓDULOS TABANTAJ</span>
                <div class="menu-blocks-mod-header">
                    <a href="{{ asset('admin/capacitaciones-inicio') }}">
                        <div class="caja-icon-mod-header" style="background: #9CEBFF;">
                            <i class="material-symbols-outlined">school</i>
                        </div>
                        <span>Capacitaciones</span>
                    </a>
                    <a href="{{ asset('contract_manager/katbol') }}  ">
                        <div class="caja-icon-mod-header" style="background: #BFFFE9;">
                            <i class="material-symbols-outlined">request_quote</i>
                        </div>
                        <span>Finanzas</span>
                    </a>
                    <a href="{{ route('admin.iso27001.inicio-guia') }}">
                        <div class="caja-icon-mod-header" style="background: #F1F1F1;">
                            <i class="material-symbols-outlined">emoji_people</i>
                        </div>
                        <span>Gestión Normativa</span>
                    </a>
                    <a href="{{ route('admin.analisis-riesgos.menu') }}">
                        <div class="caja-icon-mod-header" style="background: #FCB4BC;">
                            <i class="material-symbols-outlined">report</i>
                        </div>
                        <span>Gestión de Riesgos</span>
                    </a>
                    <a href="{{ url('contract_manager/katbol') }}">
                        <div class="caja-icon-mod-header" style="background: #E0C5FF;">
                            <i class="material-symbols-outlined">assignment</i>
                        </div>
                        <span>Gestión Contractual</span>
                    </a>
                    <a href="{{ asset('admin/planes-de-accion') }}">
                        <div class="caja-icon-mod-header" style="background: #B1C6FF;">
                            <i class="material-symbols-outlined">shield_person</i>
                        </div>
                        <span>Admin. de Proyectos</span>
                    </a>
                    <a href="{{ asset('admin/documentos') }}">
                        <div class="caja-icon-mod-header" style="background: #FFFDC4;">
                            <i class="material-symbols-outlined">folder_copy</i>
                        </div>
                        <span>Gestor Documental</span>
                    </a>
                    <a href="{{ route('admin.visitantes.menu') }}">
                        <div class="caja-icon-mod-header" style="background: #FFD9ED;">
                            <i class="material-symbols-outlined">group</i>
                        </div>
                        <span>Visitantes</span>
                    </a>
                    <a href="{{ route('admin.capital-humano.index') }}">
                        <div class="caja-icon-mod-header" style="background: #FFD3BF;">
                            <i class="material-symbols-outlined">diversity_3</i>
                        </div>
                        <span>Gestión de Talento</span>
                    </a>
                </div>
            </div>
            <div class="item-content-menu-header line-left caja-menu-admin-header overflow-hidden"
                style="background-color: #fff; min-width: 280px;">
                <span class="title-item-menu-header">ADMINISTRACIÓN</span>
                <div class="overflow-auto scroll_estilo" style="max-height:400px;  width: 120%;">
                    <ul class="menu-list-admin-header ">
                        <li class="li-click-list-header">
                            <a href="#">
                                <i class="bi bi-file-earmark-arrow-up"></i>
                                Ajustes SG
                                <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                            </a>
                            <ul>
                                <li><a href="{{ asset('admin/lista-distribucion') }}">Lista de distribución</a>
                                </li>
                                <li><a href="{{ route('admin.auditoria-clasificacion') }}">Clasificación</a></li>
                                <li><a href="{{ route('admin.auditoria-clausula') }}">Cláusula</a></li>
                            </ul>
                        </li>
                        <li class="li-click-list-header">
                            <a href="#">
                                <i class="bi bi-buildings"></i>
                                Configurar Organización
                                <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.organizacions.index') }}">Organización</a></li>
                                <li><a href="{{ route('admin.sedes.index') }}">Sedes</a></li>
                                <li><a href="{{ route('admin.grupoarea.index') }}">Crear Grupo de Áreas</a></li>
                                <li><a href="{{ route('admin.areas.index') }}">Crear Áreas</a></li>
                                <li><a href="{{ route('admin.macroprocesos.index') }}">Macroprocesos</a></li>
                                <li><a href="{{ route('admin.procesos.index') }}">Procesos</a></li>
                                <li><a href="{{ route('admin.tipoactivos.index') }}">Categorias de Activos</a></li>
                                <li><a href="{{ route('admin.subtipoactivos.index') }}">Subcategorias de Activos </a>
                                </li>
                                <li><a href="{{ route('admin.activos.index') }}">Inventario de Activos</a></li>
                                <li><a href="{{ route('admin.glosarios.index') }}">Glosario</a></li>
                            </ul>
                        </li>
                        <li class="li-click-list-header">
                            <a href="#">
                                <i class="bi bi-person-gear"></i>
                                Configurar C. humano
                                <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.puestos.index') }}">Puestos</a></li>
                                <li><a href="{{ route('admin.perfiles.index') }}">Niveles Jerárquicos</a></li>
                                <li><a href="{{ route('admin.empleados.index') }}">Empleados</a></li>
                                <li><a href="{{ asset('admin/categoria-capacitacion') }}">Categorías de Capacitaciones
                                    </a></li>
                                <li><a href="{{ asset('admin/recursos') }}">Capacitaciones</a></li>
                            </ul>
                        </li>
                        <li class="li-click-list-header">
                            <a href="#">
                                <i class="bi bi-laptop"></i>
                                Configurar Vistas
                                <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.panel-inicio.index') }}">Mis Datos</a></li>
                                <li><a href="{{ route('admin.panel-organizacion.index') }}">Mi Organización</a></li>
                            </ul>
                        </li>
                        <li class="li-click-list-header">
                            <a href="#">
                                <i class="bi bi-gear"></i>
                                Ajuste de usuario
                                <i class="material-symbols-outlined i-direct">keyboard_arrow_down</i>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                                <li><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                            </ul>
                        </li>
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
                    </ul>
                </div>
            </div>
            <div class="item-content-menu-header caja-img-escritorio-header"
                style="background-color: #e7ecef; padding: 0px;">
                <img src="{{ asset('img/escritorio-header.png') }}" alt="" class="img-escritorio-header">
            </div>
        </div>
    </header>

    {{-- @include('partials.menu') --}}
    <div class="c-wrapper" id="contenido_body_general_wrapper">
        {{-- <header class="px-3 c-header c-header-fixed" style="border: none;">
            <button class="c-header-toggler c-class-toggler d-lg-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
                <i class="fas fa-fw fa-bars iconos_cabecera" style="color:#fff;"></i>
            </button>
            <button id="btnMenu" style="all:unset; color: #fff; cursor:pointer;" class="d-md-down-none">
                <i class="fas fa-fw fa-bars" style=""></i>
            </button>
            <script>
                const btnMenu = document.querySelector('#btnMenu');
                btnMenu.addEventListener('click', () => {
                    document.body.classList.toggle('c-sidebar-lg-show');

                    if (document.body.classList.contains('c-sidebar-lg-show')) {
                        localStorage.setItem('menu-mode', 'true');
                    } else {
                        localStorage.setItem('menu-mode', 'false');
                    }
                });

                if (localStorage.getItem('menu-mode') === 'true') {
                    document.body.classList.add('c-sidebar-lg-show');
                } else {
                    document.body.classList.remove('c-sidebar-lg-show');
                }
            </script>

            <form class="form-inline col-sm-3 d-mobile-none" style="position: relative;">
                <input class="buscador-global" type="search" id="buscador_global" placeholder="Buscador..."
                    autocomplete="off" />
                <i class="fas fa-spinner fa-pulse d-none" id="buscando" style="margin-left:-45px"></i>
                <div id="resultados_sugeridos"
                    style="background-color: #fff; width:150%; position: absolute;top:50px;left:0">
                </div>
            </form>
            <ul class="ml-auto c-header-nav">
                @if (count(config('panel.available_languages', [])) > 1)
                    <li class="c-header-nav-item dropdown d-md-down-none">
                        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach (config('panel.available_languages') as $langLocale => $langName)
                                <a class="dropdown-item"
                                    href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }}
                                    ({{ $langName }})
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endif

                <ul class="ml-auto c-header-nav">
                    <li class="c-header-nav-item dropdown show">
                        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <div style="width:100%; display: flex; align-items: center;">
                                @if ($usuario->empleado)
                                    <div style="width: 40px; overflow:hidden;" class="mr-2">
                                        <img class="img_empleado" style=""
                                            src="{{ asset('storage/empleados/imagenes/' . '/' . $usuario->empleado->avatar) }}"
                                            alt="{{ $usuario->empleado->name }}">
                                    </div>
                                    <div class="d-mobile-none">
                                        <span class="mr-2" style="font-weight: bold;">
                                            {{ $usuario->empleado ? explode(' ', $usuario->empleado->name)[0] : '' }}
                                        </span>
                                        <p class="m-0" style="font-size: 8px">
                                            {{ $usuario->empleado ? Str::limit($usuario->empleado->puesto, 30, '...') : '' }}
                                        </p>
                                    </div>
                                @else
                                    <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                                @endif
                            </div>
                        </a>

                        @if ($usuario->empleado === null)
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
                                        <strong>{{ $usuario->empleado->name }}</strong>
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
            </ul>
        </header> --}}

        <div class="c-body">
            <main class="c-main">
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

        {{-- @include('partials.footer') --}}
        {{-- <footer class="app-footer">
            <div>
                TABANTAJ
                <font style="margin: 0px 20px;"> | </font>
                SILENT4BUSINESS
            </div>
            <div>
                2023
                <font style="margin: 0px 20px;"> | </font>
                Version: 4.34.10
            </div>
        </footer> --}}
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
        <a href="{{ route('admin.timesheet-inicio') }}" class="btn-barra-bottom-mobile"
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
    <script>
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
    <script>
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
    <script>
        @if ($usuario->empleado)
            window.NotificationUser = {!! json_encode(['user' => auth()->check() ? $usuario->empleado->id : null]) !!};
        @else
            window.NotificationUser = 1
        @endif
    </script>

    <script src="https://js.pusher.com/7.6.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('e2eb23f0f55bcbd3ee2f', {
            cluster: 'us2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script>
    {{-- Librerías para visualizar en campo el dolar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script> --}}


    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <script src="https://unpkg.com/@coreui/coreui@3.4.0/dist/js/coreui.bundle.min.js"></script>
    {{-- #lazyload --}}
    {{--  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js">  --}}
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    {{-- <script src="{{ asset('tabantaj/push/bin/push.min.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js">
    </script> --}}
    {{-- <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script> --}}
    <script src="{{ asset('js/buttons.print.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"
        defer></script> {{-- quitar script en el glosario --}}
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js">
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script src="{{ asset('js/yearpicker.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
        integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/plugins/monthSelect/style.min.css"
        integrity="sha512-V7B1IY1DE/QzU/pIChM690dnl44vAMXBidRNgpw0mD+hhgcgbxHAycRpOCoLQVayXGyrbC+HdAONVsF+4DgrZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>

    {{--  https://www.udemy.com/course/kubernetes-sencillo-para-desarrolladores/learn/lecture/14674434#overview  --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css"> --}}
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- x editable -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    @livewireScripts

    <x-livewire-alert::scripts />
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

    <script src="https://cdn.jsdelivr.net/gh/livewire/vue@v0.3.x/dist/livewire-vue.js"></script>
    <!-- x-editable -->
    <script>
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
    <script>
        $(document).ready(function() {
            let url = "{{ route('admin.globalStructureSearch') }}";
            $("#buscador_global").click(function(e) {
                e.preventDefault();
                let sugeridos = document.querySelector(
                    "#resultados_sugeridos");
                sugeridos.innerHTML = "";
                this.value = "";
                $("#buscando").removeClass('d-block');
                $("#buscando").addClass('d-none');
            });
            $("#buscador_global").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        term: $(this).val().toLowerCase()
                    },
                    beforeSend: function() {
                        $("#buscando").removeClass('d-none');
                        $("#buscando").addClass('d-block');
                    },
                    success: function(data) {
                        if (data.length == undefined) {
                            let filtro = "<ul class='list-group'>";
                            for (const [key, value] of Object.entries(data)) {
                                filtro += `
                                <a class="list-group-item list-group-item-action" href="${value}">
                                    <i class="mr-2 fas fa-search-location"></i>${key}
                                </a>
                            `;
                            }
                            filtro += "</ul>";
                            $("#buscando").removeClass('d-block');
                            $("#buscando").addClass('d-none');
                            // $("#resultados_sugeridos").show();
                            let sugeridos = document.querySelector(
                                "#resultados_sugeridos");
                            sugeridos.innerHTML = filtro;
                        } else if (data.length == 0) {
                            $("#buscando").removeClass('d-block');
                            $("#buscando").addClass('d-none');
                            let sugeridos = document.querySelector(
                                "#resultados_sugeridos");
                            sugeridos.innerHTML =
                                `<ul class='list-group'><li class="list-group-item">
                                    <i class="mr-2 fas fa-times-circle"></i>Sin resultados encontrados...
                                    </li>
                                </ul>`;
                        } else {
                            $("#buscando").removeClass('d-block');
                            $("#buscando").addClass('d-none');
                            let sugeridos = document.querySelector(
                                "#resultados_sugeridos");
                            sugeridos.innerHTML = "";
                        }

                        // $("#participantes_search").css("background", "#FFF");
                    }
                });
            });
            $('.searchable-field').select2({
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route('admin.globalSearch') }}',
                    dataType: 'json',
                    type: 'GET',
                    delay: 200,
                    data: function(term) {
                        return {
                            search: term
                        };
                    },
                    results: function(data) {
                        return {
                            data
                        };
                    }
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateResult: formatItem,
                templateSelection: formatItemSelection,
                placeholder: '{{ trans('global.search') }}...',
                language: {
                    inputTooShort: function(args) {
                        var remainingChars = args.minimum - args.input.length;
                        var translation = '{{ trans('global.search_input_too_short') }}';

                        return translation.replace(':count', remainingChars);
                    },
                    errorLoading: function() {
                        return '{{ trans('global.results_could_not_be_loaded') }}';
                    },
                    searching: function() {
                        return '{{ trans('global.searching') }}';
                    },
                    noResults: function() {
                        return '{{ trans('global.no_results') }}';
                    },
                }

            });

            function formatItem(item) {
                if (item.loading) {
                    return '{{ trans('global.searching') }}...';
                }
                var markup = "<div class='searchable-link' href='" + item.url + "'>";
                markup += "<div class='searchable-title'>" + item.model + "</div>";
                $.each(item.fields, function(key, field) {
                    markup += "<div class='searchable-field'>" + item.fields_formated[field] +
                        " : " +
                        item[field] + "</div>";
                });
                markup += "</div>";

                return markup;
            }

            function formatItemSelection(item) {
                if (!item.model) {
                    return '{{ trans('global.search') }}...';
                }
                return item.model;
            }

            $(document).delegate('.searchable-link', 'click', function() {
                var url = $(this).attr('href');
                window.location = url;
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

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    {{--  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>  --}}
    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-idletimer/1.0.0/idle-timer.min.js"
        integrity="sha512-hh4Bnn1GtJOoCXufO1cvrBF6BzRWBp7rFiQCEdSRwwxJVdCIlrp6AWeD8GJVbnLO9V1XovnJSylI5/tZGOzVAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script>
        $(function() {
            let idleTime = Number(@json(env('SESSION_LIFETIME')))*60*1000; // in milliseconds
            if (idleTime == 0) {
                idleTime = 120*60*1000;
            }
            console.log(idleTime);
            // Set idle time
            $(document).idleTimer(idleTime); // in milliseconds
        });

        $(function() {
            $(document).on("idle.idleTimer", function(event, elem, obj) {
                console.log('idle');
                window.location.href = "/login"
            });
        });
    </script> --}}
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

</body>

</html>
