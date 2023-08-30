<div class="col s12">
    <div class="form-group diseño-titulo" >
       <p class="center-align white-text" style="font-size:13pt;">AGREGAR CONVENIO MODIFICATORIO</p>
     </div>
  </div>

  <form wire:submit.prevent="store">

  @include('livewire.convenios-modificatorios-contratos.form')
      <div class="row">
         <div class="col s12 right-align" style="margin-top:40px;">
           <button type="submit" class="btn-redondeado btn btn-primary">Guardar</button>
        </div>
      </div>
  </form>
