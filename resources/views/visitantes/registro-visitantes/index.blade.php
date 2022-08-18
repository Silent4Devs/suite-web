@extends('layouts.visitantes')

@section('content')
    @include('visitantes.registro-visitantes.modal-aviso-privacidad')
    @livewire('visitantes.registro-visitantes')
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
