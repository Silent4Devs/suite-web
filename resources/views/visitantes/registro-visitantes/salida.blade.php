@extends('layouts.visitantes')

@section('content')
    @if ($existsResponsable)
        <div class="p-5" style="background: #f1f1f1">
            @livewire('visitantes.registrar-salida')
        </div>
    @else
        <div class="text-center w-100 pt-5">
            <h3>No se ha configurado el módulo de visitantes, comunicate con el
                administrador.</h3>
            <img class="img-fluid" src="{{ asset('img/mensaje2.png') }}" alt="">
        </div>
    @endif
@endsection
@section('scripts')
    @parent
@endsection
