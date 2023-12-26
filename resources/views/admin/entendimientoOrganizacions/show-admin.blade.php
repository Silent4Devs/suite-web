@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/foda.css') }}">
    <style>
        .aprobar {
            background-color: #00B212;
            color: #F6FCFF;
        }

        .aprobar:hover {
            color: #F6FCFF;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="titulo_general_funcion">Matriz FODA</h5>
    </div>

    {{-- <div class="card card-body shadow-sm"> --}}
    {{-- <div class="d-flex justify-content-between">
            <div>
                <h5>SILENT 4 BUSINESS</h5>
                <a class="d-inline" href="{{route('admin.entendimiento-organizacions.edit', $foda_actual)}}" style="text-decoration-line: none;">
                    <i class="material-icons" style="cursor: pointer;">edit</i>
                </a>
                <p class="d-inline">
                    SILENT 4 BUSINEntendimiento de Organización: FODA Corporativo 2023 V3ESS
                </p>
            </div>
            <img src="{{ $logo_actual }}" alt="Logo de la empresa" height="150px">
        </div> --}}

    <div class="card card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h5>SILENT 4 BUSINESS</h5>
                <p>
                    SILENT 4 BUSINEntendimiento de Organización: FODA Corporativo 2023 V3ESS
                </p>
            </div>
            <img src="{{ $logo_actual }}" alt="Logo de la empresa" height="150px">
        </div>

        <div class="caja-foda">
            <div class="foda-item fi-for">
                <h6 class="title-foda-item">FORTALEZAS</h6>
                <p class="mt-3">
                    @foreach ($obtener_FODA->fodafortalezas as $fortaleza)
                        @if ($fortaleza->tiene_riesgos_asociados)
                            <i class="text-danger mr-2 fas fa-exclamation-triangle" style="font-size:8pt"
                                title="Riesgo Asociado"></i> {{ $fortaleza->fortaleza }}. <br>
                        @else
                            {{ $fortaleza->fortaleza }}. <br>
                        @endif
                    @endforeach
                </p>
            </div>
            <div class="foda-item fi-deb">
                <h6 class="title-foda-item">DEBILIDADES</h6>
                <p class="mt-3">
                    @foreach ($obtener_FODA->fodadebilidades as $debilidad)
                        @if ($debilidad->tiene_riesgos_asociados)
                            <i class="text-danger mr-2 fas fa-exclamation-triangle" style="font-size:8pt"
                                title="Riesgo Asociado"></i> {{ $debilidad->debilidad }}. <br>
                        @else
                            {{ $debilidad->debilidad }}. <br>
                        @endif
                    @endforeach
                </p>
            </div>
            <div class="foda-item fi-opo">
                <h6 class="title-foda-item">OPORTUNIDADES</h6>
                <p class="mt-3">
                    @foreach ($obtener_FODA->fodaoportunidades as $oportunidad)
                        @if ($oportunidad->tiene_riesgos_asociados)
                            <i class="text-danger mr-2 fas fa-exclamation-triangle" style="font-size:8pt"
                                title="Riesgo Asociado"></i>{{ $oportunidad->oportunidad }}. <br>
                        @else
                            {{ $oportunidad->oportunidad }}. <br>
                        @endif
                    @endforeach
                </p>
            </div>
            <div class="foda-item fi-ame">
                <h6 class="title-foda-item">AMENAZAS</h6>
                <p class="mt-3">
                    @foreach ($obtener_FODA->fodamenazas as $amenaza)
                        @if ($amenaza->tiene_riesgos_asociados)
                            <i class="text-danger mr-2 fas fa-exclamation-triangle" style="font-size:8pt"
                                title="Riesgo Asociado"></i>{{ $amenaza->amenaza }}. <br>
                        @else
                            {{ $amenaza->amenaza }}. <br>
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
    {{-- </div> --}}

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
        <div class="card card-body shadow-sm">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group anima-focus">
                        <textarea name="comentario" id="comentario" class="form-control"></textarea>
                        <label for="comentario">Comentario</label>
                    </div>
                </div>
            </div>

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
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });
            document.getElementById('aprobado').addEventListener('click', function(e) {
                if (signaturePad.isEmpty()) {
                    e.preventDefault();
                    Swal.fire('Por favor firme el area designada.', '', 'info');
                } else {
                    let aprobar =
                        "{{ route('admin.foda-organizacions.aprobado', $foda_actual) }}";
                    document.getElementById('formularioRevision').setAttribute('action',
                        aprobar);
                }
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
                        "{{ route('admin.foda-organizacions.rechazado', $foda_actual) }}";
                    document.getElementById('formularioRevision').setAttribute('action',
                        rechazar);
                }
            });

        });
    </script>
@endsection
