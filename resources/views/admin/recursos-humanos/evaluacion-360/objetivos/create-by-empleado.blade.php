@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Objetivos-Create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Asignar </strong> Objetivos </h3>
        </div>
        <div class="card-body">
            <form id="formObjetivoCreate" method="POST" action="{{ route('admin.ev360-objetivos.index') }}"
                enctype="multipart/form-data" class="mt-3 row">
                @csrf
                @include('admin.recursos-humanos.evaluacion-360.objetivos._form_by_empleado')
                <div class="col-12">
                    <div class="d-flex justify-content-end w-100">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                        <button type="submit" class="btn btn-danger ml-2">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="objetivoModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="objetivoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #00abb2;color: white;">
                    <h4 class="modal-title" id="objetivoModalLabel"><i class="mr-1 fas fa-chalkboard-teacher"></i>
                        Conductas
                        Esperadas
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;font-size: 28px;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formConductaCreate" action="{{ route('admin.ev360-conductas.store') }}" method="post">
                        @include('admin.recursos-humanos.evaluacion-360.conductas._form')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCancelarConducta" class="btn_cancelar"
                        data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnGuardarConducta" class="btn btn-danger">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('.form-control-file').on('change', function(e) {
                let inputFile = e.currentTarget;
                console.log('si')
                $("#texto-imagen").text(inputFile.files[0].name);
                // Imagen previa
                var reader = new FileReader();
                reader.readAsDataURL(inputFile.files[0]);
                reader.onload = function(e) {
                    document.getElementById('uploadPreview').src = e.target.result;
                };
            });


            let dtButtons = [];

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: "{{ route('admin.ev360-objetivos-empleado.create', $empleado->id) }}",
                columns: [{
                    data: 'objetivo.nombre'
                }, {
                    data: 'objetivo.tipo.nombre',
                }, {
                    data: 'objetivo.KPI',
                }, {
                    data: 'objetivo.meta',
                }, {
                    data: 'objetivo.metrica.definicion',
                }, {
                    data: 'objetivo.descripcion_meta',
                }, {
                    data: 'objetivo.imagen_ruta',
                    render: function(data, type, row, meta) {
                        console.log(row);
                        return `<img src="${data}" alt="${row.objetivo.nombre}" title="${row.objetivo.nombre}" style="clip-path:circle(15px at 50% 50%); height:30px;">`;
                    }
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let urlBtnEditar =
                            `/admin/recursos-humanos/evaluacion-360/${row.empleado_id}/objetivos/${row.objetivo_id}/edit`;
                        let urlBtnActualizar =
                            `/admin/recursos-humanos/evaluacion-360/${row.empleado_id}/objetivos/${row.objetivo_id}`;
                        let urlBtnEliminar =
                            `/admin/recursos-humanos/evaluacion-360/${row.empleado_id}/objetivos/${row.objetivo_id}`;
                        let botones = `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-editar" title="Editar" onclick="event.preventDefault();Editar('${urlBtnEditar}','${urlBtnActualizar}')"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-eliminar text-danger" title="Eliminar" onclick="event.preventDefault();Eliminar('${urlBtnEliminar}')"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        `;
                        return botones;
                    }
                }],
                order: [
                    [1, 'asc']
                ],
                dom: "<'row align-items-center justify-content-center container m-0 p-0'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0 p-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
            };
            window.tblObjetivos = $('.tblObjetivos').DataTable(dtOverrideGlobals);
        });
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            document.getElementById('BtnAgregarObjetivo').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                let formData = new FormData(document.getElementById('formObjetivoCreate'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.ev360-objetivos-empleado.store', $empleado->id) }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        toastr.info('Asignando el objetivo');
                    },
                    success: function(response) {
                        if (response.success) {
                            tblObjetivos.ajax.reload();
                            toastr.success('Objetivo asignado');
                            document.getElementById('formObjetivoCreate').reset();

                            document.getElementById('foto').value = "";
                            document.getElementById('texto-imagen').innerHTML =
                                'Subir imágen <small class="text-danger" style="font-size: 10px">(Opcional)</small>';
                            document.getElementById('uploadPreview').src =
                                @json(asset('img/not-available.png'))
                        }
                    },
                    error: function(request, status, error) {
                        $.each(request.responseJSON.errors, function(indexInArray,
                            valueOfElement) {
                            console.log(valueOfElement, indexInArray);
                            $(`span.${indexInArray}_error`).text(valueOfElement[0]);

                        });
                    }
                });
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
                        document.getElementById('nivelEditCreate').innerHTML =
                            `<i class="fas fa-info-circle mr-1"></i>Nivel Actual: <strong>${ conducta.ponderacion }</strong>`;
                        $('#objetivoModal').modal('show');
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
                    title: '¿Se ha compleatado este objetivo?',
                    text: "No podrás revertir esto",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si!',
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
        })

        function limpiarErrores() {
            let errores = document.querySelectorAll('.errors');
            errores.forEach(element => {
                element.innerHTML = "";
            });
        }

        Livewire.on('tipoObjetivoStore', () => {
            $('#tipoObjetivoModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Tipo de objetivo creado con éxito');
        });
        Livewire.on('metricaObjetivoStore', () => {
            $('#metricaObjetivoModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Métrica del objetivo creada con éxito');
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
@endsection
