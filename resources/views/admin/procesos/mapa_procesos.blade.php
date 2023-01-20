@extends('layouts.admin')
@section('content')


    <style type="text/css">
        :root {
            --color1: #0034c9;
            --color2: #c900c6;
            --color3: #c90034;
        }


        body {
            background-color: #fff;
        }

        .not-active {
            pointer-events: none;
            cursor: default;
        }

        .c-main {
            overflow-y: scroll !important;
        }

        #caja_mapa_procesos {
            width: 100%;
            position: relative;
        }

        .caja2,
        .caja_central {
            border-radius: 10px;
        }

        .caja2 {
            box-shadow: 0px 0px 0px 1px #bbb;
            height: 500px;
            position: absolute;
            width: 100px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .caja2 p {
            transform: rotate(90deg);
            min-width: 400px !important;
            height: 20px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .caja_central {
            width: calc(100% - 270px);
            position: absolute;
            left: 135px;
            padding-bottom: 55px;
        }


        .contenido_h5_and_grupos {
            margin-top: 35px;
        }

        .contenido_h5_and_grupos:first-child {
            margin-top: -15px;
        }

        .caja_central{
            text-shadow: 0px 0px 1px #000;
        }

        .caja_central h5 {
            width: 300px;
            margin: auto;
            margin-bottom: -10px;
            border-radius: 100px;
            color: #fff;
            text-align: center;
            position: relative;
            z-index: 2;
            font-size: 12pt;
        }


        .caja_central .caja_grupos {
            background-color: #f9f9f9;
            text-align: center;
            padding: 40px 0;
            box-sizing: border-box;
            border-radius: 10px;
            max-height: 200px !important;
            overflow-y: auto;
            transition: 0.5s;
            position: relative;
            z-index: 1;
            box-shadow: 0px 2px 4px -1px rgba(0, 0, 0, 0.3);
        }

        .caja_central p {
            width: 200px;
            height: 80px;
            padding: 10px;
            display: inline-block;
            border: 1px solid #ccc;
            margin: 0;
            margin-bottom: 10px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            overflow-y: auto;
            margin-right: 10px;
        }
        .caja_central p:not(p.activo){
            background-color: #fff !important;
        }
        .caja_central span {
            width: auto;
            height: auto;
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        .caja_central p:hover {
            /*border: 1px solid #1255DB;*/
        }

        .caja_central p.activo {
            color: #fff !important;
            /*background-color: #1255DB;*/
            border: 1px solid #fff;
        }


        .caja_central::-webkit-scrollbar {
            width: 7px;
        }

        .caja_central::-webkit-scrollbar-track {
            background-color: rgba(0, 0, 0, 0);
        }

        .caja_central::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .caja_central::-webkit-scrollbar-thumb:hover {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .caja_procesos_dinamica {
            width: 90%;
            padding: 20px 0;
            height: auto;
            margin: auto;
            display: none;
            text-align: center;
            max-height: 200px !important;
            overflow-y: auto;
            border-top: none !important;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .caja_revelada {
            display: block !important;
            position: relative;
            animation: 0.3s caja_revelada;
            z-index: 0;
        }

        @keyframes caja_revelada {
            0% {
                opacity: 0;
                margin-top: -70px;
            }

            100% {
                opacity: 1;
                margin-top: 0px;
            }
        }




        .caja_procesos_dinamica .macro_a {
            width: 200px;
            height: 80px;
            padding: 10px;
            display: inline-block;
            border: 1px solid #ccc;
            margin: 0;
            margin-bottom: 10px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            overflow-y: auto;
            margin-right: 10px;
        }

        .caja_procesos_dinamica a {
            color: unset;
            text-decoration: none;
        }



        .macro_a::-webkit-scrollbar,
        .caja_central p::-webkit-scrollbar {
            width: 7px;
        }



        /* Track */
        .macro_a::-webkit-scrollbar-track,
        .caja_central p::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0);
        }



        /* Handle */
        .macro_a::-webkit-scrollbar-thumb,
        .caja_central p::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50px;
        }



        /* Handle on hover */
        .macro_a::-webkit-scrollbar-thumb:hover,
        .caja_central p::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        .pendiente {

            display: inline-block;
            width: 100%;
            text-align: right;

        }

    </style>

{{ Breadcrumbs::render('admin.mapa-procesos') }}


    @if ($exist_no_publicado)
        <div class="pendiente">
            <i class="fas fa-circle" style="color:yellow"></i> Pendiente de aprobación
        </div>
    @endif
    <h5 class="col-12 titulo_general_funcion">Mapa de Procesos de {{ $organizacion->empresa }}</h5>
    
    <div class="col-12 text-right">
        <a href="{{ route('admin.areas.exportar') }}" class="mr-5"><i class="fas fa-file-csv"
                style="font-size:18pt;"></i></a>
        <a href="{{ route('admin.areas.exportar') }}" class="mr-5"><i class="fas fa-camera"
                style="font-size:18pt;"></i></a>
        <i class="fas fa-compress-arrows-alt icono_contraer" style="font-size:18pt;"></i>
    </div>
    <div id="caja_mapa_procesos" style="margin-top:30px;">
        <div class="caja2">
            <p>Necesidades del cliente</p>
        </div>
        

        <div class="caja_central">
            @foreach ($grupos_mapa as $grupo_map)
                <div class="contenido_h5_and_grupos">
                    <h5 style="background-color:{{ $grupo_map->color }} !important;">{{ $grupo_map->nombre }}</h5>
                    <div class="caja_grupos" style="border: 1px solid {{ $grupo_map->color }} !important;">
                        @forelse($grupo_map->macroprocesos as $macro_map)
                            <span id="span_caja_macro{{ $macro_map->id }}">
                                <p style="border: 1px solid {{ $grupo_map->color }} !important; background: {{ $grupo_map->color }};">{{ $macro_map->nombre }}</p>
                            </span>
                        @empty
                            <a href="{{ asset('admin/macroprocesos') }}">
                                Registrar macroprocesos
                            </a>
                        @endforelse
                    </div>


                    @foreach ($grupo_map->macroprocesos as $macro_map)
                        <div id="div_caja_macro{{ $macro_map->id }}" class="caja_procesos_dinamica"  style="border: 1px solid {{ $grupo_map->color }} !important;">
                            @forelse($macro_map->procesos as $proceso_map)
                                    <div class="macro_a  {{ $proceso_map->documento_id == null ? 'not-active' : '' }}" style="{{ $proceso_map->estatus == '2' ? 'border:2px solid yellow; color:black !important;' : '' }} {{ $proceso_map->documento_id == null ? 'border:1px solid #aaa !important; color:black !important;' : '' }} border: 1px solid {{ $grupo_map->color }};">
                                        
                                        <a href="{{ route('admin.procesos.obtenerDocumentoProcesos', $proceso_map->documento_id) }}">
                                            {{ $proceso_map->nombre }}
                                        </a>
                                    </div>
                            @empty
                                Procesos no registrados
                            @endforelse
                        </div>
                    @endforeach

                </div>

            @endforeach
        </div>



        <div class="caja2" style="right: 0px;">
            <p>Satisfaccion del cliente</p>
        </div>


        {{-- <div class="d-flex justify-content-center">
            <img src="{{ asset('img/areas.jpg') }}" class="mt-3" style="height: 400px;">
        </div> --}}

    </div>



@endsection



@section('scripts')
    <script type="text/javascript">
        $(".caja_central p:not(.activo)").click(function() {
            $("span p").removeClass("activo");
            $("span:hover p").addClass("activo");
        });

        @foreach ($grupos_mapa as $grupo_map)
            @foreach ($grupo_map->macroprocesos as $macro_map)
                $("#span_caja_macro{{ $macro_map->id }}").click(function(){
                    $(".caja_revelada").removeClass("caja_revelada");
                    $("#div_caja_macro{{ $macro_map->id }}").addClass("caja_revelada");
                });
            @endforeach
        @endforeach

        $(".icono_contraer").click(function() {
            $(".caja_revelada").removeClass("caja_revelada");
            $("span p").removeClass("activo");
        });
    </script>

@endsection
