<div>
    <div>
        @include('livewire.niveles-servicio.table')
    </div>
    <br>
    <div>
        @if (!$show_contrato)
            @include("livewire.niveles-servicio.$view")
        @endif
    </div>
</div>
