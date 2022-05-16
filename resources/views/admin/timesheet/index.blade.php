@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">
    
    <style type="text/css">
        .btn_op{
            opacity: 1 !important;
        }
        .btn-primary{
            opacity: 0.6;
        }

        .btn_estatus_caja button{
            margin-left: 7px;
        }
    </style>


     {{ Breadcrumbs::render('timesheet-index') }}
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Mis Registros</font> </h5>

	<div class="card card-body">
		@livewire('timesheet.tabla-mis-registros')
	</div>
@endsection


@section('scripts')
    @parent
    <script>
        let cont = 0;
        function tablaLivewire(id_tabla)
        {
            $('#' + id_tabla).attr('id', id_tabla + cont);

            $(function() {
                let dtButtons = [{
                        extend: 'csvHtml5',
                        title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar CSV',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar Excel',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar PDF',
                        orientation: 'portrait',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        },
                        customize: function(doc) {
                            doc.pageMargins = [5, 20, 5, 20];
                            doc.styles.tableHeader.fontSize = 10;
                            doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10
                        }
                    },
                    {
                        extend: 'print',
                        title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
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
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar empleado',
                    url: "{{asset('admin/inicioUsuario/reportes/quejas')}}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                    action: function(e, dt, node, config) {
                    let {
                    url
                    } = config;
                    window.location.href = url;
                    }
                };
                let dtOverrideGlobals = {
                    buttons: dtButtons,
                    order:[
                                [0,'desc']
                            ],
                    destroy: true,
                    render: true,
                };

                let table = $('#' + id_tabla + cont).DataTable(dtOverrideGlobals);
            });
        }
        tablaLivewire('datatable_timesheet');
    </script>
@endsection