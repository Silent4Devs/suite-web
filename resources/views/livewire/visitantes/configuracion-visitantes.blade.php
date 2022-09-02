<div>
    <x-loading-indicator />
    <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Debe seleccionar un responsable para autorizar
                    la salida de los visitantes</p>
            </div>
        </div>
    </div>
    <div class="mt-4">
        @if ($responsableVisitante)
            <p>Actualizado el {{ $responsableVisitante->updated_at }}</p>
        @endif
        <label for="responsable"><i class="bi bi-person mr-2"></i> Responsable</label>
        <select wire:model="responsable" class="custom-select">
            <option value="" disabled>-- Selecciona un responsable --</option>
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}"
                    {{ $empleado->id == $responsableVisitante->empleado_id ? 'selected' : '' }}>{{ $empleado->name }}
                </option>
            @endforeach
        </select>
        <div class="mt-4">
            <label for="fotografiaRequerida"><i class="bi bi-camera mr-2"></i>¿Es requerida la fotografía al momento de
                ingresar?</label>
            <select wire:model="fotografiaRequerida" class="custom-select">
                <option value="false" {{ !$responsableVisitante->fotografia_requerida ? 'selected' : '' }}>No</option>
                <option value="true" {{ $responsableVisitante->fotografia_requerida ? 'selected' : '' }}>Sí</option>

            </select>
        </div>
    </div>
