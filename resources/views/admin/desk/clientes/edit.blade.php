@extends('layouts.admin')
@section('content')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularios_centro_atencion.css') }}">
    <style type="text/css">
        sup {
            color: red;
        }

        ol.breadcrumb {
            margin-bottom: 0px;
        }

        .select2-results__option {
            position: relative;
            padding-left: 30px !important;

        }

        .select2-selection__rendered {
            padding-left: 30px !important;

        }

        .select2-selection__rendered[title*="Alta"]::before,
        .select2-selection__rendered[title*="Alto"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FF417B;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title*="Media"]::before,
        .select2-selection__rendered[title*="Medio"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FFCB63;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title*="Baja"]::before,
        .select2-selection__rendered[title*="Bajo"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6DC866;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-select_urgencia-results li[id*="Alta"]::before,
        #select2-select_impacto-results li[id*="Alto"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FF417B;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        #select2-select_urgencia-results li[id*="Media"]::before,
        #select2-select_impacto-results li[id*="Medio"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FFCB63;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        #select2-select_urgencia-results li[id*="Baja"]::before,
        #select2-select_impacto-results li[id*="Bajo"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6DC866;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }



        .select2-selection__rendered[title*="Sin atender"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FFCB63;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="Sin atender"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FFCB63;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }



        .select2-selection__rendered[title*="En curso"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #AC84FF;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="En curso"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #AC84FF;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title*="En espera"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6863FF;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="En espera"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6863FF;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title*="Cerrado"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6DC866;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="Cerrado"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6DC866;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title*="No procedente"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FF417B;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="No procedente"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FF417B;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

    </style>
@endsection
{{-- {{ Breadcrumbs::render('quejas-edit', $quejas) }} --}}
@include('partials.flashMessages')
<div class="card">
    <div class="text-center card-header mt-4" style="background-color: #345183;">
        <strong style="font-size: 16pt; color: #fff;"><i class="fas fa-thumbs-down mr-2"></i> Quejas Clientes
        </strong>
    </div>


    <nav>
        @can('centro_atencion_quejas_cliente_editar')
            <div class="nav nav-tabs mt-3" id="tabsCapacitaciones" role="tablist">
                @if ($quejasClientes->responsable_atencion_queja_id != auth()->user()->empleado->id) <a class="nav-link active"
                        data-type="registro_queja" id="nav-registro-tab" data-toggle="tab" href="#nav-registro" role="tab"
                        aria-controls="nav-" aria-selected="true">
                        <i class="fas fa-thumbs-down mr-2"></i>
                        <span>Registro de Queja</span>
                    </a>
                @endif
            @endcan

            @can('centro_atencion_quejas_cliente_editar')
                @if ($quejasClientes->responsable_atencion_queja_id != auth()->user()->empleado->id) <a class="nav-link"
                        data-type="analisis_queja" id="nav-analisis-tab" href="#nav-analisis" style="position:relative">
                        <i class="mr-2 fas fa-clipboard-list"></i>
                        Análisis Inicial de la queja
                    </a>
                @endif
            @endcan

            @if ($quejasClientes->empleado_reporto_id == auth()->user()->empleado->id || auth()->user()->empleado->id)
                <a class="menu_queja_recibida nav-link" data-type="atencion_queja" id="nav-atencion-tab"
                    href="#nav-atencion" style="display:none; position:relative">
                    <i class="mr-2 fas fa-gavel"></i>
                    <span>Atención de la queja</span>
                </a>
            @endif

            @can('centro_atencion_quejas_cliente_editar')
                @if ($quejasClientes->responsable_atencion_queja_id != auth()->user()->empleado->id)
                    <a class="menu_queja_recibida nav-link" data-type="cierre_queja" id="nav-cierre-tab" href="#nav-cierre"
                        style="display:none; position:relative">
                        <i class="mr-2 fas fa-door-closed"></i>Cierre de la queja
                    </a>
                @endif
            @endcan
        </div>
    </nav>
    <div class="card-body">
        @include('admin.recursos.components.parciales.loader')
        <form class="row" method="POST" id="quejas-clientes-form"
            action="{{ route('admin.desk.quejasClientes-update', $quejasClientes) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $quejasClientes->id }}" name="quejas_clientes_id" />
            <div class="tab-content col-12" id="nav-tabContent">
                {{-- @can('acceder_quejas_cliente_registro_queja') --}}
                @can('centro_atencion_quejas_cliente_editar')
                    @if ($quejasClientes->responsable_atencion_queja_id != auth()->user()->empleado->id)
                        <div class="tab-pane fade show active" id="nav-registro" role="tabpanel"
                            aria-labelledby="nav-registro-tab">
                            @include('admin.desk.clientes.atencionQuejas.registro-queja')
                        </div>
                    @endif
                @endcan
                {{-- @endif --}}
                @can('centro_atencion_quejas_cliente_editar')
                    @if ($quejasClientes->responsable_atencion_queja_id != auth()->user()->empleado->id)
                        <div class="tab-pane fade" id="nav-analisis">
                            @include('admin.desk.clientes.atencionQuejas.analisis-queja')
                        </div>
                    @endif
                @endcan
                @if ($quejasClientes->responsable_atencion_queja_id == auth()->user()->empleado->id || auth()->user()->empleado->id)
                    <div class="tab-pane fade {{ $quejasClientes->responsable_atencion_queja_id == auth()->user()->empleado->id ? 'show active' : '' }}"
                        id="nav-atencion">
                        @include('admin.desk.clientes.atencionQuejas.atencion-queja')
                    </div>
                @endcan
                @can('centro_atencion_quejas_cliente_editar')
                    @if ($quejasClientes->responsable_atencion_queja_id != auth()->user()->empleado->id)
                        <div class="tab-pane fade" id="nav-cierre">
                            @include('admin.desk.clientes.atencionQuejas.cierre-queja')
                        </div>
                    @endif
                @endcan
        </div>
    </form>




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
        if (opcion == "Cerrado") {
            var fecha = new Date();
            document.getElementById('solucion').value = fecha.toLocaleString().replaceAll("/", "-");
        } else {
            document.getElementById('solucion').value = "";
        }
    }
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
    $(document).on('change', '#select_metodos', function(event) {
        $(".caja_oculta_dinamica").removeClass("d-block");
        var metodo_v = $("#select_metodos option:selected").attr('data-metodo');
        $(document.getElementById(metodo_v)).addClass("d-block");
    });
</script>



<script type="text/javascript">
    if (document.querySelector('.multiselect_areas select') != null) {
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelector('.multiselect_areas select').addEventListener('change', function(e) {
                e.preventDefault();

                (document.querySelector('.multiselect_areas textarea')).value += `${this.value}, `;

            });
        });

    }

    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.multiselect_empleados select') != null) {
            document.querySelector('.multiselect_empleados select').addEventListener('change', function(e) {
                e.preventDefault();

                (document.querySelector('.multiselect_empleados textarea')).value += `${this.value}, `;

            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.multiselect_procesos select') != null) {
            document.querySelector('.multiselect_procesos select').addEventListener('change', function(e) {
                e.preventDefault();

                (document.querySelector('.multiselect_procesos textarea')).value += `${this.value}, `;

            });
        }
    });
