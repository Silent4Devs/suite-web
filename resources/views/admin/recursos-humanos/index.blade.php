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
                    <div class="d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="mr-2 bi bi-file-earmark-person iconos_menu letra_blanca" viewBox="0 0 16 16">
                            <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z" />
                        </svg>
                        <p class="m-0">Evaluación 360 Grados</p>
                    </div>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                    fill="currentColor" class="bi bi-file-earmark-medical-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-3 2v.634l.549-.317a.5.5 0 1 1 .5.866L7 7l.549.317a.5.5 0 1 1-.5.866L6.5 7.866V8.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L5 7l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V5.5a.5.5 0 1 1 1 0zm-2 4.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z" />
                                                </svg>
                                                <p class="m-0 mt-2">
                                                    Competencias
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.ev360-competencias-por-puesto.index') }}">
                                            <div style="text-transform: capitalize">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                    fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                    <path fill-rule="evenodd"
                                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                                </svg>
                                                <p class="m-0 mt-2">
                                                    Competencias Por Puesto
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.ev360-objetivos.index') }}">
                                            <div style="text-transform: capitalize">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                    fill="currentColor" class="bi bi-bullseye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10zm0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                                                    <path
                                                        d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                                                    <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                </svg>
                                                <p class="m-0 mt-2">
                                                    Objetivos
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.ev360-evaluaciones.index') }}">
                                            <div style="text-transform: capitalize">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                    fill="currentColor" class="bi bi-file-earmark-person-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm2 5.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12s5 1.755 5 1.755z" />
                                                </svg>
                                                <p class="m-0 mt-2">
                                                    Evaluaciones
                                                </p>
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
