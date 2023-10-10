@extends('layouts.admin')

@section('content')

@include('partials.flashMessages')

    <style type="text/css">
        .caja_btn_input{
            display: flex;
        }
        .caja_btn_input form{
            display: flex;
        }
        .btn_cargar{
            border-radius: 100px;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
        }
        .btn_cargar:hover{
            color: #fff;
            background:#345183 ;
        }
        .btn_cargar i{
            font-size: 15pt;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input.btn.btn-sm{
            font-size: 8pt !important;
            background-color: rgba(0, 0, 0, 0) !important;
        }
    </style>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.amenazas.index') !!}">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Carga de Documentos</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Carga de Documentos</h5>

    <div class="mt-4 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Cargar Documentos </strong></h3>
        </div> --}}
        <div class="card-body">

            <div class="py-1 form-group col-12" style="border-bottom:2px solid #345183; color: #345183; font-weight: bold;">Análisis de Riesgos</div>


            <div class="row">
                <!-- Nombre Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-fire iconos-crear"></i>{!! Form::label('amenaza', 'Amenaza') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-amenaza', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="archivo" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload "></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-amenaza', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}

                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-shield-alt iconos-crear"></i>{!! Form::label('vulnerabilidad', 'Vulnerabilidad') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-vulnerabilidad', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="vulnerabilidad" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-vulnerabilidad', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-shield-alt iconos-crear"></i>{!! Form::label('analisis_riego', 'Analisis Riego') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-analisis_riego', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="analisis_riego" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-analisis_riego', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>

                {{-- <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        <span class="mb-1 text-center text-">Evaluación 360 Grados</span>
                    </div>
                </div> --}}

                <!-- Categoria Field -->
                {{-- <div class="form-group col-sm-6">
                    <i class="fas fa-chess-knight iconos-crear"></i>{!! Form::label('competencia', 'Competencias') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-competencia', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="competencia" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                  <!-- Categoria Field -->
                {{-- <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('evaluacion', 'Evaluaciones') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-evaluacion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="evaluacion" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                <div class="py-1 form-group col-12" style="border-bottom:2px solid #345183; color: #345183; font-weight: bold; margin-top: 25px;">ISO 27001 | Contexto</div>


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-chess-knight iconos-crear"></i>{!! Form::label('partes_interesadas', 'Partes Interesadas') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-partes_interesadas', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="partes_interesadas" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-partes_interesadas', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {{-- {!! Form::button('<i class="fas fa-download"></i>', ['class' => 'btn btn_cargar', 'title' => 'Descargar documento']) !!} --}}
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                {{-- <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('matriz_requisitos_legales', 'Matriz de Requisitos Legales') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-matriz_requisitos_legales', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="matriz_requisitos_legales" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-matriz_requisitos_legales', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::button('<i class="fas fa-download"></i>', ['class' => 'btn btn_cargar', 'title' => 'Descargar documento']) !!}
                        {!! Form::close() !!}
                    </div>
                </div> --}}
                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('foda', 'Foda') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-foda', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="foda" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-foda', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('determinacion_alcance', 'Determinación Alcance') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-determinacion_alcance', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="determinacion_alcance" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-determinacion_alcance', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>



                <div class="py-1 form-group col-12" style="border-bottom:2px solid #345183; color: #345183; font-weight: bold; margin-top: 25px;">ISO 27001 | Liderazgo</div>


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('comite_seguridad', 'Conformación del comité de seguridad') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-comite_seguridad', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="comite_seguridad" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-comite_seguridad', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {{-- {!! Form::button('<i class="fas fa-download"></i>', ['class' => 'btn btn_cargar', 'title' => 'Descargar documento']) !!} --}}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="form-group col-sm-6"><i class="fas fa-tasks iconos-crear"></i>{!! Form::label('alta_direccion', 'Minutas Alta Dirección') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-alta_direccion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="alta_direccion" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-alta_direccion', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>

                {{-- <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('evidencia_recursos', 'Evidencia de asignación de recursos') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-evidencia_recursos', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="evidencia_recursos" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('politica_sgi', 'Politica del SGI') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-politica_sgi', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="politica_sgi" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-politica_sgi', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>



                <div class="py-1 form-group col-12" style="border-bottom:2px solid #345183; color: #345183; font-weight: bold; margin-top: 25px;">Soporte</div>


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                     <i class="fas fa-chalkboard-teacher iconos-crear"></i>{!! Form::label('categoriacapacitacion', 'Conocimientos') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-categoriacapacitacion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="categoriacapacitacion" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-categoriacapacitacion', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        {{-- <span class="mb-1 text-center text-">Evaluaciones</span> --}}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-chess-knight iconos-crear"></i>{!! Form::label('revisiondireccion', 'Revisión por Dirección') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-revisiondireccion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="revisiondireccion" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-revisiondireccion', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>



                <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">Activos</div>



                {{-- <div class="py-1 form-group col-12" 12yle="border-bottom:2px solid #345183; color: #345183; font-weight: bold; margin-top: 25px;">Activos</div> --}}

{{-- pendiente da error de ruta 06/01--}}
                <!-- Categoria Field -->
                {{-- <div class="form-group col-sm-6">
                    <i class="ml-2 fas fa-layer-group iconos-crear"></i>{!! Form::label('categoria', 'Categoría') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-categoria', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="categoria" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-categoria', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::button('<i class="fas fa-download"></i>', ['class' => 'btn btn_cargar', 'title' => 'Descargar documento']) !!}
                        {!! Form::close() !!}
                    </div>
                </div> --}}



                <div class="py-1 form-group col-12" style="border-bottom:2px solid #345183; color: #345183; font-weight: bold; margin-top: 25px;">Ajustes de Usuario</div>


                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-user iconos-crear"></i>{!! Form::label('usuario', 'Usuario') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-usuario', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="usuario" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-user-md iconos-crear"></i>{!! Form::label('puesto', 'Puesto') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-puesto', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="puesto" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-puesto', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>

                 <!-- Categoria Field -->
                 <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-screwdriver iconos-crear"></i>{!! Form::label('control', 'Controles') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-control', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="control" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {{-- <button class="btn btn-secondary btn-sm">Descargar Formato</button> --}}
                        {!! Form::close() !!}
                    </div>
                </div>

                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-cogs iconos-crear"></i>{!! Form::label('ejecutarenlace', 'Enlace a Ejecutar') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-ejecutarenlace', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="ejecutarenlace" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-users iconos-crear"></i>{!! Form::label('team', 'Team') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-team', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="team" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fab fa-stripe-s iconos-crear"></i>{!! Form::label('estadoincidente', 'Estado Incidente') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-estadoincidente', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="estadoincidente" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                     <i class="fa-fw fas fa-briefcase iconos-crear"></i>{!! Form::label('roles', 'Roles') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-roles', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="role" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-roles', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>



                {{-- <div class="py-1 form-group col-12" 12yle="border-bottom:2px solid #345183; color: #345183; font-weight: bold; margin-top: 25px;">Preguntas Frecuentes</div> --}}


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-briefcase iconos-crear"></i>{!! Form::label('faqcategoria', 'Categoría') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-faqcategoria', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="faqcategoria" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn_cargar', 'title' => 'Cargar documento']) !!} --}}
                        {{-- <button class="btn btn-secondary btn-sm">Descargar Formato</button> --}}
                        {!! Form::close() !!}
                    </div>
                </div>

                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-question iconos-crear"></i>{!! Form::label('faqpregunta', 'Preguntas') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-faqpregunta', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="faqpregunta" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}


                <div class="py-1 form-group col-12" style="border-bottom:2px solid #345183; color: #345183; font-weight: bold; margin-top: 25px;">Configuración de datos</div>


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-puzzle-piece iconos_menu iconos-crear"></i>{!! Form::label('grupo_area', 'Áreas/Crear grupo') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-grupo_area', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="grupo_area" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-grupo_area', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
                {{-- <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-question iconos-crear"></i>{!! Form::label('documentos', 'Documentos/Crear documetos') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-grupo_area', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="documentos" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-question iconos-crear"></i>{!! Form::label('datos_area', 'Áreas/Crear área') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-datos_area', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="datos_area" required>
                        {!! Form::button('<i class="fas fa-file-upload"></i>', ['class' => 'btn btn-primary, class' title 'btn btnCargar documentoy']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <i class="fas fa-user-tie iconos-crear"></i>{!! Form::label('empleado', 'Empleado') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-empleado', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="empleado" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-empleado', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-laptop iconos-crear"></i>{!! Form::label('activo_inventario', 'Activos/Inventario') !!}
                    <div class="caja_btn_input">
                        {!! Form::open(['route' => 'carga-activo_inventario', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" id="csv_file" name="activo_inventario" required>
                        <button id="btn_importar" class="btn btn_importar btn_cargar" title="Cargar documento"><i class="fas fa-file-upload"></i></button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-activo_inventario', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        <button id="btn_exportar" class="btn btn_importar btn_cargar" title="Descargar documento"><i class="fas fa-download"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>

document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn_importar').addEventListener('click', async function(e) {
            e.preventDefault();

            const formData = new FormData();
            const archivos = document.getElementById('csv_file').files;
            archivos.forEach(element => {
                formData.append('archivo', element);
            });
                const response = await importar(formData)
            }
        });
    })

    async function importar(formData) {
        const url = "{{ route('carga-amenaza') }}";
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            })
            const data = await response.json();
            return data;
    }


</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btn_exportar').addEventListener('click', async function(e) {
                e.preventDefault();
                    const response = await exportar(formData, "{{ route('descarga-amenaza') }}")
                    const response = await exportar(formData, "{{ route('descarga-vulnerabilidad') }}")
                    const response = await exportar(formData, "{{ route('descarga-analisis_riego') }}")
                    const response = await exportar(formData, "{{ route('descarga-partes_interesadas') }}")
                    const response = await exportar(formData, "{{ route('descarga-matriz_requisitos_legales') }}")
                    const response = await exportar(formData, "{{ route('descarga-foda') }}")
                    const response = await exportar(formData, "{{ route('descarga-determinacion_alcance') }}")
                    const response = await exportar(formData, "{{ route('descarga-comite_seguridad') }}")
                    const response = await exportar(formData, "{{ route('descarga-alta_direccion') }}")
                    const response = await exportar(formData, "{{ route('descarga-categoriacapacitacion') }}")
                    const response = await exportar(formData, "{{ route('descarga-revisiondireccion') }}")
                    const response = await exportar(formData, "{{ route('descarga-puesto') }}")
                    const response = await exportar(formData, "{{ route('descarga-politica_sgi') }}")
                    const response = await exportar(formData, "{{ route('descarga-grupo_area') }}")
                    const response = await exportar(formData, "{{ route('descarga-empleado') }}")
                    const response = await exportar(formData, "{{ route('descarga-activo_inventario') }}")
                }
            });
        })
        async function exportar(formData, url) {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            })
            const data = await response.json();
            return data;
    }

</script>
