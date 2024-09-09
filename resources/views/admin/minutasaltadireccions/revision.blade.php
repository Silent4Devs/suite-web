@extends('layouts.admin')
@section('content')
    @include('admin.listadistribucion.estilos')
    <style>
        .aprobar {
            background-color: #00B212;
            color: #F6FCFF;
        }

        .aprobar:hover {
            color: #F6FCFF;
        }

        .card {
            border-radius: 16px;
        }

        .boton-transparentev2 {
            top: 214px;
            width: 135px;
            height: 40px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            border: 1px solid var(--unnamed-color-057be2);
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #057BE2;
            opacity: 1;
        }
    </style>

    <div class="card card-body">
        <div class="row d-flex">
            <!-- Modal -->

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                style="margin:50px 0px 50px 1230px; background:none; border: none;">
                <i class="fa-solid fa-x fa-2xl" style="color: #ffffff;"></i>
            </button>
            <div class="card col-sm-12 col-md-10"
                style="border-radius: 0px; box-shadow: none; border-color:white; width:800px;">
                <div class="card-body" style=" position: relative; left:4.5rem; width:1200px;">
                    <div class="print-none" style="text-align:right;">
                        <form method="POST"
                            action="{{ route('admin.minutasaltadireccions.pdf', ['id' => $minutas->id]) }}">
                            @csrf
                            <button class="boton-transparentev2" type="submit" style="color: var(--color-tbj);">
                                IMPRIMIR <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
                            </button>
                        </form>
                    </div>
                    <br>
                    <div class="card mt-6" style="width:1000px; position: relative; right: -.8rem;">
                        <div class="row col-12 ml-0"
                            style="border-radius;
                                    padding-left: 0px;padding-right: 0px;">
                            <div class="col-3" style="border-left: 25px solid #2395AA">
                                <img src="{{ asset('silent.png') }}" class="mt-2 img-fluid"
                                    style=" width:70%; position: relative; left: -.1rem; top: 1.4rem;">
                            </div>
                            <div class="col-5 p-2 mt-3">
                                <br>
                                <p style="position: relative; top: -1.5rem; right: 3rem;">
                                    {{ $empresa_actual }} <br>
                                    RFC: {{ $rfc }} <br>
                                    {{ $direccion }} <br>
                                </p>

                            </div>
                            <div class="col-4 pt-6 pl-6" style="background:#EEFCFF;">
                                <br>
                                <br>
                                <br>
                                <span class="textopdf"> <strong> Minuta Revisión por
                                        Dirección</strong></span>
                            </div>
                            <br>
                        </div>
                        <div style="margin: 4%">
                            <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd;">
                                <thead>
                                    <tr>
                                        <th style="background-color: var(--color-tbj); padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;"
                                            colspan="6">
                                            <center>Minuta reunión</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #dddddd;">Fecha:</td>
                                        <td style="border: 1px solid #dddddd;">{{ $minutas->fechareunion }}
                                        </td>
                                        <td style="border: 1px solid #dddddd;">Hora Inicio</td>
                                        <td style="border: 1px solid #dddddd;">{{ $minutas->hora_inicio }}
                                        </td>
                                        <td style="border: 1px solid #dddddd;">Hora fin</td>
                                        <td style="border: 1px solid #dddddd;">{{ $minutas->hora_termino }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #dddddd;">Tema:</td>
                                        <td style="border: 1px solid #dddddd;">{{ $minutas->tema_reunion }}
                                        </td>
                                        <td style="border: 1px solid #dddddd;">Objetivo:</td>
                                        <td style="border: 1px solid #dddddd;" colspan="3">
                                            {{ $minutas->objetivoreunion }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd;">
                                <thead>
                                    <tr>
                                        <th style="background-color: var(--color-tbj); padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;"
                                            colspan="4">
                                            <center>Participantes</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #dddddd;">Nombre/Apellidos</td>
                                        <td style="border: 1px solid #dddddd;">Puesto/Area</td>
                                        <td style="border: 1px solid #dddddd;">Asistencia</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #dddddd;">{{ $responsable->name }}
                                        </td>
                                        <td style="border: 1px solid #dddddd;">{{ $responsable->puesto }}
                                        </td>
                                        <td style="border: 1px solid #dddddd;">si</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd;">
                                <thead>
                                    <tr>
                                        <th style="background-color: var(--color-tbj); padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;"
                                            colspan="2">
                                            <center style="color: white;">Temas tratados</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #dddddd; padding: 10px;" colspan="2">
                                            {!! htmlspecialchars_decode($minutas->tema_tratado) !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd;">
                                <thead>
                                    <tr>
                                        <th style="border-top-left-radius: 10px;  color: black; border-top-right-radius: 10px;"
                                            colspan="2">
                                            <center>Anexo</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #dddddd; padding: 10px;" colspan="2">
                                            <p style="width: 100%; border: none; outline: none;">
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" id="formularioRevision" enctype="multipart/form-data"
        class="{{ $minutas->firma_check ? (!$firmado ? 'd-none' : '') : '' }}">
        @csrf
        <div class="card card-body shadow-sm">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group anima-focus">
                        <textarea name="comentario" id="comentario" class="form-control" placeholder="" style="height: 150px !important;"></textarea>
                        <label for="comentario">Comentario</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="text-center form-group col-12">
                    <button class="btn aprobar" id="aprobado" type="submit">
                        Aprobar Solicitud
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="text-center form-group col-12">
                    <button class="btn btn-link" id="rechazado" type="submit">
                        Rechazar
                    </button>
                </div>
            </div>
        </div>
    </form>

    <style>
        #firma_requi {
            border: 1px solid #535353;
        }
    </style>
    @if ($minutas->firma_check)
        @if ($userIsAuthorized)
            <form method="POST" action="{{ route('admin.module_firmas.minutas', ['id' => $minutas->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="card card-body">
                    <div class="" style="position: relative; left: 2rem;">
                        <br>
                        <h5><strong>Firma*</strong></h5>
                        <p>
                            Indispensable firmar antes de guardar y enviarla a aprobación.
                        </p>
                    </div>
                    <div class="flex caja-firmar">
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
                            <div class="flex my-4" style="justify-content: end;">
                                <button onclick="validar()" class="btn btn-primary" type="submit">Firmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    @endif

    @if ($firmado)
        <div class="card card-body" style="margin-bottom: 30px">
            <div class="caja-firmas-doc d-flex gap-5 justify-content-center flex-wrap">
                @foreach ($firmas as $firma)
                    <div class="d-flex justify-content-center align-items-center" style="flex-direction: column;">
                        @if ($firma->firma)
                            @if (isset($firma->empleadoTable))
                                <img src="{{ $firma->firma_ruta_minutas }}" class="img-firma" width="200"
                                    height="100">
                                <p> {{ $firma->created_at->format('d/m/Y') }}</p>
                                <p> {{ $firma->empleadoTable->name }}</p>
                            @endif
                        @else
                            <div style="height: 137px;"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection

<script>
    document.getElementById('myTextarea').value = '{{ html_entity_decode(strip_tags($minutas->tema_tratado)) }}';
</script>
@section('scripts')
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

                var clearBtn = document.getElementById(clearBtnCanvas);
                clearBtn.addEventListener("click", function(e) {
                    clearCanvas();
                }, false);

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
        document.addEventListener('DOMContentLoaded', function() {
            // var canvas = document.getElementById('signature-pad');
            // var signaturePad = new SignaturePad(canvas);

            // document.getElementById('clear').addEventListener('click', function() {
            //     signaturePad.clear();
            // });
            document.getElementById('aprobado').addEventListener('click', function(e) {
                // if (signaturePad.isEmpty()) {
                //     e.preventDefault();
                //     Swal.fire('Por favor firme el area designada.', '', 'info');
                // } else {
                let aprobar =
                    "{{ route('admin.minutasaltadireccions.aprobado', $minutas->id) }}";
                document.getElementById('formularioRevision').setAttribute('action',
                    aprobar);
                // }
            });

            document.getElementById('rechazado').addEventListener('click', function(e) {

                let comentario_if = $("#comentario").val();
                if (comentario_if == '' || comentario_if == null) {
                    e.preventDefault();
                    Swal.fire(
                        'Debe escribir comentarios de retroalimentacion al rechazar una Minuta',
                        '',
                        'info');
                } else {
                    let rechazar =
                        "{{ route('admin.minutasaltadireccions.rechazado', $minutas->id) }}";
                    document.getElementById('formularioRevision').setAttribute('action',
                        rechazar);
                }
            });

        });
    </script>
@endsection
