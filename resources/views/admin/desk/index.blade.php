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

        .cdr-celeste{
            background: #4A98FF;
        }
        .cdr-amarillo{
            background: #FFCB63;
        }
        .cdr-morado{
            background: #AC84FF;
        }
        .cdr-azul{
            background: #6863FF;
        }
        .cdr-verde{
            background: #6DC866;
        }
        .cdr-rojo{
            background: #FF417B;
        }

    </style>


    {{ Breadcrumbs::render('centro-atencion') }}
    <h5 class="col-12 titulo_general_funcion">Centro de Atención</h5>
    <div id="desk" class="mt-5 card" style="">

        @include('partials.flashMessages')
        <div class="caja_botones_secciones">

            <div class="caja_botones_menu">
                <a  href="#" data-tabs="incidentes" class="btn_activo">
                    <i class="fas fa-exclamation-triangle"></i> Incidentes de seguridad
                </a>
                <a  href="#" data-tabs="riesgos">
                    <i class="fas fa-shield-alt"></i> Riesgos
                </a>
                <a  href="#" data-tabs="quejas">
                    <i class="fas fa-frown"></i> Quejas
                </a>
                <a  href="#" data-tabs="denuncias">
                    <i class="fas fa-hand-paper"></i> Denuncias
                </a>
                <a  href="#" data-tabs="mejoras">
                    <i class="fas fa-rocket"></i> Mejoras
                </a>
                <a  href="#" data-tabs="sugerencias">
                    <i class="fas fa-lightbulb"></i> Sugerencias
                </a>

            </div>

            <div class="caja_caja_secciones">

                <div class="caja_secciones">
                    <section id="incidentes" class="caja_tab_reveldada">
                        @include('admin.desk.seguridad.seguridad')
                    </section>
                    <section id="riesgos">
                        @include('admin.desk.riesgos.riesgos')
                    </section>
                    <section id="quejas">
                        @include('admin.desk.quejas.quejas')
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


                    <div class="text-center">
                        @can('incidentes_seguridad_access')
                            <section id="incidentes">
                                @include('admin.desk.seguridad.seguridad')
                            </section>
                        @else
                            <div class="mt-5 row" style="margin-left: -10px">
                                <div class="mb-3 col-12">
                                    <img src="{{ asset('img/not_access.svg') }}" width="400 " />
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
                            <section id="riesgos">
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
                    </div>

                </div>

            </div>
        </div>
    @endsection

    @section('scripts')




    <script>
        document.addEventListener('DOMContentLoaded',function(){
            const menu=localStorage.getItem('menu-desk');
            document.querySelector('.caja_tab_reveldada').classList.remove('caja_tab_reveldada');
            document.querySelector('.btn_activo').classList.remove('btn_activo');
            document.getElementById(menu).classList.add('caja_tab_reveldada');
            document.querySelector(`[data-tabs=${menu}]`).classList.add('btn_activo');
            document.querySelector('.caja_botones_menu').addEventListener('click',function(e){

                if(e.target.getAttribute('data-tabs')){
                    localStorage.setItem('menu-desk',e.target.getAttribute('data-tabs'))
                }
            })
            window.menuActive=function(item){
                localStorage.setItem('menu-desk',item)
            }
        })

    </script>
    @endsection


