@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/foda.css') }}">
    <style>
        .aprobar{
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

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-center form-floating" style="padding-left: 68px; padding-right: 68px; ">
                <textarea class="form-control" placeholder="Agrega un comentario o nota" style="min-height: 85px;"></textarea>
            </div>
            <div class="d-flex justify-content-center" style="margin-top: 26px;">
                <button type="button" class="btn aprobar">Aprobar</button>
            </div>
            <div class="d-flex justify-content-center" style="margin-top: 28px">
                <button type="button" class="btn btn-link">Rechazar</button>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
