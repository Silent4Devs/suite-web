<div>
    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Agregar evaluación</span>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('livewire.evaluaciones.form')
        </div>

        <div class="w-100 mr-4 d-flex">
            <div class="w-100" style="text-align: end">
                <button type="submit" class="btn-success btn green" wire:loading.attr="disabled" wire:target="store"
                    wire:click.prevent="store()">
                    <i class="fas fa-spinner fa-pulse" wire:loading wire:target="store"></i>
                    <span wire:loading.remove wire:target="store">Guardar</span>
                    <span wire:loading wire:target="store">Guardando</span>
                </button>
            </div>
        </div>
    </div>

</div>
