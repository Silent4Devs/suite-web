<style>
    .iconos-crear {
        font-size: 20pt;
        margin-right: 18px;
    }

    .cedula-diseño tr {

        border: none;

    }

    .cedula-diseño td {

        padding: 0;
    }

    .descarga_archivo {

        cursor: pointer;

    }

    #contenedor_dolares .select-wrapper {
        display: block !important;
    }


    .d-none {
        display: none !important;
    }


    .descarga_archivo:hover {
        color: #26a69a !important;
    }


    .card-panel .txt-frm {
        font-weight: bolder !important;
    }



    /*select*/



    .p-oculta {
        display: none;
    }

    #existCode {
        font-weight: bold;
    }

    .input-code {
        border-bottom: : 2px solid rgb(18, 118, 250) !important;
    }

    .exists {
        border-bottom: : 2px solid red !important;
        color: red !important;
    }

    .not-exists {
        /* border-bottom: 2px solid rgb(18, 250, 114) !important; */
    }

    @media(max-width: 768px) {
        .formulario-tabla-datos-responsiva thead {
            display: none;
        }

        .formulario-tabla-datos-responsiva td {
            display: block;
            width: 80% !important;
        }

        .formulario-tabla-datos-responsiva td .select2.select2-container.select2-container--default {
            max-width: 100% !important;
        }

        .formulario-tabla-datos-responsiva td:before {
            display: block;
        }

        .p-oculta {
            display: block;
        }
    }
</style>
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

<style>
    .kbw-signature {
        width: 100%;
        height: 200px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }
</style>



@if (session('mensajeError'))
    <div class="alert alert-danger">
        {{ session('mensajeError') }}
    </div>
@endif

{{-- <form method="PATH" action="{{ route('contratos.update', $contrato->id) }}" enctype="multipart/form-data"> --}}
@livewire('formulario-editar-contratos-livewire', ['IDContrato' => $contrato->id])
{{-- nuevo diseño --}}

<!-- Modal Structure -->
<div id="convenios_modificados" class="modal"
    style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 50%; background-color: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px; z-index: 1000; padding: 20px;">
    <strong class="txt-frm">Convenios Modificados</strong>
    <ul>
        @foreach ($convenios as $convenio)
            <li style="margin-top:10px; margin-left:20px; font-size:12pt; font-weight: lighter; color:#000;">
                {{ $convenio->no_convenio }}
            </li>
        @endforeach
    </ul>
    <div class="modal-footer" style="text-align: right; margin-top: 10px;">
        <button id="closeModal" class="modal-close waves-effect waves-green btn-flat">Cerrar</button>
    </div>
</div>


<div id="modalOverlay"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
</div>

@if ($aprobacionFirmaContrato->count())
    <div class="col-12">
        <div class="card card-body">
            <h5 class="text-center">Aprobaciones firmadas</h5>
            <div class="d-flex flex-wrap gap-4 mt-4 justify-content-center"
                style="width: 100%; max-width: 1000px; margin: auto;">
                @foreach ($aprobacionFirmaContrato as $firma)
                    @if ($firma->firma)
                        <div class="text-center">
                            <img src="{{ $firma->firma_ruta }}" alt="firma" style="width: 400px;"> <br>
                            <span>{{ \Carbon\Carbon::parse($firma->aprobador->created_at)->format('d/m/Y') }}</span><br>
                            <span>{{ $firma->aprobador->name }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif


<style>
    #firma_aprobador canvas {
        border: 1px solid #bbb;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/lemonadejs/dist/lemonade.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@lemonadejs/signature/dist/index.min.js"></script>
@if ($firmar)
    <div class="col-12">
        <div class="card card-body">
            <form action="{{ route('contract_manager.contratos-katbol.aprobacion-firma-contrato') }}" method="POST">
                @csrf
                <div class="d-flex gap-4 align-items-center flex-column">
                    <div>
                        <h5>Ingrese su firma para la aprobación del registro</h5>
                    </div>
                    <div id="firma_aprobador" class="" style="width: auto;"></div>
                    <input type="hidden" name="firma_base" value="" id="firma-input">
                    <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
                    <div class="d-flex gap-5">
                        <div id="resetCanvas" class="btn btn-outline-secondary">Limpiar</div>
                        <button class="btn btn-primary">Guardar firma</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
<script>
    // Get the element to render signature component inside
    const firma_aprobador = document.getElementById("firma_aprobador");
    const resetCanvas = document.getElementById("resetCanvas");
    resetCanvas.addEventListener("click", () => {
        // console.log(component.getImage());
        component.value = [];
        document.getElementById('firma-input').value = component.getImage();
    });
    document.querySelector('#firma_aprobador').onmouseup = function() {
        document.getElementById('firma-input').value = component.getImage();
    }
    // Call signature with the firma_aprobador element and the options object, saving its reference in a variable
    const component = Signature(firma_aprobador, {
        width: 700,
        height: 300,
        instructions: ""
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script type="text/javascript">
    function miFuncion() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Registro actualizado con éxito.',
            showConfirmButton: false,
        }).then((result) => {
            // Después de que el usuario interactúa con la alerta (o después de que se cierra),
            // redirigir a la misma página
            window.location.href = window.location.href;
        });
    }
