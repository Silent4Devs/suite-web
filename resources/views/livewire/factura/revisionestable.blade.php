<div class="col s12">
    <div class="form-group diseño-titulo" >
       <p class="center-align white-text" style="font-size:13pt;">AGREGAR REVISIÓN</p>
     </div>
</div>

@include('livewire.factura.form2')

<div class="right-align">
<button wire:click="revisiones({{$facturaRevision_id}})" class="btn-redondeado btn green">
    Guardar
</button>

<button wire:click="default" class="btn-redondeado btn blue">
    Cancelar
</button>
</div>

