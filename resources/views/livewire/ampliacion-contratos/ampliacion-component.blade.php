<div>
    <div>
        @include('livewire.ampliacion-contratos.table')
    </div>
    <br>
    <div>
        @if (!$show_contrato)
            @include("livewire.ampliacion-contratos.$view")
        @endif
    </div>
</div>



