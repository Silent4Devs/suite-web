@extends('layouts.visitantes')

@section('content')
    @if ($existsResponsable)
        @include('visitantes.registro-visitantes.modal-aviso-privacidad')
        @livewire('visitantes.registro-visitantes')
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var avisoPrivacidadVisitantesBtn = document.getElementById('avisoPrivacidadVisitantesBtn');
            avisoPrivacidadVisitantesBtn.click();
        });
    </script>
@endsection