</script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.0.3/autoNumeric.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener los elementos del modal y botones
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const modal = document.getElementById('convenios_modificados');
        const overlay = document.getElementById('modalOverlay');

        // Abrir el modal
        openModalButton.addEventListener('click', function() {
            modal.style.display = 'block';
            overlay.style.display = 'block';
        });

        // Cerrar el modal
        closeModalButton.addEventListener('click', function() {
            modal.style.display = 'none';
            overlay.style.display = 'none';
        });

        // Cerrar el modal al hacer clic en el overlay
        overlay.addEventListener('click', function() {
            modal.style.display = 'none';
            overlay.style.display = 'none';
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let no_contrato = document.getElementById('no_contrato');
        let existSpan = document.getElementById('existCode');
        no_contrato.addEventListener('keyup', function(e) {
            e.preventDefault();
            let no_contrato = e.target.value;

            $.ajax({
                type: "POST",
                url: "{{ route('contract_manager.contratos-katbol.checkCode') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    no_contrato
                },
                dataType: "JSON",
                beforeSend: function() {
                    e.target.classList.remove('exists');
                    e.target.classList.remove('not-exists');
                    existSpan.classList.remove('text-success');
                    existSpan.classList.remove('text-danger');
                    existSpan.classList.add('not-exists');
                    e.target.classList.add('input-code');
                    document.querySelector('span.codigo_error').innerHTML = "";
                    existSpan.innerHTML =
                        ` Buscando...`;
                },
                success: function(response) {
                    if (no_contrato == "") {
                        e.target.classList.remove('exists');
                        e.target.classList.remove('not-exists');
                        existSpan.classList.remove('text-success');
                        existSpan.classList.remove('text-danger');
                        existSpan.classList.add('not-exists');
                        e.target.classList.add('input-code');
                        existSpan.innerHTML =
                            ` Ingresa un número de contrato`;
                    } else {
                        if (response.exists) {
                            e.target.classList.remove('not-exists');
                            e.target.classList.remove('input-code');
                            e.target.classList.add('exists');
                            existSpan.classList.remove('text-success');
                            existSpan.classList.add('text-danger');
                            existSpan.innerHTML =
                                ` Número de contrato existente`;
                        } else {
                            e.target.classList.remove('exists');
                            e.target.classList.remove('input-code');
                            e.target.classList.add('not-exists');
                            existSpan.classList.remove('text-danger');
                            existSpan.classList.add('text-success');
                            existSpan.innerHTML =
                                ` Número de contrato disponible`;
                        }
                    }
                }
            });

        });
    });
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
    rel="stylesheet">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

<script type="text/javascript">
    var signaturePad = $('#signaturePad').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.signature('clear');
        $("#signature64").val('');
    });
</script>

<script>
    function replaceSlash(elemento) {
        elemento.value = elemento.value.replace("/", "-");
        elemento.value = elemento.value.replace("\\", "-");
    }
