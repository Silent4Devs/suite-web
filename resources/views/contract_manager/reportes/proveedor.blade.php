<div class="caja-blue mb-4">
    <div>
        <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="height: 200px;">
    </div>
    <div>
        <h4 style="font-size: 22px; font-weight: bolder;">REPORTE PROVEEDORES</h4>
        <h5 class="text-left" style="font-size: 17px; margin-top:10px;">En esta sección puedes datos de los proveedores</h5>
        <p class="m-1" style="width: 60%;">
            Aquí podrás consultar de manera fácil y rápida,
            la información general de los proveedores registrados,
            permitiéndote acceder a los datos clave para un mejor seguimiento y gestión.
        </p>
        <button wire:click="imprimirReporteProveedor()" class="btn mt-3"
            style="background-color: #fff; color: var(--color-tbj) !important;">
            <i class="fas fa-print"></i>Imprimir Reporte
        </button>
    </div>
</div>
<div class="seleccionar">
    <select class="form-control" searchable="Buscar..." name="proveedor" id="proveedor" wire:model.live="proveedor_id"
        wire:change="getProveedorID">
        <option value="" selected disabled>Seleccione un proveedor</option>
        @forelse($proveedores as $item_proveedor)
            <option value="{{ $item_proveedor->id }}">{{ $item_proveedor->razon_social }}
            </option>
        @empty
            <option value="">No hay proveedores registrados</option>
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
        <div wire:loading.remove>
            @if ($reporte_proveedor_generado)
                {!! $reporte_proveedor_generado !!}
            @endif
        </div>
    </div>
</div>
