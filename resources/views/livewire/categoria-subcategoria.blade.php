<div class="col-md-6">
    <div class="row align-items-center">
        <div class="form-group col-md-11">
        <label class="required" for="tipoactivo_id"><i class="fas fa-layer-group iconos-crear"></i>Categoría</label>
        <select class="form-control select2 selecCategoria {{ $errors->has('tipoactivo') ? 'is-invalid' : '' }}" wire:model='categoriasSeleccionado' name="tipoactivo_id" id="tipoactivo_id" required>
            <option value="">Seleccionar</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{(int)($categoriasSeleccionado) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->tipo }}</option>
            @endforeach
        </select>
            @if ($errors->has('tipoactivo_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('tipoactivo_id') }}
                </div>
            @endif
    </div>
    <div style="margin-top:17px;height: 28px !important;margin-left: -10px !important;">
        <button id="btnAgregarTipo" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
        data-toggle="modal" data-target="#categorialec" data-whatever="@mdo" title="Agregar Tipo"><i
            class="fas fa-plus"></i></button>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="row align-items-center">
        <div class="form-group col-md-11">
        <label for="subtipo_id" class="required "><i class="fas fa-adjust iconos-crear"></i>Subcategoría</label>
        <select class="form-control select2 selecSubcategoria {{ $errors->has('subtipo') ? 'is-invalid' : '' }}" wire:model='subcategoria'name="subtipo_id" id="subtipo_id">
            @foreach($subcategorias as $subcategoria)
                <option value="{{$subcategoria->id}}">{{$subcategoria->subcategoria}}</option>
            @endforeach
        </select>
            @if ($errors->has('subtipo_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('subtipo_id') }}
                </div>
            @endif
    </div>
    <div style="margin-top:17px;height:28px !important;margin-left: -10px !important;">
        <button id="btnAgregarTipo" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
        data-toggle="modal" data-target="#subcategorialec" data-whatever="@mdo" title="Agregar Tipo"><i
            class="fas fa-plus"></i></button>
        </div>
    </div>
</div>


