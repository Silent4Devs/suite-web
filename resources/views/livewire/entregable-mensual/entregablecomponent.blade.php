<div>
    <div>
        @include('livewire.entregable-mensual.table')
    </div>
    <br>
    <div>
        @if (!$show_contrato)
            @include("livewire.entregable-mensual.$view")
        @endif
    </div>
</div>
