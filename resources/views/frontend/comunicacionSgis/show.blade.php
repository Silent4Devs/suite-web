@extends('layouts.frontend')
@section('content')

    @section('styles')

        <link rel="stylesheet" type="text/css" href=" https://printjs-4de6.kxcdn.com/print.min.css">

         <style type="text/css">
            .img_comunicado{
                width: 100%;
                height: 300px;

                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: all;
            }
            .documentos_sgis i{
                font-size: 50pt;
                color: #B30909;
                transition: 0.1s;
            }
            .documentos_sgis a:hover > i{
                transform: scale(1.07);
                filter: brightness(1.5);
            }
            .documentos_sgis a{
                display: inline-block;
                text-align: center;
                margin: 7px;
            }

            @media print {
                .img_comunicado{
                    width: 100%;
                    height: 300px;

                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-attachment: all;
                }
                .documentos_sgis i{
                    font-size: 50pt;
                    color: #B30909;
                    transition: 0.1s;
                }
                .documentos_sgis a:hover > i{
                    transform: scale(1.07);
                    filter: brightness(1.5);
                }
                .documentos_sgis a{
                    display: inline-block;
                    text-align: center;
                    margin: 7px;
                }
            }
        </style>
    @endsection

    {{--  {{ Breadcrumbs::render('frontend.comunicacion-sgis.show') }} --}}



    <div class="mt-5 card" style="">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Comunicados</strong></h3>
        </div>
        <div class=" card-body" style="">

            <div class="row" style="position: relative; height:35px;">
                <button class="btn btn-danger" style="position: absolute; right:20px;" onclick="printJS({
                    printable: 'impreso_row',
                    type: 'html', 
                    css: '{{ asset('css/print_comunicados.css') }}',})">
                    <i class="fas fa-print"></i>
                    Imprimir
                </button>
            </div>

            <div class="row" id="impreso_row">
                <div class="col-12">
                    <h1 style="color:#345183;">{{ $comunicacionSgi->titulo }}</h1>
                </div>
                <div class="mt-3 col-md-5">
                    @php
                    if(($comunicacionSgi->first()->count())){
                        $imagen= 'storage/imagen_comunicado_SGI/'.$comunicacionSgi->imagenes_comunicacion->first()->imagen;
                    }
                    else{
                        $imagen= 'img/portal_404.png';
                    }

                @endphp

                    <div class="img_comunicado" style="background-image: url('{{ asset($imagen) }}');"></div>
                </div>
                <div class="mt-3 col-md-7" style="display: flex; align-items:center;">
                    <div>
                        {!! $comunicacionSgi->descripcion !!}

                        <p>
                            {{ \Carbon\Carbon::parse($comunicacionSgi->fecha_publicacion)->format('d-m-Y') }}
                            &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                            <a href="{{$comunicacionSgi->link}}">{{$comunicacionSgi->link}}</a>
                            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                            Publicado en: {{$comunicacionSgi->publicar_en}}
                        </p>

                        <div class="documentos_sgis">
                            @forelse($comunicacionSgi->documentos_comunicacion as $doc)
                                <a href="{{ asset('storage/documento_comunicado_SGI/'.$doc->documento) }}" target="_blank">
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