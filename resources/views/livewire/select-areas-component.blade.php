<select class="procesoSelect form-control" name="id_amenaza" id="id_amenaza">
    <option value="">Seleccione una opción</option>
    @foreach ($areas as $area)
        <option {{ old('id_amenaza') == $area->id ? ' selected="selected"' : '' }}
            value="{{ $area->id }}">{{ $area->area }}
        </option>
    @endforeach
</select>
