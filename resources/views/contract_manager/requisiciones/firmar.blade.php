@extends('layouts.admin')

@section('content')
@section('titulo', 'Firmar Requisicion')
<link rel="stylesheet" href="{{ asset('css/requisitions/requisitions.css') }}{{ config('app.cssVersion') }}">

@if ($alerta)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                // title: 'No es posible acceder a esta vista.',
                imageUrl: `{{ asset('img/errors/cara-roja-triste.svg') }}`, // Replace with the path to your image
                imageWidth: 100, // Set the width of the image as needed
                imageHeight: 100,
                html: `<h4 style="color:red;">Colaboradores no disponibles</h4>
                        <br><p>Los colaboradores asignados se encuentran ausentes.</p><br>
                        <p>Es necesario acercarse con el administrador para solicitar que se agregue un responsable, de lo contrario no podrá firmar la requisición.</p>`,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido.',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to another view after user clicks OK
                    window.location.href = '{{ route('contract_manager.requisiciones') }}';
                }
            });
        });
    </script>
@endif

<div class="card card-content caja-blue">

    <div>
        <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="width:150px;">
    </div>

    <div>
        <h3 style="font-size: 22px; font-weight: bolder;">Bienvenido </h3>
        <h5 style="font-size: 17px; margin-top:10px;">En esta sección puedes generar tu firma electrónica</h5>
        <p style="margin-top:10px;">
            Aquí podrás firmar, revisar y procesar solicitudes de compra de manera rápida y sencilla, <br> optimizando
            el
            flujo de trabajo y asegurando un seguimiento transparente de todas las transacciones.
        </p>
    </div>
