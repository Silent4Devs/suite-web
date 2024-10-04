@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisis-impacto.menu-BIA') !!}">BIA</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisis-impacto.index') !!}">Cuestionario</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Registrar: Cuestionario de Análisis de Impacto BIA</h5>
    <div class="mt-4 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Amenaza</h3>
        </div> --}}
        <div class="card-body">
            {!! Form::open(['route' => 'admin.analisis-impacto.store']) !!}

            @include('admin.analysisImpact.fields')

            <!-- Submit Field -->
            <div class="row">
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.analisis-impacto.index') }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </div>


            {!! Form::close() !!}
        </div>
    </div>
@endsection
