<div class="row container justify-content-center">
    <div class="col-12 text-center header-text border rounded py-5" style="max-width: 40%">
        <h3 style="color: #3086AF">¡TE HAS REGISTRADO CON ÉXITO!</h3>
        <div class="mt-3" style="display: flex;justify-content: space-between">
            <span>Fecha: {{ now()->format('d-m-Y') }}</span>
            <span>Entrada: {{ now()->format('h:i A') }}</span>
        </div>
        <div class="mt-3">
            <img src="{{ $foto ? $foto : asset('assets/user.png') }}" style="max-width: 250px;clip-path: circle();"
                alt="{{ $nombre }}">
        </div>
        <div class="mt-3">
            <span style="color: #3086AF">ID: 1</span>
        </div>
        <div class="mt-3 border p-2" style="text-transform: capitalize">
            {{ $nombre }} {{ $apellidos }}
        </div>
        <div class="mt-3 border p-2">
            Dispositivo: {{ $dispositivo ? $dispositivo : 'N/A' }}
            Serie: {{ $serie ? $serie : 'N/A' }}
        </div>
        <div class="mt-3 border p-2">
            VISITA
            @if ($tipo_visita == 'persona')
                <p>PERSONA: {{ $castEmpleado ? $castEmpleado->name : 'N/A' }}</p>
            @else
                <p>ÁREA: {{ $castArea ? $castArea->area : 'N/A' }}</p>
            @endif
        </div>
    </div>
    <div class="col-12 mt-3" style="text-align: end">
        <button class="btn btn-primary" wire:click.prevent="guardarRegistroVisitante()">Finalizar</button>
    </div>
</div>
