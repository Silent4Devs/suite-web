@extends('layouts.admin')
@section('content')


    <style>
        .caja_nuevo {
            display: inline-block;
            width: 100%;
            padding: 20px;
        }

        .nuevo {
            text-align: center;
            background-color: #f3f3f3;
            border-left: 2px solid #345183;
            margin-top: 10px;
            padding: 10px;
            width: 350px;
            min-height: 80px;
            display: inline-block;
            overflow: hidden;
            margin: 10px;
            position: relative;
        }

        .nombre_nuevo {
            width: calc(100% - 70px);
            right: 0px;
            position: absolute;
            font-size: 12pt;
            text-align: left;
            font-weight: bold;
            text-align: center;
        }

        .img_nuevo {
            width: 50px;
            left: 0;
            text-align: center;
            position: absolute;
        }

        .img_nuevo img {
            height: 50px;
            width: auto;
            clip-path: circle(25px at 50% 50%);
        }

        .datos_nuevo {
            width: calc(100% - 50px);
            position: absolute;
            bottom: 5px;
            left: 50px;
        }

        .datos_nuevo h6 {
            margin: 0;
            font-weight: bold;
        }

        .datos_nuevo p {
            margin: 0;
            margin-bottom: 4px;
            line-height: 20px;
            margin-top: -5px;
        }
    </style>


    <div class="card">
        <div class="card-body">
            <h5 class="col-12 titulo_general_funcion mt-3">Vista del documento:
                {{ $documento->nombre ?? 'Documento no encontrado' }}</h5>
            {{-- <h3 class="mb-2 text-center text-white"><strong>Vista del documento:
                {{ $documento->nombre }}</strong></h3> --}}
            <a href="{{ url()->previous() }}">Regresar</a>
            <div class="mt-5">
                <div class="py-3 col-md-10 col-sm-9 bg-primary align-self-center " style="margin-top:-40px; ">


                    @if ($documento->archivo)
                        @can('documentos_download')
                            <embed src="{{ asset($path_documento . '/' . $documento->archivo) }}" class="mt-5 w-100"
                                style="height: 800px" frameborder="0" id="pdf">
                        @else
                            {{-- Oculta el panel --}}
                            {{-- <embed id="documento" src="{{ asset($path_documento . '/' . $documento->archivo) }}#toolbar=0&navpanes=0"
                            class="mt-5 w-100" style="height: 800px" frameborder="0" id="pdf"> --}}
                            <embed id="documento" src="{{ asset($path_documento . '/' . $documento->archivo) }}"
                                class="mt-5 w-100" style="height: 800px" frameborder="0" id="pdf">
                        @endcan
                    @else
                        <h5 class="col-12 titulo_general_funcion">Documento no cargado</h5>
                        {{-- <h1>Documento no cargado</h1> --}}
                    @endif
                </div>



                @if ($documento->archivo)
                    <h2 style="padding: 20px">Documento visto por:</h2>
                    <div class="caja_nuevo">

                        @forelse($empleados_vistas as $vista)
                            <div class="nuevo">
                                @if (is_null($vista->empleados))
                                    <div class="img_nuevo">
                                        <img src="{{ asset('storage/empleados/imagenes/usuario_no_cargado.png') }}"
                                            class="img_empleado">
                                    </div>
                                    <h5 class="nombre_nuevo">No hay empleado registrado</h5>
                                    <div class="datos_nuevo"></div>
                                @else
                                    <div class="img_nuevo">

                                        @if (is_null($vista->empleados->foto))
                                            <img src="{{ asset('storage/empleados/imagenes/usuario_no_cargado.png') }}"
                                                class="img_empleado">
                                        @else
                                            <img src="{{ asset('storage/empleados/imagenes/' . $vista->empleados->foto) }}"
                                                class="img_empleado">
                                        @endif
                                    </div>
                                    <h5 class="nombre_nuevo">{{ $vista->empleados->name }}</h5>
                                    <div class="datos_nuevo">
                                        <p>{{ $vista->empleados->puesto }} &nbsp;&nbsp;|&nbsp;&nbsp;
                                            @if (is_null($vista->empleados->area->area))
                                                No hay Area
                                            @else
                                                {{ $vista->empleados->area->area }}
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="nuevo">Este documento no tiene vistas</div>
                    </div>
                @endforelse
                @endif
            </div>
        </div>

    </div>



@endsection
@section('scripts')
    <script>
        var msg = "¡El botón derecho está desactivado para este sitio !";

        function disableIE() {
            if (document.all) {
                alert(msg);
                return false;
            }
        }

        function disableNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    alert(msg);
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = disableNS;
        } else {
            document.onmouseup = disableNS;
            document.oncontextmenu = disableIE;
        }
        document.oncontextmenu = ev => {
            ev.preventDefault();
            console.log("Prevented to open menu!");
        }
    </script>
@endsection
