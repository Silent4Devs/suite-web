@extends('layouts.admin')
@section('css')
    @vite(['public/css/escuela/certificados.css'])
@endsection
@section('content')
    <h5 class=" titulo_general_funcion">Mis Logros</h5>

    <h6>Mis Certificaciones</h6>

    @foreach ($cursosUser as $cursoUser)
        @if ($cursoUser->completado == 100 && $cursoUser->curso->certificado)
            <div class="card card-body mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <img src="{{ asset('img/escuela/cert-draw.png') }}" alt="">
                        <div>
                            <strong>{{ $cursoUser->curso->title }}</strong> <br>
                            {{ $cursoUser->curso->subtitle }}
                        </div>
                    </div>
                    <button class="btn btn-outline-primary"
                        onclick="imprimirElemento('certificado-{{ $cursoUser->curso->id }}');">Descargar
                        certificado</button>
                </div>
            </div>

            <div id="certificado-{{ $cursoUser->curso->id }}" class="solo-print">
                <img src="{{ $cursoUser->curso->certificado_ruta }}" class="certificado-img" alt="">
                <div class="content-certificado">
                    <div class="curso-title">
                        <span>{{ $cursoUser->curso->title }}</span>
                    </div>
                    <div class="estudiante-name">
                        <strong>{{ $user->empleado->name }}</strong>
                    </div>
                    <div class="firma-fecha">
                        <div class="firma-instructor {{ $cursoUser->curso->firma_habilitar ? '' : 'sin-firma' }}">
                            @if ($cursoUser->curso->firma_habilitar)
                                <img src="{{ $cursoUser->curso->firma_instructor }}" alt="" style="width: 100%;">
                            @endif
                        </div>
                        <div class="fecha-certificado">
                            {{ Carbon\Carbon::parse($cursoUser->curso->created_at)->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
