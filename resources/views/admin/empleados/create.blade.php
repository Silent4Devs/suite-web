@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('empleados-create') }}
    <style>
        .select2-container {
            margin-top: 0px !important;
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

        .errors {
            color: red;
            font-size: 10pt;
        }

        #btn_cancelar{

        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        border-radius: 4px;
        opacity: 1;
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Registrar: Empleado</h5>
    <div class="mt-4 card">
        @if (!$ceo_exists)
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                            No se ha definido el CEO de la organización
                        </p>
                        <p class="m-0">
                            Cree el listado de los empleados, comenzando por los de más alta jerarquía
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="tabsEmpleado" role="tablist">
                    <a class="nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab"
                        aria-controls="nav-general" aria-selected="true">
                        <i class="mr-2 fas fa-briefcase" style="font-size:20px;" style="text-decoration:none;"></i>
                        Información General
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
                </div>
            </nav>
            <form method="POST" action="{{ route('admin.empleados.store') }}" enctype="multipart/form-data"
                id="formCreateEmpleado">
                @csrf
                @can('bd_empleados_agregar')
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
                    </div>
                @endcan
                <div class="text-right form-group col-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}"  class="btn" id="btn_cancelar" style="color:#057BE2; height: 3rem;">Cancelar</a>
                    <button class="btn btn-primary" type="submit" id="btnGuardar">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <x-loading-indicator />
    {{-- MODAL CROP --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                    console.log(slug);
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
                function limpiarErrores() {
                    document.querySelectorAll('.errores').forEach(item => {
                        item.innerHTML = "";
                    })
                }

                document.querySelector('#btnGuardar').addEventListener('click', function(e) {
                    e.preventDefault();
                    limpiarErrores();
                    const formData = new FormData(document.getElementById('formCreateEmpleado'));
                    const url = document.getElementById('formCreateEmpleado').getAttribute('action');
                    document.getElementById('loaderComponent').style.display = 'block';
                    fetch(url, {
                            method: "POST",
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
                                toastr.error(
                                    'Tu resgitro contiene errores de validación, revisa los inputs por favor.'
                                );
                            }

                            if (data.status) {
                                document.getElementById('loaderComponent').style.display = 'none';
                                Swal.fire(
                                    'Empleado Creado',
                                    '',
                                    'success',
                                ).then(() => {
                                    window.location.href =
                                        "{{ route('admin.empleados.index') }}";

                                })
                            }
                            if (data.errors) {
                                console.log(data.errors);
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
            })
        </script>
        <script>
            $(document).ready(function() {
                // $('.areas').select2({
                //     theme: 'bootstrap4',
                // });
                // $('.select-search').select2({
                //     theme: 'bootstrap4',
                // });
                // $('.supervisor').select2({
                //     theme: 'bootstrap4',
                // });
                // $('#puesto_id').select2({
                //     theme: 'bootstrap4',
                // });
                // $('#perfil_empleado_id').select2({
                //     theme: 'bootstrap4',
                // });
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
                document.getElementById('btnSiguiente')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    $("#formEmpleado").removeAttr('action');
                    $("#formEmpleado").attr('action', '{{ route('admin.empleados.storeWithCompetencia') }}');
                    document.getElementById('formEmpleado').submit();
                })
                document.getElementById('btnGuardar').addEventListener('click', function(e) {
                    e.preventDefault();
                    $("#formEmpleado").removeAttr('action');
                    $("#formEmpleado").attr('action', '{{ route('admin.empleados.store') }}');
                    document.getElementById('formEmpleado').submit();
                })
                window.tblExperiencia = $('#tbl-experiencia').DataTable({
                    buttons: []
                })
                window.tblEducacion = $('#tbl-educacion').DataTable({
                    buttons: []
                })
                window.tblCurso = $('#tbl-cursos').DataTable({
                    buttons: []
                })
                window.tblCertificado = $('#tbl-certificados').DataTable({
                    buttons: []
                })

                let vigencia_certificado = document.getElementById('vigencia');
                vigencia_certificado?.addEventListener('change', function() {
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
                // let url = "{{ route('admin.empleados.get') }}";



                document.getElementById('btn-agregar-experiencia')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    limpiarErrores();
                    suscribirExperiencia()
                })

                document.getElementById('btn-agregar-educacion')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    limpiarErrores();
                    suscribirEducacion()
                })

                document.getElementById('btn-suscribir-curso')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    limpiarErrores();
                    suscribirCurso()
                })

                document.getElementById('btn-suscribir-certificado')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    limpiarErrores();
                    suscribirCertificado()
                })


                document.getElementById('btnGuardar')?.addEventListener('click', function(e) {
                    // e.preventDefault();
                    enviarExperiencia()
                    enviarEducacion()
                    enviarCurso()
                    enviarCertificado()
                })

            });





            function suscribirExperiencia() {
                //form-participantes

                let experiencias = tblExperiencia.rows().data().toArray();
                let arrExperiencia = [];
                experiencias.forEach(experiencia => {
                    arrExperiencia.push(experiencia[0])

                });

                //no se puedan agregar datos que ya estan
                let nombre = $("#empresa").val();
                let puesto = $("#puesto_trabajo").val();
                let descripcion = $("#descripcion").val();
                let inicio_mes = $("#inicio_mes").val();
                let fin_mes = $("#fin_mes").val();
                if (nombre.trim() == '') {
                    document.querySelector('.empresa_error').innerHTML = "El campo empresa es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }
                if (puesto.trim() == '') {
                    document.querySelector('.puesto_trabajo_error').innerHTML = "El campo puesto es requerido"
                    // limpiarCamposExperienciaPorId('puesto_trabajo');
                }
                if (inicio_mes.trim() == '') {
                    document.querySelector('.inicio_mes_error').innerHTML = "El campo de inicio de puesto laboral es requerido"
                    // limpiarCamposExperienciaPorId('puesto_trabajo');
                }
                if (fin_mes.trim() == '') {
                    document.querySelector('.fin_mes_error').innerHTML = "El campo fin de puesto laboral es requerido"
                    // limpiarCamposExperienciaPorId('fin_mes');
                }
                if (descripcion.trim() == '') {
                    document.querySelector('.descripcion_error').innerHTML = "El campo de descripción laboral es requerido"
                    // limpiarCamposExperienciaPorId('descripcion_error');
                }
                if (nombre.trim() != '' && puesto.trim() != '' && inicio_mes.trim() != '' && fin_mes.trim() != '' && descripcion
                    .trim() != '') {
                    limpiarCamposExperiencia();


                    if (!arrExperiencia.includes(nombre)) {


                        tblExperiencia.row.add([
                            nombre,
                            puesto,
                            descripcion,
                            inicio_mes,
                            fin_mes
                        ]).draw();

                    } else {
                        Swal.fire('Este participante ya ha sido agregado', '', 'error')
                        limpiarCamposExperiencia();
                    }
                }
                //limpia campos

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

                let educacions = tblEducacion.rows().data().toArray();
                let arrEducacion = [];
                educacions.forEach(educacion => {
                    arrEducacion.push(educacion[0])

                });


                //no se puedan agregar datos que ya estan
                let institucion = $("#institucion").val();
                let año_inicio = $("#año_inicio").val();
                let año_fin = $("#año_fin").val();
                let nivel = $("#nivel").val();

                if (institucion.trim() == '') {
                    document.querySelector('.institucion_error').innerHTML = "El campo institucion es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }
                if (año_inicio.trim() == '') {
                    document.querySelector('.año_inicio_error').innerHTML = "El campo inicio de año es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }
                if (año_fin.trim() == '') {
                    document.querySelector('.año_fin_error').innerHTML = "El campo inicio de fin es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }
                if (document.getElementById('nivel').value == "") {
                    document.querySelector('.nivel_error').innerHTML = "El campo nivel es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }
                if (institucion.trim() != '' && año_inicio.trim() != '' && año_fin.trim() != '' && document.getElementById(
                        'nivel').value != "") {
                    limpiarCamposEducacion();


                    if (!arrEducacion.includes(institucion)) {
                        tblEducacion.row.add([
                            institucion,
                            año_inicio,
                            año_fin,
                            nivel,
                        ]).draw();

                    } else {
                        Swal.fire('Este registro ya ha sido agregado', '', 'error')
                    }
                }
                //limpia campos

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
                //form-participantes

                let cursos = tblCurso.rows().data().toArray();
                let arrCurso = [];
                cursos.forEach(curso => {
                    arrCurso.push(curso[0])

                });
                //no se puedan agregar datos que ya estan


                let curso_diplomado = $("#curso_diplomado").val();
                let tipo = $("#tipo").val();
                let año = $("#año").val();
                let duracion = $("#duracion").val();

                if (curso_diplomado.trim() == '') {
                    document.querySelector('.curso_diplomado_error').innerHTML = "El campo curso/diplomado es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }

                if (document.getElementById('tipo').value == "") {
                    document.querySelector('.tipo_error').innerHTML = "El campo tipo es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }

                if (año.trim() == '') {
                    document.querySelector('.año_error').innerHTML = "El campo año es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }

                if (duracion.trim() == '') {
                    document.querySelector('.duracion_error').innerHTML = "El campo duración es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }

                if (curso_diplomado.trim() != '' && año.trim() != '' && duracion.trim() != '' && document.getElementById('tipo')
                    .value != "") {
                    limpiarCamposCursos();



                    if (!arrCurso.includes(curso_diplomado)) {

                        tblCurso.row.add([
                            curso_diplomado,
                            tipo,
                            año,
                            duracion,
                        ]).draw();

                    } else {
                        Swal.fire('Este registro ya ha sido agregado', '', 'error')
                    }
                }
            }

            function limpiarCamposCurso() {
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
                //form-participantes

                let certificados = tblCertificado.rows().data().toArray();
                let arrCertificado = [];
                certificados.forEach(certificado => {
                    arrCertificado.push(certificado[0])

                });
                //no se puedan agregar datos que ya estan
                let nombre_certificado = $("#nombre_certificado").val();
                let vigencia = $("#vigencia").val();
                let estatus = $("#vencio_alta").val();
                let evidenciafile = $("#evidencia").prop('files')[0];
                console.log(evidenciafile.name);

                var file = evidenciafile;
                var fr = new FileReader();
                fr.onload = receivedText;
                //fr.readAsText(file);//fr.readAsBinaryString(file); //as bit work with base64 for example upload to server
                fr.readAsDataURL(file);
                console.log(fr);
                alert(fr);

                if (nombre_certificado.trim() == '') {
                    document.querySelector('.nombre_certificado_error').innerHTML =
                        "El campo nombre del certificado es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }
                if (vigencia.trim() == '') {
                    document.querySelector('.vigencia_error').innerHTML = "El campo vigencia es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }
                if (estatus.trim() == '') {
                    document.querySelector('.estatus_error').innerHTML = "El campo estatus es requerido"
                    // limpiarCamposExperienciaPorId('empresa');
                }



                if (nombre_certificado.trim() != '' && vigencia.trim() != '' && estatus.trim() != '') {
                    limpiarCamposCertificados();

                    if (!arrCertificado.includes(nombre_certificado)) {

                        tblCertificado.row.add([
                            nombre_certificado,
                            vigencia,
                            estatus,
                            evidenciafile.name,
                        ]).draw();

                    } else {
                        Swal.fire('Este registro ya ha sido agregado', '', 'error')
                    }
                }
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
                alert(arrCertificado);
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
    @endsection
