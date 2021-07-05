@extends('layouts.admin')
@section('content')
    <style>
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

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong>Empleado </h3>
        </div>


        <div class="card-body">
            <form method="POST" action="{{ route('admin.empleados.update', [$empleado->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-3 text-center row justify-content-center">
                    <div class="text-center col-sm-2 w-50 text-light card-title" style="background-color:#1BB0B0">
                        Imágen Actual
                    </div>
                    <div class="col-sm-12"><img class="ml-3"
                            src="{{ asset('storage/empleados/imagenes/' . $empleado->foto) }}" style="width:80px "></div>

                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="name"><i
                                class="fas fa-user iconos-crear"></i>{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', $empleado->name) }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N° de
                            empleado</label>
                        <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                            name="n_empleado" id="n_empleado" value="{{ old('n_empleado', $empleado->n_empleado) }}"
                            disabled>
                        @if ($errors->has('n_empleado'))
                            <div class="invalid-feedback">
                                {{ $errors->first('n_empleado') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select areas" id="inputGroupSelect01" name="area_id">
                                <option selected disabled value="null">-- Seleccion un área --</option>
                                @forelse ($areas as $area_n)
                                    <option value="{{ $area_n->id }}"
                                        {{ old('area_id', $area_n->id) == $area->id ? 'selected active' : '' }}>
                                        {{ $area_n->area }}</option>
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
                        </div>
                        @if ($errors->has('area_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('area_id') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="required" for="jefe"><i class="fas fa-user iconos-crear"></i>Jefe Inmediato</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select supervisor" id="inputGroupSelect01" name="supervisor_id">
                                <option selected disabled value="null">-- Selecciona supervisor --</option>
                                @if (!$ceo_exists)
                                    <option value="">CEO</option>
                                @endif
                                @forelse ($empleados as $empleado_r)
                                    @if ($empleado_r->id != $empleado->id)
                                        <option value="{{ $empleado_r->id }}"
                                            {{ old('supervisor_id', $empleado_r->id) == $empleado->supervisor_id ? 'selected' : '' }}>
                                            {{ $empleado_r->name }}</option>
                                    @endif
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
                        </div>
                        @if ($errors->has('supervisor_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('supervisor_id') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="required" for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                            name="puesto" id="puesto" value="{{ old('puesto', $empleado->puesto) }}" required>
                        @if ($errors->has('puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('puesto') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="required" for="antiguedad"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                            ingreso</label>
                        <input class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}" type="date"
                            name="antiguedad" id="antiguedad" value="{{ old('antiguedad', $empleado->antiguedad) }}"
                            required>
                        @if ($errors->has('antiguedad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('antiguedad') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="genero"><i class="fas fa-user iconos-crear"></i>Género</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select genero" id="genero" name="genero">
                                <option selected value="" disabled>-- Selecciona Género --</option>
                                <option value="H" {{ old('genero', $empleado->genero) == 'H' ? 'selected' : '' }}>Hombre
                                </option>
                                <option value="M" {{ old('genero', $empleado->genero) == 'M' ? 'selected' : '' }}>Mujer
                                </option>
                                <option value="X" {{ old('genero', $empleado->genero) == 'X' ? 'selected' : '' }}>Otro
                                </option>
                            </select>
                        </div>
                        @if ($errors->has('genero'))
                            <div class="invalid-feedback">
                                {{ $errors->first('genero') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="required" for="estatus"><i
                                class="fas fa-business-time iconos-crear"></i>Estatus</label>
                        <select class="form-control" class="validate" required="" name="estatus">
                            <option value="" disabled selected>Escoga una opción</option>
                            <option {{ old('estatus', $empleado->estatus) == 'alta' ? 'selected' : '' }} value="alta">
                                Alta
                            </option>
                            <option {{ old('estatus', $empleado->estatus) == 'baja' ? 'selected' : '' }} value="baja">
                                Baja
                            </option>
                        </select>
                        @if ($errors->has('estatus'))
                            <div class="invalid-feedback">
                                {{ $errors->first('estatus') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="email"><i class="far fa-envelope iconos-crear"></i>Correo
                            Electronico</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="email" id="email" value="{{ old('email', $empleado->email) }}" required>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="telefono"><i class="far fa-envelope iconos-crear"></i>Telefono</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="telefono" id="telefono" value="{{ old('telefono', $empleado->telefono) }}">
                        @if ($errors->has('telefono'))
                            <div class="invalid-feedback">
                                {{ $errors->first('telefono') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="sede_id"><i class="fas fa-building iconos-crear"></i>Sede</label>
                    <select class="form-control select2 {{ $errors->has('sedes') ? 'is-invalid' : '' }}" name="sede_id"
                        id="sede_id">
                        @foreach ($sedes as $sede_actual)
                            <option value="{{ $sede_actual->id }}"
                                {{ old('sede_id', $sede_actual->id) == $sede->id ? 'selected' : '' }}>
                                {{ $sede_actual->sede }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('sede_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sede_id') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group is-invalid">
                            <div class="form-group" style="width: 100%;border: dashed 1px #cecece;">
                                <div class="row" style="padding: 20px 0;">
                                    <div class="col-md-5 col-sm-5 col-12 d-flex justify-content-center">
                                        <label style="cursor: pointer" for="foto">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <i class="fas fa-image iconos-crear"
                                                        style="font-size: 20pt;position: relative;top: 4px;"></i>
                                                    <span id="texto-imagen" class="pl-2">
                                                        Subir imágen
                                                        <small class="text-danger" style="font-size: 10px">
                                                            (Opcional)</small>
                                                    </span>
                                                </h5>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-12 d-flex justify-content-center">
                                        Ó
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-12 d-flex justify-content-center" id="avatar_choose">
                                        <label style="cursor: pointer">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <i class="fas fa-camera iconos-crear"
                                                        style="font-size: 20pt;position: relative;top: 4px;"></i>
                                                    <span id="texto-imagen-avatar" class="pl-2">
                                                        Tomar Foto
                                                        <small class="text-danger" style="font-size: 10px">
                                                            (Opcional)</small>
                                                    </span>
                                                </h5>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <input name="foto" type="file" accept="image/png, image/jpeg" class="form-control-file"
                                    id="foto" hidden="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="canvasFoto" style="display: none">
                    <div class="mt-0 display-cover">
                        <span class="badge badge-dark" id="cerrarCanvasFoto">&times;</span>
                        <video autoplay></video>
                        <canvas class="d-none"></canvas>

                        <div class="video-options">
                            <select name="" id="" class="custom-select devices">
                                <option value="">Selecciona una cámara</option>
                            </select>
                        </div>

                        <img class="screenshot-image d-none" alt="">

                        <div class="controls">
                            <button class="btn btn-danger play" title="Iniciar"><i class="fas fa-play-circle"></i></button>
                            <button class="btn btn-info pause d-none" title="Pausar"><i
                                    class="fas fa-pause-circle"></i></button>
                            <button class="btn btn-danger stop d-none" title="Detener"><i class="fas fa-stop"></i></button>
                            <button class="btn btn-outline-success screenshot d-none" title="Capturar"><i
                                    class="fas fa-image"></i></button>
                        </div>
                    </div>
                    <input type="hidden" id="snapshoot" readonly autocomplete="off" name="snap_foto">
                </div>
                <div class="text-right form-group col-12">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>

        </div>
    </div>



@endsection


@section('scripts')
    @parent
    <script>
        // document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        //     var fileName = document.getElementById("foto").files[0].name;
        //     var nextSibling = e.target.nextElementSibling
        //     nextSibling.innerText = fileName
        // })
        $(document).ready(function() {
            $('.areas').select2({
                theme: 'bootstrap4',
            });

            $('.supervisor').select2({
                theme: 'bootstrap4',
            });
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

@endsection
