@extends('layouts.admin')

@section('content')
@section('titulo', 'Actualizar Requisicion')
<link rel="stylesheet" href="{{ asset('css/requisitions/requisitions.css') }}{{ config('app.cssVersion') }}">
<link rel="stylesheet" href="{{ asset('css/requisitions/jquery.signature.css') }}{{ config('app.cssVersion') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/global/tbButtons.css') }}">
<style>
    .pulse-0 {
        animation: pulse-animation-0 2s infinite;
    }

    @keyframes pulse-animation-0 {
        0% {
            box-shadow: 0 0 0 0px #FF0000;
        }

        100% {
            box-shadow: 0 0 0 20px rgba(0, 0, 0, 0);
        }
    }
</style>

{{-- <div class="card card-body">
    <h4>Tienes
        @if ($contadorEdit == 3 || $contadorEdit == 2)
            <div style="width: 100px;" class="pulse">{{ $contadorEdit }}</div>
        @elseif ($contadorEdit == 1)
            <span class="badge badge-pill badge-warning">{{ $contadorEdit }}</span>
        @else
            <span class="badge badge-pill badge-danger">{{ $contadorEdit }}</span>
        @endif
        ediciones disponibles:
    </h4>
</div> --}}
{{-- @dump($contadorEdit) --}}
@if ($contadorEdit > 0)

    @livewire('requisiciones-edit-component', ['id_requisiciondata' => $id, 'contadorEdit' => $contadorEdit])

    @livewire('tabla-historico-requisiciones', ['idReq' => $id])

@else
    <div class="card pulse-0" style="width: 156px; height: 68px;">
        <div class="card-body d-flex flex-column align-items-center">
            <p class="mb-0" style="font-size:12px; color:#4870B2;">Ediciones disponibles</p>
            <div class="card" style="width: 43px; height: 23px; margin-top:7px;">
                <div class="card-body d-flex justify-content-center align-items-center"
                    style="padding:0px; background-color:#FF0000; border-radius:16px;">
                    <p class="mb-0" style="font-size:12px; color:#FFFFFF;">{{ $contadorEdit }}</p>
                </div>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 350px;">
            <div class="card-body d-flex jsutify-content-center flex-column align-items-center" st>
                <div style="height: 200px;">
                    <img src="{{ asset('img/welcome-blue.svg') }}" style="height: 100%;width:100%;" alt="Apoyo">
                </div>

                <div class="d-flex justify-content-center align-items-center flex-column">
                    <h5 style="font-size: 22px; font-weight: bolder; color: #474c6c;">
                        Acceso Restringido
                    </h5>
                    <p>
                        Ha alcanzado el limite de ediciones para esta Requisición.
                    </p>
                    <a href="{{ route('contract_manager.requisiciones') }}" class="btn tb-btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
    </div>


@endif
@endsection
