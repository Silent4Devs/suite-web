<div>
    <div method="POST" action="{{ route('admin.empleados.storeResumen', [$empleado->id]) }}" id="formResumen">
        <div class="row">
            <div class="form-group col-sm-12 col-lg-12 col-md-12">
                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold;">
                        Resumen</span>
                </div>
                <textarea class="form-control {{ $errors->has('resumen') ? 'is-invalid' : '' }}" type="text" name="resumen"
                    id="resumen">{{ old('resumen', $empleado->resumen) }}</textarea>
                @if ($errors->has('resumen'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resumen') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-5 col-12" style="text-align: end">
            <button id="btnGuardarResumen" class="mr-3 btn btn-sm btn-success">Guardar</button>
        </div>
    </div>


    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Certificaciones</span>
    </div>

    <div method="POST" action="{{ route('admin.empleados.storeCertificaciones', [$empleado->id]) }}"
        id="formCertificaciones" enctype="multipart/form-data" x-data="{ open: false }">
        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" />
        <div class="row">
            <div class="form-group col-sm-12 col-lg-12 col-md-12">
                <label for="nombre"><i class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                    id="nombre_certificado" value="{{ old('nombre', '') }}">
                <span class="errors nombre_error text-danger"></span>
            </div>
            <div class="col-12 form-group">
                <div class="form-check">
                    <input class="form-check-input" name="aplicaVigencia" type="checkbox" id="aplicaVigencia"
                        x-on:change="open = !open">
                    <label class="form-check-label" for="aplicaVigencia">
                        ¿Aplica Vigencia?
                    </label>
                </div>
            </div>
        </div>
        <div class="row" x-show="open">
            <div class="form-group col-sm-6">
                <label for="vigencia"><i class="far fa-calendar-alt iconos-crear"></i>Vigencia</label>
                <input class="form-control {{ $errors->has('vigencia') ? 'is-invalid' : '' }}" type="date"
                    name="vigencia" id="vigencia" value="{{ old('vigencia', '') }}">
                <span class="errors vigencia_error text-danger"></span>
            </div>


            <div class="form-group col-sm-6">
                <label for="estatus"><i class="fas fa-street-view iconos-crear"></i>Estatus</label>
                <input class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" type="text"
                    name="vencio_alta" id="vencio_alta" value="{{ old('vencio_alta', '') }}" readonly>
                <span class="errors estatus_error text-danger"></span>
            </div>
        </div>

        <div class="row">
            <div class="mt-3 col-sm-12 form-group">
                <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Adjuntar
                    Certificado</label>
                {{-- <div class="custom-file">
                    <input type="file" name="documento" class="form-control custom-file-input" id="evidencia">
                    <span class="errors documento_error text-danger"></span>
                </div> --}}

                <div class="custom-file">
                    <input type="file" name="documento" id="evidencia" aria-describedby="inputGroupFileAddon01">
                    {{-- <label class="custom-file-label" for="evidencia">Seleccionar archivo</label> --}}
                    <span class="errors documento_error text-danger"></span>
                </div>
            </div>
        </div>

        <div class="mb-5 col-12" style="text-align: end">
            <button id="btn-suscribir-certificado" type="submit" class="mr-3 btn btn-sm btn-success">
                Agregar
            </button>

        </div>

    </div>
    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
        <table class="table w-100" id="tbl-certificados" style="width:100%">
            <thead>
                <tr>
                    <th>Certificación</th>
                    <th>Vigencia</th>
                    <th>Estatus</th>
                    <th>Documento</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <input type="hidden" name="certificado" value="" id="certificado">


    <div class="mb-3 w-100 " style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Capacitaciones</span>
    </div>


    <div method="POST" action="{{ route('admin.empleados.storeCursos', [$empleado->id]) }}" id="formCursos">
        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" id="empleado_id_curso" />
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="curso_diplomado"><i class="fas fa-certificate iconos-crear"></i>Nombre</label>
                <input class="form-control {{ $errors->has('curso_diplomado') ? 'is-invalid' : '' }}" type="text"
                    name="curso_diploma" id="curso_diplomado" value="{{ old('curso_diplomado', '') }}">
                <span class="errors curso_diploma_error text-danger"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="tipo"><i class="fas fa-chalkboard-teacher iconos-crear"></i>Tipo</label>
                <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo" id="tipo">
                    <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>
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
                <label for="año"><i class="far fa-calendar-alt iconos-crear"></i>Inicio</label>
                <input class="form-control {{ $errors->has('año') ? 'is-invalid' : '' }}" type="date" name="año"
                    id="año" value="{{ old('año', '') }}">
                <span class="errors año_error text-danger"></span>
            </div>
            <div class="form-group col-sm-3">
                <label for="fecha_fin"><i class="far fa-calendar-alt iconos-crear"></i>Fin</label>
                <input class="form-control {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}" type="date"
                    name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', '') }}">
                <span class="errors fecha_fin_error text-danger"></span>
            </div>
            {{-- <div class="form-group col-sm-3">
                <label for="duracion"><i class="fas fa-clock iconos-crear"></i>Duración
                    (Hrs)</label>
                <input class="form-control {{ $errors->has('duracion') ? 'is-invalid' : '' }}" type="number"
                    name="duracion" id="duracion" value="{{ old('duracion', '') }}">
                <span class="errors duracion_error text-danger"></span>
            </div> --}}
            <div class="mt-3 col-sm-12 form-group">
                <label for="file"><i class="fas fa-folder-open iconos-crear"></i>Adjuntar
                    Archivo</label>
                <div class="custom-file">
                    <input type="file" name="file" id="file_curso" aria-describedby="inputGroupFileAddon01">
                    <span class="errors file_error text-danger"></span>
                </div>
            </div>
        </div>
        <div class="mb-5 col-12">
            <button id="btn-suscribir-curso" type="submit" class="mr-3 btn btn-sm btn-success"
                style="float: right; position: relative;">
                Agregar
                {{-- <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
    style="position: absolute; top: 3px;left: 8px;"></i> --}}
            </button>
        </div>
    </div>

    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
        <table class="table w-100" id="tbl-cursos">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Duración&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Archivo</th>
                    <th>Eliminar</th>
                </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


    <input type="hidden" name="curso" value="" id="curso">



    <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Experiencia Profesional</span>
    </div>

    <div method="POST" action="{{ route('admin.empleados.storeExperiencia', [$empleado->id]) }}" id="formExperiencia"
        enctype="multipart/form-data">

        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" id="empleado_id_experiencia" />

        <div class="row">
            <div class="form-group col-sm-6">
                <label for="empresa"><i class="fas fa-building iconos-crear"></i>Empresa</label>
                <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                    name="empresa" id="empresa" value="{{ old('empresa', '') }}">
                <span class="errors empresa_error text-danger"></span>
            </div>

            <div class="form-group col-sm-6">
                <label for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                    name="puesto" id="puesto_trabajo" value="{{ old('puesto', '') }}">
                <span class="errors puesto_error text-danger"></span>
            </div>

        </div>

        <div class="mt-1 form-group col-12">
            <b>Periodo laboral:</b>
        </div>

        <div class="col-12 form-group p-0">
            <div class="form-check">
                <input class="form-check-input" name="trabactualmente" type="checkbox" id="trabactualmente"
                    x-on:change="open = !open">
                <label class="form-check-label" for="trabactualmente">
                    Trabajo actual
                </label>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6">
                <label for="inicio_mes"><i class="far fa-calendar-alt iconos-crear"></i>De</label>
                <input class="fecha_flatpickr form-control {{ $errors->has('inicio_mes') ? 'is-invalid' : '' }}"
                    type="text" name="inicio_mes" id="inicio_mes">
                <span class="errors inicio_mes_error text-danger"></span>
            </div>



            <div class="form-group col-sm-6" id="fin_mes_contenedor">
                <label for="fin_mes"><i class="far fa-calendar-alt iconos-crear"></i>A</label>
                <input class="fecha_flatpickr form-control {{ $errors->has('fin_mes') ? 'is-invalid' : '' }}"
                    type="text" name="fin_mes" id="fin_mes" value="{{ old('fin_mes', '') }}">
                <span class="errors fin_mes_error text-danger"></span>
            </div>

        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <label for="descripcion"><i class="fas fa-clipboard-list iconos-crear"></i>Descripción</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion"
                    id="descripcion_exp"> {{ old('descripcion', '') }}</textarea>
                <span class="errors descripcion_error text-danger"></span>
            </div>

        </div>



        <div class="mb-5 col-12">
            <button id="btn-agregar-experiencia" type="submit" class="mr-3 btn btn-sm btn-success"
                style="float: right; position: relative;">
                Agregar
                {{-- <i id="suscribiendo" class="fas fa-cog fa-spin text-muted"
    style="position: absolute; top: 3px;left: 8px;"></i> --}}
            </button>
        </div>
    </div>

    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
        <table class="table w-100" id="tbl-experiencia">
            <thead>
                <tr>
                    <th style="min-width:150px;">Empresa</th>
                    <th style="min-width:150px;">Puesto</th>
                    <th style="min-width:300px;">Descripción</th>
                    <th style="min-width:80px;">Inicio</th>
                    <th style="min-width:80px;">Fin</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <input type="hidden" name="experiencia" value="" id="experiencia">

    <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Educación Académica</span>
    </div>
    <div method="POST" action="{{ route('admin.empleados.storeEducacion', [$empleado->id]) }}" id="formEducacion"
        enctype="multipart/form-data">

        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" id="empleado_id_inst" />

        <div class="row">
            <div class="form-group col-sm-12">
                <label for="institucion"><i class="fas fa-school iconos-crear"></i>Institución</label>
                <input class="form-control {{ $errors->has('institucion') ? 'is-invalid' : '' }}" type="text"
                    name="institucion" id="institucion_inst" value="{{ old('institucion', '') }}">
                <span class="errors institucion_error text-danger"></span>
            </div>
            <div class="form-group col-sm-6">
                <label for="titulo_obtenido"><i class="fas fa-school iconos-crear"></i>Titulo Obtenido</label>
                <input class="form-control {{ $errors->has('titulo_obtenido') ? 'is-invalid' : '' }}" type="text"
                    name="titulo_obtenido" id="titulo_obtenido_inst" value="{{ old('titulo_obtenido', '') }}">
                <span class="errors titulo_obtenido_error text-danger"></span>
            </div>
            <div class="form-group col-sm-6">
                <label for="nivel"><i class="fas fa-graduation-cap iconos-crear"></i>Nivel de
                    estudios</label>
                <select class="form-control {{ $errors->has('nivel') ? 'is-invalid' : '' }}" name="nivel"
                    id="nivel_inst">
                    <option value disabled {{ old('nivel', null) === null ? 'selected' : '' }}>
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
        <div class="col-12 form-group p-0">
            <div class="form-check">
                <input class="form-check-input" name="estudactualmente" type="checkbox" id="estudactualmente"
                    x-on:change="open = !open">
                <label class="form-check-label" for="estudactualmente">
                    Estudio actualmente
                </label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="año_inicio"><i class="far fa-calendar-alt iconos-crear"></i>De</label>
                <input class="form-control fecha_flatpickr {{ $errors->has('año_inicio') ? 'is-invalid' : '' }}"
                    type="text" name="año_inicio" id="año_inicio_inst" value="{{ old('año_inicio', '') }}">
                <span class="errors año_inicio_error text-danger"></span>
            </div>
            <div class="form-group col-sm-6" id="año_fin_contenedor">
                <label for="año_fin"><i class="far fa-calendar-alt iconos-crear"></i>A</label>
                <input class="form-control fecha_flatpickr {{ $errors->has('año_fin') ? 'is-invalid' : '' }}"
                    type="text" name="año_fin" id="año_fin_inst" value="{{ old('año_fin', '') }}">
                <span class="errors año_fin_error text-danger"></span>
            </div>
        </div>
        <div class="mb-5 col-12">
            <button id="btn-agregar-educacion" type="submit" class="mr-3 btn btn-sm btn-success"
                style="float: right; position: relative;">
                Agregar
            </button>
        </div>
    </div>
    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
        <table class="table w-100" id="tbl-educacion">
            <thead>
                <tr>
                    <th>Institución</th>
                    <th>Titulo</th>
                    <th>Nivel</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="educacion" value="" id="educacion">

    {{-- IDIOMAS --}}
    <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Idiomas</span>
    </div>
    <div method="POST" action="{{ route('admin.idiomas-empleados.store', [$empleado->id]) }}" id="formIdiomas"
        enctype="multipart/form-data">
        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" id="empleado_id_idioma" />
        <div class="row">
            <div class="form-group col-sm-5">
                <label for="id_language"><i class="fas fa-school iconos-crear"></i>Nombre</label>
                <select class="form-control {{ $errors->has('id_language') ? 'is-invalid' : '' }}"
                    name="id_language" id="nombre_idioma" value="{{ old('id_language', '') }}">
                    <option value="">Seleccione una opción</option>
                    @foreach ($idiomas as $id => $idioma)
                        <option value="{{ $idioma->id }}">
                            {{ $idioma->idioma }}
                        </option>
                    @endforeach
                </select>
                <span class="errors nombre_error text-danger"></span>
            </div>
            <div class="form-group col-sm-5">
                <label for="nivel"><i class="fas fa-graduation-cap iconos-crear"></i>Nivel</label>
                <select class="form-control {{ $errors->has('nivel') ? 'is-invalid' : '' }}" name="nivel"
                    id="nivel_idioma">
                    <option value disabled {{ old('nivel', null) === null ? 'selected' : '' }}>
                        Selecciona una opción</option>
                    @foreach (App\Models\IdiomaEmpleado::NIVELES as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('nivel', '') === (string) $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <span class="errors nivel_error text-danger"></span>
            </div>
            <div class="form-group col-sm-2">
                <label for="porcentaje"><i class="far fa-percent iconos-crear"></i>Porcentaje</label>
                <input style="padding-left: 20px;"
                    class="form-control {{ $errors->has('porcentaje') ? 'is-invalid' : '' }}" type="number"
                    name="porcentaje" id="porcentaje_idioma" value="{{ old('porcentaje', '') }}">
                {{-- <i class="far fa-percent iconos-crear"
                    style="position: absolute;top: 44px;left: 20px;font-size: 13px;"></i> --}}
                <span class="errors porcentaje_error text-danger"></span>
            </div>
        </div>
        <div class="row">
            <div class="mt-3 col-sm-12 form-group">
                <label for="certificado"><i class="fas fa-folder-open iconos-crear"></i>Certificado</label>
                <div class="custom-file">
                    <input type="file" name="certificado" id="certificado_idioma"
                        aria-describedby="inputGroupFileAddon01">
                    <span class="errors certificado_error text-danger"></span>
                </div>
            </div>
        </div>
        <div class="mb-5 col-12">
            <button id="btn-agregar-idioma" type="submit" class="mr-3 btn btn-sm btn-success"
                style="float: right; position: relative;">
                Agregar
            </button>
        </div>
    </div>
    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
        <table class="table w-100" id="tbl-idiomas">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nivel</th>
                    <th>Porcentaje</th>
                    <th>Certificado</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="idioma" value="" id="idioma">
</div>
