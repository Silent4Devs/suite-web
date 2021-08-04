@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.recursos.create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Capacitación </h3>
        </div>
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
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="participantes-tab" data-toggle="tab" href="#participantes" role="tab"
                                aria-controls="participantes" aria-selected="false" onclick="participantesDataTable()">
                                <font class="letra_blanca">
                                    <i class="mr-1 fas fa-users"></i>
                                    Alta de participantes
                                </font>
                            </a>
                        </li> --}}
                    </ul>
                    <div class="tab-content card" id="myTabContentJust">
                        <div class="px-4 mt-4 tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <div class="w-100" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Información general de la capacitación</span>
                            </div>
                            <form id="form-informacion-general" method="POST" action="{{ route('admin.recursos.store') }}"
                                enctype="multipart/form-data" class="mt-3 row">
                                @csrf
                                <div class="pl-3 row w-100">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                        <label for="cursoscapacitaciones">
                                            <i class="fab fa-discourse iconos-crear"></i> Título
                                        </label>
                                        <input
                                            class="form-control {{ $errors->has('cursoscapacitaciones') ? 'is-invalid' : '' }}"
                                            type="text" name="cursoscapacitaciones" id="cursoscapacitaciones"
                                            value="{{ old('cursoscapacitaciones', '') }}" autocomplete="off">
                                        @if ($errors->has('cursoscapacitaciones'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('cursoscapacitaciones') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
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
                                                    {{ old('categoria_capacitacion_id') == $categoria->nombre ? 'selected' : '' }}>
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
                                            <option value="" selected disabled>-- Selecciona una opción --</option>
                                            <option value="curso" {{ old('tipo') == 'curso' ? 'selected' : '' }}> Curso
                                            </option>
                                            <option value="diplomado" {{ old('tipo') == 'diplomado' ? 'selected' : '' }}>
                                                Diplomado</option>
                                            <option value="certificacion"
                                                {{ old('tipo') == 'certificacion' ? 'selected' : '' }}>
                                                Certificación
                                            </option>
                                        </select>
                                        @if ($errors->has('tipo'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tipo') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
                                    </div>
                                </div>
                                <div class="pl-3 row w-100">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for=""> <i class="fas fa-laptop iconos-crear"></i>Modalidad</label>
                                        <select name="modalidad" class="form-control" id="select_modalidad">
                                            <option selected value="presencial">Seleccionar modalidad</option>
                                            <option value="presencial">Presencial</option>
                                            <option value="linea">En linea</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for=""> <i class="fas fa-map-marker-alt iconos-crear"></i>
                                         <font id="font_modalidad_seleccionada"> Ubicación</font> </font></label> 
                                         <input type="" name="ubicacion" class="form-control">
                                    </div>
                                </div>
                                <div class="pl-3 row w-100">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="fecha_curso"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha
                                            Inicio</label>
                                        <input class="form-control" type="datetime-local" id="fecha_curso"
                                            name="fecha_curso" value="{{ old('fecha_curso') }}">
                                        @if ($errors->has('fecha_curso'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('fecha_curso') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                        <label for="fecha_fin"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha
                                            Finalización</label>
                                        <input class="form-control" type="datetime-local" id="fecha_fin" name="fecha_fin"
                                            value="{{ old('fecha_fin') }}">
                                        @if ($errors->has('fecha_fin'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('fecha_fin') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="instructor"><i
                                            class="fas fa-user iconos-crear"></i>{{ trans('cruds.recurso.fields.instructor') }}</label>
                                    <input class="form-control {{ $errors->has('instructor') ? 'is-invalid' : '' }}"
                                        type="text" name="instructor" id="instructor"
                                        value="{{ old('instructor', '') }}">
                                    @if ($errors->has('instructor'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('instructor') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.recurso.fields.instructor_helper') }}</span>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-12 col-lg-12">
                                    <label for="descripcion"> <i class="fas fa-lightbulb iconos-crear"></i>
                                        Descripción</label>
                                    <textarea
                                        class="form-control descripcion {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                        name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                                    @if ($errors->has('descripcion'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('descripcion') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                                    {{-- <button class="mt-4 btnNext btn btn-primary" style="float: right">
                                        Siguiente
                                        <i class="ml-1 fas fa-arrow-right"></i>
                                    </button> --}}
                                    <button id="btn-general" class="btn btn-success" type="submit"
                                        style="position: relative; float: right;">
                                        Guardar y salir
                                        {{-- <i class="ml-1 fas fa-check-circle"></i>
                                        <i id="guardando_capacitacion" class="fas fa-cog fa-spin text-muted"
                                            style="position: absolute; top: 7px;right: 12px;"></i> --}}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--<div class="px-4 mt-4 mb-3 tab-pane fade" id="participantes" role="tabpanel"
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
                                                                                                            <button id="btn-alta-participantes" type="submit" class="mr-3 btn btn-sm btn-primary"
                                                                                                                style="float: right">
                                                                                                                <i class="mr-1 fas fa-check-circle"></i>
                                                                                                                Dar de alta
                                                                                                            </button>
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
                                                                                                            {{-- <button id="btn-general" class="btn btn-success" style="position: relative">
                                        Guardar
                                        <i class="ml-1 fas fa-check-circle"></i>
                                        <i id="guardando_capacitacion" class="fas fa-cog fa-spin text-muted"
                                            style="position: absolute; top: 7px;right: 12px;"></i>
                                    </button> --}}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script>
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
                        // $("#participantes").css("background",
                        //     "#FFF url(LoaderIcon.gif) no-repeat 165px");
                        $("#guardando_capacitacion").show();
                        $("#btn-general").attr('disabled', true);
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#btn-general").attr('disabled', false);
                            $("#guardando_capacitacion").hide();
                            window.location.href = index_page;
                        } else {
                            console.log("Ocurrió un error");
                        }
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
            $("#participantes").val(user.name);
            $("#email").val(user.email);
            $("#participantes_sugeridos").hide();
        }

    </script> --}}


     <script type="text/javascript">
        $(document).ready(function(){
            let select_activos = document.querySelector('#select_modalidad');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('#font_modalidad_seleccionada');
                if(this.value == 'presencial'){
                    texto_activos.innerHTML = ` Ubicación `;
                }else{
                    texto_activos.innerHTML = ` Link `;
                }
                

            });
        });
    </script>

@endsection
