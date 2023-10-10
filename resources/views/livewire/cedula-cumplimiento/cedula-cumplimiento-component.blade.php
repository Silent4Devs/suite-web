<div>
    <div>
        @include('livewire.cedula-cumplimiento.table')
    </div>
    <br>
    <div>
        @if (!$show_contrato)
            @include("livewire.cedula-cumplimiento.$view")
            {{-- <div class="form-group diseño-titulo">
                <h4 class="sub-titulo-form col s12">HALLÁZGOS</h4>
            </div> --}}
    </div>
</div>
</div>
<div class="card card-body">
    <h4 style="text-align: center" class="sub-titulo-form col s12">HALLAZGOS</h4>
    <br>
    <br>
    <div>
        <h5 class="mb-0 d-inline-block">Facturas</h5>
        <hr class="hr-custom-title">
        <div> @include('livewire.cedula-cumplimiento.facturas_table')</div>
    </div>


    <div>
        <h5 class="mb-0 d-inline-block">Niveles de servicio</h5>
        <hr class="hr-custom-title">

        <div> @include('livewire.cedula-cumplimiento.niveles_servicio_table')</div>
    </div>

    <div>
        <h5 class="mb-0 d-inline-block"> Entregables mensuales</h5>
        <hr class="hr-custom-title">
        <div> @include('livewire.cedula-cumplimiento.entregables_mensuales_table')</div>
    </div>


    <div>
        <h5 class="mb-0 d-inline-block">Cierre proyecto</h5>
        <hr class="hr-custom-title">
        <div> @include('livewire.cedula-cumplimiento.cierre_contratos_table')</div>
    </div>
    @endif
</div>
