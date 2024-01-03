@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Competencias-Por-Puesto') }}
    </div>
    <style>
        .imagen-responsiva {
            clip-path: circle(10px at 50% 50%);
            height: 20px;
        }
        .boton-sin-borde {
        border: none;
        outline: none; /* Esto elimina el contorno al hacer clic */
        }
        .boton-transparente {
        background-color: transparent;
        border: none; /* Elimina el borde del botón si lo deseas */
        }


    </style>
    <h5 class="col-12 titulo_general_funcion">Asignar competencias por puesto</h5>
    <div class="mt-5 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Asignar competencias por puesto</strong></h3>
        </div> --}}
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <div class="px-1 py-2 mb-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Instrucciones</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                            asigne las competencias definidas a cada uno de los puestos de la organización</p>
                    </div>
                </div>
            </div>

            <div class="mb-2 row">
                <div class="col-4">
                    <label for=""><i class="fas fa-filter"></i> Filtrar por área</label>
                    <select class="form-control" id="lista_areas">
                        <option value="" disabled selected>-- Selecciona un área --</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->area }}">{{ $area->area }}</option>
                        @endforeach
                        <option value="">Todas</option>
                    </select>
                </div>
            </div>

            @include('partials.flashMessages')
            <div class="datatable-fix datatable-rds">
                <div class="d-flex justify-content-end">
                    <a class="boton-transparente boton-sin-borde" href="{{ route('descarga-puesto') }}">
                        <img src="{{ asset('download_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon">
                    </a> &nbsp;&nbsp;&nbsp;
                    <a class="boton-transparente boton-sin-borde" id="btnImport">
                        <img src="{{ asset('upload_file_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon">
                    </a>
                    @include('csvImport.modalperfilpuesto', [
                        'model' => 'Vulnerabilidad',
                        'route' => 'admin.vulnerabilidads.parseCsvImport',
                    ])
                </div>
                <h3 class="title-table-rds"> Puestos</h3>
                <table class="datatable tblCompetenciasPorPuesto" id="tblCompetenciasPorPuesto">
                    <thead class="thead-dark">
                        <tr>
                            <th style="vertical-align: top">
                                Puesto
                            </th>
                            <th>
                                Área
                            </th>
                            <th style="vertical-align: top">
                                Competencias
                            </th>
                            <th style="vertical-align: top">
                                Competencias asignadas
                            </th>
                            <th style="vertical-align: top">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $('#btnImport').on('click', function(e) {
        e.preventDefault();
        $('#xlsxImportModal').modal('show');
     });
    </script>
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        // doc.styles.tableHeader.fontSize = 6.5;
                        // doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
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
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.ev360-competencias-por-puesto.index') }}",
                columns: [{
                    data: 'puesto',
                    width: '30%',
                }, {
                    data: 'area',
                    render: function(data, type, row, meta) {
                        if(row.area){
                            return row.area.area;
                        }
                        return 'Sin asignar';
                    }
                }, {
                    data: 'competencias',
                    render: function(data, type, row, meta) {
                        console.log(data);
                        let html = '<div>';
                        let titulo = "";
                        data.forEach(competencia => {
                            if (competencia.competencia?.existe_imagen_en_servidor) {
                                titulo = competencia.competencia?.nombre;
                            } else {
                                titulo = "No se encontró el recurso para esta competencia";
                            }
                            html += `
                                <img class="imagen-responsiva" src="${competencia.competencia?.imagen_ruta}" title="${titulo}"/>
                                `;
                        });
                        html += '</div>';
                        return html;
                    },
                    width: '30%',
                }, {
                    data: 'competencias',
                    render: function(data, type, row, meta) {
                        return data.length > 0 ?
                            `<span class="badge badge-success">${data.length} competencia(s) asignada(s)</span>` :
                            '<span class="badge badge-primary">Sin competencias asignadas</span>';
                    },
                    width: '25%'
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let urlBtnAsignarCompetencias =
                            `/admin/recursos-humanos/evaluacion-360/competencias-por-puesto/${data}/create`;
                        let botones =
                            `
                            @can('competencias_por_puesto_agregar')
                                <a class="btn btn-sm btn-editar btn-primary" title="Agregar competencias" href="${urlBtnAsignarCompetencias}"><i
                                        class="mr-2 fas fa-user-tag"></i> Agregar</a>
                            @endcan
                            `;
                        return botones;
                    },
                    width: '15%'
                }],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                dom: "<'row align-items-center justify-content-center container m-0 p-0'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0 p-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
            };
            let table = $('.tblCompetenciasPorPuesto').DataTable(dtOverrideGlobals);
            $('#lista_areas').on('change', function() {
                console.log(this.value);
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    table.columns(1).search("(^" + this.value + "$)", true, false).draw();
                } else {
                    this.style.border = "1px solid #ccc";
                    table.columns(1).search(this.value).draw();
                }
            });


        });
    </script>

    {{-- <script src="{{ asset('js/datatablefilter.js') }}"></script>
       <script>
        $('#myTable').ddTableFilter();
        </script> --}}
@endsection
