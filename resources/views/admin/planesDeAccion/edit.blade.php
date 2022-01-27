@extends('layouts.admin')
@section('content')
    {{-- @can('planes_accion_create') --}}
    <h5 class="col-12 titulo_general_funcion">Editar - {{ $planImplementacion->parent }} {{$planImplementacion->norma}} </h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.planes-de-accion.update', $planImplementacion) }}">
                @csrf
                @method('PATCH')
                @include('admin.planesDeAccion._form',['edit'=>true])
                <div class="d-flex justify-content-end">
                    <a class="mr-2 btn_cancelar" href="{{ route('admin.planes-de-accion.index') }}">Cancelar</a>
                    <input type="submit" class="btn btn-danger" value="Editar">
                </div>
            </form>
        </div>
    </div>
    {{-- @endcan --}}
@endsection
