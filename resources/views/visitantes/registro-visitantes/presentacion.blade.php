@extends('layouts.visitantes')
@section('content')
    <style>
        html,
        body {
            margin: 0px;
            height: 100%;
        }

        .box {
            height: 100%;
        }

        .qr-button {
            cursor: pointer;
        }
    </style>
    <div class="box row w-100 p-0 m-0" style="background: #345183; align-items: center;position: relative;">
        <div x-data="{ show: false }">
            <div x-transition.duration.800ms x-show="show"
                style="position: absolute;bottom: 0;right: 0;display: flex;justify-content: end;padding: 0;">
                <div class="text-end p-5"
                    style="background: beige;border-radius: 100% 0 0 0;width:500px;height: 500px;position: relative;">
                    <div class="text-center" style="position: absolute;bottom: 70px;right: 20px;">
                        <div class="alert alert-primary" role="alert">
                            <i class="bi bi-info-circle"></i> ¡Escaneame para registrar tu entrada!
                        </div>
                        {!! QrCode::size(180)->generate(route('visitantes.index')) !!}
                    </div>
                </div>
            </div>
            <div x-on:click="show=!show" class="qr-button"
                style="position: absolute;bottom: 0px;right: 0px;display: flex;justify-content: end;padding: 0; width: 100px;height: 100px;">
                <div class="w-100" style="border-radius: 100% 0 0 0;background: #344183;border: 1px solid #2c2c2c94;">
                    <div class="w-100 h-100" style="position: relative">
                        <i class="bi bi-qr-code-scan"
                            style="font-size: 50px;color:white;position: absolute; bottom: 5px;right: 5px;"></i>
                    </div>
                </div>
            </div>

        </div>
        <div class="container text-center">
            <div class="col-12 col-md-12 col-lg-12">
                <h3 class="text-white">REGISTRO DE VISITANTES</h3>
                <img style="max-width: 167px" class="img-fluid mt-4" src="{{ $logo }}" alt="">
            </div>
            <div class="col-12 col-md-12 col-lg-12 mt-3">
                <div class="w-100 d-flex justify-content-center">
                    <cite style="max-width: 50%" class="mt-4 text-white">
                        {!! $quote->quote ?? '[<i>Insertar Cita Textual, solicita al administrador que ingrese alguna</i>]' !!}
                    </cite>
                </div>
            </div>
            @if ($existsResponsable)
                <div class="col-12 col-md-12 col-lg-12 justify-content-around d-flex justify-content-center mt-5">
                    <div class="d-flex text-white" style="justify-content: space-evenly;width: 40%;flex-wrap: wrap;">
                        <a class="mb-3 col-md-8 col-8 col-lg-3 border border-4 rounded"
                            href="{{ route('admin.visitantes.index') }}"
                            style="outline: none; color: white; cursor: pointer;text-decoration: none">

                            <i style="font-size: 50px" class="bi bi-box-arrow-right"></i>
                            <p>Registrar Entrada</p>

                        </a>
                        <a class="mb-3 col-md-8 col-8 col-lg-3 border border-4 rounded"
                            href="{{ route('visitantes.salida') }}"
                            style="outline: none; color: white; cursor: pointer;text-decoration: none">
                            <i style="font-size: 50px" class="bi bi-box-arrow-left"></i>
                            <p>Registrar Salida</p>
                        </a>
                    </div>
                </div>
            @else
                <h3 style="color: white" class="mt-4">No se ha configurado el módulo de visitantes, comunicate con el
                    administrador.</h3>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
@endsection
