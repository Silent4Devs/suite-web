

<!--<span class="card-title">Agregar Entregable</span>-->

{{-- <div class="col s12">
  <div class="form-group diseño-titulo" >
     <p class="center-align white-text" style="font-size:13pt;">AGREGAR ENTREGABLE</p>
   </div>
</div> --}}
<h4 class="sub-titulo-form col s12">AGREGAR ENTREGABLE</h4>
<form wire:submit.prevent="store" enctype="multipart/form-data">

    @include('livewire.entregable-mensual.form')

    <!--<button wire:click="store" class="btn green">
        Guardar
    </button>-->
  <div class="row">
     <div class="col s12 right-align" style="margin-top:40px;" >
        <button wire:click="store" type="submit" class="btn-redondeado btn btn-primary">Guardar</button>
  </div>

</form>
