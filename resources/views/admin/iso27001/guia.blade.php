    @extends('layouts.admin')
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/guia_iso.css') }}">
    @endsection
    @section('content')
        <div class="menu-pasos-guia">
            <ul>
                <li data-id="content-guia-iso-1">
                    <span>1</span>
                    <i class="bi bi-file-earmark-text"></i>
                    Contexto
                </li>
                <li data-id="content-guia-iso-2">
                    <span>2</span>
                    <i class="bi bi-file-earmark-text"></i>
                    Liderazgo
                </li>
                <li data-id="content-guia-iso-3">
                    <span>3</span>
                    <i class="bi bi-file-earmark-text"></i>
                    Planificación
                </li>
                <li data-id="content-guia-iso-4">
                    <span>4</span>
                    <i class="bi bi-file-earmark-text"></i>
                    Soporte
                </li>
                <li data-id="content-guia-iso-5">
                    <span>5</span>
                    <i class="bi bi-file-earmark-text"></i>
                    Operación
                </li>
                <li data-id="content-guia-iso-6">
                    <span>6</span>
                    <i class="bi bi-file-earmark-text"></i>
                    Evaluación
                </li>
                <li data-id="content-guia-iso-7">
                    <span>7</span>
                    <i class="bi bi-file-earmark-text"></i>
                    Mejora
                </li>
            </ul>
        </div>
        <div class="content-guia-iso mt-4">
            <div class="ml-3">
                <h3 class="title-guia-iso">SEGURIDAD DE LA INFORMACIÓN 27001</h3>
                Sistemadegestion/pasoapaso/27001
            </div>

            <div class="card card-body card-main-iso mt-4">

                <div id="content-guia-iso-1" class="paso-iso-guia active-iso-paso">
                    <h4 class="title-info-iso">C4 Contexto</h4>

                    <ul class="list-info-iso">
                        <li>4.1 Entender la organización y su contexto</li>
                        <li>4.2 Comprender las necesidades y expectativas de las partes interesadas</li>
                        <li>4.3 Determinación de alcance del sistema de gestión de la seguridad de la información</li>
                        <li>4.4 Sistema de gestión de seguridad de la información</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        <a href="{{ route('admin.analisis-brechas.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso1.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Análisis de brechas</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.implementacions.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso2.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Plan de implementación</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.partes-interesadas.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso3.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Partes interesadas</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.alcance-sgsis.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso4.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Determinación de alcance</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div id="content-guia-iso-2" class="paso-iso-guia">
                    <h4 class="title-info-iso">C5 Liderazgo</h4>

                    <ul class="list-info-iso">
                        <li>5.1Liderazgo y compromiso</li>
                        <li>5.2 Política</li>
                        <li>5.3 Funciones, responsabilidades y autoridades de la organización</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        <a href="{{ route('admin.comiteseguridads.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso5.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Conformación del comité</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.comiteseguridads.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso6.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Evidencias de asignación de recursos al SGSI</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.matriz-seguridad.sistema-gestion') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso7.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Política del sistema de gestión</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div id="content-guia-iso-3" class="paso-iso-guia">
                    <h4 class="title-info-iso">C6 Planificación</h4>

                    <ul class="list-info-iso">
                        <li>6.1 Acciones para abordar riesgos y oportunidades</li>
                        <li>6.2 Objetivos de seguridad de la información y planificación para alcanzarlos</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        <a href="">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso8.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Análisis de riesgos</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.control-accesos.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso9.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Asignación de controles</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.declaracion-aplicabilidad.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso10.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Declaración de aplicabilidad</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.declaracion-aplicabilidad.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso11.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Declaración de aplicabilidad tabla</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.tipos-objetivos.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso12.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Tipos de objetivos</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.objetivosseguridads.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso13.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Objetivos</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div id="content-guia-iso-4" class="paso-iso-guia">
                    <h4 class="title-info-iso">C7 Soporte</h4>

                    <ul class="list-info-iso">
                        <li>7.1 Recursos</li>
                        <li>7.2 Competencia</li>
                        <li>7.3 Conciencia</li>
                        <li>7.4 Comunicación</li>
                        <li>7.5 Información documentada</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        <a href="">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso14.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Transferencia de conocimiento</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.competencias.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso15.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Competencias</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.concientizacion-sgis.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso16.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Concientización SGI</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.material-sgsis.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso17.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Material SGSI</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.portal-comunicacion.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso18.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Comunicados generales</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso19.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Información documentada</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div id="content-guia-iso-5" class="paso-iso-guia">
                    <h4 class="title-info-iso">C8 Operación</h4>

                    <ul class="list-info-iso">
                        <li>8.1 Planificación y control operativo</li>
                        <li>8.2 Evaluación de riesgos de seguridad de la información</li>
                        <li>8.3 tratamiento de riesgos de seguridad de la información</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        <a href="{{ route('admin.planificacion-controls.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso20.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Planificación y control</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.tratamiento-riesgos.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso21.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Tratamiento de riesgos</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.matriz-requisito-legales.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso22.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Matriz de requisitos legales y regulatorios</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.control-accesos.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso23.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Control de accesos</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.incidentes-de-seguridads.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso24.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Incidentes de seguridad</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div id="content-guia-iso-6" class="paso-iso-guia">
                    <h4 class="title-info-iso">C9 Evaluación</h4>

                    <ul class="list-info-iso">
                        <li>9.1 Seguimiento, medición, análisis y evaluación</li>
                        <li>9.2 Auditoría interna</li>
                        <li>9.3 revisión por dirección</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        <a href="{{ route('admin.indicadores-sgsis.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso25.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Indicadores del sistema de gestión</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.auditoria-anuals-programa') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso26.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Programa anual de auditoría</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.plan-auditoria.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso27.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Plan de auditoría</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.revision-direccions.index') }}">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso28.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Revisión por dirección</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div id="content-guia-iso-7" class="paso-iso-guia">
                    <h4 class="title-info-iso">C10 Mejora</h4>

                    <ul class="list-info-iso">
                        <li>10.1 Mejora continua</li>
                        <li>10.2 No conformidad y acción correctiva</li>
                    </ul>

                    <div class="caja-cards-iso-guia mt-5">
                        <a href="">
                            <div class="card-iso-guia">
                                <img src="{{ asset('img/iso/iso29.png') }}" alt="">
                                <div class="p-3">
                                    <h4 class="title-card-img-iso">Acción correctiva</h4>
                                    <span>Completado</span>
                                </div>
                            </div>
                        </a>
                        <div class="card-iso-guia">
                            <img src="{{ asset('img/iso/iso30.png') }}" alt="">
                            <div class="p-3">
                                <h4 class="title-card-img-iso">Registro mejora</h4>
                                <span>Completado</span>
                            </div>
                        </div>
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
                $('#' + $('.menu-pasos-guia li:hover').attr('data-id')).addClass('active-iso-paso');
                console.log($('.menu-pasos-guia li:hover').attr('data-id'));
            });
        </script>
    @endsection
