<div>
    <p>Estatus actual:
        @if ($course->status == 1)
            <span
                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Borrador</span>
        @else
            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                Publicado
            </span>
        @endif
    </p>
    <select wire:ignore value="{{ old('status_id') }}"  
     wire:model="status_id" class="block w-full mt-2 mb-2 form-input">
        <option value="" disabled>Seleccione un estatus</option>
        <option value="1" {{ $course->status == 1 ?'selected':'' }}>Borrador</option>
        <option value="3" {{ $course->status == 3 ?'selected':'' }}>Publicado</option>
    </select> 
</div>
