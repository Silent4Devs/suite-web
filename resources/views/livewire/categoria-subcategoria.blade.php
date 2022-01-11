<div class="col-12 row">
    <div class="form-group col-md-6">
        <label class="required" for="tipoactivo_id"><i
                class="fas fa-layer-group iconos-crear"></i>Categoría</label>
        <select class="form-control select2 {{ $errors->has('tipoactivo') ? 'is-invalid' : '' }}" wire:model='categoria'
            name="tipoactivo_id" id="tipoactivo_id" required>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('tipoactivo_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->tipo }}</option>
            @endforeach
        </select>
        @if ($errors->has('tipoactivo_id'))
            <div class="invalid-feedback">
                {{ $errors->first('tipoactivo_id') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.activo.fields.tipoactivo_helper') }}</span>
    </div>

    <div class="form-group col-md-6">
        <label for="subtipo_id" class="required "><i class="fas fa-adjust iconos-crear"></i>Subcategoría</label>
    <select class="form-control select2 {{ $errors->has('subtipo') ? 'is-invalid' : '' }}"
        name="subtipo_id" id="subtipo_id" required>
        @foreach($subcategorias as $subcategoria)
            <option value="{{$subcategoria->categoria_id}}">{{$subcategoria->subcategoria}}</option>
        @endforeach
    </select>
    @if ($errors->has('subtipo_id'))
    <div class="invalid-feedback">
        {{ $errors->first('subtipo_id') }}
    </div>
@endif
</div>
</div>
