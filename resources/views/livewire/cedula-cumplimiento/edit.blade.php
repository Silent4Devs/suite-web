<!--<span class="card-title">Editar ampliación</span>-->
<div>
    <div class="col s12">
        <div class="form-group diseño-titulo">
            <p class="center-align white-text" style="font-size:13pt;">Editar cédula de cumplimiento</p>
        </div>
    </div>

    <div class="row">
        @include('livewire.cedula-cumplimiento.form')
    </div>

    <div style="margin: 40px 0px; text-align: right;">
        <button wire:click="update" class="btn-redondeado btn btn-primary">
            Actualizar
        </button>

        <button wire:click="default" class="btn-redondeado btn btn-default">
            Cancelar
        </button>
    </div>
</div>
