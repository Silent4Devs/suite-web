@extends('layouts.admin')
@section('content')
    {{-- @can('planes_accion_create') --}}
    <h5 class="col-12 titulo_general_funcion">Crear Plan de Acción</h5>
    <div class="pb-4 mt-5 card">
        <div class="container">
            <form method="POST" action="{{ $urlStore }}">
                @csrf
                @include('admin.planesDeAccion._form',['edit'=>false])
                <div class="d-flex justify-content-end">
                    <a class="mr-2 btn_cancelar" href="{{ route('admin.planes-de-accion.index') }}">Cancelar</a>
                    <input type="submit" class="btn btn-danger" value="Guardar">
                </div>
            </form>
        </div>
    </div>
    {{-- @endcan --}}
@endsection
@section('scripts')
    @parent
    <script>

    </script>
@endsection
