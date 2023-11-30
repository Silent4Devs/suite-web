@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('Reglas-DayOff') }}
    </div>

    @include('admin.dayoff.estilos')

    <div class="row">
        <h5 class="col-12 titulo_general_funcion">Lineamientos para Days Off´s</h5>
    </div>

    <div class="row">
        @can('reglas_dayoff_crear')
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('admin.dayOff.create') }}" type="button" class="btn btn-crear">Crear Lineamiento +</a>
            </div>
        @endcan
    </div>

    {{-- <div class="mt-5 card">
        <div class="px-1 py-2 mb-4 rounded mt-2 mr-1 ml-1 "
            style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección se determinarán los
                        lineamientos que se aplicarán a las solicitudes de Day Off de los colaboradores.
                    </p>

                </div>
            </div>
        </div> --}}
    {{-- @can('reglas_dayoff_acceder')
        <div style="margin-bottom: 10px; margin-left:10px;" class="row">
            <div class="col-lg-12">
                @include('csvImport.modal', [
                    'model' => 'Amenaza',
                    'route' => 'admin.amenazas.parseCsvImport',
                ])
            </div>
        @endcan
    </div> --}}


    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        @include('admin.dayOff.table')
    </div>
    {{-- </div> --}}
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            // let dtButtons = [{
            //         extend: 'csvHtml5',
            //         title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar CSV',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },
            //     {
            //         extend: 'excelHtml5',
            //         title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar Excel',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },

            //     {
            //         extend: 'print',
            //         text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Imprimir',
            //         // set custom header when print
            //         customize: function(doc) {
            //             let logo_actual = @json($logo_actual);
            //             let empresa_actual = @json($empresa_actual);
            //             let empleado = @json(auth()->user()->empleado->name);

            //             var now = new Date();
            //             var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
            //             $(doc.document.body).prepend(`
        //                 <div class="row">
        //                     <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
        //                         <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
        //                     </div>
        //                     <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
        //                         <p>${empresa_actual}</p>
        //                         <strong style="color:#345183">Amenazas</strong>
        //                     </div>
        //                     <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
        //                         Fecha: ${jsDate}
        //                     </div>
        //                 </div>
        //             `);

            //             $(doc.document.body).find('table')
            //                 .css('font-size', '12px')
            //                 .css('margin-top', '15px')
            //             // .css('margin-bottom', '60px')
            //             $(doc.document.body).find('th').each(function(index) {
            //                 $(this).css('font-size', '18px');
            //                 $(this).css('color', '#fff');
            //                 $(this).css('background-color', 'blue');
            //             });
            //         },
            //         title: '',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },
            //     {
            //         extend: 'colvis',
            //         text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Seleccionar Columnas',
            //     },
            //     {
            //         extend: 'colvisGroup',
            //         text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         show: ':hidden',
            //         titleAttr: 'Ver todo',
            //     },
            //     {
            //         extend: 'colvisRestore',
            //         text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Restaurar a estado anterior',
            //     }

            // ];

            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar Regla',
            //     url: "{{ route('admin.dayOff.create') }}",
            //     className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };
            // let btnExport = {
            //     text: '<i  class="fas fa-download"></i>',
            //     titleAttr: 'Descargar plantilla',
            //     className: "btn btn_cargar",
            //     url: "{{ route('descarga-amenaza') }}",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };
            // let btnImport = {
            //     text: '<i  class="fas fa-file-upload"></i>',
            //     titleAttr: 'Importar datos',
            //     className: "btn btn_cargar",
            //     action: function(e, dt, node, config) {
            //         $('#csvImportModal').modal('show');
            //     }
            // };

            // @can('reglas_dayoff_acceder')
            //     dtButtons.push(btnAgregar);
            // @endcan


            let = dtButtons = [];

            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);

            @can('reglas_dayoff_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.dayOff.massDestroy') }}",
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
                //dtButtons.push(deleteButton)
            @endcan
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.dayOff.index') }}",
                columns: [{
                        data: 'nombre',
                        name: 'nombre',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }

                    },
                    {
                        data: 'tipo_conteo',
                        name: 'tipo_conteo',
                        render: function(data, type, row) {
                            const tipo_conteo = row.tipo_conteo;
                            switch (tipo_conteo) {
                                case 1:
                                    return `
                            <div  style="text-align:left">
                                Día Natural
                            </div>
                            `;
                                    break;
                                case 2:
                                    return `
                            <div style="text-align:left">
                                Día hábil
                            </div>
                            `;
                                    break;
                                default:
                                    return `
                             <div style="text-align:left"> No se ha definido</div>
                            `;
                            }
                        }
                    },
                    {
                        data: 'inicio_conteo',
                        name: 'inicio_conteo',
                        render: function(data, type, row) {
                            const inicio_conteo = row.inicio_conteo;
                            switch (inicio_conteo) {
                                case 1:
                                    return `
                            <div  style="text-align:left">
                                Al ingreso
                            </div>
                            `;
                                    break;
                                case 2:
                                    return `
                            <div style="text-align:left">
                                Otro
                            </div>
                            `;
                                    break;
                                default:
                                    return `
                             <div style="text-align:left">No se ha definido</div>
                            `;
                            }
                        }

                    },
                    {
                        data: 'dias',
                        name: 'dias',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data} días</div>`;
                        }

                    },

                    // {
                    //     data: 'incremento_dias',
                    //     name: 'incremento_dias',
                    //     render: function(data, type, row) {
                    //         return `<div style="text-align:left">${data} días</div>`;
                    //     }
                    // },
                    {
                        data: 'periodo_corte',
                        name: 'periodo_corte',
                        render: function(data, type, row) {
                            const periodo_corte = row.periodo_corte;
                            switch (periodo_corte) {
                                case 1:
                                    return `
                            <div  style="text-align:left">
                                Aniversario
                            </div>
                            `;
                                    break;
                                case 2:
                                    return `
                            <div style="text-align:left">
                                Anual
                            </div>
                            `;
                                    break;
                                default:
                                    return `
                             <div style="text-align:left">No se ha definido</div>
                            `;
                            }
                        }
                    },
                    {
                        data: 'afectados',
                        name: 'afectados',
                        render: function(data, type, row) {
                            const afectados = row.afectados;
                            const areas = row.areas;

                            switch (afectados) {
                                case 1:
                                    return `
                                    <div  style="text-align:left">
                                    Toda la empresa
                                    </div>
                                    `;
                                    break;
                                case 2:
                                    let areas_seleccionadas = `<ul>`;
                                    areas.forEach(area => {
                                        areas_seleccionadas += `<li>${area.area}</li>`

                                    });
                                    areas_seleccionadas += "</ul>"
                                    return areas_seleccionadas;
                                    break;


                                default:
                                    return `
                             <div style="text-align:left">No se ha definido</div>
                            `;
                            }
                        }
                    },


                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },

                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-dayOffs').DataTable(dtOverrideGlobals);
            // $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
            //     let titulo_tabla = `
        //     <h5>
        //         <strong>
        //             Lineamientos para Days Off´s
        //         </strong>
        //     </h5>
        // `;
            //     imprimirTabla('datatable-dayOffs', titulo_tabla);
            // });

        });
    </script>
@endsection
