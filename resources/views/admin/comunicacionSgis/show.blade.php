@extends('layouts.admin')
@section('content')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">

    <style type="text/css">
        .img_comunicado {
            width: 400px;
            height: 290px;
            margin: auto;

            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: all;
        }

        .documentos_sgis i {
            font-size: 50pt;
            color: #B30909;
            transition: 0.1s;
        }

        .documentos_sgis a:hover>i {
            transform: scale(1.07);
            filter: brightness(1.5);
        }

        .documentos_sgis a {
            display: inline-block;
            text-align: center;
            margin: 7px;
        }

        @media print {
            .img_comunicado {
                width: 400px;
                height: 290px;

                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: all;
            }

            .documentos_sgis i {
                font-size: 50pt;
                color: #B30909;
                transition: 0.1s;
            }

            .documentos_sgis a:hover>i {
                transform: scale(1.07);
                filter: brightness(1.5);
            }

            .documentos_sgis a {
                display: inline-block;
                text-align: center;
                margin: 7px;
            }

            .print-none {
                display: none !important;
            }
        }
    </style>
@endsection

<div class="print-none">
    {{ Breadcrumbs::render('admin.comunicacion-sgis.show') }}
</div>

<h5 class="col-12 titulo_general_funcion">Comunicados Generales</h5>
        <div class="card card-body" style="background-color: #5397D5; color: #fff;">
            <div class="d-flex" style="gap: 25px;">
                <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
                <div>
                    <br>
                    <br>
                    <h4>¿Qué es Comunicados Generales?  </h4>
                    <p>
                        Anuncios o mensajes importantes que la organización comparte con todos sus colaboradores para comunicar aspectos importantes.
                    </p>
                    <p>
                        Son fundamentales ya que contribuye a la concientización y comprensión general.
                    </p>
                </div>
            </div>
        </div>


<div class="mt-5 card" style="">

    <div class=" card-body" style="">

        <button class="btn btn-danger print-none" style="position: absolute; right:20px;"
            onclick="javascript:window.print()">
            <i class="fas fa-print"></i>
            Imprimir
        </button>




        <div class="row" id="impreso_row">
            {{-- <div class="col-12">
                <h1 style="color:#345183;">{{ $comunicacionSgi->titulo }}</h1>
            </div> --}}
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
                    <span style="color:#345183; font-size:15px;"><strong>Comunicados:
                            {{ $comunicacionSgi->titulo }}</strong></span>

                </div>
                <div class="col-3 p-2">
                    <span style="color:#345183;">Fecha:
                        {{ \Carbon\Carbon::parse($comunicacionSgi->fecha_publicacion)->format('d-m-Y') }}
                    </span>
                </div>
            </div>
            <div class="mt-3 col-lg-12">
                @php
                    if ($comunicacionSgi->first()->count()) {
                        $imagen = 'storage/imagen_comunicado_SGI/' . $comunicacionSgi->imagenes_comunicacion->first()->imagen;
                    } else {
                        $imagen = 'img/portal_404.png';
                    }

                @endphp

                <div class="img_comunicado" style="background-image: url('{{ asset($imagen) }}');"></div>
            </div>
            <div class="mt-3 col-lg-12" style="display: flex; align-items:center;">
                <div>
                    {!! $comunicacionSgi->descripcion !!}

                    <p class="print-none">
                        {{ \Carbon\Carbon::parse($comunicacionSgi->fecha_publicacion)->format('d-m-Y') }}
                        &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                        <a href="{{ $comunicacionSgi->link }}" target="_blank">{{ $comunicacionSgi->link }}</a>
                        &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        Publicado en: {{ $comunicacionSgi->publicar_en }}
                    </p>

                    <div class="documentos_sgis print-none">
                        @forelse($comunicacionSgi->documentos_comunicacion as $doc)
                            <a href="{{ asset('storage/documento_comunicado_SGI/' . $doc->documento) }}"
                                target="_blank">
                                <i class="fas fa-file-pdf"></i><br>
                                <span>{{ $doc->documento }}</span>
                            </a>
                        @empty
                            <p>Sin documentos registrados</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
