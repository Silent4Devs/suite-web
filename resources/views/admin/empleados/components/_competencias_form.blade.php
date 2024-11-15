<div>
    <div method="POST" action="{{ route('admin.empleados.storeResumen', [$empleado->id]) }}" id="formResumen">
        <div class="row">
            <div class="form-group col-sm-12 col-lg-12 col-md-12">
                {{-- <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px var(--color-tbj)">
                    <span style="font-size: 17px; font-weight: bold;">
                        Resumen</span>
                </div> --}}
                <h4 class="color-tbj">Resumen</h4>
                <hr>
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
    {{-- @livewire('training.training', ['id' => $id]) --}}
    <livewire:training.training :id={{ $id }} />

    {{-- <div class="mb-3 w-100" style="border-bottom: solid 2px var(--color-tbj)">
        <span style="font-size: 17px; font-weight: bold;">
            Experiencia Profesional</span>
    </div> --}}

    <h4 class="color-tbj">Experiencia Profesional</h4>
    <hr>

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

    {{-- <div class="mb-3 w-100" style="border-bottom: solid 2px var(--color-tbj)">
        <span style="font-size: 17px; font-weight: bold;">
            Educación Académica</span>
    </div> --}}

    <h4 class="color-tbj">Educación Académica</h4>
    <hr>

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
    {{-- <div class="mb-3 w-100" style="border-bottom: solid 2px var(--color-tbj)">
        <span style="font-size: 17px; font-weight: bold;">
            Idiomas</span>
    </div> --}}

    <h4 class="color-tbj">Idiomas</h4>
    <hr>

    <div method="POST" action="{{ route('admin.idiomas-empleados.store', [$empleado->id]) }}" id="formIdiomas"
        enctype="multipart/form-data">
        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}" id="empleado_id_idioma" />
        <div class="row">
            <div class="form-group col-sm-5">
                <label for="id_language"><i class="fas fa-school iconos-crear"></i>Nombre</label>
                <select class="form-control {{ $errors->has('id_language') ? 'is-invalid' : '' }}" name="id_language"
                    id="nombre_idioma" value="{{ old('id_language', '') }}">
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
