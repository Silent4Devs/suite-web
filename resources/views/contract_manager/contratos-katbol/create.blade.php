@extends('layouts.admin')

@section('content')
    {{ Breadcrumbs::render('contratos-katbol_formulario') }}

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
    </head>
    <style>
        .kbw-signature {
            width: 100%;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
        .iconos-crear {
            font-size: 20pt;
            margin-right: 18px;
        }

        .p-oculta {
            display: none;
        }

        .alert-contrato-file {
            text-align: center;
            font-size: 12pt;
            color: #3e3e3e;
            border: 2px solid #26a69a !important;
            background: #38c88dd1;
            border-radius: 10px;
            padding: 3px;
            font-weight: bolder;
        }

        .alert-contrato-async {
            text-align: center;
            font-size: 12pt;
            color: #3e3e3e;
            border: 2px solid #2659a6 !important;
            background: #388ec8d1;
            border-radius: 10px;
            padding: 3px;
            font-weight: bolder;
        }

        #contenedor_dolares .select-wrapper {
            display: block !important;
        }


        .d-none {
            display: none !important;
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

            #contenedor_dolares .select-wrapper {
                display: block !important;
            }

        }

        div.recuadro-instruccion {
            width: 688px;
            height: 46px;
            background: #FFFBEE;
            border: 1px solid #FFA200;
            border-radius: 9px;
            opacity: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FF8000;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

    {{-- @include('admin.bitacora.table') --}}

    <div class="card card-body">
        <div>
            <div class="row">
                <div class="col m12" style="margin-top: 30px;">
                    <h3 class="titulo-form">INSTRUCCIONES</h3>
                    <p class="instrucciones">Por favor ingrese los datos del contrato para poder darlo de alta</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="">
                        <label>
                            {{-- <input type="checkbox" class="filled-in" checked="checked" /> --}}
                            <input type="checkbox" name="aprobadores_firma" id="aprobadores_firma" value="1"
                                style="width: 20px; height: 20px; vertical-align:middle;" />
                            <span>Activar flujo de aprobación</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row d-none" id="aprobadores-firma-box">
                <div class="col-md-12 form-group">
                    <label for="">Asignar Aprobadores</label>
                    <select name="aprobadores_firma[]" id="aprobadores" multiple class="form-control">
                        @if ($firma)
                            @foreach ($firma->aprobadores as $aprobador)
                                <option value="{{ $aprobador->id }}">
                                    {{ $aprobador->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="">No aprobadores available</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

        @livewire('formulario-crear-contratos-livewire')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

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
        });
    </script>

    <script type="text/javascript">
        function showContent() {
            element = document.getElementById("no_contrato");
            check = document.getElementById("check");
            if (check.checked) {
                element.style.visibility = 'hidden';
            } else {
                element.style.visibility = 'visible';
            }
        }
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

    <script>
        //Upload in tmp folder
        document.addEventListener('DOMContentLoaded', function() {
            window.random = (length =
                8) => { // Generate Random name for contracts files when it are uploaded in tmp folder
                let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let str = '';
                for (let i = 0; i < length; i++) {
                    str += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return str;
            };

            const clearErrors = () => {
                document.querySelectorAll(".errors").forEach(item => {
                    item.innerHTML = '';
                })
            }

            const inputFile = document.getElementById('adjuntarContrato');
            const url = "{{ route('contract_manager.contratos-katbol.fileUploadTmp') }}";
            inputFile.addEventListener('change', function(e) {
                const formData = new FormData();
                const tmpName = this.getAttribute('tmp-file-name');
                const uploadedFile = this.files[0];
                formData.append('file', uploadedFile);
                formData.append('tmpFileName', tmpName);
                $.ajax({
                    xhr: function() {
                        let xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                let percentComplete = (evt.loaded / evt.total) * 100;
                                // Place upload progress bar visibility code here
                                document.getElementById(
                                        'progressUploadContract').style.width =
                                    `${Math.ceil(percentComplete)}%`;
                                if (percentComplete == 100) {
                                    document.getElementById('loaderContractTmpFile')
                                        .style.display = 'block';
                                }
                            }
                        }, false);
                        return xhr;
                    },
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        clearErrors();
                        document.getElementById('btnGuardar').setAttribute('disabled', true)
                        document.getElementById('btnCancelar').setAttribute('disabled', true)
                        document.getElementById('alertContratoUploadTmp')
                            .style.display = 'none'
                        document.getElementById('progressUploadContractContainer').style
                            .display =
                            'block';
                        document.getElementById('progressUploadContract').style.width =
                            `0%`;
                        document.getElementById('loaderContractTmpFile').style.display = 'none';
                        document.getElementById('fileContratoName').value = null
                    },
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        document.getElementById('loaderContractTmpFile').style.display = 'none';
                        document.getElementById(
                                'progressUploadContractContainer').style
                            .display =
                            'none';
                        document.getElementById('alertContratoUploadTmp')
                            .style.display = 'block'
                        document.getElementById('fileContratoName').value = response.fileName
                        document.getElementById('btnGuardar').removeAttribute('disabled')
                        document.getElementById('btnCancelar').removeAttribute('disabled')
                        console.log(response);
                    },
                    error: function(request, status, error) {
                        console.log(error);
                        $.each(request.responseJSON.errors, function(indexInArray,
                            valueOfElement) {
                            console.log(indexInArray);
                            document.querySelector(`#${indexInArray}_error`)
                                .innerHTML =
                                ` ${valueOfElement[0]}`;
                        });
                        document.getElementById('btnGuardar').removeAttribute('disabled')
                        document.getElementById('btnCancelar').removeAttribute('disabled')
                        document.getElementById('loaderContractTmpFile').style.display = 'none';
                        document.getElementById('progressUploadContractContainer').style
                            .display =
                            'none';
                        document.getElementById('progressUploadContract').style.width =
                            `0%`;
                        document.getElementById('alertContratoUploadTmp')
                            .style.display = 'none'
                    }
                });
            })
        })
    </script>

    <script>
        function replaceSlash(elemento) {
            elemento.value = elemento.value.replace("/", "-");
            elemento.value = elemento.value.replace("\\", "-");
        }
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


            $('.fecha_firma').datepicker({
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
                        text: 'La fecha de fin del contrato no puede ser igual a la fecha del inicio de contrato',
                    });
                    $(".fecha_fin_contrato").val("");
                }
            });

            $(function() {
                new AutoNumeric('#teste', {

                    decimalCharacter: ',',
                    decimalCharacter: '.',
                    maximumValue: '100000000000',
                    minimumValue: '0.00',
                    currencySymbol: '$',
                    emptyInputBehavior: "zero",
                    decimalPlacesOverride: 2
                });
            });

            $(function() {
                new AutoNumeric('#este', {
                    decimalCharacter: ',',
                    decimalCharacter: '.',
                    maximumValue: '100000000000',
                    minimumValue: '0.00',
                    currencySymbol: '$',
                    emptyInputBehavior: "zero",
                    decimalPlacesOverride: 2
                });
            });

            $(function() {
                new AutoNumeric('#prueba', {
                    decimalCharacter: ',',
                    decimalCharacter: '.',
                    maximumValue: '100000000000',
                    minimumValue: '0.00',
                    currencySymbol: '$',
                    emptyInputBehavior: "zero",
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

    <script type="text/javascript">
        $('#check_aplica_fianza').click(function(e) {
            if ($('#check_aplica_fianza').is(':checked')) {
                $('.td_fianza').fadeIn(0);
            } else {
                $('.td_fianza').fadeOut(0);
            }
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
@endsection
