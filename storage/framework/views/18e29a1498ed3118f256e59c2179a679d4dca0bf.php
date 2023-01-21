<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/dark_mode.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/menu.css')); ?>">

<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show c-sidebar-light" style=" border: none;">
    <div class="bg-transparent c-sidebar-brand d-md-down-none caja_caja_img_logo">

        <!-- <div class="text-center dark_mode1" style="padding-top: 20px;">-->
        
        <div class="caja_img_logo">
            <?php
                use App\Models\Organizacion;
                $organizacion = Organizacion::select('id', 'logotipo')->first();
                if (!is_null($organizacion)) {
                    $logotipo = $organizacion->logotipo;
                } else {
                    $logotipo = 'img/logo_monocromatico.png';
                }
            ?>

            <img src="<?php echo e(asset($logotipo)); ?>" class="img_logo" style="height: 90px; margin: 20px 0;">

        </div>

    </div>

    <style>
        .c-sidebar-navli:nth-last-child(2) {
            margin-bottom: 30px;
        }
    </style>

    <ul class="c-sidebar-nav dark_mode1">

        <li class="c-sidebar-nav-title">
            <font class="letra_blanca" style="color: #345183;">Menu</font>
        </li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mi_perfil_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.inicio-Usuario.index')); ?>#datos"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/inicioUsuario') || request()->is('admin/inicioUsuario/*') || request()->is('admin/competencias/*/cv') ? 'active' : ''); ?>">
                    <i class="bi bi-file-person iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Mi perfil</font>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('portal_de_comunicaccion_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.portal-comunicacion.index')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/portal-comunicacion') || request()->is('admin/portal-comunicacion/*') ? 'active' : ''); ?>">
                    <i class="bi bi-newspaper iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Portal de Comunicación </font>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('timesheet_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.timesheet-inicio')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/timesheet') || request()->is('admin/timesheet/*') ? 'active' : ''); ?>">
                    <i class="bi bi-calendar3-range letra_blanca iconos_menu"></i>
                    <font class="letra_blanca"> Timesheet </font>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('calendario_organizacional_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.systemCalendar')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : ''); ?>">
                    <i class="bi bi-calendar3 iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Calendario </font>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos_publicados_acceder')): ?>
            
            

            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.documentos.publicados')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/publicados') || request()->is('admin/publicados*') ? 'active' : ''); ?>">
                    <i class="bi bi-folder iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Documentos </font>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('planes_de_accion_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.planes-de-accion.index')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/planes-de-accion') || request()->is('admin/planes-de-accion/*/edit') || request()->is('admin/planes-de-accion/create') || request()->is('admin/planes-de-accion/*') ? 'active' : ''); ?>">
                    <i class="bi bi-file-check iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Planes de Acción</font>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('centro_de_atencion_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.desk.index')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/desk') || request()->is('admin/desk/*') ? 'active' : ''); ?>">
                    <i class="bi bi-person-workspace iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Centro de Atención
                    </font>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('solicitud_mensajeria_atencion')): ?>
        <li class="c-sidebar-nav-item">
            <a href="<?php echo e(route('admin.envio-documentos.atencion')); ?>"
                class="c-sidebar-nav-link <?php echo e(request()->is('admin/desk') || request()->is('admin/desk/*') ? 'active' : ''); ?>">
                <i class="far fa-paper-plane iconos_menu letra_blanca"></i>
                <font class="letra_blanca">Atención de Mensajería
                </font>
            </a>
        </li>
    <?php endif; ?>
        
        
        
        
        
        <?php if(auth()->user()->can('visitantes_acceder') ||
            auth()->user()->can('capital_humano_acceder') ||
            auth()->user()->can('analisis_de_riesgo_integral_acceder') ||
            auth()->user()->can('sistema_de_gestion_acceder') ||
            auth()->user()->can('matriz_bia_menu_acceder')): ?>
            <li class="c-sidebar-nav-title">
                <font class="letra_blanca" style="color: #345183;">Módulos&nbsp;Tabantaj</font>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('visitantes_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.visitantes.menu')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/visitantes') || request()->is('admin/visitantes/*') ? 'active' : ''); ?>">
                    <i class="bi bi-person-bounding-box iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Visitantes</font>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('capital_humano_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.capital-humano.index')); ?>"
                    class="c-sidebar-nav-link
                    <?php echo e(request()->is('admin/empleados') || request()->is('admin/recursos-humanos/evaluacion-360/competencias') || request()->is('admin/lista-documentos') || request()->is('admin/perfiles') || request()->is('admin/recursos-humanos/tipos-contratos-empleados') || request()->is('admin/lista-documentos') || request()->is('admin/recursos-humanos/entidades-crediticias') || request()->is('admin/recursos-humanos/evaluacion-360/objetivos') || request()->is('admin/expedientes-profesionales') || request()->is('admin/categoria-capacitacion') || request()->is('admin/recursos-humanos/calendario-oficial') || request()->is('admin/recursos') || request()->is('admin/recursos-humanos/evaluacion-360/evaluaciones/create') || request()->is('admin/recursos-humanos/evaluacion-360/evaluaciones') || request()->is('admin/tabla-calendario/index') || request()->is('admin/capital-humano#') || request()->is('admin/capital-humano/*') ? 'active' : ''); ?>">
                    <i class="bi bi-people iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Capital Humano </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    
                    <li class="c-sidebar-nav-item">
                        <a href="<?php echo e(route('admin.capital-humano.index')); ?>"
                            class="c-sidebar-nav-link <?php echo e(request()->is('admin/capital-humano') || request()->is('admin/capital-humano/*') || request()->is('admin/empleados/*') || request()->is('admin/expedientes-profesionales/*') ? 'active' : ''); ?>">
                            
                            <i class="fa-fw fas fa-file iconos_menu letra_blanca"></i>
                            <font class="letra_blanca" style="margin-left:10px;"> Capital Humano Menú </font>
                        </a>
                    </li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuracion_empleados_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route('admin.tipos-contratos-empleados.index')); ?>"
                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/tipos-contratos-empleados') || request()->is('admin/tipos-contratos-empleados/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-file iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca" style="margin-left:10px;"> Tipos de contratos </font>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuracion_empleados_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route('admin.entidades-crediticias.index')); ?>"
                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/entidades-crediticias') || request()->is('admin/entidades-crediticias/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-file iconos_menu letra_blanca"></i>
                                <font class="letra_blanca" style="margin-left:10px;"> Entidades crediticias </font>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('organigrama_acceder')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route('admin.organigrama.index')); ?>"
                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/organigrama') || request()->is('admin/organigrama/*') ? 'c-active' : ''); ?>">
                                <i class="fas fa-sitemap iconos_menu letra_blanca"></i>
                                <font class="letra_blanca" style="margin-left:10px;"> Organigrama </font>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="c-sidebar-nav-dropdown">
                        <a class="c-sidebar-nav-dropdown-toggle" href="#">
                            <i class="fas fa-chalkboard-teacher iconos_menu letra_blanca"></i>
                            <font class="letra_blanca " style="margin-left:10px;"> Capacitaciones </font>
                        </a>
                        <ul class="c-sidebar-nav-dropdown-items">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuracion_macroproceso_access')): ?>
                                <li class="c-sidebar-nav-item">
                                    <a href="<?php echo e(asset('admin/categoria-capacitacion')); ?>">
                                        <i class="ml-2 fas fa-layer-group iconos_menu letra_blanca"
                                            style="font-size:12pt;"></i>
                                        <font class="letra_blanca" style="margin-left:10px;"> Crear categorías</font>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuracion_procesos_access')): ?>
                                <li class="c-sidebar-nav-item">
                                    <a href="<?php echo e(asset('admin/recursos')); ?>">
                                        <i class="ml-2 fas fa-graduation-cap iconos_menu letra_blanca"
                                            style="font-size:12pt;"></i>
                                        <font class="letra_blanca" style="margin-left:10px;"> Crear capacitaciones</font>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a href="<?php echo e(route('admin.rh-evaluacion360.index')); ?>">
                            <img src="<?php echo e(asset('img/360-degrees1.png')); ?>" alt="icono360"
                                style="width: 26px;margin-right: 14px;margin-left: 3px;">
                            <font class="letra_blanca" style="margin-left:10px;"> Evaluación 360° </font>
                        </a>
                    </li>
                    
                    <li class="c-sidebar-nav-dropdown">
                        <a class="c-sidebar-nav-dropdown-toggle" href="#">
                            <i class="fas fa-calendar-alt iconos_menu letra_blanca"></i>
                            <font class="letra_blanca " style="margin-left:10px;"> Calendario </font>
                        </a>
                        <ul class="c-sidebar-nav-dropdown-items">

                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.calendario-oficial.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('calendario-oficial') || request()->is('calendario-oficial/*') ? 'active' : ''); ?>">
                                    <i class="ml-2 fas fa-drum iconos_menu letra_blanca" style="font-size:12pt;"></i>
                                    <font class="letra_blanca" style="margin-left:10px;">Dias Festivos</font>
                                </a>
                            </li>

                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.tabla-calendario.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('tabla-calendario') || request()->is('tabla-calendario/*') ? 'active' : ''); ?>">
                                    <i class="ml-2 fas fa-gifts iconos_menu letra_blanca" style="font-size:12pt;"></i>
                                    <font class="letra_blanca" style="margin-left:10px;">Eventos</font>
                                </a>
                            </li>



                        </ul>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('analisis_de_riesgo_integral_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.analisis-riesgos.menu')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/matriz-riesgos') || request()->is('admin/matriz-riesgos*') ? 'active' : ''); ?>">
                    <i class="bi bi-exclamation-triangle iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Análisis de Riesgos (RA) </font>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('matriz_bia_menu_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route('admin.analisis-impacto.menu')); ?>"
                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/analisis-impacto-menu/') || request()->is('admin/analisis-impacto/*') ? 'active' : ''); ?>">
                    <i class="fas fa-traffic-light iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Análisis de Impacto</font>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sistema_de_gestion_acceder')): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link <?php echo e(request()->is('admin/iso27001') ||
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
                    : ''); ?>"
                    href="<?php echo e(route('admin.iso27001.index')); ?>#contexto">
                    <i class="bi bi-globe2 iconos_menu letra_blanca"></i>
                    <font class="letra_blanca">Sistema de Gestión</font>
                </a>
            </li>
        <?php endif; ?>
        

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permisos_de_administracion_acceder')): ?>
            <li class="c-sidebar-nav-title">
                <font class="letra_blanca" style="color: #345183;">Administración</font>
            </li>

            

            

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configurar_organizacion_acceder')): ?>
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-building iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Configurar Organización </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mi_organizacion_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.organizacions.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/organizacions') || request()->is('admin/organizacions/*') ? 'active' : ''); ?>">
                                    <i class="bi bi-building iconos_menu letra_blanca"></i>

                                    <font class="letra_blanca">Organización</font>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sedes_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.sedes.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/sedes') || request()->is('admin/sedes/*/edit') || request()->is('admin/sedes/create') ? 'active' : ''); ?>">
                                    <i class="bi bi-geo-alt iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca">Sedes</font>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acceder_submenu_areas')): ?>
                            <li class="c-sidebar-nav-dropdown">
                                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="bi bi-geo iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca "> Áreas </font>
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear_grupo_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(route('admin.grupoarea.index')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/grupoarea') || request()->is('admin/grupoarea/*') ? 'active' : ''); ?>">
                                                <i class="bi bi-boxes iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Crear Grupo </font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear_area_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(route('admin.areas.index')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/areas') || request()->is('admin/areas/*/edit') || request()->is('admin/areas/create') ? 'active' : ''); ?>">

                                                <i class="bi bi-geo iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Crear Áreas </font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acceder_submenu_mapa_procesos')): ?>
                            <li class="c-sidebar-nav-dropdown">
                                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="bi bi-file-post mr-2 iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca "> Mapa de Procesos </font>
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('macroprocesos_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(route('admin.macroprocesos.index')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/tipoactivos') || request()->is('admin/tipoactivos/*') ? 'active' : ''); ?>">
                                                <i class="bi bi-file-earmark-post-fill iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Macroprocesos</font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('procesos_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(route('admin.procesos.index')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/procesos') || request()->is('admin/procesos/*') ? 'active' : ''); ?>">
                                                <i class="bi bi-file-earmark-post iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Procesos</font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acceder_submenu_activos')): ?>
                            <li class="c-sidebar-nav-dropdown">
                                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="bi bi-pc-display-horizontal iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca "> Activos </font>
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('categoria_activos_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(route('admin.tipoactivos.index')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/tipoactivos') || request()->is('admin/tipoactivos/*') ? 'active' : ''); ?>">
                                                <i class="bi bi-layers iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Categorias</font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subcategoria_activos_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(route('admin.subtipoactivos.index')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/tipoactivos') || request()->is('admin/tipoactivos/*') ? 'active' : ''); ?>">
                                                <i class="bi bi-layers-half iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Subcategorias</font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario_activos_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(route('admin.activos.index')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/activos') || request()->is('admin/activos/*') ? 'active' : ''); ?>">
                                                <i class="bi bi-list-task iconos_menu letra_blanca"></i>
                                                <font class="letra_blanca"> Inventario</font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('glosario_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.glosarios.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/organizacions') || request()->is('admin/organizacions/*') ? 'active' : ''); ?>">
                                    <i class="bi bi-list-columns-reverse iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca" style="margin-left:10px;">Glosario</font>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuracion_empleados_access')): ?>
                            
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('control_documentar_acceder')): ?>
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-folder iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Documentos </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('agregar_documento_crear')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.documentos.create')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/create') || request()->is('admin/create*') ? 'active' : ''); ?>">
                                    <i class="bi bi-folder-plus iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> Agregar Documento </font>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('control_documentar_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.documentos.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/crear-documentos') || request()->is('admin/crear-documentos*') ? 'active' : ''); ?>">
                                    <i class="bi bi-card-checklist letra_blanca iconos_menu"></i>
                                    <font class="letra_blanca"> Control Documental </font>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('repositorio_documental_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.carpeta.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/carpeta') || request()->is('admin/carpeta/*') ? 'active' : ''); ?>">
                                    <i class="bi bi-folder2-open iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> Repositorio Documental </font>
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configurar_capital_humano')): ?>
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-person-plus iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Configurar C. Humano </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lista_de_perfiles_de_puesto_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.puestos.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/puestos') || request()->is('admin/puestos/*') ? 'active' : ''); ?>">
                                    <i class="bi bi-briefcase iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca">Puestos
                                    </font>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('niveles_jerarquicos_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.perfiles.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/perfiles') || request()->is('admin/perfiles/*') || request()->is('admin/perfiles/create') ? 'active' : ''); ?>">
                                    <i class="bi bi-diagram-2 iconos_menu letra_blanca"></i>

                                    <font class="letra_blanca">Niveles Jerárquicos</font>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bd_empleados_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.empleados.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/empleados') || request()->is('admin/empleados/*') || request()->is('admin/empleados/create') ? 'active' : ''); ?>">
                                    <i class="bi bi-person iconos_menu letra_blanca"></i>

                                    <font class="letra_blanca">Empleados</font>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acceder_submenu_capacitaciones')): ?>
                            <li class="c-sidebar-nav-dropdown">
                                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="bi bi-person-video3 iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca ">Capacitaciones</font>
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('capacitaciones_categorias_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(asset('admin/categoria-capacitacion')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/categoria-capacitacion') || request()->is('admin/categoria-capacitacion/*') ? 'active' : ''); ?>">
                                                <i class="ml-2 bi bi-mortarboard iconos_menu letra_blanca"
                                                    style="font-size:12pt;"></i>
                                                <font class="letra_blanca"> Crear Categorías </font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('capacitaciones_acceder')): ?>
                                        <li class="c-sidebar-nav-item">
                                            <a href="<?php echo e(asset('admin/recursos')); ?>"
                                                class="c-sidebar-nav-link <?php echo e(request()->is('admin/recursos') || request()->is('admin/recursos/*') || request()->is('admin/recursos/create') ? 'active' : ''); ?>">

                                                <i class="ml-2 bi bi-person-video3 iconos_menu letra_blanca"
                                                    style="font-size:12pt;"></i>
                                                <font class="letra_blanca"> Crear Capacitación</font>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configuracion_empleados_access')): ?>
                            
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configurar_vistas_acceder')): ?>
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-pc-display-horizontal iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Configurar Vistas </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configurar_vista_mis_datos_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.panel-inicio.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/panel-inicio') || request()->is('admin/panel-inicio/*') ? 'active' : ''); ?>">
                                    <i class="bi bi-person-badge iconos_menu letra_blanca"></i>
                                    <span class="letra_blanca"> Mis Datos </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mi_organizacion_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.panel-organizacion.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/panel-organizacion') || request()->is('admin/panel-organizacion/*') ? 'active' : ''); ?>">
                                    <i class="bi bi-building iconos_menu letra_blanca"></i>
                                    <span class="letra_blanca"> Mi Organización </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ajustes_usuario_acceder')): ?>
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle btn_bajar_scroll" href="#">
                        <i class="bi bi-gear iconos_menu letra_blanca"></i>
                        <font class="letra_blanca"> Ajustes de Usuario </font>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.roles.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : ''); ?>">
                                    <i class="bi bi-briefcase iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> <?php echo e(trans('cruds.role.title')); ?>

                                    </font>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuarios_acceder')): ?>
                            <li class="c-sidebar-nav-item">
                                <a href="<?php echo e(route('admin.users.index')); ?>"
                                    class="c-sidebar-nav-link <?php echo e(request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : ''); ?>">
                                    <i class="bi bi-person iconos_menu letra_blanca"></i>
                                    <font class="letra_blanca"> <?php echo e(trans('cruds.user.title')); ?>

                                    </font>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        
                        
                        
                        
                        
                        
                    </ul>
                </li>
            <?php endif; ?>
            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('configurar_soporte_acceder')): ?>
                <li class="c-sidebar-nav-item">
                    <a href="<?php echo e(route('admin.configurar-soporte.index')); ?>"
                        class="c-sidebar-nav-link <?php echo e(request()->is('admin/configurar-soporte') || request()->is('admin/configurar-soporte/*') ? 'active' : ''); ?>">
                        <i class="bi bi-gear iconos_menu letra_blanca"></i>
                        <font class="letra_blanca">Configurar Soporte</font>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        

        
        

        
        <?php if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') &&
            \App\Models\Team::where('owner_id', auth()->user()->id)->exists()): ?>
            <li class="c-sidebar-nav-item">
                <a class="<?php echo e(request()->is('admin/team-members') || request()->is('admin/team-members/*') ? 'active' : ''); ?> c-sidebar-nav-link"
                    href="<?php echo e(route('admin.team-members.index')); ?>">
                    <i class="iconos_menu letra_blanca fa-fw fa fa-users">
                    </i>
                    <span><?php echo e(trans('global.team-members')); ?></span>
                </a>
            </li>
        <?php endif; ?>
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('principal_soporte_acceder')): ?>
                <a href="<?php echo e(route('admin.soporte')); ?>" title="Soporte" style="margin-right:14px;"><i
                        class="bi bi-headset"></i></a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('principal_glosario_acceder')): ?>
                <a href="<?php echo e(route('admin.glosarios.render')); ?>" title="Glosario"><i class="bi bi-book"></i></a>
            <?php endif; ?>
            </li>
            
            
            



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
<?php /**PATH /var/www/html/resources/views/partials/menu.blade.php ENDPATH**/ ?>