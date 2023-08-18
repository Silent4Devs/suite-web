<div>
    <h1>Convenios Modificatorios</h1>
    <div>
        @include('livewire.convenios-modificatorios-contratos.table')
    </div>
    <br>
    <div>
        @if (!$show_contrato)
            @include("livewire.convenios-modificatorios-contratos.$view")
        @endif
    </div>

</div>
