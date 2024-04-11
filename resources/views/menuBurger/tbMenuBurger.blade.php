<div class="menu-hedare-window">
    <div class="item-content-menu-header" style="background-color: #EEF6FF; min-width: 280px;">
        <div class="logo-org-header">
            @php
                use App\Models\Organizacion;

                $organizacion = Organizacion::getLogo();
                if (!is_null($organizacion)) {
                    $logotipo = $organizacion->logotipo;
                } else {
                    $logotipo = 'img/logo_monocromatico.png';
                }
            @endphp

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
                        Planes de acción
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
                    <a href="{{ asset('admin/capacitaciones-inicio') }}">
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
                        <span>Admin. de Proyectos</span>
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
