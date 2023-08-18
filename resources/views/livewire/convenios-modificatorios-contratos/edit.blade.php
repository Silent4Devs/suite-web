
  <div class="col s12">
    <div class="form-group diseño-titulo" >
       <p class="center-align white-text" style="font-size:13pt;">EDITAR CONVENIO MODIFICATORIO</p>
     </div>
  </div>

@include('livewire.convenios-modificatorios-contratos.form')

<button wire:click="update" class="btn-redondeado btn btn-primary" >
    Actualizar
</button>

<button wire:click="default" class="btn-redondeado btn btn-default">
    Cancelar
</button>
