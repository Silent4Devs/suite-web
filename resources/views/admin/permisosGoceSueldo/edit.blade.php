@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}{{config('app.cssVersion')}}">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">Editar: Lineamiento</h5>
    {!! Form::model($vacacion, [
        'route' => ['admin.permisos-goce-sueldo.update', $vacacion->id],
        'method' => 'patch',
    ]) !!}
    <div class="mt-4 card card-body">

        @include('admin.permisosGoceSueldo.fields')

    </div>
    <!-- Submit Field -->
    <div class="row">
        <div class="text-right form-group col-12">
            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
