@extends('layouts.admin')
@section('content')
	

    <style type="text/css">
        body{
            background-color: #f7f7f7;
        }
        .card{
            display: inline-block;
        }
        .caja2, .caja_central{
            float: left;
            height: 500px;
            box-shadow: 0px 0px 0px 2px #888;
            border-radius: 10px;
        }
        .caja2{
            width: calc(10% - 20px);
            margin: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .caja2 p{
            transform: rotate(90deg);
        }
        .caja_central{
            width: calc(80% - 20px);
            margin: 10px;
            overflow-y: auto;
        }
        .caja_central h3{
            width: 300px;
            margin: auto;
            margin-top: -50px;
            margin-bottom: 40px;
            border-radius: 100px;
            color: #fff;
        }

        .caja_central div{
            width: 90%;
            margin-left: 5%;
            margin-top: 25px;
            border: 1px solid #ccc;
            text-align: center;
            padding: 40px 0;
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0px 2px 4px -1px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .caja_central p{
            width: 150px;
            height: 50px;
            display: inline-block;
            border: 1px solid #ccc;
            margin: 0;
            margin-top: 10px;
            border-radius: 10px;
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



        .caja_oculta{
            background-color: #eee;
            border: 1px solid #000;
            position: relative;
            transition: 0.5s;
            margin-top: -20px !important;
            color: #fff;
        }
        .caja_en_vista{
            margin-top: -105px !important;
            opacity: 0;
            z-index: -1;
        }


    </style>



	<div class="">

        <div class="caja2">
            <p>Nececidades del cliente</p>
        </div>



        <div class="caja_central">
            @foreach($areas_mapa as $area_map)
                <span>
                    <div>
                        <h3 style="background-color: #1255DB">{{$area_map->area }}</h3>
                        <p>Option</p>
                        <p>Option</p>
                        <p>Option</p>
                        <p>Option</p>
                        <p>Option</p>
                        <p>Option</p>
                        <p>Option</p>
                    </div>
                    <div class="caja_oculta caja_en_vista" style="background-color: #1255DB">
                        contenido oculto
                    </div>
                </span>
            @endforeach
        </div>



        <div class="caja2">
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
            $("span .caja_oculta").addClass("caja_en_vista");
            $("span:hover .caja_oculta").removeClass("caja_en_vista");
        });
    </script>
@endsection