</script>
<script>
    $("#no_contrato").keyup(function(e) {
        let no_contrato = $("#no_contrato").val();
        let id_contrato = $("#contrato_id").val();
        let contenedor = document.querySelector("#validar_no_contrato");
        if (no_contrato == "" || no_contrato == null) {
            contenedor.innerHTML = "";
        }

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/contratos/numero/existe`,
            data: {
                no_contrato,
                id_contrato
            },
            success: function(response) {
                if (response != 0) {
                    if (!response.existe) {
                        // console.log("No Existe");
                        contenedor.innerHTML = "";
                        contenedor.style.color = "green";
                        contenedor.innerHTML = "Número de contrato disponible";
                    } else {
                        contenedor.innerHTML = "";
                        if (response.pertenece) {
                            contenedor.style.color = "green";
                            contenedor.innerHTML = "Número de contrato disponible";
                        } else {
                            contenedor.style.color = "red";
                            contenedor.innerHTML = "Número de contrato existente";
                        }
                    }
                }

            }
        });
    });
</script>
<script>
    function mostrarAlerta() {
        $(".fondo_delete").css("display", "block");
        $(".btn-accion").css("display", "block");
    }

    $(".cancelar").click(function() {
        $(".fondo_delete").css("display", "none");
        $(".btn-accion").css("display", "none");
    });

    $(".btn-accion").click(function() {
        $(".fondo_delete").css("display", "none");
        $(".btn-accion").css("display", "none");
    });
</script>

<script>
    $(document).ready(function() {
        // Verifica si los campos vienen del backend
        let checkFianzaInicial = {{ $contratos->folio ? 'true' : 'false' }};

        // Al cargar la página, ajusta la visibilidad según el valor inicial
        if (checkFianzaInicial) {
            $(".td_fianza").fadeIn(0);
            $('#check_fianza').prop('checked', true);
        } else {
            $(".td_fianza").fadeOut(0);
            $('#check_fianza').prop('checked', false);
        }

        // Al cambiar el checkbox, ajusta la visibilidad
        $(document).on('change', '#check_fianza', function(e) {
            if (this.checked) {
                $(".td_fianza").fadeIn(0);
            } else {
                $(".td_fianza").fadeOut(0);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('.fecha_inicio_contrato').datepicker({
            firstDay: true,
            format: 'dd-mm-yyyy',
            i18n: {
                cancel: 'Cancelar',
                clear: 'Limpar',
                done: 'Ok',
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                    "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct",
                    "Nov", "Dic"
                ],
                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
            },
            //autoclose: false
        });

        $('.fecha_fin_contrato').datepicker({
            firstDay: true,
            format: 'dd-mm-yyyy',
            i18n: {
                cancel: 'Cancelar',
                clear: 'Limpar',
                done: 'Ok',
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                    "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct",
                    "Nov", "Dic"
                ],
                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
            }
        });

        // let fecha_inicio;
        // $(".fecha_inicio_contrato").change(function (e) {
        //     e.preventDefault();
        //     fecha_inicio = moment(e.target.value,'DD-MM-YYYY');
        // });

        $(".fecha_fin_contrato").change(function(e) {
            e.preventDefault();
            let fecha_inicio = moment($('.fecha_inicio_contrato').val(), 'DD-MM-YYYY');
            let fecha_seleccionada = moment(e.target.value, 'DD-MM-YYYY');
            let es_fecha_antes_fecha_fin = fecha_seleccionada.isBefore(fecha_inicio);
            let es_fecha_igual_fecha_fin = fecha_seleccionada.isSame(fecha_inicio);
            if (es_fecha_antes_fecha_fin) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'La fecha de fin del contrato no puede ser anterior a la fecha de inicio del contrato',
                });
                $(".fecha_fin_contrato").val("");
            } else if (es_fecha_igual_fecha_fin) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'La fecha de fin del contrato no puede ser igual a la fecha de inicio del contrato',
                });
                $(".fecha_fin_contrato").val("");
            }
        });

        $(function() {
            new AutoNumeric('#monto_pago', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#minimo', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#maximo', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#dolar', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#dolar_maximo', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#dolar_minimo', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#valor_dol', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });
    });
</script>

{{-- <script>
    $("#dolares_filtro").select2('destroy');
</script> --}}

{{-- <script type="text/javascript">
    $(document).on('change', '#dolares_filtro', function(event) {
        console.log('select');
        if ($('#dolares_filtro option:selected').attr('value') == 'USD') {
            $('#campos_dolares').removeClass('d-none');
        } else {
            $('#campos_dolares').addClass('d-none');
        }

    });
</script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const url = "{{ route('contract_manager.contratos-katbol.validar-documento') }}";
        $('.input-field').click(function(e) {
            $('.input-field:hover').addClass('caja_input_file_activa');
        });

        const fileInput = document.getElementById("file_contrato");
        const statusText = document.getElementById("compressStatus");

        fileInput.addEventListener("change", async (event) => {
            const selectedFile = event.target.files[0];

            if (!selectedFile) {
                statusText.textContent = "No se ha seleccionado ningún archivo.";
                return;
            }

            if (selectedFile.type !== "application/pdf") {
                statusText.textContent = "El archivo seleccionado no es un PDF.";
                return;
            }

            statusText.textContent = "Comprimiendo archivo...";

            try {
                const arrayBuffer = await selectedFile.arrayBuffer();

                const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);

                pdfDoc.setCreator("");
                pdfDoc.setProducer("");

                const compressedPdfBytes = await pdfDoc.save({
                    useObjectStreams: true
                });

                const compressedBlob = new Blob([compressedPdfBytes], {
                    type: "application/pdf"
                });

                const compressedFile = new File([compressedBlob],
                `compressed-${selectedFile.name}`, {
                    type: "application/pdf",
                });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(compressedFile);
                fileInput.files = dataTransfer.files;

                statusText.textContent = `Archivo comprimido exitosamente: ${compressedFile.name}`;
            } catch (error) {
                console.error("Error al comprimir el PDF:", error);
                statusText.textContent = "Ocurrió un error al comprimir el archivo.";
            }
        });

        // $('.input_file_validar').change(function(e) {

        //     $('.caja_input_file_activa .errors').remove();
        //     let loader_file = $('<div>');
        //     loader_file.addClass('progress');
        //     loader_file.addClass('d-none');
        //     $('.caja_input_file_activa').append(loader_file);
        //     let loader_progres_file = $('<div>');
        //     loader_progres_file.addClass('indeterminate');
        //     $('.caja_input_file_activa .progress').append(loader_progres_file);

        //     let file = e.target.files[0];
        //     let formData = new FormData();
        //     formData.append('file', file);
        //     $.ajax({
        //         xhr: function() {
        //             let xhr = new window.XMLHttpRequest();
        //             xhr.upload.addEventListener("progress", function(evt) {


        //                 if (evt.lengthComputable) {
        //                     let percentComplete = (evt.loaded / evt.total) * 100;
        //                     // Place upload progress bar visibility code here
        //                     $('.caja_input_file_activa .progress').removeClass(
        //                         'd-none');
        //                     if (percentComplete == 100) {

        //                     }
        //                 }
        //             }, false);
        //             return xhr;
        //         },

        //         url: url,

        //         data: formData,

        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },

        //         type: 'POST',

        //         dataType: 'json',

        //         contentType: false,
        //         processData: false,

        //         success: function(json) {
        //             console.log('json');
        //         },

        //         error: function(request, status, error) {
        //             console.log('Disculpe, existió un problema');
        //             $.each(request.responseJSON.errors, function(indexInArray,
        //                 valueOfElement) {
        //                 console.log(indexInArray);

        //                 let error_small = $('<small>');
        //                 error_small.addClass(`${indexInArray}_error`);
        //                 error_small.addClass('errors');
        //                 $('.caja_input_file_activa').append(error_small);

        //                 document.querySelector(
        //                         `.caja_input_file_activa .${indexInArray}_error`)
        //                     .innerHTML =
        //                     ` ${valueOfElement[0]}`;

        //                 e.target.value = '';
        //             });
        //         },

        //         complete: function(jqXHR, status) {
        //             console.log('Petición realizada');
        //             $('.caja_input_file_activa .progress').remove();
        //             $('.caja_input_file_activa').removeClass('caja_input_file_activa');
        //         }
        //     });
        // });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#update-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Create a FormData object from the form
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'), // Form action URL
                method: $(this).attr('method'), // Form method
                data: formData,
                processData: false, // Prevent jQuery from automatically transforming the data into a query string
                contentType: false, // Set the content type to false as jQuery will tell the server it's a query string request
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr) {
                    var errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("#aprobadores").select2({
            theme: "bootstrap4",
        });
    });

    document.getElementById('aprobadores_firma').addEventListener('change', (e) => {
        console.log(e.target.checked);
        if (e.target.checked) {
            document.getElementById('aprobadores-firma-box').classList.remove('d-none');
        } else {
            document.getElementById('aprobadores-firma-box').classList.add('d-none');
        }
    });
</script>
