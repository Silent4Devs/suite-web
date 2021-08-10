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

            /*
                                                                                                    Graficas de color
                                                                                                    */
            .calor {
                width: 100%;
                margin-top: 30px;
                float: left;
            }

            .datosCalor {
                width: 40%;
                float: left;
            }

            .datosColor label {
                font-family: maven regular;
            }

            .barra1 {
                width: 100%;
                height: 25px;
                float: left;
                box-shadow: -3px 3px 3px 0px #999;
                border-radius: 50px;
                font-family: maven regular;
                text-align: center;
                padding-top: 5px;
                color: #fff;
            }

            #s_baja {
                background-color: #18a827;
                display: none;
            }

            #s_media {
                background-color: #eef100;
                display: none;
                color: #000;
            }

            #s_alta {
                background-color: #ff9600;
                display: none;
            }

            #s_muyAlta {
                background-color: #cb0000;
                display: none;
            }

            .barra2 {
                width: 100%;
                height: 25px;
                float: left;
                box-shadow: -3px 3px 3px 0px #999;
                border-radius: 50px;
                font-family: maven regular;
                text-align: center;
                padding-top: 5px;
                color: #fff;
            }

            #p_baja {
                background-color: #18a827;
                display: none;
            }

            #p_media {
                background-color: #eef100;
                display: none;
                color: #000;
            }

            #p_alta {
                background-color: #ff9600;
                display: none;
            }

            #p_muyAlta {
                background-color: #cb0000;
                display: none;
            }

            .barra3 {
                width: 100%;
                height: 25px;
                float: left;
                box-shadow: -3px 3px 3px 0px #999;
                border-radius: 50px;
                font-family: maven regular;
                text-align: center;
                padding-top: 5px;
                color: #fff;
            }

            #r_baja {
                background-color: #18a827;
                display: none;
            }

            #r_media {
                background-color: #eef100;
                display: none;
                color: #000;
            }

            #r_alta {
                background-color: #ff9600;
                display: none;
            }

            #r_muyAlta {
                background-color: #cb0000;
                display: none;
            }

            .mapaCalor {
                width: 60%;
                float: right;
            }

            .mapaCalor table {
                font-family: maven regular;
                margin-top: 50px;
            }

            .mapaCalor td {
                width: 100px;
                height: 50px;
                text-align: center;
            }

            .mapaCalor td:hover {
                filter: saturate(500%);
            }

            .verde {
                background-color: #18a827;
            }

            .amarillo {
                background-color: #eef100;
            }

            .naranja {
                background-color: #ff9600;
            }

            .rojo {
                background-color: #cb0000;
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

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <div class="d-flex justify-content-between">
                <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                    href="{{ route('admin.matriz-riesgos.create', ['idAnalisis' => $idAnalisis]) }}" type="submit"
                    name="action">Agregar nuevo</a>
                <button class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;" data-toggle="modal"
                    data-target="#graficaModal">Gráfica</button>
            </div>
            <table class="table datatable datatable-MatrizRiesgo">
                <thead class="thead-dark">
                    <tr class="negras">
                        <th class="text-center" style="background-color:#3490DC;" colspan="8">Descripción General </th>
                        <th class="text-center" style="background-color:#1168af;" colspan="3">CID</th>
                        <th class="text-center" style="background-color:#217bc5;" colspan="4">Riesgo Inicial
                        <th class="text-center" style="background-color:#1168af;" colspan="2">Acciones</th>
                        <th class="text-center" style="background-color:#217bc5;" colspan="3">CID</th>
                        <th class="text-center" style="background-color:#1168af;" colspan="4">Riesgo Residual</th>
                        <th class="text-center" style="background-color:#1168af;" colspan="1">Opciones</th>
                    </tr>
                    <tr>
                        <th>
                            ID
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
                            Descripción riesgo
                        </th>
                        {{-- <th>
                            Tipo riesgo
                        </th> --}}
                        <th>
                            Confidencialidad
                        </th>
                        <th>
                            Integridad
                        </th>
                        <th>
                            Disponibilidad
                        </th>
                        {{-- <th>
                            Resultado ponderación por factores
                        </th> --}}
                        <th>
                            Probabilidad
                        </th>
                        <th>
                            Impacto
                        </th>
                        <th>
                            Nivel riesgo
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
                            Confidencialidad
                        </th>
                        <th>
                            Integridad
                        </th>
                        <th>
                            Disponibilidad
                        </th>
                        {{-- <th>
                            Resultado ponderación por factores
                        </th> --}}
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
                </thead>
            </table>
        </div>
    </div>

    @include('admin.matrizRiesgos.modalgrafica')

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
                        //doc.styles.tableHeader.fontSize = 7.5;
                        //doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
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

            @can('matriz_riesgo_create')
                /*let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nueva matríz de riesgos',
                url: "{{ route('admin.matriz-riesgos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);*/
            @endcan

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

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                /*dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",*/
                ajax: "{{ route('admin.matriz-seguridad') }}",
                columns: [
                    /*{
                                            data: 'placeholder',
                                            name: 'placeholder'
                                        },*/
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'id_sede',
                        name: 'id_sede'
                    },
                    {
                        data: 'id_proceso',
                        name: 'id_proceso'
                    },
                    {
                        data: 'id_responsable',
                        name: 'id_responsable'
                    },
                    {
                        data: 'activo_id',
                        name: 'activo_id'
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
                    /*{
                        data: 'tipo_riesgo',
                        name: 'tipo_riesgo'
                    },*/
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
                        data: 'controles_id',
                        name: 'controles_id'
                    }
                    {
                        data: 'plan_de_accion',
                        name: 'plan_de_accion'
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
                        data: 'probabilidad_residual',
                        name: 'probabilidad_residual'
                    },
                    {
                        data: 'impacto_residual',
                        name: 'impacto_residual'
                    },
                    {
                        data: 'nivelriesgo_residual',
                        name: 'nivelriesgo_residual'
                    },
                    {
                        data: 'riesgo_total_residual',
                        name: 'riesgo_total_residual'
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

    <script>
        $(document).ready(function() {
            $('.sedeSelect').select2();
            $('.areaSelect').select2();
        });
    </script>

    <script>
        $(".verde").mouseenter(function() {
            $("#r_baja").fadeIn(0);



            $("#r_media").fadeOut(0);
            $("#r_alta").fadeOut(0);
            $("#r_muyAlta").fadeOut(0);
        });



        $(".amarillo").mouseenter(function() {
            $("#r_media").fadeIn(0);



            $("#r_baja").fadeOut(0);
            $("#r_alta").fadeOut(0);
            $("#r_muyAlta").fadeOut(0);
        });



        $(".naranja").mouseenter(function() {
            $("#r_alta").fadeIn(0);



            $("#r_media").fadeOut(0);
            $("#r_baja").fadeOut(0);
            $("#r_muyAlta").fadeOut(0);
        });



        $(".rojo").mouseenter(function() {
            $("#r_muyAlta").fadeIn(0);



            $("#r_media").fadeOut(0);
            $("#r_alta").fadeOut(0);
            $("#r_baja").fadeOut(0);
        });





        $("#s_baja_p_muyAlta").mouseenter(function() {
            $("#s_baja").fadeIn(0);
            $("#p_muyAlta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_media_p_muyAlta").mouseenter(function() {
            $("#s_media").fadeIn(0);
            $("#p_muyAlta").fadeIn(0);




            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_alta_p_muyAlta").mouseenter(function() {
            $("#s_alta").fadeIn(0);
            $("#p_muyAlta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_muyAlta_p_muyAlta").mouseenter(function() {
            $("#s_muyAlta").fadeIn(0);
            $("#p_muyAlta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });



        $("#s_baja_p_alta").mouseenter(function() {
            $("#s_baja").fadeIn(0);
            $("#p_alta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_media_p_alta").mouseenter(function() {
            $("#s_media").fadeIn(0);
            $("#p_alta").fadeIn(0);




            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_alta_p_alta").mouseenter(function() {
            $("#s_alta").fadeIn(0);
            $("#p_alta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_muyAlta_p_alta").mouseenter(function() {
            $("#s_muyAlta").fadeIn(0);
            $("#p_alta").fadeIn(0);

            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#p_media").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_baja_p_media").mouseenter(function() {
            $("#s_baja").fadeIn(0);
            $("#p_media").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_media_p_media").mouseenter(function() {
            $("#s_media").fadeIn(0);
            $("#p_media").fadeIn(0);

            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_alta_p_media").mouseenter(function() {
            $("#s_alta").fadeIn(0);
            $("#p_media").fadeIn(0);

            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_muyAlta_p_media").mouseenter(function() {
            $("#s_muyAlta").fadeIn(0);
            $("#p_media").fadeIn(0);

            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_baja_p_baja").mouseenter(function() {
            $("#s_baja").fadeIn(0);
            $("#p_baja").fadeIn(0);
            $("#s_media").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
        });
        $("#s_media_p_baja").mouseenter(function() {
            $("#s_media").fadeIn(0);
            $("#p_baja").fadeIn(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
        });
        $("#s_alta_p_baja").mouseenter(function() {
            $("#s_alta").fadeIn(0);
            $("#p_baja").fadeIn(0);
            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
        });
        $("#s_muyAlta_p_baja").mouseenter(function() {
            $("#s_muyAlta").fadeIn(0);
            $("#p_baja").fadeIn(0);
            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
        });
    </script>
@endsection
