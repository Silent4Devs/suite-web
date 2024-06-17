@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    @include('admin.pasarelaPago.menu')

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
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background"
                                style="background-color: #9CEBFF;">school</i>
                            <h5>Capacitación</h5>
                        </div>
                        <a href="" class="btn">Abrir</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background"
                                style="background-color: #F1F1F1;">emoji_people</i>
                            <h5>Gestión Normativa</h5>
                        </div>
                        <a href="" class="btn">Abrir</a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background"
                                style="background-color: #FCB4BC;">gpp_maybe</i>
                            <h5>Gestor de Riesgos</h5>
                        </div>
                        <a href="" class="btn">Abrir</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background"
                                style="background-color: #E0C5FF;">clinical_notes</i>
                            <h5>Gestión Contractual</h5>
                        </div>
                        <a href="" class="btn">Abrir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tu-plan mt-5">
            <h4>Disponible en tu plan</h4>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card card-body">
                        <div>
                            <i class="material-symbols-outlined icon-background"
                                style="background-color: #B1C6FF;">overview</i>
                            <strong> Plan de trabajo </strong>
                        </div>
                        <p>
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
                            <i class="material-symbols-outlined icon-background"
                                style="background-color: #FFFDC4;">folder_managed</i>
                            <strong> Gestor Documental </strong>
                        </div>
                        <p>
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
                            <i class="material-symbols-outlined icon-background"
                                style="background-color: #FFD9ED;">groups</i>
                            <strong> Visitantes </strong>
                        </div>
                        <p>
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
                            <i class="material-symbols-outlined icon-background"
                                style="background-color: #FFD3BF;">id_card</i>
                            <strong> Gestión de Talento </strong>
                        </div>
                        <p>
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

    {{-- modales --}}
@endsection
@section('scripts')
@endsection
