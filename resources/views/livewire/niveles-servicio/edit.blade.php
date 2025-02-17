<!--<span class="card-title">Editar nivel servicio</span>-->

<link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}{{ config('app.cssVersion') }}">

<div class="col s12">
    <div class="form-group diseño-titulo">
        <p class="center-align white-text" style="font-size:13pt;">EDITAR NIVEL SERVICIO</p>
    </div>
</div>

@include('livewire.niveles-servicio.form')

<div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
    <div class="col s12 m12 right-align btn-grd distancia">
        <button wire:click="update" class="btn btn-primary">
            Actualizar
        </button>

        <button wire:click="default" class="btn btn-outline-primary">
            Cancelar
        </button>
    </div>
</div>
