<div>
    <h5 class="py-2">Editar evaluación</h5>

    @include('livewire.evaluacionobjetivos.form')

    <div class="btn-group">
        <button type="submit" class="btn-success btn green" wire:loading.attr="disabled" wire:target="update"
            wire:click.prevent="update()">
            <i class="fas fa-spinner fa-pulse" wire:loading wire:target="update"></i>
            <span wire:loading.remove wire:target="update">Actualizar</span>
            <span wire:loading wire:target="update">Actualizando</span>
        </button>
        <button wire:click="default" class="ml-2 btn btn_cancelar">
            Cancelar
        </button>
        <button class="btn btn_cancelar ml-2" onclick="window.close()">Salir</button>
    </div>

</div>
