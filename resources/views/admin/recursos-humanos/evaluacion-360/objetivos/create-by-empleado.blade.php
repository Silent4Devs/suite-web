@extends('layouts.admin')
@section('content')
    <style>
        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 8px;
            width: 16px;
            background: rgb(24, 24, 24);
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }

        .lds-facebook div:nth-child(1) {
            left: 8px;
            animation-delay: -0.24s;
        }

        .lds-facebook div:nth-child(2) {
            left: 32px;
            animation-delay: -0.12s;
        }

        .lds-facebook div:nth-child(3) {
            left: 56px;
            animation-delay: 0;
        }

        @keyframes lds-facebook {
            0% {
                top: 8px;
                height: 64px;
            }

            50%,
            100% {
                top: 24px;
                height: 32px;
            }
        }

        .display-almacenando {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 2;
            margin-left: 0px;
            background: #0000000d;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .display-almacenando h1 {
            font-size: 50px;
        }

        .display-almacenando p {
            font-size: 30px;
        }
    </style>
    {{ Breadcrumbs::render('EV360-Objetivos-Create', $empleado) }}
    <h5 class="col-12 titulo_general_funcion">Asignar Objetivos Estratégicos</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form id="formObjetivoCreate" method="POST" action="{{ route('admin.ev360-objetivos.index') }}"
                enctype="multipart/form-data" class="mt-3 row">
                @csrf
                @include('admin.recursos-humanos.evaluacion-360.objetivos._form_by_empleado', [
                    'editar' => false,
                ])
                <div class="col-12">
                    <div class="d-flex justify-content-end w-100">
                        <a href="{{ route('admin.ev360-objetivos.index') }}" class="btn_cancelar">Regresar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="objetivoModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="objetivoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #345183;color: white;">
                    <h4 class="modal-title" id="objetivoModalLabel"><i class="mr-1 fas fa-chalkboard-teacher"></i>
                        Conductas
                        Esperadas
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;font-size: 28px;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formObjetivoEdit" method="post" enctype="multipart/form-data" class="mt-3 row">
                        @method('PATCH')
                        @include('admin.recursos-humanos.evaluacion-360.objetivos._form_by_empleado', [
                            'editar' => true,
                        ])
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCancelarEditObjetivo" class="btn_cancelar"
                        data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnActualizarObjetivo" class="btn btn-danger">Guardar</button>
                </div>
                <div class="display-almacenando row" id="displayAlmacenandoUniversal" style="display: none">
                    <div class="col-12">
                        <h1>
                            <div class="lds-facebook">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('#foto').on('change', function(e) {
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
            // $('#fotoEdit').on('change', function(e) {
            //     let inputFile = e.currentTarget;
            //     console.log('No')
            //     $("#texto-imagenEdit").text(inputFile.files[0].name);
            //     // Imagen previa
            //     var reader = new FileReader();
            //     reader.readAsDataURL(inputFile.files[0]);
            //     reader.onload = function(e) {
            //         document.querySelector('#uploadPreviewEdit').src = e.target.result;
            //     };
            // });
            $('#fotoPerspectiva').on('change', function(e) {
                let inputFile = e.currentTarget;
                console.log('No')
                $("#texto-imagen-perspectiva").text(inputFile.files[0].name);
                // Imagen previa
                var reader = new FileReader();
                reader.readAsDataURL(inputFile.files[0]);
                reader.onload = function(e) {
                    document.querySelector('#uploadPreviewPerspectiva').src = e.target.result;
                };
            });


            let dtButtons = [];
            let empleado = @json($empleado);
            let auth = @json(Auth::user()->empleado);
            let supervisor = @json($empleado->supervisor);
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: "{{ route('admin.ev360-objetivos-empleado.create', $empleado->id) }}",
                columns: [{
                    data: 'objetivo.tipo.nombre',
                }, {
                    data: 'objetivo.nombre'
                },{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return row.evaluacion_id;
                    }
                },
                {
                    data: 'objetivo.KPI',
                }, {
                    data: 'objetivo',
                    render: function(data, type, row, meta) {
                        return data.meta + ' ' + row.objetivo?.metrica?.definicion;
                    }
                }, {
                    data: 'objetivo.esta_aprobado',
                    render: function(data, type, row, meta) {
                        if (data == 1) {
                            return '<span class="badge badge-success">Aprobado</span>';
                        } else if (data == 2) {
                            let html = `
                            <span class="badge badge-danger">No Aprobado
                                <i class="fas fa-comment ml-1" title="${row.objetivo.comentarios_aprobacion}"></i>
                            </span>`;
                            return html;
                        } else {
                            return '<span class="badge badge-warning">Pendiente</span>';
                        }
                    }
                }, {
                    data: 'objetivo.descripcion_meta',
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {

                        let urlBtnEditar =
                            `/admin/recursos-humanos/evaluacion-360/${row.empleado_id}/objetivos/${row.objetivo_id}/editByEmpleado`;
                        let urlBtnActualizar =
                            `/admin/recursos-humanos/evaluacion-360/objetivos/${row.objetivo_id}/empleado`;
                        let urlBtnEliminar =
                            `/admin/recursos-humanos/evaluacion-360/objetivos/${row.id}`;
                        let urlShow =
                            `/admin/recursos-humanos/evaluacion-360/${row.empleado_id}/objetivos/lista`;
                        let botones = `
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-sm btn-editar" title="Editar" onclick="event.preventDefault();Editar('${urlBtnEditar}','${urlBtnActualizar}')"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-eliminar text-danger" title="Eliminar" onclick="event.preventDefault();Eliminar('${urlBtnEliminar}')"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                `;
                        if (row.objetivo.esta_aprobado == 0) {
                            if (auth.id == supervisor.id) {
                                botones +=
                                    `<div class="col-12">
                                        <button onclick="event.preventDefault();aprobarObjetivoEstrategico(${row.objetivo_id},${row.empleado_id},true);" class="btn btn-small text-success"><i class="fa-solid fa-thumbs-up"></i></button>
                                        <button onclick="event.preventDefault();aprobarObjetivoEstrategico(${row.objetivo_id},${row.empleado_id},false);" class="btn btn-small text-danger"><i class="fa-solid fa-thumbs-down"></i></button>
                                        </div>
                                    </div>
                                    `;
                            }
                        } else {
                            botones += `</div>`;
                        }

                        return botones;
                    }
                }],
                order: [
                    [1, 'asc']
                ],
                pageLength: 10,
                dom: "<'row align-items-center justify-content-center container m-0 p-0'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0 p-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
            };
            window.tblObjetivos = $('.tblObjetivos').DataTable(dtOverrideGlobals);

            window.aprobarObjetivoEstrategico = (objetivo, empleado, estaAprobado) => {
                let textoAprobacion = estaAprobado ? 'Aprobar' : 'Rechazar';
                let textoAprobado = estaAprobado ? 'Aprobado' : 'Rechazado';
                let urlAprobacion = @json(route('admin.ev360-objetivos-empleado.aprobarRechazarObjetivo', ['empleado' => ':idEmpleado', 'objetivo' => ':idObjetivo']));
                urlAprobacion = urlAprobacion.replace(':idEmpleado', empleado);
                urlAprobacion = urlAprobacion.replace(':idObjetivo', objetivo);
                console.log(urlAprobacion);
                Swal.fire({
                    title: `¿Está seguro de ${textoAprobacion.toLowerCase()} este objetivo estratégico?`,
                    html: '<i class="fas fa-question-circle mr-2"></i> Razón de aceptación o rechazo',
                    input: 'textarea',
                    inputValidator: (value) => {
                        if (!estaAprobado) {
                            if (value.trim().length < 3) {
                                return 'El campo debe tener al menos 3 caracteres'
                            }
                        }

                    },
                    inputAttributes: {
                        'maxlength': 100,
                        'autocapitalize': 'off',
                        'autocorrect': 'off',
                        'required': estaAprobado,
                    },
                    showCancelButton: true,
                    confirmButtonText: textoAprobacion,
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (comentarios_aprobacion) => {
                        return fetch(urlAprobacion, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content'),
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    esta_aprobado: estaAprobado,
                                    objetivo,
                                    empleado,
                                    comentarios_aprobacion
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(textoAprobado, `Objetivo ${textoAprobado} con éxito`, 'success').then(
                            () => {
                                tblObjetivos.ajax.reload();
                            });
                    }
                })

            }
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
                            $("#tipo_id").val('').trigger('change');
                            $("#metrica_id").val('').trigger('change');
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
                    success: function(response) {
                        console.log(response);
                        document.querySelector('#formObjetivoEdit input[name="nombre"]').value =
                            response.nombre;
                        document.querySelector('#formObjetivoEdit input[name="KPI"]').value =
                            response.KPI;
                        document.querySelector('#formObjetivoEdit input[name="meta"]').value =
                            response.meta;
                        document.querySelector('#formObjetivoEdit [name="descripcion_meta"]')
                            .value =
                            response.descripcion_meta;
                        document.querySelector('#formObjetivoEdit .imagen-preview').src =
                            response.imagen_ruta;

                        $('#formObjetivoEdit #tipo_id').val(response.tipo_id).trigger('change');
                        $('#formObjetivoEdit #metrica_id').val(response.metrica_id).trigger(
                            'change');

                        $('#objetivoModal').modal('show');
                        $('#formObjetivoEdit').removeAttr('action');
                        $('#formObjetivoEdit').removeAttr('method');
                        $('#formObjetivoEdit').attr('action', urlActualizar);
                        $('#formObjetivoEdit').attr('method', 'PATCH');
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

            document.getElementById('btnActualizarObjetivo').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                let formulario = document.getElementById('formObjetivoEdit');
                let nombre = document.querySelector('#formObjetivoEdit input[name="nombre"]').value;
                let kpi = document.querySelector('#formObjetivoEdit input[name="KPI"]').value;
                let meta = document.querySelector('#formObjetivoEdit input[name="meta"]').value;
                let descripcion = document.querySelector(
                    '#formObjetivoEdit [name="descripcion_meta"]').value;
                let tipo_id = $('#formObjetivoEdit #tipo_id').val();
                let metrica_id = $('#formObjetivoEdit #metrica_id').val();
                let formDataEdit = new FormData();
                formDataEdit.append('nombre', nombre);
                formDataEdit.append('KPI', kpi);
                formDataEdit.append('meta', meta);
                formDataEdit.append('descripcion', descripcion);
                formDataEdit.append('tipo_id', tipo_id);
                formDataEdit.append('metrica_id', metrica_id);
                // formDataEdit.append('foto', document.querySelector('#formObjetivoEdit #fotoEdit').files[0]);
                mostrarValidando();
                $.ajax({
                    type: "POST",
                    url: formulario.getAttribute('action'),
                    data: formDataEdit,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    beforeSend: function() {
                        toastr.info(
                            'Actualizando, espere unos instantes...');
                    },
                    success: function(response) {
                        ocultarValidando();
                        limpiarErrores();
                        $('#objetivoModal').modal('hide');
                        toastr.success('Registro actualizado');
                        tblObjetivos.ajax.reload();
                        document.getElementById('fotoEdit').value = "";
                        document.getElementById('texto-imagenEdit').innerHTML =
                            'Subir imágen <small class="text-danger" style="font-size: 10px">(Opcional)</small>';
                        document.getElementById('uploadPreviewEdit').src =
                            @json(asset('img/not-available.png'))
                    },
                    error: function(request, status, error) {
                        ocultarValidando();
                        if (error != 'Unprocessable Entity') {
                            toastr.error(
                                'Ocurrió un error: ' + error);
                        } else {
                            $.each(request.responseJSON.errors, function(indexInArray,
                                valueOfElement) {
                                document.querySelector(
                                        `span.${indexInArray}_error_edit`)
                                    .innerHTML =
                                    `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                            });
                        }
                    }
                });
            })

            window.Eliminar = function(urlEliminar) {
                Swal.fire({
                    title: '¿Deseas eliminar este objetivo?',
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
                            type: "POST",
                            url: urlEliminar,
                            beforeSend: function() {
                                toastr.info(
                                    'Eliminando el objetivo, espere unos instantes...');
                            },
                            success: function(response) {
                                toastr.success('Objetivo eliminado');
                                tblObjetivos.ajax.reload();
                            },
                            error: function(request, status, error) {
                                toastr.error(
                                    'Ocurrió un error: ' + error);
                            }
                        });

                    }
                })
            }

            document.getElementById('copiarObjetivos').addEventListener('click', (e) => {
                e.preventDefault();
                let empleados = @json($empleados);
                let modalContent = document.getElementById('contenidoModal');
                let contenidoHTMLGenerado = `
                <form id="formCopiaObjetivos" class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" value="0" name="empleado_destinatario">
                            <label><i class="mr-2 fas fa-user"></i>Selecciona un empleado para importar sus objetivos</label>
                            <select class="empleados-select" name="empleado_destino">
                                <option value="">-- Selecciona un empleado --</option>
                                ${empleados.map(empleado => {
                                            return `<option data-avatar="${empleado.avatar_ruta}" value="${empleado.id}">${empleado.name}</option>`;
                                        }).join(',')}
                            </select>
                        </div>
                    </div>
                </form>
                `;
                modalContent.innerHTML = contenidoHTMLGenerado;
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
            })

            document.getElementById('btnGuardarCopiaObjs').addEventListener('click', () => {
                let formulario = document.getElementById('formCopiaObjetivos');
                let empleado_destinatario = $('.empleados-select').select2('data')[0].id;
                if (empleado_destinatario != '') {
                    console.log('copiando');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.ev360-objetivos-empleado.storeCopiaObjetivos') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            empleado_destinatario,
                            empleado_destino: {{ $empleado->id }},
                        },
                        dataType: "JSON",
                        beforeSend: function() {
                            toastr.info('Copiando objetivos');
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Objetivos copiados correctamente');
                                tblObjetivos.ajax.reload();
                                $('#modalCopiarObjetivos').modal('hide');
                            }
                        },
                        error: function(request, status, error) {
                            toastr.error(error);
                            $('#modalCopiarObjetivos').modal('hide');
                        }
                    });
                }

            })
        })

        function limpiarErrores() {
            let errores = document.querySelectorAll('.errors');
            errores.forEach(element => {
                element.innerHTML = "";
            });
        }

        function mostrarValidando() {
            document.getElementById('displayAlmacenandoUniversal').style.display = 'grid';
        }

        function ocultarValidando() {
            document.getElementById('displayAlmacenandoUniversal').style.display = 'none';
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
