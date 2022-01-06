@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.recursos.create') }}
    <style>
        .select2 {
            margin-top: 0 !important;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Capacitación </h3>
        </div>
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

                        </div>
                    </nav>
                    {{-- <div class="w-100" style="border-bottom: solid 2px #0CA193;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Información general de la capacitación</span>
                    </div> --}}
                    <form id="form-informacion-general" method="POST" action="{{ route('admin.recursos.store') }}"
                        enctype="multipart/form-data" class="mt-3 row">
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
                elFechaInicio.addEventListener('change', function(e) {
                    const fecha = e.target.value;
                    elFechaLimite.value = fecha;
                });

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
                    const url = "{{ route('admin.recursos.store') }}";
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