</div>
<div id="paso-firma" class="tab-content">
    <div class="card card-item doc-requisicion">
        <div class="flex header-doc">
            <div class="flex-item item-doc-img">
                @if ($organizacion->logo)
                    <img src="{{ asset($organizacion->logo) }}" style="width:100%; max-width:150px;">
                @else
                    <img src="{{ asset('sinLogo.png') }}" style="width:100%; max-width:150px;">
                @endif
            </div>
            <div class="flex-item info-med-doc-header">
                {{ $requisicion->sucursal->empresa }} <br>
                {{ $requisicion->sucursal->rfc }} <br>
                {{ $requisicion->sucursal->direccion }} <br>
            </div>
            <div class="flex-item item-header-doc-info" style="">
                <h4 style="font-size: 18px; color:var(--color-tbj);">REQUISICIÓN DE ADQUISICIONES</h4>
                <p>Folio: 00-00{{ $requisicion->id }}</p>
                <p>Fecha de solicitud: {{ date('d-m-Y', strtotime($requisicion->fecha)) }} </p>
            </div>
        </div>
        <div class="flex doc-blue">
            <div class="flex-item">
                <strong>Referencia:</strong><br>
                {{ $requisicion->referencia }}<br><br>
                <strong>Proyecto:</strong><br>
                @if ($requisicion->contrato === null)
                    <strong>Contrato Eliminado!</strong>
                @else
                    {{ optional($requisicion->contrato)->no_proyecto }} -
                    {{ optional($requisicion->contrato)->no_contrato }} -
                    {{ optional($requisicion->contrato)->nombre_servicio }}
                @endif
            </div>
            <div class="flex-item">
                <strong>Área que solicita:</strong><br>
                {{ $requisicion->area }}<br><br>
                <strong>Comprador:</strong><br>
                @isset($comprador->user->name)
                    {{ $comprador->user->name }}
                @endisset
            </div>
            <div class="flex-item">
                <strong>Solicita:</strong><br>
                {{ $requisicion->user }}<br><br>
            </div>
        </div>
        <div class="flex">
            <div class="flex-item">
                <strong> Producto o servicio:</strong>
            </div>
        </div>
        @foreach ($requisicion->productos_requisiciones as $producto)
            <div class="row">
                <div class="col s12 l4">
                    <strong> Cantidad:</strong><br><br>
                    <p>
                        {{ $producto->cantidad }}
                    </p>
                </div>
                <div class="col s12 l4">
                    <strong> Producto o servicio:</strong><br><br>
                    <p>
                        @isset($producto->producto->descripcion)
                            {{ $producto->producto->descripcion }}
                        @endisset
                    </p>
                </div>
                <div class="col s12 l4">
                    <strong> Especificaciones del producto o servicio:</strong><br><br>
                    <p>
                        {{ $producto->espesificaciones }}
                    </p>
                </div>
            </div>
            <hr>
        @endforeach
        <hr style="width: 80%; margin:auto;">
        @foreach ($requisicion->provedores_requisiciones as $proveedor)
            <div class="proveedores-doc" style="">
                <div class="flex header-proveedor-doc">
                    <div class="flex-item">
                        <strong>Proveedor: </strong> {{ $proveedor->proveedor }}
                    </div>
                </div>
                <div class="flex">
                    <div class="flex-item">
                        <small> -Provea contexto detallado de su necesidad de Adquisición, es importante mencionar si es
                            que la solicitud está ligada a algún proyecto en particular. -En caso de que no se brinde
                            detalle suficiente que sustente la compra, es no procedera.s </small>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l4">
                        <strong>Proveedor:</strong><br><br>
                        {{ $proveedor->proveedor }}
                    </div>
                    <div class="col s12  l4">
                        <strong>Detalle del producto:</strong><br><br>
                        {{ $proveedor->detalles }}
                    </div>
                    <div class="col s12 l4">
                        <strong>Comentarios:</strong><br><br>
                        {{ $proveedor->comentarios }}
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l4">
                        <strong>Nombre del contacto:</strong><br><br>
                        {{ $proveedor->contacto }}
                    </div>
                    <div class="col s12 l4">
                        <strong>Fecha Inicio:</strong><br><br>
                        {{ date('d-m-Y', strtotime($proveedor->fecha_inicio)) }}
                    </div>
                    <div class="col s12 l4">
                        <strong>Teléfono:</strong><br><br>
                        {{ $proveedor->cel }}
                    </div>
                    <div class="col s12 l4">
                        <br><br>
                        <strong>Correo Electrónico:</strong><br><br>
                        {{ $proveedor->contacto_correo }}
                    </div>
                    <div class="col s12 l4">
                        <br><br>
                        <strong>Fecha Fin:</strong><br><br>
                        {{ date('d-m-Y', strtotime($proveedor->fecha_fin)) }}
                    </div>
                    <div class="col s12 l4">
                        <br><br>
                        <strong>URL:</strong><br><br>
                        {{ $proveedor->url }}
                    </div>
                </div>
            </div>
        @endforeach

        @if ($requisicion->proveedor_catalogo != null)
            @foreach ($proveedores_catalogo as $prov)
                <div class="proveedores-doc" style="">
                    <div class="flex header-proveedor-doc">
                        <div class="flex-item">
                            <strong>Proveedor: </strong> @isset($prov->nombre)
                                {{ $prov->nombre }}
                            @endisset
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-item">
                            <small> -Provea contexto detallado de su necesidad de adquisición, es importante
                                mencionar si es que la solicitud está ligada a algún proyecto en particular. -En
                                caso de que no se brinde detalle suficiente que sustente la compra, esto no
                                procedera </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l4">
                            <strong>Razon social:</strong><br><br>
                            {{ $prov->razon_social }}
                        </div>
                        <div class="col s12 l4">
                            <strong>RFC:</strong><br><br>
                            {{ $prov->rfc }}
                        </div>
                        <div class="col s12 l4">
                            <strong>Contacto:</strong><br><br>
                            {{ $prov->contacto }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l4">
                            <strong>Fecha Inicio:</strong><br><br>
                            @isset($prov->fecha_inicio)
                                {{ date('d-m-Y', strtotime($prov->fecha_inicio)) }}
                            @else
                                La fecha de inicio no está disponible.
                            @endisset
                        </div>
                        <div class="col s12 l2">
                            <strong>Fecha Fin:</strong><br><br>
                            @isset($prov->fecha_fin)
                                {{ date('d-m-Y', strtotime($prov->fecha_fin)) }}
                            @else
                                La fecha fin no está disponible.
                            @endisset
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @if ($proveedor_indistinto)
            <div class="proveedores-doc" style="">
                <div class="flex header-proveedor-doc">
                    <div class="flex-item">
                        <strong>Proveedor: </strong> Indistinto
                    </div>
                </div>
                <div class="flex">
                    <div class="flex-item">
                        <small> -Provea contexto detallado de su necesidad de adquisición, es importante
                            mencionar si es que la solicitud está ligada a algún proyecto en particular. -En
                            caso de que no se brinde detalle suficiente que sustente la compra, esto no
                            procedera </small>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l4">
                        <strong>Fecha Inicio:</strong><br><br>
                        @isset($proveedor_indistinto->fecha_inicio)
                            {{ date('d-m-Y', strtotime($proveedor_indistinto->fecha_inicio)) }}
                        @else
                            La fecha de inicio no está disponible.
                        @endisset
                    </div>
                    <div class="col s12 l4">
                        <strong>Fecha Fin:</strong><br><br>
                        @isset($proveedor_indistinto->fecha_fin)
                            {{ date('d-m-Y', strtotime($proveedor_indistinto->fecha_fin)) }}
                        @else
                            La fecha fin no está disponible.
                        @endisset
                    </div>

                </div>
            </div>
        @endif
        <div class="caja-firmas-doc">
            <div class="flex" style="margin-top: 70px;">
                <div class="flex-item">
                    @if ($requisicion->firma_solicitante)
                        <img src="{{ $requisicion->firma_solicitante }}" class="img-firma">
                        <p>{{ $firma_siguiente->solicitante->name ?? '' }}</p>
                        <p>{{ $requisicion->fecha_firma_solicitante_requi }}</p>
                    @else
                        <div style="height: 137px;"></div>
                    @endif
                    <hr>
                    <p>
                        <small>FECHA, FIRMA Y NOMBRE DEL SOLICITANTE </small>
                    </p>
                </div>
                <div class="flex-item">
                    @if ($requisicion->firma_jefe)
                        <img src="{{ $requisicion->firma_jefe }}" class="img-firma">
                        <p>{{ $firma_siguiente->jefe->name ?? '' }}</p>
                        <p>{{ $requisicion->fecha_firma_jefe_requi }}</p>
                    @else
                        <div style="height: 137px;"></div>
                    @endif
                    <hr>
                    <p>
                        <small>FECHA, FIRMA Y NOMBRE DEL JEFE INMEDIATO</small>
                    </p>
                </div>
            </div>
            <div class="flex">
                <div class="flex-item">
                    @if ($requisicion->firma_finanzas)
                        <img src="{{ $requisicion->firma_finanzas }}" class="img-firma">
                        <p>{{ $firma_siguiente->responsableFinanzas->name ?? '' }} </p>
                        <p>{{ $requisicion->fecha_firma_finanzas_requi }}</p>
                    @else
                        <div style="height: 137px;"></div>
                    @endif
                    <hr>
                    <p>
                        <small> FECHA, FIRMA Y NOMBRE DE FINANZAS</small>
                    </p>
                </div>
                <div class="flex-item">
                    @if ($requisicion->firma_compras)
                        <img src="{{ $requisicion->firma_compras }}" class="img-firma">
                        <p>{{ $requisicion->comprador->user->name ?? '' }} </p>
                        <p>{{ $requisicion->fecha_firma_comprador_requi }}</p>
                    @else
                        <div style="height: 137px;"></div>
                    @endif
                    <hr>
                    <p>
                        <small> FECHA, FIRMA Y NOMBRE DE COMPRADORES</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="flex-item">
                <small><i style="color: #2395AA;">-NOTA : En caso de ser capacitación se necesita el visto bueno de
                        Gestión de talento.</i></small>
            </div>
        </div>
    </div>
    @if (is_null($requisicion->firma_solicitante) ||
            is_null($requisicion->firma_jefe) ||
            is_null($requisicion->firma_finanzas) ||
            is_null($requisicion->firma_compras))
        <div class="card card-content" style="margin-bottom: 30px">
            <form method="POST" id="myForm"
                action="{{ route('contract_manager.requisiciones.firmar-update', ['tipo_firma' => $tipo_firma, 'id' => $requisicion->id]) }}">
                @csrf
                <div class="">
                    <h5><strong>Firma*</strong></h5>
                    <p>
                        Indispensable firmar la requisición antes de guardar y enviarla a aprobación de lo contrario
                        podrá
                        ser rechazada por alguno de los colaboradores
                    </p>
                </div>
                <div class="flex caja-firmar" wire:ignore>
                    <div class="flex-item"
                        style="display:flex; justify-content: center; flex-direction: column; align-items:center;">
                        <div id="firma_content" class="caja-space-firma"
                            style="display:flex; justify-content: center; flex-direction: column; align-items:center;">
                            <canvas id="firma_requi" width="500px" height="300px">
                                Navegador no compatible
                            </canvas>
                            <input type="hidden" name="firma" id="firma">
                        </div>
                        <div>
                            <div class="btn"
                                style="color: white; background:  gray !important; transform: translateY(-40px) scale(0.8);"
                                id="clear">Limpiar</div>
                        </div>
                    </div>
                </div>
                <div class="flex" style="justify-content: end; gap:10px;">
                    {{--  <div class="btn btn-secundario" style="background: #959595 !important"><i class="fa-solid fa-chevron-left icon-prior"></i> Regresar </div>  --}}
                </div>
            </form>
            <form method="POST"
                action="{{ route('contract_manager.requisiciones.rechazada', ['id' => $requisicion->id]) }}">
                @csrf
                <div class="flex" style="position: relative; top: -1rem;  justify-content: space-between;">
                    <button class="btn btn-primary" style="background: #454545 !important;">RECHAZAR
                        REQUISICIÓN</button>
                    <div onclick="validar();" style="" class="btn btn-primary">Firmar</div>
                </div>
            </form>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function validar(params) {
        var x = $("#firma").val();
        if (x) {
            document.getElementById("myForm").submit();
        } else {
            Swal.fire(
                'Aun no ha firmado',
                'Porfavor Intentelo nuevamente',
                'error');
        }
    }
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.signature.min.js') }}"></script>



@endsection
@section('scripts')
<script>
    $('select').select2('destroy');
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
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

            if (document.getElementById('firma_requi')) {
                renderCanvas("firma_requi", "clear");
            }

        })();

        $('#firma_requi').mouseleave(function() {
            var canvas = document.getElementById('firma_requi');
            var dataUrl = canvas.toDataURL();
            $('#firma').val(dataUrl);
        });

        function renderCanvas(contenedor, clearBtnCanvas) {

            var canvas = document.getElementById(contenedor);
            console.log(canvas);
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
    });
</script>

<script>
    const firmaCanvas = document.getElementById('firma_requi');

    function disableScroll() {
        document.body.style.overflow = 'hidden';
    }

    function enableScroll() {
        document.body.style.overflow = '';
    }

    firmaCanvas.addEventListener('mousedown', disableScroll);
    firmaCanvas.addEventListener('touchstart', disableScroll);

    firmaCanvas.addEventListener('mouseup', enableScroll);
    firmaCanvas.addEventListener('touchend', enableScroll);

    document.addEventListener('mouseup', enableScroll);
    document.addEventListener('touchend', enableScroll);
</script>
@endsection
