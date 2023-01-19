@extends('layouts.admin')
@section('content')
    @if ($isEditAdmin)
        {{ Breadcrumbs::render('empleados-edit', $empleado) }}
    @else
        <style>
            .breadcrumb {
                margin-bottom: 0 !important;
            }
        </style>
        {{ Breadcrumbs::render('Editar-Curriculum', $empleado) }}
    @endif
    <style>
        .select2-container {
            margin-top: 0px !important;
        }

        .nav-tabs .nav-link.active {
            border-top: solid 2px #3490dc;
        }

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
            /*color: white;*/
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

        .collapse:not(.show) {
            display: inline;
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Editar: Empleado - {{ $empleado->name }}</h5>
    <div class="mt-4 card">
        @if ($isEditAdmin)
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
                            <i class="mr-2 fas fa-award" style="font-size:20px;"></i>Perfil Profesional
                        </a>
                        <a class="nav-link" id="nav-documentos-tab" data-toggle="tab" href="#nav-documentos" role="tab"
                            aria-controls="nav-documentos" aria-selected="false">
                            <i class="mr-2 fas fa-folder-open" style="font-size:20px;"></i>Expediente
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
                        <div class="tab-pane fade" id="nav-financiera" role="tabpanel" aria-labelledby="nav-financiera-tab">
                            @include('admin.empleados.form_components.financiera')

                        </div>
                        <div class="tab-pane fade" id="nav-competencias" role="tabpanel"
                            aria-labelledby="nav-competencias-tab">
                            @include('admin.empleados.components._competencias_form')
                        </div>
                        <div class="tab-pane fade" id="nav-documentos" role="tabpanel" aria-labelledby="nav-documentos-tab">
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
            <div class="p-4">
                <div class="mt-4 text-center form-group"
                    style="background-color:#345183; border-radius: 100px; color: white;">
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
    </div>
    <x-loading-indicator />
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
            const setDirectionOnInput = (direction) => {
                if (document.getElementById('direccion')) {
                    document.getElementById('direccion').value = direction;
                }
            }
            let direccion_empleado_actual = @json($empleado->sede ? $empleado->sede->direccion : null);
            setDirectionOnInput(direccion_empleado_actual);
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

            if (document.getElementById('sede_id')) {

                document.getElementById('sede_id').addEventListener('change', function(e) {
                    const direction = e.target.options[e.target.selectedIndex].getAttribute(
                        'data-direction');
                    setDirectionOnInput(direction);
                })
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

            $('#nacionalidad').select2({
                theme: 'bootstrap4',
                templateResult: customizeNationalitySelect,
                templateSelection: customizeNationalitySelect
            });

            window.lenguajes = @json($idiomas);

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
        if (habilitarFotoBtn) {
            habilitarFotoBtn.addEventListener('click', function(e) {
                e.preventDefault();
                contendorCanvas.style.display = 'grid';
                document.getElementById("foto").value = "";
                $("#texto-imagen").text("Subir Imágen");
            });
        }
        // feather.replace();

        const controls = document.querySelector('.controls');
        const cameraOptions = document.querySelector('.video-options>select');
        const video = document.querySelector('video');
        const canvas = document.querySelector('canvas');
        const screenshotImage = document.querySelector('.screenshot-image');
        const inputShotURL = document.getElementById('snapshoot');
        if (controls) {

        }
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
                initComplete: function(settings, json) {
                    renderizarFlatPickr();
                },
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
                            <textarea class="form-control" type="text" data-name-input="descripcion" data-experiencia-id="${row.id}" style="min-height: 25px !important;" >${data}</textarea>
                            <span class="errors descripcion_error text-danger"></span>
                            `;
                        }
                    },
                    {
                        data: 'inicio_mes',
                        name: 'inicio_mes',
                        render: function(data, type, row, meta) {
                            console.log(row)
                            if (data) {
                                return `<input class="fecha_flatpickr form-control" type="text" value="${data}" data-name-input="inicio_mes" data-experiencia-id="${row.id}" />
                                <span class="errors inicio_mes_error text-danger"></span>`;

                            } else {
                                return `<input class="fecha_flatpickr form-control" type="text" value="" data-name-input="inicio_mes"  data-experiencia-id="${row.id}" />
                                <span class="errors inicio_mes_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'fin_mes',
                        name: 'fin_mes',
                        render: function(data, type, row, meta) {
                            console.log(row.trabactualmente);
                            if (row.trabactualmente) {
                                return `Trabajo actual
                                <input class="form-group" type="checkbox" ${row.trabactualmente ? 'checked': ''} data-name-input="trabactualmente" data-experiencia-id="${row.id}" />
                                <span class="errors fin_mes_error text-danger"></span>
                                `;
                            }
                            if (data) {
                                return `<input class="form-control fecha_flatpickr"  type="text" value="${data}" data-name-input="fin_mes" data-experiencia-id="${row.id}" />
                                <span class="errors fin_mes_error text-danger"></span>`;

                            } else {
                                return `<input class="form-control fecha_flatpickr"  type="text" value="" data-name-input="fin_mes" data-experiencia-id="${row.id}" />
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
            });

            //Eventos para editar registros
            document.getElementById('tbl-experiencia').addEventListener('change', async function(e) {
                console.log(e.tagName);
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA' || e.target.tagName ==
                    'SELECT') {
                    console.log(e.target.type)
                    if (e.target.type == 'date' || e.target.type == 'select-one' || e.target.type ==
                        'number' || e.target.type == 'checkbox' || e.target.classList.contains(
                            'fecha_flatpickr')) {
                        const experienciaId = e.target.getAttribute('data-experiencia-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        let value = e.target.value;
                        // Funcion del cambio de javascript
                        if (e.target.type == 'checkbox') {
                            value = e.target.checked;
                            tblExperiencia.ajax.reload(() => {
                                renderizarFlatPickr();
                            });
                        }
                        console.log(experienciaId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        let oldValue = e.target.value;
                        try {
                            const url =
                                `/admin/empleados/update/${experienciaId}/competencias-experiencia`;
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });

            document.getElementById('tbl-experiencia').addEventListener('keyup', async function(e) {
                console.log(e.target.tagName);
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
                    if (e.target.type == 'text' || e.target.type == 'textarea' || e.target.type ==
                        'number') {
                        const experienciaId = e.target.getAttribute('data-experiencia-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(value, typeInput, experienciaId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${experienciaId}/competencias-experiencia`;
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(errror);
                        }
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
                                    tblExperiencia.ajax.reload(() => {
                                        renderizarFlatPickr();
                                    });
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
                initComplete: function(settings, json) {
                    renderizarFlatPickr();
                },
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
                        data: 'titulo_obtenido',
                        name: 'titulo_obtenido',
                        render: function(data, type, row, meta) {
                            if (!data) {
                                return `
                                <input class="form-control" type="text" value="" placeholder="Dato no registrado" data-name-input="titulo_obtenido" data-educacion-id="${row.id}" />
                                <span class="errors titulo_obtenido_error text-danger"></span>
                                `;
                            }
                            return `
                            <input class="form-control" type="text" value="${data}" data-name-input="titulo_obtenido" data-educacion-id="${row.id}" />
                            <span class="errors titulo_obtenido_error text-danger"></span>
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
                        data: 'año_inicio',
                        name: 'año_inicio',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<input class="fecha_flatpickr form-control" type="text" value="${data}" data-name-input="año_inicio" data-educacion-id="${row.id}" />
                                <span class="errors año_inicio_error text-danger"></span>`;

                            } else {
                                return `<input class="fecha_flatpickr form-control" type="text" value="" data-name-input="año_inicio" data-educacion-id="${row.id}" />
                                <span class="errors año_inicio_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'año_fin',
                        name: 'año_fin',
                        render: function(data, type, row, meta) {
                            if (row.estudactualmente) {
                                return `estudiando actualmente
                                <input class="form-group" type="checkbox" ${row.estudactualmente ? 'checked': ''} data-name-input="estudactualmente" data-educacion-id="${row.id}" />
                                <span class="errors año_fin_error text-danger"></span>
                                `;
                            }
                            if (data) {
                                return `<input class="fecha_flatpickr form-control" type="text" value="${data}" data-name-input="año_fin" data-educacion-id="${row.id}" />
                                <span class="errors año_fin_error text-danger"></span>`;

                            } else {
                                return `<input class="fecha_flatpickr form-control" type="text" value="" data-name-input="año_fin" data-educacion-id="${row.id}" />
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
            })

            document.getElementById('tbl-educacion').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA' || e.target.tagName ==
                    'SELECT') {
                    if (e.target.type == 'date' || e.target.type == 'select-one' || e.target.type ==
                        'number' || e.target.type == 'checkbox' || e.target.classList.contains(
                            'fecha_flatpickr')) {
                        const educacionId = e.target.getAttribute('data-educacion-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        let value = e.target.value;
                        if (e.target.type == 'checkbox') {
                            value = e.target.checked;
                            tblEducacion.ajax.reload(() => {
                                renderizarFlatPickr();
                            });
                        }
                        console.log(educacionId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${educacionId}/competencias-educacion`;
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });

            document.getElementById('tbl-educacion').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
                    if (e.target.type == 'text' || e.target.type == 'textarea' || e.target.type ==
                        'number') {
                        const educacionId = e.target.getAttribute('data-educacion-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(value, typeInput, educacionId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${educacionId}/competencias-educacion`;
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(error);
                        }
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
                                    tblEducacion.ajax.reload(() => {
                                        renderizarFlatPickr();
                                    });
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
                        data: 'fecha_fin_ymd',
                        name: 'fecha_fin_ymd',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<input class="form-control" type="date" value="${data}" data-name-input="fecha_fin" data-curso-id="${row.id}" />
                                <span class="errors fecha_fin_error text-danger"></span>`;

                            } else {
                                return `<input class="form-control" type="date" value="" data-name-input="fecha_fin" data-curso-id="${row.id}" />
                                <span class="errors fecha_fin_error text-danger"></span>`;
                            }
                        }
                    },
                    {
                        data: 'duracion',
                        name: 'duracion',
                        render: function(data, type, row, meta) {
                            return `
                            <div class="form-control"
                                type="number"
                                data-name-input="duracion"
                                data-name-input-id="duracion${row.id}"
                                data-curso-id="${row.id}"
                            />
                            <small>${data} Día(s)</small>
                            </div>
                            `;
                        }
                    },
                    {
                        data: 'file',
                        name: 'file',
                        render: function(data, type, row, meta) {
                            if (data) {
                                const pdfFile = "{{ asset('img/pdf-file.png') }}";
                                const assetDocumentosUrl =
                                    "{{ asset('storage/cursos_empleados/') }}";
                                return `
                            <div class="text-center" style="position:relative;">
                                <a target="_blank" class="text-center" href="${assetDocumentosUrl}/${data}" title="${data}">
                                    <img style="width:35px" src="${pdfFile}" class="img-fluid" alt="${data}" />
                                    <p class="m-0 text-muted" style="font-size:10px">${data.substring(0,35)}...</p>
                                </a>
                                <i data-curso-id="${row.id}" class="fas fa-times-circle removeFileCurso" style="position:absolute; top:0;right: 58px;"></i>
                            </div>
                            `;
                            } else {
                                return `
                                <div class="text-center">
                                    <label for="documento_curso${row.id}" class="text-center">
                                        <img src="{{ asset('img/upload-pdf.png') }}" style="width:40px" />
                                        <p class="m-0 text-muted" style="font-size:10px">Subir Documento</p>
                                    </label>
                                </div>
                                <input type="file" class="form-control d-none" id="documento_curso${row.id}" data-curso-id="${row.id}"/>
                                <p class="m-0">
                                    <span class="errors file_error text-danger"></span>
                                </p>
                                `;
                            }

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
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA' || e.target.tagName ==
                    'SELECT') {
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                            if (e.target.type == 'date') {
                                let elemento_duracion = document.querySelector(
                                    `div[data-name-input-id="duracion${cursoId}"]`)
                                elemento_duracion.innerHTML =
                                    `<small>${data.curso.duracion} Día(s)</small>`;
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    } else if (e.target.type == 'file') {
                        const cursoId = e.target.getAttribute('data-curso-id');
                        console.log(cursoId);
                        const formData = new FormData();
                        e.target.files.forEach(element => {
                            formData.append('file', element);
                        });
                        const url =
                            `/admin/empleados/update/${cursoId}/competencias-curso`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                        })
                        tblCurso.ajax.reload();
                    }
                }
            });
            document.getElementById('tbl-cursos').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
                    if (e.target.type == 'text' || e.target.type == 'textarea' || e.target.type ==
                        'number') {
                        const cursoId = e.target.getAttribute('data-curso-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(value, typeInput, cursoId);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/empleados/update/${cursoId}/competencias-curso`;
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });
            document.getElementById('tbl-cursos').addEventListener('click', function(e) {
                console.log('si');
                if (e.target.tagName == 'I') {
                    if (e.target.classList.contains('removeFileCurso')) {
                        const cursoId = e.target.getAttribute('data-curso-id');
                        Swal.fire({
                            title: 'Estás seguro de eliminar el archivo?',
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
                                    `/admin/empleados/${cursoId}/delete-file-curso`;
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
                                    if (data.status == 'success') {
                                        mostrarEstadoExitoso(e.target);
                                    }
                                    if (data.errors) {
                                        let errorN = e.target.getAttribute('data-name-input');
                                        data.errors[errorN].forEach(element => {
                                            toastr.error(element);
                                        });
                                    }
                                    tblCurso.ajax.reload();
                                } catch (error) {
                                    console.log(error);
                                }
                            }
                        })

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
                                <input type="file" class="form-control d-none" id="documento${row.id}" data-certificacion-id="${row.id}"/>
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

            })
            //Eventos para editar registros
            document.getElementById('tbl-certificados').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(error);
                        }

                    } else if (e.target.type == 'file') {
                        const certificadoId = e.target.getAttribute('data-certificacion-id');
                        const formData = new FormData();
                        e.target.files.forEach(element => {
                            formData.append('documento', element);
                        });
                        const url =
                            `/admin/empleados/update/${certificadoId}/competencias-certificaciones`;
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
                            tblCertificado.ajax.reload();
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });
            document.getElementById('tbl-certificados').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
                    if (e.target.type == 'text') {
                        const certificadoId = e.target.getAttribute('data-certificacion-id');
                        const certificadoName = e.target.value;
                        const formData = new FormData();
                        formData.append('nombre', certificadoName);
                        const url =
                            `/admin/empleados/update/${certificadoId}/competencias-certificaciones`;
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });
            document.getElementById('tbl-certificados').addEventListener('click', function(e) {
                console.log('si');
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
                                    if (data.status == 'success') {
                                        mostrarEstadoExitoso(e.target);
                                    }
                                    if (data.errors) {
                                        let errorN = e.target.getAttribute('data-name-input');
                                        data.errors[errorN].forEach(element => {
                                            toastr.error(element);
                                        });
                                    }
                                    tblCertificado.ajax.reload();
                                } catch (error) {
                                    console.log(error);
                                }
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
                });

            // IDIOMAS
            window.tblIdiomas = $('#tbl-idiomas').DataTable({
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.idiomas-empleados.index', $empleado->id) }}",
                columns: [{
                        data: 'id_language',
                        name: 'id_language',
                        render: function(data, type, row, meta) {
                            html = `
                            <select class="form-control" data-idioma-id="${row.id}" data-name-input="id_language" >`
                            lenguajes.forEach(lenguaje => {
                                html +=
                                    `<option value="${lenguaje.id}" ${data ==  lenguaje.id ? "selected":''}>${lenguaje.idioma}</option>`
                            })
                            html += `</select>
                            `;

                            return html;
                        }
                    },
                    {
                        data: 'nivel',
                        name: 'nivel',
                        render: function(data, type, row, meta) {
                            let select = `
                            <select class="form-control" data-idioma-id="${row.id}" data-name-input="nivel">
                                <option value="" disabled selected>
                                    Selecciona una opción
                                </option>`;
                            let opciones = @json(App\Models\IdiomaEmpleado::NIVELES);
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
                        data: 'porcentaje',
                        name: 'porcentaje',
                        render: function(data, type, row, meta) {
                            return `
                            <input class="form-control" type="number" value="${data}" data-name-input="porcentaje" data-idioma-id="${row.id}" />
                            <span class="errors porcentaje_error text-danger"></span>
                            `;
                        }
                    },
                    {
                        data: 'certificado',
                        name: 'certificado',
                        render: function(data, type, row, meta) {
                            if (data) {
                                const pdfFile = "{{ asset('img/pdf-file.png') }}";
                                const assetDocumentosUrl =
                                    "{{ asset('storage/idiomas_empleados/') }}";
                                return `
                            <div class="text-center" style="position:relative;">
                                <a target="_blank" class="text-center" href="${assetDocumentosUrl}/${data}" title="${data}">
                                    <img style="width:35px" src="${pdfFile}" class="img-fluid" alt="${data}" />
                                    <p class="m-0 text-muted" style="font-size:10px">${data.substring(0,35)}...</p>
                                </a>
                                <i data-idioma-id="${row.id}" class="fas fa-times-circle removeFileIdioma" style="position:absolute; top:0;right: 58px;"></i>
                            </div>
                            `;
                            } else {
                                return `
                                <div class="text-center">
                                    <label for="documento_curso${row.id}" class="text-center">
                                        <img src="{{ asset('img/upload-pdf.png') }}" style="width:40px" />
                                        <p class="m-0 text-muted" style="font-size:10px">Subir Documento</p>
                                    </label>
                                </div>
                                <input type="file" class="form-control d-none" id="documento_curso${row.id}" data-idioma-id="${row.id}"/>
                                <p class="m-0">
                                    <span class="errors file_error text-danger"></span>
                                </p>
                                `;
                            }

                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, route, meta) {
                            let urlEliminar =
                                `/admin/competencia/idiomas-empleados/${data}`;
                            let html = `
                            <button onclick="event.preventDefault(); EliminarIdioma('${urlEliminar}','${data}')" class="btn btn-sm text-primary"><i class="fas fa-trash-alt" style="color:#fd0000"></i></button>
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
            document.getElementById('tbl-idiomas').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA' || e.target.tagName ==
                    'SELECT') {
                    if (e.target.type == 'date' || e.target.type == 'select-one' || e.target.type ==
                        'number') {
                        const idiomaID = e.target.getAttribute('data-idioma-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        console.log(idiomaID);
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/competencia/${idiomaID}/idiomas`;
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
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    } else if (e.target.type == 'file') {
                        const idiomaID = e.target.getAttribute('data-idioma-id');
                        console.log(idiomaID);
                        const formData = new FormData();
                        e.target.files.forEach(element => {
                            formData.append('certificado', element);
                        });
                        const url =
                            `/admin/competencia/${idiomaID}/idiomas`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                        })
                        tblIdiomas.ajax.reload();
                    }
                }
            });
            document.getElementById('tbl-idiomas').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
                    if (e.target.type == 'text' || e.target.type == 'textarea' || e.target.type ==
                        'number') {
                        const idiomaID = e.target.getAttribute('data-idioma-id');
                        const typeInput = e.target.getAttribute('data-name-input');
                        const value = e.target.value;
                        const formData = new FormData();
                        formData.append(typeInput, value);
                        const url =
                            `/admin/competencia/${idiomaID}/idiomas`;
                        try {
                            const response = await fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content'),
                                },
                            })
                            const data = await response.json();
                            if (data.status == 'success') {
                                mostrarEstadoExitoso(e.target);
                            }
                            if (data.errors) {
                                let errorN = e.target.getAttribute('data-name-input');
                                data.errors[errorN].forEach(element => {
                                    toastr.error(element);
                                });
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });
            document.getElementById('tbl-idiomas').addEventListener('click', function(e) {
                if (e.target.tagName == 'I') {
                    if (e.target.classList.contains('removeFileIdioma')) {
                        const idiomaID = e.target.getAttribute('data-idioma-id');
                        Swal.fire({
                            title: 'Estás seguro de eliminar el archivo?',
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
                                    `/admin/competencia/${idiomaID}/idiomas-delete-certificado`;
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
                                    if (data.status == 'success') {
                                        mostrarEstadoExitoso(e.target);
                                    }
                                    if (data.errors) {
                                        let errorN = e.target.getAttribute('data-name-input');
                                        data.errors[errorN].forEach(element => {
                                            toastr.error(element);
                                        });
                                    }
                                    tblIdiomas.ajax.reload();
                                } catch (error) {
                                    console.log(error);
                                }
                            }
                        })

                    }
                }
            });
            window.EliminarIdioma = function(url, cursoId) {
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
                                toastr.info("Eliminando idioma");
                            },
                            success: function(response) {
                                if (response.status == "success") {
                                    toastr.success("Idioma eliminado");
                                    tblIdiomas.ajax.reload();
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
            // FIN IDIOMAS
            if (document.getElementById("btnGuardarDocumento")) {
                document.getElementById("btnGuardarDocumento").addEventListener("click", async function(e) {
                    e.preventDefault();
                    limpiarErrores();
                    let url = $("#formDocumentos").attr("action");
                    const formulario = document.getElementById('formDocumentos');
                    const formData = new FormData();
                    formData.append('nombre', document.getElementById('nombre_doc').value)
                    formData.append('numero', document.getElementById('numero_doc').value)
                    let documentosDoc = document.getElementById('documentos_doc').files;
                    documentosDoc.forEach(element => {
                        formData.append('file', element)
                    });
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
                                'Por favor revise que la información ingresa sea correcta'
                            );
                        }
                        if (data.status) {
                            tblDocumentos.ajax.reload();
                            limpiarCamposDocumentos();
                        }
                    } catch (error) {
                        console.log(error);
                    }
                })
            }

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
                        data: 'tipo',
                        name: 'tipo',
                        render: function(data, type, row, meta) {
                            return `
                            <font class="${data}">${data}</font>`;
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
                        data: 'archivado',
                        name: 'archivado',
                        render: function(data, type, row, meta) {
                            return `
                            <font class="archivo_${data}"></font>`;
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
            if (document.getElementById('tbl-documentos')) {
                document.getElementById('tbl-documentos').addEventListener('change', async function(e) {
                    if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
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
                    if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
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
                                                'X-CSRF-TOKEN': $(
                                                        'meta[name="csrf-token"]')
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
            }
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            document.getElementById('btn-agregar-idioma').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                suscribirIdioma()
            })


            document.getElementById('btnGuardar').addEventListener('click', function(e) {
                // e.preventDefault();
                // document.querySelector('#formEmpleados').submit();
                e.preventDefault();
                let formData = new FormData();
                if (document.getElementById('formEmpleados')) {
                    formData = new FormData(document.getElementById('formEmpleados'));
                }
                if (document.getElementById('documentos')) {
                    let documentos = document.getElementById('documentos').files;
                    if (documentos.length) {
                        documentos.forEach(element => {
                            formData.append('files[]', element);
                        });
                    }
                }
                let url = "";
                let method = "POST";
                if (document.getElementById('urlFormEmpleados')) {
                    url = document.getElementById('urlFormEmpleados').getAttribute('data-url');
                } else {
                    url = document.getElementById('formEmpleados').getAttribute('action');
                }
                document.getElementById('loaderComponent').style.display = 'block';
                fetch(url, {
                        method: method,
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json()
                        }
                        return response.json().then(text => {
                            throw text;
                        })
                    })
                    .then(data => {
                        if (data.errors) {
                            document.getElementById('loaderComponent').style.display = 'none';
                            $.each(data.errors, function(indexInArray, valueOfElement) {
                                $(`#error_${indexInArray.replaceAll('.','_')}`).text(
                                    valueOfElement[0]);
                            });
                        }

                        if (data.status) {
                            document.getElementById('loaderComponent').style.display = 'none';
                            Swal.fire(
                                data.message,
                                '',
                                'success',
                            ).then(() => {
                                if (data.from == 'curriculum') {
                                    window.location.href =
                                        "{{ route('admin.miCurriculum', $empleado) }}";
                                } else if (data.from == 'rh') {
                                    window.location.href =
                                        "{{ route('admin.empleados.index') }}";
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        if (error.exception == 'Swift_TransportException') {
                            document.getElementById('loaderComponent').style.display = 'none';
                            toastr.error(
                                'El email de Bienvenida no fue enviado con éxito, tendrás que enviarlo manualmente, comunicate con el administrador.'
                            );
                            Swal.fire(
                                'Empleado Creado',
                                '',
                                'success',
                            ).then(() => {
                                window.location.href =
                                    "{{ route('admin.empleados.index') }}";

                            })
                        }

                        if (error.message == 'The given data was invalid.') {
                            document.getElementById('loaderComponent').style.display = 'none';
                            $.each(error.errors, function(indexInArray, valueOfElement) {
                                $(`#error_${indexInArray.replaceAll('.','_')}`).text(
                                    valueOfElement[0]);
                            });
                            toastr.error(
                                'Tu resgitro contiene errores de validación, revisa los inputs por favor.'
                            );
                        }
                    })
            })
        });

        function suscribirExperiencia() {
            //form-participantes

            let url = $("#formExperiencia").attr("action");
            let formData = new FormData();
            formData.append('empresa', document.getElementById('empresa').value)
            formData.append('puesto', document.getElementById('puesto_trabajo').value)
            formData.append('empleado_id', document.getElementById('empleado_id_experiencia').value)
            formData.append('inicio_mes', document.getElementById('inicio_mes').value)
            formData.append('fin_mes', document.getElementById('fin_mes').value)
            formData.append('descripcion', document.getElementById('descripcion_exp').value)
            formData.append('trabactualmente', document.getElementById('trabactualmente').checked)
            $.ajax({
                type: "post",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    toastr.info("Guardando experiencia profesional");
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success("Experiencia profesional guardada");
                        limpiarCamposExperiencia();
                        tblExperiencia.ajax.reload(() => {
                            renderizarFlatPickr();
                        });
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

        function renderizarFlatPickr() {
            $(".fecha_flatpickr").flatpickr({
                locale: {
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May',
                            'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov',
                            'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril',
                            'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre',
                            'Diciembre'
                        ],
                    },
                },
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true, //defaults to false
                        dateFormat: "F Y", //defaults to "F Y"
                        altFormat: "F Y", //defaults to "F Y"
                        theme: "light" // defaults to "light"
                    })
                ]
            });
        }

        function mostrarEstadoExitoso(item) {
            item.style.border = "2px solid #00FA34";
            setTimeout(() => {
                item.style.border = "1px solid #d0d5db";
            }, 1500);
        }

        function limpiarCamposExperiencia() {
            $("#empresa").val('');
            $("#puesto_trabajo").val('');
            $("#descripcion_exp").val('');
            $("#inicio_mes").val('');
            $("#fin_mes").val('');
            $("#trabactualmente").val('');

        }

        function limpiarCamposDocumentos() {
            $("#nombre_doc").val('');
            $("#numero_doc").val('');
            $("#documentos_doc").val('');
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
            let formData = new FormData();
            formData.append('institucion', document.getElementById('institucion_inst').value)
            formData.append('titulo_obtenido', document.getElementById('titulo_obtenido_inst').value)
            formData.append('nivel', document.getElementById('nivel_inst').value)
            formData.append('año_inicio', document.getElementById('año_inicio_inst').value)
            formData.append('año_fin', document.getElementById('año_fin_inst').value)
            formData.append('empleado_id', document.getElementById('empleado_id_inst').value)
            formData.append('estudactualmente', document.getElementById('estudactualmente').checked)

            $.ajax({
                type: "post",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    toastr.info("Guardando educacion");
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success("Educación guardada");
                        limpiarCamposEducacion();
                        tblEducacion.ajax.reload(() => {
                            renderizarFlatPickr();
                        });
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
            $("#institucion_inst").val('');
            $("#titulo_obtenido_inst").val('');
            $("#año_inicio_inst").val('');
            $("#año_fin_inst").val('');
            $("#nivel_inst").val('');
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
            let formData = new FormData();
            formData.append('curso_diploma', document.getElementById('curso_diplomado').value)
            formData.append('tipo', document.getElementById('tipo').value)
            formData.append('año', document.getElementById('año').value)
            // formData.append('duracion', document.getElementById('duracion').value)
            let archivos = document.getElementById('file_curso').files;
            archivos.forEach(element => {
                formData.append('file', element);
            });
            formData.append('fecha_fin', document.getElementById('fecha_fin').value)
            formData.append('empleado_id', document.getElementById('empleado_id_curso').value)
            $.ajax({
                type: "post",
                url: url,
                data: formData,
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
            $("#fecha_fin").val('');
            $("#file_curso").val('');
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

        function suscribirIdioma() {

            let url = $("#formIdiomas").attr("action");
            let formData = new FormData();
            formData.append('id_language', document.getElementById('nombre_idioma').value)
            formData.append('nivel', document.getElementById('nivel_idioma').value)
            formData.append('porcentaje', document.getElementById('porcentaje_idioma').value)
            // formData.append('duracion', document.getElementById('duracion').value)
            let archivos = document.getElementById('certificado_idioma').files;
            archivos.forEach(element => {
                formData.append('certificado', element);
            });
            formData.append('empleado_id', document.getElementById('empleado_id_idioma').value)
            $.ajax({
                type: "post",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    toastr.info("Guardando Idioma");
                },
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success("Idioma guardado");
                        limpiarCamposIdioma();
                        tblIdiomas.ajax.reload();
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

        function limpiarCamposIdioma() {
            $("#nombre_idioma").val('');
            $("#nivel_idioma").val('');
            $("#porcentaje_idioma").val('');
            $("#certificado_idioma").val('');
        }

        function suscribirCertificado() {
            let url = $("#formCertificaciones").attr("action");
            const formData = new FormData();
            const nombre_certificado = document.getElementById("nombre_certificado");
            const vigencia = document.getElementById("vigencia");
            const vencio_alta = document.getElementById('vencio_alta');
            const aplicaVigencia = document.getElementById('aplicaVigencia');
            const evidencia = document.getElementById('evidencia');
            formData.append('nombre', nombre_certificado.value);
            formData.append('esVigente', aplicaVigencia.checked)
            formData.append('vigencia', vigencia.value);
            formData.append('estatus', vencio_alta.value);
            evidencia.files.forEach(element => {
                formData.append('documento', element);
            });
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
        $('.select2').select2({
            'theme': 'bootstrap4'
        });
        window.initSelect2 = () => {
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
    {{-- Evento de trabactualmente habilita y deshabilita los inputs --}}
    <script>
        $(document).ready(function() {
            $('#trabactualmente').on('change', function() {
                if (this.checked) {
                    $("#fin_mes_contenedor").hide();
                } else {
                    $("#fin_mes_contenedor").show();
                }

            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#estudactualmente').on('change', function() {
                if (this.checked) {
                    $("#año_fin_contenedor").hide();
                } else {
                    $("#año_fin_contenedor").show();
                }
            })
        });
    </script>


    <script>
        $(document).ready(function() {
            $(".yearpicker").yearpicker()

        });
    </script>

    <script>
        $(".datepicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true //to close picker once year is selected
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '#nombre_doc', function(event) {
            let op_select = $('#nombre_doc option:selected').attr('data-activar');
            console.log(op_select);
            if (op_select == 'si') {
                $('#group_numero_activo').addClass('d-block');
                $('#group_numero_activo').removeClass('d-none');
            }
            if (op_select == 'no') {
                $('#group_numero_activo').addClass('d-none');
                $('#group_numero_activo').removeClass('d-block');
            }

            let tipo_doc = $('#nombre_doc option:selected').attr('data-tipo');

            document.querySelector('#tipo_doc').innerHTML = tipo_doc;
            $('#tipo_doc').removeClass('opcional');
            $('#tipo_doc').removeClass('obligatorio');
            $('#tipo_doc').removeClass('aplica');
            $('#tipo_doc').addClass(tipo_doc);
        });
    </script>

    <script type="text/javascript">
        $(function() {
            // var dtOverrideGlobals = {
            //     buttons: [],
            //     "bDestroy": true,
            //     pageLength: 20,
            // };
            // let table = $('#tabla_docs').DataTable(dtOverrideGlobals);

            document.getElementById('tabla_docs').addEventListener('keyup', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
                    try {
                        let formData = new FormData();
                        formData.append('name', e.target.getAttribute('name'));
                        formData.append('value', e.target.value);
                        formData.append('documentoId', e.target.getAttribute('data-id'));
                        formData.append('empleadoId', e.target.getAttribute('data-empleado'));
                        const url = '{{ route('admin.inicio-Usuario.expediente-update') }}';
                        formData.forEach(item => console.log(item));
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })

                        const data = await response.json()
                        console.log(data);
                    } catch (error) {
                        toastr.error(error);
                    }
                }
            });

            // file
            document.getElementById('tabla_docs').addEventListener('change', async function(e) {
                if (e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA') {
                    try {
                        console.log(e.target.files);
                        let formData = new FormData();
                        formData.append('name', e.target.getAttribute('name'));
                        if (e.target.getAttribute('name') == 'file') {
                            formData.append('value', e.target.files[0]);
                        } else {
                            formData.append('value', e.target.value);
                        }
                        formData.append('documentoId', e.target.getAttribute('data-id'));
                        formData.append('empleadoId', e.target.getAttribute('data-empleado'));
                        const url = '{{ route('admin.empleado.edit.expediente-update') }}';
                        formData.forEach(item => console.log(item));
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        })

                        const data = await response.json()
                        console.log(data);
                        if (data.status == 201) {
                            toastr.success(data.message);
                            setTimeout(() => {
                                renderTableExpediente();
                                // window.location.reload();
                            }, 800);
                        }
                    } catch (error) {
                        toastr.error(error);
                    }
                }
            });
            renderTableExpediente();
        });

        function renderTableExpediente() {
            let tbody = document.getElementById('tablaDocsTbody');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.inicio-Usuario.expediente-getListaDocumentos', $empleado->id) }}",
                // data: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "JSON",
                success: function(response) {
                    let listaDocs = response;
                    let empleado = @json($empleado);
                    let htmlTbodyInner = "";
                    listaDocs.forEach(doc => {
                        htmlTbodyInner += `
                <tr>
                    <td>
                        <font class="${doc.tipo}">${doc.tipo}</font>
                    </td>
                    <td>${doc.documento}</td>
                    <td>
                        <input id="" data-id="${doc.id}" data-empleado="${empleado.id}"
                            name="numero" class="form-control"
                            value="${doc.empleado?((doc.empleado.numero==null||doc.empleado.numero=='null')?'':doc.empleado.numero):''}">
                    </td>
                    <td style=" display: flex;justify-content: center; position: relative;">`;
                        if (doc.ruta_documento) {
                            htmlTbodyInner += `
                                <a target="_blank" href="${doc.ruta_documento}"
                                    style="text-align:center; display:inline-block;">
                                    <img src="{{ asset('img/pdf-file.png') }}" style="width:50px;"><br>
                                    ${doc.nombre_doc}
                                </a>
                                <label for="documento${doc.id}" class="text-center"
                                    style="position:absolute; right: 20px; top:20px;">
                                    <i class="fa-solid fa-arrows-rotate btn" title="Actualizar Documento"></i>
                                </label>
                                <input type="file" class="form-control d-none" id="documento${doc.id}"
                                    data-id="${doc.id}" data-empleado="${empleado.id}"
                                    name="file" />

                                <label class="text-center" style="position:absolute; right: 20px; top:50px;"
                                    data-toggle="modal" data-target="#modal_docs_${doc.id}">
                                    <i class="fa-solid fa-eye btn"></i>
                                </label>
                            `;
                        } else {
                            htmlTbodyInner += `
                            <div class="text-center">
                                <label for="documento${doc.id}" class="text-center">
                                    <img src="{{ asset('img/upload-pdf.png') }}" style="width:40px" />
                                    <p class="m-0 text-muted" style="font-size:10px">Subir Documento</p>
                                </label>
                            </div>
                            <input type="file" class="form-control d-none" id="documento${doc.id}"
                                data-id="${doc.id}" data-empleado="${empleado.id}"
                                name="file" />
                            <p class="m-0">
                                <span class="errors documento_error text-danger"></span>
                            </p>
                            `;
                        }
                        htmlTbodyInner += `
                    </td>                 
                </tr>
                `;
                    });


                    setTimeout(() => {
                        var dtOverrideGlobals = {
                            buttons: [],
                            pageLength: 20,
                            retrieve: true,
                        };
                        if ($.fn.DataTable.isDataTable('#tabla_docs')) {
                            $('#tabla_docs').DataTable().destroy();
                        }

                        tbody.innerHTML = htmlTbodyInner;
                        let table = $('#tabla_docs').DataTable(dtOverrideGlobals);
                    }, 1000);

                }

            });
        }
    </script>
@endsection
