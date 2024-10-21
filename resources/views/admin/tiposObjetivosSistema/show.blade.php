@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Tipos de Objetivos de Sistema</h5>

    <div class="form-group text-end">
        <a class="btn btn-outline-primary" href="{{ route('admin.objetivosseguridads.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <div class="card card-body">
        <div class="form-group">
            <label for="">Nombre</label>
            <div class="form-control">
                {{ $tiposObjetivosSistema->nombre }}
            </div>
        </div>
        <div class="form-group">
            <label for="">Descripción</label>
            <div class="form-control">
                {!! $tiposObjetivosSistema->descripcion ?? 'Sin descripción' !!}
            </div>
        </div>
    </div>
@endsection
