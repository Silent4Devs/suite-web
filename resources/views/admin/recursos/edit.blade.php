@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.recursos.create') }}
    <style>
        .select2 {
            margin-top: 0 !important;
        }

    </style>
    <h5 class="col-12 titulo_general_funcion"> Registrar: Capacitación</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs" id="tabsCapacitaciones" role="tablist">
                            <a class="nav-link active" data-type="general" id="nav-general-tab" data-toggle="tab"
                                href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">
                                <i class="mr-2 fas fa-briefcase" style="font-size:20px;" style="text-decoration:none;"></i>
                                Información General
                            </a>
                            <a class="nav-link" data-type="participantes" id="nav-participantes-tab"
                                href="#nav-participantes">
                                <i class="mr-2 fas fa-users" style="font-size:20px;" style="text-decoration:none;"></i>
                                Participantes
                                <span class="badge badge-primary" id="contador-participantes-tab">0</span>
                            </a>
                        </li>
                    </ul> 

                    <div class="caja_botones_menu">
                        <a href="#" data-tabs="contenido1" class="btn_activo"><i class="mr-2 fas fa-file"
                                style="font-size:30px;" style="text-decoration:none;"></i>Información General</a>
                        <a href="#" data-tabs="contenido2"><i class="mr-2 fas fa-users" style="font-size:30px;"></i>
                            Participantes</a>
                    </div>


                    <div class="caja_caja_secciones">
                        <div class="caja_secciones">

                            <section id="contenido1" class="mt-4 caja_tab_reveldada">
                                <div>
                                    <div class="w-100" style="border-bottom: solid 2px #345183;">
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
                                                <label for="categoria_capacitacion_id"><i
                                                        class="fab fa-discourse iconos-crear"></i>
                                                    Categoría</label>
                                                <select name="categoria_capacitacion_id" id="categoria_capacitacion_id"
                                                    class="form-control">
                                                    <option value="" selected disabled>-- Selecciona una categoría --
                                                    </option>
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
                                                    <option value=""
                                                        {{ old('tipo', $recurso->tipo) == null ? 'selected' : '' }}
                                                        disabled>
                                                        -- Selecciona una opción --</option>
                                                    <option value="curso"
                                                        {{ old('tipo', $recurso->tipo) == 'curso' ? 'selected' : '' }}>
                                                        Curso
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
                                                <label for=""> <i class="fas fa-laptop iconos-crear"></i>Modalidad</label>
                                                <select name="modalidad" class="form-control" id="select_modalidad">
                                                    <option
                                                        {{ old('presencial', $recurso->modalidad) == 'presencial' ? 'selected' : '' }}
                                                        value="presencial">Presencial</option>
                                                    <option
                                                        {{ old('presencial', $recurso->modalidad) == 'linea' ? 'selected' : '' }}
                                                        value="linea">En linea</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                <label for="">
                                                    <i class="fas fa-map-marker-alt iconos-crear"></i>
                                                    <font id="font_modalidad_seleccionada">
                                                        {{ $recurso->modalidad == 'presencial' ? 'Ubicación' : 'Link' }}
                                                    </font>
                                                </label>
                                                <input type="" name="ubicacion" class="form-control"
                                                    value="{{ old('ubicacion', $recurso->ubicacion) }}">
                                            </div>
                                        </div>
                                        <div class="pl-3 row w-100">
                                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                <label for="fecha_curso"> <i class="fas fa-calendar-alt iconos-crear"></i>
                                                    Fecha
                                                    Inicio</label>
                                                <input class="form-control" type="datetime-local" id="fecha_curso"
                                                    name="fecha_curso"
                                                    value="{{ old('fecha_curso', \Carbon\Carbon::parse($recurso->fecha_curso)->format('Y-m-d\TH:i')) }}">
                                                <span class="text-danger error_text fecha_curso_error"></span>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                <label for="fecha_fin"> <i class="fas fa-calendar-alt iconos-crear"></i>
                                                    Fecha
                                                    Finalización</label>
                                                <input class="form-control" type="datetime-local" id="fecha_fin"
                                                    name="fecha_fin"
                                                    value="{{ old('fecha_fin', \Carbon\Carbon::parse($recurso->fecha_fin)->format('Y-m-d\TH:i')) }}">
                                                <span class="text-danger error_text fecha_inicio_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="instructor"><i
                                                    class="fas fa-user iconos-crear"></i>{{ trans('cruds.recurso.fields.instructor') }}</label>
                                            <input
                                                class="form-control {{ $errors->has('instructor') ? 'is-invalid' : '' }}"
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
                                        <div class="text-right form-group col-12">
                                            {{-- <button class="btn btn-danger" style="position: relative">
                                                Actualizar y salir
                                            </button>
                                            <button class="btnNext btn btn-primary" style="border-radius:100px;">
                                                Siguiente
                                                <i class="ml-1 fas fa-arrow-right"></i>
                                            </button> --}}
                                        </div>
                                    </form>
                                </div>
                            </section>


                            <section id="contenido2" class="mt-4 ml-2">
                                <div>
                                    <div class="w-100" style="border-bottom: solid 2px #345183;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Participantes</span>
                                    </div>
                                    <div class="px-1 py-2 mx-3 mb-4 rounded shadow col-12" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;margin-top: 15px;">
                                        <div class="row w-100">
                                            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                                <div class="w-100">
                                                    <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                                                </div>
                                            </div>
                                            <div class="col-11">
                                                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                                                <p class="m-0" style="font-size: 14px; color:#1E3A8A "><strong>Paso 1 </strong>
                                                    Busque participante y haga clic en el botón suscribir participante.
                                                </p>
                                                <p class="m-0" style="font-size: 14px; color:#1E3A8A "><strong>Paso 2 </strong>
                                                    Registre calificación y cargue certificado, haga clic en el botón calificar.
                                                </p>
                                                <p class="m-0" style="font-size: 14px; color:#1E3A8A "><strong>Paso 3 </strong>
                                                    Al final del formulario haga clic en el botón actualizar.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('admin.recursos.suscribir') }}"
                                        class="mt-3 row" id="form-participantes" enctype="multipart/form-data">
                                        <div class="pl-3 row w-100">
                                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
                                                    participante</label>
                                                <input type="hidden" id="id_empleado">
                                                <input class="form-control" type="text" id="participantes_search"
                                                    placeholder="Busca un empleado" style="position: relative"
                                                    autocomplete="off" />
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
                                                    placeholder="Correo del participante" readonly
                                                    style="cursor: not-allowed" />
                                            </div>
                                        </div>
                                        <div class="col-12" style="margin-bottom: 20px;">
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
                                    <div class="mt-4 w-100" style="border-bottom: solid 2px #345183;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Registrar calificación</span>
                                        <span id="participante_seleccionado"></span>
                                    </div>
                                    <div class="mt-3 form-group col-12">
                                        <form id="form_calificar_participantes"
                                            action="{{ route('admin.recursos.calificar') }}" method="POST"
                                            enctype="multipart/form-data">
                                            <div class="row">
                                                <input type="hidden" id="id_empleado_calificacion" name="id_empleado">
                                                <input type="hidden" id="id_recurso_calificacion" name="id_recurso">
                                                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                    <label for="text"><i
                                                            class="fas fa-edit iconos-crear"></i>Calificación</label>
                                                    <input class="form-control" type="number" id="calificacion"
                                                        name="calificacion" placeholder="Calificación" />
                                                </div>
                                                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                                    <label for="text"><i
                                                            class="fas fa-image iconos-crear"></i>Certificado</label>
                                                    <input class="form-control" type="file" id="certificado"
                                                        name="certificado" placeholder="Certificado"
                                                        accept=".jpg, .png, .gif" />
                                                    <span class="text-xs text-muted">Solo formatos <i
                                                            class="fas fa-image"></i>
                                                        JPG,
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
                                </div>
                            </section>

                        </div>
                    </nav>
                    {{-- <div class="w-100" style="border-bottom: solid 2px #0CA193;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Información general de la capacitación</span>
                    </div> --}}
                    <form id="form-informacion-general" method="POST"
                        action="{{ route('admin.recursos.update', $recurso) }}" enctype="multipart/form-data"
                        class="mt-3 row">
                        @csrf
                        <div class="tab-content col-12" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-general" role="tabpanel"
                                aria-labelledby="nav-general-tab">
                                @include('admin.recursos.components.configuracion-inicial')
                            </div>
                            <div class="tab-pane fade" id="nav-participantes">
                                @include('admin.recursos.components.participantes')
                            </div>
                        </div>
                        <div class="text-right form-group col-12">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                            <button class="btn btn-danger" type="submit" id="btnGuardarRecurso">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            initializeTab();
            initializeLimitDate();
            guardarCapacitacion();

            function limpiarErrores() {
                if (document.querySelectorAll('.errores').length > 0) {
                    document.querySelectorAll('.errores').forEach(element => {
                        element.innerHTML = "";
                    });
                }
            }

            function initializeTab() {
                // const menuActive = localStorage.getItem('menu-capacitaciones-active');
                // $(`#tabsCapacitaciones [data-type="participantes"]`).tab('show');

                $('#tabsCapacitaciones a').on('click', async function(event) {
                    event.preventDefault()
                    const keyTab = this.getAttribute('data-type');
                    if (keyTab == 'participantes') {
                        limpiarErrores();
                        const url = "{{ route('admin.recursos.validateForm') }}";
                        const formData = new FormData(document.getElementById(
                            'form-informacion-general'));
                        formData.append('tipo_validacion', 'general')
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data.errors);
                        if (data.errors) {
                            $.each(data.errors, function(indexInArray,
                                valueOfElement) {
                                document.querySelector(`span.${indexInArray}_error`)
                                    .innerHTML =
                                    `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                            });
                        }
                        if (data.isValid) {
                            $(this).tab('show');
                            localStorage.setItem('menu-capacitaciones-active', 'participantes');
                        }
                    } else {
                        localStorage.setItem('menu-capacitaciones-active', keyTab);
                    }
                });
            }

            function initializeLimitDate() {
                const elFechaInicio = document.getElementById('fecha_curso');
                const elFechaLimite = document.getElementById('fechaLimite');
                // elFechaInicio.addEventListener('change', function(e) {
                //     const fecha = e.target.value;
                //     elFechaLimite.value = fecha;
                // });

                elFechaLimite.addEventListener('change', function(e) {
                    console.log(new Date(elFechaLimite.value));
                    console.log(new Date(elFechaInicio.value));
                    if (new Date(elFechaLimite.value) > new Date(elFechaInicio.value)) {
                        alert('La fecha limite no puede ser mayor a la fecha de inicio');
                        elFechaLimite.value = elFechaInicio.value;
                    }
                })
            }

            function guardarCapacitacion() {
                const btnGuardarRecurso = document.getElementById('btnGuardarRecurso');
                btnGuardarRecurso.addEventListener('click', async function(e) {
                    e.preventDefault();
                    limpiarErrores();
                    if (!hayParticipantes()) {
                        Swal.fire({
                            title: '¡No has agregado participantes!',
                            text: "¿Quieres agregarlos depués?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Agregar Después',
                            cancelButtonText: 'Permanecer'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                const response = await guardarEnElServidor();
                                console.log(response);
                                if (response.status == "success") {
                                    Swal.fire(
                                        '¡Excelente!',
                                        'Capacitación Creada',
                                        'success'
                                    )

                                    setTimeout(() => {
                                        window.location.href =
                                            "{{ route('admin.recursos.index') }}";
                                    }, 1500);
                                } else {
                                    toastr.error('Ocurrió un error');
                                }
                            }
                        })
                    } else {
                        const response = await guardarEnElServidor();
                        console.log(response);
                        if (response.status == "success") {
                            Swal.fire(
                                '¡Excelente!',
                                'Capacitación Creada',
                                'success'
                            )
                            setTimeout(() => {
                                window.location.href =
                                    "{{ route('admin.recursos.index') }}";
                            }, 1500);
                        } else {
                            toastr.error('Ocurrió un error');
                        }
                    }

                })
            }

            async function guardarEnElServidor() {
                try {
                    const url = document.getElementById(
                        'form-informacion-general').getAttribute('action');
                    const formData = new FormData(document.getElementById(
                        'form-informacion-general'));
                    formData.append('tipo_request', 'ajax')
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                    })
                    const data = await response.json();
                    if (data.errors) {
                        $.each(data.errors, function(indexInArray,
                            valueOfElement) {
                            document.querySelector(`span.${indexInArray}_error`)
                                .innerHTML =
                                `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                        });
                    }
                    return data;
                } catch (error) {
                    return error;
                }
            }

            function hayParticipantes() {
                return document.querySelectorAll('.contador-participantes').length > 0;
            }

            window.initSelect2 = () => {
                $('.select2').select2({
                    'theme': 'bootstrap4'
                });
            }
            initSelect2();
            Livewire.on('select2', () => {
                initSelect2();
            });

            Livewire.on('categoriaCapacitacionStore', () => {
                $('#tipoCategoriaCapacitacionModal').modal('hide');
                $('.modal-backdrop').hide();
                document.getElementById('nombre_cat_cap').value = "";
                toastr.success('Categoría creada con éxito');
            });

            let select_activos = document.querySelector('#select_modalidad');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('#font_modalidad_seleccionada');
                if (this.value == 'presencial') {
                    texto_activos.innerHTML = ` Ubicación `;
                } else {
                    texto_activos.innerHTML = ` Link `;
                }


            });
        });
    </script>

@endsection
