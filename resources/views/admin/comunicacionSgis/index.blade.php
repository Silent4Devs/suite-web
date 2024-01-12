@extends('layouts.admin')
@section('content')

    <style>
        .table tr th:nth-child(3) {
            text-align: center !important;
        }

        .img-size {
            /*  padding: 0;
                margin: 0; */
            height: 400px;
            width: 100%;
            background-size: contain;
        }

        .modal-content {

            height: 400px;
            border: none;
        }

        .modal-body {
            padding: 0;
        }

        .carousel-control-next,
        .carousel-control-prev {
            width: 30px;
            height: 48px;
            top: 50%;
        }

        .carousel-control-next {
            right: 30px !important;
        }

        .carousel-control-prev {
            left: 30px;
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
            width: 30px;
            height: 48px;
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
            width: 30px;
            height: 48px;
        }

        .tamaño {
            width: 168px !important;
        }

    </style>

    {{ Breadcrumbs::render('admin.comunicacion-sgis.index') }}

    <h5 class="col-12 titulo_general_funcion">Comunicados Generales</h5>
        <div class="card card-body" style="background-color: #5397D5; color: #fff;">
            <div class="d-flex" style="gap: 25px;">
                <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
                <div>
                    <br>
                    <br>
                    <h4>¿Qué es Comunicados Generales?  </h4>
                    <p>
                        Anuncios o mensajes importantes  que la organización comparte con todos sus colaboradores para comunicar aspectos importante.
                    </p>
                    <p>
    
                    </p>
                </div>
            </div>
        </div>

        <div class="text-right">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.comunicacion-sgis.create') }}" type="button" class="btn btn-primary">Registrar Comunicado</a>
            </div>
        </div>

        <div class="mt-5 card">

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-ComunicacionSgi">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            {{ trans('cruds.comunicacionSgi.fields.id') }}
                        </th>
                        <th>
                            {{ trans('Título') }}
                        </th>
                        <th>
                            {{ trans('cruds.comunicacionSgi.fields.archivo') }}
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                    {{-- <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr> --}}
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Comunicación SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Comunicación SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Comunicación SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Comunicación SGSI ${new Date().toLocaleDateString().trim()}`,
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
                }

            ];

            @can('comunicados_generales_agregar')
                // let btnAgregar = {

                // text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                // titleAttr: 'Agregar comunicación SGSI',
                // url: "{{ route('admin.comunicacion-sgis.create') }}",
                // className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                // action: function(e, dt, node, config){
                // let {url} = config;
                // window.location.href = url;
                // }
                // };
                // dtButtons.push(btnAgregar);
            @endcan





            @can('comunicados_generales_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.comunicacion-sgis.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
                });

                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                //dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.comunicacion-sgis.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'titulo',
                        name: 'titulo'
                    },
                    {
                        data: 'archivo',
                        name: 'archivo',
                        render: function(data, type, row, meta) {
                            let archivo = "";
                            let archivos = JSON.parse(data);
                            archivo = ` <div class="container">

                                    <div class="mb-4 row">
                                    <div class="text-center col">
                                        @can('comunicados_generales_vinculo')
                                        <a href="#" class="btn btn-sm btn-primary tamaño" style="with:400px !important;" data-toggle="modal" data-target="#largeModal${row.id}"><i class="mr-2 text-white fas fa-file" style="font-size:13pt"></i>Visualizar&nbsp;archivos</a>
                                        @endcan
                                    </div>
                                    </div>

                                    <!-- modal -->
                                    <div class="modal fade" id="largeModal${row.id}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-body">`;
                            if (archivos.length > 0) {
                                archivo += `
                                            <!-- carousel -->
                                            <div
                                                id='carouselExampleIndicators${row.id}'
                                                class='carousel slide'
                                                data-ride='carousel'
                                                >
                                            <ol class='carousel-indicators'>
                                                    ${archivos?.map((archivo,idx)=>{
                                                        return `
                                                        <li
                                                        data-target='#carouselExampleIndicators${row.id}'
                                                        data-slide-to='${idx}'
                                                        ></li>`
                                                    })}
                                            </ol>
                                            <div class='carousel-inner'>
                                                    ${archivos?.map((archivo,idx)=>{
                                                        // console.log(archivo);
                                                        const [extension, ...nameParts] = archivo.documento.split('.').reverse();

                                                        if(extension == 'pdf'){
                                                            return `
                                                                    <div class='carousel-item ${idx==0?"active":""}'>
                                                                        <embed seamless class='img-size' src='{{ asset("storage/documento_comunicado_SGI") }}/${archivo.documento}'></embed>
                                                                    </div>`
                                                        }else{
                                                            return `
                                                                    <div class='text-center my-5 carousel-item ${idx==0?"active":""}'>
                                                                       <a href='{{ asset("storage/documento_comunicado_SGI") }}/${archivo.documento}'><i class="fas fa-file-download mr-2" style="font-size:18px"></i> ${archivo.documento}</a>
                                                                    </div>`
                                                        }

                                                    })}

                                            </div>

                                            </div>`;
                            } else {
                                archivo += `
                                                <div class="text-center">
                                                    <h3 style="text-align:center" class="mt-3">Sin archivo agregado</h3>
                                                    <img src="{{ asset('img/undrawn.png') }}" class="img-fluid " style="width:350px !important">
                                                    </div>
                                                `
                            }
                            archivo += `</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <a
                                                class='carousel-control-prev'
                                                href='#carouselExampleIndicators${row.id}'
                                                role='button'
                                                data-slide='prev'
                                                >
                                                <span class='carousel-control-prev-icon'
                                                    aria-hidden='true'
                                                    ></span>
                                                <span class='sr-only'>Previous</span>
                                            </a>
                                            <a
                                                class='carousel-control-next'
                                                href='#carouselExampleIndicators${row.id}'
                                                role='button'
                                                data-slide='next'
                                                >
                                                <span
                                                    class='carousel-control-next-icon'
                                                    aria-hidden='true'
                                                    ></span>
                                                <span class='sr-only'>Next</span>
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>`

                            return archivo;
                        }
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };

            let table = $('.datatable-ComunicacionSgi').DataTable(dtOverrideGlobals);
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });
            // $('.datatable thead').on('input', '.search', function() {
            //     let strict = $(this).attr('strict') || false
            //     let value = strict && this.value ? "^" + this.value + "$" : this.value
            //     table
            //         .column($(this).parent().index())
            //         .search(value, strict)
            //         .draw()
            // });
        });
    </script>
@endsection
