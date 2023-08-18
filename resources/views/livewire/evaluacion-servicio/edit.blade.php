<span class="card-title grey-text" style="font-size:25px;font-weight:bold;">Editar evaluación</span>



@include('livewire.evaluacion-servicio.form')

<button wire:click="update" class="btn-redondeado btn btn-primary">
    Actualizar
</button>

<button wire:click="default" class="btn-redondeado btn btn-default">
    Cancelar
</button>
