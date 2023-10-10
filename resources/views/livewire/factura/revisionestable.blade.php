<div class="col s12">
    <div class="form-group diseño-titulo">
        <p class="center-align white-text" style="font-size:13pt;">AGREGAR REVISIÓN</p>
    </div>
</div>

@include('livewire.factura.form2')

<div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
    <div class="col s12 m12 right-align btn-grd distancia">
        <button wire:click="revisiones({{ $facturaRevision_id }})" class="btn btn-success">
            Guardar
        </button>

        <button wire:click="default" class="btn btn_cancelar">
            Cancelar
        </button>
    </div>
</div>
