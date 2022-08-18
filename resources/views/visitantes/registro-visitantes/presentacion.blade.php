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
    </style>
    <div class="box row w-100 p-0 m-0" style="background: #345183; align-items: center">
        <div class="container text-center">
            <div class="col-12 col-md-12 col-lg-12">
                <h3 class="text-white">REGISTRO DE VISITANTES</h3>
                <img style="max-width: 167px" class="img-fluid mt-4" src="{{ asset('assets/silent4business_blanco@2x.png') }}"
                    alt="">
            </div>
            <div class="col-12 col-md-12 col-lg-12 mt-3">
                <div class="w-100 d-flex justify-content-center">
                    <cite style="max-width: 50%" class="mt-4 text-white">
                        {!! $quote->quote !!}
                    </cite>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 justify-content-around d-flex justify-content-center mt-5">
                <div class="d-flex text-white" style="justify-content: space-evenly;width: 40%;flex-wrap: wrap;">
                    <div class="mb-3 col-md-8 col-8 col-lg-3 border border-4 rounded">
                        <a class="" href="{{ route('visitantes.index') }}"
                            style="outline: none; color: white; cursor: pointer;text-decoration: none">
                            <i style="font-size: 50px" class="bi bi-box-arrow-right"></i>
                            <p>Registrar Entrada</p>
                        </a>
                    </div>
                    <div class="mb-3 col-md-8 col-8 col-lg-3 border border-4 rounded">
                        <a class="" href="{{ route('visitantes.salida') }}"
                            style="outline: none; color: white; cursor: pointer;text-decoration: none">
                            <i style="font-size: 50px" class="bi bi-box-arrow-left"></i>
                            <p>Registrar Salida</p>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
@endsection
