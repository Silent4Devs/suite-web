@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@endsection

@section('content')
    @include('admin.vacaciones.estilos')

    {{ Breadcrumbs::render('Reglas-Vacaciones') }}

    <div class="row">
        <h5 class="col-12 titulo_general_funcion">Lineamientos para Vacaciones</h5>
    </div>

    <div class="row">
        @can('reglas_vacaciones_crear')
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.vacaciones.create') }}" type="button" class="btn btn-crear">
                    Crear Lineamiento +
                </a>
            </div>
        @endcan
    </div>

    {{-- @can('reglas_vacaciones_crear')
        <div style="margin-bottom: 10px; margin-left:10px;" class="row">
            <div class="col-lg-12">
                @include('csvImport.modal', [
                    'model' => 'Amenaza',
                    'route' => 'admin.amenazas.parseCsvImport',
                ])
            </div>
        </div>
    @endcan --}}

    @include('flash::message')
    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        @include('admin.vacaciones.table')
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [
                // {
                //     extend: 'csvHtml5',
                //     title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar CSV',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     }
                // },
                // {
                //     extend: 'excelHtml5',
                //     title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar Excel',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     }
                // },

                // {
                //     extend: 'print',
                //     text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Imprimir',
                //     // set custom header when print
                //     customize: function(doc) {
                //         let logo_actual = @json($logo_actual);
                //         let empresa_actual = @json($empresa_actual);
                //         let empleado = @json(auth()->user()->empleado->name);

                //         var now = new Date();
                //         var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                //         $(doc.document.body).prepend(`
            //             <div class="row">
            //                 <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
            //                     <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
            //                 </div>
            //                 <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
            //                     <p>${empresa_actual}</p>
            //                     <strong style="color:#345183">Amenazas</strong>
            //                 </div>
            //                 <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
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
                // {
                //     extend: 'colvis',
                //     text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Seleccionar Columnas',
                // },
                // {
                //     extend: 'colvisGroup',
                //     text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     show: ':hidden',
                //     titleAttr: 'Ver todo',
                // },
                // {
                //     extend: 'colvisRestore',
                //     text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Restaurar a estado anterior',
                // }
            ];

            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar Regla',
            //     url: "{{ route('admin.vacaciones.create') }}",
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

            // @can('reglas_vacaciones_crear')
            // dtButtons.push(btnAgregar);
            // @endcan

            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);

            @can('reglas_vacaciones_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.vacaciones.massDestroy') }}",
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
                ajax: "{{ route('admin.vacaciones.index') }}",
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
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'fin_conteo',
                        name: 'fin_conteo',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
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
                    //         const incremento = row.incremento_dias;
                    //         if( incremento > 0 ){
                    //             return `<div style="text-align:left">${data} días</div>`;
                    //         }else{
                    //             return `<div style="text-align:left">0 días</div>`;
                    //         }

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
                                    <div  style="text-align:center">
                                    Toda la empresa
                                    </div>
                                    `;
                                    break;
                                case 2:

                                    // let HTML = `<ul>`
                                    // areas.forEach(element => {
                                    //     HTML += `<li>${element.areas}</li>`
                                    // });
                                    // HTML += `</ul>`
                                    // return HTML;

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
            let table = $('.datatable-vacaciones').DataTable(dtOverrideGlobals);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
                let titulo_tabla = `
                <h5>
                    <strong>
                        Vacaciones
                    </strong>
                </h5>
            `;
                imprimirTabla('datatable-vacaciones', titulo_tabla);
            });

        });
    </script>
@endsection