</script>



<script type="text/javascript">
    Livewire.on('planStore', () => {

        $('#planAccionModal').modal('hide');

        $('.modal-backdrop').hide();

        toastr.success('Plan de Acción creado con éxito');

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

<script type="text/javascript">
    $(document).ready(function() {
        let canal = @json($quejasClientes->canal);
        if (canal == 'Otro') {

            $('#campos_otro').removeClass('d-none')

        } else {

            $('#campos_otro').addClass('d-none')

        }
    })


    $(document).on('change', '#otros_campo', function(event) {
        if ($('#otros_campo option:selected').attr('value') == 'Otro') {
            $('#campos_otro').removeClass('d-none');
        } else {
            $('#campos_otro').addClass('d-none');
        }
    });
</script>


<script>
    $(document).ready(function() {
        let categoria_queja = @json($quejasClientes->categoria_queja);
        if (categoria_queja == 'Otro') {

            $('#camposQuejaOtro').removeClass('d-none')

        } else {

            $('#camposQuejaOtro').addClass('d-none')

        }
    })

    $(document).on('change', '#categoria_otros', function(event) {
        if ($('#categoria_otros option:selected').attr('value') == 'Otro') {
            $('#camposQuejaOtro').removeClass('d-none');
        } else {
            $('#camposQuejaOtro').addClass('d-none');
        }
    });
</script>

<script>
    $(document).ready(function() {
        let realizarAcciones = @json($quejasClientes->realizar_accion);
        if (realizarAcciones == true) {

            $("#contenidoAccion").fadeIn(100);

        } else {

            $("#contenidoAccion").fadeOut(100);

        }
    })

    $('.accion_inmediata input[value="1"]').click(function() {
        $("#contenidoAccion").fadeIn(100);
    });

    $('.accion_inmediata input[value="2"]').click(function() {
        $("#contenidoAccion").fadeOut(100);
    });
</script>

<script>
    $(document).ready(function() {
        let deseaLevantarAc = @json($quejasClientes->desea_levantar_ac);
        if (deseaLevantarAc == true) {

            $("#indicaciones_levantamiento").fadeIn(100);

        } else {

            $("#indicaciones_levantamiento").fadeOut(100);

        }
    })

    $('.levantamiento_ac input[value="1"]').click(function() {
        $("#indicaciones_levantamiento").fadeIn(100);
    });

    $('.levantamiento_ac input[value="2"]').click(function() {
        $("#indicaciones_levantamiento").fadeOut(100);
    });
</script>

<script>
    $(document).ready(function() {
        let cumplioAc = @json($quejasClientes->cumplio_ac_responsable);
        if (cumplioAc == true) {

            $("#porqueNoCumplio").fadeIn(100);

        } else {

            $("#porqueNoCumplio").fadeOut(100);

        }
    })

    $('.aCumplidoResponsable input[value="1"]').click(function() {
        $("#porqueNoCumplio").fadeIn(100);
    });

    $('.aCumplidoResponsable input[value="2"]').click(function() {
        $("#porqueNoCumplio").fadeOut(100);
    });
</script>

<script>
    $(document).ready(function() {
        let ticketSiCerrado = @json($quejasClientes->cerrar_ticket);
        if (ticketSiCerrado == true) {

            $("#ticketcerrado").fadeIn(100);

        } else {

            $("#ticketcerrado").fadeOut(100);

        }
    })

    $('.preguntaCierreTicket input[value="1"]').click(function() {
        $("#ticketcerrado").fadeIn(100);
    });

    $('.preguntaCierreTicket input[value="2"]').click(function() {
        $("#ticketcerrado").fadeOut(100);
    });
</script>


<script>
    $(document).ready(function() {
        let visualizarQuejaProcedente = @json($quejasClientes->queja_procedente);
        if (visualizarQuejaProcedente == true) {

            $("#contenedor_queja_procedente").fadeIn(100);
            $(".menu_queja_recibida").fadeIn(100);
            $("#porque_queja_procedente").fadeOut(100);
            $("#siguiente_analisis").fadeIn(100);

        } else {

            $("#contenedor_queja_procedente").fadeOut(100);
            $(".menu_queja_recibida").fadeOut(100);
            $("#porque_queja_procedente").fadeIn(100);
            $("#siguiente_analisis").fadeOut(100);
        }
    })

    $('.pregunta_queja_procedente input[value="1"]').click(function() {
        $("#contenedor_queja_procedente").fadeIn(100);
        $(".menu_queja_recibida").fadeIn(100);
        $("#porque_queja_procedente").fadeOut(100);
        $("#siguiente_analisis").fadeIn(100);
    });

    $('.pregunta_queja_procedente input[value="2"]').click(function() {
        $("#contenedor_queja_procedente").fadeOut(100);
        $(".menu_queja_recibida").fadeOut(100);
        $("#porque_queja_procedente").fadeIn(100);
        $("#siguiente_analisis").fadeOut(100);
    });
</script>

<script type="text/javascript">
    var prioridad = 0;
    var impacto = 0;
    var urgencia = 0;
    var prioridad_nombre = '';
    let color = "red";
    let colorText = "black";
    urgencia = Number($('#select_urgencia option:selected').attr('data-urgencia'));
    impacto = Number($('#select_impacto option:selected').attr('data-impacto'));
    prioridad = urgencia + impacto;
    establecerPrioridad(prioridad);

    function establecerPrioridad(prioridad) {
        if (prioridad != null) {
            prioridad_nombre = '';
            color = "white";
            colorText = "black";
        }
        if (prioridad <= 2) {
            prioridad_nombre = 'Baja';
            color = "#6DC866";
            colorText = "white";
        }
        if (prioridad >= 3) {
            prioridad_nombre = 'Media';
            color = "#FFCB63";
            colorText = "white";
        }
        if (prioridad >= 5) {
            prioridad_nombre = 'Alta';
            color = "#FF417B";
            colorText = "white";
        }
        if (document.getElementById("prioridad") != null) {
            document.getElementById("prioridad").value = prioridad_nombre;
            document.getElementById("prioridad").style.background = color;
            document.getElementById("prioridad").style.color = colorText;
        }
    }


    $(document).on('change', '#select_urgencia', function(event) {
        urgencia = Number($('#select_urgencia option:selected').attr('data-urgencia'));

        prioridad = urgencia + impacto;

        establecerPrioridad(prioridad)
    });
    $(document).on('change', '#select_impacto', function(event) {
        impacto = Number($('#select_impacto option:selected').attr('data-impacto'));

        prioridad = urgencia + impacto;

        establecerPrioridad(prioridad)

    });
</script>

<script>
    if (document.querySelector('#responsable_atencion_queja_id') != null) {

        let atencion = document.querySelector('#responsable_atencion_queja_id');
        let area_init = atencion.options[atencion.selectedIndex].getAttribute('data-area');
        let puesto_init = atencion.options[atencion.selectedIndex].getAttribute('data-puesto');
        document.getElementById('atencion_puesto').innerHTML = recortarTexto(puesto_init);
        document.getElementById('atencion_area').innerHTML = recortarTexto(area_init);

        atencion.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('atencion_puesto').innerHTML = recortarTexto(puesto)
            document.getElementById('atencion_area').innerHTML = recortarTexto(area)
        })
    }

    if (document.querySelector('#responsable_sgi_id') != null) {
        let autorizo = document.querySelector('#responsable_sgi_id');
        let area = autorizo.options[autorizo.selectedIndex].getAttribute('data-area');
        let puesto = autorizo.options[autorizo.selectedIndex].getAttribute('data-puesto');
        document.getElementById('responsable_sgi_puesto').innerHTML = recortarTexto(puesto)
        document.getElementById('responsable_sgi_area').innerHTML = recortarTexto(area)



        autorizo.addEventListener('change', function(e) {
            e.preventDefault();

            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');

            document.getElementById('responsable_sgi_puesto').innerHTML = recortarTexto(puesto)
            document.getElementById('responsable_sgi_area').innerHTML = recortarTexto(area)
        })
    }



    function recortarTexto(texto, length = 30) {
        let trimmedString = texto?.length > length ?
            texto.substring(0, length - 3) + "..." :
            texto;
        return trimmedString;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        initializeTab();
        let quejaClienteIdModel = @json($quejasClientes->id);
        if (document.getElementById('btn-siguiente-registro') != null) {
            let btnSiguienteRegistro = document.getElementById('btn-siguiente-registro');
            console.log(btnSiguienteRegistro);
            btnSiguienteRegistro.addEventListener('click', (e) => {
                e.preventDefault();
                validarGuardarQuejaRegistro();
            })
        }
        if (document.getElementById('btn-guardar-registro') != null) {
            let btnGuardarRegistro = document.getElementById('btn-guardar-registro');
            btnGuardarRegistro.addEventListener('click', (e) => {
                e.preventDefault();
                validarGuardarQuejaRegistro(true);
            })
        }
        if (document.getElementById('siguiente_analisis') != null) {
            let btnSiguienteAnalisis = document.getElementById('siguiente_analisis');
            btnSiguienteAnalisis.addEventListener('click', (e) => {
                e.preventDefault();
                validarGuardarAnalisisQueja();
            })
        }
        if (document.getElementById('btn-guardar-analisis') != null) {
            let btnGuardarAnalisis = document.getElementById('btn-guardar-analisis');
            btnGuardarAnalisis.addEventListener('click', (e) => {
                e.preventDefault();
                validarGuardarAnalisisQueja(true);
            })
        }
        if (document.getElementById('btn-guardar-atencion') != null) {
            let btnGuardarAtencion = document.getElementById('btn-guardar-atencion');
            btnGuardarAtencion.addEventListener('click', (e) => {
                e.preventDefault();
                validarGuardarAtencionQueja(true);

            })
        }
        if (document.getElementById('siguiente_atencion') != null) {
            let btnSiguienteAtencion = document.getElementById('siguiente_atencion');
            btnSiguienteAtencion.addEventListener('click', (e) => {
                e.preventDefault();
                validarGuardarAtencionQueja();
            })
        }
        if (document.getElementById('btn-guardar-cierre') != null) {
            let btnGuardarCierre = document.getElementById('btn-guardar-cierre');
            btnGuardarCierre.addEventListener('click', (e) => {
                e.preventDefault();
                validarGuardarCierreQueja(true);
            })
        }

        function limpiarErrores() {
            if (document.querySelectorAll('.errores').length > 0) {
                document.querySelectorAll('.errores').forEach(element => {
                    element.innerHTML = "";
                });
            }
        }

        function mostrarLoader() {
            const loaderCapacitaciones = document.getElementById('loaderCapacitaciones');
            loaderCapacitaciones.style.display = 'flex';
        }

        function ocultarLoader() {
            const loaderCapacitaciones = document.getElementById('loaderCapacitaciones');
            loaderCapacitaciones.style.display = 'none';
        }

        function guardarEnElServidorQuejaCliente(formData, quejaCliente, idTab, soloGuadar = false) {
            let url = "{{ route('admin.desk.quejasClientes-update', ':id') }}";
            url = url.replaceAll(':id', quejaCliente);
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.estatus == 200) {
                        if (soloGuadar) {
                            window.location.href = "{{ route('admin.desk.index') }}";
                        } else {
                            $(idTab).tab('show');
                        }
                    }
                },
                error: function(request, estatus, error) {
                    toastr.error(error);
                }
            });
        }

        async function validarGuardarQuejaRegistro(soloGuardar = false) {
            const url =
                "{{ route('admin.desk.quejasClientes.validateFormQuejaCliente') }}";
            const formData = new FormData(document.getElementById(
                'quejas-clientes-form'));
            formData.append('tipo_validacion', 'queja-registro');
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
                ocultarLoader();
                $.each(data.errors, function(indexInArray,
                    valueOfElement) {
                    document.querySelector(`span.${indexInArray}_error`)
                        .innerHTML =
                        `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                });
            }
            if (data.isValid) {
                ocultarLoader();
                guardarEnElServidorQuejaCliente(formData, quejaClienteIdModel, '#nav-analisis-tab',
                    soloGuardar);
                // $(this).tab('show');
                localStorage.setItem('menu-quejas-clientes', 'queja-analisis');
            }
        }

        async function validarGuardarAnalisisQueja(soloGuardar = false) {
            const url =
                "{{ route('admin.desk.quejasClientes.validateFormQuejaCliente') }}";
            const formData = new FormData(document.getElementById(
                'quejas-clientes-form'));
            formData.append('tipo_validacion', 'queja-analisis')
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });

            const data = await response.json();
            console.log(data.errors);
            if (data.errors) {
                ocultarLoader();
                $.each(data.errors, function(indexInArray,
                    valueOfElement) {
                    document.querySelector(`span.${indexInArray}_error`)
                        .innerHTML =
                        `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                });
            }
            if (data.isValid) {
                ocultarLoader();
                guardarEnElServidorQuejaCliente(formData, quejaClienteIdModel, '#nav-atencion-tab',
                    soloGuardar);
                // $(this).tab('show');
                localStorage.setItem('menu-quejas-clientes', 'queja-atencion');
            }


        }
        async function validarGuardarAtencionQueja(soloGuardar = false) {
            console.log(soloGuardar);
            const url =
                "{{ route('admin.desk.quejasClientes.validateFormQuejaCliente') }}";
            const formData = new FormData(document.getElementById(
                'quejas-clientes-form'));
            if (!soloGuardar) {
                formData.append('tipo_validacion', 'queja-analisis')
                console.log('no solo gu');
            } else {
                formData.append('tipo_validacion', 'queja-atencion')
                console.log('solo gu');
            }
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
                ocultarLoader();
                $.each(data.errors, function(indexInArray,
                    valueOfElement) {
                    document.querySelector(`span.${indexInArray}_error`)
                        .innerHTML =
                        `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                });
            }
            if (data.isValid) {
                ocultarLoader();
                guardarEnElServidorQuejaCliente(formData, quejaClienteIdModel, '#nav-cierre-tab',
                    soloGuardar);
                // $(this).tab('show');
                localStorage.setItem('menu-quejas-clientes', 'queja-atencion');
            }


        }
        async function validarGuardarAnalisisQueja(soloGuardar = false) {
            const url =
                "{{ route('admin.desk.quejasClientes.validateFormQuejaCliente') }}";
            const formData = new FormData(document.getElementById(
                'quejas-clientes-form'));
            formData.append('tipo_validacion', 'queja-analisis')
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
                ocultarLoader();
                $.each(data.errors, function(indexInArray,
                    valueOfElement) {
                    document.querySelector(`span.${indexInArray}_error`)
                        .innerHTML =
                        `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                });
            }
            if (data.isValid) {
                ocultarLoader();
                guardarEnElServidorQuejaCliente(formData, quejaClienteIdModel, '#nav-atencion-tab',
                    soloGuardar);
                // $(this).tab('show');
                localStorage.setItem('menu-quejas-clientes', 'queja-atencion');
            }


        }
        async function validarGuardarCierreQueja(soloGuardar = false) {
            const url =
                "{{ route('admin.desk.quejasClientes.validateFormQuejaCliente') }}";
            const formData = new FormData(document.getElementById(
                'quejas-clientes-form'));
            formData.append('tipo_validacion', 'queja-atencion')
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
                ocultarLoader();
                $.each(data.errors, function(indexInArray,
                    valueOfElement) {
                    document.querySelector(`span.${indexInArray}_error`)
                        .innerHTML =
                        `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                });
            }
            if (data.isValid) {
                ocultarLoader();
                guardarEnElServidorQuejaCliente(formData, quejaClienteIdModel, '#nav-cierre-tab',
                    soloGuardar);
                // $(this).tab('show');
                localStorage.setItem('menu-quejas-clientes', 'queja-cierre');
            }


        }


        function initializeTab() {
            const menuActive = localStorage.getItem('menu-capacitaciones-active');

            $('#tabsCapacitaciones a').on('click', async function(event) {
                event.preventDefault()
                const keyTab = this.getAttribute('data-type');
                if (keyTab == 'analisis_queja') {

                    limpiarErrores();
                    mostrarLoader();
                    validarGuardarQuejaRegistro()
                } else if (keyTab == 'atencion_queja') {
                    limpiarErrores();
                    mostrarLoader();
                    validarGuardarAnalisisQueja();
                } else if (keyTab == 'cierre_queja') {
                    limpiarErrores();
                    mostrarLoader();
                    const url =
                        "{{ route('admin.desk.quejasClientes.validateFormQuejaCliente') }}";
                    const formData = new FormData(document.getElementById(
                        'quejas-clientes-form'));
                    formData.append('tipo_validacion', 'queja-atencion')
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
                        ocultarLoader();
                        $.each(data.errors, function(indexInArray,
                            valueOfElement) {
                            document.querySelector(`span.${indexInArray}_error`)
                                .innerHTML =
                                `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                        });
                    }
                    if (data.isValid) {
                        ocultarLoader();
                        guardarEnElServidorQuejaCliente(formData, quejaClienteIdModel, this);
                        // $(this).tab('show');
                        localStorage.setItem('menu-quejas-clientes', 'queja-cierre');
                    }
                } else {
                    $(this).tab('show');
                    localStorage.setItem('menu-quejas-clientes', keyTab);
                }
            });
        }
    });
</script>
@endsection
