@extends('layouts.frontend')
@section('content')
    {{-- menus horizontales --}}
    <style type="text/css">
        .caja_botones_menu {
            display: flex;
        }

        .caja_botones_menu a {
            width: 33.33%;
            text-decoration: none;
            display: inline-block;
            color: #345183;
            padding: 5px 0px;
            border-top: 1px solid #ccc !important;
            border-right: 1px solid #ccc;
            background-color: #f9f9f9;
            margin: 0;
            text-align: center;
            align-items: center;
        }

        .caja_botones_menu a:first-child {
            border-left: 1px solid #ccc;
        }

        .caja_botones_menu a:not(.caja_botones_menu a.btn_activo) {
            border-bottom: 1px solid #ccc;
        }

        .caja_botones_menu a i {
            margin-right: 7px;
            font-size: 15pt;
        }

        .caja_botones_menu a.btn_activo,
        .caja_botones_menu a.btn_activo:hover {
            background-color: #fff;
        }

        .caja_botones_menu a:hover {
            background-color: #f1f1f1;
        }

        .caja_caja_secciones {
            width: 100%;
        }

        .caja_secciones {
            width: 100%;
            display: flex;
        }

        .caja_secciones section {
            width: 0px;
            overflow: hidden;
            transition: 0.4s;
            opacity: 0;
        }

        .caja_tab_reveldada {
            width: 100% !important;
            overflow: none;
            opacity: 1 !important;
        }



        .seccion_div {
            overflow: hidden;
            width: 990px;
        }

        .caja_tab_reveldada .seccion_div {
            overflow: hidden;
            transition-delay: 0.5s;
            width: 100%;
        }

    </style>

    <style type="text/css">
        section ul {
            padding: 0;
            margin: 0;
            text-align: center;
        }

        section li {
            list-style: none;
            width: 150px;
            height: 150px;
            box-sizing: border-box;
            position: relative;
            margin: 10px;
            display: inline-block;
        }

        section li i {
            font-size: 30pt;
            margin-bottom: 10px;
            width: 100%;
        }

        section a {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eee;
            color: #345183;
            border-radius: 6px;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
            transition: 0.1s;
            padding: 7px;
        }

        section a:hover {
            text-decoration: none !important;
            color: #345183;
            border: 1px solid #345183;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.0);
            background-color: #fff;
        }

        a:hover {
            text-decoration: none !important;
        }



        @media(max-width: 648px) {
            .caja_secciones {
                min-height: 1000px;
            }
        }

        @media(max-width: 474px) {
            .caja_secciones {
                min-height: 2000px;
            }
        }

        .tabs {
            outline: none;
        }

    </style>

    <style>
        .ventana_menu {
            width: calc(100% - 40px);
            background-color: #fff;
            position: absolute;
            margin: auto;
            display: none;
            top: 130px;
            z-index: 3;
            height: calc(100% - 40px);

        }

    </style>

    {{-- {{ Breadcrumbs::render('admin.iso27001.index') }} --}}
    {{-- @dump(request()->getTargets()) --}}
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>ISO 27001</strong></h3>
        </div>
        <div class="card-body">
            <div class="caja_botones_menu">
                <a href="#" id="contexto" data-tabs="s1" class="btn_activo tabs ventana_cerrar"><i
                        class="fa-fw fas fa-archive"></i><br> Contexto </a>
                <a href="#" id="liderazgo" data-tabs="s2" class="tabs ventana_cerrar"><i class="fa-fw fas fa-gavel"></i><br>
                    Liderazgo </a>
                <a href="#" id="planificacion" data-tabs="s3" class="tabs ventana_cerrar"><i
                        class="fa-fw fas fa-tasks"></i><br> Planificación </a>
                <a href="#" id="soporte" data-tabs="s4" class="tabs ventana_cerrar"><i class="fa-fw fas fa-headset"></i><br>
                    Soporte</a>
                <a href="#" id="operacion" data-tabs="s5" class="tabs ventana_cerrar"><i
                        class="fa-fw fas fa-briefcase"></i><br> Operación </a>
                <a href="#" id="evaluacion" data-tabs="s6" class="tabs ventana_cerrar"><i
                        class="fa-fw fas fa-file-signature"></i><br> Evaluación</a>
                <a href="#" id="mejora" data-tabs="s7" class="tabs ventana_cerrar"><i class="fa-fw fas fa-infinity"></i><br>
                    Mejora</a>
                {{-- <a href="#" id="controles" data-tabs="s8" class="tabs ventana_cerrar"><i class="fas fa-tasks"></i><br>Controles </a> --}}
            </div>

            <div class="caja_caja_secciones">
                <div class="caja_secciones">

                    <section data-id="contexto" id="s1" class="caja_tab_reveldada caja">
                        <div class="mt-5">
                            {{-- @can('contexto_access') --}}
                            <ul>
                                <li><a href="{{ url('/analisis-brechas') }}">
                                        <div>
                                            <i class="fas fa-search"></i>
                                            Análisis de brechas
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('planTrabajoBase.index') }}">
                                        <div>
                                            <i class="fas fa-stream"></i>
                                            Plan de implementación
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('partes-interesadas.index') }}">
                                        <div>
                                            <i class="far fa-handshake"></i>
                                            Partes interesadas
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('matriz-requisito-legales.index') }}">
                                        <div>
                                            <i class="fas fa-balance-scale"></i>
                                            Matriz de requisitos legales
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('entendimiento-organizacions.index') }}">
                                        <div>
                                            <i class="far fa-list-alt"></i>
                                            Análisis FODA
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('alcance-sgsis.index') }}">
                                        <div>
                                            <i class="fas fa-bullseye"></i>
                                            Determinación de alcance
                                        </div>
                                    </a></li>
                                {{-- <li><a href="{{ route('reportes-contexto.index') }}">
                                                <div>
                                                    <i class="far fa-file-alt"></i>
                                                    Generar reporte
                                                </div>
                                            </a></li> --}}
                            </ul>
                            {{-- @else
                                    <div class="row" style="margin-left: -10px">
                                        <div class="mb-3 col-12">
                                            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
                                        </div>
                                        <div class="col-12">
                                            <strong style="font-size:12pt">
                                                <i class="mr-1 fas fa-info-circle"></i>
                                                No puedes acceder al módulo de Análisis de Brechas, solicita al administrador que te
                                                otorge dichos permisos
                                            </strong>
                                        </div>
                                    </div>
                                @endcan --}}
                        </div>
                    </section>


                    <section id="s2" data-id="liderazgo" class="caja">
                        <div class="mt-5">
                            {{-- @can('liderazgo_access') --}}
                            <ul>
                                <li><a href="{{ route('comiteseguridads.index') }}">
                                        <div>
                                            <i class="fas fa-shield-alt"></i>
                                            Conformación del comité de seguridad
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('minutasaltadireccions.index') }}">
                                        <div>
                                            <i class="fas fa-columns"></i>
                                            Minutas de sesiones con alta dirección
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('evidencias-sgsis.index') }}">
                                        <div>
                                            <i class="far fa-window-restore"></i>
                                            Evidencias de asignación de recursos al SGSI
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('politica-sgsis.index') }}">
                                        <div>
                                            <i class="fas fa-landmark"></i>
                                            Política SGSI
                                        </div>
                                    </a></li>
                                {{-- <li><a href="{{ route('roles-responsabilidades.index') }}">
                                                <div>
                                                    <i class="fas fa-user-tag"></i>
                                                    Roles y responsabilidades
                                                </div>
                                            </a></li> --}}
                            </ul>
                            {{-- @else
                                    <div class="mt-5 row" style="margin-left: -10px">
                                        <div class="mb-3 col-12">
                                            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
                                        </div>
                                        <div class="col-12">
                                            <strong style="font-size:12pt">
                                                <i class="mr-1 fas fa-info-circle"></i>
                                                No puedes acceder al módulo de Liderazgo, solicita al administrador que te
                                                otorge dichos permisos
                                            </strong>
                                        </div>
                                    </div>
                                @endcan --}}
                        </div>
                    </section>


                    <section id="s3" data-id="planificacion" class="caja">
                        <div class="mt-5">
                            {{-- @can('planificacion_access') --}}
                            <ul>
                                <li><a href="#" data-ventana="riesgos" data-ruta="Análisis de riesgos"
                                        class="btn_ventana_menu">
                                        <div>
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Análisis de riesgos
                                        </div>
                                    </a></li>
                                <div class="ventana_menu" id="riesgos" style="color:#345183 !important">
                                    <i class="fas fa-arrow-circle-left iconos_menu text-align:left btn_cerrar_ventana"
                                        data-ventana="riesgos"
                                        style="font-size:20pt; position: absolute; left:60px; cursor:pointer"></i>
                                    <h3 class="text-center"><strong>Análisis de riesgos</strong></h3>
                                    <ul>
                                        <li><a href="{{ route('amenazas.index') }}">
                                                <div>
                                                    <i class="fas fa-fire"></i>
                                                    Amenazas
                                                </div>
                                            </a></li>
                                        <li><a href="{{ route('vulnerabilidads.index') }}">
                                                <div>
                                                    <i class="fas fa-shield-alt"></i>
                                                    Vulnerabilidades
                                                </div>
                                            </a></li>
                                        <li><a href="{{ route('analisis-riesgos.index') }}">
                                                <div>
                                                    <i class="fas fa-table"></i>
                                                    Matriz de Riesgos
                                                </div>
                                            </a></li>
                                    </ul>
                                </div>
                                <li><a href="{{ route('declaracion-aplicabilidad.index') . '#declaracion' }}">
                                        <div>
                                            <i class="far fa-file"></i>
                                            Declaración de aplicabilidad
                                        </div>
                                    </a></li>
                                {{-- <li><a href="{{ route('riesgosoportunidades.index') }}">
                                                <div>
                                                    <i class="fas fa-asterisk"></i>
                                                    Riesgos y oportunidades
                                                </div>
                                            </a></li> --}}
                                <li><a href="{{ route('objetivosseguridads.index') }}">
                                        <div>
                                            <i class="fas fa-lock"></i>
                                            Objetivos de seguridad
                                        </div>
                                    </a></li>
                            </ul>
                            {{-- @else
                                    <div class="mt-5 row" style="margin-left: -10px">
                                        <div class="mb-3 col-12">
                                            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
                                        </div>
                                        <div class="col-12">
                                            <strong style="font-size:12pt">
                                                <i class="mr-1 fas fa-info-circle"></i>
                                                No puedes acceder al módulo de Planificación, solicita al administrador que te
                                                otorge dichos permisos
                                            </strong>
                                        </div>
                                    </div>
                                @endcan --}}
                        </div>
                    </section>


                    <section id="s4" data-id="soporte" class="caja">
                        <div class="mt-5">
                            {{-- @can('soporte_access') --}}
                            <ul>
                                <li><a href="#" data-ventana="capacitacion" data-ruta="Capacitaciones"
                                        class="btn_ventana_menu">
                                        <div>
                                            <i class="fas fa-chalkboard-teacher"></i>
                                            Capacitaciones
                                        </div>
                                    </a></li>
                                <div class="ventana_menu" id="capacitacion" style="color:#345183 !important">
                                    <i class="fas fa-arrow-circle-left iconos_menu text-align:left btn_cerrar_ventana"
                                        data-ventana="capacitacion"
                                        style="font-size:20pt; position: absolute; left:60px; cursor:pointer"></i>
                                    <h3 class="text-center"><strong>Capacitaciones</strong></h3>
                                    <ul>
                                        <li><a href="{{ asset('categoria-capacitacion') }}">
                                                <div>
                                                    <i class="fas fa-layer-group"></i>
                                                    Crear Categorias
                                                </div>
                                            </a></li>
                                        <li><a href="{{ route('recursos.index') }}">
                                                <div>
                                                    <i class="fas fa-graduation-cap"></i>
                                                    Crear Capacitación
                                                </div>
                                            </a></li>
                                    </ul>
                                </div>
                                <li><a href="{{ route('buscarCV') }}">
                                        <div>
                                            <i class="fas fa-flag-checkered"></i>
                                            Competencias
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('concientizacion-sgis.index') }}">
                                        <div>
                                            <i class="fas fa-book-reader"></i>
                                            Concientización SGI
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('material-sgsis.index') }}">
                                        <div>
                                            <i class="fas fa-cubes"></i>
                                            Material SGSI
                                        </div>
                                    </a></li>
                                {{-- <li><a href="{{ route('material-iso-veinticientes.index') }}">
                                                <div>
                                                    <i class="far fa-object-ungroup"></i>
                                                    Material ISO 27001: 2013
                                                </div>
                                            </a></li> --}}
                                <li><a href="{{ route('comunicacion-sgis.index') }}">
                                        <div>
                                            <i class="far fa-comments"></i>
                                            Comunicación SGI
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('control-accesos.index') }}">
                                        <div>
                                            <i class="fas fa-vote-yea"></i>
                                            Control de Accesos
                                        </div>
                                    </a></li>
                                <li><a href="{{ asset('documentos/publicados') }}">
                                        <div>
                                            <i class="far fa-folder-open"></i>
                                            Infomación Documentada
                                        </div>
                                    </a></li>
                            </ul>
                            {{-- @else
                            <div class="mt-5 row" style="margin-left: -10px">
                                <div class="mb-3 col-12">
                                    <img src="{{ asset('img/not_access.svg') }}" width="400px"
                                        style="margin-left: calc(50% - 200px);" />
                                </div>
                                <div class="col-12">
                                    <strong style="font-size:12pt">
                                        <i class="mr-1 fas fa-info-circle"></i>
                                        No puedes acceder al módulo de Soporte, solicita al administrador que te
                                        otorge dichos permisos
                                    </strong>
                                </div>
                            </div>
                        @endcan --}}
                        </div>
                    </section>


                    <section id="s5" data-id="operacion" class="caja">
                        <div class="mt-5">
                            {{-- - @can('operacion_access') --}}
                            <ul>
                                <li><a href="{{ route('planificacion-controls.index') }}">
                                        <div>
                                            <i class="fas fa-clipboard-list"></i>
                                            Planificación y Control
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('tratamiento-riesgos.index') }}">
                                        <div>
                                            <i class="fas fa-viruses"></i>
                                            Tratamiento de riesgos
                                        </div>
                                    </a></li>
                            </ul>
                            {{-- @else
                                <div class="mt-5 row" style="margin-left: -10px">
                                    <div class="mb-3 col-12">
                                        <img src="{{ asset('img/not_access.svg') }}" width="400px"
                                            style="margin-left: calc(50% - 200px);" />
                                    </div>
                                    <div class="col-12">
                                        <strong style="font-size:12pt">
                                            <i class="mr-1 fas fa-info-circle"></i>
                                            No puedes acceder al módulo de Soporte, solicita al administrador que te
                                            otorge dichos permisos
                                        </strong>
                                    </div>
                                </div>
                            @endcan --}}
                        </div>
                    </section>


                    <section id="s6" data-id="evaluacion" class="caja">
                        <div class="mt-5">
                            {{-- @can('evaluacion_access') --}}
                            <ul>
                                <li><a href="{{ route('indicadores-sgsis.index') }}">
                                        <div>
                                            <i class="fas fa-list-ul"></i>
                                            Indicadores SGSI
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('desk.index') }}">
                                        <div>
                                            <i class="fas fa-lock"></i>
                                            Incidentes de Seguridad
                                        </div>
                                    </a></li>
                                {{-- <li><a href="{{ route('indicadorincidentessis.index') }}">
                                                <div>
                                                    <i class="fas fa-file-contract"></i>
                                                    Indicador Incidentes
                                                </div>
                                            </a></li> --}}
                                <li><a href="{{ route('auditoria-anuals.index') }}">
                                        <div>
                                            <i class="far fa-calendar-alt"></i>
                                            Programa Anual de Auditoria
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('plan-auditoria.index') }}">
                                        <div>
                                            <i class="fas fa-clipboard-list"></i>
                                            Plan de Auditoria
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('auditoria-internas.index') }}">
                                        <div>
                                            <i class="fas fa-network-wired"></i>
                                            Auditoria Interna
                                        </div>
                                    </a></li>
                                <li><a href="{{ route('revision-direccions.index') }}">
                                        <div>
                                            <i class="fas fa-tasks"></i>
                                            Revisión por dirección
                                        </div>
                                    </a></li>
                            </ul>
                            {{-- @else
                                <div class="mt-5 row" style="margin-left: -10px">
                                    <div class="mb-3 col-12">
                                        <img src="{{ asset('img/not_access.svg') }}" width="400px"
                                            style="margin-left: calc(50% - 200px);" />
                                    </div>
                                    <div class="col-12">
                                        <strong style="font-size:12pt">
                                            <i class="mr-1 fas fa-info-circle"></i>
                                            No puedes acceder al módulo de Evaluación, solicita al administrador que te
                                            otorge dichos permisos
                                        </strong>
                                    </div>
                                </div>
                            @endcan --}}
                        </div>
                    </section>


                    <section id="s7" data-id="mejora" class="caja">
                        <div class="mt-5">
                            {{-- @can('mejora_access') --}}
                            <ul>
                                <li><a href="{{ route('accion-correctivas.index') }}">
                                        <div>
                                            <i class="far fa-thumbs-down"></i>
                                            Acción Correctiva
                                        </div>
                                    </a></li>
                                <li>
                                    {{-- <a href="{{ route('registromejoras.index') }}">
                                                <div>
                                                    <i class="far fa-thumbs-up"></i>
                                                    Registro Mejora
                                                </div>
                                            </a> --}}
                                    <a href="{{ asset('inicioUsuario/reportes/mejoras') }}" class="cards_reportes">
                                        <div>
                                            <i class="fas fa-rocket"></i> Registro Mejora
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            {{-- @else
                                <div class="mt-5 row" style="margin-left: -10px">
                                    <div class="mb-3 col-12">
                                        <img src="{{ asset('img/not_access.svg') }}" width="400px"
                                            style="margin-left: calc(50% - 200px);" />
                                    </div>
                                    <div class="col-12">
                                        <strong style="font-size:12pt">
                                            <i class="mr-1 fas fa-info-circle"></i>
                                            No puedes acceder al módulo de Mejoras, solicita al administrador que te
                                            otorge dichos permisos
                                        </strong>
                                    </div>
                                </div>
                            @endcan --}}
                        </div>
                    </section>

                    {{-- <section id="s8" data-id="controles" class="caja">
                        <div class="mt-5">
                            <ul>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-balance-scale"></i>
                                            A5 Política de SI
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-mobile-alt"></i>
                                            A6 Organización de la SI
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-user"></i>
                                            A7 Seguridad de los Recursos
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-laptop"></i>
                                            A8 Gestion de Activos
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-door-open"></i>
                                            A9 Control de Acceso
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-key"></i>
                                            A10 Criptografia
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-hard-hat"></i>
                                            A11 Seguridad Fisica y del Entorno
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-file-signature"></i></i>
                                            A12 Seguridad de las Operaciones
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-wifi"></i>
                                            A13 Seguridad en las Comunicaciones
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-file-code"></i>
                                            A14 Sistemas de Información
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-handshake"></i>
                                            A15 Relacion con Proveedores
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-exclamation-triangle"></i>
                                            A16 Gestion de Incidentes de SI
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-life-ring"></i>
                                            A17 Continuidad del Negocio
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-check-square"></i>
                                            A18 Cumplimiento
                                        </div>
                                    </a></li>
                            </ul>
                        </div>
                    </section> --}}
                </div>
            </div>
        </div>

    </div>


