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
            border: 1px solid #345183;
            color: #345183;
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

        .agregar {
            margin-right: 15px;
        }

    </style>

    {{ Breadcrumbs::render('admin.recursos.index') }}

            <div class="text-right">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.recursos.create') }}" type="button" class="btn btn-primary">Registrar Capacitaciones</a>
                </div>
            </div>
            @include('partials.flashMessages')
            <div class="datatable-fix datatable-rds">
                <div class="d-flex justify-content-end">
                    <a class="boton-transparente boton-sin-borde" href="{{ route('descarga-categoriacapacitacion') }}">
                        <img src="{{ asset('download_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon">
                    </a> &nbsp;&nbsp;&nbsp;
                    <a class="boton-transparente boton-sin-borde" id="btnImport">
                        <img src="{{ asset('upload_file_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon">
                    </a>
                    @include('csvImport.modalcapacitaciones', [
                        'model' => 'Vulnerabilidad',
                        'route' => 'admin.vulnerabilidads.parseCsvImport',
                    ])
                </div>
                <h3 class="title-table-rds"> Capacitaciones</h3>
                <table class="datatable datatable-Recurso" id="datatable-Recurso">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>
                                {{ trans('cruds.recurso.fields.id') }}
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </th>
                            <th>
                                {{ trans('cruds.recurso.fields.participantes') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </th>
                            <th>
                                {{ trans('cruds.recurso.fields.instructor') }}
                            </th>
                            <th>
                                Tipo
                            </th>
                            <th>
                                Modalidad
                            </th>
                            <th>
                                Estatus
                            </th>
                            <th>
                                Opciones
                            </th>
                        </tr>
                    </thead>
                </table>
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

    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'print',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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
                                    <strong style="color:#345183">CAPACITACIONES</strong>
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
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
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
                ajax: "{{ route('admin.recursos.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'cursoscapacitaciones',
                        name: 'cursoscapacitaciones'
                    },
                    {
                        data: 'fecha_curso',
                        name: 'fecha_curso',
                        render: function(data, type, row, meta) {
                            return `
                                <div>
                                    <p class="m-0" style="text-align: left;">${row.fecha_inicio_format_diagonal} <strong>al</strong> ${row.fecha_fin_format_diagonal}</p>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let participantes = row.empleados;
                            let maxLength = 4;
                            let html = "";
                            let htmlRest = "";
                            if (type === "empleadoText") {
                                let participantesTexto = "";
                                participantes.forEach(participante => {
                                    participantesTexto += `
                            ${participante.name},
                            `;
                                });
                                return participantesTexto.trim();
                            }
                            if (participantes.length <= maxLength) {
                                participantes.forEach(element => {
                                    html +=
                                        `<img style="width:30px;clip-path:circle(50% at 50% 50%)" src="{{ asset('storage/empleados/imagenes/') }}/${element?.avatar}" title="${element?.name}"></img>`;
                                });
                            } else {
                                for (let index = 0; index < maxLength; index++) {
                                    const element = participantes[index];
                                    html +=
                                        `<img style="width:30px;clip-path:circle(50% at 50% 50%)" src="{{ asset('storage/empleados/imagenes/') }}/${element?.avatar}" title="${element?.name}"></img>`;
                                }
                                let empleadosRestantes = participantes.slice(maxLength, participantes
                                    .length);

                                empleadosRestantes.forEach(element => {
                                    htmlRest +=
                                        `<li class="list-group-item p-1" style="color:#fff;background-color: #000;font-size:10px; text-align:left;"><img style="width:19px;clip-path:circle(50% at 50% 50%)" src="{{ asset('storage/empleados/imagenes/') }}/${element?.avatar}"> ${element.name}</li>`;
                                });
                                html += `
                                    <span id="restantes-${data}" style="cursor: pointer;background: #289aaa;color: white;border-radius: 100%;padding: 4px;font-size: 12px;">+ ${participantes.length-maxLength}</span>
                                `
                                let template = `<div><ul class="list-group">${htmlRest}</ul></div>`;
                                tippy(`#restantes-${data}`, {
                                    content: template,
                                    allowHTML: true,
                                    theme: 'light',
                                    trigger: 'click',
                                });
                            }
                            return html
                        }
                    },
                    {
                        data: 'instructor',
                        name: 'instructor'
                    },
                    {
                        data: 'tipo',
                        name: 'tipo'
                    },
                    {
                        data: 'modalidad',
                        name: 'modalidad',
                        render: function(data, type, row, meta) {
                            return `
                            <div>
                                <p class="m-0" style="text-transform:capitalize;">${data}</p>
                                <p class="m-0 text-muted">${row.ubicacion}</p>
                            </div>
                            `;
                        }
                    },
                    {
                        data: 'estatus',
                        name: 'estatus'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {

                            const urlSeguimiento = `recursos/${data}`;
                            const urlEditar = `recursos/${data}/edit`
                            const urlEliminar = `recursos/${data}`
                            let html =
                                `
                                <div class="btn-group">
                                    @can('capacitaciones_ver')
                                        <a href="${urlSeguimiento }" class="btn btn-sm" title="Seguimiento de la capacitación"><i
                                                class="fas fa-cogs mr-2"></i></a>
                                    @endcan
                                `;
                            if (row.estatus == 'Borrador' || row.estatus == 'Cancelado') {
                                html += `
                                @can('capacitaciones_editar')
                                    <a href="${urlEditar}" class="btn btn-sm" title="Editar la capacitación"><i class="fas fa-edit mr-2"></i></a>
                                @endcan
                                        `;
                            }
                            html += `
                            @can('capacitaciones_eliminar')
                                <button data-url="${urlEliminar}" class="btn btn-sm btn-eliminar" title="Eliminar la capacitación"><i
                                        class="fas fa-trash mr-2 text-danger"></i>
                                </button>
                            @endcan
                            </div>
                            `;
                            return html;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-Recurso').DataTable(dtOverrideGlobals);
            document.querySelector('#DataTables_Table_0').addEventListener('click', function(e) {
                let target = e.target;
                if (e.target.tagName == 'I') {
                    target = e.target.closest('button')
                }

                if (target.classList.contains('btn-eliminar')) {
                    const url = e.target.getAttribute('data-url');
                    Swal.fire({
                        title: '¿Quieres eliminar esta capacitación?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Sí, eliminar!',
                        cancelButtonText: 'No',
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            try {
                                const response = await fetch(url, {
                                    method: 'DELETE',
                                    body: {},
                                    headers: {
                                        Accept: "application/json",
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr(
                                                'content'),
                                    },
                                })
                                const data = await response.json();
                                if (data.estatus == 200) {
                                    toastr.success(data.mensaje);
                                    table.ajax.reload();
                                }
                                if (data.estatus == 500) {
                                    toastr.error(data.mensaje);
                                }
                            } catch (error) {
                                toastr.error(error);
                            }
                        }
                    })
                }
            })
        });
    </script>
@endsection
