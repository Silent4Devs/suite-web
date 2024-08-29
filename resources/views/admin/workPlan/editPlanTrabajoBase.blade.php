@extends('layouts.admin')
@section('content')
    {{-- @can('planes_accion_create') --}}
    <h5 class="col-12 titulo_general_funcion">Editar - {{ $planImplementacion->parent }} {{ $planImplementacion->norma }}
    </h5>
    <div class="mt-4 card">
        <div class="card-body">
            @can('planes_de_accion_editar')
                <form method="POST" action="{{ route('admin.planTrabajoBase.update', $planImplementacion) }}">
                    @csrf
                    @method('PATCH')
                    @include('admin.workPlan._form', ['edit' => true, 'esPlanTrabajoBase' => true])
                    <div class="d-flex justify-content-end">
                        <a class="mr-2 btn_cancelar" href="{{ route('admin.planTrabajoBase.index') }}">Cancelar</a>
                        <input type="submit" class="btn btn-danger" value="Editar">
                    </div>
                </form>
            @endcan
        </div>
    </div>
    {{-- @endcan --}}
@endsection
