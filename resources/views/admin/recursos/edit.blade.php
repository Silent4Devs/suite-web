@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.recurso.title_singular') }}
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
                                    Alta de participantes
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
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
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
                                    <button class="mt-4 btnNext btn btn-primary" style="float: right">
                                        Siguiente
                                        <i class="ml-1 fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="px-4 mt-4 mb-3 tab-pane fade" id="participantes" role="tabpanel"
                            aria-labelledby="participantes-tab">
                            <div class="w-100" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Alta de participantes</span>
                            </div>
                            <form action="POST" class="mt-3 row" id="form-participantes">
                                <div class="pl-3 row w-100">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
                                            participante</label>
                                        <input class="form-control" type="text" id="participantes"
                                            placeholder="Busca un empleado" style="position: relative" />
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
                                    <button type="submit" class="mr-3 btn btn-sm btn-primary" style="float: right">Suscribir
                                        Participante</button>
                                </div>
                            </form>
                            <div class="mt-3 col-12 datatable-fix">
                                <table class="table w-100" id="tbl-participantes">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Roberto</td>
                                            <td>roberto@gmail.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 form-group col-12">
                                <div class="btn-group" role="group" aria-label="Terminar capacitacion" style="float: right">
                                    <button class="btnPrevious btn btn-danger">
                                        <i class="ml-1 fas fa-arrow-left"></i>
                                        Anterior
                                    </button>
                                    <button id="btn-general" class="btn btn-success" style="position: relative">
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
            if (!$.fn.dataTable.isDataTable('#tbl-participantes')) {
                $('#tbl-participantes').DataTable({
                    buttons: []
                });
            }
        }

        $(document).ready(function() {
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
            $("#btn-general").click(function(e) {
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
                        $("#btn-general").attr('disabled', true);
                        $(document).find('span.error-text').text('');
                        $(document).find('div#errores_alert').removeClass(
                            'p-3 text-white bg-danger');
                        $(document).find('div#errores_alert').text('');
                        $("#form-informacion-general")[0].reset();
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#btn-general").attr('disabled', false);
                            $("#guardando_capacitacion").hide();
                            //window.location.href = index_page;
                        } else {
                            console.log("Ocurrió un error");
                        }
                    },
                    error: function(error) {
                        $("#btn-general").attr('disabled', false);
                        $("#guardando_capacitacion").hide();
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
            let url = "{{ route('admin.users.get') }}";
            $("#participantes").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: 'nombre=' + $(this).val(),
                    beforeSend: function() {
                        // $("#participantes").css("background",
                        //     "#FFF url(LoaderIcon.gif) no-repeat 165px");
                        $("#cargando_participantes").show();
                        console.log('Buscando...');
                    },
                    success: function(data) {
                        $("#cargando_participantes").hide();
                        $("#participantes_sugeridos").show();
                        let sugeridos = document.querySelector(
                            "#participantes_sugeridos");
                        sugeridos.innerHTML = data;

                        $("#participantes").css("background", "#FFF");
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
            $("#participantes").val(user.name);
            $("#email").val(user.email);
            $("#participantes_sugeridos").hide();
        }

    </script>
@endsection
