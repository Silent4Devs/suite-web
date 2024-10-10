@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/listadistribucion.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    @include('admin.listadistribucion.estilos')

    <div class="card instrucciones">
        <div class="">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('politicas.png') }}" class="imgdoc" alt="">
                </div>
                <div class="col-10" style="position: relative; top: 3rem;">
                    <h5>Crea tu propio grupo de distribución de correo</h6>
                        <p>En esta sección puedes generar las listas de distribucion de correos, agruparlas y darles el
                            nivel
                            de prioridad para ser administradas conforme a su nivel asignado.</p>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.lista-distribucion.update', [$lista->id]) }}">
        @csrf
        @if ($tipo == 'flujoAprobacion')
            @include('admin.listadistribucion.flujoAprobacion')
        @elseif ($tipo == 'suplentesLideres')
            @include('admin.listadistribucion.lideresSuplentes')
        @elseif ($tipo == 'responsablesFijos')
            @include('admin.listadistribucion.responsablesFijos')
        @elseif ($tipo == 'suplentes')
            @include('admin.listadistribucion.suplentes')
        @endif
        <div class="col-12">
            <div style="position: relative; text-align:end;">
                <a href="{{ route('admin.lista-distribucion.index') }}" type="button" class="btn tb-btn-primary"
                    id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
                <button type="submit" class="btn tb-btn-primary" style="width: 8rem;">Editar</button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    @if ($tipo == 'flujoAprobacion')
        @include('admin.listadistribucion.scriptsflujoAprobacion')
    @elseif ($tipo == 'suplentesLideres')
        @include('admin.listadistribucion.scriptslideresSuplentes')
    @elseif ($tipo == 'responsablesFijos')
        @include('admin.listadistribucion.scriptsresponsablesFijos')
    @elseif ($tipo == 'suplentes')
        @include('admin.listadistribucion.scriptsSuplentes')
    @endif
@endsection
