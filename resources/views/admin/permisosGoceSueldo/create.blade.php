@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Lineamientos para Permisos</h5>

    <form action="{{ route('admin.permisos-goce-sueldo.store') }}" method="POST">
        @csrf
        <div class="mt-4 card card-body">

            @include('admin.permisosGoceSueldo.fields')

        </div>

        <!-- Submit Field -->
        <div class="row">
            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
    </form>

@endsection
