@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">
    <style>
        .circulo {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex !important;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 20px;
            left: 0px;


        }

        .circulo2 {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex !important;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 20px;
            right: 0px;


        }

        .tit {
            display: flex !important;
            justify-content: center;
            align-items: center;

        }

        .centrarte {
            display: flex !important;
            justify-content: center;
            align-items: center;
            position: absolute;
        }

        @media print {
            .print-none {
                display: none !important;
            }
        }
    </style>


    <div class="print-none">
        {{ Breadcrumbs::render('admin.entendimiento-organizacions.show') }}
    </div>


    <div class="mt-5 card p-2">
        {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Entendimiento de Organización (FODA)</strong></h3>
        </div> --}}

        <button class="btn btn-danger print-none" style="position: absolute; right:20px;" onclick="javascript:window.print()">
            <i class="fas fa-print"></i>
            Imprimir
        </button>


        @php
            use App\Models\Organizacion;
            $organizacion = Organizacion::getFirst();
            $logotipo = $organizacion->logotipo;
            $empresa = $organizacion->empresa;
        @endphp

        <div class="row mt-5 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
            <div class="col-2 pl-0" style="border-right: 2px solid #ccc">
                <img src="{{ asset($logotipo) }}" class="mt-2 mb-2 ml-4" style="width:100px;">
            </div>
            <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                <span style="font-size:13px; text-transform: uppercase;color:#345183;">{{ $empresa }}</span>
                <br>
                <span style="color:#345183; font-size:15px;"><strong>Entendimiento de Organización:
                        {{ $obtener_FODA->analisis }}</strong></span>

            </div>
            <div class="col-3 p-2">
                <span style="color:#345183;">Fecha:
                    {{ $obtener_FODA->fecha ? \Carbon\Carbon::parse($obtener_FODA->fecha)->format('d-m-Y') : 'sin registro' }}
                </span>
            </div>
        </div>

        <div id="impreso_row">

            <div class="card-body">
                @if (session('success'))
                    <div class="mb-3 row">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Bien hecho!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif



                <div class="row">
                    <div class="p-0 col-sm-1 col-md-1 d-flex align-items-center" style="transform: rotate(-90deg)">
                        <strong>INTERNAS</strong>
                    </div>


                    <div class="p-0 text-center col-md-5 col-sm-5"
                        style="border-right: solid 8px rgb(255, 104, 4); border-bottom: solid 10px #2bd1b0; min-height: 150px">
                        <div class="row">
                            <div class="circulo" style="background: #2bd1b0"><i class="fas fa-dumbbell"
                                    style="color: #fff; font-size:25px;"></i></div>
                            <div class="pl-3 col-sm-11">
                                <h5>
                                    <strong style="color: #18A98B">FORTALEZAS</strong>
                                    <button class="mr-2 btn btn-xs print-none" type="button" data-toggle="modal"
                                        data-target="#fortalezas_modal" style="float: right;">
                                        <i class="fas fa-question-circle" style="font-size: 13px"></i>
                                    </button>
                                </h5>
                                <div style="text-align:justify;" class="px-4">
                                    <ul>
                                        @foreach ($obtener_FODA->fodafortalezas as $fortaleza)
                                            <li>

                                                @if ($fortaleza->tiene_riesgos_asociados)
                                                    <i class="text-danger mr-2 fas fa-exclamation-triangle"
                                                        style="font-size:8pt"
                                                        title="Riesgo Asociado"></i>{{ $fortaleza->fortaleza }}
                                                @else
                                                    {{ $fortaleza->fortaleza }}
                                                @endif

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 text-center col-md-5 col-12 col-sm-5"
                        style=" border-bottom: solid 8px rgb(255, 89, 77); min-height: 150px">
                        <div class="row">
                            <div class="pl-3 col-sm-11">
                                <h5>
                                    <strong style="color:rgb(255, 104, 4);">
                                        DEBILIDADES
                                    </strong>

                                    <button class="mr-2 btn btn-xs print-none" type="button" data-toggle="modal"
                                        data-target="#debilidades_modal" style="float: right;">
                                        <i class="fas fa-question-circle" style="font-size: 13px"></i>
                                    </button>
                                </h5>


                                <div class="pr-3">
                                    <ul>
                                        @foreach ($obtener_FODA->fodadebilidades as $debilidad)
                                            <li style="text-align:justify;">
                                                @if ($debilidad->tiene_riesgos_asociados)
                                                    <i class="text-danger mr-2 fas fa-exclamation-triangle"
                                                        style="font-size:8pt"
                                                        title="Riesgo Asociado"></i>{{ $debilidad->debilidad }}
                                                @else
                                                    {{ $debilidad->debilidad }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="circulo2" style=" background: rgb(255, 104, 4);"><i class="fas fa-thumbs-down"
                                    style="color: #fff; font-size:25px;"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="p-0 col-sm-1 col-md-1 d-flex align-items-center" style="transform: rotate(-90deg)">
                        <strong>EXTERNAS</strong>
                    </div>
                    <div class="p-0 text-center col-md-5 col-12 col-sm-5"
                        style="border-right: solid 8px rgb(77, 184, 255); min-height: 150px">
                        <div class="row">
                            <div class="circulo" style="margin-top:20px; background:rgb(77, 184, 255)"><i
                                    class="fas fa-handshake" style="color: #fff; font-size:25px;"></i></div>
                            <div class="pl-3 col-sm-11">
                                <h5 class="mt-3">
                                    <strong style="color: rgb(77, 184, 255)">OPORTUNIDADES</strong>
                                    <button class="mr-2 btn btn-xs print-none" type="button" data-toggle="modal"
                                        data-target="#oportunidades_modal" style="float: right;">
                                        <i class="fas fa-question-circle" style="font-size: 13px"></i>
                                    </button>
                                </h5>
                                <div style="text-align: justify" class="px-4">
                                    <ul>
                                        @foreach ($obtener_FODA->fodaoportunidades as $oportunidad)
                                            <li>
                                                @if ($oportunidad->tiene_riesgos_asociados)
                                                    <i class="text-danger mr-2 fas fa-exclamation-triangle"
                                                        style="font-size:8pt"
                                                        title="Riesgo Asociado"></i>{{ $oportunidad->oportunidad }}
                                                @else
                                                    {{ $oportunidad->oportunidad }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 text-center col-md-5 col-12 col-sm-5" style="min-height: 150px">
                        <div class="row">
                            <div class="pl-3 col-sm-11">
                                <h5 class="mt-3">
                                    <strong style="color:rgb(255, 89, 77)">AMENAZAS</strong>
                                    <button class="mr-2 btn btn-xs print-none" type="button" data-toggle="modal"
                                        data-target="#amenazas_modal" style="float: right;">
                                        <i class="fas fa-question-circle" style="font-size: 13px"></i>
                                    </button>
                                </h5>
                                <div style="text-align: justify" class="pr-3">
                                    <ul>
                                        @foreach ($obtener_FODA->fodamenazas as $amenaza)
                                            <li>
                                                @if ($amenaza->tiene_riesgos_asociados)
                                                    <i class="text-danger mr-2 fas fa-exclamation-triangle"
                                                        style="font-size:8pt"
                                                        title="Riesgo Asociado"></i>{{ $amenaza->amenaza }}
                                                @else
                                                    {{ $amenaza->amenaza }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="circulo2" style="margin-top:20px; background:rgb(255, 89, 77)"><i
                                    class=" fas fa-bomb" style="color: #fff; font-size:25px;"></i></div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row justify-content-end">
                    @if ($obtener_FODA)
                        <a href="{{ route('admin.entendimiento-organizacions.edit', $obtener_FODA->id) }}"
                            class="mr-5 btn btn-primary"><i class="fas fa-pen"></i> Editar Análisis FODA</a>
                    @else

                        <a href="{{ route('admin.entendimiento-organizacions.create') }}" class="mr-5 btn btn-success"><i
                                class="fas fa-pen"></i> Realizar Análisis FODA</a>

                    @endif
                </div> --}}

                <div class="text-right form-group col-12"><br>
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar print-none">Salir</a>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="fortalezas_modal" tabindex="-1" aria-labelledby="fortalezas_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="mr-5 justify-content-center" style="margin:auto">
                        <h5 class="modal-title" id="fortalezas_modalLabel">
                            <i class="fas fa-dumbbell" style="color: #2bd1b0; font-size:25px;"></i>
                            <strong class="ml-3">FORTALEZAS</strong>
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Debemos añadir los atributos o puntos positivos que nos pueden servir para alcanzar nuestros objetivos.
                    Están relacionados tanto a los recursos materiales y su condición de uso como a los recursos humanos y
                    su nivel de capacitación para generar los mejores resultados.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="oportunidades_modal" tabindex="-1" aria-labelledby="oportunidades_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-5 justify-content-center" style="margin:auto">

                        <h5 class="modal-title" id="oportunidades_modalLabel">
                            <i class="fas fa-handshake" style="color: rgb(77, 184, 255); font-size:23px;"></i>
                            <strong class="ml-3">OPORTUNIDADES</strong>
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    En este cuadrante debemos de añadir lo que es perjudicial o los factores que pueden ser desfavorables
                    para nuestro objetivo. Son factores internos, por lo que la opinión del personal juega un papel
                    fundamental, y como es algo que se refleja al exterior, también cuenta la opinión de los clientes.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="debilidades_modal" tabindex="-1" aria-labelledby="debilidades_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-5 justify-content-center" style="margin:auto">
                        <h5 class="modal-title" id="debilidades_modalLabel">
                            <i class="mr-3 fas fa-thumbs-down" style="color:rgb(255, 104, 4); font-size:20px;"></i>

                            <strong class="mr-3">
                                DEBILIDADES
                            </strong>
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Aquí debemos tener en cuenta las condiciones externas, revisando la industria y otros factores como las
                    regulaciones que pueden afectar de forma positiva a nuestro objetivo. Son aspectos que, aunque no
                    podemos controlar, sí podemos aprovechar para mejorar o hacer crecer nuestra empresa.
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="amenazas_modal" tabindex="-1" aria-labelledby="amenazas_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="mr-5 justify-content-center" style="margin:auto">

                        <h5 class="modal-title" id="amenazas_modalLabel">
                            <i class="mr-3 fas fa-bomb" style="color: rgb(255, 89, 77); font-size:20px;"></i>
                            <strong class="mr-3">
                                AMENAZAS
                            </strong>
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Añadiremos lo perjudicial, todo lo que puede amenazar nuestra supervivencia y la potencial ganancia de
                    resultados de forma externa. Estos aspectos no lo podemos controlar, pero sí podemos contraatacar para
                    enfrentarlos.
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
