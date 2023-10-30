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
                <div class="row mt-5 col-12 ml-0" style="border-radius: 5px;height:147px;
                padding-left: 0px;padding-right: 0px;">
                    <div class="col-3" style="border-left: 25px solid #2395AA">
                        <img src="{{ asset($logotipo) }}" class="mt-2 img-fluid" style="">
                    </div>
                    <div class="col-5 p-2 mt-3" style="text-align: left;">
                        <br>
                        <span class="" style="color:#306BA9; font-size:20px;font-weight:bold;">
                            Reporte Determinación de alcance
                        </span>

                    </div>
                    <div class="col-4 pt-5 pl-5" style="background:#EEFCFF;">
                        <span class="" style="font-size:14px;color:#345183;background:#EEFCFF;">Fecha de revisión:
                            {{ \Carbon\Carbon::parse($alcanceSgsi->fecha_revision)->format('d-m-Y') }}
                        </span>
                        <div class="" style="font-size:14px;color:#345183;">
                            Fecha de publicación:
                            {{ \Carbon\Carbon::parse($alcanceSgsi->fecha_publicacion)->format('d-m-Y') }}
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
                                {!! $alcanceSgsi->nombre !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 mb-1" style="width:10px;padding-left:0px;padding-right:0px;background-color:#295082;
                    width:10px;padding-left:0px;padding-right: 43px;">
                    </div>
                </div>
                <div class="mt-4 mb-3  dato_mairg" style="">
                    <span style="font-size:14px; color:#306BA9;margin-left:55px;font-size: 14px; font-weight: bold; ml-4">
                        Alcance
                    </span>
                    <div class="px-2 mt-2 ml-5 mr-5" style="font-size:14px; color:#606060;">
                        {!! $alcanceSgsi->alcancesgsi !!}
                    </div>
                </div>

                <div class="border-bottom" style="margin-top:100px;"> </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
