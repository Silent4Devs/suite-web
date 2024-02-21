@extends('layouts.admin')
@section('content')
    <style type="text/css">
        body {
            background-color: #fff;
        }

        section {
            padding-top: 50px;
        }

        table,
        h2 {
            margin-top: 30px;
        }

        .card {
            box-shadow: none !important;
            background-color: rgba(0, 0, 0, 0);
        }

        .table {
            width: 100% !important;
        }


        table i {
            font-size: 15pt;
            margin-right: 7px;
        }

        .fa-edit {
            color: rgb(4, 4, 4);
        }

        .fa-archive {
            color: #212529;
        }

        .cdr-celeste {
            background: #4A98FF;
        }

        .cdr-amarillo {
            background: #FFCB63;
        }

        .cdr-morado {
            background: #AC84FF;
        }

        .cdr-azul {
            background: #6863FF;
        }

        .cdr-verde {
            background: #6DC866;
        }

        .cdr-rojo {
            background: #FF417B;
        }

        .caja_secciones section {
            overflow: unset !important;
        }
    </style>


    {{-- {{ Breadcrumbs::render('centro-atencion') }} --}}
    <h5 class="col-12 titulo_general_funcion">Centro de Atención</h5>
    <div id="desk" class="mt-5 card" style="border: none;">

        @include('partials.flashMessages')
        <div class="caja_botones_secciones">

            <div class="caja_botones_menu">
                @can('centro_atencion_incidentes_de_seguridad_acceder')
                    <a href="#" data-tabs="incidentes" class="btn_activo">
                        <i class="fas fa-exclamation-triangle"></i> Incidentes de seguridad
                    </a>
                @endcan
                @can('centro_atencion_riesgos_acceder')
                    <a href="#" data-tabs="riesgos">
                        <i class="fas fa-shield-alt"></i> Riesgos
                    </a>
                @endcan
                @can('centro_atencion_quejas_acceder')
                    <a href="#" data-tabs="quejas">
                        <i class="fas fa-frown"></i> Quejas
                    </a>
                @endcan
                @can('centro_atencion_quejas_clientes_acceder')
                    <a href="#" data-tabs="quejasClientes">
                        <i class="fas fa-thumbs-down"></i> Quejas Clientes
                    </a>
                @endcan
                @can('centro_atencion_denuncias_acceder')
                    <a href="#" data-tabs="denuncias">
                        <i class="fas fa-hand-paper"></i> Denuncias
                    </a>
                @endcan
                @can('centro_atencion_mejoras_acceder')
                    <a href="#" data-tabs="mejoras">
                        <i class="fas fa-rocket"></i> Mejoras
                    </a>
                @endcan
                @can('centro_atencion_sugerencias_acceder')
                    <a href="#" data-tabs="sugerencias">
                        <i class="fas fa-lightbulb"></i> Sugerencias
                    </a>
                @endcan
            </div>

            <div class="caja_caja_secciones">

                <div class="caja_secciones">
                    <section id="incidentes"
                        class="{{ Auth::user()->can('incidentes_seguridad_access') ? 'caja_tab_reveldada' : '' }}">
                        @include('admin.desk.seguridad.seguridad')
                    </section>
                    <section id="riesgos">
                        @include('admin.desk.riesgos.riesgos')
                    </section>
                    <section id="quejas">
                        @include('admin.desk.quejas.quejas')
                    </section>
                    <section id="quejasClientes">
                        @include('admin.desk.clientes.clientes')
                    </section>
                    <section id="denuncias">
                        @include('admin.desk.denuncias.denuncias')
                    </section>
                    <section id="mejoras">
                        @include('admin.desk.mejoras.mejoras')
                    </section>
                    <section id="sugerencias">
                        @include('admin.desk.sugerencias.sugerencias')
                    </section>


                    {{-- <div class="text-center">
                        @can('incidentes_seguridad_access')
                            <section id="incidentes">
                                @include('admin.desk.seguridad.seguridad')
                            </section>
                        @else
                            <div class="mt-5 row" style="top:0;">
                                <div class="mb-3 col-12">
                                    <img src="{{ asset('img/not_access.svg') }}" width="400" />
                                </div>
                                <div class="col-12">
                                    <strong style="font-size:12pt">
                                        <i class="mr-1 fas fa-info-circle"></i>
                                        No puedes acceder al módulo de Incidentes de Seguridad, solicita al administrador que te
                                        otorge dichos permisos
                                    </strong>
                                </div>
                            </div>
                        @endcan
                        @can('riesgos_access')
                            <section id="riesgos" class="caja_tab_reveldada">
                                @include('admin.desk.riesgos.riesgos')
                            </section>
                        @else
                            <div class="mt-5 row" style="margin-left: -10px">
                                <div class="mb-3 col-12">
                                    <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                                </div>
                                <div class="col-12">
                                    <strong style="font-size:12pt">
                                        <i class="mr-1 fas fa-info-circle"></i>
                                        No puedes acceder al módulo de Riesgos, solicita al administrador que te
                                        otorge dichos permisos
                                    </strong>
                                </div>
                            </div>
                        @endcan
                        @can('quejas_access')
                            <section id="quejas">
                                @include('admin.desk.quejas.quejas')
                            </section>
                        @else
                            <div class="mt-5 row" style="margin-left: -10px">
                                <div class="mb-3 col-12">
                                    <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                                </div>
                                <div class="col-12">
                                    <strong style="font-size:12pt">
                                        <i class="mr-1 fas fa-info-circle"></i>
                                        No puedes acceder al módulo de Quejas, solicita al administrador que te
                                        otorge dichos permisos
                                    </strong>
                                </div>
                            </div>
                        @endcan
                        @can('denuncias_access')
                            <section id="denuncias">
                                @include('admin.desk.denuncias.denuncias')
                            </section>
                        @else
                            <div class="mt-5 row" style="margin-left: -10px">
                                <div class="mb-3 col-12">
                                    <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                                </div>
                                <div class="col-12">
                                    <strong style="font-size:12pt">
                                        <i class="mr-1 fas fa-info-circle"></i>
                                        No puedes acceder al módulo de Denuncias, solicita al administrador que te
                                        otorge dichos permisos
                                    </strong>
                                </div>
                            </div>
                        @endcan
                        @can('mejoras_access')
                            <section id="mejoras">
                                @include('admin.desk.mejoras.mejoras')
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
                        @can('sugerencias_access')
                            <section id="sugerencias">
                                @include('admin.desk.sugerencias.sugerencias')
                            </section>
                        @else
                            <div class="mt-5 row" style="margin-left: -10px">
                                <div class="mb-3 col-12">
                                    <img src="{{ asset('img/not_access.svg') }}" width="400 " />
                                </div>
                                <div class="col-12">
                                    <strong style="font-size:12pt">
                                        <i class="mr-1 fas fa-info-circle"></i>
                                        No puedes acceder al módulo de Sugerencias, solicita al administrador que te
                                        otorge dichos permisos
                                    </strong>
                                </div>
                            </div>
                        @endcan
                    </div> --}}

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'incidentes';
            const permisoIncidente = @json(Auth::user()->can('incidentes_seguridad_access'));
            const permisoRiesgo = @json(Auth::user()->can('riesgos_access'));
            const permisoQueja = @json(Auth::user()->can('quejas_access'));
            const permisoDenuncia = @json(Auth::user()->can('denuncias_access'));
            const permisoMejora = @json(Auth::user()->can('mejoras_access'));
            const permisoSugerencia = @json(Auth::user()->can('sugerencias_access'));
            const permisoQuejaCliente = true;
            console.log(localStorage.getItem('menu-desk'));
            if (permisoIncidente) {
                // localStorage.setItem('menu-desk', 'incidentes');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'incidentes';
            } else if (permisoRiesgo) {
                // localStorage.setItem('menu-desk', 'riesgos');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'riesgos';
            } else if (permisoQueja) {
                // localStorage.setItem('menu-desk', 'quejas');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'quejas';
            } else if (permisoQuejaCliente) {
                // localStorage.setItem('menu-desk', 'quejasClientes');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'quejasClientes';
            } else if (permisoDenuncia) {
                // localStorage.setItem('menu-desk', 'denuncias');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'denuncias';
            } else if (permisoMejora) {
                // localStorage.setItem('menu-desk', 'mejoras');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'mejoras';
            } else if (permisoSugerencia) {
                // localStorage.setItem('menu-desk', 'sugerencias');
                menu = localStorage.getItem('menu-desk') ? localStorage.getItem('menu-desk') : 'sugerencias';
            }
            console.log(menu);

            if (document.querySelector('.caja_tab_reveldada')) {
                document.querySelector('.caja_tab_reveldada').classList.remove('caja_tab_reveldada');
            }
            if (document.querySelector('.btn_activo')) {
                document.querySelector('.btn_activo').classList.remove('btn_activo');
            }
            if (document.querySelector(`[data-tabs=${menu}]`)) {
                document.getElementById(menu).classList.add('caja_tab_reveldada');
                document.querySelector(`[data-tabs=${menu}]`).classList.add('btn_activo');
            }
            document.querySelector('.caja_botones_menu').addEventListener('click', function(e) {
                let elemento = e.target;
                if (elemento.tagName == 'I') {
                    elemento = elemento.closest('a');
                }
                if (elemento.getAttribute('data-tabs')) {
                    localStorage.setItem('menu-desk', elemento.getAttribute('data-tabs'))
                }
            })
            window.menuActive = function(item) {
                localStorage.setItem('menu-desk', item)
            }
        })
    </script>
@endsection
