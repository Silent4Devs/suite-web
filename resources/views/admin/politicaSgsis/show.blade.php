@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/foda/print.css') }}{{ config('app.cssVersion') }}">

    <style>
        @media print {
            .print-none {
                display: none !important;
            }
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

    <div class="print-none">
        {{ Breadcrumbs::render('admin.politica-sgsis.create') }}
    </div>
    <div class="mt-4 row justify-content-center">
        <div class="card col-sm-12 col-md-10" style="border-radius: 16px; height:1556px;">
            <div class="card-body">
                <div class="print-none" style="text-align:right;">
                    <form method="POST" style="position: relative; left: 1rem; "
                        action="{{ route('admin.politica-sgsis.pdf_show', ['id' => $politicaSgsi->id]) }}">
                        @csrf
                        @csrf
                        <button class="boton-transparentev2" type="submit" style="color: var(--color-tbj);">
                            IMPRIMIR <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
                        </button>
                    </form>
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
                        <span class="" style="color:var(--color-tbj); font-size:20px;font-weight:bold;">
                            Política del Sistema de Gestión
                        </span>

                    </div>
                    <div class="col-4 pt-5 pl-5" style="background:#EEFCFF;">
                        <span class="" style="font-size:14px;color:var(--color-tbj)background:#EEFCFF;">Fecha de
                            revisión:
                            {{ \Carbon\Carbon::parse($politicaSgsi->fecha_revision)->format('d-m-Y') }}
                        </span>
                        <div class="" style="font-size:14px;color:var(--color-tbj)">
                            Fecha de publicación:
                            {{ \Carbon\Carbon::parse($politicaSgsi->fecha_publicacion)->format('d-m-Y') }}
                        </div>
                    </div>
                </div>
                <div class="row" style="border-right: 16px solid white">
                    <div class="col-md-11" style="padding-right:0px; padding-left:14px;">
                        <div class="card mb-1" style="background-color: #EEF5FF; box-shadow:none;border-radius:0px;">
                            <div class="mt-4"
                                style="font-weight: bold;margin-left:55px;font-size:14px; color:var(--color-tbj);">
                                Nombre de la Política:
                            </div>
                            <div class="px-2 mt-2 ml-5 mr-5 mb-4" style="font-size:14px; color:#606060;">
                                {!! $politicaSgsi->nombre_politica !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 mb-1"
                        style="width:10px;padding-left:0px;padding-right:0px;background-color:var(--color-tbj);
                    width:10px;padding-left:0px;padding-right: 43px;">
                    </div>
                </div>
                <div class="mt-4 mb-3  dato_mairg" style="">
                    <span
                        style="font-size:14px; color:var(--color-tbj);margin-left:55px;font-size: 14px; font-weight: bold; ml-4">
                        Política:
                    </span>
                    <div class="px-2 mt-2 ml-5 mr-5" style="font-size:14px; color:#606060;">
                        {!! $politicaSgsi->politicasgsi !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
