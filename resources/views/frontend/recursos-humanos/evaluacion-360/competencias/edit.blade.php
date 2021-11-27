@extends('layouts.frontend')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu-secciones.css') }}">
    {{ Breadcrumbs::render('EV360-Competencias-Edit') }}
    <style>
        .alerta-error {
            padding: 10px;
            background: #ffc5c594;
            border: 1px solid red;
            border-radius: 10px;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Competencia: ({{ $competencia->nombre }})
            </h3>
        </div>
        <div class="card-body">
            <form id="formGrupo" method="POST" action="{{ route('ev360-competencias.update', $competencia) }}"
                class="mt-3 row">
                @csrf
                @method('PATCH')
                @include('frontend.recursos-humanos.evaluacion-360.competencias._formEdit')
                <div class="d-flex justify-content-end w-100">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="conductasModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="conductasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="conductasModalLabel"><i class="fas fa-cog"></i> Conductas Esperadas
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formConductaCreate" action="{{ route('ev360-conductas.store') }}" method="post">
                        @include('frontend.recursos-humanos.evaluacion-360.conductas._form')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCancelarConducta" class="btn_cancelar"
                        data-dismiss="modal">Descartar</button>
                    <button type="button" id="btnGuardarConducta" class="btn btn-danger">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            let dtButtons = [];
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar conducta',
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    $('#formConductaCreate').removeAttr('action');
                    $('#formConductaCreate').removeAttr('method');
                    $('#formConductaCreate').attr('action', "{{ route('ev360-conductas.store') }}");
                    $('#formConductaCreate').attr('method', 'POST');
                    CKEDITOR.instances.definicion.setData('');
                    $('#conductasModal').modal('show');
                }
            };
            dtButtons.push(btnAgregar);

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: "{{ route('ev360-competencias.obtenerConductas', $competencia->id) }}",
                columns: [{
                    data: 'ponderacion'
                }, {
                    data: 'definicion_h',
                    render: function(data) {
                        let html = `<div>${data}</div>`;
                        return html;
                    },
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let urlBtnEditar =
                            `/recursos-humanos/evaluacion-360/conductas/${data}/edit`;
                        let urlBtnActualizar =
                            `/recursos-humanos/evaluacion-360/conductas/${data}`;
                        let urlBtnEliminar =
                            `/recursos-humanos/evaluacion-360/conductas/${data}`;
                        let botones = `
                            <div class="btn-group">
                                <button style="color: white;background: #4a57ff;box-shadow:1px 1px 3px 0px #00000082;" class="btn btn-sm btn-editar" title="Editar" onclick="event.preventDefault();Editar('${urlBtnEditar}','${urlBtnActualizar}')"><i class="fas fa-edit"></i></button>
                                <button style="color: white;background: #ff4a4a;box-shadow:1px 1px 3px 0px #00000082;" class="btn btn-sm btn-eliminar" title="Eliminar" onclick="event.preventDefault();Eliminar('${urlBtnEliminar}')"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        `;
                        return botones;
                    }
                }],
                order: [
                    [1, 'asc']
                ]
            };
            window.table = $('.tblNiveles').DataTable(dtOverrideGlobals);
        });
        window.Editar = function(urlEditar, urlActualizar) {
            $.ajax({
                type: "GET",
                url: urlEditar,
                beforeSend: function() {
                    toastr.info(
                        'Recuperando información de la conducta, espere unos instantes...');
                },
                success: function({
                    conducta
                }) {
                    CKEDITOR.instances.definicion.setData(conducta.definicion);
                    $('#conductasModal').modal('show');
                    $('#formConductaCreate').removeAttr('action');
                    $('#formConductaCreate').removeAttr('method');
                    $('#formConductaCreate').attr('action', urlActualizar);
                    $('#formConductaCreate').attr('method', 'PATCH');
                },
                error: function(request, status, error) {
                    if (error != 'Unprocessable Entity') {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    } else {
                        $.each(request.responseJSON.errors, function(indexInArray,
                            valueOfElement) {
                            document.querySelector(`span.${indexInArray}_error`)
                                .innerHTML =
                                `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                        });
                    }
                }
            });
        }
        window.Eliminar = function(urlEliminar) {
            Swal.fire({
                title: '¿Quieres eliminar esta conducta?',
                text: "No podrás recuperar esto",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminar!',
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
                                'Eliminando la conducta, espere unos instantes...');
                        },
                        success: function(response) {
                            toastr.success('Conducta eliminada');
                            table.ajax.reload();
                        },
                        error: function(request, status, error) {
                            toastr.error(
                                'Ocurrió un error: ' + error);
                        }
                    });

                }
            })
        }
        $(document).ready(function() {
            document.getElementById('btnGuardarConducta').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                let definicion = CKEDITOR.instances.definicion.getData();
                let competencia_id = @json($competencia->id);
                // let datos = $('#formConductaCreate').serialize();
                let datos = {
                    definicion,
                    competencia_id
                }
                let url = $("#formConductaCreate").attr('action');
                let method = $("#formConductaCreate").attr('method');

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: method,
                    url: url,
                    data: datos,
                    dataType: "JSON",
                    beforeSend: function() {
                        document.querySelector("#conductasModal .modal-dialog .modal-content")
                            .style.pointerEvents = "none";
                        toastr.info(
                            'Guardando y configurando Conducta, espere unos instantes...');
                    },
                    success: function(response) {
                        document.querySelector("#conductasModal .modal-dialog .modal-content")
                            .style.pointerEvents = "all";
                        toastr.success(
                            'Conducta configurada y almacenada con éxito');
                        $('#conductasModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(request, status, error) {
                        if (error != 'Unprocessable Entity') {
                            toastr.error(
                                'Ocurrió un error: ' + error);
                        } else {
                            $.each(request.responseJSON.errors, function(indexInArray,
                                valueOfElement) {
                                document.querySelector(`span.${indexInArray}_error`)
                                    .innerHTML =
                                    `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                            });
                        }
                    }
                });
            });
        });

        function limpiarErrores() {
            let errores = document.querySelectorAll('.errors');
            errores.forEach(element => {
                element.innerHTML = "";
            });
        }
    </script>
    <script type="text/javascript">
        Livewire.on('tipoCompetenciaStore', () => {
            $('#tipoCompetenciaModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Tipo de competencia creado con éxito');
        });
        window.initSelect2 = () => {
            $('.select2').select2({
                'theme': 'bootstrap4'
            });
        }

        initSelect2();

        Livewire.on('select2', () => {
            initSelect2();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            document.getElementById('toda_la_empresa').addEventListener('change', function(e) {
                e.preventDefault();
                if (e.currentTarget.checked) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('ev360-competencias.obtenerNiveles') }}",
                        data: {
                            competencia_id: @json($competencia->id),
                        },
                        dataType: "JSON",
                        beforeSend: function() {
                            document.getElementById('niveles_cargando').classList.remove(
                                'd-none');
                        },
                        success: function(response) {
                            document.getElementById('niveles_cargando').classList.add('d-none');
                            let contenedor = document.getElementById(
                                'nivel_esperado_contenedor');
                            if (response.length > 0) {
                                let select = `
                                <label for="nivel_esperado">Establece el nivel esperado general
                                <span class="text-danger">*</span>
                                </label>
                                <select name="nivel_esperado" id="nivel_esperado" class="form-control" required>
                            `;
                                response.forEach(nivel => {
                                    select += `
                            <option value="${nivel.ponderacion}">${nivel.ponderacion}</option>
                            `;
                                });
                                select += "</select>";
                                contenedor.innerHTML = select;
                            } else {
                                contenedor.innerHTML = `<span class="mt-2 alerta-error">
                                    <i class='mr-2 fas fa-exclamation-triangle'></i>
                                    Debes ingresar niveles a la competencia primero, luego deselecciona y vuelve a seleccionar.
                                    </span>`;
                            }
                        }
                    });
                } else {
                    let contenedor = document.getElementById('nivel_esperado_contenedor');
                    contenedor.innerHTML = "";
                }
            })
        })
    </script>
@endsection
