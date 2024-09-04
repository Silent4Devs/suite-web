@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/foda/print.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/foda/foda.css') }}{{ config('app.cssVersion') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="titulo_general_funcion">Matriz FODA</h5>
        {{-- <button class="btn btn-print">
            IMPRIMIR
            <i class="fa-solid fa-print"></i>
        </button> --}}
    </div>
    <div class="card card-body shadow-sm">
        <div class="d-flex justify-content-between">
            <div>
                <h5>{{ $empresa_actual }}</h5>
                <p class="d-inline">
                    Entendimiento de la Organización: {{ $obtener_FODA->analisis }}
                </p>
                <a class="d-inline" href="{{ route('admin.entendimiento-organizacions.edit', $foda_actual) }}"
                    style="text-decoration-line: none;">
                    <i class="material-icons ml-3" style="cursor: pointer;">edit</i>
                </a>
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
            <div class="foda-title-midel">
                <small>Análisis</small>
                <h3>FODA</h3>
            </div>
            <div class="foda-item fi-opo">
                @livewire('oportunidades-component', ['foda_id' => $foda_actual])
            </div>
            <div class="foda-item fi-ame">
                @livewire('amenazas-component', ['foda_id' => $foda_actual])
            </div>
        </div>

    </div>

    <form method="POST" action="{{ route('admin.foda-organizacions.solicitudAprobacion', $foda_actual) }}">
        @csrf
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-center">
                <button type="submit" class="btn btn-light" style="border-color: #057BE2; color:#057BE2">Solicitar
                    aprobación</button>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script>
        let caja = document.querySelector('.caja-foda').getBoundingClientRect().height;
        let firstItem = document.querySelector('.fi-for').getBoundingClientRect().height;

        let calc = (firstItem * 100) / caja;

        document.querySelector('.foda-title-midel').style.top = calc + '%';
    </script>
@endsection
