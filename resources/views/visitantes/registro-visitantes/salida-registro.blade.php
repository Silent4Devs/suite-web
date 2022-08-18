@extends('layouts.visitantes')

@section('content')
    <div class="row m-0">
        <div class="col-2"></div>
        <div class="col-8 py-4">
            @livewire('visitantes.registrar-salida-visitante', ['visitante' => $visitante, 'tipo' => 'full'])
        </div>
        <div class="col-2"></div>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    </div>
@endsection
