<span class="card-title grey-text" style="font-size:25px;font-weight:bold;">Editar evaluación</span>



@include('livewire.evaluacion-servicio.form')

<div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
    <div class="col s12 m12 right-align btn-grd distancia">
        <button wire:click="update" class="btn btn-success">
            Actualizar
        </button>

        <button wire:click="default" class="btn btn_cancelar">
            Cancelar
        </button>
    </div>
</div>
