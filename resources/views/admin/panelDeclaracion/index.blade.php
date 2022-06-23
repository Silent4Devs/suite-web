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
    {{ Breadcrumbs::render('admin.paneldeclaracion.index') }}

    @include('partials.flashMessages')

    <h5 class="col-12 titulo_general_funcion">Asignación Controles</h5>
    <div class="mt-5 card">

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
                            Responsable
                        </th>
                        <th>
                            Aprobador
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
@endsection




@section('scripts')
    @parent
    <script>
        $(function() {
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Panel de Declaracion ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Panel de Declaracion ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Panel de Declaracion ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        doc.styles.tableHeader.fontSize = 7.5;
                        doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Panel de Declaracion ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
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
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.paneldeclaracion.massDestroy') }}",
                className: 'btn-danger',
                action: function(e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).data(), function(entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                                headers: {
                                    'x-csrf-token': _token
                                },
                                method: 'POST',
                                url: config.url,
                                data: {
                                    ids: ids,
                                    _method: 'DELETE'
                                }
                            })
                            .done(function() {
                                location.reload()
                            })
                    }
                }
            }

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.paneldeclaracion.index') }}",
                columns: [{
                        data: 'controles',
                        name: 'controles'
                    },
                    {
                        data: 'politica',
                        name: 'politica'
                    },
                    {
                        data: 'responsable',
                        name: 'responsable',
                        render: function(data, type, row, meta) {
                            let responsableselect = "";
                            let responsableselects = @json($empleados);
                            //  console.log(row.empleados.declaraciones_responsable);
                            responsableselect = `
                            <select class="revisoresSelect" id='responsables${row.id}'' name="responsables[]" multiple="multiple" data-id='${row.id}'>
                                ${responsableselects?.map ((responsable,idx)=>{
                                    return`
                                                                                                <option ${responsable.declaraciones_responsable?.includes(row.id)?'selected':''} data-avatar='${responsable.avatar}' data-id-empleado='${responsable.id}' data-gender='${responsable.genero}'>
                                                                                                                ${responsable.name }</option>`})}
                            </select>`;
                            $(`select#responsables${row.id}`).select2({
                                theme: 'bootstrap4',
                                templateResult: formatState,
                                templateSelection: formatState
                            });
                            $(`select#responsables${row.id}`).on('select2:select', function(e) {
                                const declaracion = this.getAttribute('data-id');
                                const {
                                    element
                                } = e.params.data;
                                const responsable = element.getAttribute('data-id-empleado')
                                const url =
                                    "{{ route('admin.paneldeclaracion.responsables') }}";
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
                                            `select#responsables${row.id} option[data-id-empleado="${responsable}"]`
                                        );
                                        usuarioSeleccionado.prop('selected', false);
                                        $(`select#responsables${row.id}`).trigger(
                                            'change.select2');
                                    }
                                    console.log(data.estatus)
                                    if (data.estatus == 'ya_es_aprobador') {
                                        const usuarioSeleccionadoResp = $(
                                            `select#responsables${row.id} option[data-id-empleado="${responsable}"]`
                                        );
                                        usuarioSeleccionadoResp.prop('selected', false);
                                        $(`select#responsables${row.id}`).trigger(
                                            'change.select2');
                                    }
                                    toastr.success(data.message);
                                }).
                                catch(error => console.log)
                            });
                            $(`select#responsables${row.id}`).on('select2:unselect', function(e) {
                                const declaracion = this.getAttribute('data-id');
                                const {
                                    element
                                } = e.params.data;
                                const responsable = element.getAttribute('data-id-empleado')
                                const url =
                                    "{{ route('admin.paneldeclaracion.responsables.quitar') }}";
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
                                    toastr.success(data.message);
                                }).
                                catch(error => console.log)

                            });
                            return responsableselect;
                        }
                    },
                    {
                        data: 'aprobador',
                        name: 'aprobador',
                        render: function(data, type, row, meta) {
                            let aprobadorselect = "";
                            let aprobadoreselects = @json($empleados);
                            aprobadorselect = `
                        <select class="revisoresSelect" id='aprobadores${row.id}'' name="aprobadores[]" multiple="multiple" data-id='${row.id}'>
                            ${aprobadoreselects?.map ((aprobador,idx)=>{
                                return`
                                                                                                        <option ${aprobador.declaraciones_aprobador?.includes(row.id)?'selected':''} data-avatar='${aprobador.avatar}' data-id-empleado='${aprobador.id}' data-gender='${aprobador.genero}'>
                                                                                                            ${aprobador.name }</option>`})}
                                </select>`;
                            $(`select#aprobadores${row.id}`).select2({
                                theme: 'bootstrap4',
                                templateResult: formatState,
                                templateSelection: formatState
                            });
                            $(`select#aprobadores${row.id}`).on('select2:select', function(e) {
                                const declaracion = this.getAttribute('data-id');
                                const {
                                    element
                                } = e.params.data;
                                const aprobador = element.getAttribute('data-id-empleado')
                                const url =
                                    "{{ route('admin.paneldeclaracion.aprobadores') }}";
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
                                            `select#aprobadores${row.id} option[data-id-empleado="${aprobador}"]`
                                        );
                                        usuarioSeleccionado.prop('selected', false);
                                        $(`select#aprobadores${row.id}`).trigger(
                                            'change.select2');
                                    }
                                    if (data.estatus == 'ya_es_responsable') {
                                        const usuarioSeleccionadoAprob = $(
                                            `select#aprobadores${row.id} option[data-id-empleado="${aprobador}"]`
                                        );
                                        usuarioSeleccionadoAprob.prop('selected',
                                            false);
                                        $(`select#aprobadores${row.id}`).trigger(
                                            'change.select2');
                                    }
                                    toastr.success(data.message);
                                }).
                                catch(error => console.log)
                            });
                            $(`select#aprobadores${row.id}`).on('select2:unselect', function(e) {
                                const declaracion = this.getAttribute('data-id');
                                const {
                                    element
                                } = e.params.data;
                                const aprobador = element.getAttribute('data-id-empleado')
                                const url =
                                    "{{ route('admin.paneldeclaracion.aprobadores.quitar') }}";
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
                                    toastr.success(data.message);
                                }).
                                catch(error => console.log)
                                console.log(declaracion, aprobador);
                            });
                            return aprobadorselect;
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
                }
                // paging: false
            };
            let table = $('.datatable-PanelDeclaracion').DataTable(dtOverrideGlobals);
            // $('.datatable-PanelDeclaracion').on('page.dt', function() {
            //     setTimeout(() => {
            //         $('select.empleado').select2({
            //             theme: 'bootstrap4',
            //             templateResult: formatState,
            //             templateSelection: formatState
            //         });

            //         $('.revisoresSelect').select2({
            //             theme: 'bootstrap4',
            //             templateResult: formatState,
            //             templateSelection: formatState
            //         });

            //         $(`select#responsables`).select2({
            //             theme: 'bootstrap4',
            //             templateResult: formatState,
            //             templateSelection: formatState
            //         });
            //     }, 2000);
            // });
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

                const enviarTodos = dataRadio == 1 ? false : true;
                const enviarNoNotificados = dataRadio == 2 ? false : true;
                const url = "{{ route('admin.paneldeclaracion.enviarcorreo') }}"
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
                        console.log(data);
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
