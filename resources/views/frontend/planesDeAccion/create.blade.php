@extends('layouts.frontend')
@section('content')
    {{-- @can('planes_accion_create') --}}
    <div class="pb-4 mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Crear Plan de Acción </strong></h3>
        </div>
        <div class="container">
            <form method="POST" action="{{ $urlStore }}">
                @csrf
                @include('frontend.planesDeAccion._form',['edit'=>false])
                <div class="d-flex justify-content-end">
                    <a class="mr-2 btn_cancelar" href="{{ route('planes-de-accion.index') }}">Cancelar</a>
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
