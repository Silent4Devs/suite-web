@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">

    <style>
        @media print {
            .print-none {
                display: none !important;
            }
        }
    </style>

    <div class="print-none">
        {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}
    </div>
    <div class="mt-4 row justify-content-center">
        <div class="card col-sm-12 col-md-10" style="border-radius: 16px; height:1556px;">
            <div class="card-body">
                <div class="print-none" style="text-align:right;">
                    <button class="btn btn-outline-primary mt-4" style="font-size:14px;width:150px;"
                        onclick="javascript:window.print()">
                        Imprimir
                        <i class="fas fa-print"style="color:#057BE2;"></i>
                    </button>
                </div>
                @php
                    use App\Models\Organizacion;
                    $organizacion = Organizacion::getFirst();
                    $logotipo = $organizacion->logotipo;
                    $empresa = $organizacion->empresa;
                @endphp
                <div class="row mt-5 col-12 ml-0"
                    style="border-radius: 5px;height:147px;
                padding-left: 0px;padding-right: 0px;">
                    <div class="col-3" style="border-left: 25px solid #2395AA">
                        <img src="{{ asset($logotipo) }}" class="mt-2 img-fluid" style="">
                    </div>
                    <div class="col-5 p-2 mt-3" style="text-align: left;">
                        <br>
                        <span class="" style="color:#306BA9; font-size:20px;font-weight:bold;">
                            Política del Sistema de Gestión
                        </span>

                    </div>
                    <div class="col-4 pt-5 pl-5" style="background:#EEFCFF;">
                        <span class="" style="font-size:14px;color:#345183;background:#EEFCFF;">Fecha de revisión:
                            {{ \Carbon\Carbon::parse($politicaSgsi->fecha_revision)->format('d-m-Y') }}
                        </span>
                        <div class="" style="font-size:14px;color:#345183;">
                            Fecha de publicación:
                            {{ \Carbon\Carbon::parse($politicaSgsi->fecha_publicacion)->format('d-m-Y') }}
                        </div>
                    </div>
                </div>
                <div class="row" style="border-right: 16px solid white">
                    <div class="col-md-11" style="padding-right:0px; padding-left:14px;">
                        <div class="card mb-1" style="background-color: #EEF5FF; box-shadow:none;border-radius:0px;">
                            <div class="mt-4" style="font-weight: bold;margin-left:55px;font-size:14px; color:#306BA9;">
                                Nombre del alcance
                            </div>
                            <div class="px-2 mt-2 ml-5 mr-5 mb-4" style="font-size:14px; color:#606060;">
                                {!! $politicaSgsi->nombre_politica !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 mb-1"
                        style="width:10px;padding-left:0px;padding-right:0px;background-color:#295082;
                    width:10px;padding-left:0px;padding-right: 43px;">
                    </div>
                </div>
                <div class="mt-4 mb-3  dato_mairg" style="">
                    <span style="font-size:14px; color:#306BA9;margin-left:55px;font-size: 14px; font-weight: bold; ml-4">
                        Alcance
                    </span>
                    <div class="px-2 mt-2 ml-5 mr-5" style="font-size:14px; color:#606060;">
                        {!! $politicaSgsi->politicasgsi !!}
                    </div>
                </div>

                <div class="border-bottom" style="margin-top:100px;"> </div>

            </div>
        </div>
    </div>

    <form method="POST" id="formularioRevision" enctype="multipart/form-data">
        @csrf
        {{-- <div class="card card-body shadow-sm">
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
        <div class="card card-body shadow-sm">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group anima-focus">
                        <textarea name="comentario" id="comentario" class="form-control" placeholder=""></textarea>
                        <label for="comentario">Comentario</label>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-12">
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
            </div> --}}

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

@section('scripts')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

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
                    "{{ route('admin.politica-sgsis.aprobado', $politicaSgsi->id) }}";
                document.getElementById('formularioRevision').setAttribute('action',
                    aprobar);
                // }
            });

            document.getElementById('rechazado').addEventListener('click', function(e) {

                let comentario_if = $("#comentario").val();
                if (comentario_if == '' || comentario_if == null) {
                    e.preventDefault();
                    Swal.fire(
                        'Debe escribir comentarios de retroalimentacion al rechazar el Analisis',
                        '',
                        'info');
                } else {
                    let rechazar =
                        "{{ route('admin.politica-sgsis.rechazado', $politicaSgsi->id) }}";
                    document.getElementById('formularioRevision').setAttribute('action',
                        rechazar);
                }
            });

        });
    </script>
@endsection
