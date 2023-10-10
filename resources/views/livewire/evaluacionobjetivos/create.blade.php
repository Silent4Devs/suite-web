<div>
    <h5 class="py-2">Agregar evaluación</h5>

    @include('livewire.evaluacionobjetivos.form')

    <div class="btn-group col-sm-4">
        
        <button id="btnGuardarCalificaciones" type="submit" class="btn-success btn green" wire:loading.attr="disabled"
            wire:target="store" wire:click.prevent="store">
            <i class="fas fa-spinner fa-pulse" wire:loading wire:target="store"></i>
            <span wire:loading.remove wire:target="store">Guardar</span>
            <span wire:loading wire:target="store">Guardando</span>
        </button>
        <button class="btn btn_cancelar ml-2" onclick="window.close()">Salir</button>
    </div>
</div>
