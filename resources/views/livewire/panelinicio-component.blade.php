<div class="container">
    <div class="row">
        <div class="form-group col-sm-3">
            <label class="required" for="nombre_id"><i class="fas fa-street-view iconos-crear"></i>Nombre</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.debounce.800ms="nombre_id" class="c-switch-input" checked>
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="nempleado_id"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.debounce.800ms="nempleado_id" class="c-switch-input" checked>
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="jefe_id"><i class="fas fa-user iconos-crear"></i>Jefe
                Inmediato</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.debounce.800ms="jefe_id" class="c-switch-input" checked>
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>Área</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.debounce.800ms="area_id" class="c-switch-input" checked>
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="puesto_id"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.debounce.800ms="puesto_id" class="c-switch-input" checked>
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <br>
            <label class="c-switch c-switch-lg c-switch-pill c-switch-label c-switch-info" style="margin-left: 30px;">
                <input type="checkbox" wire:model.debounce.800ms="puesto_id" class="c-switch-input" checked>
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                name="n_empleado" id="n_empleado" value="{{ old('n_empleado', '') }}" required>
            @error('n_empleado')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                name="n_empleado" id="n_empleado" value="{{ old('n_empleado', '') }}" required>
            @error('n_empleado')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                name="n_empleado" id="n_empleado" value="{{ old('n_empleado', '') }}" required>
            @error('n_empleado')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                name="n_empleado" id="n_empleado" value="{{ old('n_empleado', '') }}" required>
            @error('n_empleado')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                name="n_empleado" id="n_empleado" value="{{ old('n_empleado', '') }}" required>
            @error('n_empleado')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-sm-3">
            <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                de
                empleado</label>
            <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                name="n_empleado" id="n_empleado" value="{{ old('n_empleado', '') }}" required>
            @error('n_empleado')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
