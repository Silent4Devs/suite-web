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
            {{-- <div class="caja_botones_menu">
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
            </div> --}}
            {{-- <div class="caja_caja_secciones">
                <div class="caja_secciones">
                </div>
            </div> --}}
            @can('contexto_access'){{-- Cambiar Permiso --}}
                <section data-id="contexto" id="s1" class="caja_tab_reveldada caja">
                    <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                        <div class="row w-100">
                            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                <div class="w-100">
                                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                </div>
                            </div>
                            <div class="col-11">
                                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                    Instrucciones</p>
                                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                                    ingrese a los siguientes módulos para llevar a cabo la evaluación 360°</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <ul>
                            <li>
                                <a href="{{ route('admin.ev360-competencias.index') }}">
                                    <div style="text-transform: capitalize">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                            class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <p class="m-0 mt-2">
                                            Definir Competencias
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ev360-competencias-por-puesto.index') }}">
                                    <div style="text-transform: capitalize">
                                        <i class="m-0 fas fa-user-tag" style="font-size:40px"></i>
                                        <p class="m-0 mt-2">
                                            Competencias Por Puesto
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ev360-objetivos.index') }}">
                                    <div style="text-transform: capitalize">
                                        <i class="m-0 fas fa-bullseye" style="font-size:40px;"></i>
                                        <p class="m-0 mt-2">
                                            Asignar
                                            Objetivos Estratégicos
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ev360-evaluaciones.create') }}">
                                    <div style="text-transform: capitalize">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                        <p class="m-0 mt-2">
                                            Crear
                                            <br>
                                            Evaluaciones
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ev360-evaluaciones.index') }}">
                                    <div style="text-transform: capitalize">
                                        <i class="fas fa-clone"></i>
                                        <p class="m-0 mt-2">
                                            Evaluaciones
                                            <br>
                                            Creadas
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
@endsection


@section('scripts')

@endsection
