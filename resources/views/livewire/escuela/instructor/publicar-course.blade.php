<div>
    <select wire:ignore value="{{ old('status_id') }}" wire:model.live="status_id" class="mt-2 mb-2 form-control d-inline"
        style="max-width:232px;">
        <option value="" disabled>Seleccione un estatus</option>
        <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Borrador</option>
        <option value="3" {{ $course->status == 3 ? 'selected' : '' }}>Publicado</option>
        <option value="4" {{ $course->status == 4 ? 'selected' : '' }}>Cerrado</option>
    </select>
    <p class="d-inline">
        @if ($course->status == 1)
            <span class="px-2 py-2 ml-3" style="background-color:#fd7e14; color:#FFFFFF; border-radius:10px;">
                Borrador
            </span>
        @endif
        @if ($course->status == 3)
            <span class="px-2 py-2 ml-3" style="background-color: #C6FFD0; color:#049209; border-radius:10px;">
                Publicado
            </span>
        @endif
        @if ($course->status == 4)
            <span class="px-2 py-2 ml-3" style="background-color: #a1a1a1; color:#3b3b3b; border-radius:10px;">
                Cerrado
            </span>
        @endif
    </p>
</div>
