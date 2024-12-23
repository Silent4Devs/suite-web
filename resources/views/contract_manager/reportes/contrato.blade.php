<div style="display: flex; justify-content: space-between; padding:10px; margin-bottom: 20px;">
    <h4 class="sub-titulo-form">REPORTE CONTRATO</h4>
    <button class="btn" style="bottom: 25px !important;"
        onclick="printJS({
        printable: 'contrato_reporte',
        type: 'html',
        css: '{{ asset('css/reports.css/reports.css') }}',})">
        <i class="fas fa-print"></i>
        Imprimir Reporte
    </button>
</div>
<div class="seleccionar">
    <select class="form-control" searchable="Buscar..." name="contrato" id="contrato" class=""
        wire:model.live="contrato_id" wire:change="getContratoID">
        <option value="" selected disabled>Seleccione un contrato</option>
        @forelse($contratos as $item_contrato)
            <option value="{{ $item_contrato->id }}">{{ $item_contrato->no_contrato }}</option>
        @empty
            <option value="">No hay contratos registrados</option>
        @endforelse
    </select>
    <div wire:loading>
        <div class="spinner-grow text-primary" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-info" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-light" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-dark" role="status">
            <span class="sr-only"></span>
        </div>
    </div>
</div>
<div class="card">
    <div id="contrato_reporte" class="card-content">
        <style type="text/css">
            .logo_organizacion {
                width: 120px;
                height: 120px;
                margin: auto;

                @if (isset($logotipo->logotipo))
                    background-image: url('{{ url('images/' . $logotipo->logotipo) }}');
                @else
                    background-image: url('{{ url('img/Silent4Business-Logo-Color.png') }}');
                @endif
                background-repeat: no-repeat;
                background-size: contain;
                background-position: center;
            }
        </style>
        <div wire:loading.remove>
            @if ($reporte_contrato_generado)
                {!! $reporte_contrato_generado !!}
            @endif
        </div>
    </div>
</div>
