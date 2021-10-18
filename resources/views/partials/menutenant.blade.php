<link rel="stylesheet" type="text/css" href="{{ asset('css/dark_mode.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/menu.css') }}">

<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show c-sidebar-light" style=" border: none;">
    <div class="bg-transparent c-sidebar-brand d-md-down-none caja_caja_img_logo">

        <!-- <div class="text-center dark_mode1" style="padding-top: 20px;">-->
        {{-- <a href="{{url('/')}}" class="pl-0"><img src="{{ asset('img/Silent4Business-Logo-Color.png') }}" style="width: 40%;" class="img_logo"></a> --}}
        <div class="caja_img_logo">
            @php
                use App\Models\Organizacion;
                $organizacion = Organizacion::first();
                $logotipo = 'img/logo_policromatico_2.png';
                if ($organizacion) {
                    if ($organizacion->logotipo) {
                        $logotipo = 'images/' . $organizacion->logotipo;
                    }
                }
            @endphp
            <img src="{{ asset($logotipo) }}" class="img_logo" style="width: 110%;">
        </div>

    </div>

    <ul class="c-sidebar-nav dark_mode1" style="margin-top: -10px;">

        <li class="c-sidebar-nav-title">
            <span class="letra_blanca">Menu</span>
        </li>
        {{-- @can('mi_perfil_access') --}}
        <li class="c-sidebar-nav-item">
            {{-- <a href="{{ route('inicio-Usuario.index') }}" --}}
                <a class="c-sidebar-nav-link {{ request()->is('inicioUsuario') || request()->is('inicioUsuario/*') ? 'active' : '' }}">
                <i class="fas fa-user iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Mi perfil</span>
            </a>
        </li>
        {{-- @endcan --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('portal-comunicacion.index') }}"
                class="c-sidebar-nav-link {{ request()->is('portal-comunicacion') || request()->is('portal-comunicacion/*') ? 'active' : '' }}">
                <i class="fas fa-newspaper iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Portal de Comunicación </span>
            </a>
        </li>
        {{-- @can('organizacion_access') --}}
        <li
            class="c-sidebar-nav-dropdown {{ request()->is('matriz-riesgos*') ? 'c-show' : '' }} {{ request()->is('gap-unos*') ? 'c-show' : '' }} {{ request()->is('gap-dos*') ? 'c-show' : '' }} {{ request()->is('gap-tres*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fas fa-building iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Mi Organización </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                {{-- @can('organizacion_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('organizacions.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('organizacions') || request()->is('organizacions/*') ? 'active' : '' }}">
                        <i class="fas fa-bullseye iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca" style="margin-left:5px;"> Organización</span>
                    </a>
                </li>
                {{-- @endcan
                    @can('organizacion_sede_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('sedes.obtenerListaSedes') }}"
                        class="c-sidebar-nav-link {{ request()->is('obtenerListaSedes') || request()->is('obtenerListaSedes/*') ? 'active' : '' }}">
                        <i class="fas fa-map-marked-alt iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> Sedes</span>
                    </a>
                </li>
                {{-- @endcan
                    @can('organizacion_area_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('areas.renderJerarquia') }}"
                        class="c-sidebar-nav-link {{ request()->is('areas/areas-jerarquia') || request()->is('areas/areas-jerarquia') ? 'active' : '' }}">
                        {{-- <i class="fas fa-puzzle-piece iconos_menu letra_blanca">

                        </i> --}}
                        <i class="fab fa-adn iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.area.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
                    @can('organigrama_organizacion_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('organigrama.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('organigrama') || request()->is('organigrama/*') ? 'c-active' : '' }}">
                        <i class="fas fa-users iconos_menu letra_blanca">
                        </i>
                        <span class="letra_blanca"> Organigrama </span>
                    </a>
                </li>
                {{-- @endcan
                    @can('mapa_procesos_organizacion_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('procesos.mapa') }}"
                        class="c-sidebar-nav-link {{ request()->is('procesos/mapa_procesos') || request()->is('procesos/mapa-procesos') ? 'c-active' : '' }}">
                        <i class="fas fa-dice-d20 iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> Mapa de procesos </span>
                    </a>
                </li>
                {{-- @endcan --}}
            </ul>
        </li>
        {{-- @endcan
@can('dashboard_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ url('/') }}"
                class="c-sidebar-nav-link {{ request()->is('dashboards') || request()->is('dashboards/*') ? 'active' : '' }}">
                <i class="fa-fw far fa-chart-bar iconos_menu letra_blanca">

                </i>
                <span class="letra_blanca"> {{ trans('cruds.dashboard.title') }} </span>
            </a>
        </li>
        {{-- @endcan --}}
        {{-- @can('implementacion_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("implementacions.index") }}" class="c-sidebar-nav-link {{ request()->is("implementacions") || request()->is("implementacions/*") ? "active" : "" }}">

                    <i class="fas fa-paper-plane iconos_menu letra_blanca"></i>
                    <span class="letra_blanca"> {{ trans('cruds.implementacion.title') }} </span>
                </a>
            </li>
        @endcan --}}
        {{-- @can('documentos_publicados_respositorio_access') --}}
        <li
            class="c-sidebar-nav-dropdown {{ request()->is('carpeta*') ? 'c-show' : '' }} {{ request()->is('crear-documentos*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fas fa-folder iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Documentos </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                {{-- @can('documentos_publicados_lista_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('documentos.publicados') }}"
                        class="c-sidebar-nav-link {{ request()->is('publicados') || request()->is('publicados*') ? 'active' : '' }}">
                        <i class="fas fa-copy iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> Lista de Documentos </span>
                    </a>
                </li>
                {{-- @endcan
            @can('documentos_publicados_respositorio_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('carpeta.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('carpeta') || request()->is('carpeta/*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> Documentos Publicados </span>
                    </a>
                </li>
                {{-- @endcan --}}
            </ul>
        </li>
        {{-- @endcan --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('planes-de-accion.index') }}"
                class="c-sidebar-nav-link {{ request()->is('planes-de-accion') || request()->is('planes-de-accion/*/edit') || request()->is('planes-de-accion/create') || request()->is('planes-de-accion/*') ? 'active' : '' }}">
                <i class="iconos_menu letra_blanca fas fa-fw fa-stream"></i>
                <span class="letra_blanca">Planes de Acción</span>
            </a>
        </li>
        {{-- @can('agenda_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('systemCalendar') }}"
                class="c-sidebar-nav-link {{ request()->is('system-calendar') || request()->is('system-calendar/*') ? 'active' : '' }}">
                <i class="iconos_menu letra_blanca fa-fw fas fa-calendar">
                </i>
                <span class="letra_blanca"> Agenda </span>
            </a>
        </li>
        {{-- @endcan
@can('centro_atencion_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('desk.index') }}"
                class="c-sidebar-nav-link {{ request()->is('desk') || request()->is('desk/*') ? 'active' : '' }}">
                <i class="fas fa-headset iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Centro de Atención
                </span>
            </a>
        </li>
        {{-- @endcan
@can('contactanos_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('soporte.index') }}"
                class="c-sidebar-nav-link {{ request()->is('soporte.index') || request()->is('soporte/*') ? 'active' : '' }}">
                <i class="iconos_menu letra_blanca fas fa-id-card"></i>
                <span class="letra_blanca"> Contáctanos </span>
            </a>
        </li>
        {{-- @endcan
@can('glosario_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('glosarios.index') }}"
                class="c-sidebar-nav-link {{ request()->is('glosarios') || request()->is('glosarios/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-book iconos_menu letra_blanca">

                </i>
                <span class="letra_blanca"> {{ trans('cruds.glosario.title') }} </span>
            </a>
        </li>
        {{-- @endcan --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('cargadocs') }}"
                class="c-sidebar-nav-link {{ request()->is('CargaDocs') || request()->is('CargaDocs/*') ? 'active' : '' }}">
                <i class="fas fa-file-upload iconos_menu letra_blanca"></i>

                <span class="letra_blanca">Carga de Documentos</span>
            </a>
        </li>

        {{-- <li class="c-sidebar-nav-item">
            <a href="{{ route('planTrabajoBase.index') }}"
                class="c-sidebar-nav-link {{989 request()->is('planTrabajoBase') || request()->is('planTrabajoBase/*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list iconos_menu letra_blanca"></i>

                </i>
                <span class="letra_blanca"> Plan de implementación </span>
            </a>
        </li> --}}
        {{-- @can('analisis_riesgo_access')
            {{-- <li class="c-sidebar-nav-item">
                <a href="{{ route('analisis-riesgos.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('analisis-riesgos') || request()->is('analisis-riesgos/*') ? 'active' : '' }}">
                    <i class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>
                    <span class="letra_blanca"> Análisis de riesgos </span>
                </a>
            </li> --}}
        <li
            class="c-sidebar-nav-dropdown {{ request()->is('matriz-riesgos*') ? 'c-show' : '' }} {{ request()->is('gap-unos*') ? 'c-show' : '' }} {{ request()->is('gap-dos*') ? 'c-show' : '' }} {{ request()->is('gap-tres*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Análisis de riesgos </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('amenazas.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('amenazas') || request()->is('amenazas/*') ? 'active' : '' }}">
                        <i class="fas fa-fire iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca" style="margin-left:5px;"> Amenazas</span>
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a href="{{ route('vulnerabilidads.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('vulnerabilidads') || request()->is('vulnerabilidads/*') ? 'active' : '' }}">
                        <i class="fas fa-shield-alt iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> Vulnerabilidades</span>
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a href="{{ route('analisis-riesgos.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('analisis-riesgos') || request()->is('analisis-riesgos') ? 'active' : '' }}">
                        {{-- <i class="fas fa-puzzle-piece iconos_menu letra_blanca">

                        </i> --}}
                        <i class="fas fa-table iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca">Matriz de Riesgos</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- <li
                class="c-sidebar-nav-dropdown {{ request()->is('matriz-riesgos*') ? 'c-show' : '' }} {{ request()->is('gap-unos*') ? 'c-show' : '' }} {{ request()->is('gap-dos*') ? 'c-show' : '' }} {{ request()->is('gap-tres*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fas fa-exclamation-triangle iconos_menu letra_blanca">

                    </i>

                    <span class="letra_blanca"> {{ trans('cruds.analisisRiesgo.title') }} </span>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('matriz_riesgo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('matriz-riesgos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('matriz-riesgos') || request()->is('matriz-riesgos/*') ? 'c-active' : '' }}">
                                <i class="fas fa-table iconos_menu letra_blanca">
                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.matrizRiesgo.title') }} </span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li> --}}
        {{-- @endcan --}}
        {{-- <li class="c-sidebar-nav-item">
            <a href="{{ url('/analisis-brechas') }}" class="c-sidebar-nav-link">
                <i class="iconos_menu letra_blanca fas fa-fw fa-file-signature">

                </i>
                <span class="letra_blanca"> Análisis de brechas</span>
            </a>
        </li> --}}

        <li class="c-sidebar-nav-title">
            <span class="letra_blanca">Recursos Humanos</span>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('recursos-humanos/*') ? 'active' : '' }}"
                href="{{ route('rh-evaluacion360.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-file-earmark-person iconos_menu letra_blanca" viewBox="0 0 16 16">
                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z" />
                </svg>
                <span class="letra_blanca"> Evaluación 360 Grados </span>
            </a>
        </li>

        <li class="c-sidebar-nav-title">
            <span class="letra_blanca">Normas</span>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link " href="{{ route('iso27001.index') }}">
                <i class="fa-fw fas fa-globe-americas iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> ISO 27001 </span>
            </a>
        </li>

        {{-- @can('administracion_access') --}}
        <li class="c-sidebar-nav-title">
            <span class="letra_blanca">Administración</span>
        </li>
        {{-- @endcan --}}

        {{-- @can('planes_accion_access') --}}

        {{-- @endcan --}}
        {{-- @can('configuracion_datos_access') --}}
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fas fa-file-alt iconos_menu letra_blanca">

                </i>
                <span class="letra_blanca"> Configuracion de Datos </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                {{-- @can('documentos_access') --}}
                <li
                    class="c-sidebar-nav-dropdown {{ request()->is('carpeta*') ? 'c-show' : '' }} {{ request()->is('crear-documentos*') ? 'c-show' : '' }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fas fa-folder iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> Documentos </span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        {{-- @can('documentos_create') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('documentos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('crear-documentos') || request()->is('crear-documentos*') ? 'active' : '' }}">
                                <i class="fas fa-folder-plus iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> Crear Documentos </span>
                            </a>
                        </li>
                        {{-- @endcan
                        @can('carpetum_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('carpeta.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('carpeta') || request()->is('carpeta/*') ? 'active' : '' }}">
                                <i class="fas fa-folder-open iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> Gestor Documental </span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan
            @can('configuracion_sede_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('sedes.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('sedes') || request()->is('sedes/*/edit') || request()->is('sedes/create') ? 'active' : '' }}">
                        <i class="fas fa-map-marked-alt iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca">Sedes</span>
                    </a>
                </li>
                {{-- @endcan
            @can('configuracion_area_access') --}}
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fas fa-puzzle-piece iconos_menu letra_blanca"></i>
                        <span class="letra_blanca "> Áreas </span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        {{-- @can('configuracion_grupoarea_create') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('grupoarea.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('grupoarea') || request()->is('grupoarea/*') ? 'active' : '' }}">
                                <i class="ml-1 fas fa-cubes iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> Crear Grupo </span>
                            </a>
                        </li>
                        {{-- @endcan
                        @can('configuracion_area_create') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('areas.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('areas') || request()->is('areas/*/edit') || request()->is('areas/create') ? 'active' : '' }}">

                                <i class="ml-1 fab fa-adn iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> Crear Áreas </span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan
            @can('configuracion_empleados_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('empleados.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('empleados') || request()->is('empleados/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> Empleados </span>
                    </a>
                </li>
                {{-- @endcan --}}
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-laptop iconos_menu letra_blanca"></i>
                        <span class="letra_blanca "> Activos </span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        {{-- @can('configuracion_tipoactivo_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('tipoactivos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('tipoactivos') || request()->is('tipoactivos/*') ? 'active' : '' }}">
                                <i class="ml-2 fas fa-layer-group iconos_menu letra_blanca"
                                    style="span-size:13pt;"></i>
                                <span class="letra_blanca"> Categorias</span>
                            </a>
                        </li>
                        {{-- @endcan
                    @can('configuracion_activo_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('activos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('activos') || request()->is('activos/*') ? 'active' : '' }}">
                                <i class="ml-2 fas fa-th-list iconos_menu letra_blanca" style="span-size:12pt;"></i>
                                <span class="letra_blanca"> Inventario</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @can('configuracion_procesos_access') --}}
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fas fa-dice-d20 iconos_menu letra_blanca"></i>
                        <span class="letra_blanca "> Procesos </span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        {{-- @can('configuracion_macroproceso_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('macroprocesos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('tipoactivos') || request()->is('tipoactivos/*') ? 'active' : '' }}">
                                <i class="ml-2 fas fa-th iconos_menu letra_blanca" style="span-size:12pt;"></i>
                                <span class="letra_blanca"> Macroprocesos</span>
                            </a>
                        </li>
                        {{-- @endcan
                        @can('configuracion_procesos_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('procesos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('procesos') || request()->is('procesos/*') ? 'active' : '' }}">
                                <i class="ml-2 fas fa-project-diagram iconos_menu letra_blanca"
                                    style="span-size:12pt;"></i>
                                <span class="letra_blanca"> Procesos</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan --}}

                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fas fa-chalkboard-teacher iconos_menu letra_blanca"></i>
                        <span class="letra_blanca "> Capacitaciones </span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        {{-- @can('configuracion_macroproceso_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ asset('categoria-capacitacion') }}"
                                class="c-sidebar-nav-link {{ request()->is('categoria-capacitacion') || request()->is('categoria-capacitacion/*') ? 'active' : '' }}">
                                <i class="ml-2 fas fa-layer-group iconos_menu letra_blanca"
                                    style="span-size:12pt;"></i>
                                <span class="letra_blanca"> Crear categorías</span>
                            </a>
                        </li>
                        {{-- @endcan
                    @can('configuracion_procesos_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ asset('recursos') }}"
                                class="c-sidebar-nav-link {{ request()->is('recursos') || request()->is('recursos/*') ? 'active' : '' }}">
                                <i class="ml-2 fas fa-graduation-cap iconos_menu letra_blanca"
                                    style="span-size:12pt;"></i>
                                <span class="letra_blanca"> Crear capacitaciones</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>

                {{-- @can('configuracion_empleados_access') --}}
                {{-- <li class="c-sidebar-nav-item">
                            <a href="{{ route('empleados.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('empleados') || request()->is('empleados/*') ? 'active' : '' }}">
                                <i class="fas fa-exclamation-triangle iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> Catálogo de Incidentes </span>
                            </a>
                        </li> --}}
                {{-- @endcan --}}

            </ul>
        </li>
        {{-- @endcan
@can('user_management_access') --}}
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-user-cog iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Ajustes de Usuario </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                {{-- @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('permissions.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('permissions') || request()->is('permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> {{ trans('cruds.permission.title') }} </span>
                            </a>
                        </li>
                    @endcan --}}
                {{-- @can('role_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('roles.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('roles') || request()->is('roles/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> {{ trans('cruds.role.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('user_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('users.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> {{ trans('cruds.user.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('controle_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('controles.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('controles') || request()->is('controles/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-screwdriver iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> {{ trans('cruds.controle.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('audit_log_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('audit-logs.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('audit-logs') || request()->is('audit-logs/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-file-alt iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> {{ trans('cruds.auditLog.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('puesto_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('puestos.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('puestos') || request()->is('puestos/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user-md iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> {{ trans('cruds.puesto.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('user_alert_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('user-alerts.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('user-alerts') || request()->is('user-alerts/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-bell iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.userAlert.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('enlaces_ejecutar_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('enlaces-ejecutars.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('enlaces-ejecutars') || request()->is('enlaces-ejecutars/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.enlacesEjecutar.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('team_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('teams.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('teams') || request()->is('teams/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-users iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.team.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('estado_incidente_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('estado-incidentes.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('estado-incidentes') || request()->is('estado-incidentes/*') ? 'active' : '' }}">
                        <i class="fa-fw fab fa-stripe-s iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.estadoIncidente.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('estado_documento_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('estado-documentos.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('estado-documentos') || request()->is('estado-documentos/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.estadoDocumento.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('estatus_plan_trabajo_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('estatus-plan-trabajos.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('estatus-plan-trabajos') || request()->is('estatus-plan-trabajos/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.estatusPlanTrabajo.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('plan_base_actividade_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('plan-base-actividades.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('plan-base-actividades') || request()->is('plan-base-actividades/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.planBaseActividade.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('control_documento_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('control-documentos.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('control-documentos') || request()->is('control-documentos/*') ? 'c-active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon"></i>
                        <span class="letra_blanca">{{ trans('cruds.controlDocumento.title') }}</span>
                    </a>
                </li>
                {{-- @endcan --}}
            </ul>
        </li>
        {{-- @endcan
@can('faq_management_access') --}}
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-question iconos_menu letra_blanca">

                </i>
                <span class="letra_blanca"> {{ trans('cruds.faqManagement.title') }} </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                {{-- @can('faq_category_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('faq-categories.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('faq-categories') || request()->is('faq-categories/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.faqCategory.title') }} </span>
                    </a>
                </li>
                {{-- @endcan
            @can('faq_question_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('faq-questions.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('faq-questions') || request()->is('faq-questions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-question iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> {{ trans('cruds.faqQuestion.title') }} </span>
                    </a>
                </li>
                {{-- @endcan --}}
            </ul>
        </li>
        {{-- @endcan --}}
        {{-- @if (\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
    <li class="c-sidebar-nav-item">
        <a class="{{ request()->is('team-members') || request()->is('team-members/*') ? 'active' : '' }} c-sidebar-nav-link"
            href="{{ route('team-members.index') }}">
            <i class="iconos_menu letra_blanca fa-fw fa fa-users">
            </i>
            <span>{{ trans('global.team-members') }}</span>
        </a>
    </li>
@endif --}}
        {{-- @can('sitemap_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ url('sitemap') }}" class="c-sidebar-nav-link">
                <i class="iconos_menu letra_blanca fas fa-fw fa-sitemap">

                </i>
                <span class="letra_blanca">Mapa de sitio</span>
            </a>
        </li>
        {{-- @endcan --}}
    </ul>

</div>

<script async>
    var a = document.getElementsByClassName("active");
    for (var i = 0; i < a.length; i++)
        a[i].className += " c-active";
    var ida = document.getElementsByClassName("c-active");
    for (var i = 0; i < ida.length; i++)
        ida[i].id += "seleccionado";

    document.getElementById('seleccionado').parentNode.classList.add('c-show');

    document.getElementById('seleccionado').parentNode.parentNode.classList.add('c-show');

    document.getElementById('seleccionado').parentNode.parentNode.parentNode.classList.add('c-show');

    document.getElementById('seleccionado').parentNode.parentNode.parentNode.parentNode.classList.add('c-show');

    document.getElementById('seleccionado').parentNode.parentNode.parentNode.parentNode.parentNode.classList.add(
        'c-show');
</script>
