<div class="col s12">
  <div class="form-group diseño-titulo" >
     <p class="center-align white-text" style="font-size:13pt;">Agregar evaluación</p>
   </div>
</div>

<form wire:submit.prevent="store" enctype="multipart/form-data">

@include('livewire.evaluacion-servicio.formcreate')

  <div class="row">
    <div class="col s12 right-align" style="margin-top:40px;" >
      <button type="submit" class="btn-redondeado btn green">Guardar</button>
    </div>
  </div>

</form>

