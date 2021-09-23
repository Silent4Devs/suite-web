@extends('layouts.admin')

@section('content')


    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.amenazas.index') !!}">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Carga de Documentos</li>
    </ol>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Cargar Documentos </strong></h3>
        </div>
        <div class="card-body">

            <div class="row">
                <!-- Nombre Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-fire iconos-crear"></i>{!! Form::label('amenaza', 'Amenaza:') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-amenaza', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="archivo" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Decargar Formato</button>
                        {!! Form::close() !!}

                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-shield-alt iconos-crear"></i>{!! Form::label('vulnerabilidades', 'Vulnerabilidades') !!}
                    <div>
                        <input class="btn btn-primary btn-sm" type="file" name="file">
                        <button class="btn btn-secondary btn-sm">Decargar Formato</button>
                    </div>
                </div>

                <!-- Descripcion Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Descripción:') !!}
                    <div>
                        <input class="btn btn-primary btn-sm" type="file" name="file">
                        <button class="btn btn-secondary btn-sm">Decargar Formato</button>
                    </div>
                </div>

                <!-- Submit Field -->
               <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>


        </div>
    </div>
@endsection
