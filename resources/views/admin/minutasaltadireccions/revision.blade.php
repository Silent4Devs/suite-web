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
    </style>

    <div class="card card-body">
        <div class="row d-flex align-items-center justify-content-center">
            <!-- Modal -->

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="margin:50px 0px 50px 1230px; background:none; border: none;">
        <i class="fa-solid fa-x fa-2xl" style="color: #ffffff;"></i>
       </button>
            <div class="print-none">
            </div>
            <div class="card col-sm-12 col-md-10"
                style="border-radius: 0px; box-shadow: none; border-color:white; width:800px;">
                <div class="card-body" style=" position: relative; left:4.5rem; width:800px;">
                    <div class="print-none" style="text-align:right;">
                        <form method="POST"
                            action="{{ route('admin.minutasaltadireccions.pdf', ['id' => $minutas->id]) }}">
                            @csrf
                            <button class="boton-transparentev2" type="submit" style="color: #306BA9;">
                                IMPRIMIR <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
                            </button>
                        </form>
                    </div>
                    <br>
                    <div class="card mt-6" style="width:750px; position: relative; right: -.8rem;">
                        <div class="row col-12 ml-0"
                            style="border-radius;
                                    padding-left: 0px;padding-right: 0px;">
                            <div class="col-3" style="border-left: 25px solid #2395AA">
                                <img src="{{ asset('silent.png') }}" class="mt-2 img-fluid"
                                    style=" width:70%; position: relative; left: -.1rem; top: 1.4rem;">
                            </div>
                            <div class="col-5 p-2 mt-3">
                                <br>
                                <p
                                    style="position: relative; top: -1.5rem; right: 3rem;">
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
                                        <th style="background-color: #306BA9; padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;"
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
                                        <th style="background-color: #306BA9; padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;"
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
                                        <th style="background-color: #306BA9; padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;"
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
                                            <p style="width: 100%; border: none; outline: none;">Se adjunta la respuesta que Habiza dio en la reunión que tuvo con los representantes y que motivó se convocara a la reunión de hoy 10/03/2021, ya que mencionaron que para el mes de abril de este año ya no serán ellos los que administren el clúster. 1.- BARDA COLINDANTE: La barda colindante que comprende el tren número 2 que corresponde de la casa 9 a la 24, no se va a hacer porque los cimientos que se hicieron para la misma no soportan más peso inclusive ni siquiera 20 centímetros de malla ya que los vientos la derribarían 2.- PLANOS DE CONSTRUCIÓN Los planos nos los entregarían la próxima semana, pero solo van a ser los planos de cada prototipo pues las casas están hechas en serie y todos tienen las mismas características en cuanto al tema eléctrico e hidráulico, se va a entregar por correo y físico solo uno. 3.- GASTOS DE ADMINISTRACIÓN El informe nos lo entregan a más tardar el día 29 de marzo de 2021, y ellos se comprometen a compartir proveedores de insumos, vigilancia y jardineros. Por este punto se sugiere ir planeando u organizando la administración, no hay prorroga. 4.- CISTERNA DE RIEGO Nos comentan que la cisterna ya está para su funcionamiento y que a nosotros nos corresponde hacer el contrato de toma de agua para áreas verdes y alberca, inclusive nos entregaron la solicitud y esta tendrá un costo de $7,041.11. 5.-CANAL PLUVIAL</p>
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

    <form method="POST" id="formularioRevision" enctype="multipart/form-data">
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
@endsection

<script>
    document.getElementById('myTextarea').value = '{{ html_entity_decode(strip_tags($minutas->tema_tratado)) }}';
</script>
@section('scripts')
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
