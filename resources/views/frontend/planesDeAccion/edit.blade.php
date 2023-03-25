@extends('layouts.admin')
@section('content')
    {{-- @can('planes_accion_create') --}}
    <div class="pb-4 mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Editar -
                    {{ $planImplementacion->parent }}</strong></h3>
        </div>
        <div class="container">
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
@section('scripts')
    @parent
    <script>

    </script>
@endsection
