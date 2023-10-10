<!--<span class="card-title">Agregar nivel de servicio</span>-->

{{-- <div class="col s12">
  <div class="form-group diseño-titulo" >
     <p class="center-align white-text" style="font-size:13pt;">AGREGAR NIVEL DEL SERVICIO</p>
   </div>
</div> --}}
<h4 class="sub-titulo-form col s12">AGREGAR NIVEL DEL SERVICIO</h4>
<form wire:submit.prevent="store" enctype="multipart/form-data">

    @include('livewire.niveles-servicio.form')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}">



    <!--<button wire:click="store" class="btn green">
        Guardar
    </button>-->
    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <button type="submit" id="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>

</form>
