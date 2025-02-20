@extends('layouts.admin')
@section('content')
    <style>
        .select-revisores .select2-selection {
            height: 50px !important;
        }

        .select-revisores .select2-selection,
        .select-revisores textarea {
            border: 2px solid #0b9095 !important;
            height: 50px !important;
        }

        .labels-publicacion {
            color: #0b9095 !important;
            font-weight: normal !important;
        }


        .table tr td:nth-child(3) {
            min-width: 300px !important;
        }

        .table tr td:nth-child(4) {
            min-width: 300px !important;
        }
    </style>
    {{ Breadcrumbs::render('admin.paneldeclaracion-2022.index') }}

    @include('partials.flashMessages')
    <x-loading-indicator />
    <h5 class="col-12 titulo_general_funcion">Asignación Controles</h5>
    <div class="mt-5 card">
        <div id="loaderComponent" style="display:none">
            <div
                style="display:flex; justify-content: center;align-items: center;background-color: black;position: fixed;top: 0px;left: 0px;z-index: 9999;width: 100%;height: 100%;opacity: .65;">
                <div style="color: #9784ed" class="la-ball-scale-ripple-multiple la-3x">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor de cada uno de los controles
                        seleccionar al responsable
                        de su gestión así como al responsable de aprobar dicho control
                    </p>

                </div>
            </div>
        </div>

        <div class="card-body datatable-fix">
            <div class="text-right">
                <button id="btnCSV" class="btn-sm rounded pr-2" style="background-color:#c2efe0; border: #fff">
                    <i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc" title="Exportar CSV"></i>
                    Exportar CSV
                </button>
                <button id="btnExportar" class="btn-sm rounded pr-2" style="background-color:#b9eeb9; border: #fff">
                    <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935" title="Exportar Excel"></i>
                    Exportar Excel
                </button>
            </div>
            @livewire('panel-declaracion-asignados2022')

            <div class="container">
                {{-- <div class="mb-4 row">
                    <div class="text-center col">
                        <a href="#" class="btn btn-sm tb-btn-primary tamaño" style="with:400px !important;" data-toggle="modal"
                            data-target="#ResponsablesModal"><i class="mr-2 text-white fas fa-file"
                                style="font-size:13pt"></i>Notificar&nbsp;usuario</a>
                    </div>
                </div> --}}
                <!-- modal -->
                <div class="modal fade" id="ResponsablesModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class='carousel-inner'>
                                    {{-- <select class="revisoresSelect" id='responsables'
                                        multiple="multiple">
                                        @foreach ($empleados as $responsable)
                                            <option data-image='{{ $responsable->foto }}'
                                                data-id-empleado='{{ $responsable->id }}'
                                                data-gender='{{ $responsable->genero }}'>
                                                {{ $responsable->name }}</option>
                                        @endforeach

                                    </select> --}}
                                    <p>Realizó modificaciones en la lista de responsables. Elija una de las opciones
                                        siguientes</p>
                                    <input type="radio" id="contactChoice1" name="contact" value="1"> Enviar
                                    actualizaciones
                                    solo
                                    a los responsables agregados.
                                    <br>
                                    <input type="radio" id="contactChoice2" name="contact" value="2">&nbsp;Enviar
                                    actualizaciones a todos
                                    los responsables.
                                    <br>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="mt-3 btn tb-btn-primary btnEnviar"
                                    onclick="enviarCorreo(event,'responsable')">Enviar</button>
                                <button type="button" class="mt-3 btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
