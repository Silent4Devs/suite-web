<div>
    <h5 class="py-2">Editar evaluación</h5>

    @include('livewire.evaluaciones.form')

    <div class="form-group col-sm-4">
        <button type="submit" class="btn-success btn green" wire:loading.attr="disabled" wire:target="update"
            wire:click.prevent="update()">
            <i class="fas fa-spinner fa-pulse" wire:loading wire:target="update"></i>
            <span wire:loading.remove wire:target="update">Actualizar</span>
            <span wire:loading wire:target="update">Actualizando</span>
        </button>
        <button wire:click="default" class="btn btn-danger rounded">
            Cancelar
        </button>
    </div>

</div>
