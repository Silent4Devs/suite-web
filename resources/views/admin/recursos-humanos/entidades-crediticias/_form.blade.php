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
    <a href="{{ route('admin.entidades-crediticias.index') }}" class="btn" id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
    <button class="btn btn-primary" type="submit">
        Guardar
    </button>
</div>
<style>

#btn_cancelar{
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        border-radius: 4px;
        opacity: 1;
        }
</style>
