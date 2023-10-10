@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Bitácora de Visitantes</h5>
    <div class="card rounded">
        <div class="card-body">
            @if ($existsResponsable)
                @livewire('visitantes.bitacora-accesos')
            @else
                <div class="text-center w-100 pt-5">
                    <h3>No se ha configurado el módulo de visitantes, comunicate con el
                        administrador.</h3>
                    <img class="img-fluid" src="{{ asset('img/mensaje2.png') }}" alt="">
                </div>
            @endif

        </div>
        <div class="row p-4 print-none">
            <div class="col-12" style="text-align: end">
                <a href="{{ route('admin.visitantes.menu') }}" class="btn btn-success">Regresar</a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
