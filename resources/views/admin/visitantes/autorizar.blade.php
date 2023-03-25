@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Autorizar Salidas</h5>
    <div class="mt-5 card">
        <div class="card-body">
            @if ($existsResponsable)
                @livewire('visitantes.bitacora-accesos', ['tipoVista' => 'autorizar']);
            @else
                <div class="text-center w-100 pt-5">
                    <h3>No se ha configurado el módulo de visitantes, comunicate con el
                        administrador.</h3>
                    <img class="img-fluid" src="{{ asset('img/mensaje2.png') }}" alt="">
                </div>
            @endif
        </div>
        <div class="row p-4">
            <div class="col-12" style="text-align: end">
                <a href="{{ route('admin.visitantes.menu') }}" class="btn btn-success">Regresar</a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
