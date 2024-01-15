@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/guia_iso.css') }}">
@endsection
@section('content')
    <style>
        .c-main {
            margin-top: 0px !important;
            padding-top: 0px !important;
        }

        .container-fluid {
            padding: 0 !important;
        }

        .card-iso-guia a.btn-entrar[href="#"] {
            opacity: 1;
            background-color: red;
            color: #fff;
        }
    </style>
    <style>
        .toggle,
        .toggle:before,
        .slot__label {
            transition-property: background-color, transform, visibility;
            transition-duration: 0.25s;
            transition-timing-function: ease-in, cubic-bezier(0.6, 0.2, 0.4, 1.5), linear;
        }

        .toggle:before,
        .slot,
        .slot__label {
            display: block;
        }

        .toggle:focus {
            outline: transparent;
        }

        .toggle {
            border-radius: 0.75em;
            box-shadow: 0 0 0 0.1em inset;
            cursor: pointer;
            position: relative;
            margin-right: 0.25em;
            width: 1.5em;
            height: 1em;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-tap-highlight-color: transparent;
        }

        .toggle:before {
            background: currentColor;
            border-radius: 50%;
            content: "";
            top: 0.2em;
            left: 0.2em;
            width: .75em;
            height: 1em;
        }

        .toggle:checked:before {
            transform: translateX(.75em);
        }

        .toggle:checked~.slot .slot__label,
        .slot__label:nth-child(2) {
            transform: translateY(-50%) scaleY(0);
        }

        .toggle:checked~.slot .slot__label:nth-child(2) {
            transform: translateY(-100%) scaleY(1);
        }

        .slot {
            color: transparent;
            font-size: 1em;
            font-weight: bold;
            letter-spacing: 0.1em;
            line-height: 1;
            overflow: hidden;
            height: 1em;
            text-indent: -0.9em;
        }

        .slot__label {
            transform-origin: 50% 0;
            color: #788BAC;
            font-family: "Roboto", sans-serif;
        }

        .slot__label:nth-child(2) {
            transform-origin: 50% 100%;
        }
    </style>
    <div class="menu-pasos-guia scroll_estilo">
        <ul>
            <a href="{{ route('admin.dashboard_auditorias') }}">
                <li data-id="content-guia-iso-1"
                    style="position: relative; top: -4.4rem; border: 1px solid #EFF1F5; height: 4.2rem;";>
                    <i class="material-icons-outlined">dashboard</i>
                    Dashboard
                </li>
            </a>
            @can('sistema_de_gestion_contexto_acceder')
                <li data-id="content-guia-iso-1" class="paso-menu" style="position: relative; top: -3rem;">
                    <i class="material-symbols-outlined">article</i>
                    Contexto
                </li>
            @endcan
            @can('sistema_de_gestion_liderazgo_acceder')
                <li data-id="content-guia-iso-2" class="paso-menu-2" style="position: relative; top: -3rem;">
                    <i class="material-symbols-outlined">military_tech</i>
                    Liderazgo
                </li>
            @endcan
            @can('sistema_de_gestion_planificacion_acceder')
                <li data-id="content-guia-iso-3" class="paso-menu-3" style="position: relative; top: -3rem;">
                    <i class="material-symbols-outlined">newsmode</i>
                    Planificación
                </li>
            @endcan
            @can('sistema_de_gestion_soporte_acceder')
                <li data-id="content-guia-iso-4" class="paso-menu-4" style="position: relative; top: -3rem;">
                    <i class="material-symbols-outlined">shield_question</i>
                    Soporte
                </li>
            @endcan
            @can('sistema_de_gestion_operacion_acceder')
                <li data-id="content-guia-iso-5" class="paso-menu-5" style="position: relative; top: -3rem;">
                    <i class="material-symbols-outlined">business_center</i>
                    Operación
                </li>
            @endcan
            @can('sistema_de_gestion_evaluacion_acceder')
                <li data-id="content-guia-iso-6" class="paso-menu-6" style="position: relative; top: -3rem;">
                    <i class="material-symbols-outlined">editor_choice</i>
                    Evaluación
                </li>
            @endcan
            @can('sistema_de_gestion_mejora_acceder')
                <li data-id="content-guia-iso-7" class="paso-menu-7" style="position: relative; top: -3rem;">
                    <i class="material-symbols-outlined">star</i>
                    Mejora
                </li>
            @endcan
        </ul>
    </div>
    <div class="content-guia-iso">
        <div class="pl-3 py-2 row" style="background-color: #EFF1F5;">
            <div class="col-6">
                <h3 class="title-guia-iso">GESTIÓN NORMATIVA</h3>
                @can('control_versiones_iso')
                    <div class="d-flex">
                        <input id="toggle" class="toggle" type="checkbox" role="switch" name="toggle" value="true"
                            @if ($version_iso === true) checked @endif style="align-content: center">
                        <label for="toggle" class="slot">
                            <span class="slot__label">&nbsp;&nbsp;&nbsp;&nbsp;Norma ISO 27001:2022</span>
                            <span class="slot__label">&nbsp;&nbsp;&nbsp;&nbsp;Norma ISO 27001:2013</span>
                        </label>
                    </div>
                @endcan
            </div>
            {{-- <div class="col-6" style="text-align: right;">
                <a href="{{ route('admin.dashboard_auditorias') }}" class="btn btn-success">
                    <i class="fas fa-chart-pie mr-2"></i>
                    DASHBOARD
                </a>
            </div> --}}
        </div>

        <div class="card card-body card-main-iso" style="border-radius: 0px !important;">
            @can('sistema_de_gestion_contexto_acceder')
                <div id="content-guia-iso-1" class="paso-iso-guia active-iso-paso">
                    <h4 class="title-info-iso">Contexto</h4>

                    <ul class="list-info-iso">
                        <li>Entender la organización y su contexto</li>
                        <li>Comprender las necesidades y expectativas de las partes interesadas</li>
                        <li>Determinación de alcance del sistema de gestión de la seguridad de la información</li>
                        <li>Sistema de gestión de seguridad de la información</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        @can('analisis_de_brechas_acceder')
                            @if ($version_iso === true)
                                <div class="card-iso-guia">
                                    <div class="img-card-iso">
                                        <img src="{{ asset('img/iso/iso1.png') }}" alt="">
                                    </div>
                                    <div class="info-iso">
                                        <h4 class="title-card-img-iso">Análisis de brechas</h4>
                                        {{-- <span>Completado</span> --}}
                                    </div>
                                    <a href="{{ route('admin.analisisdebrechas.index') }}" class="btn-entrar">
                                        Entrar
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                    </a>
                                </div>
                            @else
                                <div class="card-iso-guia">
                                    <div class="img-card-iso">
                                        <img src="{{ asset('img/iso/iso1.png') }}" alt="">
                                    </div>
                                    <div class="info-iso">
                                        <h4 class="title-card-img-iso">Análisis de brechas</h4>
                                        {{-- <span>Completado</span> --}}
                                    </div>
                                    <a href="{{ route('admin.analisisdebrechas-2022.create') }}" class="btn-entrar">
                                        Entrar
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                    </a>
                                </div>
                            @endif
                        @endcan
                        <!--<div class="card-iso-guia">
                                                                                                                                                                                                                                                                                                                                                                <div class="img-card-iso">
                                                                                                                                                                                                                                                                                                                                                                    <img src="{{ asset('img/iso/iso2.png') }}" alt="">
                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                <div class="info-iso">
                                                                                                                                                                                                                                                                                                                                                                        <h4 class="title-card-img-iso">Plan de implementación</h4>
                                                                                                                                                                                                                                                                                                                                                                        {{-- <span>Completado</span> --}}
                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                    <a href="{{ route('admin.planTrabajoBase.index') }}" class="btn-entrar">
                                                                                                                                                                                                                                                                                                                                                                        Entrar
                                                                                                                                                                                                                                                                                                                                                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                                                                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                                                                            </div>-->
                        @can('partes_interesadas_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso3.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Partes interesadas</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.partes-interesadas.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('analisis_foda_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso23.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Análisis FODA</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.entendimiento-organizacions.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('determinacion_alcance_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso4.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Determinación de alcance</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.alcance-sgsis.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="text-right mt-4">
                        <button class="btn btn-netx">Siguiente paso</button>
                    </div>

                    <div class="nota-paso-iso">
                        <h5>
                            Como empezar
                        </h5>
                        <p>
                            Para poder implementar la norma se recomienda como primer paso llenar
                        </p>
                        <ul>
                            <li>1.-FODA</li>
                            <li>2.-Análisis de Brechas</li>
                            <li>3.-Plan de implementación</li>
                        </ul>
                    </div>
                </div>
            @endcan
            @can('sistema_de_gestion_liderazgo_acceder')
                <div id="content-guia-iso-2" class="paso-iso-guia">
                    <h4 class="title-info-iso">Liderazgo</h4>

                    <ul class="list-info-iso">
                        <li>Liderazgo y compromiso</li>
                        <li> Política</li>
                        <li> Funciones, responsabilidades y autoridades de la organización</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        @can('politica_sistema_gestion_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso7.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Política del sistema de gestión</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.politica-sgsis.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('comformacion_comite_seguridad_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso5.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Conformación del comité</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.comiteseguridads.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        <!--                    <div class="card-iso-guia">
                                                                                                                                                                                                                                                                                                                                                            <div class="img-card-iso">
                                                                                                                                                                                                                                                                                                                                                                <img src="{{ asset('img/iso/iso1.png') }}" alt="">
                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                            <div class="info-iso">
                                                                                                                                                                                                                                                                                                                                                                <h4 class="title-card-img-iso">Revisión por dirección</h4>
                                                                                                                                                                                                                                                                                                                                                                {{-- <span>Completado</span> --}}
                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                            <a href="{{ route('admin.minutasaltadireccions.index') }}" class="btn-entrar">
                                                                                                                                                                                                                                                                                                                                                                Entrar
                                                                                                                                                                                                                                                                                                                                                                <i class="material-symbols-outlined"> arrow_right_alt</i>
                                                                                                                                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                                                                                                                                        </div>-->
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-previous">Atrás</button>
                        <button class="btn btn-netx">Siguiente paso</button>
                    </div>
                </div>
            @endcan
            @can('sistema_de_gestion_planificacion_acceder')
                <div id="content-guia-iso-3" class="paso-iso-guia">
                    <h4 class="title-info-iso">Planificación</h4>

                    <ul class="list-info-iso">
                        <li> Acciones para abordar riesgos y oportunidades</li>
                        <li> Objetivos de seguridad de la información y planificación para alcanzarlos</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        @can('menu_analisis_riesgo_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso8.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Análisis de riesgos</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.analisis-riesgos.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @if ($version_iso === true)
                            @can('asignacion_de_controles_acceder')
                                <div class="card-iso-guia">
                                    <div class="img-card-iso">
                                        <img src="{{ asset('img/iso/iso9.png') }}" alt="">
                                    </div>
                                    <div class="info-iso">
                                        <h4 class="title-card-img-iso">Asignación de controles</h4>
                                        {{-- <span>Completado</span> --}}
                                    </div>
                                    <a href="{{ route('admin.paneldeclaracion.index') }}" class="btn-entrar">
                                        Entrar
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                    </a>
                                </div>
                            @endcan
                            @can('declaracion_de_aplicabilidad_acceder')
                                <div class="card-iso-guia">
                                    <div class="img-card-iso">
                                        <img src="{{ asset('img/iso/iso10.png') }}" alt="">
                                    </div>
                                    <div class="info-iso">
                                        <h4 class="title-card-img-iso">Declaración de aplicabilidad</h4>
                                        {{-- <span>Completado</span> --}}
                                    </div>
                                    <a href="{{ route('admin.declaracion-aplicabilidad.index') }}" class="btn-entrar">
                                        Entrar
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                    </a>
                                </div>
                            @endcan
                            @can('declaracion_de_aplicabilidad_acceder')
                                <div class="card-iso-guia">
                                    <div class="img-card-iso">
                                        <img src="{{ asset('img/iso/iso11.png') }}" alt="">
                                    </div>
                                    <div class="info-iso">
                                        <h4 class="title-card-img-iso">Declaración de aplicabilidad tabla</h4>
                                        {{-- <span>Completado</span> --}}
                                    </div>
                                    <a href="{{ route('admin.declaracion-aplicabilidad.tabla') }}" class="btn-entrar">
                                        Entrar
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                    </a>
                                </div>
                            @endcan
                        @else
                            @can('asignacion_de_controles_acceder')
                                <div class="card-iso-guia">
                                    <div class="img-card-iso">
                                        <img src="{{ asset('img/iso/iso9.png') }}" alt="">
                                    </div>
                                    <div class="info-iso">
                                        <h4 class="title-card-img-iso">Asignación de controles</h4>
                                        {{-- <span>Completado</span> --}}
                                    </div>
                                    <a href="{{ route('admin.paneldeclaracion-2022.index') }}" class="btn-entrar">
                                        Entrar
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                    </a>
                                </div>
                            @endcan
                            @can('declaracion_de_aplicabilidad_acceder')
                                <div class="card-iso-guia">
                                    <div class="img-card-iso">
                                        <img src="{{ asset('img/iso/iso10.png') }}" alt="">
                                    </div>
                                    <div class="info-iso">
                                        <h4 class="title-card-img-iso">Declaración de aplicabilidad</h4>
                                        {{-- <span>Completado</span> --}}
                                    </div>
                                    <a href="{{ route('admin.declaracion-aplicabilidad-2022.index') }}" class="btn-entrar">
                                        Entrar
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                    </a>
                                </div>
                            @endcan
                            @can('declaracion_de_aplicabilidad_acceder')
                                <div class="card-iso-guia">
                                    <div class="img-card-iso">
                                        <img src="{{ asset('img/iso/iso11.png') }}" alt="">
                                    </div>
                                    <div class="info-iso">
                                        <h4 class="title-card-img-iso">Declaración de aplicabilidad tabla</h4>
                                        {{-- <span>Completado</span> --}}
                                    </div>
                                    <a href="{{ route('admin.declaracion-aplicabilidad-2022.tabla') }}" class="btn-entrar">
                                        Entrar
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                    </a>
                                </div>
                            @endcan
                        @endif
                        @can('objetivos_del_sistema_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso12.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Tipos de objetivos</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.tipos-objetivos.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso13.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Objetivos</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.objetivosseguridads.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-previous">Atrás</button>
                        <button class="btn btn-netx">Siguiente paso</button>
                    </div>
                </div>
            @endcan
            @can('sistema_de_gestion_soporte_acceder')
                <div id="content-guia-iso-4" class="paso-iso-guia">
                    <h4 class="title-info-iso">Soporte</h4>

                    <ul class="list-info-iso">
                        <li>Recursos</li>
                        <li>Competencia</li>
                        <li>Conciencia</li>
                        <li>Comunicación</li>
                        <li>Información documentada</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        <div class="card-iso-guia">
                            <div class="img-card-iso">
                                <img src="{{ asset('img/iso/iso14.png') }}" alt="">
                            </div>
                            <div class="info-iso">
                                <h4 class="title-card-img-iso">Transferencia de conocimiento</h4>
                                {{-- <span>Completado</span> --}}
                            </div>
                            <a href="{{ route('admin.recursos.index') }}" class="btn-entrar">
                                Entrar
                                <i class="material-symbols-outlined"> arrow_right_alt</i>
                            </a>
                        </div>
                        <div class="card-iso-guia">
                            <div class="img-card-iso">
                                <img src="{{ asset('img/iso/iso15.png') }}" alt="">
                            </div>
                            <div class="info-iso">
                                <h4 class="title-card-img-iso">Competencias</h4>
                                {{-- <span>Completado</span> --}}
                            </div>
                            <a href="{{ route('admin.buscarCV') }}" class="btn-entrar">
                                Entrar
                                <i class="material-symbols-outlined"> arrow_right_alt</i>
                            </a>
                        </div>
                        @can('concientizacion_sgsi_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso16.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Concientización SGI</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.concientizacion-sgis.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('material_sgsi_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso17.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Material SGSI</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.material-sgsis.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('comunicados_generales_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso18.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Comunicados generales</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.comunicacion-sgis.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('informacion_documentada_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso19.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Información documentada</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.documentos.publicados') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('evidencia_asignacion_recursos_sgsi_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso6.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Evidencias de asignación de recursos al SGSI</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.evidencias-sgsis.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-previous">Atrás</button>
                        <button class="btn btn-netx">Siguiente paso</button>
                    </div>
                </div>
            @endcan
            @can('sistema_de_gestion_operacion_acceder')
                <div id="content-guia-iso-5" class="paso-iso-guia">
                    <h4 class="title-info-iso">Operación</h4>

                    <ul class="list-info-iso">
                        <li>Planificación y control operativo</li>
                        <li>Evaluación de riesgos de seguridad de la información</li>
                        <li>tratamiento de riesgos de seguridad de la información</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        @can('planificacion_y_control_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso20.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Planificación y control</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.planificacion-controls.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('tratamiento_de_los_riesgos_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso21.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Tratamiento de riesgos</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.tratamiento-riesgos.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('centro_atencion_incidentes_de_seguridad_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso24.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Incidentes de seguridad</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.desk.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('matriz_requisitos_legales_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso22.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Matriz de requisitos legales y regulatorios</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('control_de_accesos_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso23.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Control de accesos</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.control-accesos.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-previous">Atrás</button>
                        <button class="btn btn-netx">Siguiente paso</button>
                    </div>
                </div>
            @endcan
            @can('sistema_de_gestion_evaluacion_acceder')
                <div id="content-guia-iso-6" class="paso-iso-guia">
                    <h4 class="title-info-iso">Evaluación</h4>

                    <ul class="list-info-iso">
                        <li>Seguimiento, medición, análisis y evaluación</li>
                        <li>Auditoría interna</li>
                        <li>Revisión por dirección</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        @can('indicadores_sgsi_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso25.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Indicadores del sistema de gestión</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.indicadores-sgsis.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('programa_anual_auditoria_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso26.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Programa anual de auditoría</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.auditoria-anuals.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('plan_de_auditoria_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso27.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Plan de auditoría</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.plan-auditoria.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('auditoria_interna_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso23.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Informe de auditoría</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.auditoria-internas.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('revision_por_direccion_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso28.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Revisión por dirección</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.minutasaltadireccions.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-previous">Atrás</button>
                        <button class="btn btn-netx">Siguiente paso</button>
                    </div>
                </div>
            @endcan
            @can('sistema_de_gestion_mejora_acceder')
                <div id="content-guia-iso-7" class="paso-iso-guia">
                    <h4 class="title-info-iso"> Mejora</h4>

                    <ul class="list-info-iso">
                        <li>Mejora continua</li>
                        <li>No conformidad y acción correctiva</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        @can('accion_correctiva_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso29.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Acción correctiva</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.accion-correctivas.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                        @can('centro_atencion_mejoras_acceder')
                            <div class="card-iso-guia">
                                <div class="img-card-iso">
                                    <img src="{{ asset('img/iso/iso30.png') }}" alt="">
                                </div>
                                <div class="info-iso">
                                    <h4 class="title-card-img-iso">Registro mejora</h4>
                                    {{-- <span>Completado</span> --}}
                                </div>
                                <a href="{{ route('admin.desk.index') }}" class="btn-entrar">
                                    Entrar
                                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-previous">Atrás</button>
                    </div>
                </div>
            @endcan

        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $('.menu-pasos-guia li').click(function() {
            $('.paso-iso-guia').removeClass('active-iso-paso');
            let num_paso = $('.menu-pasos-guia li:hover').attr('data-id');
            $('#' + num_paso).addClass('active-iso-paso');
            activeMenuPaso(num_paso.substr(-1));
        });

        $('.btn-netx').click(function() {
            let id = $('.paso-iso-guia:hover').attr('id');
            let num_paso = id.substr(-1);
            num_paso = Number(num_paso) + 1;
            $('.paso-iso-guia').removeClass('active-iso-paso');
            $('#content-guia-iso-' + num_paso).addClass('active-iso-paso');
            activeMenuPaso(num_paso);
        });

        $('.btn-previous').click(function() {
            let id = $('.paso-iso-guia:hover').attr('id');
            let num_paso = id.substr(-1);
            num_paso = Number(num_paso) - 1;
            $('.paso-iso-guia').removeClass('active-iso-paso');
            $('#content-guia-iso-' + num_paso).addClass('active-iso-paso');
            activeMenuPaso(num_paso);
        });

        //request
        function activeMenuPaso(num_paso) {
            $('.menu-pasos-guia ul li').removeClass('active-paso');
            $('.menu-pasos-guia ul li.paso-menu-' + num_paso).addClass('active-paso');
        }
    </script>

    <script>
        document.addEventListener('change', function() {
            const version = document.getElementById('toggle');
            version.value = version.checked ? 'true' : 'false';
            // console.log(version.value);
            const valor = version.value;
            // console.log(valor);
            $.ajax({
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                url: "{{ route('admin.inicio-Usuario.updateVersionIso') }}",
                data: valor,
                processData: false,
                contentType: "application/json; charset=utf-8",
                dataType: "JSON",
            });

            async function reloadPage() {
                try {
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    location.reload();
                } catch (error) {
                    console.error('Error al recargar la página:', error);
                }
            }
            reloadPage();
        });
    </script>
@endsection
