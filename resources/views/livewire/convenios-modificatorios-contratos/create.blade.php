<div class="col s12">
    <div class="form-group diseño-titulo">
        <p class="center-align white-text" style="font-size:13pt;">AGREGAR CONVENIO MODIFICATORIO</p>
    </div>
</div>

<form wire:submit.prevent="store">

    @include('livewire.convenios-modificatorios-contratos.form')

    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>
</form>
