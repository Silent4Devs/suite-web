<div>
    <div>
        @include('livewire.cierre-contratos.table')
    </div>
    <br>
    <div>
        @if (!$show_contrato)
           @include("livewire.cierre-contratos.$view")
        @endif
    </div>
</div>
