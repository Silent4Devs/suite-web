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
                    <button class="btn btn-outline-primary" style="width:150px;"
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
                <div class="row mt-5 col-12 ml-0" style="width: 542px;
                height: 157px;border-radius: 5px">
                    <div class="col-2" style="border-left: 20px solid #2395AA">
                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-1" style="width:100px;">
                    </div>
                    <div class="col-6 p-2" style="text-align: left;">
                        <br>
                        <span style="color:#306BA9; font-size:20px;">
                            Reporte Determinación de alcance
                        </span>

                    </div>
                    <div class="col-4 p-2" style="background:#EEFCFF;">
                        <span class="ml-5" style="font-size:14px;color:#345183;">Fecha de revisión:
                            {{ \Carbon\Carbon::parse($alcanceSgsi->created_at)->format('d-m-Y') }}
                        </span>
                        <div class="ml-5" style="font-size:14px;color:#345183;">
                            Fecha de publicación: 19-09-2022
                        </div>
                    </div>
                </div>

                <div class="mt-5 mb-3  dato_mairg" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold; ml-4">
                        Nombre del alcance</span>
                </div>

                <div class="px-2 mt-2">
                    {!! $alcanceSgsi->alcancesgsi !!}
                </div>

                <div class="mt-5 mb-3  dato_mairg" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold; ml-4">
                        Alcance</span>
                </div>

                <ul>
                    @foreach ($alcanceSgsi->normas as $norma)
                        <li style="font-size:12px;">
                            {{ $norma->norma }}
                        </li>
                    @endforeach
                </ul>
                <div class="border-bottom" style="margin-top:100px;"> </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
