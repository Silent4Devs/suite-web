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

        <div class="card card-body mt-5 card-pago-confirmado" style="width: 400px; margin: auto;">
            <div class="d-flex justify-content-between">
                <strong>8 Aplicaciones</strong>
                <strong>$310.00 x 8</strong>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
                <strong>Todas las aplicaciones</strong>
                <strong>$2480.00 mx</strong>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
                <strong>Total al mes +IVA:</strong>
                <strong>$2620.00 mx</strong>
            </div>

            <div class="text-center my-5" style="font-size: 25px; color:#5AA664;">
                <strong>
                    Compra realizada
                </strong>
            </div>

            <div>
                <small>
                    Compras en Tabantaj
                </small>
            </div>

            <div class="mt-3">
                <small>Metodo de pago</small> <br>
                <img src="{{ asset('img/pasarelaPago/visa.png') }}" alt="" style="height: 25px;">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
