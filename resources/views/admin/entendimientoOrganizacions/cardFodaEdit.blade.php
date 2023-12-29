@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/foda.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
@endsection
@section('content')
<<<<<<< HEAD

=======
>>>>>>> origin/release/experiencia_usuario_s3
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="titulo_general_funcion">Matriz FODA</h5>
        <button class="btn btn-print">
            IMPRIMIR
            <i class="fa-solid fa-print"></i>
        </button>
    </div>
    <div class="card card-body shadow-sm">
        <div class="d-flex justify-content-between">
            <div>
                <h5>SILENT 4 BUSINESS</h5>
<<<<<<< HEAD
                <a class="d-inline" href="{{route('admin.entendimiento-organizacions.edit', $foda_actual)}}" style="text-decoration-line: none;">
=======
                <a class="d-inline" href="{{ route('admin.entendimiento-organizacions.edit', $foda_actual) }}"
                    style="text-decoration-line: none;">
>>>>>>> origin/release/experiencia_usuario_s3
                    <i class="material-icons" style="cursor: pointer;">edit</i>
                </a>
                <p class="d-inline">
                    SILENT 4 BUSINEntendimiento de Organización: FODA Corporativo 2023 V3ESS
                </p>
            </div>
            <img src="{{ $logo_actual }}" alt="Logo de la empresa" height="150px">
        </div>

        <div class="caja-foda">
            <div class="foda-item fi-for">
                @livewire('fortalezas-component', ['foda_id' => $foda_actual])
            </div>
            <div class="foda-item fi-deb">
                @livewire('debilidades-component', ['foda_id' => $foda_actual])
            </div>
            <div class="foda-item fi-opo">
                @livewire('oportunidades-component', ['foda_id' => $foda_actual])
            </div>
            <div class="foda-item fi-ame">
                @livewire('amenazas-component', ['foda_id' => $foda_actual])
            </div>
        </div>

    </div>

<<<<<<< HEAD
    <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-center">
            <button type="button" class="btn btn-light" style="border-color: #057BE2; color:#057BE2">Solicitar aprobación</button>
        </div>
    </div>

=======
    <form method="POST" action="{{ route('admin.foda-organizacions.solicitudAprobacion', $foda_actual) }}">
        @csrf
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-center">
                <button type="submit" class="btn btn-light" style="border-color: #057BE2; color:#057BE2">Solicitar
                    aprobación</button>
            </div>
        </div>
    </form>
>>>>>>> origin/release/experiencia_usuario_s3
@endsection


@section('scripts')
<<<<<<< HEAD
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
=======
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
>>>>>>> origin/release/experiencia_usuario_s3
@endsection
