@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    <div class="menu-pasarela">
        <ul>
            <li> <strong> Aplicaciones </strong> </li>
            <li>
                <i class="material-symbols-outlined">apps</i>
                Todas las aplicaciones
            </li>
            <li>
                <i class="material-symbols-outlined">install_desktop</i>
                Actualizaciones
            </li>
        </ul>

        <ul class="mt-5">
            <li> <strong> Planes </strong> </li>
            <li>
                <i class="material-symbols-outlined">credit_card</i>
                Planes y Precios
            </li>
        </ul>

        <ul class="mt-5">
            <li> <strong> Aplicaciones </strong> </li>
            <li>
                <i class="material-symbols-outlined">school</i>
                Capacitación
            </li>
            <li>
                <i class="material-symbols-outlined">language</i>
                Gestión Normativa
            </li>
            <li>
                <i class="material-symbols-outlined">quick_reference</i>
                Planes de trabajo
            </li>
            <li>
                <i class="material-symbols-outlined">folder_managed</i>
                Gestor Documental
            </li>
            <li>
                <i class="material-symbols-outlined">install_desktop</i>
                Gestión de Talento
            </li>
            <li>
                <i class="material-symbols-outlined">quick_reference</i>
                Gestión Contractual
            </li>
            <li>
                <i class="material-symbols-outlined">gpp_maybe</i>
                Gestión de Riesgos
            </li>
            <li>
                <i class="material-symbols-outlined">groups</i>
                Visitantes
            </li>
        </ul>
    </div>

    <div class="content-pasarela">
        <div class="d-flex portada-pasarela">
            <img src="{{ asset('img/pasarelaPago/portada-inicio.png') }}" alt="">
            <div class="text-white portada-pasarela-info p-5">
                <h3>Software Integral de Gestión Empresarial</h3>
                <p class="p-3">
                    Planifica, y analiza las operaciones contables de la compañía.
                </p>
                <p class="mt-5">
                    <strong>
                        Elige tus aplicaciones
                    </strong>
                </p>
            </div>
        </div>

        <div class="instaladas mt-5">
            <h4>Instaladas</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-body">
                        <div class="d-flex align-items-center gap-2">
                            <i class="material-symbols-outlined icon-background">school</i>
                            <span>Capacitación</span>
                        </div>
                        <a href="" class="btn">Abrir</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body">
                        <div class="d-flex align-items-center gap-2">
                            <i class="material-symbols-outlined icon-background">school</i>
                            <span>Capacitación</span>
                        </div>
                        <a href="" class="btn">Abrir</a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card card-body">
                        <div class="d-flex align-items-center gap-2">
                            <i class="material-symbols-outlined icon-background">school</i>
                            <span>Capacitación</span>
                        </div>
                        <a href="" class="btn">Abrir</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body">
                        <div class="d-flex align-items-center gap-2">
                            <i class="material-symbols-outlined icon-background">school</i>
                            <span>Capacitación</span>
                        </div>
                        <a href="" class="btn">Abrir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tu-plan">
            <h4>Disponible en tu plan</h4>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-body">
                        <div>
                            <i class="material-symbols-outlined icon-background">school</i>
                            Plan de trabajo
                        </div>
                        <p class="text-center">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.
                        </p>
                        <hr>
                        <div class="text-center">
                            <a class="btn btn-primary" href="">Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body">
                        <div>
                            <i class="material-symbols-outlined icon-background">school</i>
                            Plan de trabajo
                        </div>
                        <p class="text-center">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.
                        </p>
                        <hr>
                        <div class="text-center">
                            <a class="btn btn-primary" href="">Agregar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-body">
                        <div>
                            <i class="material-symbols-outlined icon-background">school</i>
                            Plan de trabajo
                        </div>
                        <p class="text-center">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.
                        </p>
                        <hr>
                        <div class="text-center">
                            <a class="btn btn-primary" href="">Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body">
                        <div>
                            <i class="material-symbols-outlined icon-background">school</i>
                            Plan de trabajo
                        </div>
                        <p class="text-center">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.
                        </p>
                        <hr>
                        <div class="text-center">
                            <a class="btn btn-primary" href="">Agregar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
