@extends('layouts.admin')
@section('content')
    <style>
        #tabla-contenedores tr td:nth-child(3) {
            background-color: green;
            position: relative;
            padding: 0;
        }

    </style>

    <div class="mt-5 card">
        {{-- <div style="margin-bottom: 10px; margin-left:10px;" class="row">
    <div class="col-lg-12">
        @include('csvImport.modalpartesinteresadas', ['model' => 'Amenaza', 'route' => 'admin.amenazas.parseCsvImport'])
    </div>
    </div> --}}

        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong>Contenedor</h3>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8 align-content-center">
                    @include('layouts.errors')
                    @include('flash::message')
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">

            @include('admin.OCTAVE.menu')

            <table class="table datatable-ConfSoporte tbl-contenedores " style="width: 100%" id="tabla-contenedores">
                <thead class="thead-dark dt-personalizada">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Nombre Contenedor
                        </th>
                        <th>
                            Nivel de Riesgo
                        </th>
                        <th style="min-width:200px;">
                            Descripción
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
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
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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

            @can('recurso_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar curso y capacitación',
                url: "{{ route('admin.contenedores.create', $matriz) }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                // let btnExport = {
                // text: '<i class="fas fa-download"></i>',
                // titleAttr: 'Descargar plantilla',
                // className: "btn btn_cargar" ,
                // url:"{{ route('descarga-categoriacapacitacion') }}",
                // action: function(e, dt, node, config) {
                // let {
                // url
                // } = config;
                // window.location.href = url;
                // }
                // };
                // let btnImport = {
                // text: '<i class="fas fa-file-upload"></i>',
                // titleAttr: 'Importar datos',
                // className: "btn btn_cargar",
                // action: function(e, dt, node, config) {
                // $('#xlsxImportModal').modal('show');
                // }
                // };
            
                dtButtons.push(btnAgregar);
                // dtButtons.push(btnExport);
                // dtButtons.push(btnImport);
            @endcan

            @can('competencium_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.contenedores.massDestroy') }}",
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
                ajax: "{{ route('admin.contenedores.index', $matriz) }}",
                columns: [{
                        data: 'identificador_contenedor',
                        name: 'identificador_contenedor',
                    },
                    {
                        data: 'nom_contenedor',
                        name: 'nom_contenedor',
                    },
                    {
                        data: 'riesgo',
                        name: 'riesgo',
                        render: function(data, type, row, meta) {
                            data = data == "" ? 0 : data
                            let color = "green";
                            let valor = "";
                            let texto = "white";
                            if (data <= 0) {
                                color = "gray";
                                valor = "Sin Valor";
                            }
                            if (data <= 3) {
                                color = "green";
                                valor = "Bajo";
                            }
                            if (data >= 5) {
                                color = "yellow";
                                texto = "black";
                                valor = "Media";
                            }
                            if (data >= 7) {
                                color = "orange";
                                valor = "Alta";
                            }
                            if (data >= 10) {
                                color = "red";
                                valor = "Crítica";
                            }
                            return `
                            <div style="position:absolute; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background-color:${color}; color:${texto}">${data} - ${valor}</div>
                            `
                        }
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let contenedor = data;
                            let matriz = @json($matriz);
                            let html = `
                            <a class="btn" href="/admin/contenedores/${contenedor}/edit/${matriz}"><i class="fas fa-edit"></i></a>
                            <button class="btn text-danger" onclick='event.preventDefault();Eliminar("/admin/contenedores/${contenedor}")'><i class="fas fa-trash-alt"></i></button>

                            `

                            return html;
                        }

                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            };
            let table = $('.tbl-contenedores').DataTable(dtOverrideGlobals);
            window.Eliminar = (url) => {
                console.log(url);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            dataType: "Json",
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        });

                    }
                })

            }
        });
    </script>
@endsection
