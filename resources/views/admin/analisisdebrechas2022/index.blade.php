@extends('layouts.admin')
@section('content')


    <style>
        .btn-outline-success {
            background: #788bac !important;
            color: white;
            border:none;
        }
        .btn-outline-success:focus{
            border-color:#345183 !important;
            box-shadow:none;
        }

        .btn-outline-success:active{
            box-shadow:none !important;
        }
        .btn-outline-success:hover {
            background: #788bac;
            color: white;

        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }
        th {
            background-color: #345183;
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

        .table tr th:nth-child(4) {
            min-width: 80px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(4) {
            text-align: center !important;
        }
                .card-main{
            top: 135px;
            left: 286px;
            width: 1146px;
            height: 138px;
            /* UI Properties */
            background: #3B7EB2;
            border-radius: 8px;
            opacity: 1;
            display: flex;
            align-items: center; /* Centra verticalmente los elementos en el contenedor */
        }
        .titulo-card{
            /* UI Properties */
            text-align: left;
            font: 27px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
        }
        .texto-card{
            text-align: left;
            font: 16px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
            margin-right: 60px;
            margin-left: 20px:
        }
        .container {
            display: flex;
            align-items: center; /* Centra verticalmente los elementos en el contenedor */
        }

        .left-image {
            flex: 0.25; /* El 50% del ancho disponible para la imagen */
        }

        .right-content {
            flex: 3; /* El 50% del ancho disponible para el contenido */
        }
        .titulo{
            text-align: left;
            font: normal normal 600 24px Segoe UI;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
            margin-left: 5px;
            margin-bottom: 12px;
        }
        .display-analisis{
            /* Layout Properties */
            width: 410px;
            height: 402px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #00000024;
            border-radius: 14px;
            opacity: 1;
            margin-top: 30px;
            margin-bottom: 100px;
        }
        .titulo-display-analisis{
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal medium 13px/16px var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-606060);
            text-align: center;
            font: normal normal medium 13px/16px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }
        .boton-display{
            /* Layout Properties */
            top: 595px;
            left: 541px;
            width: 100px;
            height: 35px;
            /* UI Properties */
            background: #0489FE 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #00000029;
            opacity: 1;
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) var(--unnamed-font-size-14)/17px var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-ffffff);
            text-align: center;
            font: normal normal normal 17px Roboto;
            letter-spacing: 0px;
            color: #FFFFFF;
            border-radius: 4px;
            margin: 15px 155px 0px 155px;
            padding-top: 6px;
        }
        .letra-boton-display{
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) var(--unnamed-font-size-14)/17px var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-ffffff);
            text-align: center;
            font: normal normal normal 17px Roboto;
            letter-spacing: 0px;
            color: #FFFFFF;
        }
        .card-t.card
        {
            background-color: #3B7EB2;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
        }
    </style>
     {{ Breadcrumbs::render('admin.analisisdebrechas-2022.index') }}


    @include('partials.flashMessages')

    <h5 class="titulo">Análisis de Brechas </h5>

    <div class="card card-t">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('assets/Rectángulo 2344@2x.png') }}"
                    style="margin: 9px 10px 10px 10px; width: 170px; height: 200px;">
            </div>
            <div class="col-md-10 ">
                <div class="pt-2">
                    <p class="titulo-card">Crea tu template</p>
                    <p class="texto-card mb-2">Es una herramienta visual que ayuda a las organizaciones a visualizar las
                        brechas entre el estado actual y el estado deseado. Este dashboard suele incluir indicadores clave de rendimiento
                        (KPI) que miden el desempeño de la organización en las áreas que se están analizando.El dashboard puede ser una
                        herramienta valiosa para la gestión de las brechas. Al proporcionar una visión general de las brechas, el dashboard
                        puede ayudar a las organizaciones a priorizar las áreas de mejora y a tomar medidas para cerrar las brechas.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5" style="margin: 0px 0px 0px 100px">
            <div class="display-analisis">
                <img src="{{ asset('assets/Imagen 18@2x.png') }}" alt="png"style="width: 311px; height: 233px;
                margin: 32px 50px 0px 50px;">
                <div class="titulo-display-analisis">Templates</div>
                <div class="boton-display">
                    <a href="{{ route('admin.templates') }}"
                    style="text-align: center;font: normal normal normal 17px Roboto;color: #FFFFFF;">
                    Generar
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="display-analisis" style="">
                <img src="{{ asset('assets/Imagen 22@2x.png') }}" alt="png"style="width: 311px; height: 233px;
                margin: 32px 50px 0px 50px;">
                <div class="titulo-display-analisis">Análisis de brechas</div>
                <div class="boton-display">
                    <a href="{{ route('admin.formulario') }}"
                    style="text-align: center;font: normal normal normal 17px Roboto;color: #FFFFFF;">
                    Generar
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- <h5 class="col-12 titulo_general_funcion">Análisis de Brechas 2022 </h5>

    <div class="mt-5 card">
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable datatable-AnalisisBrechas">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Fecha
                        </th>
                        <th>
                            %&nbsp;Implementacion
                        </th>
                        <th>
                            Elaboró
                        </th>
                        <th>
                            Estatus
                        </th>
                        <th>
                            Análisis
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
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Analisis de Brechas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Analisis de Brechas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                // {
                //     extend: 'pdfHtml5',
                //     title: `Analisis de Brechas ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar PDF',
                //     orientation: 'landscape',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     },
                //     customize: function(doc) {
                //         doc.pageMargins = [20, 60, 20, 30];
                //         doc.styles.tableHeader.fontSize = 7.5;
                //         doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                //     }
                // },
                {
                    extend: 'print',
                    title: `Analisis de Brechas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                        <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                            <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">ANÁLISIS DE BRECHAS</strong>
                                </div>
                                <div class="col-3 p-2">
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
            @can('analisis_de_brechas_eliminar')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.analisisdebrechas-2022.massDestroy') }}",
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
            @endcan
            //dtButtons.push(deleteButton)

            @can('analisis_de_brechas_agregar')
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nuevo analisis de brecha',
                url: "{{ route('admin.analisisdebrechas-2022.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
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
                ajax: "{{ route('admin.analisisdebrechas-2022.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'porcentaje_implementacion',
                        name: 'porcentaje_implementacion'
                    },
                    {
                        data: 'elaboro',
                        name: 'elaboro'
                    },
                    {
                        data: 'estatus',
                        name: 'estatus'
                    },
                    {
                        data: 'enlace',
                        name: 'enlace',
                        render: function(data, type, row, meta) {
                            return `  @can('analisis_de_brechas_vinculo')
                                <div class="text-center w-100"></div>
                                <a href="analisis-brechas-2022/?id=${data}" target="_blank"><i class="fas fa-file-alt fa-2x text-info"></i></a>
                                </div
                                @endcan`;
                        }
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [4, 'desc']
                ]
            };
            let table = $('.datatable-AnalisisBrechas').DataTable(dtOverrideGlobals);
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
    </script> --}}
@endsection
