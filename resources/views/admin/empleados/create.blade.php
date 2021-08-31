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

        .errors {
            color: red;
            font-size: 10pt;
        }

    </style>





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
            <form method="POST" action="{{ route('admin.empleados.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        {{-- <ul class="nav nav-pills nav-fill nav-tabs" id="tab-recursos" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                                    aria-controls="general" aria-selected="true">
                                    <font class="letra_blanca">
                                        <i class="mr-1 fas fa-file"></i>
                                        Información General
                                    </font>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="participantes-tab" data-toggle="tab" href="#participantes"
                                    role="tab" aria-controls="participantes" aria-selected="false"
                                    onclick="participantesDataTable()">
                                    <font class="letra_blanca">
                                        <i class="mr-1 fas fa-flag-checkered"></i>
                                        Competencias
                                    </font>
                                </a>
                            </li>
                        </ul> --}}



                            <div class="caja_botones_menu">
                                <a href="#" data-tabs="contenido1" class="btn_activo"><i class="mr-2 fas fa-file"
                                        style="font-size:30px;" style="text-decoration:none;"></i>Información General</a>
                                <a href="#" data-tabs="contenido2"><i class="mr-2 fas fa-flag-checkered"
                                        style="font-size:30px;"></i>
                                    Competencias</a>
                            </div>




                        <div class="caja_caja_secciones">
                            <div class="caja_secciones">
                                <section id="contenido1" class="caja_tab_reveldada">
                                    <div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required" for="name"><i
                                                        class="fas fa-street-view iconos-crear"></i>Nombre</label>
                                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    type="text" name="name" id="name" value="{{ old('name', '') }}"
                                                    required>
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="required" for="n_empleado"><i
                                                        class="fas fa-street-view iconos-crear"></i>N°
                                                    de
                                                    empleado</label>
                                                <input
                                                    class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}"
                                                    type="text" name="n_empleado" id="n_empleado"
                                                    value="{{ old('n_empleado', '') }}" required>
                                                @error('n_empleado')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-{{ $ceo_exists ? '6' : '12' }}">
                                                <label class="required" for="area"><i
                                                        class="fas fa-street-view iconos-crear"></i>Área</label>
                                                <select class="custom-select areas" id="inputGroupSelect01" name="area_id">
                                                    <option selected value="" disabled>-- Selecciona un área --</option>
                                                    @forelse ($areas as $area)
                                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                                    @empty
                                                        <option value="" disabled>Sin registros de áreas</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            @if ($ceo_exists)
                                                <div class="form-group col-sm-6">
                                                    <label class="required" for="jefe"><i
                                                            class="fas fa-user iconos-crear"></i>Jefe
                                                        Inmediato</label>
                                                    <div class="mb-3 input-group">

                                                        <select class="custom-select supervisor" id="inputGroupSelect01"
                                                            name="supervisor_id">
                                                            <option selected value="" disabled>-- Selecciona supervisor --
                                                            </option>
                                                            @forelse ($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}">
                                                                    {{ $empleado->name }}
                                                                </option>
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
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required" for="puesto"><i
                                                        class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                                <input
                                                    class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}"
                                                    type="text" name="puesto" id="puesto" value="{{ old('puesto', '') }}"
                                                    required>
                                                @if ($errors->has('puesto'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('puesto') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="required" for="antiguedad"><i
                                                        class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                                                    ingreso</label>
                                                <input
                                                    class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}"
                                                    type="date" name="antiguedad" id="antiguedad"
                                                    value="{{ old('antiguedad', '') }}" required>
                                                @if ($errors->has('antiguedad'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('antiguedad') }}
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required" for="genero"><i
                                                        class="fas fa-user iconos-crear"></i>Género</label>
                                                <div class="mb-3 input-group">
                                                    <select class="custom-select genero" id="genero" name="genero">
                                                        <option selected value="" disabled>-- Selecciona Género --</option>
                                                        <option value="H" {{ old('genero') == 'H' ? 'selected' : '' }}>
                                                            Hombre
                                                        </option>
                                                        <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>
                                                            Mujer
                                                        </option>
                                                        <option value="X" {{ old('genero') == 'X' ? 'selected' : '' }}>
                                                            Otro
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
                                                <select class="form-control" class="validate" required=""
                                                    name="estatus">
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
                                                <label class="required" for="email"><i
                                                        class="far fa-envelope iconos-crear"></i>Correo
                                                    electrónico</label>
                                                <input
                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    type="text" name="email" id="email" value="{{ old('email', '') }}"
                                                    required>
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="telefono"><i
                                                        class="fas fa-mobile-alt iconos-crear"></i></i>Teléfono
                                                    móvil</label>
                                                <input
                                                    class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                    type="text" name="telefono" id="telefono"
                                                    value="{{ old('telefono', '') }}">
                                                @if ($errors->has('telefono'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('telefono') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="telefono"><i class="fas fa-phone iconos-crear"></i>Teléfono
                                                    oficina</label>
                                                <input
                                                    class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                    type="text" name="telefono" id="telefono"
                                                    value="{{ old('telefono', '') }}">
                                                @if ($errors->has('telefono'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('telefono') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label for="telefono"><i
                                                        class="fas fa-phone-volume iconos-crear"></i>Ext.</label>
                                                <input
                                                    class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                    type="text" name="telefono" id="telefono"
                                                    value="{{ old('telefono', '') }}">
                                                @if ($errors->has('telefono'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('telefono') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="sede_id"><i
                                                        class="fas fa-building iconos-crear"></i>Sede</label>
                                                <select
                                                    class="form-control select2 {{ $errors->has('sede') ? 'is-invalid' : '' }}"
                                                    name="sede_id" id="sede_id">
                                                    @foreach ($sedes as $sede)
                                                        <option value="{{ $sede->id }}"
                                                            {{ old('sede_id') == $sede->id ? 'selected' : '' }}>
                                                            {{ $sede->sede }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('sede_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('sede_id') }}
                                                    </div>
                                                @endif
                                            </div>



                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-12 col-md-6 ">
                                                <label for="direccion"><i
                                                        class="fas fa-map iconos-crear"></i>Direccion</label>
                                                <input
                                                    class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                    type="text" name="direccion" id="direccion"
                                                    value="{{ old('direccion', '') }}">
                                                @if ($errors->has('direccion'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('direccion') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-6">
                                                <label for="cumpleaños"><i
                                                        class="fas fa-birthday-cake iconos-crear"></i>Cumpleaños</label>
                                                <input
                                                    class="form-control {{ $errors->has('cumpleaños') ? 'is-invalid' : '' }}"
                                                    type="date" name="cumpleaños" id="cumpleaños"
                                                    value="{{ old('cumpleaños', '') }}">
                                                @if ($errors->has('cumpleaños'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('cumpleaños') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group is-invalid">
                                                    <div class="form-group"
                                                        style="width: 100%;border: dashed 1px #cecece;">
                                                        <div class="row" style="padding: 20px 0;">
                                                            <div
                                                                class="col-md-5 col-sm-5 col-12 d-flex justify-content-center">
                                                                <label style="cursor: pointer" for="foto">
                                                                    <div class="d-flex align-items-center">
                                                                        <h5>
                                                                            <i class="fas fa-image iconos-crear"
                                                                                style="font-size: 20pt;position: relative;top: 4px;"></i>
                                                                            <span id="texto-imagen" class="pl-2">
                                                                                Subir imágen
                                                                                <small class="text-danger"
                                                                                    style="font-size: 10px">
                                                                                    (Opcional)</small>
                                                                            </span>
                                                                        </h5>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <div
                                                                class="col-sm-2 col-md-2 col-12 d-flex justify-content-center">
                                                                Ó
                                                            </div>
                                                            <div class="col-md-5 col-sm-5 col-12 d-flex justify-content-center"
                                                                id="avatar_choose">
                                                                <label style="cursor: pointer">
                                                                    <div class="d-flex align-items-center">
                                                                        <h5>
                                                                            <i class="fas fa-image iconos-crear"
                                                                                style="font-size: 20pt;position: relative;top: 4px;"></i>
                                                                            <span id="texto-imagen-avatar"
                                                                                class="pl-2">
                                                                                Tomar Foto
                                                                                <small class="text-danger"
                                                                                    style="font-size: 10px">
                                                                                    (Opcional)</small>
                                                                            </span>
                                                                        </h5>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <input name="foto" type="file" accept="image/png, image/jpeg"
                                                            class="form-control-file" id="foto" hidden="">
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
                                                    <button class="btn btn-danger play" title="Iniciar"><i
                                                            class="fas fa-play-circle"></i></button>
                                                    <button class="btn btn-info pause d-none" title="Pausar"><i
                                                            class="fas fa-pause-circle"></i></button>
                                                    <button class="btn btn-danger stop d-none" title="Detener"><i
                                                            class="fas fa-stop"></i></button>
                                                    <button class="btn btn-outline-success screenshot d-none"
                                                        title="Capturar"><i class="fas fa-image"></i></button>
                                                </div>
                                            </div>
                                            <input type="hidden" id="snapshoot" readonly autocomplete="off"
                                                name="snap_foto">
                                        </div>
                                        {{-- </div> --}}
                                    </div>
                                </section>



                                {{-- <div class="px-4 mt-4 mb-3 tab-pane fade" id="participantes" role="tabpanel"
                                aria-labelledby="participantes-tab"> --}}
                                <section id="contenido2" class="mt-4">
                                    <div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for="resumen"><i
                                                        class="fas fa-file-alt iconos-crear"></i>Resumen</label>
                                                <textarea
                                                    class="form-control {{ $errors->has('resumen') ? 'is-invalid' : '' }}"
                                                    type="text" name="resumen"
                                                    id="resumen">{{ old('resumen', '') }}</textarea>
                                                @if ($errors->has('resumen'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('resumen') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                            <span style="font-size: 17px; font-weight: bold;">
                                                Certificaciones</span>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for="nombre"><i
                                                        class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                                                <input
                                                    class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                    type="text" name="nombre" id="nombre_certificado"
                                                    value="{{ old('nombre', '') }}">
                                                <span class="errors nombre_certificado_error"></span>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="vigencia"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>Vigencia</label>
                                                <input
                                                    class="form-control {{ $errors->has('vigencia') ? 'is-invalid' : '' }}"
                                                    type="date" name="vigencia" id="vigencia"
                                                    value="{{ old('vigencia', '') }}">
                                                <span class="errors vigencia_error"></span>
                                            </div>


                                            <div class="form-group col-sm-6">
                                                <label for="estatus"><i
                                                        class="fas fa-street-view iconos-crear"></i>Estatus</label>
                                                <input
                                                    class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}"
                                                    type="text" name="vencio_alta" id="vencio_alta"
                                                    value="{{ old('estatus', '') }}" readonly>
                                                <span class="errors vencio_alta_error"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mt-3 col-sm-12 form-group">
                                                <label for="evidencia"><i
                                                        class="fas fa-folder-open iconos-crear"></i>Adjuntar
                                                    Certificado</label>
                                                <div class="custom-file">
                                                    <input type="file" name="files[]" multiple class="form-control"
                                                        id="evidencia">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-5 col-12">
                                            <button id="btn-suscribir-certificado" type="submit"
                                                class="mr-3 btn btn-sm btn-outline-success"
                                                style="float: right; position: relative;">
                                                <i class="mr-1 fas fa-plus-circle"></i>
                                                Agregar Certificación
                                                {{-- <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
                                        style="position: absolute; top: 3px;left: 8px;"></i> --}}
                                            </button>
                                        </div>

                                        <div class="mt-3 col-12 w-100 datatable-fix">
                                            <table class="table w-100" id="tbl-certificados"
                                                style="width:100% !important">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Vigencia</th>
                                                        <th>Estatus</th>
                                                        {{-- <th>Documento</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>

                                        <input type="hidden" name="certificado" value="" id="certificado">


                                        <div class="mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                            <span style="font-size: 17px; font-weight: bold;">
                                                Cursos / Diplomados</span>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for="curso_diplomado"><i
                                                        class="fas fa-street-view iconos-crear"></i>Nombre
                                                    del curso /
                                                    diplomado</label>
                                                <input
                                                    class="form-control {{ $errors->has('curso_diplomado') ? 'is-invalid' : '' }}"
                                                    type="text" name="curso_diplomado" id="curso_diplomado"
                                                    value="{{ old('curso_diplomado', '') }}">
                                                <span class="errors curso_diplomado_error"></span>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="tipo"><i
                                                        class="fas fa-street-view iconos-crear"></i>Tipo</label>
                                                <select
                                                    class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}"
                                                    name="tipo" id="tipo">
                                                    <option value disabled
                                                        {{ old('tipo', null) === null ? 'selected' : '' }}>
                                                        Selecciona una opción</option>
                                                    @foreach (App\Models\CursosDiplomasEmpleados::TipoSelect as $key => $label)
                                                        <option value="{{ $key }}"
                                                            {{ old('tipo', '') === (string) $key ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="errors tipo_error"></span>
                                            </div>



                                            <div class="form-group col-sm-3">
                                                <label for="año"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>Año</label>
                                                <input
                                                    class="form-control {{ $errors->has('año') ? 'is-invalid' : '' }}"
                                                    type="date" name="año" id="año" value="{{ old('año', '') }}">
                                                <span class="errors año_error"></span>
                                            </div>


                                            <div class="form-group col-sm-3">
                                                <label for="duracion"><i
                                                        class="fas fa-street-view iconos-crear"></i>Duración
                                                    (Hrs)</label>
                                                <input
                                                    class="form-control {{ $errors->has('duracion') ? 'is-invalid' : '' }}"
                                                    type="number" name="duracion" id="duracion"
                                                    value="{{ old('duracion', '') }}">
                                                <span class="errors duracion_error"></span>
                                            </div>
                                        </div>


                                        <div class="mb-5 col-12">
                                            <button id="btn-suscribir-curso" type="submit"
                                                class="mr-3 btn btn-sm btn-outline-success"
                                                style="float: right; position: relative;">
                                                <i class="mr-1 fas fa-plus-circle"></i>
                                                Agregar Curso / Diplomado
                                                {{-- <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
                                        style="position: absolute; top: 3px;left: 8px;"></i> --}}
                                            </button>
                                        </div>

                                        <div class="mt-3 col-12 w-100 datatable-fix">
                                            <table class="table w-100" id="tbl-cursos">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Tipo</th>
                                                        <th>Año</th>
                                                        <th>Duración</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>


                                        <input type="hidden" name="curso" value="" id="curso">



                                        <div class="mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                            <span style="font-size: 17px; font-weight: bold;">
                                                Experiencia Profesional</span>
                                        </div>

                                        <div class="row">

                                            <div class="form-group col-sm-6">
                                                <label for="empresa"><i
                                                        class="fas fa-building iconos-crear"></i>Empresa</label>
                                                <input
                                                    class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}"
                                                    type="text" name="empresa" id="empresa"
                                                    value="{{ old('empresa', '') }}">
                                                <span class="errors empresa_error"></span>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="puesto"><i
                                                        class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                                <input
                                                    class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}"
                                                    type="text" name="puesto_trabajo" id="puesto_trabajo"
                                                    value="{{ old('puesto', '') }}">
                                                <span class="errors puesto_trabajo_error"></span>
                                            </div>

                                        </div>

                                        <div class="mt-1 form-group col-12">
                                            <b>Periodo laboral:</b>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="inicio_mes"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>De</label>
                                                <input
                                                    class="form-control {{ $errors->has('inicio_mes') ? 'is-invalid' : '' }}"
                                                    type="date" name="inicio_mes" id="inicio_mes"
                                                    value="{{ old('inicio_mes', '') }}">
                                                <span class="errors inicio_mes_error"></span>
                                            </div>



                                            <div class="form-group col-sm-6">
                                                <label for="fin_mes"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>A</label>
                                                <input
                                                    class="form-control {{ $errors->has('fin_mes') ? 'is-invalid' : '' }}"
                                                    type="date" name="fin_mes" id="fin_mes"
                                                    value="{{ old('fin_mes', '') }}">
                                                <span class="errors fin_mes_error"></span>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for="descripcion"><i
                                                        class="fas fa-clipboard-list iconos-crear"></i>Descripción</label>
                                                <textarea
                                                    class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                                    type="text" name="descripcion"
                                                    id="descripcion"> {{ old('descripcion', '') }}</textarea>
                                                <span class="errors descripcion_error"></span>
                                            </div>

                                        </div>


                                        <div class="mb-5 col-12">
                                            <button id="btn-agregar-experiencia" type="submit"
                                                class="mr-3 btn btn-sm btn-outline-success"
                                                style="float: right; position: relative;">
                                                <i class="mr-1 fas fa-plus-circle"></i>
                                                Agregar Experiencia
                                                {{-- <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
                                        style="position: absolute; top: 3px;left: 8px;"></i> --}}
                                            </button>
                                        </div>

                                        <div class="mt-3 col-12 w-100 datatable-fix">
                                            <table class="table w-100" id="tbl-experiencia">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Empresa</th>
                                                        <th>Puesto</th>
                                                        <th>Descripción</th>
                                                        <th>Inicio</th>
                                                        <th>Fin</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>

                                        <input type="hidden" name="experiencia" value="" id="experiencia">


                                        <div class="mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                            <span style="font-size: 17px; font-weight: bold;">
                                                Educación</span>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="institucion"><i
                                                        class="fas fa-school iconos-crear"></i>Institución</label>
                                                <input
                                                    class="form-control {{ $errors->has('institucion') ? 'is-invalid' : '' }}"
                                                    type="text" name="institucion" id="institucion"
                                                    value="{{ old('institucion', '') }}">
                                                <span class="errors institucion_error"></span>
                                            </div>


                                            <div class="form-group col-sm-6">
                                                <label for="nivel"><i class="fas fa-street-view iconos-crear"></i>Nivel de
                                                    estudios</label>
                                                <select
                                                    class="form-control {{ $errors->has('nivel') ? 'is-invalid' : '' }}"
                                                    name="nivel" id="nivel">
                                                    <option value disabled
                                                        {{ old('nivel', null) === null ? 'selected' : '' }}>
                                                        Selecciona una opción</option>
                                                    @foreach (App\Models\EducacionEmpleados::NivelSelect as $key => $label)
                                                        <option value="{{ $key }}"
                                                            {{ old('nivel', '') === (string) $key ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="errors nivel_error"></span>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="año_inicio"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>De</label>
                                                <input
                                                    class="form-control {{ $errors->has('año_inicio') ? 'is-invalid' : '' }}"
                                                    type="date" name="año_inicio" id="año_inicio"
                                                    value="{{ old('año_inicio', '') }}">
                                                <span class="errors año_inicio_error"></span>
                                            </div>



                                            <div class="form-group col-sm-6">
                                                <label for="año_fin"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>A</label>
                                                <input
                                                    class="form-control {{ $errors->has('año_fin') ? 'is-invalid' : '' }}"
                                                    type="date" name="año_fin" id="año_fin"
                                                    value="{{ old('año_fin', '') }}">
                                                <span class="errors año_fin_error"></span>
                                            </div>

                                        </div>


                                        <div class="mb-5 col-12">
                                            <button id="btn-agregar-educacion" type="submit"
                                                class="mr-3 btn btn-sm btn-outline-success"
                                                style="float: right; position: relative;">
                                                <i class="mr-1 fas fa-plus-circle"></i>
                                                Agregar Educacion
                                                {{-- <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
                                        style="position: absolute; top: 3px;left: 8px;"></i> --}}
                                            </button>
                                        </div>

                                        <div class="mt-3 col-12 w-100 datatable-fix">
                                            <table class="table w-100" id="tbl-educacion">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Institucion</th>
                                                        <th>Nivel</th>
                                                        <th>Inicio</th>
                                                        {{-- <th scope="col">Área</th> --}}
                                                        <th>Fin</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>


                                        <input type="hidden" name="educacion" value="" id="educacion">



                                        <div class="mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                            <span style="font-size: 17px; font-weight: bold;">
                                                Documentos</span>
                                        </div>

                                        <div class="mt-3 col-sm-12 form-group">
                                            <label for="documentos"><i
                                                    class="fas fa-folder-open iconos-crear"></i>Documentos</label><i
                                                class="fas fa-info-circle" style="font-size:12pt; float: right;"
                                                title=""></i>
                                            <div class="custom-file">
                                                <input type="file" name="files[]" multiple class="form-control"
                                                    id="documentos">

                                            </div>
                                        </div>
                                    </div>
                                </section>

                                {{-- </div> --}}

                                

                                {{-- </div> --}}
                            </div>
                        </div>

                        <div class="text-right form-group col-12">
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}"
                                class="btn_cancelar">Cancelar</a>
                            <button class="btn btn-danger" type="submit" id="btnGuardar">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </div>



@endsection

@section('scripts')
    @parent
    <script>
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


    <script>
        $(document).ready(function() {
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
            vigencia_certificado.addEventListener('change', function() {
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







@endsection
