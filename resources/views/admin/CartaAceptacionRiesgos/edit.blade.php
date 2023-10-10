@extends('layouts.admin')

@section('content')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.vulnerabilidads.index') !!}">Vulnerabilidad</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol> --}}


    <style>

        .select2-results__option{
           position: relative;
           padding-left:30px !important;

        }

        .select2-results__option:nth-child(2)::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(61, 114, 77);
            margin-left:-20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="1"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(61, 114, 77);
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-results__option:nth-child(3)::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(50, 205, 63);
            margin-left:-20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="2"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(50, 205, 63);
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-results__option:nth-child(4)::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:yellow;
            margin-left:-20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="3"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:yellow;
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-results__option:nth-child(5)::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(255, 136, 0);
            margin-left:-20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="4"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(255, 136, 0);
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

       .select2-results__option:nth-child(6)::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:red;
            margin-left:-20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="5"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:red;
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered{
            padding-left:30px !important;


        }

        .select2-selection__rendered[title="Bajo"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(50, 205, 63);
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title="Medio"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:yellow;
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title="Alto"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(255, 136, 0);
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title="Crítico"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:red;
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title="Muy Bajo"]::before{
            position: absolute;
            content:'';
            width:10px;
            height:10px;
            background-color:rgb(61, 114, 77);
            margin-left:-18px;
            border-radius: 100px;
            margin-top: 11px;
        }




    </style>
    <h5 class="col-12 titulo_general_funcion"> Registrar: Carta de Aceptación de Riesgos</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.carta-aceptacion.update', [$cartaAceptacion->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                            Datos Generales
                        </div>
                    </div>

                        <div class="form-group col-md-4 col-lg-4 col-sm-12">
                            <label for="folio_riesgo"><i class="fas fa-ticket-alt iconos-crear"></i>ID del Riesgo
                            </label>
                            <input class="form-control {{ $errors->has('folio_riesgo') ? 'is-invalid' : '' }}" name="folio_riesgo" id="folio_riesgo"
                            value="{{ old('folio_riesgo', $cartaAceptacion->folio_riesgo) }}">
                            @if ($errors->has('folio_riesgo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('folio_riesgo') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                            <label for="fecharegistro"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha y hora del riesgo</label>
                            <input class="form-control date {{ $errors->has('fecharegistro') ? 'is-invalid' : '' }}" type="datetime-local"
                                name="fecharegistro" id="fecharegistro"
                                value="{{ old('fecharegistro', \Carbon\Carbon::parse($cartaAceptacion->fecharegistro)->format('Y-m-d\TH:i')) }}">
                            @if ($errors->has('fecharegistro'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecharegistro') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                            <label for="fechaaprobacion"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de aprobación del riesgo</label>
                            <input class="form-control date {{ $errors->has('fechaaprobacion') ? 'is-invalid' : '' }}" type="datetime-local"
                                name="fechaaprobacion" id="fechaaprobacion" value="{{ old('fechaaprobacion') }}"
                                value="{{ old('fechaaprobacion', \Carbon\Carbon::parse($cartaAceptacion->fechaaprobacion)->format('Y-m-d\TH:i')) }}">
                            @if ($errors->has('fechaaprobacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechaaprobacion') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="responsable_id"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                            <select class="form-control {{ $errors->has('responsable_id') ? 'is-invalid' : '' }}" name="responsable_id" id="responsable_id">
                                <option value="" selected disabled>
                                    -- Selecciona el nombre del empleado --
                                </option>
                                @foreach ($responsables as $responsable)
                                <option  data-puesto="{{ $responsable->puesto }}" value="{{ $responsable->id }}" data-email="{{ $responsable->email }}"
                                    {{ old('responsable_id', $cartaAceptacion->responsable_id) == $responsable->id ? 'selected' : '' }}>
                                    {{ $responsable->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('responsable_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('responsable_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_responsable"></div>

                        </div>


                        <div class="form-group col-md-4">
                            <label ><i class="fas fa-envelope iconos-crear"></i>Correo Electronico</label>
                            <div class="form-control" id="correo_responsable"></div>

                        </div>

                        <div class="col-12">
                            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                                Clasificación del Activo
                            </div>
                        </div>

                        <div class="form-group col-md-4 col-lg-4 col-sm-12">
                            <label for="activo_folio"><i class="fas fa-ticket-alt iconos-crear"></i>ID Activo
                            </label>
                            <input class="form-control mt-2 {{ $errors->has('activo_folio') ? 'is-invalid' : '' }}" name="activo_folio" id="activo_folio"
                            value="{{ old('activo_folio', $cartaAceptacion->activo_folio) }}">
                            @if ($errors->has('activo_folio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('activo_folio') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-8 col-lg-8 col-sm-12">
                            <label for="nombre_activo"><i class="bi bi-pc-display-horizontal iconos-crear"></i>Nombre
                            </label>
                            <input class="form-control {{ $errors->has('nombre_activo') ? 'is-invalid' : '' }}" name="nombre_activo" id="nombre_activo"
                            value="{{ old('nombre_activo', $cartaAceptacion->nombre_activo) }}">
                            @if ($errors->has('nombre_activo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombre_activo') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 col-lg-6 col-sm-12">
                            <label for="criticidad_activo"><i class="fab fa-cloudscale iconos-crear"></i>Criticidad del Activo
                            </label>
                            <input class="form-control {{ $errors->has('criticidad_activo') ? 'is-invalid' : '' }}" name="criticidad_activo" id="criticidad_activo"
                                value="{{ old('criticidad_activo', $cartaAceptacion->criticidad_activo) }}">
                            @if ($errors->has('criticidad_activo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('criticidad_activo') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 col-lg-6 col-sm-12">
                            <label for="confidencialidad"><i class="fas fa-lock iconos-crear"></i>Confidencialidad
                            </label>
                            <input class="form-control {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}" name="confidencialidad" id="confidencialidad"
                            value="{{ old('confidencialidad', $cartaAceptacion->confidencialidad) }}">
                            @if ($errors->has('confidencialidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confidencialidad') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12">
                            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                                Evaluación del riesgo a Aceptar
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-lg-12 col-sm-12">
                            <label for="descripcion_riesgo"><i class="far fa-file-alt iconos-crear"></i>Descripción del Riesgo Aceptado
                            </label>
                            <textarea class="form-control {{ $errors->has('descripcion_riesgo') ? 'is-invalid' : '' }}" name="descripcion_riesgo" id="descripcion_riesgo">
                                {{ old('descripcion_riesgo', $cartaAceptacion->descripcion_riesgo) }}</textarea>
                            @if ($errors->has('descripcion_riesgo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion_riesgo') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 col-lg-6 col-sm-12">
                            <label for="descripcion_negocio"><i class="far fa-file-alt iconos-crear"></i>Descripción del Impacto al Negocio
                            </label>
                            <textarea class="form-control {{ $errors->has('descripcion_negocio') ? 'is-invalid' : '' }}" name="descripcion_negocio" id="descripcion_negocio">
                                {{ old('descripcion_negocio', $cartaAceptacion->descripcion_negocio) }}</textarea>
                            @if ($errors->has('descripcion_negocio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion_negocio') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 col-lg-6 col-sm-12">
                            <label for="descripcion_tecnologico"><i class="far fa-file-alt iconos-crear"></i>Descripción del Impacto al Tecnológico
                            </label>
                            <textarea class="form-control {{ $errors->has('descripcion_tecnologico') ? 'is-invalid' : '' }}" name="descripcion_tecnologico" id="descripcion_tecnologico">
                                {{ old('descripcion_tecnologico', $cartaAceptacion->descripcion_tecnologico) }}</textarea>
                            @if ($errors->has('descripcion_tecnologico'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion_tecnologico') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12">
                            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                                Impacto del Riesgo
                            </div>
                        </div>

                        <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
                            <thead>
                                {{-- <tr class="negras">

                                    <th class="text-center" style="background-color:#1168af;" colspan="6">Tablero de Riesgos Impacto</th>
                                </tr> --}}
                                <tr>
                                    <th>PROBABILIDAD</th>
                                    <th>1.Muy Bajo</th>
                                    <th>2.Bajo</th>
                                    <th>3.Medio</th>
                                    <th>4.Alto</th>
                                    <th>5.Crítico</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        5. Muy probable
                                    </td>
                                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                       Medio (5)
                                    </td>
                                    <td style="background-color:rgb(255, 194, 124);text-align:center !important;">
                                        Alto (10)
                                     </td>
                                     <td style="background-color:rgb(255, 194, 124);text-align:center !important;">
                                        Alto (15)
                                     </td>
                                     <td style="background-color:rgb(228, 130, 130);text-align:center !important;">
                                        Crítico (20)
                                     </td>
                                     <td style="background-color:rgb(228, 130, 130);text-align:center !important;">
                                        Crítico (25)
                                     </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>
                                        4. Probable
                                    </td>
                                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                        Medio (4)
                                     </td>
                                     <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                         Medio (8)
                                      </td>
                                      <td style="background-color:rgb(255, 194, 124); text-align:center !important;">
                                         Alto (12)
                                      </td>
                                      <td style="background-color:rgb(255, 194, 124); text-align:center !important;">
                                         Alto (16)
                                      </td>
                                      <td style="background-color:rgb(228, 130, 130); text-align:center !important;">
                                         Crítico (20)
                                      </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>
                                        3. Posible
                                    </td>
                                    <td  style="background-color:rgb(133, 236, 142); text-align:center !important;">
                                        Bajo (3)
                                     </td>
                                     <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                         Medio (6)
                                      </td>
                                      <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                         Medio (9)
                                      </td>
                                      <td style="background-color:rgb(255, 194, 124); text-align:center !important;">
                                         Alto (12)
                                      </td>
                                      <td style="background-color:rgb(255, 194, 124); text-align:center !important;">
                                         Alto (15)
                                      </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>
                                        2. Poco Probable
                                    </td>
                                    <td style="background-color:rgb(133, 236, 142); text-align:center !important;">
                                        Bajo (2)
                                     </td>
                                     <td style="background-color:rgb(133, 236, 142); text-align:center !important;">
                                         Bajo (4)
                                      </td>
                                      <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                         Medio (6)
                                      </td>
                                      <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                         Medio (8)
                                      </td>
                                      <td style="background-color:rgb(255, 194, 124); text-align:center !important;">
                                         Alto (10)
                                      </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>
                                        1. Improbable
                                    </td>
                                    <td style="background-color:rgb(103, 207, 111); text-align:center !important;">
                                        Muy Bajo (1)
                                     </td>
                                     <td style="background-color:rgb(133, 236, 142); text-align:center !important;">
                                         Bajo (2)
                                      </td>
                                      <td style="background-color:rgb(133, 236, 142); text-align:center !important;">
                                         Bajo (3)
                                      </td>
                                      <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                         Medio (4)
                                      </td>
                                      <td style="background-color:rgb(240, 240, 150); text-align:center !important;">
                                         Medio (5)
                                      </td>
                                </tr>
                            </tbody>
                        </table>

                       <table class="table w-100 mt-4 mb-4" id="contactos_externos_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Descripción</th>

                                </tr>
                            </thead>
                            <tbody id="contenedor_contactos_externos">
                                <tr>
                                    <th>Muy alto</th>
                                    <th style="background-color:rgb(240, 240, 150);">Riesgo catastrófico que puede afectar la permanencia del n_registro
                                        y que genera impactos graves.
                                    </th>
                                </tr>
                                <tr>
                                    <th>Alto</th>
                                    <th style="background-color:rgb(240, 240, 150);">Riesgo intolerable para la organización que genera impactos relevantes.
                                    </th>
                                </tr>
                                <tr>
                                    <th>Medio</th>
                                    <th style="background-color:rgb(240, 240, 150);">Riesgo moderado para la organización que genera impactos significativos.
                                    </th>
                                </tr>
                                <tr>
                                    <th>Bajo</th>
                                    <th style="background-color:rgb(240, 240, 150);">Riesgo tolerable para la organización que no genera impactos significativos.
                                    </th>
                                </tr>
                                <tr>
                                    <th>Muy bajo</th>
                                    <th style="background-color:rgb(240, 240, 150);">Sin riesgo para la organización y no genera algún impacto significativo.
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="legal"><i class="fas fa-gavel iconos-crear"></i>Legal</label><br>
                            <select class="form-control select2 {{ $errors->has('legal') ? 'is-invalid' : '' }}" name="legal">
                                <option value="" selected>Selecciona una opción</option>
                                <option {{ old('1', $cartaAceptacion->legal) == '1' ? 'selected' : '' }} value="1">1</option>
                                <option {{ old('2', $cartaAceptacion->legal) == '2' ? 'selected' : '' }} value="2">2</option>
                                <option {{ old('3', $cartaAceptacion->legal) == '3' ? 'selected' : '' }} value="3">3</option>
                                <option {{ old('4', $cartaAceptacion->legal) == '4' ? 'selected' : '' }} value="4">4</option>
                                <option {{ old('5', $cartaAceptacion->legal) == '5' ? 'selected' : '' }}  value="5">5</option>
                            </select>
                        </div>


                        <div class="form-group col-md-4 col-sm-12">
                            <label for="cumplimiento"><i class="fas fa-check iconos-crear"></i>Cumplimiento</label><br>
                            <select class="form-control select2 {{ $errors->has('cumplimiento') ? 'is-invalid' : '' }}" name="cumplimiento">
                                <option value="" selected>Selecciona una opción</option>
                                <option {{ old('1', $cartaAceptacion->cumplimiento) == '1' ? 'selected' : '' }} value="1">1</option>
                                <option {{ old('2', $cartaAceptacion->cumplimiento) == '2' ? 'selected' : '' }} value="2">2</option>
                                <option {{ old('3', $cartaAceptacion->cumplimiento) == '3' ? 'selected' : '' }} value="3">3</option>
                                <option {{ old('4', $cartaAceptacion->cumplimiento) == '4' ? 'selected' : '' }} value="4">4</option>
                                <option {{ old('5', $cartaAceptacion->cumplimiento) == '5' ? 'selected' : '' }}  value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4 col-sm-12">
                            <label for="operacional"><i class="fas fa-project-diagram iconos-crear"></i>Operacional</label><br>
                            <select class="form-control select2 {{ $errors->has('operacional') ? 'is-invalid' : '' }}" name="operacional" >
                                <option value="" selected>Selecciona una opción</option>
                                <option {{ old('1', $cartaAceptacion->operacional) == '1' ? 'selected' : '' }} value="1">1</option>
                                <option {{ old('2', $cartaAceptacion->operacional) == '2' ? 'selected' : '' }} value="2">2</option>
                                <option {{ old('3', $cartaAceptacion->operacional) == '3' ? 'selected' : '' }} value="3">3</option>
                                <option {{ old('4', $cartaAceptacion->operacional) == '4' ? 'selected' : '' }} value="4">4</option>
                                <option {{ old('5', $cartaAceptacion->operacional) == '5' ? 'selected' : '' }}  value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4 col-sm-12">
                            <label for="reputacional"><i class="fas fa-newspaper iconos-crear"></i>Reputacional</label><br>
                            <select class="form-control select2 {{ $errors->has('reputacional') ? 'is-invalid' : '' }}" name="reputacional" id="reputacional">
                                <option value="" selected>Selecciona una opción</option>
                                <option {{ old('1', $cartaAceptacion->reputacional) == '1' ? 'selected' : '' }} value="1">1</option>
                                <option {{ old('2', $cartaAceptacion->reputacional) == '2' ? 'selected' : '' }} value="2">2</option>
                                <option {{ old('3', $cartaAceptacion->reputacional) == '3' ? 'selected' : '' }} value="3">3</option>
                                <option {{ old('4', $cartaAceptacion->reputacional) == '4' ? 'selected' : '' }} value="4">4</option>
                                <option {{ old('5', $cartaAceptacion->reputacional) == '5' ? 'selected' : '' }}  value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4 col-sm-12">
                            <label for="financiero"><i class="fas fa-dollar-sign iconos-crear"></i>Financiero</label><br>
                            <select class="form-control select2 {{ $errors->has('financiero') ? 'is-invalid' : '' }}" name="financiero" >
                                <option value="" selected>Selecciona una opción</option>
                                <option {{ old('1', $cartaAceptacion->financiero) == '1' ? 'selected' : '' }} value="1">1</option>
                                <option {{ old('2', $cartaAceptacion->financiero) == '2' ? 'selected' : '' }} value="2">2</option>
                                <option {{ old('3', $cartaAceptacion->financiero) == '3' ? 'selected' : '' }} value="3">3</option>
                                <option {{ old('4', $cartaAceptacion->financiero) == '4' ? 'selected' : '' }} value="4">4</option>
                                <option {{ old('5', $cartaAceptacion->financiero) == '5' ? 'selected' : '' }}  value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4 col-sm-12">
                            <label for="tecnologico"><i class="fas fa-laptop iconos-crear"></i>Tecnológico</label><br>
                            <select class="form-control select2 {{ $errors->has('tecnologico') ? 'is-invalid' : '' }}" name="tecnologico">
                                <option value="" selected>Selecciona una opción</option>
                                <option {{ old('1', $cartaAceptacion->tecnologico) == '1' ? 'selected' : '' }} value="1">1</option>
                                <option {{ old('2', $cartaAceptacion->tecnologico) == '2' ? 'selected' : '' }} value="2">2</option>
                                <option {{ old('3', $cartaAceptacion->tecnologico) == '3' ? 'selected' : '' }} value="3">3</option>
                                <option {{ old('4', $cartaAceptacion->tecnologico) == '4' ? 'selected' : '' }} value="4">4</option>
                                <option {{ old('5', $cartaAceptacion->tecnologico) == '5' ? 'selected' : '' }}  value="5">5</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                                Escenarios de Riesgo
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-lg-12 col-sm-12">
                            <label for="aceptacion_riesgo"><i class="fas fa-exclamation-triangle iconos-crear"></i>Razón por la que se debe aceptar el riesgo
                            </label>
                            <input class="form-control {{ $errors->has('aceptacion_riesgo') ? 'is-invalid' : '' }}" name="aceptacion_riesgo" id="aceptacion_riesgo"
                                value="{{ old('aceptacion_riesgo',$cartaAceptacion->aceptacion_riesgo) }}">
                            @if ($errors->has('aceptacion_riesgo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('aceptacion_riesgo') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-md-12 col-lg-12 col-sm-12">
                            <label for="controles_compensatorios"><i class="fas fa-lock iconos-crear"></i>controles compensatorios
                            </label>
                            <textarea class="form-control {{ $errors->has('controles_compensatorios') ? 'is-invalid' : '' }}" name="controles_compensatorios" id="controles_compensatorios">
                                {{ old('controles_compensatorios',$cartaAceptacion->controles_compensatorios) }}</textarea>
                            @if ($errors->has('controles_compensatorios'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('controles_compensatorios') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-12 col-lg-12 col-sm-12 mb-4">
                            <label for="controles_id" style="margin-left: 15px; margin-bottom:5px; margin-right: 0px;"><i class="fas fa-lock iconos-crear"></i>Políticas/Control asociados al Riesgo</label>

                                <select
                                    class="form-control js-example-basic-multiple select2  {{ $errors->has('controles_id') ? 'is-invalid' : '' }}"
                                    name="controles_id[]" id="select2-multiple-input-sm" multiple="multiple">
                                    <option value disabled>
                                        Selecciona una opción</option>
                                    @foreach ($controles as $control)
                                        <option value="{{ $control->id }}">
                                            {{ $control->anexo_indice }} {{ $control->anexo_politica }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('controles_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('controles_id') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                        </div>

                        <div class="col-12">
                            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                                Autorización de Aceptación de Riesgos
                            </div>
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label for="director_resp_id"><i class="fas fa-user-tie iconos-crear"></i>Director Responsable del Riesgo</label>
                            <select class="form-control {{ $errors->has('director_resp_id') ? 'is-invalid' : '' }}" name="director_resp_id" id="director_resp_id"
                                >
                                <option value="" selected disabled>
                                    -- Selecciona el nombre del empleado --
                                </option>
                                @foreach ($directoresRiesgo as $directorRiesgo)
                                <option  value="{{ $directorRiesgo->id }}"
                                    {{ old('director_resp_id', $cartaAceptacion->director_resp_id) == $directorRiesgo->id ? 'selected' : '' }}>
                                    {{ $directorRiesgo->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('reviso'))
                            <div class="invalid-feedback">
                                {{ $errors->first('director_resp_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label for="fecha_aut_direct"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de Autorización</label>
                            <input class="form-control date {{ $errors->has('fecha_aut_direct') ? 'is-invalid' : '' }}" type="date"
                                name="fecha_aut_direct" id="fecha_aut_direct" value="{{ old('fecha_aut_direct') }}">
                            @if ($errors->has('fecha_aut_direct'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_aut_direct') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="vp_responsable_id"><i class="fas fa-user-tie iconos-crear"></i>VP Responsable del Riesgo</label>
                            <select class="form-control {{ $errors->has('vp_responsable_id') ? 'is-invalid' : '' }}" name="vp_responsable_id" id="vp_responsable_id">
                                <option value="" selected disabled>
                                    -- Selecciona el nombre del empleado --
                                </option>
                                @foreach ($vicepresidentes as $vicepresidente)
                                <option   value="{{ $vicepresidente->id }}"
                                    {{ old('vp_responsable_id', $cartaAceptacion->vp_responsable_id) == $vicepresidente->id ? 'selected' : '' }}>
                                    {{ $vicepresidente->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('vp_responsable_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('vp_responsable_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label for="fecha_vp_aut"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de Autorización</label>
                            <input class="form-control date {{ $errors->has('fecha_vp_aut') ? 'is-invalid' : '' }}" type="date"
                                name="fecha_vp_aut" id="fecha_vp_aut" value="{{ old('fecha_vp_aut') }}">
                            @if ($errors->has('fecha_vp_aut'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_vp_aut') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label ><i class="fas fa-user-tie iconos-crear"></i>Presidencia</label>
                            <select class="form-control {{ $errors->has('presidencia_id') ? 'is-invalid' : '' }}" name="presidencia_id">
                                <option value="" selected disabled>
                                    -- Selecciona el nombre del empleado --
                                </option>
                                @foreach ($presidencias as $presidencia)
                                <option   value="{{ $presidencia->id }}"
                                    {{ old('presidencia_id', $cartaAceptacion->presidencia_id) == $presidencia->id ? 'selected' : '' }}>
                                    {{ $presidencia->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('presidencia_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('presidencia_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label for="fecha_aut_presidencia"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de Autorización</label>
                            <input class="form-control date {{ $errors->has('fecha_aut_presidencia') ? 'is-invalid' : '' }}" type="date"
                                name="fecha_aut_presidencia" id="fecha_aut_presidencia" value="{{ old('fecha_aut_presidencia') }}">
                            @if ($errors->has('fecha_aut_presidencia'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_aut_presidencia') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="vice_operaciones_id"><i class="fas fa-user-tie iconos-crear"></i>Vicepresidencia de Operaciones</label>
                            <select class="form-control {{ $errors->has('vice_operaciones_id') ? 'is-invalid' : '' }}" name="vice_operaciones_id" id="vice_operaciones_id">
                                <option value="" selected disabled>
                                    -- Selecciona el nombre del empleado --
                                </option>
                                @foreach ($vicepresidentesOperaciones as $vicepresidenteOperacion)
                                <option value="{{ $vicepresidenteOperacion->id }}"
                                    {{ old('vice_operaciones_id', $cartaAceptacion->vice_operaciones_id) == $vicepresidenteOperacion->id ? 'selected' : '' }}>
                                    {{ $vicepresidenteOperacion->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('vice_operaciones_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('vice_operaciones_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label for="fecha_aut_viceoperaciones"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de Autorización</label>
                            <input class="form-control date {{ $errors->has('fecha_aut_viceoperaciones') ? 'is-invalid' : '' }}" type="date"
                                name="fecha_aut_viceoperaciones" id="fecha_aut_viceoperaciones"
                                value="{{ old('fecha_aut_viceoperaciones', \Carbon\Carbon::parse($cartaAceptacion->fecha_aut_viceoperaciones))->format('Y-m-d') }}">
                            @if ($errors->has('fecha_aut_viceoperaciones'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_aut_viceoperaciones') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-md-12 col-lg-12 col-sm-12">
                            <label for="recomendaciones"><i class="fas fa-lock iconos-crear"></i>Recomendaciones Mandatorias de Seguridad
                            </label>
                            <textarea class="form-control {{ $errors->has('recomendaciones') ? 'is-invalid' : '' }}" name="recomendaciones" id="recomendaciones"
                                >{{ old('recomendaciones', $cartaAceptacion->recomendaciones) }}</textarea>
                            @if ($errors->has('recomendaciones'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('recomendaciones') }}
                                </div>
                            @endif
                        </div>





                    <!-- Submit Field -->
                    <div class="text-right form-group col-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>

                 </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    let responsable = document.querySelector('#responsable_id');
    let email_init = responsable.options[responsable.selectedIndex].getAttribute('data-email');
    let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

    document.getElementById('puesto_responsable').innerHTML = puesto_init;
    document.getElementById('correo_responsable').innerHTML = email_init;
    responsable.addEventListener('change', function(e) {
        e.preventDefault();
        let email = this.options[this.selectedIndex].getAttribute('data-email');
        let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
        document.getElementById('puesto_responsable').innerHTML = puesto;
        document.getElementById('correo_responsable').innerHTML = email;
    })
})

</script>

<script>
    $(document).ready(function() {
        CKEDITOR.replace('recomendaciones', {
            toolbar: [{
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                }, {
                    name: 'clipboard',
                    groups: ['undo'],
                    items: ['Undo', 'Redo']
                },
                {
                    name: 'tools',
                    items: ['Maximize']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                        '-',
                        'CopyFormatting', 'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'Blockquote',
                        '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                        'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                    ]
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'insert',
                    items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                },
                '/',
            ]
        });


        CKEDITOR.replace('controles_compensatorios', {
            toolbar: [{
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                }, {
                    name: 'clipboard',
                    groups: ['undo'],
                    items: ['Undo', 'Redo']
                },
                {
                    name: 'tools',
                    items: ['Maximize']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                        '-',
                        'CopyFormatting', 'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'Blockquote',
                        '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                        'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                    ]
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'insert',
                    items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                },
                '/',
            ]
        });

    });

    function initInpusToMoneyFormat() {
        document.querySelectorAll("input[data-type='currency']").forEach(element => {
            formatCurrency($(element));
        })
    }

    function inputsToMoneyFormat() {
        $("input[data-type='currency']").on({
            init: function() {
                console.log(this);
            },
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });
    }



</script>
<script>
      CKEDITOR.replace('descripcion_riesgo', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });
        CKEDITOR.replace('descripcion_negocio', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });
        CKEDITOR.replace('descripcion_tecnologico', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

</script>

<script>
    $(document).ready(function() {
        $(".js-example-basic-multiple").select2(
            'theme': 'bootstrap4',
            allowClear: true,
            minimumResultsForSearch: -1,
        );
    });
</script>

<script type="text/javascript">
    Livewire.on('planStore', () => {
        $('#planAccionModal').modal('hide');
        $('.modal-backdrop').hide();
        toastr.success('Plan de Acción creado con éxito');
    });
    window.initSelect2 = () => {
        $('.select2').select2({
            'theme': 'bootstrap4'
        });
    }

    initSelect2();

    Livewire.on('select2', () => {
        initSelect2();
    });
</script>

@endsection
