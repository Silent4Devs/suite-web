@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Competencias-Por-Puesto-Create') }}
    <style>
        .select2-container {
            margin: 0 !important;
        }

    </style>
    <h5 class="col-12 titulo_general_funcion">Competencias para: {{ $puesto->puesto }}</h5>
    <div class="mt-4 card">
        <div class="card-body">
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    Asignar Competencias
                </div>
                <form id="formCompetenciaCreate" method="POST"
                    action="{{ route('admin.ev360-competencias-por-puesto.store', $puesto) }}" class="mt-3 row">
                    @csrf
                    @include('admin.recursos-humanos.evaluacion-360.competencias-por-puesto.competencias.form')
                </form>
            {{-- <div class="d-flex justify-content-end">
                <button id="asignarBtn" class="mb-2 btn btn-sm btn-outline-success"><i
                        class="mr-2 fas fa-sync"></i>Asignar</button>
            </div> --}}
            <span id="asignando_competencia" class="d-none"><i class=" fas fa-circle-notch fa-spin"></i>
                Asignando competencia</span>
            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                Competencias Asignadas
            </div>
            <div class="datatable-fix">
                <table class="table table-bordered w-100 tblCompetenciasPorPuesto">
                    <thead class="thead-dark">
                        <tr>
                            <th style="vertical-align: top">
                                Competencia
                            </th>
                            <th style="vertical-align: top">
                                Nivel Esperado
                            </th>
                            <th style="vertical-align: top">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end w-100">
                <a href="{{ route('admin.ev360-competencias-por-puesto.index') }}" class="btn_cancelar">Regresar</a>
                {{-- <button type="submit" class="btn btn-danger">Guardar</button> --}}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEditarCompetencia" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarCompetenciaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarCompetenciaLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_cancelar" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="cambiarNivelEsperado">Cambiar Nivel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#competencia_id').select2({
                theme: 'bootstrap4'
            });

            window.tblCompetenciasPorPuesto = $('.tblCompetenciasPorPuesto').DataTable({
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.ev360-competencias-por-puesto.indexCompetenciasPorPuesto', $puesto) }}",

                columns: [{
                    data: 'competencia.nombre',
                    width: '70%'
                }, {
                    data: 'nivel_esperado',
                    width: '15%'
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let urlEditar =
                            `/admin/recursos-humanos/evaluacion-360/competencias-por-puesto/${data}/edit`;
                        let urlActualizar =
                            `/admin/recursos-humanos/evaluacion-360/competencias-por-puesto/${data}`;
                        let urlEliminar =
                            `/admin/recursos-humanos/evaluacion-360/competencias-por-puesto/${data}`;
                        let botones = `
                            <div class="btn-group">
                            @can('competencias_por_puesto_editar')
                                <button class="btn btn-sm btn-editar" title="Editar"
                                    onclick="event.preventDefault();Editar('${urlActualizar}','${urlEditar}','${row.competencia.id}','${row.competencia.nombre}','${row.nivel_esperado}')"><i
                                        class="fas fa-edit"></i></button>
                            @endcan
                            @can('competencias_por_puesto_eliminar')
                                <button class="text-danger btn btn-sm btn-eliminar" title="Eliminar"
                                    onclick="event.preventDefault();Eliminar('${urlEliminar}')"><i class="fas fa-trash-alt"></i></button>
                            @endcan
                            </div>
                        `;
                        return botones;
                    },
                    width: '15%'
                }],
                language: {
                    decimal: "",
                    emptyTable: "No hay registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 to 0 of 0 registros",
                    infoFiltered: "(Filtrado de _MAX_ total registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: '<i class="fas fa-chevron-right"></i>',
                        previous: '<i class="fas fa-chevron-left"></i>',
                    },
                },
            });

            window.Editar = function(urlActualizar, urlEditar, competencia_id, competencia_nombre, nivel_actual) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.ev360-competencias.obtenerNiveles') }}",
                    data: {
                        competencia_id: competencia_id
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        toastr.info('Recuperando información, espere un momento...');
                    },
                    success: function(response) {
                        console.log(response);
                        document.getElementById("modalEditarCompetenciaLabel").innerHTML =
                            competencia_nombre;

                        let modalBody = document.getElementById("modalBody");
                        let formHTML = `<form id="formCambioNivel${competencia_id}" action="${urlActualizar}" method='post'>
                            <label>Cambiar Nivel Esperado</label>
                            <select name="nivel_esperado"class="form-control">
                            <small class="errores error_nivel_esperado"></small>
                            `
                        response.forEach(nivel => {
                            formHTML += `
                                <option value="${nivel.ponderacion}" ${nivel_actual==nivel.ponderacion?'selected':''}>${nivel.ponderacion}</option>
                                `;
                        });
                        formHTML += `</select></form>`;
                        modalBody.innerHTML = formHTML;
                        $('#modalEditarCompetencia').modal('show');

                        $('#cambiarNivelEsperado').replaceWith($('#cambiarNivelEsperado')
                            .clone()); //Evitar creacion multiple de eventos click
                        document.getElementById('cambiarNivelEsperado').addEventListener('click',
                            function(e) {
                                e.preventDefault();
                                limpiarErroresValidacion();
                                let data = $(`#formCambioNivel${competencia_id}`).serialize();
                                let url = $(`#formCambioNivel${competencia_id}`).attr('action');
                                $.ajax({
                                    type: "PATCH",
                                    url: url,
                                    data: data,
                                    dataType: "JSON",
                                    beforeSend: function() {
                                        toastr.info(
                                            'Cambiando el nivel esperado, espere un momento...'
                                        )
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            toastr.success(
                                                'Nivel esperado cambiado con éxito'
                                            );
                                            tblCompetenciasPorPuesto.ajax.reload();
                                            $('#modalEditarCompetencia').modal(
                                                'hide');
                                        }
                                    },
                                    error: function(request, status, error) {
                                        if (request.status == 422) {
                                            $.each(request.responseJSON.errors,
                                                function(indexInArray,
                                                    valueOfElement) {
                                                    console.log(valueOfElement,
                                                        indexInArray);
                                                    $(`small.error_${indexInArray}`)
                                                        .text(
                                                            valueOfElement[
                                                                0]);

                                                });
                                        } else {
                                            toastr.error(`Error: ${error}`);
                                        }
                                    }
                                });
                            })
                    }
                });
            }
            window.Eliminar = function(urlEliminar) {
                Swal.fire({
                    title: '¿Quieres quitar esta competencia?',
                    text: "Tendrás que volver a agregarla",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, quitarla!',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            },
                            type: "DELETE",
                            url: urlEliminar,
                            beforeSend: function() {
                                toastr.info(
                                    'Quitando competencia, espere unos instantes...'
                                );
                            },
                            success: function(response) {
                                toastr.success('Competencia removida');
                                tblCompetenciasPorPuesto.ajax.reload();
                            },
                            error: function(request, status, error) {
                                toastr.error(
                                    'Ocurrió un error: ' + error);
                            }
                        });

                    }
                })
            }

            $('#competencia_id').on('select2:select', function(e) {
                let competencia_id = e.params.data.id;
                let competencia_descripcion = $(e.params.data.element).data('description');
                let competencia_nombre = e.params.data.text;
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.ev360-competencias.obtenerNiveles') }}",
                    data: {
                        competencia_id
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        document.getElementById('niveles_cargando').classList.remove(
                            'd-none');
                        document.getElementById('visualizarSignificado').classList.add(
                            'd-none');
                    },
                    success: function(response) {
                        document.getElementById('niveles_cargando').classList.add('d-none');
                        document.getElementById('visualizarSignificado').classList.remove(
                            'd-none');
                        let selectNiveles = document.querySelector('#nivel_esperado');
                        let opciones = '';
                        response.forEach(nivel => {
                            opciones += `
                            <option value="${nivel.ponderacion}">${nivel.ponderacion}</option>
                            `;
                        });
                        selectNiveles.innerHTML = opciones;

                        let html = "";
                        response.forEach(opcion => {
                            html += `
                            <div class="p-0 row" style="border-bottom: 1px solid #707070;">
                                <div class="text-center col-sm-1 col-lg-1 d-flex justify-content-center align-items-center" style="font-weight:bold;
                                font-size:12px;">
                                <p>${opcion.ponderacion}</p>
                                </div>
                                <div class="px-0 py-2 col-sm-11 col-lg-11" style="font-size: 11px;">
                                    ${opcion.definicion}
                                    </div>
                            </div>
                            `;
                        });
                        document.getElementById('titulo_competencia').innerHTML =
                            competencia_nombre;
                        document.getElementById('descripcion_competencia').innerHTML =
                            competencia_descripcion;
                        document.getElementById('competenciaInformacion').innerHTML = html;

                    }
                });
            });

            document.getElementById('asignarBtn').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErroresValidacion();
                let datos = $('#formCompetenciaCreate').serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.ev360-competencias-por-puesto.store', $puesto) }}",
                    data: datos,
                    dataType: "JSON",
                    beforeSend: function() {
                        document.getElementById('asignando_competencia').classList.remove(
                            'd-none');
                    },
                    success: function(response) {
                        document.getElementById('asignando_competencia').classList.add(
                            'd-none');
                        if (response.success) {
                            tblCompetenciasPorPuesto.ajax.reload();
                            // document.getElementById('formCompetenciaCreate').reset();
                            $("#competencia_id").val('').trigger('change');
                            document.querySelector('#nivel_esperado').innerHTML = "";
                            toastr.success('Competencia asignada correctamente');
                        }
                        if (response.error) {
                            toastr.info(response.mensaje);
                        }
                    },
                    error: function(request, status, error) {
                        document.getElementById('asignando_competencia').classList.add(
                            'd-none');
                        document.getElementById('formCompetenciaCreate').reset();
                        if (request.status == 422) {
                            $.each(request.responseJSON.errors, function(indexInArray,
                                valueOfElement) {
                                console.log(valueOfElement, indexInArray);
                                $(`small.error_${indexInArray}`).text(
                                    valueOfElement[
                                        0]);

                            });
                        } else {
                            toastr.error(`Error: ${error}`);
                        }
                    }
                });
            });

            if (document.getElementById('visualizarSignificado')) {
                document.getElementById('visualizarSignificado').addEventListener('click', function(e) {
                    e.preventDefault();
                    $('#competenciaModal').modal('show');
                })
            }
        })

        function limpiarErroresValidacion() {
            document.querySelectorAll('.errores').forEach(element => {
                element.innerHTML = '';
            })
        }
    </script>
@endsection
