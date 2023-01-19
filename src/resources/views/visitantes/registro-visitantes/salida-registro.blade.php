@extends('layouts.visitantes')

@section('content')
    <div class="row m-0">
        <div class="col-2"></div>
        <div class="col-8 py-4">
            @if ($existsResponsable)
                @if ($visitante->registro_salida)
                    <div class="text-center w-100">
                        <h3>Su salida ya ha sido registrada con éxito</h3>
                        <img class="img-fluid" src="{{ asset('img/mensaje2.png') }}" alt="">
                    </div>
                @else
                    @livewire('visitantes.registrar-salida-visitante', ['visitante' => $visitante, 'tipo' => 'full'])
                @endif
            @else
                <div class="text-center w-100 pt-5">
                    <h3>No se ha configurado el módulo de visitantes, comunicate con el
                        administrador.</h3>
                    <img class="img-fluid" src="{{ asset('img/mensaje2.png') }}" alt="">
                </div>
            @endif
        </div>
        <div class="col-2"></div>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    </div>
@endsection
