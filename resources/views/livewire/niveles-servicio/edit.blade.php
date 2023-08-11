


<!--<span class="card-title">Editar nivel servicio</span>-->

<link rel="stylesheet" type="text/css" href="{{asset('css/botones.css')}}">

<div class="col s12">
    <div class="form-group diseño-titulo" >
       <p class="center-align white-text" style="font-size:13pt;">EDITAR NIVEL SERVICIO</p>
     </div>
  </div>

@include('livewire.niveles-servicio.form')

<button wire:click="update" class="btn-redondeado btn green">
    Actualizar
</button>

<button wire:click="default" class="btn-redondeado btn blue">
    Cancelar
</button>

