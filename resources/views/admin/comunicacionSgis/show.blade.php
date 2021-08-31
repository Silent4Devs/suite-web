@extends('layouts.admin')
@section('content')

    @section('styles')
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
    </style>
    @endsection

    {{ Breadcrumbs::render('admin.comunicacion-sgis.show') }}

   

    <div class="card mt-5" style="">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Comunicados</strong></h3>
        </div>
        <div class=" card-body" style="">
            <div class="row">
                <div class="col-12">
                    <h1 style="color:#00abb2;">{{ $comunicacionSgi->titulo }}</h1>
                </div>
                <div class="col-md-5 mt-3">
                    @php
                        $imagen = count($comunicacionSgi->imagenes_comunicacion) ? 'storage/imagen_comunicado_SGI/'.$comunicacionSgi->imagenes_comunicacion->imagen : 'img/portal_404.png'; 
                    @endphp
                    <div class="img_comunicado" style="background-image: url('{{ asset($imagen) }}');"></div>
                </div>
                <div class="col-md-7 mt-3" style="display: flex; align-items:center;">
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