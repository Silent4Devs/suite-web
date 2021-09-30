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

            <div class="col-md-12 col-sm-12">
                <div class="card vrd-agua">
                    <span class="mb-1 text-center text-">Analisis de Riesgos</span>
                </div>
            </div>

            <div class="row">
                <!-- Nombre Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-fire iconos-crear"></i>{!! Form::label('amenaza', 'Amenaza:') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-amenaza', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="archivo" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}

                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-shield-alt iconos-crear"></i>{!! Form::label('vulnerabilidad', 'Vulnerabilidad') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-vulnerabilidad', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="vulnerabilidad" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        <span class="mb-1 text-center text-">Evaluacion 360 Grados</span>
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-chess-knight iconos-crear"></i>{!! Form::label('competencia', 'Competencias') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-competencia', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="competencia" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>

                  <!-- Categoria Field -->
                  <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('evaluacion', 'Evaluaciones') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-evaluacion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="evaluacion" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        <span class="mb-1 text-center text-">Soporte</span>
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-chess-knight iconos-crear"></i>{!! Form::label('competencia', 'Capacitaciones') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-competencia', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="competencia" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>




                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        <span class="mb-1 text-center text-">Ajustes de Usuario</span>
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-user iconos-crear"></i>{!! Form::label('usuario', 'Usuario') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-usuario', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="usuario" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-user-md iconos-crear"></i>{!! Form::label('puesto', 'Puesto') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-puesto', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="puesto" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>

                 <!-- Categoria Field -->
                 <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-screwdriver iconos-crear"></i>{!! Form::label('control', 'Controles') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-control', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="control" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-cogs iconos-crear"></i>{!! Form::label('ejecutarenlace', 'Enlace a Ejecutar') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-ejecutarenlace', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="ejecutarenlace" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-users iconos-crear"></i>{!! Form::label('team', 'Team') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-team', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="team" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fab fa-stripe-s iconos-crear"></i>{!! Form::label('estadoincidente', 'Estado Incidente') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-estadoincidente', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="estadoincidente" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
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
