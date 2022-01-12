<style>
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    #grad1 {
        background-color: : #9C27B0;
        background-image: linear-gradient(120deg, #FF4081, #81D4FA)
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset .form-card {
        background: white;
        border: 0 none;
        border-radius: 0px;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        padding: 20px 40px 30px 40px;
        box-sizing: border-box;
        width: 94%;
        margin: 0 3% 20px 3%;
        position: relative
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform fieldset .form-card {
        text-align: left;
        color: #9E9E9E
    }

    #msform input,
    #msform textarea {
        /* padding: 0px 8px 4px 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 16px;
            letter-spacing: 1px */
    }

    #msform input:focus,
    #msform textarea:focus {
        /* -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none;
            font-weight: bold;
            border-bottom: 2px solid skyblue;
            outline-width: 0 */
    }

    #msform .action-button {
        width: 100px;
        background: rgb(196, 196, 196);
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
    }

    select.list-dt {
        border: none;
        outline: 0;
        border-bottom: 1px solid #ccc;
        padding: 2px 5px 3px 5px;
        margin: 2px
    }

    select.list-dt:focus {
        border-bottom: 2px solid skyblue
    }

    .card {
        z-index: 0;
        border: none;
        border-radius: 0.5rem;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #2C3E50;
        margin-bottom: 10px;
        font-weight: bold;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #000000
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12px;
        width: 16%;
        float: left;
        position: relative
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f023"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f09d"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #00a57e;
    }

    .radio-group {
        position: relative;
        margin-bottom: 25px;
    }

    .radio {
        display: inline-block;
        width: 204;
        height: 104;
        border-radius: 0;
        background: lightblue;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        cursor: pointer;
        margin: 8px 2px
    }

    .radio:hover {
        box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
    }

    .radio.selected {
        box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
    }


    .fit-image {
        width: 100%;
        object-fit: cover
    }

</style>

