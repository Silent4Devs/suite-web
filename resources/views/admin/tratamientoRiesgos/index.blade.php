@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.tratamiento-riesgos.index') }}


    <h5 class="col-12 titulo_general_funcion">Tratamiento de los Riesgos</h5>

        <div class="mt-5 card">

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-TratamientoRiesgo">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width: 100px;">
                            Identificador
                        </th>
                        <th style="min-width: 600px;">
                            Descripción del riesgo
                        </th>
                        <th style="min-width: 100px;">
                            Tipo de riesgo
                        </th>
                        <th style="min-width: 80px;">
                            Riesgo total
                        </th>
                        <th style="min-width: 100px;">
                            Riesgo Residual
                        </th>
                        <th style="min-width: 800px;">
                            Acciones de tratamiento
                        </th>
                        <th style="min-width: 150px;">
                            Proceso
                        </th>
                        <th style="min-width: 80px;">
                           Dueño
                        </th>
                        <th style="min-width: 130px;">
                            Fecha compromiso
                        </th>
                        <th style="min-width: 120px;">
                            Inversión requerida
                        </th>
                        <th style="min-width: 20px;">
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
                    title: `Tratamiento de los Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Tratamiento de los Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Tratamiento de los Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Tratamiento de los Riesgos ${new Date().toLocaleDateString().trim()}`,
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

          
           

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.tratamiento-riesgos.index') }}",
                columns: [{
                        data: 'identificador',
                    },
                    {
                        data: 'descripcionriesgo',
                    },
                    {
                        data: 'tipo_riesgo',
                        name: 'tipo_riesgo',
                        render: function(data, type, row, meta) {
                            const riesgo = row.tipo_riesgo;
                            if (riesgo == 1) {
                                return `<div style="text-align:left">Positivo</div>`;
                            }
                            if (riesgo == 0) {
                                return `<div style="text-align:left">Negativo</div>`;
                            } else {
                                return `<div style="text-align:left">Negativo</div>`;
                            }
                        }
                    },
                    {
                        data: 'riesgototal',
                    },
                    {
                        data: 'riesgo_total_residual',
                    },
                    {
                        data: 'acciones',
                    },
                    {
                        data: 'proceso',
                    },
                    {
                        data: 'responsable',
                        render: function(data, type, row, meta) {
                            let responsableJson = JSON.parse(row.responsable ? row.responsable : '{}')
                            if (type === "empleadoText") {
                                return responsableJson.name;
                            }
                            let responsable = "";
                            if (responsableJson) {
                                responsable += `
                            <img src="{{ asset('storage/empleados/imagenes') }}/${responsableJson.avatar}" title="${responsableJson.name}" class="rounded-circle" style="clip-path: circle(15px at 50% 50%);height: 30px;" />
                            `;
                            }
                            return responsable;
                        }
                    },
                    {
                        data: 'fechacompromiso',
                    },
                    {
                        data: 'inversion_requerida',
                        render: function(data, type, row, meta) {
                            const inversion = row.inversion_requerida;
                            if (inversion == 1) {
                                return `<div style="text-align:left">Sí</div>`;
                            }
                            if (inversion == 0) {
                                return `<div style="text-align:left">No</div>`;
                            }
                            if(inversion == null){
                                return `<div style="text-align:left">Sin resultado</div>`;
                            }
                        }
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                createdRow: (row, data, dataIndex, cells) => {
                        let color = "green";
                        let texto = "white";
                        if (data.riesgototal <= 185) {
                            color = "#FF417B";
                            texto = "white";
                        }
                        if (data.riesgototal <= 135) {
                            color = "#FFAC6A";
                            texto = "white";
                        }
                        if (data.riesgototal <= 90) {
                            color = "#FFCB63";
                            texto = "white";
                        }
                        if (data.riesgototal <= 45) {
                            color = "#6DC866";
                            texto = "white";
                        }
                        if (data.riesgototal == null) {
                            color = "white";
                            texto = "white";
                        }
                        
                        let fondo = "green";
                        let letras = "white";
                        if (data.riesgo_total_residual <= 185) {
                            fondo = "#FF417B";
                            letras = "white";
                        }
                        if (data.riesgo_total_residual >= 135) {
                            fondo = "#FFAC6A";
                            letras = "white";
                        }
                        if (data.riesgo_total_residual <= 90) {
                            fondo = "#FFCB63";
                            letras = "white";
                        }
                        if (data.riesgo_total_residual  <= 45) {
                            fondo = "#6DC866";
                            letras = "white";
                        }
                        if (data.riesgo_total_residual == null) {
                            fondo = "#fff";
                            letras = "white";
                        }
                        if(data.riesgototal !=null){
                            $(cells[3]).css('background-color', color)
                            $(cells[3]).css('color', texto)

                        }
                        if(data.riesgo_total_residual !=null){
                            $(cells[4]).css('background-color', fondo)
                            $(cells[4]).css('color', letras)
                        }

                    },

                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                
            };
            let table = $('.datatable-TratamientoRiesgo').DataTable(dtOverrideGlobals);
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
