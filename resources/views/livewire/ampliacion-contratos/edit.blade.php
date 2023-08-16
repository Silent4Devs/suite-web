<!--<span class="card-title">Editar ampliación</span>-->

<div class="col s12">
    <div class="form-group diseño-titulo" >
       <p class="center-align white-text" style="font-size:13pt;">EDITAR AMPLIACIÓN DE CONTRATO</p>
     </div>
  </div>

@include('livewire.ampliacion-contratos.form')

<button wire:click="update" class="btn-redondeado btn green">
    Actualizar
</button>

<button wire:click="default" class="btn-redondeado btn blue">
    Cancelar
</button>
    