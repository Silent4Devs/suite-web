@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    @include('admin.pasarelaPago.components.menu')

    <div class="content-pasarela">

        @include('admin.pasarelaPago.components.btn-regresar')

        <div class="nav options-pago-periodo">
            <button class="btn active" data-toggle="tab" data-target="#nav-mes">
                Mes
            </button>
            <button class="btn" data-toggle="tab" data-target="#nav-año">
                Año
            </button>
        </div>

        <div class="tab-content mt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-mes">
                <div class="cards-planes-precios gap-3">
                    <div class="card">
                        <div class="card-header" style="background-color: #0070D2;">
                            Por Módulo
                        </div>
                        <div class="card-body">
                            <h3 class="text-center" style="color: #5DA3FF;">MXN $150/mes</h3>
                            <p class="text-center">
                                <small>Por usuario al mes</small>
                            </p>

                            <p>
                                Arma tu propio paquete seleccionando una o todas aquellas aplicaciones que necesites.
                            </p>

                            <div class="text-center mt-4">
                                <a href="{{ route('admin.pasarela-pago.pre-pago') }}"
                                    class="btn btn-outline-primary">EMPIEZA
                                    AHORA</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background-color: #00C16B;">
                            Todas las Aplicaciones
                        </div>
                        <div class="card-body">
                            <h3 class="text-center" style="color: #5FC699;">MXN $6,000/mes</h3>
                            <p class="text-center">
                                <small>Por usuario al mes</small>
                            </p>

                            <p>
                                Todas las aplicaciones. Obtén nuestra solución completa obteniendo todos los beneficio que
                                te da
                                nuestra plataforma.
                            </p>

                            <div class="text-center mt-4">
                                <a href="{{ route('admin.pasarela-pago.pre-pago') }}"
                                    class="btn btn-outline-primary">EMPIEZA
                                    AHORA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-año">
                <div class="cards-planes-precios gap-3">
                    <div class="card">
                        <div class="card-header" style="background-color: #0c3d99;">
                            Por Módulo
                        </div>
                        <div class="card-body">
                            <h3 class="text-center" style="color: #5DA3FF;">MXN $150/año</h3>
                            <p class="text-center">
                                <small>Por usuario al año</small>
                            </p>

                            <p>
                                Arma tu propio paquete seleccionando una o todas aquellas aplicaciones que necesites.
                            </p>

                            <div class="text-center mt-4">
                                <a href="{{ route('admin.pasarela-pago.pre-pago') }}"
                                    class="btn btn-outline-primary">EMPIEZA
                                    AHORA</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background-color: #14984d;">
                            Todas las Aplicaciones
                        </div>
                        <div class="card-body">
                            <h3 class="text-center" style="color: #5FC699;">MXN $6,000/año</h3>
                            <p class="text-center">
                                <small>Por usuario al mes</small>
                            </p>

                            <p>
                                Todas las aplicaciones. Obtén nuestra solución completa obteniendo todos los beneficio que
                                te da
                                nuestra plataforma.
                            </p>

                            <div class="text-center mt-4">
                                <a href="{{ route('admin.pasarela-pago.pre-pago') }}"
                                    class="btn btn-outline-primary">EMPIEZA
                                    AHORA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4 mb-4">
            <a href="" class="link">
                <i class="material-symbols-outlined"> call </i>
                <i class="material-symbols-outlined"> mail </i>
                Quiero contactar con un asesor comercial
            </a>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
