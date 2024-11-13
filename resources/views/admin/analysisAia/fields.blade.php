<!-- DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO  -->
<div class="row">
    <div class="text-center form-group col-12"
        style="background-color:var(--color-tbj); border-radius: 100px; color: white;">
        DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="fecha_entrevista" class="required">Fecha de la entrevista:</label>
        @error('fecha_entrevista')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="date" name="fecha_entrevista" id="fecha_entrevista" class="form-control" required
            min="1945-01-01" value="{{ old('fecha_entrevista') }}">
    </div>
    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="entrevistado" class="required">Entrevistado:</label>
        @error('entrevistado')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="entrevistado" id="entrevistado" class="form-control" maxlength="255"
            placeholder="..." required value="{{ old('entrevistado') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="puesto" class="required">Puesto:</label>
        @error('puesto')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="puesto" id="puesto" class="form-control" maxlength="255" placeholder="..."
            required value="{{ old('puesto') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="area" class="required">Área:</label>
        @error('area')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="area" id="area" class="form-control" maxlength="255" placeholder="..."
            required value="{{ old('area') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="extencion">Extensión:</label>
        @error('extencion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="number" name="extencion" id="extencion" class="form-control" placeholder="..." min="0"
            max="9999" value="{{ old('extencion') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="correo" class="required">Correo:</label>
        @error('correo')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="email" name="correo" id="correo" class="form-control" maxlength="255" placeholder="..."
            required value="{{ old('correo') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="aplicaciones_a_cargo" class="required">Aplicaciones a su cargo:</label>
        @error('aplicaciones_a_cargo')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="aplicaciones_a_cargo" id="aplicaciones_a_cargo" class="form-control" maxlength="255"
            placeholder="..." required value="{{ old('aplicaciones_a_cargo') }}">
    </div>
</div>

<!-- DATOS DE IDENTIFICACIÓN DEL PROCESO  -->
<div class="row">
    <div class="text-center form-group col-12"
        style="background-color:var(--color-tbj); border-radius: 100px; color: white;">
        DATOS DE IDENTIFICACIÓN DE LA APLICACIÓN
    </div>
</div>

<div class="row" x-data="{ periodicidad: false }">

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="nombre_aplicacion" class="required">Nombre de la Aplicación:</label>
        @error('nombre_aplicacion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="nombre_aplicacion" id="nombre_aplicacion" class="form-control" maxlength="255"
            placeholder="..." required value="{{ old('nombre_aplicacion') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="id_aplicacion" class="required">ID de la Aplicación:</label>
        @error('id_aplicacion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="id_aplicacion" id="id_aplicacion" class="form-control" maxlength="255"
            placeholder="..." required value="{{ old('id_aplicacion') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="version" class="required">Versión:</label>
        <input type="text" name="version" id="version" class="form-control" maxlength="255" placeholder="..."
            required value="{{ old('version') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="productivo_desarrollo" class="required">Estatus:</label>
        @error('productivo_desarrollo')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <select class="form-control" name="productivo_desarrollo" id="productivo_desarrollo" required>
            <option value disabled {{ old('productivo_desarrollo') === null ? 'selected' : '' }}>
                Selecciona una opción
            </option>
            @foreach (App\Models\AnalisisAIA::AmbienteSelect as $key => $label)
                <option value="{{ $key }}"
                    {{ old('productivo_desarrollo', $cuestionario->productivo_desarrollo) === (int) $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="interno_externo" class="required">Publicación:</label>
        @error('interno_externo')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <select class="form-control" name="interno_externo" id="interno_externo" required>
            <option value disabled {{ old('interno_externo') === null ? 'selected' : '' }}>
                Selecciona una opción
            </option>
            @foreach (App\Models\AnalisisAIA::PublicacionSelect as $key => $label)
                <option value="{{ $key }}"
                    {{ old('interno_externo', $cuestionario->interno_externo) === (int) $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="objetivo_aplicacion" class="required">Objetivo de la Aplicación:</label>
        @error('objetivo_aplicacion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="objetivo_aplicacion" id="objetivo_aplicacion" class="form-control"
            maxlength="255" placeholder="..." required value="{{ old('objetivo_aplicacion') }}">
    </div>

    <div class="form-group col-sm-12">
        <label for="tipo_conteo" class="required"><i class="fa-solid fa-calendar-days iconos-crear"></i>Periodicidad
            con
            que se genera:</label>
        @error('periodicidad')
            <small style="color: red">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="1"
                @click="periodicidad = false"
                {{ old('periodicidad_mensual', $cuestionario->periodicidad) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio1">Diario</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="2"
                @click="periodicidad = false"
                {{ old('periodicidad_mensual', $cuestionario->periodicidad) == '2' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio2">Semanal</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="3"
                @click="periodicidad = false"
                {{ old('periodicidad_mensual', $cuestionario->periodicidad) == '3' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio3">Mensual</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="4"
                @click="periodicidad = true"
                {{ old('periodicidad_mensual', $cuestionario->periodicidad) == '4' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio3">Otro: </label>
        </div>
    </div>

    <div class="form-group col-sm-12" x-show="periodicidad">
        <input type="text" class="form-control" name="p_otro_txt" placeholder="Defina"
            x-bind:disabled="!periodicidad">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="area_pertenece_aplicacion" class="required">Área a la que pertenece la Aplicación:</label>
        @error('area_pertenece_aplicacion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="area_pertenece_aplicacion" id="area_pertenece_aplicacion" class="form-control"
            maxlength="255" placeholder="..." required value="{{ old('area_pertenece_aplicacion') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="area_responsable_aplicacion" class="required">Área responsable del uso de la Aplicación:</label>
        @error('area_responsable_aplicacion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="area_responsable_aplicacion" id="area_responsable_aplicacion"
            class="form-control" maxlength="255" placeholder="..." required
            value="{{ old('area_responsable_aplicacion') }}">
    </div>

</div>
