<div>
    <div>
        @include('livewire.factura.table')
    </div>
    @if ($show_revisiones)
        <div>
            @include('livewire.factura.revisionestable')
        </div>

        <div>
            @include("livewire.factura.$vista")
        </div>
    @endif
    <br>
    <div>
        @if (!$show_contrato)
            @include("livewire.factura.$view")
        @endif
    </div>
</div>
