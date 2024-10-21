@extends('layouts.admin')
@section('content')
    <style>
        .btn-outline-success {
            background: #788bac !important;
            color: white;
            border: none;
        }

        .btn-outline-success:focus {
            border-color: #345183 !important;
            box-shadow: none;
        }

        .btn-outline-success:active {
            box-shadow: none !important;
        }

        .btn-outline-success:hover {
            background: #788bac;
            color: white;

        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid var(--color-tbj);
            color: var(--color-tbj);
            text-align: center;
            padding: 0;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

        .table tr th:nth-child(2) {


            min-width: 80px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(3) {


            min-width: 80px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(3) {

            text-align: center !important;
        }

        .table tr th:nth-child(4) {

            min-width: 130px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(4) {

            text-align: center !important;
        }

        .table tr th:nth-child(5) {


            min-width: 900px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(5) {

            text-align: justify !important;
        }


        .agregar {
            margin-right: 15px;
        }

        .module {
            width: 250px;
            margin: 0 0 1em 0;
            overflow: hidden;
        }

        .module p {
            margin: 0;
        }

        .line-clamp {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }
    </style>


    {{ Breadcrumbs::render('admin.comiteseguridads.visualizacion') }}

    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::getFirst();
        if (!is_null($organizacion->empresa)) {
            $nombre_organizacion = $organizacion->empresa;
        } else {
            $nombre_organizacion = 'La Organizacion';
        }
    @endphp
    <h5 class="col-12 titulo_general_funcion">Comités de <strong>{{ $nombre_organizacion }}</strong></h5>
    <div class="mt-5 card">
        <div style="margin-bottom: 10px; margin-left:10px;" class="row">
            <div class="col-lg-12">
                @include('csvImport.modalcomitedeseguridad', [
                    'model' => 'Vulnerabilidad',
                    'route' => 'admin.vulnerabilidads.parseCsvImport',
                ])
            </div>
        </div>


        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered datatable-Comiteseguridad" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width: 100px;">
                            Nombre del comité
                        </th>
                        <th style="min-width: 200px;">
                            Miembros
                        </th>
                        <th style="min-width: 200px;">
                            Descripción
                        </th>
                        <th style="min-width: 15px;">
                            Ver
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
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

                    }
                },
                {
                    extend: 'print',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
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
                                    <strong style="color:#345183">CONFORMACIÓN DEL COMITÉ</strong>
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
            @can('comformacion_comite_seguridad_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.comiteseguridads.massDestroy') }}",
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
                ajax: "{{ route('admin.comiteseguridads.visualizacion') }}",
                columns: [{
                        data: 'nombre_comite',
                        name: 'nombre_comite',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'miembros',
                        name: 'miembros',
                        render: function(data, type, row, meta) {
                            let miembros = data;
                            if (type === "miembroText") {
                                let miembrosTexto = "";
                                miembros.forEach(miembro => {
                                    miembrosTexto += `
                            ${miembro.name},
                            `;
                                });
                                return miembrosTexto.trim();
                            }
                            let html = '';
                            miembros.forEach(miembro => {
                                html += `
                            <img src="{{ asset('storage/empleados/imagenes/') }}/${miembro.avatar}"
                                        class="rounded-circle" alt="${miembro.name}"
                                        title="${miembro.name}" style="clip-path: circle(15px at 50% 50%);height: 30px;">
                            `
                            });
                            return html;
                        }

                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        render: function(data, type, row) {
                            return `<div style="text-align:left"><p>${data}</p></div>`;
                        }
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
            let table = $('.datatable-Comiteseguridad').DataTable(dtOverrideGlobals);

        });
    </script>
@endsection
