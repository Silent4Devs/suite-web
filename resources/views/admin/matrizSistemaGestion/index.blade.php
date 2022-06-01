@extends('layouts.admin')
@section('content')
    <div class="mt-5 card">

        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Matriz análisis de riesgo integral
                </strong></h3>
        </div>
        @can('configuracion_sede_create')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', [
                        'model' => 'MatrizRiesgo',
                        'route' => 'admin.matriz-riesgos.parseCsvImport',
                    ])
                </div>
            </div>
        @endcan
        @if ($numero_sedes > 0)
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones
                        </p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor registre los riesgos asociados a su organización</p>
                    </div>
                </div>
            </div>
            @include('partials.flashMessages')
            <div class="card-body datatable-fix">
                <div class="d-flex justify-content-between">
                    @can('analisis_de_riesgos_matriz_riesgo_analisis_create')
                        <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                            href="{{ route('admin.matriz-riesgos.sistema-gestion.create', ['idAnalisis' => $id_matriz]) }}"
                            type="submit" name="action">Agregar nuevo</a>
                    @endcan
                    {{-- @can('analisis_de_riesgos_matriz_riesgo_analisis_grafica_show')
                        <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                            href="{{ route('admin.matriz-mapa.SistemaGestion', ['idAnalisis' => $id_matriz]) }}">Gráfica</a>
                    @endcan --}}
                </div>
                <table class="table table-bordered w-100 datatable datatable-Matriz">
                    <thead class="thead-dark">
                        <tr class="negras">
                            <th class="text-center" style="background-color:#3490DC;" colspan="9">Descripción General
                            </th>
                            <th class="text-center" style="background-color:#1168af;" colspan="3">9001:2015</th>
                            <th class="text-center" style="background-color:#217bc5;" colspan="3">20000-1:2018</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="3">27001:2013</th>
                            <th class="text-center" style="background-color:#217bc5;" colspan="5">Riesgo Inicial
                            <th class="text-center" style="background-color:#1168af;" colspan="2">Acciones</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="3">9001:2015</th>
                            <th class="text-center" style="background-color:#217bc5;" colspan="3">20000-1:2018</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="3">27001:2013</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="4">Riesgo Residual</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="1">Opciones</th>
                        </tr>
                        <tr>
                            <th style="min-width: 30px;">
                                Id
                            </th>
                            <th style="min-width: 50px;">
                                Sede
                            </th>
                            <th style="min-width: 80px;">
                                Proceso
                            </th>
                            <th style="min-width: 120px;">
                                Responsable
                            </th>
                            <th style="min-width: 50px;">
                                Activo
                            </th>
                            <th style="min-width: 50px;">
                                Amenaza
                            </th>
                            <th style="min-width: 80px;">
                                Vulnerabilidad
                            </th>
                            <th style="min-width: 50px;">
                                Tipo&nbsp;de Riesgo
                            </th>
                            <th style="min-width: 200px;">
                                Descripción riesgo
                            </th>
                            <th>
                                Estrategia&nbsp;de Negocio
                            </th>
                            <th>
                                Calidad&nbsp;de Servicio
                            </th>
                            <th>
                                Cliente
                            </th>
                            <th>
                                Disponibilidad
                            </th>
                            <th>
                                Niveles&nbsp;de Servicio
                            </th>
                            <th>
                                Continuidad BCP
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
                                Resultado ponderación
                            </th>
                            <th>
                                Probabilidad
                            </th>
                            <th>
                                Impacto
                            </th>
                            <th style="text-align:center">
                                Nivel riesgo
                            </th>
                            <th style="min-width:120px;">
                                Riesgo&nbsp;total
                            </th>
                            <th style="min-width:170px;">
                                Control
                            </th>
                            <th>
                                Plan&nbsp;de&nbsp;acción
                            </th>
                            <th>
                                Estrategia&nbsp;de Negocio
                            </th>
                            <th>
                                Calidad&nbsp;de Servicio
                            </th>
                            <th>
                                Cliente
                            </th>
                            <th>
                                Disponibilidad
                            </th>
                            <th>
                                Niveles&nbsp;de Servicio
                            </th>
                            <th>
                                Continuidad BCP
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
                                Probabilidad
                            </th>
                            <th>
                                Impacto
                            </th>
                            <th>
                                Nivel riesgo
                            </th>
                            <th style="min-width:120px;">
                                Riesgo&nbsp;residual
                            </th>
                            <!--<th>
                                                                                                                                                    Riesgo total
                                                                                                                                                </th>-->
                            <th>
                                Opciones
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        @else
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Aún no se han agregado
                            matrices de riesgo
                            <a
                                href="{{ route('admin.matriz-riesgos.sistema-gestion.create', ['idAnalisis' => $id_matriz]) }}"><i
                                    class="fas fa-share"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Matriz Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Matriz Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Matriz Riesgos ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Matriz Riesgos ${new Date().toLocaleDateString().trim()}`,
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

            @can('configuracion_sede_create')
                let btnAgregar = {
                // text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                // titleAttr: 'Agregar sede',
                // url: "{{ route('admin.matriz-riesgos.create') }}",
                // className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                // let btnImport = {
                // text: '<i class="pl-2 pr-3 fas fa-file-csv"></i> CSV Importar',
                // titleAttr: 'Importar datos por CSV',
                // className: "btn-xs btn-outline-primary rounded ml-2 pr-3",
                // action: function(e, dt, node, config){
                // $('#csvImportModal').modal('show');
                // }
                // };
                dtButtons.push(btnAgregar);
                // dtButtons.push(btnImport);
            @endcan
            @can('configuracion_sede_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.matriz-riesgos.sistema-gestion.destroy', 'id') }}",
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let id_matriz = @json($id_matriz);
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url: "/admin/matriz-seguridad/sistema-gestion/data?id=" + id_matriz,
                    method: 'POST',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'id_sede',
                        name: 'id_sede',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'id_proceso',
                        name: 'id_proceso',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'id_responsable',
                        name: 'id_responsable',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'activo_id',
                        name: 'activo_id',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'id_amenaza',
                        name: 'id_amenaza',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'id_vulnerabilidad',
                        name: 'id_vulnerabilidad',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'tipo_riesgo',
                        name: 'tipo_riesgo',
                        render: function(data, type, row,meta) {
                            const riesgo = row.tipo_riesgo;
                            if (riesgo == 1) {
                            return `<div style="text-align:left">Positivo</div>`;
                            } if (riesgo == 0) {
                            return `<div style="text-align:left">Negativo</div>`;
                            }
                            else{
                            return `<div style="text-align:left">Negativo</div>`;
                            }
                        }
                    },
                    {
                        data: 'descripcionriesgo',
                        name: 'descripcionriesgo',
                    },
                    {
                        data: 'estrategia_negocio',
                        name: 'estrategia_negocio',
                    },
                    {
                        data: 'calidad_servicio',
                        name: 'calidad_servicio',
                    },
                    {
                        data: 'cliente',
                        name: 'cliente'
                    },
                    {
                        data: 'disponibilidad_2000',
                        name: 'disponibilidad_2000',
                    },
                    {
                        data: 'niveles_servicio',
                        name: 'niveles_servicio'
                    },
                    {
                        data: 'continuidad_BCP',
                        name: 'continuidad_BCP',
                    },

                    {
                        data: 'confidencialidad_270000',
                        name: 'confidencialidad_270000',
                    },
                    {
                        data: 'integridad_27000',
                        name: 'integridad_27000'
                    },
                    {
                        data: 'disponibilidad_27000',
                        name: 'disponibilidad_27000',
                    },
                    {
                        data: 'resultado_ponderacion',
                        name: 'resultado_ponderacion',
                    },
                    {
                        data: 'probabilidad',
                        name: 'probabilidad',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'impacto',
                        name: 'impacto',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'nivelriesgo',
                        name: 'nivelriesgo',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'riesgo_total',
                        name: 'riesgo_total',
                        render: function(data) {
                            switch (true) {
                                case data >= 136 && data <= 185:
                                    return `<div><div style="text-align:center">${data} - MUY ALTO</div></div>`;
                                    break;
                                case data >= 91 && data <= 135:
                                    return `<div><div style="text-align:center">${data} - ALTO</div></div>`;
                                    break;
                                case data >= 46 && data <= 90:
                                    return `<div><div style="text-align:center">${data} - MEDIO</div></div>`;
                                    break;
                                case data >= 0 && data <= 45:
                                    return `<div><div style="text-align:center">${data} - BAJO</div></div>`;
                                    break;
                                case data == null:
                                    return `<div ><div style="text-align:center">${data} - BAJO</div></div>`;
                                    break;
                                default:
                                    break;
                            }
                        }
                    },
                    {
                        data: 'control',
                        name: 'control',
                        render: function(data) {
                            let returnData = "<ol>";
                            let controles = JSON.parse(data);
                            console.log(controles);
                            controles.forEach(control => {
                                returnData +=
                                    `<li>${control.anexo_indice} - ${control.anexo_politica}</li>`;
                            });
                            return returnData + `</ol>`;
                        }
                    },
                    {
                        data: 'plan_de_accion',
                        name: 'plan_de_accion',
                        render: function(data, type, row, meta) {
                            let planes = JSON.parse(data);
                            let botones =
                                planes.map(plan => {
                                    return `<a href="/admin/planes-de-accion/${plan.id}" class="btn btn-sm" title="Visualizar Plan de Acción">
                                        <i class="fas fa-stream"></i>
                                        </a>`;
                                });
                            return botones;
                        }
                    },
                    {
                        data: 'estrategia_negocioRes',
                        name: 'estrategia_negocioRes',
                    },
                    {
                        data: 'calidad_servicioRes',
                        name: 'calidad_servicioRes',
                    },
                    {
                        data: 'clienteRes',
                        name: 'clienteRes'
                    },
                    {
                        data: 'disponibilidad_2000Res',
                        name: 'disponibilidad_2000Res',
                    },
                    {
                        data: 'niveles_servicioRes',
                        name: 'niveles_servicioRes'
                    },
                    {
                        data: 'continuidad_BCPRes',
                        name: 'continuidad_BCPRes',
                    },
                    {
                        data: 'confidencialidad_270000Res',
                        name: 'confidencialidad_270000Res',
                    },
                    {
                        data: 'integridad_27000Res',
                        name: 'integridad_27000Res'
                    },
                    {
                        data: 'disponibilidad_27000Res',
                        name: 'disponibilidad_27000Res',
                    },
                    {
                        data: 'probabilidad_residual',
                        name: 'probabilidad_residual',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'impacto_residual',
                        name: 'impacto_residual',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'nivelriesgo_residual',
                        name: 'nivelriesgo_residual',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'riesgo_residual',
                        name: 'riesgo_residual',
                        render: function(data) {
                            switch (true) {
                                case data >= 136 && data <= 185:
                                    return `<div style="text-align:center"><div>${data} - MUY ALTO</div></div>`;
                                    break;
                                case data >= 91 && data <= 135:
                                    return `<div style="text-align:center"><div>${data} - ALTO</div></div>`;
                                    break;
                                case data >= 46 && data <= 90:
                                    return `<div style="text-align:center"><div>${data} - MEDIO</div></div>`;
                                    break;
                                case data >= 0 && data <= 45:
                                    return `<div style="text-align:center"><div>${data} - BAJO</div></div>`;
                                    break;
                                case data == null:
                                    return `<div style="text-align:center"><div>${data} - BAJO</div></div>`;
                                    break;
                                default:
                                    break;
                            }
                        }

                    },
                    /*{
                        data: 'riesgo_total_residual',
                        name: 'riesgo_total_residual'
                    },*/
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                createdRow: (row, data, dataIndex, cells) => {
                    let background = '';
                    let color = '';
                    let background2 = '';
                    let color2 = '';
                    switch (true) {
                        case data.riesgo_total >= 136 && data.riesgo_total <= 185:
                            background = Number(data.tipo_riesgo) == 0 ?'#FF0000':'#00F06F';
                            color = Number(data.tipo_riesgo) == 0 ? '#ffffff':"#000000";
                            break;
                        case data.riesgo_total >= 91 && data.riesgo_total <= 135:
                            background = Number(data.tipo_riesgo) == 0 ?'#FFB900':"#92D050";
                            color = 'white';
                            break;
                        case data.riesgo_total >= 46 && data.riesgo_total <= 90:
                            background =  Number(data.tipo_riesgo) == 0 ?'yellow':"#92CDDC";
                            color = 'black';
                            break;
                        case data.riesgo_total >= 0 && data.riesgo_total <= 45:
                            background =  Number(data.tipo_riesgo) == 0 ? '#89E72C':"#003BF6";
                            color = Number(data.tipo_riesgo) == 0 ? 'black':'#ffffff';
                            break;
                        case data.riesgo_total == null:
                            background = Number(data.tipo_riesgo) == 0 ? '#89E72C':"#003BF6";
                            color = Number(data.tipo_riesgo) == 0 ? 'black':"#ffffff";
                            break;
                        default:
                            break;
                    }
                    switch (true) {
                        case data.riesgo_residual >= 136 && data.riesgo_residual <= 185:
                            background2 =  Number(data.tipo_riesgo) == 0 ?'red':"#00F06F";
                            color2 = 'white';
                            break;
                        case data.riesgo_residual >= 91 && data.riesgo_residual <= 135:
                            background2 =  Number(data.tipo_riesgo) == 0 ?'orange':"#92D050";
                            color2 = 'white';
                            break;
                        case data.riesgo_residual >= 46 && data.riesgo_residual <= 90:
                            background2 =  Number(data.tipo_riesgo) == 0 ?'yellow':"#92CDDC";
                            color2 = 'black';
                            break;
                        case data.riesgo_residual >= 0 && data.riesgo_residual <= 45:
                            background2 = Number(data.tipo_riesgo) == 0 ? '#89E72C':"#003BF6";
                            color2 = Number(data.tipo_riesgo) == 0 ? 'black':"#ffffff";
                            break;
                        case data.riesgo_residual == null:
                            background2 = Number(data.tipo_riesgo) == 0 ? '#89E72C':"#003BF6";
                            color2 =  Number(data.tipo_riesgo) == 0 ? 'black':"#ffffff";
                            break;
                        default:
                            break;
                    }
                    $(cells[22]).css('background-color', background)
                    $(cells[22]).css('color', color)
                    $(cells[37]).css('background-color', background2)
                    $(cells[37]).css('color', color2)
                },

                order: [
                    [1, 'desc']
                ],
            };
            let table = $('.datatable-Matriz').DataTable(dtOverrideGlobals);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.sedeSelect').select2();
            $('.areaSelect').select2();
        });
    </script>
@endsection
