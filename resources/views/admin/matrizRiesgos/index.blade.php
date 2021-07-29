@extends('layouts.admin')
@section('content')
    @can('matriz_riesgo_create')

        <style>
            th {
                background-color: #1BB0B0;
                color: #ffff;

            }

            .iconos-tabla {
                color: #fff;
                font-size: 10pt;

            }

            .iconos-top {

                margin-right: 5px;
                margin-top: 5px;
            }

        </style>

        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong><i class="fas fa-table letra_blanca"
                            style="font-size:20pt; margin-right:15px;"></i>Análisis de Riesgo</strong></h3>
            </div>

            {{-- <div style="margin-bottom:10px; margin-left:12px;" class="row">
                  <div class="col-lg-12">
                      <a class="btn btn-success" href="{{ route('admin.matriz-riesgos.create') }}">
                          Agregar Riesgo
                      </a>
                  </div>
              </div> --}}
        @endcan


        <div class="card-body datatable-fix">
            <table class="table datatable-MatrizRiesgo">
                <thead class="thead-dark">
                    <tr class="negras">
                        <th class="text-center" style="background-color:#3490DC;" colspan="10">Descripción General </th>
                        <th class="text-center" style="background-color:#1168af;" colspan="4">CID</th>
                        <th class="text-center" style="background-color:#217bc5;" colspan="4">Riesgo Inicial
                        <th class="text-center" style="background-color:#1168af;" colspan="2">Acciones</th>
                        <th class="text-center" style="background-color:#1168af;" colspan="4">CID</th>
                        <th class="text-center" style="background-color:#1168af;" colspan="4">Riesgo Residual</th>
                        <th class="text-center" style="background-color:#1168af;" colspan="1">Opciones</th>
                        </th>
                    </tr>
                    <tr>
                        <th>
                        </th>
                        <th>
                            {{ trans('cruds.matrizRiesgo.fields.id') }}
                        </th>
                        <th>
                            Sede
                        </th>
                        <th>
                            Proceso
                        </th>
                        <th>
                            Responsable
                        </th>
                        <th>
                            Activo
                        </th>
                        <th>
                            Amenaza
                        </th>
                        <th>
                            Vulnerabilidad
                        </th>
                        <th>
                            Descripción del Riesgo
                        </th>
                        <th>
                            Tipo de riesgo
                        </th>
                        <th>
                            Confidencialidad
                        </th>
                        <th>
                            Integridad
                        </th>
                        <th>
                            Disponibilidad
                        </th>
                        <th>
                            Resultado ponderación por factores
                        </th>
                        <th>
                            Probabilidad
                        </th>
                        <th>
                            Impacto
                        </th>
                        <th>
                            Nivel de riesgo
                        </th>
                        <th>
                            Riesgo Total
                        </th>
                        <th>
                            Control
                        </th>
                        <th>
                            Plan de acción
                        </th>
                        <th>
                            Confiabilidad
                        </th>
                        <th>
                            Integridad
                        </th>
                        <th>
                            Disponibilidad
                        </th>
                        <th>
                            Resultado ponderación por factores
                        </th>
                        <th>
                            Probabilidad
                        </th>
                        <th>
                            Impacto
                        </th>
                        <th>
                            Nivel de riesgo
                        </th>
                        <th>
                            Riesgo Total
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
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($tipoactivos as $key => $item)
                                    <option value="{{ $item->tipo }}">{{ $item->tipo }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach (App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @if ($errors->has('confidencialidad'))
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @if ($errors->has('integridad'))
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @if ($errors->has('disponibilidad'))
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach (App\Models\MatrizRiesgo::PROBABILIDAD_SELECT as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach (App\Models\MatrizRiesgo::IMPACTO_SELECT as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($controles as $key => $item)
                                    <option value="{{ $item->numero }}">{{ $item->numero }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr> --}}
                </thead>
            </table>
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
                    title: `Matríz de Riesgo ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Matríz de Riesgo ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Matríz de Riesgo ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Matríz de Riesgo ${new Date().toLocaleDateString().trim()}`,
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
            @can('matriz_riesgo_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.matriz-riesgos.massDestroy') }}",
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

            @can('matriz_riesgo_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nueva matríz de riesgos',
                url: "{{ route('admin.matriz-riesgos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.matriz-riesgos.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'sede',
                        name: 'sede'
                    },
                    {
                        data: 'proceso',
                        name: 'proceso'
                    },
                    {
                        data: 'responsable',
                        name: 'responsable'
                    },
                    {
                        data: 'activo',
                        name: 'activo'
                    },
                    {
                        data: 'amenaza',
                        name: 'amenaza'
                    },
                    {
                        data: 'vulnerabilidad',
                        name: 'vulnerabilidad'
                    },
                    {
                        data: 'descripcionriesgo',
                        name: 'descripcionriesgo'
                    },
                    {
                        data: 'tipo_riesgo',
                        name: 'tipo_riesgo'
                    },
                    {
                        data: 'confidencialidad',
                        name: 'confidencialidad'
                    },
                    {
                        data: 'integridad',
                        name: 'integridad'
                    },
                    {
                        data: 'disponibilidad',
                        name: 'disponibilidad'
                    },
                    {
                        data: 'resultadoponderacion',
                        name: 'resultadoponderacion'
                    },
                    {
                        data: 'probabilidad',
                        name: 'probabilidad'
                    },
                    {
                        data: 'impacto',
                        name: 'impacto'
                    },
                    {
                        data: 'nivelriesgo',
                        name: 'nivelriesgo'
                    },
                    {
                        data: 'riesgototal',
                        name: 'riesgototal'
                    },
                    {
                        data: 'control',
                        name: 'control'
                    },
                    {
                        data: 'plan_accion',
                        name: 'plan_accion'
                    },
                    {
                        data: 'confidencialidad_cid',
                        name: 'confidencialidad_cid'
                    },
                    {
                        data: 'integridad',
                        name: 'integridad'
                    },
                    {
                        data: 'disponibilidad_cid',
                        name: 'disponibilidad_cid'
                    },
                    {
                        data: 'resultado_ponderacion_cid',
                        name: 'resultado_ponderacion_cid'
                    },
                    {
                        data: 'riesgo_residual_probabilidad',
                        name: 'riesgo_residual_probabilidad'
                    },
                    {
                        data: 'riesgo_residual_impacto',
                        name: 'riesgo_residual_impacto'
                    },
                    {
                        data: 'riesgo_residual_nivel',
                        name: 'riesgo_residual_nivel'
                    },
                    {
                        data: 'riesgo_residual_total',
                        name: 'riesgo_residual_total'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            };
            let table = $('.datatable-MatrizRiesgo').DataTable(dtOverrideGlobals);
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