@endsection


@section('scripts')
    {{-- menus --}}
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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tabs = document.querySelectorAll('.tabs');
            tabs.forEach(tab => {
                if (tab.classList.contains('btn_activo')) {
                    tab.classList.remove('btn_activo')
                }
            });
            let cajas = document.querySelectorAll('.caja');
            cajas.forEach(caja => {
                if (caja.classList.contains('caja_tab_reveldada')) {
                    caja.classList.remove('caja_tab_reveldada')
                }
            });

            let idActual = window.location.hash.replace('#', '');
            document.getElementById(idActual).classList.add('btn_activo');
            document.querySelector(`[data-id="${idActual}"]`).classList.add('caja_tab_reveldada');
            setTimeout(() => {
                window.scrollTo(0, 0);
                console.log('scroll')
            }, 1);
        })
    </script>
    <script>
        $(".btn_ventana_menu").click(function() {
            $(".ventana_menu").fadeOut(100);
            var id_ventana = $(".btn_ventana_menu:hover").attr("data-ventana");
            $(document.getElementById(id_ventana)).fadeIn(100);
            $(".ventana_menu").css("left", "0");
            $(".ventana_menu").css("transition", "0s");
            var text_ruta = "ISO 27001 / " + $(".btn_ventana_menu:hover").attr("data-ruta");
            $(".breadcrumb-item.active").html(text_ruta);
        });
        $(".btn_cerrar_ventana").click(function() {
            $(".ventana_menu").fadeOut(100);
            $(".ventana_menu").css("left", "-50%");
            $(".ventana_menu").css("transition", "1s");
            $(".breadcrumb-item.active").html("ISO 27001");

        });

        $(".ventana_cerrar").click(function() {
            $(".ventana_menu").fadeOut(100);
            $(".ventana_menu").css("left", "-50%");
            $(".ventana_menu").css("transition", "1s");
            $(".breadcrumb-item.active").html("ISO 27001");
        });
    </script>


@endsection
