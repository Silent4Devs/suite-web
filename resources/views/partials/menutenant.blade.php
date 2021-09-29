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
                /*if ($organizacion) {
                                                    if ($organizacion->logotipo) {
                                                        $logotipo = 'images/' . $organizacion->logotipo;
                                                    }
                                                }*/
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
            <a href="{{ route('admin.inicio-Usuario.index') }}"
                class="c-sidebar-nav-link {{ request()->is('admin/inicioUsuario') || request()->is('admin/inicioUsuario/*') ? 'active' : '' }}">
                <i class="fas fa-user iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Mi perfil</span>
            </a>
        </li>
        {{-- @endcan --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.portal-comunicacion.index') }}"
                class="c-sidebar-nav-link {{ request()->is('admin/portal-comunicacion') || request()->is('admin/portal-comunicacion/*') ? 'active' : '' }}">
                <i class="fas fa-newspaper iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Portal de Comunicación </span>
            </a>
        </li>
        {{-- @can('organizacion_access') --}}
        <li
            class="c-sidebar-nav-dropdown {{ request()->is('admin/matriz-riesgos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-unos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-dos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-tres*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fas fa-building iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Mi Organización </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                {{-- @can('organizacion_access') --}}
                {{--<li class="c-sidebar-nav-item">
                    <a href="{{ route('frontend.organizacions.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('frontend/organizacions') || request()->is('frontend/organizacions/*') ? 'active' : '' }}">
                        <i class="fas fa-bullseye iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca" style="margin-left:5px;"> Organización</span>
                    </a>
                </li>--}}
                {{-- @endcan
                    @can('organizacion_sede_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.sedes.obtenerListaSedes') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/obtenerListaSedes') || request()->is('admin/obtenerListaSedes/*') ? 'active' : '' }}">
                        <i class="fas fa-map-marked-alt iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> Sedes</span>
                    </a>
                </li>
                {{-- @endcan
                    @can('organizacion_area_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.areas.renderJerarquia') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/areas/areas-jerarquia') || request()->is('admin/areas/areas-jerarquia') ? 'active' : '' }}">
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
                    <a href="{{ route('admin.organigrama.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/organigrama') || request()->is('admin/organigrama/*') ? 'c-active' : '' }}">
                        <i class="fas fa-users iconos_menu letra_blanca">
                        </i>
                        <span class="letra_blanca"> Organigrama </span>
                    </a>
                </li>
                {{-- @endcan
                    @can('mapa_procesos_organizacion_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.procesos.mapa') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/procesos/mapa_procesos') || request()->is('admin/procesos/mapa-procesos') ? 'c-active' : '' }}">
                        <i class="fas fa-dice-d20 iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> Mapa de procesos </span>
                    </a>
                </li>
                {{-- @endcan --}}
            </ul>
        </li>
        {{-- @endcan --}}
        {{-- @can('dashboard_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.home') }}"
                class="c-sidebar-nav-link {{ request()->is('admin/dashboards') || request()->is('admin/dashboards/*') ? 'active' : '' }}">
                <i class="fa-fw far fa-chart-bar iconos_menu letra_blanca">

                </i>
                <span class="letra_blanca"> {{ trans('cruds.dashboard.title') }} </span>
            </a>
        </li>
        {{-- @endcan --}}
        {{-- @can('implementacion_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.implementacions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/implementacions") || request()->is("admin/implementacions/*") ? "active" : "" }}">

                    <i class="fas fa-paper-plane iconos_menu letra_blanca"></i>
                    <span class="letra_blanca"> {{ trans('cruds.implementacion.title') }} </span>
                </a>
            </li>
        @endcan
        @can('documentos_publicados_respositorio_access') --}}
        <li
            class="c-sidebar-nav-dropdown {{ request()->is('admin/carpeta*') ? 'c-show' : '' }} {{ request()->is('admin/crear-documentos*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fas fa-folder iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Documentos </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                {{-- @can('documentos_publicados_lista_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.documentos.publicados') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/publicados') || request()->is('admin/publicados*') ? 'active' : '' }}">
                        <i class="fas fa-copy iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> Lista de Documentos </span>
                    </a>
                </li>
                {{-- @endcan
                    @can('documentos_publicados_respositorio_access') --}}
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.carpeta.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/carpeta') || request()->is('admin/carpeta/*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open iconos_menu letra_blanca"></i>
                        <span class="letra_blanca"> Documentos Publicados </span>
                    </a>
                </li>
                {{-- @endcan --}}
            </ul>
        </li>
        {{-- @endcan --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.planes-de-accion.index') }}"
                class="c-sidebar-nav-link {{ request()->is('admin/planes-de-accion') || request()->is('admin/planes-de-accion/*/edit') || request()->is('admin/planes-de-accion/create') || request()->is('admin/planes-de-accion/*') ? 'active' : '' }}">
                <i class="iconos_menu letra_blanca fas fa-fw fa-stream"></i>
                <span class="letra_blanca">Planes de Acción</span>
            </a>
        </li>
        {{-- @can('agenda_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.systemCalendar') }}"
                class="c-sidebar-nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                <i class="iconos_menu letra_blanca fa-fw fas fa-calendar">
                </i>
                <span class="letra_blanca"> Agenda </span>
            </a>
        </li>
        {{-- @endcan
        @can('centro_atencion_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.desk.index') }}"
                class="c-sidebar-nav-link {{ request()->is('admin/desk') || request()->is('admin/desk/*') ? 'active' : '' }}">
                <i class="fas fa-headset iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Centro de Atención
                </span>
            </a>
        </li>
        {{-- @endcan
        @can('contactanos_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.soporte.index') }}"
                class="c-sidebar-nav-link {{ request()->is('admin/soporte.index') || request()->is('admin/soporte/*') ? 'active' : '' }}">
                <i class="iconos_menu letra_blanca fas fa-id-card"></i>
                <span class="letra_blanca"> Contáctanos </span>
            </a>
        </li>
        {{-- @endcan
        @can('glosario_access') --}}
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.glosarios.index') }}"
                class="c-sidebar-nav-link {{ request()->is('admin/glosarios') || request()->is('admin/glosarios/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-book iconos_menu letra_blanca">

                </i>
                <span class="letra_blanca"> {{ trans('cruds.glosario.title') }} </span>
            </a>
        </li>
        {{-- @endcan --}}
        {{-- <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.planTrabajoBase.index') }}"
                class="c-sidebar-nav-link {{989 request()->is('admin/planTrabajoBase') || request()->is('admin/planTrabajoBase/*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list iconos_menu letra_blanca"></i>

                </i>
                <span class="letra_blanca"> Plan de implementación </span>
            </a>
        </li> --}}
        {{-- @can('analisis_riesgo_access')
            {{-- <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.analisis-riesgos.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/analisis-riesgos') || request()->is('admin/analisis-riesgos/*') ? 'active' : '' }}">
                    <i class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>
                    <span class="letra_blanca"> Análisis de riesgos </span>
                </a>
            </li> --}}
        <li
            class="c-sidebar-nav-dropdown {{ request()->is('admin/matriz-riesgos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-unos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-dos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-tres*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Análisis de riesgos </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.amenazas.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/amenazas') || request()->is('admin/amenazas/*') ? 'active' : '' }}">
                        <i class="fas fa-fire iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca" style="margin-left:5px;"> Amenazas</span>
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.vulnerabilidads.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/vulnerabilidads') || request()->is('admin/vulnerabilidads/*') ? 'active' : '' }}">
                        <i class="fas fa-shield-alt iconos_menu letra_blanca">

                        </i>
                        <span class="letra_blanca"> Vulnerabilidades</span>
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.analisis-riesgos.index') }}"
                        class="c-sidebar-nav-link {{ request()->is('admin/admin.analisis-riesgos') || request()->is('admin/admin.analisis-riesgos') ? 'active' : '' }}">
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
                class="c-sidebar-nav-dropdown {{ request()->is('admin/matriz-riesgos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-unos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-dos*') ? 'c-show' : '' }} {{ request()->is('admin/gap-tres*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fas fa-exclamation-triangle iconos_menu letra_blanca">

                    </i>

                    <span class="letra_blanca"> {{ trans('cruds.analisisRiesgo.title') }} </span>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('matriz_riesgo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.matriz-riesgos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/matriz-riesgos') || request()->is('admin/matriz-riesgos/*') ? 'c-active' : '' }}">
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
            <a href="{{ url('/admin/analisis-brechas') }}" class="c-sidebar-nav-link">
                <i class="iconos_menu letra_blanca fas fa-fw fa-file-signature">

                </i>
                <span class="letra_blanca"> Análisis de brechas</span>
            </a>
        </li> --}}

        <li class="c-sidebar-nav-title">
            <span class="letra_blanca">Recursos Humanos</span>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.rh-evaluacion360.index') }}">
                <i class="fa-fw fas fa-circle-notch iconos_menu letra_blanca"></i>
                <span class="letra_blanca"> Evaluación 360 Grados </span>
            </a>
        </li>

        <li class="c-sidebar-nav-title">
            <span class="letra_blanca">Normas</span>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.iso27001.index') }}#contexto">
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
                            class="c-sidebar-nav-dropdown {{ request()->is('admin/carpeta*') ? 'c-show' : '' }} {{ request()->is('admin/crear-documentos*') ? 'c-show' : '' }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fas fa-folder iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> Documentos </span>
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                {{-- @can('documentos_create') --}}
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route('admin.documentos.index') }}"
                                            class="c-sidebar-nav-link {{ request()->is('admin/crear-documentos') || request()->is('admin/crear-documentos*') ? 'active' : '' }}">
                                            <i class="fas fa-folder-plus iconos_menu letra_blanca"></i>
                                            <span class="letra_blanca"> Crear Documentos </span>
                                        </a>
                                    </li>
                                {{-- @endcan
                                @can('carpetum_access') --}}
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route('admin.carpeta.index') }}"
                                            class="c-sidebar-nav-link {{ request()->is('admin/carpeta') || request()->is('admin/carpeta/*') ? 'active' : '' }}">
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
                            <a href="{{ route('admin.sedes.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/sedes') || request()->is('admin/sedes/*/edit') || request()->is('admin/sedes/create') ? 'active' : '' }}">
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
                                        <a href="{{ route('admin.grupoarea.index') }}"
                                            class="c-sidebar-nav-link {{ request()->is('admin/grupoarea') || request()->is('admin/grupoarea/*') ? 'active' : '' }}">
                                            <i class="ml-1 fas fa-cubes iconos_menu letra_blanca"></i>
                                            <span class="letra_blanca"> Crear Grupo </span>
                                        </a>
                                    </li>
                                {{-- @endcan
                                @can('configuracion_area_create') --}}
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route('admin.areas.index') }}"
                                            class="c-sidebar-nav-link {{ request()->is('admin/areas') || request()->is('admin/areas/*/edit') || request()->is('admin/areas/create') ? 'active' : '' }}">

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
                            <a href="{{ route('admin.empleados.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/empleados') || request()->is('admin/empleados/*') ? 'active' : '' }}">
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
                                    <a href="{{ route('admin.tipoactivos.index') }}"
                                        class="c-sidebar-nav-link {{ request()->is('admin/tipoactivos') || request()->is('admin/tipoactivos/*') ? 'active' : '' }}">
                                        <i class="ml-2 fas fa-layer-group iconos_menu letra_blanca"
                                            style="span-size:13pt;"></i>
                                        <span class="letra_blanca"> Categorias</span>
                                    </a>
                                </li>
                            {{-- @endcan
                            @can('configuracion_activo_access') --}}
                                <li class="c-sidebar-nav-item">
                                    <a href="{{ route('admin.activos.index') }}"
                                        class="c-sidebar-nav-link {{ request()->is('admin/activos') || request()->is('admin/activos/*') ? 'active' : '' }}">
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
                                        <a href="{{ route('admin.macroprocesos.index') }}"
                                            class="c-sidebar-nav-link {{ request()->is('admin/tipoactivos') || request()->is('admin/tipoactivos/*') ? 'active' : '' }}">
                                            <i class="ml-2 fas fa-th iconos_menu letra_blanca" style="span-size:12pt;"></i>
                                            <span class="letra_blanca"> Macroprocesos</span>
                                        </a>
                                    </li>
                                {{-- @endcan
                                @can('configuracion_procesos_access') --}}
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route('admin.procesos.index') }}"
                                            class="c-sidebar-nav-link {{ request()->is('admin/procesos') || request()->is('admin/procesos/*') ? 'active' : '' }}">
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
                                    <a href="{{ asset('admin/categoria-capacitacion') }}"
                                        class="c-sidebar-nav-link {{ request()->is('admin/categoria-capacitacion') || request()->is('admin/categoria-capacitacion/*') ? 'active' : '' }}">
                                        <i class="ml-2 fas fa-layer-group iconos_menu letra_blanca"
                                            style="span-size:12pt;"></i>
                                        <span class="letra_blanca"> Crear categorías</span>
                                    </a>
                                </li>
                            {{-- @endcan
                            @can('configuracion_procesos_access') --}}
                                <li class="c-sidebar-nav-item">
                                    <a href="{{ asset('admin/recursos') }}"
                                        class="c-sidebar-nav-link {{ request()->is('admin/recursos') || request()->is('admin/recursos/*') ? 'active' : '' }}">
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
                            <a href="{{ route('admin.empleados.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/empleados') || request()->is('admin/empleados/*') ? 'active' : '' }}">
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
                            <a href="{{ route('admin.permissions.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> {{ trans('cruds.permission.title') }} </span>
                            </a>
                        </li>
                    @endcan --}}
                    {{-- @can('role_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> {{ trans('cruds.role.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('user_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> {{ trans('cruds.user.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('controle_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.controles.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/controles') || request()->is('admin/controles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-screwdriver iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> {{ trans('cruds.controle.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('audit_log_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.audit-logs.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file-alt iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> {{ trans('cruds.auditLog.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('puesto_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.puestos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/puestos') || request()->is('admin/puestos/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user-md iconos_menu letra_blanca"></i>
                                <span class="letra_blanca"> {{ trans('cruds.puesto.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('user_alert_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.user-alerts.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/user-alerts') || request()->is('admin/user-alerts/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-bell iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.userAlert.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('enlaces_ejecutar_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.enlaces-ejecutars.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/enlaces-ejecutars') || request()->is('admin/enlaces-ejecutars/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.enlacesEjecutar.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('team_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.teams.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-users iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.team.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('estado_incidente_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.estado-incidentes.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/estado-incidentes') || request()->is('admin/estado-incidentes/*') ? 'active' : '' }}">
                                <i class="fa-fw fab fa-stripe-s iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.estadoIncidente.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('estado_documento_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.estado-documentos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/estado-documentos') || request()->is('admin/estado-documentos/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.estadoDocumento.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('estatus_plan_trabajo_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.estatus-plan-trabajos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/estatus-plan-trabajos') || request()->is('admin/estatus-plan-trabajos/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.estatusPlanTrabajo.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('plan_base_actividade_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.plan-base-actividades.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/plan-base-actividades') || request()->is('admin/plan-base-actividades/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.planBaseActividade.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('control_documento_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.control-documentos.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/control-documentos') || request()->is('admin/control-documentos/*') ? 'c-active' : '' }}">
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
                            <a href="{{ route('admin.faq-categories.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/faq-categories') || request()->is('admin/faq-categories/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.faqCategory.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan
                    @can('faq_question_access') --}}
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.faq-questions.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/faq-questions') || request()->is('admin/faq-questions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-question iconos_menu letra_blanca">

                                </i>
                                <span class="letra_blanca"> {{ trans('cruds.faqQuestion.title') }} </span>
                            </a>
                        </li>
                    {{-- @endcan --}}
                </ul>
            </li>
        {{-- @endcan
        @if (\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="c-sidebar-nav-item">
                <a class="{{ request()->is('admin/team-members') || request()->is('admin/team-members/*') ? 'active' : '' }} c-sidebar-nav-link"
                    href="{{ route('admin.team-members.index') }}">
                    <i class="iconos_menu letra_blanca fa-fw fa fa-users">
                    </i>
                    <span>{{ trans('global.team-members') }}</span>
                </a>
            </li>
        @endif
        @can('sitemap_access') --}}
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