<h5 class="col-12 titulo_general_funcion">Empleado</h5>
<div class="mt-4 card">
    <div class="row">
        <div class="mx-0 col-md-12">
            <form id="msform">
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active" id="account"><strong>Información General</strong></li>
                    <li id="payment"><strong>Experiencia</strong></li>
                    <li id="confirm"><strong>Educación</strong></li>
                    <li id="personal"><strong>Certificaciones</strong></li>
                    <li id="personal"><strong>Cursos / Diplomados</strong></li>
                    <li id="personal"><strong>Expediente</strong></li>
                </ul> <!-- fieldsets -->
                <fieldset>

                    {{-- <h2 class="fs-title">Account Information</h2> <input type="email" name="email"
                                        placeholder="Email Id" /> <input type="text" name="uname"
                                        placeholder="UserName" /> <input type="password" name="pwd"
                                        placeholder="Password" /> <input type="password" name="cpwd"
                                        placeholder="Confirm Password" /> --}}

                    <div class="tab-content card" id="myTabContentJust">
                        <div class="px-4 mt-4 tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="required" for="name"><i
                                            class="fas fa-street-view iconos-crear"></i>Nombre</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        type="text" name="name" id="name" value="{{ old('name', '') }}" required>
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
                                    <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}"
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
                                        <label class="required" for="jefe"><i class="fas fa-user iconos-crear"></i>Jefe
                                            Inmediato</label>
                                        <div class="mb-3 input-group">

                                            <select class="custom-select supervisor" id="inputGroupSelect01"
                                                name="supervisor_id">
                                                <option selected value="" disabled>-- Selecciona supervisor --</option>
                                                @forelse ($empleados as $empleado)
                                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}
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
                                    <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}"
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
                                    <input class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}"
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
                                            <option value="H" {{ old('genero') == 'H' ? 'selected' : '' }}>Hombre
                                            </option>
                                            <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Mujer
                                            </option>
                                            <option value="X" {{ old('genero') == 'X' ? 'selected' : '' }}>Otro
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
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="telefono"><i class="fas fa-mobile-alt iconos-crear"></i></i>Teléfono
                                        móvil</label>
                                    <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                        type="text" name="telefono" id="telefono" value="{{ old('telefono', '') }}">
                                    @if ($errors->has('telefono'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('telefono') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="telefono"><i class="fas fa-phone iconos-crear"></i>Teléfono
                                        oficina</label>
                                    <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                        type="text" name="telefono" id="telefono" value="{{ old('telefono', '') }}">
                                    @if ($errors->has('telefono'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('telefono') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="telefono"><i class="fas fa-phone-volume iconos-crear"></i>Ext.</label>
                                    <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                        type="text" name="telefono" id="telefono" value="{{ old('telefono', '') }}">
                                    @if ($errors->has('telefono'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('telefono') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="sede_id"><i class="fas fa-building iconos-crear"></i>Sede</label>
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
                                                <div class="col-md-5 col-sm-5 col-12 d-flex justify-content-center"
                                                    id="avatar_choose">
                                                    <label style="cursor: pointer">
                                                        <div class="d-flex align-items-center">
                                                            <h5>
                                                                <i class="fas fa-image iconos-crear"
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
                                        <button class="btn btn-outline-success screenshot d-none" title="Capturar"><i
                                                class="fas fa-image"></i></button>
                                    </div>
                                </div>
                                <input type="hidden" id="snapshoot" readonly autocomplete="off" name="snap_foto">
                            </div>
                        </div>





                        <input type="button" name="next" class="next action-button" value="Siguiente" />
                </fieldset>
                <fieldset>
                    {{-- <div class="form-card">
                                    <h2 class="fs-title">Personal Information</h2> <input type="text" name="fname"
                                        placeholder="First Name" /> <input type="text" name="lname"
                                        placeholder="Last Name" /> <input type="text" name="phno"
                                        placeholder="Contact No." /> <input type="text" name="phno_2"
                                        placeholder="Alternate Contact No." />
                                </div> --}}

                    <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Certificaciones</span>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="nombre"><i class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                            <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                                name="nombre" id="nombre" value="{{ old('nombre', '') }}" required>
                            @if ($errors->has('nombre'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombre') }}
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="vigencia"><i class="far fa-calendar-alt iconos-crear"></i>Vigencia</label>
                            <input class="form-control {{ $errors->has('vigencia') ? 'is-invalid' : '' }}"
                                type="text" name="vigencia" id="vigencia" value="{{ old('vigencia', '') }}" required>
                            @if ($errors->has('vigencia'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vigencia') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="estatus"><i class="fas fa-street-view iconos-crear"></i>Estatus</label>
                            <input class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" type="text"
                                name="estatus" id="estatus" value="{{ old('estatus', '') }}" required>
                            @if ($errors->has('estatus'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('estatus') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="mt-3 col-sm-12 form-group">
                            <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Adjuntar
                                Certificado</label>
                            <div class="custom-file">
                                <input type="file" name="files[]" multiple class="form-control" id="evidencia">

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button id="btn-suscribir-participante" type="submit"
                            class="mr-3 btn btn-sm btn-outline-success" style="float: right; position: relative;">
                            <i class="mr-1 fas fa-plus-circle"></i>
                            Agregar Certificación
                            {{-- <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
                                            style="position: absolute; top: 3px;left: 8px;"></i> --}}
                        </button>
                    </div>

                    <div class="mt-3 col-12 w-100 datatable-fix">
                        <table class="table w-100" id="tbl-participantes">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Vigencia</th>
                                    <th>Estatus</th>
                                    <th>Documento</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <input type="button" name="previous" class="previous action-button-previous" value="Regresar" />
                    <input type="button" name="next" class="next action-button" value="Siguiente" />
                </fieldset>
                <fieldset>
                    {{-- <div class="form-card">
                                    <h2 class="fs-title">Payment Information</h2>
                                    <div class="radio-group">
                                        <div class='radio' data-value="credit"><img
                                                src="https://i.imgur.com/XzOzVHZ.jpg" width="200px" height="100px">
                                        </div>
                                        <div class='radio' data-value="paypal"><img
                                                src="https://i.imgur.com/jXjwZlj.jpg" width="200px" height="100px">
                                        </div> <br>
                                    </div> <label class="pay">Card Holder Name*</label> <input type="text"
                                        name="holdername" placeholder="" />
                                    <div class="row">
                                        <div class="col-9"> <label class="pay">Card Number*</label> <input type="text"
                                                name="cardno" placeholder="" /> </div>
                                        <div class="col-3"> <label class="pay">CVC*</label> <input type="password"
                                                name="cvcpwd" placeholder="***" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3"> <label class="pay">Expiry Date*</label> </div>
                                        <div class="col-9"> <select class="list-dt" id="month" name="expmonth">
                                                <option selected>Month</option>
                                                <option>January</option>
                                                <option>February</option>
                                                <option>March</option>
                                                <option>April</option>
                                                <option>May</option>
                                                <option>June</option>
                                                <option>July</option>
                                                <option>August</option>
                                                <option>September</option>
                                                <option>October</option>
                                                <option>November</option>
                                                <option>December</option>
                                            </select> <select class="list-dt" id="year" name="expyear">
                                                <option selected>Year</option>
                                            </select> </div>
                                    </div>
                                </div> --}}

                    <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Cursos / Diplomados</span>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="curso_diplomado"><i class="fas fa-street-view iconos-crear"></i>Nombre del curso
                                /
                                diplomado</label>
                            <input class="form-control {{ $errors->has('curso_diplomado') ? 'is-invalid' : '' }}"
                                type="text" name="curso_diplomado" id="curso_diplomado"
                                value="{{ old('curso_diplomado', '') }}" required>
                            @if ($errors->has('curso_diplomado'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('curso_diplomado') }}
                                </div>
                            @endif
                        </div>
                    </div>



                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="tipo"><i class="fas fa-street-view iconos-crear"></i>Tipo</label>
                            <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo"
                                id="tipo">
                                <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\CursosDiplomasEmpleados::TipoSelect as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('tipo', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tipo') }}
                                </div>
                            @endif
                        </div>



                        <div class="form-group col-sm-3">
                            <label for="año"><i class="far fa-calendar-alt iconos-crear"></i>Año</label>
                            <input class="form-control {{ $errors->has('año') ? 'is-invalid' : '' }}" type="month"
                                name="año" id="año" value="{{ old('año', '') }}">
                            @if ($errors->has('año'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('año') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-sm-3">
                            <label for="duracion"><i class="fas fa-street-view iconos-crear"></i>Duración</label>
                            <input class="form-control {{ $errors->has('duracion') ? 'is-invalid' : '' }}"
                                type="text" name="duracion" id="duracion" value="{{ old('duracion', '') }}">
                            @if ($errors->has('duracion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('duracion') }}
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="mb-5 col-12">
                        <button id="btn-suscribir-curso" type="submit" class="mr-3 btn btn-sm btn-outline-success"
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

                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    <input type="button" name="make_payment" class="next action-button" value="Confirm" />
                </fieldset>
                <fieldset>
                    <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Experiencia Profesional</span>
                    </div>

                    <div class="row">

                        <div class="form-group col-sm-6">
                            <label for="empresa"><i class="fas fa-building iconos-crear"></i>Empresa</label>
                            <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                                name="empresa" id="empresa" value="{{ old('empresa', '') }}">
                            @if ($errors->has('empresa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('empresa') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                                name="puesto" id="puesto_trabajo" value="{{ old('puesto', '') }}">
                            @if ($errors->has('puesto'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('puesto') }}
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="mt-1 form-group col-12">
                        <b>Periodo laboral:</b>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="inicio_mes"><i class="far fa-calendar-alt iconos-crear"></i>De</label>
                            <input class="form-control {{ $errors->has('inicio_mes') ? 'is-invalid' : '' }}"
                                type="month" name="inicio_mes" id="inicio_mes" value="{{ old('inicio_mes', '') }}">
                            @if ($errors->has('inicio_mes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('inicio_mes') }}
                                </div>
                            @endif
                        </div>



                        <div class="form-group col-sm-6">
                            <label for="fin_mes"><i class="far fa-calendar-alt iconos-crear"></i>A</label>
                            <input class="form-control {{ $errors->has('fin_mes') ? 'is-invalid' : '' }}"
                                type="month" name="fin_mes" id="fin_mes" value="{{ old('fin_mes', '') }}">
                            @if ($errors->has('fin_mes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fin_mes') }}
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="descripcion"><i
                                    class="fas fa-clipboard-list iconos-crear"></i>Descripción</label>
                            <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                type="text" name="descripcion"
                                id="descripcion"> {{ old('descripcion', '') }}</textarea>
                            @if ($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion') }}
                                </div>
                            @endif
                        </div>

                    </div>


                    <div class="mb-5 col-12">
                        <button id="btn-agregar-experiencia" type="submit" class="mr-3 btn btn-sm btn-outline-success"
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


                </fieldset>
                <fieldset>
                    {{-- <div class="form-card">
                                    <h2 class="text-center fs-title">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png"
                                                class="fit-image"> </div>
                                    </div> --}}
                    <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Educación</span>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="institucion"><i class="fas fa-school iconos-crear"></i>Institución</label>
                            <input class="form-control {{ $errors->has('institucion') ? 'is-invalid' : '' }}"
                                type="text" name="institucion" id="institucion" value="{{ old('institucion', '') }}">
                            @if ($errors->has('institucion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institucion') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-sm-6">
                            <label for="nivel"><i class="fas fa-street-view iconos-crear"></i>Nivel de estudios</label>
                            <select class="form-control {{ $errors->has('nivel') ? 'is-invalid' : '' }}" name="nivel"
                                id="nivel">
                                <option value disabled {{ old('nivel', null) === null ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                @foreach (App\Models\EducacionEmpleados::NivelSelect as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('nivel', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('nivel'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nivel') }}
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="año_inicio"><i class="far fa-calendar-alt iconos-crear"></i>De</label>
                            <input class="form-control {{ $errors->has('año_inicio') ? 'is-invalid' : '' }}"
                                type="month" name="año_inicio" id="año_inicio" value="{{ old('año_inicio', '') }}">
                            @if ($errors->has('año_inicio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('año_inicio') }}
                                </div>
                            @endif
                        </div>



                        <div class="form-group col-sm-6">
                            <label for="año_fin"><i class="far fa-calendar-alt iconos-crear"></i>A</label>
                            <input class="form-control {{ $errors->has('año_fin') ? 'is-invalid' : '' }}"
                                type="month" name="año_fin" id="año_fin" value="{{ old('año_fin', '') }}">
                            @if ($errors->has('año_fin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('año_fin') }}
                                </div>
                            @endif
                        </div>

                    </div>


                    <div class="mb-5 col-12">
                        <button id="btn-agregar-educacion" type="submit" class="mr-3 btn btn-sm btn-outline-success"
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
                    <br><br>
                    <div class="row justify-content-center">
                        <div class="text-center col-7">
                            <h5>You Have Successfully Signed Up</h5>
                        </div>
                    </div>
        </div>
        </fieldset>
        <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
            <span style="font-size: 17px; font-weight: bold;">
                Documentos</span>
        </div>

        <div class="mt-3 col-sm-12 form-group">
            <label for="documentos"><i
                    class="fas fa-folder-open iconos-crear"></i>Documentos</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;" title=""></i>
            <div class="custom-file">
                <input type="file" name="files[]" multiple class="form-control" id="documentos">

            </div>
        </div>

        <fieldset>

        </fieldset>
        </form>
    </div>
</div>
</div>





<script>

$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});

previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

$('.radio-group .radio').click(function(){
$(this).parent().find('.radio').removeClass('selected');
$(this).addClass('selected');
});

$(".submit").click(function(){
return false;
})

});

</script>
