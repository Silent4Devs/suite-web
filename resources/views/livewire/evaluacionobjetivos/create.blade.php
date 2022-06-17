<div>
    <h5 class="py-2">Agregar evaluación</h5>

    @include('livewire.evaluacionobjetivos.form')

    <div class="form-group col-sm-4">
        <button type="submit" class="btn-success btn green" wire:loading.attr="disabled" wire:target="store"
            wire:click.prevent="store()">
            <i class="fas fa-spinner fa-pulse" wire:loading wire:target="store"></i>
            <span wire:loading.remove wire:target="store">Guardar</span>
            <span wire:loading wire:target="store">Guardando</span>
        </button>
    </div>
</div>
