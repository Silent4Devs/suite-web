<div class="row">
    @if ($esPlanTrabajoBase)
        <input type="hidden" name="es_plan_trabajo_base" value="true">
    @endif
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <div class="form-group anima-focus">
                <input type="text" class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" id="parent"
                    aria-describedby="parent" name="parent"
                    value="{{ $referencia ? $referencia : old('parent', $planImplementacion->parent) }}"
                    autocomplete="off" required>
                @if ($errors->has('parent'))
                    <span class="invalid-feedback">{{ $errors->first('parent') }}</span>
                @endif
                <label for="parent"> Nombre: <span class="text-danger">*</span></label>
                <span class="text-danger parent_error error-ajax"></span>
            </div>
        </div>
    </div>
    <div class="col-sm" style="padding-left: inherit !important">
        <div class="form-group anima-focus">
            <input type="date" min="1945-01-01" class="form-control" id="inicio" name="inicio" required>
            <label for="inicio"> Fecha inicio <span class="text-danger">*</span></label>
            <small class="p-0 m-0 text-xs error_inicio errores text-danger"></small>
        </div>

    </div>
    <div class="col-sm">
        <div class="form-group anima-focus">
            <input type="date" min="1945-01-01" class="form-control" id="fin" name="fin" required>
            <label for="fin"> Fecha fin <span class="text-danger">*</span></label>
            <small class="p-0 m-0 text-xs error_fin errores text-danger"></small>
        </div>
    </div>
</div>
<div class="row">
    <div style="
    width: -webkit-fill-available;
    padding-left: 20px;
    padding-right: 20px;">
        <div class="form-group">
            <div class="form-group anima-focus">
                <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" id="objetivo" name="objetivo"
                    required>{{ old('objetivo', $planImplementacion->objetivo) }}</textarea>
                @if ($errors->has('objetivo'))
                    <div class="invalid-feedback">{{ $errors->first('objetivo') }}</div>
                @endif
                <label for="objetivo">Objetivo:</label>
                <span class="text-danger norma_error error-ajax"></span>
            </div>
        </div>
    </div>
</div>