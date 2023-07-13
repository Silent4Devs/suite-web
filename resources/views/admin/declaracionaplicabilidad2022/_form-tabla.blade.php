<div class="row col-12">

    <div class="form-group col-sm-4 col-md-4 col-lg-4">
        <label for="control_iso"><i class="far fa-clone iconos-crear"></i> Control Iso</label>
        <input class="form-control {{ $errors->has('control_iso') ? 'is-invalid' : '' }}" type="text" id="control-iso"
            value="{{ old('control_iso', $control['control_iso']) }}" readonly disabled>
    </div>
    <div class="form-group col-sm-4 col-md-4 col-lg-4">
        <label for="clasificacion"><i class="far fa-clone iconos-crear"></i>Clasificación</label>
        <input class="form-control {{ $errors->has('clasificacion') ? 'is-invalid' : '' }}" type="text"
            id="clasificacion" value="{{ old('anexo_indice', $control->clasificacion['nombre']) }}" readonly disabled>
    </div>
</div>
<div class="row col-12">
    <div class="form-group col-sm-12">
        <label class="required" for="anexo_politica"><i class="fas fa-pencil-alt iconos-crear"></i>Anexo
            Política</label>
        <textarea class="form-control {{ $errors->has('anexo_politica') ? 'is-invalid' : '' }}" type="text"
            name="anexo_politica" id="anexo_politica" required>{{ old('anexo_politica', $control['anexo_politica']) }}</textarea>
        @if ($errors->has('anexo_politica'))
            <div class="invalid-feedback">
                {{ $errors->first('anexo_politica') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
    </div>
    <div class="form-group col-sm-12">
        <label class="required" for="anexo_descripcion"><i class="fas fa-pencil-alt iconos-crear"></i>Anexo
            Descripción</label>
        <textarea class="form-control {{ $errors->has('anexo_descripcion') ? 'is-invalid' : '' }}" type="text"
            name="anexo_descripcion" id="anexo_descripcion" required>{{ old('anexo_descripcion', $control['anexo_descripcion']) }}</textarea>
        @if ($errors->has('anexo_descripcion'))
            <div class="invalid-feedback">
                {{ $errors->first('anexo_descripcion') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
    </div>
</div>
