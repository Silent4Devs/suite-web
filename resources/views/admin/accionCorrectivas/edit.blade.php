@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.accion-correctivas.create') }}

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularios_centro_atencion.css') }}">
@endsection

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Acción Correctiva </h3>
    </div>
    @include('layouts.errors')
    @include('flash::message')
    <div class="card-body">

        <div class="container">
            <div class="row">

                <div class="caja_botones_menu">
                    <a href="#" data-tabs="contenido1" class="btn_activo"><i class="mr-2 fas fa-diagnoses"
                            style="font-size:30px;" style="text-decoration:none;"></i>Acción Correctiva</a>
                    <a href="#" data-tabs="contenido2"><i class="mr-2 fab fa-medapps" style="font-size:30px;"
                            style="text-decoration:none;"></i> Ánalisis de causa raíz</a>
                    <a href="#" data-tabs="contenido3"><i class="mr-2 fas fa-file-alt" style="font-size:30px;"
                            style="text-decoration:none;"></i>Plan de acción</a>
                </div>


                {{-- <button id="acollapseExample" data-toggle="collapse" onclick="closetabcollap1()"
                            data-target="#collapseExample" class="btn btn-danger">Acción Correctiva</button>
                        <button id="acollapseplan" data-toggle="collapse" onclick="closetabcollap2()"
                            data-target="#collapseplan" class="btn btn-primary">Análisis de causa raíz</button>
                        <button id="acollapseactividad" data-toggle="collapse" onclick="" data-target="#"
                            class="btn btn-primary">Plan de acción</button> --}}
                <div class="caja_caja_secciones">
                    <div class="caja_secciones">

                        <section id="contenido1" class="caja_tab_reveldada">
                            <div>

                                <div id="test-nl-1" class="mt-5 content">
                                    @include('admin.accionCorrectivas.editform1')

                                </div>

                            </div>
                        </section>

                        <section id="contenido2">
                            <div>
                                <div class="mt-2 ml-2">
                                    @include('admin.accionCorrectivas.editform2')
                                </div>
                            </div>
                        </section>

                        <section id="contenido3">
                            <div class="mt-2 ml-2">
                                @include('admin.accionCorrectivas.editform3')
                            </div>
                        </section>

                    </div>
                </div>


            </div>

        @endsection



        @section('scripts')
            <script type="text/javascript">
                const formatDate = (current_datetime) => {
                    let formatted_date = current_datetime.getFullYear() + "-" + (current_datetime.getMonth() + 1) + "-" +
                        current_datetime.getDate() + " " + current_datetime.getHours() + ":" + current_datetime.getMinutes() +
                        ":" + current_datetime.getSeconds();
                    return formatted_date;
                }

                function cambioOpciones() {
                    var combo = document.getElementById('opciones');
                    var opcion = combo.value;
                    if (opcion == "cerrado") {
                        var fecha = new Date();
                        document.getElementById('solucion').value = formatDate(fecha);
                    } else {
                        document.getElementById('solucion').value = "";
                    }
                }

                function cambioOpciones() {
                    var combo = document.getElementById('opciones');
                    var opcion = combo.value;
                    if (opcion == "cerrado") {
                        var fecha = new Date();
                        document.getElementById('solucion').value = fecha.toISOString();
                    } else {
                        document.getElementById('solucion').value = "";
                    }
                }

                document.addEventListener('DOMContentLoaded', function() {
                    let select_activos = document.querySelector('.areas_multiselect #activos');
                    select_activos.addEventListener('change', function(e) {
                        e.preventDefault();
                        let texto_activos = document.querySelector('.areas_multiselect #texto_activos');

                        texto_activos.value += `${this.value}, `;

                    });
                });
                document.addEventListener('DOMContentLoaded', function() {
                    let select_activos = document.querySelector('.procesos_multiselect #activos');
                    select_activos.addEventListener('change', function(e) {
                        e.preventDefault();
                        let texto_activos = document.querySelector(
                            '.procesos_multiselect #texto_activos');

                        texto_activos.value += `${this.value}, `;

                    });
                });
                document.addEventListener('DOMContentLoaded', function() {
                    let select_activos = document.querySelector('.activos_multiselect #activos');
                    select_activos.addEventListener('change', function(e) {
                        e.preventDefault();
                        let texto_activos = document.querySelector(
                            '.activos_multiselect #texto_activos');

                        texto_activos.value += `${this.value}, `;

                    });
                });
            </script>
            <script type="text/javascript">
                $(document).on('change', '#select_metodos', function(event) {
                    $(".caja_oculta_dinamica").removeClass("d-block");
                    var metodo_v = $("#select_metodos option:selected").attr('data-metodo');
                    $(document.getElementById(metodo_v)).addClass("d-block");
                });
            </script>

            <script type="text/javascript">
                $(document).ready(function() {
                    window.tbl_plan = $("#tabla_plan_accion").DataTable({
                        ajax: "{{ route('admin.accion-correctiva-actividades.index', $accionCorrectiva->id) }}",
                        buttons: [],
                        columns: [{
                                data: 'id'
                            },
                            {
                                data: 'actividad'
                            },
                            {
                                data: 'fecha_inicio'
                            },
                            {
                                data: 'fecha_fin'
                            },
                            {
                                data: 'prioridad'
                            },
                            {
                                data: 'tipo'
                            },
                            {
                                data: 'id',
                                render: function(data, type, row, meta) {
                                    let lista = '<ul>';
                                    row.responsables.forEach(responsable => {
                                        lista += `<li>${responsable.name}</li>`;
                                    })
                                    lista += '</ul>';

                                    return lista;
                                }
                            },
                            {
                                data: 'comentarios'
                            },
                        ]
                    });
                });
            </script>

            <script type="text/javascript">
                $(".btn_modal_form").click(function() {
                    $(".modal_form_plan").addClass("modal_vista_plan");
                    $(".select2").select2({
                        theme: 'bootstrap4'
                    });
                });
                $(".modal_form_plan .btn.btn_cancelar").click(function() {
                    $(".modal_form_plan").removeClass("modal_vista_plan");
                });

                $(".fondo_modal").click(function() {
                    $(".modal_form_plan").removeClass("modal_vista_plan");
                });

                $(".btn_enviar_form_modal").click(function(e) {
                    e.preventDefault();
                    let datos = $('#form_plan_accion').serialize();
                    let url = document.getElementById('form_plan_accion').getAttribute('action')

                    $.ajax({
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        data: datos,
                        beforeSend: function() {
                            toastr.info('Validando y Guardando');
                        },
                        success: function(response) {
                            if (response.success) {
                                $(".modal_form_plan").removeClass("modal_vista_plan");
                                tbl_plan.ajax.reload();
                                limpiarCampos();
                                Swal.fire('Actividad Creada', 'La actividad ha sido creada con éxito',
                                    'success');
                            }
                        },
                        error: function(request, status, error) {
                            document.querySelectorAll('.errors').forEach(error => {
                                error.innerHTML = "";
                            });
                            $.each(request.responseJSON.errors, function(indexInArray, valueOfElement) {
                                console.log(valueOfElement, indexInArray);
                                $(`span.error_${indexInArray}`).text(valueOfElement[0]);

                            });
                        }
                    });
                });


                function limpiarCampos() {

                    document.getElementById('actividad').value = "";
                    document.getElementById('fecha_inicio').value = "";
                    document.getElementById('fecha_fin').value = "";
                    document.getElementById('prioridad').value = "";
                    document.getElementById('tipo').value = "";
                    document.getElementById('responsables').value = "";
                    document.getElementById('comentarios').value = "";

                }
            </script>

            <script type="text/javascript">
                $(document).on('change', '#select_categoria', function(event) {
                    $("#select_subcategorias option").addClass("d-none");
                    var categoria_selected = $("#select_categoria option:selected").attr('id');
                    $(document.getElementsByClassName(categoria_selected)).removeClass("d-none");
                });
            </script>

            <script type="text/javascript">
                var prioridad = 0;
                var impacto = 0;
                var urgencia = 0;
                var prioridad_nombre = '';

                urgencia = new Number($('#select_urgencia option:selected').attr('data-urgencia'));
                impacto = new Number($('#select_impacto option:selected').attr('data-impacto'));
                prioridad = urgencia + impacto;
                if (prioridad <= 2) {
                    prioridad_nombre = 'Baja';
                }
                if (prioridad >= 3) {
                    prioridad_nombre = 'Media';
                }
                if (prioridad >= 5) {
                    prioridad_nombre = 'Alta';
                }
                $("#prioridad").html(prioridad_nombre);



                $(document).on('change', '#select_urgencia', function(event) {
                    urgencia = new Number($('#select_urgencia option:selected').attr('data-urgencia'));

                    prioridad = urgencia + impacto;



                    if (prioridad <= 2) {
                        prioridad_nombre = 'Baja';
                    }
                    if (prioridad >= 3) {
                        prioridad_nombre = 'Media';
                    }
                    if (prioridad >= 5) {
                        prioridad_nombre = 'Alta';
                    }

                    $("#prioridad").html(prioridad_nombre);
                });
                $(document).on('change', '#select_impacto', function(event) {
                    impacto = new Number($('#select_impacto option:selected').attr('data-impacto'));

                    prioridad = urgencia + impacto;

                    if (prioridad <= 2) {
                        prioridad_nombre = 'Baja';
                    }
                    if (prioridad >= 3) {
                        prioridad_nombre = 'Media';
                    }
                    if (prioridad >= 5) {
                        prioridad_nombre = 'Alta';
                    }

                    $("#prioridad").html(prioridad_nombre);
                });
            </script>

            <script>
                const formatDate = (current_datetime) => {
                    let formatted_date = current_datetime.getFullYear() + "-" + (current_datetime.getMonth() + 1) + "-" +
                        current_datetime.getDate() + " " + current_datetime.getHours() + ":" + current_datetime.getMinutes() +
                        ":" + current_datetime.getSeconds();
                    return formatted_date;
                }

                function cambioOpciones() {
                    var combo = document.getElementById('opciones');
                    var opcion = combo.value;
                    if (opcion == "cerrado") {
                        var fecha = new Date();
                        document.getElementById('solucion').value = formatDate(fecha);
                    } else {
                        document.getElementById('solucion').value = "";
                    }
                }
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function(e) {

                    let reporto = document.querySelector('#id_reporto');
                    let area_init = reporto.options[reporto.selectedIndex].getAttribute('data-area');
                    let puesto_init = reporto.options[reporto.selectedIndex].getAttribute('data-puesto');
                    document.getElementById('reporto_puesto').innerHTML = puesto_init
                    document.getElementById('reporto_area').innerHTML = area_init

                    let registro = document.querySelector('#id_registro');
                    let area = registro.options[registro.selectedIndex].getAttribute('data-area');
                    let puesto = registro.options[registro.selectedIndex].getAttribute('data-puesto');
                    document.getElementById('registro_puesto').innerHTML = puesto
                    document.getElementById('registro_area').innerHTML = area


                    reporto.addEventListener('change', function(e) {
                        e.preventDefault();
                        let area = this.options[this.selectedIndex].getAttribute('data-area');
                        let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                        document.getElementById('reporto_puesto').innerHTML = puesto
                        document.getElementById('reporto_area').innerHTML = area
                    })
                    registro.addEventListener('change', function(e) {
                        e.preventDefault();
                        let area = this.options[this.selectedIndex].getAttribute('data-area');
                        let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                        document.getElementById('registro_puesto').innerHTML = puesto
                        document.getElementById('registro_area').innerHTML = area
                    })

                });
            </script>

        @endsection
