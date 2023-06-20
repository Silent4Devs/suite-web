@extends('layouts.admin')

@section('content')

<style>

    @page{
        size:landscape;
    }
    @media print{
        #tabla_blanca_imprimir_global{
            transform: scale(0.5);
            transform-origin: 0% 0%;
            color: black;
        }
    }
</style>

    <div class="mt-5 card">

        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Matriz Riesgo
                </strong></h3>
        </div>

            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', [
                        'model' => 'MatrizRiesgo',
                        'route' => 'admin.matriz-riesgos.parseCsvImport',
                    ])
                </div>
            </div>

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
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor registre los riesgos
                            asociados a su organización</p>
                    </div>
                </div>
            </div>
            @include('partials.flashMessages')
            <div class="card-body datatable-fix">
                <div class="d-flex justify-content-between">
                    @can('iso_27001_agregar')
                        <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                            href="{{ route('admin.matriz-riesgos.create', ['idAnalisis' => $id_matriz]) }}" type="submit"
                            name="action">Agregar nuevo</a>
                    @endcan
                        <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                            href="{{ route('admin.matriz-mapa', ['idAnalisis' => $id_matriz]) }}">Gráfica</a>
                </div>
                <table class="table table-bordered w-100 datatable datatable-Matriz" id="datatable-Matriz">
                    <thead class="thead-dark">
                        <tr class="negras">
                            <th class="text-center" style="background-color:#3490DC;" colspan="8">Descripción General
                            </th>
                            <th class="text-center" style="background-color:#1168af;" colspan="4">CID</th>
                            <th class="text-center" style="background-color:#217bc5;" colspan="3">Riesgo Inicial
                            <th class="text-center" style="background-color:#1168af;" colspan="3">Acciones</th>
                            <th class="text-center" style="background-color:#217bc5;" colspan="4">CID Residual</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="3">Riesgo Residual</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="1">Opciones</th>
                        </tr>
                        <tr>
                            <th style="min-width:20px;">
                                Id
                            </th>
                            <th style="min-width:90px;">
                                Sede
                            </th>
                            <th style="min-width:120px;">
                                Proceso
                            </th>
                            <th style="min-width:120px;">
                                Responsable
                            </th>
                            <th style="min-width:120px;">
                                Activo
                            </th>
                            <th style="min-width:120px;">
                                Amenaza
                            </th>
                            <th style="min-width:120px;">
                                Vulnerabilidad
                            </th>
                            <th style="min-width:120px;">
                                Descripción riesgo
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
                            <th style="min-width:120px;">
                                Probabilidad
                            </th>
                            <th style="min-width:120px;">
                                Impacto
                            </th>
                            <th style="min-width:120px;">
                                Nivel riesgo
                            </th>
                            <th>
                                Versión ISO
                            </th>
                            <!--<th>
                                Riesgo total
                            </th>-->
                            <th>
                                Control
                            </th>
                            <th>
                                Plan de acción
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
                            <th style="min-width:120px;">
                                Probabilidad
                            </th>
                            <th style="min-width:120px;">
                                Impacto
                            </th>
                            <th style="min-width:120px;">
                                Nivel riesgo
                            </th>
                            <th class="print-none">
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
                            <a href="{{ route('admin.matriz-riesgos.create', ['idAnalisis' => $id_matriz]) }}"><i
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
                    extend: 'print',
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    // set custom header when print
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);
                        let empleado = @json(auth()->user()->empleado->name);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                                <div class="row">
                                    <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                        <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                    </div>
                                    <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                        <p>${empresa_actual}</p>
                                        <strong style="color:#345183">Matriz ISO-27001</strong>
                                    </div>
                                    <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                        Fecha: ${jsDate}
                                    </div>
                                </div>
                            `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
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

            @can('iso_27001_agregar')
                let btnAgregar = {
                    // text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    // titleAttr: 'Agregar sede',
                    // url: "{{ route('admin.matriz-riesgos.create') }}",
                    // className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
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
            @can('iso_27001_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.matriz-riesgos.massDestroy') }}",
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
            let id_matriz = @json($id_matriz);
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "/admin/matriz-seguridad?id=" + id_matriz,
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
                        data: 'descripcionriesgo',
                        name: 'descripcionriesgo',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'confidencialidad',
                        name: 'confidencialidad',
                    },
                    {
                        data: 'integridad',
                        name: 'integridad'
                    },
                    {
                        data: 'disponibilidad',
                        name: 'disponibilidad',
                    },
                    {
                        data: 'resultadoponderacion',
                        name: 'resultadoponderacion',
                        render: function(data, type, row) {
                            return `<div style="text-align:center">${data}</div>`;
                        }
                    },
                    {
                        data: 'probabilidad',
                        name: 'probabilidad',
                        render: function(data, type, row) {
                            switch (Number(data)) {
                                case 9:
                                    return `<div style="text-align:center"><div>${data} - ALTA</div></div>`;
                                    break;
                                case 6:
                                    return `<div style="text-align:center"><div>${data} - MEDIA</div></div>`;
                                    break;
                                case 3:
                                    return `<div style="text-align:center"><div>${data} - BAJA</div></div>`;
                                    break;
                                case 0:
                                    return `<div style="text-align:center"><div>0 - NULA</div></div>`;
                                    break;
                                default:
                                    return `<div style="text-align:center"><div>No evaluado</div></div>`;
                                    break;
                            }
                        }
                    },
                    {
                        data: 'impacto',
                        name: 'impacto',
                        render: function(data, type, row) {
                            switch (Number(data)) {
                                case 9:
                                    return `<div style="text-align:center"><div>${data} - MUY ALTO</div></div>`;
                                    break;
                                case 6:
                                    return `<div style="text-align:center"><div>${data} - ALTO</div></div>`;
                                    break;
                                case 3:
                                    return `<div style="text-align:center"><div>${data} - MEDIO</div></div>`;
                                    break;
                                case 0:
                                    return `<div style="text-align:center"><div>0 - BAJO</div></div>`;
                                    break;
                                default:
                                    return `<div style="text-align:center"><div>No evaluado</div></div>`;
                                    break;
                            }
                        }
                    },
                    {
                        data: 'nivelriesgo',
                        name: 'nivelriesgo',
                        render: function(data) {
                            switch (true) {
                                case data >= 54 && data <= 81:
                                    return `<div style="text-align:center"><div>${data} - MUY ALTO</div></div>`;
                                    break;
                                case data >= 27 && data <= 36:
                                    return `<div style="text-align:center"><div>${data} - ALTO</div></div>`;
                                    break;
                                case data >= 9 && data <= 18:
                                    return `<div style="text-align:center"><div>${data} - MEDIO</div></div>`;
                                    break;
                                case data == 0:
                                    return `<div style="text-align:center"><div>0 - BAJO</div></div>`;
                                    break;
                                case data == null:
                                    return `<div style="text-align:center"><div>0 - BAJO</div></div>`;
                                    break;
                                default:
                                    break;
                            }
                        }
                    },
                    {
                        data: 'version_historico',
                        name: 'version_historico',
                        render: function(data) {
                            if(data === true) {
                                return `<div style="text-align:center"><div>27001:2013</div></div>`;
                            }else{
                                return `<div style="text-align:center"><div>27001:2022</div></div>`;
                            }
                        }
                    },
                    /*{
                        data: 'riesgototal',
                        name: 'riesgototal'
                    },*/
                    {
                        data: 'control',
                        name: 'control',
                        // render: function(data) {
                        //     let returnData = "<ol>";
                        //     let controles = JSON.parse(data);
                        //     controles.forEach(control => {
                        //         returnData +=
                        //             `<li>${control.declaracion_aplicabilidad.anexo_politica}</li>`;
                        //     });
                        //     return returnData + `</ol>`;
                        // }
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
                        data: 'confidencialidad_cid',
                        name: 'confidencialidad_cid'
                    },
                    {
                        data: 'integridad_cid',
                        name: 'integridad_cid'
                    },
                    {
                        data: 'disponibilidad_cid',
                        name: 'disponibilidad_cid'
                    },
                    {
                        data: 'resultadoponderacionRes',
                        name: 'resultadoponderacionRes',
                        render: function(data, type, row) {
                            return `<div style="text-align:center">${data}</div>`;
                        }
                    },
                    {
                        data: 'probabilidad_residual',
                        name: 'probabilidad_residual',
                        render: function(data, type, row) {
                            switch (Number(data)) {
                                case 9:
                                    return `<div style="text-align:center"><div>${data} - ALTA</div></div>`;
                                    break;
                                case 6:
                                    return `<div style="text-align:center"><div>${data} - MEDIA</div></div>`;
                                    break;
                                case 3:
                                    return `<div style="text-align:center"><div>${data} - BAJA</div></div>`;
                                    break;
                                case 0:
                                    return `<div style="text-align:center"><div> 0 - NULA</div></div>`;
                                    break;
                                default:
                                    return `<div style="text-align:center"><div>No evaluado</div></div>`;
                                    break;
                            }
                        }
                    },
                    {
                        data: 'impacto_residual',
                        name: 'impacto_residual',
                        render: function(data, type, row) {
                            switch (Number(data)) {
                                case 9:
                                    return `<div style="text-align:center"><div>${data} - MUY ALTO</div></div>`;
                                    break;
                                case 6:
                                    return `<div style="text-align:center"><div>${data} - ALTO</div></div>`;
                                    break;
                                case 3:
                                    return `<div style="text-align:center"><div>${data} - MEDIO</div></div>`;
                                    break;
                                case 0:
                                    return `<div style="text-align:center"><div> 0 - BAJO</div></div>`;
                                    break;
                                default:
                                    return `<div style="text-align:center"><div>No evaluado</div></div>`;
                                    break;
                            }
                        }
                    },
                    {
                        data: 'nivelriesgo_residual',
                        name: 'nivelriesgo_residual',
                        render: function(data) {
                            switch (true) {
                                case data >= 54 && data <= 81:
                                    return `<div style="text-align:center"><div>${data} - MUY ALTO</div></div>`;
                                    break;
                                case data >= 27 && data <= 36:
                                    return `<div style="text-align:center"><div>${data} - ALTO</div></div>`;
                                    break;
                                case data >= 9 && data <= 18:
                                    return `<div style="text-align:center"><div>${data} - MEDIO</div></div>`;
                                    break;
                                case data == 0:
                                    return `<div style="text-align:center"><div> 0 - BAJO</div></div>`;
                                    break;
                                case data == null:
                                    return `<div style="text-align:center"><div>0 - BAJO</div></div>`;
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
                        case data.nivelriesgo >= 54 && data.nivelriesgo <= 81:
                            background = '#FF0000';
                            color = "#000000";
                            break;
                        case data.nivelriesgo >= 27 && data.nivelriesgo <= 36:
                            background = '#FF7800';
                            color = "#000000";
                            break;
                        case data.nivelriesgo >= 9 && data.nivelriesgo <= 18:
                            background = '#FFFB00';
                            color = "#000000";
                            break;
                        case data.nivelriesgo == 0:
                            background = '#00FF04';
                            color = "#000000";
                            break;
                        case data.nivelriesgo == null:
                            background = '#00FF04';
                            color = "#000000";
                            break;
                        default:
                            break;
                    }

                    switch (true) {
                        case data.nivelriesgo_residual >= 54 && data.nivelriesgo_residual <= 81:
                            background2 = '#FF0000';
                            color2 = "#000000";
                            break;
                        case data.nivelriesgo_residual >= 27 && data.nivelriesgo_residual <= 36:
                            background2 = '#FF7800';
                            color2 = "#000000";
                            break;
                        case data.nivelriesgo_residual >= 9 && data.nivelriesgo_residual <= 18:
                            background2 = '#FFFB00';
                            color2 = "#000000";
                            break;
                        case data.nivelriesgo_residual == 0:
                            background2 = '#00FF04';
                            color2 = "#000000";
                            break;
                        case data.nivelriesgo_residual == null:
                            background2 = '#00FF04';
                            color2 = "#000000";
                            break;
                        default:
                            break;
                    }
                    switch (true) {
                        case data.probabilidad == 9:
                            background3 = '#FF0000';
                            color3 = "#000000";
                            break;
                        case data.probabilidad == 6:
                            background3 = '#FF7800';
                            color3 = "#000000";
                            break;
                        case data.probabilidad == 3:
                            background3 = '#FFFB00';
                            color3 = "#000000";
                            break;
                        case data.probabilidad == 0:
                            background3 = '#00FF04';
                            color3 = "#000000";
                            break;
                        case data.probabilidad == null:
                            background3 = '#00FF04';
                            color3 = "#000000";
                            break;
                        default:
                            break;
                    }
                    switch (true) {
                        case data.impacto == 9:
                            background4 = '#FF0000';
                            color4 = "#000000";
                            break;
                        case data.impacto == 6:
                            background4 = '#FF7800';
                            color4 = "#000000";
                            break;
                        case data.impacto == 3:
                            background4 = '#FFFB00';
                            color4 = "#000000";
                            break;
                        case data.impacto == 0:
                            background4 = '#00FF04';
                            color4 = "#000000";
                            break;
                        case data.impacto == null:
                            background4 = '#00FF04';
                            color4 = "#000000";
                            break;
                        default:
                            break;
                    }
                    switch (true) {
                        case data.probabilidad_residual == 9:
                            background5 = '#FF0000';
                            color5 = "#000000";
                            break;
                        case data.probabilidad_residual == 6:
                            background5 = '#FF7800';
                            color5 = "#000000";
                            break;
                        case data.probabilidad_residual == 3:
                            background5 = '#FFFB00';
                            color5 = "#000000";
                            break;
                        case data.probabilidad_residual == 0:
                            background5 = '#00FF04';
                            color5 = "#000000";
                            break;
                        case data.probabilidad_residual == null:
                            background5 = '#00FF04';
                            color5 = "#000000";
                            break;
                        default:
                            break;
                    }
                    switch (true) {
                        case data.impacto_residual == 9:
                            background6 = '#FF0000';
                            color6 = "#000000";
                            break;
                        case data.impacto_residual == 6:
                            background6 = '#FF7800';
                            color6 = "#000000";
                            break;
                        case data.impacto_residual == 3:
                            background6 = '#FFFB00';
                            color6 = "#000000";
                            break;
                        case data.impacto_residual == 0:
                            background6 = '#00FF04';
                            color6 = "#000000";
                            break;
                        case data.impacto_residual == null:
                            background6 = '#00FF04';
                            color6 = "#000000";
                            break;
                        default:
                            break;
                    }
                    $(cells[12]).css('background-color', background3)
                    $(cells[12]).css('color', color3)
                    $(cells[13]).css('background-color', background4)
                    $(cells[13]).css('color', color4)
                    $(cells[14]).css('background-color', background)
                    $(cells[14]).css('color', color)
                    $(cells[21]).css('background-color', background5)
                    $(cells[21]).css('color', color5)
                    $(cells[22]).css('background-color', background6)
                    $(cells[22]).css('color', color6)
                    $(cells[23]).css('background-color', background2)
                    $(cells[23]).css('color', color2)

                },


                order: [
                    [1, 'desc']
                ],
            };
            let table = $('.datatable-Matriz').DataTable(dtOverrideGlobals);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function(){
                let titulo_tabla = `
                    <h5>
                        <strong>
                            Matriz ISO-27001
                        </strong>
                    </h5>
                `;
                imprimirTabla('datatable-Matriz', titulo_tabla);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.sedeSelect').select2();
            $('.areaSelect').select2();
        });
    </script>
@endsection
