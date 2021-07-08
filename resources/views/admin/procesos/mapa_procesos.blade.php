@extends('layouts.admin')
@section('content')
	

    <style type="text/css">

        :root{
            --color1: #0034c9;
            --color2: #c900c6;
            --color3: #c90034;
        }


        body{
            background-color: #fff;
        }
        .c-main{
            overflow-y: scroll !important;
        }
        #caja_mapa_procesos{
            width: 100%;
            position: relative;
        }
        .caja2, .caja_central{
            border-radius: 10px;
        }
        .caja2{
            box-shadow: 0px 0px 0px 1px #bbb;
            height: 500px;
            position: fixed;
            width: 100px;

            display: flex;
            align-items: center;
            justify-content: center;
        }
        .caja2 p{
            transform: rotate(90deg);
            min-width: 400px !important;
            height: 20px;

            display: flex;
            align-items: center;
            justify-content: center;
        }
        .caja_central{
            width: calc(100% - 270px);
            position: absolute;
            left: 135px;
            padding-bottom: 55px;
        }


        .contenido_h3_and_grupos{
            margin-top: 35px;
        }
        .contenido_h3_and_grupos:first-child{
            margin-top: -15px;
        }



        .caja_central .contenido_h3_and_grupos:nth-child(n) h3{background-color: var(--color1);}
        .caja_central .contenido_h3_and_grupos:nth-child(2n) h3{background-color: var(--color2);}
        .caja_central .contenido_h3_and_grupos:nth-child(3n) h3{background-color: var(--color3);}

        .caja_central h3{
            width: 300px;
            margin: auto;
            margin-bottom: -13px;
            border-radius: 100px;
            color: #fff;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        




        .caja_central .contenido_h3_and_grupos:nth-child(n) .caja_grupos{border: 1px solid var(--color1);}
        .caja_central .contenido_h3_and_grupos:nth-child(2n) .caja_grupos{border: 1px solid var(--color2);}
        .caja_central .contenido_h3_and_grupos:nth-child(3n) .caja_grupos{border: 1px solid var(--color3);}


        .caja_central .caja_grupos{
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


        .caja_central .contenido_h3_and_grupos:nth-child(n) .caja_grupos p{color: var(--color1);}
        .caja_central .contenido_h3_and_grupos:nth-child(2n) .caja_grupos p{color: var(--color2);}
        .caja_central .contenido_h3_and_grupos:nth-child(3n) .caja_grupos p{color: var(--color3);}

        .caja_central .contenido_h3_and_grupos:nth-child(n) .caja_grupos p:hover{border: 1px solid var(--color1);}
        .caja_central .contenido_h3_and_grupos:nth-child(2n) .caja_grupos p:hover{border: 1px solid var(--color2);}
        .caja_central .contenido_h3_and_grupos:nth-child(3n) .caja_grupos p:hover{border: 1px solid var(--color3);}

        .caja_central .contenido_h3_and_grupos:nth-child(n) .caja_grupos p.activo{background-color: var(--color1);}
        .caja_central .contenido_h3_and_grupos:nth-child(2n) .caja_grupos p.activo{background-color: var(--color2);}
        .caja_central .contenido_h3_and_grupos:nth-child(3n) .caja_grupos p.activo{background-color: var(--color3);}

        .caja_central p{
            width: 150px;
            padding: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            margin: 0;
            margin-top: 10px;
            border-radius: 10px;
            cursor: pointer;
        }
        .caja_central span{
            width: auto;
            height: auto;
            display: inline-block;
            margin: 0;
        }
        .caja_central p:hover{
            border: 1px solid #1255DB;
        }
        .caja_central p.activo{
            color: #fff !important;
            background-color: #1255DB;
            border: 1px solid #fff;
        }


        .caja_central::-webkit-scrollbar{
            width: 7px;
        }
        .caja_central::-webkit-scrollbar-track{
            background-color: rgba(0, 0, 0, 0);
        }
        .caja_central::-webkit-scrollbar-thumb{
            background-color: rgba(0, 0, 0, 0.2);   
            border-radius: 10px;
        }
        .caja_central::-webkit-scrollbar-thumb:hover{
            background-color: rgba(0, 0, 0, 0.3);   
        }



        .caja_central .contenido_h3_and_grupos:nth-child(n) .caja_procesos_dinamica{border:1px solid var(--color1);}
        .caja_central .contenido_h3_and_grupos:nth-child(2n) .caja_procesos_dinamica{border:1px solid var(--color2);}
        .caja_central .contenido_h3_and_grupos:nth-child(3n) .caja_procesos_dinamica{border:1px solid var(--color3);}

        .caja_procesos_dinamica{
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
        .caja_revelada{
            display: block !important;
            position: relative;
            animation: 0.3s caja_revelada;
            z-index: 0;
        }
        @keyframes caja_revelada{
            0%{
                opacity: 0;
                margin-top: -70px;
            }
            100%{
                opacity: 1;
                margin-top: 0px;
            }
        }


        .caja_central .contenido_h3_and_grupos:nth-child(n) a{color: var(--color1) !important;}
        .caja_central .contenido_h3_and_grupos:nth-child(2n) a{color: var(--color2) !important;}
        .caja_central .contenido_h3_and_grupos:nth-child(3n) a{color: var(--color3) !important;}

        .caja_central .contenido_h3_and_grupos:nth-child(n) .caja_procesos_dinamica a:not(.registre):hover{border:1px solid var(--color1);}
        .caja_central .contenido_h3_and_grupos:nth-child(2n) .caja_procesos_dinamica a:not(.registre):hover{border:1px solid var(--color2);}
        .caja_central .contenido_h3_and_grupos:nth-child(3n) .caja_procesos_dinamica a:not(.registre):hover{border:1px solid var(--color3);}

        .caja_procesos_dinamica a:not(.registre){
            width: 150px;
            padding: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            margin: 0;
            margin-bottom: 10px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
        }





 

    </style>



	<div id="caja_mapa_procesos">

        <div class="caja2">
            <p>Nececidades del cliente</p>
        </div>



        <div class="caja_central">
            @foreach($grupos_mapa as $grupo_map)
                <div class="contenido_h3_and_grupos">
                    <h3>{{$grupo_map->nombre }}</h3>
                    <div class="caja_grupos">
                    @forelse($grupo_map->macroprocesos as $macro_map)
                        <span id="span_caja_macro{{$macro_map->id}}">
                            <p>{{$macro_map->nombre}}</p>
                        </span>
                    @empty
                        <a href="{{ asset('admin/macroprocesos') }}">
                             Registrar macroprocesos
                        </a>
                    @endforelse
                    </div>
                

                    @foreach($grupo_map->macroprocesos as $macro_map)
                        <div id="div_caja_macro{{$macro_map->id}}" class="caja_procesos_dinamica">
                            @forelse($macro_map->procesos as $proceso_map)
                                <a href="#">
                                    {{$proceso_map->nombre}}
                                </a>
                            @empty
                                <a href="{{ asset('admin/procesos') }}" class="registre">
                                    Registrar procesos
                                </a>
                            @endforelse
                        </div>
                    @endforeach

                </div>

            @endforeach
        </div>



        <div class="caja2" style="right: 30px;">
            <p>Satisfaccion del cliente</p>
        </div>              


        {{-- <div class="d-flex justify-content-center">
            <img src="{{ asset('img/areas.jpg') }}" class="mt-3" style="height: 400px;">
        </div> --}}

    </div>

@endsection



@section('scripts')
    <script type="text/javascript">
        $(".caja_central p").click(function(){
            $("span p").removeClass("activo");
            $("span:hover p").addClass("activo");
        });
    </script>

    
    <script type="text/javascript">
        @foreach($grupos_mapa as $grupo_map) @foreach($grupo_map->macroprocesos as $macro_map) $("#span_caja_macro{{$macro_map->id}}").click(function(){ $(".caja_revelada").removeClass("caja_revelada"); $("#div_caja_macro{{$macro_map->id}}").addClass("caja_revelada"); }); @endforeach @endforeach
    </script>
        
@endsection