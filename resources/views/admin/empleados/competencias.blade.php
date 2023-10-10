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

        <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
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
                        <th>Documento</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <input type="hidden" name="certificado" value="" id="certificado">


        <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
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



        <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
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


        <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
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



        <div class="mb-3 w-100" style="border-bottom: solid 2px #345183;">
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
