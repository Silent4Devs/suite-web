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
            <table class="table table-bordered w-100 datatable datatable-PanelDeclaracion">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
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
                        <th>

                        </th>
                    </tr>

                </thead>
            </table>

            <div class="container">
                {{-- <div class="mb-4 row">
                    <div class="text-center col">
                        <a href="#" class="btn btn-sm btn-primary tamaño" style="with:400px !important;" data-toggle="modal"
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
                                <button type="button" class="mt-3 btn btn-primary btnEnviar"
                                    onclick="enviarCorreo(event,'responsable')">Enviar</button>
                                <button type="button" class="mt-3 btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <table id="asignados" hidden>
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
        $(function() {
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [
                // {
                //     extend: 'csvHtml5',
                //     title: `Panel de Declaracion ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar CSV',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible'],
                //         orthogonal: "responsableText"
                //     }
                // },
                // {
                    // extend: 'excelHtml5',
                    // title: `Panel de Declaracion ${new Date().toLocaleDateString().trim()}`,
                    // text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    // className: "btn-sm rounded pr-2",
                    // titleAttr: 'Exportar Excel',
                    // exportOptions: {
                    //     columns: ['th:not(:last-child):visible'],
                    //     orthogonal: "responsableText"
                    // }
                // },
                // {
                //     extend: 'pdfHtml5',
                //     title: `Panel de Declaracion ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar PDF',
                //     orientation: 'landscape',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible'],
                //         orthogonal: "responsableText"
                //     },
                //     customize: function(doc) {
                //         doc.pageMargins = [20, 60, 20, 30];
                //         // doc.styles.tableHeader.fontSize = 7.5;
                //         // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                //     }
                // },
                // {
                //     extend: 'print',
                //     title: `Panel de Declaracion ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Imprimir',
                //     customize: function(doc) {
                //         let logo_actual = @json($logo_actual);
                //         let empresa_actual = @json($empresa_actual);

                //         var now = new Date();
                //         var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                //         $(doc.document.body).prepend(`
                //         <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                //             <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                //                     <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                //                 </div>
                //                 <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                //                     <p>${empresa_actual}</p>
                //                     <strong style="color:#345183">ASIGNACIÓN CONTROLES</strong>
                //                 </div>
                //                 <div class="col-3 p-2">
                //                     Fecha: ${jsDate}
                //                 </div>
                //             </div>
                //         `);

                //         $(doc.document.body).find('table')
                //             .css('font-size', '12px')
                //             .css('margin-top', '15px')
                //         // .css('margin-bottom', '60px')
                //         $(doc.document.body).find('th').each(function(index) {
                //             $(this).css('font-size', '18px');
                //             $(this).css('color', '#fff');
                //             $(this).css('background-color', 'blue');
                //         });
                //     },
                //     title: '',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     }
                // },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                },
                {
                    text: '<a href="#" class="btn btn-sm btn-primary tamaño" style="with:400px !important;" data-toggle="modal" data-target="#ResponsablesModal"><i class="mr-2 text-white fas fa-file" style="font-size:13pt"></i>Notificar&nbsp;usuario</a>',
                    action: function(e, dt, node, config) {

                    }
                }

            ];

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.paneldeclaracion-2022.controles') }}",
                    type: 'POST',
                },
                columns: [{
                        data: 'gapdos.control_iso',
                        name: 'gapdos.control_iso',
                    },
                    {
                        data: 'gapdos.anexo_politica',
                        name: 'gapdos.anexo_politica',
                    },
                    {
                        data: 'gapdos.clasificacion.nombre',
                        name: 'gapdos.clasificacion.nombre',
                    },
                    {

                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            if (type === "responsableText") {
                                return data.name;
                            }
                            let responsableselect = "";
                            let responsableselects = @json($empleados);
                            responsableselect =
                                `<select class="revisoresSelect responsables" id='responsables${row.id}'' name="responsables[]" multiple="multiple" data-id='${row.id}'>
                            ${responsableselects?.map ((responsable,idx)=>{
                                return`<option ${responsable.declaraciones_responsable2022?.includes(row.id)?'selected':''} data-avatar='${responsable.avatar}' data-id-empleado='${responsable.id}' data-gender='${responsable.genero}'>${responsable.name }</option>`})}
                                </select>`;
                            return responsableselect;
                        }
                    },
                    {

                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            if (type === "responsableText") {
                                return data.name;
                            }
                            let aprobadorselect = "";
                            let aprobadoreselects = @json($empleados);
                            aprobadorselect = `
                    <select class="revisoresSelect aprobadores" id='aprobadores${row.id}'' name="aprobadores[]" multiple="multiple" data-id='${row.id}'>
                        ${aprobadoreselects?.map ((aprobador,idx)=>{
                            return`<option ${aprobador.declaraciones_aprobador2022?.includes(row.id)?'selected':''} data-avatar='${aprobador.avatar}' data-id-empleado='${aprobador.id}' data-gender='${aprobador.genero}'>${aprobador.name }</option>`})}
                        </select>`;
                            return aprobadorselect;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return '';
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                "drawCallback": function(settings) {
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

                    $(`select.aprobadores`).on('select2:select', function(e) {
                        document.getElementById('loaderComponent').style.display =
                            'block';
                        const declaracion = this.getAttribute('data-id');
                        const {
                            element
                        } = e.params.data;
                        const aprobador = element.getAttribute('data-id-empleado')
                        const url =
                            "{{ route('admin.paneldeclaracion-2022.aprobadores') }}";
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
                                declaracion,
                                aprobador
                            })
                        });
                        request.then(response => response.json()).
                        then(data => {
                            if (data.estatus == 'limite_alcanzado') {
                                const usuarioSeleccionado = $(
                                    `option[data-id-empleado="${aprobador}"]`
                                );
                                usuarioSeleccionado.prop('selected', false);
                                $(`select.aprobadores`).trigger(
                                    'change.select2');
                            }
                            if (data.estatus == 'ya_es_responsable') {
                                const usuarioSeleccionadoAprob = $(
                                    `option[data-id-empleado="${aprobador}"]`
                                );
                                usuarioSeleccionadoAprob.prop('selected',
                                    false);
                                $(`select.aprobadores`).trigger(
                                    'change.select2');
                            }
                            document.getElementById('loaderComponent').style.display =
                                'none';
                            toastr.success(data.message);
                        }).
                        catch(error => {
                            document.getElementById('loaderComponent').style.display =
                                'none';
                        })
                    });
                    $(`select.aprobadores`).on('select2:unselect', function(e) {
                        document.getElementById('loaderComponent').style.display =
                            'block';
                        const declaracion = this.getAttribute('data-id');
                        const {
                            element
                        } = e.params.data;
                        const aprobador = element.getAttribute('data-id-empleado')
                        const url =
                            "{{ route('admin.paneldeclaracion-2022.aprobadores.quitar') }}";
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
                                declaracion,
                                aprobador
                            })
                        });
                        request.then(response => response.json()).
                        then(data => {
                            document.getElementById('loaderComponent').style.display =
                                'none';
                            toastr.success(data.message);
                        }).
                        catch(error => {
                            document.getElementById('loaderComponent').style.display =
                                'none';
                        })
                        console.log(declaracion, aprobador);
                    });

                    $(`select.responsables`).on('select2:select', function(e) {
                        document.getElementById('loaderComponent').style.display =
                            'block';
                        const declaracion = this.getAttribute('data-id');
                        const {
                            element
                        } = e.params.data;
                        const responsable = element.getAttribute('data-id-empleado')
                        const url =
                            "{{ route('admin.paneldeclaracion-2022.responsables') }}";
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
                                declaracion,
                                responsable
                            })
                        });
                        request.then(response => response.json()).
                        then(data => {
                            if (data.estatus == 'limite_alcanzado') {
                                const usuarioSeleccionado = $(
                                    `option[data-id-empleado="${responsable}"]`
                                );
                                usuarioSeleccionado.prop('selected', false);
                                $(`.responsables`).trigger(
                                    'change.select2');
                            }
                            console.log(data.estatus)
                            if (data.estatus == 'ya_es_aprobador') {
                                const usuarioSeleccionadoResp = $(
                                    `option[data-id-empleado="${responsable}"]`
                                );
                                usuarioSeleccionadoResp.prop('selected', false);
                                $(`.responsables`).trigger(
                                    'change.select2');
                            }
                            document.getElementById('loaderComponent').style.display =
                                'none';
                            toastr.success(data.message);
                        }).
                        catch(error => {
                            document.getElementById('loaderComponent').style.display =
                                'none';
                        })
                    });
                    $(`select.responsables`).on('select2:unselect', function(e) {
                        document.getElementById('loaderComponent').style.display =
                            'block';
                        const declaracion = this.getAttribute('data-id');
                        const {
                            element
                        } = e.params.data;
                        const responsable = element.getAttribute('data-id-empleado')
                        const url =
                            "{{ route('admin.paneldeclaracion-2022.responsables.quitar') }}";
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
                                declaracion,
                                responsable
                            })
                        });
                        request.then(response => response.json()).
                        then(data => {
                            document.getElementById('loaderComponent').style.display =
                                'none';
                            toastr.success(data.message);
                        }).
                        catch(error => {
                            document.getElementById('loaderComponent').style.display =
                                'none';
                        })

                    });
                }
                // paging: false
            };
            let table = $('.datatable-PanelDeclaracion').DataTable(dtOverrideGlobals);
        });



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
