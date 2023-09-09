<div>
    <select wire:ignore value="{{ old('status_id') }}"
     wire:model="status_id" class="mt-2 mb-2 form-control d-inline" style="max-width:232px;">
        <option value="" disabled>Seleccione un estatus</option>
        <option value="1" {{ $course->status == 1 ?'selected':'' }}>Borrador</option>
        <option value="3" {{ $course->status == 3 ?'selected':'' }}>Publicado</option>
    </select>
    <p class="d-inline">
        @if ($course->status == 1)
            <span class="px-2 py-2 ml-3" style="background-color: #C6FFD0; border-radius:10px">
                Borrador
            </span>
        @else
            <span class="px-2 py-2 ml-3" style="background-color: #C6FFD0; color:#049209; border-radius:10px">
                Publicado
            </span>
        @endif
    </p>
</div>
