@extends('layouts.admin')
@section('content')


    <style type="text/css">
        .datos_der_cv {
            color: #fff;
        }

        .cuadro_rojo{
            width:50px;
            height:50px;
            background-color: red;
        }

        .cuadro_amarillo{
            width:50px;
            height:50px;
            background-color:yellow;
        }

        .cuadro_verde_limon{
            width:50px;
            height:50px;
            background-color:rgb(50, 205, 63);
        }

        .cuadro_verde{
            width:50px;
            height:50px;
            background-color:rgb(61, 114, 77);
        }

        .cuadro_naranja{
            width:50px;
            height:50px;
            background-color:rgb(255, 136, 0);
        }


    </style>


<h5 class="col-12 titulo_general_funcion">Carta de Aceptación de Riesgos</h5>

<div class="mt-4 row justify-content-center">

        <div class="card col-sm-12 col-md-10">
                <div class="card-body">
                    {{-- <div style="width: 100%; background-color: rgb(220, 255, 255);"> --}}
                        @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::first();
                        $logotipo = $organizacion->logotipo;
                        @endphp
                        <div>
                            <div class="caja_img_logo">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width:130px;">

                                    </div>
                                    <div class="col-9 mt-4">
                                    <h2 class="mb-2 text-center" style="color:#345183"><strong>CARTA DE ACEPTACIÓN DE RIESGOS</strong></h2>

                                    </div>

                                        <p>**La vigencia de la carta aceptación de riesgos es aplicable al ciclo 2022 y se debe
                                            evaluar y renovar ante un cambio de responsable, transferencia, eliminación del riesgos
                                            o caducidad de la misma
                                        </p>


                                    <div class="row">
                                        <div class="col-5">
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong style="color:#345183">Puesto del responsable del riesgo</strong>
                                                </div>
                                                <div class="col-6">
                                                    <span style="color:#345183">{{$cartaAceptacion->responsables->puesto}}</span>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong style="color:#345183">Nombre del responsable del riesgo</strong>
                                                </div>
                                                <div class="col-6">
                                                    <span style="color:#345183">{{$cartaAceptacion->responsables->name}}</span>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong style="color:#345183">Correo electrónico del responsable del riesgo</strong>
                                                </div>
                                                <div class="col-6">
                                                    <span style="color:#345183">{{$cartaAceptacion->responsables->email}}</span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-7">
                                                    <strong style="color:#345183">ID del riesgo</strong>
                                                </div>
                                                <div class="col-5">
                                                    <span style="color:#345183">{{$cartaAceptacion->folio_riesgo}}</span>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-7">
                                                    <strong style="color:#345183">Implementación del cambio </strong>
                                                </div>
                                                <div class="col-5">

                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-7">
                                                    <strong style="color:#345183">Impacto del riesgo evaluado</strong>
                                                </div>
                                                <div class="col-5">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-3">
                                            <strong style="color:#345183">Fecha de riesgo levantado</strong>
                                            <br>
                                            <span style="color:#345183">{{$cartaAceptacion->fecharegistro}}</span>
                                            <br>
                                            <strong style="color:#345183">Fecha de aprobación del riesgo</strong>
                                            <br>
                                            <span style="color:#345183">{{$cartaAceptacion->fechaaprobacion}}</span>
                                            <br>
                                            <strong style="color:#345183">Probabilidad del riesgo evaluado</strong>
                                            <br>
                                            <span style="color:#345183"></span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    {{-- </div> --}}


                    <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
                        <thead>
                            <tr class="negras">

                                <th class="text-center" style="color:#345183; background-color:#cccccc;" colspan="6">Tablero de Riesgos Impacto</th>
                            </tr>
                            <tr>
                                <th style="color:#345183; background-color:#ffffff;">PROBABILIDAD</th>
                                <th style="color:#345183; background-color:#ffffff;">1.Muy Bajo</th>
                                <th style="color:#345183; background-color:#ffffff;">2.Bajo</th>
                                <th style="color:#345183; background-color:#ffffff;">3.Medio</th>
                                <th style="color:#345183; background-color:#ffffff;">4.Alto</th>
                                <th style="color:#345183; background-color:#ffffff;">5.Crítico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="color:#345183;">
                                    5. Muy probable
                                </td>
                                <td style=" color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                Medio (5)
                                </td>
                                <td style="color:#345183; background-color:rgb(255, 194, 124);text-align:center !important;">
                                    Alto (10)
                                </td>
                                <td style="color:#345183; background-color:rgb(255, 194, 124);text-align:center !important;">
                                    Alto (15)
                                </td>
                                <td style="color:#345183; background-color:rgb(228, 130, 130);text-align:center !important;">
                                    Crítico (20)
                                </td>
                                <td style="color:#345183; background-color:rgb(228, 130, 130);text-align:center !important;">
                                    Crítico (25)
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td style="color:#345183;">
                                    4. Probable
                                </td>
                                <td style="color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                    Medio (4)
                                </td>
                                <td style="color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                    Medio (8)
                                </td>
                                <td style="color:#345183; background-color:rgb(255, 194, 124); text-align:center !important;">
                                    Alto (12)
                                </td>
                                <td style="color:#345183; background-color:rgb(255, 194, 124); text-align:center !important;">
                                    Alto (16)
                                </td>
                                <td style="color:#345183; background-color:rgb(228, 130, 130); text-align:center !important;">
                                    Crítico (20)
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td style="color:#345183;">
                                    3. Posible
                                </td>
                                <td  style="color:#345183; background-color:rgb(133, 236, 142); text-align:center !important;">
                                    Bajo (3)
                                </td>
                                <td style="color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                    Medio (6)
                                </td>
                                <td style="color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                    Medio (9)
                                </td>
                                <td style="color:#345183; background-color:rgb(255, 194, 124); text-align:center !important;">
                                    Alto (12)
                                </td>
                                <td style="color:#345183; background-color:rgb(255, 194, 124); text-align:center !important;">
                                    Alto (15)
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td style="color:#345183;">
                                    2. Poco Probable
                                </td>
                                <td style="color:#345183; background-color:rgb(133, 236, 142); text-align:center !important;">
                                    Bajo (2)
                                </td>
                                <td style="color:#345183; background-color:rgb(133, 236, 142); text-align:center !important;">
                                    Bajo (4)
                                </td>
                                <td style="color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                    Medio (6)
                                </td>
                                <td style="color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                    Medio (8)
                                </td>
                                <td style="color:#345183; background-color:rgb(255, 194, 124); text-align:center !important;">
                                    Alto (10)
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td style="color:#345183;">
                                    1. Improbable
                                </td>
                                <td style="color:#345183; background-color:rgb(103, 207, 111); text-align:center !important;">
                                    Muy Bajo (1)
                                </td>
                                <td style="color:#345183; background-color:rgb(133, 236, 142); text-align:center !important;">
                                    Bajo (2)
                                </td>
                                <td style="color:#345183; background-color:rgb(133, 236, 142); text-align:center !important;">
                                    Bajo (3)
                                </td>
                                <td style="color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                    Medio (4)
                                </td>
                                <td style="color:#345183; background-color:rgb(240, 240, 150); text-align:center !important;">
                                    Medio (5)
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table w-100 mt-4 mb-4" id="contactos_externos_table" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" style="color:#345183; background-color:#cccccc;" colspan="2" class="text-center">Descripción</th>

                            </tr>
                        </thead>
                        <tbody id="contenedor_contactos_externos">
                            <tr>
                                <th style="color:#345183;">Muy alto</th>
                                <th style="color:#345183; background-color:rgb(240, 240, 150);">Riesgo catastrófico que puede afectar la permanencia del n_registro
                                    y que genera impactos graves.
                                </th>
                            </tr>
                            <tr>
                                <th style="color:#345183;">Alto</th>
                                <th style="color:#345183; background-color:rgb(240, 240, 150);">Riesgo intolerable para la organización que genera impactos relevantes.
                                </th>
                            </tr>
                            <tr>
                                <th style="color:#345183;">Medio</th>
                                <th style="color:#345183; background-color:rgb(240, 240, 150);">Riesgo moderado para la organización que genera impactos significativos.
                                </th>
                            </tr>
                            <tr>
                                <th style="color:#345183;">Bajo</th>
                                <th style="color:#345183; background-color:rgb(240, 240, 150);">Riesgo tolerable para la organización que no genera impactos significativos.
                                </th>
                            </tr>
                            <tr>
                                <th style="color:#345183;">Muy bajo</th>
                                <th style="color:#345183; background-color:rgb(240, 240, 150);">Sin riesgo para la organización y no genera algún impacto significativo.
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
                        <thead>
                            <tr class="negras">

                                <th class="text-center" style="color:#345183; background-color:#cccccc;" colspan="6">1.Clasificación del activo relacionado</th>
                            </tr>
                            <tr>
                                <th style="color:#345183; background-color:#ffffff;">ID Activo</th>
                                <th style="color:#345183; background-color:#ffffff;">Nombre</th>
                                <th style="color:#345183; background-color:#ffffff;">Criticidad del Activo</th>
                                <th style="color:#345183; background-color:#ffffff;">Confidencialidad</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="color:#345183;">
                                    {{$cartaAceptacion->folio_riesgo}}
                                </td>
                                <td style="color:#345183;">
                                    {{$cartaAceptacion->nombre_activo}}
                                </td>
                                <td style="color:#345183;">
                                    {{$cartaAceptacion->criticidad_activo}}
                                </td>
                                <td style="color:#345183;">
                                    {{$cartaAceptacion->confidencialidad}}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
                        <thead>
                            <tr class="negras">

                                <th class="text-center" style="color:#345183; background-color:#cccccc;" colspan="2">2.Evaluación del Riesgo a Aceptar</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td style="color:#345183;">

                                    <div class="row">
                                        <div class="col-4">
                                            <strong style="color:#345183">Descripción del Riesgo Aceptado</strong>
                                        </div>
                                        <div class="col-8">
                                            <span style="color:#345183">{!!$cartaAceptacion->descripcion_riesgo!!}</span>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td style="color:#345183;">

                                    <div class="row">
                                        <div class="col-4">
                                            <strong style="color:#345183">Descripción del Impacto del al Negocio</strong>
                                        </div>
                                        <div class="col-8">
                                            <span style="color:#345183">{!!$cartaAceptacion->descripcion_negocio!!}</span>
                                        </div>
                                    </div>
                                </td>
                        </tbody>

                        <tbody>
                            <tr>
                                <td style="color:#345183;">

                                    <div class="row">
                                        <div class="col-4">
                                            <strong style="color:#345183">Descripción del Impacto Tecnológico</strong>
                                        </div>
                                        <div class="col-8">
                                            <span style="color:#345183">{!!$cartaAceptacion->descripcion_tecnologico!!}</span>
                                        </div>
                                    </div>
                                </td>
                        </tbody>
                    </table>

                    <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
                        <thead>
                            <tr>

                                <th class="text-center" style="color:#345183; background-color:#cccccc;" colspan="2">Tipo de impacto del riesgo</th>
                            </tr>

                        </thead>

                        <tbody>
                            <tr>
                                <td  style="color:#345183;">
                                    Impacto Legal
                                </td>

                                <td  style="color:#345183;">
                                @switch ($cartaAceptacion->legal)
                                    @case(1)
                                    <div class="cuadro_verdelimon"></div>
                                        @break
                                    @case(2)
                                    <div class="cuadro_verde"></div>
                                        @break
                                    @case(3)
                                    <div class="cuadro_amarillo"></div>
                                        @break
                                    @case(4)
                                    <div class="cuadro_naranja"></div>

                                        @break
                                    @case(5)
                                    <div class="cuadro_rojo"></div>

                                        @break;
                                    @default
                                        <span>No hay registro</span>
                                @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td  style="color:#345183;">
                                    Impacto Cumplimiento
                                </td>

                                <td  style="color:#345183;">
                                    @switch ($cartaAceptacion->cumplimiento)
                                    @case(1)
                                    <div class="cuadro_verdelimon"></div>
                                        @break
                                    @case(2)
                                    <div class="cuadro_verde"></div>
                                        @break
                                    @case(3)
                                    <div class="cuadro_amarillo"></div>
                                        @break
                                    @case(4)
                                    <div class="cuadro_naranja"></div>

                                        @break
                                    @case(5)
                                    <div class="cuadro_rojo"></div>

                                        @break;
                                    @default
                                        <span>No hay registro</span>
                                @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td  style="color:#345183;">
                                    Impacto Operacional
                                </td>

                                <td  style="color:#345183;">
                                    @switch ($cartaAceptacion->operacional)
                                    @case(1)
                                    <div class="cuadro_verdelimon"></div>
                                        @break
                                    @case(2)
                                    <div class="cuadro_verde"></div>
                                        @break
                                    @case(3)
                                    <div class="cuadro_amarillo"></div>
                                        @break
                                    @case(4)
                                    <div class="cuadro_naranja"></div>

                                        @break
                                    @case(5)
                                    <div class="cuadro_rojo"></div>

                                        @break;
                                    @default
                                        <span>No hay registro</span>
                                @endswitch
                                </td>

                            </tr>
                            <tr>
                                <td  style="color:#345183;">
                                    Impacto Reputacional
                                </td>

                                <td  style="color:#345183;">
                                    @switch ($cartaAceptacion->reputacional)
                                    @case(1)
                                    <div class="cuadro_verdelimon"></div>
                                        @break
                                    @case(2)
                                    <div class="cuadro_verde"></div>
                                        @break
                                    @case(3)
                                    <div class="cuadro_amarillo"></div>
                                        @break
                                    @case(4)
                                    <div class="cuadro_naranja"></div>

                                        @break
                                    @case(5)
                                    <div class="cuadro_rojo"></div>

                                        @break;
                                    @default
                                        <span>No hay registro</span>
                                @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td  style="color:#345183;">
                                    Impacto Financiero
                                </td>
                                <td  style="color:#345183;">
                                    @switch ($cartaAceptacion->financiero)
                                    @case(1)
                                    <div class="cuadro_verdelimon"></div>
                                        @break
                                    @case(2)
                                    <div class="cuadro_verde"></div>
                                        @break
                                    @case(3)
                                    <div class="cuadro_amarillo"></div>
                                        @break
                                    @case(4)
                                    <div class="cuadro_naranja"></div>

                                        @break
                                    @case(5)
                                    <div class="cuadro_rojo"></div>

                                        @break;
                                    @default
                                        <span>No hay registro</span>
                                @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td  style="color:#345183;">
                                    Impacto Tecnológico
                                </td>
                                <td  style="color:#345183;">

                                    @switch ($cartaAceptacion->tecnologico)
                                        @case(1)
                                        <div class="cuadro_verdelimon"></div>
                                            @break
                                        @case(2)
                                        <div class="cuadro_verde"></div>
                                            @break
                                        @case(3)
                                        <div class="cuadro_amarillo"></div>
                                            @break
                                        @case(4)
                                        <div class="cuadro_naranja"></div>

                                            @break
                                        @case(5)
                                        <div class="cuadro_rojo"></div>

                                            @break;
                                        @default
                                            <span>No hay registro</span>
                                    @endswitch
                                </td>
                            </tr>
                        </tbody>

                    </table>


                    <div class="row col-12 mt-4">
                        <div class="col-4" style="color:#345183;background-color: rgb(220, 255, 255);">
                            <strong>Razón del negocio por la que se debe aceptar el Riesgo</strong>
                        </div>
                        <div class="col-8" style="background-color:#cccccc;">

                            {{$cartaAceptacion->aceptacion_riesgo}}
                        </div>
                    </div>

                    <div class="row col-12 mt-4">
                        <div class="col-4" style="color:#345183;background-color: rgb(220, 255, 255);">
                            <strong>Controles compensatorios</strong>
                        </div>
                        <div class="col-8" style="background-color:#cccccc;">
                            {!!$cartaAceptacion->controles_compensatorios!!}
                        </div>
                    </div>

                    <div>
                        <div class="mt-5 text-center p-3" style="width:100%;color:#345183; background-color:#cccccc;">
                            <strong>3.Politicas/Control asociados al Riesgo</strong>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            @foreach ($controles as $control )
                            <li>

                                {{$control->anexo_indice}} {{$control->anexo_politica}}

                            </li>
                            @endforeach
                            <hr>
                        </div>
                    </div>

                    <div>
                        <div class="mt-5 text-center p-3" style="width:100%;color:#345183; background-color:#cccccc;">
                            <strong>4. Autorización de Aceptación de Riesgo (Nombre,Fecha)</strong>
                        </div>
                        <div class="row col-12">
                            <div class="col-4 p-4" style="color:#345183;background-color: rgb(220, 255, 255);">
                                <strong style="width:100%;color:#345183;">Director Responsable del Riesgo</strong>
                            </div>
                            <div class="col-5 p-4">
                                <span style="width:100%;color:#345183;">{{$cartaAceptacion->directores->name}}</span>
                            </div>
                            <div class="col-3 p-4">
                                <span style="width:100%;color:#345183;">{{$cartaAceptacion->fecha_aut_direct}}</span>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-4 p-4" style="color:#345183;background-color: rgb(220, 255, 255);">
                                <strong style="width:100%;color:#345183;">VP Responsable del Riesgo</strong>
                            </div>
                            <div class="col-5 p-4">
                                <span style="width:100%;color:#345183;">{{$cartaAceptacion->vicepresidentes->name}}</span>
                            </div>
                            <div class="col-3 p-4">
                                <span style="width:100%;color:#345183;">{{$cartaAceptacion->fecha_vp_aut}}</span>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-4 p-4" style="color:#345183;background-color: rgb(220, 255, 255);">
                                <strong style="width:100%;color:#345183;">Presidencia</strong>
                            </div>
                            <div class="col-5 p-4">
                                <span style="width:100%;color:#345183;">{{$cartaAceptacion->presidentes->name}}</span>
                            </div>
                            <div class="col-3 p-4">
                                <span style="width:100%;color:#345183;">{{$cartaAceptacion->fecha_aut_presidencia}}</span>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-4 p-4" style="color:#345183;background-color: rgb(220, 255, 255);">
                                <strong style="width:100%;color:#345183;">Vicepresidente de Operaciones</strong>
                            </div>
                            <div class="col-5 p-4">
                                <span style="width:100%;color:#345183;">{{$cartaAceptacion->vicepresidentesOperaciones->name}}</span>
                            </div>
                            <div class="col-3 p-4">
                                <span style="width:100%;color:#345183;">

                                    {{$cartaAceptacion->fecha_aut_viceoperaciones}}</span>
                            </div>
                        </div>
                    </div>



                    <div>
                        <div class="mt-5 text-center p-3" style="width:100%;color:#345183; background-color:#cccccc;">
                            <strong>Recomendaciones mandatorias de seguridad</strong>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            {!!$cartaAceptacion->recomendaciones!!}
                        </div>
                    </div>

                </div>
        </div>

</div>

@endsection
