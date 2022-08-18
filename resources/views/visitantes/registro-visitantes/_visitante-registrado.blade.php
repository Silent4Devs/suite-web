<div>
    @if ($visitante)
        <div class="mt-3" style="display: flex;justify-content: space-between">
            <span>Fecha: {{ now()->format('d-m-Y') }}</span>
            <span>Entrada: {{ now()->format('h:i A') }}</span>
        </div>
        <div class="mt-3">
            <img src="{{ $visitante['foto'] ? $visitante['foto'] : asset('assets/user.png') }}"
                style="max-width: 250px;clip-path: circle();" alt="{{ $visitante['nombre'] }}">
        </div>
        <div class="mt-3 rounded border border-2  p-2" style="text-transform: capitalize">
            {{ $visitante['nombre'] }} {{ $visitante['apellidos'] }}
        </div>
        <div class="mt-3 rounded border border-2  p-2">
            Dispositivo: {{ $visitante['dispositivo'] ? $visitante['dispositivo'] : 'N/A' }}
            Serie: {{ $visitante['serie'] ? $visitante['serie'] : 'N/A' }}
        </div>
        <div class="mt-3 rounded border border-2  p-2">
            VISITA
            @if ($visitante['tipo_visita'] == 'persona')
                <p>{{ $visitante['empleado'] ? $visitante['empleado']['name'] : 'N/A' }}</p>
            @else
                <p>{{ $visitante ? $visitante['area']['area'] : 'N/A' }}</p>
            @endif
        </div>
        @if ($mostrarQrIngreso)
            <div class="mt-3 rounded border border-2  p-2">
                {!! QrCode::size(120)->generate($urlQrIngreso) !!}
            </div>
        @endif
        @if ($mostrarQrSalida)
            <div class="mt-3 rounded border border-2  p-2">
                {!! QrCode::size(120)->generate($urlQrSalida) !!}
            </div>
        @endif
    @endif
</div>
