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

            <div class="caja_botones_menu">
                <a href="#" data-tabs="contenido1" class="btn_activo"><i class="mr-2 fas fa-file" style="font-size:30px;"
                        style="text-decoration:none;"></i>Información General</a>
                <a href="#" data-tabs="contenido2"><i class="mr-2 fas fa-flag-checkered" style="font-size:30px;"></i>
                    Competencias</a>
            </div>



            <div class="row">
                <div class="col-md-12">

                    <div class="caja_caja_secciones">
                        <div class="caja_secciones">


                            <section id="contenido1" class="mt-4 caja_tab_reveldada">
                                <div>
                                    <form method="POST" action="{{ route('admin.empleados.update', [$empleado->id]) }}"
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

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required" for="name"><i
                                                        class="fas fa-user iconos-crear"></i>{{ trans('cruds.user.fields.name') }}</label>
                                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    type="text" name="name" id="name"
                                                    value="{{ old('name', $empleado->name) }}" required>
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
                                                    value="{{ old('n_empleado', $empleado->n_empleado) }}" readonly>
                                                @if ($errors->has('n_empleado'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('n_empleado') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required" for="area"><i
                                                        class="fas fa-street-view iconos-crear"></i>Área</label>
                                                <div class="mb-3 input-group">
                                                    <select class="custom-select areas" id="inputGroupSelect01"
                                                        name="area_id">
                                                        <option selected disabled value="null">-- Seleccion un área --
                                                        </option>
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
                                                <label class="required" for="jefe"><i
                                                        class="fas fa-user iconos-crear"></i>Jefe
                                                    Inmediato</label>
                                                <div class="mb-3 input-group">
                                                    <select class="custom-select supervisor" id="inputGroupSelect01"
                                                        name="supervisor_id">
                                                        <option selected disabled value="null">-- Selecciona supervisor --
                                                        </option>
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
                                                <label class="required" for="puesto_id"><i
                                                        class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                                <select
                                                    class="form-control {{ $errors->has('puesto_id') ? 'is-invalid' : '' }}"
                                                    name="puesto_id" id="puesto_id" value="{{ old('puesto_id', '') }}"
                                                    required>
                                                    <option value="" selected disabled>
                                                        -- Selecciona un puesto --
                                                    </option>
                                                    @foreach ($puestos as $puesto)
                                                        <option
                                                            {{ old('puesto_id', $empleado->puesto_id) == $puesto->id ? 'selected' : '' }}
                                                            value="{{ $puesto->id }}">{{ $puesto->puesto }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- <input
                                                    class="form-control {{ $errors->has('puesto_id') ? 'is-invalid' : '' }}"
                                                    type="text" name="puesto_id" id="puesto_id"
                                                    value="{{ old('puesto_id', '') }}" required> --}}
                                                @if ($errors->has('puesto_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('puesto_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="required" for="antiguedad"><i
                                                        class="fas fa-calendar-alt iconos-crear"></i>Fecha
                                                    de
                                                    ingreso</label>
                                                <input
                                                    class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}"
                                                    type="date" name="antiguedad" id="antiguedad"
                                                    value="{{ old('antiguedad', \Carbon\Carbon::parse($empleado->antiguedad)->format('Y-m-d')) }}"
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
                                                <label class="required" for="genero"><i
                                                        class="fas fa-user iconos-crear"></i>Género</label>
                                                <div class="mb-3 input-group">
                                                    <select class="custom-select genero" id="genero" name="genero">
                                                        <option selected value="" disabled>-- Selecciona Género --</option>
                                                        <option value="H"
                                                            {{ old('genero', $empleado->genero) == 'H' ? 'selected' : '' }}>
                                                            Hombre
                                                        </option>
                                                        <option value="M"
                                                            {{ old('genero', $empleado->genero) == 'M' ? 'selected' : '' }}>
                                                            Mujer
                                                        </option>
                                                        <option value="X"
                                                            {{ old('genero', $empleado->genero) == 'X' ? 'selected' : '' }}>
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
                                                    <option
                                                        {{ old('estatus', $empleado->estatus) == 'alta' ? 'selected' : '' }}
                                                        value="alta">
                                                        Alta
                                                    </option>
                                                    <option
                                                        {{ old('estatus', $empleado->estatus) == 'baja' ? 'selected' : '' }}
                                                        value="baja">
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
                                                <label class="required" for="email"><i
                                                        class="far fa-envelope iconos-crear"></i>Correo
                                                    Electrónico</label>
                                                <input
                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    type="text" name="email" id="email"
                                                    value="{{ old('email', $empleado->email) }}" required>
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="telefono_movil"><i
                                                        class="fas fa-phone iconos-crear"></i>Teléfono
                                                    móvil</label>
                                                <input
                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    type="number" name="telefono_movil" id="telefono_movil"
                                                    value="{{ old('telefono_movil', $empleado->telefono_movil) }}">
                                                @if ($errors->has('telefono_movil'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('telefono_movil') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label for="telefono"><i class="fas fa-phone iconos-crear"></i>Teléfono
                                                    oficina</label>
                                                <input
                                                    class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                    type="number" name="telefono" id="telefono"
                                                    value="{{ old('telefono', $empleado->telefono) }}">
                                                @if ($errors->has('telefono'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('telefono') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label for="extension"><i
                                                        class="fas fa-phone-volume iconos-crear"></i>Ext.</label>
                                                <input
                                                    class="form-control {{ $errors->has('extension') ? 'is-invalid' : '' }}"
                                                    type="text" name="extension" id="extension"
                                                    value="{{ old('extension', $empleado->extension) }}">
                                                @if ($errors->has('extension'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('extension') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="sede_id"><i
                                                        class="fas fa-building iconos-crear"></i>Sede</label>
                                                <select
                                                    class="form-control select2 {{ $errors->has('sedes') ? 'is-invalid' : '' }}"
                                                    name="sede_id" id="sede_id">
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


                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-12 col-md-6 ">
                                                <label for="direccion"><i
                                                        class="fas fa-map iconos-crear"></i>Direccion</label>
                                                <input
                                                    class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                                    type="text" name="direccion" id="direccion"
                                                    value="{{ old('direccion', $empleado->direccion) }}">
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
                                                    value="{{ old('cumpleaños', $empleado->cumpleaños) }}">
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
                                                                            <i class="fas fa-camera iconos-crear"
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
                                    </form>
                                </div>
                            </section>





                            <section id="contenido2" class="mt-4 ml-2">
                                <div>



                                    <form method="POST"
                                        action="{{ route('admin.empleados.storeResumen', [$empleado->id]) }}"
                                        id="formResumen">
                                        <div class="row">
                                            <div class="form-group col-sm-12 col-lg-12 col-md-12">
                                                <label for="resumen"><i
                                                        class="fas fa-file-alt iconos-crear"></i>Resumen</label>
                                                <textarea
                                                    class="form-control {{ $errors->has('resumen') ? 'is-invalid' : '' }}"
                                                    type="text" name="resumen"
                                                    id="resumen">{{ old('resumen', $empleado->resumen) }}</textarea>
                                                @if ($errors->has('resumen'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('resumen') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <button id="btnGuardarResumen" class="mr-3 btn btn-sm btn-outline-success"
                                            style="float: right; position: relative;"> <i
                                                class="mr-2 fas fa-plus-circle"></i>Guardar</button>
                                    </form>


                                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Certificaciones</span>
                                    </div>

                                    <form method="POST"
                                        action="{{ route('admin.empleados.storeCertificaciones', [$empleado->id]) }}"
                                        id="formCertificaciones" enctype="multipart/form-data">

                                        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" />
                                        <div class="row">
                                            <div class="form-group col-sm-12 col-lg-12 col-md-12">
                                                <label for="nombre"><i
                                                        class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                                                <input
                                                    class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                    type="text" name="nombre" id="nombre_certificado"
                                                    value="{{ old('nombre', '') }}">
                                                <span class="errors nombre_error text-danger"></span>
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
                                                <span class="errors vigencia_error text-danger"></span>
                                            </div>


                                            <div class="form-group col-sm-6">
                                                <label for="estatus"><i
                                                        class="fas fa-street-view iconos-crear"></i>Estatus</label>
                                                <input
                                                    class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}"
                                                    type="text" name="estatus" id="vencio_alta"
                                                    value="{{ old('estatus', '') }}" readonly>
                                                <span class="errors estatus_error text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mt-3 col-sm-12 form-group">
                                                <label for="evidencia"><i
                                                        class="fas fa-folder-open iconos-crear"></i>Adjuntar
                                                    Certificado</label>
                                                <div class="custom-file">
                                                    <input type="file" name="documento" class="form-control"
                                                        id="evidencia">
                                                    <span class="errors documento_error text-danger"></span>
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

                                    </form>
                                    <div class="mt-3 mb-4 col-12 w-100 datatable-fix">
                                        <table class="table w-100" id="tbl-certificados" style="width:100% !important">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Vigencia</th>
                                                    <th>Estatus</th>
                                                    <th>Documento</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                    <input type="hidden" name="certificado" value="" id="certificado">


                                    <div class="mb-3 w-100 " style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Cursos / Diplomados</span>
                                    </div>


                                    <form method="POST"
                                        action="{{ route('admin.empleados.storeCursos', [$empleado->id]) }}"
                                        id="formCursos">

                                        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" />

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for="curso_diplomado"><i
                                                        class="fas fa-street-view iconos-crear"></i>Nombre
                                                    del curso /
                                                    diplomado</label>
                                                <input
                                                    class="form-control {{ $errors->has('curso_diplomado') ? 'is-invalid' : '' }}"
                                                    type="text" name="curso_diploma" id="curso_diplomado"
                                                    value="{{ old('curso_diplomado', '') }}">
                                                <span class="errors curso_diploma_error text-danger"></span>
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
                                                <span class="errors tipo_error text-danger"></span>
                                            </div>



                                            <div class="form-group col-sm-3">
                                                <label for="año"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>Año</label>
                                                <input
                                                    class="form-control {{ $errors->has('año') ? 'is-invalid' : '' }}"
                                                    type="date" name="año" id="año" value="{{ old('año', '') }}">
                                                <span class="errors año_error text-danger"></span>
                                            </div>


                                            <div class="form-group col-sm-3">
                                                <label for="duracion"><i
                                                        class="fas fa-street-view iconos-crear"></i>Duración
                                                    (Hrs)</label>
                                                <input
                                                    class="form-control {{ $errors->has('duracion') ? 'is-invalid' : '' }}"
                                                    type="number" name="duracion" id="duracion"
                                                    value="{{ old('duracion', '') }}">
                                                <span class="errors duracion_error text-danger"></span>
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
                                    </form>

                                    <div class="mt-3 mb-4 col-12 w-100 datatable-fix">
                                        <table class="table w-100" id="tbl-cursos">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Año</th>
                                                    <th>Duración</th>
                                                    <th>Eliminar</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>


                                    <input type="hidden" name="curso" value="" id="curso">



                                    <div class="mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Experiencia Profesional</span>
                                    </div>

                                    <form method="POST"
                                        action="{{ route('admin.empleados.storeExperiencia', [$empleado->id]) }}"
                                        id="formExperiencia" enctype="multipart/form-data">

                                        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" />

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="empresa"><i
                                                        class="fas fa-building iconos-crear"></i>Empresa</label>
                                                <input
                                                    class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}"
                                                    type="text" name="empresa" id="empresa"
                                                    value="{{ old('empresa', '') }}">
                                                <span class="errors empresa_error text-danger"></span>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="puesto"><i
                                                        class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                                <input
                                                    class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}"
                                                    type="text" name="puesto" id="puesto_trabajo"
                                                    value="{{ old('puesto', '') }}">
                                                <span class="errors puesto_error text-danger"></span>
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
                                                <span class="errors inicio_mes_error text-danger"></span>
                                            </div>



                                            <div class="form-group col-sm-6">
                                                <label for="fin_mes"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>A</label>
                                                <input
                                                    class="form-control {{ $errors->has('fin_mes') ? 'is-invalid' : '' }}"
                                                    type="date" name="fin_mes" id="fin_mes"
                                                    value="{{ old('fin_mes', '') }}">
                                                <span class="errors fin_mes_error text-danger"></span>
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
                                                <span class="errors descripcion_error text-danger"></span>
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
                                    </form>

                                    <div class="mt-3 mb-4 col-12 w-100 datatable-fix">
                                        <table class="table w-100" id="tbl-experiencia">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Empresa</th>
                                                    <th>Puesto</th>
                                                    <th>Descripción</th>
                                                    <th>Inicio</th>
                                                    <th>Fin</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                    <input type="hidden" name="experiencia" value="" id="experiencia">


                                    <div class="mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            Educación</span>
                                    </div>


                                    <form method="POST"
                                        action="{{ route('admin.empleados.storeEducacion', [$empleado->id]) }}"
                                        id="formEducacion" enctype="multipart/form-data">

                                        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" />

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="institucion"><i
                                                        class="fas fa-school iconos-crear"></i>Institución</label>
                                                <input
                                                    class="form-control {{ $errors->has('institucion') ? 'is-invalid' : '' }}"
                                                    type="text" name="institucion" id="institucion"
                                                    value="{{ old('institucion', '') }}">
                                                <span class="errors institucion_error text-danger"></span>
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
                                                <span class="errors nivel_error text-danger"></span>
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
                                                <span class="errors año_inicio_error text-danger"></span>
                                            </div>



                                            <div class="form-group col-sm-6">
                                                <label for="año_fin"><i
                                                        class="far fa-calendar-alt iconos-crear"></i>A</label>
                                                <input
                                                    class="form-control {{ $errors->has('año_fin') ? 'is-invalid' : '' }}"
                                                    type="date" name="año_fin" id="año_fin"
                                                    value="{{ old('año_fin', '') }}">
                                                <span class="errors año_fin_error text-danger"></span>
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
                                    </form>

                                    <div class="mt-3 mb-4 col-12 w-100 datatable-fix">
                                        <table class="table w-100" id="tbl-educacion">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Institución</th>
                                                    <th>Nivel</th>
                                                    <th>Inicio</th>
                                                    {{-- <th scope="col">Área</th> --}}
                                                    <th>Fin</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
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
                                            class="fas fa-info-circle" style="font-size:12pt; float: right;" title=""></i>
                                        <div class="custom-file">
                                            <input type="file" name="files[]" multiple class="form-control"
                                                id="documentos">

                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>


                    <div class="text-right form-group col-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
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

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            document.getElementById("btnGuardarResumen").addEventListener("click", function(e) {
                e.preventDefault();
                let url = $("#formResumen").attr("action");
                console.log(url)
                $.ajax({
                    type: "post",
                    url: url,
                    data: $("#formResumen").serialize(),
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
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.empleados.getExperiencia', $empleado->id) }}",
                columns: [{
                        data: 'empresa',
                        name: 'empresa'
                    },
                    {
                        data: 'puesto',
                        name: 'puesto'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'inicio_mes',
                        name: 'inicio_mes'
                    },
                    {
                        data: 'fin_mes',
                        name: 'fin_mes'
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
            })

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
                ajax: "{{ route('admin.empleados.getEducacion', $empleado->id) }}",
                columns: [{
                        data: 'institucion',
                        name: 'institucion'
                    },
                    {
                        data: 'nivel',
                        name: 'nivel'
                    },
                    {
                        data: 'año_inicio',
                        name: 'año_inicio'
                    },
                    {
                        data: 'año_fin',
                        name: 'año_fin'
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
                ajax: "{{ route('admin.empleados.getCursos', $empleado->id) }}",
                columns: [{
                        data: 'curso_diploma',
                        name: 'nombre'
                    },
                    {
                        data: 'tipo',
                        name: 'tipo'
                    },
                    {
                        data: 'año',
                        name: 'año'
                    },
                    {
                        data: 'duracion',
                        name: 'duracion'
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
                ajax: "{{ route('admin.empleados.getCertificaciones', $empleado->id) }}",
                columns: [{
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'vigencia',
                        name: 'vigencia'
                    },
                    {
                        data: 'estatus',
                        name: 'estatus'
                    },
                    {
                        data: 'documento',
                        name: 'documento'
                    },
                    {
                        data: 'id',
                        render: function(data, type, route, meta) {
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
                document.querySelector('#formEmpleados').submit();

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
            //     let experiencias = tblExperiencia.rows().data().toArray();
            //     let arrExperiencia = [];
            //     experiencias.forEach(experiencia => {
            //         arrExperiencia.push(experiencia[0])

            //     });

            //     //no se puedan agregar datos que ya estan
            //     let nombre = $("#empresa").val();
            //     let puesto = $("#puesto_trabajo").val();
            //     let descripcion = $("#descripcion").val();
            //     let inicio_mes = $("#inicio_mes").val();
            //     let fin_mes = $("#fin_mes").val();
            //     if (nombre.trim() == '') {
            //         document.querySelector('.empresa_error').innerHTML = "El campo empresa es requerido"
            //         // limpiarCamposExperienciaPorId('empresa');
            //     }
            //     if (puesto.trim() == '') {
            //         document.querySelector('.puesto_trabajo_error').innerHTML = "El campo puesto es requerido"
            //         // limpiarCamposExperienciaPorId('puesto_trabajo');
            //     }
            //     if (inicio_mes.trim() == '') {
            //         document.querySelector('.inicio_mes_error').innerHTML = "El campo de inicio de puesto laboral es requerido"
            //         // limpiarCamposExperienciaPorId('puesto_trabajo');
            //     }
            //     if (fin_mes.trim() == '') {
            //         document.querySelector('.fin_mes_error').innerHTML = "El campo fin de puesto laboral es requerido"
            //         // limpiarCamposExperienciaPorId('fin_mes');
            //     }
            //     if (descripcion.trim() == '') {
            //         document.querySelector('.descripcion_error').innerHTML = "El campo de descripción laboral es requerido"
            //         // limpiarCamposExperienciaPorId('descripcion_error');
            //     }
            //     if (nombre.trim() != '' && puesto.trim() != '' && inicio_mes.trim() != '' && fin_mes.trim() != '' && descripcion
            //         .trim() != '') {
            //         limpiarCamposExperiencia();


            //         if (!arrExperiencia.includes(nombre)) {


            //             tblExperiencia.row.add([
            //                 nombre,
            //                 puesto,
            //                 descripcion,
            //                 inicio_mes,
            //                 fin_mes
            //             ]).draw();

            //         } else {
            //             Swal.fire('Este participante ya ha sido agregado', '', 'error')
            //             limpiarCamposExperiencia();
            //         }
            //     }
            //     //limpia campos

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

            // let educacions = tblEducacion.rows().data().toArray();
            // let arrEducacion = [];
            // educacions.forEach(educacion => {
            //     arrEducacion.push(educacion[0])

            // });


            // //no se puedan agregar datos que ya estan
            // let institucion = $("#institucion").val();
            // let año_inicio = $("#año_inicio").val();
            // let año_fin = $("#año_fin").val();
            // let nivel = $("#nivel").val();

            // if (institucion.trim() == '') {
            //     document.querySelector('.institucion_error').innerHTML = "El campo institucion es requerido"
            //     // limpiarCamposExperienciaPorId('empresa');
            // }
            // if (año_inicio.trim() == '') {
            //     document.querySelector('.año_inicio_error').innerHTML = "El campo inicio de año es requerido"
            //     // limpiarCamposExperienciaPorId('empresa');
            // }
            // if (año_fin.trim() == '') {
            //     document.querySelector('.año_fin_error').innerHTML = "El campo inicio de fin es requerido"
            //     // limpiarCamposExperienciaPorId('empresa');
            // }
            // if (document.getElementById('nivel').value == "") {
            //     document.querySelector('.nivel_error').innerHTML = "El campo nivel es requerido"
            //     // limpiarCamposExperienciaPorId('empresa');
            // }
            // if (institucion.trim() != '' && año_inicio.trim() != '' && año_fin.trim() != '' && document.getElementById(
            //         'nivel').value != "") {
            //     limpiarCamposEducacion();


            //     if (!arrEducacion.includes(institucion)) {
            //         tblEducacion.row.add([
            //             institucion,
            //             año_inicio,
            //             año_fin,
            //             nivel,
            //         ]).draw();

            //     } else {
            //         Swal.fire('Este registro ya ha sido agregado', '', 'error')
            //     }
            // }
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
            //     //form-participantes

            //     let cursos = tblCurso.rows().data().toArray();
            //     let arrCurso = [];
            //     cursos.forEach(curso => {
            //         arrCurso.push(curso[0])

            //     });
            //     //no se puedan agregar datos que ya estan


            //     let curso_diplomado = $("#curso_diplomado").val();
            //     let tipo = $("#tipo").val();
            //     let año = $("#año").val();
            //     let duracion = $("#duracion").val();

            //     if (curso_diplomado.trim() == '') {
            //         document.querySelector('.curso_diplomado_error').innerHTML = "El campo curso/diplomado es requerido"
            //         // limpiarCamposExperienciaPorId('empresa');
            //     }

            //     if (document.getElementById('tipo').value == "") {
            //         document.querySelector('.tipo_error').innerHTML = "El campo tipo es requerido"
            //         // limpiarCamposExperienciaPorId('empresa');
            //     }

            //     if (año.trim() == '') {
            //         document.querySelector('.año_error').innerHTML = "El campo año es requerido"
            //         // limpiarCamposExperienciaPorId('empresa');
            //     }

            //     if (duracion.trim() == '') {
            //         document.querySelector('.duracion_error').innerHTML = "El campo duración es requerido"
            //         // limpiarCamposExperienciaPorId('empresa');
            //     }

            //     if (curso_diplomado.trim() != '' && año.trim() != '' && duracion.trim() != '' && document.getElementById('tipo')
            //         .value != "") {
            //         limpiarCamposCursos();



            //         if (!arrCurso.includes(curso_diplomado)) {

            //             tblCurso.row.add([
            //                 curso_diplomado,
            //                 tipo,
            //                 año,
            //                 duracion,
            //             ]).draw();

            //         } else {
            //             Swal.fire('Este registro ya ha sido agregado', '', 'error')
            //         }
            //     }
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

            $.ajax({
                type: "post",
                url: url,
                data: new FormData(document.getElementById("formCertificaciones")),
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

            //form-participantes

            // let certificados = tblCertificado.rows().data().toArray();
            // let arrCertificado = [];
            // certificados.forEach(certificado => {
            //     arrCertificado.push(certificado[0])

            // });
            // //no se puedan agregar datos que ya estan
            // let nombre_certificado = $("#nombre_certificado").val();
            // let vigencia = $("#vigencia").val();
            // let estatus = $("#vencio_alta").val();


            // if (nombre_certificado.trim() == '') {
            //     document.querySelector('.nombre_certificado_error').innerHTML =
            //         "El campo nombre del certificado es requerido"
            //     // limpiarCamposExperienciaPorId('empresa');
            // }
            // if (vigencia.trim() == '') {
            //     document.querySelector('.vigencia_error').innerHTML = "El campo vigencia es requerido"
            //     // limpiarCamposExperienciaPorId('empresa');
            // }
            // if (estatus.trim() == '') {
            //     document.querySelector('.estatus_error').innerHTML = "El campo estatus es requerido"
            //     // limpiarCamposExperienciaPorId('empresa');
            // }

            // if (nombre_certificado.trim() != '' && vigencia.trim() != '' && estatus.trim() != '') {
            //     limpiarCamposCertificados();

            //     if (!arrCertificado.includes(nombre_certificado)) {

            //         tblCertificado.row.add([
            //             nombre_certificado,
            //             vigencia,
            //             estatus,
            //         ]).draw();

            //     } else {
            //         Swal.fire('Este registro ya ha sido agregado', '', 'error')
            //     }
            // }
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


@endsection
