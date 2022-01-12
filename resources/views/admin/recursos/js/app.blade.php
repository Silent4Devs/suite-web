<script>
    // $(document).ready(function() {
    document.addEventListener('DOMContentLoaded', function() {
        initializeTab();
        initializeLimitDate();
        guardarCapacitacion();
        draftCapacitacion();

        function limpiarErrores() {
            if (document.querySelectorAll('.errores').length > 0) {
                document.querySelectorAll('.errores').forEach(element => {
                    element.innerHTML = "";
                });
            }
        }

        function initializeTab() {
            // const menuActive = localStorage.getItem('menu-capacitaciones-active');
            // $(`#tabsCapacitaciones [data-type="invitaciones"]`).tab('show');

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
                } else if (keyTab == 'invitaciones') {
                    limpiarErrores();
                    const url = "{{ route('admin.recursos.validateForm') }}";
                    const formData = new FormData(document.getElementById(
                        'form-informacion-general'));
                    formData.append('tipo_validacion', 'participantes')
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
                    $(this).tab('show');
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
                        text: "¿Quieres agregarlos después?",
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

        function draftCapacitacion() {
            const btnGuardarDraftRecurso = document.getElementById('btnGuardarDraftRecurso');
            btnGuardarDraftRecurso.addEventListener('click', async function(e) {
                e.preventDefault();
                limpiarErrores();
                if (!hayParticipantes()) {
                    Swal.fire({
                        title: '¡No has agregado participantes!',
                        text: "¿Quieres agregarlos después?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Agregar Después',
                        cancelButtonText: 'Permanecer'
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            const response = await guardarEnElServidor('Borrador');
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
                    const response = await guardarEnElServidor('Borrador');
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

        async function guardarEnElServidor(tipo = 'Enviado') {
            try {
                const url = document.getElementById(
                    'form-informacion-general').getAttribute('action');
                const formData = new FormData(document.getElementById(
                    'form-informacion-general'));
                formData.append('tipo_request', 'ajax')
                formData.append('tipo_guardado', tipo)
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
