<div>
    <h5 class="py-2">Agregar evaluación</h5>
    <div class="row">
        <div class="col-md-10">
            @include('livewire.evaluaciones.form')
        </div>

        <div class="form-group col-md-2 " style="align-self: end;">
            <button type="submit" class="btn-success btn green" wire:loading.attr="disabled" wire:target="store"
                wire:click.prevent="store()">
                <i class="fas fa-spinner fa-pulse" wire:loading wire:target="store"></i>
                <span wire:loading.remove wire:target="store">Guardar</span>
                <span wire:loading wire:target="store">Guardando</span>
            </button>
        </div>
    </div>
    <div class="mt-4 text-right col-sm-12 col-lg-12 col-md-12">
        <a href="{{route('admin.indicadores-sgsis.index')}}" class="btn_cancelar" type="submit">Cerrar</a>
    </div>
</div>
