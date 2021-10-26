@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Objetivos') }}
    </div>
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Asignar Objetivos Estratégicos</strong></h3>
        </div>
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <div class="px-1 py-2 mb-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Instrucciones</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                            asigne los objetivos estratégicos a cada uno de los colaboradores de la organización.
                            <br>
                            <small class="text-muted">Importante: Consulte los objetivos estratégicos con el jefe
                                inmediato de cada
                                colaborador</small>
                        </p>
                    </div>
                </div>
            </div>
            <table class="table table-bordered w-100 tblObjetivos">
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
                    <div class="col-4">
                        <label for=""><i class="fas fa-filter"></i> Filtrar por puesto</label>
                        <select class="form-control" id="lista_puestos">
                            <option value="" disabled selected>-- Selecciona un puesto --</option>
                            @foreach ($puestos as $puesto)
                                <option value="{{ $puesto->puesto }}">{{ $puesto->puesto }}</option>
                            @endforeach
                            <option value="">Todos</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for=""><i class="fas fa-filter"></i> Filtrar por perfil</label>
                        <select class="form-control" id="lista_perfiles">
                            <option value="" disabled selected>-- Selecciona un perfil --</option>
                            @foreach ($perfiles as $perfil)
                                <option value="{{ $perfil->nombre }}">{{ $perfil->nombre }}</option>
                            @endforeach
                            <option value="">Todos</option>
                        </select>
                    </div>
                </div>
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            N° Empleado
                        </th>
                        <th style="vertical-align: top">
                            Nombre
                        </th>
                        <th style="vertical-align: top">
                            Puesto
                        </th>
                        <th style="vertical-align: top">
                            Área
                        </th>
                        <th style="vertical-align: top">
                            Perfil
                        </th>
                        <th style="vertical-align: top">
                            Objetivos
                            Asignados
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>

                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalCopiarObjetivos" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalCopiarObjetivosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #00abb2;color: white;">
                    <h5 class="modal-title" id="modalCopiarObjetivosLabel"><i class="mr-2 fas fa-copy"></i>Copiar
                        Objetivos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="contenidoModal"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_cancelar" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnGuardarCopia" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Objetivos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Objetivos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Objetivos ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Objetivos ${new Date().toLocaleDateString().trim()}`,
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
                ajax: "{{ route('admin.ev360-objetivos.index') }}",
                columns: [{
                        data: 'n_empleado'
                    }, {
                        data: 'name',
                        width: '25%',
                        render: function(data, type, row, meta) {
                            console.log(row);
                            let html = `<img src="{{ asset('storage/empleados/imagenes') }}/${row.avatar}" style="clip-path:circle(20px at 50% 50%);height:40px;">
                            <span>${data}</span>`;
                            return html;
                        }
                    }, {
                        data: 'puesto',
                        width: '18%'
                    }, {
                        data: 'area.area',
                    }, {
                        data: 'perfil.nombre',
                        width: '10%'
                    },
                    {
                        data: 'objetivos',
                        render: function(data, type, row, meta) {
                            if (data.length > 0) {
                                if (data.length == 1) {
                                    return `<span class="badge badge-success">${data.length} objetivo asignado</span>`;
                                } else {
                                    return `<span class="badge badge-success">${data.length} objetivos asignados</span>`;
                                }
                            } else {
                                return `<span class="badge badge-dark">Sin asignar objetivos</span>`;
                            }
                        },
                        width: '10%'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlAsignar =
                                `/admin/recursos-humanos/evaluacion-360/${data}/objetivos`;
                            let urlShow =
                                `/admin/recursos-humanos/evaluacion-360/${data}/objetivos/lista`;
                            let urlCopiarObjetivos =
                                `/admin/recursos-humanos/evaluacion-360/objetivos/copiar`;
                            let urlVistaCopiarObjetivos =
                                `/admin/recursos-humanos/evaluacion-360/objetivos/${data}/copiar`;
                            let html = `
                            <div class="d-flex">
                                <a href="${urlAsignar}" title="Editar" class="btn btn-sm btn-primary">
                                <i class="fas fa-user-tag"></i> Agregar    
                                </a>
                                <button onclick="CopiarObjetivos('${urlVistaCopiarObjetivos}','${row.name}','${row.data}')" title="Copiar Objetivos" class="ml-2 text-white btn btn-sm" style="background:#11bb55">
                                <i class="fas fa-copy"></i>Copiar</button>
                                <a href="${urlShow}" title="Visualizar" class="ml-2 text-white btn btn-sm" style="background:#1da79f">
                                <i class="fas fa-eye"></i> Ver    
                                </a>
                            </div>
                            `;
                            return html;
                        },
                        width: '12%'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                dom: "<'row align-items-center justify-content-center container m-0 p-0'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0 p-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
            };
            let table = $('.tblObjetivos').DataTable(dtOverrideGlobals);
            $('#lista_areas').on('change', function() {
                console.log(this.value != "");
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    table.columns(3).search("(^" + this.value + "$)", true, false).draw();
                } else {
                    this.style.border = "none";
                    table.columns(3).search(this.value).draw();
                }
            });
            $('#lista_puestos').on('change', function() {
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    table.columns(2).search(this.value).draw();
                } else {
                    this.style.border = "none";
                    table.columns(2).search("(^" + this.value + "$)", true, false).draw();
                }
            });
            $('#lista_perfiles').on('change', function() {
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    table.columns(4).search(this.value).draw();
                } else {
                    this.style.border = "none";
                    table.columns(4).search("(^" + this.value + "$)", true, false).draw();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.CopiarObjetivos = (url, nombre_empleado, empleado_id) => {
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "JSON",
                    success: function(response) {
                        let {
                            empleados
                        } = response;
                        let modalContent = document.getElementById('contenidoModal');
                        let contenidoHTMLGenerado = `
                        <div class="px-1 py-2 mb-3 rounded" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                            <div class="row w-100">
                                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                    <div class="w-100">
                                        <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                    </p>
                                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">De la lista de abajo selecciona al empleado al que se copiarán los objetivos del siguiente empleado: <strong id="nombre_empleado" data-destinatario="${empleado_id}">${nombre_empleado}</strong></p>
                                </div>
                            </div>
                        </div>
                        <form class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label><i class="mr-2 fas fa-user"></i>Selecciona al empleado</label>
                                    <select class="form-control empleados-select">
                                        ${empleados.map(empleado => {
                                            return `<option data-avatar="${empleado.avatar}" value="${empleado.id}">${empleado.name}</option>`;
                                        }).join(',')}
                                    </select>
                                </div>
                            </div>    
                        </form>
                        `;
                        modalContent.innerHTML = contenidoHTMLGenerado;
                        console.log(response);
                        $('#modalCopiarObjetivos').modal('show');

                        $('.empleados-select').select2({
                            theme: 'bootstrap4',
                            templateResult: stateSelection,
                            templateSelection: stateSelection
                        });

                        function stateSelection(opt) {
                            if (!opt.id) {
                                return opt.text;
                            }

                            var optimage = $(opt.element).attr('data-avatar');
                            var $opt = $(
                                '<span><img src="{{ asset('storage/empleados/imagenes/') }}/' +
                                optimage +
                                '" class="img-fluid rounded-circle" width="30" height="30"/>' +
                                opt.text + '</span>'
                            );
                            return $opt;
                        };
                    }
                });
            };

            document.getElementById('btnGuardarCopia').addEventListener('click', function(e) {
                e.preventDefault();

            });
        })
    </script>
@endsection
