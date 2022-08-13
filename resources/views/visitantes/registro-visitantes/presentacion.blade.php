@extends('layouts.visitantes')
@section('content')
    <style>
        html,
        body {
            margin: 0px;
            height: 100%;
        }

        .box {
            background: red;
            height: 100%;
        }
    </style>
    <div class="box d-flex" style="background: #345183; align-items: center">
        <div class="container text-center">
            <h2 class="text-white">REGISTRO DE VISITANTES</h2>
            <img style="max-width: 167px" class="img-fluid mt-4" src="{{ asset('assets/silent4business_blanco@2x.png') }}"
                alt="">
            <div class="w-100 d-flex justify-content-center">

                <cite style="max-width: 65%" class="mt-4 text-white">Lorem ipsum dolor sit amet consectetur adipisicing
                    elit.
                    Necessitatibus consequuntur
                    iusto eaque tempore
                    praesentium labore sunt harum animi? Nemo dicta illum deserunt minima dolor facere error accusamus
                    voluptas
                    adipisci in!</cite>
            </div>
            <div class="w-100 d-flex justify-content-center mt-4">
                <div class="d-flex text-white" style="justify-content: space-between; width: 10%; font-size: 25px">
                    <i class="bi bi-person-circle"></i>
                    <i class="bi bi-camera"></i>
                    <i class="bi bi-card-heading"></i>
                </div>
            </div>
            <div class="w-100 d-flex justify-content-center mt-4">
                <div class="d-flex text-white" style="justify-content: space-between; width: 40%;">
                    <a class="border rounded" href="{{ route('visitantes.index') }}"
                        style="width: 45%;outline: none; color: white; cursor: pointer;text-decoration: none">
                        <i style="font-size: 50px" class="bi bi-box-arrow-right"></i>
                        <p>Registrar Entrada</p>
                    </a>
                    <a class="border rounded" href="{{ route('visitantes.salida') }}"
                        style="width: 45%;outline: none; color: white; cursor: pointer;text-decoration: none">
                        <i style="font-size: 50px" class="bi bi-box-arrow-left"></i>
                        <p>Registrar Salida</p>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
@endsection
