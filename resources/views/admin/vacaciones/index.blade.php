@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}{{config('app.cssVersion')}}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('Reglas-Vacaciones') }} --}}

    <h5 class="col-12 titulo_general_funcion">Lineamientos para Vacaciones</h5>

    @can('reglas_vacaciones_crear')
        <div class="text-right">
            <a href="{{ route('admin.vacaciones.create') }}" type="button" class="btn btn-crear">
                Crear Lineamiento +
            </a>
        </div>
    @endcan

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

    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <h3 class="title-table-rds">Lineamientos para Vacaciones</h3>
        @include('admin.vacaciones.table')
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [


            ]

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
