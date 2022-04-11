@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .datos_der_cv {
            color: #fff;
        }

        .cuadro_rojo {
            width: 50px;
            height: 50px;
            background-color: red;
        }

        .cuadro_amarillo {
            width: 50px;
            height: 50px;
            background-color: yellow;
        }

        .cuadro_verde_limon {
            width: 50px;
            height: 50px;
            background-color: rgb(50, 205, 63);
        }

        .cuadro_verde {
            width: 50px;
            height: 50px;
            background-color: rgb(61, 114, 77);
        }

        .cuadro_naranja {
            width: 50px;
            height: 50px;
            background-color: rgb(255, 136, 0);
        }

    </style>


    <h5 class="col-12 titulo_general_funcion">Carta de Aceptación de Riesgos</h5>

    <div class="mt-4 row justify-content-center">

        <div class="card col-sm-12 col-md-11 m-0">
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
                                <h2 class="mb-2 text-center" style="color:#345183"><strong>CARTA DE ACEPTACIÓN DE
                                        RIESGOS</strong></h2>

                            </div>

                            <div class="row">
                                <p style="font-size:12px;">**La vigencia de la carta aceptación de riesgos es aplicable al
                                    ciclo 2022 y se debe
                                    evaluar y renovar ante un cambio de responsable, transferencia, eliminación del riesgos
                                    o caducidad de la misma
                                </p>
                            </div>


                            <div class="row">


                                @livewire('body-carta-aceptacion',['proceso'=>$cartaAceptacion->proceso_id,'tipo'=>'show',
                                'cartaAceptacion'=>$cartaAceptacion])

                                <div class="row col-12 mt-2 pl-0 ml-2">
                                    <div class="col-4" style="color:#345183;background-color: rgb(220, 255, 255);">
                                        <strong style="font-size:12px;">Razón del negocio por la que se debe aceptar el
                                            Riesgo</strong>
                                    </div>
                                    <div class="col-8" style="font-size:12px; background-color:#cccccc;">

                                        {{ $cartaAceptacion->aceptacion_riesgo }}
                                    </div>
                                </div>

                                <div class="row col-12 mt-4 pl-0 ml-2">
                                    <div class="col-4"
                                        style="font-size:12px; color:#345183;background-color: rgb(220, 255, 255);">
                                        <strong>Controles compensatorios</strong>
                                    </div>
                                    <div class="col-8" style="font-size:12px; background-color:#cccccc;">
                                        {!! $cartaAceptacion->controles_compensatorios !!}
                                    </div>
                                </div>

                                <div class="mt-5 text-center p-3"
                                    style="width:100%;color:#345183; background-color:#cccccc;">
                                    <strong style="font-size:12px;">3.Politicas/Control asociados al Riesgo</strong>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    @foreach ($controles as $control)
                                        <li style="font-size:12px;">

                                            {{ $control->declaracion_aplicabilidad->anexo_indice }}
                                            {{ $control->declaracion_aplicabilidad->anexo_politica }}

                                        </li>
                                    @endforeach
                                    <hr>
                                </div>
                                <div class="mt-5 text-center p-3"
                                    style="width:100%;color:#345183; background-color:#cccccc;">
                                    <strong style="font-size:12px;">4. Hallazgos asociados al Riesgo</strong>
                                </div>
                                <div class="row col-12">
                                    <div class="col-4 p-4" style="color:#345183;background-color: rgb(220, 255, 255);">
                                        <strong style="font-size:12px; width:100%;color:#345183;">Hallazgos de auditoría
                                            interna / externa</strong>
                                    </div>
                                    <div class="col-5 p-4">
                                        <span style="font-size:12px; width:100%;color:#345183;"></span>
                                    </div>

                                </div>
                                <div>
                                    <table class="table mt-4 w-100 p-0 m-0" id="contactos_table">
                                        <thead>
                                            <tr class="negras">
                                                <th class="text-center"
                                                    style="font-size:12px; color:#345183; background-color:#cccccc;"
                                                    colspan="5">
                                                    <div>
                                                        5. Autorización de Aceptación de Riesgo
                                                        (Nombre, Comentarios, Firma, Fecha)
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="{{$esAprobador?2:1}}"
                                                    style="min-width:200px; color:#345183;background-color: rgb(220, 255, 255);">
                                                    <strong style="font-size:12px; color:#345183;">Dueño del Riesgo</strong>
                                                </td>
                                                <td style="min-width:200px;">
                                                    <span
                                                        style="font-size:12px; width:100%;color:#345183;">{{ $cartaAceptacion->responsables ? $cartaAceptacion->responsables->name : 'Sin registrar' }}</span>
                                                </td>
                                                <td style="min-width:250px;">
                                                    @if ($esAprobador)
                                                    <textarea id="comentarios-dueno" class="form-control"></textarea>
                                                    @endif
                                                </td>
                                                <td style="min-width:90px;">
                                                    <span style="font-size:12px; width:100%;color:#345183;">
                                                        @if(!is_null($cartaAceptacion->fecha_aprobacion))
                                                            {{ \Carbon\Carbon::parse($cartaAceptacion->fecha_aprobacion)->format('d-m-Y') }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td style="min-width:90px;">
                                                    @if ($esAprobador)
                                                    <i style="font-size:20px; cursor:pointer"
                                                        class="text-success fas fa-check-circle"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if ($esAprobador)
                                            <tr>
                                                <td colspan="4">
                                                    <div class="row">
                                                        <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                            <canvas style="background-color:#fff" id="sig-dueno-canvas">
                                                                Navegador no compatible
                                                            </canvas>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                        <button class="btn btn-sm" id="sig-dueno-clearBtn"><i
                                                            class="mr-2 fas fa-trash-alt"></i>Limpiar</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td rowspan="{{$esAprobador?2:1}}"
                                                    style="min-width:200px; color:#345183;background-color: rgb(220, 255, 255);">
                                                    <strong style="font-size:12px; color:#345183;">Director Responsable del
                                                        Riesgo</strong>
                                                </td>
                                                <td style="min-width:200px;">
                                                    <span
                                                        style="font-size:12px; width:100%;color:#345183;">{{ $cartaAceptacion->directores ? $cartaAceptacion->directores->name : 'Sin registrar' }}
                                                    </span>
                                                </td>
                                                <td style="min-width:250px;">
                                                    @if ($esAprobador)
                                                    <textarea id="comentarios-director" class="form-control"></textarea>
                                                    @endif
                                                </td>
                                                <td style="min-width:90px;">
                                                    <span style="font-size:12px; width:100%;color:#345183;">
                                                        @if(!is_null($cartaAceptacion->fecha_aprobacion))
                                                            {{ \Carbon\Carbon::parse($cartaAceptacion->fecha_aprobacion)->format('d-m-Y') }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td style="min-width:90px;">
                                                    @if ($esAprobador)
                                                    <i style="font-size:20px; cursor:pointer"
                                                        class="text-success fas fa-check-circle"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if ($esAprobador)
                                            <tr>
                                                <td colspan="4">
                                                <div class="row">
                                                    <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                        <canvas style="background-color:#fff" id="sig-director-canvas">
                                                            Navegador no compatible
                                                        </canvas>
                                                    </div>
                                                 </div>
                                                <div class="row">
                                                    <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                    <button class="btn btn-sm" id="sig-director-clearBtn"><i
                                                        class="mr-2 fas fa-trash-alt"></i>Limpiar</button>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td rowspan="{{$esAprobador?2:1}}"
                                                    style="min-width:200px; color:#345183;background-color: rgb(220, 255, 255);">
                                                    <strong style="font-size:12px; color:#345183;">VP Responsable del
                                                        Riesgo</strong>
                                                </td>
                                                <td style="min-width:200px;">
                                                    <span
                                                        style="font-size:12px; width:100%;color:#345183;">{{ $cartaAceptacion->vicepresidentes ? $cartaAceptacion->vicepresidentes->name : 'Sin registrar' }}</span>
                                                </td>
                                                <td style="min-width:250px;">
                                                    @if ($esAprobador)
                                                    <textarea id="comentarios-vp-director" class="form-control"></textarea>
                                                    @endif
                                                </td>
                                                <td style="min-width:90px;">
                                                    <span style="font-size:12px; width:100%;color:#345183;">
                                                        @if(!is_null($cartaAceptacion->fecha_aprobacion))
                                                            {{ \Carbon\Carbon::parse($cartaAceptacion->fecha_aprobacion)->format('d-m-Y') }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td style="min-width:90px;">
                                                    @if ($esAprobador)
                                                    <i style="font-size:20px; cursor:pointer"
                                                        class="text-success fas fa-check-circle"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if ($esAprobador)
                                            <tr>
                                                <td colspan="4">
                                                <div class="row">
                                                    <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                        <canvas style="background-color:#fff" id="sig-vpresponsable-canvas">
                                                            Navegador no compatible
                                                        </canvas>
                                                    </div>
                                                 </div>
                                                <div class="row">
                                                    <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                    <button class="btn btn-sm" id="sig-vpresponsable-clearBtn"><i
                                                        class="mr-2 fas fa-trash-alt"></i>Limpiar</button>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td rowspan="{{$esAprobador?2:1}}"
                                                    style="min-width:200px; color:#345183;background-color: rgb(220, 255, 255);">
                                                    <strong style="font-size:12px; color:#345183;">Vicepresidente de
                                                        Operaciones</strong>
                                                </td>
                                                <td style="min-width:200px;">
                                                    <span
                                                        style="font-size:12px; width:100%;color:#345183;">{{ $cartaAceptacion->vicepresidentesOperaciones? $cartaAceptacion->vicepresidentesOperaciones->name: 'Sin registrar' }}</span>
                                                </td>
                                                <td style="min-width:250px;">
                                                    @if ($esAprobador)
                                                    <textarea id="comentarios-vpoperaciones" class="form-control"></textarea>
                                                    @endif
                                                </td>
                                                <td style="min-width:90px;">
                                                    <span style="font-size:12px; width:100%;color:#345183;">
                                                        @if(!is_null($cartaAceptacion->fecha_aprobacion))
                                                            {{ \Carbon\Carbon::parse($cartaAceptacion->fecha_aprobacion)->format('d-m-Y') }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td style="min-width:90px;">
                                                    @if ($esAprobador)
                                                    <i style="font-size:20px; cursor:pointer"
                                                        class="text-success fas fa-check-circle"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if ($esAprobador)
                                            <tr>
                                                <td colspan="4">
                                                <div class="row">
                                                    <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                        <canvas style="background-color:#fff" id="sig-vpoperaciones-canvas">
                                                            Navegador no compatible
                                                        </canvas>
                                                    </div>
                                                 </div>
                                                <div class="row">
                                                    <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                    <button class="btn btn-sm" id="sig-vpoperaciones-clearBtn"><i
                                                        class="mr-2 fas fa-trash-alt"></i>Limpiar</button>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td rowspan="{{$esAprobador?2:1}}"
                                                    style="min-width:200px; color:#345183;background-color: rgb(220, 255, 255);">
                                                    <strong style="font-size:12px; color:#345183;">Presidencia</strong>
                                                </td>
                                                <td style="min-width:200px;">
                                                    <span
                                                        style="font-size:12px; width:100%;color:#345183;">{{ $cartaAceptacion->presidentes ? $cartaAceptacion->presidentes->name : 'Sin registrar' }}</span>
                                                </td>
                                                <td style="min-width:250px;">
                                                    @if ($esAprobador)
                                                    <textarea id="comentarios-presidente" class="form-control"></textarea>
                                                    @endif
                                                </td>
                                                <td style="min-width:90px;">
                                                    <span style="font-size:12px; width:100%;color:#345183;">
                                                        @if(!is_null($cartaAceptacion->fecha_aprobacion))
                                                            {{ \Carbon\Carbon::parse($cartaAceptacion->fecha_aprobacion)->format('d-m-Y') }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td style="min-width:90px;">
                                                    @if ($esAprobador)
                                                    <i style="font-size:20px; cursor:pointer"
                                                        class="text-success fas fa-check-circle"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if ($esAprobador)
                                            <tr>
                                                <td colspan="4">
                                                <div class="row">
                                                    <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                        <canvas style="background-color:#fff" id="sig-presidencia-canvas">
                                                            Navegador no compatible
                                                        </canvas>
                                                    </div>
                                                 </div>
                                                <div class="row">
                                                    <div class="col-md-12" style="display: flex;align-items: center;justify-content: center;">
                                                    <button class="btn btn-sm" id="sig-presidencia-clearBtn"><i
                                                        class="mr-2 fas fa-trash-alt"></i>Limpiar</button>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>




                                <div class="mt-5 text-center p-3"
                                    style="width:100%;color:#345183; background-color:#cccccc;">
                                    <strong style="font-size:12px;">6. Recomendaciones mandatorias de seguridad</strong>
                                </div>
                                <div style="font-size:12px;" class="col-md-12 col-lg-12 col-sm-12">
                                    {!! $cartaAceptacion->recomendaciones !!}
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
                {{-- </div> --}}



                {{-- <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
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

                    </table> --}}

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
         (function() {

            window.requestAnimFrame = (function(callback) {
                return window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function(callback) {
                        window.setTimeout(callback, 1000 / 60);
                    };
            })();


        })();
        document.addEventListener('DOMContentLoaded', function(){
        renderCanvas('sig-dueno-canvas','sig-dueno-clearBtn');
        renderCanvas('sig-director-canvas','sig-director-clearBtn');
        renderCanvas('sig-vpresponsable-canvas','sig-vpresponsable-clearBtn');
        renderCanvas('sig-presidencia-canvas','sig-presidencia-clearBtn');
        renderCanvas('sig-vpoperaciones-canvas','sig-vpoperaciones-clearBtn');


        function renderCanvas(contenedor, clearBtnCanvas) {
            var canvas = document.getElementById(contenedor);
            var ctx = canvas.getContext("2d");
            ctx.strokeStyle = "#222222";
            ctx.lineWidth = 1;

            var drawing = false;
            var mousePos = {
                x: 0,
                y: 0
            };
            var lastPos = mousePos;

            canvas.addEventListener("mousedown", function(e) {
                drawing = true;
                lastPos = getMousePos(canvas, e);
            }, false);

            canvas.addEventListener("mouseup", function(e) {
                drawing = false;
            }, false);

            canvas.addEventListener("mousemove", function(e) {
                mousePos = getMousePos(canvas, e);
            }, false);

            // Add touch event support for mobile
            canvas.addEventListener("touchstart", function(e) {

            }, false);

            canvas.addEventListener("touchmove", function(e) {
                var touch = e.touches[0];
                var me = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas, e);
                var touch = e.touches[0];
                var me = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchend", function(e) {
                var me = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(me);
            }, false);

            function getMousePos(canvasDom, mouseEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: mouseEvent.clientX - rect.left,
                    y: mouseEvent.clientY - rect.top
                }
            }

            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                }
            }

            function renderCanvas() {
                if (drawing) {
                    ctx.moveTo(lastPos.x, lastPos.y);
                    ctx.lineTo(mousePos.x, mousePos.y);
                    ctx.stroke();
                    lastPos = mousePos;
                }
            }

            // Prevent scrolling when touching the canvas
            document.body.addEventListener("touchstart", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchend", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchmove", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);

            (function drawLoop() {
                requestAnimFrame(drawLoop);
                renderCanvas();
            })();

            function clearCanvas() {
                canvas.width = canvas.width;
            }

            function isCanvasBlank() {
                const context = canvas.getContext('2d');

                const pixelBuffer = new Uint32Array(
                    context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
                );

                return !pixelBuffer.some(color => color !== 0);
            }

            // Set up the UI
            // var sigText = document.getElementById(dataBaseCanvas);
            // var sigImage = document.getElementById(imageCanvas);
            var clearBtn = document.getElementById(clearBtnCanvas);
            // var submitBtn = document.getElementById(submitBtnCanvas);
            clearBtn.addEventListener("click", function(e) {
                clearCanvas();
                // sigText.innerHTML = "Data URL for your signature will go here!";
                // sigImage.setAttribute("src", "");
            }, false);
            // submitBtn.addEventListener("click", function(e) {
            //     const blank = isCanvasBlank();
            //     if (!blank) {
            //         // var dataUrl = canvas.toDataURL();
            //         // sigText.innerHTML = dataUrl;
            //         // sigImage.setAttribute("src", dataUrl);
            //     } else {
            //         if (toastr) {
            //             toastr.info('No has firmado en el canvas');
            //         } else {
            //             alert('No has firmado en el canvas');
            //         }
            //     }
            // }, false);

        }

        function isCanvasEmpty(canvas) {
            const context = canvas.getContext('2d');

            const pixelBuffer = new Uint32Array(
                context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
            );

            return !pixelBuffer.some(color => color !== 0);
        }
    })
    </script>
@endsection
