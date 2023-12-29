@extends('layouts.admin')
@section('content')
    @include('admin.listadistribucion.estilos')
    <style>
        .select2-search.select2-search--inline {
            margin-top: -20px !important;
        }
    </style>

    {{ Breadcrumbs::render('admin.minutasaltadireccions.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Minutas de Sesiones de Alta Dirección</h5>


    <div class="card card-body">

        <div>

            <div class="card-header">
                Previsualizacion de la minuta: <strong>{{ $minutasaltadireccion->documento }}</strong>
            </div>

            @php
                $path = 'en aprobacion/';
                if ($minutasaltadireccion->estatus == 3) {
                    $path = 'aprobadas/';
                }
            @endphp
            <iframe src="{{ asset('storage/minutas/' . $path . $minutasaltadireccion->documento) }}" class="w-100"
                style="height: 500px" frameborder="0"></iframe>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minutasaltadireccions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>


    {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}

    @if ($accesoparticipante == true)
        <form method="POST" id="formularioRevision" enctype="multipart/form-data">
            @csrf
            {{-- <div class="card card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row" style="justify-content: center; display: flex;">
                        <h3>Firma de Aprobación</h3>
                    </div>
                    <div class="row" style="justify-content: center; display: flex;">
                        <button id="clear" class="btn btn-link">Limpiar Firma</button>
                    </div>
                    <div class="row" style="justify-content: center; display: flex;">
                        <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                            style="border: 1px solid black;"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="comentario">Comentario</label>
                    <textarea name="comentario" id="comentario" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.minutasaltadireccions.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" id="btnGuardar" type="submit">
                        Rechazar
                    </button>
                    <button class="btn btn-danger" id="btnUpdateAndReview" type="submit" style="width: 230px !important;">
                        Aprobar
                    </button>
                </div>
            </div>
        </div> --}}
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group anima-focus">
                            <textarea name="comentario" id="comentario" class="form-control"></textarea>
                            <label for="comentario">Comentario</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center form-group col-12">
                        <button class="btn btn-verde" id="aprobado" type="submit">
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

        <div class="card card-body">
            <div class="card-header">
                <h5>Historial Comentarios de Alta Dirección</h5>
            </div>
            <br>
            <div class="col-12">
                <h6>Comentarios de colaboradores</h6>
                <ol>
                    @foreach ($comentarios as $comentario)
                        @if (isset($comentario->comentarios))
                            <li>{{ $comentario->comentarios }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    @endif
    <div class="col-12">
        <a href="{{ route('admin.minutasaltadireccions.index') }}" class="btn_cancelar">Regresar</a>
    </div>
@endsection

@section('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });

            document.getElementById('save').addEventListener('click', function() {
                if (signaturePad.isEmpty()) {
                    alert('Por favor firme el area designada.');
                } else {
                    var dataURL = signaturePad.toDataURL();
                    var repId = this.getAttribute('data-reporte');

                    fetch('{{ route('admin.auditoria-internas.storeReporteIndividual', ['reporteid' => ':reporteauditoria']) }}'
                            .replace(':reporteauditoria',
                                repId), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-Token': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    signature: dataURL
                                }),
                            })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'El lider ha sido notificado',
                                ).then(() => {
                                    window.location.href =
                                        '{{ route('admin.auditoria-internas.index') }}';
                                });
                            } else {
                                Swal.fire(
                                    'El correo no ha sido posible enviarlo debido a problemas de intermitencia con la red, favor de volver a intentar más tarde, o si esto persiste ponerse en contacto con el administrador',
                                ).then(() => {
                                    window.location.href =
                                        '{{ route('admin.auditoria-internas.index') }}';
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('aprobado').addEventListener('click', function(e) {
                let aprobar =
                    "{{ route('admin.minutasaltadireccions.aprobado', $minutasaltadireccion->id) }}";
                document.getElementById('formularioRevision').setAttribute('action', aprobar);
            });

            document.getElementById('rechazado').addEventListener('click', function(e) {

                let comentario_if = $("#comentario").val();
                if (comentario_if == '' || comentario_if == null) {
                    e.preventDefault();
                    Swal.fire('Debe escribir comentarios de retroalimentacion al rechazar una Minuta', '',
                        'info');
                } else {
                    let rechazar =
                        "{{ route('admin.minutasaltadireccions.rechazado', $minutasaltadireccion->id) }}";
                    document.getElementById('formularioRevision').setAttribute('action', rechazar);
                }
            });

        });
    </script>
@endsection
