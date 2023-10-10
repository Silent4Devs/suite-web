@extends('layouts.admin')
@section('content')

    <style>
        .menulogin {
            width: 40%;
            height: auto;
            position: fixed;
            z-index: 30;
            top: 200px;
            left: 35%;
            background-color: rgba(255, 255, 255, 10);
            border-radius: 20px;
            /* redondear bordes (esquinas)*/
            box-shadow: 3px 3px 3px #707070;
            /*sombra del elemento-desplazamiento x-desplazamiento y-desenfoque-color*/

        }

        .btnCerrar {
            width: 25px;
            height: 25px;
            color: #ffffff;
            font-size: 13pt;
            text-align: center;
            line-height: 1.5;
            float: right;
            margin-right: 30px;
            margin-top: 10px;
            cursor: pointer;

        }

    </style>
    <h5 class="col-12 titulo_general_funcion">Áreas</h5>
    <div class="mt-5 card">
        <div class="row">
            <div class="col-sm-12 col-12 col-lg-6">
                @if ($numero_grupos > 0)
                    <div class="row justify-content-center">
                        @foreach ($grupos as $grupo)
                            <div class="col-10">
                                <div class="mt-3 card justify-content-center"
                                    style="box-shadow: 0px 0px 0px 2px {{ $grupo->color }}!important;">
                                    <div class="row justify-content-center">
                                        <div class="col-3 card justify-content-center"
                                            style="margin-top:-18px; background-color:{{ $grupo->color }}!important;">
                                            <p class="text-center text-white">{{ $grupo->nombre }}</p>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row justify-content-center">
                                            @foreach ($grupo->areas as $area)
                                                <div class="mb-3 ml-2 mr-2 bg-white rounded shadow-sm col-3 sesioninicio"
                                                    style="height:40px;"
                                                    onclick="renderModal(this,'{{ $area->area }}', '{{ $area->descripcion }}', '{{ $grupo->color }}')">
                                                    <p class="text-center" style="cursor:pointer"> {{ $area->area }} </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <div class="menulogin d-none" style="border-top:solid 3px rgb(163, 163, 163);">



                                </div>

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="px-1 py-2 mx-3 rounded shadow"
                        style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                        <div class="row w-100">
                            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                <div class="w-100">
                                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                </div>
                            </div>
                            <div class="col-11">
                                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Aún no se han agregado áreas a la
                                    organización
                                    <a href="{{ route('admin.grupoarea.index') }}" class="item-right col-2 btn text-light"
                                        style="background-color:rgb(85, 217, 226); float:right">Agregar</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('img/areas.jpg') }}" class="mt-3" style="height: 400px;">
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function renderModal(element, nombre, descripcion, color) {
            element.style.border = `2px solid ${color!=null?color:"black"}`;

            let contenedor = document.querySelector(".menulogin");
            contenedor.classList.remove("d-none")
            contenedor.classList.add("d-block")
            contenedor.innerHTML = `
            <div class="btnCerrar" style="color:${color}">X</div>
                            <div class="row justify-content-center">
                                <div class="ml-5 bg-white rounded shadow-sm col--12 justify-content-center" style="margin-top:60px; background-color:${color}!important">
                                    <p class="text-center text-dark"> ${nombre} </p>
                                </div>

                            </div>

                            <p class="text-center" style="margin-top:20px;">${descripcion}</p>
                            `;
            let btnCerrar = document.querySelector(".btnCerrar");
            btnCerrar.addEventListener("click", function(e) {
                e.preventDefault();
                element.style.border = "none";
                contenedor.classList.remove("d-block")
                contenedor.classList.add("d-none")
            });

        }
    </script>

@endsection
