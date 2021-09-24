<div>
    <h5 class="py-2">Editar evaluación</h5>

    @include('livewire.evaluacionobjetivos.form')

    <div class="form-group justify-content-between d-flex">
        <div class="col-2">
            <button type="submit" class="btn-success btn green" wire:loading.attr="disabled" wire:target="update"
                wire:click.prevent="update()">
                <i class="fas fa-spinner fa-pulse" wire:loading wire:target="update"></i>
                <span wire:loading.remove wire:target="update">Actualizar</span>
                <span wire:loading wire:target="update">Actualizando</span>
            </button>
        </div>
        <div class="col">
            <button wire:click="default" class="btn_cancelar">
                Cancelar
            </button>
        </div>
    </div>

</div>
