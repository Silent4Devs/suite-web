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
        <a href="" class="link">Regresar</a>

        <div class="d-flex justify-content-center mt-5 options-pago-periodo">
            <button class="btn active">
                Mes
            </button>
            <button class="btn">
                Año
            </button>
        </div>

        <div class="cards-planes-precios mt-5 gap-3">
            @foreach ($plans as $plan)
                <div class="card">
                    <div class="card-header" style="background-color: #0070D2;">
                        {{ $plan->name }}
                    </div>
                    <div class="card-body">
                        <h3 class="text-center" style="color: #5DA3FF;">MXN ${{ $plan->price }}</h3>
                        <p class="text-center">
                            <small>Por usuario al mes</small>
                        </p>

                        <p>
                            Arma tu propio paquete seleccionando una o todas aquellas aplicaciones que necesites.
                        </p>

                        <div class="text-center mt-4">
                            <a href="{{ route('admin.pasarela-pago.pago', $plan->slug) }}"
                                class="btn btn-outline-primary">EMPIEZA AHORA</a>
                        </div>
                    </div>
                </div>
            @endforeach
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
