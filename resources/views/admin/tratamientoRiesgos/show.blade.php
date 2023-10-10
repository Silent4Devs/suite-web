@extends('layouts.admin')
@section('content')


    <style>
        span.errors {
            font-size: 11px;
        }

        canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }


        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(35px at 50% 50%);
            height: 70px;
        }

        .card-custom {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 10px;
            margin: auto;
            text-align: center;
            height: 100%;
            font-family: arial;
        }

        .title-custom {
            color: grey;
            font-size: 14px;
        }

        .circulo-rojo {
            width: 100px;
            height: 100px;
            -moz-border-radius: 20%;
            -webkit-border-radius: 20%;
            border-radius: 50%;
            background: #FF417B;
        }

        .circulo-naranja {
            width: 10px;
            height: 10px;
            -moz-border-radius: 10%;
            -webkit-border-radius: 10%;
            border-radius: 50%;
            background: #FFCB63;
        }

        @media print {
            header {
                display: none !important;
            }

            .ps__rail-y {
                display: none !important;
            }

            .ps__thumb-y {
                display: none !important;
            }

            .titulo_general_funcion {
                display: none !important;
            }

            #sidebar {
                display: none !important;
            }

            body {
                background-color: #fff !important;
            }

            #but {
                display: none !important;
            }

            .datos_der_cv {
                margin-right: -50px !important;


            }

            .table th td:nth-child(1) {
                min-width: 100px;
            }

            .print-none {
                display: none !important;
            }
        }
    </style>

    <div class="print-none">
        {{ Breadcrumbs::render('admin.tratamiento-riesgos.show') }}
    </div>

    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">
                    <a href="{{ route('admin.tratamiento-riesgos.index') }}" class="btn_cancelar">Regresar</a>
                    <button class="btn btn-danger print-none" style="position: absolute; right:20px;"
                        onclick="javascript:window.print()">
                        <i class="fas fa-print"></i>
                        Imprimir
                    </button>

                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::getFirst();
                        $logotipo = $organizacion->logotipo;
                        $empresa = $organizacion->empresa;
                    @endphp

                    <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                        <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                            <img src="{{ asset($logotipo) }}" class="mt-2" style="width:90px;">
                        </div>
                        <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                            <span
                                style="font-size:13px; text-transform: uppercase;color:#345183;">{{ $empresa }}</span>
                            <br>
                            <span style="color:#345183; font-size:15px;"><strong>Plan de Tratamiento</strong></span>

                        </div>
                        <div class="col-3 p-2">
                            <span style="color:#345183;">Fecha:
                                {{ \Carbon\Carbon::parse($tratamientoRiesgo->created_at)->format('d-m-Y') }}
                            </span>
                        </div>
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">ID Riesgo:</span>
                        <strong>{{ $tratamientoRiesgo->identificador ? $tratamientoRiesgo->identificador : 'sin registro' }}</strong>
                    </div>


                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Fecha compromiso:</span>
                        <strong>{{ \Carbon\Carbon::parse($tratamientoRiesgo->fechacompromiso)->format('d-m-Y') }}</strong>
                        </span>
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Proceso:</span>
                        <strong>{{ $tratamientoRiesgo->proceso ? $tratamientoRiesgo->proceso->nombre : 'Sin registro' }}</strong>
                        </span>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Dueño del riesgo:</span>

                        <strong>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->name : 'sin registro' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Puesto:</span>

                        <strong>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->puesto : 'sin registro' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Área:</span>

                        <strong>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->area->area : 'sin registro' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Inversión requerida:</span>
                        @if ($tratamientoRiesgo->inversion_requerida == 1)
                            <strong style="text-align:left">Sí</strong>
                        @elseif($tratamientoRiesgo->inversion_requerida == 0)
                            <strong style="text-align:left">No</strong>
                        @else
                            <strong style="text-align:left">No hay dato</strong>
                        @endif
                    </div>


                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Descripción del Riesgo</span>

                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Tipo de Riesgo:</span>

                        @if ($tratamientoRiesgo->tipo_riesgo == 1)
                            <strong style="text-align:left">Positivo</strong>
                        @elseif($tratamientoRiesgo->tipo_riesgo == 0)
                            <strong style="text-align:left">Negativo</strong>
                        @else
                            <strong style="text-align:left">No hay dato</strong>
                        @endif
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Riesgo Total:</span>
                        @if ($tratamientoRiesgo->riesgototal == null)
                            <span>Sin registro</span>
                        @else
                            @if ($tratamientoRiesgo->riesgototal >= 136 && $tratamientoRiesgo->riesgototal <= 185)
                                <i class="fas fa-circle" style="color:#FF417B;font-size:10pt;"></i><strong>
                                    {{ $tratamientoRiesgo->riesgototal }}</strong>
                            @elseif ($tratamientoRiesgo->riesgototal >= 91 && $tratamientoRiesgo->riesgototal <= 135)
                                <i class="fas fa-circle" style="color:#FFAC6A;font-size:10pt;"></i><strong>
                                    {{ $tratamientoRiesgo->riesgototal }}</strong>
                            @elseif ($tratamientoRiesgo->riesgototal >= 46 && $tratamientoRiesgo->riesgototal >= 90)
                                <i class="fas fa-circle" style="color:#FFCB63;font-size:10pt;"></i>
                                {{ $tratamientoRiesgo->riesgototal }}</strong>
                            @elseif ($tratamientoRiesgo->riesgototal >= 0 && $tratamientoRiesgo->riesgototal <= 45)
                                <i class="fas fa-circle" style="color:#6DC866;font-size:10pt;"></i>
                                {{ $tratamientoRiesgo->riesgototal }}</strong>
                            @endif
                        @endif
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Riesgo Residual:</span>
                        @if ($tratamientoRiesgo->riesgo_total_residual == null)
                            <span>Sin registro</span>
                        @else
                            @if ($tratamientoRiesgo->riesgo_total_residual >= 136 && $tratamientoRiesgo->riesgo_total_residual <= 185)
                                <i class="fas fa-circle" style="color:#FF417B;font-size:10pt;"></i><strong>
                                    {{ $tratamientoRiesgo->riesgo_total_residual }}</strong>
                            @elseif ($tratamientoRiesgo->riesgo_total_residual >= 91 && $tratamientoRiesgo->riesgo_total_residual <= 135)
                                <i class="fas fa-circle" style="color:#FFAC6A;font-size:10pt;"></i><strong>
                                    {{ $tratamientoRiesgo->riesgo_total_residual }}</strong>
                            @elseif ($tratamientoRiesgo->riesgo_total_residual >= 46 && $tratamientoRiesgo->riesgo_total_residual >= 90)
                                <i class="fas fa-circle" style="color:#FFCB63;font-size:10pt;"></i><strong>
                                    {{ $tratamientoRiesgo->riesgo_total_residual }}</strong>
                            @elseif ($tratamientoRiesgo->riesgo_total_residual >= 0 && $tratamientoRiesgo->riesgo_total_residual <= 45)
                                <i class="fas fa-circle" style="color: #6DC866;font-size:10pt;"></i><strong>
                                    {{ $tratamientoRiesgo->riesgo_total_residual }}</strong>
                            @endif
                        @endif
                    </div>

                    <div class="col-12 m-0 p-0" style="color:#18183c">
                        <br>
                        {!! $tratamientoRiesgo->descripcionriesgo !!}
                    </div>


                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Acciones de tratamiento</span>
                    </div>

                    <div class="col-12 m-0 p-0" style="color:#18183c">
                        {!! $tratamientoRiesgo->acciones !!}
                    </div>

                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Participantes</span>
                    </div>

                    @foreach ($tratamientoRiesgo->participantes as $participante)
                        <span style="color:#18183c">Nombre:<strong> {{ $participante->name }}</strong></span>
                        <br>
                        <span style="color:#18183c">Puesto:<strong> {{ $participante->puesto }}</strong></span>
                        <br>
                        <span style="color:#18183c">Área:<strong> {{ $participante->area->area }}</strong></span>
                        <br>
                    @endforeach


                    <br>
                    <br>
                    <div class="row col-12 ml-0" id="contenedor_firmas">

                        <div class="col-12 p-2" style="color:#18183c; text-align: center;">
                            @if ($tratamientoRiesgo->id_dueno == auth()->user()->empleado->id)
                                @if ($tratamientoRiesgo->es_aprobado == 'aprobado')
                                    @if ($tratamientoRiesgo->firma_responsable_aprobador == null)
                                        <div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6">
                                                    <canvas id="sig-responsable-aprobar-canvas" style="width:100%;">
                                                        Navegador no compatible
                                                    </canvas>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{-- <button class="btn btn-sm btn-success"
                                            id="sig-evaluador-submitBtn">Confirmar</button> --}}
                                                    <button class="btn btn-sm" data-action="firmar"
                                                        data-tipo="responsable_aprobador"
                                                        id="sig-responsable-aprobar-guardar"><i
                                                            class="mr-2 fas fa-check"></i>Guardar</button>
                                                    <button class="btn btn-sm" id="sig-responsable-aprobar-clearBtn"><i
                                                            class="mr-2 fas fa-trash-alt"></i>Limpiar</button>

                                                </div>
                                            </div>


                                            <br />
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea id="sig-responsable-aprobar-dataUrl" readonly class=" form-control d-none" rows="5">Data URL de tu firma será almacenada aquí</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <img
                                            src="{{ asset($route . $tratamientoRiesgo->firma_responsable_aprobador) }}"></img>
                                    @endif
                                @elseif($tratamientoRiesgo->es_aprobado == 'pendiente')
                                    <div class=" text-center justify-content-center aprobar-planificacion">

                                        <button class=" btn btn-sm text-success" data-action="aprobar"
                                            data-type="aprobacion" id="btn-aprobar" style="display:inline-block"><i
                                                class="mr-2 text-success far fa-thumbs-up"
                                                style="font-size:12pt;"></i>Aprobar</button>
                                        <button class=" btn btn-sm text-danger" data-action="rechazar"
                                            data-type="aprobacion" id="btn-rechazar" style="display:inline-block"><i
                                                class="text-danger mr-2  far fa-thumbs-down"
                                                style="font-size:12pt;"></i>Rechazar</button>

                                    </div>
                                @elseif($tratamientoRiesgo->es_aprobado == 'rechazado')
                                    <div class="mt-2 mb-2">
                                        <strong class="text-danger mt-4">Solicitud rechazada</strong>
                                    </div>
                                @endif

                            @endif
                            <div>
                                @if ($tratamientoRiesgo->id_dueno == auth()->user()->empleado->id)
                                    <strong>Dueño del riesgo</strong>
                                    <br>
                                    <span>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->name : 'Sin registro' }}</span>
                                    <br>
                                    <span>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->puesto : 'Sin registro' }}</span>
                                @else
                                    @if (isset($tratamientoRiesgo->firma_responsable_aprobador))
                                        <img
                                            src="{{ asset($route . $tratamientoRiesgo->firma_responsable_aprobador) }}"></img>
                                        <br>
                                        <strong>Dueño del riesgo</strong>
                                        <br>
                                        <span>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->name : 'Sin registro' }}</span>
                                        <br>
                                        <span>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->puesto : 'Sin registro' }}</span>
                                    @else
                                        <br>
                                        <strong style="color:#8b7f7f">Sin firma</strong>
                                        <br>
                                        <br>
                                        <strong>Dueño del riesgo</strong>
                                        <br>
                                        <span>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->name : 'Sin registro' }}</span>
                                        <br>
                                        <span>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->puesto : 'Sin registro' }}</span>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>





                </div>

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

            if (document.getElementById('sig-evaluador-canvas')) {
                renderCanvas("sig-evaluador-canvas", "sig-evaluador-clearBtn");

            }
            if (document.getElementById('sig-responsable-canvas')) {
                renderCanvas("sig-responsable-canvas", "sig-responsable-clearBtn");

            }
            if (document.getElementById('sig-responsable-aprobar-canvas')) {
                renderCanvas("sig-responsable-aprobar-canvas", "sig-responsable-aprobar-clearBtn");
            }


        })();

        //aprobar y rechazar
        // 1500 milisegundos en que tarda de recargar la pagina
        document.querySelector('.aprobar-planificacion')?.addEventListener('click', (e) => {
            e.preventDefault();
            if (e.target.getAttribute('data-type') == 'aprobacion') {
                let tipo = e.target.getAttribute('data-action');
                let url = "{{ route('admin.tratamiento-riesgos.firma-aprobacion') }}";
                let aprobado = tipo == 'aprobar' ? '1' : '0';
                let controlCambios = @json($tratamientoRiesgo);
                let mensajeBtn = tipo == 'rechazar' ? 'Rechazar' : 'Aprobar';
                Swal.fire({
                    title: 'Esta seguro que desea ' + tipo + '?',
                    text: 'comentarios',
                    input: 'textarea',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: mensajeBtn,
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (comentarios) => {
                        return fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                },
                                body: JSON.stringify({
                                    aprobado,
                                    id: controlCambios.id,
                                    comentarios
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        let mensaje = tipo == 'rechazar' ? 'Rechazado' : 'Aprobado';
                        Swal.fire('', mensaje + ' con éxito', 'success').then(() => {
                            window.location.reload();
                        })
                    }
                })

            }
        });
        // // fin aprobación


        if (document.getElementById('contenedor_firmas')) {
            document.getElementById('contenedor_firmas').addEventListener('click', (e) => {
                if (e.target.getAttribute('data-action') == 'firmar') {

                    e.preventDefault();
                    let btnId = e.target.getAttribute('id');
                    let canvasId = btnId.replaceAll('guardar', 'canvas');
                    let controlCambios = @json($tratamientoRiesgo);
                    let url = "{{ route('admin.tratamiento-riesgos.firma-aprobacion') }}";
                    var canvas = document.getElementById(canvasId);
                    var dataUrl = canvas.toDataURL();
                    let tipo = e.target.getAttribute('data-tipo');
                    var data = {
                        id: controlCambios.id,
                        tipo,
                        firma: '',
                    };
                    var isCanvasEmptySigned = isCanvasEmpty(canvas);
                    if (isCanvasEmptySigned) {
                        toastr.info('Firma(s) no dibujadas');
                    } else {
                        data['firma'] = dataUrl;

                    }
                    console.log(data);
                    if (!isCanvasEmptySigned) {
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            },
                            type: "POST",
                            data: data,
                            url: url,

                            success: function(response) {
                                if (response.success) {
                                    toastr.success('Firmado con éxito');
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1500);
                                }
                            },
                            error: function(request, status, error) {
                                toastr.error(
                                    'Ocurrió un error: ' + error);
                            }
                        });
                    }
                }
            })
        }

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
    </script>
@endsection
