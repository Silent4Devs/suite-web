<div class="form-group">
    <label class="required" for="name"><i class="fas fa-briefcase iconos-crear"></i>Nombre</label>
    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name"
        value="{{ old('name', $tipoContratoEmpleado->name) }}" required>
    @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="description"><i class="fas fa-file-signature iconos-crear"></i>Descripción</label>
    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
        id="description">{{ old('description', $tipoContratoEmpleado->description) }}</textarea>
    @if ($errors->has('description'))
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
    @endif
</div>
<div class="text-right form-group col-12" style="margin-left:15px;">
    <a href="{{ route('admin.tipos-contratos-empleados.index') }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger" type="submit">
        Guardar
    </button>
</div>
