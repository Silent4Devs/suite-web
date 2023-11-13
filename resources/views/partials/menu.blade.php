{{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/dark_mode.css') }}">  --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/menu.css') }}">

<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show c-sidebar-light" style=" border: none;">
    <div class="bg-transparent c-sidebar-brand d-md-down-none caja_caja_img_logo">

        <!-- <div class="text-center dark_mode1" style="padding-top: 20px;">-->
        {{-- <a href="{{url('/')}}" class="pl-0"><img src="{{ asset('img/Silent4Business-Logo-Color.png') }}" style="width: 40%;" class="img_logo"></a> --}}
        <div class="caja_img_logo">
            @php
                if (!is_null($organizacion)) {
                    $logotipo = $organizacion->logotipo;
                } else {
                    $logotipo = 'img/logo_monocromatico.png';
                }
            @endphp

            <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 90px; margin: 20px 0;">

        </div>

    </div>

    <style>
        .c-sidebar-navli:nth-last-child(2) {
            margin-bottom: 30px;
        }
    </style>
    <ul>
        @livewire('offline-state-component')
    </ul>
    <ul class="c-sidebar-nav dark_mode1">

        <li class="c-sidebar-nav-title">
            <font class="letra_blanca" style="color: #345183;">Menu</font>
        </li>
        @can('mi_perfil_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.inicio-Usuario.index') }}#datos"
                    class="c-sidebar-nav-link {{ request()->is('admin/inicioUsuario') || request()->is('admin/inicioUsuario/*') || request()->is('admin/competencias/*/cv') ? 'active' : '' }}">
                    <i class="bi bi-file-person iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Mi perfil</font>
                </a>
            </li>
        @endcan
        @can('portal_de_comunicaccion_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.portal-comunicacion.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/portal-comunicacion') || request()->is('admin/portal-comunicacion/*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Portal de Comunicación </font>
                </a>
            </li>
        @endcan
        @can('timesheet_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.timesheet-inicio') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/timesheet') || request()->is('admin/timesheet/*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3-range letra_blanca iconos_menu"></i>
                    <font class="letra_blanca"> Timesheet </font>
                </a>
            </li>
        @endcan
        @can('calendario_organizacional_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.systemCalendar') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3 iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Calendario </font>
                </a>
            </li>
        @endcan
        {{-- @can('organizacion_access')
            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/matriz-riesgos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-unos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-dos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-tres*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fas fa-building iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Mi Organización </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('organizacion_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.organizacions.visualizarorganizacion') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/organizacions') || request()->is('admin/organizacions/*') ? 'active' : '' }}">
                                <i class="fas fa-bullseye iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> Organización</font>
                            </a>
                        </li>
                    @endcan
                    @can('organizacion_sede_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.sedes.obtenerListaSedes') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/obtenerListaSedes') || request()->is('admin/obtenerListaSedes/*') ? 'active' : '' }}">
                                <i class="fas fa-map-marked-alt iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> Sedes</font>
                            </a>
                        </li>
                    @endcan
                    @can('organizacion_area_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.areas.renderJerarquia') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/areas/areas-jerarquia') || request()->is('admin/areas/areas-jerarquia') ? 'active' : '' }}">
                                <i class="fab fa-adn iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.area.title') }}
                                </font>
                            </a>
                        </li>
                    @endcan
                    @can('mapa_procesos_organizacion_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.procesos.mapa') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/procesos/mapa_procesos') || request()->is('admin/procesos/mapa-procesos') ? 'c-active' : '' }}">
                                <i class="fas fa-dice-d20 iconos_menu letra_blanca"></i>
                                <font class="letra_blanca"> Mapa de procesos </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan --}}
        @can('documentos_publicados_acceder')
            {{-- @can('documentos_publicados_lista_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.documentos.publicados') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/publicados') || request()->is('admin/publicados*') ? 'active' : '' }}">
                        <i class="bi bi-files iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Lista de Documentos </font>
                    </a>
                </li>
            @endcan --}}
            {{-- <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/carpeta*') ? 'c-show' : '' }} {{ request()->is('admin/crear-documentos*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="bi bi-folder iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Documentos </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('documentos_publicados_lista_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.documentos.publicados') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/publicados') || request()->is('admin/publicados*') ? 'active' : '' }}">
                                <i class="bi bi-files iconos_menu letra_blanca"></i>
                                <font class="letra_blanca"> Lista de Documentos </font>
                            </a>
                        </li>
                    @endcan
                    @can('documentos_publicados_respositorio_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.carpeta.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/carpeta') || request()->is('admin/carpeta/*') ? 'active' : '' }}">
                                <i class="bi bi-file-earmark-font iconos_menu letra_blanca"></i>
                                <font class="letra_blanca"> Documentos Publicados </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li> --}}

            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.documentos.publicados') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/publicados') || request()->is('admin/publicados*') ? 'active' : '' }}">
                    <i class="bi bi-folder iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Documentos </font>
                </a>
            </li>
        @endcan
        @can('planes_de_accion_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.planes-de-accion.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/planes-de-accion') || request()->is('admin/planes-de-accion/*/edit') || request()->is('admin/planes-de-accion/create') || request()->is('admin/planes-de-accion/*') ? 'active' : '' }}">
                    <i class="bi bi-file-check iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Planes de Acción</font>
                </a>
            </li>
        @endcan
        @can('centro_de_atencion_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.desk.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/desk') || request()->is('admin/desk/*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Centro de Atención
                    </font>
                </a>
            </li>
        @endcan
        @can('solicitud_mensajeria_atencion')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.envio-documentos.atencion') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/desk') || request()->is('admin/desk/*') ? 'active' : '' }}">
                    <i class="far fa-paper-plane iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Atención de Mensajería
                    </font>
                </a>
            </li>
        @endcan
        {{-- @can('glosario_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.glosarios.render') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/glosarios') || request()->is('admin/glosarios/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-book iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.glosario.title') }} </font>
                </a>
            </li>
        @endcan --}}
        {{-- @can('contactanos_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.soporte.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/soporte.index') || request()->is('admin/soporte/*') ? 'active' : '' }}">
                    <i class="iconos_menu letra_blanca fas fa-headset"></i>
                    <font class="letra_blanca"> Soporte </font>
                </a>
            </li>
        @endcan --}}
        {{-- <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/matriz-riesgos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-unos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-dos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-tres*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fas fa-exclamation-triangle iconos_menu letra_blanca">

                    </i>

                    <font class="letra_blanca"> {{ trans('cruds.analisisRiesgo.title') }} </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('matriz_riesgo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.matriz-riesgos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/matriz-riesgos') || request()->is('admin/matriz-riesgos/*') ? 'c-active' : '' }}">
                                <i class="fas fa-table iconos_menu letra_blanca">
                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.matrizRiesgo.title') }} </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li> --}}
        {{-- @endcan --}}
        {{-- <li class="c-sidebar-nav-item">
            <a href="{{ url('/admin/analisis-brechas') }}" class="c-sidebar-nav-link">
                <i class="iconos_menu letra_blanca fas fa-fw fa-file-signature">

                </i>
                <font class="letra_blanca"> Análisis de brechas</font>
            </a>
        </li> --}}
        @if (
            $usuario->can('visitantes_acceder') ||
                $usuario->can('capital_humano_acceder') ||
                $usuario->can('analisis_de_riesgo_integral_acceder') ||
                $usuario->can('sistema_de_gestion_acceder') ||
                $usuario->can('matriz_bia_menu_acceder') ||
                $usuario->can('mis_cursos_acceder'))
            <li class="c-sidebar-nav-title">
                <font class="letra_blanca" style="color: #345183;">Módulos&nbsp;Tabantaj</font>
            </li>
        @endif
        @can('visitantes_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.visitantes.menu') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/visitantes') || request()->is('admin/visitantes/*') ? 'active' : '' }}">
                    <i class="bi bi-person-bounding-box iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Visitantes</font>
                </a>
            </li>
        @endcan
        @can('capital_humano_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.capital-humano.index') }}"
                    class="c-sidebar-nav-link
                    {{ request()->is('admin/empleados') || request()->is('admin/recursos-humanos/evaluacion-360/competencias') || request()->is('admin/lista-documentos') || request()->is('admin/perfiles') || request()->is('admin/recursos-humanos/tipos-contratos-empleados') || request()->is('admin/lista-documentos') || request()->is('admin/recursos-humanos/entidades-crediticias') || request()->is('admin/recursos-humanos/evaluacion-360/objetivos') || request()->is('admin/expedientes-profesionales') || request()->is('admin/categoria-capacitacion') || request()->is('admin/recursos-humanos/calendario-oficial') || request()->is('admin/recursos') || request()->is('admin/recursos-humanos/evaluacion-360/evaluaciones/create') || request()->is('admin/recursos-humanos/evaluacion-360/evaluaciones') || request()->is('admin/tabla-calendario/index') || request()->is('admin/capital-humano#') || request()->is('admin/capital-humano/*') ? 'active' : '' }}">
                    <i class="bi bi-people iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Capital Humano </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    {{-- @can('configuracion_empleados_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route('admin.empleados.index') }}"
                            class="c-sidebar-nav-link {{ request()->is('admin/empleados') || request()->is('admin/empleados/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user iconos_menu letra_blanca">

                            </i>
                            <font class="letra_blanca" style="margin-left:10px;"> Empleados </font>
                        </a>
                    </li>
                @endcan --}}
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route('admin.capital-humano.index') }}"
                            class="c-sidebar-nav-link {{ request()->is('admin/capital-humano') || request()->is('admin/capital-humano/*') || request()->is('admin/empleados/*') || request()->is('admin/expedientes-profesionales/*') ? 'active' : '' }}">
                            {{-- ? 'active' : '' --}}
                            <i class="fa-fw fas fa-file iconos_menu letra_blanca"></i>
                            <font class="letra_blanca" style="margin-left:10px;"> Capital Humano Menú </font>
                        </a>
                    </li>
                    @can('configuracion_empleados_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.tipos-contratos-empleados.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/tipos-contratos-empleados') || request()->is('admin/tipos-contratos-empleados/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca" style="margin-left:10px;"> Tipos de contratos </font>
                            </a>
                        </li>
                    @endcan
                    @can('configuracion_empleados_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.entidades-crediticias.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/entidades-crediticias') || request()->is('admin/entidades-crediticias/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file iconos_menu letra_blanca"></i>
                                <font class="letra_blanca" style="margin-left:10px;"> Entidades crediticias </font>
                            </a>
                        </li>
                    @endcan
                    @can('organigrama_acceder')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.organigrama.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/organigrama') || request()->is('admin/organigrama/*') ? 'c-active' : '' }}">
                                <i class="fas fa-sitemap iconos_menu letra_blanca"></i>
                                <font class="letra_blanca" style="margin-left:10px;"> Organigrama </font>
                            </a>
                        </li>
                    @endcan
                    <li class="c-sidebar-nav-dropdown">
                        <a class="c-sidebar-nav-dropdown-toggle" href="#">
                            <i class="fas fa-chalkboard-teacher iconos_menu letra_blanca"></i>
                            <font class="letra_blanca " style="margin-left:10px;"> Capacitaciones </font>
                        </a>
                        <ul class="c-sidebar-nav-dropdown-items">
                            @can('configuracion_macroproceso_access')
                                <li class="c-sidebar-nav-item">
                                    <a href="{{ asset('admin/categoria-capacitacion') }}">
                                        <i class="ml-2 fas fa-layer-group iconos_menu letra_blanca"
                                            style="font-size:12pt;"></i>
                                        <font class="letra_blanca" style="margin-left:10px;"> Crear categorías</font>
                                    </a>
                                </li>
                            @endcan
                            @can('configuracion_procesos_access')
                                <li class="c-sidebar-nav-item">
                                    <a href="{{ asset('admin/recursos') }}">
                                        <i class="ml-2 fas fa-graduation-cap iconos_menu letra_blanca"
                                            style="font-size:12pt;"></i>
                                        <font class="letra_blanca" style="margin-left:10px;"> Crear capacitaciones</font>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route('admin.rh-evaluacion360.index') }}">
                            <img src="{{ asset('img/360-degrees1.png') }}" alt="icono360"
                                style="width: 26px;margin-right: 14px;margin-left: 3px;">
                            <font class="letra_blanca" style="margin-left:10px;"> Evaluación 360° </font>
                        </a>
                    </li>
                    {{-- <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.tabla-calendario.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('tabla-calendario') || request()->is('tabla-calendario/*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check iconos_menu letra_blanca"></i>
                        <font class="letra_blanca">Calendario</font>
                    </a>
                </li> --}}
                    <li class="c-sidebar-nav-dropdown">
                        <a class="c-sidebar-nav-dropdown-toggle" href="#">
                            <i class="fas fa-calendar-alt iconos_menu letra_blanca"></i>
                            <font class="letra_blanca " style="margin-left:10px;"> Calendario </font>
                        </a>
                        <ul class="c-sidebar-nav-dropdown-items">

                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.calendario-oficial.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('calendario-oficial') || request()->is('calendario-oficial/*') ? 'active' : '' }}">
                                    <i class="ml-2 fas fa-drum iconos_menu letra_blanca" style="font-size:12pt;"></i>
                                    <font class="letra_blanca" style="margin-left:10px;">Dias Festivos</font>
                                </a>
                            </li>

                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.tabla-calendario.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('tabla-calendario') || request()->is('tabla-calendario/*') ? 'active' : '' }}">
                                    <i class="ml-2 fas fa-gifts iconos_menu letra_blanca" style="font-size:12pt;"></i>
                                    <font class="letra_blanca" style="margin-left:10px;">Eventos</font>
                                </a>
                            </li>



                        </ul>
                    </li>
                </ul>
            </li>
        @endcan
        @can('analisis_de_riesgo_integral_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.analisis-riesgos.menu') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/matriz-riesgos') || request()->is('admin/matriz-riesgos*') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-triangle iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Análisis de Riesgos (RA) </font>
                </a>
            </li>
        @endcan
        @can('matriz_bia_menu_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.analisis-impacto.menu') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/analisis-impacto-menu/') || request()->is('admin/analisis-impacto/*') ? 'active' : '' }}">
                    <i class="fas fa-traffic-light iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Análisis de Impacto</font>
                </a>
            </li>
        @endcan

        @can('sistema_de_gestion_acceder')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->is('admin/iso27001') ||
                request()->is('admin/analisisdebrechas') ||
                request()->is('admin/planTrabajoBase') ||
                request()->is('admin/partes-interesadas') ||
                request()->is('admin/matriz-requisito-legales') ||
                request()->is('admin/entendimiento-organizacions') ||
                request()->is('admin/alcance-sgsis') ||
                request()->is('admin/comiteseguridads') ||
                request()->is('admin/minutasaltadireccions') ||
                request()->is('admin/evidencias-sgsis') ||
                request()->is('admin/politica-sgsis') ||
                request()->is('admin/paneldeclaracion') ||
                request()->is('admin/objetivosseguridads') ||
                request()->is('admin/concientizacion-sgis') ||
                request()->is('admin/material-sgsis') ||
                request()->is('admin/comunicacion-sgis') ||
                request()->is('admin/control-accesos') ||
                request()->is('admin/declaracion-aplicabilidad') ||
                request()->is('admin/planificacion-controls') ||
                request()->is('admin/tratamiento-riesgos') ||
                request()->is('admin/indicadores-sgsis') ||
                request()->is('admin/auditoria-anuals') ||
                request()->is('admin/plan-auditoria') ||
                request()->is('admin/revision-direccions') ||
                request()->is('admin/auditoria-internas') ||
                request()->is('admin/accion-correctivas') ||
                request()->is('admin/inicioUsuario/reportes/mejoras')
                    ? 'active'
                    : '' }}"
                    href="{{ route('admin.iso27001.index') }}#contexto">
                    <i class="bi bi-globe2 iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Sistema de Gestión</font>
                </a>
            </li>
        @endcan
        @can('mis_cursos_acceder')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                    <i class="bi bi-folder iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Cursos </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('mis_cursos_instructor')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.courses.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/courses') || request()->is('admin/courses') ? 'active' : '' }}">
                                <font class="letra_blanca"> Instructor </font>
                            </a>
                        </li>
                    @endcan
                </ul>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('escuela_estudiante')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.mis-cursos') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/courses') || request()->is('admin/courses') ? 'active' : '' }}">
                                <font class="letra_blanca"> Mis cursos </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{-- <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('admin/contratos') ? 'active' : '' }}"
                href="{{ route('admin.contratos.index') }}#contexto">
                <i class="bi bi-file-text iconos_menu letra_blanca"></i>
                <font class="letra_blanca">Sistema de Contratos</font>
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('admin/iso9001') ? 'active' : '' }}"
                href="{{ route('admin.iso9001.index') }}#contexto">
                <i class="bi bi-globe2 iconos_menu letra_blanca"></i>
                <font class="letra_blanca"> ISO 9001 </font>
            </a>
        </li> --}}
        @if (
            $usuario->can('sistema_gestion_contratos_acceder') ||
                $usuario->can('administracion_sistema_gestion_contratos_acceder') ||
                $usuario->can('katbol_contratos_acceso') ||
                $usuario->can('katbol_requisiciones_acceso'))
            <li class="c-sidebar-nav-title">
                <font class="letra_blanca" style="color: #345183;">Módulos&nbsp;Katbol</font>
            </li>
        @endif
        @can('dashboard_gestion_contratos_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('contract_manager.dashboard.katbol') }}"
                    class="c-sidebar-nav-link {{ request()->is('contract_manager/dashboard/katbol') ? 'active' : '' }}">
                    <i class="fas fa-chart-column iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Dashboard</font>
                </a>
            </li>
        @endcan
        @can('sistema_gestion_contratos_acceder')
            <li class="c-sidebar-nav-item">
                <a href="{{ url('contract_manager/katbol') }}"
                    class="c-sidebar-nav-link {{ request()->is('contract_manager/katbol') ? 'active' : '' }}">
                    <i class="bi bi-file-text iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Sistema de Gestion Contractual</font>
                </a>
            </li>
        @endcan
        @can('katbol_contratos_acceso')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('contract_manager.contratos-katbol.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('contract_manager/contratos-katbol') || request()->is('contract_manager/contratos-katbol/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-file iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Contratos</font>
                </a>
            </li>
        @endcan
        @can('katbol_requisiciones_acceso')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('contract_manager.requisiciones') }}"
                    class="c-sidebar-nav-link {{ request()->is('contract_manager/requisiciones') || request()->is('contract_manager/requisiciones/*') ? 'active' : '' }}">
                    <i class="bi bi-folder-plus iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Requisiciones</font>
                </a>
            </li>
        @endcan
        {{-- @can('katbol_proveedores_acceso')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('contract_manager.proveedor.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('contract_manager/proveedor') || request()->is('contract_manager/proveedor/*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Proveedores-Clientes</font>
                </a>
            </li>
        @endcan --}}

        @can('permisos_de_administracion_acceder')
            <li class="c-sidebar-nav-title">
                <font class="letra_blanca" style="color: #345183;">Administración</font>
            </li>

            {{-- @can('planes_accion_access') --}}

            {{-- @endcan --}}

            {{-- @can('carga_masiva_datos_acceder')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('cargadocs') }}"
                        class="c-sidebar-nav-link {{ request()->is('CargaDocs') || request()->is('CargaDocs/*') ? 'active' : '' }}">
                        <i class="bi bi-file-arrow-up iconos_menu letra_blanca"></i>
                        <font class="letra_blanca">Carga Masiva de Datos</font>
                    </a>
                </li>
            @endcan --}}

            @can('configurar_organizacion_acceder')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-building iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Configurar Organización </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('mi_organizacion_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.organizacions.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/organizacions') || request()->is('admin/organizacions/*') ? 'active' : '' }}">
                                    <i class="bi bi-building iconos_menu letra_blanca"></i>

                                    <font class="letra_blanca">Organización</font>
                                </a>
                            </li>
                        @endcan
                        @can('sedes_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.sedes.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/sedes') || request()->is('admin/sedes/*/edit') || request()->is('admin/sedes/create') ? 'active' : '' }}">
                                    <i class="bi bi-geo-alt iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca">Sedes</font>
                                </a>
                            </li>
                        @endcan
                        @can('acceder_submenu_areas')
                            <li class="c-sidebar-nav-dropdown">
                                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="bi bi-geo iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca "> Áreas </font>
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    @can('crear_grupo_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ route('admin.grupoarea.index') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/grupoarea') || request()->is('admin/grupoarea/*') ? 'active' : '' }}">
                                                <i class="bi bi-boxes iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Crear Grupo </font>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('crear_area_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ route('admin.areas.index') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/areas') || request()->is('admin/areas/*/edit') || request()->is('admin/areas/create') ? 'active' : '' }}">

                                                <i class="bi bi-geo iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Crear Áreas </font>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('acceder_submenu_mapa_procesos')
                            <li class="c-sidebar-nav-dropdown">
                                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="bi bi-file-post mr-2 iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca "> Mapa de Procesos </font>
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    @can('macroprocesos_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ route('admin.macroprocesos.index') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/tipoactivos') || request()->is('admin/tipoactivos/*') ? 'active' : '' }}">
                                                <i class="bi bi-file-earmark-post-fill iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Macroprocesos</font>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('procesos_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ route('admin.procesos.index') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/procesos') || request()->is('admin/procesos/*') ? 'active' : '' }}">
                                                <i class="bi bi-file-earmark-post iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Procesos</font>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('acceder_submenu_activos')
                            <li class="c-sidebar-nav-dropdown">
                                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="bi bi-pc-display-horizontal iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca "> Activos </font>
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    @can('categoria_activos_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ route('admin.tipoactivos.index') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/tipoactivos') || request()->is('admin/tipoactivos/*') ? 'active' : '' }}">
                                                <i class="bi bi-layers iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Categorias</font>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('subcategoria_activos_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ route('admin.subtipoactivos.index') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/tipoactivos') || request()->is('admin/tipoactivos/*') ? 'active' : '' }}">
                                                <i class="bi bi-layers-half iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Subcategorias</font>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('inventario_activos_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ route('admin.activos.index') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/activos') || request()->is('admin/activos/*') ? 'active' : '' }}">
                                                <i class="bi bi-list-task iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Inventario</font>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        @can('glosario_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.glosarios.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/organizacions') || request()->is('admin/organizacions/*') ? 'active' : '' }}">
                                    <i class="bi bi-list-columns-reverse iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca" style="margin-left:10px;">Glosario</font>
                                </a>
                            </li>
                        @endcan

                        @can('configuracion_empleados_access')
                            {{-- <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.empleados.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/empleados') || request()->is('admin/empleados/*') ? 'active' : '' }}">
                                <i class="fas fa-exclamation-triangle iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> Catálogo de Incidentes </font>
                            </a>
                        </li> --}}
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('control_documentar_acceder')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-folder iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Documentos </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('agregar_documento_crear')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.documentos.create') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/create') || request()->is('admin/create*') ? 'active' : '' }}">
                                    <i class="bi bi-folder-plus iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> Agregar Documento </font>
                                </a>
                            </li>
                        @endcan
                        @can('control_documentar_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.documentos.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/crear-documentos') || request()->is('admin/crear-documentos*') ? 'active' : '' }}">
                                    <i class="bi bi-card-checklist letra_blanca iconos_menu"></i>
                                    <font class="letra_blanca"> Control Documental </font>
                                </a>
                            </li>
                        @endcan
                        @can('repositorio_documental_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.carpeta.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/carpeta') || request()->is('admin/carpeta/*') ? 'active' : '' }}">
                                    <i class="bi bi-folder2-open iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> Repositorio Documental </font>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('configurar_capital_humano')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-person-plus iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Configurar C. Humano </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('lista_de_perfiles_de_puesto_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.puestos.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/puestos') || request()->is('admin/puestos/*') ? 'active' : '' }}">
                                    <i class="bi bi-briefcase iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca">Puestos
                                    </font>
                                </a>
                            </li>
                        @endcan
                        @can('niveles_jerarquicos_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.perfiles.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/perfiles') || request()->is('admin/perfiles/*') || request()->is('admin/perfiles/create') ? 'active' : '' }}">
                                    <i class="bi bi-diagram-2 iconos_menu letra_blanca"></i>

                                    <font class="letra_blanca">Niveles Jerárquicos</font>
                                </a>
                            </li>
                        @endcan
                        @can('bd_empleados_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.empleados.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/empleados') || request()->is('admin/empleados/*') || request()->is('admin/empleados/create') ? 'active' : '' }}">
                                    <i class="bi bi-person iconos_menu letra_blanca"></i>

                                    <font class="letra_blanca">Empleados</font>
                                </a>
                            </li>
                        @endcan
                        @can('acceder_submenu_capacitaciones')
                            <li class="c-sidebar-nav-dropdown">
                                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="bi bi-person-video3 iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca ">Capacitaciones</font>
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    @can('capacitaciones_categorias_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ asset('admin/categoria-capacitacion') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/categoria-capacitacion') || request()->is('admin/categoria-capacitacion/*') ? 'active' : '' }}">
                                                <i class="ml-2 bi bi-mortarboard iconos_menu letra_blanca"
                                                    style="font-size:12pt;"></i>
                                                <font class="letra_blanca"> Crear Categorías </font>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('capacitaciones_acceder')
                                        <li class="c-sidebar-nav-item">
                                            <a href="{{ asset('admin/recursos') }}"
                                                class="c-sidebar-nav-link {{ request()->is('admin/recursos') || request()->is('admin/recursos/*') || request()->is('admin/recursos/create') ? 'active' : '' }}">

                                                <i class="ml-2 bi bi-person-video3 iconos_menu letra_blanca"
                                                    style="font-size:12pt;"></i>
                                                <font class="letra_blanca"> Crear Capacitación</font>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        @can('configuracion_empleados_access')
                            {{-- <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.empleados.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/empleados') || request()->is('admin/empleados/*') ? 'active' : '' }}">
                                    <i class="fas fa-exclamation-triangle iconos_menu letra_blanca">

                                    </i>
                                    <font class="letra_blanca"> Catálogo de Incidentes </font>
                                </a>
                            </li> --}}
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('configurar_vistas_acceder')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-pc-display-horizontal iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Configurar Vistas </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('configurar_vista_mis_datos_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.panel-inicio.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/panel-inicio') || request()->is('admin/panel-inicio/*') ? 'active' : '' }}">
                                    <i class="bi bi-person-badge iconos_menu letra_blanca"></i>
                                    <span class="letra_blanca"> Mis Datos </span>
                                </a>
                            </li>
                        @endcan
                        @can('mi_organizacion_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.panel-organizacion.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/panel-organizacion') || request()->is('admin/panel-organizacion/*') ? 'active' : '' }}">
                                    <i class="bi bi-building iconos_menu letra_blanca"></i>
                                    <span class="letra_blanca"> Mi Organización </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('ajustes_usuario_acceder')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-gear iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Ajustes de Usuario </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        {{-- @can('permission_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.permisos.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/permisos') || request()->is('admin/permisos/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> {{ trans('cruds.permission.title') }} </font>
                                </a>
                            </li>
                        @endcan --}}
                        @can('roles_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.roles.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="bi bi-briefcase iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> {{ trans('cruds.role.title') }}
                                    </font>
                                </a>
                            </li>
                        @endcan
                        @can('usuarios_acceder')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="bi bi-person iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> {{ trans('cruds.user.title') }}
                                    </font>
                                </a>
                            </li>
                        @endcan
                        {{-- @can('controle_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.controles.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/controles') || request()->is('admin/controles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-screwdriver iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> {{ trans('cruds.controle.title') }} </font>
                                </a>
                            </li>
                        @endcan --}}
                        {{-- @can('audit_log_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.audit-logs.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                                    <i class="bi bi-terminal iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca" style="margin-left:11px;"> Logs del Sistema
                                    </font>
                                </a>
                            </li>
                        @endcan
                        @can('user_alert_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.user-alerts.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/user-alerts') || request()->is('admin/user-alerts/*') ? 'active' : '' }}">
                                    <i class="bi bi-bell iconos_menu letra_blanca">

                                    </i>
                                    <font class="letra_blanca">
                                        Notificaciones </font>
                                </a>
                            </li>
                        @endcan --}}
                        {{-- @can('enlaces_ejecutar_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.enlaces-ejecutars.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/enlaces-ejecutars') || request()->is('admin/enlaces-ejecutars/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                                    </i>
                                    <font class="letra_blanca">
                                        {{ trans('cruds.enlacesEjecutar.title') }} </font>
                                </a>
                            </li>
                        @endcan
                        @can('team_access')
                            <li class="c-sidebar-nav-item" class="">
                                <a href="{{ route('admin.teams.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-users iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> {{ trans('cruds.team.title') }}
                                    </font>
                                </a>
                            </li>
                        @endcan --}}
                        {{-- @can('estado_incidente_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.estado-incidentes.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/estado-incidentes') || request()->is('admin/estado-incidentes/*') ? 'active' : '' }}">
                                    <i class="fa-fw fab fa-stripe-s iconos_menu letra_blanca">

                                    </i>
                                    <font class="letra_blanca"> {{ trans('cruds.estadoIncidente.title') }} </font>
                                </a>
                            </li>
                        @endcan --}}
                        {{-- @can('estado_documento_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.estado-documentos.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/estado-documentos') || request()->is('admin/estado-documentos/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                                    </i>
                                    <font class="letra_blanca"> {{ trans('cruds.estadoDocumento.title') }} </font>
                                </a>
                            </li>
                        @endcan --}}
                        {{-- @can('estatus_plan_trabajo_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.estatus-plan-trabajos.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/estatus-plan-trabajos') || request()->is('admin/estatus-plan-trabajos/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                                    </i>
                                    <font class="letra_blanca"> {{ trans('cruds.estatusPlanTrabajo.title') }} </font>
                                </a>
                            </li>
                        @endcan --}}
                        {{-- @can('plan_base_actividade_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.plan-base-actividades.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/plan-base-actividades') || request()->is('admin/plan-base-actividades/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                                    </i>
                                    <font class="letra_blanca"> {{ trans('cruds.planBaseActividade.title') }} </font>
                                </a>
                            </li>
                        @endcan
                        @can('control_documento_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.control-documentos.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/control-documentos') || request()->is('admin/control-documentos/*') ? 'c-active' : '' }}">
                                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon"></i>
                                    <font class="letra_blanca">{{ trans('cruds.controlDocumento.title') }}</font>
                                </a>
                            </li>
                        @endcan --}}
                    </ul>
                </li>
            @endcan
            {{-- @can('') este acceso no corresponde --}}
            @can('configurar_soporte_acceder')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-gear iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Ajustes de Sistema </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.configurar-soporte.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/configurar-soporte') || request()->is('admin/configurar-soporte/*') ? 'active' : '' }}">
                                <i class="bi bi-gear iconos_menu letra_blanca"></i>
                                <font class="letra_blanca">Configurar Soporte</font>
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.visualizar-logs.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/visualizar-logs') || request()->is('admin/visualizar-logs/*') ? 'active' : '' }}">
                                <i class="bi bi-gear iconos_menu letra_blanca"></i>
                                <font class="letra_blanca">Visualizar Logs</font>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('esculea_admin_acceder')
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-folder iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Cursos </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('escuela_admin_dashboar')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.courses.index') }}"
                                    class="c-sidebar-nav-link {{ request()->is('admin/courses') || request()->is('admin/courses') ? 'active' : '' }}">
                                    <font class="letra_blanca"> Instructor </font>
                                </a>
                            </li>
                        @endcan
                        @can('escuela_admin_categorias')
                        @endcan
                        @can('escuela_admin_niveles')
                        @endcan
                    </ul>
                </li>
            @endcan
        @endcan
        {{-- @endcan --}}

        {{-- este acceso no corresponde --}}
        {{-- @can('configuracion_procesos_access')
            <li class="c-sidebar-nav-dropdown btn_bajar_scroll">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="bi bi-pc-display-horizontal iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Configurar Soporte </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route('admin.configurar-consultor.index') }}"
                            class="c-sidebar-nav-link {{ request()->is('admin/configurar-consultor') || request()->is('admin/configurar-consultor/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user-circle iconos_menu letra_blanca"></i>
                            <span class="letra_blanca"> Consultores </span>
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route('admin.configurar-soporte.index') }}"
                            class="c-sidebar-nav-link {{ request()->is('admin/configurar-soporte') || request()->is('admin/configurar-soporte/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-building iconos_menu letra_blanca"></i>
                            <span class="letra_blanca"> Soporte técnico </span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan --}}

        {{-- @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca">Manual de Usuario </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.faq-categories.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/faq-categories') || request()->is('admin/faq-categories/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> Documento</font>
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.faq-questions.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/faq-questions') || request()->is('admin/faq-questions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-question iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> Manual </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan --}}
        @if (
            \Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') &&
                \App\Models\Team::where('owner_id', $usuario->id)->exists())
            <li class="c-sidebar-nav-item">
                <a class="{{ request()->is('admin/team-members') || request()->is('admin/team-members/*') ? 'active' : '' }} c-sidebar-nav-link"
                    href="{{ route('admin.team-members.index') }}">
                    <i class="iconos_menu letra_blanca fa-fw fa fa-users">
                    </i>
                    <span>{{ trans('global.team-members') }}</span>
                </a>
            </li>
        @endif
        <style type="text/css">
            .botones_g_s {
                position: sticky;
                bottom: 0;
                left: 50px;
                width: 100%;
                background: white;
                text-align: center;
            }

            .botones_g_s a {
                display: inline-block;
                padding: 0px 25px;
                font-size: 15pt;
                color: #747474;
                text-align: center;
                border-radius: 6px;
                border: 1px solid #E1E1E1;

            }
        </style>
        <div class="text-center botones_g_s">
            @can('principal_soporte_acceder')
                <a href="{{ route('admin.soporte') }}" title="Soporte" style="margin-right:14px;"><i
                        class="bi bi-headset"></i></a>
            @endcan
            @can('principal_glosario_acceder')
                <a href="{{ route('admin.glosarios.render') }}" title="Glosario"><i class="bi bi-book"></i></a>
            @endcan
            </li>
        </div>
        {{-- @can('sitemap_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ url('sitemap') }}" class="c-sidebar-nav-link">
                    <i class="iconos_menu letra_blanca fas fa-fw fa-sitemap">

                    </i>
                    <font class="letra_blanca">Mapa de sitio</font>
                </a>
            </li>
        @endcan --}}
        {{-- <div class="text-center botones_g_s" style="margin-top: 80px;">
            @can('listados_soporte_access')
                <a href="{{ route('admin.soporte') }}" title="Soporte" style="margin-right:14px;"><i
                        class="bi bi-headset"></i></a>
            @endcan
            @can('glosario_access')
                <a href="{{ route('admin.glosarios.render') }}" title="Glosario"><i class="bi bi-book"></i></a>
            @endcan
        </div> --}}
        {{-- <div class="row lemnt_row_menu" style="padding-bottom:300px;">
        </div> --}}
    </ul>

</div>

<script async>
    var a = document.getElementsByClassName("active");
    for (var i = 0; i < a.length; i++)
        a[i].className += " c-active";


    var ida = document.getElementsByClassName("c-active");
    for (var i = 0; i < ida.length; i++)
        ida[i].id += "seleccionado";

    let seleccionadoItem = document.getElementById('seleccionado');
    if (seleccionadoItem) {
        document.getElementById('seleccionado').parentNode.classList.add('c-show');
        document.getElementById('seleccionado').parentNode.parentNode.classList.add('c-show');
        document.getElementById('seleccionado').parentNode.parentNode.parentNode.classList.add('c-show');
        document.getElementById('seleccionado').parentNode.parentNode.parentNode.parentNode.classList.add('c-show');
        document.getElementById('seleccionado').parentNode.parentNode.parentNode.parentNode.parentNode.classList.add(
            'c-show');
    }
</script>


<script>
    const btn_desplegar_menu = document.querySelector('#btn_desplegar_menu');
    if (btn_desplegar_menu) {
        btn_desplegar_menu.addEventListener('click', () => {
            document.body.classList.toggle('c-dark-theme');

            if (document.body.classList.contains('c-dark-theme')) {
                localStorage.setItem('dark-mode', 'true');
            } else {
                localStorage.setItem('dark-mode', 'false');
            }
        });
    }

    if (localStorage.getItem('dark-mode') === 'true') {
        document.body.classList.add('c-dark-theme');
    } else {
        document.body.classList.remove('c-dark-theme');
    }
</script>
