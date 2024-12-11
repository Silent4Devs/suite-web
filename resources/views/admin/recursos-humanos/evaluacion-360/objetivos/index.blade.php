@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Objetivos') }}
    </div>
    <h5 class="col-12 titulo_general_funcion">Asignar Objetivos Estratégicos</h5>
    <div class="mt-5 card">
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
                            asigne los objetivos estratégicos a cada uno de los colaboradores de la organización.
                            <br>
                            <small class="text-muted">Importante: Consulte los objetivos estratégicos con el jefe
                                inmediato de cada
                                colaborador</small>
                        </p>
                        {{-- <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Definir Nuevos Objetivos</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Para definir nuevos objetivos para
                            una siguiente evaluación presione el botón "Definir nuevos objetivos" y de clic en "Aceptar"
                            seguidamente
                            <br>
                            <small class="text-muted">Importante: Una vez que establezca nuevos objetivos tendrá que
                                realizar la carga de objetivos nuevamente</small>
                        </p>
                        <button class="btn btn-primary" id="btnNuevosObjetivos">Definir nuevos objetivos</button> --}}
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
                {{-- {{$puestos}} --}}
                <div class="col-4" id="puesto">
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

            @include('partials.flashMessages')
            <div class="datatable-fix datatable-rds">
                <h3 class="title-table-rds">Objetivos Estratégicos</h3>
                <table class="datatable tblObjetivos" id="tblObjetivos">
                    <thead class="thead-dark" id="max">
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
                    <tbody>
                        @foreach ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->n_empleado ?? 'Sin Asignar' }}</td>
                                <td>{{ $empleado->name }}</td>
                                <td>{{ $empleado->puestoRelacionado->puesto }}</td>
                                <td>{{ $empleado->area->area }}</td>
                                <td>{{ $empleado->perfil->nombre ?? 'Sin Definir' }}</td>
                                <td>{{ count($empleado->objetivos) . ' objetivos asignados' ?? 'Sin objetivos asignados' }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @can('objetivos_estrategicos_agregar')
                                            <a href="{{ url('/admin/recursos-humanos/evaluacion-360/' . $empleado->id . '/objetivos') }}"
                                                title="Editar" class="btn btn-sm tb-btn-primary">
                                                <i class="fas fa-user-tag"></i> Agregar
                                            </a>
                                        @endcan
                                        @can('objetivos_estrategicos_copiar')
                                            <button
                                                onclick="CopiarObjetivos('/admin/recursos-humanos/evaluacion-360/objetivos/{{ $empleado->id }}/copiar', '{{ $empleado->name }}', '{{ $empleado->id }}')"
                                                title="Copiar Objetivos" class="ml-2 text-white btn btn-sm"
                                                style="background:#11bb55">
                                                <i class="fas fa-copy"></i>Copiar
                                            </button>
                                        @endcan
                                        @can('objetivos_estrategicos_ver')
                                            <a href="{{ url('/admin/recursos-humanos/evaluacion-360/' . $empleado->id . '/objetivos/lista') }}"
                                                title="Visualizar" class="ml-2 text-white btn btn-sm"
                                                style="background:#1da79f">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalCopiarObjetivos" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalCopiarObjetivosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--color-tbj)color: white;">
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
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnGuardarCopia" class="btn btn-primary">Guardar</button>
                </div>
                @include('layouts.loader')
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
                pageLength: 5,
                buttons: dtButtons,
                processing: true,
                retrieve: true,
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
                    beforeSend: function() {
                        toastr.info('Obteniendo información, espere un momento...');
                    },
                    success: function(response) {
                        let {
                            hasObjetivos
                        } = response;
                        if (hasObjetivos) {
                            let {
                                empleados,
                                objetivos,
                            } = response;
                            let modalContent = document.getElementById('contenidoModal');
                            let contenidoHTMLGenerado = `
                        <div class="px-1 py-2 mb-3 rounded" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                            <div class="row w-100">
                                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                    <div class="w-100">
                                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                    </p>
                                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">De la lista de abajo selecciona al empleado al que se copiarán los objetivos del siguiente empleado: <strong id="nombre_empleado" data-destinatario="${empleado_id}">${nombre_empleado}</strong></p>
                                    <div>
                                        <ul class="list-group" style="max-height: 100px;overflow: auto;">
                                            ${objetivos.map(objetivo => {
                                                return `<li class="list-group-item"><img src="${objetivo.objetivo.imagen_ruta}" class="mr-2" style="clip-path: circle(10px at 50% 50%);height: 20px;">${objetivo.objetivo.nombre}</li>`;
                                            }).join("")}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="formCopiaObjetivos" class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" value="${empleado_id}" name="empleado_destinatario">
                                    <label><i class="mr-2 fas fa-user"></i>Selecciona al empleado</label>
                                    <select class="empleados-select" name="empleado_destino">
                                        <option value="">-- Selecciona un empleado --</option>
                                        ${empleados.map(empleado => {
                                            return `<option data-avatar="${empleado.foto}" value="${empleado.id}">${empleado.name}</option>`;
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
                                templateSelection: stateSelection,

                            });

                            function stateSelection(opt) {
                                if (!opt.id) {
                                    return opt.text;
                                }

                                var optimage = $(opt.element).attr('data-avatar');
                                var $opt = $(
                                    '<span><img src="' +
                                    optimage +
                                    '" class="img-fluid rounded-circle" width="30" height="30"/>' +
                                    opt.text + '</span>'
                                );
                                return $opt;
                            };
                        } else {
                            toastr.info('Este usuario no tiene objetivos asignados');
                        }
                    },
                    error: function(request, status, error) {
                        toastr.error(error);
                    }
                });
            };

            document.getElementById('btnGuardarCopia').addEventListener('click', function(e) {
                e.preventDefault();
                let formData = new FormData(document.getElementById('formCopiaObjetivos'));
                mostrarValidando();
                $.ajax({
                    type: "POST",
                    url: "/admin/recursos-humanos/evaluacion-360/objetivos/copiar",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Objetivos transferidos');
                            $('#modalCopiarObjetivos').modal('hide');
                        }

                        ocultarValidando();
                    },
                    error: function(request, status, error) {
                        ocultarValidando();
                        toastr.error(error);
                    }
                });
            });
        })

        function mostrarValidando() {
            document.getElementById('displayAlmacenandoUniversal').style.display = 'grid';
        }

        function ocultarValidando() {
            document.getElementById('displayAlmacenandoUniversal').style.display = 'none';
        }


        let areas = document.querySelector("#puesto");
        areas.addEventListener('change', function(event) {
            if ($("#puesto option:selected").attr("id") != "ver_todos_option") {
                let area_id = event.target.value;
                orientacion = localStorage.getItem('orientationOrgChart');
                renderOrganigrama(OrgChart, orientacion, null, true, area_id);
            }
        });
    </script>
@endsection
