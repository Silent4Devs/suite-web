@extends('layouts.admin')

@section('content')

@include('partials.flashMessages')

    <style type="text/css">
        .btn_cargar{
            border-radius: 100px;
            border: 1px solid #00abb2;
            color: #00abb2;
        }
        .btn_cargar:hover{
            color: #fff;
            background:#00abb2 ;
        }
    </style>

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

            <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">Análisis de Riesgos</div>


            <div class="row">
                <!-- Nombre Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-fire iconos-crear"></i>{!! Form::label('amenaza', 'Amenaza') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-amenaza', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="archivo" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn btn_cargar']) !!}
                        {{-- <button class="btn btn-secondary btn-sm">Descargar Formato</button> --}}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-amenaza', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}

                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-shield-alt iconos-crear"></i>{!! Form::label('vulnerabilidad', 'Vulnerabilidad') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-vulnerabilidad', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="vulnerabilidad" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-vulnerabilidad', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-shield-alt iconos-crear"></i>{!! Form::label('analisis_riego', 'Analisis Riego') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-analisis_riego', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="analisis_riego" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-analisis_riego', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
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
                    <div>
                        {!! Form::open(['route' => 'carga-competencia', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="competencia" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                  <!-- Categoria Field -->
                {{-- <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('evaluacion', 'Evaluaciones') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-evaluacion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="evaluacion" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}




                <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">ISO 27001 | Contexto</div>


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-chess-knight iconos-crear"></i>{!! Form::label('partes_interesadas', 'Partes Interesadas') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-partes_interesadas', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="partes_interesadas" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-partes_interesadas', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('matriz_requisitos_legales', 'Matriz de Requisitos Legales') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-matriz_requisitos_legales', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn tn-sm" type="file" name="matriz_requisitos_legales" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-matriz_requisitos_legales', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('foda', 'Foda') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-foda', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="foda" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-foda', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('determinacion_alcance', 'Determinación Alcance') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-determinacion_alcance', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn tn-sm" type="file" name="determinacion_alcance" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-determinacion_alcance', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>



                <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">ISO 27001 | Liderazgo</div>


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('comite_seguridad', 'Conformación del comité de seguridad') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-comite_seguridad', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="comite_seguridad" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-comite_seguridad', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="form-group col-sm-6"><i class="fas fa-tasks iconos-crear"></i>{!! Form::label('alta_direccion', 'Minutas Alta Dirección') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-alta_direccion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="alta_direccion" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-alta_direccion', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                {{-- <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('evidencia_recursos', 'Evidencia de asignación de recursos') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-evidencia_recursos', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="evidencia_recursos" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                <div class="form-group col-sm-6">
                    <i class="fas fa-vote-yea iconos-crear"></i>{!! Form::label('politica_sgi', 'Politica del SGI') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-politica_sgi', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="politica_sgi" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn btn_cargar']) !!}
                        {{-- <button class="btn btn-secondary btn-sm">Descargar Formato</button> --}}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-politica_sgi', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>



                <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">Soporte</div>


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                     <i class="fas fa-chalkboard-teacher iconos-crear"></i>{!! Form::label('categoriacapacitacion', 'Conocimientos') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-categoriacapacitacion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="categoriacapacitacion" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-categoriacapacitacion', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-chess-knight iconos-crear"></i>{!! Form::label('revisiondireccion', 'Revisión por Dirección') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-revisiondireccion', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="revisiondireccion" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-revisiondireccion', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        {{-- <span class="mb-1 text-center text-">Evaluaciones</span> --}}
                    </div>
                </div>





                {{-- <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">Activos</div> --}}


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="ml-2 fas fa-layer-group iconos-crear"></i>{!! Form::label('categoria', 'Categoría') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-categoria', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="categoria" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-categoria', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>



                <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">Ajustes de Usuario</div>


                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-user iconos-crear"></i>{!! Form::label('usuario', 'Usuario') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-usuario', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="usuario" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-user-md iconos-crear"></i>{!! Form::label('puesto', 'Puesto') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-puesto', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="puesto" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-puesto', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>


                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-cogs iconos-crear"></i>{!! Form::label('ejecutarenlace', 'Enlace a Ejecutar') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-ejecutarenlace', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="ejecutarenlace" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-users iconos-crear"></i>{!! Form::label('team', 'Team') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-team', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="team" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fab fa-stripe-s iconos-crear"></i>{!! Form::label('estadoincidente', 'Estado Incidente') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-estadoincidente', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="estadoincidente" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                     <i class="fa-fw fas fa-briefcase iconos-crear"></i>{!! Form::label('roles', 'Roles') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-estadoincidente', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="roles" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-estadoincidente', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>



                {{-- <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">Preguntas Frecuentes</div> --}}


                <!-- Categoria Field -->
                {{-- <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-briefcase iconos-crear"></i>{!! Form::label('faqcategoria', 'Categoría') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-faqcategoria', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="faqcategoria" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn btn_cargar']) !!} --}}
                        {{-- <button class="btn btn-secondary btn-sm">Descargar Formato</button> --}}
                        {{-- {!! Form::close() !!} --}}
                    {{-- </div>
                </div> --}}

                {{-- <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-question iconos-crear"></i>{!! Form::label('faqpregunta', 'Preguntas') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-faqpregunta', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="faqpregunta" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}


                <div class="py-1 text-center form-group col-12" style="background-color:#1BB0B0; border-radius:100px; color: white;">Configuración de datos</div>


                <!-- Categoria Field -->
                <div class="form-group col-sm-6">
                    <i class="fas fa-puzzle-piece iconos_menu iconos-crear"></i>{!! Form::label('grupo_area', 'Áreas/Crear grupo') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-grupo_area', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="grupo_area" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-grupo_area', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                {{-- <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-question iconos-crear"></i>{!! Form::label('documentos', 'Documentos/Crear documetos') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-grupo_area', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="documentos" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-question iconos-crear"></i>{!! Form::label('datos_area', 'Áreas/Crear área') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-datos_area', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-primary btn-sm" type="file" name="datos_area" required>
                        {!! Form::submit('cargar excel', ['class' => 'btn btn-primary']) !!}
                        <button class="btn btn-secondary btn-sm">Descargar Formato</button>
                        {!! Form::close() !!}
                    </div>
                </div>--}}
                <div class="form-group col-sm-6">
                    <i class="fas fa-user-tie iconos-crear"></i>{!! Form::label('empleado', 'Empleado') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-empleado', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="empleado" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-empleado', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <i class="fa-fw fas fa-laptop iconos-crear"></i>{!! Form::label('activo_inventario', 'Activos/Inventario') !!}
                    <div>
                        {!! Form::open(['route' => 'carga-activo_inventario', 'method' => 'post',  'enctype' => 'multipart/form-data']) !!}
                        <input class="btn btn-sm" type="file" name="activo_inventario" required>
                        {!! Form::submit('Cargar excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'descarga-activo_inventario', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Descarga excel', ['class' => 'btn text-white','style'=>'background-color:#b2b0b0']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
