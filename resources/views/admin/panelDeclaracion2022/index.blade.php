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
            <table id="asignados">
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th scope="col" colspan="2">
                    Control
                </th>
                <th>
                    Clasificación
                </th>
                <th>
                    Responsable
                </th>
                <th>
                    Aprobador
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asignados as $as)
            <tr>
                <td>
                    {{strval($as->gapdos->control_iso)}}
                </td>
                <td>
                    {{$as->gapdos->anexo_politica}}
                </td>
                <td>
                    {{$as->gapdos->clasificacion->nombre}}
                </td>
                <td>
                    {{$as->responsables2022->empleado->name ?? ''}}
                </td>
                <td>
                    {{$as->aprobadores2022->empleado->name ?? ''}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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




@section('scripts')
    @parent

    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>

    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>

    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script>
        const $btnExportar = document.querySelector("#btnExportar"),
            $tabla = document.querySelector("#asignados");

        $btnExportar.addEventListener("click", function() {
            let tableExport = new TableExport($tabla, {
                exportButtons: false, // No queremos botones
                filename: "Asignacion de Controles Norma ISO27001:2022", //Nombre del archivo de Excel
                sheetname: "Asignacion de Objetivos", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            // console.log(datos.tblobjetivos.xlsx.data);

            // console.log(datos.tblobjetivos);
            // console.log(datos.tblobjetivos.xlsx);
            // console.log(datos.tblobjetivos.xlsx.data);
            let preferenciasDocumento = datos.asignados.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);

        });
        </script>
    <script>
            const $btnCSV = document.querySelector("#btnCSV");
            $tablacsv = document.querySelector("#asignados");

        $btnCSV.addEventListener("click", function() {
            let tableExport2 = new TableExport($tablacsv, {
                exportButtons2: false, // No queremos botones
                filename2: "Asignacion de Controles Norma ISO27001:2022", //Nombre del archivo de Excel
                sheetname2: "Asignacion de Objetivos", //Título de la hoja
            });
            let datos2 = tableExport2.getExportData();
            // console.log(datos.tblobjetivos.xlsx.data);

            // console.log(datos.tblobjetivos);
            // console.log(datos.tblobjetivos.xlsx);
            // console.log(datos.tblobjetivos.xlsx.data);
            let preferenciasDocumento2 = datos2.asignados.csv;
            tableExport2.export2file(preferenciasDocumento2.data, preferenciasDocumento2.mimeType, preferenciasDocumento2.filename2, preferenciasDocumento2.fileExtension, preferenciasDocumento2.merges, preferenciasDocumento2.RTL, preferenciasDocumento2.sheetname2);
        });
    </script>

    <script>    
     document.addEventListener('DOMContentLoaded', function() {

            window.enviarCorreo = (e, tipo) => {
                let enviarRadio = document.getElementsByName('contact');

                //false
                let dataRadio = document.querySelector('input[name=contact]:checked').value;

                const responsables = $(e.target.parentElement.querySelector('select')).select2('data');
                console.log(dataRadio);
                const array_responsables = [];
                if (responsables) {
                    responsables.forEach(responsable => {
                        const responsable_id = responsable.element.getAttribute('data-id-empleado')
                        array_responsables.push(responsable_id)
                    })
                }

                document.getElementById('loaderComponent').style.display = 'block';


                const enviarTodos = dataRadio == 1 ? false : true;
                const enviarNoNotificados = dataRadio == 2 ? false : true;
                const url = "{{ route('admin.paneldeclaracion-2022.enviarcorreo') }}"
                const token = "{{ csrf_token() }}";
                const request = fetch(url, {
                        mode: 'cors', // this cannot be 'no-cors'
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            enviarTodos,
                            enviarNoNotificados,
                            responsables: JSON.stringify(array_responsables),
                            tipo
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        toastr.success('Correo(s) enviado(s) con éxito');
                        document.getElementById('loaderComponent').style.display = 'none';

                        $('#ResponsablesModal').modal('hide');

                        $('.modal-backdrop').hide();
                    })
                    .catch(error => {
                        document.getElementById('loaderComponent').style.display = 'none';
                        $('#ResponsablesModal').modal('hide');

                        $('.modal-backdrop').hide();
                        toastr.error(error);
                    })
            }

            $('select').select2({
                theme: 'bootstrap4',
            });

            $('select.empleado').select2({
                theme: 'bootstrap4',
                templateResult: formatState,
                templateSelection: formatState
            });

            $('.revisoresSelect').select2({
                theme: 'bootstrap4',
                templateResult: formatState,
                templateSelection: formatState
            });

            $(`select#responsables`).select2({
                theme: 'bootstrap4',
                templateResult: formatState,
                templateSelection: formatState
            });

        });

        window.formatState = (opt) => {
            if (!opt.id) {
                return opt.text;
            }
            var optimage = $(opt.element).attr('data-avatar');

            var $opt = $(
                '<span><img src="{{ asset('storage/empleados/imagenes/') }}/' +
                optimage +
                '" class="img-fluid rounded-circle" width="30" height="30"/>' +
                opt.text + '</span>'
            );

            return $opt;
        };
    </script>
@endsection
