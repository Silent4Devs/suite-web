<div class="form-group">
    <label class="required" for="entidad"><i class="fas fa-briefcase iconos-crear"></i>Entidad</label>
    <input class="form-control {{ $errors->has('entidad') ? 'is-invalid' : '' }}" type="text" name="entidad"
        id="entidad" value="{{ old('entidad', $entidadCrediticia->entidad) }}" required>
    @if ($errors->has('entidad'))
        <div class="invalid-feedback">
            {{ $errors->first('entidad') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="descripcion"><i class="fas fa-file-signature iconos-crear"></i>Descripción</label>
    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
        id="descripcion">{{ old('descripcion', $entidadCrediticia->descripcion) }}</textarea>
    @if ($errors->has('descripcion'))
        <div class="invalid-feedback">
            {{ $errors->first('descripcion') }}
        </div>
    @endif
</div>
<div class="text-right form-group col-12" style="margin-left:15px;">
    <a href="{{ route('admin.entidades-crediticias.index') }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger" type="submit">
        Guardar
    </button>
</div>
