<div>
    @if ($visitante)
        <div class="mt-3" style="display: flex;justify-content: space-between">
            <span>Fecha: {{ now()->format('d-m-Y') }}</span>
            <span>Entrada: {{ now()->format('h:i A') }}</span>
        </div>
        <div class="mt-3">
            <img src="{{ isset($foto) && !empty($foto)
                ? $foto
                : (isset($visitante->foto) && !empty($visitante->foto)
                    ? $visitante->foto
                    : asset('assets/user.png')) }}"
                style="max-width: 250px; height: 150px; width: 150px; clip-path: circle();" alt="Foto Capturada">

        </div>

        <div class="mt-3 rounded border border-2  p-2" style="text-transform: capitalize">
            {{ $visitante['nombre'] }} {{ $visitante['apellidos'] }}
        </div>
        @if (count($visitante['dispositivos']))
            <div class="mt-3 rounded border border-2  p-2">
                <strong>Dispositivos</strong>
                @foreach ($visitante['dispositivos'] as $item)
                    @if ($item['dispositivo'])
                        <div>
                            Dispositivo: {{ $item['dispositivo'] ? $item['dispositivo'] : 'N/A' }}
                            Serie: {{ $item['serie'] ? $item['serie'] : 'N/A' }}
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
        <div class="mt-3 rounded border border-2  p-2">
            VISITA
            @if ($visitante['tipo_visita'] == 'persona')
                <p class="m-0"><strong>Nombre:
                    </strong>{{ $visitante['empleado'] ? $visitante['empleado']['name'] : 'N/A' }}</p>
                <p class="m-0"><strong>Puesto:
                    </strong>{{ $visitante['empleado'] ? $visitante['empleado']['puesto'] : 'N/A' }}</p>
                <p class="m-0">
                    <strong>Área:
                    </strong>{{ $visitante['empleado'] ? ($visitante['empleado']['area'] ? $visitante['empleado']['area']['area'] : 'N/A') : 'N/A' }}
                </p>
            @else
                <p>{{ $visitante ? $visitante['area']['area'] : 'N/A' }}</p>
            @endif
        </div>
        @if ($mostrarQrIngreso)
            <div class="mt-3 rounded border border-2  p-2">
                <div class="alert alert-primary mb-2" role="alert">
                    <i class="bi bi-info-circle"></i> <strong>¡Escaneame para registrar tu salida!</strong>
                </div>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const isRegistrarSalida = document.querySelector('[data-page="registrar-salida"]') !== null;

        // Si estamos en registrar salida, NO ejecutamos este script
        if (isRegistrarSalida) {
            console.log("🛑 Script de 'capturedImage' no se ejecuta en Registrar Salida.");
            return;
        }

        const capturedImageElement = document.getElementById("capturedImage");
        if (!capturedImageElement) return;

        const imageData = localStorage.getItem("capturedImage");
        if (imageData) {
            capturedImageElement.src = imageData;
            console.log("✅ Imagen cargada en la vista");
        }
    });
</script>
