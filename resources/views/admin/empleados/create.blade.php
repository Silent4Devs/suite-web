@extends('layouts.admin')
@section('content')

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Empleado </strong></h3>
        </div>
        @if (!$ceo_exists)
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">No se ha definido el nodo raíz (CEO) de la
                            organización, es recomendable que se defina al inicio de la carga de empleados</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="card-body">
            <main id="webcam-app">
                <div class="form-control webcam-start" id="webcam-control">
                    <label class="form-switch">
                        <input type="checkbox" id="webcam-switch">
                        <i></i>
                        <span id="webcam-caption">Click to Start Camera</span>
                    </label>
                    <button id="cameraFlip" class="btn d-none"></button>
                </div>

                <div id="errorMsg" class="col-12 col-md-6 alert-danger d-none">
                    Fail to start camera, please allow permision to access camera. <br />
                    If you are browsing through social media built in browsers, you would need to open the page in Sarafi
                    (iPhone)/ Chrome (Android)
                    <button id="closeError" class="ml-3 btn btn-primary">OK</button>
                </div>
                <div class="md-modal md-effect-12">
                    <div id="app-panel" class="p-0 m-0 app-panel md-content row">
                        <div id="webcam-container" class="p-0 m-0 webcam-container col-12 d-none">
                            <video id="webcam" autoplay playsinline width="640" height="480"></video>
                            <canvas id="canvas" class="d-none"></canvas>
                            <div class="flash"></div>
                            <audio id="snapSound" src="audio/snap.wav" preload="auto"></audio>
                        </div>
                        <div id="cameraControls" class="cameraControls">
                            <a href="#" id="exit-app" title="Exit App" class="d-none"><i
                                    class="material-icons">exit_to_app</i></a>
                            <a href="#" id="take-photo" title="Take Photo"><i class="material-icons">camera_alt</i></a>
                            <a href="#" id="download-photo" download="selfie.png" target="_blank" title="Save Photo"
                                class="d-none"><i class="material-icons">file_download</i></a>
                            <a href="#" id="resume-camera" title="Resume Camera" class="d-none"><i
                                    class="material-icons">camera_front</i></a>
                        </div>
                    </div>
                </div>
                <div class="md-overlay"></div>
            </main>
            <div id="camera" style="width: 350px; height: 350px; border: 1px solid black"></div>
            <button onclick="take_snap()">Tomar Captura</button>
            <form method="POST" action="{{ route('admin.empleados.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="name"><i class="fas fa-street-view iconos-crear"></i>Nombre</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', '') }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="foto"><i class="fas fa-id-card-alt iconos-crear"></i> Foto </label>
                        <div class="mb-3 input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" class="needsclick dropzone" name="foto"
                                    id="foto" class="form-control {{ $errors->has('foto') ? 'is-invalid' : '' }}"
                                    id="foto-dropzone" accept="image/*" value="{{ old('foto', '') }}">
                                <label class="custom-file-label" for="inputGroupFile02"></label>

                            </div>
                        </div>
                        @if ($errors->has('foto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('foto') }}
                            </div>
                        @endif

                    </div>


                </div>


                <div class="row">


                    <div class="form-group col-sm-6">
                        <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N° de
                            empleado</label>
                        <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                            name="n_empleado" id="n_empleado" value="{{ old('n_empleado', '') }}" required>
                        @error('n_empleado')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group col-sm-6">
                        <label class="required" for="area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <select class="custom-select areas" id="inputGroupSelect01" name="area_id">
                            <option selected value="" disabled>-- Selecciona un área --</option>
                            @forelse ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @empty
                                <option value="" disabled>Sin registros de áreas</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="jefe"><i class="fas fa-user iconos-crear"></i>Jefe Inmediato</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select supervisor" id="inputGroupSelect01" name="supervisor_id">
                                <option selected value="" disabled>-- Selecciona supervisor --</option>
                                @if (!$ceo_exists)
                                    <option value="">CEO</option>
                                @endif
                                @forelse ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
                        </div>
                        {{-- <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="jefe" id="jefe" value="{{ old('jefe', '') }}" required> --}}
                        @if ($errors->has('jesupervisor_idfe'))
                            <div class="invalid-feedback">
                                {{ $errors->first('supervisor_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label class="required" for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                            name="puesto" id="puesto" value="{{ old('puesto', '') }}" required>
                        @if ($errors->has('puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('puesto') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="estatus"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                            ingreso</label>
                        <input class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}" type="date"
                            name="antiguedad" id="antiguedad" value="{{ old('antiguedad', '') }}" required>
                        @if ($errors->has('antiguedad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('antiguedad') }}
                            </div>
                        @endif

                    </div>


                    <div class="form-group col-sm-6">
                        <label class="required" for="estatus"><i
                                class="fas fa-business-time iconos-crear"></i>Estatus</label>
                        <select class="form-control" class="validate" required="" name="estatus">
                            <option value="" disabled selected>Escoga una opción</option>
                            <option value="alta">Alta</option>
                            <option value="baja">Baja</option>
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
                            name="email" id="email" value="{{ old('email', '') }}" required>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="telefono"><i class="far fa-envelope iconos-crear"></i>Teléfono</label>
                        <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="text"
                            name="telefono" id="telefono" value="{{ old('telefono', '') }}">
                        @if ($errors->has('telefono'))
                            <div class="invalid-feedback">
                                {{ $errors->first('telefono') }}
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
                                <option value="H" {{ old('genero') == 'H' ? 'selected' : '' }}>Hombre</option>
                                <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Mujer</option>
                                <option value="X" {{ old('genero') == 'X' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        @if ($errors->has('genero'))
                            <div class="invalid-feedback">
                                {{ $errors->first('genero') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="sede_id"><i class="fas fa-building iconos-crear"></i>Sede</label>
                    <select class="form-control select2 {{ $errors->has('sede') ? 'is-invalid' : '' }}" name="sede_id" id="sede_id">
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->id }}" {{ old('sede_id') == $sede->id ? 'selected' : '' }}>{{ $sede->sede }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('sede_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sede_id') }}
                        </div>
                    @endif
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
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"
        integrity="sha512-AQMSn1qO6KN85GOfvH6BWJk46LhlvepblftLHzAv1cdIyTWPBKHX+r+NOXVVw6+XQpeW4LJk/GTmoP48FLvblQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("foto").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })

        $(document).ready(function() {
            $('.areas').select2({
                theme: 'bootstrap4',
            });
            $('.supervisor').select2({
                theme: 'bootstrap4',
            });
            // let picture = webcam.snap();
            // document.querySelector('#download-photo').href = picture;
        });
    </script>
    <script>
        Webcam.set({
            width: 350,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        })
        Webcam.attach('#camera');

        function take_snap() {

        }
    </script>
    <script>
        const webcamElement = document.getElementById('webcam');

        const canvasElement = document.getElementById('canvas');

        const snapSoundElement = document.getElementById('snapSound');

        const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);


        $("#webcam-switch").change(function() {
            if (this.checked) {
                $('.md-modal').addClass('md-show');
                webcam.start()
                    .then(result => {
                        cameraStarted();
                        console.log("webcam started");
                    })
                    .catch(err => {
                        displayError();
                    });
            } else {
                cameraStopped();
                webcam.stop();
                console.log("webcam stopped");
            }
        });

        $('#cameraFlip').click(function() {
            webcam.flip();
            webcam.start();
        });

        $('#closeError').click(function() {
            $("#webcam-switch").prop('checked', false).change();
        });

        function displayError(err = '') {
            if (err != '') {
                $("#errorMsg").html(err);
            }
            $("#errorMsg").removeClass("d-none");
        }

        function cameraStarted() {
            $("#errorMsg").addClass("d-none");
            $('.flash').hide();
            $("#webcam-caption").html("on");
            $("#webcam-control").removeClass("webcam-off");
            $("#webcam-control").addClass("webcam-on");
            $(".webcam-container").removeClass("d-none");
            if (webcam.webcamList.length > 1) {
                $("#cameraFlip").removeClass('d-none');
            }
            $("#wpfront-scroll-top-container").addClass("d-none");
            window.scrollTo(0, 0);
            $('body').css('overflow-y', 'hidden');
        }

        function cameraStopped() {
            $("#errorMsg").addClass("d-none");
            $("#wpfront-scroll-top-container").removeClass("d-none");
            $("#webcam-control").removeClass("webcam-on");
            $("#webcam-control").addClass("webcam-off");
            $("#cameraFlip").addClass('d-none');
            $(".webcam-container").addClass("d-none");
            $("#webcam-caption").html("Click to Start Camera");
            $('.md-modal').removeClass('md-show');
        }


        $("#take-photo").click(function() {
            beforeTakePhoto();
            let picture = webcam.snap();
            document.querySelector('#download-photo').href = picture;
            afterTakePhoto();
        });

        function beforeTakePhoto() {
            $('.flash')
                .show()
                .animate({
                    opacity: 0.3
                }, 500)
                .fadeOut(500)
                .css({
                    'opacity': 0.7
                });
            window.scrollTo(0, 0);
            $('#webcam-control').addClass('d-none');
            $('#cameraControls').addClass('d-none');
        }

        function afterTakePhoto() {
            webcam.stop();
            $('#canvas').removeClass('d-none');
            $('#take-photo').addClass('d-none');
            $('#exit-app').removeClass('d-none');
            $('#download-photo').removeClass('d-none');
            $('#resume-camera').removeClass('d-none');
            $('#cameraControls').removeClass('d-none');
        }

        function removeCapture() {
            $('#canvas').addClass('d-none');
            $('#webcam-control').removeClass('d-none');
            $('#cameraControls').removeClass('d-none');
            $('#take-photo').removeClass('d-none');
            $('#exit-app').addClass('d-none');
            $('#download-photo').addClass('d-none');
            $('#resume-camera').addClass('d-none');
        }

        $("#resume-camera").click(function() {
            webcam.stream()
                .then(facingMode => {
                    removeCapture();
                });
        });

        $("#exit-app").click(function() {
            removeCapture();
            $("#webcam-switch").prop("checked", false).change();
        });
    </script>
@endsection
