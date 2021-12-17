@extends('layouts.admin')
@section('content')
    <style>
        .select2-container {
            margin-top: 0px !important;
        }

        /* .dataTables_scrollHeadInner {
                                                                            width: auto !important;
                                                                        } */

        .screenshot-image {
            width: 150px;
            height: 90px;
            border-radius: 4px;
            border: 2px solid whitesmoke;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
            position: absolute;
            bottom: 5px;
            left: 10px;
            background: white;
        }

        .display-cover {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70%;
            margin: 5% auto;
            position: relative;
        }

        video {
            width: 100%;
            background: rgba(0, 0, 0, 0.75);
            border-radius: 10px;
            position: relative;
        }

        #cerrarCanvasFoto {
            position: absolute;
            top: -13px;
            right: -8px;
            padding: 10px;
            border-radius: 100%;
            z-index: 1;
            cursor: pointer;
        }

        .video-options {
            position: absolute;
            left: 20px;
            top: 27px;
        }

        .controls {
            position: absolute;
            right: 20px;
            top: 20px;
            display: flex;
        }

        .controls>button {
            width: 45px;
            height: 45px;
            text-align: center;
            border-radius: 100%;
            margin: 0 6px;
            background: transparent;
        }

        .controls>button:hover svg {
            color: white !important;
        }

        @media (min-width: 300px) and (max-width: 400px) {
            .controls {
                flex-direction: column;
            }

            .controls button {
                margin: 5px 0 !important;
            }
        }

        .controls>button>svg {
            height: 20px;
            width: 18px;
            text-align: center;
            margin: 0 auto;
            padding: 0;
        }

        .controls button:nth-child(1) {
            border: 2px solid #D2002E;
        }

        .controls button:nth-child(1) svg {
            color: #D2002E;
        }

        .controls button:nth-child(2) {
            border: 2px solid #008496;
        }

        .controls button:nth-child(2) svg {
            color: #008496;
        }

        .controls button:nth-child(3) {
            border: 2px solid #00B541;
        }

        .controls button:nth-child(3) svg {
            color: #00B541;
        }

        .controls>button {
            width: 45px;
            height: 45px;
            text-align: center;
            border-radius: 100%;
            margin: 0 6px;
            background: transparent;
        }

        .controls>button:hover svg {
            color: white;
        }

        .btn i,
        .btn .c-icon {
            margin: auto;
            color: white;
            font-size: 18px;
            margin-top: 5px;
            margin-right: 2px;
        }

        .btn.stop {
            border: 2px solid red;
        }

        select.devices {
            appearance: none;
            background-color: transparent;
            border: none;
            padding: 0 1em 0 0;
            margin: 0;
            width: 100%;
            min-width: 15ch;
            max-width: 30ch;
            font-family: inherit;
            font-size: inherit;
            cursor: inherit;
            line-height: inherit;
            outline: none;
            cursor: pointer;
            border: solid 2px #6169ff;
            color: white;
            padding: 0 27px 0 10px;
        }

        select.devices:hover {
            background: #6169ff;
            color: white;
        }

        select.devices::-ms-expand {
            display: none;
        }

        .breadcrumb {
            margin-bottom: 0 !important;
        }

        .collapse:not(.show) {
            display: inline;
        }

    </style>
    <div class="mt-4 card">
        @if ($isEditAdmin)
            <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
                <h3 class="mb-1 text-center text-white"><strong> Editar: </strong>Empleado </h3>
            </div>
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="tabsEmpleado" role="tablist">
                        <a class="nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab"
                            aria-controls="nav-general" aria-selected="true">
                            <i class="mr-2 fas fa-briefcase" style="font-size:20px;" style="text-decoration:none;"></i>
                            Datos Laborales
                        </a>
                        <a class="nav-link" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab"
                            aria-controls="nav-personal" aria-selected="false">
                            <i class="mr-2 fas fa-house-user" style="font-size:20px;" style="text-decoration:none;"></i>
                            Datos Personales
                        </a>
                        <a class="nav-link" id="nav-financiera-tab" data-toggle="tab" href="#nav-financiera" role="tab"
                            aria-controls="nav-financiera" aria-selected="false">
                            <i class="mr-2 fas fa-wallet" style="font-size:20px;" style="text-decoration:none;"></i>
                            Datos Financieros
                        </a>
                        <a class="nav-link" id="nav-competencias-tab" data-toggle="tab" href="#nav-competencias"
                            role="tab" aria-controls="nav-competencias" aria-selected="false">
                            <i class="mr-2 fas fa-award" style="font-size:20px;"></i>Competencias
                        </a>
                        <a class="nav-link" id="nav-documentos-tab" data-toggle="tab" href="#nav-documentos"
                            role="tab" aria-controls="nav-documentos" aria-selected="false">
                            <i class="mr-2 fas fa-folder-open" style="font-size:20px;"></i>Documentos
                        </a>
                    </div>
                </nav>
                <form method="POST" action="{{ route('admin.empleados.update', [$empleado->id]) }}"
                    enctype="multipart/form-data" id="formEmpleados">
                    @method('PUT')
                    @csrf
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-general" role="tabpanel"
                            aria-labelledby="nav-general-tab">
                            @include('admin.empleados.form_components.general')
                        </div>
                        <div class="tab-pane fade" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
                            @include('admin.empleados.form_components.personal')
                        </div>
                        <div class="tab-pane fade" id="nav-financiera" role="tabpanel"
                            aria-labelledby="nav-financiera-tab">
                            @include('admin.empleados.form_components.financiera')
                        </div>
                        <div class="tab-pane fade" id="nav-competencias" role="tabpanel"
                            aria-labelledby="nav-competencias-tab">
                            @include('admin.empleados.components._competencias_form')
                        </div>
                        <div class="tab-pane fade" id="nav-documentos" role="tabpanel"
                            aria-labelledby="nav-documentos-tab">
                            @include('admin.empleados.form_components.documentos')
                        </div>

                    </div>
                </form>
                <div class="text-right form-group col-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit" id="btnGuardar">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </div>
        @else
            {{ Breadcrumbs::render('Editar-Curriculum', $empleado) }}
            <div class="p-4">
                <div class="mt-4 text-center form-group"
                    style="background-color:#1BB0B0; border-radius: 100px; color: white;">
                    CURRICULUM
                </div>
                <label id="urlFormEmpleados"
                    data-url="{{ route('admin.empleados.updateFromCurriculum', $empleado) }}"></label>
                @include('admin.empleados.components._competencias_form')
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.miCurriculum', $empleado) }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit" id="btnGuardar">
                        Guardar
                    </button>
                </div>
            </div>
        @endif


        <div class="card-body">
            @if (!$isEditAdmin)

            @endif
            <div class="caja_botones_menu">
                @if ($isEditAdmin)
                    {{-- <a href="#" data-tabs="contenido1" class="btn_activo"><i class="mr-2 fas fa-file"
                            style="font-size:30px;" style="text-decoration:none;"></i>Información
                        General</a>
                    <a href="#" data-tabs="contenido2" class="resizeDT"><i class="mr-2 fas fa-flag-checkered"
                            style="font-size:30px;"></i>Competencias</a> --}}
                @else
                @endif
            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="caja_caja_secciones">
                        <div class="caja_secciones">
                            @if ($isEditAdmin)
                                <section id="contenido1" class="mt-4 {{ $isEditAdmin ? 'caja_tab_reveldada' : '' }}">
                                    <div>
                                        {{-- <form method="POST"
                                            action="{{ route('admin.empleados.update', [$empleado->id]) }}"
                                            enctype="multipart/form-data" id="formEmpleados">
                                            @method('PUT')
                                            @csrf
                                            <div class="mb-3 text-center row justify-content-center">
                                                <div class="text-center col-sm-2 w-50 text-light card-title"
                                                    style="background-color:#1BB0B0">
                                                    Imágen Actual
                                                </div>
                                                <div class="col-sm-12"><img class="ml-3"
                                                        src="{{ asset('storage/empleados/imagenes/' . $empleado->foto) }}"
                                                        style="width:80px ">
                                                </div>

                                            </div>
                                            @include('admin.empleados._form')
                                        </form> --}}
                                    </div>
                                </section>
                            @endif
                            <section id="contenido2" class="mt-4 ml-2 {{ !$isEditAdmin ? 'caja_tab_reveldada' : '' }}">
                                @if (!$isEditAdmin)

                                @endif
                                {{-- @include('admin.empleados.components._competencias_form') --}}
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script type="module">
        import {
            formatNumber,
            formatCurrency
        } from "{{ asset('js/money-format/moneyInput.js') }}";

        document.addEventListener('DOMContentLoaded', function() {
            initInpusToMoneyFormat();
            inputsToMoneyFormat();
            const toogleProyectoAsignado = (ocultar) => {
                const elProyectoAsignado = document.getElementById('proyecto_asignado');
                const containerProyectoAsignado = document.getElementById('c_proyecto_asignado');
                const containerEsquemaContratacion = document.getElementById('c_esquema_contratacion');
                if (ocultar) {
                    containerProyectoAsignado.classList.remove('col-sm-6');
                    containerProyectoAsignado.classList.add('d-none');
                    containerEsquemaContratacion.classList.remove('col-sm-6');
                    containerEsquemaContratacion.classList.add('col-sm-12');
                    elProyectoAsignado.setAttribute('disabled', 'disabled');
                    elProyectoAsignado.removeAttribute('type');
                    elProyectoAsignado.setAttribute('type', 'hidden');
                    elProyectoAsignado.value = "";
                } else {
                    containerProyectoAsignado.classList.add('col-sm-6');
                    containerProyectoAsignado.classList.remove('d-none');
                    containerEsquemaContratacion.classList.remove('col-sm-12');
                    containerEsquemaContratacion.classList.add('col-sm-6');
                    elProyectoAsignado.removeAttribute('disabled');
                    elProyectoAsignado.removeAttribute('type');
                    elProyectoAsignado.setAttribute('type', 'text');
                }
            }

            $('#sede_id').on('select2:select', function(e) {
                const direction = e.target.options[e.target.selectedIndex].getAttribute('data-direction');
                setDirectionOnInput(direction);
            });
            $('#tipo_contrato_empleados_id').on('select2:select', function(e) {
                const slug = e.target.options[e.target.selectedIndex].getAttribute('data-slug');
                console.log(e.target);
                if (slug === "por-proyecto") {
                    toogleProyectoAsignado(false);
                } else {
                    toogleProyectoAsignado(true);
                }
            });

            document.getElementById('sede_id').addEventListener('change', function(e) {
                const direction = e.target.options[e.target.selectedIndex].getAttribute('data-direction');
                setDirectionOnInput(direction);
            })
            const setDirectionOnInput = (direction) => {
                document.getElementById('direccion').value = direction;
            }
        })

        function initInpusToMoneyFormat() {
            document.querySelectorAll("input[data-type='currency']").forEach(element => {
                formatCurrency($(element));
            })
        }

        function inputsToMoneyFormat() {
            $("input[data-type='currency']").on({
                init: function() {
                    console.log(this);
                },
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() {
                    formatCurrency($(this), "blur");
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            CKEDITOR.replace('resumen', {
                toolbar: [{
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker'],
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                    }, {
                        name: 'clipboard',
                        groups: ['undo'],
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                            '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'Blockquote',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                    },
                    '/',
                ]
            });
            $('#tabsEmpleado a').on('click', function(event) {
                event.preventDefault()
                // $(this).tab('show')
                setTimeout(() => {
                    $.fn.dataTable.tables({
                        visible: true,
                        api: true
                    }).columns.adjust();
                }, 1000);
            })
        })
    </script>
    {{-- <script>
        class Documentos {
            constructor() {
                this.url = "{{ route('admin.empleado.documentos', $empleado) }}";
                this.pdfFile = "{{ asset('img/pdf-file.png') }}";
                this.assetDocumentosUrl = "{{ asset('storage/documentos_empleados/') }}";
            }
            async render() {
                const response = await fetch(this.url);
                const data = await response.json();
                let html = `<div class="row">`
                data.documentos.forEach(element => {
                    html += `
                    <div class="col-md-2 col-2" style="position: relative;" id="contendorDocumento">
                        <a href="${this.assetDocumentosUrl}/${element.documentos}" target="_blank" title="Visualizar">
                        <img class="img-fluid" src="${this.pdfFile}">
                        <p class="text-muted" style="font-size: 9pt;text-align: center;">${element.documentos}</p>
                        </a>
                        <i data-documento-id="${element.id}" class="fas fa-times-circle" style="cursor:pointer;position: absolute;top: 13px;font-size: 12pt;right: 26px;color: #4a4a4a;"></i>
                    </div>
                    `
                });
                html += `</div>`;
                document.getElementById('documentosGrid').innerHTML = html;
                console.log(data);
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const documentos = new Documentos();
            documentos.render();

            const documentosGrid = document.getElementById('documentosGrid');
            documentosGrid.addEventListener('click', function(e) {
                if (e.target.tagName == 'I') {
                    console.log(e.target.getAttribute('data-documento-id'));
                }
            })
        })
    </script> --}}
    <script>
        $(document).ready(function() {
            $('.areas').select2({
                theme: 'bootstrap4',
            });
            $('.select-search').select2({
                theme: 'bootstrap4',
            });
            $('.supervisor').select2({
                theme: 'bootstrap4',
            });
            $('#puesto_id').select2({
                theme: 'bootstrap4',
            });
            $('#perfil_empleado_id').select2({
                theme: 'bootstrap4',
            });
            $('#nacionalidad').select2({
                theme: 'bootstrap4',
                templateResult: customizeNationalitySelect,
                templateSelection: customizeNationalitySelect
            });

            function customizeNationalitySelect(opt) {
                if (!opt.id) {
                    return opt.text;
                }

                let optImage = $(opt.element).attr('data-flag');
                let $opt = $(
                    `<span>
                        <img src="${optImage}" class="img-fluid rounded-circle" width="30" height="30"/>
                        ${opt.text}
                    </span>`
                    // '<span><img src="{{ asset('storage/empleados/imagenes/') }}/' +
                    // optimage +
                    // '" class="img-fluid rounded-circle" width="30" height="30"/>' +
                    // opt.text + '</span>'
                );
                return $opt;
            };
        });
    </script>
    <script>
        const habilitarFotoBtn = document.getElementById('avatar_choose');
        const contendorCanvas = document.getElementById('canvasFoto');
        const closeContenedorCanvas = document.getElementById('cerrarCanvasFoto');
        habilitarFotoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            contendorCanvas.style.display = 'grid';
            document.getElementById("foto").value = "";
            $("#texto-imagen").text("Subir Imágen");
        });
        // feather.replace();

        const controls = document.querySelector('.controls');
        const cameraOptions = document.querySelector('.video-options>select');
        const video = document.querySelector('video');
        const canvas = document.querySelector('canvas');
        const screenshotImage = document.querySelector('.screenshot-image');
        const inputShotURL = document.getElementById('snapshoot');
        const buttons = [...controls.querySelectorAll('button')];
        let streamStarted = false;

        const [play, pause, stop, screenshot] = buttons;

        const constraints = {
            video: {
                width: {
                    min: 1280,
                    ideal: 1920,
                    max: 2560,
                },
                height: {
                    min: 720,
                    ideal: 1080,
                    max: 1440
                },
            }
        };

        cameraOptions.onchange = () => {
            const updatedConstraints = {
                ...constraints,
                deviceId: {
                    exact: cameraOptions.value
                }
            };

            startStream(updatedConstraints);
        };

        play.onclick = (e) => {
            e.preventDefault();
            if (streamStarted) {
                video.play();
                play.classList.add('d-none');
                pause.classList.remove('d-none');
                return;
            }
            if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
                const updatedConstraints = {
                    ...constraints,
                    deviceId: {
                        exact: cameraOptions.value
                    }
                };
                startStream(updatedConstraints);
            }
        };

        const stopStreamedVideo = (e) => {
            e.preventDefault();
            const stream = video.srcObject;
            if (stream != null) {
                const tracks = stream.getTracks();
                tracks.forEach(function(track) {
                    track.stop();
                });
                video.srcObject = null;
                play.classList.remove('d-none');
                stop.classList.add('d-none');
                pause.classList.add('d-none');
                screenshot.classList.add('d-none');
            }
        }

        const pauseStream = (e) => {
            e.preventDefault();
            video.pause();
            play.classList.remove('d-none');
            pause.classList.add('d-none');
        };

        const doScreenshot = (e) => {
            e.preventDefault();
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            screenshotImage.src = canvas.toDataURL('image/webp');
            screenshotImage.classList.remove('d-none');
            let dataURL = canvas.toDataURL();
            inputShotURL.value = dataURL;
        };
        stop.onclick = stopStreamedVideo;
        pause.onclick = pauseStream;
        screenshot.onclick = doScreenshot;

        const startStream = async (constraints) => {
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            handleStream(stream);
        };


        const handleStream = (stream) => {
            video.srcObject = stream;
            play.classList.add('d-none');
            pause.classList.remove('d-none');
            stop.classList.remove('d-none');
            screenshot.classList.remove('d-none');
        };


        const getCameraSelection = async () => {
            const devices = await navigator.mediaDevices.enumerateDevices();
            const videoDevices = devices.filter(device => device.kind === 'videoinput');
            const options = videoDevices.map(videoDevice => {
                return `<option value="${videoDevice.deviceId}">${videoDevice.label}</option>`;
            });
            cameraOptions.innerHTML = options.join('');
        };

        getCameraSelection();

        document.getElementById('cerrarCanvasFoto').addEventListener('click', function(e) {
            stopStreamedVideo(e);
            contendorCanvas.style.display = 'none';
        });


        $('.form-control-file').on('change', function(e) {
            let inputFile = e.currentTarget;
            $("#texto-imagen").text(inputFile.files[0].name);
            let dataURL = canvas.toDataURL();
            inputShotURL.value = "";
            stopStreamedVideo(e);
            contendorCanvas.style.display = 'none';
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            document.getElementById("btnGuardarResumen").addEventListener("click", function(e) {
                e.preventDefault();
                let dataResumen = CKEDITOR.instances.resumen.getData();
                let url = $("#formResumen").attr("action");
                console.log(url)
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        resumen: dataResumen
                    },
                    beforeSend: function() {
                        toastr.info("Guardando el resumen");
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success("Resumen guardado");
                        }
                    },
                    error: function(request, status, error) {
                        console.log(error)
                        $.each(request.responseJSON.errors, function(indexInArray,

                            valueOfElement) {
                            console.log(valueOfElement, indexInArray);
                            $(`span.${indexInArray}_error`).text(valueOfElement[0]);

                        });
                    }
                });
            })
            window.tblExperiencia = $('#tbl-experiencia').DataTable({
                "autoWidth": false,
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.empleados.getExperiencia', $empleado->id) }}",
                columns: [{
                        data: 'empresa',
                        name: 'empresa',
                        render: function(data, type, row, meta) {
                            return `
                            <input class="form-control" type="text" value="${data}" data-name-input="empresa" data-experiencia-id="${row.id}" />
                            <span class="errors empresa_error text-danger"></span>
                            `;
                        }
                    },
                    {
                        data: 'puesto',
                        name: 'puesto',
                        render: function(data, type, row, meta) {
                            return `
                            <input class="form-control" type="text" value="${data}" data-name-input="puesto" data-experiencia-id="${row.id}" />
                            <span class="errors puesto_error text-danger"></span>
                            `;
                        }
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        render: function(data, type, row, meta) {
                            return `
                            <input class="form-control" type="text" value="${data}" data-name-input="descripcion" data-experiencia-id="${row.id}" />
                            <span class="errors descripcion_error text-danger"></span>
                            `;
                        }
                    },
                    {
                        data: 'inicio_mes_ymd',
                        name: 'inicio_mes_ymd',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<input class="form-control" type="date" value="${data}" data-name-input="inicio_mes" data-experiencia-id="${row.id}" />
                                <span class="errors inicio_mes_error text-danger"></span>`;

                            } else {
                                return `<input class="form-control" type="date" value="" data-name-input="inicio_mes" data-experiencia-id="${row.id}" />
                                <span class="errors inicio_mes_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'fin_mes_ymd',
                        name: 'fin_mes_ymd',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<input class="form-control" type="date" value="${data}" data-name-input="fin_mes" data-experiencia-id="${row.id}" />
                                <span class="errors fin_mes_error text-danger"></span>`;

                            } else {
                                return `<input class="form-control" type="date" value="" data-name-input="fin_mes" data-experiencia-id="${row.id}" />
                                <span class="errors fin_mes_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, route, meta) {
                            let urlEliminar =
                                `/admin/empleados/delete/${data}/competencias-experiencia`;
                            let html = `
                            <button onclick="event.preventDefault(); EliminarExperiencia('${urlEliminar}','${data}')" class="btn btn-sm text-primary"><i class="fas fa-trash-alt" style="color:#fd0000"></i></button>
                            `;
                            return html;
                        }
                    },

                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
            });

            //Eventos para editar registros
            document.getElementById('tbl-experiencia').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'SELECT') {
                    if (e.target.type == 'date' || e.target.type == 'select-one' || e.target.type ==
                        'number') {
                        const experienciaId = e.target.getAttribute('data-experiencia-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(experienciaId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${experienciaId}/competencias-experiencia`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                    }
                }
            });

            document.getElementById('tbl-experiencia').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT') {
                    if (e.target.type == 'text' || e.target.type == 'number') {
                        const experienciaId = e.target.getAttribute('data-experiencia-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(value, typeInput, experienciaId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${experienciaId}/competencias-experiencia`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                    }
                }
            });

            window.EliminarExperiencia = function(url, experienciaId) {
                Swal.fire({
                    title: 'Estás seguro de eliminar?',
                    text: "Esto no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                experienciaId
                            },
                            beforeSend: function() {
                                toastr.info("Eliminando experiencia laboral");
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success("Experiencia laboral eliminada");
                                    tblExperiencia.ajax.reload();
                                }
                            },
                            error: function(request, status, error) {
                                console.log(error)
                                $.each(request.responseJSON.errors, function(indexInArray,

                                    valueOfElement) {
                                    console.log(valueOfElement, indexInArray);
                                    $(`span.${indexInArray}_error`).text(
                                        valueOfElement[0]);

                                });
                            }
                        });
                    }
                })
            }

            window.tblEducacion = $('#tbl-educacion').DataTable({
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.empleados.getEducacion', $empleado->id) }}",
                columns: [{
                        data: 'institucion',
                        name: 'institucion',
                        render: function(data, type, row, meta) {
                            return `
                            <input class="form-control" type="text" value="${data}" data-name-input="institucion" data-educacion-id="${row.id}" />
                            <span class="errors institucion_error text-danger"></span>
                            `;
                        }
                    },
                    {
                        data: 'nivel',
                        name: 'nivel',
                        render: function(data, type, row, meta) {
                            let select = `
                            <select class="form-control" data-educacion-id="${row.id}" data-name-input="nivel">
                                <option value="" disabled selected>
                                    Selecciona una opción
                                </option>`;
                            let opciones = @json(App\Models\EducacionEmpleados::NivelSelect);
                            for (const key in opciones) {
                                select += `
                                    <option value="${key}" ${data == key ? ' selected':''}>
                                        ${key}
                                    </option>
                                `;
                            }
                            select += `
                            <span class="errors nivel_error text-danger"></span>
                            </select>
                            `;
                            return select;
                        }
                    },
                    {
                        data: 'year_inicio_ymd',
                        name: 'year_inicio_ymd',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<input class="form-control" type="date" value="${data}" data-name-input="año_inicio" data-educacion-id="${row.id}" />
                                <span class="errors año_inicio_error text-danger"></span>`;

                            } else {
                                return `<input class="form-control" type="date" value="" data-name-input="año_inicio" data-educacion-id="${row.id}" />
                                <span class="errors año_inicio_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'year_fin_ymd',
                        name: 'year_fin_ymd',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<input class="form-control" type="date" value="${data}" data-name-input="año_fin" data-educacion-id="${row.id}" />
                                <span class="errors año_fin_error text-danger"></span>`;

                            } else {
                                return `<input class="form-control" type="date" value="" data-name-input="año_fin" data-educacion-id="${row.id}" />
                                <span class="errors año_fin_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, route, meta) {
                            let urlEliminar =
                                `/admin/empleados/delete/${data}/competencias-educacion`;
                            let html = `
                            <button onclick="event.preventDefault(); EliminarEducacion('${urlEliminar}','${data}')" class="btn btn-sm text-primary"><i class="fas fa-trash-alt" style="color:#fd0000"></i></button>
                            `;
                            return html;
                        }
                    },

                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
            })

            document.getElementById('tbl-educacion').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'SELECT') {
                    if (e.target.type == 'date' || e.target.type == 'select-one' || e.target.type ==
                        'number') {
                        const educacionId = e.target.getAttribute('data-educacion-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(educacionId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${educacionId}/competencias-educacion`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                    }
                }
            });

            document.getElementById('tbl-educacion').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT') {
                    if (e.target.type == 'text' || e.target.type == 'number') {
                        const educacionId = e.target.getAttribute('data-educacion-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(value, typeInput, educacionId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${educacionId}/competencias-educacion`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                    }
                }
            });

            window.EliminarEducacion = function(url, educacionId) {
                Swal.fire({
                    title: 'Estás seguro de eliminar?',
                    text: "Esto no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                educacionId
                            },
                            beforeSend: function() {
                                toastr.info("Eliminando educación");
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success("Educación eliminada");
                                    tblEducacion.ajax.reload();
                                }
                            },
                            error: function(request, status, error) {
                                console.log(error)
                                $.each(request.responseJSON.errors, function(indexInArray,

                                    valueOfElement) {
                                    console.log(valueOfElement, indexInArray);
                                    $(`span.${indexInArray}_error`).text(
                                        valueOfElement[0]);

                                });
                            }
                        });
                    }
                })
            }


            window.tblCurso = $('#tbl-cursos').DataTable({
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.empleados.getCursos', $empleado->id) }}",
                columns: [{
                        data: 'curso_diploma',
                        name: 'curso_diploma',
                        render: function(data, type, row, meta) {
                            return `
                            <input class="form-control" type="text" value="${data}" data-name-input="curso_diploma" data-curso-id="${row.id}" />
                            <span class="errors curso_diploma_error text-danger"></span>
                            `;
                        }
                    },
                    {
                        data: 'tipo',
                        name: 'tipo',
                        render: function(data, type, row, meta) {
                            let select = `
                            <select class="form-control" data-curso-id="${row.id}" data-name-input="tipo">
                                <option value="" disabled selected>
                                    Selecciona una opción
                                </option>`;
                            let opciones = @json(App\Models\CursosDiplomasEmpleados::TipoSelect);
                            for (const key in opciones) {
                                select += `
                                    <option value="${key}" ${data == key ? ' selected':''}>
                                        ${key}
                                    </option>
                                `;
                            }
                            select += `
                            <span class="errors tipo_error text-danger"></span>
                            </select>
                            `;
                            return select;
                        }
                    },
                    {
                        data: 'year_ymd',
                        name: 'year_ymd',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<input class="form-control" type="date" value="${data}" data-name-input="año" data-curso-id="${row.id}" />
                                <span class="errors año_error text-danger"></span>`;

                            } else {
                                return `<input class="form-control" type="date" value="" data-name-input="año" data-curso-id="${row.id}" />
                                <span class="errors año_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'duracion',
                        name: 'duracion',
                        render: function(data, type, row, meta) {
                            return `
                            <input class="form-control" type="number" value="${data}" data-name-input="duracion" data-curso-id="${row.id}" />
                            <span class="errors duracion_error text-danger"></span>
                            `;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, route, meta) {
                            let urlEliminar =
                                `/admin/empleados/delete/${data}/competencias-cursos`;
                            let html = `
                            <button onclick="event.preventDefault(); EliminarCurso('${urlEliminar}','${data}')" class="btn btn-sm text-primary"><i class="fas fa-trash-alt" style="color:#fd0000"></i></button>
                            `;
                            return html;
                        }
                    },

                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],

            })
            //Eventos para editar registros
            document.getElementById('tbl-cursos').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'SELECT') {
                    if (e.target.type == 'date' || e.target.type == 'select-one' || e.target.type ==
                        'number') {
                        const cursoId = e.target.getAttribute('data-curso-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(cursoId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${cursoId}/competencias-curso`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                    }
                }
            });
            document.getElementById('tbl-cursos').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT') {
                    if (e.target.type == 'text' || e.target.type == 'number') {
                        const cursoId = e.target.getAttribute('data-curso-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(value, typeInput, cursoId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${cursoId}/competencias-curso`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                    }
                }
            });
            window.EliminarCurso = function(url, cursoId) {
                Swal.fire({
                    title: 'Estás seguro de eliminar?',
                    text: "Esto no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                cursoId
                            },
                            beforeSend: function() {
                                toastr.info("Eliminando curso");
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success("Curso eliminado");
                                    tblCurso.ajax.reload();
                                }
                            },
                            error: function(request, status, error) {
                                console.log(error)
                                $.each(request.responseJSON.errors, function(indexInArray,

                                    valueOfElement) {
                                    console.log(valueOfElement, indexInArray);
                                    $(`span.${indexInArray}_error`).text(
                                        valueOfElement[0]);

                                });
                            }
                        });
                    }
                })
            }

            window.tblCertificado = $('#tbl-certificados').DataTable({
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.empleados.getCertificaciones', $empleado->id) }}",
                columns: [{
                        data: 'nombre',
                        name: 'nombre',
                        render: function(data, type, row, meta) {
                            return `<input class="form-control" type="text" value="${data}" data-certificacion-id="${row.id}" />
                            <span class="errors nombre_error text-danger"></span>`;
                        }
                    },
                    {
                        data: 'vigencia_ymd',
                        name: 'vigencia_ymd',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<input class="form-control" type="date" value="${data}" data-certificacion-id="${row.id}" />
                                <span class="errors vigencia_error text-danger"></span>`;

                            } else {
                                return `<input class="form-control" type="date" value="" data-certificacion-id="${row.id}" />
                                <span class="errors vigencia_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'estatus',
                        name: 'estatus',
                        render: function(data, type, row, meta) {
                            return `<div class="form-control" data-vigencia-id="${row.id}">${data?data:'Permanente'}</div>
                            <span class="errors estatus_error text-danger"></span>`;
                        }
                    },
                    {
                        data: 'documento',
                        name: 'documento',
                        render: function(data, type, row, meta) {
                            if (data) {
                                const pdfFile = "{{ asset('img/pdf-file.png') }}";
                                const assetDocumentosUrl =
                                    "{{ asset('storage/certificados_empleados/') }}";
                                return `
                            <div class="text-center" style="position:relative;">
                                <a target="_blank" class="text-center" href="${assetDocumentosUrl}/${data}" title="${data}">
                                    <img style="width:35px" src="${pdfFile}" class="img-fluid" alt="${data}" />
                                    <p class="m-0 text-muted" style="font-size:10px">${data.substring(0,35)}...</p>
                                </a>
                                <i data-certificacion-id="${row.id}" class="fas fa-times-circle removeFile" style="position:absolute; top:0;right: 58px;"></i>
                            </div>
                            `;
                            } else {
                                return `
                                <div class="text-center">
                                    <label for="documento${row.id}" class="text-center">
                                        <img src="{{ asset('img/upload-pdf.png') }}" style="width:40px" />
                                        <p class="m-0 text-muted" style="font-size:10px">Subir Documento</p>
                                    </label>
                                </div>
                                <input type="file" class="form-control d-none" id="documeto${row.id}" data-certificacion-id="${row.id}"/>
                                <p class="m-0">
                                    <span class="errors documento_error text-danger"></span>
                                </p>
                                `;
                            }

                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlEliminar =
                                `/admin/empleados/delete/${data}/competencias-certificaciones`;
                            let html = `
                            <button onclick="event.preventDefault(); Eliminar('${urlEliminar}','${data}')" class="btn btn-sm text-primary"><i class="fas fa-trash-alt" style="color:#fd0000"></i></button>
                            `;
                            return html;
                        }
                    },

                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
            })
            //Eventos para editar registros
            document.getElementById('tbl-certificados').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT') {
                    if (e.target.type == 'date') {
                        const certificadoId = e.target.getAttribute('data-certificacion-id');
                        const vigencia = e.target.value;
                        console.log(e.target.value);
                        let estatus = document.querySelector(`[data-vigencia-id="${certificadoId}"]`);
                        let estatusName = "";
                        if (Date.parse(vigencia) >= Date.now()) {
                            estatus.innerHTML = "Vigente"
                            estatusName = "Vigente"
                            estatus.style.border = "2px solid #57e262";
                        } else {
                            estatus.innerHTML = 'Vencida'
                            estatusName = 'Vencida'
                            estatus.style.border = "2px solid #FF9C08";
                        }
                        const formData = new FormData();
                        formData.append('vigencia', vigencia);
                        formData.append('estatus', estatusName);
                        const url =
                            `/admin/empleados/update/${certificadoId}/competencias-certificaciones`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                    } else if (e.target.type == 'file') {
                        const certificadoId = e.target.getAttribute('data-certificacion-id');
                        const formData = new FormData();
                        e.target.files.forEach(element => {
                            formData.append('documento', element);
                        });
                        const url =
                            `/admin/empleados/update/${certificadoId}/competencias-certificaciones`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                        })
                        tblCertificado.ajax.reload();
                    }
                }
            });
            document.getElementById('tbl-certificados').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT') {
                    if (e.target.type == 'text') {
                        const certificadoId = e.target.getAttribute('data-certificacion-id');
                        const certificadoName = e.target.value;
                        const formData = new FormData();
                        formData.append('nombre', certificadoName);
                        const url =
                            `/admin/empleados/update/${certificadoId}/competencias-certificaciones`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                    }
                }
            });
            document.getElementById('tbl-certificados').addEventListener('click', function(e) {
                if (e.target.tagName == 'I') {
                    if (e.target.classList.contains('removeFile')) {
                        const certificadoId = e.target.getAttribute('data-certificacion-id');
                        Swal.fire({
                            title: 'Estás seguro de eliminar el certificado?',
                            text: "Esto no se puede revertir!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si',
                            cancelButtonText: "No",
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                const url =
                                    `/admin/empleados/${certificadoId}/delete-file-certificacion`;
                                const response = await fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        Accept: "application/json",
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr(
                                                'content'),
                                    },
                                })
                                const data = await response.json();
                                console.log(data);
                                tblCertificado.ajax.reload();
                            }
                        })

                    }
                }
            });
            window.Eliminar = function(url, certificacionId) {
                Swal.fire({
                    title: 'Estás seguro de eliminar?',
                    text: "Esto no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                certificacionId
                            },
                            beforeSend: function() {
                                toastr.info("Eliminando certificación");
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success("Certificación eliminada");
                                    tblCertificado.ajax.reload();
                                }
                            },
                            error: function(request, status, error) {
                                console.log(error)
                                $.each(request.responseJSON.errors, function(indexInArray,

                                    valueOfElement) {
                                    console.log(valueOfElement, indexInArray);
                                    $(`span.${indexInArray}_error`).text(
                                        valueOfElement[0]);

                                });
                            }
                        });
                    }
                })
            }
            let vigencia_certificado = document.getElementById('vigencia');
            vigencia_certificado.addEventListener(
                'change',
                function() {
                    // console.log(this);
                    let vigencia = this.value;
                    let estatus = document.getElementById('vencio_alta');
                    if (Date.parse(vigencia) >= Date.now()) {
                        estatus.value = "Vigente"
                        estatus.style.border = "2px solid #57e262";
                    } else {
                        estatus.value = 'Vencida'
                        estatus.style.border = "2px solid #FF9C08";
                    }
                })


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            document.getElementById("btnGuardarDocumento").addEventListener("click", async function(e) {
                e.preventDefault();
                limpiarErrores();
                let url = $("#formDocumentos").attr("action");
                const formulario = document.getElementById('formDocumentos');
                const formData = new FormData(formulario);
                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                    });
                    const data = await response.json();
                    if (data.errors) {
                        $.each(data.errors, function(indexInArray, valueOfElement) {
                            $(`#${indexInArray.replaceAll('.','_')}_error`).text(
                                valueOfElement[0]);
                        });
                        toastr.error(
                            'Tu resgitro contiene errores de validación, revisa los inputs por favor.'
                        );
                    }
                    if (data.status) {
                        tblDocumentos.ajax.reload();
                        formulario.reset();
                        console.log(data.message);
                    }
                } catch (error) {
                    console.log(error);
                }
            })

            window.tblDocumentos = $('#tbl-documentos').DataTable({
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.empleado.documentos', $empleado->id) }}",
                columns: [{
                        data: 'nombre',
                        name: 'nombre',
                        render: function(data, type, row, meta) {
                            return `<input class="form-control" type="text" value="${data}" data-name-input="nombre" data-documento-id="${row.id}" />
                            <span class="errors nombre_error text-danger"></span>`;
                        }
                    },
                    {
                        data: 'numero',
                        name: 'numero',
                        render: function(data, type, row, meta) {
                            return `<input class="form-control" type="text" value="${data}" data-name-input="numero" data-documento-id="${row.id}" />
                            <span class="errors numero_error text-danger"></span>`;
                        }
                    },
                    {
                        data: 'documentos',
                        name: 'documentos',
                        render: function(data, type, row, meta) {
                            if (data) {
                                const pdfFile = "{{ asset('img/pdf-file.png') }}";
                                return `
                            <div class="text-center" style="position:relative;">
                                <a target="_blank" class="text-center" href="${row.ruta_documento}" title="${data}">
                                    <img style="width:35px" src="${pdfFile}" class="img-fluid" alt="${data}" />
                                    <p class="m-0 text-muted" style="font-size:10px">${data.substring(0,35)}...</p>
                                </a>
                                <i data-documento-id="${row.id}" class="fas fa-times-circle removeFile" style="position:absolute; top:0;right: 58px;"></i>
                            </div>
                            `;
                            } else {
                                return `
                                <div class="text-center">
                                    <label for="documento${row.id}" class="text-center">
                                        <img src="{{ asset('img/upload-pdf.png') }}" style="width:40px" />
                                        <p class="m-0 text-muted" style="font-size:10px">Subir Documento</p>
                                    </label>
                                </div>
                                <input type="file" class="form-control d-none" id="documento${row.id}" data-name-input="file" data-documento-id="${row.id}"/>
                                <p class="m-0">
                                    <span class="errors documento_error text-danger"></span>
                                </p>
                                `;
                            }

                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlEliminar =
                                `/admin/empleado/${data}/documentos`;
                            let html = `
                            <button onclick="event.preventDefault(); EliminarDocumento('${urlEliminar}','${data}')" class="btn btn-sm text-primary"><i class="fas fa-trash-alt" style="color:#fd0000"></i></button>
                            `;
                            return html;
                        }
                    },

                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
            })
            //Eventos para editar registros
            document.getElementById('tbl-documentos').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT') {
                    if (e.target.type == 'file') {
                        const documentoId = e.target.getAttribute('data-documento-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const files = e.target.files;
                        const formData = new FormData();
                        files.forEach(element => {
                            formData.append(typeInput, element);
                        });
                        const url =
                            `/admin/empleados/update/${documentoId}/documentos`;
                        try {
                            const response = await fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content'),
                                },
                            })
                            const data = await response.json();
                            tblDocumentos.ajax.reload();
                            console.log(data);
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });
            document.getElementById('tbl-documentos').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT') {
                    if (e.target.type == 'text') {
                        const documentoId = e.target.getAttribute('data-documento-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${documentoId}/documentos`;
                        try {
                            const response = await fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content'),
                                },
                            })
                            const data = await response.json();
                            console.log(data);
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });
            document.getElementById('tbl-documentos').addEventListener('click', function(e) {
                if (e.target.tagName == 'I') {
                    if (e.target.classList.contains('removeFile')) {
                        const documentoId = e.target.getAttribute('data-documento-id');
                        Swal.fire({
                            title: 'Estás seguro de eliminar el documento?',
                            text: "Esto no se puede revertir!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si',
                            cancelButtonText: "No",
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                const url =
                                    `/admin/empleados/${documentoId}/delete-file-documento`;
                                try {
                                    const response = await fetch(url, {
                                        method: 'DELETE',
                                        headers: {
                                            Accept: "application/json",
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr(
                                                    'content'),
                                        },
                                    })
                                    const data = await response.json();
                                    tblDocumentos.ajax.reload();
                                } catch (error) {
                                    console.log(error);
                                }
                            }
                        })

                    }
                }
            });
            window.EliminarDocumento = function(url, documentoId) {
                Swal.fire({
                    title: 'Estás seguro de eliminar?',
                    text: "Esto no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                documentoId
                            },
                            beforeSend: function() {
                                toastr.info("Eliminando documento");
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    toastr.success("Documento eliminado");
                                    tblDocumentos.ajax.reload();
                                }
                            },
                            error: function(request, status, error) {
                                console.log(error)
                                $.each(request.responseJSON.errors, function(indexInArray,
                                    valueOfElement) {
                                    console.log(valueOfElement, indexInArray);
                                    $(`span.${indexInArray}_error`).text(
                                        valueOfElement[0]);
                                });
                            }
                        });
                    }
                })
            }

            // let url = "{{ route('admin.empleados.get') }}";
            document.getElementById('btn-agregar-experiencia').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                suscribirExperiencia()
            })

            document.getElementById('btn-agregar-educacion').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                suscribirEducacion()
            })

            document.getElementById('btn-suscribir-curso').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                suscribirCurso()
            })

            document.getElementById('btn-suscribir-certificado').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                suscribirCertificado()
            })


            document.getElementById('btnGuardar').addEventListener('click', function(e) {
                // e.preventDefault();
                // document.querySelector('#formEmpleados').submit();
                e.preventDefault();
                let formData = new FormData();
                if (document.getElementById('formEmpleados')) {
                    formData = new FormData(document.getElementById('formEmpleados'));
                }
                let documentos = document.getElementById('documentos').files;
                if (documentos.length) {
                    documentos.forEach(element => {
                        formData.append('files[]', element);
                    });
                }
                let url = "";
                let method = "POST";
                if (document.getElementById('urlFormEmpleados')) {
                    url = document.getElementById('urlFormEmpleados').getAttribute('data-url');
                } else {
                    url = document.getElementById('formEmpleados').getAttribute('action');
                }
                fetch(url, {
                        method: method,
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.errors) {
                            $.each(data.errors, function(indexInArray, valueOfElement) {
                                $(`#error_${indexInArray.replaceAll('.','_')}`).text(
                                    valueOfElement[0]);
                            });
                        }

                        if (data.status) {
                            Swal.fire(
                                data.message,
                                '',
                                'success',
                            )
                            if (data.from == 'curriculum') {
                                setTimeout(() => {
                                    window.location.href =
                                        "{{ route('admin.miCurriculum', $empleado) }}";
                                }, 1500);
                            } else if (data.from == 'rh') {
                                setTimeout(() => {
                                    window.location.href =
                                        "{{ route('admin.empleados.index') }}";
                                }, 1500);

                            }
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            })
        });

        function suscribirExperiencia() {
            //form-participantes

            let url = $("#formExperiencia").attr("action");

            $.ajax({
                type: "post",
                url: url,
                data: new FormData(document.getElementById("formExperiencia")),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    toastr.info("Guardando experiencia profesional");
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success("Experiencia profesional guardada");
                        limpiarCamposExperiencia();
                        tblExperiencia.ajax.reload();
                    }
                },
                error: function(request, status, error) {
                    console.log(error)
                    $.each(request.responseJSON.errors, function(indexInArray,

                        valueOfElement) {
                        console.log(valueOfElement, indexInArray);
                        $(`span.${indexInArray}_error`).text(valueOfElement[0]);

                    });
                }
            });
        }

        function limpiarCamposExperiencia() {
            $("#empresa").val('');
            $("#puesto_trabajo").val('');
            $("#descripcion").val('');
            $("#inicio_mes").val('');
            $("#fin_mes").val('');
        }

        function limpiarErrores() {
            document.querySelectorAll('.errors').forEach(element => {
                element.innerHTML = ''
            });
        }

        function enviarExperiencia() {
            let experiencias = tblExperiencia.rows().data().toArray();
            let arrExperiencia = [];
            experiencias.forEach(experiencia => {
                arrExperiencia.push(experiencia)

            });
            document.getElementById('experiencia').value = JSON.stringify(arrExperiencia);
            console.log(arrExperiencia);
        }

        function suscribirEducacion() {
            //form-participantes


            let url = $("#formEducacion").attr("action");

            $.ajax({
                type: "post",
                url: url,
                data: new FormData(document.getElementById("formEducacion")),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    toastr.info("Guardando educacion");
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success("Educación guardada");
                        limpiarCamposEducacion();
                        tblEducacion.ajax.reload();
                    }
                },
                error: function(request, status, error) {
                    console.log(error)
                    $.each(request.responseJSON.errors, function(indexInArray,

                        valueOfElement) {
                        console.log(valueOfElement, indexInArray);
                        $(`span.${indexInArray}_error`).text(valueOfElement[0]);

                    });
                }
            });
        }

        function limpiarCamposEducacion() {
            $("#institucion").val('');
            $("#año_inicio").val('');
            $("#año_fin").val('');
            $("#nivel").val('');
        }

        function enviarEducacion() {
            let educacions = tblEducacion.rows().data().toArray();
            let arrEducacion = [];
            educacions.forEach(educacion => {
                arrEducacion.push(educacion)

            });
            document.getElementById('educacion').value = JSON.stringify(arrEducacion);
            console.log(arrEducacion);
        }


        function suscribirCurso() {

            let url = $("#formCursos").attr("action");

            $.ajax({
                type: "post",
                url: url,
                data: new FormData(document.getElementById("formCursos")),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    toastr.info("Guardando curso");
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success("Curso guardado");
                        limpiarCamposCursos();
                        tblCurso.ajax.reload();
                    }
                },
                error: function(request, status, error) {
                    console.log(error)
                    $.each(request.responseJSON.errors, function(indexInArray,

                        valueOfElement) {
                        console.log(valueOfElement, indexInArray);
                        $(`span.${indexInArray}_error`).text(valueOfElement[0]);

                    });
                }
            });
        }

        function limpiarCamposCursos() {
            $("#curso_diplomado").val('');
            $("#tipo").val('');
            $("#año").val('');
            $("#duracion").val('');
        }

        function enviarCurso() {
            let cursos = tblCurso.rows().data().toArray();
            let arrCurso = [];
            cursos.forEach(curso => {
                arrCurso.push(curso)

            });
            document.getElementById('curso').value = JSON.stringify(arrCurso);
            console.log(arrCurso);
        }

        function suscribirCertificado() {

            let url = $("#formCertificaciones").attr("action");
            const formData = new FormData(document.getElementById("formCertificaciones"));
            const aplicaVigencia = document.getElementById('aplicaVigencia');
            formData.append('esVigente', aplicaVigencia.checked)
            $.ajax({
                type: "post",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    toastr.info("Guardando certificado");
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success("Certificado guardado");
                        limpiarCamposCertificados();
                        tblCertificado.ajax.reload();
                    }
                },
                error: function(request, status, error) {
                    console.log(error)
                    $.each(request.responseJSON.errors, function(indexInArray,

                        valueOfElement) {
                        console.log(valueOfElement, indexInArray);
                        $(`span.${indexInArray}_error`).text(valueOfElement[0]);

                    });
                }
            });
        }

        function limpiarCamposCertificados() {
            $("#nombre_certificado").val('');
            $("#vigencia").val('');
            $("#vencio_alta").val('');
            $("#evidencia").val('');

        }

        function enviarCertificado() {
            let certificados = tblCertificado.rows().data().toArray();
            let arrCertificado = [];
            certificados.forEach(certificado => {
                arrCertificado.push(certificado)

            });
            document.getElementById('certificado').value = JSON.stringify(arrCertificado);
            console.log(arrCertificado);
        }
    </script>
    <script type="text/javascript">
        Livewire.on('PerfilStore', () => {
            $('#PerfilModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Perfil de empleado creado con éxito');
        });

        Livewire.on('PuestoStore', () => {
            $('#PuestoModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Puesto de empleado creado con éxito');
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

        document.addEventListener('DOMContentLoaded', function() {
            var headers = {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
                'Access-Control-Allow-Origin': 'https://api.flaticon.com/v2'
            };


        })
    </script>
@endsection
