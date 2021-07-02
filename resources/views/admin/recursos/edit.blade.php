@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.recursos.create') }}
    
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} Capacitación
        </div>
        <div id="errores_alert"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-fill nav-tabs" id="tab-recursos" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                                aria-controls="general" aria-selected="true">
                                <font class="letra_blanca">
                                    <i class="mr-1 fas fa-file"></i>
                                    Información General
                                </font>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="participantes-tab" data-toggle="tab" href="#participantes" role="tab"
                                aria-controls="participantes" aria-selected="false" onclick="participantesDataTable()">
                                <font class="letra_blanca">
                                    <i class="mr-1 fas fa-users"></i>
                                    Participantes
                                </font>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content card" id="myTabContentJust">
                        <div class="px-4 mt-4 tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <div class="w-100" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Información general de la capacitación</span>
                            </div>
                            <form id="form-informacion-general" class="mt-3 row" method="POST"
                                action="{{ route('admin.recursos.update', [$recurso->id]) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="pl-3 row w-100">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label for="cursoscapacitaciones">
                                            <i class="fab fa-discourse iconos-crear"></i> Título
                                        </label>
                                        <input
                                            class="form-control {{ $errors->has('cursoscapacitaciones') ? 'is-invalid' : '' }}"
                                            type="text" name="cursoscapacitaciones" id="cursoscapacitaciones"
                                            value="{{ old('cursoscapacitaciones', $recurso->cursoscapacitaciones) }}"
                                            autocomplete="off">
                                        <span class="text-danger error_text cursoscapacitaciones_error"></span>
                                    </div>
                                </div>
                                <div class="pl-3 row w-100">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="categoria_capacitacion_id"><i class="fab fa-discourse iconos-crear"></i>
                                            Categoría</label>
                                        <select name="categoria_capacitacion_id" id="categoria_capacitacion_id"
                                            class="form-control">
                                            <option value="" selected disabled>-- Selecciona una categoría --</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}"
                                                    {{ old('categoria_capacitacion_id', $categoria->nombre) == $categoria->nombre ? 'selected' : '' }}>
                                                    {{ $categoria->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('categoria_capacitacion_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('categoria_capacitacion_id') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="tipo"><i class="fab fa-discourse iconos-crear"></i> Tipo</label>
                                        <select name="tipo" id="tipo" class="form-control">
                                            <option value="" {{ old('tipo', $recurso->tipo) == null ? 'selected' : '' }}
                                                disabled>
                                                -- Selecciona una opción --</option>
                                            <option value="curso"
                                                {{ old('tipo', $recurso->tipo) == 'curso' ? 'selected' : '' }}> Curso
                                            </option>
                                            <option value="diplomado"
                                                {{ old('tipo', $recurso->tipo) == 'diplomado' ? 'selected' : '' }}>
                                                Diplomado</option>
                                            <option value="certificacion"
                                                {{ old('tipo', $recurso->tipo) == 'certificacion' ? 'selected' : '' }}>
                                                Certificación
                                            </option>
                                        </select>
                                        <span class="text-danger error_text tipo_error"></span>
                                    </div>
                                </div>
                                <div class="pl-3 row w-100">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="fecha_curso"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha
                                            Inicio</label>
                                        <input class="form-control" type="datetime-local" id="fecha_curso"
                                            name="fecha_curso"
                                            value="{{ old('fecha_curso', \Carbon\Carbon::parse($recurso->fecha_curso)->format('Y-m-d\TH:i')) }}">
                                        <span class="text-danger error_text fecha_curso_error"></span>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="fecha_fin"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha
                                            Finalización</label>
                                        <input class="form-control" type="datetime-local" id="fecha_fin" name="fecha_fin"
                                            value="{{ old('fecha_fin', \Carbon\Carbon::parse($recurso->fecha_fin)->format('Y-m-d\TH:i')) }}">
                                        <span class="text-danger error_text fecha_inicio_error"></span>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="instructor"><i
                                            class="fas fa-user iconos-crear"></i>{{ trans('cruds.recurso.fields.instructor') }}</label>
                                    <input class="form-control {{ $errors->has('instructor') ? 'is-invalid' : '' }}"
                                        type="text" name="instructor" id="instructor"
                                        value="{{ old('instructor', $recurso->instructor) }}">
                                    <span class="text-danger error_text instructor_error"></span>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-12 col-lg-12">
                                    <label for="descripcion"> <i class="fas fa-lightbulb iconos-crear"></i>
                                        Descripción</label>
                                    <textarea
                                        class="form-control descripcion {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                        name="descripcion"
                                        id="descripcion">{{ old('descripcion', $recurso->descripcion) }}</textarea>
                                    <span class="text-danger error_text descripcion_error"></span>
                                </div>
                                <div class="form-group col-12">
                                    <div class="btn-group" role="group" aria-label="Terminar capacitacion"
                                        style="float: right">
                                        <button class="btn btn-success btn-general" style="position: relative">
                                            Actualizar y salir
                                            <i class="ml-1 fas fa-check-circle"></i>
                                            <i id="guardando_capacitacion_1"
                                                class="fas fa-cog fa-spin text-muted guardando_capacitacion"
                                                style="position: absolute; top: 7px;right: 12px;"></i>
                                        </button>
                                        <button class="btnNext btn btn-primary" style="float: right">
                                            Siguiente
                                            <i class="ml-1 fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="px-4 mt-4 mb-3 tab-pane fade" id="participantes" role="tabpanel"
                            aria-labelledby="participantes-tab">
                            <div class="w-100" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Participantes</span>
                            </div>
                            <form method="POST" action="{{ route('admin.recursos.suscribir') }}" class="mt-3 row"
                                id="form-participantes" enctype="multipart/form-data">
                                <div class="pl-3 row w-100">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
                                            participante</label>
                                        <input type="hidden" id="id_empleado">
                                        <input class="form-control" type="text" id="participantes_search"
                                            placeholder="Busca un empleado" style="position: relative" autocomplete="off" />
                                        <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                                            style="position: absolute; top: 43px; right: 25px;"></i>
                                        <div id="participantes_sugeridos"></div>
                                        @if ($errors->has('participantes'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('participantes') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="email"><i class="fas fa-at iconos-crear"></i>Email</label>
                                        <input class="form-control" type="text" id="email"
                                            placeholder="Correo del participante" readonly style="cursor: not-allowed" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button id="btn-suscribir-participante" type="submit"
                                        class="mr-3 btn btn-sm btn-outline-success"
                                        style="float: right; position: relative;">
                                        <i class="mr-1 fas fa-plus-circle"></i>
                                        Suscribir Participante
                                        <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
                                            style="position: absolute; top: 3px;left: 8px;"></i>
                                    </button>
                                </div>
                            </form>
                            <div class="mt-3 col-12 datatable-fix">
                                <table class="table w-100" id="tbl-participantes">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">No. Empleado</th>
                                            <th scope="col">Participante</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Calificación</th>
                                            <th scope="col">Certificado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="mt-4 w-100" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Registrar calificación</span>
                                <span id="participante_seleccionado"></span>
                            </div>
                            <div class="mt-3 form-group col-12">
                                <form id="form_calificar_participantes" action="{{ route('admin.recursos.calificar') }}"
                                    method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" id="id_empleado_calificacion" name="id_empleado">
                                        <input type="hidden" id="id_recurso_calificacion" name="id_recurso">
                                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                            <label for="text"><i class="fas fa-edit iconos-crear"></i>Calificación</label>
                                            <input class="form-control" type="number" id="calificacion" name="calificacion"
                                                placeholder="Calificación" />
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                            <label for="text"><i class="fas fa-image iconos-crear"></i>Certificado</label>
                                            <input class="form-control" type="file" id="certificado" name="certificado"
                                                placeholder="Certificado" accept=".jpg, .png, .gif" />
                                            <span class="text-xs text-muted">Solo formatos <i class="fas fa-image"></i> JPG,
                                                PNG, GIF</span>
                                            <div class="text-center col-12" id="c_img_certificado">
                                                <img src="" alt="" width="80px" id="img_certificado">
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <button id="btn_calificar_empleado" type="submit"
                                                class="btn btn-sm btn-outline-success" style="float: right">
                                                <i class="mr-1 fas fa-edit "></i>Calificar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="mt-3 form-group col-12">
                                <div class="btn-group" role="group" aria-label="Terminar capacitacion" style="float: right">
                                    <button class="btnPrevious btn btn-danger">
                                        <i class="ml-1 fas fa-arrow-left"></i>
                                        Anterior
                                    </button>
                                    <button id="btn-general" class="btn btn-success btn-general" style="position: relative">
                                        Actualizar
                                        <i class="ml-1 fas fa-check-circle"></i>
                                        <i id="guardando_capacitacion" class="fas fa-cog fa-spin text-muted"
                                            style="position: absolute; top: 7px;right: 12px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        function participantesDataTable() {
            let id_recurso = "{{ $recurso->id }}";
            if (!$.fn.dataTable.isDataTable('#tbl-participantes')) {
                tbl_participantes = $('#tbl-participantes').DataTable({
                    buttons: [],
                    ajax: {
                        url: `/admin/recursos/${id_recurso}/participantes/`,
                        type: "GET"
                    },
                    columns: [{
                            data: "id",
                            visible: false
                        },
                        {
                            data: "n_empleado",
                        },
                        {
                            data: "name",
                            render: function(data, type, row, meta) {
                                let foto = row.foto != null ? row.foto : "no-photo.png";
                                let html = `<div class="row align-items-center">
                                <div class="col-4">
                                    <img src="{{ asset('storage/empleados/imagenes') }}/${foto}" width="35px" class="mr-2 rounded-circle" />
                                </div>
                                <div class="col-8">
                                    <p class="p-0 m-0"><strong>${data}</strong></p>
                                    <p class="p-0 m-0"><span class="badge badge-primary">${row.area}</span></p>
                                </div>
                            </div>`;
                                return html;
                            }
                        },
                        {
                            data: "email"
                        },
                        {
                            data: "pivot.calificacion"
                        },
                        {
                            data: "pivot.certificado",
                            render: function(data, type, row, meta) {
                                let nombre_capacitacion = "{{ $recurso->cursoscapacitaciones }}";
                                if (data != null) {
                                    return `<a target="_blank" href="{{ asset('storage/capacitaciones/certificados/') }}/${nombre_capacitacion}/${data}">
                                                <img src="{{ asset('storage/capacitaciones/certificados/') }}/${nombre_capacitacion}/${data}" width="45px" />
                                            </a>`;
                                } else {
                                    return "";
                                }

                            }
                        },
                        {
                            data: "id",
                            render: function(data, type, row, meta) {
                                let certificado = row.pivot.certificado;
                                let calificacion = row.pivot.calificacion;
                                let boton_html =
                                    `<div class="btn-group" role="group" aria-label="Basic example">
                                <button onclick='calificarParticipante(${data},"${certificado}","${calificacion}","${row.name}")' type="button" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button onclick='eliminarParticipante(${data})' type="button" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            `;
                                return boton_html;
                            }
                        }
                    ]
                });
            }
        }

        function calificarParticipante(id_empleado, certificado, calificacion, nombre) {
            let id_recurso = "{{ $recurso->id }}";
            $("#id_empleado_calificacion").val(id_empleado);
            $("#id_recurso_calificacion").val(id_recurso);
            let calificacion_r = calificacion;
            let certificado_r = certificado;
            if (calificacion == 'null') {
                calificacion = null;
            }
            if (certificado == 'null') {
                certificado = null;
            }
            let seleccionado_p = document.querySelector("#participante_seleccionado");
            seleccionado_p.innerHTML = `( ${nombre} )`;
            $("#calificacion").val(calificacion);
            let img_certificado = document.querySelector("#img_certificado");
            let nombre_capacitacion = "{{ $recurso->cursoscapacitaciones }}";
            img_certificado.src =
                `{{ asset('storage/capacitaciones/certificados/') }}/${nombre_capacitacion}/${certificado}`;
        }

        function eliminarParticipante(id_empleado) {
            Swal.fire({
                title: 'Estás seguro de realizar esta acción?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('admin.recursos.cancelar') }}";
                    let id_recurso = "{{ $recurso->id }}";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            id_recurso,
                            id_empleado
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.success) {
                                tbl_participantes.ajax.reload();
                                Swal.fire(
                                    'Participante dado de baja!',
                                    '',
                                    'success'
                                )
                            }

                            if (response.error) {
                                console.log('Ocurrió un error al eliminar');
                            }
                        }
                    });
                }
            })
        }

        function suscribirParticipante() {
            //form-participantes
            let id_recurso = "{{ $recurso->id }}";
            let id_empleado = $("#id_empleado").val();
            let url = $("#form-participantes").attr("action");
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id_recurso,
                    id_empleado,
                },
                beforeSend: function() {
                    $("#suscribiendo").show();
                    $("#btn-suscribir-participante").attr('disabled', true);
                },
                success: function(response) {
                    if (response.success) {
                        $("#btn-suscribir-participante").attr('disabled', false);
                        $("#suscribiendo").hide();
                        tbl_participantes.ajax.reload();
                        $("#participantes_search").val('');
                        $("#id_empleado").val('');
                        $("#email").val('');
                        Swal.fire(
                            'Participante dado de alta!',
                            '',
                            'success'
                        )
                    }
                    if (response.exists) {
                        $("#btn-suscribir-participante").attr('disabled', false);
                        $("#suscribiendo").hide();
                        console.log("Ya está suscrito");
                        $("#participantes_search").val('');
                        $("#id_empleado").val('');
                        $("#email").val('');
                        Swal.fire(
                            'Este participante ya está dado de alta en la capacitación!',
                            '',
                            'error'
                        )
                    }
                    if (response.error) {
                        console.log("Aún no has seleccionado un empleado");
                        $("#btn-suscribir-participante").attr('disabled', false);
                        $("#suscribiendo").hide();
                        $("#participantes_search").val('');
                        $("#id_empleado").val('');
                        $("#email").val('');
                        Swal.fire(
                            'Aún no has seleccionado un empleado para dar de alta!',
                            '',
                            'error'
                        )
                    }
                }
            });
        }

        function saveCalificacionParticipante(form) {
            $.ajax({
                type: "POST",
                url: $(form).attr('action'),
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#id_empleado_calificacion").val(null);
                    $("#id_recurso_calificacion").val(null);
                    $("#calificacion").val(null);
                    $("#certificado").val(null);
                    if (response.success) {
                        Swal.fire(
                            'Datos registrados con éxito',
                            '',
                            'success'
                        )
                        tbl_participantes.ajax.reload();
                    }
                    if (response.no_selected) {
                        Swal.fire(
                            'No has seleccionado un participante!',
                            '',
                            'error'
                        )
                    }
                }
            });
        }

        $(document).ready(function() {
            // $("#participantes-tab").trigger('click');
            let tbl_participantes;

            $("#form_calificar_participantes").submit(function(e) {
                e.preventDefault();
                saveCalificacionParticipante(this);
            });

            $("#suscribiendo").hide();
            $("#btn-suscribir-participante").click(function(e) {
                e.preventDefault();
                suscribirParticipante();
            });

            $('.btnNext').click(function(e) {
                e.preventDefault();
                $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
            });

            $('.btnPrevious').click(function(e) {
                e.preventDefault();
                $('.nav-tabs > .nav-item > .active').parent().prev('li').find('a').trigger('click');
            });

            let index_page = "{{ route('admin.recursos.index') }}";
            $("#guardando_capacitacion").hide();
            $("#guardando_capacitacion_1").hide();
            $(".btn-general").click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let url = $("#form-informacion-general").attr("action");
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#form-informacion-general').serialize(),
                    beforeSend: function() {
                        $("#guardando_capacitacion").show();
                        $("#guardando_capacitacion_1").show();
                        $(".btn-general").attr('disabled', true);
                        $(document).find('span.error-text').text('');
                        $(document).find('div#errores_alert').removeClass(
                            'p-3 text-white bg-danger');
                        $(document).find('div#errores_alert').text('');
                        $("#form-informacion-general")[0].reset();
                    },
                    success: function(response) {
                        if (response.success) {
                            $(".btn-general").attr('disabled', false);
                            $("#guardando_capacitacion").hide();
                            $("#guardando_capacitacion_1").hide();
                            window.location.href = index_page;
                        } else {
                            console.log("Ocurrió un error");
                        }
                    },
                    error: function(error) {
                        $(".btn-general").attr('disabled', false);
                        $("#guardando_capacitacion").hide();
                        $("#guardando_capacitacion_1").hide();
                        $(document).find('div#errores_alert').addClass(
                            'p-3 text-white bg-danger');
                        $("#errores_alert").text(
                            'Existen errores de validación, por favor revisa ambas pestañas.'
                        );
                        $.each(error.responseJSON.errors, function(indexInArray,
                            valueOfElement) {
                            $(`span.${indexInArray}_error`).text(valueOfElement[0]);
                            console.log(indexInArray, valueOfElement);
                        });

                    }
                });
            });

            $("#cargando_participantes").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = "{{ route('admin.empleados.get') }}";
            $("#participantes_search").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: 'nombre=' + $(this).val(),
                    beforeSend: function() {
                        $("#cargando_participantes").show();
                    },
                    success: function(data) {
                        $("#cargando_participantes").hide();
                        $("#participantes_sugeridos").show();
                        let sugeridos = document.querySelector(
                            "#participantes_sugeridos");
                        sugeridos.innerHTML = data;

                        $("#participantes_search").css("background", "#FFF");
                    }
                });
            });

            // CKEDITOR.replace('descripcion', {
            //     toolbar: [{
            //         name: 'paragraph',
            //         groups: ['list', 'indent', 'blocks', 'align'],
            //         items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
            //             'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
            //             'Bold', 'Italic'
            //         ]
            //     }, {
            //         name: 'clipboard',
            //         items: ['Link', 'Unlink']
            //     }, ]
            // });
        });
        //To select country name
        function seleccionarUsuario(user) {
            console.log(user);
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#email").val(user.email);
            $("#participantes_sugeridos").hide();
        }

    </script>
@endsection
