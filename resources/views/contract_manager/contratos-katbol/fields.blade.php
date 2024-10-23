<div class="col l12 m12 s12">

    <div class="card hoverable">
        <div class="card-content">
        <!-- No Contrato Field -->
        <div class="row mb-4">
            <div class="input-field col s12 m4">
                <small>No. de Contrato:</small>
                <input type="number" name="no_contrato" class="form-control" value="{{ old('no_contrato') }}">
            </div>

            <div class="input-field col s12 m4">
                <small>Nombre del Proveedor:</small>
                <input type="text" name="nombre_proveedor" class="form-control" value="{{ old('nombre_proveedor') }}">
            </div>

            <div class="input-field col s12 m4">
                <small>Área</small>
                <input type="text" name="area" class="form-control" value="{{ old('area') }}">
            </div>

            <div class="input-field col s12 m4">
                <small>Nombre del Servicio</small>
                <input type="text" name="nombre_servicio" class="form-control" value="{{ old('nombre_servicio') }}">
            </div>

            <div class="input-field col s12 m4">
                <small>Clasificación</small>
                <input type="text" name="clasificacion" class="form-control" value="{{ old('clasificacion') }}">
            </div>

            <div class="input-field col s12 m4">
                <small>Administrador</small>
                <input type="text" name="administrador" class="form-control" value="{{ old('administrador') }}">
            </div>

            <div class="input-field col s12 m4">
                <small>Fase</small>
                <input type="text" name="fase" class="form-control" value="{{ old('fase') }}">
            </div>

            <div class="input-field col s12 m4">
                <small class="active">Estatus*</small>
                <div class="display-flex ml-4">
                    <select class="validate" name="estatus" required>
                        <option value="" disabled selected>Escoga una opción</option>
                        <option value="Inicio" {{ old('estatus') == 'Inicio' ? 'selected' : '' }}>Inicio</option>
                        <option value="Ejecución" {{ old('estatus') == 'Ejecución' ? 'selected' : '' }}>Ejecución</option>
                        <option value="Conclusión" {{ old('estatus') == 'Conclusión' ? 'selected' : '' }}>Conclusión</option>
                    </select>
                </div>
                @if ($errors->has('estatus'))
                    <div class="display-flex ml-4">
                        <label class="red-text">{{ $errors->first('estatus') }}</label>
                    </div>
                @endif
            </div>

            <div class="input-field col s12 m4">
                <small>Vigencia del Contrato</small>
                <input type="text" name="vigencia_contrato" class="form-control" value="{{ old('vigencia_contrato') }}">
            </div>

            <div class="input-field col s12 m4">
                <small>PMP Asignado</small>
                <input type="text" name="pmp_asignado" class="form-control" value="{{ old('pmp_asignado') }}">
            </div>

            <div class="row mb-3">
                <div class="col s12">
                    <div class="form-group col-sm-12 right">
                        <button type="submit" class="btn tb-btn-primary">Guardar</button>
                        <a href="{{ route('contratos.index') }}" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
