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
        <input type="text" name="entrevistado" id="entrevistado" class="form-control" maxlength="120" placeholder="0"
            required value="{{ old('entrevistado') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="puesto" class="required">Puesto:</label>
        @error('puesto')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="puesto" id="puesto" class="form-control" maxlength="200" placeholder="0"
            required value="{{ old('puesto') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="area" class="required">Área:</label>
        @error('area')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="area" id="area" class="form-control" maxlength="150" placeholder="0"
            required value="{{ old('area') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="direccion" class="required">Dirección:</label>
        @error('direccion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="direccion" id="direccion" class="form-control" maxlength="255" placeholder="0"
            required value="{{ old('direccion') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="extencion">Extensión:</label>
        @error('extencion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="number" name="extencion" id="extencion" class="form-control" maxlength="4" min="0"
            max="9999" placeholder="0" value="{{ old('extencion') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="correo" class="required">Correo:</label>
        @error('correo')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="email" name="correo" id="correo" class="form-control" maxlength="255" placeholder="0"
            required value="{{ old('correo') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="procesos_a_cargo" class="required">Procesos a su cargo:</label>
        @error('procesos_a_cargo')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="procesos_a_cargo" id="procesos_a_cargo" class="form-control" maxlength="255"
            placeholder="0" required value="{{ old('procesos_a_cargo') }}">
    </div>

</div>
<!-- DATOS DE IDENTIFICACIÓN DEL PROCESO  -->
<div class="row">
    <div class="text-center form-group col-12"
        style="background-color:var(--color-tbj); border-radius: 100px; color: white;">
        DATOS DE IDENTIFICACIÓN DEL PROCESO
    </div>
</div>

<div class="row" x-data="{ periodicidad: false }">
    <div class="form-group col-sm-8">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="id_proceso" class="required">ID del Proceso:</label>
        @error('id_proceso')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="id_proceso" id="id_proceso" class="form-control" maxlength="20"
            placeholder="0" required value="{{ old('id_proceso') }}">
    </div>

    <div class="form-group col-sm-4">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="version" class="required">Versión:</label>
        @error('version')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="version" id="version" class="form-control" maxlength="50" placeholder="0"
            required value="{{ old('version') }}">
    </div>

    <div class="form-group col-sm-8">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="nombre_proceso" class="required">Nombre del Proceso:</label>
        @error('nombre_proceso')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="nombre_proceso" id="nombre_proceso" class="form-control" maxlength="255"
            placeholder="0" required value="{{ old('nombre_proceso') }}">
    </div>

    <div class="form-group col-sm-4">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="tipo" class="required">Tipo:</label>
        @error('tipo')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="tipo" id="tipo" class="form-control" maxlength="255" placeholder="0"
            required value="{{ old('tipo') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="macroproceso" class="required">Macroproceso:</label>
        @error('macroproceso')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="macroproceso" id="macroproceso" class="form-control" maxlength="255"
            placeholder="0" required value="{{ old('macroproceso') }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="subproceso" class="required">Subproceso:</label>
        @error('subproceso')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="subproceso" id="subproceso" class="form-control" maxlength="255"
            placeholder="0" required value="{{ old('subproceso') }}">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="objetivo_proceso" class="required">Objetivo del Proceso:</label>
        @error('objetivo_proceso')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <input type="text" name="objetivo_proceso" id="objetivo_proceso" class="form-control" maxlength="255"
            placeholder="0" required value="{{ old('objetivo_proceso') }}">
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
</div>
