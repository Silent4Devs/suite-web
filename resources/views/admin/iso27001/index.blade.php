@extends('layouts.admin')
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
            color: #008186;
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
            color: #008186;
            border-radius: 6px;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
            transition: 0.1s;
            padding: 7px;
        }

        section a:hover {
            text-decoration: none !important;
            color: #008186;
            border: 1px solid #00abb2;
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

    </style>

    {{ Breadcrumbs::render('admin.iso27001.index') }}

    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>ISO 27001</strong></h3>
        </div>
        <div class="card-body">
            <div class="caja_botones_menu">
                <a href="#" data-tabs="s1" class="btn_activo"><i class="fa-fw fas fa-archive"></i> Contexto </a>
                <a href="#" data-tabs="s2"><i class="fa-fw fas fa-gavel"></i> Liderazgo </a>
                <a href="#" data-tabs="s3"><i class="fa-fw fas fa-tasks"></i> Planificación </a>
                <a href="#" data-tabs="s4"><i class="fa-fw fas fa-headset"></i> Soporte</a>
                <a href="#" data-tabs="s5"><i class="fa-fw fas fa-briefcase"></i> Operación </a>
                <a href="#" data-tabs="s6"><i class="fa-fw fas fa-file-signature"></i> Evaluación</a>
                <a href="#" data-tabs="s7"><i class="fa-fw fas fa-infinity"></i> Mejora</a>
                <a href="#" data-tabs="s8"><i class="fas fa-tasks"></i>Controles </a>
            </div>

            <div class="caja_caja_secciones">
                <div class="caja_secciones">
                    @can('contexto_access')
                        <section id="s1" class="caja_tab_reveldada">
                            <div class="mt-5">
                                <ul>
                                    <li><a href="{{ url('/admin/analisis-brechas') }}">
                                            <div>
                                                <i class="fas fa-search"></i>
                                                Análisis de brechas
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.planTrabajoBase.index') }}">
                                            <div>
                                                <i class="fas fa-stream"></i>
                                                Plan de implementación
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.declaracion-aplicabilidad.index') . '#declaracion' }}">
                                            <div>
                                                <i class="far fa-file"></i>
                                                Declaracion de aplicabilidad
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.partes-interesadas.index') }}">
                                            <div>
                                                <i class="far fa-handshake"></i>
                                                Partes interesadas
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.matriz-requisito-legales.index') }}">
                                            <div>
                                                <i class="fas fa-balance-scale"></i>
                                                Matriz de requisitos legales
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.entendimiento-organizacions.index') }}">
                                            <div>
                                                <i class="far fa-list-alt"></i>
                                                FODA
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.alcance-sgsis.index') }}">
                                            <div>
                                                <i class="fas fa-bullseye"></i>
                                                Determinación de alcance
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.reportes-contexto.index') }}">
                                            <div>
                                                <i class="far fa-file-alt"></i>
                                                Generar Reporte
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </section>
                    @else
                        <div class="mt-5 row" style="margin-left: -10px">
                            <div class="mb-3 col-12">
                                <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                            </div>
                            <div class="col-12">
                                <strong style="font-size:12pt">
                                    <i class="mr-1 fas fa-info-circle"></i>
                                    No puedes acceder al módulo de Análisis de Brechas, solicita al administrador que te
                                    otorge dichos permisos
                                </strong>
                            </div>
                        </div>
                    @endcan
                    @can('liderazgo_access')
                        <section id="s2">
                            <div class="mt-5">
                                <ul>
                                    <li><a href="{{ route('admin.comiteseguridads.index') }}">
                                            <div>
                                                <i class="fas fa-shield-alt"></i>
                                                Conformación del comité de seguridad
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.minutasaltadireccions.index') }}">
                                            <div>
                                                <i class="fas fa-columns"></i>
                                                Minutas de sesiones con Ata dirección
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.evidencias-sgsis.index') }}">
                                            <div>
                                                <i class="far fa-window-restore"></i>
                                                Evidencias de asignación de recursos al SGSI
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.politica-sgsis.index') }}">
                                            <div>
                                                <i class="fas fa-landmark"></i>
                                                Política SGSI
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.roles-responsabilidades.index') }}">
                                            <div>
                                                <i class="fas fa-user-tag"></i>
                                                Roles y responsabilidades
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </section>
                    @else
                        <div class="mt-5 row" style="margin-left: -10px">
                            <div class="mb-3 col-12">
                                <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                            </div>
                            <div class="col-12">
                                <strong style="font-size:12pt">
                                    <i class="mr-1 fas fa-info-circle"></i>
                                    No puedes acceder al módulo de Liderazgo, solicita al administrador que te
                                    otorge dichos permisos
                                </strong>
                            </div>
                        </div>
                    @endcan
                    @can('planificacion_access')
                        <section id="s3">
                            <div class="mt-5">
                                <ul>
                                    <li><a href="{{ route('admin.matriz-riesgos.index') }}">
                                            <div>
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Análisis de riesgos
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.riesgosoportunidades.index') }}">
                                            <div>
                                                <i class="fas fa-asterisk"></i>
                                                Riesgos y oportunidades
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.objetivosseguridads.index') }}">
                                            <div>
                                                <i class="fas fa-lock"></i>
                                                Objetivos de seguridad
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </section>
                    @else
                        <div class="mt-5 row" style="margin-left: -10px">
                            <div class="mb-3 col-12">
                                <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                            </div>
                            <div class="col-12">
                                <strong style="font-size:12pt">
                                    <i class="mr-1 fas fa-info-circle"></i>
                                    No puedes acceder al módulo de Planificación, solicita al administrador que te
                                    otorge dichos permisos
                                </strong>
                            </div>
                        </div>
                    @endcan
                    @can('soporte_access')
                        <section id="s4">
                            <div class="mt-5">
                                <ul>
                                    <li><a href="{{ route('admin.recursos.index') }}">
                                            <div>
                                                <i class="fas fa-chalkboard-teacher"></i>
                                                Capacitaciones
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.competencia.index') }}">
                                            <div>
                                                <i class="fas fa-flag-checkered"></i>
                                                Competencias
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.concientizacion-sgis.index') }}">
                                            <div>
                                                <i class="fas fa-book-reader"></i>
                                                Concientización SGI
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.material-sgsis.index') }}">
                                            <div>
                                                <i class="fas fa-cubes"></i>
                                                Material SGI
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.material-iso-veinticientes.index') }}">
                                            <div>
                                                <i class="far fa-object-ungroup"></i>
                                                Material ISO 27001: 2013
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.comunicacion-sgis.index') }}">
                                            <div>
                                                <i class="far fa-comments"></i>
                                                Comunicación SGI
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.politica-del-sgsi-soportes.index') }}">
                                            <div>
                                                <i class="fas fa-landmark"></i>
                                                Política SGI
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.control-accesos.index') }}">
                                            <div>
                                                <i class="fas fa-vote-yea"></i>
                                                Control de Accesos
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.informacion-documetadas.index') }}">
                                            <div>
                                                <i class="far fa-folder-open"></i>
                                                Infomación Documentada
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </section>
                    @else
                        <div class="mt-5 row" style="margin-left: -10px">
                            <div class="mb-3 col-12">
                                <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                            </div>
                            <div class="col-12">
                                <strong style="font-size:12pt">
                                    <i class="mr-1 fas fa-info-circle"></i>
                                    No puedes acceder al módulo de Soporte, solicita al administrador que te
                                    otorge dichos permisos
                                </strong>
                            </div>
                        </div>
                    @endcan
                    @can('operacion_access')
                        <section id="s5">
                            <div class="mt-5">
                                <ul>
                                    <li><a href="{{ route('admin.planificacion-controls.index') }}">
                                            <div>
                                                <i class="fas fa-clipboard-list"></i>
                                                Planificaión y Control
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.tratamiento-riesgos.index') }}">
                                            <div>
                                                <i class="fas fa-viruses"></i>
                                                Tratamiento de riesgos
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </section>
                    @else
                        <div class="mt-5 row" style="margin-left: -10px">
                            <div class="mb-3 col-12">
                                <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                            </div>
                            <div class="col-12">
                                <strong style="font-size:12pt">
                                    <i class="mr-1 fas fa-info-circle"></i>
                                    No puedes acceder al módulo de Operación, solicita al administrador que te
                                    otorge dichos permisos
                                </strong>
                            </div>
                        </div>
                    @endcan
                    @can('evaluacion_access')
                        <section id="s6">
                            <div class="mt-5">
                                <ul>
                                    <li><a href="{{ route('admin.indicadores-sgsis.index') }}">
                                            <div>
                                                <i class="fas fa-list-ul"></i>
                                                Indicadores SGSI
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.incidentes-de-seguridads.index') }}">
                                            <div>
                                                <i class="fas fa-lock"></i>
                                                Incidentes de Seguridad
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.indicadorincidentessis.index') }}">
                                            <div>
                                                <i class="fas fa-file-contract"></i>
                                                Indicador Incidentes
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.auditoria-anuals.index') }}">
                                            <div>
                                                <i class="far fa-calendar-alt"></i>
                                                Programa Anual de Auditoria
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.plan-auditoria.index') }}">
                                            <div>
                                                <i class="fas fa-clipboard-list"></i>
                                                Plan de Auditoria
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.auditoria-internas.index') }}">
                                            <div>
                                                <i class="fas fa-network-wired"></i>
                                                Auditoria Interna
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.revision-direccions.index') }}">
                                            <div>
                                                <i class="fas fa-tasks"></i>
                                                Revisión por dirección
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </section>
                    @else
                        <div class="mt-5 row" style="margin-left: -10px">
                            <div class="mb-3 col-12">
                                <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                            </div>
                            <div class="col-12">
                                <strong style="font-size:12pt">
                                    <i class="mr-1 fas fa-info-circle"></i>
                                    No puedes acceder al módulo de Evaluación, solicita al administrador que te
                                    otorge dichos permisos
                                </strong>
                            </div>
                        </div>
                    @endcan
                    @can('mejoras_access')
                        <section id="s7">
                            <div class="mt-5">
                                <ul>
                                    <li><a href="{{ route('admin.accion-correctivas.index') }}">
                                            <div>
                                                <i class="far fa-thumbs-down"></i>
                                                Acción Correctiva
                                            </div>
                                        </a></li>
                                    <li><a href="{{ route('admin.registromejoras.index') }}">
                                            <div>
                                                <i class="far fa-thumbs-up"></i>
                                                Registro Mejora
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </section>
                    @else
                        <div class="mt-5 row" style="margin-left: -10px">
                            <div class="mb-3 col-12">
                                <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                            </div>
                            <div class="col-12">
                                <strong style="font-size:12pt">
                                    <i class="mr-1 fas fa-info-circle"></i>
                                    No puedes acceder al módulo de Mejoras, solicita al administrador que te
                                    otorge dichos permisos
                                </strong>
                            </div>
                        </div>
                    @endcan
                    <section id="s8">
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
                    </section>
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
@endsection
