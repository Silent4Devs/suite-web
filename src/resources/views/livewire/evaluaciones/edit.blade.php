<div>
    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Editar evaluación</span>
    </div>

    @include('livewire.evaluaciones.form')

    <div class="row w-100 m-0" style="justify-content:end">
        <button type="submit" class="mr-3 btn-success btn green" wire:loading.attr="disabled" wire:target="update"
            wire:click.prevent="update()">
            <i class="fas fa-spinner fa-pulse" wire:loading wire:target="update"></i>
            <span wire:loading.remove wire:target="update">Actualizar</span>
            {{-- <span wire:loading wire:target="update">Actualizando</span> --}}
        </button>
        <button wire:click="default" class="btn btn_cancelar">
            Cancelar
        </button>
    </div>
</div>
