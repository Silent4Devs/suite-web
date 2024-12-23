<div style="display: flex; justify-content: space-between; padding:10px; margin-bottom: 20px;">
    <h4 class="sub-titulo-form">REPORTE PROVEEDOR</h4>
    <button class="btn" style="bottom: 25px !important;"
        onclick="printJS({
        printable: 'proveedor_reporte',
        type: 'html',
        css: '{{ asset('css/reports.css/reports.css') }}',})">
        <i class="fas fa-print"></i>
        Imprimir Reporte
    </button>
</div>
<div class="seleccionar">
    <select class="form-control" searchable="Buscar..." name="proveedor" id="proveedor">
        <option value="" selected disabled>Seleccione un proveedor</option>
        @forelse($proveedores as $item_proveedor)
            <option value="{{ $item_proveedor->id }}">{{ $item_proveedor->nombre_comercial }}
            </option>
        @empty
            <option value="">No hay proveedores registrados</option>
        @endforelse
    </select>
    <button type="submit" class="btn tb-btn-primary" id="buscar_proveedor"
        onclick="buscarproveedor($('#proveedor').val()); return false;">
        Generar reporte
    </button>

</div>
<div class="card">
    <div id="proveedor_reporte" class="card-content">
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
        <div id="caja_reporte_proveedor_ajax"></div>
    </div>
</div>
