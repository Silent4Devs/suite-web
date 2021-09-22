@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu-secciones.css') }}">
    <div class="mt-3">
        {{ Breadcrumbs::render('Evaluacion360') }}
    </div>
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong><i class="mr-2 fas fa-circle-notch"></i>Evaluación 360
                    Grados</strong>
            </h3>
        </div>
        <div class="card-body">
            <div class="caja_botones_menu">
                <a href="#" id="contexto" data-tabs="s1" class="btn_activo tabs ventana_cerrar">
                    <i class="fa-fw fas fa-archive"></i><br>
                    Contexto
                </a>
            </div>
            <div class="caja_caja_secciones">
                <div class="caja_secciones">
                    @can('contexto_access'){{-- Cambiar Permiso --}}
                        <section data-id="contexto" id="s1" class="caja_tab_reveldada caja">
                            <div class="mt-5">
                                <ul>
                                    <li>
                                        <a href="{{ route('admin.ev360-competencias.index') }}">
                                            <div style="text-transform: capitalize">
                                                <i class="fas fa-file-invoice"></i>
                                                Competencias
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.ev360-objetivos.index') }}">
                                            <div style="text-transform: capitalize">
                                                <i class="fas fa-file-invoice"></i>
                                                Objetivos
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.ev360-evaluaciones.index') }}">
                                            <div style="text-transform: capitalize">
                                                <i class="fas fa-file-invoice"></i>
                                                Evaluaciones
                                            </div>
                                        </a>
                                    </li>
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
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection
