<header>
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
            $logotipo = 'logo-ltr.png';
        }

        $hoy_format_global = \Carbon\Carbon::now()->format('d/m/Y');
    @endphp
    <div class="content-header-blue">
        <div class="caja-inicio-options-header">
            <button class="btn-menu-header" onclick="menuHeader();">
                <div class="points-menu-header">
                    <div class="point-menu-header"></div>
                    <div class="point-menu-header"></div>
                    <div class="point-menu-header"></div>
                    <div class="point-menu-header"></div>
                    <div class="point-menu-header"></div>
                    <div class="point-menu-header"></div>
                    <div class="point-menu-header"></div>
                    <div class="point-menu-header"></div>
                    <div class="point-menu-header"></div>
                </div>
                <div class="close-menu-header"></div>
            </button>
            <a href="{{ url('/admin/portal-comunicacion') }}">
                <img src="{{ asset('img/logo-ltr.png') }}" alt="" style="height: 40px;">
            </a>
            @livewire('global-search-component', ['lugar' => 'header'])
        </div>
        @if ($empleado)
            <ul class="ml-auto c-header-nav gap-3">
                <li class="time-custom d-none">
                    <a href="{{ route('admin.timesheet-create') }}" title="Timesheet" data-toggle="tooltip"
                        data-placement="bottom">
                        <i class="bi bi-calendar-plus"></i>
                    </a>
                </li>
                @can('calendario_corporativo_acceder')
                    <li class="calendar-custom d-none">
                        <a href="{{ route('admin.systemCalendar') }}" title="Calendario" data-toggle="tooltip"
                            data-placement="bottom">
                            <i class="bi bi-calendar3"></i>
                        </a>
                    </li>
                @endcan
                @can('documentos_publicados_acceder')
                    <li class="document-custom d-none">
                        <a href="{{ route('admin.documentos.publicados') }}" title="Ver Documentos" data-toggle="tooltip"
                            data-placement="bottom">
                            <i class="bi bi-folder"></i>
                        </a>
                    </li>
                @endcan
                @can('planes_de_accion_acceder')
                    <li class="planes-custom d-none">
                        <a href="{{ route('admin.planes-de-accion.index') }}" title="Planes de Acción" data-toggle="tooltip"
                            data-placement="bottom">
                            <i class="bi bi-file-earmark-check"></i>
                        </a>
                    </li>
                @endcan
                @can('centro_de_atencion_acceder')
                    <li class="centro-custom d-none">
                        <a href="{{ route('admin.desk.index') }}" title="Centro de Trabajo" data-toggle="tooltip"
                            data-placement="bottom">
                            <i class="bi bi-person-workspace"></i>
                        </a>
                    </li>
                @endcan
                <li>
                    <button class="" data-toggle="modal" data-target="#modalCustomLinks">
                        <i class="material-symbols-outlined"> add_circle</i>
                    </button>
                </li>
                <li>
                    <i id="fullscreen-btn" class="material-symbols-outlined" style="cursor: pointer;">
                        fullscreen
                    </i>
                    <script>
                        document.getElementById("fullscreen-btn").addEventListener("click", function(e) {
                            if (!document.fullscreenElement) {
                                document.documentElement.requestFullscreen();
                                e.target.innerHTML = "fullscreen_exit";
                            } else {
                                document.exitFullscreen();
                                e.target.innerHTML = "fullscreen";
                            }
                        });
                    </script>
                </li>
                <li style="position: relative;">
                    @livewire('campana-notificaciones-component')
                </li>
                <li class="c-header-nav-item dropdown show">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <div style="width:100%; display: flex; align-items: center;">
                            @if ($empleado)
                                <div style="overflow:hidden; border-radius: 100px; background-color: #00000045;"
                                    class="mr-2">
                                    <img class="img_empleado" style="width: 30px; height: 30px;"
                                        src="{{ asset('storage/empleados/imagenes/' . '/' . $empleado->avatar) }}"
                                        alt="{{ $empleado->name }}">

                                    <i class="material-symbols-outlined mx-2">settings</i>
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
                        <div class="mt-3 text-center dropdown-menu dropdown-menu-right hide py-0"
                            style="width:300px; box-shadow: 0px 3px 6px 1px #00000029; border-radius: 4px; border:none;">
                            <div class="d-flex align-items-center justify-content-center gap-2 py-3"
                                style=" background-color: #cfdbe4;">
                                <div class="img-person">
                                    <img src="{{ $empleado->avatar_ruta }}" alt="{{ $empleado->name }}">
                                </div>
                                <span style="font-size:18px;" class="color-tbj">
                                    <strong>{{ $empleado->name }}</strong>
                                </span>
                            </div>
                            <div class="p-4 text-start">
                                <div>
                                    @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                                        @can('profile_password_edit')
                                            <a style="all: unset; color: #747474; cursor: pointer;"
                                                class=" {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                                                href="{{ route('profile.password.edit') }}">
                                                <i class="bi bi-gear"></i>
                                                Configuración de perfil
                                            </a>
                                        @endcan
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <a style="all: unset; color: #747474; cursor: pointer;"
                                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Cerrar sesión
                                    </a>
                                </div>
                                <div class="mt-3">
                                    <button style="all: unset;  cursor: pointer;"
                                        onclick="document.querySelector('.content-custom-design').classList.remove('invisible')">
                                        <i class="bi bi-pencil-square"></i>
                                        Personalización visual
                                    </button>
                                </div>
                                <div class="mt-3">
                                    <a style="all: unset; color: #747474; cursor: pointer;"
                                        href="{{ route('admin.inicioUsuario.mis-cursos') }}">
                                        <i class="bi bi-trophy"></i>
                                        Mis logros
                                    </a>
                                </div>
                                <div class="mt-3 text-end">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                            {{ $empleado->disponibilidad->disponibilidad == 1 ? 'checked' : '' }}
                                            onchange="handleSwitchChange(event)">
                                        <label class="custom-control-label" for="customSwitch1">
                                            @switch($empleado->disponibilidad->disponibilidad)
                                                @case(1)
                                                    Activo
                                                @break

                                                @case(2)
                                                    Ausente
                                                @break

                                                @default
                                                    Activo
                                            @endswitch
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
            </ul>
        @endif
    </div>
    <div class="menu-hedare-window">
        {{-- <div class="item-content-menu-header" style="background-color: #EEF6FF; min-width: 280px;">
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
        </div> --}}
        @if (
            $usuario->can('clausulas_auditorias_acceder') ||
                $usuario->can('capacitaciones_acceder') ||
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
                    @can('capacitaciones_acceder')
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



                    @can('mi_perfil_acceder')
                        <a href="{{ route('admin.inicio-Usuario.index') }}">
                            <div class="caja-icon-mod-header" style="background: #bfdbff;">
                                <i class="bi bi-file-person-fill"></i>
                            </div>
                            <span>Mi perfil</span>
                        </a>
                    @endcan
                    @can('portal_de_comunicaccion_acceder')
                        <a href="{{ route('admin.portal-comunicacion.index') }}">
                            <div class="caja-icon-mod-header" style="background: #ffd1bf;">
                                <i class="bi bi-newspaper"></i>
                            </div>
                            <span>Comunicación</span>
                        </a>
                    @endcan
                    @can('calendario_corporativo_acceder')
                        <a href="{{ route('admin.systemCalendar') }}">
                            <div class="caja-icon-mod-header" style="background: #e1bfff;">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <span>Calendario</span>
                        </a>
                    @endcan
                    @can('documentos_publicados_acceder')
                        <a href="{{ route('admin.documentos.publicados') }}">
                            <div class="caja-icon-mod-header" style="background: #bffdff;">
                                <i class="bi bi-folder"></i>
                            </div>
                            <span>Documentos</span>
                        </a>
                    @endcan
                    @can('planes_de_accion_acceder')
                        <a href="{{ route('admin.planes-de-accion.index') }}">
                            <div class="caja-icon-mod-header" style="background: #ffbfe1;">
                                <i class="bi bi-file-earmark-check"></i>
                            </div>
                            <span>Planes de Trabajo</span>
                        </a>
                    @endcan
                    @can('centro_de_atencion_acceder')
                        <a href="{{ route('admin.desk.index') }}">
                            <div class="caja-icon-mod-header" style="background: #bfffe3;">
                                <i class="bi bi-person-workspace"></i>
                            </div>
                            <span>Centro de atención</span>
                        </a>
                    @endcan

                    <a href="{{ route('admin.timesheet-create') }}">
                        <div class="caja-icon-mod-header" style="background: #bfebff;">
                            <i class="bi bi-calendar-plus"></i>
                        </div>
                        <span>Timesheet</span>
                    </a>

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
                                    @can('matriz_bia_menu_acceder')
                                        <li>
                                            <a href="{{ route('admin.analisis-impacto.menu-BIA') }}">
                                                Análisis de Impacto
                                            </a>
                                        </li>
                                    @endcan
                                    @can('lista_distribucion_acceder')
                                        <li><a href="{{ asset('admin/lista-distribucion') }}">Lista de
                                                distribución</a>
                                        </li>
                                    @endcan
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
                                    @can('lista_informativa_acceder')
                                        <li>
                                            <a href="{{ route('admin.lista-informativa.index') }}">Lista Informativa</a>
                                        </li>
                                    @endcan
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
                                    <li><a href="{{ route('admin.module_firmas') }}">Modulo Firmas</a></li>
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
        {{-- <div class="item-content-menu-header caja-img-escritorio-header"
            style="background-color: #e7ecef; padding: 0px;">
            <img src="{{ asset('img/escritorio-header.webp') }}" alt="" class="img-escritorio-header">
        </div> --}}
    </div>
    <div class="bg-black-header-menu" onclick="menuHeader();"></div>
</header>

<!-- Modal -->
<div class="modal fade" id="modalCustomLinks" tabindex="-1" aria-labelledby="modalCustomLinksLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="mt-3 text-center">Accesos directos</h5>

                <div class="mt-5">
                    <div class="box-acces-custom-items">
                        <button class="btn btn-acces-custom border d-flex align-items-center flex-column p-1 px-3"
                            style="color: #606060;" data-custom="time-custom">
                            <i class="bi bi-calendar-plus" style="font-size: 38px;"></i>
                            <small style="font-size: 9px;">Timesheet</small>
                        </button>
                        @can('calendario_corporativo_acceder')
                            <button class="btn btn-acces-custom border d-flex align-items-center flex-column p-1 px-3"
                                style="color: #606060;" data-custom="calendar-custom">
                                <i class="bi bi-calendar3" style="font-size: 38px;"></i>
                                <small style="font-size: 9px;">Calendario</small>
                            </button>
                        @endcan
                        @can('documentos_publicados_acceder')
                            <button class="btn btn-acces-custom border d-flex align-items-center flex-column p-1 px-3"
                                style="color: #606060;" data-custom="document-custom">
                                <i class="bi bi-folder" style="font-size: 38px;"></i>
                                <small style="font-size: 9px;">Documentos</small>
                            </button>
                        @endcan
                        @can('planes_de_accion_acceder')
                            <button class="btn btn-acces-custom border d-flex align-items-center flex-column p-1 px-3"
                                style="color: #606060;" data-custom="planes-custom">
                                <i class="bi bi-file-earmark-check" style="font-size: 38px;"></i>
                                <small style="font-size: 9px;">Planes de Trabajo</small>
                            </button>
                        @endcan

                        @can('centro_de_atencion_acceder')
                            <button class="btn btn-acces-custom border d-flex align-items-center flex-column p-1 px-3"
                                style="color: #606060;" data-custom="centro-custom">
                                <i class="bi bi-person-workspace" style="font-size: 38px;"></i>
                                <small style="font-size: 9px;">Centro de atención</small>
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para inicializar los botones y contenido según localStorage
    function initializeButtons() {
        document.querySelectorAll('.btn-acces-custom').forEach(element => {
            const customClass = element.getAttribute('data-custom');

            // Obtener y aplicar el estado del botón desde localStorage
            const isActive = localStorage.getItem(`btn-${customClass}-active`);
            if (isActive === 'true') {
                element.classList.add('active');
            } else {
                element.classList.remove('active');
            }

            // Obtener y aplicar el estado del contenido desde localStorage
            const isHidden = localStorage.getItem(`content-${customClass}-hidden`);
            const contentElement = document.querySelector('.' + customClass);
            if (isHidden === 'true') {
                contentElement.classList.add('d-none');
            } else {
                contentElement.classList.remove('d-none');
            }
        });
    }

    // Función para agregar eventos a los botones y guardar el estado en localStorage
    function setupButtonListeners() {
        document.querySelectorAll('.btn-acces-custom').forEach(element => {
            element.addEventListener('click', (e) => {
                const target = e.currentTarget;
                const customClass = target.getAttribute('data-custom');
                const contentElement = document.querySelector('.' + customClass);

                // Cambiar el estado de "active" y guardarlo en localStorage
                target.classList.toggle('active');
                const isActive = target.classList.contains('active');
                localStorage.setItem(`btn-${customClass}-active`, isActive);

                // Cambiar el estado de "d-none" en el contenido y guardarlo en localStorage
                if (isActive) {
                    contentElement.classList.remove('d-none');
                } else {
                    contentElement.classList.add('d-none');
                }
                const isHidden = contentElement.classList.contains('d-none');
                localStorage.setItem(`content-${customClass}-hidden`, isHidden);
            });
        });
    }

    // Ejecutar la inicialización al cargar la página
    document.addEventListener('DOMContentLoaded', () => {
        initializeButtons();
        setupButtonListeners();
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip(); // Initialize all tooltips
    });
</script>
