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
    </style>
    <div class="menu-pasos-guia scroll_estilo">
        <ul>
            <li data-id="content-guia-iso-1" class="paso-menu-1 active-paso">
                <i class="material-symbols-outlined">article</i>
                Contexto
            </li>
            <li data-id="content-guia-iso-2" class="paso-menu-2">
                <i class="material-symbols-outlined">military_tech</i>
                Liderazgo
            </li>
            <li data-id="content-guia-iso-3" class="paso-menu-3">
                <i class="material-symbols-outlined">newsmode</i>
                Planificación
            </li>
            <li data-id="content-guia-iso-4" class="paso-menu-4">
                <i class="material-symbols-outlined">shield_question</i>
                Soporte
            </li>
            <li data-id="content-guia-iso-5" class="paso-menu-5">
                <i class="material-symbols-outlined">business_center</i>
                Operación
            </li>
            <li data-id="content-guia-iso-6" class="paso-menu-6">
                <i class="material-symbols-outlined">editor_choice</i>
                Evaluación
            </li>
            <li data-id="content-guia-iso-7" class="paso-menu-7">
                <i class="material-symbols-outlined">star</i>
                Mejora
            </li>
        </ul>
    </div>
    <div class="content-guia-iso">
        <div class="pl-3 py-2" style="background-color: #EFF1F5;">
            <h3 class="title-guia-iso">GESTIÓN NORMATIVA</h3>
        </div>

        <div class="card card-body card-main-iso" style="border-radius: 0px !important;">

            <div id="content-guia-iso-1" class="paso-iso-guia active-iso-paso">
                <h4 class="title-info-iso">Contexto</h4>

                <ul class="list-info-iso">
                    <li>Entender la organización y su contexto</li>
                    <li>Comprender las necesidades y expectativas de las partes interesadas</li>
                    <li>Determinación de alcance del sistema de gestión de la seguridad de la información</li>
                    <li>Sistema de gestión de seguridad de la información</li>
                </ul>

                <div class="caja-cards-iso-guia mt-5">
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso1.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Análisis de brechas</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.analisis-brechas.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso2.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Plan de implementación</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.implementacions.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso3.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Partes interesadas</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.partes-interesadas.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso4.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Determinación de alcance</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.alcance-sgsis.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
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

            <div id="content-guia-iso-2" class="paso-iso-guia">
                <h4 class="title-info-iso">Liderazgo</h4>

                <ul class="list-info-iso">
                    <li>Liderazgo y compromiso</li>
                    <li> Política</li>
                    <li> Funciones, responsabilidades y autoridades de la organización</li>
                </ul>

                <div class="caja-cards-iso-guia mt-5">
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso5.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Conformación del comité</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.comiteseguridads.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso6.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Evidencias de asignación de recursos al SGSI</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.evidencias-sgsis.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso7.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Política del sistema de gestión</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.politica-sgsis.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-previous">Atrás</button>
                    <button class="btn btn-netx">Siguiente paso</button>
                </div>
            </div>

            <div id="content-guia-iso-3" class="paso-iso-guia">
                <h4 class="title-info-iso">Planificación</h4>

                <ul class="list-info-iso">
                    <li> Acciones para abordar riesgos y oportunidades</li>
                    <li> Objetivos de seguridad de la información y planificación para alcanzarlos</li>
                </ul>

                <div class="caja-cards-iso-guia mt-5">
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso8.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Análisis de riesgos</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.analisis-riesgos.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso9.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Asignación de controles</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.control-accesos.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso10.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Declaración de aplicabilidad</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.declaracion-aplicabilidad-2022.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso11.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Declaración de aplicabilidad tabla</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.declaracion-aplicabilidad-2022.tabla') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso12.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Tipos de objetivos</h4>
                            <span>Completado</span>
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
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.objetivosseguridads.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-previous">Atrás</button>
                    <button class="btn btn-netx">Siguiente paso</button>
                </div>
            </div>

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
                            <span>Completado</span>
                        </div>
                        <a href="" class="btn-entrar">
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
                            <span>Completado</span>
                        </div>
                        <a href="" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso16.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Concientización SGI</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.concientizacion-sgis.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso17.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Material SGSI</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.material-sgsis.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso18.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Comunicados generales</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.portal-comunicacion.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso19.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Información documentada</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.informacion-documetadas.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-previous">Atrás</button>
                    <button class="btn btn-netx">Siguiente paso</button>
                </div>
            </div>

            <div id="content-guia-iso-5" class="paso-iso-guia">
                <h4 class="title-info-iso">Operación</h4>

                <ul class="list-info-iso">
                    <li>Planificación y control operativo</li>
                    <li>Evaluación de riesgos de seguridad de la información</li>
                    <li>tratamiento de riesgos de seguridad de la información</li>
                </ul>

                <div class="caja-cards-iso-guia mt-5">
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso20.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Planificación y control</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.planificacion-controls.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso21.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Tratamiento de riesgos</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.tratamiento-riesgos.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso22.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Matriz de requisitos legales y regulatorios</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso23.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Control de accesos</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.control-accesos.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso24.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Incidentes de seguridad</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.incidentes-de-seguridads.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-previous">Atrás</button>
                    <button class="btn btn-netx">Siguiente paso</button>
                </div>
            </div>

            <div id="content-guia-iso-6" class="paso-iso-guia">
                <h4 class="title-info-iso">Evaluación</h4>

                <ul class="list-info-iso">
                    <li>Seguimiento, medición, análisis y evaluación</li>
                    <li>Auditoría interna</li>
                    <li>revisión por dirección</li>
                </ul>

                <div class="caja-cards-iso-guia mt-5">
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso25.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Indicadores del sistema de gestión</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.indicadores-sgsis.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso26.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Programa anual de auditoría</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.auditoria-anuals.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso27.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Plan de auditoría</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.plan-auditoria.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso28.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Revisión por dirección</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.revision-direccions.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-previous">Atrás</button>
                    <button class="btn btn-netx">Siguiente paso</button>
                </div>
            </div>

            <div id="content-guia-iso-7" class="paso-iso-guia">
                <h4 class="title-info-iso"> Mejora</h4>

                <ul class="list-info-iso">
                    <li>Mejora continua</li>
                    <li>No conformidad y acción correctiva</li>
                </ul>

                <div class="caja-cards-iso-guia mt-5">
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso29.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Acción correctiva</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.accion-correctivas.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                    <div class="card-iso-guia">
                        <div class="img-card-iso">
                            <img src="{{ asset('img/iso/iso30.png') }}" alt="">
                        </div>
                        <div class="info-iso">
                            <h4 class="title-card-img-iso">Registro mejora</h4>
                            <span>Completado</span>
                        </div>
                        <a href="{{ route('admin.plan-mejoras.index') }}" class="btn-entrar">
                            Entrar
                            <i class="material-symbols-outlined"> arrow_right_alt</i>
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-previous">Atrás</button>
                </div>
            </div>

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
@endsection
