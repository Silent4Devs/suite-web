<!--<span class="card-title">Agregar ampliación</span>-->
{{-- <div> --}}
    {{-- <div class="col s12">
        <div class="form-group diseño-titulo">
            <p class="center-align white-text" style="font-size:13pt;">Agregar cédula de cumplimiento</p>
        </div>
    </div>
    <br /><br /> --}}
    <h4 class="sub-titulo-form col s12">AGREGAR CÉDULA DE CUMPLIMIENTO</h4>
    <form wire:submit.prevent="store" style="display:none;">
        @include('livewire.cedula-cumplimiento.form')
        <div class="row">
            <div class="col s12 right-align" style="margin-top:40px;">
                <button type="submit" class="btn-redondeado btn green">Guardar</button>
            </div>
        </div>
    </form>
{{-- </div> --}}
